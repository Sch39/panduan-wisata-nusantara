import { usePage } from "@inertiajs/vue3";

export function useSharedData() {
    return usePage().props;
}
