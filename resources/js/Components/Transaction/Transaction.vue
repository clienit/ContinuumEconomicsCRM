<template>
  <tr>
    <td>{{ transaction.client.first_name }} {{ transaction.last_name }}</td>
    <td>{{ transaction.transaction_date }}</td>
    <td>{{ transaction.amount }}</td>
    <td>
        <button type="button" @click="onEdit" class="btn btn-success">Update</button>        
        <button type="button" @click="onDelete" class="btn btn-secondary">Delete</button>
    </td>
  </tr>
</template>

<script>
export default {
    props: {
        transaction: {
            type: Object
        }
    },
    methods: {
        onDelete() {
            this.$emit("onDelete", this.transaction.id);
        },
        onEdit() {
            this.$emit("onEdit", this.transaction);
        }
    },
};
</script>
