<template>
    <section>
        <div class="container">
            <h1>{{ post_details.title }}</h1>

            <div v-if="post_details.category">Category: {{ post_details.category.name }}</div>

            <div><span v-for="tag in post_details.tags" :key="tag.id" class="badge bg-primary mx-1">{{ tag.name }}</span></div>

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