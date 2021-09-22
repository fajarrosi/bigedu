<template >
    <q-page padding>
        <h1>Webinar Detail</h1>        
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
    }
}
</script>
