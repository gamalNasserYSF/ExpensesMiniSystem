<?php

namespace App\Http\Controllers\API\Auth;

class Validator extends \GLibs\Validation\ApiValidation
{

    public function url()
    {
        return "api/auth/";
    }

    public function rules()
    {
        if ($this->is('register')) {
            return $this->register();
        } elseif ($this->is('login')) {
            return $this->login();
        }
        return [];
    }

    private function login()
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required',
        ];
    }

    private function register()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ];
    }

}
