<template>
    <main>
        <slot/>
    </main>
</template>

<script>
import {Link} from '@inertiajs/vue2'

export default {
    components: {
        Link,
    }
}
</script>
