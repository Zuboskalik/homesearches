<template>    
    <div> 

        <div class="panel panel-default">
            <div class="panel-heading">Search by fields:</div>
            <div class="panel-body">
                <p><el-input placeholder = "Name" type = "text" v-model = "searchFields.name" name = "name"></el-input></p>
                <p><el-input-number type = "number" v-model.number = "searchFields.price.min" name = "pricemin" :step = "10000"></el-input-number> Min price</p>
                <p><el-input-number type = "number" v-model.number = "searchFields.price.max" name = "pricemax" :step = "10000"></el-input-number> Max price</p>
                <p><el-input-number type = "number" v-model.number = "searchFields.bedrooms" name = "bedrooms"></el-input-number> Bedrooms</p>
                <p><el-input-number type = "number" v-model.number = "searchFields.bathrooms" name = "bathrooms"></el-input-number> Bathrooms</p>
                <p><el-input-number type = "number" v-model.number = "searchFields.storeys" name = "storeys"></el-input-number> Storeys</p>
                <p><el-input-number type = "number" v-model.number = "searchFields.garages" name = "garages"></el-input-number> Garages</p>
                
            </div>
        </div>
        <div v-if = "searchNow == true" class="panel-body">Loading...</div>
        <div v-else class="panel-body">
            <table v-if = "homesearches.length > 0" class = "table table-bordered table-striped">
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
             Total: {{totalCount}}

              <div class="centered">
                
                <paginate
                :page-count="pageCount"
                :margin-pages="2"
                :page-range="4"
                :initial-page="0"
                :container-class="'pagination'"
                :click-handler="fetch"
                :prev-text="'Prev'"
                :next-text="'Next'"
                ></paginate>
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
                page: 1,
                pageCount: 1,
                homesearches : [],
                totalCount : 0,
                searchNow : false
            }
        },

        watch: {            
            searchFields: {
                handler(val) {
                    this.searchHomes();
                },
                deep: true
            }
        },
        
        mounted() {
            axios.get('/api/v1/homesearches?page=' + this.page)
                .then((resp) => {
                    this.homesearches = resp.data.data;
                    this.pageCount = resp.data.last_page;
                    this.totalCount = resp.data.total;
                })
                .catch(function (resp) {
                    alert("Could not load homesearches");
                });
        },

        methods: {     
            fetch(page) {
                axios.get('/api/v1/homesearches?page=' + page)
                    .then((resp) => {
                        this.homesearches = resp.data.data;
                        this.pageCount = resp.data.last_page;
                        this.totalCount = resp.data.total;
                    })
            }, 
            searchHomes() {
                app.searchNow = true;      
                axios.get('/api/v1/search?page=', { params: { searchFields : this.searchFields } })
                    .then((resp) => {
                        this.homesearches = resp.data.data;
                        this.pageCount = resp.data.last_page;
                        this.totalCount = resp.data.total;
                    })
                    .catch((resp) => {
                        alert("Could not load search data");
                    })
                    .finally((resp) => {
                        this.searchNow = false;
                    });
            },
        }
            
    }
</script>