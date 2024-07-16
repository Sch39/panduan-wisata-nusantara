<template>
    <div class="fixed inset-0 flex z-40">
        <aside class="absolute flex h-screen overflow-y-auto"
            :class="[right ? 'right-0 flex-row' : 'left-0 flex-row-reverse']">
            <SideBarButton @click.prevent="toggle()" class="" />

            <Transition enter-active-class="transition-opacity ease-linear duration-300">
                <div class="transition-all overflow-hidden flex justify-center bg-white border-r pt-14"
                    :class="[open ? 'max-w-lg' : 'max-w-0']">
                    <SideBar />
                </div>
            </Transition>
        </aside>

    </div>

    <div class="m-5 ml-12">
        <slot />

    </div>
</template>

<script setup>
import SideBarButton from '../Components/UI/SideBarButton.vue';
import SideBar from '../Components/UI/SideBar.vue';
import { TransitionRoot } from '@headlessui/vue'

import { ref } from 'vue'
const open = ref(false),
    right = ref(false)

function toggle() {
    open.value = !open.value
}

</script>

<style>
/* .fade-enter-active,
.fade-leave-active {
    transition: opacity 1s ease-out;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
} */
</style>
