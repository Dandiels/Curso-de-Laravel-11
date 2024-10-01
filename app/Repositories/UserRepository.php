<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function paginate($perPage)
    {
        return User::paginate($perPage);
    }

    public function all()
    {
        return User::paginate(15);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(array $data, $id)
    {
        $user = User::find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    public function find($id)
    {
        return User::find($id);
    }
}
