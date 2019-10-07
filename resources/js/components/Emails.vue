<template>
  <div class="container">
    <!-- <div class="m-4">
      <button class="btn btn-dark" @click="stateEmails()">Procesar emails</button>
    </div>-->
    <div class="card">
      <div class="card-body">
        <form class="row" @submit.prevent="sendEmail()">
          <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Email</label>
            <input
              type="email"
              required
              class="form-control"
              placeholder="Su email"
              v-model="email.email"
            />
          </div>
          <div class="form-group col-md-6">
            <label for="exampleInputPassword1">Asunto</label>
            <input
              type="text"
              required
              v-model="email.subject"
              class="form-control"
              placeholder="Asunto"
            />
          </div>

          <div class="form-group col-md-12">
            <label>Destinatario</label>
            <input
              required
              type="email"
              v-model="email.addressee"
              class="form-control"
              placeholder="Destinatario"
            />
          </div>
          <div class="form-group col-md-12">
            <label>Mensaje</label>
            <textarea
              required
              v-model="email.message"
              cols="30"
              class="form-control"
              rows="10"
              placeholder="Deja tu mensaje"
            ></textarea>
          </div>
          <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      email: {
        email: "",
        subject: "",
        addressee: "",
        message: ""
      }
    };
  },
  methods: {
    sendEmail(e) {
      // e.preventDefault();
      // alert("Su mensaje está en cola.");

      axios
        .post("/api/queuedEmail", this.email)
        .then(res => {
          if (res.data.status) {
            this.$swal.fire({
              text: "Su email ingresó a la cola.",
              type: "success"
            });
            this.email = {};
          }
        })
        .catch(function(error) {});
    }
  }
};
</script>