@extends('layouts.app')

@section('content')
    <div class="ratio ratio-21x9">
        <div class="row justify-content-md-center d-flex p-2">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header ">
                        <div class="d-flex justify-content-center">
                            {{ __('Admin') }}
                        </div>
                    </div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">email</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($data as $admin)
                                <tr>
                                    <th scope="row">{{ $admin->id }}</th>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <div class="container">
                                                <div class="col js-form">
                                                    <form action="{{ route('delete-admin') }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" name="email" value="{{ $admin->email }}"
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
