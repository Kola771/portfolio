<script setup>
import Header from '../Components/Home/Navbar.vue'
import Footer from '../Components/Home/Footer.vue'
import { Head, useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import axios from "axios";

const form = useForm({
    flname: "",
    email: "",
    subject: "",
    message: "",
});

let result = ref(false);
let error = ref(false);
const sendData = () => {
    axios.post(route("addContact"), {
        formulaire: form
    }).then(response => {
        if (response.data.result) {
            result.value = response.data.result;
            error.value = false;
            setTimeout(() => {
                result.value = ''
                window.location.href = "/"
            }, 1500)
        } else {
            error.value = response.data.error;
            result.value = false;
            setTimeout(() => {
                error.value = ''
                window.location.href = "/"
            }, 1500)
        }
    })
}
</script>

<template>
    <Head title="Prendre contact" />
    <Header></Header>
    <div class="h-[680px] bg-[url('/storage/myassets/contact.jpg')] bg-no-repeat bg-cover relative flex flex-col">
        <div class="flex justify-center w-full mt-[10rem] text-white">
            <div class="w-[75rem] m-auto flex justify-center">
                <p class="text-[30px] mt-[130px] md:text-[40px] md:mt-[9rem] lg:mt-[170px] lg:text-[90px] font-normal font-thin text-gray-300 text-center uppercase leading-[96px]">
                    Prendre contact
                </p>
            </div>
        </div>
    </div>

    <main>
        <div class="w-[90%] lg:max-w-[80rem] m-auto my-[8rem]">
            <section class="flex flex-wrap justify-center items-center">
                <h2 class="basis-full md:basis-1/2 lg:basis-1/2 text-[1.8rem] md:text-[2.4rem] uppercase opacity-70">Entrons en communication ensemble !</h2>
                <div class="basis-full md:basis-1/2 lg:basis-1/2 mt-4 md:mt-0 md:border-l-[3px] md:p-4 text-[17px] text-justify md:pl-8 font-serif">
                    Si vous avez l'intention de prendre contact, je vous encourage à compléter le formulaire ci-dessous. Je m'engage à vous fournir une réponse rapide dès que possible.
                </div>
            </section>
        </div>
        <div class="bg-gray-100 w-full h-[750px] flex items-center justify-center">
            <div class="w-full py-8">
                <div
                    class="bg-white w-5/6 md:w-3/4 lg:w-2/3 xl:w-[500px] 2xl:w-[550px] mt-2 mx-auto px-16 py-8 rounded-lg shadow-2xl">
                            <p v-if="result" class="bg-[#519b5d] text-white p-1.5 opacity-85 rounded">{{ result }}</p>
                            <p v-if="error" class="bg-[#f00020] text-white p-1.5 opacity-80 rounded">{{ error }}</p>
                    <form class="my-8 text-sm" @submit.prevent="sendData">
                        <div class="flex flex-col my-4">
                            <label for="name" class="text-gray-700">Nom et Prénoms</label>
                            <input type="text" name="name" id="name" v-model="form.flname"
                                class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900"
                                placeholder="Votre nom et prénoms" required>
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="email" class="text-gray-700">Adresse Electronique</label>
                            <input type="email" name="email" id="email" v-model="form.email"
                                class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900"
                                placeholder="Votre email" required>
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="subject" class="text-gray-700">Sujet</label>
                            <input type="text" name="subject" id="subject" v-model="form.subject"
                                class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900"
                                placeholder="Sujet" required>
                        </div>

                        <div class="flex flex-col my-4">
                            <label for="message"
                                class="text-gray-700">Message</label>
                            <textarea id="message" rows="4" v-model="form.message"
                                class="mt-2 block p-2.5 w-full text-sm text-gray-900 focus:outline-none rounded border border-gray-300 focus:ring-0 focus:border-gray-300 resize-none"
                                placeholder="Votre message" required></textarea>
                        </div>

                        <div class="mt-8 flex items-center justify-end space-x-4">
                            <button
                                class="bg-blue-600 hover:bg-blue-700 px-4 py-3 text-gray-100 hover:shadow-xl transition duration-150 uppercase">Envoyer
                                votre message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <Footer></Footer>
</template>

<style></style>
<script>
export default {
    
    props: {
        laravelVersion: String,
    },
    data() {
        return {
        };
    },
    mounted() {
    },
    methods: {

    },
};
</script>