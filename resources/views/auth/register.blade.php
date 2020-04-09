@extends('frontEnd.master')
@section('title')
    BeautyShop|Register
@endsection
@section('content')
    <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="login">
            <div class="login-form-container">
                <div class="login-text">
                    <h3>Creat a new account</h3>
                    <p>Please Register using account detail bellow.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <div class="controls">
                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required placeholder="Username">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email Address">
                        @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="controls">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="button-box">
                        <button type="submit" class="btn btn-common log-btn">{{ __('Register') }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    </div>
    <div style="height: 200px;"></div>
@endsection