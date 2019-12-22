@extends('layouts.admin')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row p-2">

<div class="page-header row no-gutters py-4">

    <div class="col-12 col-sm-4 text-center text-sm-left mb-3">
      <span class="text-uppercase page-subtitle">Dashboard</span>
      <h3 class="page-title">Send Notification</h3>
    </div>



  <div class="col-md-12">
   <div class="card mb-5">
     <div class="card-body">
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


        <form action="user/notify/{{$token}}" method="post">
           {{ csrf_field() }}
         <div class="row">
            <div class="col-12 mt-3 mb-5">
              <label>Title of Notification.</label>
              <input type="text" name="title" placeholder="enter here" class="form-control">
            </div>
            <br>

            <div class="col-12 mb-5">
              <label>Message.</label>
              <textarea class="form-control" rows="3" placeholder="enter here ....." name="message"></textarea>
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


@section('script')
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('brands.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'full_name', name: 'full name'},
            {data: 'email', name: 'email'},
            {data: 'contact_no', name: 'contact no'},
            {data: 'company_type', name: 'company type'},
            {data: 'headquarter', name: 'headquarter'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
@endsection