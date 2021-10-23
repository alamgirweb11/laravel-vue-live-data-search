<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-sm-12">
                <div class="card mt-2">
                    <div class="card-header">Laravel Vue Real Time Data Search</div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                        <input type="text" class="form-control" v-model="search_title" placeholder="Type title" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                        </div>
                        </div>
                         <table class="table table-border">
                          <thead>
                              <tr>
                                  <th>Title</th>
                                  <th>Description</th>
                                  <th>Image</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="post in posts" :key="post.id">
                                     <td>{{ post.title.substr(0, 20) + '...' }}</td>
                                     <td>{{ post.description.substr(0, 30) + '...' }}</td>
                                     <td><img :src="post.image" :style="imageStyle" loading="lazy"></td>
                                     <td v-if="post.status===1">Published</td>
                                     <td v-else>Pending</td>
                              </tr>
                          </tbody>
                      </table>
                      <div v-if="!posts.length" :class="ErrorText">Search result not found!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
             return{
                  posts: [],
                  imageStyle:{
                       'height': 40 + 'px', 
                       'width': 40 + 'px', 
                  },
                  ErrorText:{
                       'text-center': true,
                       'text-danger': true,
                       'font-weight-bolder': true,
                  },
                  search_title: '',
                  search_result: '',
             }
        },

        mounted() {
              this.getAllPost();
        },
        methods: {
            // show all data in table
            getAllPost(){
                            let allPosts = this;
                            axios.get('/all-post')
                                .then(function (response) {
                                   allPosts.posts = response.data;
                                    // console.log(response.data);
                                })
                                .catch(function (error) {
                                    console.log(error);
                                })
                    
            },
            // search data by post title
            getSearchData(val){
                 let allPosts = this;
                  axios.get('/search', {
                        params: {
                        search: val
                        }
                    })
                    .then(function (response) {
                       allPosts.posts = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    })  
            }
        },
        watch:{
            // typing value count
            search_title:function(val){
                 this.getSearchData(val);
            }    
        }
    }
</script>
