<?php
// This is the API, 2 possibilities: show the app list or show a specific app by id.
// This would normally be pulled from a database but for demo purposes, I will be hardcoding the return values.
// https://trinitytuts.com/build-first-web-service-php/

function get_app_by_id($id)
{
  $app_info = array();

  // normally this info would be pulled from a database.
  // build JSON array.
  switch ($id){
    case 1:
      $app_info = array("app_name" => "Web Demo", "app_price" => "Free", "app_version" => "2.0"); 
      break;
    case 2:
      $app_info = array("app_name" => "Audio Countdown", "app_price" => "Free", "app_version" => "1.1");
      break;
    case 3:
      $app_info = array("app_name" => "The Tab Key", "app_price" => "Free", "app_version" => "1.2");
      break;
    case 4:
      $app_info = array("app_name" => "Music Sleep Timer", "app_price" => "Free", "app_version" => "1.9");
      break;
  }

  return $app_info;
}

function getBarang($id)
{
  $app_info = array();

  // normally this info would be pulled from a database.
  // build JSON array.
  switch ($id){
  case 1:
      $app_info = array("Nama Barang" => "Web Demo", "app_price" => "Free", "app_version" => "2.0"); 
      break;
    case 2:
      $app_info = array( "Nama Barang" => "Sepatu", "Nama Vendor" => "Cantik", "Qty" => "100","Harga Satuan" => "1000000");
      break;
    case 3:
      $app_info = array("Nama Barang" => "Tas", "Nama Vendor" => "Bagus", "Qty" => "170","Harga Satuan" => "1500000");
      break;
    case 4:
      $app_info = array("Nama Barang" => "Dress", "Nama Vendor" => "Sally", "Qty" => "150","Harga Satuan" => "1000000");
      break;
  }

  return $app_info;
}

function get_app_list()
{
  //normally this info would be pulled from a database.
  //build JSON array
  $app_list = array(array("id" => 1, "name" => "Web Demo"), array("id" => 2, "name" => "Audio Countdown"), array("id" => 3, "name" => "The Tab Key"), array("id" => 4, "name" => "Music Sleep Timer")); 

  return $app_list;
}

$possible_url = array("get_app_list", "get_app", "getBarang");

$value = "An error has occurred";

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url))
{
  switch ($_GET["action"])
    {
      case "get_app_list":
        $value = get_app_list();
        break;
      case "get_app":
        if (isset($_GET["id"]))
          $value = get_app_by_id($_GET["id"]);
        else
          $value = "Missing argument";
        break;
       case "getBarang":
        if (isset($_GET["id"]))
          $value = getBarang($_GET["id"]);
        else
          $value = "Missing argument";
        break;
    }
}

// kamal

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$json = file_get_contents('php://input');
	$obj = json_decode($json);
	$value =  "berhasil diinput ". $obj->{'nama'};
}

if($_SERVER['REQUEST_METHOD'] == "PUT"){
	$json = file_get_contents('php://input');
	$obj = json_decode($json);	
	$id= $_SERVER['HTTP_ID'];
	
	$value = "berhasil diupdate ".$id." ".$obj->{'nama'};
}

if($_SERVER['REQUEST_METHOD'] == "DELETE"){
	$id= $_SERVER['HTTP_ID'];	
	$value = "dihapus ". $id;
	
}

header('Content-type: application/json');
//return JSON array
exit(json_encode($value));
?>
