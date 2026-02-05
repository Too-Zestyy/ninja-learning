<script setup lang="ts">
import { get_all_jokes } from '@/api/jokes'
import TheWelcome from '../components/TheWelcome.vue'
import { onMounted, reactive, ref } from 'vue'

// const api_resp = await get_all_jokes()
</script>

<template>
  <main>
    <div>
      <h1>This shows a test collection from the PHP API!</h1>

      <!-- <div v-if="state.data"> -->
      <p>{{ data }}</p>
      <!-- </div> -->
    </div>
    <TheWelcome />
  </main>
</template>

<script lang="ts">
type JokeResponse = { setup: string; punchline: string }[]
export default {
  data() {
    return {
      data: [] as JokeResponse,
      loading: false,
      error: null,
    }
  },
  // methods: {
  // async fetchData() {
  //   this.data = await get_all_jokes()
  // },
  // TODO: onMounted is not being triggered here
  // setup() {
  //   const data = ref<{ setup: string; punchline: string }[] | undefined>(undefined)

  //   onMounted(async () => {
  //     data.value = [{ setup: 'hi', punchline: 'hello' }]
  //     console.log(`the component is now mounted.`)
  //   })

  //   return {
  //     data,
  //   }
  // },

  mounted() {
    get_all_jokes().then(
      (resp) => (this.data = resp),
      (err) => (this.data = [{ setup: 'failed', punchline: err }]),
    )
    console.log(`the component is now mounted.`)
  },

  // },
}
</script>
