<script setup>
import {
  Popover,
  PopoverButton,
  PopoverGroup,
  PopoverPanel,
} from "@headlessui/vue";
import { Link } from "@inertiajs/inertia-vue3";
import {
  MenuIcon,
  XIcon,
  UserIcon,
  BookmarkIcon,
  ClipboardIcon,
  AdjustmentsIcon,
} from "@heroicons/vue/outline";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>
<script>
export default {
  components: {
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel,
    MenuIcon,
    XIcon,
  },
  setup() {
    return {};
  },
};
</script>
<!-- This example requires Tailwind CSS v2.0+ -->
<template>
  <Popover class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
      <div class="flex justify-between items-center py-4 md:justify-start md:space-x-10">
        <div class="flex justify-start lg:w-0 lg:flex-1">
          <a href="/">
            <span class="sr-only">Workflow</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              x="0px"
              y="0px"
              width="60"
              height="60"
              viewBox="0 0 172 172"
              style=" fill:#000000;"
            >
              <g
                fill="none"
                fill-rule="nonzero"
                stroke="none"
                stroke-width="1"
                stroke-linecap="butt"
                stroke-linejoin="miter"
                stroke-miterlimit="10"
                stroke-dasharray=""
                stroke-dashoffset="0"
                font-family="none"
                font-weight="none"
                font-size="none"
                text-anchor="none"
                style="mix-blend-mode: normal"
              >
                <path
                  d="M0,172v-172h172v172z"
                  fill="none"
                ></path>
                <g fill="#4f46e5">
                  <path d="M109.43823,59.57578c0,0.79156 -0.64178,1.43333 -1.43333,1.43333h-44.00978c-0.79156,0 -1.43333,-0.64177 -1.43333,-1.43333c0,-14.20828 10.85427,-24.10687 23.07452,-24.29321c13.08992,-0.19959 23.80229,10.39059 23.80229,23.43536v0.85785zM152.65,8.6v154.8c0,4.74075 -3.85925,8.6 -8.6,8.6h-116.1c-4.74075,0 -8.6,-3.85925 -8.6,-8.6v-154.8c0,-4.74075 3.85925,-8.6 8.6,-8.6h116.1c4.74075,0 8.6,3.85925 8.6,8.6zM58.40833,139.39167c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-3.58333c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h3.58333c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM58.40833,114.30833c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-3.58333c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h3.58333c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM58.40833,89.225c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-3.58333c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h3.58333c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM118.25,66.74245c1.64654,0 2.96843,-1.38782 2.86057,-3.0573c-0.09854,-1.52363 -1.4319,-2.67603 -2.95876,-2.67603h-1.54693c-0.79156,0 -1.43333,-0.64177 -1.43333,-1.43333c0,-16.38587 -11.47527,-27.81742 -25.06864,-29.73916c-0.70807,-0.09997 -1.23625,-0.70198 -1.23625,-1.41721v-0.9202c0,-1.64654 -1.38783,-2.96843 -3.0573,-2.86058c-1.52363,0.09854 -2.67603,1.4319 -2.67603,2.95876v0.82202c0,0.71523 -0.52818,1.31687 -1.23625,1.41721c-14.14951,2.00058 -25.06864,14.18857 -25.06864,28.88131v0.85785c0,0.79156 -0.64177,1.43333 -1.43333,1.43333h-1.54693c-1.52686,0 -2.86022,1.1524 -2.95876,2.67603c-0.10786,1.66948 1.21403,3.0573 2.86058,3.0573zM122.90833,139.39167c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-49.45c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h49.45c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM122.90833,114.30833c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-49.45c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h49.45c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM122.90833,89.225c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-49.45c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h49.45c1.58312,0 2.86667,-1.28355 2.86667,-2.86667z"></path>
                </g>
              </g>
            </svg>
          </a>
        </div>
        <div class="-mr-2 -my-2 md:hidden">
          <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <span class="sr-only">Open menu</span>
            <MenuIcon
              class="h-6 w-6"
              aria-hidden="true"
            />
          </PopoverButton>
        </div>
        <PopoverGroup
          v-if="$page.props.auth.user"
          as="nav"
          class="hidden md:flex space-x-10"
        >
          <a
            :href="route('dashboard')"
            class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
          >
            <component
              :is="AdjustmentsIcon"
              class="flex-shrink-0 h-6 w-6 text-indigo-600"
              aria-hidden="true"
            />
            <span class="ml-3 text-base font-medium text-gray-900">
              Home
            </span>
          </a>
          <a
            :href="route('profile')"
            class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
          >
            <component
              :is="UserIcon"
              class="flex-shrink-0 h-6 w-6 text-indigo-600"
              aria-hidden="true"
            />
            <span class="ml-3 text-base font-medium text-gray-900">
              Profile
            </span>
          </a>
          <a
            :href="route('menu_type.index')"
            class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
          >
            <component
              :is="BookmarkIcon"
              class="flex-shrink-0 h-6 w-6 text-indigo-600"
              aria-hidden="true"
            />
            <span class="ml-3 text-base font-medium text-gray-900">
              Menu Types
            </span>
          </a>
          <a
            :href="route('menu_item.index')"
            class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
          >
            <component
              :is="ClipboardIcon"
              class="flex-shrink-0 h-6 w-6 text-indigo-600"
              aria-hidden="true"
            />
            <span class="ml-3 text-base font-medium text-gray-900">
              Menu Items
            </span>
          </a>
          <a
            href="/"
            class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
          >
            <component
              :is="ClipboardIcon"
              class="flex-shrink-0 h-6 w-6 text-indigo-600"
              aria-hidden="true"
            />
            <span class="ml-3 text-base font-medium text-gray-900">
              Menus
            </span>
          </a>
        </PopoverGroup>

        <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
          <a
            v-if="canLogin"
            :href="route('login')"
            class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900"
          > Sign in </a>
          <a
            v-if="canRegister"
            :href="route('register')"
            class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
          > Sign up </a>
          <Link
            v-if="$page.props.auth.user"
            :href="route('logout')"
            method="post"
            as="button"
            class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-rose-600 hover:bg-rose-700"
          >
          Logout
          </Link>

        </div>
      </div>
    </div>

    <transition
      enter-active-class="duration-200 ease-out"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="duration-100 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <PopoverPanel
        focus
        class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden"
      >
        <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
          <div class="pt-5 pb-6 px-5">
            <div class="flex items-center justify-between">
              <div>
                <a href="/">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    x="0px"
                    y="0px"
                    width="60"
                    height="60"
                    viewBox="0 0 172 172"
                    style=" fill:#000000;"
                  >
                    <g
                      fill="none"
                      fill-rule="nonzero"
                      stroke="none"
                      stroke-width="1"
                      stroke-linecap="butt"
                      stroke-linejoin="miter"
                      stroke-miterlimit="10"
                      stroke-dasharray=""
                      stroke-dashoffset="0"
                      font-family="none"
                      font-weight="none"
                      font-size="none"
                      text-anchor="none"
                      style="mix-blend-mode: normal"
                    >
                      <path
                        d="M0,172v-172h172v172z"
                        fill="none"
                      ></path>
                      <g fill="#4f46e5">
                        <path d="M109.43823,59.57578c0,0.79156 -0.64178,1.43333 -1.43333,1.43333h-44.00978c-0.79156,0 -1.43333,-0.64177 -1.43333,-1.43333c0,-14.20828 10.85427,-24.10687 23.07452,-24.29321c13.08992,-0.19959 23.80229,10.39059 23.80229,23.43536v0.85785zM152.65,8.6v154.8c0,4.74075 -3.85925,8.6 -8.6,8.6h-116.1c-4.74075,0 -8.6,-3.85925 -8.6,-8.6v-154.8c0,-4.74075 3.85925,-8.6 8.6,-8.6h116.1c4.74075,0 8.6,3.85925 8.6,8.6zM58.40833,139.39167c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-3.58333c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h3.58333c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM58.40833,114.30833c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-3.58333c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h3.58333c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM58.40833,89.225c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-3.58333c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h3.58333c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM118.25,66.74245c1.64654,0 2.96843,-1.38782 2.86057,-3.0573c-0.09854,-1.52363 -1.4319,-2.67603 -2.95876,-2.67603h-1.54693c-0.79156,0 -1.43333,-0.64177 -1.43333,-1.43333c0,-16.38587 -11.47527,-27.81742 -25.06864,-29.73916c-0.70807,-0.09997 -1.23625,-0.70198 -1.23625,-1.41721v-0.9202c0,-1.64654 -1.38783,-2.96843 -3.0573,-2.86058c-1.52363,0.09854 -2.67603,1.4319 -2.67603,2.95876v0.82202c0,0.71523 -0.52818,1.31687 -1.23625,1.41721c-14.14951,2.00058 -25.06864,14.18857 -25.06864,28.88131v0.85785c0,0.79156 -0.64177,1.43333 -1.43333,1.43333h-1.54693c-1.52686,0 -2.86022,1.1524 -2.95876,2.67603c-0.10786,1.66948 1.21403,3.0573 2.86058,3.0573zM122.90833,139.39167c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-49.45c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h49.45c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM122.90833,114.30833c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-49.45c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h49.45c1.58312,0 2.86667,-1.28355 2.86667,-2.86667zM122.90833,89.225c0,-1.58312 -1.28355,-2.86667 -2.86667,-2.86667h-49.45c-1.58312,0 -2.86667,1.28355 -2.86667,2.86667c0,1.58312 1.28355,2.86667 2.86667,2.86667h49.45c1.58312,0 2.86667,-1.28355 2.86667,-2.86667z"></path>
                      </g>
                    </g>
                  </svg>
                </a>
              </div>
              <div class="-mr-2">
                <PopoverButton class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                  <span class="sr-only">Close menu</span>
                  <XIcon
                    class="h-6 w-6"
                    aria-hidden="true"
                  />
                </PopoverButton>
              </div>
            </div>
            <div
              class="mt-6"
              v-if="$page.props.auth.user"
            >
              <nav class="grid gap-y-8">
                <a
                  :href="route('dashboard')"
                  class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
                >
                  <component
                    :is="AdjustmentsIcon"
                    class="flex-shrink-0 h-6 w-6 text-indigo-600"
                    aria-hidden="true"
                  />
                  <span class="ml-3 text-base font-medium text-gray-900">
                    Home
                  </span>
                </a>
                <a
                  :href="route('profile')"
                  class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
                >
                  <component
                    :is="UserIcon"
                    class="flex-shrink-0 h-6 w-6 text-indigo-600"
                    aria-hidden="true"
                  />
                  <span class="ml-3 text-base font-medium text-gray-900">
                    Profile
                  </span>
                </a>
                <a
                  :href="route('menu_type.index')"
                  class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
                >
                  <component
                    :is="BookmarkIcon"
                    class="flex-shrink-0 h-6 w-6 text-indigo-600"
                    aria-hidden="true"
                  />
                  <span class="ml-3 text-base font-medium text-gray-900">
                    Menu Types
                  </span>
                </a>
                <a
                  :href="route('menu_item.index')"
                  class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
                >
                  <component
                    :is="ClipboardIcon"
                    class="flex-shrink-0 h-6 w-6 text-indigo-600"
                    aria-hidden="true"
                  />
                  <span class="ml-3 text-base font-medium text-gray-900">
                    Menu Items
                  </span>
                </a>
                <a
                  href="/"
                  class="-m-3 p-3 flex items-center rounded-md hover:bg-gray-50"
                >
                  <component
                    :is="ClipboardIcon"
                    class="flex-shrink-0 h-6 w-6 text-indigo-600"
                    aria-hidden="true"
                  />
                  <span class="ml-3 text-base font-medium text-gray-900">
                    Menus
                  </span>
                </a>
              </nav>
            </div>
          </div>
          <div class="py-6 px-5 space-y-6">
            <div>
              <a
                v-if="canRegister"
                :href="route('register')"
                class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
              > Sign up </a>
              <p
                v-if="canLogin"
                class="mt-6 text-center text-base font-medium text-gray-500"
              >
                Existing customer?
                <a
                  :href="route('login')"
                  class="text-indigo-600 hover:text-indigo-500"
                > Sign in </a>
              </p>
              <Link
                v-if="$page.props.auth.user"
                :href="route('logout')"
                method="post"
                as="button"
                class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-rose-600 hover:bg-rose-700"
              >
              Logout
              </Link>
            </div>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>
