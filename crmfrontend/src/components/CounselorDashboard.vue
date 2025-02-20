<template>
  <div>
    <h1>Counselor Dashboard</h1>
    <div v-for="lead in leads" :key="lead.id">
      <p>{{ lead.name }} - {{ lead.status }}</p>
      <button @click="updateLeadStatus(lead.id, 'In Progress')">In Progress</button>
      <button @click="updateLeadStatus(lead.id, 'Not Interested')">Not Interested</button>
      <button @click="moveToApplication(lead)">Move to Application</button>
    </div>
    <button @click="logout">Logout</button> <!-- Logout button -->
  </div>
</template>

<script>
import { useStore } from 'vuex';
import { onMounted } from 'vue';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    const leads = store.getters.leads;

    // Update the status of a lead
    const updateLeadStatus = (leadId, status) => {
      console.log(`Updating lead ${leadId} status to ${status}`);
      // API call to update lead status in backend
    };

    // Move lead to application section
    const moveToApplication = (lead) => {
      console.log(`Moving lead ${lead.name} to application`);
      // API call to move lead to the application section
    };

    // Fetch leads when the component is mounted
    onMounted(() => {
      store.dispatch('fetchLeads');
    });

    // Logout function
    const logout = () => {
      store.dispatch('logout'); // Clear the auth token in Vuex store
      localStorage.removeItem('auth_token'); // Remove token from localStorage
      router.push('/login'); // Redirect to login page
    };

    return { leads, updateLeadStatus, moveToApplication, logout };
  },
};
</script>
