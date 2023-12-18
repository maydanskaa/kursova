<?php
   session_start();  // Початок сесії для зберігання та використання даних сесії
   if ($_POST['vendorf']) {
    //print_r($_POST);
       $query = "SELECT * FROM smartphone ";
       $join = "INNER JOIN vendor_list v ON vendor = v.id_vendor ";

       // Логіка фільтрації за виробником

    if ($_POST['vendorf'] == "default") {
        $price = NULL;
    }else if ($_POST['vendorf'] == "") {
        $price = NULL;
    }else{
        $price = "WHERE vendor = ".$_POST['vendorf']." ";
    }

       // Логіка сортування за ціною

    if ($_POST['pricef'] == "default") {
        $order = NULL;
    }elseif($_POST['pricef'] == "asc"){
        $order = "price ASC ";
    }elseif($_POST['pricef'] == "desc"){
        $order = "price DESC ";
    }

       // Логіка сортування за діагоналлю

       if ($_POST['diagf'] == "default") {
        $diag = NULL;
    }elseif($_POST['diagf'] == "asc"){
        $diag = "diagonal ASC ";
    }elseif($_POST['diagf'] == "desc"){
        $diag = "diagonal DESC ";
    }
       // Логіка складання умов для ORDER BY

    if ($_POST['diagf'] != "default" && $_POST['pricef'] != "default") {
      $conc = "ORDER BY ".$order.",".$diag;
    }elseif ($_POST['diagf'] != "default") {
        $conc = "ORDER BY ".$diag;
    }elseif ($_POST['pricef'] != "default") {
        $conc = "ORDER BY ".$order;
    }else {
        $conc = NULL;
    }

    $query = $query.$join.$price.$conc;
    //$query = $query.$join.$price.$order.$diag.$conc;
    $_SESSION['querry'] = $query;
    header('Location: ../index.php');
   }
   header('Location: ../index.php');