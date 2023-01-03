<template>
    <app-layout>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div
              class="
                bg-teal-100
                border-t-4 border-teal-500
                rounded-b
                text-teal-900
                px-4
                py-3
                shadow-md
                my-3
              "
              role="alert"
              v-if="$page.props.flash.message"
            >
              <div class="flex">
                <div>
                  <p class="text-sm">{{ $page.props.flash.message }}</p>
                </div>
              </div>
            </div>
            <button
              @click="openModal()"
              class="
                bg-blue-500
                hover:bg-blue-700
                text-white
                font-bold
                py-2
                px-4
                rounded
                my-3
              "
            >
              Create New GPS Transmitter
            </button>
            <table class="table-fixed w-full">
              <thead>
                <tr class="bg-gray-100">
                  <th class="px-4 py-2">IMEI Number</th>
                  <th class="px-4 py-2">GPS Number</th>
                  <th class="px-4 py-2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="row in data" :key="row.id">
                  <td class="border px-4 py-2">{{ row.imei_number }}</td>
                  <td class="border px-4 py-2">{{ row.gsm_number }}</td>
                  <td class="border px-4 py-2">
                    <button
                      @click="edit(row)"
                      class="
                        bg-blue-500
                        hover:bg-blue-700
                        text-white
                        font-bold
                        py-2
                        px-4
                        rounded
                        mr-2
                      "
                    >
                      Edit
                    </button>
                    <button
                      @click="deleteRow(row)"
                      class="
                        bg-red-500
                        hover:bg-red-700
                        text-white
                        font-bold
                        py-2
                        px-4
                        rounded
                      "
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <DialogModal :show="isOpen" @close="closeModal" :alert="alert">
            <template #title> Create GPS Transmitter </template>
            <template #content>
                <form>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="">
                          <div class="mb-4">
                                    <InputLabel
                                        for="imei_number"
                                        value="IMEI Number:"
                                    />
                                    <TextInput
                                        id="imei_number"
                                        v-model="form.imei_number"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        placeholder="Enter IMEI Number"
                                    />
                                    <InputError :message="errors.imei_number" />
                                </div>
                                <div class="mb-4">
                                    <InputLabel
                                        for="gsm_number"
                                        value="GSM Number:"
                                    />
                                    <TextInput
                                        id="gsm_number"
                                        v-model="form.gsm_number"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        placeholder="Enter GSM Number"
                                    />
                                    <InputError :message="errors.gsm_number" />
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
    </app-layout>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import AppLayout from "../../Layouts/AppLayout.vue";
  import { Inertia } from '@inertiajs/inertia'
  import DialogModal from "../../Components/DialogModal.vue";
  import PrimaryButton from "../../Components/PrimaryButton.vue";
  import SecondaryButton from "../../Components/SecondaryButton.vue";
  import InputLabel from "../../Components/InputLabel.vue";
  import TextInput from "../../Components/TextInput.vue";
  import InputError from "../../Components/InputError.vue";
  
  defineProps({
    data: Array,
    errors: Object,
  
  });
  
  let editMode = ref(false);
  let isOpen = ref(false);
  let form = ref({
    imei_number: null,
    gsm_number: null,
  });
  
  function openModal() {
    isOpen.value = true;
  }
  function closeModal() {
    isOpen.value = false;
    reset();
    editMode.value = false;
  }
  function reset() {
    form.value = {
      imei_number: null,
      gsm_number: null,
    };
  }
  function save(data) {
  
    Inertia.post("/transmitters", data);
    reset();
    closeModal();
    editMode.value = false;
  }
  function edit(data) {
    form.value = Object.assign({}, data);
    editMode.value = true;
    openModal();
  }
  function update(data) {
    data._method = "PUT";
    Inertia.post("/transmitters/" + data.id, data);
    reset();
    closeModal();
  }
  function deleteRow(data) {
    if (!confirm("Are you sure want to remove?")) return;
    data._method = "DELETE";
    Inertia.post("/transmitters/" + data.id, data);
    reset();
    closeModal();
  }
  </script>