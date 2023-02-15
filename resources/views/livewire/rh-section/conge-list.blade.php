<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Conges</h4>
                            <div class="col-md-6">
                                <div class="search-result global-shadow rounded-pill bg-white">

                                    <div class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1">
                                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <input wire:model="search" class="form-control border-0 box-shadow-none"
                                            type="search" placeholder="chercher par nom et prenom ou cin ..."
                                            aria-label="Search">
                                    </div>

                                </div>
                            </div>
                            <div class="breadcrumb-action justify-content-center flex-wrap">

                                <div class="action-btn">

                                    <button @if (count($employes) == null) disabled @endif type="button"
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
        @if (count($employes) == null)
            <div class="alert alert-warning d-flex align-items-center mt-5" role="alert">
                <span class="mr-2" aria-label="Warning:"><i
                        class="fa-sharp fa-solid fa-triangle-exclamation"></i></span>
                <div>
                    Vous deviez crée un employe avant de crée un conges
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
            @if (count($conges) > 0)


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
                                                    <span class="userDatatable-title">Nom De Employe</span>
                                                    <a href="" wire:click.prevent="sort('employe_id')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Date de Debut</span>
                                                    <a href="" wire:click.prevent="sort('date_debut')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Date de fin</span>
                                                    <a href="" wire:click.prevent="sort('date_fin')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Nombre des Jours</span>
                                                    <a href="" wire:click.prevent="sort('jours')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>
                                                <th>
                                                    <span class="userDatatable-title">Type de Congé</span>
                                                    <a href="" wire:click.prevent="sort('type')"><i
                                                            class="fa-sharp fa-solid fa-sort"></i></a>
                                                </th>

                                                <th>
                                                    <span class="userDatatable-title">Actions</span>
                                                </th>


                                            </tr>
                                        </thead>
                                        <tbody>



                                            @foreach ($conges as $conge)
                                                <tr>
                                                    <td>

                                                        <input type="checkbox" wire:model="selectRows"
                                                            value="{{ $conge->id }}">

                                                    </td>

                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $conge->id }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $conge->employe->nom }}
                                                            {{ $conge->employe->prenom }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $conge->date_debut }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $conge->date_fin }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $conge->jours }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $conge->type }}
                                                        </div>
                                                    </td>



                                                    <td>

                                                        <ul class="orderDatatable_actions mb-0 d-flex">

                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#edit-modal"
                                                                    wire:click='edit({{ $conge->id }})'><i
                                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                            </li>
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#modal-info-delete"
                                                                    wire:click='delete({{ $conge->id }})'
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
                                <div class="d-flex justify-content-sm-end justify-content-start mt-15 pt-25 border-top">

                                    <nav class="atbd-page ">
                                        <ul class="atbd-pagination d-flex">
                                            <li class="atbd-pagination__item">
                                                {{ $conges->links('vendor.livewire.bootstrap') }}
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
                    table Bureau is empty
                </div>

            @endif
        @endif
        {{-- add conge  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">

                        <h6 class="modal-title">Ajouter Nouveau Congé</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">


                        <form enctype="multipart/form-data" wire:submit.prevent="saveData()">
                            <div class="form-basic">
                                @if (session()->has('form_error'))
                                    <div class="alert alert-danger">

                                        {{ session('form_error') }}

                                    </div>
                                @endif

                                <div class="form-group mb-25">
                                    <label>Le Nom de Employé</label>
                                    <select name="select-size-1" wire:model.defer='employe_id' id="select-size-1"
                                        class="form-control  form-control-lg" data-live-search="true"
                                        data-show-subtext="true" required>
                                        <option value="" selected>select an option</option>
                                        @if ($employes->count() > 0)
                                            @foreach ($employes as $employe)
                                                <option value="{{ $employe->id }}">{{ $employe->nom }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('employe_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-25">
                                    <label>Date Dubet</label>
                                    <input class="form-control form-control-lg" type="date" name="datedubet"
                                        wire:model.defer='datedebut' required>
                                    @error('datedebut')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Date Fin</label>
                                    <input class="form-control form-control-lg" type="date" name="datefin"
                                        wire:model.defer='datefin' required>
                                    @error('datefin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Type de Congé </label>
                                    <select name="select-size-1" wire:model='type' id="select-size-1"
                                        class="form-control  form-control-lg" required>
                                        <option value="" selected>select an option</option>
                                        <option value="Type1">Type1</option>
                                        <option value="Type2">Type2</option>
                                        <option value="Type3">Type3</option>
                                        <option value="Type4">Type4</option>
                                        <option value="Type5">Type5</option>
                                        <option value="Type6">Type6</option>
                                        <option value="autre">autre</option>
                                    </select>


                                </div>

                                @if ($typeautre == 'autre')
                                    <div class="form-group mb-25">
                                        <label>Votre Type de Congé</label>
                                        <input class="form-control form-control-lg" type="text"
                                            name="authre_column" required wire:model.defer='type'>

                                    </div>
                                @endif


                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary btn-sm" value="Save" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>






        </div>





        {{-- edit domaine model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Edit Congé</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">


                        <form enctype="multipart/form-data" wire:submit.prevent="editData()">
                            <div class="form-basic">

                                <div class="form-group mb-25">
                                    <label>Le Nom de Employé</label>
                                    <select name="select-size-1" wire:model.defer='employe_id' id="select-size-1"
                                        class="form-control  form-control-lg" data-live-search="true"
                                        data-show-subtext="true" required>
                                        <option value="" selected>select an option</option>
                                        @if ($employes->count() > 0)
                                            @foreach ($employes as $employe)
                                                <option value="{{ $employe->id }}">{{ $employe->nom }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('employe_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-25">
                                    <label>Date Dubet</label>
                                    <input class="form-control form-control-lg" type="date" name="datedubet"
                                        wire:model.defer='datedebut' required>
                                    @error('datedebut')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Date Fin</label>
                                    <input class="form-control form-control-lg" type="date" name="datefin"
                                        wire:model.defer='datefin' required>
                                    @error('datefin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Type de Congé </label>
                                    <select name="select-size-1" wire:model='type' id="select-size-1"
                                        class="form-control  form-control-lg" required>
                                        <option value="" selected>select an option</option>
                                        <option value="Type1">Type1</option>
                                        <option value="Type2">Type2</option>
                                        <option value="Type3">Type3</option>
                                        <option value="Type4">Type4</option>
                                        <option value="Type5">Type5</option>
                                        <option value="Type6">Type6</option>
                                        <option value="autre">autre</option>
                                    </select>


                                </div>

                                @if ($typeautre == 'autre')
                                    <div class="form-group mb-25">
                                        <label>Votre Type de Congé</label>
                                        <input class="form-control form-control-lg" type="text"
                                            name="authre_column" required wire:model.defer='type'>

                                    </div>
                                @endif


                            </div>

                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary btn-sm" value="Edit" />
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
                                <h6>Voulez-vous supprimer ce conge</h6>
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
                                <h6>Voulez-vous supprimer ce conge</h6>
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
