<?php
class Productos extends CI_Controller {

   function index(){
      echo 'Esto es la portada de productos';
   }
   
   function ordenadores($marca=null, $modelo=null){
      if (is_null($marca) && is_null($modelo)){
          echo 'Aquí se muestran los productos de ordenadores';
      }elseif(is_null($modelo)){
          echo 'Mostrando ordenadores de marca ' . $marca;
      }else{
          echo 'Mostrando ordenadores de marca ' . $marca . ' y modelo ' . $modelo;
      }
   }
   
   function monitores(){
      echo 'Aquí se muestran los productos de monitores';
   }
   
   function perifericos($modelo){
      echo 'Estás viendo el periférico ' . $modelo;
   }
}
?> 
