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
                  <th>Influencer</th>                 
                  <th>Wallet</th>   
                  <th>Post Detail</th>            
                  <th>Accepted</th>               
                  <th>Payout</th>               
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($data as $camp)
             <tr>

              <td>{{$camp->inf_inv_id}}</td>

              @if ($camp->influencer)
              <td>
                <div class="row">
                  <div class="col">
                    <div class="small">ID-{{$camp->influencer_id}},<br>
                         Name-{{$camp->influencer->name}},<br>
                         Email-{{$camp->influencer->email}},<br>
                         Phone-{{$camp->influencer->mobile_no}}

                    </div>
                  </div>
                  <div class="col">
                     <div class="small">
                        Gender-{{$camp->influencer->gender}},
                        Age-{{$camp->influencer->age}},<br>
                        DOB-{{$camp->influencer->date_of_birth}},
                        Location-{{$camp->influencer->city()}}
                     </div>
                  </div>
                </div>                
              </td>

              <td>{{$camp->influencer->i_wallet}}</td>  

              <td>
                <div class="small">
                  PostData-{{$camp->post->post_data}},<br>
                  postuniqueId-{{$camp->post->post_unique_id}}<br>                 
                  @if ($camp->post->file_name)
                  <a href="http://www.genz360.com:81/get-image/{{$camp->post->file_name}}" target="_blank">View File</a>
                  @endif
                </div>
              </td>
               <td>
                 @if ($camp->accepted)
                  <div class="badge badge-success">true</div>
                 @else 
                  <div class="badge badge-danger">False</div>
                 @endif
               </td>

               <td>
                 @if ($camp->paid_status)
                  <div class="badge badge-success">Done</div>
                 @else 
                  <div class="badge badge-warning">Not Done</div>
                 @endif
               </td>

              <td>
                <div class="dropdown show dropleft">
                  <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink-{{$camp->campluencer_id}}" data-toggle="dropdown" aria-haspopup="flase" aria-expanded="false">
                     <i class="fas fa-ellipsis-v"></i>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-{{$camp->campluencer_id}}">
                    @if ($camp->influencer->not_token)
                    <a class="dropdown-item" href="{{ route('notification.user',$camp->influencer->influencer_id) }}">Send Notification</a>
                    @endif

                    @if (!$camp->paid_status)
                    <a href="{{ route('campaign.payout',$camp->inf_inv_id) }}" class="dropdown-item">Payout</a>
                    @endif

                    
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