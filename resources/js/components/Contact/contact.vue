<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Messages List</h3>

                        <div class="card-tools">
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Title</th>
                                <th>Mobile</th>
                                <th>Message</th>
                                <th>Reason</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center" v-for="contact in contacts" :key="contact.id">
                                <td>{{ contact.name }}</td>
                                <td>{{ contact.email }}</td>
                                <td>{{ contact.title }}</td>
                                <td>{{ contact.mobile }}</td>
                                <td>{{ contact.message }}</td>

                                <td>

                                    <a href="#?" @click="deleteMessage(contact.id)">
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


    </div>
</template>

<script>
    export default {
        data()
        {
            return {
                editMode: false,
                contacts:{},
                form: new Form({
                    id: '',
                    title: '',
                    message: '',
                    name: '',
                    email: '',
                    mobile: '',
                })
            }
        },
        methods:{

            loadJob()
            {
                axios.get('api/contacts').then(({data})=>(this.contacts = data.data));
            },

            deleteMessage(id)
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
                        this.form.delete('api/contacts/'+id).then(() => {

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
