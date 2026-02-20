<template>
  <div :style="style">
    <div class="container">
      <div class="book">
        <div class="lines"></div>
      </div>
      <div class="ripped-page">
        <p>{{ bookMessage }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.container {
  position: relative;
  max-width: 100%;
  max-height: 100%;
  aspect-ratio: 1;
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 2px;
}
.book {
  position: absolute;
  width: 100%;
  height: 75%;
  background-color: beige;

  border: 0.33rem solid palevioletred;
  border-radius: 0.5rem;

  display: flex;
  flex-direction: row;
  justify-content: center;

  animation: book-bob 10s ease-in-out -9s infinite;
  //   animation: bob-height 6s ease-in-out -10s infinite;
}
.lines {
  width: 90%;
  height: 100%;

  background: repeating-linear-gradient(
    rgba(0, 0, 0, 0),
    rgba(0, 0, 0, 0) 1rem,
    #9198e5 1rem,
    #9198e5 calc(1rem + 2px)
  );
}
.ripped-page {
  p {
    color: black;
    font-size: 1.2rem;
    text-align: center;
    margin: 0.25rem;
    margin-bottom: 0;
    line-height: 2.1rem;

    font-style: italic;
    // font-weight: 500;
  }

  position: relative;
  width: 50%;
  height: 75%;
  left: 52%;
  bottom: 5%;
  background-color: rgb(236, 236, 210);
  background: repeating-linear-gradient(
    rgb(236, 236, 210),
    rgb(236, 236, 210) 1rem,
    #9198e5 1rem,
    #9198e5 calc(1rem + 2px)
  );
  border-radius: 0.2rem;

  box-shadow: 0 5px 10px 0px rgba(0, 0, 0, 0.4);

  animation: page-bob 3.75s ease-in-out -9s infinite;

  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;

  mask: repeating-conic-gradient(
      from 45deg at 1rem 50%,
      #0000,
      #000 1deg 89deg,
      #0000 90deg 180deg
    ) -1rem
    25%/100% 0.5rem;
}

@keyframes book-bob {
  0% {
    transform: translate(0%, 1%) rotate(-5deg);
  }
  50% {
    transform: translate(0%, -2%) rotate(-6deg);
  }
  100% {
    transform: translate(0%, 1%) rotate(-5deg);
  }
}

@keyframes page-bob {
  0% {
    transform: translate(0%, 1%) rotate(1deg);
  }
  50% {
    transform: translate(0%, -3%) rotate(0deg);
  }
  100% {
    transform: translate(0%, 1%) rotate(1deg);
  }
}
</style>

<script lang="ts">
export default {
  props: {
    size: String,
    bookMessage: String,
  },
  computed: {
    style() {
      return { width: this.$props.size }
    },
  },
}
</script>
