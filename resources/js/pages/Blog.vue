<template>
    <section>
        <div class="container">
            <Posts />
        </div>
    </section>
</template>

<script>
import Posts from '../components/Posts.vue'
export default {
    name: 'Blog',
    components: {
        Posts
    }
}
</script>