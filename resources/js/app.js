import { createApp, h } from 'vue'
import { createInertiaApp, usePage } from '@inertiajs/vue3'
import DefaultLayout from './Layouts/default.vue'
import translationPlugin from './Plugins/translationPlugin'
import { useRoute } from './Composables/useRoute'
import 'boxicons/css/boxicons.min.css';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        const page = pages[`./Pages/${name}.vue`]
        page.default.layout = page.default.layout || DefaultLayout
        return page
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
        app.config.globalProperties.$useRoute = useRoute
        app.use(translationPlugin, { prop: 'translations' })
        app.use(plugin)
        app.mount(el)
    },
})
