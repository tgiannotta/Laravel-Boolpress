<template>
    <section>
        <div class="container">
            <h1>I nostri post</h1>

            <div class="row row-cols-3">
                <div  v-for="post in posts" :key="post.id" class="col">
                    <div class="card my-2" >
                            
                            <div class="card-body">
                                <h5 class="card-title">{{post.title}}</h5>
                                <p class="card-text">{{post.content.substr(0, 50)}}</p>
                            </div>
                          
                            <div class="card-body">
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                            </div>
                </div>
            </div>
            <nav>
                <!-- Previous page -->
                <ul class="pagination">
                    <li class="page-item" :class="{ 'disabled': currentPage == 1 }">
                    <span @click="getPosts(currentPage - 1)" class="page-link">Previous</span>
                    </li>
                    <!-- Current page -->
                    <li v-for="n in lastPage" :key="n" class="page-item" :class="{ 'active': currentPage == n }">
                    <span @click="getPosts(n)" class="page-link">{{ n }}</span>
                    </li>
                    <!-- Next Page -->
                    <li class="page-item" :class="{ 'disabled': currentPage == lastPage }">
                    <span @click="getPosts(currentPage + 1)" class="page-link">Next</span>
                    </li>
                </ul>
            </nav>
        </div>  
    </section>
</template>

<script>
export default {
    name: 'Posts',
    data: function(){
        return{
            posts: [],
            currentPage: 1,
            lastaPage: 0
        };
    },
    methods: {
        getPosts(pageNumber){
            axios.get('/api/posts', {
                params: {
                    page: pageNumber
                }
            })
            .then((response) =>{
                this.posts = response.data.results.data;
                this.currentPage = response.data.results.current_page;
                this.lastPage = response.data.results.last_page;

            });
        }
    },
    created: function(){
        this.getPosts(1);
    }   
}
</script>