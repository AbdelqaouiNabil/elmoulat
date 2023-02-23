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
        <div class="cardContainer">

            {{-- <h1 id="h11"> I am a dashboard</h1> --}}
            <div class="row">
                <div class="card">
                    <h2 class="fourniss">Fournisseur</h2>
                    <div class="valContainer">
                        <h4 class="val">{{ count($fournisseurs) }}</h4>
                    </div>
                </div>
                <div class="card">
                    <h2 class="proje">Projets</h2>
                    <div class="valContainer">
                        <h4 class="val">{{ count($projets) }}</h4>
                    </div>
                </div>
                <div class=" card cardCaisse">
                    <h2 class="caiss">Caisse</h2>
                    <div class="row">
                        <div class="col mt-3">
                            <h4 class="justified">justified <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z" />
                                </svg>
                            </h4>
                        </div>
                        <div class="col mt-3">
                            <h4 class="val">{{ $caisse->sold }}</h4>
                        </div>

                        <div class="col mt-3">
                            <h4 class="total">Total</h4>
                        </div>
                        <div class="col mt-3">
                            <h4 class="val">{{ $caisse->total }}</h4>
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
                            <h4 class="val">{{ $caisse->sold_nonjustify }}</h4>
                        </div>

                    </div>
                </div>
            </div>





            {{-- <div id="highchart2"></div> --}}




            {{-- <h1>{{ print_r($depots) }} </h1> --}}


            {{-- START DIAGRAMS  --}}

            {{-- <div class="col-xl-12 col-12 mb-25">

                <div class="card broder-0">
                    <div class="card-header">
                        <ul class="card-tab-links mr-3 nav-tabs nav">
                            <li>
                                <a href="#t_revenue-month" data-toggle="tab" id="t_revenue-month-tab" role="tab"
                                    aria-selected="true">Month</a>
                            </li>
                        </ul>
                    </div>
                    <!-- ends: .card-header -->
                        <div class="card-body ">
                            <div class="tab-content">

                                <div class="tab-pane fade" id="t_revenue-month" aria-labelledby="t_revenue-month-tab">
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
                                    <h1>hello</h1>

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

                            </div>
                        </div>
                        <!-- ends: .card-body -->


                </div>


            </div> --}}

            {{-- end diagrams --}}

        </div>



        {{-- my charts  --}}
        <div class="chartContainer">
            <div class="row">

                <div class="col mt-6">
                    <div id="highchart"></div>
                </div>
                <div class="col mt-6">
                    <div id="highchartDiiii"></div>
                </div>
            </div>
            <div class="row chart3" >
                <div class="col mt-6">
                    <div id="highchart3333"></div>
                </div>
            </div>

        </div>






    </div>

</main>



</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>




<script>
    var domaines = @json($domaines);
    var data = [];

    // Loop through the $domaines array and create an object for each item
    @foreach ($domaines as $item)
        data.push({
            name: '{{ $item->name }}',
            y: {{ $item->domaineFois }}
        });
    @endforeach



    Highcharts.chart('highchart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Les Domaines les plus Utiliser'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Pourcentage',
            colorByPoint: true,
            data: data // Use the data array to populate the series data
        }]
    });


    ////////////////////////////////////////////////////////////////
    Highcharts.chart('highchartDiiii', {
        chart: {
            //   plotBackgroundColor: null,
            //   plotBorderWidth: null,
            //   plotShadow: false,
            type: 'column'
        },
        title: {
            text: 'Browser market shares in January, 2018'
        },

        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                    name: 'Internet Explorer',
                    y: 11.84
                },
                {
                    name: 'Firefox',
                    y: 10.85
                },
                {
                    name: 'Edge',
                    y: 4.67
                },
                {
                    name: 'Safari',
                    y: 4.18
                },
                {
                    name: 'Sogou Explorer',
                    y: 1.64
                },
                {
                    name: 'Opera',
                    y: 1.6
                },
                {
                    name: 'QQ',
                    y: 1.2
                },
                {
                    name: 'Other',
                    y: 2.61
                }
            ]

        }]
    });

    Highcharts.chart('highchart3333', {
        chart: {
            //   plotBackgroundColor: null,
            //   plotBorderWidth: null,
            //   plotShadow: false,
            type: 'spline'
        },
        title: {
            text: 'Browser market shares in January, 2018'
        },

        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                    name: 'Internet Explorer',
                    y: 11.84
                },
                {
                    name: 'Firefox',
                    y: 10.85
                },
                {
                    name: 'Edge',
                    y: 4.67
                },
                {
                    name: 'Safari',
                    y: 4.18
                },
                {
                    name: 'Sogou Explorer',
                    y: 1.64
                },
                {
                    name: 'Opera',
                    y: 1.6
                },
                {
                    name: 'QQ',
                    y: 1.2
                },
                {
                    name: 'Other',
                    y: 2.61
                }
            ]

        }]
    });
</script>


<script></script>

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
