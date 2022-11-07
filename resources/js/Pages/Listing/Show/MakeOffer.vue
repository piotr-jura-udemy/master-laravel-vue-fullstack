<template>
  <Box v-if="!offerMade">
    <template #header>Make an Offer</template>
    <div>
      <form @submit.prevent="makeOffer">
        <input
          v-model.number="form.amount" type="text"
          class="input"
        />
        <input
          v-model.number="form.amount" type="range" :min="price / 2"
          :max="price * 2" step="1000"
          class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
        />
  
        <button
          type="submit"
          class="btn-outline w-full mt-2 text-sm"
        >
          Make an Offer
        </button>
      </form>
    </div>
    <div class="flex justify-between text-gray-500 mt-2">
      <div>Difference</div>
      <div>
        <Price :price="form.amount - props.price" class="font-medium" />
      </div>
    </div>
  </Box>
  <Box v-else>
    <template #header>Offer Made</template>
    <Price :price="offerMade.amount" class="text-3xl" />

    <section class="mt-2 flex flex-col md:flex-row justify-between text-gray-500">
      <div>Made on</div>
      <div class="text-gray-400">{{ new Date(offerMade.created_at).toDateString() }}</div>
    </section>

    <section
      class="mt-1 flex flex-col md:flex-row justify-between text-gray-500"
    >
      <div>Made on</div>
      <div class="text-gray-400">
        {{ new
          Date(offerMade.created_at).toDateString() }}
      </div>
    </section>
  </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { /*ref, */watch } from 'vue'
import { debounce } from 'lodash'
import Price from '@/Components/Price.vue'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  listingId: Number,
  price: Number,
  offerMade: Object,
})
const form = useForm({
  amount: props.price,
})
const emit = defineEmits(['offerUpdated'])
// const offer = ref(props.price)
watch(() => form.amount, debounce((value) => {
  emit('offerUpdated', value)
}, 500))
const makeOffer = () => form.post(
  route('listing.offer.store', { listing: props.listingId }), { preserveScroll: true, preserveState: true },
)
</script>