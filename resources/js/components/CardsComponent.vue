<template>
  <div class="item">
    <i class="users icon"></i>
    sas
    <!-- <div class="content" v-for="(item, index) in radicados" :key="index">
      sasa
    </div> -->
  </div>
</template>

<script>
export default {
  mounted() {
    // data(){
    //   radicados: []
    // },
    axios
    .get('getRadicados')
    .then(response => {
      this.radicados = response.data;
      console.log(radicados)
    })
    // console.log("Component mounted.");
  },
};
</script>
