export function register (context,user) {
    return new Promise((resolve,reject) =>{
        if(user){
            context.commit('setUser',user)
            this.$router.push('/otp')
            resolve("user created")
        }else{
            reject("user failed register")
        }
    })
}

export function login(context,user){
    return new Promise ((resolve,reject)=>{
        if (user){
            context.commit('logUser',user)
            this.$router.push('/')
            resolve("user loggin")
        }else{
            reject("user failed login")
        }
    })
}

export function otp(context,user){
    return new Promise((resolve,reject)=>{
        if(user){
            context.commit('setAkt','aktif')
            this.$router.push('/')
        }
    })
}

