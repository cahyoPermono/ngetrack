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
              Create New Customer
            </button>
            <table class="table-fixed w-full">
              <thead>
                <tr class="bg-gray-100">
                  <th class="px-4 py-2">Company Name</th>
                  <th class="px-4 py-2">Address</th>
                  <th class="px-4 py-2">PIC Name</th>
                  <th class="px-4 py-2">Phone</th>
                  <!-- <th class="px-4 py-2">Created Date</th> -->
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
            <div
              class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400"
              v-if="isOpen"
            >
              <div
                class="
                  flex
                  items-end
                  justify-center
                  min-h-screen
                  pt-4
                  px-4
                  pb-20
                  text-center
                  sm:block sm:p-0
                "
              >
                <div class="fixed inset-0 transition-opacity">
                  <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <!-- This element is to trick the browser into centering the modal contents. -->
                <span
                  class="hidden sm:inline-block sm:align-middle sm:h-screen"
                ></span
                >​
                <div
                  class="
                    inline-block
                    align-bottom
                    bg-white
                    rounded-lg
                    text-left
                    overflow-hidden
                    shadow-xl
                    transform
                    transition-all
                    sm:my-8 sm:align-middle sm:max-w-lg sm:w-full
                  "
                  role="dialog"
                  aria-modal="true"
                  aria-labelledby="modal-headline"
                >
                  <form>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                      <div class="">
                        <div class="mb-4">
                          <label
                            for="name"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Company Name:</label
                          >
                          <input
                            type="text"
                            class="
                              shadow
                              appearance-none
                              border
                              rounded
                              w-full
                              py-2
                              px-3
                              text-gray-700
                              leading-tight
                              focus:outline-none focus:shadow-outline
                            "
                            id="name_pt"
                            placeholder="Enter Company Name"
                            v-model="form.name_pt"
                          />
                          <div v-if="errors.name_pt" class="text-red-500">
                            {{ errors.name_pt }}
                          </div>
                        </div>
                        <div class="mb-4">
                          <label
                            for="type"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Address:</label
                          >
                          <textarea
                            class="
                              shadow
                              appearance-none
                              border
                              rounded
                              w-full
                              py-2
                              px-3
                              text-gray-700
                              leading-tight
                              focus:outline-none focus:shadow-outline
                            "
                            id="address"
                            v-model="form.address"
                            placeholder="Enter Address"
                          ></textarea>
                          <div v-if="errors.address" class="text-red-500">
                            {{ errors.address }}
                          </div>
                        </div>
                        
                        <div class="mb-4">
                          <label
                            for="type"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >PIC Name:</label
                          >
                          <textarea
                            class="
                              shadow
                              appearance-none
                              border
                              rounded
                              w-full
                              py-2
                              px-3
                              text-gray-700
                              leading-tight
                              focus:outline-none focus:shadow-outline
                            "
                            id="name_pic"
                            v-model="form.name_pic"
                            placeholder="Enter PIC Name"
                          ></textarea>
                          <div v-if="errors.pic_name" class="text-red-500">
                            {{ errors.pic_name }}
                          </div>
                        </div>

                        <div class="mb-4">
                          <label
                            for="type"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Phone:</label
                          >
                          <textarea
                            class="
                              shadow
                              appearance-none
                              border
                              rounded
                              w-full
                              py-2
                              px-3
                              text-gray-700
                              leading-tight
                              focus:outline-none focus:shadow-outline
                            "
                            id="phone"
                            v-model="form.phone"
                            placeholder="Enter Phone"
                          ></textarea>
                          <div v-if="errors.phone" class="text-red-500">
                            {{ errors.phone }}
                          </div>
                        </div>
                      </div>
                    </div>
                    <div
                      class="
                        bg-gray-50
                        px-4
                        py-3
                        sm:px-6 sm:flex sm:flex-row-reverse
                      "
                    >
                      <span
                        class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                      >
                        <button
                          wire:click.prevent="store()"
                          type="button"
                          class="
                            inline-flex
                            justify-center
                            w-full
                            rounded-md
                            border border-transparent
                            px-4
                            py-2
                            bg-green-600
                            text-base
                            leading-6
                            font-medium
                            text-white
                            shadow-sm
                            hover:bg-green-500
                            focus:outline-none
                            focus:border-green-700
                            focus:shadow-outline-green
                            transition
                            ease-in-out
                            duration-150
                            sm:text-sm sm:leading-5
                          "
                          v-show="!editMode"
                          @click="save(form)"
                        >
                          Save
                        </button>
                      </span>
                      <span
                        class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                      >
                        <button
                          wire:click.prevent="store()"
                          type="button"
                          class="
                            inline-flex
                            justify-center
                            w-full
                            rounded-md
                            border border-transparent
                            px-4
                            py-2
                            bg-green-600
                            text-base
                            leading-6
                            font-medium
                            text-white
                            shadow-sm
                            hover:bg-green-500
                            focus:outline-none
                            focus:border-green-700
                            focus:shadow-outline-green
                            transition
                            ease-in-out
                            duration-150
                            sm:text-sm sm:leading-5
                          "
                          v-show="editMode"
                          @click="update(form)"
                        >
                          Update
                        </button>
                      </span>
                      <span
                        class="
                          mt-3
                          flex
                          w-full
                          rounded-md
                          shadow-sm
                          sm:mt-0 sm:w-auto
                        "
                      >
                        <button
                          @click="closeModal()"
                          type="button"
                          class="
                            inline-flex
                            justify-center
                            w-full
                            rounded-md
                            border border-gray-300
                            px-4
                            py-2
                            bg-white
                            text-base
                            leading-6
                            font-medium
                            text-gray-700
                            shadow-sm
                            hover:text-gray-500
                            focus:outline-none
                            focus:border-blue-300
                            focus:shadow-outline-blue
                            transition
                            ease-in-out
                            duration-150
                            sm:text-sm sm:leading-5
                          "
                        >
                          Cancel
                        </button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </app-layout>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import AppLayout from "../../Layouts/AppLayout.vue";
  import { Inertia } from '@inertiajs/inertia'
  
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