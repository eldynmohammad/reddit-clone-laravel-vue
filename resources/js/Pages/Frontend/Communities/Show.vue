<script setup>
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps({
    community: {
        type: Object,
        default() {
            return {}
        }
    }
});
</script>

<template>
    <BreezeGuestLayout>
        <div v-if="$page.props.auth.is_loggedin" class="flex justify-end m-2 p-2">
            <Link :href="route('communities.posts.create', props.community.slug)"
                class="px-3.5 py-3 rounded-md text-sm bg-indigo-500 text-white">Create Post</Link>
        </div>
        <div>{{ props.community.name }} page</div>
    </BreezeGuestLayout>
</template>
