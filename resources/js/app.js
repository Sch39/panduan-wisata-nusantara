import { createApp, h } from 'vue'
import { createInertiaApp, usePage } from '@inertiajs/vue3'
import DefaultLayout from './Layouts/Default.vue'
import DashboardLayout from './Layouts/Dashboard.vue'
import translationPlugin from './Plugins/translationPlugin'
import { useRoute } from './Composables/useRoute'
import 'boxicons/css/boxicons.min.css';
import Toast, { POSITION } from 'vue-toastification'
import 'vue-toastification/dist/index.css'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        const page = pages[`./Pages/${name}.vue`]
        let layoutApplied = page.default.layout || DefaultLayout
        layoutApplied = name.startsWith('Dashboard/') ? [DefaultLayout, DashboardLayout] : layoutApplied
        page.default.layout = layoutApplied
        return page
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
        app.config.globalProperties.$useRoute = useRoute
        app.use(translationPlugin, { prop: 'translations' })
        app.use(plugin)
        app.use(Toast, {
            position: POSITION.TOP_RIGHT,
            timeout: 5000,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            draggablePercent: 0.6,
            showCloseButtonOnHover: false,
            hideProgressBar: false,
            closeButton: "button",
            icon: true,
            maxToasts: 5,
            rtl: false,
            transition: "Vue-Toastification__fade",
        })
        app.mount(el)
    },
})
