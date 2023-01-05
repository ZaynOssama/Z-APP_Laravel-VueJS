<template>
    <table id="example" class="table table-striped table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Assigned To</th>
                <th>Data Create</th>
                <th>Data Update</th>
                <th>
                    <div class="ms-3 text-center">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="me-2 btn btn-outline-primary" @click="openNewTask">
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
            <tr v-for="task in tasks" :key="task.id">
                    <td>{{task.title}}</td>
                    <td>{{task.description}}</td>
                    <td>{{task.name}}</td>
                    <td>{{task.created_at}}</td>
                    <td>{{task.updated_at}}</td>
                    <td>
                        <div class="text-center">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#createModal" class="me-2 btn btn-outline-success" @click="openEditTask(task)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="button" class="btn btn-outline-danger" @click="openDeleteTask(task)"><i class="fa-solid fa-trash"></i></button>
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
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Title" required v-model="dataTask.title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" placeholder="Get up early" required v-model="dataTask.description">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label">Assigned To</label>
                                <select v-model="dataTask.user_id">
                                <option disabled value="">Please select one</option>
                                    <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary" @click.prevent="createTask" v-if="btnCreate">Create task</button>
                <button type="submit" class="btn btn-outline-primary" @click.prevent="editTask" v-if="btnEdit">Edit task</button>
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
            this.getTasks()
            this.getUsers()
        },
        data() {
            return {
                users: [],
                tasks: [],
                dataTask: {title: '', description: '', user_id: ''},
                title: '',
                modalShow: true,
                btnCreate: false,
                btnEdit: false,
                idTask: '',
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
            // getTasks() {
            //     axios.get('users-data').then(res => {
            //         $('#example').DataTable( {
            //             data: res.data,
            //             columns: [
            //                 { data: 'title' },
            //                 { data: 'description' },
            //                 { data: '' },
            //                 { data: 'created_at' },
            //                 { data: 'updated_at' }
            //             ]
            //         } );
            //     });
            // }
            getTasks() {
                axios.get('tasks-data').then(res => {
                    this.tasks = res.data;
                    $('#example').DataTable().destroy();
                    this.tabla()
                });
            },
            getUsers() {
                axios.get('users-data').then(res => {
                    this.users = res.data;
                });
            },
            createTask() {
                axios.post('new-task', this.dataTask).then(res => {
                    this.dataTask ={title: '', description: '', user_id: ''}
                    this.getTasks()
                    this.modalShow = false
                    swal("Created!", "A new task has been created!", "success");
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }).catch(function (error) {
                    swal("Sorry!", "Something went wrong!", "danger");
                });
            },
            openNewTask() {
                this.title = 'New User'
                this.btnCreate = true
                this.btnEdit = false
                this.dataTask ={title: '', description: '', user_id: ''}
            },
            openEditTask(task_data) {
                this.dataTask ={title: task_data.title, description: task_data.description, user_id: task_data.user_id}
                this.title = 'Edit User'
                this.btnCreate = false
                this.btnEdit = true
                this.idTask = task_data.id
            },
            editTask() {
                axios.put('edit-task/'+this.idTask, this.dataTask).then(res => {
                    this.idTask = ''
                    this.getTasks()
                    this.modalShow = false
                    swal("Edited!", "The task "+ this.dataTask.title +" has been edited!", "success");
                    setTimeout(function(){
                        location.reload();
                    }, 2000);
                }).catch(function (error) {
                    swal("Sorry!", "Something went wrong!", "danger");
                });
            },
            openDeleteTask(task_data) {
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover the task "+ task_data.title +" !",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete('delete-task/'+task_data.id).then(res => {
                            this.getTasks()
                            swal("Poof! This task has been deleted!", {
                            icon: "success",
                            });
                        }).catch(function (error) {
                            swal("Sorry!", "Something went wrong!", "danger");
                        });
                    } else {
                        swal("The task "+ task_data.title +" is safe!");
                    }
                });
            },
        }
    }
</script>
