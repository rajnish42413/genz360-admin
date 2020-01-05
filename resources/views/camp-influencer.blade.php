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
      <h1 class="page-title">campluencers Overview</h1>
    </div>
  </div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">       

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
          </div>
      
          
         <hr>

         <br>
          <table class="table table-bordered data-table table-sm small" id="tableID">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>I ID</th>
                   <th>C ID</th>
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
            @foreach ($data as $camp)
             <tr>
              <td>{{$camp->inf_inv_id}}</td>
              <td>{{$camp->campaingn_id}}</td>
              @if ($camp->influencer)
              <td>{{$camp->influencer_id}}</td>
              <td>{{$camp->influencer->name}}</td>
              <td>{{$camp->influencer->email}}</td>
              <td>{{$camp->influencer->mobile_no}}</td>
              <td class="text-uppercase">{{$camp->influencer->gender}}</td>
              <td>{{$camp->influencer->age}}</td>
              <td>{{$camp->influencer->date_of_birth}}</td>
              <td>{{$camp->influencer->city()}}</td>
              {{-- <td>{{$camp->profile_photo}}</td> --}}
              {{-- <td>{{$camp->updated}}</td> --}}
              <td>{{$camp->influencer->i_wallet}}</td>
              <td><i class="fas {{$camp->influencer->use_facebook ? "fa-check text-success":"fa-times text-danger"}}"></i>
                @if ($camp->influencer->facebook)
                {{$camp->influencer->facebook->follower_count}}
                @endif
              </td>

              <td><i class="fas {{$camp->influencer->use_instagram ? "fa-check text-success":"fa-times text-danger"}}"></i>
              @if ($camp->influencer->instagram)
                {{$camp->influencer->instagram->follower_count}}
                @endif
              </td>

              <td><i class="fas {{$camp->influencer->use_twitter ? "fa-check text-success":"fa-times text-danger"}}"></i>
              @if ($camp->influencer->twitter)
                {{$camp->influencer->twitter->follower_count}}
                @endif
              </td>

              <td><i class="fas {{$camp->influencer->use_youtube ? "fa-check text-success":"fa-times text-danger"}}"></i>
              @if ($camp->influencer->youtube)
                {{$camp->influencer->youtube->subscriber_count}}
                @endif
              </td>
              <!-- <td><i class="fas {{$camp->influencer->use_facebook ? "fa-check text-success":"fa-times text-danger"}}"></i></td>
              <td><i class="fas {{$camp->influencer->use_instagram ? "fa-check text-success":"fa-times text-danger"}}"></i></td>
              <td><i class="fas {{$camp->influencer->use_twitter ? "fa-check text-success":"fa-times text-danger"}}"></i></td>
              <td><i class="fas {{$camp->influencer->use_youtube ? "fa-check text-success":"fa-times text-danger"}}"></i></td> -->
             {{--  <td>{{$camp->c_tokken}}</td>
              <td>{{$camp->not_token}}</td> --}}
              <td>{{$camp->registration_date}}</td>
              <td>
                <div class="dropdown show dropleft">
                  <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink-{{$camp->campluencer_id}}" data-toggle="dropdown" aria-haspopup="flase" aria-expanded="false">
                     <i class="fas fa-ellipsis-v"></i>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-{{$camp->campluencer_id}}">
                    @if ($camp->not_token)
                    <a class="dropdown-item" href="user/notification/{{$camp->not_token}}">Send Notification</a>
                    @endif
                    <a class="dropdown-item" href="#">More Detail</a>
                    <a class="dropdown-item" href="#">Delete User</a>
                  </div>
                </div>
              </td>
              @endif
             </tr>
            @endforeach
          </tbody>
       </table>
      {{ $data->links() }}
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