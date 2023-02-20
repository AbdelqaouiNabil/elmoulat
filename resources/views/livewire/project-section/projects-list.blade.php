<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title"> Projets</h4>
                            <div class="col-md-6">
                                <div class="search-result global-shadow rounded-pill bg-white">

                                    <div class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1">
                                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <input wire:model="search" class="form-control border-0 box-shadow-none"
                                            type="search" placeholder="chercher par nom  ou ville ..."
                                            aria-label="Search">
                                    </div>

                                </div>
                            </div>
                            <div class="breadcrumb-action justify-content-center flex-wrap">

                                <div class="dropdown action-btn">
                                    <button @if (count($bureaus) == null || count($caisses) == null) disabled @endif
                                        class="btn btn-sm btn-default btn-white dropdown-toggle" type="button"
                                        id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="la la-download"></i> Exporter
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <span class="dropdown-item">Exporter</span>
                                        <div class="dropdown-divider"></div>
                                        <a href="" class="dropdown-item">
                                            <i class="la la-print"></i> Printer</a>
                                        <a href="{{route('admin.pdf',['id'=>$selectedProjects])}}" target="_blank" type="application/pdf" class="dropdown-item">
                                            <i class="la la-file-pdf"></i> PDF</a>
                                        <i class="la la-file-excel"></i> Excel (XLSX)</a>
                                        <a href="" class="dropdown-item" wire:click.prevent='export()'>
                                            <i class="la la-file-csv"></i> CSV</a>
                                    </div>
                                </div>
                                <div class="action-btn">

                                    <button @if (count($bureaus) == null || count($caisses) == null) disabled @endif type="button"
                                        class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                        data-target="#modal-import">
                                        <i class="la la-plus"></i>Importer</button>

                                </div>

                                <div class="action-btn">

                                    <button @if (count($bureaus) == null || count($caisses) == null) disabled @endif type="button" wire:click="resetInputs()"
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
        @if (count($bureaus) == null)
            <div class="alert alert-warning d-flex align-items-center mt-5" role="alert">
                <span class="mr-2" aria-label="Warning:"><i
                        class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>
                <div>
                    Vous deviez crée un Breau avant de crée un Projet
                </div>
            </div>
        @else
            @if (count($caisses) == null)
                <div class="alert alert-warning d-flex align-items-center mt-5" role="alert">
                    <span class="mr-2" aria-label="Warning:"><i
                            class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>
                    <div>
                        Vous deviez crée un Caisse avant de crée un Projet
                    </div>
                </div>
            @else
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}

                    </div>
                @endif
                @if ($projets->count() > 0)
                    <div class="container-fluid">
                        <div class="action-btn mb-3">

                            <button type="button" class="btn btn-sm btn-danger"
                                @if ($bulkDisabled) hidden @endif data-toggle="modal"
                                data-target="#modal-all-delete">
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
                                                        <span class="userDatatable-title">Id</span>
                                                        <a href="" wire:click.prevent="sort('id')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Nom de Projet</span>
                                                        <a href="" wire:click.prevent="sort('name')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Image</span>
                                                        <a href="" wire:click.prevent="sort('image')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Ville</span>
                                                        <a href="" wire:click.prevent="sort('ville')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Adresse</span>
                                                        <a href="" wire:click.prevent="sort('adress')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Consistance</span>
                                                        <a href="" wire:click.prevent="sort('consistance')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Titre Finance</span>
                                                        <a href=""
                                                            wire:click.prevent="sort('titre_finance')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>

                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Autorisation</span>
                                                        <a href="" wire:click.prevent="sort('autorisation')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>


                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Superfice</span>
                                                        <a href="" wire:click.prevent="sort('superfice')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>

                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Date de Début</span>
                                                        <a href="" wire:click.prevent="sort('datedebut')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>

                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Date de Fin</span>

                                                        <a href="" wire:click.prevent="sort('datefin')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>

                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title ">Bureau</span>
                                                        <a href="" wire:click.prevent="sort('id_bureau')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>

                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title ">Caisse</span>
                                                        <a href="" wire:click.prevent="sort('id_caisse')"><i
                                                                class="fa-sharp fa-solid fa-sort"></i></a>

                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-right">Actions</span>


                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($projets->count() > 0)

                                                    @foreach ($projets as $projet)
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox"
                                                                        wire:model="selectedProjects"
                                                                        value="{{ $projet->id }}">

                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->id }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->name }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    <img src="{{ Storage::disk('local')->url($projet->image) }}"
                                                                        width="100" />
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->ville }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->adress }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->consistance }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->titre_finance }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->autorisation }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->superfice }}
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->datedebut }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->datefin }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->bureau->nom }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $projet->caisse->name }}
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <ul class="orderDatatable_actions mb-0 d-flex">

                                                                    <li><a href="#" class="remove"
                                                                            data-toggle="modal"
                                                                            data-target="#edit-modal"
                                                                            wire:click='editProject({{ $projet->id }})'><i
                                                                                class="fa-regular fa-pen-to-square"></i></a>
                                                                    </li>
                                                                    <li><a href="#" class="remove"
                                                                            data-toggle="modal"
                                                                            data-target="#modal-info-delete"
                                                                            wire:click='deleteProject({{ $projet->id }})'
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
                                    <div
                                        class="d-flex justify-content-sm-end justify-content-start mt-15 pt-25 border-top">

                                        <nav class="atbd-page ">
                                            <ul class="atbd-pagination d-flex">
                                                <li class="atbd-pagination__item">
                                                    {{ $projets->links('vendor.livewire.bootstrap') }}
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

                        Table Project is empty
                    </div>

                @endif
            @endif
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

                                    <label>Importer des projets depuis un fichier xlxs</label>
                                    <input class="form-control form-control-lg" type="file" name="exelFile"
                                        wire:model.defer='exelFile'>
                                    @error('exelFile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">Annuler</button>
                        <button type="submit" wire:click.prevent='importData'
                            class="btn btn-success btn-outlined btn-sm">Importer</button>

                    </div>
                    </form>
                </div>
            </div>


        </div>





        {{-- import modal end --}}

        {{-- add project  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Nouveau Projet</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data">
                            <div class="form-basic">

                                <div class="row ">
                                    <div class="col-lg-6">

                                        <div class="row ">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Nom de Projet</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="name" wire:model.defer='name'>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="row ">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Consistance</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="consistance" wire:model.defer='consistance'>
                                                @error('consistance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Titre Finance</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="titre_finance" wire:model.defer='titre_finance'>
                                                @error('titre_finance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Date de Début</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    wire:model.defer='dated' name="dated">
                                                <div
                                                    class="form-inline-action d-flex justify-content-between align-items-center">
                                                </div>
                                                @error('dated')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Caisse </label>
                                                <select name="select-size-1" wire:model.defer='id_caisse'
                                                    id="select-size-1" class="form-control  form-control-lg">
                                                    <option value="" selected>select an option</option>
                                                    @foreach ($caisses as $caisse)
                                                        <option value="{{ $caisse->id }}">{{ $caisse->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('id_caisse')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>ville</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="ville" wire:model.defer='ville'>
                                                @error('ville')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>




                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Superfice</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="superfice" wire:model.defer='superfice'>
                                                @error('superfice')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Autorisation</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="autorisation" wire:model.defer='autorisation'>
                                                @error('autorisation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Image</label>
                                                <input class="form-control form-control-lg" type="file"
                                                    name="iamge" wire:model.defer='image'>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Date de Fin</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    wire:model.defer='datef' name="datef">
                                                <div
                                                    class="form-inline-action d-flex justify-content-between align-items-center">
                                                </div>
                                                @error('datef')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Bureau </label>
                                                <select name="select-size-1" wire:model.defer='id_bureau'
                                                    id="select-size-1" class="form-control  form-control-lg">
                                                    <option value="" selected>select an option</option>
                                                    @foreach ($bureaus as $bureau)
                                                        <option value="{{ $bureau->id }}">{{ $bureau->nom }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('id_bureau')
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

                            <div class="modal-footer">
                                <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Enregistrer
                                    Projet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>






        {{-- edit project model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Edit Projet</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form wire:submit.prevent='editData()'>
                            <div class="form-basic">

                                <div class="row ">
                                    <div class="col-lg-6">

                                        <div class="row ">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Nom de Projet</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="name" wire:model.defer='name'>
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="row ">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Consistance</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="consistance" wire:model.defer='consistance'>
                                                @error('consistance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Titre Finance</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="titre_finance" wire:model.defer='titre_finance'>
                                                @error('titre_finance')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Date de Début</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    wire:model.defer='dated' name="dated">
                                                <div
                                                    class="form-inline-action d-flex justify-content-between align-items-center">
                                                </div>
                                                @error('dated')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Caisse </label>
                                                <select name="select-size-1" wire:model.defer='id_caisse'
                                                    id="select-size-1" class="form-control  form-control-lg">
                                                    <option value="" selected>select an option</option>
                                                    @foreach ($caisses as $caisse)
                                                        <option value="{{ $caisse->id }}">{{ $caisse->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('id_caisse')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Ville</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="ville" wire:model.defer='ville'>
                                                @error('ville')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Superfice</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="superfice" wire:model.defer='superfice'>
                                                @error('superfice')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Autorisation</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="autorisation" wire:model.defer='autorisation'>
                                                @error('autorisation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Date de Fin</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    wire:model.defer='datef' name="datef">
                                                <div
                                                    class="form-inline-action d-flex justify-content-between align-items-center">
                                                </div>
                                                @error('datef')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Bureau </label>
                                                <select name="select-size-1" wire:model.defer='id_bureau'
                                                    id="select-size-1" class="form-control  form-control-lg">
                                                    <option value="" selected>select an option</option>
                                                    @foreach ($bureaus as $bureau)
                                                        <option value="{{ $bureau->id }}">{{ $bureau->nom }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('id_bureau')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Addresse</label>
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



                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Edit Projet</button>
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
                                <h6>Voulez-vous supprimer ce projet</h6>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">Annuler</button>
                        <button type="button" wire:click.prevent='deleteData'
                            class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">Supprimer</button>

                    </div>
                </div>
            </div>


        </div>




        <!-- ends: .modal-info-Delete -->

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
                                <h6>Voulez-vous supprimer ce projet</h6>
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
        @push('scripts')
            <script>
                window.addEventListener('close-model', event => {
                    $('#modal-basic').modal('hide');
                    $('#edit-modal').modal('hide');
                    $('#modal-info-delete').modal('hide');
                    $('#modal-import').modal('hide');
                })
            </script>
        @endpush

    </div>
</div>
