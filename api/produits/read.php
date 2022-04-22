<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //
    $produits = new Produits($db);

    $result = $produits->read();

    $num = $result->rowCount();

    if ($num > 0) {
        $produits_arr = array();
        $produits_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $produits_item = array(
                'id' => $id,
                'nom' => $nom,
                'description' => $description,
                'prix' => $prix,
                'reference' => $reference,
                'created_at' => $created_at,
                'update_at' => $update_at
            );

            array_push($produits_arr['data'], $produits_item);
        } 
        echo json_encode($produits_arr);

    }
    else {
        // No Produits
        echo json_encode(
          array('message' => 'No Posts Found')
        );
    }
