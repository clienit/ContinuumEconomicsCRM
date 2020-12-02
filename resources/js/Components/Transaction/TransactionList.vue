<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Transaction Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>

                <tbody>
                    <transaction 
                        v-for="transaction in transactions"
                        :key="transaction.id"
                        :transaction="transaction"
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
            transactions: {
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