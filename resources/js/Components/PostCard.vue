<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps({
    post: {
        type: Object,
        default() {
            return {}
        }
    },
    community: {
        type: Object,
        default() {
            return {}
        }
    }
})
</script>

<template>
    <div class="flex max-w-4xl p-4 bg-white border border-gray-300 rounded-lg dark:bg-gray-800">
        <div class="mr-3">upvote</div>
        <div>
            <div class="mx-2 md:flex">
                <!-- <span class="mr-3 font-semibold">r/Laravel</span> -->
                <div class="flex items-center text-sm opacity-50">
                    <span>Posted by</span>
                    <span class="ml-1 font-semibold">u/{{ post.username }}</span>
                </div>
            </div>
            <a href="#">
                <Link :href="route('frontend.communities.posts.show', [props.community.slug, props.post.slug])"
                    class="mx-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ post.title }}
                </Link>
            </a>
            <p class="mx-2 mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ post.description }}
            </p>
            <div class="flex items-center mt-8 gap-2">
                <a href="#"
                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-center bg-gray-100 rounded-md hover:bg-gray-200 focus:ring-4 focus:ring-indigo-50">
                    Comments 15
                </a>
                <a href="#"
                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-300">
                    Read more
                </a>
            </div>
        </div>
    </div>
</template>
