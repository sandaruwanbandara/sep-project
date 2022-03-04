<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head,useForm } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/Button.vue";
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import FlashMessages from '@/Components/FlashMessages.vue';
import BreezeInput from "@/Components/Input.vue";
import { reactive,ref,computed } from "vue";
import {
  BookmarkIcon,
} from "@heroicons/vue/outline";
import Pagination from '@/Components/Pagination'

const props = defineProps({
  user: Object,
  status: String,
  items : Object,
});


const menu_item_form = useForm({
  name: props.items.data[0].mt_name
});

function menu_item_form_submit(id) {
  console.log(menu_item_form );
  menu_item_form.patch(route('menu_type.update',id),{
      onFinish: () => resetForm(),
  });
}

function resetForm(){

  menu_item_form.name = ""
}

const searchQuery = ref('')

</script>

<template>
  <BreezeAuthenticatedLayout>

    <Head title="Menu Categories" />

    <BreezeValidationErrors />

    <FlashMessages/>

    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Menu Categories
      </h2>
    </template>

    <div>
        <div class="min-h-screen bg-gray-50">
            <!-- Page Content -->
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <form @submit.prevent="menu_item_form_submit(items.data[0].id)">
                            <div class="mb-4 md:flex md:justify-start">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                        Menu Category Name
                                    </label>
                                    <BreezeInput
                                      id="name"
                                      type="text"
                                      class="mt-1 block w-full"
                                      placeholder="Name"
                                      v-model="menu_item_form.name"
                                    />
                                </div>
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="lastName">
                                        &nbsp;
                                    </label>
                                      <BreezeButton
                                          :class="{ 'opacity-25': menu_item_form.processing, 'py-2': 'py-2' }"
                                          :disabled="menu_item_form.processing"
                                        >
                                        Update
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
                                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                        <table class="min-w-full leading-normal">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                                                        Menu category
                                                    </th>
                                                    <!-- <th
                                                        class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                                                        Display name
                                                    </th> -->
                                                    <th
                                                        class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                                                        Created at
                                                    </th>
                                                    <th
                                                        class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                                                        Updated at
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="item in items.data" :key="item.id">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex">
                                                                <component
                                                                    :is="BookmarkIcon"
                                                                    class="flex-shrink-0 h-6 w-6 text-indigo-600"
                                                                    aria-hidden="true"
                                                                  />
                                                                <span
                                                                    class="ml-2 text-sm font-medium text-gray-900">{{item.mt_name}}</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <!-- <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{item.display_name}}
                                                        </div>
                                                    </td> -->
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">{{item.created_at}}</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div class="text-sm text-gray-500">{{item.updated_at}}</div>
                                                    </td>
                                                </tr>
                                               
                                            </tbody>
                                        </table>

                                        
                                        <div
                                            class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                                            <!-- <span class="text-xs xs:text-sm text-gray-900">
                                                Showing {{page_info.from_row}} to {{page_info.to_row}} of {{page_info.total_row_count}} Entries
                                            </span> -->
                                            <div class="inline-flex mt-2 xs:mt-0">
                                                <!-- <button
                                                    class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-l">
                                                    Prev
                                                </button>
                                                <button
                                                    class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-r">
                                                    Next
                                                </button> -->
                                                 <pagination :links="items.links" />
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