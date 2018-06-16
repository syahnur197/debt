@extends('layouts.app')

@section('content')
  <div class="main">
    <div class="d-flex justify-content-between">
      <a href="{{ url('loans/'.$loan->id) }}" class="btn btn-warning float-right">View <i class="fas fa-eye"></i></a>
    </div>
    <div class="row my-1">
      <div class="col-lg-3 col-md-3 col-sm-12 text-center my-1">
        <div class="card p-2" >
          <img class="card-img-top" src="{{asset('storage/'.$loan->photo)}}">
        </div>
      </div>
      <div class="col-lg-9 col-md-9 col-sm-12 my-1">
        {!! Form::open(['url' => '/loans/'.$loan->id, 'id' => 'update-loan-form', 'files' => true, 'method' => 'PUT']) !!}
        <div class="card">
          <h5 class="card-header bg-secondary text-light">Debtor's Detail</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group my-1">
                  <label for="debtor_name" class="control-label">Name</label>
                  <input type="text" name="debtor_name" id="debtor_name" class="form-control" value="{{ ucwords($loan->debtor_name) }}">
                </div>
                <div class="form-group my-1">
                  <label for="debtor_ic" class="control-label">IC Number</label>
                  <input type="text" name="debtor_ic" id="debtor_ic" class="form-control" value="{{ $loan->debtor_ic }}">
                </div>
                <div class="form-group my-1">
                  <label for="debtor_phone" class="control-label">Phone <span class="small text-danger">(without +673 and dashes)</span></label>
                  <input type="number" name="debtor_phone" id="debtor_phone" class="form-control" min='7000000' max='8999999' value="{{ $loan->debtor_phone }}">
                </div>
                <div class="form-group my-1">
                  <label for="debtor_address" class="control-label">Address</label>
                  <input type="text" name="debtor_address" id="debtor_address" class="form-control" value="{{ $loan->debtor_address }}">
                </div>
                <div class="form-group my-1">
                  <label for="" class="control-label">Photo</label> <span class="small text-danger">(Choose image to change debtor photo)</span>
                  <input type="file" class='form-control' name='photo' accept="image/*">
                </div>
                <div class="form-group my-1">
                  <label for="note" class="control-label">Special Note</label>
                  <p class="small mb-0 text-danger">Say something about this debtor.</p>
                  <textarea name="note" id="note" rows="5" class='form-control'>{{ $loan->note }}</textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="card">
          <h5 class="card-header bg-secondary text-light">Loan's Detail</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group my-1">
                  <label for="amount" class="control-label">Amount <span class="small text-danger">(in BND)</span></label>
                  <input type="text" name="amount" id="amount" class="form-control" value="{{ $loan->amount }}">
                </div>
                <div class="form-group my-1">
                  <label for="loan_date" class="control-label">Loan Date</label>
                  <input type="date" name="loan_date" id="loan_date" class="form-control" value="{{ $loan->loan_date }}">
                </div>
                <div class="form-group my-1">
                  <label for="payback_date" class="control-label">Loan Settlement Date</label>
                  <input type="date" name="payback_date" id="payback_date" class="form-control" value="{{ $loan->payback_date }}">
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="card">
          <h5 class="card-header bg-secondary text-light">Guarantor's Detail</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group my-1">
                  <label for="guarantor_name" class="control-label">Name</label>
                  <input type="text" name="guarantor_name" id="guarantor_name" class="form-control" value="{{ ucwords($loan->guarantor_name) }}">
                </div>
                <div class="form-group my-1">
                  <label for="guarantor_ic_no" class="control-label">IC Number</label>
                  <input type="text" name="guarantor_ic_no" id="guarantor_ic_no" class="form-control" value="{{ ucwords($loan->guarantor_ic_no) }}">
                </div>
              </div>
            </div>
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
            <div class="form-group my-1">
              <button type='button' id='extra-doc' class="btn btn-secondary text-light my-2">Add Additional Documents</button>
              <div id='extra-doc-div'>
              </div>
            </div>
            @if (count($loan->documents) > 0)
              @foreach ($loan->documents as $doc)
                <div class='card my-2'>
                  <div class='card-body'>
                    <img class="card-img-top img-thumbnail" src="{{asset('storage/'.$doc->document)}}">
                    <div class='text-center my-2'><button type='buttonn' class='btn btn-danger center delete-doc' data-id='{{ $doc->id }}'>Delete Document</button></div>
                  </div>
                </div>
              @endforeach
            @else
              No Documents Uploaded
            @endif
          </div>
        </div>
        {!! Form::bsSubmit('Submit', ['class' => 'bg-gradient-success btn btn-block text-light mt-2']) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      $("body").on('click', '.delete-extra', function(e) {
        $(this).parent().parent().remove();
      });
    
      $('body').on('click', '#extra-doc', function(e) {
        let extra = `<div class='row'>
          <div class='col-1'>
          <button type='button' class="btn btn-danger delete-extra"><i class="far fa-trash-alt"></i></button>
          </div>
          <div class='col-11'><input type="file" class='form-control mb-2' name='document[]' multiple accept="image/*"></div></div>`;
        $("#extra-doc-div").append(extra);
      });

      $('body').on('click', '.delete-doc', function(e) {
        let confirmation = confirm("Are you sure you want to delete this document?");
        if (!confirmation) {
          return false;
        }

        let data = {
          'document_id' : $(this).data('id'),
          '_method' : 'DELETE',
          'csrf-token' : '{{ csrf_token() }}'
        }

        $.post('{{ url("api/document") }}', data, function(resp) {
          alert(resp.message);
        });
        $(this).parent().parent().parent().remove();
      });
    });
  </script>
@endsection
