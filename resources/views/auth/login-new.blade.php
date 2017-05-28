@extends('layouts.auth', ['user' => 'reza'])

@section('body_class', 'login_us')

@section('styles')
    <style type="text/css">
        body{
            background-color: red!important;
        }
    </style>

@endsection

@section('content')
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="post">
                    {{-- method_field('patch') --}}
                    {{ csrf_field() }}
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="">
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Log in</a>
                        <a class="reset_pass" href="#">Lost your password?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br>

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="">
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="">
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="">
                    </div>
                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br>

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
@endsection

@push('before_body_end')
<!-- login dfhjdfkgjdfkgj -->
@endpush