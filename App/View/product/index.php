

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=assets("css/style.css")?>">
    <link rel="icon" type="image/x-icon" href="<?=assets("uploads/images/scandiweb.png?v=1111")?>">
    <title>Add Product | Scandiweb</title>
</head>
<body>

    <!-- HEADER START -->
    <header>
        <div class="container">
      
                <div class="area-header flex justify-between pt-60 border-bottom pb-20">
                        <div class="title">
                            <h3 class="fs-32 fw-semi-bold">Product Add</h3>
                        </div>
                        <div class="buttons g-15 flex">
                            <button type="submit" form="product_form"  class="scw-button scw-button align-center button-save   fw-bold">Save</button>
                            <a href="<?=_link()?>" class="scw-button scw-button align-center button-cancel fw-bold">Cancel</a>
                        </div>
                </div>
             

        </div>
    </header>
    <!-- HEADER END -->
    <!-- MAIN START -->
    <main>
        <div class="container">

            <!-- FORM START -->
            <form id="product_form" class="form-width">
                <div class="form-group">
                    <div class="column-label">
                        <label for="sku">SKU</label>
                    </div>
                    <div class="input-area">
                        <input id="sku" name="sku" type="text" placeholder="Product's SKU Code">
                    </div>
                </div>
                <div class="form-group">
                    <div class="column-label">
                        <label for="name">Name</label>
                    </div>
                    <div class="input-area">
                        <input id="name" name="name" type="text" placeholder="Product's Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="column-label">
                        <label for="price">Price ($)</label>
                    </div>
                    <div class="input-area">
                        <input id="price" name="price" type="number" step="0.1" min="0" placeholder="Product's Price">
                    </div>
                </div>
                <div class="form-group">
                    <div class="column-label">
                        <label for="productType">Type Switcher</label>
                    </div>
                    <div class="input-area">
                        <select name="productType" id="productType">
                            <option hidden>Type Switcher</option>
                            <option value="Dvd" id="DVD">DVD</option>
                            <option value="Furniture" id="Furniture">Furniture</option>
                            <option value="Book" id="Book">Book</option>
                        </select>
                    </div>
                </div>

                <div id="changer-group">
                   
                </div>

                



            </form>
            <!-- FORM END -->
        </div>
    </main>
    <!-- MAIN END -->
    <!-- FOOTER START -->
    <footer >
        <div class="container">
                <div class="content pt-20 pb-20 border-top">
                    <center  class="fw-semi-bold">🫂Scandiweb👀 test assigment</center>
                </div>
        </div>
    </footer>
    <!-- FOOTER END  -->
    
</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.2/axios.min.js" integrity="sha512-NCiXRSV460cHD9ClGDrTbTaw0muWUBf/zB/yLzJavRsPNUl9ODkUVmUHsZtKu17XknhsGlmyVoJxLg/ZQQEeGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js"></script>


<script>

    const form = document.getElementById("product_form");
    const changeArea = document.getElementById("changer-group");
    const select     = document.getElementById("productType");

    select.addEventListener("change",()=>{
        let value = select.value;

        if(value==="Furniture"){
            changeArea.innerHTML=null;
            changeArea.innerHTML=`
                    <div class="form-group">
                        <div class="column-label">
                            <label for="height">Height (cm)</label>
                        </div>
                        <div class="input-area">
                            <input id="height" name="height" type="number" min="0" placeholder="Products' Height">
                        </div>
                    </div>   
                    <div class="form-group">
                        <div class="column-label">
                            <label for="width">Width (cm)</label>
                        </div>
                        <div class="input-area">
                            <input id="width" name="width" type="number" min="0" placeholder="Product's Width">
                        </div>
                    </div> 
                    <div class="form-group">
                        <div class="column-label">
                            <label for="length">Length (cm)</label>
                        </div>
                        <div class="input-area">
                            <input id="length" name="length" type="number" min="0" placeholder="Product's Length">
                        </div>
                    </div> 
                    <span class="helper-text">Please provide dimensions in HxWxL format.</span>

            `;

        }else if(value==="Dvd"){
            changeArea.innerHTML=null;
            changeArea.innerHTML=`
                    <div class="form-group">
                        <div class="column-label">
                            <label for="size">Size (mb)</label>
                        </div>
                        <div class="input-area">
                            <input id="size" name="size" type="number" min="0" placeholder="Product's Size">
                            <span class="helper-text">Please enter dvd's size on mb format.</span>
                        </div>
                    </div>   
            `;

        }else if(value==="Book"){
            changeArea.innerHTML=null;
            changeArea.innerHTML=`
                    <div class="form-group">
                        <div class="column-label">
                            <label for="weight">Weight (kg)</label>
                        </div>
                        <div class="input-area">
                            <input id="weight" name="weight" type="number" min="0" placeholder="Product's weight">
                            <span class="helper-text">Please enter book's weight on kg format.</span>
                        </div>
                    </div>   

            `;
        } 

    })


    form.addEventListener("submit",function(e){
        
        e.preventDefault();
        var formData = new FormData(form);

        axios.post("<?=_link("product/add")?>",formData)
        .then(res=>{
            if(res.data.ok){
                window.location.href="<?=_link("")?>"
            }
            else{
                Swal.fire(res.data.title,res.data.msg,res.data.status);
            }
        })
        .catch(error=>{
            window.location.reload();
        })
    })

</script>


</html>


