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
              <h3 class="box-title">{{ $result->total() }} {{ str_plural('User', $result->count()) }}</h3>
              <span>
                <?php if(!empty($error)){echo $error; } ?> 
                </span>
              <div class="pull-right">
                @can('add_users')
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"> 
                        <i class="glyphicon glyphicon-plus-sign"></i> Create
                    </a>
                @endcan
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped {{ $result->count() > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        @can('edit_users', 'delete_users')
                        <th class="text-center">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($result as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->implode('name', ', ') }}</td>
                            <td>{{ $user->created_at->toFormattedDateString() }}</td>

                            @can('edit_users')
                            <td class="text-center">
                                @include('shared._actions', [
                                    'entity' => 'users',
                                    'id' => $user->id
                                ])
                                <a class="btn btn-xs btn-info" href="{{ route('password_change',['user_id'=>$user->id]) }}" title="Password Change">
                                    <span class="text-info glyphicon glyphicon-transfer" style="color:#fff;"></span>
                                </a>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>

              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                {{ $result->links() }}
              </ul>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>    
</section>
@endsection