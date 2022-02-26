<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased">
    <div>
        <div class="min-h-screen bg-gray-50">

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    Head
                </div>
            </header>

            <!-- Page Content -->
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="mb-4 md:flex md:justify-start">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                        Menu Category Name
                                    </label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="firstName" type="text" placeholder="Name" />
                                </div>
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="lastName">
                                        Menu Category Display Name
                                    </label>
                                    <input
                                        class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                        id="lastName" type="text" placeholder="Display Name" />
                                </div>
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="lastName">
                                        &nbsp;
                                    </label>
                                    <button type="submit"
                                        class="flex items-center justify-center px-2 py-1 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                        Create </button>
                                </div>
                            </div>
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
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Menu Categories</h3>
                                </div>
                                <div class="my-2 flex sm:flex-row flex-col">
                                    <div class="flex flex-row mb-1 sm:mb-0">
                                        <div class="relative">
                                            <select
                                                class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                                <option>5</option>
                                                <option>10</option>
                                                <option>20</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="relative">
                                            <select
                                                class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                                <option>All</option>
                                                <option>Active</option>
                                                <option>Inactive</option>
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block relative">
                                        <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                                <path
                                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                                </path>
                                            </svg>
                                        </span>
                                        <input placeholder="Search by category"
                                            class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                                    </div>
                                </div>
                                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                                        <table class="min-w-full leading-normal">
                                            <thead>
                                                <tr>
                                                    <th
                                                        class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                                                        Menu category
                                                    </th>
                                                    <th
                                                        class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                                                        Display name
                                                    </th>
                                                    <th
                                                        class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                                                        Created at
                                                    </th>
                                                    <th
                                                        class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">
                                                        Updated at
                                                    </th>
                                                    <th
                                                        class="px-5 py-3 border-b-2 border-indigo-600 bg-indigo-500 text-left text-xs font-semibold text-white uppercase">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    aria-hidden="true"
                                                                    class="flex-shrink-0 h-6 w-6 text-indigo-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z">
                                                                    </path>
                                                                </svg>
                                                                <span
                                                                    class="ml-2 text-sm font-medium text-gray-900">Beverages</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">Beverages
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">2022-02-18 18:53:34</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div class="text-sm text-gray-500">2022-02-18 18:53:34</div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="#"
                                                            class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                        <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    aria-hidden="true"
                                                                    class="flex-shrink-0 h-6 w-6 text-indigo-600">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z">
                                                                    </path>
                                                                </svg>
                                                                <span
                                                                    class="ml-2 text-sm font-medium text-gray-900">Fried
                                                                    Rice</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">Fried Rice
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="text-sm text-gray-500">2022-02-18 18:53:34</div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                        <div class="text-sm text-gray-500">2022-02-18 18:53:34</div>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        <a href="#"
                                                            class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                        <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div
                                            class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                                            <span class="text-xs xs:text-sm text-gray-900">
                                                Showing 1 to 4 of 50 Entries
                                            </span>
                                            <div class="inline-flex mt-2 xs:mt-0">
                                                <button
                                                    class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-l">
                                                    Prev
                                                </button>
                                                <button
                                                    class="text-sm bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-r">
                                                    Next
                                                </button>
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
</body>

</html>
