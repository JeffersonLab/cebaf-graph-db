<template>
    <Layout>
        <Head><title>Data Sets</title></Head>
        <h1>Data Sets</h1>
        <b-table :items="dataSets" :fields="fields">
            <!-- A custom formatted column -->
            <template #cell(id)="data">
                <b-link :href="route('data-sets.show',[data.value])">{{ data.value}}</b-link>
            </template>
            <!-- A custom formatted column -->
            <template #cell(download)="data">
                <b-link :href="route('data-sets.zip',[data.item.id])">
                    <b-icon icon="download" aria-hidden="true"></b-icon>
                </b-link>
            </template>
        </b-table>
    </Layout>
</template>

<script>
import Layout from '../Layout.vue'

export default {
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
                {key: 'download'}
            ]
        },
        tableData(){

        }
    }
}
</script>

<style scoped>

</style>
