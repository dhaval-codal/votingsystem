<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  

  <title>@yield('title',"PVS")</title>

  <!-- Custom fonts for this template-->
  <link href="{{url('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{url('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{url('css/sb-admin-2.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <script src="{{url('https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js')}}"></script>
  <script src="{{url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js')}}"></script>
  <script src="{{url('https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js')}}"></script>
  <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css')}}">
  

</head>

<body id="page-top">

    <center>
      <h2 style="font-weight: bolder;">
        <a class="nav-link" href="{{url('/add_candidate')}}">
        <span>Home</span></a>
        PVS
      </h2>
      <h3>Welcome {{Session::get('username')}}</h3>
      <div style="background: lightgreen;border-radius: 8px; width: 500px;">
        <center>
          @if(count($cname) == 1)
          <h1 style="float: center;font-size: 50px;color: black;">
            <b>Winner : {{ $cname[0] }}</b>
          </h1>
          @else
          <h1 style="float: center;font-size: 50px;color: black;">
            <b>Tie Between : </b>
            @foreach ($cname as $user)
                <br><b>{{ $user }}</b>
            @endforeach
          </h1>
          @endif
        </center>
      </div> 
      <br>
    </center>
    
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{url('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{url('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{url('js/demo/datatables-demo.js')}}"></script>

  <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $(document).ready(function() {
        $('#dtHorizontalVerticalExample').DataTable();
    } );

  </script>
</body>

</html>
