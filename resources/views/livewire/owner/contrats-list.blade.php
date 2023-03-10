<div>
    <div>
        <div class="contents">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Contrat</h4>

                                <div class="col-md-6">
                                    <div class="search-result global-shadow rounded-pill bg-white">

                                        <div
                                            class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1 border-0">
                                            <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                            <input wire:model="search" class="form-control border-0 box-shadow-none"
                                                type="search"
                                                placeholder="chercher par nom contrat, cin ouvrier, date ..."
                                                aria-label="Search">
                                        </div>

                                    </div>
                                </div>

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
                                            wire:click="resetInputs" data-toggle="modal" data-target="#modal-basic">
                                            <i class="la la-plus"></i>Ajouter</button>

                                    </div>
                                    <div class="action-btn">

                                        <button type="button" class="btn btn-sm btn-primary btn-add"
                                            @if (count($selectedContrats) > 1 || $bulkDisabled == true || $isReglementExists == true) hidden @endif wire:click="resetInputs"
                                            wire:click.prevent="addReglement" data-toggle="modal"
                                            data-target="#reglement-modal">
                                            <i class="la la-plus"></i>Reglement</button>

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
            @if (session()->has('error'))
                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>
            @endif
            @if ($contrats->count() > 0)
                <div class="container-fluid">
                    @if (!$bulkDisabled)
                        <div class="action-btn mb-3">
                            <button type="button"
                                class="@if ($bulkDisabled) disabled @endif btn btn-sm btn-danger"
                                data-target="#modal-all-delete" data-toggle="modal">
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
                                                    <a href="" wire:click.prevent="sort('id')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Titre</span>
                                                    <a href="" wire:click.prevent="sort('titre')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Date Debut</span>
                                                    <a href="" wire:click.prevent="sort('datedebut')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Date Fin</span>
                                                    <a href="" wire:click.prevent="sort('datefin')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Montant</span>
                                                    <a href="" wire:click.prevent="sort('montant')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Avance</span>
                                                    <a href="" wire:click.prevent="sort('avence')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Le reste</span>
                                                    <a href="" wire:click.prevent="sort('titre')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Ouvrier</span>
                                                    <a href="" wire:click.prevent="sort('titre')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Projet</span>
                                                    <a href="" wire:click.prevent="sort('titre')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Entreprise</span>
                                                    <a href="" wire:click.prevent="sort('titre')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title ">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            @foreach ($contrats as $c)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" wire:model="selectedContrats"
                                                                value="{{ $c->id }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->id }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->titre }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->datedebut }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->datefin }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->montant }} DH
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">

                                                            @if (is_null($c->avance))
                                                                <a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#modal-addAvance"
                                                                    wire:click='addAvance({{ $c->id }})'><i
                                                                        class="fa-solid fa-plus"></i></a>
                                                            @else
                                                                {{ $c->avance }} DH
                                                            @endif


                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->montant_reste }} DH
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            @if (!is_null($c->id_ouvrier))
                                                                {{ $c->ouvrier->n_cin }}
                                                            @else
                                                                <i style="color:grey ;font-size:18px"
                                                                    class="fa-solid fa-person-circle-xmark"></i>
                                                            @endif

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            @if (!is_null($c->projet))
                                                                {{ $c->projet->name }}
                                                            @else
                                                                <i style="color:gray;font-size:16px"
                                                                    class="fa-solid fa-building-circle-xmark"></i>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            @if (!is_null($c->name_entreprise))
                                                                {{ $c->name_entreprise }}
                                                            @else
                                                                null
                                                            @endif


                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex">
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#modal-addAvance"
                                                                    wire:click='addAvance({{ $c->id }})'><i
                                                                        class="fa-solid fa-plus"></i></a>
                                                            </li>
                                                            <li>

                                                                <a data-target="#edit-modal" href="#"
                                                                    class="remove" data-toggle="modal"
                                                                    wire:click='editContrat({{ $c->id }})'><i
                                                                        class="fa-regular fa-pen-to-square"></i></a>


                                                            </li>

                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#modal-info-delete"
                                                                    wire:click='deleteContrat({{ $c->id }})'
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
                                                {{ $contrats->links('vendor.livewire.bootstrap') }}
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
                    table Contrat is empty
                </div>
            @endif



            {{-- add Contrat  modal --}}
            <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
                aria-hidden="true">


                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header">
                            <h6 class="modal-title">Ajouter Nouveau Contrat</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span data-feather="x"></span></button>

                        </div>
                        <div class="modal-body">

                            <form enctype="multipart/form-data">
                                <div class="form-basic">


                                    <div class="row">
                                        <div class="col mt-6">



                                            <div class="form-group mb-25">
                                                <label>Titre</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    wire:model.defer='titre'>
                                                @error('titre')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Date Début</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="datedebut" wire:model.defer='datedebut'>
                                                @error('datedebut')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Date Fin</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="datefin" wire:model.defer='datefin'>
                                                @error('datefin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Montant</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="montant" wire:model.defer='montant'>
                                                @error('montant')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Type</label>
                                                <select name="avec" id="select-size-1" wire:model='type_contrat'
                                                    class="form-control  form-control-lg">
                                                    <option value="ouvrier" selected>Ouvrier</option>
                                                    <option value="fournisseur">Fournisseur</option>

                                                </select>
                                                @error('type_contrat')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            @if ($type_contrat == 'ouvrier')
                                                <div class="form-group mb-25">
                                                    <label>Type de Caisse</label>
                                                    <div class="row">
                                                        <div class="col mt-6">
                                                            <div class="form-group mb-25">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        value="particulier" checked
                                                                        wire:model='type_ouvrier'>
                                                                    <label class="form-check-label">
                                                                        Particulier
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col mt-6">
                                                            <div class="form-group mb-25">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        value="entreprise" wire:model='type_ouvrier'>
                                                                    <label class="form-check-label">
                                                                        Entreprise
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($type_ouvrier == 'particulier')
                                                    <div class="form-group mb-25 ">
                                                        <label>Ouvrier CIN</label>
                                                        <input class="form-control form-control-lg" type="text"
                                                            wire:model.defer='cin_ouvrier'>
                                                        @error('cin_ouvrier')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @elseif($type_ouvrier == 'entreprise')
                                                    <div class="form-group mb-25 ">
                                                        <label>Nom D'entreprise</label>
                                                        <input class="form-control form-control-lg" type="text"
                                                            wire:model.defer='name_entreprise'>
                                                        @error('name_entreprise')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-25 ">
                                                        <label>ICE</label>
                                                        <input class="form-control form-control-lg" type="text"
                                                            wire:model.defer='ice_entreprise'>
                                                        @error('ice_entreprise')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                @endif
                                            @elseif($type_contrat == 'fournisseur')
                                                <div class="form-group mb-25 ">
                                                    <label>ICE</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        wire:model.defer='ice_fournisseur'>
                                                    @error('ice_fournisseur')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                            <div class="form-group mb-25 ">
                                                <label>Projet</label>
                                                <select wire:model.defer='id_projet'
                                                    class="form-control  form-control-lg">
                                                    <option selected>select project</option>
                                                    @foreach ($projects as $p)
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
                        </div>
                        <div class="modal-footer">
                            <button wire:click.prevent="saveContrat" type="submit"
                                class="btn btn-primary btn-sm">Enregistrer
                                Contrat</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        {{-- edit Contrat model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Modifier Contrat</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">



                        <form wire:submit.prevent='editData'>

                            <div class="form-basic">


                                <div class="row">
                                    <div class="col mt-6">



                                        <div class="form-group mb-25">
                                            <label>Titre</label>
                                            <input class="form-control form-control-lg" type="text"
                                                wire:model.defer='titre'>
                                            @error('titre')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Date Début</label>
                                            <input class="form-control form-control-lg" type="date"
                                                name="datedebut" wire:model.defer='datedebut'>
                                            @error('datedebut')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Date Fin</label>
                                            <input class="form-control form-control-lg" type="date" name="datefin"
                                                wire:model.defer='datefin'>
                                            @error('datefin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Montant</label>
                                            <input class="form-control form-control-lg" type="text" name="montant"
                                                @if ($isAvanceExists == false) disabled value="{{$montant}}" @else wire:model.defer='montant' @endif >
                                            @error('montant')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Type</label>
                                            <select name="avec" id="select-size-1" wire:model='type_contrat'
                                                class="form-control  form-control-lg">
                                                <option value="ouvrier" selected>Ouvrier</option>
                                                <option value="fournisseur">Fournisseur</option>

                                            </select>
                                            @error('type_contrat')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @if ($type_contrat == 'ouvrier')
                                            <div class="form-group mb-25">
                                                <label>Type de L'ouvrier</label>
                                                <div class="row">
                                                    <div class="col mt-6">
                                                        <div class="form-group mb-25">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    value="particulier" checked
                                                                    wire:model='type_ouvrier'>
                                                                <label class="form-check-label">
                                                                    Particulier
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col mt-6">
                                                        <div class="form-group mb-25">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    value="entreprise" wire:model='type_ouvrier'>
                                                                <label class="form-check-label">
                                                                    Entreprise
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($type_ouvrier == 'particulier')
                                                <div class="form-group mb-25 ">
                                                    <label>Ouvrier CIN</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        wire:model.defer='cin_ouvrier'>
                                                    @error('cin_ouvrier')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @elseif($type_ouvrier == 'entreprise')
                                                <div class="form-group mb-25 ">
                                                    <label>Nom D'entreprise</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        wire:model.defer='name_entreprise'>
                                                    @error('name_entreprise')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-25 ">
                                                    <label>ICE</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        wire:model.defer='ice_entreprise'>
                                                    @error('ice_entreprise')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            @endif
                                        @elseif($type_contrat == 'fournisseur')
                                            <div class="form-group mb-25 ">
                                                <label>ICE</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    wire:model.defer='ice_fournisseur'>
                                                @error('ice_fournisseur')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif
                                        <div class="form-group mb-25 ">
                                            <label>Projet</label>
                                            <select wire:model.defer='id_projet'
                                                class="form-control  form-control-lg">
                                                <option selected>select project</option>
                                                @foreach ($projects as $p)
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
                                <button type="submit" wire:click.prevent="editData"
                                    class="btn btn-primary btn-sm">Enregistrer Contrat</button>
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
                                <h6>Voulez-vous supprimer cette Contrat</h6>
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
        {{-- delete selected modal --}}
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
                                <h6>Voulez-vous supprimer selected Contrat</h6>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">annuler</button>
                        <button type="button" wire:click.prevent='deleteSelected'
                            class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

                    </div>
                </div>
            </div>


        </div>


        {{-- add reglement model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="add-modal-reglement" tabindex="-1"
            role="dialog" aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Reglement</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">



                        <form wire:submit.prevent='saveReglement()'>
                            <div class="form-basic">


                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group mb-25">
                                            <label>Nom de Contrat</label>
                                            <input class="form-control form-control-lg" type="text" disabled
                                                value="{{ $name }}" name="name">


                                        </div>
                                    </div>
                                    <div class="col-6">

                                        <div class="form-group mb-25">
                                            <label>Montant(le reste)</label>
                                            <input class="form-control form-control-lg" type="text" disabled
                                                value="{{ $montant }} DH" name="montant">


                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-25">
                                    <label>Date Debut</label>
                                    <input class="form-control form-control-lg" type="date" name="datedebut"
                                        wire:model.defer='datedebut'>
                                    @error('datedebut')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group mb-25">
                                            <input class="radio" wire:model='methode' type="radio"
                                                value='cheque'>
                                            <label>
                                                <span class="radio-text">Avec chèque</span>
                                            </label>
                                        </div>

                                    </div>
                                    <div class="form-group mb-25">
                                        <input class="radio" wire:model='methode' type="radio" value='cash'>
                                        <label>
                                            <span class="radio-text">Avec Cash</span>
                                        </label>
                                    </div>
                                </div>

                                @if ($methode == 'cheque')
                                    <div class="form-group mb-25">
                                        <input class="form-control form-control-lg" type="text"
                                            name="numero_cheque" wire:model='numero_cheque'>
                                        @error('numero_cheque')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endIf
                                @if ($methode == 'cash')
                                    <div class="form-group mb-25">

                                        <label>Caisse </label>
                                        <select name="select-size-1" wire:model.defer='id_caisse' id="select-size-1"
                                            class="form-control  form-control-lg">

                                            <option value="" selected>select an option</option>
                                            @foreach ($caisses as $caisse)
                                                <option value="{{ $caisse->id }}">{{ $caisse->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('id_caisse')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                @endif

                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Enregistrer Reglement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        {{-- add avence model  --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="modal-addAvance" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Avence</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form enctype="multipart/form-data" wire:submit.prevent="saveAvance()">
                            <div class="form-basic">

                                <div class="form-group mb-25">
                                    <label>Methode</label>
                                    <div class="row">
                                        <div class="col mt-3">
                                            <div class="form-group mb-25">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="cach"
                                                        @if (count($caisses) == null) disabled @endif
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
                                                        @if (count($cheques) == null) disabled @endif
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
                                    @error('methode')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @if ($methode == 'cheque')
                                    <div class="form-group mb-25">

                                        {{-- <label>Numéro Cheque</label>
                                        <input class="form-control form-control-lg" type="text" name="numero_cheque"
                                            placeholder="Saisir Numéro de Cheque" wire:model.defer='numero_cheque' @if (count($check_cheque) == null) disabled @endif>
                                        @error('numero_cheque')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror --}}
                                        <div class="atbd-select">
                                            <select id="select-search" class="form-control"
                                                wire:model.defer='numero_cheque'>
                                                <option selected> select one option</option>
                                                @foreach ($cheques as $cheque)
                                                    <option value="{{ $cheque->numero }}">{{ $cheque->numero }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
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

                                @endif
                                <div class="form-group mb-25">
                                    <label class="required">Date</label>
                                    <input class="form-control form-control-lg" type="date"
                                        wire:model.defer='date_avance'>
                                    @error('date_avance')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-25">
                                    <label class="required">Montant</label>
                                    <input class="form-control form-control-lg" type="text" name="montant"
                                        wire:model.defer='montant'>
                                    @error('montant')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>


                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary btn-sm" value="Ajouter" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- add reglement  --}}
        <div wire:ignore.self class="modal fade" id="reglement-modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Ajouter Reglement</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow: hidden">
                        <form enctype="multipart/form-data" wire:submit.prevent="saveReglement()">
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Date</label>
                                    <input class="form-control form-control-lg" type="date"
                                        wire:model.defer='date'>
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Montant Total</label>
                                    <input class="form-control form-control-lg" type="text" disabled
                                        value="{{ $montant }} DH">
                                    @error('montant')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="form-group mb-25 col-lg-3">
                                        <input class="radio" wire:model="methode_reglement" type="radio"
                                            value="cach" @if (count($caisses) == null) disabled @endif>
                                        <label>
                                            <span class="radio-text">Avec Cach</span>
                                        </label>
                                    </div>
                                    <div class="form-group mb-25 col-lg-3">
                                        <input class="radio" wire:model="methode_reglement" type="radio"
                                            @if (count($cheques) == null) disabled @endif value="cheque">
                                        <label>
                                            <span class="radio-text">Avec chèque</span>
                                        </label>
                                    </div>
                                    <div class="form-group mb-25 col-lg-3">
                                        <input class="radio" wire:model="methode_reglement" type="radio"
                                            value="virement">
                                        <label>
                                            <span class="radio-text">Avec Virement</span>
                                        </label>
                                    </div>
                                    <div class="form-group mb-25 col-lg-3">
                                        <input class="radio" wire:model="methode_reglement" type="radio"
                                            value="med">
                                        <label>
                                            <span class="radio-text">MED</span>
                                        </label>
                                    </div>
                                </div>




                                @if ($methode_reglement == 'cheque' && count($cheques) > 0)
                                    <div class="form-group mb-25 ">
                                        <label>
                                            Numéro de Cheque
                                        </label>
                                        <input class="form-control form-control-lg" type="text"
                                            placeholder="search.." wire:model.defer="numero_cheque"
                                            list="chequeList">
                                        @error('numero_cheque')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <datalist id="chequeList">
                                            @foreach ($cheques as $ch)
                                                <option value="{{ $ch->numero }}"></option>
                                            @endforeach
                                        </datalist>

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Cheque(PDF)</label>
                                        <input class="form-control form-control-lg" type="file"
                                            wire:model.defer='cheque_pdf'>
                                        @error('cheque_pdf')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Montant de Cheque</label>
                                        <input class="form-control form-control-lg" type="text"
                                            placeholder="0000.00 DH" wire:model.defer='montant_cheque'>
                                        @error('montant_cheque')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @elseif($methode_reglement == 'virement')
                                    <div class="form-group mb-25">
                                        <label>Réf Virement</label>
                                        <input class="form-control form-control-lg" type="text"
                                            wire:model.defer='ref_virement'>
                                        @error('ref_virement')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @elseif($methode_reglement == 'med')
                                    <div class="form-group mb-25">
                                        <label>Réf MED</label>
                                        <input class="form-control form-control-lg" type="text"
                                            wire:model.defer='ref_med'>
                                        @error('ref_med')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @elseif($methode_reglement == 'cach')
                                    <div class="form-group mb-25">
                                        <label>Caisse </label>
                                        <select name="select-size-1" wire:model.defer='id_caisse' id="select-size-1"
                                            class="form-control  form-control-lg">
                                            <option>select option</option>
                                            @foreach ($caisses as $caisse)
                                                <option value="{{ $caisse->id }}">{{ $caisse->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('id_caisse')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Sold Total </label>
                                        <input class="form-control form-control-lg" type="text" disabled>
                                    </div>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Enregistrer
                            Règlement</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
