<script setup>
import { ArrowSmallUpIcon } from '@heroicons/vue/24/solid';
import { Link } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

const props = defineProps({
    slug: {
        type: String,
        default: ''
    }
});
</script>

<template>
    <Link :href="route('posts.upvote', props.slug)" method="post" as="button" type="button" preserve-scroll
        class="w-8 h-8 rounded-md hover:bg-indigo-300 grid place-content-center">
    <ArrowSmallUpIcon class="w-5 h-5 text-gray-800" />
    </Link>
</template>
