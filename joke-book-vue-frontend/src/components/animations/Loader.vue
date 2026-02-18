<template>
  <div :style="style">
    <div class="container">
      <span class="loader"></span>
      <span class="loader"></span>
      <span class="loader"></span>
      <span class="loader"></span>
      <span class="loader"></span>
      <span class="loader"></span>
    </div>
  </div>
</template>

<style scoped lang="scss">
.container {
  max-width: 100%;
  max-height: 100%;
  aspect-ratio: 1;
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 2px;
}
.loader {
  width: 90%;
  height: 90%;

  background-color: blueviolet;
  animation: load-anim 1s infinite ease-in-out;
}
@for $i from 1 through 6 {
  // Add delay to make animation "flow", and subtract a cycle to make the animation immediately begin in a desirable state
  .loader:nth-child(#{$i}) {
    animation-delay: calc(0.15s * ($i - 1) - 1s);
  }
}
/* TODO: Update loader animation to be more engaging */
@keyframes load-anim {
  0% {
    height: 100%;
    background-color: rgb(194, 139, 247);
    border-radius: 10%;
  }
  50% {
    height: 1px;
    background-color: rgb(160, 81, 120);
    border-radius: 0;
  }
  100% {
    height: 100%;
    background-color: rgb(194, 139, 247);
    border-radius: 10%;
  }
}
</style>

<script lang="ts">
export default {
  props: ['size'],
  computed: {
    style() {
      return { width: this.$props.size }
    },
  },
}
</script>
