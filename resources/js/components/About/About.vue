<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">About</h3>

                        <div class="card-tools">
                            <button class="btn-success"  @click="addAbout"> Add New <i class="fas fa-info fa-fw"> </i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Reason</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center" v-for="user in abouts" :key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.title }}</td>
                                <td>{{ user.description.substr(0,150) }}</td>

                                <td>
                                    <a href="#?">
                                        <i class="fas fa-user-edit green" @click="editAbout(user)"></i>
                                    </a>
                                    /
                                    <a href="#?" @click="deleteAbout(user.id)">
                                        <i class="fas fa-trash-alt danger" ></i>
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
                        <h5 class="modal-title" v-show="!editMode" id="exampleModalLabel">Add About</h5>
                        <h5 class="modal-title" v-show="editMode" id="">Update About Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateAbout() : createAbout()">
                        <div class="modal-body">
                            <div class="md-form form-sm m-2">

                                <input v-model="form.title" type="text" name="title" id="title" placeholder="Name"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>

                            <div class="md-form form-sm m-2">

                                <textarea v-model="form.description" type="text" name="description" id="description" placeholder="Description"
                                          class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <div class="md-form form-sm m-2">

                                <input  type="file" name="image" id="image" placeholder="Select an image"
                                        @change="convertToBase64" ref="fileupload" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('image') }">
                                <has-error :form="form" field="photo"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" v-show="!editMode" class="btn btn-primary">Add New Info</button>
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
                abouts:{},
                form: new Form({
                    id: '',
                    title: '',
                    description: '',
                    image: '',
                })
            }
        },
        methods:{
            addAbout()
            {
                this.editMode = false;
                this.form.reset();
                $('#basicExampleModal').modal('show');
            },
            editAbout(about)
            {
                this.form.reset();
                this.editMode = true;
                this.form.fill(about);
                $('#basicExampleModal').modal('show');
                $('#basicExampleModal').on('hidden.bs.modal', function () {
                    $('#basicExampleModal form')[0].reset();
                });
            },
            loadAbout()
            {
                axios.get('api/abouts').then(({data})=>(this.abouts = data.data));
            },
            createAbout()
            {
                this.$Progress.start();
                this.form.post('api/abouts').then(() => {
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
            updateAbout()
            {
                this.$Progress.start();
                this.form.put('api/abouts/'+ this.form.id).then(()=>{
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
            deleteAbout(id)
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
                        this.form.delete('api/abouts/'+id).then(() => {

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
                        this.form.image = reader.result;
                    }
                    reader.readAsDataURL(file)
                }else{
                    swal.fire(
                        'OOPS!!!',
                        'You Are Trying To Upload Large File',
                        'warning'
                    );
                    let input = this.$refs.fileupload;
                    input.type = 'text';
                    input.type = 'file';
                }
            }
        },
        created() {
            this.loadAbout();
            Fire.$on('afterCreate',() => { this.loadAbout()})
        }
    }
</script>
