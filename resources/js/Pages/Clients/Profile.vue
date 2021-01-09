<template>
    <app-layout>

        <div class="flex flex-row mt-5">
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <button v-if="this.page == 'profile'"
                    class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full"
                    @click="page = 'profile'">
                    Mon Profil
                </button>
                <button v-else class="bg-green-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full"
                    @click="page = 'profile'">
                    Mon Profil
                </button>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <button v-if="this.page == 'profile'"
                    class="bg-green-400 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full"
                    @click="page = 'bucket'">
                    Mon panier
                </button>
                <button v-else class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded-full"
                    @click="page = 'bucket'">
                    Mon panier
                </button>
            </div>
        </div>
        <div v-if="this.page == 'profile'">
            <form>
                <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <div class="grid grid-cols-8 gap-4">
                                <p class="col-span-7 block text-gray-700 font-bold mb-2">Photo de profil :
                                </p>
                                <img :src="currentUser.profile_photo_path">
                                <div v-if="hidden == currentUser.profile_photo_path">

                                    <input type="file" @change="onSelected">
                                    <button @click="upload()">Upload image</button>
                                </div>
                                <button v-if="hidden == 'yes'" @click="hidden = currentUser.profile_photo_path"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                    type="button">Edit</button>
                            </div>
                            <div class="grid grid-cols-8 gap-4">
                                    <p class="col-span-7 block text-gray-700 font-bold mb-2">Nom : {{currentUser.name}}

                                    </p>
                                    <button v-if="hidden == 'yes'" @click="hidden = currentUser.name"
                                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                        type="button">Editer</button>
                            </div>
                            <div v-if="hidden == currentUser.name" class="grid grid-cols-6 gap-4">
                                <input type="text" v-model="tempContent"
                                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput1" placeholder="Enter New Username">
                                <button @click="userModify('name',  tempContent), hidden = 'yes', tempContent = null"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                    type="button">Valider</button>
                                <button @click="hidden = 'yes', tempContent = null"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                    type="button">Annuler</button>
                                <div class="text-red-500"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="grid grid-cols-8 gap-4">
                                <p class="col-span-7 block text-gray-700 font-bold mb-2">Email : {{currentUser.email}}
                                </p>
                                <button v-if="hidden == 'yes'" @click="hidden = currentUser.email"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                    type="button">Editer</button>
                            </div>
                            <div v-if="hidden == currentUser.email" class="grid grid-cols-6 gap-4">
                                <input type="text" v-model="tempContent"
                                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput1" placeholder="Enter New Email">
                                <button @click="userModify('email',  tempContent), hidden = 'yes', tempContent = null"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                    type="button">Valider</button>
                                <button @click="hidden = 'yes', tempContent = null"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                    type="button">Annuler</button>
                                <div class="text-red-500"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="grid grid-cols-8 gap-4">
                                <p class="col-span-7 block text-gray-700 font-bold mb-2">Téléphone :
                                    {{currentUser.phone_number}}
                                </p>
                                <button v-if="hidden == 'yes'" @click="hidden = currentUser.phone_number"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                    type="button">Editer</button>
                            </div>
                            <div v-if="hidden == currentUser.phone_number" class="grid grid-cols-6 gap-4">
                                <input type="text" v-model="tempContent"
                                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput1" placeholder="Enter New Phone Number">
                                <button
                                    @click="userModify('phone_number',  tempContent), hidden = 'yes', tempContent = null"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                    type="button">Valider</button>
                                <button @click="hidden = 'yes', tempContent = null"
                                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                    type="button">Annuler</button>
                                <div class="text-red-500"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class=" rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button @click="warning = 'delete'" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Supprimer Mon Compte
                    </button>
                </span>
            </form>
            <div v-if="warning == 'delete'">
                <div class="flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800">
                    <div class="bg-white rounded-lg w-1/2">
                        <div class="flex flex-col items-start p-4">
                            <div class="flex items-center w-full">
                                <div class="text-gray-900 font-medium text-lg">Etes-vous sur ?</div>
                            </div>
                            <hr>
                            <div class="">La suppression de votre compte sera définitive.</div>
                            <hr>
                            <div class="ml-auto">
                                <button @click="userDelete(currentUser.id), warning = null"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    C'est compris !
                                </button>
                            </div>
                            <div class="ml-auto">
                                <button @click="warning = null"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <bucket v-if="this.page == 'bucket'"></bucket>

    </app-layout>
</template>


<script>
    import AppLayout from '../../Layouts/AppLayout'
    import Bucket from './Bucket'

    export default {

        components: {
            Bucket,
            AppLayout
        },

        data() {
            return {
                page: 'profile',
                hidden: 'yes',
                tempContent: null,
                currentUser: null,
                selectedFile: null,
                profile_photo: '',
                warning: null

            }
        },
        async beforeMount() {
            await axios.get('/api/user').then((response) => {

                this.currentUser = response.data

            })

            console.log('this.currentUser:', this.currentUser)
        },

        methods: {
            async userModify(row, content) {
                if (row == 'name') {
                    this.currentUser.name = content;
                    var body = {
                        name: content
                    }
                } else if (row == 'email') {
                    this.currentUser.email = content;
                    var body = {
                        email: content
                    }
                } else if (row == 'phone_number') {
                    this.currentUser.phone_number = content;
                    var body = {
                        phone_number: content
                    }
                }
                let url = "/api/users/" + this.currentUser.id
                await axios.put(url, body)
            },


            async onSelected(event) {
                this.selectedFile = event.target.files[0]
                await axios.post(
                    'https://api.imgur.com/3/image', this.selectedFile, {
                        headers: {
                            // 'Access-Control-Allow-Headers': '*',
                            // 'Access-Control-Allow-Origin': "*",

                            Authorization: 'Client-ID efc40da539eb36a',
                        }
                    }
                ).then(response => {
                    this.profile_photo = response.data.data.link
                    console.log(this.profile_photo)
                })
                console.log('userID', this.currentUser.id)
                // await axios.get('/sanctum/csrf-cookie')
                var body = {
                    profile_photo_path: this.profile_photo
                }
                await axios.put("/api/users/" + this.currentUser.id, body).then(response => {
                    console.log('upload database ok')
                })
                // window.location = '/seller/profile'
            },


            async userDelete(id) {
                console.log('id:', id)
                await axios.post('/api/logout')
                let url = "/api/users/" + id
                await axios.delete(url)
                window.location = '/';
            },

        }
    }

</script>
