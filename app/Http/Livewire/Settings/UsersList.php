<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersList extends Component
{

    public $name , $email , $password , $role;
    public function render()
    {
        $users =  User::whereRoleIs('admin')->get();
        $roles = Role::all();
        return view('livewire.settings.users-list',['users'=>$users,'roles'=>$roles]);
    }

    public function saveData(){
        $this->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required',

        ]);

        $user = new User;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password =  Hash::make($this->password);
        $userAdded = $user->save();
        if($userAdded){
            $user->attachRole($this->role);
            session()->flash('message', 'user bien ajouter');
            $this->dispatchBrowserEvent('add');
        }else{
            session()->flash('error', 'something goes wrong');
        }
    }
}
