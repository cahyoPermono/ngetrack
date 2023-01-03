<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div v-if="type === 'success'">
        <div class="rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <CheckCircleIcon
                        class="h-5 w-5 text-green-400"
                        aria-hidden="true"
                    />
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ message }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
        <div class="rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <XCircleIcon
                        class="h-5 w-5 text-red-400"
                        aria-hidden="true"
                    />
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">
                        {{ message }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// import { CheckCircleIcon, XCircleIcon } from "@heroicons/vue/20/solid";

defineProps({
    type: {
        type: String,
        default: "success",
    },
    message: {
        type: String,
        default: "Alert",
    },
});
</script>
