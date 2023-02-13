@extends('layouts.app')

@section('content')
    {{-- <div class="container"> --}}
    <div class="card ">
        <div class="row justify-content-center">
            <div class="card-header">{{ __('Add teacher to Class') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('add-teacher-class') }}">
                    @csrf
                    <div class="container col-md-6">
                        <div class="mb-5">
                            <div class="row mb-3">
                                <label for="teacher_id" class="col-md-4 col-form-label text-md-end">Teacher</label>
                                <div class="col-md-6">
                                    <select class="form-select" name="teacher_id" id="teacher_id" requierd>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->employee->full_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" name="id" value="{{ $data->id }}" class="btn btn-primary">
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
@endsection
