<!DOCTYPE html>
<html lang="en">

<head>
    <!-- @see https://www.seomarketing.com.br/meta-tags-google.php -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Wesley Flôres">

    <!-- Page tittle -->
    <title>{{$data->controller}} - {{$data->action}}</title>

    <!-- js dependency-->
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>

    <!-- css dependency-->
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/general.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/popup.css')}}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
</head>

<body>
    <!-- @see https://startbootstrap.com/templates/simple-sidebar/ -->
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-center"> {{ $data->user->name }}</div>

            <!-- attributes of this module -->
            <form style="display: hidden" id="data">
                <input type="hidden" name="controller" value="{{ $data->controller }}">
                <input type="hidden" name="date" value="{{ date('Y/m/d H:i:s') }}">
                <input type="hidden" name="url" value="{{ request()->fullUrl() }}">
                <input type="hidden" name="csrf" value="{{ csrf_token() }}">
            </form>

            <!-- Chunck elements-->
            <div class="{{ $data->chunk->xGen->xClass }}">
                @foreach ($data->chunk->Chunk->AttachedElement->Child->xBit as $key => $chunk)
                @if ( (bool) (int) $chunk->ActiveElement === true )
                <a href="{{ $chunk->CompletePath }}" class="{{ $data->chunk->xGen->xClassBit }}">{{ $chunk->PropertyText }}</a>
                @endif
                @endforeach
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-secondary" id="menu-toggle">Toggle Menu</button>

                <button class="btn btn-success ml-1" title="Cadastrar {{ $data->controller }}">
                    <a href='{{ route("{$data->controller}.create") }}' style="color: white;">
                        Cadastro (+)
                        <a />
                </button>

                <!-- PDF -->
                <a href='{{ route("Archive", [$data->controller, "pdf"]) }}'>
                    <img src="https://img.icons8.com/nolan/64/pdf.png" alt="Pdf Image">
                </a>

                <!-- XML -->
                <a href='{{ route("Archive", [$data->controller, "xml"]) }}'>
                    <img src="https://img.icons8.com/nolan/64/xml.png" alt="Xml Image">
                </a>

                <!-- CSV -->
                <a href='{{ route("Archive", [$data->controller, "csv"]) }}'>
                    <img src="https://img.icons8.com/nolan/64/csv.png" alt="Csv Image">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('welcome') }}">Laravel <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" title="User Profile">User</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Options
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">
                                    <img src="https://img.icons8.com/nolan/32/exit.png" alt="Logout Image"> Action
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="https://img.icons8.com/nolan/32/exit.png" alt="Logout Image"> Another action
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('login') }}">
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
        $("#menu-toggle").click(function(e) {
            e.preventDefault();

            $("#wrapper").toggleClass("toggled");
        });

        $('.toast').toast('show');
    </script>
</body>

</html>