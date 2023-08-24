<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />
            <div class="basis-[50%] flex flex-wrap content-center justify-center rounded" style="width: 24rem; height: 32rem;">
                <img class="w-full h-full bg-center bg-no-repeat bg-cover rounded"
                    src="/storage/myassets/six.jpg">
            </div>

        <div class="basis-[48%]">
            <div class="my-[25px] mx-2 text-sm text-gray-600">
                Vous avez oublié votre mot de passe ? Pas de souci. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe par e-mail. Ce lien vous permettra de choisir un nouveau mot de passe.
            </div>
    
            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>
    
            <form @submit.prevent="submit" class="mt-[50px] mx-2">
                <div>
                    <InputLabel for="email" value="Email" />
    
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full focus:ring-0"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />
    
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
    
                <div class="flex items-center justify-center mt-4">
                    <PrimaryButton class="padding" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Réinstaliser son mot de passe
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

<style>
.padding {
    padding: 10px;
}
</style>