<template>
<app-layout>
    <div>
        <div class="flex flex-row mt-5">
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" @click="isCrudClients = false, isCrudSellers = false, isDashboard = true">
                    Home
                </button>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <button  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" @click="isCrudClients = true, isCrudSellers = false, isDashboard = false" >
                    Clients
                </button>
            </div>
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" @click="isCrudClients = false, isCrudSellers = true, isDashboard = false">
                    Sellers
                </button>
            </div>
        </div>
        <main class="m-10">
            <div v-if="isDashboard">
                <h1 class="text-center"> Welcome to the admin panel</h1>
            </div>
            <crud-clients v-if="isCrudClients"></crud-clients>
            <crud-sellers v-if="isCrudSellers"></crud-sellers>
        </main>
    </div>
</app-layout>

</template>

<script>
    // import JetNavLink from '@/Jetstream/NavLink'
    import CrudClients from './CrudClients'
    import CrudSellers from './CrudSellers'
    import AppLayout from '../../Layouts/AppLayout'

    export default {
        components: {
            CrudClients,
            CrudSellers,
            AppLayout
        },
        data(){
            return{
            isDashboard: true,
            isCrudClients: false,
            isCrudSellers: false,
            }
            
        }
    }

</script>
