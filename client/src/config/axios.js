import axios from 'axios'
import store from '../store'

const basePath = 'http://localhost:8000/'

const instance = axios.create({
  baseURL: basePath
})

instance.interceptors.request.use(
  config => {
    const token = localStorage.getItem('token')
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  error => Promise.reject(error)
)

instance.interceptors.response.use(function (response) {
  return response
}, function (error) {
  if (error.response.status === 401 && error.response.config.url !== 'auth/logout') {
    store.dispatch('logout')
  }

  return Promise.reject(error)
})

export default instance
