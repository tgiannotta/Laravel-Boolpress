<template>
    <section>
        <div class="container">
            <h1>{{ post_details.title }}</h1>

            <div v-if="post_details.category">Category: {{ post_details.category.name }}</div>

            <div>
                <router-link class="badge bg-info text-dark mx-1" v-for="tag in post_details.tags" :key="tag.id" :to="{name: 'tag-details', params: {slug: tag.slug}}" > {{tag.name}}  </router-link>
            </div>

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

