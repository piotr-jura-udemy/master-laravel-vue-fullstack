<template>
  <div class="mb-4">
    <Link :href="route('realtor.listing.index')">
      ← Go back to
      Listings
    </Link>
  </div>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box v-if="!listing.offers.length" class="flex md:col-span-7 items-center">
      <div
        class="w-full text-center font-medium text-gray-500"
      >
        No offers
      </div>
    </Box>

    <section v-else class="md:col-span-7 items-center">
      <Box v-for="offer in listing.offers" :key="offer.id" class="mb-4">
        <template #header>Offer #{{ offer.id }}</template>
        <section class="flex items-center justify-between">
          <section>
            <Price :price="offer.amount" class="text-xl" />
            <div class="text-gray-500">
              Difference
              <Price :price="offer.amount - listing.price" />
            </div>
            <div class="text-gray-500 text-sm">
              Made by John Spencer
            </div>
            <div class="text-gray-500 text-sm">
              Made on {{ (new Date).toDateString() }}
            </div>
          </section>
          <section>
            <Link
              :href="route('realtor.offer.accept', { offer: offer.id })" 
              class="btn-outline text-xs font-medium" 
              as="button" method="put"
            >
              Accept
            </Link>
          </section>
        </section>
      </Box>
    </section>

    <div class="md:col-span-5 flex flex-col gap-4">
      <Box>
        <template #header>
          Basic Info
        </template>
        <Price
          :price="listing.price"
          class="text-2xl font-bold"
        />
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress
          :listing="listing"
          class="text-gray-500"
        />
      </Box>
    </div>
  </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/inertia-vue3'

defineProps({ listing: Object })
</script>