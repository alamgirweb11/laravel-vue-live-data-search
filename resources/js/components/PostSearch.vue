<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-10 col-sm-12">
                <div class="card mt-2">
                    <div class="card-header">Laravel Vue Real Time Data Search</div>
                    <div class="card-body">
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
                  }
             }
        },

        mounted() {
              this.getAllPost();
        },
        methods: {
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
                    
            }
        },
    }
</script>
