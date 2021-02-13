<template>
<div class="container">
    <a target="_blank" href="/cli" class="btn btn-dark my-5 mx-auto">Add a product</a>
    <div class="products justify-centent-center">
        
        <div class="d-flex justify-content-between my-5">
            <select class="form-control mb-3" aria-label="form-select-lg example">
              <option selected>Filter</option>
                <option v-for="category in categories" :key="category.id" v-text="category.name" :value="category.name"></option>
            </select>
            
            <div class="input-group mx-3">
              <input v-model="sortbyname" type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username" aria-describedby="button-addon2">
            </div>
            
            <select v-model="selectedprice" @change="sortbyprice" class="form-control mb-3" aria-label="form-select-lg example">
              <option selected>Sort by price</option>
                <option>up</option>
                <option>down</option>
            </select>  
        </div>
        <div class="row mb-5">
            <div v-for="product in filterbyname" :key="product.id" class="card m-1 p-2 col-4">
                <img :src="product.image_url">
                <h2>{{ product.name }}</h2>
                <h4>{{ product.price }}$</h4>
                <p>{{ product.description }}</p>
                <small>{{ product.categorie }}</small>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    
    export default {
        
        name: "MainWeb",
        data() {
            return {
                
                sortbyname: "",
                selectedprice: [],
                categories: [],
                products: []
                
            }
        },
        methods: {
            
            getcategories() {
                
                fetch('api/allcategories')
                .then(res => res.json())
                .then(res => {
                    
                    this.categories = res.data;
                    
                }).catch(err => console.log(err));
                
            },
            getproducts() {
                fetch('api/products')
                .then(res => res.json())
                .then(res => {
                    this.products = res.data;
                })
                .catch(err => console.log(err));
            },
            sortbyprice() {
                
                if(this.selectedprice === "down"){
                    
                this.products.sort((a,b) => {
                   
                    if(a.price < b.price) return -1;
                    if(a.price > b.price) return 1;
                    return 0;
                    
                });
                    
                }else {
                    
                this.products.sort((a,b) => {
                   
                    if(a.price < b.price) return 1;
                    if(a.price > b.price) return -1;
                    return 0;                    
                    
                });
                    
                }
                
            }             
        },
        computed: {
          
            filterbyname() {
                return this.products.filter(product => {
                    
                    return product.name.match(this.sortbyname);
                    
                })
            },
                       
            
        },
        created() {
            this.getcategories();
            this.getproducts();
        }
        
    }
    
</script>
