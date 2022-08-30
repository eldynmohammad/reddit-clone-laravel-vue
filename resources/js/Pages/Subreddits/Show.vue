<script setup>
import { defineProps } from "vue";

const props = defineProps({
    subreddit: {
        type: Object,
        default() {
            return {}
        }
    }
});

console.log(props.subreddit);
</script>

<template>
    <div>{{ props.subreddit.name }} page</div>
</template>
