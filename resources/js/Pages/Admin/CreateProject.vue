<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import axios from "axios";

const form = useForm({
    nameProject: "",
    image: "",
    description: "",
    poste: "",
    url: "",
    frontend: "",
    backend: "",
});

let image = ref("image");
let result = ref(false);
let error = ref(false);
const submit = (image) => {
    let asset = images(image);
    let formData = new FormData();
    formData.append("fichier", asset[0]);
    formData.append("projet", form.nameProject);
    formData.append("description", form.description);
    formData.append("poste", form.poste);
    formData.append("url", form.url);
    formData.append("frontend", form.frontend);
    formData.append("backend", form.backend);
    axios.post(route("project.store"), formData, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    }).then(response => {
        if(response.data.result)
        {
            result.value = response.data.result;
            error.value = false;
        } else {
            error.value = response.data.error;
            result.value = false;
        }
    })
}

const images = (image) => {
    return image.files;
};
</script>

<template>
    <Head title="Ajout d'un nouveau projet" />

    <AuthenticatedLayout>
        <div class="py-12 content">
            <div class="mt-[50px] w-[80%] sm:w-[70%] md:w-[60%] lg:max-w-[35%] mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- component -->
                <div class='flex items-center justify-center from-teal-100 via-teal-300 to-teal-500'>
                    <div class='w-full px-10 py-8 bg-white rounded-lg shadow-xl'>
                        <div class='space-y-6'>
                            <p v-if="result" class="bg-[#519b5d] text-white p-1.5 opacity-85 rounded">{{ result }}</p>
                            <p v-if="error" class="bg-[#f00020] text-white p-1.5 opacity-80 rounded">{{ error }}</p>
                            <form @submit.prevent="submit(image)" enctype="multipart/form-data">
                                <h2 class="text-2xl font-bold ">Ajout d'un nouveau projet</h2>
                                <p class="my-4 opacity-70">Remplissez correctement ce formulaire !!!</p>
                                <hr class="my-6">
                                <label class="uppercase text-sm font-bold opacity-70" for="nameproject">Nom du projet
                                    :</label>
                                <input type="text"
                                    class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded border-2 border-slate-200 focus:border-slate-600 focus:outline-none"
                                    id="nameproject" v-model="form.nameProject" required>

                                <label class="uppercase text-sm font-bold opacity-70" for="description">Brève description
                                    :</label>
                                <textarea class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded resize-none" id="description"
                                    v-model="form.description" required></textarea>

                                <label class="uppercase text-sm font-bold opacity-70" for="poste">Poste occupé :</label>
                                <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" id="poste"
                                    v-model="form.poste" required>

                                <label class="uppercase text-sm font-bold opacity-70" for="url">L'url du site :</label>
                                <input type="text" class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" id="url"
                                    v-model="form.url" required>

                                <label class="uppercase text-sm font-bold opacity-70" for="frontend">Langage utilisé pour le
                                    frontend :</label>
                                <textarea class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded resize-none" id="frontend"
                                    v-model="form.frontend" required></textarea>

                                <label class="uppercase text-sm font-bold opacity-70" for="backend">Langage utilisé pour le
                                    backend :</label>
                                <textarea class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded resize-none" id="backend"
                                    v-model="form.backend" required></textarea>

                                <label for="file">Sélectionnez une image :</label>
                                <input type="file" name="file" id="file" ref="image" @change="images(image)"
                                    class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" required />

                                <input type="submit"
                                    class="py-3 px-6 my-2 bg-[#FFA500] text-white font-medium rounded hover:bg-[#333] cursor-pointer ease-in-out duration-300"
                                    value="Ajouter">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>