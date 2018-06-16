<template>
  <div>
    <div class="text-center">
      <h2>Discover Debts</h2>
    </div>
     <div class="row" v-for="i in Math.ceil(loans.length / 2)" :key="i">
        <DiscoverCard :loan="loan" v-for="loan in loans.slice((i - 1) * 2, i * 2)" :key="loan.id"></DiscoverCard>
    </div>
  </div>
</template>

<script>
  export default {
    data: function() {
      return {
        loans: []
      }
    },
    mounted() {
      console.log('Component mounted.')
      this.fetchLoans();
    },
    methods: {
      fetchLoans: function() {
        axios.get('api/loans/paginate')
          .then((resp) => {
            this.loans = resp.data.data;
            console.log(resp);
            // this.loans = resp.data;
          })
      }
    }
  }
</script>