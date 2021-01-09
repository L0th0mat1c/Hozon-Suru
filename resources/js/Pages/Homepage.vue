<template>
<app-layout>
    <div class="Home-display">
<!-- --------------------------------------------------------------------------------------------------------------------- -->
<!--                                              Header_                                                                  -->
<!-- --------------------------------------------------------------------------------------------------------------------- -->
        <div class="HS-HL">
            <h1>HOZON SURU</h1>
        </div>
        <p class="HS-sub">Préservez le monde d'une crise alimentaire avec Hozon suru, évitez à des plats encore comestibles de finir à la poubelle et réduisez à votre niveau le cercle vicieux de la surproduction</p>
        <p class="DBL-SUB">Nos derniers bons plans</p>
<!-- --------------------------------------------------------------------------------------------------------------------- -->
<!--                                              Body_                                                                    -->
<!-- --------------------------------------------------------------------------------------------------------------------- -->
        <div class="display-cards f-row">
            <div class="card shadow-xl" v-for="card in cards" :key="card.id">

            <a :href="'search/'+ card.id+'/'+ card.category_id+'/'+card.location_id+'/'+ card.user_id">
                <div class="container">
                    <img class="container-img" :src="card.background_image" alt="BG-img">
                    <div class="nbr-card">{{card.articles_number}} articles</div>
                    <div class="price-card">{{card.price}} €</div>
                    <div class="seller-profile"></div>
                </div>
                <div class="card-data">
                    <div class="seller-name">{{card.title}}</div>
                    <div class="seller-category">Exotique</div>
                    <div class="date">{{card.created_at}}</div>
                    <button class="rez-btn">RESERVER</button>
                </div>
            </a>
            </div>
        </div>
    </div>
</app-layout>
</template>

<script>

import AppLayout from '../Layouts/AppLayout.vue'

    export default {
        components: {
        AppLayout
        },
        data() {
            return {
                cards: this.cardsHome,
            }
        },
        props: [
            'cardsHome'
        ],
        mounted() {
            
        },
        methods: {
 
        },
    }
</script>


<style>
    .screen-container{
        display: flex;
        flex-direction: column;
    }
    .Home-display{
        display: flex;
        flex-direction: column;
        align-content: center;
        margin: 2% 10%;
        width: 80%;
    }
    .HS-HL{
        display: flex;
        align-content: center;
        justify-content: center;
        min-height: 100px;
        font-family: "Amaranth", sans-serif;
        text-align: center;
        background-image: url("../../assets/visuals/HS-jungle.jpg");
        border-radius: 16px;
        margin-bottom: 1%;
    }
    .HS-HL h1{
        display: flex;
        flex-direction: column;
        align-content: center;
        justify-content: center;
        text-align: center;
        font-size: 300%;
        min-height: 100%;
        color: #f6f6f6;
    }
    .HS-sub{
        font-size: 1.5vh;
        font-family: "Titillium Web", sans-serif;
        text-align: center;
        padding-bottom: 1rem;
        margin-bottom: 1%;
    }
    .DBL-SUB{
        font-size: 5vh;
        font-family: "Amaranth", "sans-serif";
        text-align: center;
        margin: 2vh 0vh;
    }
    .display-cards{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-content: center;
    }
    .card{
        display: flex;
        flex-direction: column;
        border-color: #80808080;
        border-style: solid;
        border-width: 0.5px;
        border-radius: 16px;
        margin-top: 16px;
        margin-right: 16px;
        height: 470px;
    }
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
        margin-top: 2vh;
        padding: 1vh 1vw;
    }
</style>

