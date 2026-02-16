import axios from 'axios'

const http = axios.create({
  baseURL: 'http://localhost/Abirs_FoodCourt/public',
})

export default http

