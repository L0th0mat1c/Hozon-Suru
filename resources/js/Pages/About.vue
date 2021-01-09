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
    
<!-- --------------------------------------------------------------------------------------------------------------------- -->
<!--                                              Body_                                                                    -->
<!-- --------------------------------------------------------------------------------------------------------------------- -->
        <div class="display-cards">
            <div class="about-container">
                <div class="project shadow-xl">
                    <h1>1/3 de toute la nourriture produite dans le monde est jetée.</h1>
                    <p>Réduire le gaspillage alimentaire est l'une des choses les plus importantes que l'on puisse faire pour inverser le changement climatique.Les actions d’aujourd’hui auront des conséquences graves sur l'avenir durable de notre planète.</p>
                    <p>Si nous disposons actuellement de suffisamment de ressources et de nourriture pour nourrir une population croissante, une grande partie en est malheureusement gaspillée.
                    Si nous continuons à faire comme si de rien n'était, davantage de populations connaîtront l'insécurité alimentaire et des pénuries alimentaires.</p>
                    <p>Conscients de cette réalité grandissante, nous nous proposons de mettre en place une plateforme web grâce à laquelle les particuliers pourront récupérer des produits destinés à être jetés.
                    Les professionnels, qu’ils soient restaurateurs ou distributeurs, pourront ainsi bénéficier d’une ultime étape avant le gaspillage.</p>
                </div>
                <div class="photo1 shadow-xl"></div>
                <a href="https://fr.statista.com/infographie/4918/chiffre-cles-gaspillage-alimentaire/" 
                title="Infographie: Gaspillage alimentaire : 16 milliards d'euros perdus chaque année"
                class="waste-link shadow-xl">
                
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
                // sellers: [],
                // users: [],
                n: [1,2,3,4,5],
            }
        },
        props: [
            'cardsHome'
        ],
        mounted() {
            console.log(this.cards)
            // this.getCards(),
            // this.getCardsSellers()
            // this.getSellersUserData()
        },
        methods: {

        },
    }
</script>


<style>
/* SCREEN_ */
    .screen-container{
        display: flex;
        flex-direction: column;
    }
/* HEADER_ */
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
        font-size: 24px;
        font-family: "Titillium Web", sans-serif;
        text-align: center;
        padding-bottom: 1rem;
        margin-bottom: 1%;
    }
/* BODY_ */
    .display-cards{
        display: flex;
        flex-direction: column;
        align-content: center;
    }
    .about-container{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-content: center;
        margin-bottom: 5vh;
    }
    .project{
        display: flex;
        flex-direction: column;
        align-content: flex-start;
        border-radius: 32px;
        padding: 2vw 2vh;
        height: 33vh;
        width: 100%;
    }
    .project h1{
        font-family: "Amaranth", sans-serif;
        font-size: 2vh;
        margin-bottom: 1vh;
    }
    .project p{
        font-family: 'titillium','sans-serif';
        font-size: 2vh;
        margin-bottom: 1vh;
    }
    .photo1{
        border-radius: 32px;
        padding: 2vw 2vh;
        margin: 4vh 0vw;
        width: 100%;
        height: 33vh;
        background-image: url("../../assets/visuals/HS-FOOD-1.jpg");
        background-size: 100%;
    }
    .waste-link{
        background-image: url("https://cdn.statcdn.com/Infographic/images/normal/4918.jpeg");
        background-size: 100%;
        width: 100%;
        height: 66vh;
        border-radius: 32px;
    }
/* RESPONSIVE_ */
    @media (max-width: 1524px) {
        .waste-link{
            height: 38vh;
        }
        .project{
            height: 50vh;
        }
    }
    @media (max-width: 540px) {
        .waste-link{
            height: 39vh;
        }
        .project{
            height: 50vh;
            font-size: 1.5vh;
        }
    }
    @media (max-width: 420px) {
        .waste-link{
            height: 25vh;
        }
        .project{
            height: 50vh;
            font-size: 1.5vh;
        }
    }
/* END */
</style>
