<template>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Data Create</th>
                <th>Data Update</th>
                <th>
                    <div class="ms-3 text-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="me-2 btn btn-outline-primary" @click="opendataUser">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-warning"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
            </svg>
            <tr v-for="user in users" :key="user.id">
                    <td>{{user.name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.role}}</td>
                    <td>{{user.created_at}}</td>
                    <td>{{user.updated_at}}</td>
                    <td>
                        <div class="text-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="me-2 btn btn-outline-success" @click="openEditUser(user)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-outline-danger" @click="openDeleteUser(user)"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
            </tr>
        </tbody>
    </table>
    <!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" v-if="modalShow" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{title}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form>
            <div class="modal-body">
                <div class="container">
                    <div class="row align-items-start">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Name" required v-model="dataUser.name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="name@example.com" required v-model="dataUser.email">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" v-model="dataUser.password">
                            </div>
                            <div class="mb-3 btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="admin" v-model="dataUser.role">
                                <label class="btn btn-outline-primary" for="btnradio1">Admin</label>

                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="customer" v-model="dataUser.role">
                                <label class="btn btn-outline-primary" for="btnradio2">Customer</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary" @click.prevent="createUser" v-if="btnCreate">Create user</button>
                <button type="submit" class="btn btn-outline-primary" @click.prevent="editUser" v-if="btnEdit">Edit user</button>
            </div>
        </form>
    </div>
  </div>
</div>
</template>

<script>
import $ from 'jquery/dist/jquery.js'
import datatable from 'datatables.net-bs5'
import axios from 'axios';
import swal from 'sweetalert';

    export default {
        mounted() {
            this.getUsers()
        },
        data() {
            return {
                users: [],
                roleUser: 'customer',
                dataUser: {name: '', email: '', password: '', role: this.roleUser},
                title: '',
                modalShow: true,
                btnCreate: false,
                btnEdit: false,
                idUser: '',
            }
        },
        methods: {
            tabla() {
                this.$nextTick(() => {
                    $('#example').dataTable( {
                        "order": [[ 0, 'asc' ]]
                    } );
                });
            },
            // getUsers() {
            //     axios.get('users-data').then(res => {
            //         $('#example').DataTable( {
            //             data: res.data,
            //             columns: [
            //                 { data: 'name' },
            //                 { data: 'email' },
            //                 { data: 'role' },
            //                 { data: 'created_at' },
            //                 { data: 'updated_at' }
            //             ]
            //         } );
            //     });
            // }
            getUsers() {
                axios.get('users-data').then(res => {
                    this.users = res.data;
                    $('#example').DataTable().destroy();
                    this.tabla()
                });
            },
            createUser() {
                axios.post('new-user', this.dataUser).then(res => {
                    this.dataUser ={name: '', email: '', password: '', role: ''}
                    this.getUsers()
                    this.modalShow = false
                    swal("Created!", "A new user has been created!", "success");
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }).catch(function (error) {
                    swal("Sorry!", "Something went wrong!", "danger");
                });
            },
            opendataUser() {
                this.title = 'New User'
                this.btnCreate = true
                this.btnEdit = false
                this.dataUser ={name: '', email: '', password: '', role: ''}
            },
            openEditUser(user_data) {
                this.dataUser ={name: user_data.name, email: user_data.email, role: user_data.role}
                this.title = 'Edit User'
                this.btnCreate = false
                this.btnEdit = true
                this.idUser = user_data.id
            },
            editUser() {
                axios.put('edit-user/'+this.idUser, this.dataUser).then(res => {
                    this.idUser = ''
                    this.getUsers()
                    this.modalShow = false
                    swal("Edited!", "The user "+ this.dataUser.name +" has been edited!", "success");
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }).catch(function (error) {
                    swal("Sorry!", "Something went wrong!", "danger");
                });
            },
            openDeleteUser(user_data) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover the user "+ user_data.name +" !",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete('delete-user/'+user_data.id).then(res => {
                            this.getUsers()
                            swal("Poof! This user has been deleted!", {
                            icon: "success",
                            });
                        }).catch(function (error) {
                            swal("Sorry!", "Something went wrong!", "danger");
                        });
                    } else {
                        swal("The user "+ user_data.name +" is safe!");
                    }
                });
            },
        }
    }
</script>
