import '@/api/const'
import { API_HOST } from '@/api/const'

const get_all_jokes = async () => {
  const response = await fetch(API_HOST + '/api/jokes')

  if (response.ok) {
    return response.json()
  } else {
    return 'failed to get from API.'
  }
}

export { get_all_jokes }
