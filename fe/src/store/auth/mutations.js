
export function setUser (state,user) {
    let data = {
        email : user.email,
        name: user.name,
        password: user.password,
        otp: '873497'
    }
    let data2 = {
        email : user.email,
        name: user.name,
        password: user.password,
        role: 'mentee'
    }
    state.user = data
    state.users.push(data2)
}

export function logUser(state,user){
    state.user = user
    state.user.status = 'aktif'
}

export function setAkt(state,data){
    state.user.status = data
}

