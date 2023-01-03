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
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="me-2 btn btn-outline-primary">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <create-user />
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
                            <button type="button" class="me-2 btn btn-outline-success"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </div>
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
