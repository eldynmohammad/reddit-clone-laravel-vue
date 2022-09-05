<script setup>
import { defineProps } from 'vue';
import UpVoteLink from './UpVoteLink.vue';
import DownVoteLink from './DownVoteLink.vue';

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
    <div class="flex flex-col items-center gap-2">
        <UpVoteLink :slug="props.post.slug"
            :class="[ props.post.postVotes[ 0 ] && props.post.postVotes[ 0 ].vote === 1 ? 'bg-indigo-200' : 'bg-gray-50' ]" />
        <p class="text-xs font-semibold">{{ props.post.votes }}</p>
        <DownVoteLink :slug="props.post.slug"
            :class="[ props.post.postVotes[ 0 ] && props.post.postVotes[ 0 ].vote === -1 ? 'bg-pink-200' : 'bg-gray-50' ]" />

    </div>
</template>
