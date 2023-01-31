<div>
    <div class="contents">
        <div class="container-fluid">
    
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">
    
                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title"></h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">
    
                                <div class="dropdown action-btn">
                                    <button class="btn btn-sm btn-default btn-white dropdown-toggle" type="button"
                                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="la la-download"></i> Exporter
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <span class="dropdown-item">Exporter</span>
                                        <div class="dropdown-divider"></div>
                                        <a href="" class="dropdown-item">
                                            <i class="la la-print"></i> Printer</a>
                                        <a href="" class="dropdown-item">
                                            <i class="la la-file-pdf"></i> PDF</a>
                                        <i class="la la-file-excel"></i> Excel (XLSX)</a>
                                        <a href="" class="dropdown-item">
                                            <i class="la la-file-csv"></i> CSV</a>
                                    </div>
                                </div>
                                  <div class="action-btn">
    
                                    <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                        data-target="#modal-import">
                                        <i class="la la-plus"></i>importer</button>
                            
                                </div>
    
                                <div class="action-btn">
    
                                    <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                        data-target="#modal-basic">
                                        <i class="la la-plus"></i>Ajouter</button>
    
    
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success">
    
                {{ session('message') }}
    
            </div>
        @endif
        <div class="container-fluid">
           
         <div class="action-btn mb-3">
    
            <button type="button" class=" btn btn-sm btn-danger btn-add  " @if($bulkDisabled) disabled @endif data-toggle="modal" data-target="#modal-all-delete" >
             <i class="la la-trash"></i>delete selected</button>
    
            </div>
            <div class="row">
                <div class="col-lg-12">
               
                    <div
                        class="userDatatable orderDatatable shipped-dataTable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless border-0">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th >
                                          
                                                 <div class="form-check">
                                                   <input  type="checkbox" wire:model="selectAll" >
                                                
      
                                                    </div>
             
                                           
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">id</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Nome de client</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">CIN</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Numero de CIN</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Email</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Phone</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Ville de Residance</span>
                                        </th>
                                        
                                        <th>
                                            <span class="userDatatable-title float-right">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @if ($clients->count() > 0)
    
                                        @foreach ($clients as $client)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                       <input type="checkbox" wire:model="selectedClients" value="{{ $client->id }}" >
      
                                                      </div> 
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $client->id }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $client->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                       <a href=" {{ Storage::disk('local')->url($client->cin) }}" target="_blank" type="application/pdf" style="color: red; font-size:20px;"><i class="fa-solid fa-file-pdf"></i></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $client->n_cin }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $client->email }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $client->phone }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $client->ville_de_resi }}
                                                    </div>
                                                </td>
                                                
    
                                                <td>
                                                    <ul class="orderDatatable_actions mb-0 d-flex">
                                    
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                            data-target="#edit-modal"
                                                            wire:click='editClient({{ $client->id }})'><i
                                                                class="fa-regular fa-pen-to-square"></i></a></li>
                                                    <li><a href="#" class="remove" data-toggle="modal"
                                                            data-target="#modal-info-delete"
                                                            wire:click='deleteClient({{ $client->id }})'
                                                            style="color: red;"><i class="fa-solid fa-trash"></i></a>
                                                    </li>
    
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
    
                                       
                                    @else
                                    @endif
    
                                    <!-- End: tr -->
    
    
    
    
    
    
    
                                </tbody>
                            </table><!-- End: table -->
                        </div>
                        <div class="d-flex justify-content-sm-end justify-content-start mt-15 pt-25 border-top">
       
                            <nav class="atbd-page ">
                                <ul class="atbd-pagination d-flex">
                                    <li class="atbd-pagination__item">
                                          {{ $clients->links('vendor.livewire.bootstrap') }}
                                    </li>
                                    <li class="atbd-pagination__item">
                                        <div class="paging-option">
                                            <select wire:model="pages" name="page-number" class="page-selection">
                                                <option value="5">5/page</option>
                                                <option value="10">10/page</option>
                                                <option value="20">20/page</option>
                                                <option value="40">40/page</option>
                                            </select>
                                        </div>
                                    </li>
                                </ul>
                            </nav>
    
    
                        </div>
                    </div><!-- End: .userDatatable -->
                </div><!-- End: .col -->
            </div>
        </div>
    {{-- import modal start --}}
    <div wire:ignore.self class="modal-info-delete modal fade show" id="modal-import" tabindex="-1"
            role="dialog" aria-hidden="true">
    
    
            <div class="modal-dialog modal-dialog-centered modal-info" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-info-body d-flex">
                            <div class="modal-info-icon warning">
                                <span data-feather="info"></span>
                            </div>
                               <form  enctype="multipart/form-data">
                                    <div class="form-group mb-25">
    
                                        <label>Importer des clients depuis un fichier xlxs</label>
                                        <input class="form-control form-control-lg" type="file" name="exelFile"
                                            wire:model.defer='exelFile'>
                                        @error('exelFile')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                     
                                    </div>
                                  
                        </div>
                    </div>
                    <div class="modal-footer">
    
                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">Annuler</button>
                        <button type="submit" wire:click.prevent='importData' class="btn btn-success btn-outlined btn-sm" >importer</button>
    
                    </div>
                    </form>
                </div>
            </div>
    
    
        </div>
    
    
    
    
          
    {{-- import modal end --}}

    {{-- this for delete all selected items --}}

   <div wire:ignore.self class="modal-info-delete modal fade show" id="modal-all-delete" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-info" role="document">
       <div class="modal-content">
           <div class="modal-body">
               <div class="modal-info-body d-flex">
                   <div class="modal-info-icon warning">
                       <span data-feather="info"></span>
                   </div>

                   <div class="modal-info-text">
                       <h6>Voulez-vous supprimer ce Ouvrier</h6>
                   </div>

               </div>
           </div>
           <div class="modal-footer">

               <button type="button" class="btn btn-danger btn-outlined btn-sm"
                   data-dismiss="modal">annuler</button>
               <button type="button" wire:click.prevent='deleteSelected()' 
                   class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

           </div>
       </div>
   </div>


  </div>
    
        {{-- add Client  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">
    
    
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">
    
    
    
                        <h6 class="modal-title">Ajouter Nouveau client</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
    
                            <form enctype="multipart/form-data">
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Nom de Client</label>
                                        <input class="form-control form-control-lg" type="text" name="name"
                                            wire:model.defer='name'>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
    
                                  
    
                                   
                                    <div class="form-group mb-25">
                                        <label>CIN</label>
                                        <input class="form-control form-control-lg" type="file" name="cin"
                                            wire:model.defer='cin'>
                                            @error('cin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Numero CIN</label>
                                        <input class="form-control form-control-lg" type="text" name="n_cin"
                                            wire:model.defer='n_cin'>
                                        @error('n_cin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Email</label>
                                        <input class="form-control form-control-lg" type="email" name="email"
                                            wire:model.defer='email'>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-25">
                                        <label>Phone Number</label>
                                        <input class="form-control form-control-lg" type="number" name="phone"
                                            wire:model.defer='phone'>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Ville de Residance</label>
                                        <input class="form-control form-control-lg" type="text" name="ville_de_resi"
                                            wire:model.defer='ville_de_resi'>
                                        @error('ville_de_resi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                   
                                </div>
                                
                        </div>
    
    
                    </div>
                    <div class="modal-footer">
                        <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Enregistrer Client</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    

         {{-- delete model  --}}
    
        
    
       <div wire:ignore.self class="modal-info-delete modal fade show" id="modal-info-delete" tabindex="-1"
       role="dialog" aria-hidden="true">


       <div class="modal-dialog modal-sm modal-info" role="document">
           <div class="modal-content">
               <div class="modal-body">
                   <div class="modal-info-body d-flex">
                       <div class="modal-info-icon warning">
                           <span data-feather="info"></span>
                       </div>

                       <div class="modal-info-text">
                           <h6>Voulez-vous supprimer ce Ouvrier</h6>
                       </div>

                   </div>
               </div>
               <div class="modal-footer">

                   <button type="button" class="btn btn-danger btn-outlined btn-sm"
                       data-dismiss="modal">annuler</button>
                   <button type="button" wire:click.prevent='deleteData()'
                       class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

               </div>
           </div>
       </div>


   </div>
    
    
    
    
    
        {{-- edit project model --}}
    
        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">
    
                 <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">
    
    
    
                        <h6 class="modal-title">Edit Nouveau Client</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
    
                            <form wire:submit.prevent='editData'>
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Nom de Client</label>
                                        <input class="form-control form-control-lg" type="text" name="name"
                                            wire:model.defer='name'>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
    
                                  
    
                    
                                    <div class="form-group mb-25">
                                        <label>Numero CIN</label>
                                        <input class="form-control form-control-lg" type="text" name="n_cin"
                                            wire:model.defer='n_cin'>
                                        @error('n_cin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Email</label>
                                        <input class="form-control form-control-lg" type="email" name="email"
                                            wire:model.defer='email'>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mb-25">
                                        <label>Phone Number</label>
                                        <input class="form-control form-control-lg" type="number" name="phone"
                                            wire:model.defer='phone'>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Ville de Residance</label>
                                        <input class="form-control form-control-lg" type="text" name="ville_de_resi"
                                            wire:model.defer='ville_de_resi'>
                                        @error('ville_de_resi')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                        </div>
    
    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Enregistrer client</button>
                    </div>
                    </form>
                </div>
            </div>
           
    
    
        </div>
    
    
       {{-- delete model  --}}
    
        
    
       <div wire:ignore.self class="modal-info-delete modal fade show" id="modal-info-delete" tabindex="-1"
       role="dialog" aria-hidden="true">


       <div class="modal-dialog modal-sm modal-info" role="document">
           <div class="modal-content">
               <div class="modal-body">
                   <div class="modal-info-body d-flex">
                       <div class="modal-info-icon warning">
                           <span data-feather="info"></span>
                       </div>

                       <div class="modal-info-text">
                           <h6>Voulez-vous supprimer ce Ouvrier</h6>
                       </div>

                   </div>
               </div>
               <div class="modal-footer">

                   <button type="button" class="btn btn-danger btn-outlined btn-sm"
                       data-dismiss="modal">annuler</button>
                   <button type="button" wire:click.prevent='deleteData()'
                       class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

               </div>
           </div>
       </div>


   </div>

 

   <!-- ends: .modal-info-Delete -->
    
    
    
    </div>
    </div>
    </div>
    
    