<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas</title>
    <link rel="stylesheet" href="/libs/bootstrap-5.0.2-dist/css/bootstrap.min.css">
  
  <link rel="stylesheet" href="css/style.css">
  
    <link rel="stylesheet" href="/libs/DataTables/datatables.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h4>Sistema de Consultas</h4>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main style="min-height: calc(100vh - 200px);">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @yield('contenido')
                </div>
            </div>
        </div>

    </main>

    <footer class="footer mt-auto py-3 fixed-bottom" style="background-color: black;">
        <div class="container" >
            <p class="text-white text-center">
                Yendry Villalobos Oviedo - Charlotte Rojas Padilla &copy; {{ date('Y-m-d') }}
            </p>
        </div>
    </footer>
    

    <script src="/libs/jquery/jquery-3.6.4.min.js"></script>
    <script src="/libs/jquery/jquery-ui.min.js"></script>
    <script src="/libs/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src="/libs/DataTables/datatables.min.js"></script>

    @yield('js')

</body>

</html>
