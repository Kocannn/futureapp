<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: #111;
            min-height: 100vh;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            background: linear-gradient(135deg, #1e3a8a 40%, #3b82f6 100%);
        }

        .login-container {
            background: #ffffff;
            width: 720px;
            max-width: 95vw;
            padding: 3rem 3.5rem;
            border-radius: 12px;
            box-sizing: border-box;
            border: 2px solid #1e3a8a;
            box-shadow: 0 10px 20px rgba(29, 78, 216, 0.3);
            user-select: none;
            text-align: center;
        }

        .login-logo {
            margin-bottom: 1rem;
        }

        .login-title {
            font-weight: 700;
            font-size: 2.25rem;
            margin-bottom: 2rem;
            color: #1e3a8a;
        }

        form.login-form {
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
            text-align: left;
        }

        label {
            font-weight: 700;
            font-size: 1rem;
            margin-bottom: 0.35rem;
            color: #1e3a8a;
            user-select: none;
        }

        .input-field {
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
            border: 2px solid #2c3e50;
            border-radius: 8px;
            outline-offset: 3px;
            transition: border-color 0.25s ease;
            color: #111;
        }

        .input-field::placeholder {
            color: #7f8c8d;
            font-style: italic;
        }

        .input-field:focus {
            border-color: #1e40af;
            outline: none;
            box-shadow: 0 0 6px #1e40af88;
        }

        .input-error {
            color: #b91c1c;
            font-size: 0.9rem;
            margin-top: 0.3rem;
            font-weight: 700;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            color: #1e3a8a;
            user-select: none;
        }

        .remember-me input[type="checkbox"] {
            width: 1.3rem;
            height: 1.3rem;
            cursor: pointer;
            accent-color: #1e40af;
            border-radius: 5px;
            border: 2px solid #2c3e50;
            transition: border-color 0.3s ease;
        }

        .remember-me input[type="checkbox"]:hover {
            border-color: #1e40af;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
        }

        .forgot-password {
            font-size: 1rem;
            color: #1e40af;
            text-decoration: none;
            font-weight: 700;
            user-select: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #113270;
        }

        .btn-primary {
            background-color: #1e40af;
            color: white;
            font-weight: 800;
            padding: 0.5rem 1.5rem;
            font-size: 0.95rem;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            user-select: none;
            box-shadow: 0 3px 7px rgba(30, 64, 175, 0.5);
        }

        .btn-primary:hover {
            background-color: #14306e;
            box-shadow: 0 5px 10px rgba(20, 48, 110, 0.7);
        }

        @media (max-width: 760px) {
            .login-container {
                width: 100%;
                padding: 2.5rem 1.5rem;
            }

            .login-title {
                font-size: 1.8rem;
            }
        }
    </style>

    <div class="login-page">
        <div class="login-container">
            <!-- LOGO -->
            <div class="login-logo">
                <img src="{{ asset('images/FUTURE.APT__1.png') }}" alt="Future Apt Logo" class="w-28 h-auto mx-auto">
            </div>

            <!-- <h2 class="login-title">{{ __('FUTUREAPT') }}</h2> -->

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username"
                        class="input-field"
                        placeholder="your.email@example.com"
                    />
                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="input-field"
                        placeholder="••••••••"
                    />
                    <x-input-error :messages="$errors->get('password')" class="input-error" />
                </div>

                <div class="remember-me">
                    <input id="remember_me" type="checkbox" name="remember" />
                    <label for="remember_me">{{ __('Remember me') }}</label>
                </div>

                <div class="form-footer">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-password">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button type="submit" class="btn-primary">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
