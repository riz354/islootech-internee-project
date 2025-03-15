@extends('layout')




@section('dashboard')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="col-10">
        @if ($message = Session::get('success'))
            <script>
                Swal.fire({
                    title: "Ticket Upadted Successfully!",

                    icon: "success"
                });
            </script>
        @endif
    </div>







    <div class="item wow fadeInUpBig animated w-100 text-center my-5 animated" data-number="12" style="visibility: visible;">
        <i class="fa fa-briefcase fa-3x"></i>
        <h2 id="number1" class="number">{{$count}}</h2>
        <span></span>
        <p>Total Tickets</p>
    </div>

    <a href="{{ route('ticket.generate') }}" class="btn btn-primary m-5">
        Generate Ticket</a><br><br>



    <table class="table col-11 m-auto table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Message</th>
                <th scope="col">Labels</th>
                <th scope="col">Categories</th>
                <th scope="col">Priority</th>
                <th scope="col">Image_Path</th>
                <th scope="col">Status</th>
                <th scope="">View</th>
                <th scope="">Update</th>
                <th scope="">Delete</th>
                <th scope="">Assign TO Aggent</th>



            </tr>
        </thead>
        <tbody>

            @foreach ($tickets as $ticket)
                <tr>
                    <td class="w-10">{{ $ticket->title }}</td>
                    <td class="w-10">{{ $ticket->message }}</td>

                    <td class="w-10">
                        @php
                            $labels = json_decode($ticket->labels);
                        @endphp
                        @foreach ($labels as $label)
                            {{ $label }},
                        @endforeach
                    </td>
                    <td class="w-10">
                        @php
                            $categoryies = json_decode($ticket->categoryies);
                        @endphp
                        @foreach ($categoryies as $category)
                            {{ $category }},
                        @endforeach
                    </td>
                    <td class="w-10">{{ $ticket->priority }}</td>

                    <td class="w-10">
                        @if ($ticket->image_path)
                            @foreach (json_decode($ticket->image_path ?? '[]') as $imagePath)
                                {{ $imagePath }},
                            @endforeach
                        @endif
                    </td>

                    <td class="w-10">
                        @if ($ticket->agents->isNotEmpty())
                            <p>Assigned</p>
                        @else
                            <p>UnAssigned</p>
                        @endif
                    </td>

                    <td class="w-10 "><a href="{{ route('ticket.detail', $ticket->id) }}" class="btn btn-primary">View</a>
                    </td>
                    <td class="w-10 "><a href="{{ route('ticket.edit', $ticket->id) }}" class="btn btn-success">Update</a>
                    </td>
                    <td class="w-10 "><a href="#" class="btn btn-warning"
                            onclick="ticketDelete('{{ $ticket->id }}')">Delete</a></td>
                    <td class="w-10 "><a href="{{ route('ticket.agent', $ticket->id) }}" class="btn btn-danger">Assign</a>
                    </td>



                </tr>
            @endforeach


        </tbody>
    </table>

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "Assigned!",
                text: "Ticket Assigned Successfully!",
                icon: "success"
            });
        </script>
    @endif
    <script>
        function ticketDelete(id) {
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
                        url: "{{ route('ticket.destroy', ['id' => 'id']) }}".replace('id', id),
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





        $.fn.jQuerySimpleCounter = function( options ) {
	    var settings = $.extend({
	        start:  0,
	        end:    100,
	        easing: 'swing',
	        duration: 400,
	        complete: ''
	    }, options );

	    var thisElement = $(this);

	    $({count: settings.start}).animate({count: settings.end}, {
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
$('#number1').jQuerySimpleCounter({end: count ,duration: 3000});
    </script>
@endsection
