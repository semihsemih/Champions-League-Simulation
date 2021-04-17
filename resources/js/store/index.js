import Vue from 'vue'
import Vuex from 'vuex'
import fixture from './modules/fixture'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules:{
        fixture
    }
})