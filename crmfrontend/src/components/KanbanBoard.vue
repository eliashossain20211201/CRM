<template>
  <div>
    <vue-draggable-next :list="leads" group="kanban">
      <div v-for="lead in leads" :key="lead.id" class="kanban-card">
        <p>{{ lead.name }} - {{ lead.status }}</p>
      </div>
    </vue-draggable-next>
  </div>
</template>

<script>
import { ref } from 'vue';
import vueDraggableNext from 'vue-draggable-next';
import { useStore } from 'vuex';

export default {
  components: {
    vueDraggableNext
  },
  setup() {
    const store = useStore();
    const leads = ref(store.getters.leads);

    return { leads };
  }
};
</script>
