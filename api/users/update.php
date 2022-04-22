<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Users.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $users = new Users($db);

  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $post->id = $data->id;

  $post->prenom = $data->prenom;
  $post->role = $data->role;
  $post->created_at = $data->created_at;
  $post->update_at = $data->update_at;

  // Update Users
  if($post->update()) {
    echo json_encode(
      array('message' => 'Users Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Users Not Updated')
    );
  }