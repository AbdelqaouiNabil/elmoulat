<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
<<<<<<< HEAD
                            <h4 class="text-capitalize breadcrumb-title">Relever Banquaire</h4>




=======
                            <h4 class="text-capitalize breadcrumb-title">Relever Bancaire</h4>
>>>>>>> 1e7d78c3b67ff8d90aad3fb4dc881af2dec5e089
                            <div class="breadcrumb-action justify-content-center flex-wrap">
                                <div class="action-btn">
                                    <input class="form-control " type="date" value="21-15-2022"  wire:model.defer="dateR">
                                </div>
                                <div class="action-btn">
                                    <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal"
                                        data-target="#modal-import">
                                        <i class="la la-plus"></i>importer</button>
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

            @if ($releverBanquaire)
                <div class="row">
                            <div class="col-lg-12">

                                <div
                                    class="userDatatable orderDatatable shipped-dataTable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-borderless border-0">
                                            <thead>
                                                <tr class="userDatatable-header">
                                            
                                                    <th>
                                                        <span class="userDatatable-title">Id</span>
                                                       
                                                    </th>
                                                     <th>
                                                        <span class="userDatatable-title">date Mise En disposition </span>
                                                        
                                                    </th>
                                                     <th>
                                                        <span class="userDatatable-title">Compte Banquaire</span>
                                                        
                                                    </th>
                                                   <th>
                                                        <span class="userDatatable-title">Action</span>
                                                        
                                                    </th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($releverBanquaire->count() > 0)

                                                    @foreach ($releverBanquaire as $releverBanquaire)
                                                        <tr>
                                                          
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $releverBanquaire->id }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $releverBanquaire->dateR }}
                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $releverBanquaire->compte->numero }}
                                                                </div>
                                                            </td>
                                                           
                                                           

                                                            <td>
                                                                <ul class="orderDatatable_actions mb-0 d-flex">
                                                                 <li><a href="#" class="remove"
                                                                            data-toggle="modal"
                                                                            data-target="#view-modal"
                                                                             wire:click='viewReleverBanquaire({{ $releverBanquaire->id }})'
                                                                            >
                                                                            <i class="fa-solid fa-eye"></i>
                                                                            </a>
                                                                    </li>

                                                                    <li><a href="#" class="remove"
                                                                            data-toggle="modal"
                                                                            data-target="#edit-modal"
                                                                            wire:click='editReleverBanquaire({{ $releverBanquaire->id }})'><i
                                                                                class="fa-regular fa-pen-to-square"></i></a>
                                                                    </li>
                                                                    <li><a href="#" class="remove"
                                                                            data-toggle="modal"
                                                                            data-target="#modal-info-delete"
                                                                            wire:click='deleteReleverBanquaire({{ $releverBanquaire->id }})'
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
                                                    {{-- {{ $releverBanquaire->links('vendor.livewire.bootstrap') }} --}}
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
           
            @endif
        </div>


        {{-- import modal start --}}
        <div wire:ignore.self class="modal-info-delete modal fade show" id="modal-import" tabindex="-1" role="dialog"
            aria-hidden="true">


            <div class="modal-dialog modal-dialog-centered modal-info" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal-info-body d-flex">
                            <div class="modal-info-icon warning">
                                <span data-feather="info"></span>
                            </div>
                            <form enctype="multipart/form-data">
                                <div class="form-group mb-25">

                                    <label>Importer le Relever Bancaire depuis un fichier xlxs</label>
                                    <input class="form-control form-control-lg" type="file" name="file"
                                        wire:model.defer='file'>
                                    @error('file')
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



            {{-- view modal start --}}
        <div wire:ignore.self class="modal fade show" id="view-modal" tabindex="-1" >


            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-body">
                           <table >
                                            <thead>
                                                <tr class="userDatatable-header">
                                            
                                                    <th>
                                                        <span class="userDatatable-title">Id</span>
                                                       
                                                    </th>
                                                     <th>
                                                        <span class="userDatatable-title">Date operation</span>
                                                       
                                                    </th>
                                                     <th>
                                                        <span class="userDatatable-title">Libelle</span>
                                                        
                                                    </th>
                                                     <th>
                                                        <span class="userDatatable-title">Credit</span>
                                                        
                                                    </th>
                                                   <th>
                                                        <span class="userDatatable-title">Debit</span>
                                                        
                                                    </th>
                                                     
                                                   
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @if ($transactions)

                                                    @foreach ($transactions as $transaction)
                                                        <tr>
                                                          
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $transaction->id }}
                                                                </div>
                                                            </td>
                                                             <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $transaction->date_Operation }}
                                                                </div>
                                                            </td>
                                                          <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $transaction->libelle }}
                                                                </div>
                                                            </td>
                                                            
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $transaction->credit }}
                                                                </div>
                                                            </td> 
                                                            
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $transaction->debit }}
                                                                </div>
                                                            </td> 
                                                               
                                                      
                                                        </tr>
                                                    @endforeach
                                                @else



                                                @endif

                                                <!-- End: tr -->

                                            </tbody>
                                        </table><!-- End: table -->
                        </div>
                </div>
            </div>


        </div>
        {{-- view modal end --}}


    </div>

</div>
