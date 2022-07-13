@extends('default.layouts.app-2')

@section('content')
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="assets/images/logo.svg">
                        </div>
                        <h4>Do you forgot your password</h4>
                        <h6 class="font-weight-light">Enter your email to get link reset password</h6>
                        @if($errors->any())
                            <h6 class="text-danger">{{$errors->first()}}</h6>
                        @endif
                        @if(Session::has('success'))
                            <h5 class="text-success">{{Session::get('success')}}</h5>
                        @endif
                        <form class="pt-3" method="POST" action="{{route('forgot-password')}}">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-lg" value="{{old('email')}}" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Send Link</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <a href="{{route('login')}}" class="auth-link text-black">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
@endsection
