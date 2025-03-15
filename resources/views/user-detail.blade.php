@extends('layout')

@section('dashboard')
<h1 class="text-cenetr text-success ml-50">User Details</h1>

    <table class="table col-10 m-auto">

        <tbody>
            <tr>
                <th scope="row">Id</th>
                <td>{{$user->id}}</td>

            </tr>

            <tr>
                <th scope="row">Name</th>
                <td>{{$user-> name}}</td>


            </tr>

            <tr>
                <th scope="row">Email</th>
                <td>{{$user->email}}</td>


            </tr>

            <tr>
                <th scope="row">Phone No</th>

                <td>{{$user->phone_number}}</td>


            </tr>




        </tbody>
    </table>
   <a href="{{route('user.view')}}" class="btn btn-primary btn-lg">Back</a>
@endsection
