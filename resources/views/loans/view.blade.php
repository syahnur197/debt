@extends('layouts.app')

@section('content')
  @if ($loan->user->id == Auth::id())
    <div class="d-flex justify-content-between">
      <a href="{{ url('loans/'.$loan->id.'/edit') }}" class="btn btn-warning float-right">Edit <i class="fas fa-edit"></i></a>
    </div>
  @endif
  <div class="main">
    <div class="row my-1">
      <div class="col-lg-3 col-md-3 col-sm-12 text-center my-1">
        <div class="card p-2" >
          <img class="card-img-top" src="{{asset('storage/'.$loan->photo)}}">
        </div>
        <div class='my-4 mb-1'>Share this!</div>
        {!! $share !!}
      </div>
      <div class="col-lg-9 col-md-9 col-sm-12 my-1">
        <div class="card">
          <h5 class="card-header bg-secondary text-light">Debtor's Detail</h5>
          <div class="card-body">
            <p class="card-text my-0"><strong>Name:</strong> {{ucwords($loan->debtor_name)}}</p>
            <p class="card-text my-0"><strong>IC Number:</strong> {{$loan->debtor_ic}}</p>
            <p class="card-text my-0">
              <strong>Phone:</strong>
              <span
                data-id='{{"673".$loan->debtor_phone}}'
                data-toggle="modal" data-target="#whatsapp-modal"
                class='whatsapp'
              >
                <i class="fab fa-whatsapp" ></i>
                <a href='#'>{{"+673".$loan->debtor_phone}}</a>
              </span>
              <code>Click to send whatsapp message</code>
            </p>
            <p class="card-text my-0"><strong>Address:</strong> {{$loan->debtor_address}}</p>
            <p class="card-text my-0"><strong>Special Note:</strong></p>
            <p class="card-text my-0">{{$loan->note}}</p>
          </div>
        </div>
        <hr>
        <div class="card">
          <h5 class="card-header bg-secondary text-light">Loan's Detail</h5>
          <div class="card-body">
            <p class="card-text my-0"><strong>Loaned Amount:</strong> BND {{$loan->amount}}</p>
            <p class="card-text my-0"><strong>Loaned Date:</strong> {{Carbon\Carbon::parse($loan->loan_date)->format('d M Y')}}</p>
            <p class="card-text my-0"><strong>Loan Settlement Date:</strong> {{Carbon\Carbon::parse($loan->payback_date)->format('d M Y')}}</p>
          </div>
        </div>
        <hr>
        <div class="card">
          <h5 class="card-header bg-secondary text-light">Guarantor's Detail</h5>
          <div class="card-body">
            <p class="card-text my-0"><strong>Name:</strong> {{ucwords($loan->guarantor_name)}}</p>
            <p class="card-text my-0"><strong>IC Number:</strong> {{ucwords($loan->guarantor_ic_no)}}</p>
          </div>
        </div>
        <hr>
        <div class="card">
          <h5 class="card-header bg-secondary text-light">Creditor's Detail</h5>
          <div class="card-body">
            <p class="card-text my-0"><strong>Name:</strong> {{ucwords($loan->user->name)}}</p>
          </div>
        </div>
        <hr>
        <div class="card">
          <h5 class="card-header bg-secondary text-light">Interesting Documents</h5>
          <div class="card-body">
            @if (count($loan->documents) > 0)
              @foreach ($loan->documents as $doc)
                <img class="card-img-top img-thumbnail my-2" src="{{asset('storage/'.$doc->document)}}">
              @endforeach
            @else
              No Documents Uploaded
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="disqus_thread"></div>
@endsection

@section('modals')
<div class="modal" tabindex="-1" role="dialog" id='whatsapp-modal'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light">
        <h5 class="modal-title">Enter Your Text</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <input type="text" class='form-control my-1' id='whatsapp-message' placeholder="Help us to remind the person to settle their loan!">
            <button class="btn btn-success btn-block my-1" id='send-whatsapp-message'>Send Message</button>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('script')
<script>

$(document).ready(function(){  
  let phone = 0;
  $('body').on('click', '.whatsapp', function(e) {
    phone = $(this).data('id');
  })

  $('body').on('click', '#send-whatsapp-message', function(e) {
    let message = $("#whatsapp-message").val();
    message = encodeURI(message);
    window.open('https://api.whatsapp.com/send?phone='+phone+'&text='+message, '_blank');
  })
});
</script>
@endsection

@section('style')
<style>
    ul { 
      overflow: auto; 
    } 
    ul li { 
      list-style-type: none; float: left; 
    } 
    ul li a span { 
      background: #205D7A; 
      color: #fff; 
      width: 40px; 
      height: 40px; 
      border-radius: 20px; 
      font-size: 25px; 
      text-align: center; 
      margin-right: 10px; 
      padding-top: 15%; 
    }

    ul .fa-facebook-square { 
      background:#3b5998 
    } 
    ul .fa-google-plus-g { 
      background:#dd4b39 
    }
    ul .fa-twitter { 
      background:#00aced 
    }
</style>
@endsection