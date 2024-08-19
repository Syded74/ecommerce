@extends('layouts.auth')

@section('content')
<div>
    <div>
        <div>
            <div>{{ __('Reset Password') }}</div>

            <div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div>
                        <label for="email">{{ __('Email Address') }}</label>

                        <div>
                            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                            @error('email')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password">{{ __('Password') }}</label>

                        <div>
                            <input id="password" type="password" name="password" required>
                            @error('password')
                                <span role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>

                        <div>
                            <input id="password-confirm" type="password" name="password_confirmation" required>
                        </div>
                    </div>

                    <div>
                        <div>
                            <button type="submit">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
