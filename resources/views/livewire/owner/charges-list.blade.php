<div>
    <div>
        <div class="contents">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Charge</h4>
                                <div class="col-md-6">
                                    <div class="search-result global-shadow rounded-pill bg-white">

                                        <div
                                            class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1 border-0">
                                            <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                            <input wire:model="search" class="form-control border-0 box-shadow-none"
                                                type="search"
                                                placeholder="chercher par nom ou type ou nom de fournisseur ou nom du projet ..."
                                                aria-label="Search">
                                        </div>

                                    </div>
                                </div>

                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <div class="dropdown action-btn">
                                        <div class="dropdown dropdown-click">
                                            <select name="select-size-1" wire:model="search"
                                                class="form-control  form-control-lg">
                                                <option value="" selected>Order By</option>
                                                <option value="payed">Payed</option>
                                                <option value="notPayed">Not Payed</option>
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

                                        <button type="button" class="btn btn-sm btn-primary btn-add"
                                            @if (is_null($projets) || is_null($fournisseurs) ) disabled @endif wire:click="resetInputs()"
                                            data-toggle="modal" data-target="#modal-basic">
                                            <i class="la la-plus"></i>Ajouter</button>

                                    </div>
                                    @if (count($charges) > 0 && count($selectedCharges) > 0 && $checkIfnotPayed==true)
                                        <div class="action-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-add"
                                                data-toggle="modal" data-target="#cree-reglement">
                                                <i class="la la-plus"></i> Créer un Règlement
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if (count($projets) > 0 && count($fournisseurs) > 0)
                @if (session()->has('message'))
                    <div class="alert alert-success">

                        {{ session('message') }}

                    </div>
                @endif
                @if (session()->has('warning2'))
                    <div class="alert alert-warning">

                        {{ session('warning2') }}

                    </div>
                @endif

                @if ($charges->count() > 0)
                    <div class="container-fluid">

                        @if (!$bulkDisabled)
                            <div class="action-btn mb-3">
                                <button type="button" class="btn btn-sm btn-danger" wire:click="deleteSelected">
                                    <i class="la la-trash"></i>delete selected</button>
                            </div>
                        @endif

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
                                                        <span class="userDatatable-title">Bon</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Bon(PDF)</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Montant</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Date</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">type</span>
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
                                                                {{ $CH->bon }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                <a href=" {{ Storage::disk('local')->url($CH->bonpdf) }}"
                                                                    target="_blank" type="application/pdf"
                                                                    style="color: red; font-size:20px;"><i
                                                                        class="fa-solid fa-file-pdf"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $CH->montant }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $CH->date }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $CH->type }}
                                                            </div>
                                                        </td>


                                                        <td>
                                                            @if ($CH->situation === 'payed')
                                                                <div class="orderDatatable-title">
                                                                    <span class="badge rounded-pill bg-success "
                                                                        style="color:white; font-weight:700;">{{ $CH->situation }}</span>
                                                                </div>
                                                            @endif
                                                            @if ($CH->situation === 'notPayed')
                                                                <div class="orderDatatable-title">
                                                                    <span class="badge rounded-pill bg-danger"
                                                                        style="color:white;  font-weight:700;">{{ $CH->situation }}</span>
                                                                </div>
                                                            @endIf

                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">

                                                                {{ $CH->projet->name }}

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $CH->fournisseur->name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex">

                                                                <li><a href="#" class="remove"
                                                                        data-toggle="modal" data-target="#edit-modal"
                                                                        wire:click='editCharge({{ $CH->id }})'><i
                                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                                </li>
                                                                <li><a href="#" class="remove"
                                                                        data-toggle="modal"
                                                                        data-target="#modal-info-delete"
                                                                        wire:click='deleteCharge({{ $CH->id }})'
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
                                    <div
                                        class="d-flex justify-content-sm-end justify-content-start mt-15 pt-25 border-top">

                                        <nav class="atbd-page ">
                                            <ul class="atbd-pagination d-flex">
                                                <li class="atbd-pagination__item">
                                                    {{ $charges->links('vendor.livewire.bootstrap') }}
                                                </li>
                                                <li class="atbd-pagination__item">

                                                    <div class="paging-option">
                                                        <select wire:model="pages" name="pages"
                                                            class="page-selection">
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
                        table Charges is empty
                    </div>
                @endif
            @else
                <div class="alert alert-warning d-flex align-items-center mt-5" role="alert">
                    <span class="mr-2" aria-label="Warning:"><i
                            class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>
                    <div>
                        Vous deviez crée un projet et un fournisseur avant de crée un charge
                    </div>
                </div>

            @endif

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

                            <form enctype="multipart/form-data" wire:submit.prevent="saveCharge">
                                <div class="form-basic">


                                    <div class="row">
                                        <div class="col mt-6">

                                            <div class="form-group mb-25">
                                                <label>Nom de charge</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="name" wire:model.defer='name'>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Numéro Bon</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="bon" wire:model.defer='bon'>
                                                @error('bon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Le Bon (PDF)</label>
                                                <input class="form-control form-control-lg" type="file"
                                                    name="bonpdf" wire:model.defer='bonpdf'>
                                                @error('bonpdf')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25 ">
                                                <label>Fournisseur</label>
                                                <select name="fournisseur_id" id="select-size-1"
                                                    wire:model.defer='fournisseur_id'
                                                    class="form-control  form-control-lg">
                                                    <option selected>select an option</option>
                                                    @foreach ($fournisseurs as $f)
                                                        <option value="{{ $f->id }}">{{ $f->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('fournisseur_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if ($calculateMontant)
                                                <div class="form-group mb-25">
                                                    <label>Prix HT</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        id="prix" name="prixht" wire:model='prixht'>
                                                    @error('prixht')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-25">
                                                    <label>TVA</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        name="tva" wire:model='tva'>
                                                    @error('tva')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col mt-6">

                                            <div class="form-group mb-25">
                                                <label>Date</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="date" wire:model.defer='date'>
                                                @error('date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Type</label>
                                                <select name="type" id="select-size-1" wire:model.defer='type'
                                                    class="form-control  form-control-lg">
                                                    <option selected>select an option</option>
                                                    @foreach ($this->chargetype as $type)
                                                        <option value="{{ $type }}">{{ $type }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Montant Total <input type="checkbox"
                                                        wire:model='calculateMontant'>
                                                    (<i style="color:rgb(160, 160, 18)"
                                                        class="fa-solid fa-triangle-exclamation"></i>check to
                                                    calculate)</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    @if ($calculateMontant) disabled @endif name="montant"
                                                    wire:model.defer='montant'>
                                                @error('montant')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-25 ">
                                                <label>Projet</label>
                                                <select name="id_projet" id="select-size-1"
                                                    wire:model.defer='id_projet'
                                                    class="form-control  form-control-lg">
                                                    <option selected>select an option</option>
                                                    @foreach ($projets as $p)
                                                        <option value="{{ $p->id }}">{{ $p->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('id_projet')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if ($calculateMontant)
                                                <div class="form-group mb-25">
                                                    <label>QT</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        name="QT" wire:model='QT'>
                                                    @error('QT')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group mb-25">
                                                    <label>Montant Total</label>
                                                    <input class="form-control form-control-lg"
                                                        value="{{ $montant }} DH" disabled name="montant">

                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm">Enregistrer Charge</button>
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
                                <div class="row">
                                    <div class="col mt-6">

                                        <div class="form-group mb-25">
                                            <label>Nom de charge</label>
                                            <input class="form-control form-control-lg" type="text" name="name"
                                                wire:model.defer='name'>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Numéro Bon</label>
                                            <input class="form-control form-control-lg" type="text" name="bon"
                                                wire:model.defer='bon'>
                                            @error('bon')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Le Bon (PDF)</label>
                                            <input class="form-control form-control-lg" type="file" name="bonpdf"
                                                value="{{ asset('' . $bonpdf . '') }}" wire:model.defer='bonpdf'>

                                            @error('bonpdf')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25 ">
                                            <label>Fournisseur</label>
                                            <select name="fournisseur_id" id="select-size-1"
                                                wire:model.defer='fournisseur_id'
                                                class="form-control  form-control-lg">
                                                <option selected>select an option</option>
                                                @foreach ($fournisseurs as $f)
                                                    <option value="{{ $f->id }}">{{ $f->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('fournisseur_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col mt-6">

                                        <div class="form-group mb-25">
                                            <label>Date</label>
                                            <input class="form-control form-control-lg" type="date" name="date"
                                                wire:model.defer='date'>
                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Type</label>
                                            <select name="type" id="select-size-1" wire:model.defer='type'
                                                class="form-control  form-control-lg">
                                                <option selected>select an option</option>
                                                @foreach ($this->chargetype as $type)
                                                    <option value="{{ $type }}">{{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Montant Total </label>
                                            <input class="form-control form-control-lg" type="text" name="montant"
                                                wire:model.defer='montant'>
                                            @error('montant')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-25 ">
                                            <label>Projet</label>
                                            <select name="id_projet" id="select-size-1" wire:model.defer='id_projet'
                                                class="form-control  form-control-lg">
                                                <option selected>select an option</option>
                                                @foreach ($projets as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_projet')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
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
                                @if (session()->has('warningDelete'))
                                    <div class="alert alert-warning">

                                        {{ session('warningDelete') }}

                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">annuler</button>
                        <button type="button" wire:click.prevent='deleteData'
                            class="btn btn-success btn-outlined btn-sm"
                            @if ($impossibleDeSupp) disabled @endif data-dismiss="modal">supprimer</button>

                    </div>
                </div>
            </div>


        </div>

        {{-- CREE REGLEMENT model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="cree-reglement" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">
                        <h6 class="modal-title">Création d'un Règlement</h6>
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                        @if (session()->has('error'))
                            <div class="alert alert-danger form-group mb-25">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form enctype="multipart/form-data">
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Date</label>
                                    <input class="form-control form-control-lg" type="date" name="dateR"
                                        wire:model='dateR' value="{{ $dateR }}">
                                    @error('dateR')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Montant Total</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="0000.00 DH" name="montant" wire:model.defer='montant'>
                                    @error('montant')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <input class="radio" wire:click='optionCheque' type="checkbox">
                                    <label>
                                        <span class="radio-text">Avec chèque</span>
                                    </label>
                                </div>

                                @if ($optionC)
                                    <div class="form-group mb-25">
                                        <label>Les chèques disponible</label>
                                        <select name="numero_cheque" wire:model.defer='numero_cheque'
                                            class="form-control  form-control-lg">
                                            @foreach ($cheques as $ch)
                                                <option value="{{ $ch->numero }}">{{ $ch->numero }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endIf


                                <div class="form-group mb-25">
                                    <input class="radio" wire:click='avecFacture' type="checkbox">
                                    <label>
                                        <span class="radio-text">Avec Facture</span>
                                    </label>
                                </div>

                                @if ($avecF)
                                    <div class="form-group mb-25">
                                        <label>Numéro du Facture</label>
                                        <input class="form-control form-control-lg" type="text" name="numFacture"
                                            wire:model.defer='numFacture'>
                                        @error('numFacture')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endIf
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click.prevent="addReg" type="submit"
                            @if ($errordAjoutReg) disabled @endif
                            class="btn btn-primary btn-sm">Enregistrer le règlement</button>
                    </div>
                    </form>


                </div>
            </div>
        </div>

    </div>

</div>
