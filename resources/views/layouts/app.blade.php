<!doctype html>
<html lang="en" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StrikingDash</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <!-- inject:css-->



    {{-- High Charts --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    {{-- select2 jquery --}}






    <link rel="stylesheet" href="{{ asset('css/dashboardStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/bootstrap/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/fontawesome.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/footable.standalone.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/fullcalendar@5.2.0.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/jquery-jvectormap-2.0.5.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/jquery.mCustomScrollbar.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/leaflet.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/line-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/MarkerCluster.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/MarkerCluster.Default.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/slick.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/star-rating-svg.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/trumbowyg.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendor_assets/css/wickedpicker.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <script src="sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon.png') }}">
    @livewireStyles
</head>

<body class="layout-light side-menu overlayScroll">
    <div class="mobile-search">
        <form class="search-form">
            <span data-feather="search"></span>
            <input wire:model='search' class="form-control mr-sm-2 box-shadow-none" type="text"
                placeholder="Search...">
        </form>
    </div>

    <div class="mobile-author-actions"></div>
    <header class="header-top">
        <nav class="navbar navbar-light">
            <div class="navbar-left">



                <a href="{{ route('owner.dashboard') }}" class="sidebar-toggle">
                    <img class="svg" src="{{ asset('img/svg/bars.svg') }}" alt="img"></a>
                <a class="navbar-brand" href="{{ route('owner.dashboard') }}"><img class="dark"
                        src="{{ asset('img/logo_dark.png') }}" alt="svg"><img class="light"
                        src="{{ asset('img/logo_white.png') }}" alt="img"></a>


                <div class="top-menu">

                    <div class="strikingDash-top-menu position-relative">
                        <ul>
                            <li class="has-subMenu">
                                <a href="#" class="active">Dashboard</a>
                                <ul class="subMenu">
                                    <li>
                                        <a class="active" href="index.html">Social Media</a>
                                    </li>
                                    <li>
                                        <a class="" href="business.html">FineTech /
                                            Business</a>
                                    </li>
                                    <li>
                                        <a class="" href="performance.html">Site
                                            Performance</a>
                                    </li>
                                    <li>
                                        <a class="" href="ecommerce.html">Ecommerce</a>
                                    </li>
                                    <li>
                                        <a class="" href="crm.html">
                                            CRM</a>
                                    </li>
                                    <li>
                                        <a class="" href="sales.html">
                                            Sales Performance</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-subMenu">
                                <a href="#" class="">Layouts</a>
                                <ul class="subMenu">
                                    <li class="l_sidebar">
                                        <a href="#" data-layout="light">Light Mode</a>
                                    </li>
                                    <li class="l_sidebar">
                                        <a href="#" data-layout="dark">Dark Mode</a>
                                    </li>
                                    <li class="l_navbar">
                                        <a href="#" data-layout="top">Top Menu</a>
                                    </li>
                                    <li class="l_navbar">
                                        <a href="#" data-layout="side">Side Menu</a>
                                    </li>
                                    <li class="layout">
                                        <a href="../rtl">RTL</a>
                                    </li>
                                    <li class="layout">
                                        <a href="../ltr">LTR</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-subMenu">
                                <a href="#" class="">Apps</a>
                                <ul class="subMenu">
                                    <li>
                                        <a href="chat.html" class="">
                                            <span data-feather="message-square" class="nav-icon"></span>
                                            <span class="menu-text">Chat</span>
                                        </a>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="shopping-cart" class="nav-icon"></span>
                                            <span class="menu-text">eCommerce</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a href="products.html" class="">Products</a>
                                            </li>
                                            <li>
                                                <a href="product-details.html" class="">Product Details</a>
                                            </li>
                                            <li>
                                                <a href="add-product.html" class="">Product
                                                    Add</a>
                                            </li>
                                            <li>
                                                <a href="" class="">Product Edit</a>
                                            </li>
                                            <li>
                                                <a href="cart.html" class="">Cart</a>
                                            </li>
                                            <li>
                                                <a href="order.html" class="">Orders</a>
                                            </li>
                                            <li>
                                                <a href="sellers.html" class="">Sellers</a>
                                            </li>
                                            <li>
                                                <a href="invoice.html" class="">Invoices</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="mail" class="nav-icon"></span>
                                            <span class="menu-text">Email</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a href="inbox.html" class="">Inbox</a>
                                            </li>
                                            <li>
                                                <a href="read-email.html" class="">Read
                                                    Email</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="chat.html" class="">
                                            <span data-feather="bookmark" class="nav-icon"></span>
                                            <span class="menu-text">Note</span>
                                        </a>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="" class="">
                                            <span data-feather="user" class="nav-icon"></span>
                                            <span class="menu-text">Profile</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a href="profile.html" class="">Profile</a>
                                            </li>
                                            <li>
                                                <a href="" class="">Profile Settings</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="user-check" class="nav-icon"></span>
                                            <span class="menu-text">Contact</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a class="" href="contact-1.html">Contact 1</a>
                                            </li>
                                            <li>
                                                <a class="" href="contact-2.html">Contact 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="chat.html" class="">
                                            <span data-feather="activity" class="nav-icon"></span>
                                            <span class="menu-text">To-Do</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="kanban.html" class="">
                                            <span data-feather="columns" class="nav-icon"></span>
                                            <span class="menu-text">Kanban Board</span>
                                        </a>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="repeat" class="nav-icon"></span>
                                            <span class="menu-text">Import & Export</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a class="" href="import.html">Import</a>
                                            </li>
                                            <li>
                                                <a class="" href="export.html">Export</a>
                                            </li>
                                            <li>
                                                <a class="" href="export-selected.html">Export Selected
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="file-manager.html" class="">
                                            <span data-feather="file" class="nav-icon"></span>
                                            <span class="menu-text">File Manager</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="task-app.html" class="">
                                            <span data-feather="clipboard" class="nav-icon"></span>
                                            <span class="menu-text">Task App</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>



                            <li class="has-subMenu">
                                <a href="#" class="">Crud</a>
                                <ul class="subMenu">
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="shopping-cart" class="nav-icon"></span>
                                            <span class="menu-text">Firestore Crud</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a class="" href="firestore.html">View All</a>
                                            </li>
                                            <li>
                                                <a class="" href="firestore-add.html">Add
                                                    New</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>


                            <li class="mega-item has-subMenu">
                                <a href="#" class="">Pages</a>
                                <ul class="megaMenu-wrapper megaMenu-small">
                                    <li>
                                        <ul>
                                            <li>
                                                <a href="projects.html" class="">Project</a>
                                            </li>
                                            <li>
                                                <a href="application-ui.html" class="">Project Details</a>
                                            </li>
                                            <li>
                                                <a href="create.html" class="">Create
                                                    Project</a>
                                            </li>
                                            <li>
                                                <a href="users-card.html" class="">Team</a>
                                            </li>
                                            <li>
                                                <a href="users-card2.html" class="">Users</a>
                                            </li>
                                            <li>
                                                <a href="user-info.html" class="">Users
                                                    Info</a>
                                            </li>
                                            <li>
                                                <a href="users-list.html" class="">Users
                                                    List</a>
                                            </li>
                                            <li>
                                                <a href="users-group.html" class="">Users
                                                    Group</a>
                                            </li>
                                            <li>
                                                <a href="banner.html" class="">
                                                    <span class="menu-text">Banners</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="testimonial.html" class="">
                                                    <span class="menu-text">Testimonial</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="support.html" class="">
                                                    <span class="menu-text">Support Center</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="dynamic-table.html" class="">
                                                    <span class="menu-text">Dynamic Table</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li>
                                                <a href="users-datatable.html" class="">Users
                                                    Table</a>
                                            </li>
                                            <li>
                                                <a href="gallery.html" class="">Gallery 1</a>
                                            </li>
                                            <li>
                                                <a href="gallery2.html" class="">Gallery 2</a>
                                            </li>
                                            <li>
                                                <a href="pricing.html" class="">Pricing</a>
                                            </li>
                                            <li>
                                                <a href="faq.html" class="">FAQ's</a>
                                            </li>
                                            <li>
                                                <a href="search.html" class="">Search
                                                    Results</a>
                                            </li>
                                            <li>
                                                <a href="maintenance.html" class="">Coming
                                                    Soon</a>
                                            </li>
                                            <li>
                                                <a href="404.html" class="">404</a>
                                            </li>
                                            <li>
                                                <a href="maintenance.html" class="">
                                                    <span class="menu-text">Maintenance</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="login.html" class="">
                                                    <span class="menu-text">Log In</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="sign-up.html" class="">
                                                    <span class="menu-text">Sign Up</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="blank.html" class="">
                                                    <span class="menu-text">Blank</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="mega-item has-subMenu">
                                <a href="#" class="">Components</a>
                                <ul class="megaMenu-wrapper megaMenu-wide">
                                    <li>
                                        <span class="mega-title">Components</span>
                                        <ul>
                                            <li>
                                                <a class="" href="alert.html">Alert</a>
                                            </li>
                                            <li>
                                                <a class="" href="avatar.html">Avatar</a>
                                            </li>
                                            <li>
                                                <a class="" href="badge.html">Badge</a>
                                            </li>
                                            <li>
                                                <a class="" href="breadcrumbs.html">Breadcrumb</a>
                                            </li>
                                            <li>
                                                <a class="" href="buttons.html">Button</a>
                                            </li>
                                            <li>
                                                <a class="" href="cards.html">Cards</a>
                                            </li>
                                            <li>
                                                <a class="" href="carousel.html">Carousel</a>
                                            </li>
                                            <li>
                                                <a class="" href="checkbox.html">Checkbox</a>
                                            </li>
                                            <li>
                                                <a class="" href="collapse.html">Collapse</a>
                                            </li>
                                            <li>
                                                <a class="" href="comments.html">Comments</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span class="mega-title">Components</span>
                                        <ul>
                                            <li>
                                                <a class="" href="dashboard-base.html">Dashboard
                                                    Base</a>
                                            </li>
                                            <li>
                                                <a class="" href="date-picker.html">DatePicker</a>
                                            </li>
                                            <li>
                                                <a class="" href="drawer.html">Drawer</a>
                                            </li>
                                            <li>
                                                <a class="" href="drag-drop.html">Drag &
                                                    Drop</a>
                                            </li>
                                            <li>
                                                <a class="" href="dropdown.html">Dropdown</a>
                                            </li>
                                            <li>
                                                <a class="" href="empty.html">Empty</a>
                                            </li>
                                            <li>
                                                <a class="" href="input.html">Input</a>
                                            </li>
                                            <li>
                                                <a class="" href="list.html">List</a>
                                            </li>
                                            <li>
                                                <a class="" href="menu.html">Menu</a>
                                            </li>
                                            <li>
                                                <a class="" href="message.html">Message</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span class="mega-title">Components</span>
                                        <ul>
                                            <li>
                                                <a class="" href="modal.html">Modals</a>
                                            </li>
                                            <li>
                                                <a class="" href="notifications.html">Notification</a>
                                            </li>
                                            <li>
                                                <a class="" href="page-header.html">Page
                                                    Headers</a>
                                            </li>
                                            <li>
                                                <a class="" href="pagination.html">Paginations</a>
                                            </li>
                                            <li>
                                                <a class="" href="progressbar.html">Progress</a>
                                            </li>
                                            <li>
                                                <a class="" href="radio.html">Radio</a>
                                            </li>
                                            <li>
                                                <a class="" href="rate.html">Rate</a>
                                            </li>
                                            <li>
                                                <a class="" href="result.html">Result</a>
                                            </li>
                                            <li>
                                                <a class="" href="select.html">Select</a>
                                            </li>
                                            <li>
                                                <a class="" href="skeleton.html">Skeleton</a>
                                            </li>
                                            <li>
                                                <a class="" href="time-picker.html">Timepicker</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <span class="mega-title">Components</span>
                                        <ul>
                                            <li>
                                                <a class="" href="slider.html">Slider</a>
                                            </li>
                                            <li>
                                                <a class="" href="spin.html">Spinner</a>
                                            </li>
                                            <li>
                                                <a class="" href="statistics.html">Statistic</a>
                                            </li>
                                            <li>
                                                <a class="" href="steps.html">Steps</a>
                                            </li>
                                            <li>
                                                <a class="" href="switch.html">Switch</a>
                                            </li>
                                            <li>
                                                <a class="" href="tab.html">Tabs</a>
                                            </li>
                                            <li>
                                                <a class="" href="tag.html">Tags</a>
                                            </li>
                                            <li>
                                                <a class="" href="timeline.html">Timeline</a>
                                            </li>
                                            <li>
                                                <a class="" href="timeline-2.html">Timeline
                                                    2</a>
                                            </li>
                                            <li>
                                                <a class="" href="timeline-3.html">Timeline
                                                    3</a>
                                            </li>
                                            <li>
                                                <a class="" href="uploads.html">Upload</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-subMenu">
                                <a href="#" class="">Features</a>
                                <ul class="subMenu">
                                    <li>
                                        <a href="editors.html" class="">
                                            <span data-feather="edit" class="nav-icon"></span>
                                            <span class="menu-text">Editors</span>
                                        </a>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="grid" class="nav-icon"></span>
                                            <span class="menu-text">Icons</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a href="feather.html" class="">Feather icons
                                                    (svg)</a>
                                            </li>
                                            <li>
                                                <a href="fontawesome.html" class="">Font
                                                    Awesome</a>
                                            </li>
                                            <li>
                                                <a href="lineawesome.html" class="">Line
                                                    Awesome</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="bar-chart-2" class="nav-icon"></span>
                                            <span class="menu-text">Charts</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a class="" href="charts.html">Chart JS</a>
                                            </li>
                                            <li>
                                                <a class="" href="google-chart.html">Google
                                                    Charts</a>
                                            </li>
                                            <li>
                                                <a class="" href="peity-chart.html">Peity
                                                    Charts</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="disc" class="nav-icon"></span>
                                            <span class="menu-text">Froms</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a class="" href="form.html">Basics</a>
                                            </li>
                                            <li>
                                                <a class="" href="form-layouts.html">Layouts</a>
                                            </li>
                                            <li>
                                                <a class="" href="form-elements.html">Elements</a>
                                            </li>
                                            <li>
                                                <a class="" href="form-components.html">Components</a>
                                            </li>
                                            <li>
                                                <a class="" href="form-validations.html">Validations</a>
                                            </li>
                                        </ul>
                                    </li>



                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="map" class="nav-icon"></span>
                                            <span class="menu-text">Maps</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a href="google-map.html" class="">Google
                                                    Maps</a>
                                            </li>
                                            <li>
                                                <a href="leaflet-map.html" class="">Leaflet
                                                    Maps</a>
                                            </li>
                                            <li>
                                                <a href="vector-map.html" class="">Vector
                                                    Maps</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="server" class="nav-icon"></span>
                                            <span class="menu-text">Widget</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a class="" href="widget-charts.html">Chart</a>
                                            </li>
                                            <li>
                                                <a class="" href="widget-mixed.html">Mixed</a>
                                            </li>
                                            <li>
                                                <a class="" href="widget-card.html">Card</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="square" class="nav-icon"></span>
                                            <span class="menu-text">Wizards</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a href="checkout-wizard6.html" class="">Wizard
                                                    1</a>
                                            </li>
                                            <li>
                                                <a href="checkout-wizard7.html" class="">Wizard
                                                    2</a>
                                            </li>
                                            <li>
                                                <a href="checkout-wizard8.html" class="">Wizard
                                                    3</a>
                                            </li>
                                            <li>
                                                <a href="checkout-wizard9.html" class="">Wizard
                                                    4</a>
                                            </li>
                                            <li>
                                                <a href="checkout-wizard10.html" class="">Wizard
                                                    5</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-subMenu-left">
                                        <a href="#" class="">
                                            <span data-feather="book" class="nav-icon"></span>
                                            <span class="menu-text">Knowledge Base</span>
                                        </a>
                                        <ul class="subMenu">
                                            <li>
                                                <a class="" href="knowledgebase.html">Knowledge
                                                    Base</a>
                                            </li>
                                            <li>
                                                <a class="" href="knowledgebase-2.html">All
                                                    Article</a>
                                            </li>

                                            <li>
                                                <a class="" href="knowledgebase-3.html">Single Article</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- ends: navbar-left -->

            <div class="navbar-right">

                <ul class="navbar-right__menu">
                    <li class="nav-search d-none">
                        <a href="#" class="search-toggle">
                            <i class="la la-search"></i>
                            <i class="la la-times"></i>
                        </a>
                        <form action="/" class="search-form-topMenu">
                            <span class="search-icon" data-feather="search"></span>
                            <input wire:model='search' class="form-control mr-sm-2 box-shadow-none" type="text"
                                placeholder="Search...">
                        </form>
                    </li>
                    <li class="nav-message">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle">
                                <span data-feather="mail"></span></a>
                            <div class="dropdown-wrapper">
                                <h2 class="dropdown-wrapper__title">Messages <span
                                        class="badge-circle badge-success ml-1">2</span></h2>
                                <ul>
                                    <li class="author-online has-new-message">
                                        <div class="user-avater">
                                            <img src="img/team-1.png" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                                <span class="msg-count badge-circle badge-success badge-sm">1</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="author-offline has-new-message">
                                        <div class="user-avater">
                                            <img src="img/team-1.png" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                                <span class="msg-count badge-circle badge-success badge-sm">1</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="author-online has-new-message">
                                        <div class="user-avater">
                                            <img src="img/team-1.png" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                                <span class="msg-count badge-circle badge-success badge-sm">1</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="author-offline">
                                        <div class="user-avater">
                                            <img src="img/team-1.png" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="author-offline">
                                        <div class="user-avater">
                                            <img src="img/team-1.png" alt="">
                                        </div>
                                        <div class="user-message">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">Web Design</a>
                                                <span class="time-posted">3 hrs ago</span>
                                            </p>
                                            <p>
                                                <span class="desc text-truncate" style="max-width: 215px;">Lorem ipsum
                                                    dolor amet cosec Lorem ipsum</span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="dropdown-wrapper__more">See All Message</a>
                            </div>
                        </div>
                    </li>
                    <!-- ends: nav-message -->
                    <li class="nav-notification">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle">
                                <span data-feather="bell"></span></a>
                            <div class="dropdown-wrapper">
                                <h2 class="dropdown-wrapper__title">Notifications <span
                                        class="badge-circle badge-warning ml-1">4</span></h2>
                                <ul>
                                    <li
                                        class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--primary">
                                            <span data-feather="inbox"></span>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li
                                        class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--secondary">
                                            <span data-feather="upload"></span>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li
                                        class="nav-notification__single nav-notification__single--unread d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--success">
                                            <span data-feather="log-in"></span>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="nav-notification__single nav-notification__single d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--info">
                                            <span data-feather="at-sign"></span>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                    <li class="nav-notification__single nav-notification__single d-flex flex-wrap">
                                        <div class="nav-notification__type nav-notification__type--danger">
                                            <span data-feather="heart"></span>
                                        </div>
                                        <div class="nav-notification__details">
                                            <p>
                                                <a href="" class="subject stretched-link text-truncate"
                                                    style="max-width: 180px;">James</a>
                                                <span>sent you a message</span>
                                            </p>
                                            <p>
                                                <span class="time-posted">5 hours ago</span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="dropdown-wrapper__more">See all incoming activity</a>
                            </div>
                        </div>
                    </li>
                    <!-- ends: .nav-notification -->
                    <li class="nav-settings">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle">
                                <span data-feather="settings"></span></a>
                            <div class="dropdown-wrapper dropdown-wrapper--large">
                                <ul class="list-settings">
                                    <li class="d-flex">
                                        <div class="mr-3"><img src="img/mail.png" alt=""></div>
                                        <div class="flex-grow-1">
                                            <h6>
                                                <a href="" class="stretched-link">All Features</a>
                                            </h6>
                                            <p>Introducing Increment subscriptions </p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="mr-3"><img src="img/color-palette.png" alt=""></div>
                                        <div class="flex-grow-1">
                                            <h6>
                                                <a href="" class="stretched-link">Themes</a>
                                            </h6>
                                            <p>Third party themes that are compatible</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="mr-3"><img src="img/home.png" alt=""></div>
                                        <div class="flex-grow-1">
                                            <h6>
                                                <a href="" class="stretched-link">Payments</a>
                                            </h6>
                                            <p>We handle billions of dollars</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="mr-3"><img src="img/video-camera.png" alt=""></div>
                                        <div class="flex-grow-1">
                                            <h6>
                                                <a href="" class="stretched-link">Design Mockups</a>
                                            </h6>
                                            <p>Share planning visuals with clients</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="mr-3"><img src="img/document.png" alt=""></div>
                                        <div class="flex-grow-1">
                                            <h6>
                                                <a href="" class="stretched-link">Content Planner</a>
                                            </h6>
                                            <p>Centralize content gethering and editing</p>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="mr-3"><img src="img/microphone.png" alt=""></div>
                                        <div class="flex-grow-1">
                                            <h6>
                                                <a href="" class="stretched-link">Diagram Maker</a>
                                            </h6>
                                            <p>Plan user flows & test scenarios</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <!-- ends: .nav-settings -->
                    <li class="nav-support">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle">
                                <span data-feather="help-circle"></span></a>
                            <div class="dropdown-wrapper">
                                <div class="list-group">
                                    <span>Documentation</span>
                                    <ul>
                                        <li>
                                            <a href="">How to customize admin</a>
                                        </li>
                                        <li>
                                            <a href="">How to use</a>
                                        </li>
                                        <li>
                                            <a href="">The relation of vertical spacing</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="list-group">
                                    <span>Payments</span>
                                    <ul>
                                        <li>
                                            <a href="">How to customize admin</a>
                                        </li>
                                        <li>
                                            <a href="">How to use</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="list-group">
                                    <span>Content Planner</span>
                                    <ul>
                                        <li>
                                            <a href="">How to customize admin</a>
                                        </li>
                                        <li>
                                            <a href="">How to use</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- ends: .nav-support -->
                    <li class="nav-flag-select">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle"><img src="img/flag.png" alt=""
                                    class="rounded-circle"></a>
                            <div class="dropdown-wrapper dropdown-wrapper--small">
                                <a href=""><img src="img/eng.png" alt=""> English</a>
                                <a href=""><img src="img/ger.png" alt=""> German</a>
                                <a href=""><img src="img/spa.png" alt=""> Spanish</a>
                                <a href=""><img src="img/tur.png" alt=""> Turkish</a>
                            </div>
                        </div>
                    </li>
                    <!-- ends: .nav-flag-select -->
                    <li class="nav-author">
                        <div class="dropdown-custom">
                            <a href="javascript:;" class="nav-item-toggle"><img
                                    src="{{ Storage::disk('local')->url(Auth::user()->image) }}" alt=""
                                    class="rounded-circle"></a>
                            <div class="dropdown-wrapper">
                                <div class="nav-author__info">
                                    <div class="author-img">
                                        <img src="{{ Storage::disk('local')->url(Auth::user()->image) }}"
                                            alt="" class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6>{{ Auth::user()->name }}</h6>
                                        <span>UI Designer</span>
                                    </div>
                                </div>
                                <div class="nav-author__options">
                                    <ul>
                                        <li>
                                            <a href="{{ route('owner.profile') }}">
                                                <span data-feather="user"></span> Profile</a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span data-feather="settings"></span> Settings</a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span data-feather="key"></span> Billing</a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span data-feather="users"></span> Activity</a>
                                        </li>
                                        <li>
                                            <a href="">
                                                <span data-feather="bell"></span> Help</a>
                                        </li>
                                    </ul>
                                    <a href="{{ route('logout') }}" class="nav-author__signout">
                                        <span data-feather="log-out"></span> Sign Out</a>
                                </div>
                            </div>
                            <!-- ends: .dropdown-wrapper -->
                        </div>
                    </li>
                    <!-- ends: .nav-author -->
                </ul>
                <!-- ends: .navbar-right__menu -->
                <div class="navbar-right__mobileAction d-md-none">
                    <a href="#" class="btn-search">
                        <span data-feather="search"></span>
                        <span data-feather="x"></span></a>
                    <a href="#" class="btn-author-action">
                        <span data-feather="more-vertical"></span></a>
                </div>
            </div>
            <!-- ends: .navbar-right -->
        </nav>
    </header>
    <main class="main-content">



        <aside class="sidebar-wrapper">

            <div class="sidebar sidebar-collapse" id="sidebar">

                <div class="sidebar__menu-group">

                    <ul class="sidebar_nav">

                        <li class="menu-title">

                            <span>Main menu</span>

                        </li>



                        <li>

                            <a href="{{ route('owner.projects') }}">

                                <span wire:ignore><i data-feather="layers" class="nav-icon"></i></span>

                                <span class="menu-text">Projet</span>

                            </a>

                        </li>



                        <li>

                            <a href="{{ route('owner.fournisseurs') }}"
                                class="$currentTab === 'fournisseurs' ? 'active' : ''">

                                <span wire:ignore><i data-feather="folder" class="nav-icon"></i></span>

                                <span class="menu-text">Fournisseurs</span>

                            </a>

                        </li>

                        <li>

                            <a href="{{ route('owner.ouvriers') }}">

                                <span wire:ignore><i data-feather="tool" class="nav-icon"></i></span>

                                <span class="menu-text">Ouvriers</span>

                            </a>

                        </li>



                        <li class="menu-title m-top-30">

                            <span>Charges</span>

                        </li>

                        <li>

                            <a href="{{ route('owner.charges') }}">

                                <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                                <span class="menu-text">Charges</span>

                            </a>

                        </li>

                        <li>

                            <a href="{{ route('owner.contrats') }}">

                                <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                                <span class="menu-text">Contrats</span>

                            </a>

                        </li>
                        <li>

                            <a href="{{ route('owner.factures') }}">

                                <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                                <span class="menu-text">Facture</span>

                            </a>

                        </li>

                        <li>

                            <a href="{{ route('owner.depenses') }}">

                                <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                                <span class="menu-text">Depenses</span>

                            </a>

                        </li>

                        <li>

                            <a href="{{ route('owner.reglements') }}">

                                <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                                <span class="menu-text">Reglements</span>

                            </a>

                        </li>
                        <li>

                            <a href="{{ route('owner.depots') }}">

                                <span wire:ignore><i data-feather="briefcase" class="nav-icon"></i></span>

                                <span class="menu-text">Depots</span>

                            </a>

                        </li>
                        <li class="menu-title m-top-30">

                            <span>Transactions</span>

                        </li>

                        <li>

                            <a href="{{ route('owner.comptes') }}">

                                <span data-feather="folder" class="nav-icon"></span>

                                <span class="menu-text">Compte Banquaire</span>

                            </a>

                        </li>

                        <li>

                            <a href="{{ route('owner.relevers') }}">

                                <span data-feather="folder" class="nav-icon"></span>

                                <span class="menu-text">Relever Banquaire</span>

                            </a>

                        </li>

                        <li>

                            <a href="{{ route('owner.chequiers') }}">

                                <span wire:ignore><i data-feather="file-plus" class="nav-icon"></i></span>

                                <span class="menu-text">chequier</span>

                            </a>

                        </li>
                        <li>

                            <a href="{{ route('owner.cheques') }}">

                                <span wire:ignore><i data-feather="file-plus" class="nav-icon"></i></span>

                                <span class="menu-text">cheques</span>

                            </a>

                        </li>
                        <li>

                            <a href="{{ route('owner.caisses') }}">

                                <span data-feather="folder" class="nav-icon"></span>

                                <span class="menu-text">Caisse</span>

                            </a>

                        </li>




                        <li class="menu-title m-top-30">

                            <span>RH</span>

                        </li>


                        <li>

                            <a href="#">

                                <span data-feather="folder" class="nav-icon"></span>

                                <span class="menu-text">Email</span>

                            </a>

                        </li>
                        <li>


                            <a href="{{ route('owner.bureaus') }}">


                                <span data-feather="folder" class="nav-icon"></span>

                                <span class="menu-text">Bureau</span>

                            </a>

                        </li>
                        <li>

                            <a href="{{ route('owner.employes') }}">

                                <span data-feather="folder" class="nav-icon"></span>

                                <span class="menu-text">Employe</span>

                            </a>

                        </li>
                        <li>

                            <a href="{{ route('owner.conges') }}">

                                <span data-feather="folder" class="nav-icon"></span>

                                <span class="menu-text">Conges</span>

                            </a>

                        </li>

                        <li class="has-child">
                            <a href="#" class="">
                                <span wire:ignore><i data-feather="aperture" class="nav-icon"></i></span>
                                <span class="menu-text">Vente Section</span>
                                <span class="toggle-icon"></span>
                            </a>
                            <ul>
                                <li class="nav-item">
                                    <a href="{{ route('owner.clients') }}">Clients</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('owner.ventes') }}">Ventes</a>
                                </li>

                            </ul>
                        </li>


                        <li class="has-child">
                            <a href="#" class="">
                                <span wire:ignore><i data-feather="aperture" class="nav-icon"></i></span>
                                <span class="menu-text">Settings</span>
                                <span class="toggle-icon"></span>
                            </a>
                            <ul>
                                <li class="nav-item">
                                    <a href="{{ route('owner.banks') }}">Banque</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('owner.domaines') }}">Domaine</a>
                                </li>

                                <li>
                                    <a href="{{ route('owner.users') }}" class="">Utilisateur<span
                                            class="badge badge-success menuItem">New</span></a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('owner.role') }}">Roles</a>
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




        {{ $slot }}



        <footer class="footer-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-copyright">
                            <p>2020 @<a href="#">Aazztech</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-menu text-right">
                            <ul>
                                <li>
                                    <a href="#">About</a>
                                </li>
                                <li>
                                    <a href="#">Team</a>
                                </li>
                                <li>
                                    <a href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <!-- ends: .Footer Menu -->
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <div id="overlayer">
        <span class="loader-overlay">
            <div class="atbd-spin-dots spin-lg">
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
                <span class="spin-dot badge-dot dot-primary"></span>
            </div>
        </span>
    </div>
    <div class="overlay-dark-sidebar"></div>
    <!-- inject:js-->

    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"></script>

    {{-- <script src="{{('js/app.js')}}" ></script> --}}



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('assets/vendor_assets/js/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/accordion.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/autoComplete.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/drawer.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/dynamicBadge.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/dynamicCheckbox.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/footable.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/fullcalendar@5.2.0.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/google-chart.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.filterizr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.mCustomScrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/jquery.star-rating-svg.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/loader.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/muuri.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/popover.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/trumbowyg.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/wickedpicker.min.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/drag-drop.js') }}"></script>
    <script src="{{ asset('assets/vendor_assets/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/footable.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/full-calendar.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/googlemap-init.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/icon-loader.js') }}"></script>
    <script src="{{ asset('assets/theme_assets/js/leaflet-init.js') }}"></script>
    <script src="https://kit.fontawesome.com/1a35748197.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/theme_assets/js/main.js') }}"></script>


    @livewireScripts
    =======
    <script>
        window.addEventListener('add', event => {
            Swal.fire(
                'Super!',
                'Vous avez ajouter un nouveau caisse!',
                'success'
            );
        });

        window.addEventListener('close-model', event => {
            $('#modal-basic').modal('hide');
            $('#edit-modal').modal('hide');
            $('#modal-info-delete').modal('hide');
            $('#add-modal-reglement').modal('hide');
            $('#modal-import').modal('hide');
            $('#reglement-modal').modal('hide');
            $('#modal-addAvance').modal('hide');
            


        });
        $(document).ready(function() {
            $('#select_data').selectize({
                sortField: 'text'
            });
        });
    </script>




    {{-- High Charts --}}

    <!-- endinject-->
</body>

</html>
