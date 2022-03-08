<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import FlashMessages from "@/Components/FlashMessages.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeSelect from "@/Components/Select.vue";
import { reactive, ref, computed } from "vue";
import { BookmarkIcon } from "@heroicons/vue/outline";
import {
  Dialog,
  DialogOverlay,
  DialogTitle,
  DialogDescription,
} from "@headlessui/vue";

let formButtonType = ref('Create')

const searchQuery = ref("")

let isOpen = ref(false);

let isEdit = ref(false);

const props = defineProps({
  user: Object,
  status: String,
  items: Object,
  types : Object
});

const menuForm = useForm({
  id: "",
  name: "",
  description: "",
  available_from: "",
  available_to: "",
  availability: false,
  display: false
});

function menuFormSubmit(){
  if (isEdit.value) {
    menuForm.put(route("menu.update"), {
      onSuccess: () => resetForm(),
    });
  } else {
    menuForm.post(route("menu.store"), {
      onSuccess: () => resetForm(),
    });
  }
}

function resetForm() {
  menuForm.name = ""
  menuForm.id = ""
  menuForm.description = ""
  menuForm.available_from = ""
  menuForm.available_to = ""
  menuForm.availability = false,
  menuForm.display = false
  isEdit.value = false
  formButtonType.value = 'Create'
}

const filteredItems = computed(() => {
  return props.items.data.filter((item) => {
    return (
      searchQuery.value.toLowerCase().length === 0 ||
      item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  });
});

const deleteForm = useForm({
  id: "",
});

function deleteItem(id) {
  setIsOpen(true)
  deleteForm.id = id
}

function deleteItemConfirm() {
  deleteForm.delete(route("menu.destroy"), {
    onFinish: () => resetDeleteForm(),
  });
}

function resetDeleteForm() {
  setIsOpen(false);
  deleteForm.id = "";
}

function setIsOpen(value) {
  isOpen.value = value;
}

function editItem(item) {
  menuForm.name = item.name
  menuForm.id = item.id
  menuForm.description = item.description
  menuForm.available_from = item.available_from
  menuForm.available_to = item.available_to
  menuForm.availability = (item.availability == 'Yes') ? true : false
  menuForm.display = (item.display == 'Yes') ? true : false
  isEdit.value = true
  formButtonType.value = 'Update'
}


</script>

<template>
  <BreezeAuthenticatedLayout>

    <Head title="Menu Items" />

    <BreezeValidationErrors />

    <FlashMessages />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Menu
      </h2>
    </template>

    <Dialog
      :open="isOpen"
      @close="setIsOpen"
      class="fixed inset-0 z-10 overflow-y-auto"
    >
      <div class="flex items-center justify-center min-h-screen">
        <DialogOverlay class="fixed inset-0 bg-black opacity-50" />
        <div class="relative max-w-sm mx-auto bg-white rounded px-4 py-4">
          <DialogTitle class="block mb-2 text-sm font-bold text-gray-700">Confrimation</DialogTitle>
          <DialogDescription>This will permanently delete this record</DialogDescription>
          <p>Are you sure you want to continue? This action cannot be undone.</p>
          <button
            class="mr-2 justify-center px-2 py-1 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-red-600 hover:bg-red-700"
            @click="deleteItemConfirm"
          >Yes</button>
          <button
            class="justify-center px-2 py-1 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
            @click="setIsOpen(false)"
          >Cancel</button>
        </div>
      </div>
    </Dialog>

    <div>
      <div class="min-h-screen bg-gray-50">
        <!-- Page Content -->
        <div class="py-6">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <form @submit.prevent="menuFormSubmit">
                  <div class="mb-4 md:flex md:justify-start">
                    <div class="md:ml-2 flex-1">
                      <label
                        class="block mb-2 text-sm font-bold text-gray-700"
                        for="lastName"
                      >
                        Menu Name
                      </label>
                      <BreezeInput
                        id="display_name"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Name"
                        v-model="menuForm.name"
                      />
                    </div>
                    <div class="md:ml-2 flex-1">
                      <label
                        class="block mb-2 text-sm font-bold text-gray-700"
                        for="lastName"
                      >
                        Description
                      </label>
                      <BreezeInput
                        id="display_name"
                        type="text"
                        class="mt-1 block w-full"
                        placeholder="Description"
                        v-model="menuForm.description"
                      />
                    </div>
                    <div class="md:ml-2 flex-1">
                      <label
                        class="block mb-2 text-sm font-bold text-gray-700"
                        for="lastName"
                      >
                        Avilable From
                      </label>
                      <BreezeInput
                        id="display_name"
                        type="time"
                        class="mt-1 block w-full"
                        placeholder="From"
                        v-model="menuForm.available_from"
                      />
                    </div>
                    <div class="md:ml-2 flex-1">
                      <label
                        class="block mb-2 text-sm font-bold text-gray-700"
                        for="lastName"
                      >
                        Avilable To
                      </label>
                      <BreezeInput
                        id="display_name"
                        type="time"
                        class="mt-1 block w-full"
                        placeholder="To"
                        v-model="menuForm.available_to"
                      />
                    </div>
                    <div class="md:ml-2 flex-1">
                      <label
                        class="block mb-2 text-sm font-bold text-gray-700"
                        for="lastName"
                      >
                        Availability
                      </label>
                      <input type="checkbox" v-model="menuForm.availability" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:ml-2 flex-1">
                      <label
                        class="block mb-2 text-sm font-bold text-gray-700"
                        for="lastName"
                      >
                        Display
                      </label>
                      <input type="checkbox" v-model="menuForm.display" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                  </div>
                  <div class="mb-4 md:flex md:justify-start">
                    <div>
                      <BreezeButton
                        :class="{ 'opacity-25': menuForm.processing, 'py-2': 'py-2' }"
                        :disabled="menuForm.processing"
                      >
                        {{formButtonType}}
                      </BreezeButton>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Page Content -->
        <div class="py-1">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <div>
                  <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Menus</h3>
                  </div>
                  <div class="my-2 flex sm:flex-row flex-col">
                    <div class="block relative">
                      <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg
                          viewBox="0 0 24 24"
                          class="h-4 w-4 fill-current text-gray-500"
                        >
                          <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                          </path>
                        </svg>
                      </span>
                      <BreezeInput
                        id="search"
                        type="text"
                        class="pl-8 mt-1 block w-full appearance-none rounded-r rounded-l sm:rounded-l-none"
                        placeholder="Search by menu name"
                        v-model="searchQuery"
                      />
                    </div>
                  </div>
                  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                      <table class="min-w-full leading-normal">
                        <thead>
                          <tr>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Menu Name
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Description
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Available From
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Available To
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Availability
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Display
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">

                            </th>
                          </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                          <tr  
                            v-for="item in filteredItems"
                            :key="item.id"
                          >
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="flex items-center">
                                <div class="flex">
                                  <component
                                    :is="BookmarkIcon"
                                    class="flex-shrink-0 h-6 w-6 text-indigo-600"
                                    aria-hidden="true"
                                  />
                                  <span class="ml-2 text-sm font-medium text-gray-900">{{item.name}}</span>
                                </div>
                              </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900">{{item.description}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-500">{{item.available_from}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-500">{{item.available_to}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-500">{{item.availability}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-500">{{item.display}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                              <a
                                :href="route('menu.show',item.id)"
                                class="cursor-pointer text-indigo-600 hover:text-indigo-900 mr-3"
                              >View</a>
                              <a
                                @click="editItem(item)"
                                class="cursor-pointer text-indigo-600 hover:text-indigo-900 mr-3"
                              >Edit</a>
                              <a
                                @click="deleteItem(item.id)"
                                class="cursor-pointer text-red-600 hover:text-red-900"
                              >Delete</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        <span class="text-xs xs:text-sm text-gray-900">
                          Showing {{items.from}} to {{items.to}} of {{items.total}} Entries
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                          <a
                            :href="items.prev_page_url"
                            class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-l"
                          >
                            Prev
                          </a>
                          <a
                            :href="items.next_page_url"
                            class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-r"
                          >
                            Next
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>