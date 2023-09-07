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
  <header class="fixed inset-x-0 top-0 z-50 bg-[#000000] border-b-2">
    <div class="flex p-2 justify-between lg:justify-between md:justify-between items-center lg:w-[80rem] lg:p-6 md:p-4 lg:m-auto">
      <h1 class="text-[20px] text-[#FFA500] font-bold">
        <Link href="/">MyFolio</Link>
      </h1>
      <div class="hidden lg:gap-4 lg:items-center lg:flex md:flex">
        <Link href="/"
          class="p-1 font-bold md:text-[14px] lg:text-lg hover:text-[#FFA500] text-white ease-in duration-300">
        Accueil</Link>
        <Link href="/#bibliographie"
          class="p-1 font-bold md:text-[14px] lg:text-lg hover:text-[#FFA500] text-white ease-in duration-300">Ma
        bibliographie</Link>
        <Link :href="route('competences')"
          class="p-1 font-bold md:text-[14px] lg:text-lg hover:text-[#FFA500] text-white ease-in duration-300">Mes
        compétences</Link>
        <Link :href="route('projects')"
          class="p-1 font-bold md:text-[14px] lg:text-lg hover:text-[#FFA500] text-white ease-in duration-300">Mes
        projets</Link>
        <Link :href="route('contacts')"
          class="p-1 font-bold md:text-[14px] lg:text-lg hover:text-[#FFA500] text-white ease-in duration-300">
        Contact</Link>
        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
          class="rounded bg-[#FFA500] hover:bg-[#FFFFFF] hover:text-[#FFA500] font-bold md:text-[14px] lg:text-lg p-1 text-white ease-in duration-300">
        Dashboard</Link>
      </div>
      <div class="text-white relative lg:hidden md:hidden mr-4" @click="auclick">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-6 h-6 cursor-pointer">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
        </svg>
        <div v-if="show" class="mt-[1rem] bg-[#eee] absolute right-0 lg:hidden md:hidden flex flex-col w-[150px] gap-0.5 p-1 rounded">
          <Link href="/#bibliographie"
            class="p-1 font-bold md:text-[14px] border-b-[2px] border-[#333] lg:text-lg hover:text-[#FFA500] text-[#333] ease-in duration-300">Ma
          bibliographie</Link>
          <Link :href="route('competences')"
            class="p-1 font-bold md:text-[14px] border-b-[2px] border-[#333] lg:text-lg hover:text-[#FFA500] text-[#333] ease-in duration-300">Mes
          compétences</Link>
          <Link :href="route('projects')"
            class="p-1 font-bold md:text-[14px] border-b-[2px] border-[#333] lg:text-lg hover:text-[#FFA500] text-[#333] ease-in duration-300">Mes
          projets</Link>
          <Link :href="route('contacts')"
            class="p-1 font-bold md:text-[14px] border-b-[2px] border-[#333] lg:text-lg hover:text-[#FFA500] text-[#333] ease-in duration-300">
          Contact</Link>
          <Link v-if="$page.props.auth.user" :href="route('dashboard')"
            class="rounded font-bold md:text-[14px] hover:text-[#FFA500] lg:text-lg p-1 text-[#333] ease-in duration-300">
          Dashboard</Link>
        </div>
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
  transition: opacity 0.5s ease;
  /* Ajoutez d'autres propriétés de transition au besoin */
}

.fade-in {
  opacity: 1;
}
</style>
<script>
export default {
    props: {
        laravelVersion: String,
    },
    data() {
        return {
            show: false,
            x: 0,
        };
    },
    mounted() {
    },
    methods: {
        auclick() {
            if(this.x === 1) {
              this.show = false;
              this.x = 0;
            } else {
              this.show = true;
              this.x++
            }
        },
    },
};
</script>