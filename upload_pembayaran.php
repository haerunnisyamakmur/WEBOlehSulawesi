<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST"); // here is define the request method

include 'koneksi.php'; // include database connection file

$id_pesanan = $_POST["id_pesanan"];

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format
	
$fileName  =  $_FILES['sendimage']['name'];
$tempPath  =  $_FILES['sendimage']['tmp_name'];
$fileSize  =  $_FILES['sendimage']['size'];
		
if(empty($fileName))
{
	$errorMSG = json_encode(array("message" => "Tidak ada foto yang dipilih", "status" => false));	
	echo $errorMSG;
}
else
{
	$upload_path = 'img/'; // set upload folder path 
	
	$fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension
		
	// valid image extensions
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
					
	// allow valid image file formats
	if(in_array($fileExt, $valid_extensions))
	{				
		//check file not exist our upload folder path
		if(!file_exists($upload_path . $fileName))
		{
			// check file size '5MB'
			if($fileSize < 10000000){
				move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
			}
			else{		
				$errorMSG = json_encode(array("message" => "Ukuran filemu lebih dari 10 MB", "status" => false));	
				echo $errorMSG;
			}
		}
		else
		{		
			$errorMSG = json_encode(array("message" => "File dengan nama yang sama telah ada", "status" => false));	
			echo $errorMSG;
		}
	}
	else
	{		
		$errorMSG = json_encode(array("message" => "Masukkan hanya JPG, JPEG, PNG & GIF", "status" => false));	
		echo $errorMSG;		
	}
}
		
// if no error caused, continue ....
if(!isset($errorMSG))
{
	// $query =  mysqli_query($conn,'INSERT into tbl_image (name) VALUES("'.$fileName.'")');
	$query =  mysqli_query($konek,"UPDATE pesanan SET bukti_pembayaran = '$fileName', tanggal_pembayaran = NOW(), status_pembayaran = 'Sudah bayar' WHERE id_pesanan = '$id_pesanan'");
	// (name) VALUES("'.$fileName.'")');
			
	echo json_encode(array("message" => "Upload pembayaran berhasil", "status" => true));	
}

?>