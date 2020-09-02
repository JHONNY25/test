<template>
<div>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col" v-for="item in headers" :key="item">{{ item }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item,index) in data" :key="index">
                <th scope="row">{{ item.id }}</th>
                <td>{{ item.name }}</td>
                <td>{{ item.email }}</td>
                <td>{{ item.status === 1 ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <div class="custom-control custom-switch">
                        <input v-model="status" type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Inactivo/Activo</label>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
export default {
    data() {
        return {
            status: 0
        }
    },
    props: ['data', 'headers'],
    methods: {
        changeStatus(item) {
            let users = await axios.post('/update-status', item)

            this.users = await users.data
        },
    }
}
</script>
