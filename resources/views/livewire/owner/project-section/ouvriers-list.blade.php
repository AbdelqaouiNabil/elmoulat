<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Ouvriers</h4>
                            <div class="col-md-6">
                                <div class="search-result global-shadow rounded-pill bg-white">

                                    <div class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1 border-0">
                                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <input wire:model="search" class="form-control border-0 box-shadow-none"
                                            type="search" placeholder="chercher par nom et prenom ou cin ..."
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

                                    <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                        data-target="#modal-import">
                                        <i class="la la-plus"></i>importer</button>


                                </div>

                                <div class="action-btn">

                                    <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                        data-target="#modal-basic">
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

        @if (session()->has('error'))
            <div class="alert alert-danger">

                {{ session('error') }}
        @endif
        @if ($ouvriers->count() > 0)
            <div class="container-fluid">
                <div class="action-btn mb-3">

                    <button type="button" class=" btn btn-sm btn-danger btn-add"
                        @if ($btndelete) hidden @endif data-target="#modal-all-delete"
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
                                                <input type="checkbox" wire:model="selectAll">
                                            </th>

                                            <th>
                                                <span class="userDatatable-title">id</span>
                                                <a href="" wire:click.prevent="sort('id')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Nom et Prenom</span>
                                                <a href="" wire:click.prevent="sort('nom')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>

                                            <th>
                                                <span class="userDatatable-title">cin</span>
                                                <a href="" wire:click.prevent="sort('cin')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">numero cin</span>
                                                <a href="" wire:click.prevent="sort('n_cin')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Phone</span>
                                                <a href="" wire:click.prevent="sort('phone')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">date de naissance </span>
                                                <a href="" wire:click.prevent="sort('datenais')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">date debut</span>
                                                <a href="" wire:click.prevent="sort('datedebut')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">observation</span>
                                                <a href="" wire:click.prevent="sort('observation')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">notation</span>
                                                <a href="" wire:click.prevent="sort('notation')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">adress</span>
                                                <a href="" wire:click.prevent="sort('adress')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">email</span>
                                                <a href="" wire:click.prevent="sort('email')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Actions</span>
                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if ($ouvriers->count() > 0)

                                            @foreach ($ouvriers as $ouvrier)
                                                <tr>
                                                    <td>

                                                        <input type="checkbox" wire:model="checked_id"
                                                            value="{{ $ouvrier->id }}">

                                                    </td>

                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->id }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->nom }}
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            <a href=" {{ Storage::disk('local')->url($ouvrier->cin) }}"
                                                                target="_blank" type="application/pdf"
                                                                style="color: red; font-size:20px;"><i
                                                                    class="fa-solid fa-file-pdf"></i></a>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->n_cin }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->phone }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->datenais }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->datedebut }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->observation }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->notation }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->adress }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $ouvrier->email }}
                                                        </div>
                                                    </td>



                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex">

                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#edit-modal"
                                                                    wire:click='editOuvrier({{ $ouvrier->id }})'><i
                                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                            </li>
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#modal-info-delete"
                                                                    wire:click='deleteOuvrier({{ $ouvrier->id }})'
                                                                    style="color: red;"><i
                                                                        class="fa-solid fa-trash"></i></a>
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        @endif

                                        <!-- End: tr -->







                                    </tbody>
                                </table><!-- End: table -->
                            </div>
                            <div class="d-flex justify-content-sm-end justify-content-start mt-15 pt-25 border-top">

                                <nav class="atbd-page ">
                                    <ul class="atbd-pagination d-flex">
                                        <li class="atbd-pagination__item">
                                            {{ $ouvriers->links('vendor.livewire.bootstrap') }}
                                        </li>
                                        <li class="atbd-pagination__item">
                                            <div class="paging-option">
                                                <select name="page-number" class="page-selection"
                                                    wire:model="pages">
                                                    <option value="20">20/page</option>
                                                    <option value="40">40/page</option>
                                                    <option value="60">60/page</option>
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
                table ouvriers is empty
            </div>
        @endif
        {{-- import modal start --}}
        <div wire:ignore.self class="modal-info-delete modal fade show" id="modal-import" tabindex="-1"
            role="dialog" aria-hidden="true">


            <div class="modal-dialog modal-dialog-centered modal-info" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-info-body d-flex">
                            <div class="modal-info-icon warning">
                                <span data-feather="info"></span>
                            </div>
                            <form enctype="multipart/form-data">
                                <div class="form-group mb-25">

                                    <label>Importer des Ouvriers depuis un fichier xlxs</label>
                                    <input class="form-control form-control-lg" type="file" name="excelFile"
                                        wire:model.defer='excelFile'>
                                    @error('excelFile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">Annuler</button>
                        <button type="submit" wire:click.prevent='importData'
                            class="btn btn-success btn-outlined btn-sm">importer</button>

                    </div>
                    </form>
                </div>
            </div>


        </div>





        {{-- import modal end --}}

        {{-- add ouvrier  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Nouveau Ouvrier</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">


                        <form enctype="multipart/form-data">
                            <div class="form-basic">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Nom et Prenom</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="nom" wire:model.defer='nom'>
                                                @error('nom')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>CIN</label>
                                                <input class="form-control form-control-lg" type="file"
                                                    name="cin" wire:model.defer='cin'>
                                                @error('cin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Numero CIN</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="n_cin" wire:model.defer='n_cin'>
                                                @error('n_cin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>date de naissance</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="datenais" wire:model.defer='datenais'>
                                                @error('datenais')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Email</label>
                                                <input class="form-control form-control-lg" type="email"
                                                    name="email" wire:model.defer='email'>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>observation</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="observation" wire:model.defer='observation'>
                                                @error('observation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>notation</label>
                                                <input class="form-control form-control-lg" type="number"
                                                    name="notation" wire:model.defer='notation'>
                                                @error('notation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Phone</label>
                                                <input class="form-control form-control-lg" type="number"
                                                    name="phone" wire:model.defer='phone'>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>date de debut</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="datedebut" wire:model.defer='datedebut'>
                                                @error('datedebut')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Adress</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="adress" wire:model.defer='adress'>
                                                @error('adress')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                </div>



                            </div>




                    </div>
                    <div class="modal-footer">
                        <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Enregistrer
                            Ouvrier</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>




        {{-- edit project model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Modifier Ouvrier</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form enctype="multipart/form-data" wire:submit.prevent="editData()">
                            <div class="form-basic">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Nom de ouvrier</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="nom" wire:model.defer='nom'>
                                                @error('nom')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Email</label>
                                                <input class="form-control form-control-lg" type="email"
                                                    name="email" wire:model.defer='email'>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Numero CIN</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="n_cin" wire:model.defer='n_cin'>
                                                @error('n_cin')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>date de naissance</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="datenais" wire:model.defer='datenais'>
                                                @error('datenais')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>observation</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="observation" wire:model.defer='observation'>
                                                @error('observation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>notation</label>
                                                <input class="form-control form-control-lg" type="number"
                                                    name="notation" wire:model.defer='notation'>
                                                @error('notation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Phone</label>
                                                <input class="form-control form-control-lg" type="number"
                                                    name="phone" wire:model.defer='phone'>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>date de debut</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="datedebut" wire:model.defer='datedebut'>
                                                @error('datedebut')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>


                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group mb-25 col-lg-12">
                                        <label>Adress</label>
                                        <input class="form-control form-control-lg" type="text" name="adress"
                                            wire:model.defer='adress'>
                                        @error('adress')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary btn-sm" value="Enregistrer" />
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
                                <h6>Voulez-vous supprimer ce Ouvrier</h6>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">annuler</button>
                        <button type="button" wire:click.prevent='deleteData()'
                            class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

                    </div>
                </div>
            </div>


        </div>



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
                                <h6>Voulez-vous supprimer ce Ouvrier</h6>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">annuler</button>
                        <button type="button" wire:click.prevent='deletecheckedouvrier()'
                            class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

                    </div>
                </div>
            </div>


        </div>

        <!-- ends: .modal-info-Delete -->
    </div>
</div>
