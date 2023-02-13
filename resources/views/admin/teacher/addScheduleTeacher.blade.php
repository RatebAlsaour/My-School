@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">{{ __('Teacher') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('add-schedule-teacher') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="container col-md-6">
                            <div class="mb-5">
                                <label for="file" class="form-label">choos Schedule</label>
                                <input class="form-control" name="schedule" type="file" id="file"
                                    accept=".png, .jpg, .jpeg" onchange="preview()">
                                <button type="submit" name="id" value="{{ $data->id }}" class="btn btn-primary"
                                    onclick="clearImage()">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }

        function clearImage() {
            document.getElementById('formFile').value = null;
            frame.src = "";
        }
    </script>
@endsection
