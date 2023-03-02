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
            @if ($contrats->count() > 0)
                <div class="container-fluid">
                    @if (!$bulkDisabled)
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
                                                    <a href="" wire:click.prevent="sort('id')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Nom de contrat</span>
                                                    <a href="" wire:click.prevent="sort('name')"><i
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
                                                    <a href="" wire:click.prevent="sort('name')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Ouvrier</span>
                                                    <a href="" wire:click.prevent="sort('name')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Projet</span>
                                                    <a href="" wire:click.prevent="sort('name')"><i
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
                                                            {{ $c->name }}
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
                                                            {{ $c->avance }} DH
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->montant - $c->avance }} DH
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->cin_Ouv }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            @if (!is_null($c->projet))
                                                                {{ $c->projet->name }}
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex">
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#add-modal-reglement"
                                                                    wire:click='addReglement({{ $c->id }})'><i
                                                                        class="fa-solid fa-plus"></i></a>
                                                            </li>
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#edit-modal"
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

                                    @if (session()->has('error'))
                                        <div class="alert alert-danger" class="form-group mb-25">

                                            {{ session('error') }}

                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col mt-6">



                                            <div class="form-group mb-25">
                                                <label>Nom de contrat</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="name" wire:model.defer='name'>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Date Debut</label>
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
                                                <label>Avance</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="avance" wire:model.defer='avance'>
                                                @error('avance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-25 ">
                                                <label>Ouvrier CIN</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="cin_Ouv" wire:model.defer='cin_Ouv'>
                                                @error('cin_Ouv')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-25 ">
                                                <label>Projet</label>
                                                <select name="id_projet" id="select-size-1"
                                                    wire:model.defer='id_projet'
                                                    class="form-control  form-control-lg">
                                                    <option selected>Select a project</option>
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

                        @if (session()->has('error'))
                            <div class="alert alert-danger">

                                {{ session('error') }}

                            </div>
                        @endif

                        <form wire:submit.prevent='editData'>
                            <div class="form-basic">




                                <div class="row">
                                    <div class="col mt-6">



                                        <div class="form-group mb-25">
                                            <label>Nom de Contrat</label>
                                            <input class="form-control form-control-lg" type="text" name="name"
                                                wire:model.defer='name'>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Date Debut</label>
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
                                                wire:model.defer='montant'>
                                            @error('montant')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Avance</label>
                                            <input class="form-control form-control-lg" type="text" name="avance"
                                                wire:model.defer='avance'>
                                            @error('avance')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Ouvrier</label>
                                            <input class="form-control form-control-lg" type="text" name="cin_Ouv"
                                                wire:model.defer='cin_Ouv'>
                                            @error('cin_Ouv')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-25 ">
                                            <label>Projet</label>
                                            <select name="id_projet" id="select-size-1" wire:model.defer='id_projet'
                                                class="form-control  form-control-lg">
                                                <option selected>Select a project</option>
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
                                <button type="submit" wire:click.prevent="updateContrat"
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
                                        <select name="select-size-1" wire:model.defer='id_caisse'
                                            id="select-size-1" class="form-control  form-control-lg">

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
    </div>

</div>
