{{-- resources/views/admin/dashboard.blade.php --}}

<x-admin.header :title="'Dashboard'" />

<x-page-title 
    title="Dashboard" 
    :breadcrumbs="['Admin', 'Dashboard']"
/>

<div class="row">

    {{-- Total Orders --}}
    <div class="col-xxl-3 col-sm-6">

        <div class="card card-animate">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="fw-medium text-muted mb-0">
                            Total Orders
                        </p>

                        <h2 class="mt-4 ff-secondary fw-semibold">
                            <span class="counter-value">
                                2,450
                            </span>
                        </h2>

                        <p class="mb-0 text-muted">

                            <span class="badge bg-success-subtle text-success mb-0">

                                <i class="ri-arrow-up-line align-middle"></i>
                                12.5 %

                            </span>
                            vs previous month
                        </p>

                    </div>

                    <div>

                        <div class="avatar-sm flex-shrink-0">

                            <span class="avatar-title bg-primary-subtle rounded fs-3">

                                <i class="ri-shopping-bag-3-line text-primary"></i>

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Revenue --}}
    <div class="col-xxl-3 col-sm-6">

        <div class="card card-animate">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="fw-medium text-muted mb-0">
                            Revenue
                        </p>

                        <h2 class="mt-4 ff-secondary fw-semibold">
                            ₹85,420
                        </h2>

                        <p class="mb-0 text-muted">

                            <span class="badge bg-success-subtle text-success mb-0">

                                <i class="ri-arrow-up-line align-middle"></i>
                                8.2 %

                            </span>

                            vs previous month

                        </p>

                    </div>

                    <div>

                        <div class="avatar-sm flex-shrink-0">

                            <span class="avatar-title bg-success-subtle rounded fs-3">

                                <i class="ri-money-dollar-circle-line text-success"></i>

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Customers --}}
    <div class="col-xxl-3 col-sm-6">

        <div class="card card-animate">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="fw-medium text-muted mb-0">
                            Customers
                        </p>

                        <h2 class="mt-4 ff-secondary fw-semibold">
                            1,245
                        </h2>

                        <p class="mb-0 text-muted">

                            <span class="badge bg-info-subtle text-info mb-0">

                                <i class="ri-arrow-up-line align-middle"></i>
                                5.4 %

                            </span>

                            vs previous month

                        </p>

                    </div>

                    <div>

                        <div class="avatar-sm flex-shrink-0">

                            <span class="avatar-title bg-info-subtle rounded fs-3">

                                <i class="ri-user-3-line text-info"></i>

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- Products --}}
    <div class="col-xxl-3 col-sm-6">

        <div class="card card-animate">

            <div class="card-body">

                <div class="d-flex justify-content-between">

                    <div>

                        <p class="fw-medium text-muted mb-0">
                            Products
                        </p>

                        <h2 class="mt-4 ff-secondary fw-semibold">
                            320
                        </h2>

                        <p class="mb-0 text-muted">

                            <span class="badge bg-warning-subtle text-warning mb-0">

                                <i class="ri-arrow-up-line align-middle"></i>
                                3.1 %

                            </span>

                            vs previous month

                        </p>

                    </div>

                    <div>

                        <div class="avatar-sm flex-shrink-0">

                            <span class="avatar-title bg-warning-subtle rounded fs-3">

                                <i class="ri-store-2-line text-warning"></i>

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- Charts & Recent Orders --}}
<div class="row">

    {{-- Sales Overview --}}
    <div class="col-xl-8">

        <div class="card">

            <div class="card-header border-0 align-items-center d-flex">

                <h4 class="card-title mb-0 flex-grow-1">
                    Sales Overview
                </h4>

            </div>

            <div class="card-body">

                <div id="sales_chart"
                     style="height: 350px;">
                </div>

            </div>

        </div>

    </div>

    {{-- Top Categories --}}
    <div class="col-xl-4">

        <div class="card">

            <div class="card-header border-0">

                <h4 class="card-title mb-0">
                    Top Categories
                </h4>

            </div>

            <div class="card-body">

                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div>

                        <h6 class="mb-1">
                            Electronics
                        </h6>

                        <small class="text-muted">
                            450 Orders
                        </small>

                    </div>

                    <span class="badge bg-primary-subtle text-primary">
                        45%
                    </span>

                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div>

                        <h6 class="mb-1">
                            Fashion
                        </h6>

                        <small class="text-muted">
                            320 Orders
                        </small>

                    </div>

                    <span class="badge bg-success-subtle text-success">
                        30%
                    </span>

                </div>

                <div class="d-flex align-items-center justify-content-between mb-4">

                    <div>

                        <h6 class="mb-1">
                            Furniture
                        </h6>

                        <small class="text-muted">
                            180 Orders
                        </small>

                    </div>

                    <span class="badge bg-warning-subtle text-warning">
                        15%
                    </span>

                </div>

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <h6 class="mb-1">
                            Grocery
                        </h6>

                        <small class="text-muted">
                            120 Orders
                        </small>

                    </div>

                    <span class="badge bg-danger-subtle text-danger">
                        10%
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- Recent Orders --}}
<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-header border-0">

                <div class="d-flex align-items-center justify-content-between">

                    <h4 class="card-title mb-0">
                        Recent Orders
                    </h4>

                    <a href="#"
                       class="btn btn-soft-primary btn-sm">

                        View All

                    </a>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-centered align-middle table-nowrap mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>
                                    #ORD001
                                </td>

                                <td>
                                    Raj Patel
                                </td>

                                <td>
                                    iPhone 15 Pro
                                </td>

                                <td>
                                    ₹1,20,000
                                </td>

                                <td>

                                    <span class="badge bg-success-subtle text-success">
                                        Delivered
                                    </span>

                                </td>

                                <td>
                                    21 May 2026
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    #ORD002
                                </td>

                                <td>
                                    Amit Shah
                                </td>

                                <td>
                                    Nike Shoes
                                </td>

                                <td>
                                    ₹8,500
                                </td>

                                <td>

                                    <span class="badge bg-warning-subtle text-warning">
                                        Pending
                                    </span>

                                </td>

                                <td>
                                    20 May 2026
                                </td>

                            </tr>

                            <tr>

                                <td>
                                    #ORD003
                                </td>

                                <td>
                                    Priya Mehta
                                </td>

                                <td>
                                    Office Chair
                                </td>

                                <td>
                                    ₹15,000
                                </td>

                                <td>

                                    <span class="badge bg-info-subtle text-info">
                                        Processing
                                    </span>

                                </td>

                                <td>
                                    20 May 2026
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>

    var options = {

        series: [{
            name: 'Sales',
            data: [120, 210, 180, 280, 350, 400, 450]
        }],

        chart: {
            type: 'area',
            height: 350,
            toolbar: {
                show: false
            }
        },

        dataLabels: {
            enabled: false
        },

        stroke: {
            curve: 'smooth'
        },

        xaxis: {
            categories: [
                'Mon',
                'Tue',
                'Wed',
                'Thu',
                'Fri',
                'Sat',
                'Sun'
            ]
        }

    };

    var chart = new ApexCharts(
        document.querySelector("#sales_chart"),
        options
    );

    chart.render();

</script>

<x-admin.footer />