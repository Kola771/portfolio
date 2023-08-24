<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from "vue";
import axios from "axios";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12 content">
            <div class="mt-12 max-w-[60%] mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="flex flex-wrap -mx-2">
                        <div class="w-full lg:w-1/3 p-2">
                            <div
                                class="flex items-center flex-row w-full bg-gradient-to-r dark:from-[#FFA500] dark:to-blue-500 from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                                <div
                                    class="flex text-indigo-500 dark:text-white items-center justify-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        strokeWidth={1.5} stroke="currentColor"
                                        class="object-scale-down transition duration-500">
                                        <path strokeLinecap="round" strokeLinejoin="round"
                                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                                    <div class="text-xs whitespace-nowrap">
                                        Total Projet
                                    </div>
                                    <div>
                                        {{ allProject.length }}
                                    </div>
                                </div>
                                <div class=" flex items-center flex-none text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        strokeWidth={1.5} stroke="currentColor" class="w-6 h-6">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/3 p-2 ">
                            <div
                                class="flex items-center flex-row w-full bg-gradient-to-r dark:from-[#FFA500] dark:to-blue-500 from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                                <div
                                    class="flex text-indigo-500 dark:text-white justify-center items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.068.157 2.148.279 3.238.364.466.037.893.281 1.153.671L12 21l2.652-3.978c.26-.39.687-.634 1.153-.67 1.09-.086 2.17-.208 3.238-.365 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                                    <div class="text-xs whitespace-nowrap">
                                        Total Sms
                                    </div>
                                    <div>
                                        500
                                    </div>
                                </div>
                                <div class=" flex items-center flex-none text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        strokeWidth={1.5} stroke="currentColor" class="w-6 h-6">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>

                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 lg:w-1/3 p-2 ">
                            <div
                                class="flex items-center flex-row w-full bg-gradient-to-r dark:from-[#FFA500] dark:to-blue-500 from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                                <div
                                    class="flex text-indigo-500 dark:text-white justify-center items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        strokeWidth={1.5} stroke="currentColor"
                                        class="object-scale-down transition duration-500">
                                        <path strokeLinecap="round" strokeLinejoin="round"
                                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                                    <div class="text-xs whitespace-nowrap">
                                        Bibliographie
                                    </div>
                                    <div>
                                        <Link :href="route('bibliographie.editBibliography')">Changer sa bibliographie</Link>
                                    </div>
                                </div>
                                <div class=" flex items-center flex-none text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        strokeWidth={1.5} stroke="currentColor" class="w-6 h-6">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="w-full">
                        <div class="flex items-center mt-4 md:mt-0 gap-x-4">
                            <span class="absolute">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </span>

                            <input type="text" placeholder="Recherchez un projet" v-model="inputValue" @input="search(inputValue)"
                                class="block basis-[85%] py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                            <Link :href="route('addVue')" class="text-center bg-[#FFA500] p-1.5 text-white basis-[14%] rounded">Ajouter un projet</Link>
                        </div>
                    </div>
                    <div class="flex flex-col mt-6">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-x-auto max-h-[600px] border border-gray-200 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50 sticky top-0">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">
                                                    <button class="flex items-center gap-x-3 focus:outline-none">
                                                        <span>Images</span>

                                                    </button>
                                                </th>
                                                <th scope="col"
                                                    class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500">
                                                    <button class="flex items-center gap-x-3 focus:outline-none">
                                                        <span>Projets</span>
                                                    </button>
                                                </th>
                                                <th scope="col"
                                                    class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                                    Postes
                                                </th>
                                                <th scope="col"
                                                    class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500">
                                                    Actions
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="projet in allProject" :key="projet.id">
                                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                                    <div class="w-10 h-10 flex">
                                                        <img v-bind:src="`/storage/projetImage/${projet.image}`"
                                                            alt="profile"
                                                            class="shadow rounded-full object-cover border-[3px] border-blue-600" />
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div>
                                                        <h2 class="font-medium text-gray-800">
                                                            {{ projet.name_project }}
                                                        </h2>
                                                        <p class="text-sm font-normal text-gray-600">
                                                            Créé le {{ projet.created_at.split("T")[0] }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap">
                                                    <div
                                                        class="inline text-center text-sm font-normal text-gray-500 gap-x-2">
                                                        {{ projet.poste }}
                                                    </div>
                                                </td>
                                                <td class="px-4 py-4 text-sm whitespace-nowrap text-white">
                                                    <div class="flex items-center space-x-4 text-sm">
                                                        <a href="#" class="flex items-center
                                                        justify-between px-2 py-2 text-sm font-medium leading-5
                                                        text-[#333] rounded-lg focus:outline-none
                                                        focus:shadow-outline-gray" aria-label="View"
                                                            @click.prevent="editProjet(projet.id)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-4 h-4 text-green-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                            </svg>
                                                        </a>

                                                        <a href="#" class="flex items-center
                                                        justify-between px-2 py-2 text-sm font-medium leading-5
                                                        text-[#333] rounded-lg focus:outline-none
                                                        focus:shadow-outline-gray" aria-label="View"
                                                            @click.prevent="deleteShow(projet.id, projet.name_project, projet.image)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-5 h-5 text-red-600">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                        </a>

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
                class="w-96 md:w-auto bg-gray-800 relative flex flex-col justify-center items-center py-16 px-4 md:px-24 xl:py-24 xl:px-36">
                <div role="banner">
                    <img v-bind:src="`/storage/projetImage/${asset}`" alt="imageprojet"
                        class="rounded-full w-[220px] h-[220px] border-2">
                </div>
                <div class="mt-12">
                    <h3 role="main"
                        class="text-3xl text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-center">
                        {{ projet }}
                    </h3>
                </div>
                <div class="mt">
                    <p class="mt-6 sm:w-80 text-base text-white leading-7 text-center">Voulez-vous supprimer ce projet de
                        votre site !?</p>
                </div>
                <button @click="deleteProject(project_id)"
                    class="w-full text-gray-800 hover:bg-gray-100 bg-white sm:w-auto mt-14 text-base leading-4 text-center py-6 px-16 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 ">Oui...supprimer</button>
                <button @click="closeShow"
                    class="mt-6 text-white hover:border-white text-base leading-none focus:outline-none focus:border-gray-800 border-b border-transparent text-center">Non...</button>
                <button @click="closeShow"
                    class="text-gray-400 absolute top-8 right-8 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800"
                    aria-label="close">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 6L6 18" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6 6L18 18" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
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
            allProject: [],
            show: false,
            asset: "",
            projet: "",
            project_id: "",
            inputValue: "",
        };
    },
    mounted() {
        this.recupProjects();
    },
    methods: {
        search(valeur){
            axios.post(route('project.searchProject'), {
                value: valeur
            }).then(response => {
                this.allProject = response.data;
            })
        },

        closeShow() {
            this.show = false;
        },

        deleteShow(id, name, img) {
            this.show = true;
            this.project_id = id;
            this.projet = name;
            this.asset = img;
        },

        deleteProject(id) {
            axios.post(route("project.delete"), {
                id: id
            }).then(response => {
                if (response.data.result) {
                    this.allProject = response.data.allProject;
                    this.show = false;
                }
            })
        },

        editProjet(id) {
            window.location.href = `/project/edit/${id}`;
        },

        recupProjects() {
            axios.get(route("allProject")).then(response => {
                this.allProject = response.data;
            })
        }
    },
};
</script>