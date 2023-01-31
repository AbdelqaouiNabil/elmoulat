<div>
    <aside class="sidebar-wrapper">

        <div class="sidebar sidebar-collapse" id="sidebar">

            <div class="sidebar__menu-group">

                <ul class="sidebar_nav">

                    <li class="menu-title">

                        <span>Main menu</span>

                    </li>

                    

                      <li>

                        <a style="cursor:pointer" wire:click="changeTab('projet')" id="projet" class="$currentTab === 'projet' ? 'active' : ''">

                            <span data-feather="layers" class="nav-icon"></span>

                            <span class="menu-text">Projet</span>

                        </a>

                    </li>

                    <li>

                        <a style="cursor:pointer" wire:click="changeTab('fournisseurs')"  class="$currentTab === 'fournisseurs' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Fournisseurs</span>

                        </a>

                    </li>

                    <li>

                        <a style="cursor:pointer" wire:click="changeTab('ouvriers')" class="$currentTab === 'ouvriers' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Ouvriers</span>

                        </a>

                    </li>

                     <li>

                        <a style="cursor:pointer" wire:click="changeTab('clients')" class="$currentTab === 'clients' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Client</span>

                        </a>

                    </li>
                    <li>

                        <a style="cursor:pointer" wire:click="changeTab('charges')" class="$currentTab === 'charges' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">charges</span>

                        </a>

                    </li>

                    <li class="menu-title m-top-30">

                        <span>Transactions</span>

                    </li>

                      <li>

                        <a style="cursor:pointer" wire:click="changeTab('Compte')" class="$currentTab === 'Compte' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Compte Banquaire</span>

                        </a>

                    </li>

                     <li>

                        <a style="cursor:pointer" wire:click="changeTab('Relever')" class="$currentTab === 'Relever' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Relever Banquaire</span>

                        </a>

                    </li>

                     <li>

                        <a style="cursor:pointer" wire:click="changeTab('chequier')" class="$currentTab === 'chequier' ? 'active' : ''">

                            <span  class="nav-icon"></span>

                            <span class="menu-text">chequier</span>

                        </a>

                    </li>       



                     <li class="menu-title m-top-30">

                        <span>RH</span>

                    </li>


                     <li>

                        <a style="cursor:pointer" wire:click="changeTab('Relever')" class="$currentTab === 'Relever' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Email</span>

                        </a>

                    </li>  
                    <li>

                        <a style="cursor:pointer" wire:click="changeTab('Bureau')" class="$currentTab === 'Bureau' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Bureau</span>

                        </a>

                    </li>  
                    <li>

                        <a style="cursor:pointer" wire:click="changeTab('Employe')" class="$currentTab === 'Employe' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Employe</span>

                        </a>

                    </li> 

                    <li class="menu-title m-top-30">

                        <span>Constant-Section</span>

                    </li>


                    <li>

                        <a style="cursor:pointer" wire:click="changeTab('Domaine')" class="$currentTab === 'Domaine' ? 'active' : ''">

                            <span  class="nav-icon"> <i class="fa-solid fa-book "></i></span>

                            <span class="menu-text">Domaine</span>

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </aside>
         <div>

       
       @if($currentTab === 'projet')
       <livewire:project-section.projects-list>
        
       @endif
       @if($currentTab === 'fournisseurs')
       <livewire:project-section.fournisseurs-list>
        
        
        
       @endif
       @if($currentTab === 'ouvriers')
       <livewire:project-section.ouvriers-list>
        
       @endif
       
       @if($currentTab === 'clients')
       <livewire:client-list>
        
       @endif

       @if($currentTab === 'Domaine')
       <livewire:constant-section.domaine-list>
        
       @endif
       @if($currentTab === 'Bureau')
       <livewire:rh-section.bureau-list>
        
       @endif
       @if($currentTab === 'Employe')
       <livewire:rh-section.employe-list>
       @endif
        @if($currentTab === 'chequier')
       <livewire:transactions.chequier-list>

        
       @endif
       
       @if($currentTab === 'charges')
       <livewire:charges-list>
        
       @endif
       
       </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('close-model', event => {
            $('#modal-basic').modal('hide');
            $('#edit-modal').modal('hide');
            $('#modal-info-delete').modal('hide');
        });


        window.addEventListener('add', event =>{
             Swal.fire(
                  'Super!',
                  'Vous avez ajouter un nouveau projet!',
                'success'
)
        });
    </script>
@endpush