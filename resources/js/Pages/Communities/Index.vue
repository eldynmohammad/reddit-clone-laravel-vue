<script setup>
import Pagination from "@/Components/Pagination.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { PencilIcon, TrashIcon } from "@heroicons/vue/24/solid";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import swal from 'sweetalert';
import { defineProps, watch } from "vue";

const props = defineProps({
    communities: {
        type: Object,
        default() {
            return {};
        },
    },
});

const form = useForm({
    name: "",
    description: "",
    slug: "",
});

watch(
    () => form.name,
    (val) => {
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
    form.post(route("communities.store"));
};

function openDeleteModal(slug) {
    swal('Delete?', 'Are you sure want to delete this post?', 'warning', {
        buttons: {
            cancel: "Cancel",
            destroy: "Delete"
        }
    }).then((value) => {
        switch (value) {
            case "cancel":
                break;

            case "destroy":
                Inertia.delete(route('communities.destroy', slug));
                swal('Gotcha!', 'Data deleted successfully.', 'success')
        }
    });
}
</script>

<template>

    <Head title="All Communities" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                All Communities
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end">
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link :href="route('communities.create')"
                                class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                            Add Community</Link>
                        </div>
                    </div>
                    <div class="flex flex-col mt-8">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                    Name
                                                </th>
                                                <th scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                    Slug
                                                </th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr v-for="community in props.communities.data" :key="community.id">
                                                <!-- <tr> -->
                                                <td
                                                    class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">
                                                    <!-- Laravel -->
                                                    <Link :href="route('frontend.communities.show', community.slug)"
                                                        class="font-semibold text-blue-500 hover:text-blue-700">
                                                    {{ community.name }}
                                                    </Link>
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                    {{ community.slug }}
                                                </td>
                                                <td
                                                    class="relative flex items-center justify-end gap-3 py-4 pl-3 pr-4 text-right whitespace-nowrap sm:pr-6">
                                                    <Link :href="route('communities.edit', community.slug)"
                                                        class="p-2 border rounded-md hover:bg-gray-100"
                                                        :class="[!community.owner ? 'bg-gray-200 text-gray-400 opacity-30 cursor-default pointer-events-none' : '' ]">
                                                    <PencilIcon class="w-4 h-4" />
                                                    </Link>
                                                    <button type="button" class="p-2 text-white rounded-md"
                                                        :class="[ !community.owner ? 'bg-pink-200 opacity-30 cursor-default pointer-events-none' : 'bg-pink-500 hover:bg-pink-600' ]"
                                                        @click="openDeleteModal(community.slug)">
                                                        <TrashIcon class="w-4 h-4" />
                                                    </button>
                                                    <!-- <Link :href="route('communities.posts.destroy', [ community.slug, post.data.slug ])"
                                class="p-1.5 bg-pink-500 text-white rounded-md hover:bg-pink-600">
                            <TrashIcon class="w-3.5 h-3.5" />
                            </Link> -->
                                                    <!-- </div> -->
                                                    <!-- Edit -->
                                                    <!-- <Link :href="
                                                            route(
                                                                'communities.edit',
                                                                community.id
                                                            )
                                                        " class="mr-3 text-indigo-600 hover:text-indigo-900">
                                                    Edit
                                                    </Link>
                                                    <Link :href="
                                                            route(
                                                                'communities.destroy',
                                                                community.id
                                                            )
                                                        " class="text-pink-600 hover:text-pink-900" method="delete"
                                                        as="button" type="button">Delete</Link> -->
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="p-2 m-2">
                                        <Pagination :links="props.communities.links" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
