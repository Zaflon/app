<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Wesley Flôres">

    <!-- Page tittle -->
    <title>{{$view->controller}} - {{$view->action}}</title>

    <!-- js dependency-->
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

    <!-- css dependency-->
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/general.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/popup.css')}}">

    <!-- box css dependency-->
    <link rel="stylesheet" href="{{URL::asset('css/box.css')}}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
</head>

<body>
    <div class="box-wrapper"></div>
    <!-- @see https://startbootstrap.com/templates/simple-sidebar/ -->
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        @component('components.menu', [
            'username' => $view->user->name,
            'date' => date('Y/m/d H:i:s'),
            'controller' => $view->controller,
            'url' => request()->fullUrl(),
            'csrf' => csrf_token(),
            'image' => $view->user->image
        ])
        @endcomponent
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

                <button class="btn btn-secondary" id="menu-toggle">Toggle Menu</button>

                <button class="btn btn-success ml-1" title="Cadastrar {{ $view->controller }}">
                    <a href='{{ route("{$view->controller}.create") }}' style="color: white;">
                        Register (+)
                    </a>
                </button>

                <!-- PDF -->
                <a href="{{ route('GenericPDFReport.show', $view->report->key) }}">
                    <img src="{{URL::asset('img/export-pdf.png')}}" alt="Pdf Image">
                </a>

                <!-- XML -->
                <a href="{{ route('GenericXMLReport.show', $view->report->key) }}">
                    <img src="{{URL::asset('img/xml-file.png')}}" alt="Xml Image">
                </a>

                <!-- CSV -->
                <a href="{{ route('GenericCSVReport.show', $view->report->key) }}">
                    <img src="{{URL::asset('img/import-csv.png')}}" alt="Csv Image">
                </a>

                <!-- CHART -->
                <a href="{{ route('GenericChartReport.show', $view->report->key) }}">
                    <img src="{{URL::asset('img/combo-chart.png')}}" alt="Chart">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="#" title="User Profile">User</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <div class="dropdown-item">
                                    <img src='{{ URL::asset("storage/{$view->user->image}") }}' alt="User" />
                                </div>

                                <a class="dropdown-item" href="#">
                                    <img src="https://img.icons8.com/nolan/32/exit.png" alt="Logout Image"> Action
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="https://img.icons8.com/nolan/32/exit.png" alt="Logout Image"> Another action
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <img src="https://img.icons8.com/nolan/32/exit.png" alt="Logout Image"> Log Out
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>

            <div class="container-fluid p-3">
                @yield('conteudo')
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Menu Toggle Script -->
    <script>
        const Wrapper = document.querySelectorAll("div.list-group a.group");

        $("#menu-toggle").click(function(e) {
            e.preventDefault();

            $("#wrapper").toggleClass("toggled");
        });

        $('.toast').toast('show');

        Wrapper.forEach((element, index, array) => {
            element.addEventListener(`click`, e => {
                const TARGET = `.wrapper-${e.target.dataset.target}`;
                const HTMLElement = document.querySelector(TARGET);

                HTMLElement.style.display = (HTMLElement.style.display === `none`) ? `block` : `none`;
            });

            element.click();
        });
    </script>
</body>

</html>