<div>
    <style>
        .badge-secondary {
            background-color: #ebedef;
            color: #40464f;
        }

        /* .badge-danger {
            background-color: #f9e1e5;
            color: #af233a;
        }

       

        .badge-warning {
            background-color: #fbf0da;
            color: #73510d;
        }

        .badge-danger {
            background-color: #f9e1e5;
            color: #af233a;
        } */
    </style>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">cheques</h4>
                            <div class="col-md-6">
                                <div class="search-result global-shadow rounded-pill bg-white">
                                    

                                    <div class="border-right d-flex align-items-center w-100  pl-25 pr-sm-25 pr-0 py-1 border-0">
                                        <span><i class="fa-solid fa-magnifying-glass"></i></span>
                                        <input wire:model="search" class="form-control border-0 box-shadow-none"
                                            type="search" placeholder="chercher par numero  ou situation ..."
                                            aria-label="Search">
                                    </div>

                                </div>
                                
                            </div>
                           
                            <div class="breadcrumb-action justify-content-center flex-wrap">

                                <div class="action-btn">
                                    <div class="dropdown action-btn">
                                        <div class="dropdown dropdown-click">
        
                                            <select @if (count($cheques) == null) disabled @endif name="select-size-1" id="select-size-1" wire:model="search"
                                                class="form-control  form-control-lg">
                                                <option value=""  selected>Order By situation</option>
                                                @foreach ($situationCheques as $cheque)
                                                    <option value="{{ $cheque->situation }}">{{ $cheque->situation }}</option>
                                                @endforeach
        
                                            </select>
                                        </div>
                                    </div>


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
        @if (count($cheques) > 0)


            <div class="container-fluid">

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
                                                <span class="userDatatable-title">Numero</span>
                                                <a href="" wire:click.prevent="sort('numero')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">situation</span>
                                                <a href="" wire:click.prevent="sort('situation')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">Chequier</span>
                                                <a href="" wire:click.prevent="sort('id_chequier')"><i
                                                        class="fa-sharp fa-solid fa-sort"></i></a>
                                            </th>

                                            <th>
                                                <span class="userDatatable-title">Actions</span>

                                            </th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($cheques as $cheque)
                                            <tr>
                                                <td>

                                                    <input type="checkbox" wire:model="selectRows"
                                                        value="{{ $cheque->id }}">

                                                </td>

                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $cheque->id }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $cheque->numero }}

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        <span
                                                            class="badge rounded-pill 
                                                            @if ($cheque->situation == 'disponible') badge-success 
                                                            @elseif($cheque->situation == 'livrer') badge-info
                                                            @elseif($cheque->situation == 'regeter') badge-danger
                                                            @elseif($cheque->situation == 'annuler') badge-warning
                                                            @else badge-secondary @endif">
                                                            {{ $cheque->situation }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $cheque->id_chequier }}
                                                    </div>
                                                </td>


                                                <td>

                                                    @if ($cheque->situation == 'disponible')
                                                        <ul class="orderDatatable_actions mb-0 d-flex">

                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#edit-modal"
                                                                    wire:click='edit({{ $cheque->id }})'><i
                                                                        class="fa-regular fa-pen-to-square"></i></a>
                                                            </li>


                                                        </ul>

                                                    @else
                                                    <ul class="orderDatatable_actions mb-0 d-flex">

                                                        <li><a href="#" class="remove" data-toggle="modal" ><i style="color:#bec6d0;" class="fa-solid fa-ban"></i></a>
                                                            
                                                        </li>


                                                    </ul>
                                                    @endif


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
                                            {{ $cheques->links('vendor.livewire.bootstrap') }}
                                        </li>
                                        <li class="atbd-pagination__item">
                                            <div class="paging-option">
                                                <select name="page-number" class="page-selection" wire:model="pages">
                                                    <option value="5">05/page</option>
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
                table cheques is empty
            </div>

        @endif



        {{-- edit domaine model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog"
            aria-hidden="true">

            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Edit Cheque</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">
                        <form enctype="multipart/form-data" wire:submit.prevent="editData()">
                            <div class="form-basic">


                                <div class="form-group mb-25">
                                    <label>Date Dubet</label>
                                    <select class="form-control  form-control-lg" name="situation" id="situation"
                                        wire:model='situation' required>
                                        <option value="disponible">Disponible</option>
                                        <option value="livrer">Livrer</option>
                                        <option value="regeter">Regeter</option>
                                        <option value="annuler">Annuler</option>
                                        <option value="autre">Autre</option>

                                    </select>

                                    @error('situation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                @if ($situation == 'autre')
                                    <div class="form-group mb-25">
                                        <label>Saisier Votre setiation</label>
                                        <input class="form-control form-control-lg" type="text"
                                            wire:model.defer='autre' required>
                                        @error('autre')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
