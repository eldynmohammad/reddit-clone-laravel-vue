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
        <div class="hidden sm:block mr-3">upvote</div>
        <div>
            <!-- <span class="mr-3 font-semibold">r/Laravel</span> -->
            <div class="text-xs opacity-50 flex flex-col md:flex-row gap-1">
                <span>Posted by</span>
                <span class="font-semibold max-w-[12rem] break-words">u/{{ post.username}}</span>
            </div>
            <Link :href="route('frontend.communities.posts.show', [props.community.slug, props.post.slug])"
                class="block mt-4 text-xl font-semibold">
            {{ post.title }}
            </Link>
            <p class="mt-1 mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ post.description }}
            </p>
            <div class="flex items-center mt-4 gap-2">
                <div class="mr-3 sm:hidden">upvote</div>
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
