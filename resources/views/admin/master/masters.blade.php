@extends('layouts.app')

@section('content')
    <div class="ratio ratio-21x9">
        <div class="row justify-content-md-center d-flex p-2">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-center">
                            {{ __('Matsters') }}
                        </div>
                    </div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">birthday</th>
                                <th scope="col">phone</th>
                                <th scope="col">education degree</th>
                                <th scope="col">email</th>
                                <th scope="col">start date</th>
                                <th scope="col">worke time</th>
                                <th scope="col">salary</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($data as $master)
                                @if ($master->employee->states == 1)
                                    <tr>
                                        <th scope="row">{{ $master->id }}</th>
                                        <td>{{ $master->employee->full_name }}</td>
                                        <td>{{ $master->employee->birthday }}</td>
                                        <td>{{ $master->employee->phone }}</td>s
                                        <td>{{ $master->employee->edu_degree }}</td>
                                        <td>{{ $master->employee->email }}</td>
                                        <td>{{ $master->employee->start_date }}</td>
                                        <td>{{ $master->work_time }}</td>
                                        <td>{{ $master->salary }}</td>
                                        {{-- <td>{{ $master->address->city }}</td> --}}
                                        <td>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('show-master') }}" method="GET">
                                                            @csrf
                                                            <button type="submit" name="id"
                                                                value="{{ $master->id }}"
                                                                class="btn btn-outline-primary">show</button>
                                                        </form>
                                                    </div>
                                                    <div class="col">
                                                        <form action="{{ route('edite-master') }}" method="GET">
                                                            @csrf
                                                            <button type="submit" name="id"
                                                                value="{{ $master->id }}"
                                                                class="btn btn-outline-info">update</button>
                                                        </form>
                                                    </div>
                                                    <div class="col js-form">
                                                        <form action="{{ route('delete-master') }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" name="id"
                                                                value="{{ $master->id }}"
                                                                class="btn btn-outline-danger js-delete">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">birthday</th>
                                <th scope="col">phone</th>
                                <th scope="col">education degree</th>
                                <th scope="col">email</th>
                                <th scope="col">start date</th>
                                <th scope="col">worke time</th>
                                <th scope="col">salary</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <h5>out off service</h5>
                        <tbody class="table-group-divider">
                            @foreach ($data as $master)
                                @if ($master->employee->states == 0)
                                    <tr>
                                        <th scope="row">{{ $master->id }}</th>
                                        <td>{{ $master->employee->full_name }}</td>
                                        <td>{{ $master->employee->birthday }}</td>
                                        <td>{{ $master->employee->phone }}</td>s
                                        <td>{{ $master->employee->edu_degree }}</td>
                                        <td>{{ $master->employee->email }}</td>
                                        <td>{{ $master->employee->start_date }}</td>
                                        <td>{{ $master->work_time }}</td>
                                        <td>{{ $master->salary }}</td>
                                        {{-- <td>{{ $master->address->city }}</td> --}}
                                        <td>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="{{ route('show-master') }}" method="GET">
                                                            @csrf
                                                            <button type="submit" name="id"
                                                                value="{{ $master->id }}"
                                                                class="btn btn-outline-primary">show</button>
                                                        </form>
                                                    </div>
                                                    <div class="col">
                                                        <form action="{{ route('edite-master') }}" method="GET">
                                                            @csrf
                                                            <button type="submit" name="id"
                                                                value="{{ $master->id }}"
                                                                class="btn btn-outline-info">update</button>
                                                        </form>
                                                    </div>
                                                    <div class="col js-form">
                                                        <form action="{{ route('delete-master') }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" name="id"
                                                                value="{{ $master->id }}"
                                                                class="btn btn-outline-danger js-delete">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
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
                    text: "You won't be able to revert this!",
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
