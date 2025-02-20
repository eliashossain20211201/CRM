<template>
  <div>
    <h1>Admin Dashboard</h1>
    <div v-for="lead in leads" :key="lead.id">
      <p>{{ lead.name }} - {{ lead.status }}</p>
      <button @click="assignCounselor(lead.id)">Assign Counselor</button>
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

    // Define the assignCounselor function
    const assignCounselor = (leadId) => {
      console.log(`Assigning counselor to lead with ID: ${leadId}`);
      // Implement the API call to assign the counselor here
    };

    // Fetch leads when the component is mounted
    onMounted(() => {
      store.dispatch('fetchLeads');
    });

    // Logout function
    const logout = () => {
      store.dispatch('logout'); // Clear the auth token in Vuex store
      localStorage.removeItem('auth_token'); // Clear the token from localStorage
      router.push('/login'); // Redirect to login page
    };

    return { leads, assignCounselor, logout };
  },
};
</script>
