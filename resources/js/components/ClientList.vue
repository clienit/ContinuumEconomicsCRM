<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <client 
                        v-for="client in clients"
                        :key="client.id"
                        :client="client"
                        @onDelete="onDelete"
                        @onEdit="onEdit"
                    />
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            clients: {
                type: Array
            }
        },
        methods: {
            onDelete(id) {
                this.$emit("onDelete", id);
            },
            onEdit(data) {
                this.$emit("onEdit", data);
            }
        }
    };
</script>