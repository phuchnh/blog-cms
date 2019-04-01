import { ApiService } from './api.service';

export const AuthService = {
    fetchUser() {
        return ApiService.get('/auth/user').then(
            (resp) => {
                const { data } = resp.data;
                return data;
            }
        );
    }
};