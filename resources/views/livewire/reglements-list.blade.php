<div>
    <div>
        <div class="contents">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Reglement</h4>
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
                                        <button type="button" class="btn btn-sm btn-primary btn-add"
                                            data-toggle="modal" data-target="#modal-basic">
                                            <i class="la la-plus"></i>Ajouter</button>
                                    </div>
                                    {{-- @if ($contrats->count() > 0)
                                    <div class="action-btn">
                                        <button type="button" class="btn btn-sm btn-primary btn-add" wire:click="checkChargeSituation"  data-toggle="modal" data-target="#cree-reglement" >
                                            <i class="la la-plus"></i> Créer un Règlement
                                        </button>
                                    </div>
                                    @endif --}}
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

            @if ($reglements->count() > 0)
                <div class="container-fluid">
                    @if (!($bulkDisabled))
                    <div class="action-btn mb-3">
                        <button type="button"
                            class="@if ($bulkDisabled) disabled @endif btn btn-sm btn-danger"
                            wire:click="deleteSelected">
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
                                                    <span class="userDatatable-title">Date de contrat</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Montant</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Methode</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title float-right">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($reglements as $reg)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" wire:model="selectedRegs"
                                                                value="{{ $reg->id }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $reg->id }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $reg->date }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $reg->montant }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $reg->methode }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex">
                                                            <li>
                                                                <a href="#" class="view" data-toggle="modal"
                                                                    data-target="#show-modal"
                                                                    wire:click='showReglement({{ $reg->id }})'>
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-eye" style="color:blue;">
                                                                        <path
                                                                            d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                        </path>
                                                                        <circle cx="12" cy="12" r="3"></circle>
                                                                    </svg>
                                                                </a>
                                                            </li>
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#edit-modal"
                                                                    wire:click='editReglement({{ $reg->id }})'><i
                                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                            </li>
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#modal-info-delete"
                                                                    wire:click='deleteReglement({{ $reg->id }})'
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
                                                {{ $reglements->links('vendor.livewire.bootstrap') }}
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
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <div>
                        <span class="mr-2" aria-label="Warning:"><i
                                class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>Reglement table is empty
                    </div>
                </div>
            @endif



            {{-- add Reglement  modal --}}
            <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
                aria-hidden="true">


                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header">
                            <h6 class="modal-title">Ajouter Nouveau Reglement</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span data-feather="x"></span></button>
                        </div>
                        <div class="modal-body">
                            <form enctype="multipart/form-data">
                                <div class="form-basic">
                                    <div class="row">
                                        <div class="col mt-6">
                                            <div class="form-group mb-25">
                                                <label>Date de contrat</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="date" wire:model.defer='date'>
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Montant</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="montant" wire:model.defer='montant'>
                                            </div>

                                            <div class="form-group mb-25">
                                                <input class="radio" wire:click='optionCheque' type="checkbox">
                                                <label>
                                                    <span class="radio-text">Avec chèque</span>
                                                </label>
                                            </div>

                                            @if ($optionC)
                                                <div class="form-group mb-25">
                                                    <input class="form-control form-control-lg" type="text"
                                                        name="numero_cheque" wire:model.defer='numero_cheque'>
                                                </div>
                                            @endIf
                                        </div>
                                        <div class="col mt-6">
                                            <div class="form-group mb-25 ">
                                                <label>Nom Contrat</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="nom_contrat" wire:model.defer='nom_contrat'>
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Numero Facture</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="num_facture" wire:model.defer='num_facture'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button wire:click.prevent="saveReglement" type="submit"
                                        class="btn btn-primary btn-sm">Enregistrer
                                        Reglement</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            {{-- edit Reglement model --}}

            <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
                aria-hidden="true">

                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header">



                            <h6 class="modal-title">Modifier Rglement</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span data-feather="x"></span></button>
                        </div>
                        <div class="modal-body">

                            <form wire:submit.prevent='editData'>
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Montant de Reglement</label>
                                        <input class="form-control form-control-lg" type="text" name="montant"
                                            wire:model.defer='montant'>
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Date de relement</label>
                                        <input class="form-control form-control-lg" type="date" name="date"
                                            wire:model.defer='date'>
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Num Facture</label>
                                        <input class="form-control form-control-lg" type="text" name="num_facture"
                                            wire:model.defer='num_facture'>
                                    </div>

                                    <div class="form-group mb-25">
                                        <label>Nom Contrat</label>
                                        <input class="form-control form-control-lg" type="text" name="nom_contrat"
                                            wire:model.defer='nom_contrat'>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    <button type="submit" wire:click.prevent="updateReglement"
                                        class="btn btn-primary btn-sm">Enregistrer Reglement</button>
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
                                    <h6>Voulez-vous supprimer ce Reglement</h6>
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


            <div wire:ignore.self class="modal-basic modal fade show" id="show-modal" tabindex="-1" role="dialog"
                aria-hidden="true">

                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header">



                            <h6 class="modal-title">Reglement Infos</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span data-feather="x"></span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-basic">


                                <div class="row">
                                    <div class="col mt-6">
                                        <label>Montant de Reglement</label>
                                    </div>
                                    <div class="col mt-6">
                                        <label>{{ $montant }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-6">
                                        <label>Date de Reglement</label>
                                    </div>
                                    <div class="col mt-6">
                                        <label>{{ $date }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-6">
                                        <label>Methode</label>
                                    </div>
                                    <div class="col mt-6">
                                        <label>{{ $methode }}</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mt-6">
                                        <label>Numero Cheque</label>
                                    </div>
                                    <div class="col mt-6">
                                        <label>{{ $numero_cheque }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-6">
                                        <label>Numero Facture</label>
                                    </div>
                                    <div class="col mt-6">
                                        <label>{{ $num_facture }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-6">
                                        <label>Nom Contrat</label>
                                    </div>
                                    <div class="col mt-6">
                                        <label>{{ $nom_contrat }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>
</div>
