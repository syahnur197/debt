@extends('layouts.app')

@section('content')
  <div class="text-center">
    <h2>Discover Debts</h2>
  </div>
  <?php $counts = count($loans); $i = 0;?>
  @foreach ($loans as $loan)
    @if($i % 2 == 0)
      <div class="row">
    @endif
      <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4 mb-lg-4 mb-xl-4 mb-md-4 mb-sm-4">
        <div class="card bg-light">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-lg-3 col-md-3 col-sm-3">
                <div class="image">
                  <img src="{{asset('storage/'.$loan->photo)}}" class="img img-responsive img-thumbnail" style="max-width: 100%"/>
                </div>
              </div>
              <div class="col-12 col-lg-9 col-md-9 col-sm-9">
                <h5 class="card-title text-dark my-1">
                  {{ucwords($loan->debtor_name)}}
                </h5>
                <div class="card-text">
                  <h6 class="mb-2">
                    Loaned BND {{$loan->amount}} from {{ucwords($loan->user->name)}}  
                    on {{Carbon\Carbon::createFromFormat('Y-m-d', $loan->loan_date)->format('d M Y')}}
                  </h6>
                  <div class='card mb-2'>
                    <div class='card-body'>
                      <h5>Notes:</h5>
                      <br>
                      {{ substr($loan->note, 0, 300)}}
                      <a href="loans/{{$loan->id}}">Read More...</a>
                    </div>
                  </div>
                  @unless (Auth::guest())
                    <div class="row">
                      <div class="col-12">
                        @if ($loan->user_like > 0)
                          <button class="btn btn-secondary btn-block unlike-button btn-sm" data-id='{{$loan->id}}'>
                            <i class="far fa-thumbs-down"></i>
                            Unlike
                          </button>
                        @else
                          <button class="btn btn-primary btn-block like-button btn-sm" data-id='{{$loan->id}}'>
                            <i class="far fa-thumbs-up"></i>
                            Like
                          </button>
                        @endif
                      </div>
                    </div>
                  @endunless
                  (
                    <i class="fas fa-comment text-primary"></i> 
                    <a href="{{ url('loans/'.$loan->id.'#disqus_thread') }}">
                      <span class="disqus-comment-count" data-disqus-url="{{ url('/loans/'.$loan->id) }}"></span>
                    </a>
                  )
                  <br>
                  (
                    <i class="far fa-thumbs-up text-primary"></i>
                    <span id='like-count-{{$loan->id}}'>{{count($loan->likes)}}</span> Likes
                  )
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php $i++; ?>
    @if($i % 2 == 0)
    </div>
    @endif
  @endforeach
@endsection

@section('script')
  <script id="dsq-count-scr" src="//bruneidebtrepo.disqus.com/count.js" async></script>
  <script>
    $(() => {
      $('body').on('click', '.like-button', function(e) {
        let button = $(this);
        let loan_id = $(this).data('id');
        let user_id = {{Auth::id()}};
        $.post('{{ url("api/loans/liked") }}', {loan_id : loan_id, 'csrf-token' : '{{csrf_token()}}', user_id : user_id}, function(resp) {
          if(resp.success) {
            button.addClass('unlike-button btn-secondary');
            button.removeClass('like-button btn-primary');
            button.html(`<i class="far fa-thumbs-down"></i> Unlike`);
            $("#like-count-"+loan_id).html(resp.count);
          }
        })
      })

      $('body').on('click', '.unlike-button', function(e) {
        let button = $(this);
        let loan_id = $(this).data('id');
        let user_id = {{Auth::id()}};
        $.post('{{ url("api/loans/unliked") }}', {loan_id : loan_id, 'csrf-token' : '{{csrf_token()}}', user_id : user_id}, function(resp) {
          if(resp.success) {
            button.addClass('like-button btn-primary');
            button.removeClass('unlike-button btn-secondary');
            button.html(`<i class="far fa-thumbs-up"></i> Like`);
            $("#like-count-"+loan_id).html(resp.count);
          }
        })
      })
    })
  </script>
@endsection

@section('style')
<style>
  .image { 
    position:relative; 
    overflow:hidden;
    padding-bottom:100%; 
  } 
  .image img { 
    position:absolute; 
  }
</style>
@endsection