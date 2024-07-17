export function useNameInitials(name) {
    const names = name.split(' ')
    const initials = names.map(name => name.charAt(0)).join('').toUpperCase()
    return initials.slice(0, 2)
}
