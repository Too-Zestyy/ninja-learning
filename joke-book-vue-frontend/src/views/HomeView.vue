<script setup lang="ts">
import { get_all_jokes } from '@/api/jokes'
import Loader from '@/components/utils/Loader.vue'

// const api_resp = await get_all_jokes()
</script>

<template>
  <main>
    <div>
      <h1>Joke book - Even better than ever to Vue!</h1>
      <!-- <Loader></Loader> -->

      <ul class="joke-list" v-if="data.jokes">
        <li v-for="joke in data.jokes">{{ joke.setup }}</li>
      </ul>
      <div v-else class="loading-content">
        <Loader size="50px"></Loader>
        <h2>Loading jokes...</h2>
      </div>
    </div>
  </main>
</template>

<script lang="ts">
type JokeResponse = { jokes: { setup: string; punchline: string }[]; pages: number }
export default {
  data() {
    return {
      data: {} as JokeResponse,
      loading: false,
      error: null,
    }
  },

  mounted() {
    get_all_jokes().then(
      (resp) => (this.data = resp),
      (err) => (this.data = {} as JokeResponse),
    )
    console.log(`the component is now mounted.`)
  },

  // },
}
</script>

<style lang="css" scoped>
.loading-content {
  display: flex;
  flex-direction: row;
  align-items: center;

  gap: 10px;
}
.joke-list {
  font-size: large;
}
</style>
