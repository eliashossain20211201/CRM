<template>
  <div>
    <form @submit.prevent="login">
      <input type="email" v-model="email" placeholder="Email" required />
      <input type="password" v-model="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
    
    <div v-if="leads.length > 0">
      <h2>Leads</h2>
      <ul>
        <li v-for="lead in leads" :key="lead.id">{{ lead.name }}</li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      leads: [],  // Array to store leads data
    };
  },
  methods: {
    async login() {
      try {
        console.log('Logging in with:', this.email, this.password);  // Debug email and password

        // Make the login API request
        const response = await axios.post('http://localhost:8000/api/login', {
          email: this.email,
          password: this.password,
        });

        console.log('API Response:', response);  // Debug full response from the API

        // Assuming the API returns the token inside the 'authorisation' object
        const token = response.data?.authorisation?.token;

        if (token) {
          console.log('Token received:', token);  // Debugging the received token

          // Store the token in localStorage
          localStorage.setItem('auth_token', token);
          console.log('Token saved to localStorage');  // Verify token saved to localStorage

          // Now fetch leads using the token
          await this.fetchLeads(token);  // Fetch leads before redirecting
        } else {
          console.log('No token found in API response');
          alert('Failed to get token. Please try again.');
        }

        // Redirect to home page after successful login
        this.$router.push('/');
      } catch (error) {
        console.error('Login failed:', error);  // Debugging error
        alert('Login failed. Please check your credentials.');
      }
    },

    async fetchLeads(token) {
      try {
        console.log('Fetching leads with token:', token);  // Debugging token before fetching leads

        const response = await axios.get('http://127.0.0.1:8000/api/leads', {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });

        console.log('Leads fetched successfully:', response);  // Debugging the leads response

        // Store leads data in the component
        this.leads = response.data || [];

      } catch (error) {
        console.error('Error fetching leads:', error);  // Debugging error fetching leads
        alert('Failed to load leads');
      }
    },
  },

  mounted() {
    const token = localStorage.getItem('auth_token');
    if (token) {
      console.log('Token found in localStorage, fetching leads...');
      this.fetchLeads(token); // Fetch leads if token exists
    }
  },
};
</script>
