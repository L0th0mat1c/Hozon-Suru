<template>
    <app-layout>
        <div class="screen-container">
            <div class="card-container shadow-xl" v-for="car in card" :key="car.id">
                <!-- --------------------------------------------------------------------------------------------------------------------- -->
                <!--                                              INFORMATION SUR LA DISPONIBILITE DU PANIER_                              -->
                <!-- --------------------------------------------------------------------------------------------------------------------- -->
                <div class="sell-info">
                        <img class="card-image":src="car.background_image" alt="BG-img">
                    <div class="mob-rez-sell">
                        <div class="card-articles" v-if=" car.articles_number > 1  ">
                            <p>Articles Disponibles</p>
                            <div class="nbr-articles">{{car.articles_number}}<p>Articles</p>
                                <!-- VARIABLE card.articles -->
                            </div>
                        </div>
                        <div class="card-articles" v-else>
                            <p>Article Disponible</p>
                            <div class="nbr-articles">{{car.articles_number}}<p>Article</p>
                                <!-- VARIABLE card.articles -->
                            </div>
                        </div>
                        <div class="card-price">
                            <p>Prix du panier </p>
                            <div class="price">{{car.price}}€
                                <!-- VARIABLE card.price -->
                            </div>
                        </div>

                    </div>
                    <div class="card-disp">
                        <p>Horaires</p>
                        <div class="disp">{{car.start_time}} 
                            <!-- VARIABLE ??? disponibilité défini par le vendeur -->

                        </div>
                        <div class="disp">
                        {{car.end_time}}
                        </div>
                    </div>
                    <div class="card-rez" @click="isOpen = true">RESERVER</div>

                </div>
                <!-- --------------------------------------------------------------------------------------------------------------------- -->
                <!--                                              DESCRIPTION DU PANIER_                                                   -->
                <!-- --------------------------------------------------------------------------------------------------------------------- -->
                <div class="card-desc">
                    <div class="title">{{car.title}}
                        <!-- VARIABLE card.title -->
                    </div>
                    <div class="sub-title">
                        <div class="category">{{categorie[0].name}}
                            <!-- VARIABLE card.category -->
                        </div>
                    </div>
                    <div class="desc">
                        <p>Description</p>
                        <div class="descrition">{{car.description}}
                            <!-- VARIABLE card.description -->
                        </div>
                    </div>
                    <div class="map">
                        <!-- API MAP non definie -->
                    </div>
                    <div class="share-btn">
                        <p>Partager ce panier :</p>
                        <div class="facebook"></div>
                        <div class="twitter"></div>
                        <div class="mail"></div>
                    </div>
                </div>
                <!-- --------------------------------------------------------------------------------------------------------------------- -->
                <!--                                              INFORMATION SUR LE VENDEUR DU PANIER_                                    -->
                <!-- --------------------------------------------------------------------------------------------------------------------- -->
                <div class="seller-desc">
                    <div class="seller-image">
                        <div class="seller-profile"></div>
                    </div>
                    <div class="seller-data">
                        <div class="seller-name">{{seller.name}}</div>
                        <p>Téléphone :</p>
                        <div class="seller-phone">{{seller.phone_number}}</div>
                        <p>Adresse :</p>
                        <div class="seller-address">{{car.adress}}</div>
                        <p>E-mail :</p>
                        <div class="seller-email">{{seller.email}}</div>
                        <p>Site web :</p>
                        <div class="seller-website">{{car.url_site}}</div>
                    </div>
                    <div class="comments">
                        <div class="com-btn">Laisser un commentaire</div>
                    </div>
                </div>
            </div>
            <!-- --------------------------------------------------------------------------------------------------------------------- -->
            <!--                                              POP-UP DE VALIDATION_                                                    -->
            <!-- --------------------------------------------------------------------------------------------------------------------- -->
            <div v-if="isOpen == true">
                <div class="flex items-center justify-center fixed left-0 bottom-0 w-full h-full pop">
                    <div class="bg-white rounded-lg w-1/2">
                        <div class="flex flex-col items-start p-4">
                            <div class="flex items-center w-full">
                                <div class="text-gray-900 font-medium text-lg">Etes-vous sur ?</div>
                            </div>
                            <hr>
                            <div>En cliquant sur reserver, vous vous engagez à aller chercher votre panier chez
                                le commercant.</div>
                            <hr>
                            <div class="ml-auto">
                                <button @click="reservation()"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Reserver
                                </button>
                                <button @click="isOpen = false"
                                    class="bg-transparent hover:bg-gray-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                                    Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                categories: this.categorie,
                locations: this.location,
                seller: null,
                search: '',
                categorie_id: '',
                location_id: '',
                currentUser: null
            }
        },
        props: [
            'card',
            'categorie',
            'location',
        ],
        async mounted() {
            let url = '/api/users/' + this.card[0].user_id
            await axios.get(url)
                .then(response => {
                    this.seller = response.data
                })
            await axios.get('/api/user').then((response) => {
                this.currentUser = response.data
            })
            console.log('this.currentUser:', this.currentUser)
            console.log('seller', this.seller);
            console.log('card', this.card);
            console.log('categorie', this.categorie)
        },
        methods: {
            async reservation() {
                if (this.card[0].articles_number > 1) {
                    this.card[0].articles_number = this.card[0].articles_number - 1
                    let url = '/api/cards/' + this.card[0].id
                    let body = {
                        articles_number: this.card[0].articles_number - 1
                    }
                    await axios.put(url, body)
                        .then(response => {
                            this.cards = response.data
                            console.log('this.cards:', this.cards)
                        })
                    this.isOpen = false
                }else if(this.card[0].articles_number = 1){
                    this.card[0].articles_number = 0
                    let url = '/api/cards/' + this.card[0].id
                    let body = {
                        articles_number: 0,
                        display : 0
                    }
                    await axios.put(url, body)
                        .then(response => {
                            this.cards = response.data
                            console.log('this.cards:', this.cards)
                        })
                    window.location = '/search'
                }

                if (this.currentUser.bucket_arr == null){
                    var bucketArr = [this.card[0].id ];
                }else {
                    var bucketArr = JSON.parse("[" + this.currentUser.bucket_arr + "]")
                    bucketArr.push(this.card[0].id )
                }

                var body = { bucket_arr : bucketArr.toString() }

                await axios.put('/api/users/' + this.currentUser.id
                , body)  

                this.send();
            },
           send() {
               this.card[0].id
                const data = {
                    id: this.card[0].id,
                    email: this.seller.email}
                    console.log(this.card.id)
                
               axios.get('/send-reservation/'+ data.id +'/' + data.email).then((response) => {
                    console.log('ok pour réservation')
                })
            }
        }
    }
</script>

<style>
    .main{
        height: 100vh;
    }
    .screen-container {
        display: flex;
        flex-direction: column;
        font-family: "Titillium Web", sans-serif;
    }
    .card-container {
        display: flex;
        align-content: stretch;
        align-items: stretch;
        justify-content: space-between;
        padding: 2%;
        margin: 2% 10%;
        width: 80%;
        height: 100%;
        border: 0.5px solid #80808050;
        border-radius: 32px;
        color: #303030;
    }
    /* SELL INFO */
    .sell-info {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 30%;
    }
    .card-image {
        border-radius: 16px;
        height: 33%;
        width: 100%;
        background-size: contain;
    }
    .card-articles {
        display: flex;
        justify-content: space-between;
        margin-top: 4vh;
        text-align: center;
        align-items: center;
        font-weight: 600;
        font-size: 2.5vh;
    }
    .nbr-articles {
        font-family: "Amaranth", sans-serif;
        background-color: #40d6a4;
        width: 45%;
        border-radius: 8px;
        padding: 8px 16px;
    }
    .nbr-articles p{
        display: none;
    }
    .card-price {
        display: flex;
        justify-content: space-between;
        margin-top: 4vh;
        text-align: center;
        align-items: center;
        font-weight: 600;
        font-size: 2.5vh;
    }
    .price {
        font-family: "Amaranth", sans-serif;
        background-color: #40d6a4;
        width: 45%;
        border-radius: 8px;
        padding: 8px 16px;
    }
    .card-disp {
        display: flex;
        justify-content: space-between;
        margin-top: 4vh;
        text-align: center;
        align-items: center;
        font-weight: 600;
        font-size: 2.5vh;
    }
    .disp {
        font-family: "Amaranth", sans-serif;
        display: flex;
        justify-content: center;
        background-color: #40d6a4;
        width: 35%;
        border-radius: 8px;
        padding: 8px 8px;
    }
    .card-rez {
        display: flex;
        justify-content: center;
        font-family: "Amaranth", sans-serif;
        font-weight: 600;
        font-size: 2.5vh;
        background-color: #00573a;
        color: #f6f6f6;
        border-radius: 8px;
        width: 80%;
        margin-left: 10%;
        padding: 16px 32px;
    }
    .card-rez:hover {
        background-color: #40d6a4;
        color: #00573a;
        outline: none;
        transition: ease-in-out 0.2s;
    }
    .pop{
        background-color: #d8d8d880;
    }
/* CARD DESCRIPTION */
    .card-desc {
        display: flex;
        flex-direction: column;
        width: 30%;
    }
    .title {
        font-family: "Amaranth", sans-serif;
        font-weight: 600;
        font-size: 2.5vh;
    }
    .sub-title {
        display: flex;
        justify-content: space-between;
        font-size: 1.5vh;
        font-weight: 200;
        color: #808080;
        margin-bottom: 4%;
    }
    .desc p {
        font-size: 1.5vh;
        font-weight: 200;
        color: #808080;
        margin-bottom: 1%;
    }
    .descrition {
        display: flex;
        flex-wrap: wrap;
        font-size: 1.5vh;
        margin-bottom: 4%;
    }
    .map {
        background-image: url("../../assets/visuals/HS-MAP-fake.png");
        height: 400px;
        width: 100%;
        margin-bottom: 4%;
    }
    .share-btn {
        display: flex;
        justify-content: space-evenly;
        font-weight: 600;
        font-size: 2.5vh;
    }
    .facebook {
        height: 42px;
        width: 42px;
        background-image: url("../../assets/icons/HS - FB - G3.png");
        background-size: 42px 42px;
    }
    .twitter {
        height: 42px;
        width: 42px;
        background-image: url("../../assets/icons/HS - twitter - G3.png");
        background-size: 42px 42px;
    }
    .mail {
        height: 42px;
        width: 42px;
        background-image: url("../../assets/icons/HS - mail - G3.png");
        background-size: 42px 42px;
    }
/* SELLER DESCRIPTION */
    .seller-desc {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 30%;
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
    }
    .seller-image {
        display: flex;
        justify-content: center;
    }
    .seller-profile {
        border-radius: 50%;
        border: solid 0.5px #303030;
        background-color: #00573a;
        height: 150px;
        width: 150px;
    }
    .seller-data {
        padding: 2%;
    }
    .seller-data p {
        font-size: 1.5vh;
        margin-bottom: 1%;
    }
    .seller-name {
        font-family: "Amaranth", sans-serif;
        font-weight: 600;
        font-size: 2.5vh;
        text-align: center;
        justify-content: center;
        padding: 2%;
        margin-bottom: 2%;
    }
    .seller-phone {
        font-size: 2vh;
        font-weight: 600;
        margin-bottom: 2%;
    }
    .seller-address {
        font-size: 2vh;
        font-weight: 600;
        margin-bottom: 2%;
    }
    .seller-email {
        font-size: 2vh;
        font-weight: 600;
        margin-bottom: 2%;
    }
    .seller-website {
        font-size: 2vh;
        font-weight: 600;
        margin-bottom: 2%;
    }
    .comments {
        margin-top: 4%;
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
    }
    .com-btn {
        display: flex;
        justify-content: center;
        font-family: "Amaranth", sans-serif;
        font-weight: 600;
        font-size: 2.5vh;
        background-color: #40d6a4;
        color: #00573a;
        border-radius: 8px;
        width: 100%;
        padding: 16px 32px;
    }
    .com-btn:hover {
        background-color: #00573a;
        color: #40d6a4;
        outline: none;
        transition: ease-in-out 0.2s;
    }
/* RESPONSIVE_ */                           /* ---------------------------------------------------------------------- */
    @media (max-width: 1000px) {
        .card-container {
            flex-direction: column;
        }
       /* SELL INFO */
        .sell-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
        }
        .card-image {
            text-align: center;
            border-radius: 16px;
            min-height: 350px;
            width: 100%;
            background-size: contain;
        }
        .mob-rez-sell{
            display: flex;
            justify-content: space-between;
            margin: 2vh 0vw;
        }
        .card-articles{
            display: flex;
            align-content: center;
            justify-content: center;
        }
        .card-articles p{
            display: none;
        }
        .nbr-articles {
            display: flex;
            justify-content: center;
            font-weight: 400;
            font-size: 2vh;
            border-radius: 6px;
            padding: 6px 12px;
            width: 25vw;
        }
        .nbr-articles p{
            display: block;
            font-family: "Amaranth", sans-serif;
            background-color: #40d6a4;
            font-weight: 400;
            font-size: 2vh;
            border-radius: 6px;
            margin-left: 1vw;
        }
        .card-price{
            justify-content: center;
        }
        .card-price p{
            display: none;
        }
        .price {
            justify-content: center;
            display: flex;
            font-weight: 400;
            font-size: 2vh;
            border-radius: 6px;
            padding: 6px 12px;
            width: 25vw;
        }
        .card-disp p{
            display: none;
        }
        .disp {
            display: flex;
            justify-content: center;
            flex: 1;
            font-weight: 400;
            font-size: 2vh;
            border-radius: 6px;
            padding: 6px 12px;
            width: 25vw
        }
        .card-rez {
            display: flex;
            justify-content: center;
            font-family: "Amaranth", sans-serif;
            font-weight: 600;
            font-size: 2.5vh;
            background-color: #00573a;
            color: #f6f6f6;
            border-radius: 8px;
            width: 80%;
            margin-left: 10%;
            padding: 16px 32px;
        }
        .card-rez:hover {
            background-color: #40d6a4;
            color: #00573a;
            outline: none;
            transition: ease-in-out 0.2s;
        }
        .pop{
            background-color: #d8d8d880;
        }
    /* CARD DESCRIPTION */
        .card-desc {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        .title {
            font-family: "Amaranth", sans-serif;
            font-weight: 600;
            font-size: 2.5vh;
            margin-left: 8vw;
        }
        .sub-title {
            display: flex;
            justify-content: space-between;
            font-size: 1.5vh;
            font-weight: 200;
            color: #808080;
            margin-bottom: 4%;
            margin-left: 8vw;
        }
        .desc p {
            font-size: 1.5vh;
            font-weight: 200;
            color: #808080;
            margin-bottom: 1%;
            margin-left: 8vw;
        }
        .descrition {
            display: flex;
            flex-wrap: wrap;
            font-size: 1.5vh;
            margin-bottom: 4%;
            margin-left: 8vw;
            margin-right: 8vw;
        }
        .map {
            background-image: url("../../assets/visuals/HS-MAP-fake.png");
            height: 400px;
            width: 78%;
            margin-bottom: 4%;
            margin-left: 10%;
        }
    /* SELLER DESCRIPTION */
        .seller-desc {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10px;
        }
        .seller-image {
            display: none
        }
        .seller-data {
            padding: 0%;
            margin-left: 7.5vw;
        }
        .seller-data p {
            font-size: 1.5vh;
            margin-bottom: 1%;
        }
        .seller-name {
            font-family: "Amaranth", sans-serif;
            font-weight: 600;
            font-size: 2.5vh;
            text-align: left;
            justify-content: center;
            margin-bottom: 2%;
            padding: 0%;
        }
        .seller-phone {
            font-size: 2vh;
            font-weight: 600;
            margin-bottom: 2%;
        }
        .seller-address {
            font-size: 2vh;
            font-weight: 600;
            margin-bottom: 2%;
        }
        .seller-email {
            font-size: 2vh;
            font-weight: 600;
            margin-bottom: 2%;
        }
        .seller-website {
            font-size: 2vh;
            font-weight: 600;
            margin-bottom: 2%;
        }
        .comments {
            margin-top: 4%;
            padding: 0%;
            margin-left: 10vw;
        }
        .com-btn {
            display: flex;
            justify-content: center;
            font-family: "Amaranth", sans-serif;
            font-weight: 600;
            font-size: 2.5vh;
            background-color: #40d6a4;
            color: #00573a;
            border-radius: 8px;
            width: 100%;
            padding: 16px 32px;
        }
        .com-btn:hover {
            background-color: #00573a;
            color: #40d6a4;
            outline: none;
            transition: ease-in-out 0.2s;
        }
    }
</style>
