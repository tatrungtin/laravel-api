@extends('admin.layouts.app')

@section('title')
    @if (!empty($role))
        Edit Role
    @else
        Add Role
    @endif
@endsection
@section('header')
<style>
    li{
        list-style: none;
    }
    .trew {
        font-size: 17px;
        padding-left: 15px;
    }
    .trew-chirent {
        /*display: none;*/
    }
    .trew .trew-parent a{
        color: #000;
    }
    .trew .trew-parent i{
        padding-right: 7px;
        padding-left: 7px;
    }
    .trew .trew-parent ul{
       padding-left: 25px;
    }
    .icheckbox_minimal-blue {
        margin-left: 5px;
    }
    .chirent_key_block {
        display: block;
    }
    .chirent_key_none {
        display: none;
    }
    input[type=checkbox]:checked:before {
        color: #3c8dbc !important;
    }
    input[type=checkbox]:before {
        font-family: "FontAwesome";
        content: "\f00c";
        font-size: 15px;
        padding: 0px 0px;
        color: transparent !important;
        background: #fff;
        display: block;
        width: 18px;
        height: 18px;
        border: 1px solid #d6d6d6;
        border-radius: 1px;
        margin-right: 5px;
        margin-top: -3px;
    }
    .fa-key {
        padding-left: 7px;
        padding-right: 5px;
    }
    input[type="checkbox"]:hover  {
        cursor: pointer;
    }
</style>
@endsection
@section('content')
    <div class="box news-form">
        <div class="box-header with-border">
              <h3 class="box-title">@yield('title')</h3>
        </div>
        <div class="box-body" >
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @if (!empty($role))
                    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
                    @else
                    {!! Form::open(['route' => ['roles.store']]) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Name"]) !!}
                    </div>
                    <div class="form-group">
                        @if (empty($role) || $role->id != config("constants.SUPERADMIN_ROLE_ID"))
                        <h4><input type="checkbox" class="checkAll" onclick="checkAll(this);" /> <i class="fa fa-key"></i>Permission</h4>
                        <div class="trew">
                            @foreach ($permissions as $key => $permission)
                            @if (!empty(array_filter($permission)))
                            <li class="trew-parent" >
                                <input type="checkbox" onclick="checkChildren('{{ $key }}', this)" class="" id="parent_{{ $key }}">
                                <a href="javascript:void(0);" onclick="toggleRole('{{ $key }}')">
                                    <i class="fa fa-folder-open" id="folder_{{ $key }}"></i>
                                    <span>{{ $key }}</span>
                                </a>
                               
                               <ul class="trew-chirent" id="chirent_key_{{ $key }}">
                                    @foreach ($permission as $key_item => $item)
                                   <li>
                                    <input @if (!empty($role)) @if (count($role->permissions) > 0) {{ in_array($key.'.'.$item, $role->permissions)?'checked':''}} @endif @endif  value="{{ $key.'.'.$item }}" id="permission_check_{{ $key_item.'_'.$key }}" type="checkbox" name="permissions[]" class="check_children_{{ $key }} checkbox_checked_{{ $key }} checkboxs" onclick="checkAllChildrenCheckParent('{{ $key }}')">
                                    <a href="javascript:void(0);" onclick="checkItemChildren('{{ $key_item.'_'.$key }}', '{{ $key }}', this)">
                                        <i class="fa fa-file-code-o"></i>
                                        <span>{{ $item }}</span>
                                    </a>
                                    </li>
                                   @endforeach
                               </ul>
                            </li>
                            @else
                            <li class="trew-parent">
                                <input type="checkbox" name="permissions[]" id="permission_check_parent{{ $key }}" class="checkboxs" onclick="checkChildren('{{ $key }}', this)" @if (!empty($role)) {{ in_array($key, $role->permissions)?'checked':''}} @endif value="{{ $key }}">
                                <a href="javascript:void(0);" onclick="checkItemParentNotChildren('{{ $key }}', this)">
                                    <i class="fa fa-file-code-o"></i>
                                    <span>{{ $key }}</span>
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2 margin-b-5">{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}</div>
                            <div class="col-sm-2 margin-b-5"><a href="{{ route("roles.index") }}" class="btn btn-primary form-control">Back</a></div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('footer')
<script src="js/checkRole.js"></script>
<script>
    $(window).on("load", function() {
        @foreach($permissions as $key => $permission)
        @if (count($permission) >= 1)
            checkAllChildrenCheckParent('{{ $key }}');
        @endif
        @endforeach
    });
</script>
@endsection