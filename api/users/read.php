<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate  object
  $users = new Users($db);

  // query
  $result = $post->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any users
  if($num > 0) {
    // users array
    $users_arr = array();
    // $users_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $post_item = array(
        'id' => $id,
        'prenom' => $prenom,
        'role' => $role,
        'created_at' => $created_at,
        'update_at' => $update_at
      );

      // Push to "data"
      array_push($users_arr, $users_item);

    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {
    // No Users
    echo json_encode(
      array('message' => 'No Users Found')
    );
  }