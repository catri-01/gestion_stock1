<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // Set ID to UPDATE
  $produits->id = $data->id;
  $produits->nom = $data->nom;
  $produits->prix = $data->prix;
  $produits->stock = $data->stock;
  $produits->reference = $data->reference;
  $produits->created_at = $data->created_at;
  $produits->update_at = $data->update_at;

  // Update produits
  if($produits->update()) {
    echo json_encode(
      array('message' => 'Produits Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Produits not updated')
    );
  }