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
            <PrimaryButton
              @click="openModal()"
              class="my-3">
              Create New Customer
            </PrimaryButton>
            <table class="table-fixed w-full">
              <thead>
                <tr class="bg-gray-100">
                  <th class="px-4 py-2">Company Name</th>
                  <th class="px-4 py-2">Address</th>
                  <th class="px-4 py-2">PIC Name</th>
                  <th class="px-4 py-2">Phone</th>
                  <th class="px-4 py-2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="row in data" :key="row.id">
                  <td class="border px-4 py-2">{{ row.name_pt }}</td>
                  <td class="border px-4 py-2">{{ row.address }}</td>
                  <td class="border px-4 py-2">{{ row.name_pic }}</td>
                  <td class="border px-4 py-2">{{ row.phone }}</td>
                  <td class="border px-4 py-2">
                    <PrimaryButton
                      @click="edit(row)"
                      class="mr-2">
                      Edit
                    </PrimaryButton>
                    <DangerButton
                      @click="deleteRow(row)">
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
            <template #title> Create Customer </template>
            <template #content>
                <form>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="">
                          <div class="mb-4">
                                    <InputLabel
                                        for="name_pt"
                                        value="Customer Name:"
                                    />
                                    <TextInput
                                        id="name_pt"
                                        v-model="form.name_pt"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        placeholder="Enter Customer Name"
                                    />
                                    <InputError :message="errors.name_pt" />
                                </div>
                                <div class="mb-4">
                                    <InputLabel
                                        for="address"
                                        value="Address:"
                                    />
                                    <TextInput
                                        id="address"
                                        v-model="form.address"
                                        type="text"
                                        class="mt-1 block w-full"
                                        required
                                        placeholder="Enter Address"
                                    />
                                    <InputError :message="errors.address" />
                                </div>
                                <div class="mb-4">
                                <InputLabel for="name_pic" value="PIC Name:" />
                                <TextInput
                                    id="name_pic"
                                    v-model="form.name_pic"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    placeholder="Enter PIC Name"
                                />
                                <InputError :message="errors.name_pic" />
                            </div>
                            <div class="mb-4">
                                <InputLabel for="phone" value="Phone:" />
                                <TextInput
                                    id="phone"
                                    v-model="form.phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    required
                                    placeholder="Enter Phone"
                                />
                                <InputError :message="errors.phone" />
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
  import DangerButton from "../../Components/DangerButton.vue";
  
  defineProps({
    data: Array,
    errors: Object,
  
  });
  
  let editMode = ref(false);
  let isOpen = ref(false);
  let form = ref({
    name_pt: null,
    address: null,
    name_pic: null,
    phone: null,
  });

  let alert = ref({});
  
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
      name_pt: null,
      address: null,
      name_pic: null,
      phone: null,
    };
  }
  function save(data) {
  
    Inertia.post("/customers", data);
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
    Inertia.post("/customers/" + data.id, data);
    reset();
    closeModal();
  }
  function deleteRow(data) {
    if (!confirm("Are you sure want to remove?")) return;
    data._method = "DELETE";
    Inertia.post("/customers/" + data.id, data);
    reset();
    closeModal();
  }
  </script>