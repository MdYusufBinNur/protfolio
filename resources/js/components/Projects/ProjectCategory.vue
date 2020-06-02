<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Project Categories</h3>

                        <div class="card-tools">
                            <button class="btn-success"  @click="addCategory"> Add New <i class="fas fa-user-plus fa-fw"> </i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>

                                <th>Reason</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="category in categories" :key="category.id">
                                <td>{{ category.id }}</td>
                                <td>{{ category.name }}</td>

                                <td>
                                    <a href="#?">
                                        <i class="fas fa-user-edit green" @click="editCategory(category)"></i>
                                    </a>
                                    /
                                    <a href="#?" @click="deleteCategory(category.id)">
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
                        <h5 class="modal-title" v-show="!editMode" id="exampleModalLabel">Add New Category</h5>
                        <h5 class="modal-title" v-show="editMode" id="">Update Category Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode ? updateCategory() : createCategory()">
                        <div class="modal-body">
                            <div class="md-form form-sm m-2">

                                <input v-model="form.name" type="text" name="name" id="name" placeholder="Name"
                                       class="form-control form-control-sm" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" v-show="!editMode" class="btn btn-primary">Add New Category</button>
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
                categories:{},
                form: new Form({
                    id: '',
                    name: '',
                })
            }
        },
        methods:{

            loadCategories()
            {
                axios.get('api/project_categories').then(({data})=>(this.categories = data.data));
            },
            editCategory(category)
            {
                this.form.reset();
                this.editMode = true;
                this.form.fill(category);
                $('#basicExampleModal').modal('show');
                $('#basicExampleModal').on('hidden.bs.modal', function () {
                    $('#basicExampleModal form')[0].reset();
                });

            },
            deleteCategory(category)
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
                        this.form.delete('api/project_categories/'+category).then(() => {

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
            addCategory()
            {
                this.editMode = false;
                this.form.reset();
                $('#basicExampleModal').modal('show');
            },
            createCategory()
            {
                this.$Progress.start();
                this.form.post('api/project_categories').then(() => {
                    Fire.$emit('afterCreate');
                    toast.fire({
                        icon: 'success',
                        title: 'Successfully New Category Added'
                    });
                    $('#basicExampleModal').modal('hide');
                    this.form.reset();
                    Fire.$emit('afterCreate');
                    this.$Progress.finish()
                }).catch(()=>{
                    toast.fire({
                        icon: 'error',
                        title: 'Failed To Add New Category'
                    });
                    this.$Progress.fail()
                });
            },
            updateCategory()
            {
                this.$Progress.start();
                this.form.put('api/project_categories/'+ this.form.id).then(()=>{
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
            }

        },
        created() {
            this.loadCategories();
            Fire.$on('afterCreate',() => { this.loadCategories()})
        }
    }
</script>
