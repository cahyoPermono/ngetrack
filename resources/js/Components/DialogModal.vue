<script setup>
import Modal from './Modal.vue';
import Alert from './Alert.vue';

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    alert: {
        type: Object,
        default: {},
    }
});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div class="px-6 py-4">
            <div class="text-lg">
                <slot name="title" />
            </div>

            <div class="mt-4">
                <div v-if="alert.type" class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <Alert :type="alert.type" :message="alert.message" />
                </div>
                <slot name="content" />
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
            <slot name="footer" />
        </div>
    </Modal>
</template>
