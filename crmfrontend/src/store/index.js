import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    leads: [],
    applications: [],
    currentUser: null,
    authToken: localStorage.getItem('auth_token') || null,
    userRole: localStorage.getItem('user_role') || null,
  },
  mutations: {
    setLeads(state, leads) {
      state.leads = leads;
    },
    setApplications(state, applications) {
      state.applications = applications;
    },
    setCurrentUser(state, user) {
      state.currentUser = user;
    },
    setAuthToken(state, token) {
      state.authToken = token;
      localStorage.setItem('auth_token', token);
    },
    setUserRole(state, role) {
      state.userRole = role;
      localStorage.setItem('user_role', role);
    },
    clearAuthToken(state) {
      state.authToken = null;
      state.userRole = null;
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user_role');
    },
  },
  actions: {
    login({ commit }, { token, role }) {
      commit('setAuthToken', token);
      commit('setUserRole', role);
    },
    logout({ commit }) {
      commit('clearAuthToken');
    },
    fetchLeads({ commit, state }) {
      axios.get('http://localhost:8000/api/leads', {
        headers: {
          Authorization: `Bearer ${state.authToken}`,
        },
      }).then(response => {
        commit('setLeads', response.data);
      });
    },
    fetchApplications({ commit, state }) {
      axios.get('http://localhost:8000/api/applications', {
        headers: {
          Authorization: `Bearer ${state.authToken}`,
        },
      }).then(response => {
        commit('setApplications', response.data);
      });
    },
    fetchCurrentUser({ commit, state }) {
      axios.get('http://localhost:8000/api/user', {
        headers: {
          Authorization: `Bearer ${state.authToken}`,
        },
      }).then(response => {
        commit('setCurrentUser', response.data);
      });
    },
  },
  getters: {
    leads: state => state.leads,
    applications: state => state.applications,
    currentUser: state => state.currentUser,
    isAuthenticated: state => !!state.authToken,
  },
});
