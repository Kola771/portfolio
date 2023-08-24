<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

            <form @submit.prevent="submit" class="basis-[49%] flex flex-wrap content-center justify-center rounded-l-md bg-white"
                style="width: 24rem; height: 32rem;">
                <div class="w-72">
                    <!-- Heading -->
                    <h1 class="text-xl font-semibold">Bienvenue sur <Link class="text-[#FFA500] font-bold" href="/">MyFolio</Link></h1>
                    <small class="text-gray-400">Bienvenue de nouveau ! Veuillez entrer vos informations.</small>
                    <div class="mt-4">
                        <div class="mb-3">
                            <InputLabel for="email" value="Email" />

                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                                autofocus autocomplete="username" />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div class="mb-3">
                            <InputLabel for="password" value="Password" />

                            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                                required autocomplete="current-password" />

                            <InputError class="mt-2" :message="form.errors.password" />
                        </div>

                        <div class="block mt-4 flex justify-between items-center">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ml-1 text-sm text-gray-600">Souviens-toi de moi</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4 flex-wrap">
                            <PrimaryButton class="padding mt-4 " :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Connexion
                            </PrimaryButton>
                        </div>
                    </div>
                </div>
            </form>
            <div class="basis-[48%] flex flex-wrap content-center justify-center rounded-r-md" style="width: 24rem; height: 32rem;">
                <img class="w-full h-full bg-center bg-no-repeat bg-cover rounded-r-md"
                    src="/storage/myassets/three.jpg">
            </div>
    </GuestLayout>
</template>

<style>
.padding {
    padding: 14px;
}
</style>