@extends('layouts.app')

@section('title', 'Edit Post ')

@section('content')
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Articals</h3>
              <div class="pull-right">
                 <a href="{{ route('articals.index') }}" class="btn btn-default btn-sm"> 
                    <i class="fa fa-arrow-left"></i> Back
                 </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::model($artical, ['method' => 'PUT', 'route' => ['articals.update',  $artical->id], 'enctype' => 'multipart/form-data' ]) !!}
                    @include('admin.articals._form')
                    <!-- Submit Form Button -->
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
              </table>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>    
</section>
@endsection