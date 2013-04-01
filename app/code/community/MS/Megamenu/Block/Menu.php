<?php

class MS_Megamenu_Block_Menu extends Mage_Core_Block_Template {

	/* Models */

	private $catModel;

	private $productModel;

	/* Megamenu parts */

	private $categories = array();

    private $featuredProducts = array();

	public function __construct() {		

		$this->catModel = Mage::getModel('catalog/category');
        $this->productModel = Mage::getModel('catalog/product');
        $this->setupMenu(Mage::app()->getWebsite(1)->getDefaultStore()->getRootCategoryId());

	}

	public function getCategories() {
		return $this->categories;
	}

	public function getFeaturedProducts() {
		return $this->featuredProducts;
	}
	
	public function setupMenu($id, $level = 1) {

		$temp = array();

		$children = $this->catModel->load($id)->getChildrenCategories();
		
		if($children->count() == 0) return; 
		
		foreach ($children as $i => $category):
            $category->load($category->getId());
			$temp[$i] = array(
				'id' => $category->getId(),
				'name' => $category->getName(), 
				'url' => $category->getUrl(),               
				'submenu' => $this->setupMenu($i, $level+1)
			);
            if($level == 1) $this->setProduct($i, $category->getCatFeaturedProduct());					
						
		endforeach;

		if($level == 1) $this->categories = $temp;

		return $temp;

	}

    public function setProduct($i, $sku) {
        
        if(is_null($sku)) return;

        $product = $this->productModel->loadByAttribute('sku', $sku);

        // the sku is set for category, but the product with that sku had been deleted.
        if(is_null($product)) return;

        $featuredProduct = array(
        	// to do: check if sales price is available!
            'name' => $product->getName(),
            'add_to_cart' => Mage::helper('checkout/cart')->getAddUrl($product),
            'price' => $this->beautifyPrice($product->getPrice(), "RSD"),
            'img' => $this->resizeImage($product)
        );

        $this->featuredProducts[$i] = $featuredProduct;
    }
	
	private function resizeImage($product) {
		return (string)Mage::helper('catalog/image')->init($product, 'thumbnail')->resize(150);
	}

	private function beautifyPrice($price, $monetary) {
		return number_format((float)$price, 2, '.', ',') . " " . $monetary;
	}
}

?>