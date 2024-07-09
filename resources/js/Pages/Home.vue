<template>

    <Head>
        <title>{{ __('pages.home.title') }}</title>
        <meta head-key="description" name="description" :content="__('pages.home.meta_description')" />
    </Head>
    <BaseJumbotron :title="__('pages.home.jumbotron_title')" :description="__('pages.home.jumbotron_description')"
        :link="$useRoute('/dashboard')" :link-text="__('pages.home.jumbotron_button').toUpperCase()" />

</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import BaseJumbotron from './../Components/UI/BaseJumbotron.vue'
</script>
