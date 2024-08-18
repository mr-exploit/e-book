@extends('auth.app')

@section('title', 'Login - EBOOK')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-7 ">
            <div class="card card-whitebgcsm border-0 shadow-lg  my-5">
                <div class="card-body p-0 ">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="">
                                    <h2 class="text-center mb-5">Welcome to E-BOOK</h2>
                                    @include('layouts.message')
                                    <form action="" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="email" class="form-control" id="email" placeholder="Email" name='email'>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" id="password" placeholder="Password" name='password'>
                                        </div>
                                        <button type="submit" class="btn btn-grays w-100">Sign in</button>
                                        <div class="d-flex justify-content-center mt-3">
                                            <a class="me-3 text-link navit" href="{{ url('reset-password') }}">Forgot Password?</a>
                                            <a class="me-3 text-link navit" href="{{ url('register') }}">Create account</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection