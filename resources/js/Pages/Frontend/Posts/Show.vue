<script setup>
import Pagination from "@/Components/Pagination.vue";
import PostCard from "@/Components/PostCard.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps({
    community: {
        type: Object,
        default() {
            return {}
        }
    },
    post: {
        type: Object,
        default() {
            return {}
        }
    }
});

// console.log(props.posts.data);
</script>

<template>
    <BreezeGuestLayout>
        <template #header>
            <div class="flex items-center justify-between px-2">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    r/{{ props.community.name }}
                </h2>
                <Link v-if="$page.props.auth.is_loggedin"
                    :href="route('communities.posts.create', props.community.slug)"
                    class="px-3.5 py-3 rounded-md text-sm font-semibold bg-indigo-500 text-white">Create Post</Link>
            </div>
        </template>

        <div class="flex flex-col lg:flex-row gap-6">
            <div class="space-y-4 lg:w-8/12">
                <h1 class="text-3xl font-bold">{{ post.title }}</h1>
                <span class="mt-4">Post details</span>
            </div>
            <div class="flex-1">
                <div class="rounded-lg bg-white overflow-hidden">
                    <div class="px-4 py-3 bg-emerald-500 text-white">
                        <h3 class="font-bold">About community</h3>
                    </div>
                    <div class="p-4"></div>
                </div>
            </div>
        </div>

        <div class="mt-8">
        </div>
    </BreezeGuestLayout>
</template>
