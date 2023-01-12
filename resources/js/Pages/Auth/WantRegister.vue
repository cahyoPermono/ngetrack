<template>
    <div class="flex h-screen justify-center items-center bg-gray-900">
        <div class="text-center text-gray-300">
            <h1 class="text-3xl mb-2">Limited Registration</h1>
            <p class="text-xl">Please Contact Your Administrator For Registration</p>
            <Link
                :href="route('login')"
                class="underline text-sm hover:text-gray-400"
            >
                Back
            </Link>
        </div>
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>
