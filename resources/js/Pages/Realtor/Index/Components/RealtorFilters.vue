<template>
  <form>
    <div class="mb-4 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center gap-2">
        <input
          id="deleted"
          v-model="filterForm.deleted"
          type="checkbox" 
          class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
        />
        <label for="deleted">Deleted</label>
      </div>
    </div>
  </form>
</template>

<script setup>
import { reactive, watch } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import {debounce} from 'lodash'

const filterForm = reactive({
  deleted: false,
})
// reactive / ref / computed
watch(
  // 0.5s - cancelled
  // 
  filterForm, debounce(() => Inertia.get(
    route('realtor.listing.index'),
    filterForm,
    { preserveState: true, preserveScroll: true },
  ), 1000),
)
</script>