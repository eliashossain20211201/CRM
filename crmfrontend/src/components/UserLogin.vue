<template>
  <div>
    <form @submit.prevent="login">
      <input type="email" v-model="email" placeholder="Email" required />
      <input type="password" v-model="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
import { ref } from 'vue';  // Import ref from vue
import axios from 'axios';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    const email = ref('');
    const password = ref('');

    const login = async () => {
      try {
        const response = await axios.post('http://localhost:8000/api/login', {
          email: email.value,
          password: password.value,
        });

        const token = response.data?.authorisation?.token;

        if (token) {
          store.dispatch('login', token); // Save token to Vuex store
          router.push('/');  // Redirect to dashboard
        } else {
          alert('Login failed.');
        }
      } catch (error) {
        console.error('Login failed:', error);
      }
    };

    return { email, password, login };
  },
};
</script>

<style scoped>
/* Optional CSS styling */
form {
  max-width: 400px;
  margin: auto;
}

input {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #42b983;
  border: none;
  color: white;
}
</style>
