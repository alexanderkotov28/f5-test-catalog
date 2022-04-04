<template>
  <header class="py-3 header">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4">
        <span v-if="currentCategory" class="text-muted" href="#">{{ currentCategory.title }}</span>
      </div>
      <div class="col-4 text-center">
        <NuxtLink class="header__logo text-dark" to="/">Catalog</NuxtLink>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="text-muted" href="#" aria-label="Search">
          <IconSearch/>
        </a>
      </div>
    </div>
  </header>
</template>

<script>
import IconSearch from "../../assets/icons/IconSearch";
import {mapState, mapGetters} from 'vuex';

export default {
  name: "LayoutHeader",
  computed: {
    ...mapState('categories', [
      'currentCategoryId'
    ]),
    ...mapGetters('categories', [
      'getCategoryById'
    ]),
    currentCategory() {
      if (this.currentCategoryId !== null) {
        return this.getCategoryById(this.currentCategoryId);
      }
      return null;
    }
  },
  components: {
    IconSearch
  }
}
</script>

<style lang="scss">
.header {
  line-height: 1;
  border-bottom: 1px solid #e5e5e5;

  &__logo {
    //font-family: "Playfair Display", Georgia, "Times New Roman", serif;
    font-size: 2.25rem;

    &:hover {
      text-decoration: none;
    }

  }
}
</style>