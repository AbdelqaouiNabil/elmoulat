<div>
    <div class="contents">
        <div class="container-fluid">
    
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">
    
                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Ouvriers</h4>

                       
                           
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

                <button type="button" class=" btn btn-sm btn-danger btn-add  " @if($btndelete) disabled @endif data-target="#modal-all-delete" data-toggle="modal" >
                                          
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
                                        
                                        <th>
                                            <input type="checkbox" wire:model="selectAll">
                                        </th>
                                        
                                        <th>
                                            <span class="userDatatable-title">id</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Nome de ouvrier</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">date de naissance </span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">cin</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">numero cin</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">date dubet</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">observation</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">notation</span>
                                        </th>
                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @if ($ouvriers->count() > 0)
    
                                        @foreach ($ouvriers as $ouvrier)
                                            <tr>
                                                <td>
                                            
                                                    <input  type="checkbox" wire:model="checked_id" value="{{$ouvrier->id}}"  >
                                                    
                                                </td>
                                               
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $ouvrier->id }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $ouvrier->nom }}
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $ouvrier->datenais }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                       <a href=" {{ Storage::disk('local')->url($ouvrier->cin) }}" target="_blank" type="application/pdf" style="color: red; font-size:20px;"><i class="fa-solid fa-file-pdf"></i></a>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $ouvrier->n_cin }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $ouvrier->datedubet }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $ouvrier->observation }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $ouvrier->notation }}
                                                    </div>
                                                </td>
                                               
    
                                               
                                                <td>
                                                    <ul class="orderDatatable_actions mb-0 d-flex">
                                    
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#edit-modal"
                                                                wire:click='editOuvrier({{ $ouvrier->id }})'><i
                                                                    class="fa-regular fa-pen-to-square"></i></a></li>
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#modal-info-delete"
                                                                wire:click='deleteOuvrier({{ $ouvrier->id }})'
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
                                        <a href="#" class="atbd-pagination__link pagination-control"><span
                                                class="la la-angle-left"></span></a>
                                        <a href="#" class="atbd-pagination__link"><span
                                                class="page-number">1</span></a>
                                        <a href="#" class="atbd-pagination__link active"><span
                                                class="page-number">2</span></a>
                                        <a href="#" class="atbd-pagination__link"><span
                                                class="page-number">3</span></a>
                                        <a href="#" class="atbd-pagination__link pagination-control"><span
                                                class="page-number">...</span></a>
                                        <a href="#" class="atbd-pagination__link"><span
                                                class="page-number">12</span></a>
                                        <a href="#" class="atbd-pagination__link pagination-control"><span
                                                class="la la-angle-right"></span></a>
                                        <a href="#" class="atbd-pagination__option">
                                        </a>
                                    </li>
                                    <li class="atbd-pagination__item">
                                        <div class="paging-option">
                                            <select name="page-number" class="page-selection">
                                                <option value="20">20/page</option>
                                                <option value="40">40/page</option>
                                                <option value="60">60/page</option>
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
    
                                        <label>Importer des Ouvriers depuis un fichier xlxs</label>
                                        <input class="form-control form-control-lg" type="file" name="excelFile"
                                            wire:model.defer='excelFile'>
                                        @error('excelFile')
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
    
    
    
                        <h6 class="modal-title">Ajouter Nouveau Ouvrier</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
    
                            <form enctype="multipart/form-data">
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Nom de ouvrier</label>
                                        <input class="form-control form-control-lg" type="text" name="nom"
                                            wire:model.defer='nom'>
                                        @error('nom')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
    
                                  
    
                                    <div class="form-group mb-25">
                                        <label>date de naissance</label>
                                        <input class="form-control form-control-lg" type="date" name="datenais"
                                            wire:model.defer='datenais'>
                                        @error('datenais')
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
                                        <label>date de dubet</label>
                                        <input class="form-control form-control-lg" type="date" name="datedubet"
                                            wire:model.defer='datedubet'>
                                        @error('datedubet')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>observation</label>
                                        <input class="form-control form-control-lg" type="text" name="observation"
                                            wire:model.defer='observation'>
                                        @error('observation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>notation</label>
                                        <input class="form-control form-control-lg" type="number" name="notation"
                                            wire:model.defer='notation'>
                                        @error('notation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    
                                   
                                </div>
                                
                        </div>
    
    
                    </div>
                    <div class="modal-footer">
                        <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Enregistrer Ouvrier</button>
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
    
    
    
                        <h6 class="modal-title">Edit Ouvrier</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
    
                            <form >
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Nom de ouvrier</label>
                                        <input class="form-control form-control-lg" type="text" name="nom"
                                            wire:model.defer='nom'>
                                        @error('nom')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
    
                                  
    
                                    <div class="form-group mb-25">
                                        <label>date de naissance</label>
                                        <input class="form-control form-control-lg" type="date" name="datenais"
                                            wire:model.defer='datenais'>
                                        @error('datenais')
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
                                        <input class="form-control form-control-lg" type="number" name="n_cin"
                                            wire:model.defer='n_cin'>
                                        @error('n_cin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>date de dubet</label>
                                        <input class="form-control form-control-lg" type="date" name="datedubet"
                                            wire:model.defer='datedubet'>
                                        @error('datedubet')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>observation</label>
                                        <input class="form-control form-control-lg" type="text" name="observation"
                                            wire:model.defer='observation'>
                                        @error('observation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>notation</label>
                                        <input class="form-control form-control-lg" type="number" name="notation"
                                            wire:model.defer='notation'>
                                        @error('notation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                   
                                </div>
                                
                        </div>
    
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" wire:click.prevent='editData()'> Save changes</button>
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



        <div wire:ignore.self class="modal-info-delete modal fade show" id="modal-all-delete" tabindex="-1"
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
                    <button type="button" wire:click.prevent='deletecheckedouvrier()'
                        class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

                </div>
            </div>
        </div>


    </div>
    
        <!-- ends: .modal-info-Delete -->
    
    
    
    
    </div>
    </div>
    </div>
    
    