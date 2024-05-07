@extends('layouts.app')

@section('title', 'Akses Role')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Akses Role</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <x-card>
                <x-slot name="header">
                    Akses Role
                </x-slot>

                <x-table id="aksesRoleTable" class="aksesRoleTable" style="width: 100%">
                    <x-slot name="thead">
                        <th>No</th>
                        <th>Name</th>
                        <th>Guard Name</th>
                        <th>Action</th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('konfigurasi.aksesrole.form')
@endsection

@include('konfigurasi.aksesrole.scripts')
