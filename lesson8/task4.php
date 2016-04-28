<?php
class link_add
{
    public function getCss ($href)
    {
        echo '<link rel="stylesheet" href="' . $href .'">';
    }

    public function getJs ($src)
    {
        echo '<script src="' . $src .'"></script>';
    }
}
$linkCss = new link_add();
$linkCss->getCss('style.css');
$linkJs = new link_add();
$linkJs->getJs('js.js');
?>
