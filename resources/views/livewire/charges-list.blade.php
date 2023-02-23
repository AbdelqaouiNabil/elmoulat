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
                                                type="search" placeholder="chercher par nom ou type..."
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
                                                <option value="payed">Payed</option>
                                                <option value="notPayed">notPayed</option>
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
                                            wire:click="buttonAjouter" data-toggle="modal" data-target="#modal-basic">
                                            <i class="la la-plus"></i>Ajouter</button>

                                    </div>
                                    @if ($charges->count() > 0)
                                        <div class="action-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-add"
                                                wire:click="checkChargeSituation" data-toggle="modal"
                                                data-target="#cree-reglement">
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
            @if (session()->has('message'))
                <div class="alert alert-success">

                    {{ session('message') }}

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
                                                            @if (!is_null($CH->projet))
                                                                {{ $CH->projet->name }}
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            @if (!is_null($CH->fournisseur))
                                                                {{ $CH->fournisseur->name }}
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex">

                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#edit-modal"
                                                                    wire:click='editCharge({{ $CH->id }})'><i
                                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                            </li>
                                                            <li><a href="#" class="remove" data-toggle="modal"
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
                    table Charges is empty
                </div>
            @endif



            {{--
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js" defer>
            </script>
            <script>
                $(document).ready(function() {
                    $('#myTable01').DataTable({
                        dom: 'ft',
                    });
                });
            </script> --}}








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

                                    @if (session()->has('warning'))
                                        <div class="alert alert-warning form-group mb-25">

                                            {{ session('warning') }}

                                        </div>
                                    @endif
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
                                                <label>bon</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="bon" wire:model.defer='bon'>
                                                @error('bon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>tva</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="tva" wire:model.defer='tva'>
                                                @error('tva')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>prix_TTC</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="prix_TTC" wire:model.defer='prix_TTC'>
                                                @error('prix_TTC')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-25 ">
                                                <label>Fournisseur</label>
                                                <select name="fournisseur_id" id="select-size-1"
                                                    wire:model.defer='fournisseur_id'
                                                    class="form-control  form-control-lg">
                                                    <option value="" selected>select an option</option>
                                                    @foreach ($fournisseurs as $f)
                                                        <option value="{{ $f->id }}">{{ $f->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>



                                        </div>
                                        <div class="col mt-6">


                                            <div class="form-group mb-25">
                                                <label>Type</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="type" wire:model.defer='type'>
                                                @error('type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>prix_ht</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="prix_ht" wire:model.defer='prix_ht'>
                                                @error('prix_ht')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>QT</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="QT" wire:model.defer='QT'>
                                                @error('QT')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>MTTTC</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="MTTTC" wire:model.defer='MTTTC'>
                                                @error('MTTTC')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25 ">
                                                <label>Projet</label>
                                                <select name="id_projet" id="select-size-1"
                                                    wire:model.defer='id_projet'
                                                    class="form-control  form-control-lg">
                                                    <option value="" selected>select an option</option>
                                                    @foreach ($projets as $p)
                                                        <option value="{{ $p->id }}">{{ $p->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>



                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mt-6">


                                            <div class="form-group mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="situation"
                                                        value="notPayed" checked wire:model.defer='situation'>
                                                    <label class="form-check-label">
                                                        impayé
                                                    </label>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col mt-6">


                                            <div class="form-group mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="payed"
                                                        disabled wire:model.defer='situation' name="situation">
                                                    <label class="form-check-label">
                                                        payé
                                                    </label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>




                                </div>
                        </div>
                        <div class="modal-footer">
                            <button wire:click.prevent="saveCharge" type="submit"
                                @if ($noProjectOrFourniss) disabled @endif
                                class="btn btn-primary btn-sm">Enregistrer
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
                                            <label>bon</label>
                                            <input class="form-control form-control-lg" type="text" name="bon"
                                                wire:model.defer='bon'>
                                            @error('bon')
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
                                            <label>prix_TTC</label>
                                            <input class="form-control form-control-lg" type="text"
                                                name="prix_TTC" wire:model.defer='prix_TTC'>
                                            @error('prix_TTC')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-25 ">
                                            <label>Fournisseur</label>
                                            <select name="fournisseur_id" id="select-size-1"
                                                wire:model.defer='fournisseur_id'
                                                class="form-control  form-control-lg">
                                                @foreach ($fournisseurs as $f)
                                                    <option value="{{ $f->id }}">{{ $f->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                    </div>
                                    <div class="col mt-6">


                                        <div class="form-group mb-25">
                                            <label>Type</label>
                                            <input class="form-control form-control-lg" type="text" name="type"
                                                wire:model.defer='type'>
                                            @error('type')
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
                                            <label>QT</label>
                                            <input class="form-control form-control-lg" type="text" name="QT"
                                                wire:model.defer='QT'>
                                            @error('QT')
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
                                        <div class="form-group mb-25 ">
                                            <label>Projet</label>
                                            <select name="id_projet" id="select-size-1" wire:model.defer='id_projet'
                                                class="form-control  form-control-lg">
                                                @foreach ($projets as $p)
                                                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                @endforeach
                                            </select>
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
                                        wire:model.defer='dateR'>
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

                    @if ($errordAjoutReg)
                        <div class="modal-footer">
                            <button wire:click.prevent="addReg" type="submit" disabled
                                class="btn btn-primary btn-sm">Enregistrer le règlement</button>
                        </div>
                    @else
                        <div class="modal-footer">
                            <button wire:click.prevent="addReg" type="submit"
                                class="btn btn-primary btn-sm">Enregistrer le règlement</button>
                        </div>
                    @endif

                    </form>


                </div>
            </div>
        </div>

    </div>




</div>
</div>
</div>
