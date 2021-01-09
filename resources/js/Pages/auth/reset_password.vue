<template>
    <app-layout>
        
        <div class=" flex flex-wrap w-full justify-center items-center pt-56">
            <!-- <div class="p-2 text-2x1 text-gray-800 font-semibold">Reset password</div> -->
            <div class="flex flex-wrap max-w-xl">
                <div class="title">
                    <h1>Réinitialisation de votre mot de passe :</h1>
                </div>  
                    <form v-on:submit.prevent="sendToken">
                        
                        <div class="p-2 w-full">
                            <label class="w-full" for="email">Votre email :</label> 
                        
                            <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" v-bind:class="{'is-invalid': errorEmail, 'is-valid':infoEmail}" placeholder="Votre email" type="text"
                            v-model="email" name="email">
                        <div class="text-red-600">{{errorEmail}}</div>
                        <div class="text-red-600">{{infoEmail}}</div>
                        <button class="backg-green hover:bg-blue-dark text-black font-bold py-2 px-4 rounded">Envoyer le token par mail</button>
                        </div>
                    </form>

                    <form v-on:submit.prevent="validateToken">
                        
                        <div class="p-2 w-full">
                            <label class="w-full" for="email">Token :</label> 
                        
                            <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" v-bind:class="{'is-invalid': errorToken, 'is-valid':infoToken}" placeholder="Token..." type="password"
                            v-model="token" name="token">
                        <div class="text-red-600">{{errorToken}}</div>
                         <div class="text-red-600">{{infoToken}}</div>
                        <button class="backg-green hover:bg-blue-dark text-black font-bold py-2 px-4 rounded" type="submit">Valider le token</button>
                        </div>
                    </form>

                    <div class="" v-if="tokenValid">
                        <form v-on:submit.prevent="changePassword">
                            
                            <div class="p-2 w-full">
                                    <label class="w-full" for="email">Nouveau mot de passe :</label> 
                                
                                    <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" v-bind:class="{'is-invalid': errorNewPassword}" placeholder="Mot de passe..." type="password"
                                    v-model="newPassword" name="token">
                                <div class="text-red-600">{{errorNewPassword}}</div>
                                <div class="p-2 w-full">
                                    <label class="w-full" for="email">Confirmer mot de passe :</label> 
                                
                                    <input class="w-full bg-gray-100 rounded border border-gray-400 focus:outline-none focus:border-indigo-500 text-base px-4 py-2" v-bind:class="{'is-invalid': errorPasswordAgain}" placeholder="Confirmer mot de passe..." type="password"
                                    v-model="passwordAgain" name="token">
                                <div class="text-red-600">{{errorPasswordAgain}}</div>
                                <button class="backg-green hover:bg-blue-dark text-black font-bold py-2 px-4 rounded" type="submit">Changer le mot de passe</button>
                                </div>
                            </div>
                        </form>
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
    name:'password-reset',
    props: {

    },
    data() {
            return {
                email:'',
                errorEmail: null,
                token:'',
                errorToken: null,
                infoToken: null,
                newPassword: '',
                errorNewPassword: null,
                passwordAgain: '',
                errorPasswordAgain: '',
                tokenValid: false,
                infoEmail: null,
                user: null


               
        
            }
        },
        props: [
            
        ],
        mounted() {
            
        },
    methods: {
            
            sendToken(){
                this.errorEmail = null;

                if (!this.email) {
                    this.errorEmail = "L'adresse mail est requis";
                }
                if (!this.errorEmail) {
                    const data = {
                        email: this.email
                    }

                    axios.post('send-token', data).then((response) => {
                        if(response.data.error) {
                            this.errorEmail = response.data.error 
                        }else{
                            this.infoEmail = 'Mail envoyé';
                        }
                        
                    }).catch(error => {
                        this.errorEmail = response.data.error;
                        
                    });
                    
                    
                }
            },
            validateToken() {
                this.errorToken = null;

                if (!this.token) {
                    this.errorToken  = "Token est demandé.";
                }

                if (!this.errorToken) {
                    const data = {
                        token: this.token
                    }
                    axios.post('validate-token', data).then(response => {

                        if (response.data.id) {
                            this.tokenValid = true;
                            this.infotoken = 'Le token est ok !';
                            this.user = response.data;
                        }
                    }).catch(error => {
                        this.errorToken = error.response.data.error;
                    })
                }

            },
            changePassword() {

                this.errorNewPassword = null;
                this.errorPasswordAgain = null;

                if (!this.newPassword) {
                    this.errorNewPassword = "Nouveau password est requis";
                }

                if (!this.passwordAgain) {
                    this.errorPasswordAgain = "Confirmation du password demandé !";
                }

                if (this.newPassword !== this.passwordAgain) {
                    this.errorPasswordAgain = " Password différent !";
                }

                if (!this.errorNewPassword && !this.errorPasswordAgain) {
                    const data = {
                        password:   this.newPassword,
                        id: this.user.id
                    }
                    axios.post('reset-password',data).then(() => {
                        window.location = '/login';
                    })
                }
            }
            
            

    }
}
</script>

<style scoped>
.backg-green{
    background-color: #00573A;
    color: white;
}
.title{
    padding-bottom: 50px;
    font-family: "Amaranth", sans-serif;
    
}
.title h1{
    font-size: 30px;
}
</style>