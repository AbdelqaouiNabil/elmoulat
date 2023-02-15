<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\Role;

class RolesList extends Component
{
    public function render()
    {
        $permissions=Permission::all();
        $roles = Role::all();
        return view('livewire.settings.roles-list',['roles'=>$roles,'permissions'=>$permissions]);
    }
}
