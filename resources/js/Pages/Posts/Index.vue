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
                <Link
                    :href="route('posts.create')"
                    class="bg-emerald-500 hover:bg-gray-800 duration-200 text-white p-4"
                    >Create New Post</Link
                >
                <div
                    class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8"
                >
                    <table
                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Post Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Post Title
                                </th>
                                <th scope="col" class="px-6 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="post in posts"
                                :key="post.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                            >
                                <td class="px-6 py-4">
                                    <img
                                        class="w-10 h-10 rounded-full"
                                        :src="'/images/' + post.image"
                                        alt="Post Image"
                                    />
                                </td>
                                <td
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    {{ post.title }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-4">
                                    <Link
                                        class="font-medium text-green-600 dark:text-green-500 hover:underline"
                                        :href="route('posts.show', post.id)"
                                        >View</Link
                                    >
                                    <a
                                        href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                        >Edit</a
                                    >
                                    <a
                                        href="#"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        >Delete</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
