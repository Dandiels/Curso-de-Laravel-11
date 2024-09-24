@extends('admin.layouts.app')

@section('title', 'Cadastro')

@section('content')

    <h1>Novo Usuário</h1>

    {{-- @include('admin.includes.alert') --}}

    <form action="{{ route('users.store') }}" method="POST">
        @include('admin.users.partials.form')
    </form>

@endsection