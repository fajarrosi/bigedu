<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar class="bg-white"
      >
      
        <q-img src="~assets/logo/logo.png"  width="60px" class="q-my-none cursor-pointer" @click="$router.replace({ name: 'home' })"></q-img>
        <q-space />
        <q-btn flat round dense icon="menu" text-color="black" class="lt-md"/>
      <q-btn stretch flat label="Beranda" @click="$router.push({ name: 'home'})" text-color="black"  no-caps class="gt-sm"/>
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
        
      </q-toolbar>
    </q-header>

  

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>

export default ({
  name: 'MainLayout',
})
</script>
