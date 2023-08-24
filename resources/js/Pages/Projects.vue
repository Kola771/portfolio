<script setup>
import Header from '../Components/Home/Navbar.vue'
import Footer from '../Components/Home/Footer.vue'
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    allProject: {
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
    <Head title="Mes différents projets" />
    <Header></Header>
    <div class="h-[680px] bg-[url('/storage/myassets/two.jpg')] bg-no-repeat bg-cover relative flex flex-col">
        <div class="flex justify-center w-full mt-[10rem] text-white">
            <div class="w-[75rem] m-auto flex justify-center">
                <p class="mt-[170px] text-[90px] font-normal font-thin testDesc text-center uppercase leading-[96px]">
                    Mes projets
                </p>
            </div>
        </div>
    </div>

    <main>
        <div>
            <div class="my-[2.5rem] max-w-[80rem] p-10 m-auto flex gap-8 img" v-for="projet in allProject" :key="projet.id">
                <div class="basis-2/5">
                    <img :src="`/storage/projetImage/${projet.image}`" alt="my_face"
                        class="h-full ease-in duration-300 hover:scale-105">
                </div>
                <section class="basis-1/2 text-[#333] font-serif">
                    <h2 class="font-bold text-[3rem]">{{ projet.name_project }}</h2>
                    <p class="my-4 text-justify">{{ projet.description }}</p>
                    <p class="my-4 text-justify"><span class="font-bold">Poste</span>: {{ projet.poste }}</p>
                    <div>Langages utilisés :
                        <p class="mt-4">Pour le frontend: <span class="font-bold uppercase">{{ projet.frontend }}</span>
                        </p>
                        <p class="mt-4">Pour le backend: <span class="font-bold uppercase">{{ projet.backend }}</span></p>
                    </div>

                    <p class="mt-4 flex justify-between">
                        <a class="bg-[#000000] text-white p-4 text-center basis-[40%] font-serif ease-in duration-300 hover:bg-[#FFA500]"
                            :href="`${projet.linkSite}`" target="blank">Accéder au site</a>
                    </p>
                </section>
            </div>
        </div>
    </main>

    <Footer></Footer>
</template>

<style>
.img:nth-of-type(2n) {
    border-block: 3px solid rgb(163, 159, 159);
}
.img:nth-of-type(2n)>div {
    order: 2;
}
.img:nth-of-type(n+2)>section {
    order: 1;
}
</style>
