@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Permissions"))

@section('content')

    <page v-cloak>
        <span slot="header">
            <a class="btn btn-primary" href="/system/permissions/create">
            {{ __("Create Permission") }}
            </a>
            <a class="btn btn-primary" href="/system/resourcePermissions/create">
                {{ __("Create Resource") }}
            </a>
            <a class="btn btn-primary" href="/system/permissionGroups/create">
                {{ __("Create Group") }}
            </a>
        </span>
        <div class="col-md-12">
            <data-table source="/system/permissionGroups"
                id="permission-groups-table">
            </data-table>
        </div>
    </page>

@endsection

@push('scripts')

    <script>

        const vm = new Vue({
            el: '#app'
        });

    </script>

@endpush