@extends('admin.layouts.app')

@section('title', 'Detalhes do Usuário')

@section('content')

    <ul>
        <li>Nome: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
    </ul>

    <x-alert/>

    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf()
        @method('delete')
        <button type="submit">Deletar</button>
    </form>

@endsection