<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeInputError from "@/Components/InputError.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { watch } from "vue";

const props = defineProps({
    community: {
        type: Object,
        default() {
            return {}
        }
    }
})

const form = useForm({
    title: "",
    description: "",
    url: "",
});

const submit = () => {
    form.post(route("communities.posts.store", props.community.slug));
};
</script>

<template>

    <Head title="Create Post" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Post for {{ props.community.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="max-w-md p-4 mx-auto bg-white rounded-lg">
                    <form @submit.prevent="submit">
                        <div>
                            <BreezeLabel for="title" value="Title" />
                            <BreezeInput id="title" type="text" class="block w-full mt-1" v-model="form.title" autofocus
                                autocomplete="title" />
                            <BreezeInputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="url" value="Url" />
                            <BreezeInput id="url" type="text" class="block w-full mt-1" v-model="form.url"
                                autocomplete="url" />
                            <BreezeInputError class="mt-2" :message="form.errors.url" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="description" value="Description" />
                            <BreezeInput id="description" type="text" class="block w-full mt-1"
                                v-model="form.description" autocomplete="description" />
                            <BreezeInputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Save
                            </BreezeButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
