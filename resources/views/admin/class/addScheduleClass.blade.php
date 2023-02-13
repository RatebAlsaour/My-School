@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
    <div class="card">
        <div class="row justify-content-center">
            <div class="card-header">{{ __('Add schedule to Class') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('add-schedule-class') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="container col-md-6">
                        <div class="mb-5">
                            <label for="file" class="form-label">choos Schedule</label>
                            <input class="form-control" name="schedule" type="file" id="file"
                                accept=".png, .jpg, .jpeg" onchange="preview()">
                            <div class="col-md-6 pt-3">
                                <button type="submit" name="id" value="{{ $data->id }}" class="btn btn-primary"
                                    onclick="clearImage()">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
