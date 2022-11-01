<template>
  <h1 class="text-3xl mb-4">Your Listings</h1>

  <section>
    <RealtorFilters :filters="filters" />
  </section>

  <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    <Box v-for="listing in listings.data" :key="listing.id" :class="{ 'border-dashed': listing.deleted_at }">
      <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
        <div :class="{ 'opacity-25': listing.deleted_at }">
          <div class="xl:flex items-center gap-2">
            <Price :price="listing.price" class="text-2xl font-medium" />
            <ListingSpace :listing="listing" />
          </div>

          <ListingAddress :listing="listing" />
        </div>
        <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
          <a
            class="btn-outline text-xs font-medium" 
            :href="route('listing.show', { listing: listing.id })"
            target="_blank"
          >Preview</a>
          <Link class="btn-outline text-xs font-medium" :href="route('realtor.listing.edit', { listing: listing.id })">Edit</Link>
          
          <Link
            v-if="!listing.deleted_at"
            class="btn-outline text-xs font-medium" 
            :href="route('realtor.listing.destroy', { listing: listing.id })" 
            as="button" method="delete"
          >
            Delete
          </Link>

          <Link
            v-else 
            class="btn-outline text-xs font-medium" 
            :href="route('realtor.listing.restore', { listing: listing.id })" 
            as="button" 
            method="put"
          >
            Restore
          </Link>
        </div>
      </div>
    </Box>
  </section>

  <section v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="listings.links" />
  </section>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  listings: Object,
  filters: Object,
})
</script>
