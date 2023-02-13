@extends('layouts.app')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px" src="/images/{{ $data[0]->image ? $data[0]->image : 'profile1.jpg' }}"><span
                        class="font-weight-bold">
                        <h3> {{ $data[0]->f_name }}</h3>
                    </span><span class="text-black-50">Profile</span><span> </span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right">{{ $data[0]->f_name }} Info </h3>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Name</label><output type="text" class="form-control"
                                placeholder="first name" value="">{{ $data[0]->full_name }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Mother name</label><output type="text"
                                class="form-control" placeholder="enter address line 1"
                                value="">{{ $data[0]->mother_name }}</div>
                        <div class="col-md-6"><label class="labels">Birthday</label><output type="text"
                                class="form-control" placeholder="enter address line 2"
                                value="">{{ $data[0]->birthday }}</div>
                        <div class="col-md-6"><label class="labels">Mobile Number</label><output type="text"
                                class="form-control" placeholder="enter phone number" value="">{{ $data[0]->phone }}
                        </div>
                        <div class="col-md-6"><label class="labels">Perant phone</label><output type="text"
                                class="form-control" placeholder="enter address line 2"
                                value="">{{ $data[0]->parent_phone }}</div>
                        <div class="col-md-6"><label class="labels">Email</label><output type="text" class="form-control"
                                placeholder="enter address line 2" value="">{{ $data[0]->email }}</div>
                    </div>
                    <div class="row mt-4">
                    </div>
                    <div class="row sm-4">
                        <h5 class="py-4 ">{{ __('Address') }}</h5>
                        <div class="col-md-6"><label class="labels">City</label><output type="text" class="form-control"
                                placeholder="education" value="">{{ $data[0]->address->city }}</div>
                        <div class="col-md-6"><label class="labels">Region</label><output type="text"
                                class="form-control" placeholder="country" value="">{{ $data[0]->address->region }}
                        </div>
                        <div class="col-md-6"><label class="labels">Street</label><output type="text"
                                class="form-control" value="" placeholder="state">{{ $data[0]->address->street }}
                        </div>
                        <div class="col-md-6"><label class="labels">Bulid number</label><output type="text"
                                class="form-control" value=""
                                placeholder="state">{{ $data[0]->address->bulid_num }}
                        </div>
                    </div>
                </div>
                <div class="container p-20">
                    <div class="row">
                        <div class="col">
                            <div class="container pr-60">
                                <form action="{{ route('edite-student') }}" method="GET">
                                    @csrf
                                    <button type="submit" name="id" value="{{ $data[0]->id }}"
                                        class="btn btn-outline-info">update</button>
                                </form>
                            </div>
                        </div>
                        <div class="col ">
                            <form action="{{ route('delete-student') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="id" value="{{ $data[0]->id }}"
                                    class="btn btn-outline-danger js-delete">Delete</button>
                            </form>
                        </div>
                        <div class="col ">
                            <form action="{{ route('new-password-student') }}" method="POST">
                                @csrf
                                <button type="submit" name="id" value="{{ $data[0]->id }}"
                                    class="btn btn-outline-secondary">change password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <h5 class="py-4 ">{{ __('Class') }}</h5>
                    <div class="col-md-6"><label class="labels">Level</label><output type="text" class="form-control"
                            placeholder="enter address line 2" value="">{{ $data[0]->classRoom->level }}</div>
                    <div class="col-md-6"><label class="labels">Class Room</label><output type="text"
                            class="form-control" placeholder="enter email id"
                            value="">{{ $data[0]->ClassRoom->room_name }}</div>
                </div>
                <div class="col-md-6 pt-3">
                    </span><span class="text-black-50 ">Absence & Late</span><span> </span>
                    <table class="table table-hover table-bordered"id="dxd">
                        <thead>
                            <tr>
                                <th scope="col">type</th>
                                <th scope="col">date</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <div class="overflow-scroll">
                                @foreach ($data[0]->absence_Let_st as $absence_Let_st)
                                    <tr>
                                        {{-- <th scope="row">{{ $absence_Let_st->id }}</th> --}}
                                        <td>{{ $absence_Let_st->type }}</td>
                                        <td>{{ $absence_Let_st->subject }}</td>
                                    </tr>
                                @endforeach
                            </div>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-8">
                    @if ($password =Session::get('password'))
                        <div class="alter alert-success alert-dismissible fade show" role="alert">
                          <p class="pl-2">new password: {{$password}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 pt-3">
                </span><span class="text-black-70">marks</span><span> </span>
                <table class="table table-hover table-bordered"id="dxd">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">mark</th>
                            <th scope="col">Subject</th>
                            <th scope="col">type</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <div class="overflow-scroll">
                            @foreach ($data[0]->mark as $mark)
                                <tr>
                                    <th scope="row">{{ $mark->id }}</th>
                                    <td>{{ $mark->mark }}</td>
                                    <td>{{ $mark->subject }}</td>
                                    <td>{{ $mark->type }}</td>
                                </tr>
                            @endforeach
                        </div>
                    </tbody>
                </table>
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
