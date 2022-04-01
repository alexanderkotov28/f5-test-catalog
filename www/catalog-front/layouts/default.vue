<template>
  <div class="container">
    <layout-header></layout-header>
    <nav-scroller></nav-scroller>
    <nuxt />
  </div>
</template>

<script>
import LayoutHeader from "../components/layout/Header";
import NavScroller from "../components/layout/NavScroller";

export default {
  components: {
    LayoutHeader,
    NavScroller
  }
}
</script>