<template>
    <section>
        <div class="container">
            <h1>I nostri post</h1>

            <div class="row row-cols-3">
                <div  v-for="post in posts" :key="post.id" class="col">
                    <div class="card my-2" >
                            <!-- <img src="..." class="card-img-top" alt="..."> -->
                            <div class="card-body">
                                <h5 class="card-title">{{post.title}}</h5>
                                <p class="card-text">{{post.content.substr(0, 50)}}</p>
                            </div>
                           <!--  <ul class="list-group list-group-flush">
                                <li class="list-group-item">An item</li>
                                
                            </ul> -->
                            <div class="card-body">
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                            </div>
                </div>
            </div>
        </div>  
    </section>
</template>

<script>
export default {
    name: 'Posts',
    data: function(){
        return{
            posts: []
        };
    },
    methods: {
        getPosts: function(){
            axios.get('/api/posts')
            .then((response) =>{
                this.posts = response.data.results;
            });
        }
    },
    created: function(){
        this.getPosts();
    }   
}
</script>