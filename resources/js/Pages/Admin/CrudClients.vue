<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                Client</button>
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-10">Id</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Phone_number</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-for="client of clients" v-bind:key="client.name">
                        <td class="border px-4 py-2">{{client.id}}</td>
                        <td class="border px-4 py-2">{{client.name}}</td>
                        <td class="border px-4 py-2">{{client.email}}</td>
                        <td class="border px-4 py-2">{{client.phone_number}}</td>
                        <td class="border px-4 py-2">
                            <button type="button" @click="openModal(client)"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                            <button type="button" @click="userDelete(client.id)"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
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
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <form>
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="">
                                    <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Userame :
                                                {{this.tempClient.name}}</p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempClient.id"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempClient.id" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Username"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="userModify(tempClient.id, 'name', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Email :
                                                {{this.tempClient.email}}</p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempClient.email"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempClient.email" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Email"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="userModify(tempClient.id, 'email', tempContent), tempContent = null, hidden = null">Validate</button>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="tempContent = null, hidden = null">Cancel</button>
                                            <div class="text-red-500"></div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="grid grid-cols-8 gap-4">
                                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Phone number :
                                                {{this.tempClient.phone_number}}</p>
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button" @click="hidden = tempClient.phone_number"
                                                v-if="hidden == null">Edit</button>
                                        </div>
                                        <div v-if="hidden == tempClient.phone_number" class="grid grid-cols-6 gap-4">
                                            <input type="text"
                                                class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="exampleFormControlInput1" placeholder="Enter New Phone Number"
                                                v-model="tempContent">
                                            <button
                                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                                type="button"
                                                @click="userModify(tempClient.id, 'phone_number', tempContent), tempContent = null, hidden = null">Validate</button>
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
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
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
                clients: [],
                tempClient: null,
                tempContent: null,
                tempName: null,
                tempEmail: null,
                tempPhone: null,
            }
        },
        mounted() {
            this.getAllClients()
        },
        methods: {
            openModal(client) {
                this.isOpen = 'editModal'
                this.tempClient = client
            },
            async getAllClients() {
                this.clients = [];
                await axios.get('/api/users')
                    .then(response => {
                        response.data.forEach(element => {
                            if (element.is_seller == 0) {
                                this.clients.push(element)
                            }
                        })
                    })
            },
            async userDelete(id) {
                console.log('id:', id)
                let url = "/api/users/" + id
                await axios.delete(url)
                this.clients = []
                this.getAllClients()
            },
            async userModify(id, row, content) {
                if (row == 'name') {
                    this.tempClient.name = content;
                    var body = {
                        name: content
                    }
                } else if (row == 'email') {
                    this.tempClient.email = content;
                    var body = {
                        email: content
                    }
                } else {
                    this.tempClient.phone_number = content;
                    var body = {
                        phone_number: content
                    }
                }
                let url = "/api/users/" + id
                await axios.put(url, body)
            },
            async userCreate(name, email, phone) {
                let body = {
                    name: name,
                    email: email,
                    phone_number: phone
                }
                let url = "/api/users/" + id
                await axios.post(url, body)
            },
        },
    }
</script>