<template>
  <div class="container">
    <span class="loader"></span>
  </div>
</template>

<style scoped>
.container {
  width: 50px;
  height: 50px;
  aspect-ratio: 1;
  display: flex;
  flex-direction: row;
  align-items: center;
}
.loader {
  width: 100%;
  height: 100%;

  background-color: blueviolet;
  animation: load-anim 1s infinite ease-in-out;
}
/* TODO: Update loader animation to be more engaging */
@keyframes load-anim {
  0% {
    height: 100%;
    background-color: rgb(194, 139, 247);
  }
  50% {
    height: 0;
    background-color: rgb(160, 81, 120);
  }
  100% {
    height: 100%;
    background-color: rgb(194, 139, 247);
  }
}
</style>
