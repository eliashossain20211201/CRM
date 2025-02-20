<template>
  <div>
    <h2>Leads Management</h2>
    <!-- Logout Button -->
    <div class="logout-container">
      <button @click="logout">Logout</button>
    </div>

    <div class="kanban-board">
      <!-- New Leads Column -->
      <div class="kanban-column">
        <h3>New Leads</h3>
        <Draggable
          v-model="newLeads"
          :group="{ name: 'leads', pull: true, put: true }"
          @start="drag=true"
          @end="drag=false"
          @change="onDragChange"
        >
          <div v-for="lead in newLeads" :key="lead.id">
            <p>{{ lead.name }}</p>
          </div>
        </Draggable>
      </div>

      <!-- In Progress Column -->
      <div class="kanban-column">
        <h3>In Progress</h3>
        <Draggable
          v-model="inProgressLeads"
          :group="{ name: 'leads', pull: true, put: true }"
          @start="drag=true"
          @end="drag=false"
          @change="onDragChange"
        >
          <div v-for="lead in inProgressLeads" :key="lead.id">
            <p>{{ lead.name }}</p>
          </div>
        </Draggable>
      </div>

      <!-- Converted Column -->
      <div class="kanban-column">
        <h3>Converted</h3>
        <Draggable
          v-model="convertedLeads"
          :group="{ name: 'leads', pull: true, put: true }"
          @start="drag=true"
          @end="drag=false"
          @change="onDragChange"
        >
          <div v-for="lead in convertedLeads" :key="lead.id">
            <p>{{ lead.name }}</p>
          </div>
        </Draggable>
      </div>
    </div>
  </div>
</template>

<script>
// Import Draggable correctly
import Draggable from 'vue-draggable-next'; 
import axios from 'axios';

export default {
  data() {
    return {
      leads: [],
      newLeads: [],
      inProgressLeads: [],
      convertedLeads: [],
      drag: false,
    };
  },
  mounted() {
    this.fetchLeads();
  },
  methods: {
    async fetchLeads() {
      try {
        const response = await axios.get('http://localhost:8000/api/leads', {
          headers: {
            Authorization: `Bearer ${localStorage.getItem('auth_token')}`,
          },
        });

        this.leads = response.data;
        this.newLeads = this.leads.filter(lead => lead.status === 'new');
        this.inProgressLeads = this.leads.filter(lead => lead.status === 'in_progress');
        this.convertedLeads = this.leads.filter(lead => lead.status === 'converted');
      } catch (error) {
        console.error('Error fetching leads:', error);
      }
    },

    logout() {
      localStorage.removeItem('auth_token');
      this.$router.push('/login');
    },

    // Called when a lead is moved to a new status column
    onDragChange(evt) {
      // Get the updated list of leads after the drag-and-drop
      this.updateLeadStatus(evt.item, evt.from.dataset.status);
    },

    updateLeadStatus(lead, newStatus) {
      // Update the lead's status in the backend
      axios
        .put(`http://localhost:8000/api/leads/${lead.id}`, { status: newStatus })
        .then(() => {
          this.fetchLeads(); // Re-fetch leads after updating the status
        })
        .catch(error => {
          console.error('Failed to update lead status:', error);
        });
    },
  },
  components: {
    Draggable, // Register Draggable correctly
  },
};
</script>

<style scoped>
.kanban-board {
  display: flex;
  justify-content: space-between;
}

.kanban-column {
  width: 30%;
  background-color: #f5f5f5;
  padding: 10px;
  border-radius: 5px;
}

.kanban-column h3 {
  text-align: center;
}

.logout-container {
  position: absolute;
  top: 10px;
  right: 10px;
}

button {
  padding: 8px 12px;
  background-color: #ff6347;
  border: none;
  color: white;
  cursor: pointer;
}
</style>
