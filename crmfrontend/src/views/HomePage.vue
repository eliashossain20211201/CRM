<template>
  <div class="home">
    <LeadDashboard />
  </div>
</template>

<script>
import LeadDashboard from '@/components/LeadDashboard.vue';

export default {
  name: 'HomePage',
  components: {
    LeadDashboard,
  },
};
</script>

<style scoped>
.home {
  margin-top: 20px;
}
</style>
