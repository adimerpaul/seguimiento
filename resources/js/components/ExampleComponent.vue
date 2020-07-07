<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Seguimientos</div>
                    <div class="card-body">
                        <div>
                            <div style="margin-bottom: 10px">
                                <el-row>
                                    <el-col :span="18">
                                        <input type="text" width="100" placeholder="Numero" v-model="seguimiento.numero">
                                        <input type="text" width="100" placeholder="Nombre Completo" v-model="seguimiento.nombre">
                                        <button class="btn btn-success p-0 pl-1 pr-1" @click="onCreate">create 1 row</button>
<!--                                        <el-button @click="onCreate100">create 100 row</el-button>-->
<!--                                        <el-button @click="bulkDelete">bulk delete</el-button>-->
                                    </el-col>

                                    <el-col :span="6">
                                        <el-input placeholder="search NO." v-model="filters[0].value"></el-input>
                                    </el-col>
                                </el-row>
                            </div>

                            <data-tables :data="data" :action-col="actionCol" :filters="filters" @selection-change="handleSelectionChange">
                                <el-table-column type="selection" width="55">
                                </el-table-column>

                                <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.prop" sortable="custom">
                                </el-table-column>
                            </data-tables>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<!--                        <table id="example" class="display" style="width:100%">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th>Name</th>-->
<!--                                <th>Position</th>-->
<!--                                <th>Office</th>-->
<!--                                <th>Age</th>-->
<!--                                <th>Start date</th>-->
<!--                                <th>Salary</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            <tr>-->
<!--                                <td>Tiger Nixon</td>-->
<!--                                <td>System Architect</td>-->
<!--                                <td>Edinburgh</td>-->
<!--                                <td>61</td>-->
<!--                                <td>2011/04/25</td>-->
<!--                                <td>$320,800</td>-->
<!--                            </tr>-->
<!--                            </tbody>-->
<!--                        </table>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import $ from 'jquery';
    export default {
        data() {
            return {
                seguimiento:{},
                data:[],
                titles : [
                 {
                    prop: "numero",
                    label: "Numero"
                },
                {
                    prop: "nombre",
                    label: "Nombre"
                },
                    //{
                //     prop: "content",
                //     label: "Content"
                // }, {
                //     prop: "flow_type",
                //     label: "Type"
                // }, {
                //     prop: "flow_type_code",
                //     label: "Type2"
                // }
                ],
                filters: [
                    {
                        value: '',
                        filterFn: (row, filter) => {
                            return Object.keys(row).some(prop => {
                                if (prop === 'date') {
                                    return this.getDate(row.date).indexOf(filter.value) > -1
                                } else {
                                    return row[prop].toString().toLowerCase().indexOf(filter.value.toLowerCase()) > -1
                                }
                            })
                        }
                    }
                ],
                actionCol: {
                    props: {
                        label: 'Opciones',
                        // label: 'A1545',
                    },
                    buttons: [{
                        props: {
                            type: 'success'
                        },
                        handler: row => {
                            console.log(row);
                            $('#exampleModal').modal('show');
                            // this.$message('Edit clicked')
                            // row.flow_no = 'hello word' + Math.random()
                            // row.content = Math.random() > 0.5 ? 'Water flood' : 'Lock broken'
                            // row.flow_type = Math.random() > 0.5 ? 'Repair' : 'Help'
                        },
                        label: 'Agregar'
                    },
                    // {
                    //     handler: row => {
                    //         console.log(row.id);
                    //         // this.data.splice(this.data.indexOf(row), 1)
                    //         // this.$message('delete success')
                    //     },
                    //     label: 'delete'
                    // }
                    ]
                },
                selectedRow: []
            }
        },
        mounted() {
           this.datos();
        },
        methods: {
            onCreate() {
                axios.post('/seguimiento',this.seguimiento).then(res=>{
                    // console.log(res);
                    this.$message('Guardado correctamente!!!');
                    this.seguimiento={};
                    this.datos();
                });
                // this.data.push({
                //     content: "new created"+ Math.floor(Math.random() * 100),
                //     flow_no: "FW201601010003" + Math.floor(Math.random() * 100),
                //     flow_type: "Help"+ Math.floor(Math.random() * 100),
                //     flow_type_code: "help"+ Math.floor(Math.random() * 100)
                // })
            },
            datos(){
                axios.get('/seguimiento').then(res=>{
                    this.data=res.data;
                })
            },
            onCreate100() {
                [...new Array(100)].map(_ => {
                    this.onCreate()
                })
            },
            handleSelectionChange(val) {
                this.selectedRow = val
            },
            bulkDelete() {
                this.selectedRow.map(row => {
                    this.data.splice(this.data.indexOf(row), 1)
                })
                this.$message('bulk delete success')
            }
        }
    }
</script>
