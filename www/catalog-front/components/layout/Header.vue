<template>
  <header class="py-3 header">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4"></div>
      <div class="col-4 text-center">
        <a class="header__logo text-dark" href="#">Catalog</a>
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

export default {
  name: "LayoutHeader",
  components: {
    IconSearch
  }
}
</script>

<style lang="scss">
.header {
  line-height: 1;
  border-bottom: 1px solid #e5e5e5;

  &__logo{
    //font-family: "Playfair Display", Georgia, "Times New Roman", serif;
    font-size: 2.25rem;

    &:hover{
      text-decoration: none;
    }

  }
}
</style>