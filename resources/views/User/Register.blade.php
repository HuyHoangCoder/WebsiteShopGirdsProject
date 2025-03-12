@extends('layout')
@section('title')
    Đăng Ký
@endsection
@section('body')
    <!-- Start Account Register Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>No Account? Register</h3>
                            <p>Registration takes less than a minute but gives you full control over your orders.</p>
                        </div>
                        <form action="" class="row" method="post">
                            @csrf       {{--  để bảo mật  --}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-fn">Name</label>
                                    <input class="form-control" name="name" type="text" id="reg-fn" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-email">E-mail Address</label>
                                    <input class="form-control" name="email" type="email" id="reg-email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass">Password</label>
                                    <input class="form-control" name="password" type="password" id="reg-pass" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass-confirm">Confirm Password</label>
                                    <input class="form-control" name="repassword" type="password" id="reg-pass-confirm" required>
                                </div>
                            </div>

                            @if (Session::has('messenger'))   {{-- Nếu trong session có messenger, in ra h2 --}}
                                <div class="alert alert-danger">{{Session::get('messenger')}}</div> 
                                {{-- vào session lấy messenger để đổ ra --}}
                                @php
                                    Session::forget('messenger'); // và sau đó quên cái thông báo đi bằng forget
                                @endphp
                            @endif

                            <div class="button">
                                <button class="btn" type="submit">Register</button>
                            </div>
                            

                            <p class="outer-link">Already have an account? <a href="login.html">Login Now</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Register Area -->
@endsection