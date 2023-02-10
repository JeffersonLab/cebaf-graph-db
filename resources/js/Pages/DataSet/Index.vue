<template>
    <Layout>
        <Head><title>Data Sets</title></Head>
        <h1>Data Sets</h1>
        <b-table :items="dataSets" :fields="fields"></b-table>
    </Layout>
</template>

<script>
import Layout from '../Layout.vue'

export default {
    name: "Index",
    components: {
        Layout,
    },
    props: {
        dataSets: Array,
    },
    computed:{
        fields(){
            return [
                {key : 'id'},
                {key: 'comment'},
                {key: 'graphCount'},
            ]
        }
    }
}
</script>

<style scoped>

</style>
