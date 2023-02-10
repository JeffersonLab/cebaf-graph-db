<template>
    <body class="container">
    <header>
        <div class="row strapline">
<!--            <Link href="/">Home</Link>-->
<!--            <Link href="/about">About</Link>-->
<!--            <Link href="/contact">Contact</Link>-->
        </div>
    </header>
    <main>
        <slot/>
    </main>
    </body>
</template>

<script>
import {Link} from '@inertiajs/vue2'

export default {
    components: {
        Link,
    }
}
</script>
