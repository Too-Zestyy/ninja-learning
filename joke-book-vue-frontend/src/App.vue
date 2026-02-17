<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <div class="page-container">
    <header>
      <!-- <img alt="Vue logo" class="logo" src="@/assets/logo.svg" width="125" height="125" /> -->

      <div class="wrapper">
        <nav>
          <RouterLink to="/">Home</RouterLink>
          <RouterLink to="/about">About</RouterLink>
        </nav>
      </div>
    </header>

    <main class="router">
      <RouterView />
    </main>
  </div>
</template>
<style scoped lang="scss">
.page-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  flex: 1;
  flex-grow: 1;
  width: 100%;
}
header {
  line-height: 1.5;
  height: 10vh;
  display: flex;
  flex-direction: column;
  align-items: center;
}

header .wrapper {
  width: 100%;
  nav {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
  }
}

.router {
  flex: auto;
  flex-grow: 1;
  min-height: 90vh;
  flex-direction: column;
  justify-content: start;
  align-items: center;
  gap: 1rem;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    // padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
    flex-direction: row;
  }

  nav {
    text-align: left;
    // margin-left: -1rem;
    font-size: 1rem;

    padding: 1rem 0;
    margin-top: 1rem;
  }
}
</style>
