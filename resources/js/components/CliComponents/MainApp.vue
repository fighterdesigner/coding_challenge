<template>
<div class="container pb-5">
<div class="row mt-5">
<div class="addproduct col-7">
    <h3>Add a product:</h3>
 <form @submit.prevent="AddProduct" enctype="multipart/form-data">
  <div class="form-group mb-3">
    <label class="form-label">Name:</label>
    <input v-model="product.name" type="text" class="form-control">
  </div>
  <div class="form-group mb-3">
    <label class="form-label">Description:</label>
    <input v-model="product.description" type="text" class="form-control">
  </div>
  <div class="form-group mb-3">
      <label class="form-label">Categorie:</label>
        <select multiple size="5" v-model="selected" class="form-control form-select-lg mb-3" aria-label="size 3 select example">
          <option disabled>Select a category</option>
          <option v-for="allcategory in allcategories" :key="allcategory.id" v-text="allcategory.name" :value="allcategory.name"></option>    
        </select>
  </div>
  <div class="form-group mb-3">
      <label class="form-label">Price:</label>
    <input v-model="product.price" type="text" class="form-control">
  </div>
  <div class="form-group mb-3">
      <label class="form-label">Image:</label>
    <input type="file" @change="imageMethod" ref="upload">
  </div>            
  <button type="submit" class="btn btn-primary">Add</button>
        </form>
    
<div class="products-container my-4">
    <div v-for="product in products" :key="product.id" class="card p-2 mb-4">
    <img :src="product.image_url">
    <h3>{{product.name}}</h3>
    <h4>{{product.price}}</h4>
    <p>{{product.description}}</p>
    <small>{{product.categorie}}</small>
    <button @click="deletProduct(product.id)" class="btn btn-danger">Delete</button>
    </div>   
</div>
</div>
    
<div class="addcategory col-5">
    <h2>Add a category:</h2>
    <div class="form-group">
        <form @submit.prevent="AddCategory">
        <label>Category:</label>
        <input v-model="category.name" type="text" class="form-control mb-3">
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
    <div class="col-12 card text-center">
        <div id="parent" class="row card col-12 my-3 mx-auto" v-for="category in categorys" :key="category.id">
            <input ref="radioinput" @change="getCategoryId(category.id)" type="radio" class="my-3 mx-auto" name="flexRadioDefault" id="flexRadioDefault1">
             <label for="flexRadioDefault1">{{category.name}}</label>
            
            <button @click.stop="deletCategory(category.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            
            <button @click.stop="fetchSubCategories($event,category.id)" class="btn btn-dark btn-sm my-2"><i class="fas fa-angle-down"></i></button>
            
        </div>
        <div id="child" class="subcategories">
            <div class="row card col-10 my-3 mx-auto" v-for="subcategory in subcategories" :key="subcategory.id">
            <p>{{subcategory.name}}</p>
            <button @click.prevent="deleteSubCategories(subcategory.id)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </div>
</div>    
</div> 
</div>
</template>

<script>
export default {
    name: "MainApp",
    data() {
        return {
            
            image: "",// it takes the input element
            selected: [],// this takes the name of the categories that are selected
                        
            products: [],// for the products
            categorys: [],// for the categories
            subcategories: [], // for subcategories
            allcategories: [], //for the select
            
            product: { // for adding a product   
                name: "",
                description: "",
                price: null,
                categorie: "",
                image_url: ""
            },
            category: { // for adding a category
                name: "",
            },
            
        }
    },
    methods: {
        
// methods for the products get delete and post        
        
        AddProduct() {        
            
            this.product.categorie = `${this.selected}`;
            
            //******* Uplaod the image ********            
            
            if(this.product.image_url === '') {
            
                this.product.image_url = "/images/default.jpg";
                
            }else{
            
            const formdata = new FormData();
            formdata.set('image',this.image);                   
                        
            fetch('api/upload', {
                method: "post",
                body: formdata
            }).catch(err => console.log(err));
            }
            
            //*******************************
            
            fetch('api/product', {
                method: "post",
                body: JSON.stringify(this.product),
                headers: {
                    'content-type': 'application/json'
                }
            })
                .then(res => {
                
                
                this.product.name = "";
                this.product.description = "";
                this.product.price = "";
                this.product.categorie = [];
                this.selected = [];
                this.product.image_url = "";
                this.$refs.upload.value = "";
                
                this.fetchProducts();
                
            })
                .catch(err => console.log(err));
            
        },    
        imageMethod(e) {// gitting the image name
            
            this.image = e.target.files[0];
            
            this.product.image_url = "/images/" + e.target.files[0].name;
                         
        },
        
        fetchProducts() {
            fetch('api/products')
            .then(res => res.json())
            .then(res => {
                this.products = res.data;
            })
            .catch(err => console.log(err));
        },
        
         deletProduct(id) {
            fetch(`api/product/${id}`,{
                method: "delete"
            })
            .then(res => {
                this.fetchProducts();
            })
            .catch(err => console.log(err));
             
        },
//***************************************************
        
//*********** methods for categories and subcategories ***********        
        fetchCategories() {
            fetch('api/categories')
            .then(res => res.json())
            .then(res =>{
                this.categorys = res.data;
            }).catch(err => console.log(err));
        },
        fetchSubCategories(event,id) {            
                         
            const child = document.getElementById("child");
            
                            
            fetch(`api/subcategory/${id}`)
            .then(res => res.json())
            .then(res => {
                this.subcategories = res.data;
            }).catch(err => console.log(err));
            
            event.currentTarget.parentElement.appendChild(child);
            
        },
        fetchforproducts() {
          
            fetch('api/allcategories')
            .then(res => res.json())
            .then(res => {
                this.allcategories = res.data;
            })
            .catch(err => console.log(err));
            
        },
        AddCategory() {
            fetch('api/category', {
                method: 'post',
                body: JSON.stringify(this.category),
                headers: {
                    "content-type": "application/json"
                }
            })
            .then(res => {
                this.category.name = "";
                this.category.category_id = 0;
                this.fetchCategories();
                this.fetchforproducts();
                this.$refs.radioinput.forEach(radio => {radio.checked = false;});
                
            })
            .catch(err => console.log(err));
        },
        deletCategory(id) {
            fetch(`api/category/${id}`,{
                method: 'delete'
            })
            .then(res => {
                this.fetchforproducts();
                this.fetchCategories();
                this.fetchSubCategories();
            })
            .catch(err => console.log(err));
        },
        deleteSubCategories(id) {
          
            fetch(`api/subcategory/${id}`, {
                method: 'delete'
            })
            .then(res => {
                
                this.fetchforproducts();
                this.fetchSubCategories();
                
            })
            .catch(err => console.log(err));
            
        },
        getCategoryId(id) {
            this.category.category_id = `${id}`;
        }
        
     },
//*************************************************    
    
    created() { //launch these methods in the created phase
       this.fetchProducts();
       this.fetchCategories();
       this.fetchforproducts();
    }
}
</script>
