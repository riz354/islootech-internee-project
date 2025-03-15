@extends('auth_layout')


@section('title')
registerUser
@endsection

@section('Form')
    <form action="{{ route('user.registered') }}" method="post" id="registration_form">
        @csrf
        <h4 class="text-center text-primary mb-5">Create Your Acccount Here</h4>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label " for="user_name">Full Name <span class="text-danger">*</span></label>
            <input type="text" id="user_name" class="form-control @error('user_name') is-invalid @enderror"
                placeholder="Enter your full_name" name="user_name" />
            <span class="text-danger">
                @error('user_name')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter your email address" name="email" />
            <span class="text-danger">
                @error('email')
                    {{ $message }}
                @enderror
            </span>

        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password">Password<span class="text-danger ">*</span></label>
            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                name="password" />
            <span class="text-danger">
                @error('password')
                    {{ $message }}
                @enderror
            </span>

        </div>


        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="phone_no">Phone No<span class="text-danger">*</span></label>
            <input type="tel" id="phone_no" class="form-control @error('phone_no') is-invalid @enderror"
                name="phone_no" />
            <span class="text-danger">
                @error('phone_no')
                    {{ $message }}
                @enderror
            </span>

        </div>

        <div class="text-center pt-1 mb-5 pb-1 col-12">
            <button class="btn btn-dark btn-lg " type="submit">Register User</button>
        </div>

        <div class="d-flex align-items-center justify-content-center pb-4">
            <p class="mb-0 me-2">Already! have an account?</p>
            <a class="btn btn-outline-primary" href="{{route('login')}}">Login</a>

        </div>

    </form>
@endsection






