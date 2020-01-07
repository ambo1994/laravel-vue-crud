<template>
    <div id="postsrec">
        
        <div class="row justify-content-center">
        <div v-bind:class="{ succmsg: succmsg }">
                <div class="col-md-12 col-lg-12">
                    <div class="alert alert-success cusmsg">{{ actionmsg }}</div>
                </div>
        </div>
        <div class="col-md-12">
           <!-- Button trigger modal -->
            
            <!-- Modal -->
            
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-bind:class="{ showmodal:showmodal }">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form method = "post" name="addpost" id="addpost" action="#" @submit.prevent="updatePost">
                        <div class="form-group">
                            <label for="todo">To Do</label>
                            <input type="text" name="todo" id="todo" class="form-control" placeholder="Todo" v-model="post.todo" />
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group">
                            <p>Are you sure want to delete the record? </p>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-success" v-on:click="hideModal()">Cancel</button>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-success" v-on:click="deletePost()">Ok</button>
                        </div>
                  </div>
                  
                </div>
              </div>
            </div>


            <div class="card">
                <div class="card-header">Posts List</div>
                <div class="card-body">
                    <table class="table table-striped" v-bind:pagenumber = "pagenumber">
                    <thead>
                      <tr>
                        <th scope="col">Todo</th>
                        <th scope="col" colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="post in laravelData.data" :key="post.id">
                        <th scope="row">{{ post.todo }}</th>
                        <td><a href="#" v-on:click="editPost(post.id)" data-target="#exampleModal"  data-toggle="modal" v-bind:todo="post.todo">Edit</a></td>
                        <td><a href="#" data-target="#exampleModal2" v-on:click="deleteId(post.id)"  data-toggle="modal" v-bind:id="id"  >Delete</a></td>
                      </tr>
                      
                    </tbody>
                  </table>
                  <pagination :data="laravelData" :limit="2" @pagination-change-page="postLists">
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                  </pagination>
                </div>
            </div>

        </div>
    </div>
    </div>
</template>


<script>
    
    export default {
        
        data() {
            return {
                post: {
                   "todo": '',
                },
                laravelData: {},
                id: '',
                succmsg:  true,
                showmodal: false,
                pagenumber: 1,
                actionmsg: '',
            }
        },
        methods: {
            postLists(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }
                this.$http.get(this.$apiURL + 'api/posts?page='+ page).then((response) => {
                    //this.posts = response.data.data;
                    this.laravelData = response.data;
                    this.pagenumber = page;
                    console.log(this.$apiURL);
            });
            },

            editPost(postid) {
                this.$http.get(this.$apiURL + 'api/posts/'+ postid).
                    then((data) => {
                        this.post.todo = data.data.data.todo;
                        this.id = postid;
                    });
            },

            updatePost() {
                   this.$http.put(this.$apiURL + 'api/posts/'+this.id,{
                        'todo': this.post.todo,
                    }).
                    then((data) => {
                        this.succmsg = false;
                        console.log(data);
                        this.post.todo = '';
                        var self = this;
                        setTimeout(function(){
                            self.succmsg = true;
                        },3000);
                        this.actionmsg = "Data updated successfully";
                        $('#exampleModal').modal('hide');
                    this.postLists(this.pagenumber);
                        
                    });
            },

            deleteId(postid) {
                    this.id = postid;
            },

            deletePost() {
                   this.$http.delete(this.$apiURL + 'api/posts/'+this.id).
                    then((data) => {
                        this.succmsg = false;;
                        var self = this;
                        setTimeout(function(){
                            self.succmsg = true;
                        },3000);
                         
                        this.actionmsg = "Data deleted successfully";
                        this.postLists(this.pagenumber);
                        $('#exampleModal2').modal('hide');
                        
                    });
            },

            hideModal() {
                $('#exampleModal2').modal('hide');
            }
            
        },
        mounted() {
            this.postLists();
        }
    }
</script>
<style scoped>
    .succmsg {
        display: none;
    }
    .showmodal {
        display: none !important;
        opacity: 0;
    }
</style>