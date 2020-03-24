<!DOCTYPE html>
<html lang="en">
<head>
	<title>PVS</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ url('images/icons/favicon.ico') }}/>
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

				<center>
					@if (count($errors) > 0)
					   <div class = "alert alert-danger" style="background: #FA8072; border-radius: 8px;">
					      <ul>
					         @foreach ($errors->all() as $error)
					            <li>{{ $error }}</li>
					         @endforeach
					      </ul>
					   </div>
					@endif
				</center>
				<br>
				<form class="login100-form validate-form" method="post" action="{{ url('/setvotes') }}">
					@csrf
					<span class="login100-form-title p-b-43" style="padding-bottom: 10px; " >
						<h3>
							<img src="{{ url('image/poll.png') }}" width="50" height="50" style="margin-left: -30px;">
							Preferential Voting System
						</h3><br>
						<p style="color: white;">
							Select Candidate Whom You Want To Win. <br>
							Select Candidates As You Prefer In the Order Of 1 to 4. <br>
							You Must Select 4 candidates. <b><u>Onec Submited Then You Can't Upate It.</u></b>
						</p>
					</span>
					<input type="hidden" name="ch" id="ch" value="1">
					<input type="hidden" name="b2b" id="b2b" value="0">
					<input type="hidden" name="c1" id="c1" value="0">
					<input type="hidden" name="c2" id="c2" value="0">
					<input type="hidden" name="c3" id="c3" value="0">
					<input type="hidden" name="c4" id="c4" value="0">
					<input type="hidden" name="voterun" value="{{ $user->username }}">
				<table class="table" width="100%" cellspacing="0" style="text-align:center;font-size: 20px;font-weight: bolder;color: white;">
                  <tbody>
                    <tr>
                      <td style="color: black;">{{ '1st Choice : ' }}</td>
                      <td><label id="lb1"></label></td>
                      <td style="color: black;">{{ '2nd Choice : ' }}</td>
                      <td><label id="lb2"></label></td>
                    </tr>
                    <tr>
                      <td style="color: black;">{{ '3rd Choice : ' }}</td>
                      <td><label id="lb3"></label></td>
                      <td style="color: black;">{{ '4th Choice : ' }}</td>
                      <td><label id="lb4"></label></td>
                    </tr>
                  </tbody>
                </table>
					
				<table class="table table-bordered" width="100%" cellspacing="0" style="text-align:center;font-size: 30px;font-weight: bolder;color: white;">
                  <thead style="color: black;">
                    <tr>
                      <th>Check Box</th>
                      <th>Candidate Name</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($candidates as $d)
                    <tr>
                      <td>
                      	<input type="checkbox" class="custom-control-input" id="defaultUnchecked" style="height: 25px;width: 25px;" name="check[]" onclick="check('{{ $d->name }}',this)">
                      </td>
                      <td>{{$d->name}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                
                	<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="height: 50px;" onclick="checkall()">
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<script type="text/javascript">
		
	function check(name,cb)
	{
		var ch = document.getElementById('ch').value;
		var sc = "c";
		sc = sc.concat(ch);
		if (cb.checked == false) {
			
			var bb = document.getElementById('b2b').value;
			if (bb > 0) {
				alert("First Chosse Your Preferent No " + bb);
				cb.checked = true;	
			} else {
				if ( name == document.getElementById('lb1').innerHTML) {
					document.getElementById('lb1').innerHTML = " ";
					document.getElementById('ch').value = "1";
					document.getElementById('b2b').value = "1";
					document.getElementById('c1').value = "0";
				}
				if ( name == document.getElementById('lb2').innerHTML) {
					document.getElementById('lb2').innerHTML = " ";
					document.getElementById('ch').value = "2";
					document.getElementById('b2b').value = "2";
					document.getElementById('c2').value = "0";
				}
				if ( name == document.getElementById('lb3').innerHTML) {
					document.getElementById('lb3').innerHTML = " ";
					document.getElementById('ch').value = "3";
					document.getElementById('b2b').value = "3";
					document.getElementById('c3').value = "0";
				}
				if ( name == document.getElementById('lb4').innerHTML) {
					document.getElementById('lb4').innerHTML = " ";
					document.getElementById('ch').value = "4";
					document.getElementById('b2b').value = "4";
					document.getElementById('c4').value = "0";
				}
			}
			
		} else {
			if (document.getElementById('c1').value != 0 && document.getElementById('c2').value != 0  && document.getElementById('c3').value != 0 && document.getElementById('c4').value != 0) {
				alert('You Alread Select 4 Candidates.');
				cb.checked = false;	
			} else {
				var lbid = "lb";
				lbid = lbid.concat(ch);
				document.getElementById(lbid).innerHTML = name;
				document.getElementById('ch').value = parseInt(ch) + 1 ;
				document.getElementById('b2b').value = "0";
				document.getElementById(sc).value = name;
			}
		}
	}

</script>
</body>
</html>