<template >
    <q-page padding >
        <div class="row justify-center items-center login">
            <div class="col-sm-10" >
                <div class="row justify-between items-center ">
                    <div class="col-sm-6 col-12 ">
                        <q-card class="q-pa-lg">
                            <q-card-section>
                                <q-form ref="formRef">
                                    <q-input filled bottom-slots v-model="user.email" label="Email"
                                    lazy-rules = "ondemand" 
                                    :rules="[ val => val && val.length > 0 || 'Email tidak boleh kosong', cekEmail]"
                                    >
                                        <template v-slot:before>
                                        <q-icon name="email" />
                                        </template>
                                    </q-input>

                                    <q-input filled bottom-slots v-model="user.password" :type="visibility ? 'password' : 'text' " label="Password" 
                                    lazy-rules = "ondemand"
                                    :rules="[val => val && val.length > 0 || 'Password tidak boleh kosong',cekPass]"
                                    >
                                        <template v-slot:before>
                                        <q-icon name="key" />
                                        </template>

                                        <template v-slot:append>
                                            <q-icon :name="visibility ? 'visibility' : 'visibility_off' " @click="visibility = !visibility" class="cursor-pointer"/>
                                        </template>
                                    </q-input>
                                </q-form>
                                    <q-btn label="Masuk"  color="primary" style="width: 100%;" :loading="load" :disabled="btndisabled" @click="onSubmit">
                                        <template v-slot:loading>
                                            <q-spinner-facebook />
                                        </template>
                                    </q-btn>
                            </q-card-section>
                        </q-card>
                    </div>
                    <div class="col-sm-5 ">
                        <q-img
                        src="ilustrasi/login.svg"
                        />
                    </div>
                </div>
            </div>
        </div>
    </q-page>
</template>
<script>
export default {
    data(){
        return{
            user:{
                email:'admin@gmail.com',
                password:'admin'
            },
            visibility: true,
            load:false,
            btndisabled: false,
            cek:false,
            cekpass:false
        }
    },
    methods:{
        onSubmit(){
            this.load =true
            this.btndisabled = true
            setTimeout(()=>{
                let email = this.$store.getters["auth/cekEmail"](this.user.email)
                console.log(email)
                if(email){
                    this.cek = true
                    if (this.user.password === email.password) {
                        this.cekpass = true
                    }else{
                        this.cekpass = false
                    }
                }else{
                    this.cek = false
                }
                    this.$refs.formRef.validate()
                    this.load =false
                    this.btndisabled = false
                    if (this.cek && this.cekpass) {
                        this.$store.dispatch('auth/login',email)
                    }
            },5000)
        },
        cekEmail(){
            return this.cek || 'email tidak ditemukan'
        },
        cekPass(){
            return this.cekpass || 'password salah'
        }
        
    }
}
</script>
<style lang="scss">
    .login{
        margin-top: 100px;
    }
</style>