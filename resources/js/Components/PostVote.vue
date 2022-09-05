<script setup>
import { defineProps } from 'vue';
import DownVoteLink from './DownVoteLink.vue';
import UpVoteLink from './UpVoteLink.vue';

const props = defineProps({
    post: {
        type: Object,
        default() {
            return {}
        }
    }
});
</script>

<template>
    <div class="flex md:flex-col items-center gap-4 md:gap-2">
        <UpVoteLink :slug="props.post.slug"
            :class="[ props.post.postVotes[ 0 ] && props.post.postVotes[ 0 ].vote === 1 ? 'bg-indigo-200' : 'bg-gray-100' ]" />
        <p class="text-xs font-semibold" :class="{
                'text-indigo-600' : props.post.postVotes[ 0 ] && props.post.postVotes[ 0 ].vote === 1,
                'text-pink-600' : props.post.postVotes[ 0 ] && props.post.postVotes[ 0 ].vote === -1
                }">
            {{ props.post.votes }}</p>
        <DownVoteLink :slug="props.post.slug"
            :class="[ props.post.postVotes[ 0 ] && props.post.postVotes[ 0 ].vote === -1 ? 'bg-pink-200' : 'bg-gray-100' ]" />

    </div>
</template>
