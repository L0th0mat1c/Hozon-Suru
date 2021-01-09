<template>
<div>
    <div class="flex flex-wrap justify-center">
        <div class="py-3 flex flex-wrap" v-for="card in cards" :key="card.id">
            <div class="mx-8 bg-gray-200 rounded shadow p-4">
                <div class="text-4x2"><h2> {{card.title}}</h2></div>
                <div>Prix : {{card.price}} €</div>
                <div>Nombre de réservations possible : {{card.articles_number}}</div>
                    <div v-for="seller in sellers" :key="seller.id">
                            <div v-if="seller.id == card.seller_id">
                                
                                <div v-for="categorie in categories" :key="categorie.id">
                                    <div v-if="seller.category_id == categorie.id">Categorie : {{categorie.name}}</div>
                                </div>
                                
                                <div v-for="location in locations" :key="location.id">
                                    <div v-if="seller.location_id == location.id">Locatisation : {{location.name}}</div>        
                                </div>                
                                                
                              
                            </div>
                    </div>
                    <button class="bg-blue hover:bg-blue-dark text-black font-bold py-2 px-4 rounded">Réserver</button>
            </div>
        </div>

    </div>
</div>
</template>
<script>
// import Button from '../Jetstream/Button.vue'
//Loic => Fichier search pour le module de recherche de cards


// import AppLayout from '@/Layouts/AppLayout'
// import AppLayout from '../Layouts/AppLayout.vue'


export default {
    components: {
        // Button
        
        // AppLayout
    },
    data() {
            return {
                isOpen: false,
                cards: null,
                categories: this.categories,
                locations: this.locations,
                search:'',
                categorie_id:'',
                location_id: '',
                sellers:''
                

            }
        },
        props: [
            'categories',
            'locations'
        ],
        mounted() {
            this.getAllCards()
            this.getAllSeller()
            console.log(this.cards);
            console.log(this.categories);
            console.log(this.locations);
        },
    methods: {
            async searchCards() {
                await axios.get('/search/result' ,{
                    params: {
                        // __limit:5
                        search: this.search ? this.search: '',
                        categorie_id: this.categorie_id,
                        location_id: this.location_id
                    }
                })
                    .then(response => {
                        this.cards = response.data
                        console.log('this.cards:', this.cards)
                    })
            },
            async getAllSeller() {
                await axios.get('/api/sellers')
                    .then(response => {
                        this.sellers = response.data
                        console.log('this.sellers:', this.sellers)
                    })
            },
            async getAllCards() {
                await axios.get('/api/cards')
                    .then(response => {
                        this.cards = response.data
                        console.log('this.cards:', this.cards)
                    })
            },
            

    }
}
</script>
       