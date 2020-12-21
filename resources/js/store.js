import Vue from "vue";
import Vuex from "vuex";
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        range: 0
    },
    mutations: {
        increment(state) {
            state.billing++;
        },
        decrement(state) {
            state.billing--;
        }
    },

    actions: {},

    modules: {}
});
