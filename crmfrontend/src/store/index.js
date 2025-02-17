// src/store/index.js
import { createStore } from 'vuex';  // Use createStore from 'vuex'
import axios from 'axios';

export default createStore({
  state: {
    leads: [],
    applications: [],
    counselors: [],
    currentUser: null,
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
  },
  actions: {
    fetchLeads({ commit }) {
      axios.get('http://localhost:8000/api/leads') // Change this to your backend endpoint
        .then(response => {
          commit('setLeads', response.data);
        });
    },
    fetchApplications({ commit }) {
      axios.get('http://localhost:8000/api/applications') // Change this to your backend endpoint
        .then(response => {
          commit('setApplications', response.data);
        });
    },
    fetchCounselors({ commit }) {
      axios.get('http://localhost:8000/api/counselors') // Change this to your backend endpoint
        .then(response => {
          commit('setCounselors', response.data);
        });
    },
    fetchCurrentUser({ commit }) {
      axios.get('http://localhost:8000/api/user') // Change this to your backend endpoint
        .then(response => {
          commit('setCurrentUser', response.data);
        });
    },
  },
  getters: {
    leads: state => state.leads,
    applications: state => state.applications,
    counselors: state => state.counselors,
    currentUser: state => state.currentUser,
  },
});
