<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">biens</h4>
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

                                    <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal" @if(count($projects)==null) disabled @endif
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
        @if (count($projects) > 0)
            @if ($biens->count() > 0)
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
                                                    <span class="userDatatable-title">Project</span>
                                                    <a href="" wire:click.prevent="sort('id_project')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>

                                                <th>
                                                    <span class="userDatatable-title">Type</span>
                                                    <a href="" wire:click.prevent="sort('type')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Situation</span>
                                                    <a href="" wire:click.prevent="sort('situation')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>

                                                <th>
                                                    <span class="userDatatable-title">Images </span>
                                                    <a href="" wire:click.prevent="sort('image')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title"> Etage </span>
                                                    <a href="" wire:click.prevent="sort('etage')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title"> Numero </span>
                                                    <a href="" wire:click.prevent="sort('numero_bien')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Espace</span>
                                                    <a href="" wire:click.prevent="sort('espace')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Prix</span>
                                                    <a href="" wire:click.prevent="sort('prix')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Description</span>
                                                    <a href="" wire:click.prevent="sort('description')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Actions</span>
                                                </th>


                                            </tr>
                                        </thead>
                                        <tbody>



                                            @foreach ($biens as $bien)
                                                <tr>
                                                    <td>

                                                        <input type="checkbox" wire:model="checked_id"
                                                            value="{{ $bien->id }}">

                                                    </td>

                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $bien->id }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $bien->project->name }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $bien->type }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $bien->situation }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="orderDatatable-title">
                                                          
                                                            @foreach (explode(',', $bien->image) as $path)
                                                                <img src="{{ Storage::disk('local')->url($path) }}"
                                                                    alt="image of bien" width="50px">
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $bien->etage }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $bien->numero }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $bien->espace }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $bien->prix }} DH
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $bien->description }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex">

                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#edit-modal"
                                                                    wire:click='editbien({{ $bien->id }})'><i
                                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                            </li>
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#modal-info-delete"
                                                                    wire:click='deletebien({{ $bien->id }})'
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
                                                {{ $biens->links('vendor.livewire.bootstrap') }}
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
                    table biens is empty
                </div>
            @endif
        @else
        <div class="alert alert-warning d-flex align-items-center mt-5" role="alert">
            <span class="mr-2" aria-label="Warning:"><i
                    class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>
            <div>
                Vous deviez crée un projet avant de crée un bien
            </div>
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

                                    <label>Importer des biens depuis un fichier xlxs</label>
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

        {{-- add bien  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Nouveau bien</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">


                        <form enctype="multipart/form-data" wire:submit.prevent="saveData()">
                            <div class="form-basic">

                                <div class="form-group mb-25 ">

                                    <label>Projet </label>
                                    <select wire:model.defer='id_project' class="form-control  form-control-lg">

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
                                <div class="form-group mb-25 ">

                                    <label>Type </label>
                                    <select wire:model.defer='type_bien' class="form-control form-control-lg">
                                        <option value=""> select option</option>
                                        <option value="appartement">Appartement</option>
                                        <option value="bureau">Bureau</option>
                                        <option value="magasin">Magasin</option>

                                    </select>
                                    @error('type_bien')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-25 ">
                                    <label>Situation</label>
                                    <input class="form-control form-control-lg" type="text" disabled
                                        value="Disponible">

                                </div>


                                <div class="form-group mb-25 ">
                                    <label>Prix</label>
                                    <input class="form-control form-control-lg" type="text"
                                        wire:model.defer='prix'>
                                    @error('prix')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group mb-25 ">
                                    <label>Pictures</label>
                                    <input class="form-control form-control-lg" type="file" multiple
                                        wire:model.defer='image'>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group mb-25 ">
                                    <label>Etage</label>
                                    <input class="form-control form-control-lg" type="text"
                                        wire:model.defer='etage'>
                                    @error('etage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group mb-25 ">
                                    <label>Numéro Bien</label>
                                    <input class="form-control form-control-lg" type="text"
                                        wire:model.defer='numero_bien'>
                                    @error('numero_bien')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-25 ">
                                <label>Espace (m)</label>
                                <input class="form-control form-control-lg" type="text" wire:model.defer='espace'>
                                @error('espace')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-25">
                                <label>Description</label>
                                <textarea class="form-control form-control-lg" rows="2" cols="50" wire:model.defer='description'>
                                 </textarea>
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



                    <h6 class="modal-title">Modifier bien</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span data-feather="x"></span></button>
                </div>
                <div class="modal-body">

                    <form enctype="multipart/form-data" wire:submit.prevent="editData()">
                        <div class="form-basic">

                            <div class="form-group mb-25 ">

                                <label>Projet </label>
                                <select wire:model.defer='id_project' class="form-control  form-control-lg">

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
                            <div class="form-group mb-25 ">

                                <label>Type </label>
                                <select wire:model.defer='type_bien' class="form-control form-control-lg">
                                    <option value=""> select option</option>
                                    <option value="appartement">Appartement</option>
                                    <option value="bureau">Bureau</option>
                                    <option value="magasin">Magasin</option>

                                </select>
                                @error('type_bien')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>

                            <div class="form-group mb-25 ">
                                <label>Situation</label>
                                <select wire:model.defer='situation' class="form-control form-control-lg">
                                    <option value="disponible">Disponible</option>
                                    <option value="location">location</option>
                                    <option value="vente">vente</option>

                                </select>
                                @error('type_bien')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>


                            <div class="form-group mb-25 ">
                                <label>Prix</label>
                                <input class="form-control form-control-lg" type="text" wire:model.defer='prix'>
                                @error('prix')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>





                            <div class="form-group mb-25 ">
                                <label>Etage</label>
                                <input class="form-control form-control-lg" type="text" wire:model.defer='etage'>
                                @error('etage')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group mb-25 ">
                                <label>Numéro Bien</label>
                                <input class="form-control form-control-lg" type="text"
                                    wire:model.defer='numero_bien'>
                                @error('numero_bien')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-25 ">
                            <label>Espace (m)</label>
                            <input class="form-control form-control-lg" type="text" wire:model.defer='espace'>
                            @error('espace')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-25">
                            <label>Description</label>
                            <textarea class="form-control form-control-lg" rows="2" cols="50" wire:model.defer='description'>
                             </textarea>
                        </div>

                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary btn-sm" value="Enregistrer" />
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- delete modal  --}}
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
                            <h6>Voulez-vous supprimer ce bien</h6>
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


</div>
