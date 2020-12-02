<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Client</div>
        <div class="card-body">
            <form class="form" enctype="multipart/form-data">
              <div class="form-group">
                  <input type="text" name="first_name" class="form-control" @change="handleChange" placeholder="First Name" :value="form.first_name">
              </div>
              <div class="form-group">
                  <input type="text" name="last_name" class="form-control" @change="handleChange" placeholder="Last Name" :value="form.last_name">
              </div>
              <div class="form-group">
                  <input type="email" name="email" class="form-control" @change="handleChange" placeholder="Email" :value="form.email">
              </div>
              <div class="form-group">
                <input type="file" class="form-control-file" name="avatar" @change="selectFile">
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
export default {
  data() {
    return {
      btnName: "Save"
    };
  },
  props: {
    form: {
      type: Object
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
    onFormSubmit(event) {
      event.preventDefault();
      if (this.formValidation()) {
        this.$emit("onFormSubmit", this.form);
        this.btnName = "Save";
      }
    },
    onClearForm(event) {
      event.preventDefault();
      this.form.first_name = "";
      this.form.last_name = "";
      this.form.email = "";
      this.form.isEdit = false;

      document.querySelector(".form").reset();

      this.btnName = "Save";
    },
    formValidation() {
      if (document.getElementsByName("first_name")[0].value === "") {
        alert("Enter First Name");
        return false;
      }
      if (document.getElementsByName("last_name")[0].value === "") {
        alert("Enter Last Name");
        return false;
      }
      if (document.getElementsByName("email")[0].value === "") {
        alert("Enter Email");
        return false;
      }
      if (document.getElementsByName("avatar")[0].value === "") {
        alert("Please Add Your Avatar");
        return false;
      }
      return true;
    },
  },
  updated() {
    if (this.form.isEdit) {
      this.btnName = "Update";
    }
  }
};
</script>
