@extends('layout')

@section('dashboard')
    <form action="{{ route('user.update', $user->id) }}" method="post" id="edit_user" class="col-6 m-auto"
        onsubmit=" return swal(this)">
        @csrf
        <h4 class="text-center text-primary mb-5">Update User</h4>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label " for="user_name">Full Name <span class="text-danger">*</span></label>
            <input type="text" id="user_name" class="form-control @error('user_name') is-invalid @enderror"
                placeholder="Enter your full_name" name="user_name" value="{{ old('user_name', $user->name) }}" />
            <span class="text-danger">
                @error('user_name')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
            <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter your email address" name="email" value="{{ $user->email }}" />
            <span class="text-danger">
                @error('email')
                    {{ $message }}
                @enderror
            </span>

        </div>




        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="phone_no">Phone No<span class="text-danger">*</span></label>
            <input type="tel" id="phone_no" class="form-control @error('phone_no') is-invalid @enderror"
                name="phone_no" value="{{ $user->phone_number }}" />
            <span class="text-danger">
                @error('phone_no')
                    {{ $message }}
                @enderror
            </span>

        </div>


        {{-- <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="phone_no">Role<span class="text-danger">*</span></label>

            @foreach ($user->roles as $role)
            <input type="tel" id="role" class="form-control @error('role') is-invalid @enderror"
            name="role" value="{{$role->role_name}}" />
            @endforeach





            <span class="text-danger">
                @error('phone_no')
                    {{ $message }}
                @enderror
            </span>

        </div> --}}




        <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="role">Role<span class="text-danger">*</span></label>
            <select class="form-control" id="role" name="role">



                @foreach ($role as $role)

                    <option value="{{ $role->id }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}
                        {{ $role->role_name === 'Admin' ? 'disabled' : '' }}>{{ $role->role_name }}</option>
                    
                @endforeach


                {{-- @foreach ($user->roles as $role)
                <option value="{{ $role->role_name }}">{{ $role->role_name }}</option>
            @endforeach --}}


            </select>
            <span class="text-danger">
                @error('priority')
                    {{ $message }}
                @enderror
            </span>
        </div>








        <div class="text-center pt-1 mb-5 pb-1 col-12">
            <button class="btn btn-dark btn-lg " type="submit"> Update</button>
        </div>



    </form>

    <script>
        // $('#edit_user').submit(function() {
        //     Swal.fire({
        //         title: "Do you want to save the changes?",
        //         showDenyButton: true,
        //         showCancelButton: true,
        //         confirmButtonText: "Save",
        //         denyButtonText: `Don't save`
        //     }).then((result) => {
        //         /* Read more about isConfirmed, isDenied below */
        //         if (result.isConfirmed) {
        //             Swal.fire("Saved!", "", "success");
        //         } else if (result.isDenied) {
        //             Swal.fire("Changes are not saved", "", "info");
        //         }
        //     });
        // })
    </script>
@endsection()
