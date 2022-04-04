<template>
  <PostGrid :posts="posts"></PostGrid>
</template>

<script>
import PostGrid from "../../../components/post-grid/grid";
import {mapState} from 'vuex';

export default {
  name: "categoriesId",
  fetch(){
    this.$store.dispatch('posts/loadPostsByCategory', this.$route.params.id);
  },
  created(){
    this.$store.commit('categories/setCurrentCategoryId', this.$route.params.id);
  },
  computed: {
    ...mapState('posts',[
        'posts'
    ])
  },
  components: {
    PostGrid
  }
}
</script>

<style scoped>

</style>