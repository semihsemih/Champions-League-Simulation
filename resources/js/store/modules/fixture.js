import axios from 'axios'

const state = {
    week: null,
    fixture: [],
    teams: []
}

const getters = {
    getFixture() {
        return state.fixture
    },
    getWeek() {
        return state.week
    },
    getTeams() {
        return state.teams
    },
}

const mutations = {
    setFixture(state, fixture) {
        state.fixture = fixture
    },
    setWeek(state, week) {
        state.week = week
    },
    setTeams(state, teams) {
        state.teams = teams
    }
}

const actions = {
    async getAllFixture({commit}) {
        return axios.get('/api/get-fixtures')
        .then((resp) => {
            commit('setFixture', resp.data)
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    async createFixture({commit}) {
        return axios.get('/api/create-fixtures')
        .then((resp) => {
            commit('setWeek', resp.data.week)
            commit('setTeams', resp.data.teams)
            commit('setFixture', resp.data.games)
            console.log(resp.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    async nextWeek({commit, getters}) {
        return axios.get('/api/next-week?week=' + getters.getWeek)
        .then((resp) => {
            commit('setWeek', getters.getWeek + 1)
            commit('setTeams', resp.data.teams)
            commit('setFixture', resp.data.games)
            console.log(resp.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    async resetSession({commit}) {
        return axios.get('/api/reset-session')
        .then((resp) => {
            commit('setWeek', resp.data.week)
            commit('setTeams', resp.data.teams)
            commit('setFixture', resp.data.games)
            console.log(resp.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },
    async playAll({commit}) {
        return axios.get('/api/play-all')
        .then((resp) => {
            commit('setWeek', resp.data.week)
            commit('setTeams', resp.data.teams)
            commit('setFixture', resp.data.games)
            console.log(resp.data);
        })
        .catch(function (error) {
            console.log(error);
        });
    },
}

export default {
    state,
    getters,
    mutations,
    actions
}


