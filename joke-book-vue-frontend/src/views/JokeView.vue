<template>
  <p>{{ data }}</p>
</template>
<script lang="ts">
import { get_joke_details } from '@/api/jokes'
import router from '@/router'

type JokeDetailsResponse = { setup: String; punchline: String }
export default {
  data() {
    return {
      data: {} as JokeDetailsResponse,
      loading: false,
      error: null,
    }
  },

  mounted() {
    ;(async () => {
      await router.isReady()

      // janky for now
      const joke_id = this.$route.params.id as unknown as number

      get_joke_details(joke_id).then(
        (resp) => (this.data = resp),
        (err) => (this.data = {} as JokeDetailsResponse),
      )
    })()
  },

  // },
}
</script>
