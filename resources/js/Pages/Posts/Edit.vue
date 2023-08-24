<script setup>
import { useForm } from "@inertiajs/vue3";
// import inertia
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

// Prendi i dati del post dal prop
const props = defineProps({
    post: Object,
});

// Crea un'istanza del form con i dati del post
const form = useForm({
    title: props.post.title,
    description: props.post.description,
    image: null,
});

// Definisci la funzione di submit
const submit = () => {
    const data = new FormData();
    for(let key in form) {
        if(key === 'image' && form[key] instanceof File) {
            data.append(key, form[key], form[key].name);
        } else {
            data.append(key, form[key]);
        }
    }
    
    Inertia.post(route("posts.update", props.post.id), data, {
        _method: 'PUT',
        preserveScroll: true,
        onSuccess: () => form.reset("image"),
    });
};



const handleFileChange = (event) => {
    form.image = event.target.files[0];
    console.log(form.image); // log per verificare il file caricato
};
</script>

<template>
    <AppLayout title="Edit Post">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Post
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
                            <img
                                v-if="!form.image && props.post.image"
                                :src="`/images/${props.post.image}`"
                                alt="Current image"
                            />
                        </div>

                        <div class="mt-4">
                            <button
                                class="bg-emerald-500 hover:bg-gray-800 duration-200 text-white p-4"
                                type="submit"
                            >
                                Aggiorna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
