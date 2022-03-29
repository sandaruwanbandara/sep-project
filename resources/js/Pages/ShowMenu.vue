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
              href="/"
              class="w-full flex items-center justify-center px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-3 md:text-lg md:px-8"
            > Back To Home </a>
          </div>
        </div>
      </div>
      <!-- Col -->
      <div
        class="w-full h-auto hidden lg:block lg:w-1/3 bg-contain bg-no-repeat bg-center"
        style="background-image: url('/images/menucard.png')"
      >
      </div>
    </main>

    <div class="mt-16 lg:mt-20">
      <!-- Mobile filter dialog -->
      <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <section
          aria-labelledby="products-heading"
          class="pt-6 pb-24"
        >
          <div class="grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-10">
            
            <!-- Product grid -->
            <div class="lg:col-span-3">
              <div class="relative z-10 pb-6 border-b border-gray-200">
                <h1 class="text-xl tracking-tight font-bold text-gray-900 sm:text-2xl md:text-3xl">
                {{name}}
                </h1>
                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:mx-auto md:mt-5 md:text-xl lg:mx-0">{{desc}}.</p>
              </div>
              <!-- Replace with your content -->

              <div class="mt-8">
                <div class="flow-root">
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

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
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
} from "@heroicons/vue/solid";
import BreezeButton from "@/Components/Button.vue";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  products : Array,
  name : String,
  desc : String
});

</script>
