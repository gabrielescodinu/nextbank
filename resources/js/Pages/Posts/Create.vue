<script setup>
import { useForm } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

// Creare un istanza del form con le proprietà iniziali
const form = useForm({
    title: "",
    description: "",
    image: null,
});

// Definire la funzione di submit
const submit = () => {
    form.post(route("posts.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <AppLayout title="Create Post">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Post
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <Link
                    :href="route('posts.index')"
                    class="bg-indigo-500 hover:bg-gray-800 duration-200 text-white p-4"
                    >Back to Posts</Link
                >
                <div class="mt-8">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="title">Titolo</label>
                            <br />
                            <input
                                class="w-full outline-none border-none focus:border-indigo-500 border-2"
                                id="title"
                                v-model="form.title"
                                type="text"
                            />
                            <div v-if="form.errors.image" class="text-red-500">
                                {{ form.errors.image }}
                            </div>
                        </div>

                        <div>
                            <label for="description">Descrizione</label>
                            <br />
                            <textarea
                                class="w-full outline-none border-none focus:border-indigo-500 border-2"
                                id="description"
                                v-model="form.description"
                            ></textarea>
                        </div>

                        <div>
                            <label for="image">Immagine</label>
                            <br />
                            <input
                                class="w-full outline-none border-none focus:border-indigo-500 border-2"
                                id="image"
                                type="file"
                                @change="form.image = $event.target.files[0]"
                            />
                        </div>

                        <div class="mt-4">
                            <button
                                class="bg-emerald-500 hover:bg-gray-800 duration-200 text-white p-4"
                                type="submit"
                            >
                                Crea
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
