import api from "../src/api";

export const state = () => ({
    categories: [],
    currentCategoryId: null
});

export const mutations = {
    setCategories(state, data){
        state.categories = data;
    },

    setCurrentCategoryId(state, data){
      state.currentCategoryId = data;
    }
}

export const actions = {
    loadCategories({ commit }) {
        return api.getCategories().then(res => {
            commit('setCategories', res.data)
        })
    }
}

export const getters = {
    getCategoryById: (state) => (id) => {
        var cat;
        state.categories.some(category => {
            if(+category.id === +id){
                cat = category;
                return true;
            }
        })
        return cat;
    },

    getCategoriesByParentId : (state) => (parent_id = null) => {
        return state.categories.filter(category => +category.parent_id === +parent_id);
    }
}
