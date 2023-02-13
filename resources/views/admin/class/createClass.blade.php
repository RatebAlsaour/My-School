@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Class') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('create-class') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="level"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Level') }}</label>
                                <div class="col-md-6">
                                    <input id="level" type="text"
                                        class="form-control @error('level') is-invalid @enderror" name="level"
                                        value="{{ old('level') }}" required autocomplete="name" autofocus>
                                    @error('level')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="room_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Room name') }}</label>
                                <div class="col-md-6">
                                    <input id="room_name" type="text"
                                        class="form-control @error('room_name') is-invalid @enderror" name="room_name"
                                        value="{{ old('room_name') }}" required autocomplete="name" autofocus>
                                    @error('room_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="date"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Year') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="text"
                                        class="form-control @error('date') is-invalid @enderror" name="date"
                                        value="{{ old('date') }}" required autocomplete="name" autofocus>
                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="master_id"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Master id') }}</label>
                                <div class="col-md-6">
                                    <input id="master_id" type="text"
                                        class="form-control @error('master_id') is-invalid @enderror" name="master_id"
                                        value="{{ old('master_id') }}" required autocomplete="name" autofocus>
                                    @error('master_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="image"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Schedule') }}</label>
                                <div class="col-md-6">
                                    <input id="image" type="date"
                                        class="form-control @error('image') is-invalid @enderror" name="image"
                                        value="{{ old('image') }}" autocomplete="image" autofocus>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Craete') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
