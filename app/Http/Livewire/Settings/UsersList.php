<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use File;

class UsersList extends Component
{

    use WithFileUploads;

    public $name , $email , $password , $role , $userID , $profilImage;
    public $rules = [
        'role' => "required",

    ];
    public function render()
    {
        $users = User::whereRoleIs(['admin','comptable'])->get();
        $roles = Role::all();
        return view('livewire.settings.users-list',['users'=>$users,'roles'=>$roles]);
    }

    
   public function resetInputs(){
    $this->name="";
    $this->email="";
    $this->password="";
   }
    public function saveData(){
        $this->validate([
            'name'=> 'required',
            'email'=> 'required|email',
            'profilImage' => 'image|mimes:jpeg,jpg,png',
            'password'=> 'required',

        ]);
       
        $imageNmae = $this->profilImage->store('images/userProfilImage', 'public'); 
        $user = new User;
        $user->name = $this->name;
        $user->image = $imageNmae;
        $user->email = $this->email;
        $user->password =  Hash::make($this->password);
        $userAdded = $user->save();
        if($userAdded){
            $user->attachRole($this->role);
            // for hidden the model
              $this->dispatchBrowserEvent('close-model');
              $this->dispatchBrowserEvent('add');
              session()->flash('message', 'user bien ajouter');
              $this->resetInputs();
            
            
        }else{
            session()->flash('error', 'something goes wrong');
            $this->resetInputs();
            // for hidden the model
            $this->dispatchBrowserEvent('close-model');
        }
    }

    public function deleteUser($id){

        $user = User::where('id',$id)->first();
        $this->userID = $user->id;

    }
    public function deleteUserData(){
        $user = User::where('id', $this->userID)->first();
      
       try{
        $path = Storage::disk('local')->url($user->image);
        File::delete(public_path($path));
        $role = $user->roles;
        $user->detachRole($role[0]->name);
        $deletedUser = $user->delete();
       
        session()->flash('message','user bien supprimer');
            $this->dispatchBrowserEvent('add');
       }catch(Exception $e){
               
            session()->flash('Error','something goes wrong try agin');
            $this->dispatchBrowserEvent('add');
       }
            
       
       
    }

    public function editUser($id){
        $user = User::where('id',$id)->first();
        $this->userID = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        
    }

    public function editUserData(){
        $this->validate();
        $user = User::where('id',$this->userID )->first();
        $role = $user->roles;
        $user->id = $this->userID ;
        $user->name = $this->name ;
        $user->email = $this->email ;
        $user->password =  Hash::make($this->password);
        $userAdded = $user->save();
        $user->detachRole($role[0]->name);
        if($userAdded){
            $user->attachRole($this->role);
            // for hidden the model
            
              $this->dispatchBrowserEvent('close-model');
              $this->dispatchBrowserEvent('add');
            session()->flash('message', 'user bien modifier');
            $this->resetInputs();
            
            
        }else{
            session()->flash('error', 'something goes wrong');
            $this->resetInputs();
            // for hidden the model
            $this->dispatchBrowserEvent('close-model');
        }



    }
}
