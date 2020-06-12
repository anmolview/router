@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2 mt-3">
    <h3 class="display-6">Add New Router</h3>
  <div>
  @if ($errors->any())
    <div class="alert alert-danger mt-1">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div><br/>
  @endif
  <form action="{{route('router.store')}}" method="POST">
  @csrf
    <div class="row">
      <div class="form-group col-6">
        <label for="uname">Sap ID:</label>
        <input type="text" class="form-control" id="sap_id" maxlength="18" value="{{ old('sap_id') }}" placeholder="Enter Sap ID" name="sap_id" required>
      </div>
      <div class="form-group col-6">
        <label for="pwd">Host Name:</label>
        <input type="text" class="form-control" id="host_name" maxlength="14" value="{{ old('host_name') }}" placeholder="Enter Host Name" name="host_name" required>
      </div>
      <div class="form-group col-6">
        <label for="uname">IP address:</label>
        <input type="text" class="form-control" id="ip_address" value="{{ old('ip_address') }}" placeholder="Enter IP address" name="ip_address" required>
      </div>
      <div class="form-group col-6">
        <label for="pwd">Mac address:</label>
        <input type="text" class="form-control" id="mac_address" maxlength="17" value="{{ old('mac_address') }}" placeholder="Enter Mac address" name="mac_address" required>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection