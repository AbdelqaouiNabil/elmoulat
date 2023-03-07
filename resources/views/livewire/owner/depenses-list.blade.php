<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Depense</h4>

                            <div class="col-md-6">
                                <div class="search-result global-shadow rounded-pill bg-white">

                                    <div
                                        class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1 border-0">
                                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <input wire:model="search" class="form-control border-0 box-shadow-none"
                                            type="search" placeholder="chercher par l'utiliter ..."
                                            aria-label="Search">
                                    </div>

                                </div>
                            </div>


                            <div class="breadcrumb-action justify-content-center flex-wrap">
                                <div class="dropdown action-btn">
                                    <div class="dropdown dropdown-click">

                                        <select name="select-size-1" wire:model="filter"
                                            class="form-control  form-control-lg">
                                            <option value="" selected>Order By</option>
                                            <option value="Justifier">Justifier</option>
                                            <option value="Non Justifier">Non Justifier</option>
                                        </select>
                                    </div>
                                </div>

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
                                        wire:click="resetInputs" wire:click.prevent="checkCheque()" data-target="#modal-basic">
                                        <i class="la la-plus"></i>Ajouter</button>

                                </div>
                                @if ($depenses->count() > 0 && $checkIfnotJustify == true && $bulkDisabled == false)
                                    <div class="action-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-add"
                                            data-toggle="modal" data-target="#facture-modal">
                                            <i class="la la-plus"></i> Ajouter Facture
                                        </button>
                                    </div>
                                @endif
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
        @elseif (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        

        @if ($depenses->count() > 0)
            <div class="container-fluid">
                <div class="breadcrumb-main">
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <div class="action-btn mb-3">
                            <button type="button" class="btn btn-sm btn-info" disabled>
                                Montant Total: {{ $montantTotal }} DH</button>
                        </div>
                        <div class="action-btn ">
                            <button type="button" class="btn btn-sm btn-success mr-3 " 
                                @if (count($selectedDepenses) > 0) disabled @endif data-toggle="modal"
                                data-target="#facture-modal">
                                <i style="color:white ;margin:0px; padding:2px"
                                    class="fa-solid fa-file-invoice-dollar"></i></button>
                        </div>

                    </div>
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
                                                <span class="userDatatable-title">Date </span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Montant</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Situation</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Projet</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Type</span>
                                            </th>

                                            <th>
                                                <span class="userDatatable-title">Methode</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Description</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title float-right">Actions</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        @foreach ($depenses as $dep)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" wire:model="selectedDepenses"
                                                            value="{{ $dep->id }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $dep->id }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $dep->dateDep }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $dep->montant }} DH
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($dep->situation == 'justify')
                                                        <div class="orderDatatable-title">
                                                            <span class="badge rounded-pill bg-success "
                                                                style="color:white; font-weight:700;">{{ $dep->situation }}</span>
                                                        </div>
                                                    @endif
                                                    @if ($dep->situation == 'Non Justify')
                                                        <div class="orderDatatable-title">
                                                            <span class="badge rounded-pill bg-danger"
                                                                style="color:white;  font-weight:700;">{{ $dep->situation }}</span>
                                                        </div>
                                                    @endIf
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $dep->project->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $dep->type_depense }}
                                                    </div>
                                                </td>


                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $dep->methode }}
                                                    </div>
                                                </td>
                                                <td>

                                                    @if ($dep->description == '')
                                                        <i class="fa-solid fa-book-open"
                                                            style="color:rgb(188, 187, 187)"></i>
                                                    @else
                                                        <a href="#" data-toggle="modal"
                                                            wire:click="Description({{ $dep->id }})"
                                                            data-target="#description-modal"><i
                                                                class="fa-solid fa-book-open"></i></a>
                                                    @endif
                                                </td>

                                                <td>
                                                    <ul class="orderDatatable_actions mb-0 d-flex">
                                                        
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#edit-modal"
                                                                wire:click='editDepense({{ $dep->id }})'><i
                                                                    class="fa-regular fa-pen-to-square"></i></a>
                                                        </li>
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                            data-target="#modal-info-delete"
                                                            wire:click.prevent="deleteItem({{$dep->id}})"
                                                            style="color: red;"><i
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
                                            {{ $depenses->links('vendor.livewire.bootstrap') }}
                                        </li>
                                        <li class="atbd-pagination__item">

                                            <div class="paging-option">
                                                <select wire:model="pages" name="pages" class="page-selection">
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
        @else
            <div class="h-100 d-flex align-items-center justify-content-center">
                table Depenses is empty
            </div>
        @endif

        {{-- add Depense modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">
                        <h6 class="modal-title">Ajouter Nouveau Depense</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form enctype="multipart/form-data">

                            <div class="form-group mb-25">
                                <label>Montant de depense</label>
                                <input class="form-control form-control-lg" type="text" name="montant"
                                    wire:model.defer='montant'>
                                @error('montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-group mb-25">
                                <label>Date</label>
                                <input class="form-control form-control-lg" type="date" name="dateDep"
                                    wire:model.defer='dateDep'>
                                @error('dateDep')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-25 ">
                                <label>Projet</label>
                                <select name="id_projet" id="select-size-1" wire:model.defer='id_project'
                                    class="form-control  form-control-lg">
                                    <option selected>Choisir un projet</option>
                                    @foreach ($projets as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_project')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-25">
                                <label>Methode</label>
                                <div class="row">
                                    <div class="col mt-3">
                                        <div class="form-group mb-25">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="cach"
                                                    wire:model='methode'>
                                                <label class="form-check-label">
                                                    Cach
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mt-3">
                                        <div class="form-group mb-25">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="cheque"
                                                    wire:model='methode'>
                                                <label class="form-check-label">
                                                    Cheque
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mt-3">
                                        <div class="form-group mb-25">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="virement"
                                                    wire:model='methode'>
                                                <label class="form-check-label">
                                                    Virement
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mt-3">
                                        <div class="form-group mb-25">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="med"
                                                    wire:model='methode'>
                                                <label class="form-check-label">
                                                    MED
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($methode == 'cheque')
                                <div class="form-group mb-25">

                                    {{-- <label>Numéro Cheque</label>
                                    <input class="form-control form-control-lg" type="text" name="numero_cheque"
                                        placeholder="Saisir Numéro de Cheque" wire:model.defer='numero_cheque' @if(count($check_cheque)==null) disabled @endif>
                                    @error('numero_cheque')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror --}}
                                    <div class="atbd-select ">

                                        <select  id="select-search" id="select-search" class="form-control" wire:model.defer='numero_cheque' >
                                            @foreach($check_cheque as $cheque)
                                               <option value="{{$cheque->numero}}">{{$cheque->numero}}</option>
                                            @endforeach
                                        </select>
    
                                    </div>
                                </div>

                                
                            @endif
                            @if ($methode == 'virement')
                                <div class="form-group mb-25">

                                    <label>Réf Virement</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="Saisir Réf virement" wire:model.defer='ref_virement'>
                                    @error('ref_virement')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($methode == 'med')
                                <div class="form-group mb-25">

                                    <label>Réf MED</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="Saisir Réf virement" wire:model.defer='ref_med'>
                                    @error('ref_med')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($methode == 'cach')
                                <div class="form-group mb-25 ">
                                    <label>Caisse</label>
                                    <select wire:model.defer='id_caisse' class="form-control  form-control-lg">
                                        <option selected>Choisir un Caisse</option>
                                        @foreach ($caisses as $caisse)
                                            <option value="{{ $caisse->id }}">{{ $caisse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_caisse')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Type de Caisse</label>
                                    <div class="row">
                                        <div class="col mt-6">
                                            <div class="form-group mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        value="sold_nonJustify" checked wire:model='type_caisse'>
                                                    <label class="form-check-label">
                                                        Non Justifier
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-6">
                                            <div class="form-group mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        value="sold_Justify" wire:model='type_caisse'>
                                                    <label class="form-check-label">
                                                        Justifier
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group mb-25 ">
                                <label>Type</label>
                                <select wire:model='type_depense' class="form-control  form-control-lg">
                                    <option selected>select an option</option>
                                    @foreach ($typeDepense as $type)
                                        <option value="{{ $type }}">{{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_depense')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if ($type_depense == 'Ouvrier')
                                <div class="form-group mb-25">
                                    <label>Ouvrier</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="saisir le CIN si c'est un ouvrier"
                                        wire:model.defer='cin_ouvrier'>
                                    @error('cin_ouvrier')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($type_depense == 'Autre')
                                <div class="form-group mb-25">
                                    <label class="required">Autre Type</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="Saisir Votre Type.." wire:model.defer='autre_type'>
                                    @error('autre_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif


                            <div class="form-group mb-25">
                                <label>Description</label>
                                <textarea class="form-control form-control-lg" rows="2" cols="50" wire:model.defer='description'>
                                 </textarea>
                            </div>
                    </div>


                    <div class="modal-footer">
                        <button wire:click.prevent="saveDepense" type="submit"
                            class="btn btn-primary btn-sm">Enregistrer
                            Depense</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- edit Depense model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Modifier Depense</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form enctype="multipart/form-data">

                            <div class="form-group mb-25">
                                <label>Montant de depense</label>
                                <input class="form-control form-control-lg" type="text" name="montant"
                                    wire:model.defer='montant'>
                                @error('montant')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-group mb-25">
                                <label>Date</label>
                                <input class="form-control form-control-lg" type="date" name="dateDep"
                                    wire:model.defer='dateDep'>
                                @error('dateDep')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-25 ">
                                <label>Projet</label>
                                <select name="id_projet" id="select-size-1" wire:model.defer='id_project'
                                    class="form-control  form-control-lg">
                                    <option selected>Choisir un projet</option>
                                    @foreach ($projets as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_project')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-25">
                                <label>Methode</label>
                                <div class="row">
                                    <div class="col mt-3">
                                        <div class="form-group mb-25">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="cach"
                                                    wire:model='methode'>
                                                <label class="form-check-label">
                                                    Cach
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mt-3">
                                        <div class="form-group mb-25">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="cheque" 
                                                    wire:model='methode'>
                                                <label class="form-check-label">
                                                    Cheque
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mt-3">
                                        <div class="form-group mb-25">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="virement"
                                                    wire:model='methode'>
                                                <label class="form-check-label">
                                                    Virement
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col mt-3">
                                        <div class="form-group mb-25">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="med"
                                                    wire:model='methode'>
                                                <label class="form-check-label">
                                                    MED
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($methode == 'cheque')
                                <div class="form-group mb-25">

                                    <label>Numéro Cheque</label>
                                    <input class="form-control form-control-lg" type="text" name="numero_cheque"
                                        placeholder="Saisir Numéro de Cheque" wire:model.defer='numero_cheque'>
                                    @error('numero_cheque')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($methode == 'virement')
                                <div class="form-group mb-25">

                                    <label>Réf Virement</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="Saisir Réf virement" wire:model.defer='ref_virement'>
                                    @error('ref_virement')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($methode == 'med')
                                <div class="form-group mb-25">

                                    <label>Réf MED</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="Saisir Réf virement" wire:model.defer='ref_med'>
                                    @error('ref_med')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($methode == 'cach')
                                <div class="form-group mb-25 ">
                                    <label>Caisse</label>
                                    <select wire:model.defer='id_caisse' class="form-control  form-control-lg">
                                        <option selected>Choisir un Caisse</option>
                                        @foreach ($caisses as $caisse)
                                            <option value="{{ $caisse->id }}">{{ $caisse->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_caisse')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Type de Caisse</label>
                                    <div class="row">
                                        <div class="col mt-6">
                                            <div class="form-group mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        value="sold_nonJustify" checked wire:model='type_caisse'>
                                                    <label class="form-check-label">
                                                        Non Justifier
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-6">
                                            <div class="form-group mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        value="sold_Justify" wire:model='type_caisse'>
                                                    <label class="form-check-label">
                                                        Justifier
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group mb-25 ">
                                <label>Type</label>
                                <select wire:model='type_depense' class="form-control  form-control-lg">
                                    <option selected>select an option</option>
                                    @foreach ($typeDepense as $type)
                                        <option value="{{ $type }}">{{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('type_depense')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if ($type_depense == 'Ouvrier')
                                <div class="form-group mb-25">
                                    <label>Ouvrier</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="saisir le CIN si c'est un ouvrier"
                                        wire:model.defer='cin_ouvrier'>
                                    @error('cin_ouvrier')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($type_depense == 'Autre')
                                <div class="form-group mb-25">
                                    <label class="required">Autre Type</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="Saisir Votre Type.." wire:model.defer='autre_type'>
                                    @error('autre_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif


                            <div class="form-group mb-25">
                                <label>Description</label>
                                <textarea class="form-control form-control-lg" rows="2" cols="50" wire:model.defer='description'>
                                 </textarea>
                            </div>
                    </div>


                    <div class="modal-footer">
                        <button wire:click.prevent="modifierDepense" type="submit"
                            class="btn btn-primary btn-sm">Edit
                            Depense</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


      

        {{-- Show Depense model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="show-modal" tabindex="-1" role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Depense Infos</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-basic">


                            <div class="row">
                                <div class="col mt-6">
                                    <label>Montant de depense</label>
                                </div>
                                <div class="col mt-6">
                                    <label>{{ $montant }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-6">
                                    <label>Date de depense</label>
                                </div>
                                <div class="col mt-6">
                                    <label>{{ $dateDep }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-6">
                                    <label>Projet</label>
                                </div>
                                <div class="col mt-6">
                                    @if (!is_null($depenseInfos))
                                        <label>{{ $depenseInfos->projet->name }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-6">
                                    <label>L'usage</label>
                                </div>
                                <div class="col mt-6">
                                    <label>{{ $Aqui }}</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-6">
                                    <label>Type</label>
                                </div>
                                <div class="col mt-6">
                                    @if ($type == 'Justifier')
                                        <span class="badge rounded-pill bg-success "
                                            style="color:white; font-weight:700;">{{ $type }}</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger "
                                            style="color:white; font-weight:700;">{{ $type }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-6">
                                    <label>Description</label>
                                </div>
                                <div class="col mt-6">
                                    <label>{{ $description }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- model for show description --}}

        <div class="modal fade" id="description-modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLongTitle">Description</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $description_data }}</p>
                    </div>

                </div>
            </div>
        </div>

        {{-- add  facture  to depenses for justify --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="facture-modal" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">
                        <h6 class="modal-title">Ajouter Nouveau Depot</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>

                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Montant Total</label>
                                    <input class="form-control form-control-lg" type="text" disabled
                                        value="{{ $montantTotal }} DH">

                                </div>
                            </div>
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Numéro Facture</label>
                                    <input class="form-control form-control-lg" type="text"
                                        wire:model.defer='numero_facture'>
                                    @error('numero_facture')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Montant Facture</label>
                                    <input class="form-control form-control-lg" type="text"
                                        wire:model.defer='montant_facture'
                                        placeholder="saisir le montant de facture...">
                                    @error('montant_facture')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button wire:click.prevent="addFacture" type="submit"
                                    class="btn btn-primary btn-sm">Ajouter Facture
                                </button>
                            </div>
                        </form>

                    </div>
                    
                </div>
            </div>
        </div>


        <!-- ends: .modal-info-Delete -->



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
                                <h6>Do you want to delete this item ?</h6>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">No</button>
                        <button type="button" wire:click.prevent='deleteData'
                            class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">Yes</button>

                    </div>
                </div>
            </div>


        </div>

    </div>

</div>
