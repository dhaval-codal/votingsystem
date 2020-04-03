<!DOCTYPE html>
<html lang="en">
<head>
	<title>PVS</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ url('images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{	{ url('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ url('vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ url('vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ url('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-b-160 p-t-50">
					
					<span class="login100-form-title p-b-43">
						<img src="{{ url('image/poll.png') }}" width="80" height="80" style="margin-left: -30px;">
						<h1>Preferential Voting System</h1>
					</span>
					<span class="login100-form-title p-b-43">
						Hello {{ $user->name }}
					</span>
					<span class="login100-form-title p-b-43">
						Your Vote Saved Successfilly.
					</span>
					
					<table class="table" width="100%" cellspacing="0" style="text-align:center;font-size: 20px;font-weight: bolder;color: white;">
	                  <tbody>
	                    <tr>
	                      <td style="color: black;">{{ 'Your 1stChoice : ' }}</td>
	                      <td><label id="lb1">{{ $user->oprefer_1 }}</label></td>
	                      <td style="color: black;">{{ 'Your 2ndChoice : ' }}</td>
	                      <td><label id="lb2">{{ $user->oprefer_2 }}</label></td>
	                    </tr>
	                    <tr>
	                      <td style="color: black;">{{ 'Your 3rdChoice : ' }}</td>
	                      <td><label id="lb3">{{ $user->oprefer_3 }}</label></td>
	                      <td style="color: black;">{{ 'Your 4thChoice : ' }}</td>
	                      <td><label id="lb4">{{ $user->oprefer_4 }}</label></td>
	                    </tr>
	                    <tr>
	                    	<td></td>
	                    	<td></td>
	                    	<td></td>
	                    	<td></td>
	                    </tr>
	                  </tbody>
	                </table>
					
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>