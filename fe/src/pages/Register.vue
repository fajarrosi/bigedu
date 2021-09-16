<template >
    <q-page padding >
        <div class="row justify-center items-center login">
            <div class="col-sm-10">
                <div class="row justify-between items-center ">
                    <div class="col-sm-6 col-12 ">
                        <q-card class="my-card">
                            <q-card-section>
                                <q-form class="q-pa-lg" @submit="onSubmit">
                                    <q-input filled bottom-slots v-model="user.email" label="Email"
                                    lazy-rules
                                    :rules="[ val => val && val.length > 0 || 'Email tidak boleh kosong',val => validEmail(val)]"
                                    >
                                        <template v-slot:before>
                                        <q-icon name="email" />
                                        </template>
                                    </q-input>

                                    <q-input filled bottom-slots v-model="user.name" label="Nama"
                                    lazy-rules
                                    :rules="[ val => val && val.length > 0 || 'Nama tidak boleh kosong']"
                                    >
                                        <template v-slot:before>
                                        <q-icon name="perm_identity" />
                                        </template>
                                    </q-input>

                                    <q-input filled bottom-slots v-model="user.password" :type="visibility ? 'password' : 'text' " label="Password" 
                                    lazy-rules
                                    :rules="[val => val && val.length > 0 || 'Password tidak boleh kosong']"
                                    >
                                        <template v-slot:before>
                                        <q-icon name="key" />
                                        </template>

                                        <template v-slot:append>
                                            <q-icon :name="visibility ? 'visibility' : 'visibility_off' " @click="visibility = !visibility" class="cursor-pointer"/>
                                        </template>
                                    </q-input>
                                    <q-input filled bottom-slots v-model="user.password_confirmation" :type="visibility ? 'password' : 'text' " label="Konfirmasi Password" 
                                    lazy-rules
                                    :rules="[ val => val && val.length > 0 || 'konfirmasi password tidak boleh kosong', val => konfirmasi(val)]">
                                        <template v-slot:before>
                                        <q-icon name="key" />
                                        </template>

                                        <template v-slot:append>
                                        <q-icon :name="visibility ? 'visibility' : 'visibility_off' " @click="visibility = !visibility"/>
                                        </template>

                                    </q-input>
                                    <q-btn label="Daftar" type="submit" color="primary" style="width: 100%;" :loading="load" :disabled="btndisabled">
                                        <template v-slot:loading>
                                            <q-spinner-facebook />
                                        </template>
                                    </q-btn>
                                </q-form>
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
                email:'fajarilhamrosi@gmail.com',
                name:'fajarilhamrosi',
                password: 'admin',
                password_confirmation : 'admin'
            },
            visibility: true,
            load:false,
            btndisabled: false,
        }
    },
    methods: {
        validEmail(val){
            if(val.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)){
                return true;
            }else{
                return 'Email tidak valid';
            }
        },
        konfirmasi(val){
            if(val === this.user.password){
                return true;
            }else{
                return 'Password tidak sama';
            }
        },
        onSubmit(){
            this.load = true
            this.btndisabled = true
            setTimeout(()=>{
                this.$store.dispatch('auth/register',this.user)
                .then(()=>{
                    console.log("berhasil")
                    this.load = false
                    this.btndisabled = false
                })
                .catch(()=>{
                    console.log("gagal")
                })
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