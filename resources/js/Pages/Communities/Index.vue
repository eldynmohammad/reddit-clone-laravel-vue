<script setup>
import Pagination from "@/Components/Pagination.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end">
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <Link
                                :href="route('communities.create')"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                            >
                                Add Community</Link
                            >
                        </div>
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div
                            class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8"
                        >
                            <div
                                class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                            >
                                <div
                                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-300"
                                    >
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                >
                                                    Name
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                                >
                                                    Slug
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                                >
                                                    <span class="sr-only"
                                                        >Edit</span
                                                    >
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="divide-y divide-gray-200 bg-white"
                                        >
                                            <tr
                                                v-for="community in props
                                                    .communities.data"
                                                :key="community.id"
                                            >
                                                <!-- <tr> -->
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                                >
                                                    <!-- Laravel -->
                                                    <Link
                                                        href="#"
                                                        class="text-blue-500 hover:text-blue-700 font-semibold"
                                                    >
                                                        {{ community.name }}
                                                    </Link>
                                                </td>
                                                <td
                                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                                >
                                                    {{ community.slug }}
                                                </td>
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                                >
                                                    <!-- Edit -->
                                                    <Link
                                                        :href="
                                                            route(
                                                                'communities.edit',
                                                                community.id
                                                            )
                                                        "
                                                        class="text-indigo-600 hover:text-indigo-900 mr-3"
                                                    >
                                                        Edit
                                                    </Link>
                                                    <Link
                                                        :href="
                                                            route(
                                                                'communities.destroy',
                                                                community.id
                                                            )
                                                        "
                                                        class="text-pink-600 hover:text-pink-900"
                                                        method="delete"
                                                        as="button"
                                                        type="button"
                                                        >Delete</Link
                                                    >
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="m-2 p-2">
                                        <Pagination
                                            :links="props.communities.links"
                                        />
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