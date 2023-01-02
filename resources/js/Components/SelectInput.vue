<script setup>
defineProps([
    'items',
    'refer',
    'modelValue',
]);

defineEmits(['update:modelValue']);
</script>
<template>
    <select
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        >
        <option value="" disabled selected>-- Select --</option>
        <option
            v-for="item in items"
            :value="item.id"
            :key="item.id"
        >
            {{ refer ? item[refer] : item.name }}
        </option>
    </select>
</template>
