@extends('layouts.admin')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
  .select2-container--default{
    display: block;
    width: 100%;
    height: calc(2.25rem + 2px) !important;
    padding: .375rem .75rem !important;
    font-size: 1rem !important;
    line-height: 1.5 !important;
    color: #495057 !important;
    background-color: #fff !important;
    background-clip: padding-box !important;
    border: 1px solid #ced4da !important;
    border-radius: .25rem !important;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }
  .select2-container--default .select2-selection--single, .select2-container--default .select2-selection--single:focus{
    border: none !important;
  }
   .select2-results>ul>li{
    padding: 0.5rem;
    font-size: 0.7em !important;
  }

</style>
@endsection

@section('content')
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle">Dashboard</span>
      <h1 class="page-title">Influencers Overview</h1>
    </div>
  </div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">       
         <form>

          <div class="row">
            <div class="col">
              <div class="dropdown d-inline">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                  Export
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#" id="json">TO JSON</a>
                  <a class="dropdown-item" href="#" id="csv" >To CSV</a>
                </div>                                    
            </div>
          </div>
          <div class="col"><h5>{{$subtotal}} of {{$total}}</h5>   </div>
            <div class="col">
              <select class="form-control" name="pagination" onchange="form.submit()">
                <option value="50" @if (request()->get('pagination') == 50) selected @endif>50</option>
                <option value="100" @if (request()->get('pagination') == 100)selected @endif>100</option>
                <option value="250" @if (request()->get('pagination')== 250)selected @endif>250</option>
                <option value="500" @if (request()->get('pagination') == 500)selected @endif>500</option>
                <option value="1000" @if (request()->get('pagination') == 1000)selected @endif>1000</option>
              </select>
            </div>
          </div>
      
          
         <hr>
  
           <div class="form-row align-items-center">

             <div class="col-2 my-1">
               <input type="text" class="form-control" placeholder="Search by name" name="name" value="{{request()->get('name')}}">
             </div>

             <div class="col-2 my-1">
               <input type="text" class="form-control" placeholder="Search by email" name="email" value="{{request()->get('email')}}">
             </div>

             <div class="col-2 my-1">
               <input type="text" class="form-control" placeholder="Search by mobile" name="mobile" value="{{request()->get('mobile')}}">
             </div>

             <div class="col-2 my-1">
              <select class="form-control js-example-basic-single" name="city">
                <option value="">Location</option>
                @foreach ($locations as $location)
                  <option value="{{$location->location_id}}" 
                    @if (request()->get('city') == $location->location_id)selected @endif
                  >{{$location->location}}</option>
                @endforeach
              </select>
             </div>

              <div class="col my-1">
              <select class="form-control" name="gender">
                <option value="">Gender</option>
                <option value="m" @if (request()->get('gender') == "m")selected @endif>
                M</option>
                <option value="f" @if (request()->get('gender') == "f")selected @endif>F</option>
                <option value="o" @if (request()->get('gender') == "o")selected @endif>O</option>
              </select>
             </div>

             <div class="col my-1">
               <select class="form-control" name="platform">
                <option value="">Platform</option>
                <option value="fb" @if (request()->get('platform') == "fb")selected @endif>Facebook</option>
                <option value="insta" @if (request()->get('platform') == "insta")selected @endif>Instagram</option>
                <option value="tw" @if (request()->get('platform') == "tw")selected @endif>Twitter</option>
                <option value="yt" @if (request()->get('platform') == "yt")selected @endif>Youtube</option>
              </select>
             </div>

             <div class="col-auto my-1">
               <button type="submit" class="btn btn-primary">Submit</button>
             </div>
           </div>
         </form>
         <br>
          <table class="table table-bordered data-table table-sm small" id="tableID">
          <thead>
              <tr>
                  <th>Influencer ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile No</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>DOB</th>
                  <th>Location</th>
                  <th>Wallet</th>
                  <th><i class="fab fa-facebook-square"></i></th>
                  <th><i class="fab fa-instagram"></i></th>
                  <th><i class="fab fa-twitter-square"></i></th>
                  <th><i class="fab fa-youtube-square"></i></th>
                  <th>Created At</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($influnceres as $inf)
             <tr>
              <td>{{$inf->influencer_id}}</td>
              <td>{{$inf->name}}</td>
              <td>{{$inf->email}}</td>
              <td>{{$inf->mobile_no}}</td>
              <td class="text-uppercase">{{$inf->gender}}</td>
              <td>{{$inf->age}}</td>
              <td>{{$inf->date_of_birth}}</td>
              <td>{{$inf->city()}}</td>
              {{-- <td>{{$inf->profile_photo}}</td> --}}
              {{-- <td>{{$inf->updated}}</td> --}}
              <td>{{$inf->i_wallet}}</td>

              <td><i class="fas {{$inf->use_facebook ? "fa-check text-success":"fa-times text-danger"}}"></i>
                @if ($inf->facebook)
                {{$inf->facebook->follower_count}}
                @endif
              </td>

              <td><i class="fas {{$inf->use_instagram ? "fa-check text-success":"fa-times text-danger"}}"></i>
              @if ($inf->instagram)
                {{$inf->instagram->follower_count}}
                @endif
              </td>

              <td><i class="fas {{$inf->use_twitter ? "fa-check text-success":"fa-times text-danger"}}"></i>
              @if ($inf->twitter)
                {{$inf->twitter->follower_count}}
                @endif
              </td>

              <td><i class="fas {{$inf->use_youtube ? "fa-check text-success":"fa-times text-danger"}}"></i>
              @if ($inf->youtube)
                {{$inf->youtube->subscriber_count}}
                @endif
              </td>

             {{--  <td>{{$inf->c_tokken}}</td>
              <td>{{$inf->not_token}}</td> --}}
              <td>{{$inf->registration_date}}</td>
              <td>
                <div class="dropdown show dropleft">
                  <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink-{{$inf->influencer_id}}" data-toggle="dropdown" aria-haspopup="flase" aria-expanded="false">
                     <i class="fas fa-ellipsis-v"></i>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-{{$inf->influencer_id}}">
                    @if ($inf->not_token)
                    <a class="dropdown-item" href="user/notification/{{$inf->not_token}}" href="{{ route('notification.user',$inf->not_token) }}">Send Notification</a>
                    @endif
                    <a class="dropdown-item" href="#">More Detail</a>
                    <a class="dropdown-item" href="#">Delete User</a>
                  </div>
                </div>
              </td>
             </tr>
            @endforeach
          </tbody>
      </table>
      {{ $influnceres->links() }}
    </div>
    </div>
  </div>
</div>
@endsection


@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
<script type="text/javascript" src="{{ asset('scripts/tableExport.js') }}"></script>
<script>
$(document).ready(function() {
  $('.js-example-basic-single').select2();
});
  $('#json').on('click',function(){
    $("#tableID").tableHTMLExport({type:'json',filename:'sample.json'});
  })
  $('#csv').on('click',function(){
    $("#tableID").tableHTMLExport({type:'csv',filename:'sample.csv'});
  })
  // $('#pdf').on('click',function(){
  //   $("#tableID").tableHTMLExport({type:'pdf',filename:'sample.pdf'});
  // })
  </script>
@endsection