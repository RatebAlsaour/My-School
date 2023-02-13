@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register Tearcher') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('create-Teacher') }}">
                            @csrf
                            <input id="job_type" type="hidden" class="form-control " name="job_type" value="teacher"
                                required>
                            <div class="row mb-3">
                                <label for="f_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="f_name" type="text"
                                        class="form-control @error('f_name') is-invalid @enderror" name="f_name"
                                        value="{{ old('f_name') }}" required autocomplete="name" autofocus>

                                    @error('f_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="m_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Middle Name') }}</label>

                                <div class="col-md-6">
                                    <input id="m_name" type="text"
                                        class="form-control @error('m_name') is-invalid @enderror" name="m_name"
                                        value="{{ old('m_name') }}" required autocomplete="name" autofocus>

                                    @error('m_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="l_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="l_name" type="text"
                                        class="form-control @error('l_name') is-invalid @enderror" name="l_name"
                                        value="{{ old('l_name') }}" required autocomplete="name" autofocus>

                                    @error('l_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="birthday"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>

                                <div class="col-md-6">
                                    <input id="birthday" type="date"
                                        class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                                        value="{{ old('birthday') }}" required autocomplete="birthday" autofocus>

                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="numder"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="edu_degree"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Educational Degree') }}</label>

                                <div class="col-md-6">
                                    <input id="edu_degree" type="text"
                                        class="form-control @error('edu_degree') is-invalid @enderror" name="edu_degree"
                                        value="{{ old('edu_degree') }}" required autocomplete="edu_degree" autofocus>

                                    @error('edu_degree')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="start_date"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Start date') }}</label>

                                <div class="col-md-6">
                                    <input id="start_date" type="date"
                                        class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                        value="{{ old('start_date') }}" required>

                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="subject" class="col-md-4 col-form-label text-md-end">Subject</label>
                                <div class="col-md-6">
                                    <select class="form-select" name="subject" id="subject" requierd>
                                        <option selected>Select one</option>
                                        <option value="Physic">Physic</option>
                                        <option value="Math">Math</option>
                                        <option value="English">English</option>
                                    </select>
                                </div>
                            </div>
                            <h4>{{ __('Address') }}</h4>
                            <div class="row mb-3">
                                <label for="city"
                                    class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>

                                <div class="col-md-6">
                                    <input id="city" type="text"
                                        class="form-control @error('city') is-invalid @enderror" name="city"
                                        value="{{ old('city') }}" required autocomplete="city" autofocus>

                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="region"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Region') }}</label>

                                <div class="col-md-6">
                                    <input id="region" type="text"
                                        class="form-control @error('region') is-invalid @enderror" name="region"
                                        value="{{ old('region') }}" required autocomplete="region" autofocus>

                                    @error('region')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="street"
                                    class="col-md-4 col-form-label text-md-end">{{ __('street') }}</label>

                                <div class="col-md-6">
                                    <input id="street" type="text"
                                        class="form-control @error('street') is-invalid @enderror" name="street"
                                        value="{{ old('street') }}" required autocomplete="street" autofocus>

                                    @error('street')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="bulid_num"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Bulid numder') }}</label>

                                <div class="col-md-6">
                                    <input id="bulid_num" type="text"
                                        class="form-control @error('bulid_num') is-invalid @enderror" name="bulid_num"
                                        value="{{ old('bulid_num') }}" required autocomplete="bulid_num" autofocus>

                                    @error('bulid_num')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="salary"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Salary') }}</label>

                                <div class="col-md-6">
                                    <input id="salary" type="price" class="form-control" name="salary" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="session_price"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Session price') }}</label>

                                <div class="col-md-6">
                                    <input id="session_price" type="price" class="form-control" name="session_price"
                                        required>
                                </div>
                            </div>
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
            <div class="col-md-4">
                @if ($user = Session::get('user'))
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-center">{{ __('Teacher') }}</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">#</th> --}}
                                        <th scope="col">email</th>
                                        <th scope="col">password</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        {{-- <th scope="row">{{$user['fullname']}}</th> --}}
                                        <td>{{ $user['fullname'] }}</td>
                                        <td>{{ $user['password'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

{{-- @section('scripts')
<script>
    function myFunction() {
      /* Get the text field */
      var copyText = document.getElementById("myInput");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */

      document.execCommand('copy')
      /* Copy the text inside the text field */
      navigator.clipboard.writeText(copyText.value);

      /* Alert the copied text */
      alert("Copied the text: " + copyText.value);
    }
    </script>
@endsection --}}
