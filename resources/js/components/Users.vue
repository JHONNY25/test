<template>
    <div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ title }}</div>

                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="exampleFormControlSelect1">Filtro por status</label>
                            <select class="form-control" id="status">
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </div>
                        
                        <Table :headers="headers" :data="users"></Table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    </div>
</template>

<script>
    import Table from './TableComponent.vue'
    import axios from 'axios'

    export default {
        components:{
            Table
        },
        data(){
            return{
                users:[],
                title: 'Test for Job',
                headers: ['#','Name','Email','Status']
            }
        },
        methods: {
            async getProducts(){
                let users = await axios.get('/get-users')

                this.users = await users.data
            },
        },
        created() {
            this.getProducts()
        },
    }
</script>
