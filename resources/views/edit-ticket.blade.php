@extends('layout')

@section('dashboard')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <form action="{{ route('ticket.update',$ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center mb-4">CREATE TICKET</h2>
                    <div class="form-group m-4">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title"
                            value="{{ $ticket->title }}" name="title">
                        <span class="text-danger">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="form-group m-4">
                        <label for="message">Message<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="message" rows="3" value="{{ $ticket->message }}" name="message">{{ $ticket->message }}</textarea>
                        <span class="text-danger">
                            @error('message')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>



                    <div class="form-group m-4">
                        <label> Label<span class="text-danger">*</span></label>
                        <div class="row">
                            @php
                                $ticketlabels = json_decode($ticket->labels);
                            @endphp
                            @foreach ($label as $label)
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="label_checkbox[]"
                                            id="{{ $label->label_name }}" value="{{ $label->label_name }}"
                                            {{ in_array($label->label_name, $ticketlabels) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="checkbox1">
                                            {{ $label->label_name }}</label>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <span class="text-danger">
                            @error('label_checkbox')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>


                    <div class="form-group m-4">
                        <label> Categories<span class="text-danger">*</span></label>

                        <div class="row">
                            @php
                                $categoryTicket = json_decode($ticket->categoryies);
                            @endphp
                            @foreach ($category as $category)
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="category_checkbox[]"
                                            id="{{ $category->category_name }}" value="{{ $category->category_name }}"
                                            {{ in_array($category->category_name, $categoryTicket) ? 'checked' : '' }}>


                                        <label class="form-check-label"
                                            for="checkbox4">{{ $category->category_name }}</label>
                                    </div>


                                </div>
                            @endforeach


                        </div>
                        <span class="text-danger">
                            @error('category_checkbox')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>



                    <div class="form-group m-4">
                        <label for="exampleFormControlSelect1">Priority<span class="text-danger">*</span></label>
                        <select class="form-control" id="exampleFormControlSelect1" name="priority">

                            @foreach ($priority as $priority)
                                <option value="{{ $priority->priority }}"
                                    {{ $ticket->priority == $priority->priority ? 'selected' : $priority->priority }}>
                                    {{ $priority->priority }}</option>
                            @endforeach

                        </select>
                        <span class="text-danger">
                            @error('priority')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    {{-- <div class="form-group m-4">
                        <label for="file">Upload Image<span class="text-danger">*</span></label>
                        <input type="file"  class="filepond form-control-file" id="image" name="image"
                            placeholder="Choose image" >
                        <span class="text-danger">
                            @error('image')
                                <br>{{ $message }}
                            @enderror
                        </span>

                        <img src="{{asset($ticket->image_path) }}" alt="not found">

                    </div> --}}

                    <div class="form-group m-4">
                        <label for="images">Upload Image<span class="text-danger">*</span></label>
                        <input type="file" class="filepond form-control-file" id="image" name="image[]" multiple
                            placeholder="Choose images">
                        <span class="text-danger">
                            @error('image')
                                <br>{{ $message }}
                            @enderror
                        </span>

                        {{-- @if ($ticket->image_path)
                            <div class="mt-2">
                                @foreach (json_decode($ticket->image_path) as $imagePath)
                                    <div class="image-container" data-image="{{ $imagePath }}">
                                        <img src="{{ asset($imagePath) }}" alt="Ticket Image" width="100">
                                        <span class="remove-image">&times;</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif --}}
                    </div>


                    <div class="text-center m-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary ml-2">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        var files = [];

        @forelse(json_decode($ticket->image_path) as $image)
            files.push({
                source: '{{ asset($image) }}',
            });
        @empty
        @endforelse

        const inputElement = document.getElementById('image');
        FilePond.create(inputElement, {
            files: files,
            styleButtonRemoveItemPosition: 'right',
            imageCropAspectRatio: '1:1',
            acceptedFileTypes: ['image/png', 'image/jpeg', 'image/jpg'],
            maxFileSize: '500000KB',
            ignoredFiles: ['.ds_store', 'thumbs.db', 'desktop.ini'],
            storeAsFile: true,
            chunkUploads: true,
            chunkSize: '200KB',
            allowMultiple: true,
            chunkForce: true,
            server: {
                timeout: 7000,

                revert: '/files/revertFile',
                patch: '/files/uploadfileChunk?patch=',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            credits: {
                label: '',
                url: ''
            }
        });
         // Add event listener for the onaddfile event
        //  pond.on('addfile', (error, file) => {
        //     // Clear previous previews
        //     document.getElementById('image').innerHTML = '';

        //     // Iterate over all files and display previews
        //     pond.getFiles().forEach((file) => {
        //         const imagePreview = document.createElement('img');
        //         imagePreview.src = URL.createObjectURL(file.file);
        //         imagePreview.style.maxWidth = '200px';
        //         imagePreview.style.maxHeight = '100px';
        //         imagePreview.style.marginLeft = '40%';

        //         document.getElementById('image').appendChild(imagePreview);
        //     });
        // });
    </script>
@endsection
