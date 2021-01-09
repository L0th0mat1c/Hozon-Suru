<template>
    <app-layout>
        <div class=" flex flex-wrap w-full justify-center items-center pt-56">
            <div class="flex flex-wrap max-w-xl">
                <div class="p-2 text-2x1 text-gray-800 font-semibold">Rejoignez la communauté de Hozon</div>
                <div class="p-2 w-full">
                    <label class="w-full" for="name">Nom :</label> 
                    <span class="w-full text-red-500" v-if="errors.name">{{errors.name[0]}}</span>
                    <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Name" type="text"
                    v-model="form.name">
                </div>
                <div class="p-2 w-full">
                    <label class="w-full" for="email">Votre email:</label> 
                   
                    <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Email" type="text"
                    v-model="form.email">
                </div>
                <div class="p-2 w-full">
                    <label class="w-full" for="email">Votre mot de passe:</label> 
                   
                    <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Password" type="password"
                    v-model="form.password" name="password">
                </div>
                <div class="p-2 w-full">
                    <label class="w-full" for="email">Confirmer votre mot de passe:</label> 
                   
                    <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" placeholder="Confirm Password" type="password"
                    v-model="form.password_confirmation" name="password_confirmation">
                </div>
                <div class="p-2 w-full">
                    <label class="w-full" for="email">Type de compte :</label> 
                        <select v-model="form.is_seller">
                            <option value="null" selected="selected">Choisir votre type de compte </option>
                            <option value="1">Professionnel</option>
                            <option value="0">Particulier</option>
                        </select>
                </div>
                <div class="p-2 w-full mt-4">
                    <button @click.prevent="saveForm" type="submit" class="flex text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover-bg-indigo-600 rounded text-lg">S'enregistrer</button>
                </div>
                
            </div>
        </div>
</app-layout>
</template>
<script>
//Loic => Fichier search pour le module de recherche de cards


// import AppLayout from '@/Layouts/AppLayout'
import AppLayout from '../../Layouts/AppLayout'


export default {
    components: {
        
        AppLayout
    },
    data() {
            return {
                form:{
                    name:'',
                    email:'',
                    password:'',
                    password_verified: '',
                    is_seller:'',
                },
                errors:[]
               
        
            }
        },
        props: [
            
        ],
        mounted() {
            
        },
    methods: {
            
            saveForm(){
                console.log('ok register')
                axios.post('/api/register', this.form).then(() =>{
                    console.log('saved');
                    window.location = '/login'
                }).catch((error) =>{
                    this.errors = error.response.data.errors;
                })
            }
            
            

    }
}
</script>

       