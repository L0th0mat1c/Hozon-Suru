<template>
<div>
    <div v-if="this.tempCard == 'noCard'" class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        
        <div class="mb-4">
                    <div class="grid grid-cols-8 gap-4">
                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Photo de profil : 
                            </p>
                            <img :src="tempCard.background_image">
                            <div v-if="hidden == tempCard.background_image">
                               
                                <input type="file" @change="newSelect">
                               
                             </div>
                            <button v-if="hidden == 'yes'" @click="hidden = tempCard.background_image"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                type="button">Edit</button>
                        </div>
                    </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Titre : 
                </p>
                <input type="text"
                    class=" flex-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    placeholder="Entrez un titre" v-model="tempTitle">
            </div>
        </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Catégorie : 
                </p>
                <select v-model="tempCategory" aria-label="categories" class="loc-drop-list">
                    <option value="" selected="selected" @click="searchCards()">Choisir une catégorie</option>
                    <option v-for="categorie in categories" :key="categorie.id+'nav2'" v-bind:value="categorie.id"
                        @click="searchCards()">{{categorie.name}}</option>
                </select>
            </div>
        </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Description : 
                </p>
                <input type="text"
                    class=" flex-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    placeholder="Entrez un texte" v-model="tempDescription">
            </div>
        </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Adresse : 
                </p>
                <input type="text"
                    class=" flex-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    placeholder="Entrez un texte" v-model="tempAdress">
            </div>
        </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Secteur : 
                </p>
                <select v-model="tempSecteur" aria-label="Locations" class="loc-drop-list">
                    <option value="" selected="selected" @click="searchCards()">Choisir un secteur</option>
                    <option v-for="location in locations" :key="location.id+'nav2'" v-bind:value="location.id"
                        @click="searchCards()">{{location.name}}</option>
                </select>
            </div>
        </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Nombres d'articles : 
                </p>
                <input type="text"
                    class=" flex-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    placeholder="Entrez un nombre" v-model="tempArticle">
            </div>
        </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Prix d'un article : 
                </p>
                <input type="text"
                    class=" flex-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    placeholder="Entrez un nombre" v-model="tempPrice">
            </div>
        </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Allergènes : 
                </p>
                <input type="text"
                    class=" flex-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    placeholder="Entrez un texte" v-model="tempAllergene">
            </div>
        </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Horaires de récupération : 
                </p>
                <input type="text"
                    class=" flex-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    placeholder="Entrez un horaire (exemple 18:00)" v-model="tempStartTime">
                    <input type="text"
                    class=" flex-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    placeholder="Entrez un horaire (exemple 23:30)" v-model="tempEndTime">
            </div>
        </div>
        <div class="mb-4">
            <div class="flex flex-row">
                <p class="flex-auto block text-gray-700 font-bold mb-2">Numéro de Siret : 
                </p>
                <input type="text"
                    class=" flex-auto shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    placeholder="Entrez un numéro de siret" v-model="tempSiret">
            </div>
        </div>
        <div v-if="error == true" class="text-red-500">
            Veuillez remplir tout les champs avec le type renseigné en placeholder
        </div>
        <span class=" rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button @click="cardPost(currentUser.id, tempTitle, tempCategory, tempDescription,tempAdress, tempSecteur, tempArticle, tempPrice, tempAllergene, tempSiret, tempStartTime, tempEndTime)" type="button"
                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                Créer ma carte
            </button>
        </span>
    </div>





    <div v-else class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="mb-4">
                    <div class="grid grid-cols-8 gap-4">
                            <p class="col-span-7 block text-gray-700 font-bold mb-2">Photo de profil : 
                            </p>
                            <img :src="tempCard.background_image">
                            <div v-if="hidden == tempCard.background_image">
                               
                                <input type="file" @change="onSelected">
                                
                             </div>
                            <button v-if="hidden == 'yes'" @click="hidden = tempCard.background_image"
                                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                                type="button">Edit</button>
                        </div>
                    </div>
        <div class="mb-4">
            <div class="grid grid-cols-8 gap-4">
                <p class="col-span-7 block text-gray-700 font-bold mb-2">Titre : {{this.tempCard.title}}
                </p>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.title" v-if="hidden == null">Editer</button>
            </div>
            <div v-if="hidden == tempCard.title" class="grid grid-cols-6 gap-4">
                <input type="text"
                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Entrez un texte" v-model="tempContent">
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'title', tempContent), tempContent = null, hidden = null">Valider</button>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, hidden = null">Annuler</button>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">
            <div v-for="categorie in categories" v-bind:key="categorie.id" class="grid grid-cols-8 gap-4">
                <p v-if="tempCard.category_id == categorie.id" class="col-span-7 block text-gray-700 font-bold mb-2">
                    Categorie : {{categorie.name}}
                </p>
                <button v-if="hidden == null && tempCard.category_id == categorie.id"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.category_id + 'category'">Editer</button>
            </div>
            <div v-if="hidden == tempCard.category_id + 'category'" class="grid grid-cols-6 gap-4">
                <select v-model="tempContent" aria-label="categories" class="loc-drop-list">
                    <option value="" selected="selected" @click="searchCards()">Choisir un secteur</option>
                    <option v-for="categorie in categories" :key="categorie.id+'nav2'" v-bind:value="categorie.id"
                        @click="searchCards()">{{categorie.name}}</option>
                </select>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'category_id', tempContent), tempContent = null, hidden = null">Valider</button>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, hidden = null">Annuler</button>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="grid grid-cols-8 gap-4">
                <p class="col-span-7 block text-gray-700 font-bold mb-2">Description : {{this.tempCard.description}}
                </p>
                <button
                    class="h-10 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.description" v-if="hidden == null">Editer</button>
            </div>
            <div v-if="hidden == tempCard.description" class="grid grid-cols-6 gap-4">
                <textarea type="text"
                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Entrez un texte" v-model="tempContent"></textarea>
                <button
                    class="h-10 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'description', tempContent), tempContent = null, hidden = null">Valider</button>
                <button
                    class=" h-10 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, hidden = null">Annuler</button>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="grid grid-cols-8 gap-4">
                <p class="col-span-7 block text-gray-700 font-bold mb-2">Addresse : {{this.tempCard.adress}}
                </p>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.adress" v-if="hidden == null">Editer</button>
            </div>
            <div v-if="hidden == tempCard.adress" class="grid grid-cols-6 gap-4">
                <textarea type="text"
                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Entrez un texte" v-model="tempContent"></textarea>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'adress', tempContent), tempContent = null, hidden = null">Valider</button>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, hidden = null">Annuler</button>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">

            <div v-for="location in locations" v-bind:key="location.id" class="grid grid-cols-8 gap-4">
                <p v-if="tempCard.location_id == location.id" class="col-span-7 block text-gray-700 font-bold mb-2">
                    Secteur : {{location.name}}
                </p>
                <button v-if="hidden == null && tempCard.location_id == location.id"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.location_id + 'location'">Editer</button>
            </div>
            <div v-if="hidden == tempCard.location_id + 'location'" class="grid grid-cols-6 gap-4">
                <select v-model="tempContent" aria-label="Locations" class="loc-drop-list">
                    <option value="" selected="selected" @click="searchCards()">Choisir un secteur</option>
                    <option v-for="location in locations" :key="location.id+'nav2'" v-bind:value="location.id"
                        @click="searchCards()">{{location.name}}</option>
                </select>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'location_id', tempContent), tempContent = null, hidden = null">Valider</button>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, hidden = null">Annuler</button>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="grid grid-cols-8 gap-4">
                <p class="col-span-7 block text-gray-700 font-bold mb-2">Nombre d'articles :
                    {{this.tempCard.articles_number}}
                </p>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.articles_number" v-if="hidden == null">Editer</button>
            </div>
            <div v-if="hidden == tempCard.articles_number" class="grid grid-cols-6 gap-4">
                <input type="text"
                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Entrez un nombre" v-model="tempContent">
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'articles_number', tempContent), tempContent = null, hidden = null">Valider</button>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, hidden = null">Annuler</button>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="grid grid-cols-8 gap-4">
                <p class="col-span-7 block text-gray-700 font-bold mb-2">Prix d'un article :
                    {{this.tempCard.price}} €
                </p>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.price + 'prix'" v-if="hidden == null">Editer</button>
            </div>
            <div v-if="hidden == tempCard.price + 'prix'" class="grid grid-cols-6 gap-4">
                <input type="text"
                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Entrez un nombre" v-model="tempContent">
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'price', tempContent), tempContent = null, hidden = null">Valider</button>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, hidden = null">Annuler</button>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="grid grid-cols-8 gap-4">
                <p @click="test()" class="col-span-7 block text-gray-700 font-bold mb-2">Allergènes :
                    {{this.tempCard.allergenes}}
                </p>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.id" v-if="hidden == null">Editer</button>
            </div>
            <div v-if="hidden == tempCard.id" class="grid grid-cols-6 gap-4">
                <input type="text"
                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Entrez un texte" v-model="tempContent">
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'allergenes', tempContent), tempContent = null, hidden = null">Valider</button>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, hidden = null">Annuler</button>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="grid grid-cols-8 gap-4">
                <p @click="test()" class="col-span-7 block text-gray-700 font-bold mb-2">Horaires de récupération :
                    Entre {{this.tempCard.start_time}} et {{this.tempCard.end_time}}
                    
                </p>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.start_time" v-if="hidden == null">Editer</button>
            </div>
            <div v-if="hidden == tempCard.start_time" class="grid grid-cols-6 gap-4">
                <div >
                <p>Horaire d'ouverture :</p>
                <input type="text"
                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Entrez un horaire (exemple 18:00)" v-model="tempContent">
                </div>
                <div >
                    <p>Horaire de fermeture :</p>
                    <input type="text"
                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Entrez un horaire (exemple 23:30)" v-model="tempContent2">
                </div>
                <div>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'start_time', tempContent, tempContent2), tempContent = null, tempContent2 = null, hidden = null">Valider</button>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, tempContent2 = null , hidden = null">Annuler</button>
                </div>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">
            <div class="grid grid-cols-8 gap-4">
                <p @click="test()" class="col-span-7 block text-gray-700 font-bold mb-2">Numéro de siret:
                    {{this.tempCard.siret_number}}
                </p>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="hidden = tempCard.siret_number" v-if="hidden == null">Editer</button>
            </div>
            <div v-if="hidden == tempCard.siret_number" class="grid grid-cols-6 gap-4">
                <input type="text"
                    class=" col-span-4 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1" placeholder="Entrez un numéro de siret" v-model="tempContent">
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button"
                    @click="cardModify(tempCard.id, 'siret_number', tempContent), tempContent = null, hidden = null">Valider</button>
                <button
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5s"
                    type="button" @click="tempContent = null, hidden = null">Annuler</button>
                <div class="text-red-500"></div>
            </div>
        </div>
        <div class="mb-4">
            <p class="col-span-7 block text-gray-700 font-bold mb-2">Visible sur le site : </p>
            <div class="flex justify-between items-center">
                <div @click="toggle(tempCard.id, tempCard.display)"
                    class="w-16 h-10 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out"
                    :class="{ 'bg-green-400': toggleActive}">
                    <div class="bg-white w-8 h-8 rounded-full shadow-md transform duration-300 ease-in-out"
                        :class="{ 'translate-x-6': toggleActive}"></div>
                </div>
            </div>
        </div>
        <span class=" rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button @click="warning = 'delete'" type="button"
                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                Supprimer Ma Carte
            </button>
        </span>
    </div>
    <div v-if="warning == 'display'">
            <div class="flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800">
                <div class="bg-white rounded-lg w-1/2">
                    <div class="flex flex-col items-start p-4">
                        <div class="flex items-center w-full">
                            <div class="text-gray-900 font-medium text-lg">Visibilité de votre carte</div>
                        </div>
                        <hr>
                        <div class="">Afin de rendre votre carte de vente visible par les clients, veuillez activer le bouton "Visible sur le site" dans votre section "Ma carte". <br>
                        Vous pouvez également désactiver la visibilité à tout moment en passant ce même bouton à off.</div>
                        <hr>
                        <div class="ml-auto">
                            <button @click="warning = null"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                C'est compris !
                            </button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div v-if="warning == 'delete'">
            <div class="flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800">
                <div class="bg-white rounded-lg w-1/2">
                    <div class="flex flex-col items-start p-4">
                        <div class="flex items-center w-full">
                            <div class="text-gray-900 font-medium text-lg">Etes-vous sur ?</div>
                        </div>
                        <hr>
                        <div class="">La suppression de votre carte sera définitive.</div>
                        <hr>
                        <div class="ml-auto">
                            <button @click="cardDelete(tempCard.id), warning = null"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                C'est compris !
                            </button>
                        </div>
                        <div class="ml-auto">
                            <button @click="warning = null"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Annuler
                            </button>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</template>


<script>
    export default {

        data() {
            return {
                currentUser: null,
                tempCard: null,
                locations: null,
                categories: null,
                hidden: null,
                toggleActive: null,
                tempTitle: null,
                tempCategory: null,
                tempDescription: null,
                tempAdress: null,
                tempSecteur: null,
                tempArticle: null,
                tempPrice:  null,
                tempAllergene: null,
                tempSiret: null,
                warning : null,
                selectedFile: null,
                background: null,
                tempStartTime: null,
                tempEndTime: null,
                error : false
            }
        },
        async beforeMount() {
            await this.getCurrentUser()

            await this.getCard()

            await this.getCategoriesAndLocations()

            console.log('this.currentUser:', this.currentUser)
            console.log('card', this.tempCard)
            console.log('categories', this.categories)
            console.log('locations', this.locations)
        },

        methods: {

            async getCurrentUser(){
                await axios.get('/api/user').then((response) => {

                this.currentUser = response.data

            })
            },

            async getCard(){
                await axios.get('/api/cards?display=all')
                        .then(response => {
                            response.data.forEach(card => {
                                if (card.user_id == this.currentUser.id) {
                                    this.tempCard = card
                                }
                            })
                            if (this.tempCard == null) {
                                this.tempCard = 'noCard'
                            }
                        })
                    if (this.tempCard.display == 1) {
                        this.toggleActive = true
                    } else if (this.tempCard.display == 0) {
                        this.toggleActive = false
                        this.warning = 'display'
                    }
            },

            async getCategoriesAndLocations(){
                await axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data
                })
                await axios.get('/api/location')
                .then(response => {
                    this.locations = response.data
                })

            },

            async toggle(id, display) {

                if (display == 0) {
                    this.toggleActive = true
                    this.tempCard.display = 1
                    let body = {
                        display: 1
                    }
                    let url = "/api/cards/" + id
                    await axios.put(url, body)
                } else if (display == 1) {
                    this.toggleActive = false
                    this.tempCard.display = 0
                    let body = {
                        display: 0
                    }
                    let url = "/api/cards/" + id
                    await axios.put(url, body)
                }
            },
            async cardModify(id, row, content, content2) {
                console.log('content:', content)
                console.log('id:', id)

                if (row == 'title') {
                    this.tempCard.title = content;
                    var body = {
                        title: content
                    }
                } else if (row == 'description') {
                    this.tempCard.description = content;
                    var body = {
                        description: content
                    }
                } else if (row == 'articles_number') {
                    this.tempCard.articles_number = content;
                    var body = {
                        articles_number: content
                    }
                } else if (row == 'allergenes') {
                    this.tempCard.allergenes = content;
                    var body = {
                        allergenes: content
                    }
                } else if (row == 'adress') {
                    this.tempCard.adress = content;
                    var body = {
                        adress: content
                    }
                } else if (row == 'siret_number') {
                    this.tempCard.siret_number = content;
                    var body = {
                        siret_number: content
                    }
                } else if (row == 'location_id') {
                    this.tempCard.location_id = content;
                    var body = {
                        location_id: content
                    }
                } else if (row == 'category_id') {
                    this.tempCard.category_id = content;
                    var body = {
                        category_id: content
                    }
                }
                else if (row == 'price') {
                    this.tempCard.price = content;
                    var body = {
                        price: content
                    }
                }
                else if (row == 'start_time') {
                    this.tempCard.start_time = content;
                    this.tempCard.end_time = content2;
                    var body = {
                        start_time: content,
                        end_time: content2
                    }
                }

                let url = "/api/cards/" + id
                await axios.put(url, body)
            },

            async cardDelete(id) {
                let url = "/api/cards/" + id
                await axios.delete(url)
                this.isOpen = null
                this.hidden = null
                this.tempCard = 'noCard'
            },
            async newSelect(event) {
                this.selectedFile = event.target.files[0]
                await axios.post(
                        'https://api.imgur.com/3/image', this.selectedFile, {
                            headers: {
                                Authorization: 'Client-ID efc40da539eb36a',
                            }}
                    ).then(response => {
                            this.background = response.data.data.link
                            console.log( this.background)
                    })
                    console.log('userID', this.tempCard.id)
            },

            async cardPost(id, title, category, description, adress, secteur, article, price, allergenes, siret, start_time, end_time) {
                console.log(start_time)
                let body = {
                        title: this.tempTitle,
                        category_id : this.tempCategory,
                        description : this.tempDescription,
                        adress : this.tempAdress,
                        location_id: this.tempSecteur,
                        articles_number : this.tempArticle,
                        price : this.tempPrice,
                        allergenes : this.tempAllergene,
                        siret_number : this.tempSiret,
                        background_image: this.background,
                        user_id : id,
                        start_time: this.tempStartTime,
                        end_time: this.tempEndTime
                    }
                let url = '/api/cards'
                await axios.post(url, body)
                    .catch(error => {
                        if(error){
                            this.error=true
                        }
                    })

                await this.getCard()
            },
            async onSelected(event) {
                this.selectedFile = event.target.files[0]
                await axios.post(
                        'https://api.imgur.com/3/image', this.selectedFile, {
                            headers: {
                             
                                Authorization: 'Client-ID efc40da539eb36a',
                            }}
                    ).then(response => {
                            this.background = response.data.data.link
                            console.log( this.background)
                    })
                    console.log('userID', this.tempCard.id)
                // await axios.get('/sanctum/csrf-cookie')
                var body = {background_image: this.background}
                await axios.put("/api/cards/" + this.tempCard.id, body).then(response => {
                            console.log( 'upload database ok')
                    }) 
                window.location = '/seller/profile'
            },
        }
    }

</script>
