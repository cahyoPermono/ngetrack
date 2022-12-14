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
                  <th class="px-4 py-2">Name</th>
                  <th class="px-4 py-2">Type</th>
                  <th class="px-4 py-2">Brand</th>
                  <th class="px-4 py-2">Stock</th>
                  <th class="px-4 py-2">Condition</th>
                  <th class="px-4 py-2">Weight</th>
                  <th class="px-4 py-2">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="row in data" :key="row.id">
                  <td class="border px-4 py-2">{{ row.nama }}</td>
                  <td class="border px-4 py-2">{{ row.type }}</td>
                  <td class="border px-4 py-2">{{ row.brand }}</td>
                  <td class="border px-4 py-2">{{ row.stock }}</td>
                  <td class="border px-4 py-2">{{ row.condition }}</td>
                  <td class="border px-4 py-2">{{ row.weight }}</td>
                  <!-- <td class="border px-4 py-2">{{ row.tglBerlaku }}</td> -->
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
                            >Name:</label
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
                            id="nama"
                            placeholder="Enter Name"
                            v-model="form.nama"
                          />
                          <div v-if="errors.nama" class="text-red-500">
                            {{ errors.nama }}
                          </div>
                        </div>
                        <div class="mb-4">
                          <label
                            for="type"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Type:</label
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
                            id="type"
                            v-model="form.type"
                            placeholder="Enter Type"
                          ></textarea>
                          <div v-if="errors.type" class="text-red-500">
                            {{ errors.type }}
                          </div>
                        </div>

                        <div class="mb-4">
                          <label
                            for="brand"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Brand:</label
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
                            id="brand"
                            v-model="form.brand"
                            placeholder="Enter Brand"
                          ></textarea>
                          <div v-if="errors.brand" class="text-red-500">
                            {{ errors.brand }}
                          </div>
                        </div>

                        <div class="mb-4">
                          <label
                            for="stock"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Stock:</label
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
                            id="stock"
                            v-model="form.stock"
                            placeholder="Enter Stock"
                          ></textarea>
                          <div v-if="errors.stock" class="text-red-500">
                            {{ errors.stock }}
                          </div>
                        </div>

                        <div class="mb-4">
                          <label
                            for="condition"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Condition:</label
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
                            id="condition"
                            v-model="form.condition"
                            placeholder="Enter Condition"
                          ></textarea>
                          <div v-if="errors.condition" class="text-red-500">
                            {{ errors.condition }}
                          </div>
                        </div>

                        <div class="mb-4">
                          <label
                            for="weight"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Weight:</label
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
                            id="weight"
                            v-model="form.weight"
                            placeholder="Enter Weight"
                          ></textarea>
                          <div v-if="errors.weight" class="text-red-500">
                            {{ errors.weight }}
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
    nama: null,
    type: null,
    brand: null,
    stock:null,
    condition:null,
    weight:null,
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
      nama: null,
      type: null,
      brand: null,
      stock:null,
      condition:null,
      weight:null,
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