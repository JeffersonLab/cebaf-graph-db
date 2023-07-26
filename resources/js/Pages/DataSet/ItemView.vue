<template>
    <Layout>
        <Head><title>Data Set #{{dataSet.id}}</title></Head>
        <h1>Data Set #{{ dataSet.id }}</h1>
        <h2>{{ dataSet.comment }}</h2>
        <h3>Configuration</h3>
        <div class="row">
            <div class="col">
                <pre><code class="language-yaml">{{ configFile }}</code></pre>
            </div>
        </div>
        <h3>Models</h3>
        <div class="row">
            <div class="col">
                <p>The table below lists models trained on the current data set</p>
                <b-table :items="[]"></b-table>
            </div>
        </div>
        <h3>Data</h3>
        <div class="row">
            <div class="col">
                <p>The table below lists the graph data that comprise the data set.</p>
                <b-table :items="dataSet.data"></b-table>
            </div>
        </div>

    </Layout>
</template>

<script>
import Layout from '../Layout.vue'
import {Head} from '@inertiajs/vue2'

export default {
    components: {
        Layout,
        Head
    },
    props: {
        dataSet: Object,
    },
    computed: {
        configFile() {
            return this.dataSet.config
        }
    }
}
</script>

<style scoped>
pre {
    display: block;
    height: 400px;
    width:100%;
    resize: both;
    overflow: auto;
}
h3 {
    border-top: 1px solid;
}
</style>

