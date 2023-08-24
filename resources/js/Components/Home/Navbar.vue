<script setup>
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
    <Head title="Bienvenu(e) sur mon Portfolio" />
    <header class="fixed inset-x-0 top-0 z-50 bg-[#ffffff] bg-[url('/storage/myassets/six.jpg')] border-b-2">
        <div class="flex justify-between items-center w-[80rem] p-6 m-auto">
                <h1 class="text-[20px] text-[#FFA500] font-bold"><Link href="/">MyFolio</Link></h1>
                <div class="flex gap-4">
                    <Link href="/" class="p-1 font-bold text-lg hover:text-[#FFA500] text-white ease-in duration-300">
                    Accueil</Link>
                    <Link href="/#bibliographie" class="p-1 font-bold text-lg hover:text-[#FFA500] text-white ease-in duration-300">Ma
                    bibliographie</Link>
                    <Link :href="route('competences')" class="p-1 font-bold text-lg hover:text-[#FFA500] text-white ease-in duration-300">Mes
                    compétences</Link>
                    <Link :href="route('projects')" class="p-1 font-bold text-lg hover:text-[#FFA500] text-white ease-in duration-300">Mes
                    projets</Link>
                    <Link :href="route('contacts')" class="p-1 font-bold text-lg hover:text-[#FFA500] text-white ease-in duration-300">
                    Contact</Link>
                    <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="rounded bg-[#FFA500] hover:bg-[#FFFFFF] hover:text-[#FFA500] font-bold text-lg p-1 text-white ease-in duration-300">
                    Dashboard</Link>
                </div>
            </div>
    </header>
</template>

<style>
html {
  scroll-behavior: smooth;
}
::-webkit-scrollbar {
  background-color: #fff;
  width: 8px;
}

/* Couleur de la poignée (thumb) */
::-webkit-scrollbar-thumb {
  background-color: #eee;
  border: 2px solid;
  border-radius: .5em;
}

/* Couleur de la poignée lorsqu'elle est survolée */
::-webkit-scrollbar-thumb:hover {
  background-color: #FFA500;
}

.animated-element {
  opacity: 0;
  transition: opacity 0.5s ease; /* Ajoutez d'autres propriétés de transition au besoin */
}

.fade-in {
  opacity: 1;
}
</style>