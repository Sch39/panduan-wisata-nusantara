<template>
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <i class="mx-auto text-6xl text-blue-500 bx bx-mail-send"></i>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Verify your email address</h2>
                <p class="mt-2 text-sm text-gray-600">
                    We have sent an email to <span class="font-medium text-gray-900">{{ props.userEmail }}</span>.
                    Please
                    check your inbox and click on the verification link.
                </p>
                <p v-if="isEmailSended" class="mt-2 text-sm text-green-600">
                    Verification email has been resent.
                </p>
                <p v-if="isEmailSendError" class="mt-2 text-sm text-red-600">
                    Get error when send email, please try again.
                </p>
            </div>
            <div>
                <button :disabled="isButtonDisabled" @click="resendEmail"
                    :class="{ '!bg-blue-300 cursor-not-allowed': isButtonDisabled }"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Resend Email
                </button>
                <p v-if="isEmailSended" class="mt-2 text-sm text-gray-600 text-center text-red-600">
                    Please wait {{ formattedTime }} before resending the email.
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>

import { ref, defineProps, computed } from 'vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ userEmail: { type: String, required: true } });

const isButtonDisabled = ref(false),
    isEmailSended = ref(false),
    isEmailSendError = ref(false)
const remainingTime = ref(0)
const form = useForm({})


const resendEmail = async () => {
    try {
        isButtonDisabled.value = true
        form.post('/email/confirmation-notification', {
            onSuccess(page) {
                isEmailSended.value = true
                remainingTime.value = 60
                startTimer()
            },
            onError(error) {
                isEmailSendError.value = true
                setTimeout(() => {
                    isEmailSendError.value = false
                    isButtonDisabled.value = false
                }, 1000);
            },

        })

    } catch (error) {
        console.error('Error resending email:', error)
    }
}

const startTimer = () => {
    const interval = setInterval(() => {
        remainingTime.value -= 1
        if (remainingTime.value <= 0) {
            clearInterval(interval)
            isButtonDisabled.value = false
            isEmailSended.value = false
        }
    }, 1000)
}

const formattedTime = computed(() => {
    const minutes = Math.floor(remainingTime.value / 60)
    const seconds = remainingTime.value % 60
    return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')} s`
})
</script>

<style scoped>
/* Additional styles if needed */
</style>
