@extends('admin.layouts.app')
@section('title','List Roles')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="box post-list">
                <div class="box-header with-border">
                      <h3 class="box-title">@yield('title')</h3>
                </div>
                <div class="box-body">
                    <form method="GET" class="form-inline">
                        <div class="form-group">
                            {!! Form::label('q', 'Search: ') !!}
                            {!! Form::text('q', Request::get('q'), ['class' => 'form-control', "placeholder" => "name"]) !!}
                        </div>
                        <button class="btn btn-primary" type="submit"> <i class="fa fa-search"></i> Search</button>
                    </form>

                    <hr>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->updated_at}}</td>
                                    <td>
                                        @hasPermission('roles.edit')
                                        <a href="{{ route("roles.edit", $item->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                                        @endhasPermission
                                        @hasPermission('roles.destroy')
                                        @if ($item->id != config("constants.SUPERADMIN_ROLE_ID"))
                                        <button class="btn btn-danger delete-item" data-form="form-delete-{{$item->id}}"><i class="fa fa-trash"></i> Delete</button>
                                        {!! Form::open(['method' => 'DELETE', 'id' => "form-delete-" . $item->id, 'route' => ['roles.destroy', $item->id]]) !!}
                                        {!! Form::close() !!}
                                        @endif
                                        @endhasPermission
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($items)
                        {!!$items->appends(request()->except('page'))->render()!!}
                    @endif
                    @hasPermission('roles.create')
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route("roles.create") }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create role</a>
                        </div>
                    </div>
                    @endhasPermission
                </div>
            </div>
        </div>
    </div>
@endsection