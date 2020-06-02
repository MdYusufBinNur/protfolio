<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">About</h3>

                        <div class="card-tools">
                            <button class="btn-success"  @click="addJob"> Add New <i class="fas fa-info fa-fw"> </i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Time Line</th>
                                <th>Description</th>
                                <th>Reason</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center" v-for="job in jobs" :key="job.id">
                                <td>{{ job.id }}</td>
                                <td>{{ job.title }}</td>
                                <td>{{ job.company }}</td>
                                <td>{{ job.time_line }}</td>
                                <td>{{ job.description.substr(0,150) }}</td>

                                <td>
                                    <a href="#?">
                                        <i class="fas fa-user-edit green" @click="editJob(job)"></i>
                                    </a>
                                    /
                                    <a href="#?" @click="deleteJob(job.id)">
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
                        <h5 class="modal-title" v-show="!editMode" id="exampleModalLabel">Add Job</h5>
                        <h5 class="modal-title" v-show="editMode" id="">Update Job Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateJob() : createJob()">
                        <div class="modal-body">
                            <div class="md-form form-sm m-2">

                                <input v-model="form.title" type="text" name="title" id="title" placeholder="Title"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="md-form form-sm m-2">

                                <input v-model="form.company" type="text" name="company" id="company" placeholder="Company"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('company') }">
                                <has-error :form="form" field="company"></has-error>
                            </div>
                            <div class="md-form form-sm m-2">

                                <input v-model="form.time_line" type="text" name="time_line" id="time_line" placeholder="Time Line"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('time_line') }">
                                <has-error :form="form" field="time_line"></has-error>
                            </div>

                            <div class="md-form form-sm m-2">

                                <textarea v-model="form.description" type="text" name="description" id="description" placeholder="Description"
                                          class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                <has-error :form="form" field="description"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" v-show="!editMode" class="btn btn-primary">Add New Job</button>
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
                jobs:{},
                form: new Form({
                    id: '',
                    title: '',
                    description: '',
                    company: '',
                    time_line: '',
                })
            }
        },
        methods:{
            addJob()
            {
                this.editMode = false;
                this.form.reset();
                $('#basicExampleModal').modal('show');
            },
            editJob(job)
            {
                this.form.reset();
                this.editMode = true;
                this.form.fill(job);
                $('#basicExampleModal').modal('show');
                $('#basicExampleModal').on('hidden.bs.modal', function () {
                    $('#basicExampleModal form')[0].reset();
                });
            },
            loadJob()
            {
                axios.get('api/job_details').then(({data})=>(this.jobs = data.data));
            },
            createJob()
            {
                this.$Progress.start();
                this.form.post('api/job_details').then(() => {
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
            updateJob()
            {
                this.$Progress.start();
                this.form.put('api/job_details/'+ this.form.id).then(()=>{
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
            deleteJob(id)
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
                        this.form.delete('api/job_details/'+id).then(() => {

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

        },
        created() {
            this.loadJob();
            Fire.$on('afterCreate',() => { this.loadJob()})
        }
    }
</script>
