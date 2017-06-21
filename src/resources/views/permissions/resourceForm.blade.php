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
<div class="col-sm-3">
    <div class="form-group{{ $errors->has('dataTables') ? ' has-error' : '' }}">
        {!! Form::label('dataTables', __("Data Tables")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('dataTables') }}
        </small>
        <input type="checkbox" name="dataTables">
    </div>
</div>
<div class="col-sm-3">
    <div class="form-group{{ $errors->has('vueSelect') ? ' has-error' : '' }}">
        {!! Form::label('vueSelect', __("Vue Select")) !!}
        <small class="text-danger" style="float:right;">
            {{ $errors->first('vueSelect') }}
        </small>
        <input type="checkbox" name="vueSelect">
    </div>
</div>