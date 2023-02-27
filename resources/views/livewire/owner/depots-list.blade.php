<div>
    <div>
        <div class="contents">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Depot</h4>
                                <div class="col-md-6">
                                    <div class="search-result global-shadow rounded-pill bg-white">

                                        <div
                                            class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1 border-0">
                                            <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                            <input wire:model="search" class="form-control border-0 box-shadow-none"
                                                type="search" placeholder="chercher par numero_cheque..."
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





            @if ($depots->count() > 0)
                <div class="container-fluid">

                    {{-- @if (!$bulkDisabled)
                        <div class="action-btn mb-3">
                            <button type="button" class="btn btn-sm btn-danger" wire:click="deleteSelected">
                                <i class="la la-trash"></i>delete selected</button>
                        </div>
                    @endif --}}




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
                                                    <span class="userDatatable-title">Numero Cheque</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Libelle Caisse</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Date</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Montant</span>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title float-right">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($depots as $dep)
                                                <tr>
                                                    <td>
                                                        <div class="form-check">
                                                            <input type="checkbox" wire:model="selectedDepots"
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
                                                            {{ $dep->numero_cheque }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $dep->caisse->name }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $dep->dateC }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $dep->montant }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex">
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#edit-modal"
                                                                    wire:click='editDepot({{ $dep->id }})'><i
                                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                            </li>
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#modal-info-delete"
                                                                    wire:click='deleteDepot({{ $dep->id }})'
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
                                                {{ $depots->links('vendor.livewire.bootstrap') }}
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
                    table Depots is empty
                </div>
            @endif


            {{-- add Charge  modal --}}
            <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
                aria-hidden="true">


                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header">
                            <h6 class="modal-title">Ajouter Nouveau Depot</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span data-feather="x"></span></button>

                        </div>
                        <div class="modal-body">

                            <form enctype="multipart/form-data">
                                <div class="form-basic">
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger form-group mb-25">

                                            {{ session('error') }}

                                        </div>
                                    @endif
                                    <div class="form-group mb-25">
                                        <label>Montant</label>
                                        <input class="form-control form-control-lg" type="text" name="montant"
                                            wire:model.defer='montant'>
                                        @error('montant')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>numero_cheque</label>
                                        <input class="form-control form-control-lg" type="text"
                                            name="numero_cheque" wire:model.defer='numero_cheque'>
                                        @error('numero_cheque')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>dateC</label>
                                        <input class="form-control form-control-lg" type="date" name="dateC"
                                            wire:model.defer='dateC'>
                                        @error('dateC')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group mb-25 ">
                                        <label>Caisse</label>
                                        <select name="id_caisse" id="select-size-1" wire:model.defer='id_caisse'
                                            class="form-control  form-control-lg">
                                            <option value="" selected>select an option</option>
                                            @foreach ($caisses as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_caisse')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button wire:click.prevent="saveDepot" type="submit"
                                class="btn btn-primary btn-sm">Enregistrer
                                Depot</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        {{-- edit depot model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Modifier Depot</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form enctype="multipart/form-data">
                            <div class="form-basic">
                                @if (session()->has('error'))
                                    <div class="alert alert-danger form-group mb-25">

                                        {{ session('error') }}

                                    </div>
                                @endif
                                <div class="form-group mb-25">
                                    <label>Montant</label>
                                    <input class="form-control form-control-lg" type="text" name="montant"
                                        wire:model.defer='montant'>
                                    @error('montant')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>numero_cheque</label>
                                    <input class="form-control form-control-lg" type="text" name="numero_cheque"
                                        wire:model.defer='numero_cheque'>
                                    @error('numero_cheque')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Date</label>
                                    <input class="form-control form-control-lg" type="date" name="dateC"
                                        wire:model.defer='dateC'>
                                    @error('dateC')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group mb-25 ">
                                    <label>Caisse</label>
                                    <select name="id_caisse" id="select-size-1" wire:model.defer='id_caisse'
                                        class="form-control  form-control-lg">
                                        <option value="" selected>select an option</option>
                                        @foreach ($caisses as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" wire:click.prevent="updateDepot"
                            class="btn btn-primary btn-sm">Enregistrer Depot</button>
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
                            <h6>Voulez-vous supprimer ce depot</h6>
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
