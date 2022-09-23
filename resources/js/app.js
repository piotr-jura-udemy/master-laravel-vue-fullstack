import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

createInertiaApp({
  resolve: async (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue')

    const page = await pages[`./Pages/${name}.vue`]()
    page.default.layout = page.default.layout || MainLayout

    return page
  },
  // function () {}
  // {el: xxx, App: xxx, props: xxx}
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})