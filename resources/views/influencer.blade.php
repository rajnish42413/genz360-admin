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
          <table class="table table-bordered data-table table-sm small">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Influencer ID</th>
                  <th>Full Name</th>
                {{--   <th>Email</th>
                  <th>Contact no</th>
                  <th>Company Type</th>
                  <th>Headquarter</th> --}}
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
        ajax: "{{ route('influencers.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'influencer_id', name: 'influencer_id'},
            {data: 'full_name', name: 'full_name'},
            // {data: 'email', name: 'email'},
            // {data: 'contact_no', name: 'contact_no'},
            // {data: 'company_type', name: 'company_type'},
            // {data: 'headquarter', name: 'headquarter'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[ 1, 'desc' ]]
    });
    
  });
</script>
@endsection