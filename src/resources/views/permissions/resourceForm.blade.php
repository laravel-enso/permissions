<div class="col-sm-6">
    <div class="form-group{{ $errors->has('prefix') ? ' has-error' : '' }}">
        {!! Form::label('prefix', __("Resource Prefix")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('prefix') }}
        </small>
        {!! Form::text('prefix', null, ['class' => 'form-control', 'placeholder' => __("Completeaza")]) !!}
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group{{ $errors->has('permission_group_id') ? ' has-error' : '' }}">
        {!! Form::label('permission_group_id', __("Permissions Group")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('permission_group_id') }}
        </small>
        {!! Form::select('permission_group_id', $permissionGroups, null, ['class' => 'form-control select']) !!}
    </div>
</div>
<div class="col-sm-12">
    <br>
    @foreach($resources as $resource => $permissions)
        <label><b>{{ __(ucfirst($resource)) }}</b></label>
        <div class="row">
            @foreach($permissions as $permission)
                <div class="col-xs-6 col-sm-3">
                    <div class="form-group">
                        <input type="checkbox" name="{{ $permission['name'] }}" checked>
                        <label>{{ $permission['name'] }}</label>
                    </div>
                </div>
            @endforeach
        </div>
        <hr>
    @endforeach
</div>