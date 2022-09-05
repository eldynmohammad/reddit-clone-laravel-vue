<script setup>
import Pagination from "@/Components/Pagination.vue";
import PostCard from "@/Components/PostCard.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps({
    communities: {
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
    }
});
</script>

<template>
    <BreezeGuestLayout>
        <div class="flex flex-col lg:flex-row gap-6">
            <div class="space-y-4 lg:w-8/12">
                <PostCard v-for="( post, index ) in props.posts.data" :key="index" :post="post"
                    :community="post.community_slug" />
            </div>
            <div class="flex-1">
                <div class="rounded-lg bg-white overflow-hidden">
                    <div class="px-4 py-3 bg-emerald-500 text-white">
                        <h3 class="font-bold">Top communities</h3>
                    </div>
                    <div class="p-4"></div>
                </div>
            </div>
        </div>

        <!-- <div class="mt-8">
            <Pagination :links="props.posts.meta.links" />
        </div> -->
        <!-- <div>{{ props.community.name }} page</div> -->
    </BreezeGuestLayout>
</template>
