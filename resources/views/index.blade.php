@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mt-3">
            <div class="float-left">
                <h2>Router Details</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-sm btn-info" href="{{ route('router.create') }}"> Add</a>
            </div>
        </div>
    </div>
   <div id="alert">
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-1">
            <p>{{ $message }}</p>
        </div>
    @endif
   </div>
   
    <table class="table table-striped datatable " id="router" border="1">
        <thead>
            <tr>
                <th>SAP ID</th>
                <th>Host Name</th>
                <th>IP Address</th>
                <th>MAC Address</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
      
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
$('#router').DataTable({
    "paging": true,
    "processing": true,
    "serverSide": true,
    "lengthMenu": [25, 50, 75, 100],
    "responsive": true,
    "lengthChange": true,
    "searching": true,

    "ajax": {
      "url": "{{route('router.index')}}",
      "type": "GET",
    },

    "columns": [{
        "data": "sap_id",
      },
      {
        "data": "host_name",
      },
      {
        "data": "ip_address",
      },
      {
        "data": "mac_address",
      },
      {
        "data": "action",
        sortable: false
      },
    ]
  });

  $(document).on('click', '.delete-router', function(){
    var elm = $(this);
    var id = elm.attr('data-id');
    url = "{{route('router.destroy',":id")}}";
    url = url.replace(':id', id);
    $.ajax({
      type: 'delete',
      url: url,
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      success: function(response) {
        elm.parent().parent().remove();
        $('#alert').html('<div class="alert alert-success mt-1"><p>'+response.message+'</p></div>');
      },
      error: function(error) {
        $('#alert').html('<div class="alert alert-danger mt-1"><p>'+error.responseJSON.message+'</p></div>');
      }
    });
  });
});
</Script>
@endsection