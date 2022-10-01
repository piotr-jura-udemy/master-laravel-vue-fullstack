<template>
  <Link href="/listing">Listings</Link>&nbsp;
  <Link href="/listing/create">New Listing</Link>
  <!-- <div>The page with time {{ timer }}</div> -->
  <div v-if="flashSuccess" class="success">
    {{ flashSuccess }}
  </div>
  <slot>Default</slot>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/inertia-vue3'

// const x = ref(0)
// const y = computed(() => x.value * 2)

const page = usePage()
const flashSuccess = computed(
  () => page.props.value.flash.success,
)
// import { ref } from 'vue'

// const timer = ref(0)
// setInterval(() => timer.value++, 1000)
</script>

<style scoped>
  .success {
    background-color: green;
    color: white;
  }
</style>