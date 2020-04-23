@extends('Admin.adminlayout')

@section('title','Admin - Add Voters')


@section('content')
  <style type="text/css">
    img:hover{
      cursor: pointer;
    }
  </style>
  <div class="container-fluid" >

    <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b>Add Voters</b></h1>
          </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

      <form class="" action="{{url('/addvoter')}}" method="post">
      @csrf
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-10">
                <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="username" placeholder="Enter UserName" id="username" value="{{ old('username') }}" required="">
                  </div>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <select class="form-control" id="weight" name="weight">
                      <option  value="1">Vote-WeightAge :- 1</option>
                      <option  value="2">Vote-WeightAge :- 2</option>
                      <option  value="3">Vote-WeightAge :- 3</option>
                      <option  value="4">Vote-WeightAge :- 4</option>
                      <option  value="5">Vote-WeightAge :- 5</option>
                      <option  value="6">Vote-WeightAge :- 6</option>
                    </select>
                  </div>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <button class="btn btn-primary btn-user btn-block" id="add">
                      Add
                    </button>
                  </div>
                </div>
          </div>
        </div><br>
  </form>

  <!-- Table Start -->

       <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Voters Data</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dtHorizontalVerticalExample" width="100%" cellspacing="0"style="text-align:center;">
                  <thead>
                    <tr>
                      <th>Voter Name</th>
                      <th>Voting Link</th>
                      <th>Vote WeightAge</th>
                      <th>1st Prefer </th>
                      <th>2nd Prefer </th>
                      <th>3rd Prefer </th>
                      <th>4th Prefer </th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Voter Name</th>
                      <th>Voting Link</th>
                      <th>Vote WeightAge</th>
                      <th>1st Prefer </th>
                      <th>2nd Prefer </th>
                      <th>3rd Prefer </th>
                      <th>4th Prefer </th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach ($data as $d)
                    <tr>
                      <td>{{$d->name}}</td>
                      <td>{{ $d->voting_link }}</td>
                      <td>{{ $d->weight }}</td>
                      @if($d->prefer_1 == null)
                      <td>{{ 'Not Voted Yet' }}</td>
                      @else
                      <td>{{$d->prefer_1}}</td>
                      @endif
                      @if($d->prefer_2 == null)
                      <td>{{ 'Not Voted Yet' }}</td>
                      @else
                      <td>{{$d->prefer_2}}</td>
                      @endif
                      @if($d->prefer_3 == null)
                      <td>{{ 'Not Voted Yet' }}</td>
                      @else
                      <td>{{$d->prefer_3}}</td>
                      @endif
                      @if($d->prefer_4 == null)
                      <td>{{ 'Not Voted Yet' }}</td>
                      @else
                      <td>{{$d->prefer_4}}</td>
                      @endif
                      <td>
                        <a onclick="confirmation()" href='{{url("/deletevoter/$d->id")}}'><img src="{{url('/image/delete.png')}}" class="img-responsive" width="30" height="30"></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
</div>

<!-- Table End -->

</div>


@endsection
      