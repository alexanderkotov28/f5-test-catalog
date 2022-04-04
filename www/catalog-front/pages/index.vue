<template>
  <PostGrid :posts="posts"></PostGrid>
</template>

<script>
import PostGrid from "../components/post-grid/grid";
import {mapState} from "vuex";

export default {
  name: 'IndexPage',
  fetch(){
    this.$store.dispatch('posts/loadPosts')
  },
  computed: {
    ...mapState('posts', [
      'posts'
    ]),
  },
  created() {
    this.$store.commit('categories/setCurrentCategoryId', null);
  },
  components: {PostGrid}
}
</script>
