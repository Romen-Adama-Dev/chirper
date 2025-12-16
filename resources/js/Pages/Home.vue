<script setup>
defineProps({
  chirps: {
    type: Array,
    default: () => []
  }
})
</script>

<template>
  <div class="max-w-2xl mx-auto">
    <template v-if="chirps.length">
      <div
        v-for="chirp in chirps"
        :key="chirp.id"
        class="bg-white shadow rounded-lg mt-8"
      >
        <div class="p-6">
          <div class="font-semibold">{{ chirp.author }}</div>
          <div class="mt-1">{{ chirp.message }}</div>
          <div class="text-sm text-gray-500 mt-2">
            {{ chirp.created_at }}
          </div>
        </div>
      </div>
    </template>

    <p v-else class="text-gray-500 mt-8">
      No chirps yet. Be the first to chirp!
    </p>
  </div>
</template>