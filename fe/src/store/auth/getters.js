export const cekEmail = (state) => (email) => {
    return state.users.find(user => user.email === email)
}
/*
export function someGetter (state) {
}
*/
