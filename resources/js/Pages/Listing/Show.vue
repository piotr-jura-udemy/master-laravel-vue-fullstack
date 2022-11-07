<template>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box class="md:col-span-7 items-center" :class="{ 'flex': !hasImages }">
      <div v-if="hasImages" class="grid grid-cols-2 gap-1">
        <img
          v-for="image in listing.images" :key="image.id"
          :src="image.src"
        />
      </div>
      <div v-else class="w-full text-center font-medium text-gray-500">No images</div>
    </Box>
    <div class="md:col-span-5 flex flex-col gap-4">
      <Box>
        <template #header>
          Basic Info
        </template>
        <Price :price="listing.price" class="text-2xl font-bold" />
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" class="text-gray-500" />
      </Box>

      <Box>
        <template #header>
          Monthly Payment
        </template>
        <div>
          <label class="label">Interest rate ({{ interestRate }}%)</label>
          <input
            v-model.number="interestRate"
            type="range" min="0.1" max="30" step="0.1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />

          <label class="label">Duration ({{ duration }} years)</label>
          <input
            v-model.number="duration"
            type="range" min="3" max="35" step="1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />

          <div class="text-gray-600 dark:text-gray-300 mt-2">
            <div class="text-gray-400">Your monthly payment</div>
            <Price :price="monthlyPayment" class="text-3xl" />
          </div>

          <div class="mt-2 text-gray-500">
            <div class="flex justify-between">
              <div>Total paid</div>
              <div>
                <Price :price="totalPaid" class="font-medium" />
              </div>
            </div>
            <div class="flex justify-between">
              <div>Principal paid</div>
              <div>
                <Price :price="listing.price" class="font-medium" />
              </div>
            </div>
            <div class="flex justify-between">
              <div>Interest paid</div>
              <div>
                <Price :price="totalInterest" class="font-medium" />
              </div>
            </div>
          </div>
        </div>
      </Box>

      <MakeOffer :price="listing.price" :listing-id="listing.id" :offer-made="offerMade" @offer-updated="offer = $event" />
    </div>
  </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { ref } from 'vue'

import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import MakeOffer from './Show/MakeOffer.vue'
import { computed } from 'vue'

const interestRate = ref(2.5)
const duration = ref(25)
const offer = ref(props.listing.price)

const props = defineProps({
  listing: Object,
  offerMade: Object,
})

const hasImages = computed(() => props.listing?.images?.length)

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
  offer, interestRate, duration,
)
</script>