<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Baluchon - Profil</title>

    <link rel="shortcut icon" type="image/ico" href="{{asset('images/favicon.ico') }}"/>
    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


    <!-- Page level plugin CSS-->
  <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">

  <!-- Custom styles for this template-->

  <link href="/css/admin/sb-admin.css" rel="stylesheet">
  <!--CKEditor Plugin-->
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>


  @yield('css_role_page')
    @yield('css_categorie_page')


</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="/">Baluchon</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
          @auth
          {{ Auth::user()->nomUser }} {{ Auth::user()->prenomUser }} {{ Auth::user()->roles->isNotEmpty() ? Auth::user()->roles->first()->name : "" }}
          @endauth
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Déconnexion</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        @role('admin,responsable-commerce')
      <li class="nav-item">
        <a class="nav-link" href="/admin">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Statistiques</span>
        </a>
      </li>
        @endrole
        <li class="nav-item active">
            <a class="nav-link" href="/profile">
                <i class="fas fa-fw fa-user"></i>
                <span>Profile</span></a>
        </li>
      @can('isAdmin')
        <li class="nav-item">
          <a class="nav-link" href="/roles">
            <i class="fa fa-unlock-alt"></i>
            <span>Roles</span></a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="/categories">
                    <i class="fa fa-box"></i>
                    <span>Categories</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/souscategories">
                    <i class="fa fa-boxes"></i>
                    <span>Sous-Categories</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/users">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Utilisateurs</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/unites">
                    <i class="fa fa-balance-scale"></i>
                    <span>Unites</span></a>
            </li>
      @endcan
      @role('admin,responsable-commerce,moderateur')
      <li class="nav-item">
        <a class="nav-link" href="/commerces">
            <i class="fas fa-fw fa-store"></i>
          <span>Commerces</span></a>
      </li>
      @endrole
        @role('admin,responsable-commerce')
        <li class="nav-item">
            <a class="nav-link" href="/produits">
                <i class="fas fa-fw fa-cart-plus"></i>
                <span>Produits</span></a>
        </li>
        @endrole
        <li class="nav-item">
            <a class="nav-link" href="/commentaires">
                <i class="fas fa-fw fa-comment"></i>
                <span>Avis</span></a>
        </li>
    </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

          @yield('content')

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Baluchon</span>
            </div>
          </div>
        </footer>

    </div>
  <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Voulez-vous vous déconnecter ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pour quitter, cliquer sur déconnexion.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>

          <a class="btn btn-primary" href="#"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              {{ __('Déconnexion') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>

          {{-- <a class="btn btn-primary" href="login.html">Logout</a> --}}
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->

  <script src="/vendor/datatables/jquery.dataTables.js"></script>
  <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/js/admin/sb-admin.js"></script>

  <!-- Demo scripts for this page-->
  <script src="/js/admin/demo/datatables-demo.js"></script>


  @yield('js_post_page')
  @yield('js_user_page')
  @yield('js_role_page')
  @yield('js_categorie_page')
  </body>

</html>
