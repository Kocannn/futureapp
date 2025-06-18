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

        .register-page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            background: linear-gradient(135deg, #1e3a8a 40%, #3b82f6 100%);
        }

        .register-container {
            background: #ffffff;
            width: 720px;
            max-width: 95vw;
            padding: 3rem 3.5rem;
            border-radius: 12px;
            box-sizing: border-box;
            border: 2px solid #1e3a8a;
            box-shadow: 0 10px 20px rgba(29, 78, 216, 0.3);
            user-select: none;
        }

        .register-title {
            font-weight: 700;
            font-size: 2.25rem;
            margin-bottom: 2.5rem;
            color: #1e3a8a;
            text-align: center;
        }

        form.register-form {
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
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

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
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

        .login-link {
            font-size: 1rem;
            color: #1e40af;
            text-decoration: none;
            font-weight: 700;
            user-select: none;
            transition: color 0.3s ease;
        }

        .login-link:hover {
            color: #113270;
        }

        @media (max-width: 760px) {
            .register-container {
                width: 100%;
                padding: 2.5rem 1.5rem;
            }

            .register-title {
                font-size: 1.8rem;
            }
        }
    </style>

    <div class="register-page">
        <div class="register-container"><div class="login-container">
            <!-- LOGO -->
            <div class="register-logo">
                <img src="{{ asset('images/FUTURE.APT__1.png') }}" alt="Future Apt Logo" class="w-28 h-auto mx-auto">
            </div>
            <!-- <h2 class="register-title">{{ __('Register to FUTUREAPT') }}</h2> -->

            <form method="POST" action="{{ route('register') }}" class="register-form">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input
                        id="name"
                        class="input-field w-full"
                        type="text"
                        name="name"
                        :value="old('name')"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Your full name"
                    />
                    <x-input-error :messages="$errors->get('name')" class="input-error" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input
                        id="email"
                        class="input-field w-full"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                        placeholder="your.email@example.com"
                    />
                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input
                        id="password"
                        class="input-field w-full"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <x-input-error :messages="$errors->get('password')" class="input-error" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input
                        id="password_confirmation"
                        class="input-field w-full"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="input-error" />
                </div>

                <!-- Footer -->
                <div class="form-footer">
                    <a class="login-link" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
