@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profile</div>

                <div class="panel-body">
                    @if(session('success'))
                        <div class="success-wrapper" style="margin:20px 0">
                            <h3 style="color:green">{{ session('success') }}</h3>
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ url('/user-profile/update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control" name="phone" required value="{{ $user->phone }}">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('profile') ? ' has-error' : '' }}">
                            <label for="profile" class="col-md-4 control-label">Profile Picture</label>

                            <div class="col-md-6">
                                <input id="profile" type="file" class="form-control" name="profile">
                                @if ($errors->has('profile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @if($user->profile == '')
                                    <img src="{{ asset('profile/user_images/default_user_image.png') }}" style="width:100px;height:100px">
                                @else
                                    <img src="{{ asset('profile/user_images').'/'.$user->profile }}" style="width:100px;height:100px">
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="last-profile" value="{{ $user->profile }}">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
