<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Vehicle List</h3>

                        <div class="card-tools">
                            
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Vehicle Identity</th>
                            <th>Vehicle's Name</th>
                            <th>Register At</th>
                            <th>Modify</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="#">
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
    </div>
</template>

<script>
    export default {
        data(){
            return{
                users : {},
                form: new Form({
                    name : '',
                    email : '',
                    password: '',
                    type: '',
                    photo: ''
                })
            }
        },
        methods: {
            loadUsers(){
                axios.get("api/user").then(({ data }) => (this.users = data.data));
            },
            createUser(){
                this.form.post('api/user')
            }

        },
        created() {
            this.loadUsers();
        }
    }
</script>
