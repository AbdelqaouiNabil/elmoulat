<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Employe</h4>
                            <div class="col-md-6">
                                <div class="search-result global-shadow rounded-pill bg-white">

                                    <div
                                        class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1">
                                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <input wire:model="search" class="form-control border-0 box-shadow-none"
                                            type="search" placeholder="chercher par nom ou prenom ..."
                                            aria-label="Search">
                                    </div>

                                </div>
                            </div>
                            <div class="breadcrumb-action justify-content-center flex-wrap">

                                <div class="action-btn">

                                    <button @if(count($bureaus)==null) disabled @endif type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal"
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
                    Vous deviez crée un bureau avant de crée un employe
                </div>
            </div>
        @else
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
            @if ($employes->count()>0)
                <div class="container-fluid">
                    <div class="action-btn mb-3">

                        <button type="button" class=" btn btn-sm btn-danger btn-add  "
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
                                                    <input type="checkbox" wire:model="selectAll">
                                                </th>

                                                <th>
                                                    <span class="userDatatable-title">id</span>
                                                    <a href="" wire:click.prevent="sort('id')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Nom</span>
                                                    <a href="" wire:click.prevent="sort('nom')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Prénom</span>
                                                     <a href="" wire:click.prevent="sort('prenom')"><i
                                                    class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Date Naissance</span>
                                                     <a href="" wire:click.prevent="sort('datenais')"><i
                                                    class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Date Debut</span>
                                                     <a href="" wire:click.prevent="sort('datedebut')"><i
                                                    class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Phone Number</span>
                                                     <a href="" wire:click.prevent="sort('phone')"><i
                                                    class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Contrat</span>
                                                     <a href="" wire:click.prevent="sort('contrat')"><i
                                                    class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Designiation</span>
                                                     <a href="" wire:click.prevent="sort('designiation')"><i
                                                    class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Bureau</span>
                                                     <a href="" wire:click.prevent="sort('bureau_id')"><i
                                                    class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>

                                                <th>
                                                    <span class="userDatatable-title">Actions</span>
                                                </th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($employes->count() > 0)

                                                @foreach ($employes as $employe)
                                                    <tr>
                                                        <td>

                                                            <input type="checkbox" wire:model="selectRows"
                                                                value="{{ $employe->id }}">

                                                        </td>

                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $employe->id }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $employe->nom }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $employe->prenom }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $employe->datenais }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $employe->datedebut }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $employe->phone }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $employe->designiation }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $employe->contrat }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $employe->bureau_id }}
                                                            </div>
                                                        </td>



                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex">

                                                                <li><a href="#" class="remove" data-toggle="modal"
                                                                        data-target="#edit-modal"
                                                                        wire:click='edit({{ $employe->id }})'><i
                                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                                </li>
                                                                <li><a href="#" class="remove" data-toggle="modal"
                                                                        data-target="#modal-info-delete"
                                                                        wire:click='delete({{ $employe->id }})'
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
                                                {{ $employes->links('vendor.livewire.bootstrap') }}
                                            <li class="atbd-pagination__item">
                                                <div class="paging-option">
                                                    <select name="page-number" class="page-selection"
                                                        wire:model.defer="pages">
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
                    table Employe is empty
                </div>

            @endif
        @endif

        {{-- add Employe  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Nouveau employe </h6>
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
                                                    <label>Nom</label>
                                                    <input class="form-control form-control-lg" type="text" name="nom"
                                                        wire:model.defer='nom'>
                                                    @error('nom')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
            
                                                </div>
        
                                            </div>
                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>Date Naissance</label>
                                                    <input class="form-control form-control-lg" type="date" name="datenais"
                                                        wire:model.defer='datenais'>
                                                    @error('datenais')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>Prénom</label>
                                                    <input class="form-control form-control-lg" type="text" name="prenom"
                                                        wire:model.defer='prenom'>
                                                    @error('prenom')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
            
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>Date de Debut</label>
                                                    <input class="form-control form-control-lg" type="date" name="datedebut"
                                                        wire:model.defer='datedebut'>
                                                    @error('datedebut')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
            
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="form-group mb-25">
                                        <label>Phone Number</label>
                                        <input class="form-control form-control-lg" type="number" name="phone"
                                            wire:model.defer='phone'>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Contrat</label>
                                        <input class="form-control form-control-lg" type="text" name="contrat"
                                            wire:model.defer='contrat'>
                                        @error('contrat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Designiation</label>
                                        <input class="form-control form-control-lg" type="text"
                                            name="designiation" wire:model.defer='designiation'>


                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Salaire</label>
                                        <input class="form-control form-control-lg" type="number" name="salaire"
                                            wire:model.defer='salaire'>
                                        @error('salaire')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Bureau </label>
                                        <select name="select-size-1" wire:model.defer='bureau_id' id="select-size-1"
                                            class="form-control  form-control-lg">
                                            <option value="" selected>select an option</option>
                                            @foreach ($bureaus as $bureau)
                                                <option value="{{ $bureau->id }}">{{ $bureau->nom }}</option>
                                            @endforeach

                                        </select>
                                        @error('bureau_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>


                                </div>

                       


                    </div>
                    <div class="modal-footer">
                        <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Enregistrer
                            employe</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>






        {{-- edit domaine model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Edit Ouvrier</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                       

                            <form>
                                <div class="form-basic">
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>Nom</label>
                                                    <input class="form-control form-control-lg" type="text" name="nom"
                                                        wire:model.defer='nom'>
                                                    @error('nom')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
            
                                                </div>
        
                                            </div>
                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>Date Naissance</label>
                                                    <input class="form-control form-control-lg" type="date" name="datenais"
                                                        wire:model.defer='datenais'>
                                                    @error('datenais')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
            
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>Prénom</label>
                                                    <input class="form-control form-control-lg" type="text" name="prenom"
                                                        wire:model.defer='prenom'>
                                                    @error('prenom')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
            
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group mb-25 col-lg-12">
                                                    <label>Date de Debut</label>
                                                    <input class="form-control form-control-lg" type="date" name="datedebut"
                                                        wire:model.defer='datedebut'>
                                                    @error('datedebut')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
            
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="form-group mb-25">
                                        <label>Phone Number</label>
                                        <input class="form-control form-control-lg" type="number" name="phone"
                                            wire:model.defer='phone'>
                                        @error('phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Contrat</label>
                                        <input class="form-control form-control-lg" type="text" name="contrat"
                                            wire:model.defer='contrat'>
                                        @error('contrat')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Designiation</label>
                                        <input class="form-control form-control-lg" type="text"
                                            name="designiation" wire:model.defer='designiation'>


                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Salaire</label>
                                        <input class="form-control form-control-lg" type="number" name="salaire"
                                            wire:model.defer='salaire'>
                                        @error('salaire')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label>Bureau </label>
                                        <select name="select-size-1" wire:model.defer='bureau_id' id="select-size-1"
                                            class="form-control  form-control-lg">
                                            <option value="" selected>select an option</option>
                                            @foreach ($bureaus as $bureau)
                                                <option value="{{ $bureau->id }}">{{ $bureau->nom }}</option>
                                            @endforeach

                                        </select>
                                        @error('bureau_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>


                                </div>

                       


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" wire:click.prevent='editData()'>
                            Save employe</button>
                    </div>
                    </form>
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
                                <h6>Voulez-vous supprimer ce employe</h6>
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
                                <h6>Voulez-vous supprimer ce employe</h6>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger btn-outlined btn-sm"
                            data-dismiss="modal">annuler</button>
                        <button type="button" wire:click.prevent='deleteSelectedRows()'
                            class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">supprimer</button>

                    </div>
                </div>
            </div>


        </div>

        <!-- ends: .modal-info-Delete -->




    </div>
</div>
</div>
