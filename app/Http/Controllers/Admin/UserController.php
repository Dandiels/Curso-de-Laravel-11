<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DTO\UserDTO;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $userDTO = new UserDTO($request->validated('name'), $request->validated('email'), $request->validated('password'));
        User::create($userDTO->toArray());
        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit(string $id)
    {
        //$user = User::where('id', '=', $id)->first();
        //$user = User::where('id', $id)->first(); // ->firstOrFail();
        if (!$user = User::find($id))
        {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        if (!$user = User::find($id))
        {
            return back()->with('message', 'Usuário não encontrado!');
        }

        if ($request->password)
        {
            $userDTO = new UserDTO($request->validated('name'), $request->validated('email'), $request->validated('password'));
            $userDTO->password = bcrypt($request->password);
        }
        else
        {
            $userDTO = new UserDTO($request->validated('name'), $request->validated('email'), null);
        }

        $user->update($userDTO->toArray());

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function show(string $id)
    {
        if (!$user = User::find($id))
        {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }

        return view('admin.users.show', compact('user'));
    }

    public function destroy(string $id)
    {
        if (!$user = User::find($id))
        {
            return redirect()->route('users.index')->with('message', 'Usuário não encontrado!');
        }

        if (Auth::id() === $user->id)
        {
            return back()->with('message', 'Você não pode deletar o seu próprio perfil!');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
    }
}
