<script setup>
import CommunityList from "@/Components/CommunityList.vue";
import PostCard from "@/Components/PostCard.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
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
        <div class="flex flex-col gap-6 lg:flex-row">
            <div class="space-y-4 lg:w-8/12">
                <PostCard v-for="( post, index ) in props.posts.data" :key="index" :post="post"
                    :community="post.community_slug" />
            </div>
            <div class="flex-1">
                <CommunityList :communities="props.communities.data">
                    <template #title>Top Communities</template>
                </CommunityList>
            </div>
        </div>
    </BreezeGuestLayout>
</template>
