@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-9">
            <div class="justify-content-center">

                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Delete User Without Ajax</h3>
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
                        <form action="{{ route('delete-user') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <select class="custom-select" name="user">
                                    <option selected value="">Select User to Edit</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name . " " . $user->last_name }}</option>
                                    @endforeach
                                </select>
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
