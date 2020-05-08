@extends('layouts.app')

@section('title', 'Roles & Permissions')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Roles Update</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
              <h4 class="panel-title">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" aria-expanded="{{'true' }}" aria-controls="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
                    <?php echo $title; ?> Role
                  </a>
                  <div class="pull-right">
                    <input type="checkbox" name="select-all" id="select-all" value="Select All" /> Select All
                  </div>
              </h4>
          </div>
          <div id="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" class="panel-collapse collapse {{'in' }}" role="tabpanel" aria-labelledby="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
              <div class="panel-body">
                  <div class="row">
                    {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update',  $role->id ], 'class' => 'm-b']) !!}
                        @foreach($permission as $perm)
                            <?php
                                $per_found = null;

                                if( isset($role) ) {
                                    $per_found = $role->hasPermissionTo($perm->name);
                                }

                                if( isset($user)) {
                                    $per_found = $user->hasDirectPermission($perm->name);
                                }
                            ?>
                            <div class="col-md-3">
                                <div class="checkbox">
                                    <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                        {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                                    </label>
                                </div>
                            </div>

                        @endforeach
                        <div class="col-md-12">
                          <?php if($role->name != 'Admin'){ ?>
                            @can('edit_roles')
                              {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            @endcan
                          <?php } ?>
                        </div>
                       {!! Form::close() !!}
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>
<script type="text/javascript">
  $('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
  });
</script>
@endsection