<template>
  <div class="item">
    <i class="users icon"></i>
    <div class="content">
      {{texto}}
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      url: "holasas"
    };
  }
};
</script>
