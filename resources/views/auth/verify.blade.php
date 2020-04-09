@extends('layouts.app')
@section('title')
    BeautyShop|Verify Email
@endsection
@section('content')
<div class="container" style="margin: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
