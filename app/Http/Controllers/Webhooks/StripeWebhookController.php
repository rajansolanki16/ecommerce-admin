<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\Event;
use Stripe\Exception\SignatureVerificationException;
use Stripe\StripeClient;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    /**
     * Handle Stripe webhook events.
     */
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret') ?? getPaymentSetting('stripe_webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (SignatureVerificationException $e) {
            \Log::error('Stripe webhook signature verification failed: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 403);
        } catch (\Exception $e) {
            \Log::error('Stripe webhook error: ' . $e->getMessage());
            return response()->json(['error' => 'Webhook error'], 400);
        }

        // Handle different event types
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $this->handlePaymentIntentSucceeded($event);
                break;

            case 'payment_intent.payment_failed':
                $this->handlePaymentIntentFailed($event);
                break;

            case 'charge.refunded':
                $this->handleChargeRefunded($event);
                break;

            case 'charge.dispute.created':
                $this->handleDisputeCreated($event);
                break;

            default:
                \Log::info('Unhandled Stripe event type: ' . $event->type);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Handle payment_intent.succeeded event.
     */
    private function handlePaymentIntentSucceeded($event)
    {
        $paymentIntent = $event->data->object;
        $transactionId = $paymentIntent->id;

        try {
            $payment = Payment::where('transaction_id', $transactionId)->first();

            if (!$payment) {
                \Log::warning("Payment not found for Stripe transaction: {$transactionId}");
                return;
            }

            // Update payment status
            $payment->markAsSucceeded([
                'stripe_event_id' => $event->id,
                'payment_intent_id' => $paymentIntent->id,
                'charge_id' => $paymentIntent->charges->data[0]->id ?? null,
            ]);

            // Update order status
            $order = $payment->order;
            if ($order->status === 'pending') {
                $order->updateStatus(
                    'processing',
                    'payment_succeeded',
                    'webhook',
                    null,
                    ['stripe_event_id' => $event->id]
                );

                \Log::info("Order #{$order->id} marked as processing after payment success");
            }

            // Dispatch event for notifications
            event(new \App\Events\PaymentSucceeded($payment));

        } catch (\Exception $e) {
            \Log::error("Error handling payment_intent.succeeded: " . $e->getMessage());
        }
    }

    /**
     * Handle payment_intent.payment_failed event.
     */
    private function handlePaymentIntentFailed($event)
    {
        $paymentIntent = $event->data->object;
        $transactionId = $paymentIntent->id;

        try {
            $payment = Payment::where('transaction_id', $transactionId)->first();

            if (!$payment) {
                \Log::warning("Payment not found for Stripe transaction: {$transactionId}");
                return;
            }

            // Extract failure reason
            $failureReason = $paymentIntent->last_payment_error?->message ?? 'Unknown error';

            // Update payment status
            $payment->markAsFailed($failureReason, [
                'stripe_event_id' => $event->id,
                'error_code' => $paymentIntent->last_payment_error?->code,
                'error_message' => $failureReason,
            ]);

            // Update order status if not already failed
            $order = $payment->order;
            if ($order->status === 'pending') {
                $order->updateStatus(
                    'pending', // Keep as pending so customer can retry
                    'payment_failed',
                    'webhook',
                    null,
                    [
                        'stripe_event_id' => $event->id,
                        'failure_reason' => $failureReason,
                    ]
                );
            }

            // Dispatch event for notifications
            event(new \App\Events\PaymentFailed($payment));

            \Log::warning("Payment failed for Order #{$order->id}: {$failureReason}");

        } catch (\Exception $e) {
            \Log::error("Error handling payment_intent.payment_failed: " . $e->getMessage());
        }
    }

    /**
     * Handle charge.refunded event.
     */
    private function handleChargeRefunded($event)
    {
        $charge = $event->data->object;
        $paymentIntentId = $charge->payment_intent;

        try {
            $payment = Payment::where('transaction_id', $paymentIntentId)->first();

            if (!$payment) {
                \Log::warning("Payment not found for refunded charge: {$paymentIntentId}");
                return;
            }

            // Update payment status
            $payment->markAsRefunded();

            \Log::info("Payment #{$payment->id} marked as refunded");

        } catch (\Exception $e) {
            \Log::error("Error handling charge.refunded: " . $e->getMessage());
        }
    }

    /**
     * Handle charge.dispute.created event.
     */
    private function handleDisputeCreated($event)
    {
        $dispute = $event->data->object;

        try {
            \Log::warning("Charge dispute created: {$dispute->id} for charge {$dispute->charge}");
            // TODO: Implement dispute handling - notify admin, etc.
        } catch (\Exception $e) {
            \Log::error("Error handling charge.dispute.created: " . $e->getMessage());
        }
    }
}
