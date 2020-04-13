@extends('Admin.adminlayout')

@section('title','Admin - Winner')


@section('content')
  <style type="text/css">
    img:hover{
      cursor: pointer;
    }
  </style>
  <div class="container-fluid" >
    <center>
      <div style="background: lightgreen;border-radius: 8px;">
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
  </div>

<!-- Round 1 Table End -->
  <div class="card shadow mb-4" style="margin-left: 20px;margin-right: 20px;">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Round 1</h6>
        <h4 style="float: right;margin-top: -25px;margin-bottom: -10px;color: blue;font-weight: bolder;">Out Of Race : 
          @foreach($round1['ofr'] as $ofr)
          {{ $ofr }}
          @endforeach
        </h4>
      </div>
      <div class="card-body">
        <div class="">
          <table class="table table-bordered" width="98%" cellspacing="0"style="text-align:center;">
            <thead>
              <tr>
                <th>{{ "Candidates" }}</th>
                @foreach($votern as $voter)
                <th>{{ $voter->name }}</th>
                @endforeach
                <th>{{ "Count" }}</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>{{ "Candidates" }}</th>
                @foreach($votern as $voter)
                <th>{{ $voter->name }}</th>
                @endforeach
                <th>{{ "Count" }}</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($candidate as $c)
              @php ($cnt = 0)
              <tr>
                <td>{{$c->name}}</td>
                @for ($i = 0; $i <= (count($votern)-1); $i++)
                    @if($c->name == $round1[$i]['prefer_1'])
                         <td>{{ 1 }}</td>
                         @php ($cnt++)
                    @elseif($c->name == $round1[$i]['prefer_2'])
                         <td>{{ 2 }}</td>
                    @elseif($c->name == $round1[$i]['prefer_3'])
                         <td>{{ 3 }}</td>
                    @elseif($c->name == $round1[$i]['prefer_4'])
                         <td>{{ 4 }}</td>
                    @else 
                         <td>{{ 0 }}</td>
                    @endif
                @endfor
                <td>
                  {{ $cnt }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
<!-- End Round 1 Table End -->


<!-- Round 2 Table End -->
  <div class="card shadow mb-4" style="margin-left: 20px;margin-right: 20px;">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Round 2</h6>
        <h4 style="float: right;margin-top: -25px;margin-bottom: -10px;color: blue;font-weight: bolder;">Out Of Race : 
          @foreach($round2['ofr'] as $ofr)
          {{ $ofr }}
          @endforeach
        </h4>
      </div>
      <div class="card-body">
        <div class="">
          <table class="table table-bordered" width="98%" cellspacing="0"style="text-align:center;">
            <thead>
              <tr>
                <th>{{ "Candidates" }}</th>
                @foreach($votern as $voter)
                <th>{{ $voter->name }}</th>
                @endforeach
                <th>{{ "Count" }}</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>{{ "Candidates" }}</th>
                @foreach($votern as $voter)
                <th>{{ $voter->name }}</th>
                @endforeach
                <th>{{ "Count" }}</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($candidate as $c)
                @if(!in_array($c->name, $round1['ofr']))
                  @php ($cnt = 0)
                  <tr>
                    <td>{{$c->name}}</td>
                    @for ($i = 0; $i <= (count($votern)-1); $i++)
                        @if($c->name == $round2[$i]['prefer_1'])
                             <td>{{ 1 }}</td>
                             @php ($cnt++)
                        @elseif($c->name == $round2[$i]['prefer_2'])
                             <td>{{ 2 }}</td>
                        @elseif($c->name == $round2[$i]['prefer_3'])
                             <td>{{ 3 }}</td>
                        @elseif($c->name == $round2[$i]['prefer_4'])
                             <td>{{ 4 }}</td>
                        @else 
                             <td>{{ 0 }}</td>
                        @endif
                    @endfor
                    <td>
                      {{ $cnt }}
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
<!-- End Round 2 Table End -->


<!-- Round 1 Table End -->
  <div class="card shadow mb-4" style="margin-left: 20px;margin-right: 20px;">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Round 3</h6>
        <h4 style="float: right;margin-top: -25px;margin-bottom: -10px;color: blue;font-weight: bolder;">Out Of Race : 
          @foreach($round3['ofr'] as $ofr)
          {{ $ofr }}
          @endforeach
        </h4>
      </div>
      <div class="card-body">
        <div class="">
          <table class="table table-bordered" width="98%" cellspacing="0"style="text-align:center;">
            <thead>
              <tr>
                <th>{{ "Candidates" }}</th>
                @foreach($votern as $voter)
                <th>{{ $voter->name }}</th>
                @endforeach
                <th>{{ "Count" }}</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>{{ "Candidates" }}</th>
                @foreach($votern as $voter)
                <th>{{ $voter->name }}</th>
                @endforeach
                <th>{{ "Count" }}</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($candidate as $c)
                @if(!in_array($c->name, $round2['ofr']))
                  @php ($cnt = 0)
                  <tr>
                    <td>{{$c->name}}</td>
                    @for ($i = 0; $i <= (count($votern)-1); $i++)
                        @if($c->name == $round3[$i]['prefer_1'])
                             <td>{{ 1 }}</td>
                             @php ($cnt++)
                        @elseif($c->name == $round3[$i]['prefer_2'])
                             <td>{{ 2 }}</td>
                        @elseif($c->name == $round3[$i]['prefer_3'])
                             <td>{{ 3 }}</td>
                        @elseif($c->name == $round3[$i]['prefer_4'])
                             <td>{{ 4 }}</td>
                        @else 
                             <td>{{ 0 }}</td>
                        @endif
                    @endfor
                    <td>
                      {{ $cnt }}
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </div>
<!-- End Round 3 Table End -->



</div>


@endsection
      