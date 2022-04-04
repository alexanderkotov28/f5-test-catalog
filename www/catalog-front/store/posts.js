import api from "../src/api";

export const state = () => ({
    posts: [],
    post: null,
    page: 1,
    perPage: 10,
    total: null
});

export const mutations = {
    setPosts(state, data) {
        state.posts = data;
        // state.posts.push(...data);
    },

    setTotal(state, data) {
        state.total = data;
    },

    setPost(state, data){
        state.post = data;
    }
}

export const actions = {
    loadPosts({commit}) {
        return api.getPosts().then(res => {
            commit('setPosts', res.data.data);
            commit('setTotal', res.data.total);
        })
    },

    loadPostsByCategory({commit}, category_id) {
        return api.getPostsByCategory(category_id).then(res => {
            commit('setPosts', res.data.data);
            commit('setTotal', res.data.total);
        })
    },

    loadPost({commit}, id){
        return api.getPost(id).then(res => {
            commit('setPost', res.data);
        })
    }
}

export const getters = {}