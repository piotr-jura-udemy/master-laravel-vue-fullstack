<template>
  <div v-for="listing in listings" :key="listing.id">
    <div>
      <Link :href="`/listing/${listing.id}`">
        <ListingAddress :listing="listing" />
      </Link>
    </div>
    <div>
      <Link :href="`/listing/${listing.id}/edit`">Edit</Link>
    </div>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
defineProps({
  listings: Array,
})
</script>