import { usePage } from "@inertiajs/vue3";

export function useRoute(url = '') {
    return `/${usePage().props.locale}${url}`
}

export function getLocale() {
    return usePage().props.locale
}