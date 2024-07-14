<!-- resources/js/Pages/Error.vue -->
<template>
    <div class="error-page">
        <h1>{{ errorCode }}</h1>
        <p>{{ errorMessage }}</p>
        <Link href="/">Go back to Home</Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/vue3'
export default {
    props: {
        errorCode: {
            type: Number,
            required: true,
        },
        errorMessage: {
            type: String,
            required: true,
        },
    },
}
</script>

<style>
.error-page {
    text-align: center;
    margin-top: 50px;
}
</style>
