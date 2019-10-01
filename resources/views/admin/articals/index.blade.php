@extends('layouts.app')

@section('title', 'Posts')

@section('content')

<section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
    <li class="active">Artical</li>
  </ol>
</section>
 <section class="content">
    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $result->total() }} {{ str_plural('Artical', $result->count()) }}</h3>
              <div class="pull-right">
                @can('add_articals')
                    <a href="{{ route('articals.create') }}" class="btn btn-primary btn-sm"> 
                        <i class="glyphicon glyphicon-plus-sign"></i> Create
                    </a>
                @endcan
              </div>
              <div class="pull-right">
                  <a href="{{ route('add') }}" class="btn btn-primary btn-sm" style="margin-right: 20px;"> 
                      <i class="glyphicon glyphicon-plus-sign"></i> Import
                  </a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-striped {{ $result->count() > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Author</th>
                        <th>Created At</th>
                        @can('edit_posts', 'delete_posts')
                            <th class="text-center">Actions</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($result as $item)
                        <?php $image_name =  $item->image_name; ?>
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                              <?php if((!empty($image_name))){ ?>
                              <img src="{{asset('uploads/articals').'/'.$image_name}}" width="50" height="50" alt="{{$item->title}}"/>
                            <?php } else { ?>
                              <img src="{{asset('img/post_dafult.jpg')}}" width="50" height="50" alt="{{$item->title}}"/>
                            <?php } ?>
                            </td>
                            <td>{{ $item->user['name'] }}</td>
                            <td>{{ $item->created_at->toFormattedDateString() }}</td>
                            @can('edit_articals', 'delete_articals')
                            <td class="text-center">
                                @include('shared._actions', [
                                    'entity' => 'articals',
                                    'id' => $item->id
                                ])
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>    
</section>

@endsection