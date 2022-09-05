<script setup>
import { ArrowSmallDownIcon } from '@heroicons/vue/24/solid';
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
    <Link :href="route('posts.downvote', props.slug)" method="post" as="button" type="button" preserve-scroll
        class="w-8 h-8 rounded-md hover:bg-pink-300 grid place-content-center">
    <ArrowSmallDownIcon class="w-5 h-5 text-gray-800" />
    </Link>
</template>
