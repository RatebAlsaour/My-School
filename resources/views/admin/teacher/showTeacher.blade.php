@extends('layouts.app')

@section('content')
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5"
                        width="150px" src="/images/{{ $data[0]->image ? $data[0]->image : 'profile0.png' }}"><span
                        class="font-weight-bold">
                        <h3> {{ $data[0]->employee->f_name }}</h3>
                    </span><span class="text-black-50">Profile</span><span> </span></div>
                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class=" mt-5" width="150px"
                        src="/images/{{ $data[0]->schedule ? $data[0]->schedule : 'schedule.png' }}">
                    </span><span class="text-black-50">schedule</span><span> </span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="text-right">{{ $data[0]->employee->f_name }} Info </h3>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6"><label class="labels">Name</label><output type="text" class="form-control"
                                placeholder="first name" value="">{{ $data[0]->employee->full_name }}</div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6"><label class="labels">Job</label><output type="text" class="form-control"
                                placeholder="enter address line 1" value="">{{ $data[0]->employee->job_type }}</div>
                        <div class="col-md-6"><label class="labels">Birthday</label><output type="text"
                                class="form-control" placeholder="enter address line 2"
                                value="">{{ $data[0]->employee->birthday }}</div>
                        <div class="col-md-6"><label class="labels">Mobile Number</label><output type="text"
                                class="form-control" placeholder="enter phone number"
                                value="">{{ $data[0]->employee->phone }}</div>
                        <div class="col-md-6"><label class="labels">Perant phone</label><output type="text"
                                class="form-control" placeholder="enter address line 2"
                                value="">{{ $data[0]->employee->full_name }}</div>
                        <div class="col-md-6"><label class="labels">Email</label><output type="text" class="form-control"
                                placeholder="enter address line 2" value="">{{ $data[0]->employee->email }}</div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6"><label class="labels">Start date</label><output type="text"
                                class="form-control" placeholder="enter address line 2"
                                value="">{{ $data[0]->employee->start_date }}</div>
                        <div class="col-md-6"><label class="labels">End date</label><output type="text"
                                class="form-control" placeholder="enter address line 2"
                                value="">{{ $data[0]->employee->end_date }}</div>
                    </div>
                    <div class="row sm-5">
                        <h5 class="py-4 ">{{ __('Address') }}</h5>
                        <div class="col-md-6"><label class="labels">City</label><output type="text" class="form-control"
                                placeholder="education" value="">{{ $data[0]->employee->address->city }}</div>
                        <div class="col-md-6"><label class="labels">Region</label><output type="text"
                                class="form-control" placeholder="country"
                                value="">{{ $data[0]->employee->address->region }}</div>
                        <div class="col-md-6"><label class="labels">Street</label><output type="text"
                                class="form-control" value=""
                                placeholder="state">{{ $data[0]->employee->address->street }}</div>
                        <div class="col-md-6"><label class="labels">Bulid number</label><output type="text"
                                class="form-control" value=""
                                placeholder="state">{{ $data[0]->employee->address->bulid_num }}</div>
                    </div>
                </div>
                <div class="container p-20">
                    <div class="row">
                        <div class="col">
                            <div class="container">
                                <form action="{{ route('edite-teacher') }}" method="GET">
                                    @csrf
                                    <button type="submit" name="id" value="{{ $data[0]->id }}"
                                        class="btn btn-outline-info">update</button>
                                </form>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="container">
                                <form action="{{ route('add-schedule-teacher') }}" method="GET">
                                    @csrf
                                    <button type="submit" name="id" value="{{ $data[0]->id }}"
                                        class="btn btn-outline-info">add schedule</button>
                                </form>
                            </div>
                        </div>
                        <div class="col">
                            <div class="container pr-60">
                                <form action="{{ route('new-password-employee') }}" method="POST">
                                    @csrf
                                    <button type="submit" name="id" value="{{ $data[0]->employee->id }}"
                                        class="btn btn-outline-secondary">change password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <h5 class="py-4 ">{{ __('More') }}</h5>
                    <div class="col-md-6"><label class="labels">Session price</label><output type="text"
                            class="form-control" placeholder="enter address line 2"
                            value="">{{ $data[0]->session_price }}</div>
                    <div class="col-md-6"><label class="labels">Salary</label><output type="text"
                            class="form-control" placeholder="enter email id" value="">{{ $data[0]->salary }}
                    </div>
                </div>
                <div class="row py-3">
                    @if ($data[0]->employee->active == 1)
                    <div class="col-md-4">
                        <form action="{{ route('end-service') }}" method="POST">
                            @csrf
                            <button type="submit" name="id" value="{{ $data[0]->employee->id }}"
                                class="btn btn-outline-secondary js-end">End service</button>
                        </form>
                    </div>
                    @endif
                    <div class="col">
                        <form action="{{ route('delete-teacher') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" name="id" value="{{ $data[0]->id }}"
                                class="btn btn-outline-danger js-delete">Delete</button>
                        </form>
                    </div>
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
    <script>
        $(document).ready(function() {
            $('body').on('click', '.js-end', function(e) {

                if (e.target.classList.contains('clicked')) {
                    return;
                }
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This employee will be out off service",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, do it!'
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
