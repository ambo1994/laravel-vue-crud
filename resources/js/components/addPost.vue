<template>
       <div class="container">
            <div v-bind:class="{ succmsg: succmsg }">
                <div class="col-md-12 col-lg-12">
                    <div class="alert alert-success">Data inserted successfully</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 com-lg-7  offset-md-3">
                    <form method = "post" name="addpost" id="addpost" action="#" enctype="multipart/form-data" @submit.prevent="addPost">
                        <div class="form-group">
                            <label for="todo">To Do</label>
                            <input type="text" name="todo" id="todo" class="form-control" placeholder="Todo" v-model="post.todo"/>
                            {{ post.todo }}
                        </div>
                       <div class="form-group text-right">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
</div>
</template>
<script>
    
    export default {
        
        data() {
            return {
                post: {
                    'todo': '',
                },
                succmsg:  true,
            }
        },
        methods: {
            addPost() {
                this.$http.post(this.$apiURL + 'api/posts',{
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
                    });
            }
            
        },
        computed: {
}
    }
</script>
<style scoped>
    .succmsg {
        display: none;
    }
</style>