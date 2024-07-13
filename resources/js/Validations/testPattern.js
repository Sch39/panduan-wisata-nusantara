export function minOneLetter(value) {
    return /[a-zA-Z]/.test(value)
}

export function minOneLowerOneUpper(value) {
    return /[a-z]/.test(value) && /[A-Z]/.test(value)
}

export function minOneNumber(value) {
    return /\d/.test(value)
}

export function minOneSymbol(value) {
    return /[!@#$%^&*(),.?":{}|<>]/.test(value)
}
