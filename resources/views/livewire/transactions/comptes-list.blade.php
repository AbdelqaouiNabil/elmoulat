<div>
    <div>
        <div class="contents">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">

                                <h4 class="text-capitalize breadcrumb-title"> Comptes Banquaires</h4>
                                <div class="col-md-6">
                                    <div class="search-result global-shadow rounded-pill bg-white">

                                        <div
                                            class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1">
                                            <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                            <input wire:model="search" class="form-control border-0 box-shadow-none"
                                                type="search" placeholder="chercher par date ou numero de debut ..."
                                                aria-label="Search">
                                        </div>

                                    </div>
                                </div>
                                <div class="breadcrumb-action justify-content-center flex-wrap">

                                    <div class="action-btn">

                                        <button type="button" @if (count($comptes) == null) disabled @endif wire:click="resetInputs()"
                                            class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                            data-target="#modal-basic">
                                            <i class="la la-plus"></i>Ajouter</button>


                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if (count($banks) == null)
                <div class="alert alert-warning d-flex align-items-center mt-5" role="alert">
                    <span class="mr-2" aria-label="Warning:"><i
                            class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>
                    <div>
                        Vous deviez crée un compte banquaire avant de crée un chequier
                    </div>
                </div>
            @else
                @if (session()->has('success'))
                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">

                        {{ session('error') }}

                    </div>
                @endif
                @if (count($comptes) > 0)

                    <div class="container-fluid">

                        <div class="action-btn mb-3">

                            <button type="button" class=" btn btn-sm btn-danger btn-add"
                                @if ($bulkDisabled) hidden @endif data-target="#modal-all-delete"
                                data-toggle="modal">
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
                                                        <a href="" wire:click.prevent="sort('id')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Numéro</span>
                                                        <a href="" wire:click.prevent="sort('numero')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Date de création</span>
                                                        <a href="" wire:click.prevent="sort('date_creation')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Sold</span>
                                                        <a href="" wire:click.prevent="sort('sold')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>

                                                    <th>
                                                        <span class="userDatatable-title">Nom de Banque</span>
                                                        <a href="" wire:click.prevent="sort('bank_id')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Actions</span>
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>



                                                @foreach ($comptes as $compte)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" wire:model="selectRows"
                                                                    value="{{ $compte->id }}">

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $compte->id }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $compte->numero }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $compte->date_creation }}
                                                            </div>
                                                        </td>


                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $compte->sold }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $compte->bank->nom }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex">

                                                                <li><a href="#" class="remove" data-toggle="modal"
                                                                        data-target="#edit-modal"
                                                                        wire:click='edit({{ $compte->id }})'><i
                                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                                </li>
                                                                <li><a href="#" class="remove" data-toggle="modal"
                                                                        data-target="#modal-info-delete"
                                                                        wire:click='delete({{ $compte->id }})'
                                                                        style="color: red;"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </li>

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table><!-- End: table -->
                                    </div>
                                    <div
                                        class="d-flex justify-content-sm-end justify-content-start mt-15 pt-25 border-top">

                                        <nav class="atbd-page ">
                                            <ul class="atbd-pagination d-flex">
                                                <li class="atbd-pagination__item">
                                                    {{ $comptes->links('vendor.livewire.bootstrap') }}
                                                </li>
                                                <li class="atbd-pagination__item">
                                                    <div class="paging-option">
                                                        <select wire:model="pages" name="page-number"
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
                        table Compts is empty
                    </div>

                @endif
            @endif
            {{-- edit compte modal START --}}
            <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
                aria-hidden="true">


                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header">



                            <h6 class="modal-title">Modifier Projet</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span data-feather="x"></span></button>
                        </div>
                        <div class="modal-body">

                            <form>


                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Numéro de compte</label>
                                        <input class="form-control form-control-lg" type="number"
                                            wire:model.defer='numero'>
                                        @error('numero')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Date de création</label>
                                        <input class="form-control form-control-lg" type="date"
                                            wire:model.defer='datecreation'>
                                        @error('datecreation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Sold</label>
                                        <input class="form-control form-control-lg" type="number"
                                            wire:model.defer='sold'>
                                        @error('sold')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Bank </label>

                                        <select name="bank" wire:model.defer='bankId' id="select-size-1"
                                            class="form-control  form-control-lg">
                                            <option value="" selected>select an option</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->nom }}</option>
                                            @endforeach

                                        </select>
                                        @error('bankID')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button wire:click.prevent='editData' class="btn btn-primary btn-sm">Enregistrer
                                        Modification</button>
                                </div>



                            </form>
                        </div>
                    </div>


                </div>
            </div>



            {{-- edit compte model END --}}

            {{-- delete model START --}}



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
                                    <h6>Voulez-vous supprimer ce compte</h6>
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

            {{-- delete model END --}}
            {{-- delete selected model start --}}

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
                                    <h6>Do you Want to delete these items?</h6>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="button" class="btn btn-danger btn-outlined btn-sm"
                                data-dismiss="modal">No</button>
                            <button type="button" wire:click='deleteSelected'
                                class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">Yes</button>

                        </div>
                    </div>
                </div>


            </div>
            {{-- delete selected model end --}}

            {{-- add compte model START --}}


            <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
                aria-hidden="true">


                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content modal-bg-white ">
                        <div class="modal-header">



                            <h6 class="modal-title">Ajouter Nouveau compte</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span data-feather="x"></span></button>
                        </div>
                        <div class="modal-body">


                            <form enctype="multipart/form-data">
                                <div class="form-basic">
                                    <div class="form-group mb-25">
                                        <label>Numéro de compte</label>
                                        <input class="form-control form-control-lg" type="number"
                                            wire:model.defer='numero'>
                                        @error('numero')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Date de création</label>
                                        <input class="form-control form-control-lg" type="date"
                                            wire:model.defer='datecreation'>
                                        @error('datecreation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Sold</label>
                                        <input class="form-control form-control-lg" type="number"
                                            wire:model.defer='sold'>
                                        @error('sold')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Bank </label>

                                        <select name="bank" wire:model.defer='bankId' id="select-size-1"
                                            class="form-control  form-control-lg">
                                            <option value="" selected>select an option</option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}">{{ $bank->nom }}</option>
                                            @endforeach

                                        </select>
                                        @error('bankID')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>



                                    <div class="modal-footer">
                                        <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Ajouter
                                            compte</button>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- add compte model END --}}



        </div>
