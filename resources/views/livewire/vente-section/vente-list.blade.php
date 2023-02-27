<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">ventes</h4>
                            <div class="col-md-6">
                                <div class="search-result global-shadow rounded-pill bg-white">

                                    <div
                                        class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1 border-0">
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
            </div>
        @endif
        @if ($ventes->count() > 0)
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
                                                <span class="userDatatable-title">titer</span>
                                                <a href="" wire:click.prevent="sort('titre')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Client</span>
                                                <a href="" wire:click.prevent="sort('client_id')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>

                                            <th>
                                                <span class="userDatatable-title">Projet</span>
                                                <a href="" wire:click.prevent="sort('project_id')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>

                                            <th>
                                                <span class="userDatatable-title">Montant</span>
                                                <a href="" wire:click.prevent="sort('montant')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>

                                            <th>
                                                <span class="userDatatable-title">Montant Réal </span>
                                                <a href="" wire:click.prevent="sort('montantReal')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title"> Le Reste </span>
                                                <a href="" wire:click.prevent="sort('reste')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title"> Payé </span>
                                                <a href="" wire:click.prevent="sort('paye')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Contrat</span>
                                                <a href="" wire:click.prevent="sort('contrat')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Actions</span>
                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody>



                                        @foreach ($ventes as $vente)
                                            <tr>
                                                <td>

                                                    <input type="checkbox" wire:model="checked_id"
                                                        value="{{ $vente->id }}">

                                                </td>

                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $vente->id }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $vente->titre }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $vente->client->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $vente->project->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $vente->montant }} DH
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $vente->montantReal }} DH
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $vente->reste }} DH
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $vente->paye }} DH
                                                    </div>
                                                </td>


                                                <td>
                                                    <div class="orderDatatable-title">
                                                        <a href=" {{ Storage::disk('local')->url($vente->contrat) }}"
                                                            target="_blank" type="application/pdf"
                                                            style="color: red; font-size:20px;"><i
                                                                class="fa-solid fa-file-pdf"></i></a>
                                                    </div>
                                                </td>

                                                <td>
                                                    <ul class="orderDatatable_actions mb-0 d-flex">
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#modal-afficher"
                                                                wire:click='afficher({{ $vente->id }})'><i
                                                                    style="color:rgb(21, 126, 218)"
                                                                    class="fa-solid fa-eye"></i></a>
                                                        </li>
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#modal-addAvence"
                                                                wire:click='addAvence({{ $vente->id }})'><i
                                                                    style="color:rgb(117, 187, 12)"
                                                                    class="fa-solid fa-circle-plus"></i></a>
                                                        </li>
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#edit-modal"
                                                                wire:click='editvente({{ $vente->id }})'><i
                                                                    class="fa-regular fa-pen-to-square"></i></a>
                                                        </li>
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#modal-info-delete"
                                                                wire:click='deletevente({{ $vente->id }})'
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
                                            {{ $ventes->links('vendor.livewire.bootstrap') }}
                                        </li>
                                        <li class="atbd-pagination__item">
                                            <div class="paging-option">
                                                <select name="page-number" class="page-selection" wire:model="pages">
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
                table ventes is empty
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

                                    <label>Importer des ventes depuis un fichier xlxs</label>
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

        {{-- add vente  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Nouveau vente</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">


                        <form enctype="multipart/form-data" wire:submit.prevent="saveData()">
                            <div class="form-basic">
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Titre</label>
                                                <input class="form-control form-control-lg" type="titre"
                                                    name="titre" wire:model.defer='titre'>
                                                @error('titre')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="form-group mb-25 col-lg-12">

                                                <label>Projet </label>
                                                <select name="select-size-1" wire:model.defer='id_project'
                                                    id="select-size-1" class="form-control  form-control-lg">

                                                    <option selected>select an option</option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->id }}">{{ $project->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                @error('id_project')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Date</label>
                                                <input class="form-control form-control-lg" type="date"
                                                    name="dateV" wire:model.defer='dateV'>
                                                @error('dateV')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Montant</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="montant" wire:model.defer='montant'>
                                                @error('montant')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Montant Réal</label>
                                                <input class="form-control form-control-lg" type="text"
                                                    name="montantReal" wire:model.defer='montantReal'>
                                                @error('montantReal')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group mb-25 col-lg-12">
                                                <label>Contrat(PDF)</label>
                                                <input class="form-control form-control-lg" type="file"
                                                    name="contrat" wire:model.defer='contrat'>
                                                @error('contrat')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        @if ($cb_client == false)
                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>Nom Client <input type="checkbox" wire:model='cb_client'>
                                                        (<i style="color:rgb(160, 160, 18)"
                                                            class="fa-solid fa-triangle-exclamation"></i>check if
                                                        client exist)</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        name="name" wire:model.defer='name'>
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="form-group mb-25 col-lg-12">
                                                    <label class="required">CIN</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        name="n_cin" wire:model.defer='n_cin'>
                                                    @error('n_cin')
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
                                                    <label>Ville de Résidence</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        wire:model.defer='ville_de_resi'>
                                                    @error('ville_de_resi')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>CIN(PDF)</label>
                                                    <input class="form-control form-control-lg" type="file"
                                                        name="cin" wire:model.defer='cin'>
                                                    @error('cin')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>CIN<input type="checkbox" wire:model='cb_client'> (<i
                                                            style="color:rgb(160, 160, 18)"
                                                            class="fa-solid fa-triangle-exclamation"></i>uncheck if
                                                        client doesn't exist)</label>
                                                    <input class="form-control form-control-lg" type="text"
                                                        name="n_cin" wire:model.defer='n_cin'>
                                                    @error('n_cin')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @if (session()->has('myerror'))
                                                        <span class="text-danger">{{ session('myerror') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        @endif

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

        {{-- edit model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Modifier Vente</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form enctype="multipart/form-data" wire:submit.prevent="editData()">
                            <div class="form-basic">


                                <div class="form-group mb-25">
                                    <label class="required">Titre</label>
                                    <input class="form-control form-control-lg" type="text" name="titre"
                                        wire:model.defer='titre'>
                                    @error('titre')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label class="required">Date</label>
                                    <input class="form-control form-control-lg" type="date" name="dateV"
                                        wire:model.defer='dateV'>
                                    @error('dateV')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Projet </label>
                                    <select name="select-size-1" wire:model.defer='id_project' id="select-size-1"
                                        class="form-control  form-control-lg">

                                        <option selected>select an option</option>
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('id_project')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Client </label>
                                    <select name="select-size-1" wire:model.defer='id_project' id="select-size-1"
                                        class="form-control  form-control-lg">
                                        <option selected>select an option</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->n_cin }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('id_client')
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
                                <div class="form-group mb-25">
                                    <label class="required">Montant Real</label>
                                    <input class="form-control form-control-lg" type="text" name="montantReal"
                                        wire:model.defer='montantReal'>
                                    @error('montantReal')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

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


        {{-- add avence model  --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="modal-addAvence" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Avence</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form enctype="multipart/form-data" wire:submit.prevent="saveAvence()">
                            <div class="form-basic">


                                <div class="form-group mb-25">
                                    <label>Client</label>
                                    <input class="form-control form-control-lg" type="text" disabled
                                        wire:model.defer='clientname'>
                                </div>
                                <div class="form-group mb-25">
                                    <label>Titre</label>
                                    <input class="form-control form-control-lg" type="text" disabled
                                        wire:model.defer='titre'>
                                </div>
                                <div class="form-group mb-25">
                                    <label class="required">Type</label>
                                    <input class="form-control form-control-lg" type="text" name="type"
                                        wire:model.defer='type'>
                                    @error('type')
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

        {{-- for afficher avence data  --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="modal-afficher" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title"> Liste d'avence </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa-regular fa-circle-xmark"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-6"> <h6>Client : <span style="color:#5f63f2 ; margin:5px">{{ $name }}</span> </h6></div>
                            
                            <div class="col-6"> <h6>Total : <span style="color:#0be537 ; margin:5px">{{ $totalavence }}</span> </h6></div>
                        </div>

                        <table class="table mb-0 table-borderless border-0">
                            <thead>
                                <tr style="background: #5f63f2; color:white; border-radius:10px">
                                    <th>id</th>
                                    <th>date</th>
                                    <th>type</th>
                                    <th>montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($avences as $avence)
                                    <tr>
                                        <td>{{ $avence->id }}</td>
                                        <td>{{ $avence->dateA }}</td>
                                        <td>{{ $avence->type }}</td>
                                        <td>{{ $avence->montant }}</td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

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
                                <h6>Voulez-vous supprimer ce vente</h6>
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
                                <h6>Voulez-vous supprimer ce vente</h6>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">annuler</button>
                        <button type="button" wire:click.prevent='deletecheckedvente()'
                            class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

                    </div>
                </div>
            </div>


        </div>

        <!-- ends: .modal-info-Delete -->

    </div>
</div>
