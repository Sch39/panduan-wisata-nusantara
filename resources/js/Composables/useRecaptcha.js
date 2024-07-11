import { usePage } from "@inertiajs/vue3";

export function useRecaptcha(locale) {
    if (document.contains(document.getElementById('recaptcha'))) {
        document.getElementById('recaptcha')?.remove()
    }

    const props = usePage().props
    let recaptchaScript = document.createElement('script')
    recaptchaScript.setAttribute('id', 'recaptcha');
    let googleAPI = 'https://www.google.com/recaptcha/api.js'
    googleAPI += `?render=${props.grecaptcha_key}&hl=${locale}`
    recaptchaScript.setAttribute('src', googleAPI)
    document.head.appendChild(recaptchaScript)
}
