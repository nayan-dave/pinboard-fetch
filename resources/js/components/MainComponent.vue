<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3 m-auto mt-4">
                <div class="list-group">
                    <h4>Tags</h4>
                    <div class="list-group-item" v-for="tag in tags" :key="tag.tag">
                        <label>
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                @click="selectedTags($event)" 
                                :id="tag.tag"
                                :checked="tag.checked"
                            >
                            {{tag.title}}
                        </label>
                    </div>
                    <button type="button" class="btn btn-light mt-4" @click="getItems()">Apply Filters</button>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4" v-for="item in items">
                        <div class="card border-primary h-100">
                            <div class="card-header">
                                <a :href="item.url">
                                    <span class="text-primary">{{item.title}}</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <p class="card-text" :class="{'text-success': item.live, 'text-danger': !item.live }">{{item.live?'Live':'Not Live'}}</p>
                                <p class="card-text">{{item.description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: 'pinboard',
        data() {
            return {
                items: Array,
                select_tags: [],
                tags: [
                    {'tag':"laravel",'title':"Laravel","checked":false},
                    {'tag':"vue",'title':"Vue","checked":false},
                    {'tag':"vue.js",'title':"Vue.js","checked":false},
                    {'tag':"php",'title':"PHP","checked":false},
                    {'tag':"api",'title':"API","checked":false}
                ],
            }
        },
        methods: {
            getItems: function() {
                const url = 'http://127.0.0.1:8000/api';
                axios.get('/api/items',{params: this.select_tags}).then(response =>{
                    this.items = response.data
                    console.log(response);
                    console.log(this.products);
                });
            },
            selectedTags(event){
                console.log(event.target);
                console.log(event.target.checked);
                console.log(event.target.id);
                if(event.target.checked){
                    this.select_tags.push(event.target.id);
                }
                else{
                    const tag = event.target.id;
                    for(let data of this.select_tags){
                        if(data === tag){
                            const index = this.select_tags.indexOf(data);
                            this.select_tags.splice(index, 1);
                        }
                    }
                }
            },
        },
        mounted() {
            //this.getItems();
            console.log('Component mounted.')
        }
    }
</script>
