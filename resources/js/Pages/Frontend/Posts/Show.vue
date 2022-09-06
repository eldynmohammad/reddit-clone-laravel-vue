<script setup>
import PostList from "@/Components/PostList.vue";
import PostVote from "@/Components/PostVote.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import { ArrowSmallLeftIcon, PencilIcon, TrashIcon } from "@heroicons/vue/24/solid";
import { Inertia } from "@inertiajs/inertia";
import { Link, useForm } from "@inertiajs/inertia-vue3";
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
    },
    posts: {
        type: Object,
        default() {
            return {}
        }
    },
    can_update: {
        type: Boolean
    },
    can_delete: {
        type: Boolean
    },
});

const form = useForm({
    content: ''
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

const submitComment = () => {
    form.post(route('frontend.posts.comments', [ props.community.slug, props.post.data.slug ]), {
        onSuccess: () => form.reset('content')
    });
}
</script>

<template>
    <BreezeGuestLayout>
        <div class="flex flex-col gap-6 lg:flex-row">
            <div class="w-full lg:w-8/12">
                <Link :href="route('frontend.communities.show', props.community.slug)"
                    class="flex items-center px-4 py-3 text-sm bg-white rounded-full hover:bg-gray-200 w-max">
                <ArrowSmallLeftIcon class="w-5 h-5 text-gray-900" />
                <span class="ml-4">r/{{ props.community.name }}</span>
                </Link>
                <div class="flex mt-4 overflow-hidden bg-white rounded-lg">
                    <PostVote :post="props.post.data" class="hidden md:flex bg-gray-200 p-2.5" />
                    <div class="flex-1">
                        <div class="flex items-center justify-between px-3 mt-4">
                            <div class="flex flex-wrap gap-2 text-xs opacity-50">
                                <div class="flex gap-1">
                                    <span>Posted by</span>
                                    <span class="font-semibold max-w-[12rem] break-words">
                                        u/{{ post.data.username }}</span>
                                </div>
                                <span class="md:ml-1">{{ post.data.created_at }}</span>
                            </div>
                            <div v-if="$page.props.auth.is_loggedin" class="flex items-center gap-2 ">
                                <Link v-if="props.can_update"
                                    :href="route('communities.posts.edit', [ props.community.slug, props.post.data.slug ])"
                                    class="p-1.5 border rounded-md hover:bg-gray-100">
                                <PencilIcon class="w-3.5 h-3.5" />
                                </Link>
                                <button type="button" class="p-1.5 bg-pink-500 text-white rounded-md hover:bg-pink-600"
                                    v-if="props.can_delete" @click="openDeleteModal">
                                    <TrashIcon class="w-3.5 h-3.5" />
                                </button>
                            </div>
                        </div>
                        <div class="divide-y-2">
                            <div class="p-3">
                                <h1 class="text-xl font-semibold">{{ post.data.title }}</h1>
                                <p class="mt-1">{{ post.data.description }}</p>
                                <a :href="post.data.url"
                                    class="text-xs font-semibold text-indigo-500 break-words hover:text-indigo-300">
                                    {{ post.data.url }}
                                </a>
                                <div class="mt-4 md:hidden">
                                    <PostVote :post="props.post.data" />
                                </div>
                            </div>
                            <div v-if="$page.props.auth.is_loggedin" class="p-4">
                                <form @submit.prevent="submitComment">
                                    <div class="mt-2">
                                        <!-- <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Your
                                    comment</label> -->
                                        <textarea rows="4" v-model="form.content" placeholder="What are your thoughts?"
                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300"></textarea>
                                    </div>
                                    <div class="flex justify-end mt-2">
                                        <button
                                            class="px-4 py-2 text-sm text-white bg-indigo-500 rounded-md hover:bg-indigo-700">Comment</button>
                                    </div>
                                </form>
                            </div>
                            <div v-if="props.post.data.comments.length">
                                <h3 class="px-4 py-3 text-lg">Comments</h3>
                                <ul role="list" class="px-4 divide-y divide-gray-200">
                                    <li v-for="(comment, index) in props.post.data.comments" :key="index"
                                        class="flex flex-col py-4">
                                        <div class="text-xs">
                                            <span class="opacity-60">Commented by</span>
                                            <span class="ml-1 font-semibold">{{ comment.username }}</span>
                                        </div>
                                        <p class="mt-4 text-sm">{{ comment.content }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <PostList :posts="props.posts.data" :community="props.community">
                    <template #title>Popular Posts</template>
                </PostList>
            </div>
        </div>

        <div class="mt-8">
        </div>
    </BreezeGuestLayout>
</template>
