<div>

    {{-- <aside class="sidebar-wrapper">

        <div class="sidebar sidebar-collapse" id="sidebar">

            <div class="sidebar__menu-group">

                <ul class="sidebar_nav">

                    <li class="menu-title">

                        <span>Main menu</span>

                    </li>



                    <li>

                        <a wire:click="changeTab('projet')" id="projet"
                            class="$currentTab === 'projet' ? 'active' : ''">

                            <span wire:ignore><i data-feather="layers" class="nav-icon"></i></span>

                            <span class="menu-text">Projet</span>

                        </a>

                    </li>

                    <li>

                        <a wire:click="changeTab('fournisseurs')"
                            class="$currentTab === 'fournisseurs' ? 'active' : ''">

                            <span wire:ignore><i data-feather="folder" class="nav-icon"></i></span>

                            <span class="menu-text">Fournisseurs</span>

                        </a>

                    </li>

                    <li>

                        <a wire:click="changeTab('ouvriers')" class="$currentTab === 'ouvriers' ? 'active' : ''">

                            <span wire:ignore><i data-feather="tool" class="nav-icon"></i></span>

                            <span class="menu-text">Ouvriers</span>

                        </a>

                    </li>

                    <li>

                        <a wire:click="changeTab('clients')" class="$currentTab === 'clients' ? 'active' : ''">

                            <span wire:ignore><i data-feather="dollar-sign" class="nav-icon"></i></span>

                            <span class="menu-text">Client</span>

                        </a>

                    </li>

                    <li class="menu-title m-top-30">

                        <span>Charges</span>

                    </li>

                    <li>

                        <a wire:click="changeTab('charges')" class="$currentTab === 'charges' ? 'active' : ''">

                            <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                            <span class="menu-text">charges</span>

                        </a>

                    </li>

                    <li>

                        <a wire:click="changeTab('Contrats')" class="$currentTab === 'Contrats' ? 'active' : ''">

                            <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                            <span class="menu-text">Contrats</span>

                        </a>

                    </li>
                    <li>

                        <a wire:click="changeTab('facture')" class="$currentTab === 'facture' ? 'active' : ''">

                            <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                            <span class="menu-text">Facture</span>

                        </a>

                    </li>

                    <li>

                        <a wire:click="changeTab('depenses')" class="$currentTab === 'depenses' ? 'active' : ''">

                            <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                            <span class="menu-text">Depenses</span>

                        </a>

                    </li>
                    <li>

                        <a wire:click="changeTab('reglements')" class="$currentTab === 'reglements' ? 'active' : ''">

                            <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                            <span class="menu-text">Reglements</span>

                        </a>

                    </li>
                    <li>

                        <a wire:click="changeTab('depots')" class="$currentTab === 'depots' ? 'active' : ''">

                            <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                            <span class="menu-text">Depots</span>

                        </a>

                    </li>

                    <li class="menu-title m-top-30">

                        <span>Transactions</span>

                    </li>

                    <li>

                        <a wire:click="changeTab('Comptes')" class="$currentTab === 'Comptes' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Compte Banquaire</span>

                        </a>

                    </li>

                    <li>

                        <a wire:click="changeTab('Relever')" class="$currentTab === 'Relever' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Relever Banquaire</span>

                        </a>

                    </li>

                    <li>

                        <a wire:click="changeTab('chequier')" class="$currentTab === 'chequier' ? 'active' : ''">

                            <span wire:ignore><i data-feather="file-plus" class="nav-icon"></i></span>

                            <span class="menu-text">chequier</span>

                        </a>

                    </li>



                    <li class="menu-title m-top-30">

                        <span>RH</span>

                    </li>


                    <li>

                        <a wire:click="changeTab('Relever')" class="$currentTab === 'Relever' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Email</span>

                        </a>

                    </li>
                    <li>

                        <a wire:click="changeTab('Bureau')" class="$currentTab === 'Bureau' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Bureau</span>

                        </a>

                    </li>
                    <li>

                        <a wire:click="changeTab('Employe')" class="$currentTab === 'Employe' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Employe</span>

                        </a>

                    </li>
                    <li>

                        <a style="cursor:pointer" wire:click="changeTab('conges')"
                            class="$currentTab === 'conges' ? 'active' : ''">

                            <span data-feather="folder" class="nav-icon"></span>

                            <span class="menu-text">Conges</span>

                        </a>

                    </li>


                    <li class="has-child">
                        <a href="#" class="">
                            <span wire:ignore><i data-feather="aperture" class="nav-icon"></i></span>
                            <span class="menu-text">Settings</span>
                            <span class="toggle-icon"></span>
                        </a>
                        <ul>
                            <li class="nav-item">
                                <a wire:click="changeTab('Bank')"
                                    class="$currentTab === 'Bank' ? 'active' : ''">Bank</a>
                            </li>
                            <li class="nav-item">
                                <a wire:click="changeTab('domaine')"
                                    class="$currentTab === 'domaine' ? 'active' : ''">Domaine</a>
                            </li>

                            <li>
                                <a href="" class="">Profile Settings<span
                                        class="badge badge-success menuItem">New</span></a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Timeline</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="">Activity</a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>

        </div>

    </aside>
    <div>


        @if ($currentTab === 'projet')
            <livewire:project-section.projects-list>
        @endif
        @if ($currentTab === 'fournisseurs')
            <livewire:project-section.fournisseurs-list>
        @endif
        @if ($currentTab === 'ouvriers')
            <livewire:project-section.ouvriers-list>
        @endif

        @if ($currentTab === 'clients')
            <livewire:client-list>
        @endif

        @if ($currentTab === 'domaine')
            <livewire:settings.domaine-list>
        @endif
        @if ($currentTab === 'Bureau')
            <livewire:rh-section.bureau-list>
        @endif
        @if ($currentTab === 'Employe')
            <livewire:rh-section.employe-list>
        @endif
        @if ($currentTab === 'conges')
            <livewire:rh-section.conge-list>
        @endif
        @if ($currentTab === 'chequier')
            <livewire:transactions.chequier-list>
        @endif

        @if ($currentTab === 'charges')
            <livewire:charges-list>
        @endif
        @if ($currentTab === 'Contrats')
            <livewire:contrats-list>
        @endif

        @if ($currentTab === 'depenses')
            <livewire:depenses-list>
        @endif

        @if ($currentTab === 'reglements')
            <livewire:reglements-list>
        @endif

        @if ($currentTab === 'depots')
            <livewire:depots-list>
        @endif

        @if ($currentTab === 'Bank')
            <livewire:settings.bank-list>
        @endif


        @if ($currentTab === 'Relever')
            <livewire:relever-bankaire>
        @endif

        @if ($currentTab === 'facture')
            <livewire:facture-list>
        @endif

        @if ($currentTab === 'Comptes')
            <livewire:transactions.comptes-list>
        @endif --}}


    </div>



    <main>
        <div class="container-fluid mt-5 pt-5" name="maindiv">
            <div class="container ms-5 divContainer">

                {{-- <h1 id="h11"> I am a dashboard</h1> --}}
                <div class="row">
                    <div class="card">
                        <h2 class="fourniss">Fournisseur</h2>
                        <div class="valContainer">
                            <h4 class="val">5900</h4>
                        </div>
                    </div>
                    <div class="card">
                        <h2 class="proje">Projets</h2>
                        <div class="valContainer">
                            <h4 class="val">48</h4>
                        </div>
                    </div>
                    <div class=" card cardCaisse">
                        <h2>Caisse</h2>
                        <div class="row">
                            <div class="col mt-3">
                                <h4 class="justified">justified <svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor"
                                        class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z" />
                                    </svg>
                                </h4>
                            </div>
                            <div class="col mt-3">
                                <h4 class="val">4522.00</h4>
                            </div>
                            <div class="col mt-3">
                                <h4 class="nonJustified">non Justified

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-arrow-down-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M14 13.5a.5.5 0 0 1-.5.5h-6a.5.5 0 0 1 0-1h4.793L2.146 2.854a.5.5 0 1 1 .708-.708L13 12.293V7.5a.5.5 0 0 1 1 0v6z" />
                                    </svg>
                                </h4>
                            </div>
                            <div class="col mt-3">
                                <h4 class="val">2333.89</h4>
                            </div>
                        </div>
                    </div>
                </div>




                {{-- START DIAGRAMS  --}}

                <div class="col-xl-12 col-12 mb-25">

                    <div class="card broder-0">
                        <div class="card-header">
                            <h6>
                                Total Revenue
                                <span>Nov 23, 2019 - Nov 29, 2019</span>
                            </h6>
                            <div class="card-extra">
                                <ul class="card-tab-links mr-3 nav-tabs nav" role="tablist">
                                    <li>
                                        <a href="#t_revenue-week" data-toggle="tab" id="t_revenue-week-tab"
                                            role="tab" aria-selected="true">Week</a>
                                    </li>
                                    <li>
                                        <a href="#t_revenue-month" data-toggle="tab" id="t_revenue-month-tab"
                                            role="tab" aria-selected="false">Month</a>
                                    </li>
                                    <li>
                                        <a class="active" href="#t_revenue-year" data-toggle="tab"
                                            id="t_revenue-year-tab" role="tab" aria-selected="false">Year</a>
                                    </li>
                                </ul>
                                <div class="dropdown dropleft">
                                    <a href="#" role="button" id="cash" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-ellipsis-h"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="cash">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ends: .card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade" id="t_revenue-week" role="tabpanel"
                                    aria-labelledby="t_revenue-week-tab">
                                    <div class="cashflow-display d-flex">
                                        <div class="cashflow-display__single">
                                            <span class="cashflow-display__title">Current Balance</span>
                                            <h2 class="cashflow-display__amount color-primary">$2,784</h2>
                                        </div>
                                        <!-- ends: .cashflow-display__single -->
                                        <div class="cashflow-display__single">
                                            <span class="cashflow-display__title">Cash in</span>
                                            <h2 class="cashflow-display__amount">$4,240</h2>
                                        </div>
                                        <!-- ends: .cashflow-display__single -->
                                        <div class="cashflow-display__single">
                                            <span class="cashflow-display__title">Cash out</span>
                                            <h2 class="cashflow-display__amount">$2,470</h2>
                                        </div>
                                        <!-- ends: .cashflow-display__single -->
                                    </div>

                                    <div class="cashflow-chart">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="barChartCashflow_W"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Cash in
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: rgb(255, 77, 79);"></span>Cash out
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="t_revenue-month" role="tabpanel"
                                    aria-labelledby="t_revenue-month-tab">
                                    <div class="cashflow-display d-flex">
                                        <div class="cashflow-display__single">
                                            <span class="cashflow-display__title">Current Balance</span>
                                            <h2 class="cashflow-display__amount color-primary">$52,784</h2>
                                        </div>
                                        <!-- ends: .cashflow-display__single -->
                                        <div class="cashflow-display__single">
                                            <span class="cashflow-display__title">Cash in</span>
                                            <h2 class="cashflow-display__amount">$74,240</h2>
                                        </div>
                                        <!-- ends: .cashflow-display__single -->
                                        <div class="cashflow-display__single">
                                            <span class="cashflow-display__title">Cash out</span>
                                            <h2 class="cashflow-display__amount">$22,470</h2>
                                        </div>
                                        <!-- ends: .cashflow-display__single -->
                                    </div>

                                    <div class="cashflow-chart">
                                        <div class="parentContainer">


                                            <div>
                                                <canvas id="barChartCashflow_M"></canvas>
                                            </div>


                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Cash in
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: rgb(255, 77, 79);"></span>Cash out
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane fade active show" id="t_revenue-year" role="tabpanel"
                                    aria-labelledby="t_revenue-year-tab">
                                    <div class="cashflow-display d-flex">
                                        <div class="cashflow-display__single">
                                            <span class="cashflow-display__title">Current Balance</span>
                                            <h2 class="cashflow-display__amount color-primary">$92,784</h2>
                                        </div>
                                        <!-- ends: .cashflow-display__single -->
                                        <div class="cashflow-display__single">
                                            <span class="cashflow-display__title">Cash in</span>
                                            <h2 class="cashflow-display__amount">$104,240</h2>
                                        </div>
                                        <!-- ends: .cashflow-display__single -->
                                        <div class="cashflow-display__single">
                                            <span class="cashflow-display__title">Cash out</span>
                                            <h2 class="cashflow-display__amount">$872,470</h2>
                                        </div>
                                        <!-- ends: .cashflow-display__single -->
                                    </div>

                                    <div class="cashflow-chart">
                                        <div class="parentContainer">


                                            <div>
                                                <div class="chartjs-size-monitor">
                                                    <div class="chartjs-size-monitor-expand">
                                                        <div class=""></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink">
                                                        <div class=""></div>
                                                    </div>
                                                </div>
                                                <canvas id="barChartCashflow" height="281"
                                                    style="display: block; width: 796px; height: 281px;"
                                                    width="796" class="chartjs-render-monitor"></canvas>
                                            </div>


                                            <div class="chartjs-tooltip center"
                                                style="opacity: 0; left: 786.421px; top: 253.702px; font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 12px; font-style: normal; padding: 6px;">
                                                <table>
                                                    <thead></thead>
                                                    <div class="tooltip-title">Dec</div>
                                                    <tbody>
                                                        <tr>
                                                            <td><span class="chartjs-tooltip-key"
                                                                    style="background:#20C997; border-color:transparent; border-width: 2px; border-radius: 30px"></span><span
                                                                    class="chart-data">30</span> <span
                                                                    class="data-label">Cash in</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="chartjs-tooltip-key"
                                                                    style="background:#20C997; border-color:transparent; border-width: 2px; border-radius: 30px"></span><span
                                                                    class="chart-data">20</span> <span
                                                                    class="data-label">Cash out</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <ul class="legend-static">
                                            <li class="custom-label">
                                                <span style="background-color: rgb(95, 99, 242);"></span>Cash in
                                            </li>
                                            <li class="custom-label">
                                                <span style="background-color: rgb(255, 77, 79);"></span>Cash out
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ends: .card-body -->
                    </div>


                </div>

                {{-- end diagrams --}}

            </div>
        </div>

    </main>
















</div>
<script>
    window.addEventListener('close-model', event => {
        $('#modal-basic').modal('hide');
        $('#edit-modal').modal('hide');
        $('#modal-info-delete').modal('hide');
    });


    window.addEventListener('add', event => {
        Swal.fire(
            'Super!',
            'Vous avez ajouter un nouveau projet!',
            'success'
        )
    });
</script>
