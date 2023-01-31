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

         <button type="button" class="@if($bulkDisabled) disabled @endif btn btn-sm btn-danger" wire:click="deleteSelected"
                                   >
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
                                        <span class="userDatatable-title">Nome de projet</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">image</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">ville</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">adress</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">consistance</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">titre_finance</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">autorisation</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">superfice</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">date de debut</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title">date de fin</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title float-right">Bureau</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title float-right">Caisse</span>
                                    </th>
                                    <th>
                                        <span class="userDatatable-title float-right">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($projets->count() > 0)

                                    @foreach ($projets as $projet)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                   <input type="checkbox" wire:model="selectedProjects" value="{{ $projet->id }}" >
  
                                                  </div> 
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->id }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    <img src="{{ Storage::disk('local')->url($projet->image) }}"
                                                        width="100" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->ville }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->adress }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->consistance }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->titre_finance }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->autorisation }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->superfice }}
                                                </div>
                                            </td>

                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->datedebut }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->datefin }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->bureau->nom }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $projet->caisse->id }}
                                                </div>
                                            </td>

                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex">
                                
                                                    <li><a href="#" class="remove" data-toggle="modal"
                                                            data-target="#edit-modal"
                                                            wire:click='editProject({{ $projet->id }})'><i
                                                                class="fa-regular fa-pen-to-square"></i></a></li>
                                                    <li><a href="#" class="remove" data-toggle="modal"
                                                            data-target="#modal-info-delete"
                                                            wire:click='deleteProject({{ $projet->id }})'
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
                                      {{ $projets->links('vendor.livewire.bootstrap') }}
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

                                    <label>Importer des projets depuis un fichier xlxs</label>
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

    {{-- add project  modal --}}
    <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
        aria-hidden="true">


        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content modal-bg-white ">
                <div class="modal-header">



                    <h6 class="modal-title">Ajouter Nouveau Projet</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span data-feather="x"></span></button>
                </div>
                <div class="modal-body">
                    

                        <form enctype="multipart/form-data">
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Nom de projet</label>
                                    <input class="form-control form-control-lg" type="text" name="name"
                                        wire:model.defer='name'>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    
                                </div>

                                <div class="form-group mb-25">

                                    <label>image</label>
                                    <input class="form-control form-control-lg" type="file" name="image"
                                        wire:model.defer='image'>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    {{-- @if ($image)

                                                Photo Preview:

                                                     <img src="{{ $image->temporaryUrl() }}" width="100">

                                             @endif --}}
                                </div>

                                <div class="form-group mb-25">
                                    <label>consistance</label>
                                    <input class="form-control form-control-lg" type="text" name="consistance"
                                        wire:model.defer='consistance'>
                                    @error('consistance')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>titre_finance</label>
                                    <input class="form-control form-control-lg" type="text" name="titre_finance"
                                        wire:model.defer='titre_finance'>
                                    @error('titre_finance')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>superfice</label>
                                    <input class="form-control form-control-lg" type="text" name="superfice"
                                        wire:model.defer='superfice'>
                                    @error('superfice')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>adress</label>
                                    <input class="form-control form-control-lg" type="text" name="adress"
                                        wire:model.defer='adress'>
                                    @error('adress')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>ville</label>
                                    <input class="form-control form-control-lg" type="text" name="ville"
                                        wire:model.defer='ville'>
                                    @error('ville')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>autorisation</label>
                                    <input class="form-control form-control-lg" type="text" name="autorisation"
                                        wire:model.defer='autorisation'>
                                    @error('autorisation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Date de commencement</label>
                                    <input class="form-control form-control-lg" type="date"
                                        wire:model.defer='dated' name="dated">
                                    <div class="form-inline-action d-flex justify-content-between align-items-center">
                                    </div>
                                    @error('dated')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-25">
                                <label>Date de fin</label>
                                <input class="form-control form-control-lg" type="date" wire:model.defer='datef'
                                    name="datef">
                                <div class="form-inline-action d-flex justify-content-between align-items-center">
                                </div>
                                @error('datef')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-25">
                                <label>Bureau </label>
                                <select name="select-size-1" wire:model.defer='id_bureau' id="select-size-1" class="form-control  form-control-lg">
                                    <option value="" selected>select an option</option>
                                @foreach($bureaus as $bureau)
                                    <option value="{{$bureau->id}}">{{$bureau->nom}}</option>
                                    
                                @endforeach
                                    
                                </select>
                                @error('id_bureau')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            </div>
                            <div class="form-group mb-25">
                                <label>Caisse </label>
                                <select name="select-size-1" wire:model.defer='id_caisse' id="select-size-1" class="form-control  form-control-lg">
                                    <option value="" selected>select an option</option>
                                @foreach($caisses as $caisse)
                                    <option value="{{$caisse->id}}">{{$caisse->id}}</option>
                                    
                                @endforeach
                                    
                                </select>
                                @error('id_caisse')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            </div>
                    </div>


              
                <div class="modal-footer">
                    <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Enregistrer projet</button>
                </div>
                </form>
            </div>
        </div>
    </div>






    {{-- edit project model --}}

    <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
        aria-hidden="true">

             <div class="modal-dialog modal-md" role="document">
            <div class="modal-content modal-bg-white ">
                <div class="modal-header">



                    <h6 class="modal-title">Ajouter Nouveau Projet</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span data-feather="x"></span></button>
                </div>
                <div class="modal-body">

                        <form wire:submit.prevent='editData'>
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Nom de projet</label>
                                    <input class="form-control form-control-lg" type="text" name="name"
                                        wire:model.defer='name'>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group mb-25">
                                    <label>consistance</label>
                                    <input class="form-control form-control-lg" type="text" name="consistance"
                                        wire:model.defer='consistance'>
                                    @error('consistance')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>titre_finance</label>
                                    <input class="form-control form-control-lg" type="text" name="titre_finance"
                                        wire:model.defer='titre_finance'>
                                    @error('titre_finance')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>superfice</label>
                                    <input class="form-control form-control-lg" type="text" name="superfice"
                                        wire:model.defer='superfice'>
                                    @error('superfice')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>adress</label>
                                    <input class="form-control form-control-lg" type="text" name="adress"
                                        wire:model.defer='adress'>
                                    @error('adress')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>ville</label>
                                    <input class="form-control form-control-lg" type="text" name="ville"
                                        wire:model.defer='ville'>
                                    @error('ville')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>autorisation</label>
                                    <input class="form-control form-control-lg" type="text" name="autorisation"
                                        wire:model.defer='autorisation'>
                                    @error('autorisation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Date de commencement</label>
                                    <input class="form-control form-control-lg" type="date"
                                        wire:model.defer='dated' name="dated">
                                    <div class="form-inline-action d-flex justify-content-between align-items-center">
                                    </div>
                                    @error('dated')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                          
                            <div class="form-group mb-25">
                                <label>Date de fin</label>
                                <input class="form-control form-control-lg" type="date" wire:model.defer='datef'
                                    name="datef">
                                <div class="form-inline-action d-flex justify-content-between align-items-center">
                                </div>
                                @error('datef')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-25">
                                <label>Bureau </label>
                                <select name="select-size-1" wire:model.defer='id_bureau' id="select-size-1" class="form-control  form-control-lg">
                                    <option value="" selected>select an option</option>
                                @foreach($bureaus as $bureau)
                                    <option value="{{$bureau->id}}">{{$bureau->name}}</option>
                                    
                                @endforeach
                                    
                                </select>
                                @error('id_bureau')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            </div>
                            <div class="form-group mb-25">
                                <label>Caisse </label>
                                <select name="select-size-1" wire:model.defer='id_caisse' id="select-size-1" class="form-control  form-control-lg">
                                    <option value="" selected>select an option</option>
                                @foreach($caisses as $caisse)
                                    <option value="{{$caisse->id}}">{{$caisse->id}}</option>
                                    
                                @endforeach
                                    
                                </select>
                                @error('id_caisse')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                            </div>
                    </div>

 
              
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm">Enregistrer projet</button>
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
                            <h6>Voulez-vous supprimer ce projet</h6>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger btn-outlined btn-sm"
                        data-dismiss="modal">annuler</button>
                    <button type="button" wire:click.prevent='deleteData'
                        class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

                </div>
            </div>
        </div>


    </div>

    <!-- ends: .modal-info-Delete -->




</div>
</div>
</div>

