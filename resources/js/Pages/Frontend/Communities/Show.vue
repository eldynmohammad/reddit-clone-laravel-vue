<script setup>
import CommunityList from "@/Components/CommunityList.vue";
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
    posts: {
        type: Object,
        default() {
            return {}
        }
    },
    communities: {
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

        <div class="flex flex-col gap-6 lg:flex-row">
            <div class="space-y-4 lg:w-8/12">
                <PostCard v-for="(post, index) in props.posts.data" :key="index" :post="post"
                    :community="props.community.slug" />
            </div>
            <div class="flex-1 space-y-4">
                <div class="overflow-hidden bg-white rounded-lg">
                    <div class="px-4 py-3 text-white bg-indigo-600">
                        <h3 class="font-bold">About community</h3>
                    </div>
                    <div class="p-4">
                        <p class="text-sm">{{ props.community.description }}</p>
                    </div>
                </div>
                <CommunityList :communities="props.communities.data">
                    <template #title>Latest Communities</template>
                </CommunityList>
            </div>
        </div>

        <div class="mt-8">
            <Pagination :links="props.posts.meta.links" />
        </div>
    </BreezeGuestLayout>
</template>
