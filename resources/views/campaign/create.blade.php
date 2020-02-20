@extends('layouts.admin')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-2">
      <span class="text-uppercase page-subtitle">Dashboard</span>
      <h3 class="page-title">Create Campaign</h3>
    </div>

    @if ($errors->any())
      <div class="alert alert-dangers">
          @foreach ($errors->all() as $error)
              <div class="small text-danger"> - {{ $error }}</div><br>
          @endforeach
        </div>
    @endif

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
    @endif

  
<div class="row">
  <div class="col-md-6">
   <div class="card">
     <div class="card-body">
       <h3>Basic Details</h3>
       
        <form action="{{ route('notification.send') }}" method="post">
           {{ csrf_field() }}
         <div class="row">

            <div class="col-12">
                <label>Campaign Name</label>
                <input type="name" name="name" value="{{old('name')}}" class="form-control">
            </div>

            <div class="col mt-3">
              <label>Select Campaign</label>
               <select class="form-control" name="campaign">
                <option value="">Select Brand</option>
                @foreach ($brands as $brand)
                  <option>{{$brand->brand_name}}</option>
                @endforeach  
              </select>
            </div>
      
            

            <div class="col-12 mt-3 mb-5">
              <label>Title of Notification.</label>
              <input type="text" name="title" placeholder="enter here" class="form-control" value="{{old('title')}}">
            </div>
          

            <div class="col-12 mb-5">
              <label>Description</label>
              <textarea class="form-control" rows="3" placeholder="enter here ....." name="desc">
                {{old('desc')}}
              </textarea>
            </div>

            <button class="btn btn-block btn-primary" type="submit">Send</button>
            <div class="mb-5"></div>
         </div>
       </form>
     </div>
   </div>
  </div>

  <div class="col-md-6">
   <div class="card">
     <div class="card-body">
       <h3>Email Notification </h3>
       
        <form action="{{ route('notification.email') }}" method="post">
           {{ csrf_field() }}
         <div class="row">
            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="all" name="allusers">
                <label class="form-check-label" for="defaultCheck1">
                    All Influencers
                </label>
              </div>
            </div>

            <div class="col mt-3">
              <label>Select Campaign</label>
               <select class="form-control js-example-basic-single" name="campaign">
                <option value="">Select Campaign</option>
              
              </select><br>
              <small>To send notificaion to active campaign influencer.</small>
            </div>

            <br>

            <div class="col-12 mt-3 mb-5">
              <label>Subject.</label>
              <input type="text" name="subject" placeholder="enter here" class="form-control" value="{{old('subject')}}">
            </div>
            <br>

            <div class="col-12 mt-3 mb-5">
              <label>Title</label>
              <input type="text" name="title" placeholder="enter here" class="form-control" value="{{old('title')}}">
            </div>

            <br>

            <div class="col-12 mb-5">
              <label>Message.</label>
              <textarea class="form-control" rows="3" placeholder="enter here ....." name="message">
              {{old('message')}}
              </textarea>
            </div>

            <button class="btn btn-block btn-primary" type="submit">Send</button>
            <div class="mb-5"></div>
         </div>
       </form>
     </div>
   </div>
  </div>

</div>
@endsection
