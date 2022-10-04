<template>
  <span>
    {{ listing.street }} {{ listing.street_nr }}, {{
      listing.city }}
  </span>
</template>

<script setup>
defineProps({
  listing: Object,
})
</script>