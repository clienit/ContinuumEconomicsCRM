<template>
  <div id="app">
    <div class="container">
        <client-form :form="form" @onFormSubmit="onFormSubmit" />
        <loader v-if="loader" />
        <client-list
            :clients="clients"
            @onDelete="onDelete"
            @onEdit="onEdit"
        />
    </div>
  </div>
</template>

<script>

export default {
    data() {
        return {
            clients: [],
            form: {
                first_name: '',
                last_name: '',
                avatar: '',
                email: '',
                isEdit: false
            },
            loader: false
        };
    },
    created() {
        this.getClients();
    },
    methods: {
        onEdit(data) {
            this.form = data;
            this.form.isEdit = true;
        },
        onDelete(id) {
            this.deleteClient(id);
        },
        onFormSubmit(data) {
            if (data.isEdit) {
                // Edit Client
                this.editClient(data);
            } else {
                // Create Client
                this.createClient(data);
            }
        },
        getClients() {
            this.loader = true;
            axios
                .get('/clients')
                .then(response => {
                    this.clients = response.data.data;
                    this.loader = false;
                })
                .catch(err => console.log(err))
                .finally(() => this.loader = false);
        },
        createFormData(data) {
            let formData = new FormData();
            formData.append("first_name", this.form.first_name);
            formData.append("last_name", this.form.last_name);
            formData.append("email", this.form.email);
            formData.append("avatar", this.form.avatar);
            return formData;
        },
        createClient(data) {
            this.loader = true;
            let formData = this.createFormData(data);
            axios
                .post('/clients', formData)
                .then(response => (
                    this.getClients()
                ))
                .catch(error => console.log(error))
                .finally(() => this.loader = false)
        },
        deleteClient(id) {
            this.loader = true;
            axios
                .delete('/clients/' + id)
                .then(response => (
                    this.getClients()
                ))
                .catch(error => console.log(error))
                .finally(() => this.loader = false)
        },
        editClient(data) {
            this.loader = true;
            axios
                .put('/clients/' + data.id, this.form)
                .then(response => (
                    this.getClients()
                ))
                .catch(error => console.log(error))
                .finally(() => this.loader = false)
        }
    }
};
</script>
