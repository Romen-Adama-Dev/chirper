<script setup>
import { computed } from 'vue'
import { useForm, usePage } from '@inertiajs/vue3'
import Chirp from '@/Components/Chirp.vue'

defineProps({
  chirps: {
    type: Array,
    default: () => []
  }
})

const page = usePage()
const flashSuccess = computed(() => page.props.flash?.success)

const form = useForm({
  message: ''
})

const submit = () => {
  form.post('/chirps', {
    preserveScroll: true,
    onSuccess: () => form.reset('message')
  })
}
</script>

<template>
  <div class="max-w-2xl mx-auto px-4">
    <h1 class="text-3xl font-bold mt-8">Latest Chirps</h1>

    <div v-if="flashSuccess" class="mt-6 bg-green-50 border border-green-200 text-green-800 rounded-lg px-4 py-3">
      {{ flashSuccess }}
    </div>

    <div class="bg-white shadow rounded-lg mt-8">
      <div class="p-6">
        <form @submit.prevent="submit">
          <textarea
            v-model="form.message"
            placeholder="What's on your mind?"
            rows="4"
            maxlength="255"
            class="w-full border rounded-lg p-3 resize-none"
            :class="form.errors.message ? 'border-red-400' : 'border-gray-200'"
            required
          />

          <div v-if="form.errors.message" class="mt-2 text-sm text-red-600">
            {{ form.errors.message }}
          </div>

          <div class="mt-4 flex justify-end">
            <button
              type="submit"
              class="px-4 py-2 rounded-lg bg-black text-white disabled:opacity-50"
              :disabled="form.processing"
            >
              Chirp
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="space-y-4 mt-8">
      <Chirp
        v-for="chirp in chirps"
        :key="chirp.id"
        :chirp="chirp"
      />

      <div v-if="!chirps.length" class="py-12 text-center text-gray-500">
        No chirps yet. Be the first to chirp!
      </div>
    </div>
  </div>
</template>