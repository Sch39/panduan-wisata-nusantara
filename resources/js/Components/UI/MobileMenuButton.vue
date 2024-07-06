<template>
    <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
            @click="$emit('toggleMobileMenu')">
            <span class="sr-only">Open main menu</span>
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
        </button>
    </div>
</template>

<script setup>
import { Bars3Icon } from '@heroicons/vue/24/outline';

</script>
