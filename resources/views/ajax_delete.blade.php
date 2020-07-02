@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-9">
            <div class="justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">User Delete With Ajax</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul class=></ul>
                        </div>
                        <form id="upload_form" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <select class="custom-select" onchange="myUser(this.value)">
                                    <option selected>Select User to Edit</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name . " " . $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="button" onclick="myFunction()">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        var user;

        function myUser(id) {
            user = id;
        }

        function  myFunction(){
            var _token = "{{ csrf_token() }}";
            if (user != null){
                $.ajax({
                    url: "{{ route('ajax-delete') }}",
                    type: "POST",
                    dataType: "JSON",
                    data: {_token:_token, user:user},
                    success: function (data) {
                        alert(data.success);
                    }
                });
            }
            else {
                alert("No User Selected");
            }
        }

    </script>
@endsection
