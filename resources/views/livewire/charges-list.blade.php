<div>
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
                                            data-target="#modal-basic">
                                            <i class="la la-plus"></i>Ajouter</button>
    
                                    </div>
                                    <div class="action-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#cree-reglement" >
                                            <i class="la la-plus"></i> Créer un Règlement
                                        </button>
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
                    <button type="button" class="@if($bulkDisabled) disabled @endif btn btn-sm btn-danger"
                        wire:click="deleteSelected">
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
    
                                                <div class="form-check">
                                                    <input type="checkbox" wire:model="selectAll">
    
    
                                                </div>
    
    
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">id</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Nome de charge</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">type</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">bon</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">prix HT</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">TVA</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">QT</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">prix TTC</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">MTTTC</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">situation</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Projet</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Fournisseur</span>
                                            </th>
    
                                            <th>
                                                <span class="userDatatable-title float-right">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
    
                                      
                                        @foreach ($charges as $CH)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" wire:model="selectedCharges"
                                                        value="{{ $CH->id }}">
    
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->id }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->name }}
                                                </div>
                                            </td>
    
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->type }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->bon }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->prix_ht }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->tva }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->QT }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->prix_TTC }}
                                                </div>
                                            </td>
    
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->MTTTC }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="orderDatatable-title">
                                                    {{ $CH->situation }}
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <div class="orderDatatable-title">
                                                    {{ $CH->projet()->name }}
                                                </div> --}}
                                            </td>
                                            <td>
                                                {{-- <div class="orderDatatable-title">
                                                    {{ $CH->Fournisseur()->name }}
                                                </div> --}}
                                            </td>
                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex">
    
                                                    <li><a href="#" class="remove" data-toggle="modal"
                                                            data-target="#edit-modal"
                                                            wire:click='editCharge({{ $CH->id }})'><i
                                                                class="fa-regular fa-pen-to-square"></i></a></li>
                                                    <li><a href="#" class="remove" data-toggle="modal"
                                                            data-target="#modal-info-delete"
                                                            wire:click='deleteCharge({{ $CH->id }})' style="color: red;"><i
                                                                class="fa-solid fa-trash"></i></a>
                                                    </li>
    
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                               
    
                                        <!-- End: tr -->
    
                                    </tbody>
                                </table><!-- End: table -->
                            </div>
                            <div class="d-flex justify-content-sm-end justify-content-start mt-15 pt-25 border-top">
    
                                <nav class="atbd-page ">
                                    <ul class="atbd-pagination d-flex">
                                        <li class="atbd-pagination__item">
                                            {{ $charges->links('vendor.livewire.bootstrap') }}
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
    
    
    
            {{-- add Charge  modal --}}
            <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
                aria-hidden="true">
    
    
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header">
                            <h6 class="modal-title">Ajouter Nouveau Charge</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span data-feather="x"></span></button>
                        </div>
                        <div class="modal-body">
    
                                <form enctype="multipart/form-data">
                                    <div class="form-basic">
                                        <div class="form-group mb-25">
                                            <label>Nom de charge</label>
                                            <input class="form-control form-control-lg" type="text" name="name"
                                                wire:model.defer='name'>
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
    
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Type</label>
                                            <input class="form-control form-control-lg" type="text" name="type"
                                                wire:model.defer='type'>
                                            @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>bon</label>
                                            <input class="form-control form-control-lg" type="text" name="bon"
                                                wire:model.defer='bon'>
                                            @error('bon')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>prix_ht</label>
                                            <input class="form-control form-control-lg" type="text" name="prix_ht"
                                                wire:model.defer='prix_ht'>
                                            @error('prix_ht')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>tva</label>
                                            <input class="form-control form-control-lg" type="text" name="tva"
                                                wire:model.defer='tva'>
                                            @error('tva')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>QT</label>
                                            <input class="form-control form-control-lg" type="text" name="QT"
                                                wire:model.defer='QT'>
                                            @error('QT')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>prix_TTC</label>
                                            <input class="form-control form-control-lg" type="text" name="prix_TTC"
                                                wire:model.defer='prix_TTC'>
                                            @error('prix_TTC')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>MTTTC</label>
                                            <input class="form-control form-control-lg" type="text" name="MTTTC"
                                                wire:model.defer='MTTTC'>
                                            @error('MTTTC')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Situation</label>
                                            <input class="form-control form-control-lg" type="text" name="situation"
                                                wire:model.defer='situation'>
                                            @error('situation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25 ">
                                            <label>Projet</label>
                                                <select name="projet_id"  id="select-size-1" wire:model.defer='projet_id' class="form-control  form-control-lg">
                                                    @foreach($projets as $p)
                                                    <option value="{{$p->id}}">{{$p->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                         <div class="form-group mb-25 ">
                                            <label>Fournisseur</label>
                                                <select name="fournisseur_id"  id="select-size-1" wire:model.defer='fournisseur_id' class="form-control  form-control-lg">
                                                    @foreach($fournisseurs as $f)
                                                    <option value="{{$f->id}}">{{$f->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button wire:click.prevent="saveCharge" type="submit" class="btn btn-primary btn-sm">Enregistrer
                                    Charge</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
    
            </div>
    
            {{-- edit charge model --}}
    
            <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
                aria-hidden="true">
    
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header">
    
    
    
                            <h6 class="modal-title">Modifier Charge</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span data-feather="x"></span></button>
                        </div>
                        <div class="modal-body">
    
                                <form wire:submit.prevent='editData'>
                                    <div class="form-basic">
                                        <div class="form-group mb-25">
                                            <label>Nom de charge</label>
                                            <input class="form-control form-control-lg" type="text" name="name"
                                                wire:model.defer='name'>
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
    
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Type</label>
                                            <input class="form-control form-control-lg" type="text" name="type"
                                                wire:model.defer='type'>
                                            @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>bon</label>
                                            <input class="form-control form-control-lg" type="text" name="bon"
                                                wire:model.defer='bon'>
                                            @error('bon')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>prix_ht</label>
                                            <input class="form-control form-control-lg" type="text" name="prix_ht"
                                                wire:model.defer='prix_ht'>
                                            @error('prix_ht')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>tva</label>
                                            <input class="form-control form-control-lg" type="text" name="tva"
                                                wire:model.defer='tva'>
                                            @error('tva')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>QT</label>
                                            <input class="form-control form-control-lg" type="text" name="QT"
                                                wire:model.defer='QT'>
                                            @error('QT')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>prix_TTC</label>
                                            <input class="form-control form-control-lg" type="text" name="prix_TTC"
                                                wire:model.defer='prix_TTC'>
                                            @error('prix_TTC')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>MTTTC</label>
                                            <input class="form-control form-control-lg" type="text" name="MTTTC"
                                                wire:model.defer='MTTTC'>
                                            @error('MTTTC')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Situation</label>
                                            <input class="form-control form-control-lg" type="text" name="situation"
                                                wire:model.defer='situation'>
                                            @error('situation')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25 ">
                                            <label>Projet</label>
                                                <select name="projet_id"  id="select-size-1" wire:model.defer='projet_id' class="form-control  form-control-lg">
                                                    @foreach($projets as $p)
                                                    <option value="{{$p->id}}">{{$p->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                         <div class="form-group mb-25 ">
                                            <label>Fournisseur</label>
                                                <select name="fournisseur_id"  id="select-size-1" wire:model.defer='fournisseur_id' class="form-control  form-control-lg">
                                                    @foreach($fournisseurs as $f)
                                                    <option value="{{$f->id}}">{{$f->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
    
    
                            <div class="modal-footer">
                                <button type="submit" wire:click.prevent="updateCharge"
                                    class="btn btn-primary btn-sm">Enregistrer Charge</button>
                            </div>
                            </form>
                        </div>
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
                                    <h6>Voulez-vous supprimer ce Charge</h6>
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
    




{{-- 
            <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
                aria-hidden="true">
    
    
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header"> --}}
    
            {{-- Add Reglement Model--}}
            <div wire:ignore.self class="modal-basic modal fade show" id="cree-reglement" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">
                        <h6 class="modal-title">Création d'un Règlement</h6></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                            <form enctype="multipart/form-data">
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <input class="radio" name="method" type="radio">
                                        <label>
                                            <span class="radio-text">Check</span>
                                        </label>
                                        <input class="radio" name="method" type="radio">
                                        <label>
                                            <span class="radio-text">Cash</span>
                                        </label>
                                </div>
                                 
                                  
                                   
                                    {{-- <div class="form-group mb-25">
                                        <label>prix_ht</label>
                                        <input class="form-control form-control-lg" type="text" name="prix_ht"
                                            wire:model.defer='prix_ht'>
                                        @error('prix_ht')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                  
                                    
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button wire:click.prevent="saveCharge" type="submit" class="btn btn-primary btn-sm">Enregistrer le règlement</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    
    
    
        </div>
    </div>
</div>
