<script setup>
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import { ArrowSmallLeftIcon, PencilIcon, TrashIcon } from "@heroicons/vue/24/solid";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import swal from 'sweetalert';
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

// const isDeleteOpen = ref(false);

function openDeleteModal() {
    swal('Delete?', 'Are you sure want to delete this post?', 'warning', {
        buttons: {
            cancel: "Cancel",
            destroy: "Delete"
        }
    }).then((value) => {
        switch (value) {
            case "cancel":
                break;

            case "destroy":
                Inertia.delete(route('communities.posts.destroy', [ props.community.slug, props.post.data.slug ]));
        }
    });
}
</script>

<template>
    <BreezeGuestLayout>
        <!-- <template #header>
            <div class="flex items-center justify-between px-2">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    r/{{ props.community.name }}
                </h2>
                <Link v-if="$page.props.auth.is_loggedin"
                    :href="route('communities.posts.create', props.community.slug)"
                    class="px-3.5 py-3 rounded-md text-sm font-semibold bg-indigo-500 text-white">Create Post</Link>
            </div>
        </template> -->

        <div class="flex flex-col gap-6 lg:flex-row">
            <div class="w-full lg:w-8/12">
                <Link :href="route('frontend.communities.show', props.community.slug)"
                    class="flex items-center px-4 py-3 text-sm bg-white rounded-full hover:bg-gray-200 w-max">
                <ArrowSmallLeftIcon class="w-5 h-5 text-gray-900" />
                <span class="ml-4">r/{{ props.community.name }}</span>
                </Link>
                <div class="p-4 mt-4 bg-white rounded-lg">
                    <div class="flex justify-between items-center">
                        <div class="text-xs opacity-50 flex flex-col md:flex-row gap-1">
                            <span>Posted by</span>
                            <span class="font-semibold max-w-[12rem] break-words">u/{{ post.data.username}}</span>
                        </div>
                        <div v-if="$page.props.auth.is_loggedin && post.data.owner" class=" flex items-center gap-2">
                            <Link
                                :href="route('communities.posts.edit', [ props.community.slug, props.post.data.slug ])"
                                class="p-1.5 border rounded-md hover:bg-gray-100">
                            <PencilIcon class="w-3.5 h-3.5" />
                            </Link>
                            <button type="button" class="p-1.5 bg-pink-500 text-white rounded-md hover:bg-pink-600"
                                @click="openDeleteModal">
                                <TrashIcon class="w-3.5 h-3.5" />
                            </button>
                            <!-- <Link :href="route('communities.posts.destroy', [ community.slug, post.data.slug ])"
                                class="p-1.5 bg-pink-500 text-white rounded-md hover:bg-pink-600">
                            <TrashIcon class="w-3.5 h-3.5" />
                            </Link> -->
                        </div>
                    </div>
                    <h1 class="mt-4 text-xl font-semibold">{{ post.data.title }}</h1>
                    <p class="mt-1">{{ post.data.description }}</p>
                    <a :href="post.data.url"
                        class="text-xs break-words font-semibold text-indigo-500 hover:text-indigo-300">
                        {{ post.data.url }}
                    </a>
                </div>
            </div>
            <div class="flex-1">
                <div class="overflow-hidden bg-white rounded-lg">
                    <div class="px-4 py-3 text-white bg-emerald-500">
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
