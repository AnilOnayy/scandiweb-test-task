
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=assets("css/style.css")?>">
    <link rel="icon" type="image/x-icon" href="<?=assets("uploads/images/scandiweb.png?v=1111")?>">
    <title>Products | Scandiweb</title>
</head>
<body>

    <!-- HEADER START -->
    <header>
        <div class="container">
      
                <div class="area-header flex justify-between pt-60 border-bottom pb-20">
                        <div class="title">
                            <h3 class="fs-32 fw-semi-bold">Product List</h3>
                        </div>
                        <div class="buttons g-15 flex">
                            <a href="<?=_link("addproduct")?>" class="scw-button scw-button align-center button-add fw-bold">Add</a>
                            <button id="delete-product-btn" class="scw-button align-center fw-bold scw-button button-delete">Mass Delete</button>
                        </div>
                </div>
             

        </div>
    </header>
    <!-- HEADER END -->
    <!-- MAIN START -->
    <main>
        <div class="container">

            <!-- PRODUCT LIST START -->
            <div class="product-list-grid grid g-15 pt-20 ">
                <?php 
                    if(isset($data['products'])){
                        foreach($data['products'] as $product){
                            ?>
                                <div class="product-box">
                                    <input type="checkbox" name="product-delete[]" class="delete-checkbox" data-product-id="<?=$product->id?>">
                                    <div class="info">
                                        <p><?=$product->sku?></p>
                                        <p><?=$product->name?></p>
                                        <p><?=price($product->price)?> $</p>
                                        <?php 
                                            $type = $product->type;

                                            if($type=="Furniture"){
                                                $height = $product->height;
                                                $width  = $product->width;
                                                $length = $product->length;

                                                echo "<p>Dimension: {$height}x{$width}x{$length}</p>";
                                            }
                                            else if($type=="Book"){
                                                $weight = $product->weight;
                                                echo "<p>Weight : {$weight} KG</p>";
                                            }
                                            else if($type=="Dvd"){
                                                $size = $product->size;
                                                echo "<p>Size : {$size} MB</p>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php
                        }
                    }
                ?>
                
            </div>
            <!-- PRODUCT LIST END -->
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

    const deleteButton = document.getElementById("delete-product-btn");


    deleteButton.addEventListener("click",()=>{

        var checkboxes = document.querySelectorAll(".delete-checkbox");
        var ids = [];

        checkboxes.forEach(e=>{
            if(e.checked){
                ids.push(e.getAttribute("data-product-id"));
            }
        })

        let formData = new FormData();
        formData.append("ids" , ids);
        
        if(ids.length){
            axios.post("<?=_link("product/delete")?>",formData)
            .then(res => {

                if(res.data.ok) window.location.reload();

                else  Swal.fire(res.data.title,res.data.msg,res.data.status);
            })
            .catch(error=>{
                console.log(error);
            })
        }

        
    })
</script>

</html>