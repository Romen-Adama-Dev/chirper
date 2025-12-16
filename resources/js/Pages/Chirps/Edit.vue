<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  chirp: {
    type: Object,
    required: true
  }
})

const form = useForm({
  message: props.chirp.message ?? ''
})

const submit = () => {
  form.put(`/chirps/${props.chirp.id}`, {
    preserveScroll: true
  })
}
</script>

<template>
  <div class="max-w-2xl mx-auto px-4">
    <h1 class="text-3xl font-bold mt-8">Edit Chirp</h1>

    <div class="bg-white shadow rounded-lg mt-8">
      <div class="p-6">
        <form @submit.prevent="submit">
          <textarea
            v-model="form.message"
            rows="4"
            maxlength="255"
            class="w-full border rounded-lg p-3 resize-none"
            :class="form.errors.message ? 'border-red-400' : 'border-gray-200'"
            required
          />

          <div v-if="form.errors.message" class="mt-2 text-sm text-red-600">
            {{ form.errors.message }}
          </div>

          <div class="mt-4 flex justify-between">
            <a href="/" class="underline">Cancel</a>
            <button
              type="submit"
              class="px-4 py-2 rounded-lg bg-black text-white disabled:opacity-50"
              :disabled="form.processing"
            >
              Update Chirp
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>