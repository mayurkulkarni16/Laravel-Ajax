@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-9">
            <div class="justify-content-center">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">User Edit With Ajax</h3>
                        <form id="id_select" method="post">
                            {{ csrf_field() }}
                            <select class="custom-select" onchange="myUser(this.value)">
                                <option selected>Select User to Edit</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->first_name . " " . $user->last_name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul class=></ul>
                        </div>
                        <form id="upload_form" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                            </div>

                            <div class="form-group">
                                <label>Middle Name:</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Middle Name">
                            </div>

                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                            </div>

                            <div class="form-group">
                                <label>Email:</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>

                            <div class="form-group">
                                <label>Address:</label>
                                <input class="form-control" name="address" id="address" placeholder="Address">
                            </div>

                            <div class="form-group">
                                <label>Profile Image:</label>
                                <img src="" id="profile_image_src" height="130px" width="100px" style="display: none">
                                <input type="file" name="profile_image" id="profile_image" class="form-control-file">
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

        var image;

        function printErrorMsg(response) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( response, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }

        $("#profile_image").change(function(){
            image = this.files[0];
            console.log(image)
        });

        function myFunction(){
            var _token = "{{ csrf_token() }}";
            var first_name = $("input[name='first_name']").val();
            var middle_name = $("input[name='middle_name']").val();
            var last_name = $("input[name='last_name']").val();
            var email = $("input[name='email']").val();
            var address = $("input[name='address']").val();
            var fd = new FormData;
            fd.append("_token", _token);
            fd.append("first_name", first_name);
            fd.append("last_name", last_name);
            fd.append("email", email);
            fd.append("address", address);
            fd.append("middle_name", middle_name);
            fd.append("image", image);
            $.ajax({
                url: "{{ route('ajax-validation') }}",
                type: 'POST',
                dataType: 'JSON',
                data: fd,
                contentType: false,
                processData: false,
                cache: false,
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        alert(data.success);
                    }
                    else{
                        printErrorMsg(data.error);
                    }
                }
            });
        }

        function myUser(id){
            var _token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('get_user_ajax') }}",
                type: 'POST',
                dataType: 'JSON',
                data: {_token:_token, id:id},
                success: function (data) {
                    document.getElementById("first_name").value = data.first_name;
                    document.getElementById("middle_name").value = data.middle_name;
                    document.getElementById("last_name").value = data.last_name;
                    document.getElementById("address").value = data.address;
                    document.getElementById("email").value = data.email;
                    $("#profile_image_src").css('display','block');
                    var img = data.profile_image
                    document.getElementById("profile_image_src").src = "/storage/avatars/" + data.profile_image;
                }
            });
        }
    </script>
@endsection
