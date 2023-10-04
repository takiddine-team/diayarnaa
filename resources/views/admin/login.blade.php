@extends('layouts.app')
@section('content')
    {{-- =========================================================== --}}
    {{-- ================== Sweet Alert Section ==================== --}}
    {{-- =========================================================== --}}
    <div>
        @if (session()->has('success'))
            <script>
                swal("Great Job !!!", "{!! Session::get('success') !!}", "success", {
                    button: "OK",
                });
            </script>
        @endif
        @if (session()->has('danger'))
            <script>
                swal("oops !!!", "{!! Session::get('danger') !!}", "error", {
                    button: "Close",
                });
            </script>
        @endif
    </div>

    <div class="innerPage">
        {{-- =========================================================== --}}
        {{-- =================== Breadcrumb Section ==================== --}}
        {{-- =========================================================== --}}
        <section class="innerImage ">
            <img src="{{ asset('style_files/frontend/img/inners/mainInner.png') }}" alt="">
            <div class="pageTitle">
                <h2>Login</h2>
                <span>Home <span> > </span> Login</span>
            </div>
        </section>


        {{-- =========================================================== --}}
        {{-- =================== contact Section =============== --}}
        {{-- =========================================================== --}}
        <section class="regester login">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <form action="#" class="regesterForm">
                            @csrf
                            <div class="formHeaader text-center text-white">
                                <span>Login</span>
                            </div>
                            <div class="row formBody">
                                <div class="col-12 mb-5 text-center">
                                    <img src="{{ asset('style_files/frontend/img/all/login.png') }}" class="img-fluid"
                                        alt="img">
                                </div>
                                <div class="col-12 mb-4 text-center">
                                    <input type="text" placeholder="User name" name="userName" class="form-control"
                                        id="userName">
                                </div>
                                <div class="col-12 mb-4">
                                    <input type="password" placeholder="Password" name="password" class="form-control"
                                        id="password">
                                </div>
                                <div class="col-12 mb-4 d-flex justify-content-between">
                                    <div class="radio-item">
                                        <input id="radio-1" name="demo" type="radio">
                                        <label for="radio-1" class="small">Remember Me</label>
                                    </div>
                                    <a href="#" class="small forgetPassword link">I forgot my password </a>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="submit" class="btn mainBtn mb-4 w-100" value="Login">
                                    <a href="{{ route('signup') }}" class="btn mainBtn signUp w-100">Signup</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
