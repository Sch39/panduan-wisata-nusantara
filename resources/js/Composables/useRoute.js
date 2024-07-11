import { usePage } from "@inertiajs/vue3";

export function useRoute(url = '') {
    return `/${usePage().props.locale}${url}`
}

export function getLocale() {
    return usePage().props.locale
}

export function useRouteLangChange(langId) {
    let url = usePage().url
    url = url.replace(usePage().props.locale, langId)
    return url
}
