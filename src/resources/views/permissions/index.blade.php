@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Permissions"))

@section('content')

    <page :custom-render="customRender"
        v-cloak>
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
            <data-table source="/system/permissions"
                id="permission-table">
            </data-table>
        </div>
    </page>

@endsection

@push('scripts')

    <script>

        const vm = new Vue({
            el: '#app',

            methods: {
                customRender: function(column, data, type, row, meta) {
                    switch(column) {
                        case 'type':
                            return data == 'Read' || data == 'Citire' ? '<span class="label bg-green">' + data + '</span>'
                                : '<span class="label bg-orange">' + data + '</span>';
                        case 'default':
                            return data == 'Yes' || data == 'Da' ? '<span class="label bg-green">' + data + '</span>'
                                : '<span class="label bg-orange">' + data + '</span>';
                        default:
                            toastr.warning('render for column ' + column + ' is not defined.' );
                            return data;
                    }
                }
            }
        });

    </script>

@endpush