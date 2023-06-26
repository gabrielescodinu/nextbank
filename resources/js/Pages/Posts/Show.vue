<script setup>
import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

</script>

<template>
    <AppLayout :title="post.title">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ post.title }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link :href="route('posts.index')" class="bg-indigo-500 hover:bg-gray-800 duration-200 text-white p-4">Back to Posts</Link>
                <div class="mt-8">
                    <p>{{ post.description }}</p>
                </div>
            </div>
        </div>
    </AppLayout>

</template>

<script>
export default {
    props: {
        post: Object,
    },
}
</script>
