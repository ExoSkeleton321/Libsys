<?php
session_start();
if(
	isset($_FILES['photoBook'], $_POST['nameBook'], $_POST['descriptionBook'], $_POST['publishDateBook'], $_POST['isbnBook'], $_POST['pageNumberBook'], $_POST['editionBook'], $_POST['priceBook'], $_POST['amountBook'], $_POST['genreBook'], $_POST['codeBook'], $_POST['authorBook'], $_POST['editorialBook'])
	&&
	trim($_FILES['photoBook']['name']) !== "" && trim($_POST['nameBook']) !== "" && trim($_POST['descriptionBook']) !== "" && trim($_POST['publishDateBook']) !== "" && trim($_POST['isbnBook']) !== "" && trim($_POST['pageNumberBook']) !== "" && trim($_POST['editionBook']) !== "" && trim($_POST['priceBook']) !== "" && trim($_POST['amountBook']) !== "" && trim($_POST['genreBook']) !== "" && trim($_POST['codeBook']) !== "" && trim($_POST['authorBook']) !== "0" && trim($_POST['editorialBook']) !== "0"
){
	require 'FunctionsLibros.php';
	$obj = new FunctionsLibros();

	$name 		 = trim($_POST['nameBook']);
	$description = trim($_POST['descriptionBook']);
	$publishDate = trim($_POST['publishDateBook']);
	$isbn 		 = substr(strtoupper($_POST['isbnBook']), 0, 13);
	$pages 		 = (int) $_POST['pageNumberBook'];
	$edition 	 = (int) $_POST['editionBook'];
	$price 		 = (double) $_POST['priceBook'];
	$amount 	 = (int) $_POST['amountBook'];
	$genre 		 = (int) $_POST['genreBook'];
	$code 		 = strtoupper($_POST['codeBook']);
	$autor 		 = trim($_POST['authorBook']);
	$editorial	 = trim($_POST['editorialBook']);

	$allowed 	  = ['png', 'jpg', 'jpeg'];
	$imgName 	  = $_FILES['photoBook']['name'];
	$imgExtension = mb_strtolower(end(explode(".", $imgName)));

	if(in_array($imgExtension, $allowed )){
		$insert = $obj->insertBook($name, $description, $publishDate, $isbn, $pages, $edition, $price, $amount, $genre, $code, $autor, $editorial);
		
		if($insert == "true"){
			$img = $_FILES['photoBook']['tmp_name'];
			$id = $obj->getId($isbn);

			$path = '../../img/Libros/' . $id[0] . '.png';
			if($imgExtension != "png"):
	            if($imgExtension == "jpg"):
	                    $imgObj = imagecreatefromjpeg($img);
	                    imagepng($imgObj, $img . '.png');
	            elseif($imgExtension == "jpeg"):
	                    $imgObj = imagecreatefromjpeg($img);
	                    imagepng($imgObj, $img . '.png');
	            endif;
	                            
				move_uploaded_file($img, $path);
	                                
				header("Location: ../../libros");
				exit();
			elseif($imgExtension == 'png'):
				move_uploaded_file($img, $path);
				
	            header("Location: ../../libros");
				exit();
			endif;
		}elseif($insert == "false"){
			header("Location: ../../libros?e4");
			exit();
		}elseif($insert == "false1"){
			header("Location: ../../libros?e3");
			exit();
		}

	}else{
		header("Location: ../../libros?e2");
		exit();
	}
}else{
	header("Location: ../../libros?e1");
	exit();
}