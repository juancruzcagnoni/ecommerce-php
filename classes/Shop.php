<?php

class Products
{

    // Defino las propiedades.
    public int    $product_id;
    public string $product_title;
    public string $description;
    public string $price;
    public string $img;
    public string $categorie;
    public string $seller;

    /**
     * @return Products[]  
     */

    public function all(): array
    {
        $archiveName = __DIR__ . "/../data/shop.json";
        $content = file_get_contents($archiveName);
        $data = json_decode($content, true);

        // Array para retornar los productos 
        $products = [];

        foreach ($data as $date) {

            $product = new Products();
            $product->product_id     = $date['product_id'];
            $product->product_title  = $date['product_title'];
            $product->description    = $date['description'];
            $product->price          = $date['price'];
            $product->img            = $date['img'];
            $product->categorie      = $date['categorie'];
            $product->seller         = $date['seller'];

            $products[] = $product;
        }

        return $products;
    }

    /**
     * @param int $id
     * @return Products|null
     */

    public function byId(int $id): ?Products
    {
        $products = $this->all();

        foreach ($products as $product) {

            if ($product->product_id == $id) {
                return $product;
            }
        }

        return null;
    }
}
