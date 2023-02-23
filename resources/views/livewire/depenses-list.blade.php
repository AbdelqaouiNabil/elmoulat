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

                                    <div class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1 border-0">
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
                                        wire:click="buttonAjouter" data-target="#modal-basic">
                                        <i class="la la-plus"></i>Ajouter</button>

                                </div>
                                {{-- @if ($depenses->count() > 0)
                                        <div class="action-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-add"
                                                wire:click="checkChargeSituation" data-toggle="modal"
                                                data-target="#cree-reglement">
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

        @if ($depenses->count() > 0)
            <div class="container-fluid">

                {{-- <div class="action-btn mb-3">
                    <button type="button"
                        class="@if ($bulkDisabled) disabled @endif btn btn-sm btn-danger"
                        wire:click="deleteSelected">
                        <i class="la la-trash"></i>delete selected</button>
                </div> --}}



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
                                                <span class="userDatatable-title">Montant</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">type</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">L'utilité</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Date</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Projet</span>
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
                                                        {{ $dep->montant }}
                                                    </div>
                                                </td>

                                                <td>
                                                    @if ($dep->type === 'Justifier')
                                                        <div class="orderDatatable-title">
                                                            <span class="badge rounded-pill bg-success "
                                                                style="color:white; font-weight:700;">{{ $dep->type }}</span>
                                                        </div>
                                                    @endif
                                                    @if ($dep->type === 'Non Justifier')
                                                        <div class="orderDatatable-title">
                                                            <span class="badge rounded-pill bg-danger"
                                                                style="color:white;  font-weight:700;">{{ $dep->type }}</span>
                                                        </div>
                                                    @endIf
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $dep->Aqui }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $dep->dateDep }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        @if (!is_null($dep->projet))
                                                            {{ $dep->projet->name }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <ul class="orderDatatable_actions mb-0 d-flex">
                                                        <li>
                                                            <a href="#" class="view" data-toggle="modal"
                                                                data-target="#show-modal"
                                                                wire:click='showDepense({{ $dep->id }})'>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-eye" style="color:blue;">
                                                                    <path
                                                                        d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                                    </path>
                                                                    <circle cx="12" cy="12"
                                                                        r="3"></circle>
                                                                </svg>
                                                            </a>
                                                        </li>
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#edit-modal"
                                                                wire:click='editDepense({{ $dep->id }})'><i
                                                                    class="fa-regular fa-pen-to-square"></i></a>
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
                            <div class="form-basic">
                                @if (session()->has('error'))
                                <div class="alert alert-danger">

                                    {{ session('error') }}

                                </div>
                            @endif
                            @if (session()->has('warning'))
                                <div class="alert alert-warning form-group mb-25">

                                    {{ session('warning') }}

                                </div>
                            @endif
                                <div class="form-group mb-25">
                                    <label>Montant de depense</label>
                                    <input class="form-control form-control-lg" type="text" name="montant"
                                        wire:model.defer='montant'>
                                    @error('montant')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Type</label>
                                    <div class="row">
                                        <div class="col mt-6">
                                            <div class="form-group mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="radio"
                                                        value="justifier" checked wire:model.defer='justifier'>
                                                    <label class="form-check-label">
                                                        Justifier
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col mt-6">
                                            <div class="form-group mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        value="nonJustifier" wire:model.defer='nonJustifier'
                                                        name="radio">
                                                    <label class="form-check-label">
                                                        Nom Justifier
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <select name="id_projet" id="select-size-1" wire:model.defer='id_projet'
                                        class="form-control  form-control-lg">
                                        <option selected>Choisir un projet</option>
                                        @foreach ($projets as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-25">
                                    <label class="fs-3">L'usage</label>
                                    <input type="checkbox" name="Aouvrier" wire:model.defer='Aouvrier'>
                                    <label>Ouvrier</label>
                                    <input class="form-control form-control-lg" type="text" name="Aqui"
                                        placeholder="A qui (saisir le CIN si c'est un ouvrier)"
                                        wire:model.defer='Aqui'>
                                    @error('Aqui')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-25">
                                    <label>Description</label>
                                    <textarea class="form-control form-control-lg" name="description" rows="5" cols="50"
                                        wire:model.defer='description'>
                                        </textarea>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click.prevent="saveDepense" type="submit"
                            @if ($noProjects) disabled @endif
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

                        <form wire:submit.prevent='editData'>
                            <div class="form-basic">
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
                                <div class="form-group mb-25">
                                    <label class="fs-3">L'usage</label>
                                    <input type="checkbox" name="Aouvrier" wire:model.defer='Aouvrier'>
                                    <label>Ouvrier</label>
                                    <input class="form-control form-control-lg" type="text" name="Aqui"
                                        placeholder="A qui (saisir le CIN si c'est un ouvrier)"
                                        wire:model.defer='Aqui'>
                                    @error('Aqui')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Description</label>
                                    <textarea class="form-control form-control-lg" name="description" rows="5" cols="50"
                                        wire:model.defer='description'>
                                        </textarea>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="submit" wire:click.prevent="updateDepense"
                                    class="btn btn-primary btn-sm">Enregistrer Depense</button>
                            </div>
                        </form>
                    </div>
                </div>



            </div>

        </div>

        {{-- CREE REGLEMENT model --}}

        {{-- <div wire:ignore.self class="modal-basic modal fade show" id="cree-reglement" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">
                        <h6 class="modal-title">Création d'un Règlement</h6>
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body"> --}}
        {{-- <div class="alert alert-danger d-flex align-items-center mt-5" role="alert">
                                                <span class="mr-2" aria-label="Warning:"><i class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>
                                                <div>
                                                    Vous sélectionnez une charge payé
                                                </div>
                                            </div> --}}
        {{-- <form enctype="multipart/form-data">
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Date</label>
                                    <input class="form-control form-control-lg" type="date" name="date"
                                        wire:model.defer='date'>
                                    @error('date')
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
                                class="btn btn-primary btn-sm">Enregistrer
                                le règlement</button>
                        </div>
                    @endif --}}
        {{-- <div class="modal-footer">
                                <button wire:click.prevent="addReg"   @if ($check) disable @endif type="submit" class="btn btn-primary btn-sm">Enregistrer le règlement</button>
                            </div> --}}

        {{-- </form>





                </div>
            </div>
        </div> --}}











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

    </div>

</div>
