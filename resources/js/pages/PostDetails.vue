<template>
    <section>
        <div class="container">
            <h1>{{ post_details.title }}</h1>

            <p>{{ post_details.content }}</p>

        </div>
        
    </section>
</template>


<script>
export default {
    name: 'PostDetails',
    data: function() {
        return {
            post_details: false
        };
    },
    methods: {
        getPost(){
            axios.get('/api/posts/' + this.$route.params.slug)
            .then((response) =>{
                this.post_details = response.data.results
            });
        }
    },
    created: function(){
        this.getPost();
    }
}
</script>