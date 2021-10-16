<!DOCTYPE html>
<html>
 <head>
  <title>Students</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <br />
   <div class="alert" id="message" style="display: none"></div>
   <div class="card">
        <div class="card-header text-center font-weight-bold">
        <h2>Students List</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="datatable-ajax-crud">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>First Name</th>
                    <th>last Name</th>
                    <th>Phone</th>
                    <th>Profile Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            </table>
        </div>
    </div>
  

    <form action="" id="studentForm" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="error_list">
            
        </div>

        <div class="form-group">
            <label for="first_name" class="col-md-4 control-label">First Name</label>
            <div class="col-md-6">
                <input id="first_name" type="text" class="form-control" name="first_name" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="last_name" class="col-md-4 control-label">last Name</label>
            <div class="col-md-6">
                <input id="last_name" type="text" class="form-control" name="last_name" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-md-4 control-label">Phone</label>
            <div class="col-md-6">
                <input id="phone" type="tel" class="form-control" name="phone" value="">
            </div>
        </div>

        <div class="form-group">
            <label for="file" class="col-md-4 control-label">Profile Picture</label>
            <div class="col-md-6">
                <input id="file" type="file" class="form-control" name="profile">
            </div>
        </div>

        <div class="form-group">
            <button type="submit" id="submit">Submit</button>
        </div>
    </form>
   <span id="uploaded_image"></span>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    fetchData();
    
    $('#studentForm').on('submit', function(event){
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: "/students",
            type:"POST",
            data:new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                fetchData();
            },
            error: function(data) {
                $(".error_ul").removeClass('d-none');
                console.log(data.responseText);
                var response = JSON.parse(data.responseText);
                var html = '<ul class="alert alert-warning error_ul d-none" id="show_error">'; 
                $.each(response, function(key, error_val){
                    html += '<li>'+error_val+'</li>';
                });
                html += '</ul>';
                $('.error_list').html(html);
            }
        });
    });


    function fetchData(){
        $.ajax({
            url: "/students/fetch",
            type:"GET",
            dataType: "json",
            success: function (data) {
                $('tbody').html('');
                $.each(data, function(key, item){
                    $('tbody').append('<tr>\
                        <td>'+item.id+'</td>\
                        <td>'+item.first_name+'</td>\
                        <td>'+item.last_name+'</td>\
                        <td>'+item.phone+'</td>\
                        <td><img src="profile/student_images/'+item.profile+'" style="width:50px;height:50px"></td>\
                        <td><button type="button" data-id="'+item.id+'" class="edit-student btn btn-success">Edit</button><button type="button" data-id="'+item.id+'" class="delete-student btn btn-danger">Delete</button></td>\
                        </tr>');
                });
            },
            error: function(data) {
                
            }
        });
    }

});
</script>



