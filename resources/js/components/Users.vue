<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Responsive Hover Table</h3>

                        <div class="card-tools">
                            <button class="btn-success"  @click="addNewUser"> Add New <i class="fas fa-user-plus fa-fw"> </i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Reason</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.type }}</td>
                                <td>
                                    <a href="#?">
                                        <i class="fas fa-user-edit green" @click="editUser(user)"></i>
                                    </a>
                                    /
                                    <a href="#?" @click="deleteUser(user.id)">
                                        <i class="fas fa-trash-alt red" ></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editMode" id="exampleModalLabel">Add New User</h5>
                        <h5 class="modal-title" v-show="editMode" id="">Update User Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateUser() : createUsers()">
                        <div class="modal-body">
                            <div class="md-form form-sm m-2">

                                <input v-model="form.name" type="text" name="name" id="name" placeholder="Name"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                             <div class="md-form form-sm m-2">

                                 <input v-model="form.email" type="text" name="name" id="email" placeholder="Email"
                                        class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('email') }">
                                 <has-error :form="form" field="email"></has-error>
                             </div>

                            <div class="md-form form-sm m-2">

                                <input v-model="form.bio" type="text" name="bio" id="bio" placeholder="Bio"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('bio') }">
                                <has-error :form="form" field="bio"></has-error>
                            </div>

                            <div class="md-form form-sm m-2">
                                <select name="type" id="type" v-model="form.type" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="md-form form-sm m-2">

                                <input v-model="form.password" type="password" name="password" id="password" placeholder="Password"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                            <div class="md-form form-sm m-2">

                                <input  type="file" name="photo" id="photo" placeholder="Select an image"
                                      @change="convertToBase64" ref="fileupload" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('photo') }">
                                <has-error :form="form" field="photo"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" v-show="!editMode" class="btn btn-primary">Sign up</button>
                            <button type="submit" v-show="editMode" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data()
        {
          return {
              editMode: false,
              users:{},
              form: new Form({
                  id: '',
                  name: '',
                  email: '',
                  password: '',
                  type: '',
                  bio: '',
                  photo: ''
              })
          }
        },
        methods:{
            addNewUser()
            {
                this.editMode = false;
                this.form.reset();
                $('#basicExampleModal').modal('show');
            },
            editUser(user)
            {
                this.form.reset();
                this.editMode = true;
                this.form.fill(user);
                $('#basicExampleModal').modal('show');
                $('#basicExampleModal').on('hidden.bs.modal', function () {
                    $('#basicExampleModal form')[0].reset();
                });
            },
            loadUsers()
            {
                axios.get('api/user').then(({data})=>(this.users = data.data));
            },
            createUsers()
            {
                this.$Progress.start();
                this.form.post('api/user').then(() => {
                    Fire.$emit('afterCreate');
                    toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    });
                    $('#basicExampleModal').modal('hide');
                    this.form.reset();
                    Fire.$emit('afterCreate');
                    this.$Progress.finish()
                }).catch(()=>{
                    toast.fire({
                        icon: 'error',
                        title: 'Failed To Create User'
                    });
                    this.$Progress.fail()
                });
            },
            updateUser()
            {
                this.$Progress.start();
                this.form.put('api/user/'+ this.form.id).then(()=>{
                    Fire.$emit('afterCreate');
                    this.$Progress.finish();
                    toast.fire({
                        icon: 'success',
                        title: 'User Info Updated'
                    });
                    $('#basicExampleModal').modal('hide');
                    this.form.reset();

                }).catch(()=>{
                    this.$Progress.fail();
                    toast.fire({
                        icon: 'error',
                        title: 'Failed To Update'
                    });
                });
                console.log("Edit Mode Here")
            },
            deleteUser(id)
            {
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        // Send HTTP Request
                        this.form.delete('api/user/'+id).then(() => {

                            swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            Fire.$emit('afterCreate');
                        }).cache(() => {
                            toast.fire({
                                icon: 'error',
                                title: 'Failed To Delete User'
                            });
                        });

                    }
                })
            },
            convertToBase64(e){
                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();

                if (file["size"] < 2111775){
                    reader.onloadend = (file) =>{
                        this.form.photo = reader.result;
                    }
                    reader.readAsDataURL(file)
                }else{
                    swal.fire(
                        'OOPPSS!!!',
                        'You Are Trying pl Large File',
                        'warning'
                    );
                    let input = this.$refs.fileupload;
                    input.type = 'text';
                    input.type = 'file';
                }
            }
        },
        created() {
            this.loadUsers();
            Fire.$on('afterCreate',() => { this.loadUsers()})
        }
    }
</script>
