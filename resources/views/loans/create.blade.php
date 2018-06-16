@extends('layouts.app') 

@section('content')
  <div>
    <a href="/dashboard" class="btn btn-secondary mb-2">
      <i class="fas fa-arrow-left"></i>
      Go Back
    </a>
    <div class='text-center' id="page-title">
      <h3 class='font-weight-bold'>Add Loan Statement</h3>
    </div>
  </div>

  {!! Form::open(['url' => '/loans', 'id' => 'create-loan-form', 'files' => true, 'method' => 'POST']) !!}
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="row mb-2">
        <div class="col-6">
          <button type='button' id='prev-button' class="mt-2 btn btn-success text-light btn-block" data-id='0'> Previous </button>
        </div>
        <div class="col-6">
          <button type='button' id='next-button' class="mt-2 btn btn-success text-light btn-block" data-id='2'> Next </button>
        </div>
      </div>
      <div id='card-1'>
        <div class="card mb-2">
          <div class="card-header p-3 mb-2 bg-secondary text-light">
            Debtor's Detail
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group my-1">
                  <label for="debtor_name" class="control-label">Name</label>
                  <input type="text" name="debtor_name" id="debtor_name" class="form-control" value="{{ old('debtor_name') }}">
                </div>
                <div class="form-group my-1">
                  <label for="debtor_ic" class="control-label">IC Number</label>
                  <input type="text" name="debtor_ic" id="debtor_ic" class="form-control" value="{{ old('debtor_ic') }}">
                </div>
                <div class="form-group my-1">
                  <label for="debtor_phone" class="control-label">Phone <span class="small text-danger">(without +673 and dashes)</span></label>
                  <input type="number" name="debtor_phone" id="debtor_phone" class="form-control" min='7000000' max='8999999' value="{{ old('debtor_phone') }}">
                </div>
                <div class="form-group my-1">
                  <label for="debtor_address" class="control-label">Address</label>
                  <input type="text" name="debtor_address" id="debtor_address" class="form-control" value="{{ old('debtor_address') }}">
                </div>
                <div class="form-group my-1">
                  <label for="" class="control-label">Photo <span class="small text-danger">(Upload square images for better result!)</span></label>
                  <input type="file" class='form-control' name='photo' value="{{ old('photo') }}" accept="image/*">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id='card-2' class="d-none">
        <div class="card mb-2">
          <div class="card-header p-3 mb-2 bg-secondary text-light">
            Loan's Detail
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group my-1">
                  <label for="amount" class="control-label">Amount</label>
                  <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount') }}">
                </div>
                <div class="form-group my-1">
                  <label for="loan_date" class="control-label">Loan Date</label>
                  <input type="date" name="loan_date" id="loan_date" class="form-control" value="{{ old('loan_date') }}">
                </div>
                <div class="form-group my-1">
                  <label for="payback_date" class="control-label">Loan Settlement Date</label>
                  <input type="date" name="payback_date" id="payback_date" class="form-control" value="{{ old('payback_date') }}">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id='card-3' class="d-none">
        <div class="card mb-2">
          <div class="card-header p-3 mb-2 bg-secondary text-light">
            Guarantor's Detail
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group my-1">
                  <label for="guarantor_name" class="control-label">Name</label>
                  <input type="text" name="guarantor_name" id="guarantor_name" class="form-control" value="{{ old('guarantor_name') }}">
                </div>
                <div class="form-group my-1">
                  <label for="guarantor_ic_no" class="control-label">IC Number</label>
                  <input type="text" name="guarantor_ic_no" id="guarantor_ic_no" class="form-control" value="{{ old('guarantor_ic_no') }}">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id='card-4' class="d-none">
        <div class="card mb-2">
          <div class="card-header p-3 mb-2 bg-secondary text-light">
            Extra
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <label for="note" class="control-label">Special Note</label>
                <p class="small mb-0 text-danger">Say something about this debtor.</p>
                <textarea name="note" id="note" rows="5" class='form-control'>{{ old('note') }}</textarea>
                <div class="form-group my-1">
                  <label for="" class="control-label">Extra Documents</label>
                  <p class="small mb-0 text-danger">You must upload proof of debtor loaning your money</p>
                  <p class="small mb-0 text-danger">You may also upload additional photos i.e. debtor enjoying luxurious meal instead of returning your money back, etc.</p>
                  <button type='button' id='extra-doc' class="btn btn-secondary text-light my-2">Add Additional Documents</button>
                  <div id='extra-doc-div'>
                    <input type="file" class='form-control mb-2' name='document[]' multiple accept="image/*">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id='card-5' class="d-none">
        <div class="card mb-2">
          <div class="card-header p-3 mb-2 bg-secondary text-light">
            Review Details
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12">
                <h3>Debtor's Details</h3>
                <strong>Name: </strong> <span id="debtor_name_span"></span>
                <br>
                <strong>IC Number: </strong> <span id="debtor_ic_span"></span>
                <br>
                <strong>Phone Number: </strong> <span id="debtor_phone_span"></span>
                <br>
                <strong>Adress: </strong> <span id="debtor_address_span"></span>
                <h3>Loan's Details</h3>
                <strong>Amount: </strong> <span id="amount_span"></span>
                <br>
                <strong>Loan Date: </strong> <span id="loan_date_span"></span>
                <br>
                <strong>Loan Settlement Date: </strong> <span id="payback_date_span"></span>
                <h3>Guarantor's Details</h3>
                <strong>Name: </strong> <span id="guarantor_name_span"></span>
                <br>
                <strong>IC Number: </strong> <span id="guarantor_ic_no_span"></span>
                <h3>Extra</h3>
                <strong>Special Note: </strong>
                <br>
                <span id="note_span"></span>
              </div>
            </div>
          </div>
        </div>
        {!! Form::bsSubmit('Submit', ['class' => 'bg-gradient-success btn btn-block text-light']) !!}
      </div>
    </div>
  </div>
  {!! Form::close() !!}
  @endsection
  
  @section('script')
  <script>
  $(document).ready(function() {

    $('body').on('click', '#next-button', function(e) {
    console.log($(this).data('id'));
    let next_card_id = $(this).data('id');
    let current_card_id = $(this).data('id') - 1;

    if (next_card_id == 5) {
      let debtor_name      = $("#debtor_name").val();
      let debtor_ic        = $("#debtor_ic").val();
      let debtor_phone     = $("#debtor_phone").val();
      let debtor_address   = $("#debtor_address").val();

      let amount           = $("#amount").val();
      let loan_date        = $("#loan_date").val();
      let payback_date     = $("#payback_date").val();

      let guarantor_name   = $("#guarantor_name").val();
      let guarantor_ic_no  = $("#guarantor_ic_no").val();

      let note             = $("#note").val()

      $("#debtor_name_span").html(debtor_name);
      $("#debtor_ic_span").html(debtor_ic);
      $("#debtor_phone_span").html(debtor_phone);
      $("#debtor_address_span").html(debtor_address);
      
      $("#amount_span").html(amount);
      $("#loan_date_span").html(loan_date);
      $("#payback_date_span").html(payback_date);
      
      $("#guarantor_name_span").html(guarantor_name);
      $("#guarantor_ic_no_span").html(guarantor_ic_no);
      
      $("#note_span").html(note);
    } 

    if(next_card_id == 6) { return false; }


    $("#card-"+current_card_id).addClass('d-none');
    $("#card-"+next_card_id).removeClass('d-none');
    $(this).data('id', next_card_id+1);
    $("#prev-button").data('id', next_card_id-1);
  });
  
  $('body').on('click', '#prev-button', function(e) {
    let prev_card_id = $(this).data('id');
    if(prev_card_id == 0) {
      return false;
    }
    let current_card_id = $(this).data('id') + 1;
    $("#card-"+current_card_id).addClass('d-none');
    $("#card-"+prev_card_id).removeClass('d-none');
    $(this).data('id', prev_card_id-1);
    $("#next-button").data('id', prev_card_id+1);
  });

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
  })
});
</script>
@endsection

