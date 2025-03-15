@extends('layout')


@section('dashboard')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="item wow fadeInUpBig animated w-100 text-center my-5 animated" data-number="12" style="visibility: visible;">
        <i class="fa fa-solid fa-user fa-3x"></i>
        <h2 id="number1" class="number">{{ $count }}</h2>
        <span></span>
        <p>Total Users</p>
    </div>
    <table class="table col-11 m-auto table-striped table-bordered" id="usersTable">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone No</th>
                <th scope="col">Role</th>
                <th scope="col">View</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($users as $user)
                <tr id="{{ $user->id }}">
                    <td class="w-10">{{ $user->name }}</td>
                    <td class="w-10">{{ $user->email }}</td>
                    <td class="w-10">{{ $user->phone_number }}</td>
                    @foreach ($user->roles as $role)
                        <td class="w-10">{{ $role->role_name }}</td>
                    @endforeach
                    <td class="w-10 "><a href="{{ route('user.show', $user->id) }}" class="btn btn-primary">View</a></td>
                    <td class="w-10 "><a href="{{ route('user.edit', $user->id) }}" class="btn btn-success">Edit</a></td>
                    <td class="w-10 "><a href="#" onclick="UserDelete('{{ $user->id }}')"
                            class="btn btn-warning">Delete</a></td>
                </tr>
            @endforeach


        </tbody>
    </table>
    <script>
        function UserDelete(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // console.log(result);
                    // alert(result.isConfirmed)
                    $.ajax({
                        url: "{{ route('user.destroy', ['id' => 'id']) }}".replace('id', id),
                        type: "post",
                        dataType: 'json',
                        data: {
                            '_token': "{{ csrf_token() }}", // Include CSRF token here
                            "id": id
                        },
                        success: function(response) {

                            if (response.success) {

                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });
                                setInterval(function() {
                                    window.location.reload();
                                }, 1000);

                                // $('#usersTable').DataTable().ajax.reload();

                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Your file has been deleted.",
                                    icon: "error"
                                });
                            }
                        }
                    });
                }
            });
        }

        $.fn.jQuerySimpleCounter = function(options) {
            var settings = $.extend({
                start: 0,
                end: 100,
                easing: 'swing',
                duration: 400,
                complete: ''
            }, options);

            var thisElement = $(this);

            $({
                count: settings.start
            }).animate({
                count: settings.end
            }, {
                duration: settings.duration,
                easing: settings.easing,
                step: function() {
                    var mathCount = Math.ceil(this.count);
                    thisElement.text(mathCount);
                },
                complete: settings.complete
            });
        };

        var count = <?php echo $count; ?>;
        $('#number1').jQuerySimpleCounter({
            end: count,
            duration: 3000
        });
    </script>
@endsection
