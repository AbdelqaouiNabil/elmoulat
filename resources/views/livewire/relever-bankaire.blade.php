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
                                    <input class="form-control " type="date" wire:model="filter"  name="date">
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

            @if (!is_null($releverB))
                <div class="row">
                    <div class="col mt-6">
                        <p>Relevé au : {{ $releverB->date }}</p>
                        {{-- <p>Compte : {{ $releverB->compte->numero }}</p> --}}
                    </div>
                    <div class="col mt-6">
                        {{-- <p>Solde en MAD : {{ $releverB->compte->sold }}</p> --}}
                    </div>
                </div>
            @endif





            @if (!is_null($transactions))
                <div class="table-responsive">
                    <table class="table table-bordered table-social">
                        <tbody>
                            <tr>
                                <td>Date Operation</td>
                                <td>Libelle</td>
                                <td>Debit</td>
                                <td>Credit</td>
                                <td>Date Valeur</td>
                            </tr>
                            @foreach ($transactions as $trans)
                                <tr>
                                    <td> {{ $trans->date_Operation }} </td>
                                    <td>{{ $trans->libelle }}</td>
                                    <td>{{ $trans->debit }}</td>
                                    <td>{{ $trans->credit }}</td>
                                    <td>{{ $trans->date_Valeur }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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


    </div>

</div>
