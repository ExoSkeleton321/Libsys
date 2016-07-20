<?php
	error_reporting(1);
	require 'includes/phpToPDF.php';
	require 'includes/php/FunctionsLibros.php';
	require 'includes/php/FunctionsClientes.php';
	$obj  = new FunctionsLibros();
	$obj2 = new FunctionsClientes();
	$rows = '';

	foreach($_POST['books'] as $book){
		$parts = explode('|', $book);
		$existencias = $obj->getExistenciasLibros($parts[0]);

		if($parts[1] <= $existencias[0]){
			$rows =  $rows . '
				<tr>
					<th>' . $obj->getNameLibro($parts[0])[0] . '</th>
					<td>$' . number_format($parts[2], 2) . '</td>
				</tr>';
		}else{
			$rows =  $rows . '<tr></tr>';
		}
	}

    //HTML top output
    $my_html = '
    <HTML>
    <head>
		<style>
			.logoDiv{
				width: 100%;
				padding: 5px 0 0 5px;
			}

			.logoDiv *{
			    display: inline-block;
			}

			.logo {
				color: #343434;
				font-size: 14px;
				line-height: 30px;
				font-weight: normal;
				text-transform: uppercase;
				font-family: "Orienta", sans-serif;
				font-style: italic;
			    margin: 0;
			    position: absolute;
			    top: 13px;
			}

			.logoDiv img{
			    width: 50px;
			    height: 50px;
			}

			.container{
			    margin: 0 auto; 
			    width: 90%;
			    border: 1px solid #000;
			}

			table{
			    width: 100%;
			}

			table tr th + td{
			    padding: 20px; 
			}

			table th{
			    text-align: right;
			}

			.subtotal{
			    border-top: 1px solid #000;
			}

			.lineheight{
			    line-height: 10px;
			}
		</style>
    </head>
    <body>
		<div class="container">
		    <div class="logoDiv">
		        <img src="http://phsclubs.com/wp-content/uploads/2013/08/book-club.jpg" />
		        <h3 class="logo">Recibo De Pago</h3>
		    </div>
		    <table class="table table-hover">
		    	' . $rows . '
		        <tr>
		            <th class="subtotal lineheight">Sub Total:</th>
		            <td class="subtotal lineheight">$' . number_format($_POST['priceVenta'], 2) . '</td>
		        </tr>
		        <tr>
		            <th class="lineheight">IVA (16%):</th>
		            <td class="lineheight">$' . number_format($_POST['priceIva'], 2) . '</td>
		        </tr>
		        <tr>
		            <th class="lineheight">Total:</th>
		            <td class="lineheight">$' . number_format($_POST['priceTotal'], 2) . '</td>
		        </tr>
		    </table>
		</div>
	</body>
	</HTML>
    ';

    $file_name = 'recibo ' . $_POST['time'] . '.pdf';

    //Set Your Options
    $pdf_options = array(
      "source_type" => 'html',
      "source" => $my_html,
      "action" => 'save',
      "save_directory" => 'recibos',
      "file_name" => $file_name);

    //Code to generate PDF file from options above
    phptopdf($pdf_options);
?>