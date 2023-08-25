<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from "vue";
import axios from "axios";

const props = defineProps({
    allContacts: {
        type: Object,
        default: () => ({}),
    },
    options: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12 content">
            <div class="mt-12 max-w-[60%] mx-auto sm:px-6 lg:px-8 space-y-6">

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h2 class="text-[#333] font-bold text-[20px]">Liste des messages envoyés par les utilisateurs</h2>
                    <div class="flex flex-col mt-6">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-x-auto max-h-[650px] border-y border-gray-200 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-[#1E293B] sticky top-0">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-[#eee]">
                                                    <button class="flex items-center gap-x-3 focus:outline-none">
                                                        <span>Emetteur</span>
                                                    </button>
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-[#eee]">
                                                    <button class="flex items-center gap-x-3 focus:outline-none">
                                                        <span>Sujet</span>
                                                    </button>
                                                </th>
                                                <th scope="col"
                                                    class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-[#eee]">
                                                    Reçu
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="contact in allContacts" :key="contact.id"
                                                class="hover:bg-gray-300 cursor-pointer" @click="deleteShow(contact.id)">
                                                <td class="px-4 py-2 text-sm whitespace-nowrap flex gap-4 items-center">
                                                    <div
                                                        class="text-[#FFA500] w-[40px] h-[40px] bg-[#1E293B] rounded-full flex justify-center items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                                        </svg>
                                                    </div>
                                                    <div
                                                        class="inline text-center text-sm font-normal text-gray-600 gap-x-2">
                                                        {{ contact.flname }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-2 text-sm font-medium whitespace-nowrap">
                                                    <div
                                                        class="inline text-center text-sm font-normal text-gray-600 gap-x-2">
                                                        {{ contact.subject }}
                                                    </div>
                                                </td>
                                                <td class="px-12 py-2 text-sm font-medium whitespace-nowrap">
                                                    <div
                                                        class="inline text-center text-sm font-normal text-gray-600 gap-x-2">
                                                        Reçu le {{ contact.created_at.split("T")[0] }}
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative flex justify-center items-center" v-if="show == true" @click="closeShow">
            <div id="menu" class="w-full h-full bg-gray-900 bg-opacity-80 top-0 fixed sticky-0" @click="closeShow">
            </div>
        </div>
        <div v-if="show == true" class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
            <div
                class="w-96 md:w-[400px] bg-[#eee] relative flex flex-col justify-center items-center py-16 px-4 md:px-24 xl:py-4 xl:px-4 rounded-lg">
                <div class="flex justify-between w-full items-center">
                    <div class="flex items-center gap-4 w-full">
                        <div
                            class="text-[#FFA500] w-[40px] h-[40px] bg-[#1E293B] rounded-full flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-[#333] font-semibold leading-7 lg:leading-9 text-center">
                                {{ oneContact.flname }}
                            </h3>
                        </div>
                    </div>
                    <button @click="closeShow"
                        class="text-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 flex justify-center items-center"
                        aria-label="close">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 6L6 18" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M6 6L18 18" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="w-full mt-3 flex gap-2 flex-wrap bg-[#1E293B] p-2 rounded">
                    <p class="text-[#eee]">Objet :</p>
                    <p class="text-[#eee] uppercase">{{ oneContact.subject }}</p>
                </div>
                <div class="w-full mt-3 flex flex-wrap gap-2 bg-[#1E293B] p-2 rounded">
                    <p class="text-[#eee]">Adresse électronique :</p>
                    <p class="text-[#eee]">{{ oneContact.email }}</p>
                </div>
                <div class="w-full mt-6">
                    <p class="max-w-[80%] bg-[#FFA500] text-[#eee] p-3 rounded-lg">{{ oneContact.message }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
export default {
    props: {
        laravelVersion: String,
    },
    data() {
        return {
            show: false,
            oneContact: [],
        };
    },
    mounted() {
    },
    methods: {
        closeShow() {
            this.show = false;
        },

        deleteShow(id) {
            axios.post(route("oneContact"), {
                id: id
            }).then(response => {
                this.show = true;
                if (response.data.result) {
                    this.oneContact = response.data.result;
                }
            })
        },
    },
};
</script>