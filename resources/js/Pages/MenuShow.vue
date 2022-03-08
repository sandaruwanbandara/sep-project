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

let isOpen = ref(false);

const searchQuery = ref("")

const searchAddedQuery = ref("")

const props = defineProps({
  user: Object,
  status: String,
  menu: Object,
  items: Object,
  menu_items: Object
});

function setIsOpen(value) {
  isOpen.value = value;
}

const filteredItems = computed(() => {
  return props.items.data.filter((item) => {
    return (
      searchQuery.value.toLowerCase().length === 0 ||
      item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
  });
});

const filteredMenuItems = computed(() => {
  return props.menu_items.data.filter((item) => {
    return (
      searchAddedQuery.value.toLowerCase().length === 0 ||
      item.menu_item.name.toLowerCase().includes(searchAddedQuery.value.toLowerCase())
    );
  });
});

const addItemForm = useForm({
  menu_id: props.menu.id,
  item_id: "",
});

function resetAddItemForm(){
  addItemForm.item_id = "";
}

function addItem(item){
  addItemForm.item_id = item.id
  addItemForm.post(route("menu.item.add"), {
    onSuccess: () => resetAddItemForm(),
  });
}

const removeItemForm = useForm({
  menu_id: props.menu.id,
  item_id: "",
});

function resetRemoveItemForm(){
  removeItemForm.item_id = "";
}

function removeItem(item){  
  removeItemForm.item_id = item.id
  removeItemForm.delete(route("menu.item.remove"), {
    onSuccess: () => resetRemoveItemForm(),
  });
}

</script>

<template>
  <BreezeAuthenticatedLayout>

    <Head title="Menus" />

    <BreezeValidationErrors />

    <FlashMessages />

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        View {{menu.name}} Menu
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
                  <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Menu Items in Menu {{menu.name}}</h3>
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
                        placeholder="Search by menu item name"
                        v-model="searchAddedQuery"
                      />
                    </div>
                  </div>
                  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                      <table class="min-w-full leading-normal">
                        <thead>
                          <tr>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Menu type
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Menu item name
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Description
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Price
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
                            v-for="item in filteredMenuItems"
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
                                  <span class="ml-2 text-sm font-medium text-gray-900">{{item.menu_item.type.name}}</span>
                                </div>
                              </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900">{{item.menu_item.name}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-500">{{item.menu_item.description}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-500">{{item.menu_item.price}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-500">{{item.menu_item.availability}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-500">{{item.menu_item.display}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                              <a
                                @click="removeItem(item)"
                                class="cursor-pointer text-indigo-600 hover:text-indigo-900 mr-3"
                              >Remove from Menu</a>
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
        <!-- Page Content -->
        <div class="py-6">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <div>
                  <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Add Menu Items to {{menu.name}} Menu</h3>
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
                        placeholder="Search by menu item name"
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
                              Menu type
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Menu item name
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Description
                            </th>
                            <th class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                              Price
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
                                  <span class="ml-2 text-sm font-medium text-gray-900">{{item.type.name}}</span>
                                </div>
                              </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-900">{{item.name}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                              <div class="text-sm text-gray-500">{{item.description}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-500">{{item.price}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-500">{{item.availability}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                              <div class="text-sm text-gray-500">{{item.display}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                              <a
                                @click="addItem(item)"
                                class="cursor-pointer text-indigo-600 hover:text-indigo-900 mr-3"
                              >Add To Menu</a>
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