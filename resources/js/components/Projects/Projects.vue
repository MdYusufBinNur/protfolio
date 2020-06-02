<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Responsive Hover Table</h3>

                        <div class="card-tools">
                            <button class="btn-success"  @click="addProject"> Add New <i class="fas fa-tasks fa-fw"> </i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th>Client</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="project in projects" :key="project.id">
                                <td>{{ project.id }}</td>
                                <td>{{ project.project_name }}</td>
                                <td>{{ project.project_details}}</td>
                                <td>{{ project.project_client }}</td>

                                <td>
                                    <a href="#?">
                                        <i class="fas fa-user-edit green" @click="editProject(project)"></i>
                                    </a>
                                    /
                                    <a href="#?" @click="deleteProject(project.id)">
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
                    <form @submit.prevent="editMode ? updateProjects() : createProjects()">
                        <div class="modal-body">


                            <div class="md-form form-sm m-2">
                                <label for="project_category_id">Select Category</label>
                                <select name="project_category_id" required id="project_category_id" v-model="form.project_category_id" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('project_category_id') }">
                                    <option v-for="category in categories" :value="category.id">{{ category.name}}</option>

                                </select>
                                <has-error :form="form" field="project_category_id"></has-error>
                            </div>
                            <div class="md-form form-sm m-2">

                                <input v-model="form.project_name" type="text" name="project_name" id="project_name" placeholder="Name"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('project_name') }">
                                <has-error :form="form" field="project_name"></has-error>
                            </div>

                            <div class="md-form form-sm m-2">

                                <input v-model="form.project_client" type="text" name="project_client" id="project_client" placeholder="Client"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('project_client') }">
                                <has-error :form="form" field="project_client"></has-error>
                            </div>

                            <div class="md-form form-sm m-2">
                                <textarea v-model="form.project_details" type="text" name="project_details" id="project_details" placeholder="Details"
                                          class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('project_details') }">

                                </textarea>
                                <has-error :form="form" field="project_details"></has-error>
                            </div>

                            <div class="md-form form-sm m-2">
                                <input v-model="form.project_date" type="date" name="project_date" id="project_date" placeholder="Date"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('project_date') }">
                                <has-error :form="form" field="project_date"></has-error>
                            </div>
                            <div class="md-form form-sm m-2">
                                <input v-model="form.project_links" type="text" name="project_links" id="project_links" placeholder="Link"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('project_links') }">
                                <has-error :form="form" field="project_links"></has-error>
                            </div>

                            <div class="md-form form-sm m-2">

                                <input  type="file" name="project_image" id="project_image" placeholder="Select an image"
                                        @change="convertToBase64" ref="fileupload" class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('project_image') }">
                                <has-error :form="form" field="project_image"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" v-show="!editMode" class="btn btn-primary">Add New Project</button>
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
                projects:{},
                categories:{},
                form: new Form({
                    id: '',
                    project_name: '',
                    project_details: '',
                    project_date: '',
                    project_image: '',
                    project_client: '',
                    project_category_id: '',
                    project_links: '',
                    project_comments: '',
                }),
                test: ['one', 'two', 'three']
            }
        },
        methods:{
            loadProjects()
            {
                axios.get('api/projects').then(({data})=>[this.projects = data.projects.data, this.categories = data.categories]);
            },
            createProjects()
            {
                this.$Progress.start();
                this.form.post('api/projects').then(() => {
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
            editProject(project)
            {
                this.form.reset();
                this.editMode = true;
                this.form.fill(project);
                $('#basicExampleModal').modal('show');
                $('#basicExampleModal').on('hidden.bs.modal', function () {
                    $('#basicExampleModal form')[0].reset();
                });
            },
            deleteProject(id)
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
                        this.form.delete('api/projects/'+id).then(() => {

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
            updateProjects()
            {
                this.$Progress.start();
                this.form.put('api/projects/'+ this.form.id).then(()=>{
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
            addProject()
            {
                this.editMode = false;
                this.form.reset();
                $('#basicExampleModal').modal('show');
            },
            convertToBase64(e){
                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();

                if (file["size"] < 2111775){
                    reader.onloadend = (file) =>{
                        this.form.project_image = reader.result;
                    }
                    reader.readAsDataURL(file)
                }else{
                    swal.fire(
                        'OPS!!!',
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
            this.loadProjects();
            Fire.$on('afterCreate',() => { this.loadProjects()})
        }
    }
</script>
