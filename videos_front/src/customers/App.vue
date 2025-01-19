<template>
  <component :is="layout">
    <router-view/>
  </component>
</template>
<script>
import HomeLayout from '@/customers/commons/Layouts/index.vue'
import {listen} from "./history";
export default {
  name: 'App',
  components: {
    HomeLayout
  },
  computed: {
    layout() {
      return (this.$route.meta.layout) ? this.$route.meta.layout : "";
    }
  },
  created() {
    listen((route, previousRoute) => {
      this.current = route
    });

    window.addEventListener(
      "popstate",
      event => (this.current = window.location.pathname)
    );
  }
}
</script>
