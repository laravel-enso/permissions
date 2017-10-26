@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Permissions"))

@section('content')

    <page v-cloak>
        <span slot="header">
            <a class="btn btn-primary" href="/system/permissions/create">
                {{ __("Create Permission") }}
            </a>
            <a class="btn btn-primary" href="/system/permissionGroups/create">
                {{ __("Create Group") }}
            </a>
        </span>
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <box theme="primary"
                collapsible removable border open
                title="{{ __('Create Resource Permissions') }}">
                {!! Form::open(['method' => 'POST', 'url' => '/system/resourcePermissions']) !!}
                    @include('laravel-enso/permissionmanager::permissions.resourceForm')
                    <center>
                        {!! Form::submit(__("Save"), ['class' => 'btn btn-primary ']) !!}
                    </center>
                {!! Form::close() !!}
            </box>
        </div>
    </page>

@endsection

@push('scripts')

    <script>

        const vm = new Vue({
            el: '#app',

            data: {
                options: {!! $permissionGroups !!},
                permissionGroupId: "{!! old('permission_group_id') !!}" || null
            }
        });

    </script>

@endpush