<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Factures</h4>
                            <div class="col-md-6">
                                <div class="search-result global-shadow rounded-pill bg-white">

                                    <div class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1 border-0">
                                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <input wire:model="search" class="form-control border-0 box-shadow-none"
                                            type="search" placeholder="chercher par numero..." aria-label="Search">
                                    </div>

                                </div>
                            </div>
                            <div class="breadcrumb-action justify-content-center flex-wrap">


                                <div class="dropdown action-btn">
                                    <button @if (count($fournisseurs) == null) disabled @endif
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
                                        <a href="" class="dropdown-item">
                                            <i class="la la-file-pdf"></i> PDF</a>
                                        <i class="la la-file-excel"></i> Excel (XLSX)</a>
                                        <a href="" class="dropdown-item">
                                            <i class="la la-file-csv"></i> CSV</a>
                                    </div>
                                </div>
                                <div class="action-btn">

                                    <button @if (count($fournisseurs) == null) disabled @endif type="button"
                                        class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                        data-target="#modal-import">
                                        <i class="la la-plus"></i>importer</button>


                                </div>

                                <div class="action-btn">

                                    <button @if (count($fournisseurs) == null) disabled @endif type="button"
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
        @if (count($fournisseurs) == null)
            <div class="alert alert-warning d-flex align-items-center mt-5" role="alert">
                <span class="mr-2" aria-label="Warning:"><i
                        class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>
                <div>
                    Vous deviez crée un fournisseur avant de crée un facture
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
            @if ($factures->count() > 0)
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
                                                    <input type="checkbox" wire:model="selectAll">
                                                </th>

                                                <th>
                                                    <span class="userDatatable-title">id</span>
                                                    <a href="" wire:click.prevent="sort('id')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Numéro de Facture</span>
                                                    <a href="" wire:click.prevent="sort('numero')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>

                                                <th>
                                                    <span class="userDatatable-title">Fournisseur</span>
                                                    <a href="" wire:click.prevent="sort('id')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Facture File</span>
                                                    <a href="" wire:click.prevent="sort('scan_pdf')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Type</span>
                                                    <a href="" wire:click.prevent="sort('type')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Montant</span>
                                                    <a href="" wire:click.prevent="sort('montant')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>

                                                <th>
                                                    <span class="userDatatable-title">Date de Facture </span>
                                                    <a href="" wire:click.prevent="sort('date')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>

                                                <th>
                                                    <span class="userDatatable-title">Actions</span>
                                                </th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if ($factures->count() > 0)

                                                @foreach ($factures as $facture)
                                                    <tr>
                                                        <td>

                                                            <input type="checkbox" wire:model="selectRows"
                                                                value="{{ $facture->id }}">

                                                        </td>

                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $facture->id }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $facture->numero }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $facture->fournisseur->name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                <a href=" {{ Storage::disk('local')->url($facture->scan_pdf) }}"
                                                                    target="_blank" type="application/pdf"
                                                                    style="color: red; font-size:20px;"><i
                                                                        class="fa-solid fa-file-pdf"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $facture->type }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $facture->montant }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $facture->date }}
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex">

                                                                <li><a href="#" class="remove"
                                                                        data-toggle="modal" data-target="#edit-modal"
                                                                        wire:click='edit({{ $facture->id }})'><i
                                                                            class="fa-regular fa-pen-to-square"></i></a>
                                                                </li>
                                                                <li><a href="#" class="remove"
                                                                        data-toggle="modal"
                                                                        data-target="#modal-info-delete"
                                                                        wire:click='delete({{ $facture->id }})'
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
                                                {{ $factures->links('vendor.livewire.bootstrap') }}
                                            </li>
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
                    table factures is empty
                </div>
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

                                    <label>Importer des factures depuis un fichier xlxs</label>
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

        {{-- add facture  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Nouveau Facture</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">


                        <form enctype="multipart/form-data">
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Numéro</label>
                                    <input class="form-control form-control-lg" type="number" name="numero"
                                        wire:model.defer='numero'>
                                    @error('numero')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-25">
                                    <label class="required">Fournisseur </label>
                                    <select name="select-size-1" wire:model.defer='fournisseur_id' id="select-size-1"
                                        class="form-control  form-control-lg">
                                        <option value="" selected>select an option</option>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('fournisseur_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                
                                <div class="form-group mb-25">
                                    <label>Reglemnt</label>
                                    <input class="form-control form-control-lg" type="text" name="id_reglement"
                                        wire:model.defer='id_reglement'>
                                    @error('id_reglement')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Facture PDF</label>
                                    <input class="form-control form-control-lg" type="file" name="scan_pdf"
                                        wire:model.defer='scan_pdf'>
                                    @error('scan_pdf')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label class="required">Type </label>
                                    <select name="select-size-1" wire:model='type' id="select-size-1"
                                        class="form-control  form-control-lg">
                                        <option selected >----select one---- </option>
                                        <option value="real" >Real</option>
                                        <option value="fake">Fake</option>
                                        <option value="ajustement">Ajustement</option>
                                    </select>
                                    @error('type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                @if ($type == 'fake' || $type == 'ajustement')
                                    <div class="form-group mb-25">
                                        <label>Prix</label>
                                        <input class="form-control form-control-lg" type="text" name="prix"
                                            required wire:model.defer='prix'>
                                        @error('prix')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label class="required">Caisse </label>
                                        <select name="select-size-1" wire:model.defer='caisse' id="select-size-1"
                                            required class="form-control  form-control-lg">
                                            <option selected>select one</option>

                                            @foreach ($caisses as $caisse)
                                                <option value="{{ $caisse->id }}">{{ $caisse->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('caisse')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                    <label>Date</label>
                                    <input class="form-control form-control-lg" type="date" name="date" 
                                        wire:model.defer='date'>
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Enregistrer
                                    facture</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        {{-- edit facture model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Modifier facture</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form enctype="multipart/form-data" wire:submit.prevent="editData()">
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Numéro</label>
                                    <input class="form-control form-control-lg" type="number" name="numero"
                                        wire:model.defer='numero'>
                                    @error('numero')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-25">
                                    <label class="required">Fournisseur </label>
                                    <select name="select-size-1" wire:model.defer='fournisseur_id' id="select-size-1"
                                        class="form-control  form-control-lg">
                                        <option value="" selected>select an option</option>
                                        @foreach ($fournisseurs as $fournisseur)
                                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('fournisseur_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Reglemnt</label>
                                    <input class="form-control form-control-lg" type="text" name="id_reglement"
                                        wire:model.defer='id_reglement'>
                                    @error('id_reglement')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                
                                @if ($type == 'fake' || $type == 'ajustement')
                                    <div class="form-group mb-25">
                                        <label>Prix</label>
                                        <input class="form-control form-control-lg" type="text" name="prix"
                                            required wire:model.defer='prix'>
                                        @error('prix')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="form-group mb-25">
                                        <label class="required">Caisse </label>
                                        <select name="select-size-1" wire:model.defer='caisse' id="select-size-1"
                                            required class="form-control  form-control-lg">
                                            <option selected>select one</option>

                                            @foreach ($caisses as $caisse)
                                                <option value="{{ $caisse->id }}">{{ $caisse->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('caisse')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                                    <label>Date</label>
                                    <input class="form-control form-control-lg" type="date" name="date"
                                        wire:model.defer='date'>
                                    @error('date')
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
                                <h6>Voulez-vous supprimer ce facture</h6>
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
                                <h6>Voulez-vous supprimer ce facture</h6>
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

        @push('scripts')
            <script>
                window.addEventListener('close-model', event => {
                    
                    $('#modal-basic').modal('hide');
                    $('#edit-modal').modal('hide');
                    $('#modal-info-delete').modal('hide');
                })
            </script>
        @endpush




    </div>
</div>
