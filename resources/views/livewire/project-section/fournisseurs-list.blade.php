<div>
    <style>
        .required:after {
            content: '*';
            color: red;
            padding-left: 5px;
        }

    </style>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Fournisseurs</h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">

                                <div class="dropdown action-btn">
                                    <button class="btn btn-sm btn-default btn-white dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                                    <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#modal-basic">
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
        <div class="container-fluid">
            <button type="button" class=" btn btn-sm btn-danger btn-add  " @if($bulkDisabled) disabled @endif data-target="#modal-all-delete" data-toggle="modal" >
                                          
                <i class="la la-trash"></i>delete selected</button>
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="userDatatable orderDatatable shipped-dataTable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                        <div class="table-responsive">
                          
                            <table class="table mb-0 table-borderless border-0">
                                <thead>
                                    <tr class="userDatatable-header">
                                        
                                        <th>
                                            <input type="checkbox" wire:model="selectAll">
                                        </th>
                                        
                                        <th>
                                            <span class="userDatatable-title">id</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Nom de Fournisseur</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Ice </span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">phone</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Email</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Adress</span>
                                        </th>
                                        <th>
                                            <span class="userDatatable-title">Domaine</span>
                                        </th> 
                                        <th>
                                            <span class="userDatatable-title">Actions</span>
                                        </th>
                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>
    
                                    @if ($fournisseurs->count() > 0)
        
                                            @foreach ($fournisseurs as $fournisseur)
                                                <tr>
                                                    <td>
                                                
                                                        <input  type="checkbox" wire:model="selectedfournisseur" value="{{$fournisseur->id}}"  >
                                                        
                                                    </td>
                                                   
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $fournisseur->id }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $fournisseur->name }}
                                                        </div>
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $fournisseur->ice }}
                                                        </div>
                                                    </td>
                                                    
                                                    
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $fournisseur->phone }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $fournisseur->email }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{ $fournisseur->adress }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="orderDatatable-title">
                                                            {{-- {{ $fournisseur->f_domaine->name}} --}}
                                                            
                                                        </div>
                                                    </td>
                                                   
        
                                                   
                                                    <td>
                                                        <ul class="orderDatatable_actions mb-0 d-flex">
                                        
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#edit-modal"
                                                                    wire:click='editFournisseur({{ $fournisseur->id }})'><i
                                                                        class="fa-regular fa-pen-to-square"></i></a></li>
                                                            <li><a href="#" class="remove" data-toggle="modal"
                                                                    data-target="#modal-info-delete"
                                                                    wire:click='deleteFournisseur({{ $fournisseur->id }})'
                                                                    style="color: red;"><i class="fa-solid fa-trash"></i></a>
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
                                        <a href="#" class="atbd-pagination__link pagination-control"><span class="la la-angle-left"></span></a>
                                        <a href="#" class="atbd-pagination__link"><span class="page-number">1</span></a>
                                        <a href="#" class="atbd-pagination__link active"><span class="page-number">2</span></a>
                                        <a href="#" class="atbd-pagination__link"><span class="page-number">3</span></a>
                                        <a href="#" class="atbd-pagination__link pagination-control"><span class="page-number">...</span></a>
                                        <a href="#" class="atbd-pagination__link"><span class="page-number">12</span></a>
                                        <a href="#" class="atbd-pagination__link pagination-control"><span class="la la-angle-right"></span></a>
                                        <a href="#" class="atbd-pagination__option">
                                        </a>
                                    </li>
                                    <li class="atbd-pagination__item">
                                        <div class="paging-option">
                                            <select name="page-number" class="page-selection">
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


        {{--add Fournisseur  modal --}}
        <div wire:ignore.self class="modal-basic modal fade show" id="modal-basic" tabindex="-1" role="dialog" aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">

                        <h6 class="modal-title">Ajouter Nouveau Frournisseur</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form>
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label class="required">Nom </label>
                                    <input class="form-control form-control-lg" type="text" name="name" wire:model.defer='name'>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>ICE</label>
                                    <input class="form-control form-control-lg" type="text" name="ice" wire:model.defer='ice'>
                                    @error('ice')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Phone</label>
                                    <input class="form-control form-control-lg" type="text" name="phone" wire:model.defer='phone'>
                                    @error('phone')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Adress</label>
                                    <input class="form-control form-control-lg" type="text" name="adress" wire:model.defer='adress'>
                                    @error('adress')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Email</label>
                                    <input class="form-control form-control-lg" type="text" name="email" wire:model.defer='email'>
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>

                                <div class="form-group mb-25">
                                    <label>Domaine </label>
                                    <select name="select-size-1" wire:model.defer='id_fdomaine' id="select-size-1" class="form-control  form-control-lg">
                                        <option value="" selected>select an option</option>
                                    @foreach($f_domaines as $f_domaine)
                                        <option value="{{$f_domaine->id}}">{{$f_domaine->name}}</option>
                                        
                                    @endforeach
                                        
                                    </select>
                                    @error('id_fdomaine')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                </div>


                            </div>



                            <div class="modal-footer">
                                <button wire:click.prevent="saveData()" class="btn btn-primary btn-sm">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


       




        {{-- edit project model --}}

        <div wire:ignore.self class="modal-basic modal fade show" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">


            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content modal-bg-white ">
                    <div class="modal-header">



                        <h6 class="modal-title">Modifier Projet</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span data-feather="x"></span></button>
                    </div>
                    <div class="modal-body">

                        <form wire:submit.prevent='editData'>
                            <div class="form-basic">
                                <div class="form-group mb-25">
                                    <label class="required">Nom </label>
                                    <input class="form-control form-control-lg" type="text" name="name" wire:model.defer='name'>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>ICE</label>
                                    <input class="form-control form-control-lg" type="text" name="ice" wire:model.defer='ice'>
                                    @error('ice')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Phone</label>
                                    <input class="form-control form-control-lg" type="text" name="phone" wire:model.defer='phone'>
                                    @error('phone')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Adress</label>
                                    <input class="form-control form-control-lg" type="text" name="adress" wire:model.defer='adress'>
                                    @error('adress')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>
                                <div class="form-group mb-25">
                                    <label>Email</label>
                                    <input class="form-control form-control-lg" type="text" name="email" wire:model.defer='email'>
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>

                                    @enderror
                                </div>

                                <div class="form-group mb-25">
                                    <label>Domaine </label>
                                    <select name="select-size-1" wire:model.defer='id_fdomaine' id="select-size-1" class="form-control  form-control-lg">
                                        <option value="" selected>select an option</option>
                                    @foreach($f_domaines as $f_domaine)
                                        <option value="{{$f_domaine->id}}">{{$f_domaine->name}}</option>
                                        
                                    @endforeach
                                        
                                    </select>
                                    @error('id_fdomaine')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                </div>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Enregistrer projet</button>
                    </div>
                    </form>
                </div>
            </div>


        </div>


        {{-- delete model  --}}

        <!-- ends: .modal-info-confirmed -->

        <div wire:ignore.self class="modal-info-delete modal fade show" id="modal-info-delete" tabindex="-1" role="dialog" aria-hidden="true">


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

                        <button type="button" class="btn btn-danger btn-outlined btn-sm" data-dismiss="modal">No</button>
                        <button type="button" wire:click='deleteData' class="btn btn-success btn-outlined btn-sm" data-dismiss="modal">Yes</button>

                    </div>
                </div>
            </div>


        </div>
        <!-- ends: .modal-info-Delete -->

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