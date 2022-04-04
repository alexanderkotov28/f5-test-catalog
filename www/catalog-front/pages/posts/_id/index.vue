<template>
  <div class="blog-post" v-if="loaded">
    <h2 class="blog-post-title" v-html="post.title"></h2>
    <div class="blog-post-meta">
      <nuxt-link class="mr-2" :to="{name: 'categories-id', params: {id:category.id}}" v-for="category in post.categories" :key="category.id">{{ category.title }}</nuxt-link>
    </div>

    <p v-html="post.preview"></p>
    <hr>
    <p v-html="post.text"></p>
  </div>
</template>

<script>
import {mapState} from 'vuex';

export default {
  name: "postsId",
  data(){
    return {
      loaded: false
    }
  },
  fetch() {
    this.$store.dispatch('posts/loadPost', this.$route.params.id).then(() => {
      this.$store.commit('categories/setCurrentCategoryId', this.post.categories[0].id);
      this.loaded = true;
    });
  },
  computed: {
    ...mapState('posts', [
        'post'
    ])
  }
}
</script>

<style scoped>
.blog-post {
  margin-bottom: 4rem;
}
.blog-post-title {
  margin-bottom: .25rem;
  font-size: 2.5rem;
}
.blog-post-meta {
  margin-bottom: 1.25rem;
  color: #999;
}
</style>