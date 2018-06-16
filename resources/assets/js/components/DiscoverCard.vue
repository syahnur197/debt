<template>
    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-4 mb-lg-4 mb-xl-4 mb-md-4 mb-sm-4">
      <div class="card bg-light">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-lg-3 col-md-3 col-sm-3">
              <div class="image">
                <img :src="loan.photo" class="img img-responsive img-thumbnail" style="max-width: 100%"/>
              </div>
            </div>
            <div class="col-12 col-lg-9 col-md-9 col-sm-9">
              <h5 class="card-title text-dark my-1">
                {{ loan.debtor_name }}
              </h5>
              <div class="card-text">
                <h6 class="mb-2">
                  Loaned BND {{loan.amount}} from {{loan.user.name}}  
                  on {{loan.loan_date}}
                </h6>
                <div class='card mb-2'>
                  <div class='card-body'>
                    <h5>Notes:</h5>
                    <br>
                    {{ loan.note }}
                    <a :href="'loans'+loan.id">Read More...</a>
                  </div>
                </div>
                <br>
                (
                  <i class="fas fa-comment text-primary"></i> 
                  <a :href="loan.comment_url">
                    <span class="disqus-comment-count" :data-disqus-url="'/loans/'+loan.id"></span>
                  </a>
                )
                <br>
                (
                  <i class="far fa-thumbs-up text-primary"></i>
                  <span :id="'like-count-'+loan.id">{{loan.likes.length}}</span> Likes
                )
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
export default {
  props: ['loan']
}
</script>

