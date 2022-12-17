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
            Create New Route
          </button>
          <table class="table-fixed w-full">
            <thead>
              <tr class="bg-gray-100">
                <th class="px-4 py-2 w-80">Registration Number</th>
                <th class="px-4 py-2">Vehicle</th>
                <th class="px-4 py-2">From</th>
                <th class="px-4 py-2">To</th>
                <th class="px-4 py-2">Driver</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2 w-72">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="row in data" :key="row.id">
                <td class="border px-4 py-2">{{ row.reg_no }}</td>
                <td class="border px-4 py-2">{{ row.vehicle.name }}</td>
                <td class="border px-4 py-2">{{ row.from }}</td>
                <td class="border px-4 py-2">{{ row.to }}</td>
                <td class="border px-4 py-2">{{ row.driver }}</td>
                <td class="border px-4 py-2">{{ row.status }}</td>
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
                    @click="endRoute(row)"
                    class="
                      bg-orange-500
                      hover:bg-orange-600
                      text-white
                      font-bold
                      py-2
                      px-4
                      rounded
                      mr-2
                    "
                  >
                    Delete
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
                          for="vehicles"
                          class="block text-gray-700 text-sm font-bold mb-2"
                          >Vehicle:</label
                        >
                        <select
                          id="vehicles"
                          name="vehicle"
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
                          v-model="form.vehicle_id"
                        >
                          <option
                            v-for="vehicle in vehicles"
                            :value="vehicle.id"
                            :key="vehicle.id"
                          >
                            {{ vehicle.name }}
                          </option>
                        </select>
                        <div v-if="errors.driver" class="text-red-500">
                          {{ errors.driver }}
                        </div>
                      </div>
                      <div class="mb-4">
                        <label
                          for="from"
                          class="block text-gray-700 text-sm font-bold mb-2"
                          >From:</label
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
                          id="from"
                          placeholder="Enter From"
                          v-model="form.from"
                        />
                        <div v-if="errors.from" class="text-red-500">
                          {{ errors.from }}
                        </div>
                      </div>
                      <div class="flex justify-between">
                        <div class="mb-4">
                          <label
                            for="from_long"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >From Longitude:</label
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
                            id="from"
                            placeholder="Enter From Longitude"
                            v-model="form.from_long"
                          />
                          <div v-if="errors.from_long" class="text-red-500">
                            {{ errors.from_long }}
                          </div>
                        </div>
                        <div class="mb-4">
                          <label
                            for="from_lat"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >from Latitude:</label
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
                            id="from"
                            placeholder="Enter From Latitude"
                            v-model="form.from_lat"
                          />
                          <div v-if="errors.from_lat" class="text-red-500">
                            {{ errors.from_lat }}
                          </div>
                        </div>
                      </div>
                      <div class="mb-4">
                        <label
                          for="to"
                          class="block text-gray-700 text-sm font-bold mb-2"
                          >To:</label
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
                          id="to"
                          placeholder="Enter Destination"
                          v-model="form.to"
                        />
                        <div v-if="errors.to" class="text-red-500">
                          {{ errors.to }}
                        </div>
                      </div>
                      <div class="flex justify-between">
                        <div class="mb-4">
                          <label
                            for="to_long"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Destination Longitude:</label
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
                            id="to_long"
                            placeholder="Enter Destination Longitude"
                            v-model="form.to_long"
                          />
                          <div v-if="errors.to_long" class="text-red-500">
                            {{ errors.to_long }}
                          </div>
                        </div>
                        <div class="mb-4">
                          <label
                            for="to_lat"
                            class="block text-gray-700 text-sm font-bold mb-2"
                            >Destination Latitude:</label
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
                            id="to_lat"
                            placeholder="Enter Destination Latitude"
                            v-model="form.to_lat"
                          />
                          <div v-if="errors.to_lat" class="text-red-500">
                            {{ errors.to_lat }}
                          </div>
                        </div>
                      </div>
                      <div class="mb-4">
                        <label
                          for="driver"
                          class="block text-gray-700 text-sm font-bold mb-2"
                          >Driver:</label
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
                          id="driver"
                          placeholder="Enter Driver Name"
                          v-model="form.driver"
                        />
                        <div v-if="errors.driver" class="text-red-500">
                          {{ errors.driver }}
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
import { Inertia } from "@inertiajs/inertia";

defineProps({
  data: Array,
  errors: Object,
  vehicles: Array,
});

let editMode = ref(false);
let isOpen = ref(false);
let form = ref({});

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
    vehicle_id: null,
    from: null,
    from_long: null,
    from_lat: null,
    to: null,
    to_long: null,
    to_lat: null,
    driver: null,
  };
}
function save(data) {
  Inertia.post("/routes", data, {
    onError: (errors) => {
      console.log(errors);
    }
  });
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
  delete data.vehicle;
  Inertia.post("/routes/" + data.id, data);
  reset();
  closeModal();
}
function deleteRow(data) {
  if (!confirm("Are you sure want to remove?")) return;
  data._method = "DELETE";
  Inertia.post("/routes/" + data.id, data);
  reset();
  closeModal();
}
</script>