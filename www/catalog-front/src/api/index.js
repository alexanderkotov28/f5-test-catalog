import axios from "axios";

class Api {
    #client;

    constructor() {
        this.#client = axios.create({
            baseURL: '/api/v1'
        })
    }

    getCategories() {
        return this.#client.get('/categories');
    }

    getPosts(params) {
        return this.#client.get('/posts', {
            params: params
        });
    }

    getPost(id) {
        return this.#client.get('/post/'+id);
    }

    getPostsByCategory(category_id) {
        return this.#client.get('/categories/'+category_id+'/posts');
    }
}


const api = new Api();

export default api;