<?php
require 'init.php';

class FunctionsLibros{
	public function getLibros(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			libros.*,
			tipo_libro.tipo

			FROM libros

			INNER JOIN tipo_libro
			ON libros.tipoLibro_id = tipo_libro.tipoLibro_id

			ORDER BY libros.libro_id ASC
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function getLibrosNoExistencias(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			libros.*,
			tipo_libro.tipo

			FROM libros

			INNER JOIN tipo_libro
			ON libros.tipoLibro_id = tipo_libro.tipoLibro_id

			WHERE numero_copias = 0

			ORDER BY libros.libro_id ASC
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function getLibrosGeneros(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			tipo_libro.*

			FROM tipo_libro
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function getLibroInfo($id){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			libros.*,
			tipo_libro.tipoLibro_id as tipoId,
			tipo_libro.tipo

			FROM libros

			INNER JOIN tipo_libro
			ON libros.tipoLibro_id = tipo_libro.tipoLibro_id

			WHERE libros.libro_id = :id
		");
		$query->execute([
			'id' => $id
		]);

		return $query->fetch();
	}

	public function searchForBook($name){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			libros.*,
			tipo_libro.tipo

			FROM libros

			INNER JOIN tipo_libro
			ON libros.tipoLibro_id = tipo_libro.tipoLibro_id

			WHERE libros.nombre LIKE '%" . $name . "%' OR ISBN = :query
		");
		$query->execute([
			'query' => $name
		]);

		return $query->fetchAll();
	}

	public function searchForBookNoEsxistencias($name){
		global $pdo;

		$query = $pdo->prepare("
			SELECT 
			libros.*,
			tipo_libro.tipo

			FROM libros

			INNER JOIN tipo_libro
			ON libros.tipoLibro_id = tipo_libro.tipoLibro_id

			WHERE (libros.nombre LIKE '%" . $name . "%' OR ISBN = :query) AND libros.numero_copias = 0
		");
		$query->execute([
			'query' => $name
		]);

		return $query->fetchAll();
	}

	public function insertBook($name, $description, $publishDate, $isbn, $pages, $edition, $price, $amount, $genre, $code, $autor, $editorial){
		global $pdo;

		$check = $pdo->prepare("
			SELECT * 
			FROM libros
			WHERE ISBN = BINARY(:isbn)
		");
		$check->execute([
			'isbn' => $isbn
		]);

		if($check->rowCount() > 0){
			return "false1";
		}else{
			$query = $pdo->prepare("
				INSERT INTO 
				libros(isbn, nombre, autores, editoriales, fecha_publicacion, numero_paginas, edicion, precio, numero_copias, descripcion, tipoLibro_id, codigo_alfanumerico)
				VALUES(:isbn, :nombre, :autores, :editoriales, :fecha_publicacion, :numero_paginas, :edicion, :precio, :numero_copias, :descripcion, :tipoLibro_id, :codigo_alfanumerico)
			");
			$query->execute([
				'isbn' 	  	   		=> $isbn,
				'nombre'	   		=> $name,
				'autores'	   		=> $autor,
				'editoriales'	   	=> $editorial,
				'fecha_publicacion' => $publishDate,
				'numero_paginas' 	=> $pages,
				'edicion'	   		=> $edition,
				'precio'   			=> $price,
				'numero_copias'		=> $amount,
				'descripcion'		=> $description,
				'tipoLibro_id'		=> $genre,
				'codigo_alfanumerico' => $code
			]);

			if($query){
				return "true";
			}else{
				return "false";
			}
		}
	}

	public function updateBook($bookId, $name, $description, $publishDate, $isbn, $pages, $edition, $price, $amount, $genre, $code){
		global $pdo;

		$query = $pdo->prepare("
			UPDATE libros
			SET ISBN = :isbn, nombre = :nombre, fecha_publicacion = :fecha_publicacion, numero_paginas = :numero_paginas, edicion = :edicion, precio = :precio, numero_copias = :numero_copias, descripcion = :descripcion, tipoLibro_id = :tipoLibro_id, codigo_alfanumerico = :codigo_alfanumerico
			WHERE libro_id = :id
		");
		$query->execute([
			'isbn' 	  	   		=> $isbn,
			'nombre'	   		=> $name,
			'fecha_publicacion' => $publishDate,
			'numero_paginas' 	=> $pages,
			'edicion'	   		=> $edition,
			'precio'   			=> $price,
			'numero_copias'		=> $amount,
			'descripcion'		=> $description,
			'tipoLibro_id'		=> $genre,
			'codigo_alfanumerico' => $code,
			'id' 				=> $bookId
		]);

		if($query){
			return "true";
		}else{
			return "false";
		}
	}

	public function getId($isbn){
		global $pdo;

		$query1 = $pdo->prepare("
			SELECT libro_id
			FROM libros
			WHERE ISBN = BINARY(:isbn)
		");
		$query1->execute([
			'isbn' => $isbn
		]);
		return $query1->fetch();
	}

	public function deleteBook($id){
		global $pdo;

		$query = $pdo->prepare("
			DELETE FROM libros

		    WHERE libro_id = :id
		");
		$query->execute([
			'id' => $id
		]);

		if($query):
			return true;
		else:
			return false;
		endif;
	}

	public function insertGenero($tipo){
		global $pdo;

		$check = $pdo->prepare("
			SELECT * 
			FROM tipo_libro
			WHERE tipo = :tipo
		");

		$check->execute([
			'tipo' => $tipo
		]);

		if($check->rowCount() > 0){
			return "false1";
		}else{
			$query = $pdo->prepare("
				INSERT INTO tipo_libro(tipo)

				VALUES(:tipo)
			");
			$query->execute([
				'tipo' => ucfirst($tipo)
			]);

			if($query){
				return "true";
			}else{
				return "false";
			}
		}
	}

	public function getAllAutores(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT *
			FROM autores
		");
		$query->execute();

		return $query->fetchAll();
	}

	public function insertAutor($nombre){
		global $pdo;

		$check = $pdo->prepare("
			SELECT * 
			FROM autores
			WHERE autor = :autor
		");

		$check->execute([
			'autor' => $nombre
		]);

		if($check->rowCount() > 0){
			return "false1";
		}else{
			$query = $pdo->prepare("
				INSERT INTO autores(autor)

				VALUES(:autor)
			");
			$query->execute([
				'autor' => ucfirst($nombre)
			]);

			if($query){
				return "true";
			}else{
				return "false";
			}
		}
	}

	public function getAllEditoriales(){
		global $pdo;

		$query = $pdo->prepare("
			SELECT *
			FROM editoriales
		");
		$query->execute();
		
		return $query->fetchAll();
	}

	public function insertEditorial($nombre){
		global $pdo;

		$check = $pdo->prepare("
			SELECT * 
			FROM editoriales
			WHERE editorial = :editorial
		");

		$check->execute([
			'editorial' => $nombre
		]);

		if($check->rowCount() > 0){
			return "false1";
		}else{
			$query = $pdo->prepare("
				INSERT INTO editoriales(editorial)

				VALUES(:editorial)
			");
			$query->execute([
				'editorial' => ucfirst($nombre)
			]);

			if($query){
				return "true";
			}else{
				return "false";
			}
		}
	}

	public function getAutorInfo($id){
		global $pdo;

		$query = $pdo->prepare("
			SELECT autor
			FROM autores
			WHERE autor_id = BINARY(:id)
		");
		$query->execute([
			'id' => $id
		]);
		return $query->fetch();
	}

	public function getEditorialInfo($id){
		global $pdo;

		$query = $pdo->prepare("
			SELECT editorial
			FROM editoriales
			WHERE editorial_id = BINARY(:id)
		");
		$query->execute([
			'id' => $id
		]);
		return $query->fetch();
	}

	public function getExistenciasLibros($id){
		global $pdo;

		$query = $pdo->prepare("
			SELECT numero_copias
			FROM libros
			WHERE libro_id = BINARY(:id)
		");
		$query->execute([
			'id' => $id
		]);
		return $query->fetch();
	}

	public function getNameLibro($id){
		global $pdo;

		$query = $pdo->prepare("
			SELECT nombre
			FROM libros
			WHERE libro_id = BINARY(:id)
		");
		$query->execute([
			'id' => $id
		]);
		return $query->fetch();
	}

	public function updateExistencias($libroId, $cantidad){
		global $pdo;

		$query = $pdo->prepare("
			UPDATE libros
			SET numero_copias = numero_copias - :can
			WHERE libro_id = :id
		");

		$query->execute([
			'can' => $cantidad,
			'id'  => $libroId
		]);

		if($query){
			return true;
		}else{
			return false;
		}
	}


}
?>