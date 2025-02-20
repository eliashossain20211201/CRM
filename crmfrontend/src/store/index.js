import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    leads: [],
    applications: [],
    counselors: [],
    currentUser: null,
    authToken: localStorage.getItem('auth_token') || null, // Get token from localStorage
  },
  mutations: {
    setLeads(state, leads) {
      state.leads = leads;
    },
    setApplications(state, applications) {
      state.applications = applications;
    },
    setCounselors(state, counselors) {
      state.counselors = counselors;
    },
    setCurrentUser(state, user) {
      state.currentUser = user;
    },
    setAuthToken(state, token) {
      state.authToken = token;
      localStorage.setItem('auth_token', token); // Save token in localStorage
    },
    clearAuthToken(state) {
      state.authToken = null;
      localStorage.removeItem('auth_token'); // Remove token from localStorage
    },
  },
  actions: {
    fetchLeads({ commit, state }) {
      axios.get('http://localhost:8000/api/leads', {
        headers: {
          Authorization: `Bearer ${state.authToken}`,
        },
      })
      .then(response => {
        commit('setLeads', response.data);
      });
    },
    fetchApplications({ commit, state }) {
      axios.get('http://localhost:8000/api/applications', {
        headers: {
          Authorization: `Bearer ${state.authToken}`,
        },
      })
      .then(response => {
        commit('setApplications', response.data);
      });
    },
    fetchCounselors({ commit, state }) {
      axios.get('http://localhost:8000/api/counselors', {
        headers: {
          Authorization: `Bearer ${state.authToken}`,
        },
      })
      .then(response => {
        commit('setCounselors', response.data);
      });
    },
    fetchCurrentUser({ commit, state }) {
      axios.get('http://localhost:8000/api/user', {
        headers: {
          Authorization: `Bearer ${state.authToken}`,
        },
      })
      .then(response => {
        commit('setCurrentUser', response.data);
      });
    },
    login({ commit }, token) {
      commit('setAuthToken', token); // Save token to Vuex store and localStorage
    },
    logout({ commit }) {
      commit('clearAuthToken'); // Clear token from Vuex store and localStorage
    },
  },
  getters: {
    leads: state => state.leads,
    applications: state => state.applications,
    counselors: state => state.counselors,
    currentUser: state => state.currentUser,
    isAuthenticated: state => !!state.authToken, // Check if the user is authenticated
  },
});
