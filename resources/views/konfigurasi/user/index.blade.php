@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Pengguna</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <x-card>
                <x-slot name="header">
                    Daftar Pengguna
                </x-slot>

                <x-table id="userTable" class="userTable" style="width: 100%">
                    <x-slot name="thead">
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </x-slot>
                </x-table>
            </x-card>
        </div>
    </div>
    @include('konfigurasi.user.form')
@endsection

@include('konfigurasi.user.scripts')
