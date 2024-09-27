<?php

namespace App\DTO;

class UserDTO
{
    public string $name;
    public string $email;
    public ?string $password;

    public function __construct(string $name, string $email, ?string $password)
    {
        $this->name = $name;
        $this->email = $email;
        if ($password)
        {
            $this->password = $password;
        }
        else
        {
            $this->password = null;
        }
    }

    public function toArray(): array
    {
        if ($this->password)
        {
            return
            [
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password
            ];
        }
        else
        {
            return
            [
                'name' => $this->name,
                'email' => $this->email
            ];
        }
    }
}
