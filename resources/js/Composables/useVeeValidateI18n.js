import { configure, defineRule } from 'vee-validate'
import { localize, setLocale } from '@vee-validate/i18n'
import id from './../../../lang/Inertia/validations/id.json'
import en from './../../../lang/Inertia/validations/en.json'
import { usePage } from '@inertiajs/vue3'
import { email, required, digits, min, alpha_spaces } from '@vee-validate/rules'
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
    defineRule('digits', digits)
    defineRule('min', min)
    defineRule('alpha_spaces', alpha_spaces)

    // custom rules
    const messages = locale === 'id' ? id.messages : en.messages;
    const fields = locale === 'id' ? id.fields : en.fields

    // defineRule('confirmed', confirmed)
    defineRule('confirmed', (value, [target], ctx) => {
        if (value !== ctx.form[target]) {
            return messages.confirmed.replace('{field}', fields[ctx.name]).replace('{target}', fields[target])
        }
        return true
    })

    defineRule('accepted', (value, [target], ctx) => {
        if (value === 'on') {
            return messages.accepted.replace('{field}', fields[ctx.name])
        }
        return true
    })


    defineRule('password', (value) => {
        const { password } = fields

        if (!minOneLetter(value)) {
            return messages.password.letters.replace('{field}', password)
        }
        if (!minOneLowerOneUpper(value)) {
            return messages.password.mixed.replace('{field}', password)
        }
        if (!minOneNumber(value)) {
            return messages.password.numbers.replace('{field}', password)
        }
        if (!minOneSymbol(value)) {
            return messages.password.symbols.replace('{field}', password)
        }

        return true
    })

}
