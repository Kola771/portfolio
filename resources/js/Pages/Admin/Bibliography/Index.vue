<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import axios from "axios";

const props = defineProps({
    personnality: {
        type: Object,
        default: () => ({}),
    },
    options: {
        type: Object,
        default: () => ({}),
    },
});

let contenu = ref("");
contenu.value = props.personnality.bibliographie.replace(/<br\s*\/>/g, "");

const form = useForm({
    image: props.personnality.image,
    bibliographie: contenu,
});

let image = ref("image");
let result = ref(false);
let error = ref(false);
const submit = (image) => {
    let asset = images(image);
    let formData = new FormData();
    if (asset.length > 0) {
        formData.append("fichier", asset[0]);
    }
    formData.append("bibliographie", form.bibliographie);
    axios.post(route("bibliographie.update", `${props.personnality.id}`), formData, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    }).then(response => {
        if (response.data.result) {
            result.value = response.data.result;
            error.value = false;
            setTimeout(() => {
                result.value = ''
                Inertia.get(route('dashboard'))
            }, 1500)
        } else {
            error.value = response.data.error;
            result.value = false;
            setTimeout(() => {
                error.value = ''
                Inertia.get(route('dashboard'))
            }, 1500)
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
            <div class="mt-[50px] mx-auto sm:px-6 lg:px-8 space-y-6" style="width: 60%;">
                <!-- component -->
                <div class='flex items-center justify-center from-teal-100 via-teal-300 to-teal-500'>
                    <div class='w-full px-10 py-8 bg-white rounded-lg shadow-xl'>
                        <div class='space-y-6'>
                            <p v-if="result" class="bg-[#519b5d] text-white p-1.5 opacity-85 rounded">{{ result }}</p>
                            <p v-if="error" class="bg-[#f00020] text-white p-1.5 opacity-80 rounded">{{ error }}</p>
                            <form @submit.prevent="submit(image)" enctype="multipart/form-data" class="flex gap-8">
                                <div style="flex-basis: 58%;">
                                    <h2 class="text-2xl font-bold ">Modifier le contenu de votre bibliographie</h2>
                                    <p class="my-4 opacity-70">Remplissez correctement ce formulaire !!!</p>
                                    <hr class="my-3">
                                    
                                    <label class="uppercase text-sm font-bold opacity-70" for="bibliographie">Bibliographie
                                        :</label>
                                    <textarea class="p-3 mt-2 mb-2 w-full bg-slate-200 rounded resize-none h-[320px]" id="bibliographie"
                                        v-model="form.bibliographie" required>{{ form.bibliographie.replace("<br>", "") }}</textarea>
                                </div>

                                <div style="flex-basis: 42%">
                                    <div class="flex flex-col gap-4 mb-6 rounded p-2 shadow-2xl">
                                        <label>Image actuelle de votre bibliographie :</label>
                                        <img v-bind:src="`/storage/myassets/${form.image}`" class="w-full rounded"
                                            alt="imageBibliographie" style="height: 300px">
                                    </div>
                                    <label for="file">Sélectionnez une image :</label>
                                    <input type="file" name="file" id="file" ref="image" @change="images(image)"
                                        class="p-3 mt-2 mb-4 w-full bg-slate-200 rounded" />
                                    <div class="flex justify-end">
                                        <input type="submit"
                                            class="py-3 px-6 my-2 bg-[#FFA500] text-white font-medium rounded hover:bg-[#333] cursor-pointer ease-in-out duration-300"
                                            value="Modifier">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
