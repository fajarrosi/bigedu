<template >
    <q-page padding>
        <div class="row justify-center">
            <div class="col-8">
                <q-card>
                    <q-card-section>
                        <q-skeleton type="QInput" v-if="initial"/>
                        <q-input filled bottom-slots v-model="search" label="Search" type="search" v-else>
                            <template v-slot:before>
                            <q-icon name="search"/>
                            </template>
                        </q-input>
                    </q-card-section>
                </q-card>
            </div>
        </div>
        <div class="row justify-start justify-sm-center ">
            
            <!-- <div class="col-md-3 q-pa-lg col-sm-5 col-10" v-for="webinar in webinars" :key="webinar">
                <q-card>
                    <q-card-section class="q-pa-lg">
                        <q-skeleton type="text" height="50px" v-if="initial"/>
                        <h6 class="q-my-none" v-else>{{webinar.evTitle}}</h6>
                        <q-skeleton height="150px" square v-if="initial"/>
                        <q-img  :src="'ilustrasi/'+webinar.evThumbnails"  class="q-mt-lg" v-else/>
                        <q-separator class="bg-black q-mt-lg"></q-separator>
                        <q-skeleton type="text" height="50px" v-if="initial"/>
                        <p class="date q-mt-lg" v-else>
                            {{webinar.diff}}
                        </p>
                    </q-card-section>
                </q-card>
            </div> -->

            <div class="col-md-3 q-pa-lg col-sm-5 col-10" v-for="webinar in searchkey" :key="webinar">
                <q-card>
                    <q-card-section >
                        <q-list  separator>
                            <q-item >
                                <q-item-section v-if="initial">
                                    <q-skeleton type="text" height="50px" />
                                    <q-skeleton height="150px" square />
                                </q-item-section>
                                <q-item-section v-else>
                                    <q-item-label class="text-primary text-justify  text-body1 web-title">{{webinar.evTitle}}</q-item-label>
                                    <q-img src="https://cdn.quasar.dev/img/mountains.jpg" class="q-mt-lg"/>
                                </q-item-section>
                            </q-item>

                            <q-item >
                                <q-item-section v-if="initial">
                                    <div class="row justify-between">
                                    <q-skeleton type="text" height="50px" class="col-7 col-md-5"/>
                                    <q-skeleton type="QBtn" height="50px" class="col-4 col-md-5"/>

                                    </div>
                                </q-item-section>
                                <q-item-section v-else>
                                <q-item-label caption>
                                    <div class="row justify-between items-center">
                                        <div class="col-8 col-md-6">
                                            <q-icon name="event" />
                                            {{webinar.diff}}
                                        </div>
                                        <q-btn color="primary" label="Daftar" class="col-4 col-md-6"/>
                                    </div>
                                </q-item-label>
                                </q-item-section>
                            </q-item>
                        </q-list>
                    </q-card-section>
                </q-card>
            </div>
            
        </div>
        <div class="q-pa-lg flex flex-center">
                <q-pagination
                v-model="current"
                color="primary"
                :max="10"
                :max-pages="6"
                boundary-numbers
                />
        </div>

        
        
    </q-page>
</template>
<script>
export default {
    data(){
        return{
            search:'',
            current:1,
            load:false,
            btndisabled:false,
            initial:true,
        }
    },
    mounted(){
        this.onGetData()
    },
    methods: {
        onSearch(){
            this.load = true
            this.btndisabled = true
            setTimeout(()=>{
                this.load = false
                this.btndisabled = false
            },5000)
        },
        onGetData(){
            setTimeout(()=>{
                this.initial = false
            },5000)
        }
    },
    computed:{
        searchkey(){
            return this.$store.state.webinar.events.filter((webinar)=> webinar.evTitle.toLowerCase().includes(this.search.toLowerCase()))
        }
    }   
}
</script>
<style lang="scss">
    .web-title{
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* number of lines to show */
        -webkit-box-orient: vertical;
        max-height: 3.6em;
        overflow: hidden;
    }
</style>