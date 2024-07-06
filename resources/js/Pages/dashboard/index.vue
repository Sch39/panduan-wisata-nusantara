<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <h1>Dashboard</h1>

    <Link :href="$useRoute('/')" method="get">Home</Link>
</template>
