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
                                     <td>{{ post.title }}</td>
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
                  posts: []
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
