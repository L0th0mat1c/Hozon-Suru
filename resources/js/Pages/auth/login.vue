<template>
    <app-layout>
          <div class=" flex flex-wrap w-full justify-center items-center pt-56">
            <div class="flex flex-wrap max-w-xl">
                <div class="p-2 text-2x1 text-gray-800 font-semibold">Connectez-vous à la communauté</div>
                
                <div class="p-2 w-full">
                    <label class="w-full" for="email">Votre email:</label> 
                   
                    <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Email" type="text"
                    v-model="form.email">
                    <span class="text-danger" v-if="errors.email">{{errors.email[0]}}</span>
                </div>
                <div class="p-2 w-full">
                    <label class="w-full" for="email">Votre mot de passe:</label> 
                   
                    <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Password" type="password"
                    v-model="form.password" name="password">
                    <span class="text-danger" v-if="errors.password">{{errors.password[0]}}</span>
                </div>
                
                <div class="p-2 w-full mt-4">
                    <button @click.prevent="loginUser" type="submit" class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover-bg-indigo-600 rounded text-lg">Se Connecter</button>
                </div>
                 <div class="p-3">
                
            <span><a class="btn btn-link" href="/reset_password">
                                        Mot de passe oublié ?
                                    </a></span>
            </div>
            </div>
            <!-- <form action="api/password" -->
           
        </div>
        
</app-layout>
</template>
<script>
//Loic => Fichier search pour le module de recherche de cards


// import AppLayout from '@/Layouts/AppLayout'
import AppLayout from '../../Layouts/AppLayout.vue'


export default {
    components: {
        
        AppLayout
    },
    data() {
            return {
                form:{
                    email:'',
                    password:'',
                },
                errors:[],
                confirmed:''
                
        
            }
        },
        props: [
            
        ],
        mounted() {
            
        },
    methods: {
            
            async loginUser(){

                try {
                await axios.get('/sanctum/csrf-cookie');
                await axios.post('/api/login', this.form).then(response => {
                    this.confirmed = response.data
                    console.log(  'Ok pour bosser',this.confirmed  )
                    if (this.confirmed.is_seller == true) {
                        window.location = '/seller/profile'
                    }else{
                        window.location = '/client/profile'
                    }
                });
                    
                    // window.location = "/";
                } catch(error) {
                    this.errors = error.response.data.errors;
                }
                
            }
                
            
            

    }
}
</script>
       