@extends('frontEnd.master')
@section('title')
    BeautyShop|Login
@endsection
@section('content')


    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="login-form-container">
                <div class="login-text">
                    <h3>Login</h3>
                    <p>Please Register using account detail bellow.</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <div class="controls">
                            <input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="controls">
                            @if (Route::has('password.request'))
                                <a class="btn btn-info" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="button-box">
                        <div class="login-toggle-btn">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>

                        </div>
                        <button type="submit" class="btn btn-common log-btn">
                            {{ __('Login') }}
                        </button>


                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection
