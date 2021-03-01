<template>    
    <div> 

        <div class="panel panel-default">
            <div class="panel-heading">Homes list</div>
            <div class="panel-body">
                
                <input type="text" v-model="keywords">
                
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Bedrooms</th>
                        <th>Storeys</th>
                        <th>Garages</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="homesearch in homesearches" v-bind:key="homesearch.id">
                        <td>{{ homesearch.name }}</td>
                        <td>{{ homesearch.price }}</td>
                        <td>{{ homesearch.bedrooms }}</td>
                        <td>{{ homesearch.storeys }}</td>
                        <td>{{ homesearch.garages }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {                
                keywords: null,
                homesearches: []
            }
        },

        watch: {
            keywords(after, before) {
                this.searchName();
            }
        },
        
        mounted() {
            var app = this;
            axios.get('/api/v1/homesearches')
                .then(function (resp) {
                    app.homesearches = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load homesearches");
                });
        },

        methods: {      
            searchName() {
                var app = this;      
                axios.get('/api/v1/search', { params: { keywords: this.keywords } })
                    .then(function (resp) {
                        app.homesearches = resp.data;
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not load search data");
                    });
            },
        }
            
    }
</script>