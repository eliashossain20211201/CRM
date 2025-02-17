<template>
  <div class="kanban-board">
    <div v-for="(status, index) in statuses" :key="index" class="kanban-column">
      <h4>{{ status }}</h4>
      <!-- Loop through filtered leads and directly use 'lead' -->
      <div
        v-for="lead in filteredLeads(status)"
        :key="lead.id"
        class="kanban-item"
        draggable="true"
        @dragstart="onDragStart(lead)"
        @dragover.prevent
        @drop="onDrop(status, lead)"
      >
        {{ lead.name }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  props: {
    leads: Array,
  },
  data() {
    return {
      draggedLead: null,
      statuses: ['new', 'in_progress', 'bad_timing', 'not_interested', 'not_qualified'],
    };
  },
  methods: {
    filteredLeads(status) {
      return this.leads.filter(lead => lead.status === status);
    },
    onDragStart(lead) {
      this.draggedLead = lead;  // Track the dragged lead
    },
    onDrop(status, lead) {
      if (this.draggedLead && this.draggedLead.id !== lead.id) {
        // If the lead is dragged to another status
        axios.put(`http://localhost/api/leads/${this.draggedLead.id}`, {
          status: status,
        }).then(() => {
          this.$emit('status-updated');  // Notify parent component
        });
      }
    },
  },
};
</script>

<style scoped>
.kanban-board {
  display: flex;
  gap: 20px;
}

.kanban-column {
  width: 200px;
  background-color: #f4f4f4;
  padding: 10px;
  border-radius: 5px;
}

.kanban-item {
  padding: 10px;
  background-color: #fff;
  margin: 10px 0;
  border: 1px solid #ddd;
  border-radius: 5px;
  cursor: move;
}
</style>
