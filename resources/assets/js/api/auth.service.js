import { ApiService } from './api.service';
import { Cookie } from '../util/cookie'

export const AuthService = {
    fetchUser() {
        return ApiService.get('/auth/user').then(
            (resp) => {
                const { data } = resp.data;
                return data;
            }
        );
    },

    logout() {
      let token = document.head.querySelector('meta[name="csrf-token"]')
      const body = new FormData()
      body.append('_token', token.content)
      let config = {}
      config.baseURL = '/'
      config.headers = {};
      if (Cookie.findByName('token')) {
        config.headers['Authorization'] = `${ Cookie.findByName('token') }`
      }
      return ApiService.post(`logout`, body, config)
    }
};