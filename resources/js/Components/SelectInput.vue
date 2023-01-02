<script setup>
defineProps(["items", "refer", "modelValue"]);

defineEmits(["update:modelValue"]);
</script>
<template>
    <select
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
        <option value="" disabled selected>-- Select --</option>
        <option v-for="item in items" :value="item.id" :key="item.id">
            {{ refer ? item[refer] : item.name }}
        </option>
    </select>
</template>
