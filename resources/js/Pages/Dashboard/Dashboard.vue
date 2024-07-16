<script setup>
import { Link, Head } from '@inertiajs/vue3';

</script>

<template>

    <Head>
        <title>Dashboard</title>
        <meta head-key="description" name="description" content="Dashboard" />
    </Head>

    <h1>Dashboard</h1>

    <Link :href="$useRoute('/')" method="get">Home</Link>

</template>
