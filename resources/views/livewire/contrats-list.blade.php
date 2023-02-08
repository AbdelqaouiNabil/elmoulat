<div>
    <div>
        <div class="contents">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Contrat</h4>
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

            @if ($contrats->count() > 0)
                <div class="container-fluid">
                    <div class="action-btn mb-3">
                        <button type="button"
                            class="@if ($bulkDisabled) disabled @endif btn btn-sm btn-danger"
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
                                                    <span class="userDatatable-title">Nome de contrat</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Date Debut</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Date Fin</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Montant</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Avance</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Ouvrier</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title float-right">Actions</span>
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
                                                            {{ $c->montant }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->avance }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $c->ouvrier->n_cin }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex">

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
                                <div class="d-flex justify-content-sm-end justify-content-start mt-15 pt-25 border-top">

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
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <div>
                    <span class="mr-2" aria-label="Warning:"><i class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>Contrats table is empty
                </div>
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
                                            </div>
                                            <div class="form-group mb-25">
                                                <label>Date Fin</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="datefin" wire:model.defer='datefin'>
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
                                                <input class="form-control form-control-lg" type="avance"
                                                    name="avance" wire:model.defer='avance'>
                                                @error('avance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group mb-25 ">
                                                <label>Ouvrier CIN</label>
                                                <input class="form-control form-control-lg" type="ouvrierCIN"
                                                    name="ouvrierCIN" wire:model.defer='ouvrierCIN'>
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
                                        </div>
                                        <div class="form-group mb-25">
                                            <label>Date Fin</label>
                                            <input class="form-control form-control-lg" type="date" name="datefin"
                                                wire:model.defer='datefin'>
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
                                            <input class="form-control form-control-lg" type="text"
                                                name="ouvrierCIN" wire:model.defer='ouvrierCIN'>
                                            @error('ouvrierCIN')
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



    </div>




</div>
    {{-- </div>
    </div> --}}
