@extends('layout')

@section('dashboard')
    <h1 class="text-cenetr text-success ml-50">Ticket Details</h1>

    <table class="table col-10 m-auto">

        <tbody>
            <tr>
                <th scope="row">Id</th>
                <td>{{ $data->id }}</td>

            </tr>

            <tr>
                <th scope="row">Title</th>
                <td>{{ $data->title }}</td>


            </tr>

            <tr>
                <th scope="row">Message</th>
                <td>{{ $data->message }}</td>


            </tr>

            <tr>
                <th scope="row">Labels</th>
                @php
                    $labels = json_decode($data->labels);
                @endphp
                <td>
                    @foreach ($labels as $labels)
                        {{ $labels }},
                    @endforeach
                </td>


            </tr>

            <tr>
                <th scope="row">Categoryies</th>
                @php
                    $category = json_decode($data->categoryies);
                @endphp
                <td>
                    @foreach ($category as $category)
                        {{ $category }},
                    @endforeach
                </td>


            </tr>

            <tr>
                <th scope="row">Priority</th>
                <td>{{ $data->priority }}</td>


            </tr>

            <tr>
                <th scope="row">Image_Path</th>
                <td>{{ $data->image_path }}</td>


            </tr>

        </tbody>

    </table>
    <div class="col-10 m-auto">

        @if ($data->image_path)

            @foreach (json_decode($data->image_path ?? '[]') as $imagePath)
            <div class="col-8 m-4">
                <h6>{{$imagePath}}</h6>
                <img src="{{ asset($imagePath) }}" class="w-25 h-25" alt="Ticket Image">

            </div>
            @endforeach
        @endif
    </div>

    <a href="{{ route('ticket.view') }}" class="btn btn-primary btn-lg">Back</a>
@endsection
