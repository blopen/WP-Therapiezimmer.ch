<div class="uk-container">
<?php 
    $path = "\Cubetech\Cards";
    $typeName = ucfirst(substr($this->name, 0, strpos($this->name, '-'))).'Card';
    $backSalshWhitSpace = " \ ";
    $backSalsh =  str_replace(' ', '', $backSalshWhitSpace);;
    $class = $path.$backSalsh.$typeName;
    $card = new $class($this->id);
    $card->render();
     ?>


</div>