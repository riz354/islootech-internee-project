@extends('layout')


@section('dashboard')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
            <form action="{{route('ticket.assigned',$id)}}" method="post" >
                @csrf
                <h2 class="text-center mb-4">Assign Ticket</h2>

                <div class="form-group m-4">
                    <label for="exampleFormControlSelect1">Select Agent<span class="text-danger">*</span></label>
                    <select class="form-control" id="agent" name="agent[]" multiple required>

                        @foreach ($agent as $agent)
                            <option value="{{ $agent->id }}" >{{ $agent->name }}</option>
                        @endforeach


                    </select>
                    <span class="text-danger">
                        @error('agent')
                            {{ $message }}
                        @enderror
                    </span>
                </div>


                <div class="text-center m-4">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>
            </form>
        </div>
    </div>
</div>


@endsection
