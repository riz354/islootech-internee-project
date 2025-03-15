@extends('auth_layout')




@section('createUserMessage')

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "Welcome!",
                text: "New User Created Successfully!",
                icon: "success"
            });
        </script>
    @endif
@endsection()




@section('Form')
    {{-- <form action="{{ route('user.authenticate') }}" method="POST"> --}}
    <form action="{{route('user.authenticate')}}" method="POST">


        @csrf
        <h4 class="text-center text-primary mb-5">Please login to your account</h4>


        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter your email address" />

        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror" />
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
        </div>


        <div class="text-center pt-1 mb-5 pb-1">
            <button class="btn btn-dark btn-lg " type="submit">Log in now</button>

            <a class="text-muted" href="#!">Forgot password?</a>
        </div>

        <div class="d-flex align-items-center justify-content-center pb-4">
            <p class="mb-0 me-2">Don't have an account?</p>
            <a class="btn btn-outline-primary" href="{{ route('user.register') }}">Create Account</a>

        </div>

    </form>
@endsection
