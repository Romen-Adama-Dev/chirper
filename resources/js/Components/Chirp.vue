<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
  chirp: {
    type: Object,
    required: true
  }
})

const avatarUrl = (email) => {
  if (!email) return 'https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth'
  return `https://avatars.laravel.cloud/${encodeURIComponent(email)}`
}

const destroy = () => {
  if (!confirm('Are you sure you want to delete this chirp?')) return
  router.delete(`/chirps/${props.chirp.id}`, { preserveScroll: true })
}
</script>

<template>
  <div class="bg-white shadow rounded-lg">
    <div class="p-6">
      <div class="flex gap-3">
        <img
          :src="avatarUrl(chirp.email)"
          :alt="chirp.author"
          class="w-10 h-10 rounded-full"
        />

        <div class="flex-1 min-w-0">
          <div class="flex justify-between gap-3">
            <div class="flex items-center gap-1 min-w-0">
              <span class="text-sm font-semibold truncate">{{ chirp.author }}</span>
              <span class="text-gray-400">·</span>
              <span class="text-sm text-gray-500">{{ chirp.created_at }}</span>
              <template v-if="chirp.edited">
                <span class="text-gray-400">·</span>
                <span class="text-sm text-gray-500 italic">edited</span>
              </template>
            </div>

            <div class="flex items-center gap-2">
              <a :href="`/chirps/${chirp.id}/edit`" class="text-sm underline">Edit</a>
              <button type="button" class="text-sm underline text-red-600" @click="destroy">
                Delete
              </button>
            </div>
          </div>

          <p class="mt-2">
            {{ chirp.message }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>