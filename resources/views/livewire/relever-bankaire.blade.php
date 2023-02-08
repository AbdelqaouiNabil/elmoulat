<div>
    <div class="contents">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop-breadcrumb">

                        <div class="breadcrumb-main">
                            <h4 class="text-capitalize breadcrumb-title">Releler Bankaire</h4>
                            <div class="breadcrumb-action justify-content-center flex-wrap">
                                <div class="action-btn">
                                    <button type="button"
                                        class="btn btn-sm btn-primary btn-add" data-toggle="modal"
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
                <div class="row">
                    <div class="col-lg-12">

                        <div class="userDatatable orderDatatable shipped-dataTable global-shadow border p-30 bg-white radius-xl w-100 mb-30">
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless border-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                            <th>
                                                <span class="userDatatable-title">date_Operation</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">libelle</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">debit</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">credit</span>
                                            </th>
                                            <th>
                                                <span class="userDatatable-title">date_Valeur</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>


                                        @foreach ($transactions as $trans)
                                            <tr>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $trans->date_Operation }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $trans->libelle }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $trans->debit }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $trans->credit }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="orderDatatable-title">
                                                        {{ $trans->date_Valeur }}
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach


                                        <!-- End: tr -->

                                    </tbody> --}}
                                </table><!-- End: table -->
                            </div>
                            {{-- <div class="d-flex justify-content-sm-end justify-content-start mt-15 pt-25 border-top">
                                <nav class="atbd-page ">
                                    <ul class="atbd-pagination d-flex">
                                        <li class="atbd-pagination__item">
                                            {{ $transactions->links('vendor.livewire.bootstrap') }}
                                        </li>
                                        <li class="atbd-pagination__item">

                                            <div class="paging-option">
                                                <select wire:model="pages" name="pages" class="page-selection">
                                                    <option value="5">5/page</option>
                                                    <option value="10">10/page</option>
                                                    <option value="20">20/page</option>
                                                    <option value="40">40/page</option>
                                                </select>
                                            </div>


                                        </li>
                                    </ul>
                                </nav>
                            </div> --}}
                        </div><!-- End: .userDatatable -->
                    </div><!-- End: .col -->
                </div>
            </div>



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

                                <label>Importer le Relever Bancaire depuis un fichier xlxs</label>
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


    </div>

</div>
