@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="row justify-content-center">
            <div class="card-header">{{ __('Affiliation Request') }}</div>
            <div class="card-body">
                <div class="row justify-content-center">
                    @foreach ($data as $req)
                        <div class="col-md-7 pt-3">
                            <div class="card pl-4">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $req->created_at }}</h4>
                                    <div class="row">
                                        <div class="col-md-4">Name:
                                            <h2>{{ $req->name }}</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">Target level:<h4> {{ $req->target_level }}</h4>
                                        </div>
                                        <div class="col-md-3">Last degree:<h4> {{ $req->last_level_degree }}</h4>
                                        </div>
                                        <div class="col-md-2">Last level:<h4> {{ $req->last_level }}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">Phone: <h4>{{ $req->phone }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
