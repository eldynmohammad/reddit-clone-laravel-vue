<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps({
    community: {
        type: Object,
        default() {
            return {};
        },
    },
    posts: {
        type: Object,
        default() {
            return {};
        },
    },
});
</script>

<template>
    <div class="rounded-lg bg-white overflow-hidden">
        <div class="px-4 py-3 bg-violet-600 text-white">
            <h3 class="font-bold">
                <slot name="title" />
            </h3>
        </div>
        <div class="px-4">
            <ul class="divide-y divide-slate-300 dark:divide-slate-700">
                <li v-for="(post, index) in posts" :key="index" class="py-3 sm:py-4">
                    <div class="flex items-center gap-1 flex-wrap text-sm">
                        <Link :href="route('frontend.communities.posts.show', [ props.community.slug, post.slug ])"
                            class="font-semibold truncate text-slate-800 dark:text-slate-300 hover:underline underline-offset-4">
                        {{ post.title }}
                        </Link>
                        <p class="opacity-60">— Votes [{{ post.votes }}]</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
