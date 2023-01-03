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
                    <button type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="ms-5 me-3 btn btn-outline-primary">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Name</label>
                                <input type="text" class="form-control" id="Input1" placeholder="name" required v-model="newUser.name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Email</label>
                                <input type="email" class="form-control" id="Input2" placeholder="name@example.com" required v-model="newUser.email">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                                <input type="email" class="form-control" id="Input3" placeholder="password" required v-model="newUser.password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-primary" @click.prevent="createUser">Create user</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <button type="button" class="btn btn-warning"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
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
                        <button type="button" class="ms-5 me-3 btn btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                    </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import $ from 'jquery'
import datatable from 'datatables.net-bs5'
import axios from 'axios';

    export default {
        mounted() {
            this.getUsers()
        },
        data() {
            return {
                users: [],
                newUser: {name: '', email: '', password: ''}
            }
        },
        methods: {
            tabla() {
                this.$nextTick(() => {
                    $('#example').DataTable();
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
                axios.post('new-user', this.newUser).then(res => {
                    this.getUsers()
                    $('#createModal').modal('hide')
                });
            }
        }
    }
</script>
