<template>
  <div class="container">
    <div class="card">
      <div class="card-body table table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Asunto</th>
              <th>Destinatario</th>
              <th>Mesaje</th>
              <th>Envió</th>
              <th>Estado</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in emails" :key="index">
              <td>{{item.subject}}</td>
              <td>{{item.addressee}}</td>
              <td>{{item.message}}</td>
              <td>{{item.user.name}}</td>
              <td>Falló</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      emails: []
    };
  },

  mounted() {
    this.getEmails();
  },
  methods: {
    getEmails() {
      axios
        .get("/api/getEmails")
        .then(res => {
          this.emails = res.data;
          console.log(res.data);
        })
        .catch(function(error) {});
    }
  }
};
</script>