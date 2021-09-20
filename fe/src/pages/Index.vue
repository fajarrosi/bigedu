<template>
  <q-page padding>
    <section class="value">
      <div class="row q-pa-lg items-center justify-around">
        <div class="col-md-5 col-12">
          <h2>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt omnis doloremque quas incidunt </h2>
        </div>
        <div class="col-md-5 col-12">
          <q-img  src="ilustrasi/login.svg" />
        </div>
      </div>
    </section>
    <section class="about">
      <div class="row items-center q-mt-lg justify-around">
        <div class="col-md-5 col-12 q-pa-lg">
          <q-img  src="ilustrasi/login.svg" />
        </div>
        <div class="col-md-5 col-12">
          <h4 class="q-my-sm">Tentang Kami</h4>
          <h6 class="q-my-sm">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi, earum.
          </h6>
          <q-btn label="Selengkapnya"  color="primary"  :loading="load" :disabled="btndisabled" >
              <template v-slot:loading>
                  <q-spinner-facebook />
              </template>
          </q-btn>
        </div>
      </div>
    </section>
    <section class="product">
      <div class="row justify-around items-center">
        <div class="col-12 text-center text-primary">
          <h4>Produk dan Servis Kami</h4>
        </div>
        <div class="col-md-5 col-12 q-pa-lg">
          <q-img  src="ilustrasi/login.svg" />
        </div>
        <div class="col-md-5 col-12 q-pa-sm">
          <h4 class="q-my-sm">Webinar</h4>
          <h6 class="q-my-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, tempore!</h6>
          <q-btn label="Selengkapnya"  color="primary"  :loading="load" :disabled="btndisabled" >
              <template v-slot:loading>
                  <q-spinner-facebook />
              </template>
          </q-btn>
        </div>
        <div class="col-md-5 col-12 q-pa-lg">
          <q-img  src="ilustrasi/login.svg" />
        </div>
        <div class="col-md-5 col-12">
          <h4 class="q-my-sm">Research Academy</h4>
          <h6 class="q-my-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, tempore!</h6>
          <q-btn label="Selengkapnya"  color="primary"  :loading="load" :disabled="btndisabled" >
              <template v-slot:loading>
                  <q-spinner-facebook />
              </template>
          </q-btn>
        </div>
        <div class="col-md-5 col-12 q-pa-lg">
          <q-img  src="ilustrasi/login.svg" />
        </div>
        <div class="col-md-5 col-12">
          <h4 class="q-my-sm">Inhouse Training & Consultancy</h4>
          <h6 class="q-my-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, tempore!</h6>
          <q-btn label="Selengkapnya"  color="primary"  :loading="load" :disabled="btndisabled" >
              <template v-slot:loading>
                  <q-spinner-facebook />
              </template>
          </q-btn>
        </div>
      </div>
    </section>
    <section class="mentor">
      <div class="row">
        <div class="col-12 text-center text-primary">
          <h4>Mentor kami</h4>
        </div>
      </div>
    </section>
    <section class="testimoni">
      <div class="row">
        <div class="col-12 text-center text-primary">
          <h4>Testimoni</h4>
        </div>
      </div>
    </section>
    <section class="why">
      <div class="row">
        <div class="col-12 text-center text-primary">
          <h4>Mengapa Memililh Kami ? </h4>
        </div>
      </div>
    </section>
    <section class="klien">
      <div class="row">
        <div class="col-12 text-center text-primary">
          <h4>Klien kami</h4>
        </div>
      </div>
    </section>
    <section class="post">
      <div class="row">
        <div class="col-12 text-center text-primary">
          <h4>Artikel Terbaru</h4>
        </div>
      </div>
    </section>
    <section class="msg">
      <div class="row">
        <div class="col-12 text-center text-primary">
          <h4>Apakah ingin info terbaru dari kami </h4>
        </div>
      </div>
    </section>
  </q-page>
</template>

<script>

export default ({
  data(){
    return {
      btndisabled:false,
      load:false
    }
  }
})
</script>
