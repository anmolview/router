@extends('layouts.app')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Router Detail</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('router.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
    <div class="alert alert-danger mt-1">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div><br/>
    @endif
  
    <form action="{{ route('router.update',$router->id) }}" method="POST">
      @csrf
      @method('PATCH')
   
      <div class="row">
        <div class="form-group col-6">
          <label for="uname">Sap ID:</label>
          <input type="text" class="form-control" id="sap_id" maxlength="18" value="{{ $router->sap_id }}" placeholder="Enter Sap ID" name="sap_id" required>
        </div>
        <div class="form-group col-6">
          <label for="pwd">Host Name:</label>
          <input type="text" class="form-control" id="host_name" maxlength="14" value="{{ $router->host_name }}" placeholder="Enter Host Name" name="host_name" required>
        </div>
        <div class="form-group col-6">
          <label for="uname">IP address:</label>
          <input type="text" class="form-control" id="ip_address" value="{{ $router->ip_address }}" placeholder="Enter IP address" name="ip_address" required>
        </div>
        <div class="form-group col-6">
          <label for="pwd">Mac address:</label>
          <input type="text" class="form-control" id="mac_address" maxlength="17" value="{{ $router->mac_address }}" placeholder="Enter Mac address" name="mac_address" required>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection