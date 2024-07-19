<template>
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">{{ messages[usePage().props.locale].help.title }}</h1>
        <div class="space-y-6">
            <section v-for="(section, index) in helpSections" :key="index">
                <h2 class="text-2xl font-semibold mb-4">{{ section.title }}</h2>
                <p class="text-gray-700">{{ section.content }}</p>
            </section>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
const messages = {
    en: {
        help: {
            title: 'Help & Support',
            sections: [
                {
                    title: 'How to Use the Website',
                    content: 'Our website provides comprehensive information about various tourist destinations in Indonesia. ',
                },
                {
                    title: 'How to Contact Us',
                    content: 'If you have any questions or need further assistance, please contact us through the contact form on our website or send an email to sukron@sch39.dev.',
                },
                {
                    title: 'Privacy Policy',
                    content: 'We respect your privacy. Please read our privacy policy to understand how we collect, use, and protect your personal information.',
                },
                {
                    title: 'Frequently Asked Questions',
                    content: 'Visit our FAQ page to find answers to common questions about using our website, booking tours, and more.',
                },
            ],
        },
    },
    id: {
        help: {
            title: 'Bantuan & Dukungan',
            sections: [
                {
                    title: 'Cara Menggunakan Website',
                    content: 'Website kami menyediakan informasi lengkap tentang berbagai destinasi wisata di Indonesia. ',
                },
                {
                    title: 'Cara Menghubungi Kami',
                    content: 'Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, silakan hubungi kami melalui formulir kontak di situs web kami atau kirimkan email ke sukron@sch39.dev.',
                },
                {
                    title: 'Kebijakan Privasi',
                    content: 'Kami menghargai privasi Anda. Silakan baca kebijakan privasi kami untuk memahami bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.',
                },
                {
                    title: 'Pertanyaan yang Sering Diajukan',
                    content: 'Kunjungi halaman FAQ kami untuk menemukan jawaban atas pertanyaan umum tentang menggunakan situs web kami, memesan tur, dan banyak lagi.',
                },
            ],
        },
    },
};

const helpSections = computed(() => {
    return messages[usePage().props.locale].help.sections
})
</script>

<style scoped>
/* Optional: Add any additional styles here */
</style>
