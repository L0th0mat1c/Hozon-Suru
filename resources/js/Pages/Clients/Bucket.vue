<template>
<div>
    <div v-if="currentUser.bucket_arr == null" class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="mb-4">
            
                <p class="flex-auto block text-gray-700 font-bold mb-2">Votre panier est vide.
                </p>
            
        </div>
    </div>
    <div v-if="currentUser.bucket_arr != null" class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div v-if=" currentUser.bucket_arr.length == 1">
            <h1 class = "m-5">Vous avez réservé 1 élément</h1>
        </div>
        <div v-else>
            <h1 class = "m-5">Vous avez réservé {{this.myBucket.length}} éléments</h1>
        </div>
        <!-- <tr class="flex flex-cols" v-for="card in cards" :key="card.id">
            <td>
                <div>{{card.title}}
                    </div>
                    <div>{{card.price}}
                    </div>
                    <div>{{card.adress}}
                    </div>
                    <div>{{card.description}}
                    </div>
            </td>
        </tr> -->
        
    </div>
</div>
</template>


<script>
    export default {
        data() {
            return {
                currentUser: null,
                myBucket: null,
                cards : []
            }
        },

        async beforeMount() {
            await this.getCurrentUser()
            await this.getCardsOfBucket()

            console.log('this.currentUser:', this.currentUser)
            console.log('this.myBucket:', this.myBucket)
            console.log('cards:', this.cards)
        },

        methods: {

            async getCurrentUser(){
                await axios.get('/api/user').then((response) => {

                this.currentUser = response.data

                this.myBucket = JSON.parse("[" + this.currentUser.bucket_arr + "]")
                
                })
            },

            async getCardsOfBucket(){
                await axios.get('/api/cards')
                    .then(response => {
                        response.data.forEach(card => {
                            this.myBucket.forEach(element => {
                                if(element == card.id){
                                    this.cards.push(card)
                                }
                            })
                        });
                    })
            }
        }
    }

</script>
