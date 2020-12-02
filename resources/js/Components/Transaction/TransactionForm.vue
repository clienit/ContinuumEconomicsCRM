<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Transaction</div>
        <div class="card-body">
            <form class="form" enctype="multipart/form-data">
              <div class="form-group">
                  <select
                    name="client_id"
                    id="client_id"
                    class="form-control"
                    @change="handleChange"
                    v-model="form.client_id"
                  >
                    <option value selected>Select Client</option>
                    <option
                      v-for="client in clients"
                      :key="client.id"
                      :value="client.id"
                    >{{ client.first_name }} {{ client.last_name }}</option>
                  </select>
              </div>
              <div class="form-group">
                  <datepicker :value="form.transaction_date" class="form-control" name="transaction_date" @selected="handleDate" placeholder="Transaction Date"></datepicker>
              </div>
              <div class="form-group">
                  <input type="email" name="amount" class="form-control" @change="handleChange" placeholder="Amount" :value="form.amount">
              </div>
              <div class="form-group">
                <button type="button" @click="onFormSubmit" class="btn btn-success">
                  {{ btnName }}            
                </button>
                <button type="button" @click="onClearForm" class="btn btn-secondary">
                  Clear Form          
                </button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';

moment().format();

export default {
  components: {
    Datepicker
  },
  data() {
    return {
      btnName: "Save"
    };
  },
  props: {
    form: {
      type: Object
    },
    clients: {
      type: Array
    }
  },
  methods: {
    selectFile(event) {
        this.form['avatar'] = event.target.files[0];
    },
    handleChange(event) {
      const { name, value } = event.target;
      this.form[name] = value;
    },
    handleDate(data) {
      this.form['transaction_date'] = moment(data).format('YYYY-MM-DD');
    },
    onFormSubmit(event) {
      event.preventDefault();
      this.$emit("onFormSubmit", this.form);
      this.btnName = "Save";
    },
    onClearForm(event) {
      event.preventDefault();
      this.form.client_id = "";
      this.form.transaction_date = "";
      this.form.amount = "";

      document.querySelector(".form").reset();

      this.btnName = "Save";
    },
  },
  updated() {
    if (this.form.isEdit) {
      this.btnName = "Update";
    }
  }
};
</script>
