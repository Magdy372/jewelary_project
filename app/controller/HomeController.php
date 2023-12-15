<?php

require_once(__ROOT__ . "controller/Controller.php");
class HomeController extends Controller
    {


        public function displaybytype($typeid = null){
            return $this->model->displaybytype($typeid);
        }
    }
    
    
    ?>