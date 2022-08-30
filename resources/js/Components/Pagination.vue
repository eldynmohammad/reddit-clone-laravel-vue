<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps({
    links: [],
});
</script>

<template>
    <div class="flex">
        <template v-for="(link, key) in props.links" :key="key">
            <div
                v-if="link.url === null"
                v-html="link.label"
                class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded-md"
            ></div>
            <Link
                v-else
                :href="link.url"
                v-html="link.label"
                class="mb-1 mr-1 px-4 py-3 text-gray-900 text-sm leading-4 border rounded-md bg-white hover:bg-indigo-100 focus:text-indigo-500 focus:border-indigo-500"
                :class="{ 'bg-indigo-400 text-white': link.active }"
            ></Link>
        </template>
    </div>
</template>
