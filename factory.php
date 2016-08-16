<?php
abstract class Product
{
  private $sku;
  private $name;
  protected $type = null;

  public function __construct($sku, $name)
  {
    $this->sku = $sku;
    $this->name = $name;
  }

  public function getSku()
  {
    return $this->sku;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getType()
  {
    return $this->type;
  }
}
class Product_Chair extends Product
{
  protected $type = 'chair';
}
class Product_Table extends Product
{
  protected $type = 'table';
}
class Product_Bookcase extends Product
{
  protected $type = 'bookcase';
}
class Product_Sofa extends Product
{
  protected $type = 'sofa';
}



// Simple implementation
 $product = new Product_Chair('0001','INGOLF Chair');
 $product = new Product_Table('0002','STOCKHOLN Table');

 // Improved implementation
 class ProductController {

 public function create($product_type)
 {
   // Some post data validation logic here

   // Now we need to instantiate our product
   switch($product_type)
   {
     case 'chair':
       $product = new Product_Chair($post['sku'],$post['name']);
       break;

      case 'table':
       $product = new Product_Table($post['sku'],$post['name']);
       break;

      case 'sofa':
       $product = new Product_Sofa($post['sku'],$post['name']);
       break;

      case 'bookcase':
       $product = new Product_Bookcase($post['sku'],$post['name']);
       break;
   }

   // Do something with the post data and save the product

   ...

   return $product->getType();
 }
}


// Refined implementation
class ProductFactory
{
  public static function build($product_type, $sku, $name)
  {
    $product = "Product_" . ucwords($product_type);
    if(class_exists($product))
    {
      return new $product($sku, $name);
    }
    else {
      throw new Exception("Invalid product type given.");
    }
  }
}

// Refactored implementation
class ProductController {

 public function create($product_type)
 {
   // Some post data validation logic here

   // Now we need to instantiate our product
   $product = ProductFactory::build($product_type, $post['sku'], $post['name'])

   // Do something with the post data and save the product

   return $product->getType();
 }
}
