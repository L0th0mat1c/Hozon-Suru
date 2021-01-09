<template>  
    <app-layout>  
<!-- --------------------------------------------------------------------------------------------------------------------- -->
<!--                                              Body_                                                                    -->
<!-- --------------------------------------------------------------------------------------------------------------------- -->
        <div class="Container">
<!-- --------------------------------------------------------------------------------------------------------------------- -->
<!--                                              Search bar_                                                              -->
<!-- --------------------------------------------------------------------------------------------------------------------- -->
            <div class="search-box overflow-hidden shadow-xl flex">
                <div class="search-1">
    <!-- Category Filter_ -->
                    <div class="cat-box">
                        <img class="cat-icon" src="../../assets/icons/List-White.png">
                        <select 
                        v-model="categorie_id" 
                        aria-label="Catégories" 
                        class="cat-drop-list">
                            <option 
                            value=""
                            selected="selected" 
                            @click="searchCards()">Catégories</option>
                            <option 
                            v-for="categorie in categories" 
                            :key="categorie.id+'nav1'" 
                            v-bind:value="categorie.id" 
                            @click="searchCards()">{{categorie.name}}</option>
                        </select>
                    </div>
    <!-- Input Filter_ -->
                    <div class="input-box">
                        <img class="input-icon" src="../../assets/icons/Search-White.png">
                        <input 
                        type="text"
                        name="search"
                        v-model="search"
                        class="input-bar"
                        aria-label="Rechercher"
                        placeholder="Que recherchez-vous ?"
                        @keyup.enter="searchCards()">
                    </div>
    <!-- Location Filter_ -->
                    <div class="loc-box">
                        <img class="input-icon" src="../../assets/icons/Marker-White.png">
                        <select 
                        v-model="location_id" 
                        aria-label="Locations" 
                        class="loc-drop-list">
                            <option 
                            value="" 
                            selected="selected" 
                            @click="searchCards()">Choisir un secteur</option>
                            <option 
                            v-for="location in locations" 
                            :key="location.id+'nav2'" 
                            v-bind:value="location.id" 
                            @click="searchCards()">{{location.name}}</option>
                        </select>
                    </div>
    <!-- Price Filter_ -->
                    <div class="price-box">
                        <select v-model="price" aria-label="Prix" class="price-drop-list">
                            <option value="" selected="selected" @click="searchCards()">Choisir un prix</option>
                            <option value="5" @click="searchCards(), searchShow = true">Moins de 5 €</option>
                            <option value="10" @click="searchCards(), searchShow = true">Moins de 10 €</option>
                            <option value="15" @click="searchCards(), searchShow = true">Moins de 15 €</option>
                            <option value="20" @click="searchCards(), searchShow = true">Moins de 20 €</option>
                            <option value="21" @click="searchCards(), searchShow = true">Plus de 20 €</option>
                        </select>
                    </div>
                </div>
            </div>
<!-- --------------------------------------------------------------------------------------------------------------------- -->
<!--                                              Mobile search bar_                                                       -->
<!-- --------------------------------------------------------------------------------------------------------------------- -->
            <div class="mobile-search-box shadow-xl">
                <div class="mobile-search-1">
    <!-- Category Filter_ -->
                    <div class="mobile-cat-box">
                        <select 
                        v-model="categorie_id" 
                        aria-label="Catégories" 
                        class="mobile-cat-drop-list">
                            <option 
                            value=""
                            selected="selected" 
                            @click="searchCards()">Catégories</option>
                            <option 
                            v-for="categorie in categories" 
                            :key="categorie.id+'nav1'" 
                            v-bind:value="categorie.id" 
                            @click="searchCards()">{{categorie.name}}</option>
                        </select>
                    </div>
    <!-- Input Filter_ -->
                    <div class="mobile-input-box">
                        <input 
                        type="text"
                        name="search"
                        v-model="search"
                        class="mobile-input-bar"
                        aria-label="Rechercher"
                        placeholder="Que recherchez-vous ?"
                        @keyup.enter="searchCards()">
                    </div>
    <!-- Location Filter_ -->
                    <div class="mobile-loc-box">
                        <select 
                        v-model="location_id" 
                        aria-label="Locations"
                        name="loc"
                        class="mobile-loc-drop-list">
                            <option 
                            value="" 
                            selected="selected" 
                            @click="searchCards()">Choisir un secteur</option>
                            <option 
                            v-for="location in locations" 
                            :key="location.id+'nav2'" 
                            v-bind:value="location.id" 
                            @click="searchCards()">{{location.name}}</option>
                        </select>
                    </div>
    <!-- Price Filter_ -->
                    <div class="mobile-price-box">
                        <select v-model="price" aria-label="Prix" name="prices" class="mobile-price-drop-list">
                            <option value="" selected="selected" @click="searchCards()">Choisir un prix</option>
                            <option value="5" @click="searchCards(), searchShow = true">Moins de 5 €</option>
                            <option value="10" @click="searchCards(), searchShow = true">Moins de 10 €</option>
                            <option value="15" @click="searchCards(), searchShow = true">Moins de 15 €</option>
                            <option value="20" @click="searchCards(), searchShow = true">Moins de 20 €</option>
                            <option value="21" @click="searchCards(), searchShow = true">Plus de 20 €</option>
                        </select>
                    </div>
                </div>
            </div>
<!-- --------------------------------------------------------------------------------------------------------------------- -->
<!--                                              Display results_                                                         -->
<!-- --------------------------------------------------------------------------------------------------------------------- -->
            <div v-if="cards != null" class="display-screen flex flex-wrap justify-center overflow-hidden shadow-xl">     
                <div class="card shadow-xl" v-for="card in cards" :key="card.id+'a'">
                    <div class="container">
                        <img class="container-img" :src="card.background_image" alt="BG-img">
                        <div class="nbr-card">{{card.articles_number}} articles</div>
                        <div class="price-card">{{card.price}} €</div>
                        <div class="seller-profile"></div>
                    </div>
                    <div class="card-data">
                        <div class="seller-name">{{card.title}}</div>
                        <div v-for="categorie in categories" :key="categorie.id+'b'">
                            <div v-if="card.category_id == categorie.id" class="seller-category">{{categorie.name}}</div>
                        </div>                                       
                        <div v-for="location in locations" :key="location.id+'c'">
                            <div v-if="card.location_id == location.id" class="date">{{location.name}}</div>        
                        </div>                
                        <a :href="'search/'+card.id+'/'+card.category_id+'/'+card.location_id+'/'+card.user_id"><button class="rez-btn">
                            RESERVER
                        </button></a>
                    </div>
                </div>
            </div>
            <div v-if="cards == null"> <p>Nous n'avons rien trouvé avec ses filtres ! </p> </div>
        </div>
    </app-layout>
</template>

<script>
//Loic => Fichier search pour le module de recherche de cards
import AppLayout from '../Layouts/AppLayout.vue'
export default {
    components: {
        AppLayout
    },
    data() {
            return {
                isOpen: false,
               
                search:'',
                // searchShow: false,
                categorie_id:'',
                location_id: '',
                priceSelected:'',
                price:'',
                // results:[]
                
            }
        },
        props: [
            'cards',
            'categories',
            'locations'
        ],
        mounted() {
           
        },
    methods: {
            async searchCards() {
                this.cards = [];
                await axios.get('/api/cards?search=' + this.search +
                        "&categorie_id=" + this.categorie_id +
                        "&location_id=" + this.location_id +
                        "&price=" + this.price)
                    .then(response => {
                        if (response.data.length == 0) {
                            this.cards = null
                            console.log('this.cards:', this.cards)
                        } else {
                            this.cards = response.data
                            console.log('this.cards else:', this.cards)
                        }
                    })
            }         
           
    }
}
</script>

<style>
    .test{
        background-color: #b4d455;
    }
    .Container{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        align-content: center;
    }
    .search-box{
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 0% 4%;
        border-radius: 32px;
        height: 150px;
        width: 80%;
        margin-bottom: 2%;
        margin-top: 2%;
        border: solid 1px #c8c8c850;
        background-color: #00573a;
        color: #d8d8d8;
        font-family: "Titillium Web", sans-serif;
    }
    .search-1{
        display: flex;
        justify-content: space-between;
        color: #d8d8d8;
    }
/* CATEGORIES_ */
    .cat-box{
        display: flex;
        justify-content: space-between;
        align-content: center;
        align-items: center;
        height: 42px;
        width: 24%;
        border: solid 1px #d8d8d8;
        color: #d8d8d8;
        padding-left: 1vw;
        padding-right: 1vw;
        border-radius: 6px;
    }
    .cat-icon{
        height: 24px;
        width: 24px;
    }
    .cat-drop-list{
        background: none;
        border-style: none;
        color: #d8d8d8;
    }
    .cat-drop-list:focus{
        outline: none;
    }
/* SEARCH INPUT_ */
    .input-box{
        display: flex;
        justify-content: space-between;
        align-content: center;
        align-items: center;
        height: 42px;
        width: 24%;
        border: solid 1px #d8d8d8;
        color: #f6f6f6;
        padding-left: 0.5vw;
        padding-right: 0.5vw;
        border-radius: 6px;
    }
    .input-box::placeholder {
        color: #d8d8d8;
        opacity: 1;
    }
    .input-icon{
        height: 24px;
        width: 24px;
    }
    .input-bar{
        background: none;
        border-style: none;
        color: #d8d8d8;
    }
    .input-bar:focus{
        outline: none;
        color: #d8d8d8;
    }
/* LOCATIONS_ */
    .loc-box{
        display: flex;
        justify-content: space-evenly;
        align-content: center;
        align-items: center;
        height: 42px;
        width: 24%;
        border: solid 1px #d8d8d8;
        color: #d8d8d8;
        padding-left: 1vw;
        padding-right: 1vw;
        border-radius: 6px;
    }
    .loc-icon{
        height: 24px;
        width: 24px;
    }
    .loc-drop-list{
        background: none;
        border-style: none;
        color: #d8d8d8;
    }
    .loc-drop-list:focus{
        outline: none;
    }
/* PRICES_ */
    .price-box{
        display: flex;
        justify-content: space-evenly;
        align-content: center;
        align-items: center;
        height: 42px;
        width: 24%;
        border: solid 1px #d8d8d8;
        color: #d8d8d8;
        border-radius: 6px;
    }
    .price-drop-list{
        background: none;
        border-style: none;
        color: #d8d8d8;
    }
    .price-drop-list:focus{
        outline: none;
    }
/* DISPLAY SCREEN_ */
    .display-screen{
        border-radius: 32px;
        border: solid 1px #c8c8c850;
        width: 80%;
        padding: 3% 1%;
    }
/* CARDS_ */
    .card{
        display: flex;
        flex-direction: column;
        border-color: #80808080;
        border-style: solid;
        border-width: 0.5px;
        border-radius: 16px;
        margin: 16px;
        font-family: "Titillium Web", sans-serif;
        height: 470px;
    }
    /* .card:hover{
    background-color: #40d6a4;
    } */
    .container{
        position: relative;
        text-align: center;
        width: 350px;
        display: flex;
        flex-direction: column;
    }
    .container-img {
        border-top-right-radius: 16px;
        border-top-left-radius: 16px;
        max-height: 200px;
        max-width: 350px;
    }
    .nbr-card{
        position: absolute;
        top: 8px;
        left: 8px;
        background-color: #40d6a4;
        color: #303030;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
    }
    .price-card{
        position: absolute;
        bottom: 8px;
        right: 8px;
        background-color: #40d6a4;
        color: #303030;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
    }
    .card-data{
        width: 350px;
        height: 200px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        align-content: center;
    }
    .seller-profile{
        border-radius: 50%;
        border: solid 0.5px #303030;
        position: absolute;
        bottom: 8px;
        left: 8px;
        background-color: #00573a;
        height: 42px;
        width: 42px;
    }
    .seller-name{
        font-size: 18px;
        font-family: "Amaranth", sans-serif;
        text-align: center;
        padding-bottom: 1%;
    }
    .seller-category{
        padding-bottom: 1rem;
    }
    .date{
        padding-bottom: 1rem;
    }
    .rez-btn{
        padding: 8px 16px;
        border-radius: 8px;
        background-color: #00573a;
        color: #f6f6f6;
        width: 100%;
    }
    .mobile-search-box{
        display: none;
    }
/* RESPONSIVE_ */
    @media (max-width: 1100px) {
        .search-box{
            display: none;
        }
        .mobile-search-box{
            display: flex;
            flex-direction: column;
            padding: 3vh 3vw;
            background-color: #00573a;
            border-radius: 16px;
            margin: 2vh 0vw;
            width: 80vw;
        }
        .mobile-search-1{
            display: flex;
            flex-direction: column;
        }
    /* CATEGORIES_ */
        .mobile-cat-box{
            display: flex;
            color: #f6f6f6;
        }
        .mobile-cat-drop-list{
            width: 100%;
            background: none;
            border-style: none;
            border-bottom: solid 2px #f6f6f6;
            padding-bottom: 0.5vh;
            margin: 1vh 0vh;
        }
    /* SEARCH INPUT_ */
        .mobile-input-box{
            display: flex;
        }
        .mobile-input-bar::placeholder {
            opacity: 1;
            color: #f6f6f6ff;
        }
        .mobile-input-bar{
            width: 100%;
            color: #f6f6f6;
            background: none;
            border-style: none;
            border-bottom: solid 2px #f6f6f6;
            padding-bottom: 0.5vh;
            margin: 1vh 0vh;
        }
    /* LOCATIONS_ */
        .mobile-loc-box{
            display: flex;
        }
        .mobile-loc-drop-list{
            width: 100%;
            color: #f6f6f6;
            background: none;
            border-style: none;
            border-bottom: solid 2px #f6f6f6;
            padding-bottom: 0.5vh;
            margin: 1vh 0vh;
        }
    /* PRICES_ */
        .mobile-price-box{
            display: flex;
        }
        .mobile-price-drop-list{
            width: 100%;
            color: #f6f6f6;
            background: none;
            border-style: none;
            border-bottom: solid 2px #f6f6f6;
            padding-bottom: 0.5vh;
            margin: 1vh 0vh;
        }
    }

</style>