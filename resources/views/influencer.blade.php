@extends('layouts.admin')

@section('content')
<div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle">Dashboard</span>
      <h3 class="page-title">Genz360 Overview</h3>
    </div>
  </div>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h3> Influencers  <small>Total : {{$total}}</small></h3>
          <table class="table table-bordered data-table table-sm small">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Influencer ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile No</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>Device</th>
                  <th width="100px">Action</th>
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
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
        pageLength: 50,
        ajax: "{{ route('influencers.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
            {data: 'influencer_id', name: 'influencer_id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'mobile_no', name: 'mobile_no'},
            {data: 'gender', name: 'gender'},
            {data: 'age', name: 'age'},
            {data: 'not_token', name: 'not_token', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[ 1, 'desc' ]]
    });
    
  });
</script>
@endsection