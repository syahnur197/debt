@extends('layouts.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          @if(Request::is("listings/$listing->id"))
            {{ $listing->name }}
          @else
            {{ $title }}
          @endif
        </div>
        <div class="card-body">
          @if(Request::is("listings/$listing->id"))
            <ul class="list-group">
              <li class="list-group-item">Address: {{ $listing->address }}</li>
              <li class="list-group-item">Website: <a href="http://www.{{ $listing->website }}" target="_blank">{{ $listing->website }}</a></li>
              <li class="list-group-item">Email: {{ $listing->email }} </li>
              <li class="list-group-item">Phone: {{ $listing->phone }}</li>
            </ul>
            <div class="card card-body bg-light my-3">
              {{ $listing->bio }}
            </div>
          @endif
          @unless(Request::is("listings/$listing->id"))
            {!! Form::open(['url' => $action, 'method' => $method]) !!}
            {{ Form::bsText('name', $listing->name, ['placeholder' => 'Company Name', "disabled" => $disabled]) }}
            {{ Form::bsText('website', $listing->website, ['placeholder' => 'Company Website', "disabled" => $disabled]) }}
            {{ Form::bsText('email', $listing->email, ['placeholder' => 'Company Email', "disabled" => $disabled]) }}
            {{ Form::bsText('phone', $listing->phone, ['placeholder' => 'Company Phone', "disabled" => $disabled]) }}
            {{ Form::bsText('address', $listing->address, ['placeholder' => 'Company Address', "disabled" => $disabled]) }}
            {{ Form::bsTextArea('bio', $listing->bio, ['placeholder' => 'About This Business', "disabled" => $disabled]) }}
            {!! Form::bsSubmit('Submit', []) !!}
          @endunless
          {!! Form::close() !!}
          @if(Request::is("listings/$listing->id") && $listing->user_id == Auth::id())
            <a href="/listings/{{ $listing->id }}/edit" class="btn btn-warning btn-block py-1">Edit</a>
            <a class="btn btn-danger btn-block py-1"  
              onclick="confirmDelete();">
              Delete Listing
            </a>
            {!! Form::open(['url' => "/listings/$listing->id", 'method' => "DELETE", "id" => "delete-listing-form"]) !!}
            {!! Form::close() !!}
            <script>
              function confirmDelete() {
                let confirmation = confirm("Are you sure?");
                if (confirmation) {
                  document.getElementById('delete-listing-form').submit();
                } else {
                  alert("cancelled");
                }
              }
            </script>
          @elseif(Request::is("listings/$listing->id/edit"))
            <a href="/listings/{{ $listing->id }}" class="btn btn-dark btn-block py-1">View</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
