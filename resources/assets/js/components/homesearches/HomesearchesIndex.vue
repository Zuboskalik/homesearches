<template>    
    <div> 

        <div class="panel panel-default">
            <div class="panel-heading">Search by fields:</div>
            <div class="panel-body">
                <p><input type="text" v-model="searchFields.name" name = "name"> - name</p>
                <p><input type="number" v-model.number="searchFields.price.min" name = "pricemin"> - min price</p>
                <p><input type="number" v-model.number="searchFields.price.max" name = "pricemax"> - max price</p>
                <p><input type="number" v-model.number="searchFields.bathrooms" name = "bathrooms"> - bathrooms</p>
                <p><input type="number" v-model.number="searchFields.storeys" name = "storeys"> - storey</p>
                <p><input type="number" v-model.number="searchFields.garages" name = "garages"> - garages</p>
                
            </div>
        </div>
        <div v-if="searchNow == true" class="panel-body">Loading...</div>
        <div v-else class="panel-body">
            <table v-if="homesearches.length > 0" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Bedrooms</th>
                    <th>Bathrooms</th>
                    <th>Storeys</th>
                    <th>Garages</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="homesearch in homesearches" v-bind:key="homesearch.id">
                    <td>{{ homesearch.name }}</td>
                    <td>{{ homesearch.price }}</td>
                    <td>{{ homesearch.bedrooms }}</td>
                    <td>{{ homesearch.bathrooms }}</td>
                    <td>{{ homesearch.storeys }}</td>
                    <td>{{ homesearch.garages }}</td>
                </tr>
                </tbody>
            </table>
            <div v-else>
                No results found...
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {                
                searchFields : {
                    name : "",
                    bedrooms : "",
                    bathrooms : "",
                    storeys : "",
                    garages : "",
                    price : {
                        min : "", 
                        max : ""
                    },
                },
                homesearches : [],
                searchNow : false
            }
        },

        watch: {            
            searchFields: {
                handler(val) {
                    this.searchName();
                },
                deep: true
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
                app.searchNow = true;      
                axios.get('/api/v1/search', { params: { searchFields : this.searchFields } })
                    .then(function (resp) {
                    app.searchNow = false;
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