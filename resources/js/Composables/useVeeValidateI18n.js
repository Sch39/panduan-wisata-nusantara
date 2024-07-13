import { configure, defineRule } from 'vee-validate'
import { localize, setLocale } from '@vee-validate/i18n'
import id from './../../../lang/Inertia/validations/id.json'
import en from './../../../lang/Inertia/validations/en.json'
import { usePage } from '@inertiajs/vue3'
import { email, required, digits } from '@vee-validate/rules'
import { minOneLetter, minOneLowerOneUpper, minOneNumber, minOneSymbol } from '../Validations/testPattern'


export function useVeeValidateI18n() {
    rules(usePage().props.locale)

    configure({
        generateMessage: localize({ id: { names: id.fields, messages: id.messages }, en: { names: en.fields, messages: en.messages } }),
        validateOnBlur: true,
    })
    setLocale(usePage().props.locale)
}

function rules(locale) {
    defineRule('required', required)
    defineRule('email', email)
    defineRule('password', (value) => {
        const messages = locale === 'id' ? id.messages.password : en.messages.password;
        const { password } = locale.value === 'id' ? id.fields : en.fields;

        if (!minOneLetter(value)) {
            return messages.letters.replace('{field}', password)
        }
        if (!minOneLowerOneUpper(value)) {
            return messages.mixed.replace('{field}', password)
        }
        if (!minOneNumber(value)) {
            return messages.numbers.replace('{field}', password)
        }
        if (!minOneSymbol(value)) {
            return messages.symbols.replace('{field}', password)
        }

        return true
    })

}
