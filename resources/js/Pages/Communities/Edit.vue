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
});

const form = useForm(props.community);

watch(() => form.name, (val) => {
    console.log(val);
    form.slug = val
        .toLowerCase()
        .trim()
        .replace(/[^\w\s-]/g, "")
        .replace(/[\s_-]+/g, "-")
        .replace(/^-+|-+$/g, "");
    }
);

const submit = () => {
    form.patch(route("communities.update", form.id));
    // form.post(route('communities.store'), {
    //     onFinish: () => form.reset('name', 'description', 'slug'),
    // });
};
</script>

<template>

    <Head title="Create Community" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Community
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="max-w-md mx-auto bg-white p-4 rounded-lg">
                    <form @submit.prevent="submit">
                        <div>
                            <BreezeLabel for="name" value="Name" />
                            <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                                autocomplete="name" />
                            <BreezeInputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="slug" value="Slug" />
                            <BreezeInput id="slug" type="text" class="mt-1 block w-full bg-slate-100"
                                v-model="form.slug" autocomplete="slug" readonly disabled />
                            <BreezeInputError class="mt-2" :message="form.errors.slug" />
                        </div>

                        <div class="mt-4">
                            <BreezeLabel for="description" value="Description" />
                            <BreezeInput id="description" type="text" class="mt-1 block w-full"
                                v-model="form.description" autocomplete="description" />
                            <BreezeInputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Update
                            </BreezeButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
