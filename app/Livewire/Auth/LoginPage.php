<?php

namespace App\Livewire\Auth;

use Livewire\Component;

#[Title('Login') ]

class LoginPage extends Component
{
    public $username;
    public $password;

    public function save(){
        $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    

        if( !auth()->attempt(['username' => $this->username, 'password' => $this->password])) {
            session()->flash('error', 'invalid credentials');
            return;   
        }

        return redirect()->intended();
    }
    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
