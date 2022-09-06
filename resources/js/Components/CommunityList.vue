<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps({
    communities: {
        type: Object,
        default() {
            return {};
        },
    },
});
</script>

<template>
    <div class="overflow-hidden bg-white rounded-lg">
        <div class="px-4 py-3 text-white bg-violet-600">
            <h3 class="font-bold">
                <slot name="title" />
            </h3>
        </div>
        <div class="px-4">
            <ul class="divide-y divide-slate-300 dark:divide-slate-700">
                <li v-for="(community, index) in communities" :key="index" class="py-3 sm:py-4">
                    <div class="flex items-center gap-1 text-sm flex-wrap">
                        <Link :href="route('frontend.communities.show', community.slug)"
                            class="font-semibold truncate text-slate-800 dark:text-slate-300 hover:underline underline-offset-4">
                        {{ community.name }}
                        </Link>
                        <p class="opacity-60">— {{ community.posts_count }}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
