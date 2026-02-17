<script setup lang="ts">
import LoaderWithMessage from '@/components/loader/LoaderWithMessage.vue'
</script>
<template>
  <!-- <p>{{ data }}</p> -->
  <LoaderWithMessage message="Hold on tight..!" v-if="!data.punchline"></LoaderWithMessage>
  <div v-else class="joke-content">
    <h2>{{ data.setup }}</h2>
    <h3 v-if="!joke_revealed" v-on:click="joke_revealed = true">Reveal the punchline!</h3>
    <h3 v-else>{{ data.punchline }}</h3>
  </div>
</template>

<style scoped>
.joke-content {
  display: flex;
  flex-direction: column;
  text-align: center;
}
</style>
<script lang="ts">
import { get_joke_details } from '@/api/jokes'
import router from '@/router'
import { API_HOST } from '@/api/const'

type JokeDetailsResponse = { setup: String; punchline: String }
export default {
  data() {
    return {
      data: {} as JokeDetailsResponse,
      joke_revealed: false,
      loading: false,
      error: null,
    }
  },

  mounted() {
    ;(async () => {
      await router.isReady()

      // janky for now
      const joke_id = this.$route.params.id as unknown as number

      const resp = await fetch(API_HOST + `/api/joke/${joke_id}`)

      if (resp.ok) {
        this.data = (await resp.json()) as JokeDetailsResponse
      }
    })()
  },

  // },
}
</script>
