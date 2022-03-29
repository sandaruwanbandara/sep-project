
<script setup>
import { ref,reactive } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'
import MainNav from "@/Components/MainNav.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import {
  Dialog,
  DialogOverlay,
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { XIcon, SearchIcon } from "@heroicons/vue/outline";
import {
  ChevronDownIcon,
  FilterIcon,
  MinusSmIcon,
  PlusSmIcon,
  ViewGridIcon,
  RefreshIcon,
} from "@heroicons/vue/solid";
import BreezeButton from "@/Components/Button.vue";

const sortOptions = [
  { name: "Newest", href: "#", current: false },
  { name: "Items in Menu: Low to High", href: "#", current: false },
  { name: "Items in Menu: High to Low", href: "#", current: false },
];
const mainCategories = [
  { name: "Restaurants or Cafes", href: "#", id : 1 },
  { name: "Menu Cards", href: "#", id : 2 },
  { name: "Dishes", href: "#", id : 3 },
];
const filters = [
  {
    id: "price",
    name: "Item Price",
    options: [
      { value: "pf1", label: "Below 100.00", checked: false },
      { value: "pf2", label: "100.00 to 200.00", checked: false },
      { value: "pf3", label: "200.00 to 500.00", checked: false },
      { value: "pf4", label: "500.00 to 1000.00", checked: false },
      { value: "pf5", label: "1000.00 to 5000.00", checked: false },
      { value: "pf6", label: "Above 5000.00", checked: false },
    ],
  },
  {
    id: "time",
    name: "Available Time",
    options: [
      { value: "tf1", label: "Breakfast", checked: false },
      { value: "tf2", label: "Lunch", checked: false },
      { value: "tf3", label: "Dinner", checked: false },
      { value: "tf4", label: "Snacks", checked: false },
    ],
  },
  {
    id: "availability",
    name: "Availability",
    options: [
      { value: "af1", label: "Available", checked: false },
      { value: "af2", label: "Unavailable", checked: false },
    ],
  },
];

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  products : Array
});

const mobileFiltersOpen = ref(false);
const searchPlaceHolder = ref("Search Restaurants or Cafe")

const slug = ref("");
const filterMainCategoryId = ref(1);
const checkedFilters = ref([]);

function setMainCategory(id, text,event){
  this.filterMainCategoryId = id
  this.searchPlaceHolder = "Search "+ text
  this.find()
}

function clearFilters(){
  window.location.reload();
}

const form = reactive({
  slug: slug,
  mainCategory: filterMainCategoryId,
  checkedFilters: checkedFilters,
})

function find(){
   Inertia.post(route('home.search'), form)
}


</script>

<template>
  <BreezeGuestLayout
    :canLogin="canLogin"
    :canRegister="canRegister"
  >

    <main class="flex mt-4 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-10 lg:mt-10 lg:px-8 xl:mt-20">
      <!-- Col -->
      <div class="sm:text-center lg:text-left w-full h-auto lg:block lg:w-2/3 bg-cover">
        <h1 class="text-2xl tracking-tight font-extrabold text-gray-900 sm:text-4xl md:text-4xl">
          <span class="block xl:inline">Welcome to Self-Serve-Menu</span>
          {{ ' ' }}
          <span class="block text-indigo-600 lg:inline">The one-stop directory for restaurant menus</span>
        </h1>
        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:mx-auto md:mt-5 md:text-xl lg:mx-0">The easy way to decide where to eat out! With nearby restaurant menus at your fingertips.</p>
        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
          <div class="rounded-md shadow">
            <a
              :href="route('register')"
              class="w-full flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-3 md:text-lg md:px-8"
            > Get started </a>
          </div>
        </div>
      </div>
      <!-- Col -->
      <div
        class="w-full h-auto hidden lg:block lg:w-1/3 bg-contain bg-no-repeat bg-center"
        style="background-image: url('/images/burger-image.png')"
      >
      </div>
    </main>

    <div class="mt-16 lg:mt-20">
      <!-- Mobile filter dialog -->
      <TransitionRoot
        as="template"
        :show="mobileFiltersOpen"
      >
        <Dialog
          as="div"
          class="fixed inset-0 flex z-40 lg:hidden"
          @close="mobileFiltersOpen = false"
        >
          <TransitionChild
            as="template"
            enter="transition-opacity ease-linear duration-300"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="transition-opacity ease-linear duration-300"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <DialogOverlay class="fixed inset-0 bg-black bg-opacity-25" />
          </TransitionChild>

          <TransitionChild
            as="template"
            enter="transition ease-in-out duration-300 transform"
            enter-from="translate-x-full"
            enter-to="translate-x-0"
            leave="transition ease-in-out duration-300 transform"
            leave-from="translate-x-0"
            leave-to="translate-x-full"
          >
            <div class="ml-auto relative max-w-xs w-full h-full bg-white shadow-xl py-4 pb-12 flex flex-col overflow-y-auto">
              <div class="px-4 flex items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">Filters</h2>
                <button
                  type="button"
                  class="-mr-2 w-10 h-10 bg-white p-2 rounded-md flex items-center justify-center text-gray-400"
                  @click="mobileFiltersOpen = false"
                >
                  <span class="sr-only">Close menu</span>
                  <XIcon
                    class="h-6 w-6"
                    aria-hidden="true"
                  />
                </button>
              </div>

              <!-- Filters -->
              <div class="mt-4 border-t border-gray-200">
                <h3 class="sr-only">Categories</h3>
                <ul
                  role="list"
                  class="font-medium text-gray-900 px-2 py-3"
                >
                  <li
                    v-for="category in mainCategories"
                    :key="category.name"
                  >
                    <a
                      :href="category.href"
                      class="block px-2 py-3"
                      @click.prevent.stop="setMainCategory(category.id, category.name ,$event)"
                      :class="{'text-indigo-700 font-bold': category.id == filterMainCategoryId}"
                    >
                      {{ category.name }}
                    </a>
                  </li>
                </ul>

                <Disclosure
                  as="div"
                  v-for="section in filters"
                  :key="section.id"
                  class="border-t border-gray-200 px-4 py-6"
                  v-slot="{ open }"
                >
                  <h3 class="-mx-2 -my-3 flow-root">
                    <DisclosureButton class="px-2 py-3 bg-white w-full flex items-center justify-between text-gray-400 hover:text-gray-500">
                      <span class="font-medium text-gray-900">
                        {{ section.name }}
                      </span>
                      <span class="ml-6 flex items-center">
                        <PlusSmIcon
                          v-if="!open"
                          class="h-5 w-5"
                          aria-hidden="true"
                        />
                        <MinusSmIcon
                          v-else
                          class="h-5 w-5"
                          aria-hidden="true"
                        />
                      </span>
                    </DisclosureButton>
                  </h3>
                  <DisclosurePanel class="pt-6">
                    <div class="space-y-6">
                      <div
                        v-for="(option, optionIdx) in section.options"
                        :key="option.value"
                        class="flex items-center"
                      >
                        <input
                          :id="`filter-mobile-${section.id}-${optionIdx}`"
                          :name="`${section.id}[]`"
                          :value="option.value"
                          type="checkbox"
                          :checked="option.checked"
                           v-model="checkedFilters"
                          class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                        />
                        <label
                          :for="`filter-mobile-${section.id}-${optionIdx}`"
                          class="ml-3 min-w-0 flex-1 text-gray-500"
                        >
                          {{ option.label }}
                        </label>
                      </div>
                    </div>
                  </DisclosurePanel>
                </Disclosure>
              </div>
            </div>
          </TransitionChild>
        </Dialog>
      </TransitionRoot>

      <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <section
          aria-labelledby="products-heading"
          class="pt-6 pb-24"
        >
          <h2
            id="products-heading"
            class="sr-only"
          >Products</h2>

          <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-10">
            <!-- Filters -->
            <div class="hidden lg:block">
              <h3 class="sr-only">Categories</h3>
              <ul
                role="list"
                class="text-sm font-medium text-gray-900 space-y-4 pb-6 border-b border-gray-200"
              >
                <li
                  v-for="category in mainCategories"
                  :key="category.name"
                >
                  <a :href="category.href"
                    @click.prevent.stop="setMainCategory(category.id, category.name ,$event)"
                    :class="{'text-indigo-700 font-bold': category.id == filterMainCategoryId}"
                  >
                    {{ category.name }}
                  </a>
                </li>
              </ul>

              <Disclosure
                as="div"
                v-for="section in filters"
                :key="section.id"
                class="border-b border-gray-200 py-6"
                v-slot="{ open }"
              >
                <h3 class="-my-3 flow-root">
                  <DisclosureButton class="py-3 bg-white w-full flex items-center justify-between text-sm text-gray-400 hover:text-gray-500">
                    <span class="font-medium text-gray-900">
                      {{ section.name }}
                    </span>
                    <span class="ml-6 flex items-center">
                      <PlusSmIcon
                        v-if="!open"
                        class="h-5 w-5"
                        aria-hidden="true"
                      />
                      <MinusSmIcon
                        v-else
                        class="h-5 w-5"
                        aria-hidden="true"
                      />
                    </span>
                  </DisclosureButton>
                </h3>
                <DisclosurePanel class="pt-6">
                  <div class="space-y-4">
                    <div
                      v-for="(option, optionIdx) in section.options"
                      :key="option.value"
                      class="flex items-center"
                    >
                      <input
                        :id="`filter-${section.id}-${optionIdx}`"
                        :name="`${section.id}[]`"
                        :value="option.value"
                        type="checkbox"
                        :checked="option.checked"
                        v-model="checkedFilters"
                        class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                      />
                      <label
                        :for="`filter-${section.id}-${optionIdx}`"
                        class="ml-3 text-sm text-gray-600"
                      >
                        {{ option.label }}
                      </label>
                    </div>
                  </div>
                </DisclosurePanel>
              </Disclosure>
            </div>
            <!-- Product grid -->
            <div class="lg:col-span-3">
              <div class="relative z-10 flex items-left pb-6 border-b border-gray-200">
                <div class="mr-3 relative rounded-md shadow-sm w-3/5">
                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 sm:text-sm">
                      <SearchIcon
                        class="h-6 w-6"
                        aria-hidden="true"
                      />
                    </span>
                  </div>
                  <input
                    v-model="slug"
                    type="text"
                    class="focus:ring-indigo-500 focus:border-indigo-500 block text-lg w-full py-3 pl-10 pr-12 sm:text-md border-gray-300 rounded-md"
                    :placeholder="searchPlaceHolder"
                  />
                </div>

                <BreezeButton @click="find" class="w-1/5 mr-3 flex px-5">Find</BreezeButton>

                <div class="w-1/5 mr-3 flex items-center">
                  <Menu
                    as="div"
                    class="relative inline-block text-left"
                  >
                    <div>
                      <RefreshIcon alt="reset filters" @click="clearFilters" v-if="checkedFilters.length || slug" class="cursor-pointer text-red-500 font-bold w-5 h-5" aria-hidden="true" />
                      <!-- <MenuButton class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900">
                        Sort
                        <ChevronDownIcon
                          class="flex-shrink-0 -mr-1 ml-1 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                          aria-hidden="true"
                        />
                      </MenuButton> -->
                    </div>

                    <transition
                      enter-active-class="transition ease-out duration-100"
                      enter-from-class="transform opacity-0 scale-95"
                      enter-to-class="transform opacity-100 scale-100"
                      leave-active-class="transition ease-in duration-75"
                      leave-from-class="transform opacity-100 scale-100"
                      leave-to-class="transform opacity-0 scale-95"
                    >
                      <MenuItems class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-2xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                        <div class="py-1">
                          <MenuItem
                            v-for="option in sortOptions"
                            :key="option.name"
                            v-slot="{ active }"
                          >
                          <a
                            :href="option.href"
                            :class="[option.current ? 'font-medium text-gray-900' : 'text-gray-500', active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm']"
                          >
                            {{ option.name }}
                          </a>
                          </MenuItem>
                        </div>
                      </MenuItems>
                    </transition>
                  </Menu>

                  <button
                    type="button"
                    class="p-2 -m-2 ml-4 sm:ml-6 text-gray-400 hover:text-gray-500 lg:hidden"
                    @click="mobileFiltersOpen = true"
                  >
                    <span class="sr-only">Filters</span>
                    <FilterIcon
                      class="w-5 h-5"
                      aria-hidden="true"
                    />
                  </button>
                </div>
              </div>
              <!-- Replace with your content -->
              <div class="mt-8">
                <div class="flow-root">
                  <div v-if="!products.length" class="text-lg text-gray-400">no results found. Please try with another filter</div>
                  <ul
                    role="list"
                    class="-my-6 divide-y divide-gray-200"
                  >
                    <li
                      v-for="product in products"
                      :key="product.id"
                      class="flex py-6"
                    >
                      <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                        <img
                          :src="product.img"
                          class="h-full w-full object-cover object-center"
                        />
                      </div>

                      <div class="ml-4 flex flex-1 flex-col">
                        <div>
                          <div class="flex justify-between text-base font-medium text-gray-900">
                            <h3>
                              <a :href="product.href"> {{ product.name }} </a>
                            </h3>
                            <p class="ml-4 text-sm text-gray-600">{{ product.fld_one }}</p>
                          </div>
                          <p class="mt-1 text-sm text-gray-500">{{ product.desc }}</p>
                        </div>
                        <div class="flex flex-1 items-end justify-between text-sm">
                          <p class="text-gray-500">{{product.fld_two}}</p>

                          <div class="flex">
                            <a
                              :href="product.href"
                              type="button"
                              class="font-medium text-indigo-600 hover:text-indigo-500"
                            >View More</a>
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>

              <!-- /End replace -->
            </div>
          </div>
        </section>
      </main>
    </div>

  </BreezeGuestLayout>
</template>
