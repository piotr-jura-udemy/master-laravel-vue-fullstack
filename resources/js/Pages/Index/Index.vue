<template>
  <div>Index</div>
  <Link href="/hello">Show Page</Link>
  <div>
    The message is {{ message }}
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps({ message: String })
</script>

<script>
import MainLayout from '../../Layouts/MainLayout.vue';
export default {
  layout: MainLayout
}
</script>