<script setup>
import Header from '../Components/Home/Navbar.vue'
import Footer from '../Components/Home/Footer.vue'
import { Head, Link } from '@inertiajs/vue3';
import axios from "axios";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Bienvenu(e) sur mon Portfolio" />
    <Header></Header>
    <div class="h-[1100px] bg-[url('/storage/myassets/six.jpg')] bg-no-repeat bg-cover relative flex flex-col">
        <div class="flex justify-center w-full mt-[10rem] text-white">
            <div class="w-[75rem] m-auto">
                <p
                    class="mt-[20rem] text-[90px] font-normal font-thin testDesc text-center uppercase leading-[96px] opacity-80">
                    Koladé ABOUDOU M.</p>
                <p class="mt-[5rem] flex justify-center animated-element lien-bi">
                    <a class="before:ease relative w-[15%] p-3 text-center text-[20px] rounded-full overflow-hidden border border-[#FFA500] bg-[#FFA500] text-white shadow-2xl transition-all before:absolute before:right-0 before:top-0 before:h-12 before:w-6 before:translate-x-12 before:rotate-6 before:bg-white before:opacity-10 before:duration-700 hover:shadow-[#FFA500] hover:before:-translate-x-40 flex justify-center items-center"
                        href="#bibliographie">Commencer
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                </p>
            </div>
        </div>
    </div>

    <main>
        <div class="my-[3rem] max-w-[80rem] p-6 m-auto flex gap-8" id="bibliographie">
            <div class="basis-1/2">
                <img v-bind:src="`/storage/myassets/${bibliography.image}`" alt="my_face" class="h-full">
            </div>
            <section class="basis-1/2 text-[#333] font-serif">
                <h2 class="font-bold text-[4rem]">Bibliographie</h2>
                <h3 class="text-[2rem] mt-3 mb-4 uppercase">Koladé ABOUDOU M.</h3>
                <p class="mt-4 text-justify" v-html="bibliography.bibliographie"></p>
                <p class="mt-4 text-justify">Ouvert à de nouvelles opportunités, n’hésitez pas à prendre contact avec moi
                    directement via le
                    <Link class="text-[#FFA500] hover:text-[#333]" :href="route('contacts')">formulaire de contact</Link> !
                </p>
                <p class="mt-4 flex justify-between">
                    <a class="bg-[#000000] text-white p-4 text-center basis-[40%] font-serif ease-in duration-300 hover:bg-[#FFA500]"
                        href="#projects">Mes projets</a>
                    <a class="bg-[#000000] text-white p-4 text-center basis-[40%] font-serif ease-in duration-300 hover:bg-[#FFA500]"
                        href="#">Mon CV</a>
                </p>
            </section>
        </div>
        <div class="my-[3rem] max-w-[80rem] p-6 m-auto flex gap-8" id="projects">
            <section>
                <h2 class="font-bold text-[3rem] mb-2">Mes projets</h2>
                <div class="flex gap-4 justify-center">
                    <a :href="`${projet.linkSite}`" target="blank" class="w-[400px] h-full relative lienSite" v-for="projet in allProject" :key="projet.id">
                        <figure class="h-[500px]">
                            <img class="h-full" :src="`/storage/projetImage/${projet.image}`" alt="my_project">
                            <figcaption class="caption">
                                <div class="max-w-[100%] my-10 mx-auto p-[2rem]">
                                    <h4 class="my-3 text-[22px] text-center">{{ projet.name_project }}</h4>
                                    <p class="my-4 text-justify">{{ projet.description }}</p>
                                    <p class="my-4 text-justify">Poste: {{ projet.poste }}</p>
                                    <div>Langages utilisés :
                                        <p class="mt-4">Pour le frontend: <span class="font-bold uppercase">{{ projet.frontend }}</span>
                                        </p>
                                        <p class="mt-4">Pour le backend: <span class="font-bold uppercase">{{ projet.backend }}</span></p>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div v-if="condition" class="flex justify-between items-center mt-12">
                    <div class="border-2 basis-1/3"></div>
                    <a class="basis-1/3 text-center border-4 rounded-full p-3 hover:bg-[#FFA500] hover:text-white ease-in duration-300 text-[20px]"
                        :href="route('projects')">
                        Voir plus
                    </a>
                    <div class="border-2 basis-1/3"></div>
                </div>
            </section>
        </div>
    </main>

    <Footer></Footer>
</template>

<style>
/* Styles de base */
.caption {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 500px;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    opacity: 0;
    transition: opacity 0.3s ease;
}

a:hover .caption {
    opacity: 1;
}

.animated-element {
    opacity: 0;
    transition: opacity 0.5s ease;
}

.fade-in {
    opacity: 1;
}
</style>
<script>
// import { defineProps } from 'vue';
// import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        laravelVersion: String,
    },
    data() {
        return {
            descr: [],
            condition: null,
            bibliography: [],
            allProject: [],
        };
    },
    mounted() {
        this.affiche();
        this.reloadPage();
        this.afficheBibliographie();
        this.recupProjects();
    },
    methods: {
        affiche() {
            if (document.querySelector(".testDesc")) {
                let testDesc = document.querySelector(".testDesc").textContent;
                document.querySelector(".testDesc").innerHTML = '';
                let index = 0;
                const intervalID = setInterval(function () {
                    if (index < testDesc.length) {
                        document.querySelector(".testDesc").innerHTML += testDesc.charAt(index);
                        index++;
                    } else {
                        document.querySelector(".lien-bi").classList.add("fade-in")
                        clearInterval(intervalID);
                    }
                }, 100);
            }
        },
        reloadPage() {
            let link = document.querySelectorAll(".lienSite");
            if (link.length == 3) {
                this.condition = true;
            }
        },

        afficheBibliographie() {
            axios.get(route('bibliographie.bibliography')).then(response => {
                this.bibliography = response.data;
            })
        },

        recupProjects() {
            axios.get(route("allProjectLimit")).then(response => {
                this.allProject = response.data;
            })
        }
    },
};
</script>