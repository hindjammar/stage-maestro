@include('admin.home')

<div class="flex overflow-hidden bg-white">
    <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop"></div>
    <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64 mt-4">
        <main>
            <div class="pt-6 px-4">
                <div class="mb-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-2 gap-4">
                   
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span
                                    class="text-2xl sm:text-3xl leading-none font-bold text-gray-900"></span>
                                <h3 class="text-base font-normal text-gray-500">All products</h3>
                            </div>
                            <div
                                class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                                <svg class="group-hover:text-gray-900 w-9 h-10 text-black dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M5 13.2a3 3 0 0 0 0 5.6V20a1 1 0 1 0 2 0v-1.2a3 3 0 0 0 0-5.6V4a1 1 0 0 0-2 0v9.2Zm6 6.8v-9.2a3 3 0 0 1 0-5.6V4a1 1 0 1 1 2 0v1.2a3 3 0 0 1 0 5.6V20a1 1 0 1 1-2 0Zm6-1.2V20a1 1 0 1 0 2 0v-1.2a3 3 0 0 0 0-5.6V4a1 1 0 1 0-2 0v9.2a3 3 0 0 0 0 5.6Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <span
                                    class="text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{$totalUsers}}</span>
                                <h3 class="text-base font-normal text-gray-500">All users</h3>
                            </div>
                            <div
                                class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                                <svg class="w-12 h-12 text-gray-800 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                          d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3a2.5 2.5 0 1 1 2-4.5M19.5 17h.5c.6 0 1-.4 1-1a3 3 0 0 0-3-3h-1m0-3a2.5 2.5 0 1 0-2-4.5m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3c0 .6-.4 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8  2xl:col-span-2">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold leading-none text-gray-900">Latest Users</h3>
                                <a href="/allusers"
                                   class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg inline-flex items-center p-2">
                                    View all
                                </a>
                            </div>
                            <div class="flow-root">
                                <ul role="list" class="divide-y divide-gray-200">
                                    @foreach($LatestUsers as $user)
                                        <li class="py-3 sm:py-4">
                                            <div class="flex items-center space-x-4">
                                                
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-gray-900 truncate">
                                                        {{$user->name}}
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate">
                                                        <a href="/cdn-cgi/l/email-protection" class="_cf_email_"
                                                           data-cfemail="17727a767e7b57607e7973646372653974787a">{{$user->email}}</a>
                                                    </p>
                                                </div>
                                                <div class="inline-flex items-center text-base  text-gray-600">
                                                    @foreach ($user->roles as $role)
                                                        {{ $role->name }}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>

                                    @endforeach
                                </ul>
                            </div>
                    </div>

                    <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Latest Creator</h3>
                                <span
                                    class="text-base font-normal text-gray-500">This is a list of latest creator</span>
                            </div>
                            <!-- <div class="flex-shrink-0">
                                <a href="creators"
                                   class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View
                                    all</a>
                            </div> -->
                        </div>
                        <div class="flex flex-col mt-8">
                            <div class="overflow-x-auto rounded-lg">
                                <div class="align-middle inline-block min-w-full">
                                    <div class="shadow overflow-hidden sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Creator
                                                </th>
                                                <th scope="col"
                                                    class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Email
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="bg-white">
                                            @foreach($LatestCreator as $creator)
                                                <tr>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                        <span class="font-semibold">{{$creator->name}}</span>
                                                    </td>
                                                    <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                        {{$creator->email}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </main>
        <p class="text-center text-sm text-gray-500 my-10">
            &copy;<?php echo date("Y"); ?>. All rights
            reserved.
        </p>
 </div>
</div>