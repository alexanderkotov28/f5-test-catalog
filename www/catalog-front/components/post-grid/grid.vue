<template>
  <div class="row mb-2">
    <Item :post="post" v-for="post in posts" :key="post.id"></Item>
  </div>
</template>

<script>
import Item from "./item";

export default {
  name: "PostGrid",
  props: {
    posts: {
      type: Array,
      default: () => []
    }
  },
  components: {
    Item
  }
}
</script>

<style scoped>

</style>