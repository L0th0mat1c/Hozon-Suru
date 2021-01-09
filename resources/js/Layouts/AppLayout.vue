<template>
    <div class="screen-display">
        <nav class="nav-bar">
            <!-- Primary Navigation Menu -->
            <div class="nav-container">
                <!-- logo + home link -->
                <div class="nav-block-left">
                    <!-- Logo -->
                    <div class="HS-NAV-LOGO">
                        <a href="/">HOZON SURU</a>
                    </div>
                    <!-- Navigation Links -->
                    <div class="nav-link">
                        <a href="/">ACCUEIL</a>
                    </div>
                    <div class="nav-link">
                        <a href="/search">RECHERCHE</a>
                    </div> 
                    <div class="nav-link">
                        <a href="/About">A PROPOS DE NOUS</a>
                    </div>
                </div>
                <div class="nav-block-right">
                    <!-- LOG & REG_ -->
                    <div v-if="user == null" class="nav-sub">       
                        <div class="nav-link">
                            <a href="/login">CONNEXION</a>
                            <!-- /!\ ROUTE TO FILL /!\ -->
                        </div>
                        <div class="nav-link reg">
                            <a href="/register">INSCRIPTION</a>
                        </div>
                    </div>
                    <!-- ADMIN BUTTONS_ -->
                    <div v-else-if="this.user.is_admin == true" class="nav-sub">
                        <div class="nav-link">
                            <a href="/admin/crud">DASHBOARD</a>
                        </div>
                        <div class="nav-link reg">
                            <!-- ADMIN LOG-OUT -->
                           
                            <!-- Authentication -->
                            <button as="button" href="#" class="dc" @click="logout()">DECONNEXION</button>
                        
                        </div>
                    </div>
                    <!-- LOG-OFF & USER'S PROFILE -->
                    <div v-else-if="this.user.is_seller == true" class="nav-sub">
                        <div class="nav-link">
                            <a href="/seller/profile">{{user.name}}</a>
                        </div>
                        <div class="nav-link reg">
                            <!-- Authentication -->
                            <button as="button" href="#" class="dc" @click="logout()">DECONNEXION</button>
                        </div>
                    </div>
                    <div v-else class="nav-sub">
                        <div class="nav-link" v-if="user.is_seller == true">
                            
                            <a href="/seller/profile">{{user.name}}</a>
                        </div>
                        <div class="nav-link" v-else>
                            
                            <a href="/client/profile">{{user.name}}</a>
                        </div>

                        <div class="nav-link reg">
                            <!-- Authentication -->
                            <button as="button" href="#" class="dc" @click="logout()">DECONNEXION</button>
                        </div>
                    </div>
                </div>

                <!-- HAMBURBUR ! -->
                <div class="Hamburbur" @click="mobileBtn()">
                    <div class="burbur1"></div>
                    <div class="burbur2"></div>
                    <div class="burbur3"></div>

                </div>
                <!-- MOBILE NAV MENU-->
                <div class="mobile-menu">
                    <!-- Navigation Links -->
                    <a href="/">
                        <div class="mobile-nav-link">ACCUEIL</div>
                    </a>
                    <a href="/search">
                        <div class="mobile-nav-link">RECHERCHE</div>
                    </a>
                    <a href="/About">
                        <div class="mobile-nav-link">A PROPOS DE NOUS</div>
                    </a>
                    <!-- LOG & REG_ -->
                    <div v-if="user == null" class="mobile-nav-sub">       
                            <a href="/login">
                                <div class="mobile-nav-link">CONNEXION</div>
                            </a>
                            <!-- /!\ ROUTE TO FILL /!\ -->
                        <a href="/register">
                            <div class="mobile-nav-link mobile-reg">INSCRIPTION</div>
                        </a>
                    </div>
                    <!-- ADMIN BUTTONS_ -->
                    <div v-else-if="this.user.is_admin == true" class="mobile-nav-sub">
                        <div class="mobile-nav-link">
                            <a href="/admin/crud">DASHBOARD</a>
                        </div>
                        <!-- ADMIN LOG-OUT -->
                        <form @submit.prevent="logout">
                            <a href="#" class="dc" @click="logout()">
                                <div class="mobile-nav-link mobile-reg">DECONNEXION</div>
                            </a>
                        </form>
                    </div>
                    <!-- LOG-OFF & USER'S PROFILE -->
                    <div v-else-if="this.user.is_seller == true" class="mobile-nav-sub">
                        <div class="mobile-nav-link">
                            <a href="/seller/profile">{{user.name}}</a>
                        </div>
                        <div class="mobile-nav-link mobile-reg">
                            <!-- Authentication -->
                            <button as="button" href="#" class="dc" @click="logout()">DECONNEXION</button>
                        </div>
                    </div>
                    <div v-else class="mobile-nav-sub">
                        <div class="mobile-nav-link" v-if="user.is_seller == true">
                            <a href="/seller/profile">{{user.name}}</a>
                        </div>
                        <div class="mobile-nav-link" v-else>
                            <a href="/client/profile">{{user.name}}</a>
                        </div>
                        <div class="mobile-nav-link mobile-reg">
                            <!-- Authentication -->
                            <button as="button" href="#" class="dc" @click="logout()">DECONNEXION</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Page Heading -->
        <header class="bg-white shadow">
            <slot name="header"></slot>
        </header>
        <!-- Page Content -->
        <main>
            <slot></slot>
        </main>
    </div>
</template>

<script>
    export default {
        components: {},
        data() {
            return {
                showingNavigationDropdown: false,
                // logged: false,
                user: null
            }
        },
        async created(){
            await axios.get('/api/user').then((response) => {
                this.user = response.data
                console.log('this.user:', this.user)
            })
        },
        methods: {
           async logout() {
                console.log('entrer deconnexion')
                await axios.post('/api/logout').then(response => {
                    console.log('deconnexion')
                    window.location = '/';
                })
            },
            async mobileBtn() {
                document.querySelector('.Hamburbur').addEventListener('click', ()=>{
                    document.querySelector('.mobile-menu').classList.toggle('nav-active');
                })
            }
        }
    }
</script>

<style>
    *{
        color: #303030;
    }
    .screen-display{
        width: 100vw;
        height: 100vh;
    }
    html{
        height: 100%;
        background-color: #f6f6f6;
    }
    .nav-bar{
        display: flex;
        background-color: #008a5c;
        font-size: 20px;
        font-family: "Titillium Web", sans-serif;
        align-content: center;
        height: 100px;
        width: 100vw;  
    }
    .nav-container{
        display: flex;
        width: 100%;
        justify-content: space-between;
    }
    .nav-block-left{
        display: flex;
        padding: 8px 16px;
        justify-content: flex-end;
        align-items: center;
    }
    .nav-block-right{
        display: flex;
        padding: 8px 16px;
        justify-content: flex-start;
        align-items: center;
    }
    .nav-sub{
        display: flex;
        padding: 8px 16px;
        justify-content: center;
        align-items: center;
    }
    .nav-logo{
        font-size: 32px;
        font-family: "Amaranth", sans-serif;
        text-align: center;
        padding-right: 0.5rem;
    }
    .nav-link{
        padding: 8px;
        text-align: center;
        font-weight: 600;
        color: #f6f6f6;
        transition: ease-in-out 0.2s;
    }
    .nav-link:hover{
        color:#40d6a4;
        border-bottom: solid 1px #40d6a4;
        outline: none;
    }
    .nav-link:focus{
        border-style: none;
        outline: none;
    }
    .reg{
        background-color: #40d6a4;
        color: #00573a;
        border-radius: 8px;
    }
    .reg:hover{
        background-color: #00573a;
    }
    .dc:hover{
        color: #40d6a4;
    }
    .HS-NAV-LOGO{
        font-size: 3vh;
        font-family: "Amaranth", "sans-serif";
        color: #303030;
        padding: 8px;
        text-align: center;
        font-weight: 600;
        transition: ease-in-out 0.2s;
    }
    .Hamburbur{
        display: none;
    }
    .mobile-menu{
        display: none;
    }
/* RESPONSIVE_ */
    @media (max-width: 1100px) {
        body{
            overflow-x: hidden;
        }
        .nav-link{
            display: none;
        }
        .nav-block-right{
            display: none;
        }
        .HS-NAV-LOGO{
            padding: 0px;
        }
        .Hamburbur{
            display: block;
            padding: 35px;
            cursor: pointer;
        }
        .Hamburbur div{
            width: 25px;
            height: 3px;
            margin: 5px;
            background-color: #40d6a4;
        }
        .mobile-menu{
            color: #303030;
            background-color: #d8d8d8;
            display: none;
            position: absolute;
            z-index : 1;
            top: 100px;
            right: 0px;
            height: 92vh;
            width: 100vw;
            flex-direction: column;
            align-content: center;
            transform: translateX(100%);
            transition: transform 0.5s ease-in;
        }
        .mobile-nav-sub{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: stretch;
        }
        .mobile-nav-link{
            padding: 5vh 0vh;
            text-align: center;
            font-weight: 600;
            font-size: 2.5vh;
            transition: ease-in-out 0.2s;
        }
        .mobile-nav-link:hover{
            color:#40d6a4;
            border-bottom: solid 1px #40d6a4;
            outline: none;
        }
        .mobile-nav-link:focus{
            border-style: none;
            outline: none;
        }
        .mobile-reg{
            display: flex;
            background-color: #40d6a4;
            color: #00573a;
            width: 100%;
            justify-content: center;
        }
        .mobile-reg:hover{
            background-color: #00573a;
        }
    }
    .nav-active{
        transform: translateX(0%);
        display: flex;
    }
</style>
