<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";
import PostVote from "./PostVote.vue";

const props = defineProps({
    post: {
        type: Object,
        default() {
            return {}
        }
    },
    community: {
        type: String,
        default: ''
    }
})
</script>

<template>
    <div class="flex max-w-4xl bg-white border border-gray-300 rounded-lg dark:bg-gray-800">
        <div class="hidden md:flex">
            <PostVote :post="props.post" class="bg-gray-200 p-2.5" />
        </div>
        <div class="p-3">
            <div class="text-xs opacity-50 flex flex-col md:flex-row items-centar gap-2">
                <div class="flex items-center">
                    <span>In</span>
                    <Link :href="route('frontend.communities.show', props.community)"
                        class="ml-1 font-semibold hover:text-indigo-600">
                    r/{{ props.community }}</Link>
                </div>
                <div class="flex md:items-center flex-col md:flex-row">
                    <span>Posted by</span>
                    <span class="font-semibold max-w-[12rem] break-words">u/{{ post.username}}</span>
                </div>
            </div>
            <Link :href="route('frontend.communities.posts.show', [props.community, props.post.slug])"
                class="block mt-4 text-xl font-semibold">
            {{ post.title }}
            </Link>
            <p class="mt-1 mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ post.description }}
            </p>
            <div class="flex items-center gap-2 mt-4">
                <div class="mr-3 md:hidden">
                    <PostVote :post="props.post" />
                </div>
                <Link :href="route('frontend.communities.posts.show', [props.community, props.post.slug])"
                    class="inline-flex items-center px-3 py-2 text-xs font-semibold text-center text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 focus:ring-4 focus:ring-indigo-50">
                {{ post.comments_count }} Comments
                </Link>
                <!-- <Link :href="route('frontend.communities.posts.show', [props.community, props.post.slug])"
                    class="inline-flex items-center px-3 py-2 text-xs font-semibold text-center text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-300">
                Read more
                </Link> -->
            </div>
        </div>
    </div>
</template>
