@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-9">
            <div class="justify-content-center">

                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Edit User Form Without Ajax</h3>
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
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ $user->first_name }}">
                            </div>

                            <div class="form-group">
                                <label>Middle Name:</label>
                                <input type="text" name="middle_name" class="form-control" placeholder="Middle Name" value="{{ $user->middle_name }}">
                            </div>

                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ $user->last_name }}">
                            </div>

                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <strong>Address:</strong>
                                <input type="text" class="form-control" name="address" placeholder="Address" value="{{ $user->address }}"></input>
                            </div>

                            <div class="form-group">
                                <label>Profile Image:</label>
                                <img src="/storage/avatars/{{ $user->profile_image }}.jpg" height="130px" width="100px">
                                <input type="file" name="profile_image" class="form-control-file">
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
