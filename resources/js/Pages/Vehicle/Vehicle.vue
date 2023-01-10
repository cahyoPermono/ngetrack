<template>
    <app-layout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4"
                >
                    <div
                        class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                        role="alert"
                        v-if="$page.props.flash.message"
                    >
                        <div class="flex">
                            <div>
                                <p class="text-sm">
                                    {{ $page.props.flash.message }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <PrimaryButton @click="openModal()" class="my-3">
                        Create New Vehicle
                    </PrimaryButton>
                    <span class="ml-2">
                        <PrimaryButton @click="openUploadModal()" class="my-3">
                            Upload Vehicle Picture
                        </PrimaryButton>
                    </span>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-60">Plate Number</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Type</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in data" :key="row.id">
                                <td class="border px-4 py-2">
                                    {{ row.plate }}
                                </td>
                                <td class="border px-4 py-2">{{ row.name }}</td>
                                <td class="border px-4 py-2">{{ row.type }}</td>
                                <td class="border px-4 py-2">
                                    <PrimaryButton
                                        @click="edit(row)"
                                        class="mr-2"
                                    >
                                        Edit
                                    </PrimaryButton>
                                    <SecondaryButton
                                        @click="show(row)"
                                        class="mr-2"
                                    >
                                        Picture
                                    </SecondaryButton>
                                    <DangerButton @click="deleteRow(row)">
                                        Delete
                                    </DangerButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <DialogModal :show="isOpen" @close="closeModal" :alert="alert">
            <template #title> Create Vehicle </template>
            <template #content>
                <form>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="">
                            <div class="mb-4">
                                <InputLabel for="name" value="Vehicle Name:" />
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    placeholder="Enter Vehicle Name"
                                />
                                <InputError :message="errors.name" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="type" value="Vehicle Type:" />
                                <TextInput
                                    id="type"
                                    v-model="form.type"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    placeholder="Enter Vehicle Type"
                                />
                                <InputError :message="errors.type" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="plate" value="Plate Number:" />
                                <TextInput
                                    id="plate"
                                    v-model="form.plate"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    placeholder="Enter Vehicle License/Plate Number"
                                />
                                <InputError :message="errors.plate" />
                            </div>
                        </div>
                    </div>
                </form>
            </template>
            <template #footer>
                <span
                    class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"
                >
                    <SecondaryButton
                        @click="closeModal()"
                        type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    >
                        Cancel
                    </SecondaryButton>
                </span>
                <span
                    class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                >
                    <PrimaryButton
                        wire:click.prevent="store()"
                        type="button"
                        v-show="!editMode"
                        @click="save(form)"
                    >
                        Save
                    </PrimaryButton>
                </span>
                <span
                    class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                >
                    <PrimaryButton
                        wire:click.prevent="store()"
                        type="button"
                        v-show="editMode"
                        @click="update(form)"
                    >
                        Update
                    </PrimaryButton>
                </span>
            </template>
        </DialogModal>
        <DialogModal :show="isPicOpen" @close="closePicModal">
            <template #title>Vehicle Picture </template>
            <template #content>
                <ImagesWithDetail :images="images" />
            </template>
            <template #footer>
                <span
                    class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"
                >
                    <SecondaryButton
                        @click="closePicModal()"
                        type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    >
                        Back
                    </SecondaryButton>
                </span>
            </template>
        </DialogModal>
        <DialogModal :show="isUploadOpen" @close="closeUploadModal">
            <template #title>Upload Vehicle Picture</template>
            <template #content>
                <form @submit.prevent="submit">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <InputLabel value="Vehicle:" for="vehicles" />
                            <SelectInput
                                id="vehicles"
                                :items="data"
                                v-model="uploadForm.vehicle_id"
                                class="mt-1 w-full block"
                            />
                            <InputError :message="errors.vehicle_id" />
                        </div>
                        <div>
                            <InputLabel value="Picture:" />
                            <input
                                class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                                type="file"
                                @input="
                                    uploadForm.pictures = $event.target.files
                                "
                                multiple
                            />
                            <InputError :message="errors.pictures" />
                            <progress
                                v-if="uploadForm.progress"
                                :value="uploadForm.progress.percentage"
                                max="100"
                                class="w-full mt-2"
                            >
                                {{ uploadForm.progress.percentage }}%
                            </progress>
                        </div>
                    </div>
                </form>
            </template>
            <template #footer>
                <span
                    class="mt-3 mr-2 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"
                >
                    <PrimaryButton
                        @click="submit"
                        type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                        :disabled="form.processing"
                    >
                        Submit
                    </PrimaryButton>
                </span>
                <span
                    class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"
                >
                    <SecondaryButton
                        @click="closeUploadModal()"
                        type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    >
                        Back
                    </SecondaryButton>
                </span>
            </template>
        </DialogModal>
    </app-layout>
</template>
<script setup>
import { ref, onMounted } from "vue";
import AppLayout from "../../Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import DialogModal from "../../Components/DialogModal.vue";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import SecondaryButton from "../../Components/SecondaryButton.vue";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";
import DangerButton from "../../Components/DangerButton.vue";
import ImagesWithDetail from "../../Components/ImagesWithDetail.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import SelectInput from "../../Components/SelectInput.vue";

defineProps({
    data: Array,
    errors: Object,
});

let editMode = ref(false);
let isOpen = ref(false);
let isPicOpen = ref(false);
let isUploadOpen = ref(false);
let images = ref([]);
let form = ref({
    name: null,
    type: null,
    plate: null,
    status: null,
    speed: null,
    fuel_level: null,
    mileage: null,
});

const uploadForm = useForm({
    vehicle_id: null,
    pictures: null,
});

function submit() {
    uploadForm.post("/pictures", {
        onSuccess: () => {
            uploadForm.reset();
            closeUploadModal();
        },
        onError: (errors) => {
            if (errors.message) {
                alert.value = {
                    type: "error",
                    message: errors.message,
                };
            }
        },
    });
}

function openModal() {
    isOpen.value = true;
}

function openPictureModal() {
    isPicOpen.value = true;
}

function openUploadModal() {
    isUploadOpen.value = true;
}

let alert = ref({});

function closeModal() {
    isOpen.value = false;
    reset();
    editMode.value = false;
}
function closePicModal() {
    isPicOpen.value = false;
}
function closeUploadModal() {
    isUploadOpen.value = false;
}
function reset() {
    form.value = {
        name: null,
        type: null,
        plate: null,
        status: null,
        speed: null,
        fuel_level: null,
        mileage: null,
    };
}
function save(data) {
    data.status = "Vehicle Off";
    data.speed = "0";
    data.fuel_level = "0";
    data.mileage = "0";

    Inertia.post("/vehicles", data);
    reset();
    closeModal();
    editMode.value = false;
}
function edit(data) {
    form.value = Object.assign({}, data);
    editMode.value = true;
    openModal();
}
function show(data) {
    images.value = data.vehicle_pictures;
    openPictureModal();
}
function update(data) {
    data._method = "PUT";
    Inertia.post("/vehicles/" + data.id, data);
    reset();
    closeModal();
}
function deleteRow(data) {
    if (!confirm("Are you sure want to remove?")) return;
    data._method = "DELETE";
    Inertia.post("/vehicles/" + data.id, data);
    reset();
    closeModal();
}
</script>
