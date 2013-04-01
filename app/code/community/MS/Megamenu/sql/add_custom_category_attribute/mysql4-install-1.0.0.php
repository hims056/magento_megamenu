<?php
 	
 	$installer = $this;
	$installer->startSetup();

	 
	$installer->addAttribute('catalog_category', 'cat_featured_product', array(
        'group'         => 'Featured product',
        'input'         => 'text',
        'type'          => 'text',
        'label'         => 'Featured product SKU',
        'backend'       => '',
        'visible'       => 1,
        'required'      => 0,
        'user_defined' => 1,
        'global'        => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    ));
	 
	$installer->endSetup();
 
?>