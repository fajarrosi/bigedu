<template>
  <div class="q-pa-md">
    <q-layout view="hHh Lpr lff"  class="shadow-2 rounded-borders">
      <q-header elevated class="bg-white">
        <q-toolbar 
        >
        
          <q-img src="~assets/logo/logo.png"  width="60px" class="q-my-none cursor-pointer" @click="$router.replace({ name: 'home' })"></q-img>
          <q-space />
        <q-btn flat round dense icon="menu" text-color="black" class="lt-md" @click="drawerLeft = !drawerLeft"/>
        <!-- <q-btn stretch flat label="Beranda" @click="$router.push({ name: 'home'})" text-color="black"  no-caps class="gt-sm"/>
          <q-btn-dropdown auto-close stretch flat label="Services & Produk Kami" no-caps text-color="black" class="gt-sm">
            <q-list>
              <q-item clickable @click="$router.push({ name: 'blog'})">
                <q-item-section>Webinar</q-item-section>
              </q-item>

              <q-item clickable @click="$router.push({ name: 'blog'})">
                <q-item-section>Research Academy</q-item-section>
              </q-item>
              <q-item clickable @click="$router.push({ name: 'blog'})">
                <q-item-section>Inhouse Training & Consultancy</q-item-section>
              </q-item>
            </q-list>
          </q-btn-dropdown>
          <q-btn stretch flat label="Blog" @click="$router.push({ name: 'blog'})" text-color="black"  no-caps class="gt-sm"/>
          <q-btn stretch flat label="Mentor" @click="$router.push({ name: 'mentor'})" text-color="black"  no-caps class="gt-sm"/>
        <q-space class="gt-sm"/>
        <q-btn stretch flat label="Masuk" @click="$router.push({ name: 'masuk'})" text-color="black"  no-caps class="gt-sm"/>
        <q-btn stretch flat label="Daftar" text-color="black"  no-caps @click="$router.push({ name: 'daftar'})" class="gt-sm"/>
          -->

          <q-tabs class="text-black gt-sm" no-caps>
            <q-route-tab 
              v-for="t in tabs" :key="t"
              :label="t.label"
              :to="t.route"
              exact
              active-class="custom-active"
              content-class="own-size"

            />
          </q-tabs>
          <q-space class="gt-sm"/>
          <q-tabs class="text-black gt-sm" no-caps>
            <q-route-tab 
              v-for="t in auth" :key="t"
              :label="t.label"
              :to="t.route"
              exact
              active-class="custom-active"
              content-class="own-size"
              
            />
          </q-tabs>
        </q-toolbar>
      </q-header>

      <q-drawer
          v-model="drawerLeft"
          :width="200"
          :breakpoint="700"
          elevated
          class="bg-white text-black"
        >
          <q-scroll-area class="fit">
            <div class="q-pa-sm ">
              <q-tabs class="text-black martop" no-caps vertical>
            <q-route-tab 
              v-for="t in tabs" :key="t"
              :label="t.label"
              :to="t.route"
              exact
              active-class="custom-active"
              content-class="own-size"
              @click="drawerLeft = !drawerLeft"
            />
          </q-tabs>
          <q-space class="gt-sm"/>
          <q-tabs class="text-black" no-caps vertical>
            <q-route-tab 
              v-for="t in auth" :key="t"
              :label="t.label"
              :to="t.route"
              exact
              active-class="custom-active"
              content-class="own-size"
              @click="drawerLeft = !drawerLeft"
            />
          </q-tabs>
            </div>
          </q-scroll-area>
        </q-drawer>

    

      <q-page-container>
        <router-view />
      </q-page-container>
    </q-layout>
  </div>
</template>

<script>
const tabs = [
  {
    label : 'Beranda',
    route : { name: 'home' },
  },
  {
    label : 'Webinar',
    route : { name: 'all' },
  },
  {
    label : 'Research Academy',
    route : { name: 'all' },
  },
  {
    label : 'Inhouse Training & Consultancy',
    route : { name: 'all' },
  },
  {
    label : 'Blog',
    route : { name: 'blog' },
  }
]

const auth = [
  {
    label : 'Masuk',
    route : { name: 'masuk' },
  },
  {
    label : 'Daftar',
    route : { name: 'daftar' },
  }
]

export default ({
  name: 'MainLayout',

  data(){
    return {
      tabs,
      auth,
      drawerLeft : false
    }
  },
  methods:{
    draw(){
        if (this.me === 'masuk') {
            return {name: 'daftar'}
        }
    }
  }
})
</script>

<style lang="scss">
  .custom-active{
    color: crimson !important;
  }
  
  .own-size {
    .q-tab__label{
      font-size: 12px; 
    }
  }
  .martop{
    margin-top: 60px;
  }
    
  
 
</style>
