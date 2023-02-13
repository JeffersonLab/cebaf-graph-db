<template>
    <Layout>
        <Head><title>Data Sets</title></Head>
        <h1>Data Sets</h1>
        <h2>        {{route('data-sets.show',[1])}}</h2>
        <b-table :items="dataSets" :fields="fields">
            <!-- A custom formatted column -->
            <template #cell(id)="data">
                <b-link :href="route('data-sets.show',[data.value])">{{ data.value}}</b-link>
            </template>
        </b-table>
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
