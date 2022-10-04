<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <Box v-for="listing in listings" :key="listing.id">
      <div>
        <Link
          :href="route('listing.show', {listing: listing.id})"
        >
          <ListingAddress :listing="listing" />
        </Link>
      </div>
      <div>
        <Link
          :href="route('listing.edit', {listing: listing.id})"
        >
          Edit
        </Link>
      </div>
      <div>
        <Link
          :href="route('listing.destroy', {listing: listing.id})"
          method="DELETE" as="button"
        >
          Delete
        </Link>
      </div>
    </Box>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import Box from '@/Components/UI/Box.vue'
defineProps({
  listings: Array,
})
</script>