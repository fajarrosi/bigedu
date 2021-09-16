<template >
    <q-page padding >
        <div class="row justify-center items-center login">
                    <div class="col-md-4 col-8 ">
                        <q-card class="my-card">
                            <q-card-section>
                                <q-banner inline-actions class="text-white bg-red q-mb-md" v-if="Object.keys(errors).length">
                        OTP yang Anda Masukkan Salah <br>
                    </q-banner>
                    Masukkan 6 digit kode verifikasi yang dikirimkan ke <b>{{user.email}}</b> <br>
                    kode OTP kamu : <b>{{user.otp}}</b>
                    
                    <br>
                        <q-form
                        @submit="onSubmit"
                        >
                    <div class="row">
                            <q-input v-model="otp1" maxlength="1" mask="#" input-class="otp" input-style="text-align: center; font-size: 34px;" class="testing col q-mr-lg q-mt-lg"/>
                            <q-input v-model="otp2" maxlength="1" mask="#" input-class="otp" input-style="text-align: center; font-size: 34px;" class="testing col q-mr-lg q-mt-lg"/>
                            <q-input v-model="otp3" maxlength="1" mask="#" input-class="otp" input-style="text-align: center; font-size: 34px;" class="testing col q-mr-lg q-mt-lg"/>
                            <q-input v-model="otp4" maxlength="1" mask="#" input-class="otp" input-style="text-align: center; font-size: 34px;" class="testing col q-mr-lg q-mt-lg"/>
                            <q-input v-model="otp5" maxlength="1" mask="#" input-class="otp" input-style="text-align: center; font-size: 34px;" class="testing col q-mr-lg q-mt-lg"/>
                            <q-input v-model="otp6" maxlength="1" mask="#" input-class="otp" input-style="text-align: center; font-size: 34px;" class="testing col q-mr-lg q-mt-lg"/>
                            <span class="col-12 q-mt-lg" v-if="totalTime >= -1">Kirim Ulang : {{minute}}:{{second}}</span>
                    </div>
                    <div class="row">
                            <q-btn label="Kirim Ulang"  color="primary"  :loading="load2" :disabled="btndisabled2" class="col-md-4 q-mt-lg" no-caps v-if="totalTime < -1" @click="onKirimUlang">
                                <template v-slot:loading>
                                    <q-spinner-facebook />
                                </template>
                            </q-btn>
                    </div>
                    <q-btn label="Verifikasi" type="submit" :color="valid ? 'grey' : 'primary'" style="width: 100%;" :loading="load" :disabled="btn" class="q-mt-lg">
                            <template v-slot:loading>
                                <q-spinner-facebook />
                            </template>
                        </q-btn>
                    </q-form>
                            </q-card-section>
                        </q-card>
                    </div>
        </div>
    </q-page>
</template>
<script>
import { useQuasar } from 'quasar'
export default {
    setup(){
        const $q = useQuasar()
        return {
            showNotif () {
                $q.notify({
                message: 'OTP Berhasil Dikirim',
                type: 'info',
                position: 'top',
                progress: true
                })
            }
        }
    },
    data(){
        return{
            // user:{},
            load:false,
            btndisabled: true,
            errors:{},
            otp1:'',
            otp2:'',
            otp3:'',
            otp4:'',
            otp5:'',
            otp6:'',
            second:null,
            minute:null,
            totalTime:null,
            otp:'',
            btndisabled2:false,
            load2:false,
        }
    },
    computed:{
        valid(){
            if(this.otp1 && this.otp2 && this.otp3 && this.otp4 && this.otp5 && this.otp6){
                return false
            }else{
                return true
            }
        },
        btn(){
            if(!this.valid){
                if (this.btndisabled) {
                    return false
                }else{
                    return true
                }
            }else{
                return true
            }
        },
        user(){
            return this.$store.state.auth.user
        }
    },
    mounted(){
        this.nextSiblings()
    },
    created() {
        this.timer(120)
    },
    methods: {
        timer(time){
            this.totalTime = time
            this.second = '00'
            this.minute = '00'
            let mulai = setInterval(() => {
            this.minute = parseInt(this.totalTime /60,10)
            this.second = parseInt(this.totalTime  % 60,10)
            this.minute = this.minute < 10 ? '0' + this.minute : this.minute
            this.second = this.second < 10 ? '0' + this.second : this.second
            this.totalTime -=1
                if(this.totalTime === -1){
                    this.second = '00' 
                }
                if(this.totalTime < -1) {
                    clearInterval(mulai)
                }
            },1000)
        },
        onKirimUlang(){
            this.load2 = true
            this.btndisabled2 = true
            setTimeout(()=>{
                this.timer(120)
                this.showNotif()
                this.load2=false
                this.btndisabled2 = false
            },500)
        },
        nextSiblings(){
            let otps = document.getElementsByClassName('otp');
            Array.from(otps).forEach(function(otp,index){
                otp.addEventListener("keyup",function(e){
                    let grandparent = otp.parentNode.parentNode.parentNode.parentNode
                    if(otp.value.length === 1 && index !== 5){
                        let ns = grandparent.nextElementSibling
                        let next = ns.children[0].children[0].children[0].children[0]
                        next.focus()
                    }
                    if(index !== 0 && e.keyCode === 8){
                        let ps = grandparent.previousElementSibling
                        let prev = ps.children[0].children[0].children[0].children[0]
                        prev.focus()
                    }
                });
            })
        },
        onSubmit(){
            this.load = true
            this.btndisabled = false
            this.otp = this.otp1 + this.otp2 + this.otp3 + this.otp4 + this.otp5 + this.otp6
            setTimeout(()=>{
                if(this.otp === this.user.otp){
                    this.$store.dispatch("auth/otp",this.user)
                    this.load = false
                    this.btndisabled = true
                }
            },5000)
        }
    },
}
</script>
<style lang="scss">
    .login{
        margin-top: 100px;
    }
</style>