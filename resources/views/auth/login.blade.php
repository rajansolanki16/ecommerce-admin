<x-header :meta="array('title'=> 'Login', 'description'=> getSetting('page_home_meta_description'))" />

<main>
    <section class="ko-loginRegister-section">
        <div class="ko-container">
            <div class="ko-loginRegister-wrap">
                <h1 class="ko-loginRegister-title">  {{ __('common.login_heading') }}</h1>
                <div class="ko-loginRegister-from">

                    @if (session()->has('message'))
                    <div class="alert {{ session()->get('status') == 'success' ? 'alert-success' : 'alert-danger' }}" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                    <form action="{{ route('auth.login') }}" method="POST">
                        @csrf

                        <div class="ko-loginRegister-grp">
                            <label for="email">    {{ __('common.username_or_email') }}<sup>{{ __('common.required_mark') }}</sup></label>
                            <input type="email" class="ko-loginRegister-control @error('email') invalid-input @enderror"
                                name="email" id="email" value="{{ old('email') }}" required />
                            @error('email')
                                <div class="invalid-response" style="display:flex">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="ko-loginRegister-grp">
                          <label for="password"> {{ __('common.password') }} <sup>{{ __('common.required_mark') }}</sup></label>
                            <input type="password"
                                class="ko-loginRegister-control @error('password') invalid-input @enderror"
                                name="password" required id="ko_loginRegister_input" />
                            <button type="button" class="ko-loginRegister-pass" id="pass_hideShow">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            @error('password')
                                <div class="invalid-response" style="display:flex" >{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <input type="checkbox" name="remember" id="ko_remember_me" />
                           <label for="ko_remember_me">{{ __('common.remember_me') }}</label>
                        </div>
                      <button type="submit" class="ko-btn">{{ __('common.login_button') }}</button>
                        {{-- <a href="{{ route('view.forget_password') }}" class="ko-forgot-pass">Lost your password?</a>
                        <a href="{{ route('view.signup') }}" class="ko-forgot-pass">Don't have account? create here</a> --}}
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<x-footer />
