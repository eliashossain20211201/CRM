<template>
  <div class="dashboard">
    <h2>Lead Management Dashboard</h2>

    <section v-if="leads.length">
      <h3>Leads</h3>
      <kanban-board :leads="leads" />
    </section>

    <section v-if="applications.length">
      <h3>Applications</h3>
      <div class="applications">
        <div v-for="application in applications" :key="application.id">
          <p>{{ application.lead.name }} - Status: {{ application.status }}</p>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import KanbanBoard from './KanbanBoard.vue';
import { mapState, mapActions } from 'vuex';

export default {
  name: 'LeadDashboard',
  components: {
    KanbanBoard,
  },
  computed: {
    ...mapState(['leads', 'applications']),
  },
  mounted() {
    this.fetchLeads();
    this.fetchApplications();
  },
  methods: {
    ...mapActions(['fetchLeads', 'fetchApplications']),
  },
};
</script>

<style scoped>
.dashboard {
  padding: 20px;
}

.applications {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
</style>
