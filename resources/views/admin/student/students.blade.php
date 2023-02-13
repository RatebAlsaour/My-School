@extends('layouts.app')

@section('content')
    <div class="ratio ratio-21x9">
        <div class="row justify-content-md-center d-flex p-2">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-center">
                            {{ __('Students') }}
                        </div>
                    </div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">mothername</th>
                                <th scope="col">birthday</th>
                                <th scope="col">phone</th>
                                <th scope="col">perant phone</th>
                                <th scope="col">email</th>
                                <th scope="col">level</th>
                                <th scope="col">class room</th>
                                <th scope="col">city</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($data as $student)
                                <tr>
                                    <th scope="row">{{ $student->id }}</th>
                                    <td>{{ $student->full_name }}</td>
                                    <td>{{ $student->mother_name }}</td>
                                    <td>{{ $student->birthday }}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->parent_phone }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->classRoom->level }}</td>
                                    <td>{{ $student->classRoom->room_name }}</td>
                                    <td>{{ $student->address->city }}</td>
                                    <td>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col">
                                                    <form action="{{ route('show-student') }}" method="GET">
                                                        @csrf
                                                        <button type="submit" name="id" value="{{ $student->id }}"
                                                            class="btn btn-outline-primary">show</button>
                                                    </form>
                                                </div>
                                                <div class="col">
                                                    <form action="{{ route('edite-student') }}" method="GET">
                                                        @csrf
                                                        <button type="submit" name="id" value="{{ $student->id }}"
                                                            class="btn btn-outline-info">update</button>
                                                    </form>
                                                </div>
                                                <div class="col js-form">
                                                    <form action="{{ route('delete-student') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" name="id" value="{{ $student->id }}"
                                                            class="btn btn-outline-danger js-delete">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
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
