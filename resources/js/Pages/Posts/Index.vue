<script setup>
import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <AppLayout title="Posts">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link :href="route('posts.create')" class="bg-emerald-500 hover:bg-gray-800 duration-200 text-white p-4">Create New Post</Link>
                <ul class="mt-8">
                    <li v-for="post in posts" :key="post.id">
                        <Link :href="route('posts.show', post.id)">{{
                            post.title
                        }}</Link>
                    </li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>

<script>
export default {
    props: {
        posts: Array,
    },
};
</script>
