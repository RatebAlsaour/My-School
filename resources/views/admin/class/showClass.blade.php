@extends('layouts.app')

@section('content')
    <div class="position-fixed">
        <div class="container  bg-white mt-5 mb-5 ">
            <div class=" d-flex flex-row mb-3">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img id="sky" class="mx-auto d-block img-fluid img-thumbnail " onclick="enlargeImg()"
                            id="img1" src="/images/{{ $data[0]->image ? $data[0]->image : 'schedule.png' }}">
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="text-right">Class {{ $data[0]->room_name }}</h3>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Level</label><output type="text"
                                    class="form-control" placeholder="first name" value="">{{ $data[0]->level }}
                            </div>
                            <div class="col-md-6"><label class="labels">Room</label><output type="text"
                                    class="form-control" placeholder="enter address line 1"
                                    value="">{{ $data[0]->room_name }}
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Master</label><output type="text"
                                    class="form-control" placeholder="enter address line 2"
                                    value="">{{ $data[0]->master->employee->full_name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="container">
                        <div class="d-flex justify-content-center">{{ __('Teacher') }}</div>
                        <table class="table table-hover table-bordered"id="dxd">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">@</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <div class="overflow-scroll">
                                    @foreach ($data[0]->teacher as $teacher)
                                        <tr>
                                            <th scope="row">{{ $teacher->id }}</th>
                                            <td>{{ $teacher->employee->full_name }}</td>
                                            <td>{{ $teacher->employee->phone }}</td>
                                            <td>{{ $teacher->subject }}</td>
                                            <td>
                                                {{-- <div class="col">
                                        <form action="{{ route('show-student') }}" method="GET">
                                            @csrf
                                            <button type="submit" name="id" value="{{ $student->id }}"
                                                class="btn btn-outline-primary">show</button>
                                        </form>
                                    </div> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ratio ratio-21x9">
                    <div class="row justify-content-md-center d-flex p-2">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-center">{{ __('Students') }}</div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">@</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            @foreach ($data[0]->student as $student)
                                                <tr>
                                                    <th scope="row">{{ $student->id }}</th>
                                                    <td>{{ $student->full_name }}</td>
                                                    <td>{{ $student->phone }}</td>
                                                    <td>
                                                        <div class="col">
                                                            <form action="{{ route('show-student') }}" method="GET">
                                                                @csrf
                                                                <button type="submit" name="id"
                                                                    value="{{ $student->id }}"
                                                                    class="btn btn-outline-primary">show</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Get the img object using its Id
        img = document.getElementById("img1");
        // Function to increase image size
        function enlargeImg() {
            // Set image size to 1.5 times original
            img.style.transform = "scale(4.5)";
            // Animation effect
            img.style.transition = "transform 0.25s ease";
        }
        // Function to reset image size
        function resetImg() {
            // Set image size to original
            img.style.transform = "scale(1)";
            img.style.transition = "transform 0.25s ease";
        }
    </script>
@endsection
