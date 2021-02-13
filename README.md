# backend (laravel v7), frontend(vue v2) API Resource

i never worked with laravel but i did with vuejs.

The good thing i should do is not creating cli in olny one component, i should use a lot and then put them into the main one.  

### These are the things i couldn't make:

#### If you deleted a product the image will not deleted(i should pass the name of the image width the method(delete) so we could delete it)

#### If you deleted a category it well not deleted in the product(maybe here i should use relations between tables), iam pushing them into an array

#### There is no pagination in both products and categories

#### I didn't filter the names and the categories they should be in lowercase:

```bash
toLowerCase()
```

#### filter by category:

it works when iam not using vue, because in vue product.courses is not an array:

```bash
const data = [
    
    {
        "guid":"j5Dc9Z",
        "courses":["id","name","foo"]
    },
    
    {
        "guid":"a5gdfS",
        "courses":["id","name","bar","id","name","foo"]
    },
    {
        "guid":"jHab6i",
        "courses":["id","name","foobar"]
    }

];
    
const c = "bar";

let y = data.filter(product => {
   
    return product.courses.some(ele => c.includes(ele));
    
});
    
console.log(y);

```
## If you could lead me to a better solutions to all the things i couldn't make that would be a big plus.

# Thank you for this experience i learned a lot, i think iam going to add it as a gig in fiveer
