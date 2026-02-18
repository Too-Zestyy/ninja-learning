<script setup lang="ts">
import LoaderWithMessage from '@/components/animations/LoaderWithMessage.vue'
import NotFoundBook from '@/components/animations/NotFoundBook.vue'
</script>
<template>
  <div v-if="api_status === 404" style="display: flex; flex-direction: column; align-items: center">
    <NotFoundBook size="250px"></NotFoundBook>
    <h3>Did someone really steal a <i>joke..?</i></h3>
  </div>

  <LoaderWithMessage message="Hold on tight..!" v-else-if="!data.punchline"></LoaderWithMessage>
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
      api_status: -1,
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

      this.api_status = resp.status
    })()
  },

  // },
}
</script>
