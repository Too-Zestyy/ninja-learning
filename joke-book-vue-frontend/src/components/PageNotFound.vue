<script setup lang="ts">
import NotFoundBook from '@/components/animations/NotFoundBook.vue'
</script>
<template>
  <div style="display: flex; flex-direction: column; align-items: center">
    <h1>404</h1>
    <NotFoundBook size="250px" :book-message="bookMessage"></NotFoundBook>
    <h3>{{ subtitle }}</h3>
  </div>
</template>
<style scoped>
h1 {
  font-size: 2.25rem;
}
</style>

<script lang="ts">
export default {
  props: {
    bookMessage: String,
    subtitle: String,
  },
}
</script>
