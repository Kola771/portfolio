<script setup>
import Header from '../Components/Home/Navbar.vue'
import Footer from '../Components/Home/Footer.vue'
import { Head, Link } from '@inertiajs/vue3';

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
    <Head title="Mes différents compétences" />
    <Header></Header>
    <div class="h-[680px] bg-[url('/storage/myassets/two.jpg')] bg-no-repeat bg-cover relative flex flex-col">
        <div class="flex justify-center w-full mt-[10rem] text-white">
            <div class="w-[75rem] m-auto flex justify-center">
                <p class="mt-[170px] text-[90px] font-normal font-thin testDesc text-center uppercase leading-[96px]">
                    Mes compétences
                </p>
            </div>
        </div>
    </div>

    <main>
        <div class="my-[2.5rem] max-w-[80rem] m-auto">
            <section>
                <h2 class="font-bold text-[2rem] my-6 text-center text-[#FFA500]">Mes compétences principales</h2>
                <div class="text-[1.2rem] text-justify">
                    Comme mentionné précédemment, je suis spécialisé dans le développement backend. J'ai acquis de
                    l'expérience dans la création de solutions à travers divers langages de programmation, tant au niveau du
                    backend que du frontend. Voici la liste de ces langages que je partagerai ci-dessous.
                </div>
                <div class="flex gap-8">
                    <div class="max-w-md py-4 px-8 bg-white shadow-2xl rounded-lg my-20 w-[500px] h-[320px]">
                        <div class="flex justify-center md:justify-end -mt-16">
                            <img class="w-20 h-20 object-cover rounded-full border-[3px] border-indigo-500" src="/storage/myassets/frontend.jpg" alt="image">
                        </div>
                        <h3 class="font-serif text-[22px] mb-4">Frontend</h3>
                        <div class="bg-gray-400 w-[380px] mt-2 rounded">
                            <div class="w-[280px] p-1 text-white bg-blue-600 text-[18px] font-serif rounded">HTML</div>
                        </div>
                        <div class="bg-gray-400 w-[380px] mt-3 rounded">
                            <div class="w-[250px] p-1 text-white bg-blue-600 text-[18px] font-serif rounded">CSS</div>
                        </div>
                        <div class="bg-gray-400 w-[380px] mt-3 rounded">
                            <div class="w-[180px] p-1 text-white bg-blue-600 text-[18px] font-serif rounded">JavaScript</div>
                        </div>
                        <div class="bg-gray-400 w-[380px] mt-3 rounded">
                            <div class="w-[80px] p-1 text-white bg-blue-600 text-[18px] font-serif rounded">JQuery</div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <a href="https://github.com/Kola771" target="blank" class="text-xl font-medium text-indigo-500">Koladé A.</a>
                        </div>
                    </div>
                    <div class="max-w-md py-4 px-8 bg-white shadow-2xl rounded-lg my-20 w-[500px] h-[230px]">
                        <div class="flex justify-center md:justify-end -mt-16">
                            <img class="w-20 h-20 object-cover rounded-full border-[3px] border-indigo-500" src="/storage/myassets/backend.jpg" alt="image">
                        </div>
                        <h3 class="font-serif text-[22px] mb-4">Backend</h3>
                        <div class="bg-gray-400 w-[380px] mt-2 rounded">
                            <div class="w-[220px] p-1 text-white bg-blue-600 text-[18px] font-serif rounded">PHP</div>
                        </div>
                        <div class="bg-gray-400 w-[380px] mt-3 rounded">
                            <div class="w-[140px] p-1 text-white bg-blue-600 text-[18px] font-serif rounded">PYTHON</div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <a href="https://github.com/Kola771" target="blank" class="text-xl font-medium text-indigo-500">Koladé A.</a>
                        </div>
                    </div>
                    <div class="max-w-md py-4 px-8 bg-white shadow-2xl rounded-lg my-20 w-[500px]">
                        <div class="flex justify-center md:justify-end -mt-16">
                            <img class="w-20 h-20 object-cover rounded-full border-[3px] border-indigo-500" src="/storage/myassets/framework.jpg" alt="image">
                        </div>
                        <h3 class="font-serif text-[22px] mb-4">Framework</h3>
                        <div class="font-serif">
                            Lors de mon parcours, j'ai aussi eu à utiliser des frameworks.
                            <p class="mt-2">Frameworks Frontend :</p>
                            <div class="bg-gray-400 w-[380px] my-2 rounded">
                                <div class="w-[100px] p-1 text-white bg-blue-600 text-[18px] font-serif rounded">VueJS</div>
                            </div>
                            <p>Frameworks Backend</p>
                            <div class="bg-gray-400 w-[380px] mt-3 rounded">
                                <div class="w-[150px] p-1 text-white bg-blue-600 text-[18px] font-serif rounded">Laravel</div>
                            </div>
                            <div class="bg-gray-400 w-[380px] mt-3 rounded">
                                <div class="w-[120px] p-1 text-white bg-blue-600 text-[18px] font-serif rounded">FastApi</div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <a href="https://github.com/Kola771" target="blank" class="text-xl font-medium text-indigo-500">Koladé A.</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <Footer></Footer>
</template>

<style></style>
<script>
// import { defineProps } from 'vue';
// import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props: {
        laravelVersion: String,
    },
    data() {
        return {
            descr: [],
            condition: null,
        };
    },
    mounted() {
    },
    methods: {

    },
};
</script>