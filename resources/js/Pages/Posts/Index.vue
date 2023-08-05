<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm, Link} from '@inertiajs/vue3';

defineProps({
    posts: Array
})

const form = useForm({
    body: '',
})

const createPost = () => {
  form.post(route('posts'), {
      preserveScroll: true,
      onSuccess: () => {
          form.reset()
      }
  });
}

</script>

<template>
    <Head title="Posts"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
        </template>

        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-3">
                <form @submit.prevent="createPost" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <label for="body" class="sr-only">Body</label>
                    <textarea v-model="form.body" @focus="form.clearErrors('body')" name="body" id="body" cols="30" rows="5" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"></textarea>
                    <div class="text-sm text-red-500" v-if="form.errors.body">
                        {{ form.errors.body }}
                    </div>
                    <button
                        type="submit"
                        class="mt-2 bg-gray-700 px-4 py-2 rounded-md font-medium text-white"
                        :disabled="form.processing"
                        :class="{ 'opacity-50': form.processing }"
                    >
                        Post
                    </button>
                </form>

                <div class="text-center">
                    <Link :href="route('posts')" preserve-scroll :only="['posts']" type="button" class="text-sm text-indigo-600">Refresh Posts</Link>
                </div>

                <div v-for="post in posts" :key="post.id">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <div class="font-semibold">
                              <Link :href="route('users.show', post.user)" preserve-scroll>{{ post.user.name }}</Link>
                            </div>
                            <p class="mt-1">{{ post.body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

