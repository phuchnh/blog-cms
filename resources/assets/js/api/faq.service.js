import { ApiService } from './api.service';

export const FaqService = {
    fetchList(params = {}) {
        return ApiService.get('/faqs', params);
    }
};