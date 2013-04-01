<?php 

class MS_Megamenu_Helper_Render {
  
   
    public function mainCategories($menu) {
    
        $html = "\n\t".'<ul>';
        foreach ($menu as $menuRow) {        
            $html .= $this->menuItem($menuRow);
        }
        return $html;
    }

    
    public function menuItem($item) {

        $html = "\n\t".'<li data-rel="'. $item['id'] .'"> ';

        if (isset($item['url'])) $html .= '<a href="'.$item['url'].'">';
        $html .= $item['name'];
        if (isset($item['url'])) $html .= '</a>';
        $html .= '</li>'."\n";

        return $html;
    }

    public function hasChild($menuItem) {    
        return isset($menuItem['submenu']);
    }

    public function subMenu($i, $menu, $level = 1) {  

        $printMenu = $this->isFirstSubmenuLevel($level) ? "\n\t".'<ul data-rel="'. $i . '" class="submenu">' : "\n\t".'<ul>';
        
        foreach ($menu as $menu_item) {
        
            $printMenu .= "\n\t".'<li data-rel="'. $menu_item['id'].'">';
            if (isset($menu_item['url'])) $printMenu .= '<a href="'.$menu_item['url'].'">';
            $printMenu .= $menu_item['name'];
            if (isset($menu_item['url'])) $printMenu .= '</a>';
            if (isset($menu_item['submenu']))
            {
                $printMenu .= $this->subMenu($i, $menu_item['submenu'], $level + 1);

            }
            $printMenu .= '</li>'."\n";

        }
        $printMenu .= '</ul>'."\n";

        return $printMenu;
    }

    private function isFirstSubmenuLevel($level) {
        return $level <= 1;
    }

    public function featuredProducts($productCollection) {
        $html = "";
        foreach ($productCollection as $i => $product) {
        
            $html .= "\n\t". '<div class="product" data-rel="'. $i .'">';
            if (isset($product['img'])) $html .= "\n\t". '<img src="'. $product['img'] .'" />';
            $html .= "\n\t".'<div class="productInfo">';
            $html .= "\n\t". '<p>'. $product['name'] . '</p><p>' . $product['price'] . "\n\t" . '<a href="'. $product['add_to_cart'] .'">Add to cart</a>';
            $html .= '</div>'. "\n";
            $html .= '</div>'. "\n";
        }
        
        return $html;
    }

}