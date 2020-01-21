@include('includes.head')

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-content-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-content-menu" data-col="2-columns">

    @include('includes.header')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Type Pretrip Checks</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Master Data</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Pretrip Checks</a>
                                </li>
                                <li class="breadcrumb-item active">Type PTC
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>   
            </div>

            <!-- BEGIN: Main Menu-->

            @include('includes.sidebar')
            
            <div class="content-body">
            @yield('content')

</body>
<!-- END: Body-->
</html>