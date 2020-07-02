@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="col-sm-9">
            <div class="justify-content-center">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center">Form Validation Without Ajax</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('validation') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ old('first_name') }}">
                                </div>

                                <div class="form-group">
                                    <label>Middle Name:</label>
                                    <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="{{ old('middle_name') }}">
                                </div>

                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ old('last_name') }}">
                                </div>

                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                </div>

                                <div class="form-group">
                                    <strong>Address:</strong>
                                    <textarea class="form-control" name="address" placeholder="Address" value="{{ old('address') }}"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Profile Image:</label>
                                    <input type="file" name="profile_image" class="form-control-file" value="{{ old('profile_image') }}">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
