<script setup lang="ts">
import Loader from './Loader.vue'

const props = defineProps<{ message: String }>()
</script>

<template>
  <div class="loader-container">
    <div class="icon-container">
      <Loader class="loader-icon"></Loader>
    </div>

    <p class="loader-message">{{ props.message }}</p>
  </div>
</template>

<style scoped>
.loader-container {
  font-size: large;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 0.33rem;
}
.icon-container {
  max-width: 7.5rem;
}

/* desktop */
@media (min-width: 1024px) {
  .icon-container {
    width: 7.5vw;
  }
}
/* mobile */

@media (max-width: 1024px) {
  .icon-container {
    width: 30vw;
  }
}
</style>
