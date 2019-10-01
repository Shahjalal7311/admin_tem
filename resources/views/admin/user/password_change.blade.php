@extends('layouts.app')

@section('title', 'Users')

@section('content')
<section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
    <li class="active">User</li>
  </ol>
</section>
<section class="content">
	<div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Password Change</h3>
        </div>
        <div class="box-body">
        	<form id="form-change-password" role="form" method="POST" action="{{ route('password_update',['user_d'=>$user_id]) }}" novalidate class="form-horizontal">
        		<input type="hidden" name="user_d" value="<?= $user_id ?>">
					  <div class="col-md-12">             
					    <label for="current-password" class="col-sm-2">Current Password</label>
					    <div class="col-sm-10">
					      <div class="form-group">
					        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
					        <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password">
					      </div>
					    </div>
					    <label for="password" class="col-sm-2">New Password</label>
					    <div class="col-sm-10">
					      <div class="form-group">
					        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
					      </div>
					    </div>
					    <label for="password_confirmation" class="col-sm-2">Re-enter Password</label>
					    <div class="col-sm-10">
					      <div class="form-group">
					        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-6">
					      <button type="submit" class="btn btn-danger">Submit</button>
					    </div>
					  </div>
					</form>
        </div>
    	</div>
    </div>
  </div>
</section>
@endsection
        	