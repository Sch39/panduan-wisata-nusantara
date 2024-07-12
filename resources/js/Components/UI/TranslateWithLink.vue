<template>
    <template v-for="el of translated">
        <slot name="text" v-if="el.type === 'text'" :value="el.value"></slot>
        <slot name="link" v-if="el.type === 'link'" :href="el.href" :value="el.text"></slot>
    </template>
</template>

<script setup>
import { computed, getCurrentInstance, defineProps } from 'vue'
const { proxy } = getCurrentInstance()

const props = defineProps({
    tKey: { type: String, required: true },
    replaces: { type: Object, required: true },
})

const translated = computed(() =>
    proxy.$translateWithLinks(props.tKey, props.replaces)
)

</script>
