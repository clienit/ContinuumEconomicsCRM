<template>
  <div id="app">
    <div class="container">
        <transaction-form :form="form" :clients="clients" @onFormSubmit="onFormSubmit" />
        <loader v-if="loader" />
        <transaction-list
            :transactions="transactions"
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
            transactions: [],
            clients: [],
            form: {
                client_id: '',
                transaction_date: '',
                amount: '',
                isEdit: false
            },
            loader: false
        };
    },
    created() {
        this.getClients();
        this.getTransactions();
    },
    methods: {
        onEdit(data) {
            this.form = data;
            this.form.isEdit = true;
        },
        onDelete(id) {
            this.deleteTransaction(id);
        },
        onFormSubmit(data) {
            console.log(data);
            if (data.isEdit) {
                // Edit Transaction
                this.editTransaction(data);
            } else {
                // Create Transaction
                this.createTransaction(data);
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
        getTransactions() {
            this.loader = true;
            axios
                .get('/transactions')
                .then(response => {
                    this.transactions = response.data.data;
                    this.loader = false;
                })
                .catch(err => console.log(err))
                .finally(() => this.loader = false);
        },
        createFormData(data) {
            let formData = new FormData();
            formData.append("client_id", this.form.client_id);
            formData.append("transaction_date", this.form.transaction_date);
            formData.append("amount", this.form.amount);
            return formData;
        },
        createTransaction(data) {
            this.loader = true;
            let formData = this.createFormData(data);
            axios
                .post('/transactions', formData)
                .then(response => (
                    this.getTransactions()
                ))
                .catch(error => console.log(error))
                .finally(() => this.loader = false)
        },
        deleteTransaction(id) {
            this.loader = true;
            axios
                .delete('/transactions/' + id)
                .then(response => (
                    this.getTransactions()
                ))
                .catch(error => console.log(error))
                .finally(() => this.loader = false)
        },
        editTransaction(data) {
            this.loader = true;
            axios
                .put('/transactions/' + data.id, this.form)
                .then(response => (
                    this.getTransactions()
                ))
                .catch(error => console.log(error))
                .finally(() => this.loader = false)
        }
    }
};
</script>
