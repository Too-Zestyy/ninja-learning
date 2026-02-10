import '@/api/const'
import { API_HOST } from '@/api/const'

const get_joke_page = async (page: number = 1) => {
  const response = await fetch(API_HOST + `/api/jokes/${page}`)

  if (response.ok) {
    return response.json()
  } else {
    return 'failed to get from API.'
  }
}

const get_joke_details = async (id: number) => {
  const response = await fetch(API_HOST + `/api/joke/${id}`)

  if (response.ok) {
    return response.json()
  } else {
    return 'failed to get from API.'
  }
}

export { get_joke_page, get_joke_details }
