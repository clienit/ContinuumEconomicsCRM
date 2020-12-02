<template>
  <tr>
    <td>
        <img class="card-img-left" v-bind:src="'../storage/' + client.avatar" alt="Client Image" width="100" height="100">
    </td>
    <td>{{ client.first_name }} {{ client.last_name }}</td>
    <td>{{ client.email }}</td>
    <td>
        <button type="button" @click="onEdit" class="btn btn-success">Update</button>        
        <button type="button" @click="onDelete" class="btn btn-secondary">Delete</button>
    </td>
  </tr>
</template>

<script>
export default {
    props: {
        client: {
            type: Object
        }
    },
    methods: {
        onDelete() {
            this.$emit("onDelete", this.client.id);
        },
        onEdit() {
            this.$emit("onEdit", this.client);
        }
    },
};
</script>
