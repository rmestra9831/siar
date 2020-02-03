<template>
  <div class="item">
    <i class="users icon"></i>
    <div class="content" v-for="(radicado, index) in radicados">
      {{radicado.consecutive}}
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      radicados: []
    }
  },
  methods: {
    getRadicados: function(){
      axios({
        method: 'get',
        responseType: 'json',
        url: 'getRadicados',
      }).then(response => {
      this.radicados = response.data;
      console.log(response)
    }).catch(e =>  {console.log(e)});
    
    }
  },
  beforeMount: function() {
    this.getRadicados();
  }
};
</script>
