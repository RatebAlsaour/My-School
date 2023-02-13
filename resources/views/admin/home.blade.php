@extends('layouts.app')

@section('content')
    <div class="card ">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row justify-content-center pb-4">
                    <div class="p5 col-md-2" >
                        <div class="card pb-6">
                            {{-- <img src="https://picsum.photos/500/300?random=1" class="card-img-top" alt="..."> --}}
                            <div class="px-3 pt-2 pb-3">
                                <div class="row">
                                    <h5>Master</h5>
                                    <h6> {{$sta['master']}}</h6>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form method="GET" action="{{ route('all-masters') }}">
                                            @csrf
                                            <div class="row mb-0">
                                                <div class="raw-md-5">
                                                    <button type="submit" class="btn btn-outline-secondary">
                                                        {{ __('All master') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <form method="GET" action="{{ route('create-master') }}">
                                            @csrf
                                            <div class="row mb-0">
                                                <div class="col-md-20 ">
                                                    <button type="submit" class="btn btn-outline-secondary">
                                                        {{ __('Add mastre') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class=" pt-3">
                                    <form class="d-flex" role="search" method="POST"
                                        action="{{ route('find-employee') }}">
                                        @csrf
                                        <input class="form-control me-2" type="search" placeholder="master full name"
                                            aria-label="Search" id="full_name" name="full_name">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p5 col-md-2">
                        <div class="card pb-6">
                            <div class="px-3 pt-2 pb-3">
                                <div class="row">
                                    <h5>Teacher</h5>
                                    <h6> {{$sta['teacher']}}</h6>

                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form method="GET" action="{{ route('all-teachers') }}">
                                            @csrf
                                            <div class="row mb-0">
                                                <div class="raw-md-5 ">
                                                    <button type="submit" class="btn btn-outline-secondary">
                                                        {{ __('All teachers') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <form method="GET" action="{{ route('create-teacher') }}">
                                            @csrf
                                            <div class="row mb-0">
                                                <div class="raw-md-5">
                                                    <button type="submit" class="btn btn-outline-secondary">
                                                        {{ __('Add teacher') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class=" pt-3">
                                    <form class="d-flex" role="search" method="POST"
                                        action="{{ route('find-employee') }}">
                                        @csrf
                                        <input class="form-control me-2" type="search" placeholder="teacher full name"
                                            aria-label="Search" id="full_name" name="full_name">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p5 col-md-2">
                        <div class="card pb-6">
                            {{-- <img src="https://picsum.photos/500/300?random=1" class="card-img-top" alt="..."> --}}
                            <div class="px-3 pt-2 pb-3">
                                <div class="row">
                                    <h5>Student</h5>
                                    <h6> {{$sta['student']}}</h6>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form method="GET" action="{{ route('all-students') }}">
                                            @csrf
                                            <div class="row mb-0">
                                                <div class="col">
                                                    <button type="submit" class="btn btn-outline-secondary">
                                                        {{ __('All students') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col">
                                        <form method="GET" action="{{ route('create-student') }}">
                                            @csrf
                                            <div class="row mb-0">
                                                <div class="raw-md-5">
                                                    <button type="submit" class="btn btn-outline-secondary">
                                                        {{ __('Add student') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class=" pt-3">
                                    <form class="d-flex" role="search" method="POST"
                                        action="{{ route('find-student') }}">
                                        @csrf
                                        <input class="form-control me-2" type="search" placeholder="student full name"
                                            aria-label="Search" id="full_name" name="full_name">
                                        <button class="btn btn-outline-success" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card text-bg-light">
                            <div class="card-header">
                                <div class="row mb-0">
                                    <div class="col">
                                        <h3>{{ __('Classes') }}</h3>
                                    </div>
                                    <div class="col">
                                        <form method="GET" action="{{ route('create-class') }}">
                                            @csrf
                                            <div class="row mb-0">
                                                <div class="raw-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-outline-dark">
                                                        {{ __('create class') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" width="100%">
                                <table class="table table-hover table-bordered" width="100%">
                                    <div class="container-fluid">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">level</th>
                                                <th scope="col">name</th>
                                                <th scope="col">date</th>
                                                <th scope="col">Handle</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                            @foreach ($data as $class)
                                                <tr>
                                                    <th scope="row">{{ $class->id }}</th>
                                                    <td>{{ $class->level }}</td>
                                                    <td>{{ $class->room_name }}</td>
                                                    <td>{{ $class->date }}</td>
                                                    <td>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <form action="{{ route('class-students') }}"
                                                                        method="GET">
                                                                        @csrf
                                                                        <button type="submit" name="id"
                                                                            value="{{ $class->id }}"
                                                                            class="btn btn-outline-secondary">student</button>
                                                                    </form>
                                                                </div>
                                                                <div class="col">
                                                                    <form action="{{ route('show-class') }}"
                                                                        method="GET">
                                                                        @csrf
                                                                        <button type="submit" name="id"
                                                                            value="{{ $class->id }}"
                                                                            class="btn btn-outline-primary">show</button>
                                                                    </form>
                                                                </div>
                                                                <div class="col">
                                                                    <form action="{{ route('add-schedule-class') }}"
                                                                        method="GET">
                                                                        @csrf
                                                                        <button type="submit" name="id"
                                                                            value="{{ $class->id }}"
                                                                            class="btn btn-outline-dark">Add
                                                                            schedule</button>
                                                                    </form>
                                                                </div>
                                                                <div class="col">
                                                                    <form action="{{ route('add-teacher-class') }}"
                                                                        method="GET">
                                                                        @csrf
                                                                        <button type="submit" name="id"
                                                                            value="{{ $class->id }}"
                                                                            class="btn btn-outline-dark">Add
                                                                            Teacher</button>
                                                                    </form>
                                                                </div>
                                                                <div class="col">
                                                                    <form action="{{ route('delete-class') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" name="id"
                                                                            value="{{ $class->id }}"
                                                                            class="btn btn-outline-danger js-delete">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </div>
                                </table>
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
        $(document).ready(function() {
            $('body').on('click', '.js-delete', function(e) {

                if (e.target.classList.contains('clicked')) {
                    return;
                }
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "It will delete all student how belong to this class ",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.classList.add('clicked')
                        e.target.click();
                    }
                })
            })
        });
    </script>
@endsection
