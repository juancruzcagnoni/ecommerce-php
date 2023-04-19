<?php
    function allProducts(){
        $archiveName = __DIR__. "/../data/shop.json";
        $content = file_get_contents($archiveName);
        return json_decode($content, true);
    }

    function productId($id){    
        $products = allProducts();
        
        foreach($products as $product){
        
            if($product['product_id'] == $id){
                return $product;
            }
        
        }

        return null;
    }
?>