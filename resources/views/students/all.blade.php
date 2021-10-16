@extends('layouts.app')

@section('content')
<div class="container mt-4">
  
    <div class="card">
      <div class="card-header text-center font-weight-bold">
        <h2>Students List</h2>
      </div>
      <div class="card-body">
          <table class="table table-bordered" id="datatable-ajax-crud">
             <thead>
                <tr>
                   <th>S. No.</th>
                   <th>First Name</th>
                   <th>last Name</th>
                   <th>Phone</th>
                   <th>Profile Image</th>
                   <th>Action</th>
                </tr>
             </thead>
             <tbody>
                @php($x = 1)

                @if(empty($students)) 
                    <tr><td>No data found</td></tr>    
                @else
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $x++ }}</td>
                        </tr>
                        <tr>
                            <td>{{ $student->first_name }}</td>
                        </tr>
                        <tr>
                            <td>{{ $student->last_name }}</td>
                        </tr>
                        <tr>
                            <td>{{ $student->phone }}</td>
                        </tr>
                        <tr>
                            @if($student->profile == '')
                            <td></td>
                            @else
                            <td><img src="{{ asset('profile/user_images').'/'.$student->profile }}" style="height:50px;width:50px"></td>
                            @endif
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
          </table>
      </div>
    </div>
    

    <form action="" id="studentForm" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
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
    
    

@endsection