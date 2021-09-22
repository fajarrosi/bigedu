<template >
    <q-page padding>
        <div class="row justify-center">
            <div class="col-12">
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

            <div class="col-md-3 q-pa-lg col-sm-6 col-12" v-for="webinar in getdata" :key="webinar">
                <q-card>
                    <q-skeleton height="300px" square v-if="initial"/>
                    <q-img src="https://cdn.quasar.dev/img/mountains.jpg" height="300px" v-else/>
                    <q-list  separator v-if="initial">
                            <q-item>
                                <q-item-section >
                                    <q-skeleton type="text" height="50px" />
                                    <q-skeleton type="text" height="100px" />
                                </q-item-section>
                            </q-item>
                            <q-item>
                                <q-item-section>
                                    <q-skeleton type="text" height="50px" />
                                </q-item-section>
                                <q-item-section thumbnail>
                                    <q-skeleton type="QBtn" height="30px" class="q-mr-md"/>
                                </q-item-section>
                            </q-item>
                    </q-list>
                    <q-card-section class="q-pb-none" v-else>
                        <div class="text-h6 text-justify ellipsis-3-lines">{{webinar.evTitle}}</div>
                    </q-card-section>
                    <q-card-section v-if="!initial">
                        <div class="text-caption ellipsis-3-lines text-justify">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae nesciunt dolores tenetur a eligendi reiciendis minima harum, debitis reprehenderit. Porro!
                        </div>
                    </q-card-section>
                    <q-separator v-if="!initial"/>
                    <q-card-actions align="around" v-if="!initial">
                        <q-icon name="event" />
                        30 Januari 2021
                        <q-btn label="Selengkapnya" no-caps class="text-primary" flat dense :to="{name:'webinar-detail',params: {id: webinar.id}}"/>
                    </q-card-actions>
                </q-card>
            </div>
            
        </div>
        <div class="q-pa-lg flex flex-center">
                <q-pagination
                v-model="page"
                color="primary"
                :max="Math.ceil(searchkey.length/totalPages)"
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
            page:1,
            totalPages:8,
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
            return this.$store.state.webinar.events
            .filter((webinar)=> webinar.evTitle.toLowerCase().includes(this.search.toLowerCase()))
            
        },
        getdata(){
            return this.searchkey
            .slice((this.page-1)*this.totalPages,(this.page-1)*this.totalPages+this.totalPages)
        }
    }   
}
</script>
