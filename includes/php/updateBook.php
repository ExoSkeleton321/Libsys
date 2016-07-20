<?php
if(true){
	require 'FunctionsLibros.php';
	$obj = new FunctionsLibros();

	$bookId 	 = trim($_POST['bookId']);
	$name 		 = trim($_POST['nameBook']);
	$description = trim($_POST['descriptionBook']);
	$publishDate = trim($_POST['publishDateBook']);
	$isbn 		 = substr(strtoupper($_POST['isbnBookUpdate']), 0, 13);
	$pages 		 = (int) $_POST['pageNumberBook'];
	$edition 	 = (int) $_POST['editionBook'];
	$price 		 = (double) $_POST['priceBook'];
	$amount 	 = (int) $_POST['amountBook'];
	$genre 		 = (int) $_POST['genreBook'];
	$code 		 = strtoupper($_POST['codeBook']);

	$allowed 	  = ['png', 'jpg', 'jpeg'];

	if(trim($_FILES['photoBook']['name']) !== ""):
		$imgName 	  = $_FILES['photoBook']['name'];
		$imgExtension = mb_strtolower(end(explode(".", $imgName)));
		if(in_array($imgExtension, $allowed )){
			$insert = $obj->updateBook($bookId, $name, $description, $publishDate, $isbn, $pages, $edition, $price, $amount, $genre, $code);
			
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
	else:
		$insert = $obj->updateBook($bookId, $name, $description, $publishDate, $isbn, $pages, $edition, $price, $amount, $genre, $code);
		if($insert == "true"){
			header("Location: ../../libros");
			exit;
		}else{
			header("Location: ../../libros?e4");
			exit();
		}
	endif;
}else{
	header("Location: ../../libros?e1");
	exit();
}