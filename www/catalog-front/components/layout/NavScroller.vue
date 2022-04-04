<template>
  <div class="nav-scroller py-1 mb-2">
    <nav class="nav-scroller__nav nav d-flex justify-content-between">
      <nuxt-link class="p-2 text-muted" :to="{name: 'categories-id', params: {id:category.id}}" :key="category.id"
                 v-for="category in currentCategories">{{ category.title }}
      </nuxt-link>
    </nav>
  </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex';

export default {
  name: "NavScroller",
  fetch() {
    this.$store.dispatch('categories/loadCategories')
  },
  computed: {
    ...mapState('categories', [
      'categories',
      'currentCategoryId'
    ]),
    ...mapGetters('categories', [
      'getCategoriesByParentId'
    ]),
    currentCategories() {
      return this.getCategoriesByParentId(this.currentCategoryId);
    }
  }
}
</script>

<style lang="scss">
.nav-scroller {
  position: relative;
  z-index: 2;
  height: 2.75rem;
  overflow-y: hidden;

  &__nav {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: nowrap;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
  }
}
</style>