@extends('layouts.app') 
@section('content')
  <a href="/loans/create" class="btn btn-primary float-right">Add Loan Statement</a>
  <br>
  <br>
  @if(count($loans) > 0)
    @foreach($loans as $loan)
      <div class="card card-body bg-light">
        <p>Name:  {{$loan->debtor_name}}</p>
        <p>Amount: B$ {{$loan->amount}}</p>
        <div class="row">
          <div class="col-4 my-1">
            <a href="/loans/{{$loan->id}}" class="btn btn-success btn-block">View</a>
          </div>
          <div class="col-4 my-1">
            <a href="/loans/{{$loan->id}}/edit" class="btn btn-warning btn-block">Edit</a>
          </div>
          <div class="col-4 my-1">
            <a href="/loans/{{$loan->id}}" class="btn btn-danger btn-block">Private</a>
          </div>
        </div>
      </div>
      <hr>
    @endforeach
  @endif
@endsection