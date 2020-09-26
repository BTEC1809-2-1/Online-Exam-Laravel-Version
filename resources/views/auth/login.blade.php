@extends('layouts.app')

@section('content')
<BR>
<BR>
<BR>
<BR>
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #385898 ; color: white; font-weight: bold; text-align:center;">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right" style="color: black">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right" style="color: black">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="LoginBtn col-md-2 offset-md-4">
                                <button type="submit" class="btn LoginBtn" style="background-color: white ; color: #385898; border : 1px solid #385898;">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="login-gg col-md">
                                <a href=" {{ url('auth/google') }}" class="btn btn-primary" style="background-color: white; color: black; padding-left:20px; padding-right:20px;margin-left:17px;">
                                <img src="https://accounts.google.com/favicon.ico" alt="" width="24" height="24">Sign in with Google</a>
                            </div>
                        </div>                                                                                                                                                          
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
