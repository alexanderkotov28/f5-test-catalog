<template>
  <div class="col-md-6">
    <div class="post row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm position-relative">
      <div class="col p-4 d-flex flex-column position-static">
        <div>
          <nuxt-link
              class="mr-1"
              :to="{name: 'categories-id', params: {id:category.id}}"
              v-for="category in post.categories"
              :key="category.id+'_'+post.id">
            <strong class="d-inline-block mb-2 text-primary">{{ category.title }}</strong>
          </nuxt-link>
        </div>
        <h3 class="post__title mb-1">{{ post.title }}</h3>
        <p class="card-text mb-auto">{{ post.preview }}</p>
        <nuxt-link :to="{name: 'posts-id', params: {id:post.id}}" class="">Continue reading</nuxt-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostGridItem",
  props: {
    post: {
      type: Object,
      default: {}
    }
  }
}
</script>

<style lang="scss">
.post {
  &__title {
    font-size: 1.35rem;
  }
}
</style>