import axios from "axios";

export default {
  namespaced: true,
  state: {
    counselors: [],
    newLeads: [],
    assignedLeads: [],
    selectedCounselor: null,
  },
  mutations: {
    SET_COUNSELORS(state, counselors) {
      state.counselors = counselors;
    },
    SET_NEW_LEADS(state, leads) {
      state.newLeads = leads;
    },
    SET_ASSIGNED_LEADS(state, leads) {
      state.assignedLeads = leads;
    },
    SET_SELECTED_COUNSELOR(state, counselorId) {
      state.selectedCounselor = counselorId;
    },
  },
  actions: {
    async fetchCounselors({ commit }) {
      const response = await axios.get("/api/counselors");
      commit("SET_COUNSELORS", response.data);
    },
    async fetchNewLeads({ commit }) {
      const response = await axios.get("/api/unassignedleads");
      commit("SET_NEW_LEADS", response.data);
    },
    async fetchAssignedLeads({ commit, state }) {
      if (!state.selectedCounselor) return;
      const response = await axios.get(`/api/leads/assigned/${state.selectedCounselor}`);
      commit("SET_ASSIGNED_LEADS", response.data);
    },
    async assignLeads({ dispatch, state }, leadIds) {
      await axios.post("/api/assignlead", {
        counselor_id: state.selectedCounselor,
        lead_ids: leadIds,
      });
      dispatch("fetchNewLeads");
      dispatch("fetchAssignedLeads");
    },
    async unassignLeads({ dispatch, state }, leadIds) {
      await axios.post("/api/leads/unassign", {
        counselor_id: state.selectedCounselor,
        lead_ids: leadIds,
      });
      dispatch("fetchNewLeads");
      dispatch("fetchAssignedLeads");
    },
  },
};
