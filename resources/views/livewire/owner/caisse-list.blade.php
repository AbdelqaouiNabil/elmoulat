<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Caisse</h4>

                            <div class="breadcrumb-action justify-content-center flex-wrap">

                                <div class="action-btn">

                                    <button type="button" class="btn btn-sm btn-success btn-add" data-toggle="modal"
                                        wire:click="resetInputs()" data-target="#modal-depot">
                                        Ajouter depot</button>


                                </div>
                                <div class="action-btn">

                                    <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                        wire:click="resetInputs()" data-target="#modal-basic">
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
        @if (count($caisses) > 0)
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
                                                <span class="userDatatable-title">Nom de Caisse</span>
                                                <a href="" wire:click.prevent="sort('name')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Sold</span>
                                                <a href="" wire:click.prevent="sort('sold')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Sold Non Justify</span>
                                                <a href="" wire:click.prevent="sort('sold_nonjustify')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Total Sold</span>
                                                <a href="" wire:click.prevent="sort('total')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>

                                            <th>
                                                <span class="userDatatable-title">Actions</span>
                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody>



                                        @foreach ($caisses as $caisse)
                                            <tr>
                                                <td>

                                                    <input type="checkbox" wire:model="selectRows"
                                                        value="{{ $caisse->id }}">

                                                </td>

                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $caisse->id }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $caisse->name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $caisse->sold }} DH
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $caisse->sold_nonjustify }} DH
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $caisse->total }} DH
                                                    </div>
                                                </td>



                                                <td>
                                                    <ul class="orderDatatable_actions mb-0 d-flex">

                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#edit-modal"
                                                                wire:click='edit({{ $caisse->id }})'><i
                                                                    class="fa-regular fa-pen-to-square"></i></a>
                                                        </li>
                                                        <li><a href="#" class="remove" data-toggle="modal"
                                                                data-target="#modal-info-delete"
                                                                wire:click='delete({{ $caisse->id }})'
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
                                            {{ $caisses->links('vendor.livewire.bootstrap') }}
                                        </li>
                                        <li class="atbd-pagination__item">
                                            <div class="paging-option">
                                                <select name="page-number" class="page-selection" wire:model="pages">
                                                    <option value="05">05/page</option>
                                                    <option value="20">20/page</option>
                                                    <option value="40">40/page</option>
                                                    <option value="60">60/page</option>
                                                </select>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="h-100 d-flex align-items-center justify-content-center">
                table caisse is empty
            </div>
        @endif

        {{-- add caisse  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Ajouter Nouveau Caisse </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">


                        <form enctype="multipart/form-data">
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Nom de Caisse</label>
                                    <input class="form-control form-control-lg" type="text" name="name"
                                        wire:model.defer='name'>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Sold</label>
                                    <input class="form-control form-control-lg" type="text" name="sold"
                                        wire:model.defer='sold'>
                                    @error('sold')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Sold Non Justify</label>
                                    <input class="form-control form-control-lg" type="text" name="sold_nonjustify"
                                        wire:model.defer='sold_nonjustify'>
                                    @error('sold_nonjustify')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>

                    </div>
                    <div class="modal-footer">
                        <button wire:click.prevent="saveData" class="btn btn-primary btn-sm">Enregistrer
                            Caisse</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>






        {{-- edit caisse model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Edit Caisse</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">


                        <form>
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label>Nom de Caisse</label>
                                    <input class="form-control form-control-lg" type="text" name="name"
                                        required wire:model.defer='name'>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mb-25">
                                    <label>Sold</label>
                                    <input class="form-control form-control-lg" type="text" name="sold"
                                        required wire:model.defer='sold'>
                                    @error('sold')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mb-25">
                                    <label>Sold Non Justify</label>
                                    <input class="form-control form-control-lg" type="text" name="sold_nonjustify"
                                        required wire:model.defer='sold_nonjustify'>
                                    @error('sold_nonjustify')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                            </div>





                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm"
                                    wire:click.prevent='editData()'> Modifer
                                    Caisse</button>
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
                                <h6>Voulez-vous supprimer ce caisse</h6>
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
                                <h6>Voulez-vous supprimer ce caisse</h6>
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

        {{-- add depot  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-depot" tabindex="-1" role="dialog"
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
                                    <input class="form-control form-control-lg" type="date" name="dateC"
                                        wire:model.defer='dateC'>
                                    @error('dateC')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Numéro Cheque</label>
                                    <input class="form-control form-control-lg" type="text" name="numero_cheque"
                                        wire:model.defer='numero_cheque'>
                                    @error('numero_cheque')
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

                                <div class="form-group mb-25 ">
                                    <label>Type Sold</label>
                                    <select name="id_caisse" id="select-size-1" wire:model.defer='type_sold'
                                        class="form-control  form-control-lg">
                                        <option value="sold_nonJustify" selected>Non justify</option>
                                        <option value="sold_justify">justify</option>

                                    </select>
                                    @error('type_sold')
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





</div>


