<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Produits.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $produits = new Produits($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $produits->nom = $data->nom;
  $produits->prix = $data->prix;
  $produits->stock = $data->stock;
  $produits->reference = $data->reference;
  $produits->created_at = $data->created_at;
  $produits->update_at = $data->update_at;

  // Create produits
  if($produits->create()) {
    echo json_encode(
      array('message' => 'Produits Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Produits Not Created')
    );
  }