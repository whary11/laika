<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <button
              ype="button"
              data-toggle="modal"
              data-target="#modal_user"
              class="btn btn-success"
            >Crear</button>
          </div>
          <div class="card-body">
            <v-client-table
              :pagination="{edge:true}"
              :data="rows"
              :columns="table.columns"
              :options="{
        texts,headings,perPage,collapseGroups,pagination
        }"
              class="table-sm"
            >
              <div slot="Acciones" slot-scope="props" class="btn-group">
                <button
                  type="button"
                  class="btn btn-dark"
                  data-toggle="modal"
                  data-target="#edit_user"
                  @click="user_edit=props.row"
                >Editar</button>
                <button
                  class="btn btn-danger btn-sm"
                  data-toggle="modal"
                  @click="deleteUser(props.row)"
                >Eliminar</button>
              </div>
            </v-client-table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para la creación y edición de los usuarios -->
    <!-- Modal -->
    <div
      class="modal fade"
      id="modal_user"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div
            class="alert alert-success m-3"
            v-if="userValidate"
            role="alert"
          >Todos los campos está correctos</div>
          <div class="alert alert-danger m-3" v-else role="alert">Hay {{count}} incorrectos</div>

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Craer Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="row" @submit.prevent="saveUser()">
              <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Nombre</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="user.name"
                  placeholder="Nombre completo"
                />
              </div>
              <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Correo electrónico</label>
                <input
                  type="email"
                  v-model="user.email"
                  class="form-control"
                  placeholder="Correo electrónico"
                />
              </div>
              <div class="form-group col-md-12">
                <label for="exampleInputPassword1">Contraseña</label>
                <input
                  type="password"
                  v-model="user.password"
                  class="form-control"
                  placeholder="Contraseña"
                />
              </div>
              <!-- <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Confirmar contraseña</label>
                <input
                  type="password"
                  v-model="user.confirmed_password"
                  class="form-control"
                  placeholder="Confirmar contraseña"
                />
              </div>-->

              <div class="form-group col-md-4">
                <label for="exampleInputPassword1">País</label>
                <v-select
                  :options="countries"
                  @input="chageCountry"
                  v-model="user.country"
                  label="name"
                  placeholder="País"
                ></v-select>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputPassword1">Departament</label>

                <v-select
                  :options="departments"
                  @input="chageDep"
                  label="name"
                  v-model="user.department"
                  placeholder="Departament"
                ></v-select>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputPassword1">Municipio</label>

                <v-select
                  :options="municipalities"
                  placeholder="Municipio"
                  v-model="user.municipality"
                  label="name"
                ></v-select>
              </div>
              <div class="col-md-12" v-if="loading">
                <div class="row justify-content-center">
                  <div class="spinner-border text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                  <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary" :disabled="!userValidate">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Fin del modal -->

    <!-- Modal para editar user -->

    <div
      class="modal fade"
      id="edit_user"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      v-if="user_edit.municipality"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <!-- <div
            class="alert alert-success m-3"
            v-if="userValidate"
            role="alert"
          >Todos los campos está correctos</div>
          <div class="alert alert-danger m-3" v-else role="alert">Hay {{count}} incorrectos</div>-->

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Craer Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="row" @submit.prevent="editUser()">
              <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Nombre</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="user_edit.name"
                  placeholder="Nombre completo"
                />
              </div>
              <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Correo electrónico</label>
                <input
                  type="email"
                  v-model="user_edit.email"
                  class="form-control"
                  placeholder="Correo electrónico"
                />
              </div>
              <div class="form-group col-md-12">
                <label for="exampleInputPassword1">Contraseña</label>
                <input
                  type="password"
                  v-model="user_edit.password"
                  class="form-control"
                  placeholder="Contraseña"
                />
              </div>
              <!-- <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Confirmar contraseña</label>
                <input
                  type="password"
                  v-model="user.confirmed_password"
                  class="form-control"
                  placeholder="Confirmar contraseña"
                />
              </div>-->

              <div class="form-group col-md-4">
                <label>País</label>
                <v-select
                  :options="countries"
                  @input="chageCountryEdit"
                  v-model="user_edit.municipality.department.country"
                  label="name"
                  placeholder="País"
                ></v-select>
              </div>
              <div class="form-group col-md-4">
                <label>Departament</label>
                <!-- <pre>
                  {{user_edit}}
                </pre>-->

                <v-select
                  :options="departments"
                  @input="chageDepEdit"
                  label="name"
                  v-model="user_edit.municipality.department"
                  placeholder="Departament"
                ></v-select>
              </div>
              <div class="form-group col-md-4">
                <label>Municipio</label>

                <v-select
                  :options="municipalities"
                  placeholder="Municipio"
                  v-model="user_edit.municipality"
                  label="name"
                ></v-select>
              </div>
              <div class="col-md-12" v-if="loading">
                <div class="row justify-content-center">
                  <div class="spinner-border text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                  <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user_edit: {},
      loading: false,
      count: 0,
      countries: [],
      departments: [],
      municipalities: [],
      user: {
        name: "",
        email: "",
        password: "",
        // confirmed_password: "",
        country: "",
        department: "",
        municipality: ""
      },
      user_validate: [
        "name",
        "email",
        "password",
        // "confirmed_password",
        "country",
        "department",
        "municipality"
      ],
      rows: [],
      table: {
        columns: [
          "name",
          "email",
          "municipality.name",
          "municipality.department.name",
          "municipality.department.country.name",
          "Acciones"
        ]
      },
      config: {
        scope: "estudiante",
        rol: "STUDENT",
        urlSave: "/api/user/saveUser",
        urlEdit: `/api/user/editUser`
      },
      headings: {
        document: "Identificacion",
        names: "Nombre",
        surnames: "Apellidos",
        email: "Email"
      },
      pagination: { nav: "scroll", chunk: 6 },
      collapseGroups: true,
      perPage: 10,
      texts: {
        count:
          "Montrando del {from} al {to} de {count} Registros|{count} Registros|1 rol",
        first: "First",
        last: "Last",
        filter: "",
        filterPlaceholder: "Buscar registro",
        limit: "",
        page: "Page:",
        noResults: "Sin resultados",
        filterBy: "Filter by {column}",
        loading: "Cargando...",
        defaultOption: "Select {column}",
        columns: "Columns"
      }
    };
  },
  mounted() {
    this.getUser();
    this.getCountries();
  },

  methods: {
    chageCountry(county) {
      console.log(county);
      this.departments = county.departments;
    },
    chageDep(dep) {
      console.log(dep);
      this.municipalities = dep.municipality;
    },

    chageCountryEdit(county) {
      console.log(county);
      this.departments = county.departments;
    },
    chageDepEdit(dep) {
      console.log(dep);
      this.municipalities = dep.municipality;
    },

    getUser() {
      axios
        .get("/api/getUsers")
        .then(res => {
          this.rows = res.data;
        })
        .catch(function(error) {});
    },
    editUser() {
      axios
        .post("/api/editUser", this.user_edit)
        .then(res => {
          if (res.data.status) {
            this.$swal.fire({
              text: "Usuario editado con éxito.",
              type: "success"
            });
            $("#edit_user").modal("hide");

            this.getUser();
          }
          console.log(res.data);
        })
        .catch(function(error) {});
    },

    saveUser() {
      if (this.userValidate) {
        this.loading = true;
        axios
          .post("/api/saveUser", this.user)
          .then(res => {
            this.loading = false;
            if (res.data.status) {
              this.getUser();
              this.user = {};
              $("#modal_user").modal("hide");
              alert("Usuario guardado con éxito");
            }
          })
          .catch(function(error) {});
      }
    },

    getCountries() {
      axios
        .get("/api/getCountries")
        .then(res => {
          this.countries = res.data;
        })
        .catch(function(error) {});
    },

    deleteUser(user) {
      this.$swal
        .fire({
          // title: "Are you sure?",
          text: "Deseas eliminar el usuario ?",
          type: "error",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "SI",
          cancelButtonText: "NO"
        })
        .then(result => {
          axios
            .post("/api/deleteUser", user)
            .then(res => {
              console.log(res.data.status);
              if (res.data.status) {
                if (res.data.status) {
                  this.getUser();
                }
                this.$swal.fire({
                  text: "Usuario eliminado con éxito.",
                  type: "success"
                });
              }
            })
            .catch(function(error) {});
        });
    }
  },
  computed: {
    userValidate() {
      let count = 0;
      this.user_validate.map(v => {
        if (this.user[v] != "") {
          count++;
        }
      });
      this.count = this.user_validate.length - count;

      if (count < this.user_validate.length) {
        return false;
      } else {
        return true;
      }
    }
  }
};
</script>
