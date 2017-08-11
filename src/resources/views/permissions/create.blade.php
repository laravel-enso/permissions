@extends('laravel-enso/core::layouts.app')

@section('pageTitle', __("Permissions"))

@section('content')

    <page v-cloak>
        <span slot="header">
            <a class="btn btn-primary" href="/system/resourcePermissions/create">
                {{ __("Create Resource") }}
            </a>
            <a class="btn btn-primary" href="/system/permissionGroups/create">
                {{ __("Create Group") }}
            </a>
        </span>
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <vue-form :data="form">
            </vue-form>
        </div>
    </page>

@endsection

@push('scripts')

    <script>

        const vm = new Vue({
            el: '#app',

            data: {
                form: {!! $form !!}
            }
        });

    </script>

@endpush