<?php

require_once('functions.php');
require_once('db_connection.php');
set_exception_handler('error_handler');

startUp();

$output = [];

$json_input = file_get_contents('php://input');
// $obj = json_decode($json_input, true);
$obj = json_decode($json_input, true);

$category = $_GET['category'];



$query = "SELECT r.id, r.directions_url, r.image_url, r.serving_size, r.label, r.cooking_time, r.categories,
GROUP_CONCAT(i.ingredients_desc SEPARATOR \"\n\") AS ingredients
FROM recipe AS r
JOIN recipe_ingredients AS i
ON r.id = i.recipe_id
WHERE r.categories LIKE \"%{$category}%\"
GROUP BY i.recipe_id
LIMIT 5 ";

// print($query);
// exit;

if(mysqli_connect_errno()){
  print(json_encode(mysqli_connect_error()));
  exit;
}


$result = mysqli_query($conn, $query);

if (empty($result)) {
  // throw new Exception(mysqli_error($conn));
  print(json_encode(["empty result"]));
  exit();
};


while ($row = mysqli_fetch_assoc($result)) {
  $output[] = $row;
};
$output[] = "printing output";

print(json_encode($output));

?>
