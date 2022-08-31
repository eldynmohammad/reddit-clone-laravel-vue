<script setup>
import { defineProps } from "vue";

const props = defineProps({
    post: {
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
                <h2 class="mx-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ post.title }}
                </h2>
            </a>
            <p class="mx-2 mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ post.description }}
            </p>
            <div class="flex items-center p-2 m-2">
                <p class="p-2 mr-4">Comments(2)</p>
                <a href="#"
                    class="inline-flex items-center px-3 py-2 text-sm font-semibold text-center text-white bg-indigo-500 rounded-md hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-300">
                    Read more
                </a>
            </div>
        </div>
    </div>
</template>
