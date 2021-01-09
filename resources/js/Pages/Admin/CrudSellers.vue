<template>
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm"></p>
                    </div>
                </div>
            </div>
            <button @click="isOpen = 'createModal'"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create New
                Seller</button>
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-10">Id</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Phone_number</th>
                        <th class="px-4 py-2">Action</th>
                        <th class="px-4 py-2">Seller card</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(seller, index) of sellers" v-bind:key="seller.name">
                        <td class="border px-4 py-2">{{seller.id}}</td>
                        <td class="border px-4 py-2">{{seller.name}}</td>
                        <td class="border px-4 py-2">{{seller.email}}</td>
                        <td class="border px-4 py-2">{{seller.phone_number}}</td>
                        <td class="border px-4 py-2">
                            <button type="button" @click="openModal(seller)"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button type="button" @click="userDelete(seller.id, index)"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                        </td>
                        <td class="border px-4 py-2">
                            <div class="flex flex-row gap-4" v-if="seller.has_card == true">
                                <button  type="button" @click="openCard(seller.id)"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">See card</button>
                            </div>
                            <button v-else type="button" @click="openCard(seller.id)"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Card</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-if="isOpen == 'editModal'" class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle"
                        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <form>
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Userame :
                                                {{this.tempSeller.name}}</p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempSeller.id"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempSeller.id" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Username"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="userModify(tempSeller.id, 'name', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Email :
                                                {{this.tempSeller.email}}</p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempSeller.email"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempSeller.email" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Email"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="userModify(tempSeller.id, 'email', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Phone number :
                                                {{this.tempSeller.phone_number}}</p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempSeller.phone_number"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempSeller.phone_number" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Phone Number"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="userModify(tempSeller.id, 'phone_number', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button @click="isOpen = null, hidden = null" type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                        Go back
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div v-if="isOpen == 'createModal'" class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle"
                        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <form>
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="mb-4">
                                    <div class="grid grid-cols-5 gap-4">
                                        <p class="block text-gray-700 font-bold mb-2">Userame : </p>
                                        <input type="text"
                                            class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="exampleFormControlInput1" placeholder="Enter Username"
                                            v-model="tempName">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="grid grid-cols-5 gap-4">
                                        <p class="block text-gray-700 font-bold mb-2">Email : </p>
                                        <input type="text"
                                            class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="exampleFormControlInput1" placeholder="Enter Email"
                                            v-model="tempContent">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="grid grid-cols-3 gap-4">
                                        <p class="block text-gray-700 font-bold mb-2">Phone Number : </p>
                                        <input type="text"
                                            class=" col-span-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="exampleFormControlInput1" placeholder="Enter Phone Number"
                                            v-model="tempContent">
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button
                                        @click="userCreate(this.tempName, this.tempEmail, this.tempPhone), isOpen = null, hidden = null"
                                        type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                        Create
                                    </button>
                                </span>
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button @click="isOpen = null, hidden = null" type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                        Go back
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div v-if="isOpen == 'seeCard'" class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle"
                        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <form>
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Title : {{this.tempCard.title}}
                                                </p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempCard.title"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempCard.title" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Title"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="cardModify(tempCard.id, 'title', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                </div>
                                <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Description : {{this.tempCard.description}}
                                                </p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempCard.description"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempCard.description" class="grid grid-cols-6 gap-4">
                                            <textarea type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Description"
                                                v-model="tempContent"></textarea>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="cardModify(tempCard.id, 'description', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                </div>
                                <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Address : {{this.tempCard.adress}}
                                                </p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempCard.adress"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempCard.adress" class="grid grid-cols-6 gap-4">
                                            <textarea type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Adress"
                                                v-model="tempContent"></textarea>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="cardModify(tempCard.id, 'adress', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                </div>
                                <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Article number : {{this.tempCard.articles_number}}
                                                </p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempCard.articles_number"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempCard.articles_number" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Description"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="cardModify(tempCard.id, 'articles_number', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                </div>
                                <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p @click="test()" class="col-span-7 block text-gray-700 font-bold mb-2">Allergènes : {{this.tempCard.allergenes}}
                                                </p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempCard.id"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempCard.id" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Description"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="cardModify(tempCard.id, 'allergenes', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                </div>
                                <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p @click="test()" class="col-span-7 block text-gray-700 font-bold mb-2">Siret Number : {{this.tempCard.siret_number}}
                                                </p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempCard.siret_number"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempCard.siret_number" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Description"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="cardModify(tempCard.id, 'siret_number', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                </div>
                                <div class="mb-4">
                                    <p class="col-span-7 block text-gray-700 font-bold mb-2">Display : </p>
                                    <div class="flex justify-between items-center" @click="toggle(tempCard.id, tempCard.display)">
                                            <div class="w-16 h-10 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-400': toggleActive}">
                                            <div class="bg-white w-8 h-8 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-6': toggleActive}"></div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <span class=" rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button @click="isOpen = null, hidden = null, tempCard = null" type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                        Go back
                                    </button>
                                </span>
                                <span class=" rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <button
                                        @click="cardDelete(tempCard.id)"
                                        type="button"
                                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                        Delete card
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CrudDashboard from './CrudDashboard';
    export default {
        components: {
            CrudDashboard
        },
        data() {
            return {
                isOpen: null,
                hidden: null,
                sellers: [],
                cards: [],
                tempSeller: null,
                tempCard: null,
                tempContent: null,
                tempName: null,
                tempEmail: null,
                tempPhone: null,
                toggleActive: null,
            }
        },
        async beforeMount() {
            await this.getAllSellersAndCards()
        },
        methods: {
            openModal(seller) {
                this.isOpen = 'editModal'
                this.tempSeller = seller
            },
            test(){
                console.log("Toggle", this.cards)
            },
            openCard(id){
                console.log('id:', id)
                this.isOpen = 'seeCard'
                this.cards.forEach(card => {
                    if(card.user_id == id){
                        this.tempCard = card        
                    }
                })
                if(this.tempCard.display == 1){
                    this.toggleActive = true
                }else if (this.tempCard.display == 0){
                    this.toggleActive = false
                }
            },
            async toggle(id, display){
                
                if(display == 0){
                    this.toggleActive = true
                    this.tempCard.display = 1
                    let body = {
                        display : 1
                    }
                    let url = "/api/cards/" + id
                    await axios.put(url, body)
                }else if(display == 1){
                    this.toggleActive = false
                    this.tempCard.display = 0
                    let body = {
                        display : 0
                    }
                    let url = "/api/cards/" + id
                    await axios.put(url, body)
                }
            },
            async getAllSellersAndCards() {
                this.sellers = [];    
                 await axios.get('/api/users')
                    .then(response => {
                        response.data.forEach(element => {
                            if (element.is_seller == 1) {
                                this.sellers.push(element)
                            }
                        })
                        
                    })
                await axios.get("/api/cards?display=all")
                    .then(response => {
                        this.cards = response.data
                    })
                var has_card_true = {has_card : true};
                var has_card_false = {has_card : false};
                var actualizedArray = []
                this.sellers.forEach((seller,index) => {
                    actualizedArray.push(Object.assign(this.sellers[index], has_card_false))
                    this.cards.forEach(card => {
                        if(seller.id == card.user_id){
                            actualizedArray.splice(index, 1)
                            actualizedArray.push(Object.assign(this.sellers[index], has_card_true))                                
                        }
                    })
                })
            this.sellers = actualizedArray
            console.log('this.sellers:', this.sellers)
            console.log('this.cards:', this.cards)
            },
            async userDelete(id, index) {
                console.log('id:', id)
                let url = "/api/users/" + id
                await axios.delete(url)
                this.sellers.splice(index,1);
            },
            async userModify(id, row, content) {
                if (row == 'name') {
                    this.tempSeller.name = content;
                    var body = {
                        name: content
                    }
                } else if (row == 'email') {
                    this.tempSeller.email = content;
                    var body = {
                        email: content
                    }
                } else if(row == 'phone_number') {
                    this.tempSeller.phone_number = content;
                    var body = {
                        phone_number: content
                    }
                }else if(row == 'adress'){
                    this.tempSeller.phone_number = content;
                    var body = {
                        phone_number: content
                    }
                }
                let url = "/api/users/" + id
                await axios.put(url, body)
            },
            async sellerModify(id, row, content) {
                console.log('d:', id)
                
                if(row == 'adress'){
                    this.tempSeller.adress = content;
                    var body = {
                        adress: content
                    }
                }else if(row == 'siret_number'){
                    this.tempSeller.siret_number = content;
                    var body = {
                        siret_number: content
                    }
                }
                let url = "/api/sellers/" + id
                await axios.put(url, body)
            },
            async cardModify(id, row, content) {
                console.log('id:', id)
                
                if(row == 'title'){
                    this.tempCard.title = content;
                    var body = {
                        title: content
                    }
                }else if(row == 'description'){
                    this.tempCard.description = content;
                    var body = {
                        description: content
                    }
                }else if(row == 'articles_number'){
                    this.tempCard.articles_number = content;
                    var body = {
                        articles_number: content
                    }
                }else if(row == 'allergenes'){
                    this.tempCard.allergenes = content;
                    var body = {
                        allergenes: content
                    }
                }else if(row == 'adress'){
                    this.tempCard.adress = content;
                    var body = {
                        adress: content
                    }
                }else if(row == 'siret_number'){
                    this.tempCard.siret_number = content;
                    var body = {
                        siret_number: content
                    }
                }
                let url = "/api/cards/" + id
                await axios.put(url, body)
            },
            async cardDelete(id){
                let url = "/api/cards/" + id
                await axios.delete(url)
                await this.getAllSellersAndCards()
                this.isOpen = null
                this.hidden = null
                this.tempCard = null
            }
        },
    }
</script>