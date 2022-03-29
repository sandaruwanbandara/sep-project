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
        style="background-image: url('/images/dish.png')"
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
                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:mx-auto md:mt-5 md:text-xl lg:mx-0">{{desc}}</p>
                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:mx-auto md:mt-5 md:text-xl lg:mx-0">{{price}}</p>
                <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:mx-auto md:mt-5 md:text-xl lg:mx-0">{{availability}}</p>
              </div>
              <!-- Replace with your content -->

              <div class="mt-8">
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
  name: String,
  desc : String,
  price : String,
  availability: String
});

</script>
