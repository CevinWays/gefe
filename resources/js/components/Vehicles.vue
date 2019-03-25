<template>
    <div class="container">
        <div class="row" v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>
        <div class="row" v-if="$gate.isAdmin()">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Vehicle List</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal()"> <i class="fas fa-motorcycle"></i> Tambah</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Vehicle Identity</th>
                            <th>Vehicle's Name</th>
                            <th>Owner</th>
                            <th>Register At</th>
                            <th>Modify</th>
                        </tr>
                        <tr v-for="vehicle in vehicles" :key="vehicle.id">
                            <td>{{vehicle.id}}</td>
                            <td>{{vehicle.number}}</td>
                            <td>{{vehicle.name}}</td>
                            <td>{{vehicle.user_id}}</td>
                            <td>{{vehicle.created_at}}</td>
                            <td>
                                <a href="#" @click="editModal(vehicle)">
                                    <i class="fa fa-edit cyan"></i>
                                </a>
                                /
                                <a href="#">
                                    <i class="fa fa-trash red"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody></table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <form @submit.prevent="editmode ? updateVehicle() :createVehicle()">
            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">Tambah Kendaraan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label>Nomor Kendaraan</label>
                            <input v-model="form.number" type="number" name="number"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('number') }">
                            <has-error :form="form" field="number"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Nama Kendaraan</label>
                            <input v-model="form.name" type="text" name="name"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>
                        <div class="form-group">
                            <label>Type Kendaraan</label>
                            <select name="type" v-model="form.type" id="type" class="form-control" :class="{ 
                                'is-invalid': form.errors.has('type') }">
                                    <option value="">Pilih tipe kendaraan</option>
                                    <option value="dua">Roda dua</option>
                                    <option value="empat">Roda Empat</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                vehicles : {},
                form: new Form({
                    id: '',
                    name : '',
                    number : '',
                    type:'',
                })
            }
        },
        methods: {
            newModal(){
                this.form.reset();
                $('#addNew').modal('show');
            },
            loadVehicle(){
                axios.get("api/vehicle").then(({ data }) => (this.vehicles = data.data));
            },
            createVehicle(){
                this.$Progress.start();
                this.form.post('api/vehicle')
                .then(()=>{
                    this.$Progress.finish();
                    $('#addNew').modal('hide');

                    toast.fire({
                        type: 'success',
                        title: 'Vehicle Created Successfully!'
                    })

                    this.loadVehicle();
                    Fire.$emit('AfterCreate');
                })
                .catch(()=>{
                    this.$Progress.fail();
                })
            },
            updateVehicle(id){
                this.$Progress.start();
                this.form.put('api/vehicle/'+this.form.id)
                .then(()=>{
                    $('#addNew').modal('hide');
                    Swal.fire(
                        'Updated!',
                        'Berhasil terupdate!.',
                        'success'
                    )
                    this.loadVehicle();
                    Fire.$emit('AfterCreate');
                })
                .catch(()=>{
                    this.$Progress.fail();
                })

                console.log("editing data");
            },
            editModal(vehicle){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(vehicle);
            }
        },
        created() {
            this.loadVehicle();
            Fire.$on('AfterCreate',() => {
                this.loadVehicle();
            });
            // setInterval(() => this.loadUsers(), 3000);

        }
    }
</script>
