<template>
    <div class="container">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Nina Mcintire</h3>

                <p class="text-muted text-center">Software Engineer</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fa fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fa fa-pencil mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                          <input type="text" v-model="form.name" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-10">
                          <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputPhoto" class="col-sm-2 control-label">Profile Photo</label>

                        <div class="col-sm-10">
                          <input type="file" @change="updateProfile" class="form-input" id="inputPhoto" name="photo" placeholder="Photo">
                        </div>
                      </div>

                      <div class="form-group">
                            <label for="inputType" class="col-sm-2 control-label">Type</label>
                            <div class="col-sm-10">
                              <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 
                              'is-invalid': form.errors.has('type') }">
                                  <option value="">Pilih tipe user</option>
                                  <option value="admin">Admin</option>
                                  <option value="guest">Guest</option>
                                  <option value="mahasiswa">Mahasiswa</option>
                                  <option value="dosen">Dosen</option>
                                  <option value="staff">Staff</option>
                              </select>
                            </div>
                            <has-error :form="form" field="type"></has-error>
                        </div>

                      <!-- <div class="form-group">
                        <label for="inputType" class="col-sm-2 control-label">Type</label>

                        <div class="col-sm-10">
                          <input disabled type="text" v-model="form.type" class="form-control" id="inputType" placeholder="Type">
                        </div>
                      </div> -->
                      
                      <div class="form-group">
                        <label for="inputPassword" class="col-sm-6 control-label">Password(leave it empty if not changing)</label>

                        <div class="col-sm-6">
                          <input type="password" v-model="form.password" class="form-control" id="inputPassword" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button @click.prevent="updateInfo" type="submit" class="btn btn-danger">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
    </div>
</template>

<script>
    export default {
        data(){
          return{
            form: new Form({
              id : '',
              name : '',
              email : '',
              password: '',
              type: '',
              photo: ''
            })
          }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
          updateInfo(){
            this.$Progress.start();
            this.form.put('api/profile/')
            .then(()=>{
              
              this.$Progress.finish();
            })
            .catch(()=>{
              this.$Progress.fail();
            })
          },
          updateProfile(e){
            let file = e.target.files[0];
            console.log(file);
            let reader = new FileReader();

            // resize the profile photos
            if (file['size'] < 2111775) {
              reader.onloadend = (file) => {
                this.form.photo = reader.result;
              }
              reader.readAsDataURL(file);
            }else{
              Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: 'You are uploading a large image!',
              })
            }
          }
        },
        created(){
          axios.get("api/profile").then(({data}) => (this.form.fill(data)));
        }
    }
</script>
