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
import { ref } from 'vue';
import axios from 'axios';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

export default {
  setup() {
    const store = useStore();
    const router = useRouter();
    const email = ref('');
    const password = ref('');
    const error = ref(null);

    const login = async () => {
      try {
        const response = await axios.post('http://localhost:8000/api/login', {
          email: email.value,
          password: password.value,
        });

        const token = response.data?.authorisation?.token;
        const userRole = response.data?.user?.role;

        if (token) {
          store.dispatch('login', { token, role: userRole });
          if (userRole === 'admin') {
            router.push('/admin');
          } else if (userRole === 'counselor') {
            router.push('/counselor');
          }
        } else {
          error.value = 'Login failed. Please check your credentials.';
        }
      } catch (err) {
        error.value = 'Login failed. Please try again later.';
      }
    };

    return { email, password, login, error };
  },
};
</script>
