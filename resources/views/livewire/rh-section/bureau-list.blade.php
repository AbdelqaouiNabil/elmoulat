<div>
    <div class="contents">
        <div class="container-fluid">
    
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">
    
                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Bureaus</h4>

                       
                           
                            <div class="breadcrumb-action justify-content-center flex-wrap">
    
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
        @if(session()->has('error'))
        <div class="alert alert-danger">
    
            {{ session('error') }}

        </div>
        @endif
        <div class="container-fluid">
            <div class="action-btn mb-3">

                <button type="button" class=" btn btn-sm btn-danger btn-add  " @if($bulkDisabled) disabled @endif data-target="#modal-all-delete" data-toggle="modal" >
                                          
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
                                            <span class="userDatatable-title">Nome de Bureau</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Ville de Bureau</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Phone number</span>
                                        </th>
                                       
                                        <th>
                                            <span class="userDatatable-title">Actions</span>
                                        </th>
                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @if ($bureaus->count() > 0)
    
                                        @foreach ($bureaus as $bureau)
                                            <tr>
                                                <td>
                                            
                                                    <input  type="checkbox" wire:model="selectRows" value="{{$bureau->id}}"  >
                                                    
                                                </td>
                                               
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $bureau->id }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $bureau->nom }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $bureau->ville }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $bureau->phone }}
                                                    </div>
                                                </td>
                                                
    
                                               
                                                <td>
                                                    <ul class="orderDatatable_actions mb-0 d-flex">
                                    
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#edit-modal"
                                                                wire:click='edit({{ $bureau->id }})'><i
                                                                    class="fa-regular fa-pen-to-square"></i></a></li>
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#modal-info-delete"
                                                                wire:click='delete({{ $bureau->id }})'
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

        {{-- add domaine  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">
    
    
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">
    
    
    
                        <h6 class="modal-title">Ajouter Nouveau Bureau </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                      
    
                            <form enctype="multipart/form-data">
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Nom de Bureau</label>
                                        <input class="form-control form-control-lg" type="text" name="name"
                                            wire:model.defer='name'>
                                        @error('name')
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
                                        <label>Phone</label>
                                        <input class="form-control form-control-lg" type="number" name="phone"
                                            wire:model.defer='phone'>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
                                   
                                </div>
                                
                       
    
    
                    </div>
                    <div class="modal-footer">
                        <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Enregistrer Bureau</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    
    
    
    
    
    
        {{-- edit domaine model --}}
    
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
                                        <label>Nom de Domaine</label>
                                        <input class="form-control form-control-lg" type="text" name="name"
                                            wire:model.defer='name'>
                                        @error('name')
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
                                        <label>Phone</label>
                                        <input class="form-control form-control-lg" type="number" name="phone"
                                            wire:model.defer='phone'>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        
                                    </div>
                                   
                                </div>
                                
                        </div>
    
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" wire:click.prevent='editData()'> Save Bureau</button>
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
                                <h6>Voulez-vous supprimer ce bureau</h6>
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
                            <h6>Voulez-vous supprimer ce bureau</h6>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger btn-outlined btn-sm"
                        data-dismiss="modal">annuler</button>
                    <button type="button" wire:click.prevent='deleteSelectedRows()'
                        class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

                </div>
            </div>
        </div>


    </div>
    
        <!-- ends: .modal-info-Delete -->
    
    
    
    
    </div>
    </div>
    </div>
    
    