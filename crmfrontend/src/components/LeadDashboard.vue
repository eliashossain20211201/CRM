<template>
  <div class="dashboard-container">
    <header>
      <h1>Lead Dashboard</h1>
      <button @click="logout" class="logout-button">Logout</button>
    </header>
    <div class="leads-list">
      <h2>Leads</h2>
      <ul>
        <li v-for="lead in leads" :key="lead.id" class="lead-item">
          <div class="lead-name">{{ lead.name }}</div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      leads: [],
    };
  },
  async mounted() {
    const token = localStorage.getItem('auth_token');
    if (token) {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/leads', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        this.leads = response.data || [];
      } catch (error) {
        console.error('Error fetching leads:', error);
      }
    } else {
      this.$router.push('/login'); // Redirect if not authenticated
    }
  },
  methods: {
    logout() {
      localStorage.removeItem('auth_token'); // Remove the token
      this.$store.commit('setCurrentUser', null); // Reset the user in the store
      this.$router.push('/login'); // Redirect to login
    },
  },
};
</script>

<style scoped>
.dashboard-container {
  padding: 20px;
  font-family: Arial, sans-serif;
}

header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

h1 {
  margin: 0;
}

.logout-button {
  padding: 10px 15px;
  background-color: #f44336;
  color: white;
  border: none;
  cursor: pointer;
}

.logout-button:hover {
  background-color: #d32f2f;
}

.leads-list {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 8px;
}

h2 {
  margin-top: 0;
}

ul {
  list-style-type: none;
  padding: 0;
}

.lead-item {
  background-color: #ffffff;
  padding: 15px;
  margin-bottom: 10px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.lead-name {
  font-weight: bold;
}
</style>
