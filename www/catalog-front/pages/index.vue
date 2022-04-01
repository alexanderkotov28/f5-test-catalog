<template>
  <div class="row mb-2">
    <div class="col-md-6">
      <post></post>
    </div>
    <div class="col-md-6">
      <post></post>
    </div>
  </div>
</template>

<script>
import Post from "../components/Post";
export default {
  name: 'IndexPage',
  components: {Post}
}
</script>
