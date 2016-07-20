$(document).ready(function(){
	//USUARIOS
	$(document).on('click', '.byName', function(){
		try{
			$('.formById').css('display', 'none');
			$('.formByUsername').css('display', 'none');
			$('.resultSearch').html("");
			$('#byIdTxt').val("");
			$('#byUsernameTxt').val("");
		}catch(e){}
		$('.formByName').css('display', 'inherit');
		$('#byNameTxt').focus();
	});
	$(document).on('click', '.byId', function(){
		try{
			$('.formByName').css('display', 'none');
			$('.formByUsername').css('display', 'none');
			$('.resultSearch').html("");
			$('#byNameTxt').val("");
			$('#byUsernameTxt').val("");
		}catch(e){}
		$('.formById').css('display', 'inherit');
		$('#byIdTxt').focus();
	});
	$(document).on('click', '.byUsername', function(){
		try{
			$('.formById').css('display', 'none');
			$('.formByName').css('display', 'none');
			$('.resultSearch').html("");
			$('#byIdTxt').val("");
			$('#byNameTxt').val("");
		}catch(e){}
		$('.formByUsername').css('display', 'inherit');
		$('#byUsernameTxt').focus();
	});

	//Search by user's name.
	$('#byNameTxt').on('keyup', function(){
		try{
    		$('.loaderBox').remove();
    	}catch(e){}

		if($(this).val().trim() != ""){
			//Check if there are special characters in string.
			var node = $(this);
			node.val(node.val().replace(/[^a-zA-Z ]+/g,''));
			//Reset outline
			$(this).css('outline', 'none');
			//Ajax call.
			$.ajax({
				type: 'POST',
                url: 'includes/php/searchForUser.php',
                data: {
                    type: 'name',
                    query: node.val().trim()  
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('#byNameTxt');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	$('.resultSearch').html("");
                	$('.resultSearch').html(data);
                }
			});
		}else{
			//console.log('No Ajax');
			$(this).css('outline', '1px solid red');
		}
	});

	//Search by user ID
	$('#byIdTxt').on('keyup', function(){
		try{
    		$('.loaderBox').remove();
    	}catch(e){}

		if($(this).val().trim() != ""){
			//Check if there are special characters in string.
			var node = $(this);
			node.val(node.val().replace(/[^0-9 ]+/g,''));
			//Reset outline
			$(this).css('outline', 'none');
			//Ajax call.
			$.ajax({
				type: 'POST',
                url: 'includes/php/searchForUser.php',
                data: {
                    type: 'id',
                    query: node.val().trim()  
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('#byIdTxt');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	$('.resultSearch').html("");
                	$('.resultSearch').html(data);
                }
			});
		}else{
			//console.log('No Ajax');
			$(this).css('outline', '1px solid red');
		}
	});

	//Search by username
	$('#byUsernameTxt').on('keyup', function(){
		try{
    		$('.loaderBox').remove();
    	}catch(e){}

		if($(this).val().trim() != ""){
			//Check if there are special characters in string.
			var node = $(this);
			node.val(node.val().replace(/[^a-zA-Z0-9]+/g,''));
			//Reset outline
			$(this).css('outline', 'none');
			//Ajax call.
			$.ajax({
				type: 'POST',
                url: 'includes/php/searchForUser.php',
                data: {
                    type: 'username',
                    query: node.val().trim()  
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('#byIdTxt');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	$('.resultSearch').html("");
                	$('.resultSearch').html(data);
                }
			});
		}else{
			//console.log('No Ajax');
			$(this).css('outline', '1px solid red');
		}
	});
	
	//Add user
	$('.addUsuario').click(function(){
		var name 		 = $('.nameUsuarioTxt').val().trim();
		var apellido_pat = $('.apellidoPatUsuarioTxt').val().trim();
		var apellido_mat = $('.apellidoMatUsuarioTxt').val().trim();
		var email 		 = $('.emailUsuarioTxt').val().trim();
		var telefono 	 = $('.telUsuarioTxt').val().trim();
		var tipoTel 	 = $('.tipoTelUsuario').val();
		var tipoUsuario  = $('.tipoUsuario').val();
		var fechaNac_mes = $('.fechaNac_mes').val();
		var fechaNac_dia = $('.fechaNac_dia').val();
		var fechaNac_anio= $('.fechaNac_anio').val();

		if(name !== "" && apellido_pat !== "" && apellido_mat !== "" && email !== "" && telefono !== "" && tipoTel !== 0 && tipoUsuario !== 0 && fechaNac_mes !== 0 && fechaNac_dia !== 0 && fechaNac_anio !== 0){
			//Reset borders
			$('.nameUsuarioTxt').css('outline', 'none');
			$('.apellidoPatUsuarioTxt').css('outline', 'none');
			$('.apellidoMatUsuarioTxt').css('outline', 'none');
			$('.emailUsuarioTxt').css('outline', 'none');
			$('.telUsuarioTxt').css('outline', 'none');
			$('.tipoTelUsuario').css('outline', 'none');
			$('.tipoUsuario').css('outline', 'none');
			$('.fechaNac_mes').css('outline', 'none');
			$('.fechaNac_dia').css('outline', 'none');
			$('.fechaNac_anio').css('outline', 'none');
			
			//Insert user
			$.ajax({
				type: 'POST',
                url: 'includes/php/insertUser.php',
                data: {
                    nombre: name,
                    apellido_pat: apellido_pat,
                    apellido_mat: apellido_mat,
                    email: email,
                    tel: telefono,
                    tipoTel: tipoTel,
                    tipoUsuario: tipoUsuario,
                    mes: fechaNac_mes,
                    dia: fechaNac_dia,
                    anio: fechaNac_anio
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.addUsuario');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	try{
                		$('.resTipoTel').remove();
                	}catch(e){}
                	$('.nameUsuarioTxt').val("");
					$('.apellidoPatUsuarioTxt').val("");
					$('.apellidoMatUsuarioTxt').val("");
					$('.emailUsuarioTxt').val("");
					$('.telUsuarioTxt').val("");
                	$(data).insertAfter('.addUsuario');

                	//Update table
                	$.ajax({
                		type: 'POST',
	                    url: 'includes/php/updateUsersTable.php',
	                    success: function(data){
	                    	$('.tableUsers').html(data);
	                    }
                	});

                	setTimeout(function(){
                		try{
                    		$('.loaderBox').remove();
                    	}catch(e){}
                    	try{
                    		$('.resTipoTel').remove();
                    	}catch(e){}
                	}, 5000);
                }
			});
		}else if(name == "" || apellido_pat == "" || apellido_mat == "" || email == "" || telefono == "" || tipoTel == 0 || tipoUsuario == 0){
			if(name == ""){
				$('.nameUsuarioTxt').css('outline', '1px solid red');
			}else{
				$('.nameUsuarioTxt').css('outline', '1px solid #ccc');
			}

			if(apellido_pat == ""){
				$('.apellidoPatUsuarioTxt').css('outline', '1px solid red');
			}else{
				$('.apellidoPatUsuarioTxt').css('outline', '1px solid #ccc');
			}

			if(apellido_mat == ""){
				$('.apellidoMatUsuarioTxt').css('outline', '1px solid red');
			}else{
				$('.apellidoMatUsuarioTxt').css('outline', '1px solid #ccc');
			}

			if(email == ""){
				$('.emailUsuarioTxt').css('outline', '1px solid red');
			}else{
				$('.emailUsuarioTxt').css('outline', '1px solid #ccc');
			}

			if(telefono == ""){
				$('.telUsuarioTxt').css('outline', '1px solid red');
			}else{
				$('.telUsuarioTxt').css('outline', '1px solid #ccc');
			}

			if(tipoTel == "0"){
				$('.control-tipoTel  a').css('outline', '1px solid red');
			}else{
				$('.control-tipoTel  a').css('outline', '1px solid #ccc');
			}

			if(tipoUsuario == "0"){
				$('.control-tipoUsuario  a').css('outline', '1px solid red');
			}else{
				$('.control-tipoUsuario  a').css('outline', '1px solid #ccc');
			}

			if(fechaNac_mes == "0"){
				$('.fechaNac_mes').css('outline', '1px solid red');
			}else{
				$('.fechaNac_mes').css('outline', '1px solid #ccc');
			}

			if(fechaNac_dia == "0"){
				$('.fechaNac_dia').css('outline', '1px solid red');
			}else{
				$('.fechaNac_dia').css('outline', '1px solid #ccc');
			}

			if(fechaNac_anio == "0"){
				$('.fechaNac_anio').css('outline', '1px solid red');
			}else{
				$('.fechaNac_anio').css('outline', '1px solid #ccc');
			}
		}
	});

	//Agregar Tipo Telefono
	$('.addTipoTel').click(function(){
		var tipo = $('.tipoTelTxt').val().trim();
		if(tipo !== ""){
			$('.tipoTelTxt').css('outline', 'none');
			$.ajax({
				type: "POST",
				url: 'includes/php/insertTipoTelefono.php',
                data: {
                    tipo: tipo 
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.addTipoTel');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	try{
                		$('.resTipoTel').remove();
                	}catch(e){}
                	$('.tipoTelTxt').val("");
                	$(data).insertAfter('.addTipoTel');
                }
			});
		}else{
			$('.tipoTelTxt').css('outline', '1px solid red');
		}
	});

	//Ver mas de un usuarios
	$(document).on('click', '.btnViewMore', function(){
		var userId = $(this).attr("data-userId");

		$.ajax({
			type: "POST",
			url: 'includes/php/getUserInfo.php',
            data: {
                userId: userId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.verMasUsuarioModal').html(data);
            }
		});
	});

	//Editar un usuarios
	$(document).on('click', '.btnEditUser', function(){
		$( ".btnEditUserSecond" ).attr( "data-userId", $(this).attr("data-userId"));
	});
	$(document).on('click', '.btnEditUser', function(){
		var userId = $(this).attr("data-userId");

		$.ajax({
			type: "POST",
			url: 'includes/php/editUserInfo.php',
            data: {
                userId: userId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.editUsuarioModal').html(data);
            }
		});
	});

	$(document).on('click', '.btnEditUserSecond', function(){
		var userId 		 = $(this).attr("data-userId");
		var name 		 = $('.nameUsuarioTxtUpdate').val().trim();
		var apellido_pat = $('.apellidoPatUsuarioTxtUpdate').val().trim();
		var apellido_mat = $('.apellidoMatUsuarioTxtUpdate').val().trim();
		var email 		 = $('.emailUsuarioTxtUpdate').val().trim();
		var telefono 	 = $('.telUsuarioTxtUpdate').val().trim();
		var tipoTel 	 = $('.tipoTelUsuarioUpdate').val();
		var tipoUsuario  = $('.tipoUsuarioUpdate').val();
		var fecha_nacimiento = $('.fecha_nacimiento').val().trim();
		var usuarioInicial   = $('.usuarioInicial').val().trim();

		if(name !== "" && apellido_pat !== "" && apellido_mat !== "" && email !== "" && tipoUsuario !== "0"){
			//Reset borders
			$('.nameUsuarioTxtUpdate').css('outline', 'none');
			$('.apellidoPatUsuarioTxtUpdate').css('outline', 'none');
			$('.apellidoMatUsuarioTxtUpdate').css('outline', 'none');
			$('.emailUsuarioTxtUpdate').css('outline', 'none');
			$('.telUsuarioTxtUpdate').css('outline', 'none');
			$('.tipoTelUsuarioUpdate').css('outline', 'none');
			$('.tipoUsuarioUpdate').css('outline', 'none');

			//Insert user
			$.ajax({
				type: 'POST',
                url: 'includes/php/updateUser.php',
                data: {
                	userId: userId,
                    nombre: name,
                    apellido_pat: apellido_pat,
                    apellido_mat: apellido_mat,
                    email: email,
                    tel: telefono,
                    tipoTel: tipoTel,
                    tipoUsuario: tipoUsuario,
                    fecha_nacimiento: fecha_nacimiento,
                    usuarioInicial: usuarioInicial
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.btnEditUserSecond');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	try{
                		$('.resTipoTel').remove();
                	}catch(e){}
                	if(tipoTel !== "0" && data == '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Usuario actualizado correctamente.</p>' && telefono !== ""){
                		$('.allTelephones').append('<p>- ' + telefono + "</p>");
                	}

                	$(data).insertAfter('.btnEditUserSecond');


                	//Update table
                	$.ajax({
                		type: 'POST',
	                    url: 'includes/php/updateUsersTable.php',
	                    success: function(data){
	                    	$('.tableUsers').html(data);
	                    }
                	});

                	setTimeout(function(){
                		try{
                    		$('.loaderBox').remove();
                    	}catch(e){}
                    	try{
                    		$('.resTipoTel').remove();
                    	}catch(e){}
                	}, 5000);
                }
			});
		}else if(name == "" || apellido_pat == "" || apellido_mat == "" || email == "" || tipoUsuario == 0){
			if(name == ""){
				$('.nameUsuarioTxtUpdate').css('outline', '1px solid red');
			}else{
				$('.nameUsuarioTxtUpdate').css('outline', '1px solid #ccc');
			}

			if(apellido_pat == ""){
				$('.apellidoPatUsuarioTxtUpdate').css('outline', '1px solid red');
			}else{
				$('.apellidoPatUsuarioTxtUpdate').css('outline', '1px solid #ccc');
			}

			if(apellido_mat == ""){
				$('.apellidoMatUsuarioTxtUpdate').css('outline', '1px solid red');
			}else{
				$('.apellidoMatUsuarioTxtUpdate').css('outline', '1px solid #ccc');
			}

			if(email == ""){
				$('.emailUsuarioTxtUpdate').css('outline', '1px solid red');
			}else{
				$('.emailUsuarioTxtUpdate').css('outline', '1px solid #ccc');
			}

			if(tipoUsuario == "0"){
				$('.control-tipoUsuarioUpdate  a').css('outline', '1px solid red');
			}else{
				$('.control-tipoUsuarioUpdate  a').css('outline', '1px solid #ccc');
			}
		}
	});

	//Eliminar un usuarios
	$(document).on('click', '.btnDeleteUserFirst', function(){
		$( ".btnDeleteUser" ).attr( "data-userId", $(this).attr("data-userId"));
	});

	$(document).on('click', '.btnDeleteUser', function(){
		var userId = $(this).attr("data-userId");
		$.ajax({
			type: "POST",
			url: 'includes/php/deleteUser.php',
            data: {
                userId: userId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	
            	//Update table
            	$.ajax({
            		type: 'POST',
                    url: 'includes/php/updateUsersTable.php',
                    success: function(data){
                    	$('.tableUsers').html(data);
                    }
            	});
            }
		});
	});

	//LIBROS
	var counter;
	//Ver mas de un libro
	$(document).on('click', '.btnViewMoreBook', function(){
		var bookId = $(this).attr("data-bookId");

		$.ajax({
			type: "POST",
			url: 'includes/php/getBookInfo.php',
            data: {
                bookId: bookId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.verMasLibroModal').html(data);
            }
		});
	});

	$('.btnAddBookInitial').click(function(){
		counter = 1;
		$('.codeBook').val("");
	});

	$('.codeBook').on('keyup', function(){
		if(counter == 2 || counter == 4 || counter == 5){
			$('.codeBook').val($('.codeBook').val() + '-');
		}
		
		counter++;
	});

	//Emiminar libro
	$(document).on('click', '.btnDeleteBook', function(){
		$( ".btnDeleteBookPerm" ).attr( "data-bookId", $(this).attr("data-bookId"));
	});
	$(document).on('click', '.btnDeleteBookPerm', function(){
		var bookId = $(this).attr("data-bookId");

		$.ajax({
			type: "POST",
			url: 'includes/php/deleteBook.php',
            data: {
                bookId: bookId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	
            	//Update table
            	$.ajax({
            		type: 'POST',
                    url: 'includes/php/updateBookTable.php',
                    success: function(data){
                    	$('.tableBooks').html(data);
                    }
            	});
            }
		});
	});

	//Buscar libros
	$('.searchBookTxt').on('keyup', function(){
		try{
    		$('.loaderBox').remove();
    	}catch(e){}

		//Ajax call.
		$.ajax({
			type: 'POST',
            url: 'includes/php/searchForBook.php',
            data: {
            	userType: userType,
                query: $(this).val().trim()  
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.tableBooks').html(data);
            }
		});
	});

	//Editar un libro
	$(document).on('click', '.btnEditBook', function(){
		var bookId = $(this).attr("data-bookId");
		$.ajax({
			type: "POST",
			url: 'includes/php/editBookInfo.php',
            data: {
                bookId: bookId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.editLibroModal').html(data);
            }
		});
	});

	//Agregar genero de libro
	$('.btnAddGenero').click(function(){
		var tipo = $('.tipoLibroTxt').val().trim();
		if(tipo !== ""){
			$('.tipoLibroTxt').css('outline', 'none');
			$.ajax({
				type: "POST",
				url: 'includes/php/insertGeneroLibro.php',
                data: {
                    tipo: tipo 
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.btnAddGenero');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	try{
                		$('.resTipoTel').remove();
                	}catch(e){}
                	$('.tipoLibroTxt').val("");
                	if(data == '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Insertado Correctamente.</p>'){
                		$('.generosLibrosExistentes').append("<p>" + tipo + "</p>");
                	}
                	
                	$(data).insertAfter('.btnAddGenero');

                	setTimeout(function(){
                		try{
                    		$('.loaderBox').remove();
                    	}catch(e){}
                    	try{
                    		$('.resTipoTel').remove();
                    	}catch(e){}
                	}, 5000);
                }
			});
		}else{
			$('.tipoLibroTxt').css('outline', '1px solid red');
		}
	});

	//Agregar autor de libro
	$('.btnAddAutor').click(function(){
		var nombre = $('.nombreAutorTxt').val().trim();
		if(nombre !== ""){
			$('.nombreAutorTxt').css('outline', 'none');
			$.ajax({
				type: "POST",
				url: 'includes/php/insertAutor.php',
                data: {
                    nombre: nombre 
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.btnAddAutor');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	try{
                		$('.resTipoTel').remove();
                	}catch(e){}
                	$('.tipoLibroTxt').val("");
                	if(data == '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Insertado Correctamente.</p>'){
                		$('.autoresExistentes').append("<p>" + nombre + "</p>");
                		$('.nombreAutorTxt').val("");
                	}
                	
                	$(data).insertAfter('.btnAddAutor');

                	setTimeout(function(){
                		try{
                    		$('.loaderBox').remove();
                    	}catch(e){}
                    	try{
                    		$('.resTipoTel').remove();
                    	}catch(e){}
                	}, 5000);
                }
			});
		}else{
			$('.nombreAutorTxt').css('outline', '1px solid red');
		}
	});

	//Agregar editorial de libro
	$('.btnAddEditorial').click(function(){
		var nombre = $('.nombreEditorialTxt').val().trim();
		if(nombre !== ""){
			$('.nombreEditorialTxt').css('outline', 'none');
			$.ajax({
				type: "POST",
				url: 'includes/php/insertEditorial.php',
                data: {
                    nombre: nombre 
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.btnAddEditorial');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	try{
                		$('.resTipoTel').remove();
                	}catch(e){}
                	$('.tipoLibroTxt').val("");
                	if(data == '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Insertado Correctamente.</p>'){
                		$('.editorialesExistentes').append("<p>" + nombre + "</p>");
                		$('.nombreEditorialTxt').val("");
                	}
                	
                	$(data).insertAfter('.btnAddEditorial');

                	setTimeout(function(){
                		try{
                    		$('.loaderBox').remove();
                    	}catch(e){}
                    	try{
                    		$('.resTipoTel').remove();
                    	}catch(e){}
                	}, 5000);
                }
			});
		}else{
			$('.nombreEditorialTxt').css('outline', '1px solid red');
		}
	});

	//Change Password
    $('.btnChangePass').on('click', function(){
        var oldPass       = $('.old_pass').val().trim();
        var newPass       = $('.new_pass').val().trim();
        var newPassRepeat = $('.new_pass_repeat').val().trim();

        if(oldPass !== "" && newPass !== "" && newPassRepeat !== ""){

            if(newPass === newPassRepeat){

                if(oldPass !== newPass){
                    $('.old_pass').css('outline', '1px solid #ccc');
                    $('.new_pass').css('outline', '1px solid #ccc');
                    $('.new_pass_repeat').css('outline', '1px solid #ccc');
                    try{
                        $('.errorPost').remove();
                    }catch(e){}

                    $.ajax({
                        type: 'POST',
                        url: 'includes/php/changePassword.php',
                        data: {
                            oldPass: $('.old_pass').val().trim(),
                            newPass: $('.new_pass').val().trim(),
                            newPassRepeat: $('.new_pass_repeat').val().trim()
                        },
                        beforeSend: function(){
                            $('.changePassContainer').append('<img src="img/loader.gif" class="loaderBox" />');
                        },
                        success: function(data){
                            if(data === '<span style="color: green;" class="successChangePass">Contraseña actualizada.</span>'){
                                $('.old_pass').val('');
                                $('.new_pass').val('');
                                $('.new_pass_repeat').val('');
                            }

                            try{
                                $('.successChangePass').remove(); //Echoed from changePassword.php file
                            }catch(e){}
                            $('.loaderBox').remove();
                            $('.loaderBox').remove();

                            $('.changePassContainer').append(data);
                        }
                    });
                }else{
                    try{
                        $('.errorPost').remove();
                    }catch(e){}
                    try{
                        $('.successChangePass').remove();
                    }catch(e){}
                    $('.changePassContainer').append('<span class="errorPost">La contraseña actual no puede ser igual que la nueva.</span>');
                    $('.old_pass').css('outline', '1px solid red');
                    $('.new_pass').css('outline', '1px solid red');
                    $('.new_pass_repeat').css('outline', '1px solid #ccc'); 
                }
                
            }else{
                try{
                    $('.errorPost').remove();
                }catch(e){}
                try{
                    $('.successChangePass').remove();
                }catch(e){}
                $('.changePassContainer').append('<span class="errorPost">Contraseñas no son iguales.</span>');
                $('.old_pass').css('outline', '1px solid #ccc');
                $('.new_pass').css('outline', '1px solid red');
                $('.new_pass_repeat').css('outline', '1px solid red');
            }
            
        }else{
            if(oldPass == ""){
                $('.old_pass').css('outline', '1px solid red');
            }else{
                $('.old_pass').css('outline', '1px solid #ccc');
            }

            if(newPass == ""){
                $('.new_pass').css('outline', '1px solid red');
            }else{
                $('.new_pass').css('outline', '1px solid #ccc');
            }

            if(newPassRepeat == ""){
                $('.new_pass_repeat').css('outline', '1px solid red');
            }else{
                $('.new_pass_repeat').css('outline', '1px solid #ccc');
            }

        }
    });

	//Clientes
	//Add cliente
	$('.addCliente').click(function(){
		var name 		 = $('.nameClienteTxt').val().trim();
		var apellido_pat = $('.apellidoPatClienteTxt').val().trim();
		var apellido_mat = $('.apellidoMatClienteTxt').val().trim();
		var curp 		 = $('.curpClienteTxt').val().trim();
		var tipoCliente  = $('.tipoCliente').val();
		var email 		 = $('.correoClienteTxt').val().trim();
		var direccion 	 = $('.direccionClienteTxt').val().trim();
		var tel 		 = $('.telClienteTxt').val().trim();
		var tipoTel 	 = $('.tipoTelCliente').val();

		if(name !== "" && apellido_pat !== "" && apellido_mat !== "" && email !== "" && tel !== "" && tipoTel !== "0" && tipoCliente !== 0){
			//console.log("Sent");
			//Reset borders
			$('.nameClienteTxt').css('outline', 'none');
			$('.apellidoPatClienteTxt').css('outline', 'none');
			$('.apellidoMatClienteTxt').css('outline', 'none');
			$('.curpClienteTxt').css('outline', 'none');
			$('.control-tipoCliente  a').css('outline', 'none');

			$('.correoClienteTxt').css('outline', 'none');
			$('.direccionClienteTxt').css('outline', 'none');
			$('.telClienteTxt').css('outline', 'none');
			$('.control-tipoTel  a').css('outline', 'none');
			
			//Insert user
			$.ajax({
				type: 'POST',
                url: 'includes/php/insertCliente.php',
                data: {
                    nombre: name,
                    apellido_pat: apellido_pat,
                    apellido_mat: apellido_mat,
                    email: email,
                    tel: tel,
                    tipoTel: tipoTel,
                    tipoCliente: tipoCliente,
                    curp: curp,
                    direccion: direccion
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.addCliente');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	try{
                		$('.resTipoTel').remove();
                	}catch(e){}
                	if(data == "<p class='resTipoTel'><i class='halflings-icon ok' style='color: green;'></i> Cliente insertado Correctamente.</p>"){
						$('.nameClienteTxt').val("");
						$('.apellidoPatClienteTxt').val("");
						$('.apellidoMatClienteTxt').val("");
						$('.correoClienteTxt').val("");
						$('.telClienteTxt').val("");
						$('.curpClienteTxt').val("");
						$('.direccionClienteTxt').val("");
                	}
                	
                	$(data).insertAfter('.addCliente');

                	//Update table
                	$.ajax({
                		type: 'POST',
	                    url: 'includes/php/updateClientesTable.php',
	                    beforeSend: function(){
	                    	$('.tableClientesInner').html('<img src="img/loader.gif" class="loaderBox" />');
	                    },
	                    success: function(data){
	                    	$('.tableClientesInner').html(data);
	                    }
                	});

                	setTimeout(function(){
                		try{
                    		$('.loaderBox').remove();
                    	}catch(e){}
                    	try{
                    		$('.resTipoTel').remove();
                    	}catch(e){}
                	}, 5000);
                }
			});
		}else{
			if(name == ""){
				$('.nameClienteTxt').css('outline', '1px solid red');
			}else{
				$('.nameClienteTxt').css('outline', '1px solid #ccc');
			}

			if(apellido_pat == ""){
				$('.apellidoPatClienteTxt').css('outline', '1px solid red');
			}else{
				$('.apellidoPatClienteTxt').css('outline', '1px solid #ccc');
			}

			if(apellido_mat == ""){
				$('.apellidoMatClienteTxt').css('outline', '1px solid red');
			}else{
				$('.apellidoMatClienteTxt').css('outline', '1px solid #ccc');
			}

			if(email == ""){
				$('.correoClienteTxt').css('outline', '1px solid red');
			}else{
				$('.correoClienteTxt').css('outline', '1px solid #ccc');
			}

			if(tel == ""){
				$('.telClienteTxt').css('outline', '1px solid red');
			}else{
				$('.telClienteTxt').css('outline', '1px solid #ccc');
			}

			if(tipoTel == "0"){
				$('.control-tipoTel  a').css('outline', '1px solid red');
			}else{
				$('.control-tipoTel  a').css('outline', '1px solid #ccc');
			}

			if(curp == ""){
				$('.curpClienteTxt').css('outline', '1px solid red');
			}else{
				$('.curpClienteTxt').css('outline', '1px solid #ccc');
			}

			if(direccion == ""){
				$('.direccionClienteTxt').css('outline', '1px solid red');
			}else{
				$('.direccionClienteTxt').css('outline', '1px solid #ccc');
			}

			if(tipoCliente == "0"){
				$('.control-tipoCliente  a').css('outline', '1px solid red');
			}else{
				$('.control-tipoCliente  a').css('outline', '1px solid #ccc');
			}
		}
	});

	//Buscar clientes
	$('.searchClienteTxt').on('keyup', function(){
		try{
    		$('.loaderBox').remove();
    	}catch(e){}

		//Ajax call.
		$.ajax({
			type: 'POST',
            url: 'includes/php/searchForCliente.php',
            data: {
                query: $(this).val().trim()  
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.tableClientesInner').html(data);
            }
		});
	});

	//Ver mas de un cliente
	$(document).on('click', '.btnViewMoreCliente', function(){
		var clienteId = $(this).attr("data-userId");
		
		$.ajax({
			type: "POST",
			url: 'includes/php/getClienteInfo.php',
            data: {
                userId: clienteId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.verMasClienteModal').html(data);
            }
		});
	});

	//Editar un cliente
	$(document).on('click', '.btnEditCliente', function(){
		$( ".btnEditClienteSecond" ).attr( "data-userId", $(this).attr("data-userId"));
	});
	$(document).on('click', '.btnEditCliente', function(){
		var userId = $(this).attr("data-userId");

		$.ajax({
			type: "POST",
			url: 'includes/php/editClienteInfo.php',
            data: {
            	userType: userType,
                userId: userId
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.editClienteModal').html(data);
            }
		});
	});
	$(document).on('click', '.btnEditClienteSecond', function(){
		var userId 		 = $(this).attr("data-userId");
		var tipoCliente  = $('.tipoClienteUpdate').val();
		var email 		 = $('.correoClienteTxtUpdate').val().trim();
		var direccion 	 = $('.direccionClienteTxtUpdate').val().trim();
		var tel 		 = $('.telClienteTxtUpdate').val().trim();
		var tipoTel 	 = $('.tipoTelClienteUpdate').val();


		if(email !== "" && tipoCliente !== "0" && direccion !== ""){
			//Reset borders
			$('.tipoClienteUpdate').css('outline', 'none');
			$('.correoClienteTxtUpdate').css('outline', 'none');
			$('.direccionClienteTxtUpdate').css('outline', 'none');
			$('.telClienteTxtUpdate').css('outline', 'none');
			$('.tipoTelClienteUpdate').css('outline', 'none');

			//Insert user
			$.ajax({
				type: 'POST',
                url: 'includes/php/updateCliente.php',
                data: {
                	userId: userId,
                	tipoCliente: tipoCliente,
                	email: email,
                	direccion: direccion,
                	tel: tel,
                	tipoTel: tipoTel
                }, 
                beforeSend: function(){
                    $('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.btnEditClienteSecond');
                },
                success: function(data){
                	try{
                		$('.loaderBox').remove();
                	}catch(e){}
                	try{
                		$('.resTipoTel').remove();
                	}catch(e){}
                	if(tipoTel !== "0" && data == '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Cliente actualizado correctamente.</p>' && tel !== ""){
                		$('.allTelephones').append('<p>- ' + tel + " [" + $(".tipoTelClienteUpdate option:selected").text() + "]</p>");
                	}

                	$('.telClienteTxtUpdate').val("");
					$('.tipoTelClienteUpdate').val("");
                	$(data).insertAfter('.btnEditClienteSecond');


                	//Update table
                	$.ajax({
                		type: 'POST',
	                    url: 'includes/php/updateClientesTable.php',
	                    beforeSend: function(){
	                    	$('.tableClientesInner').html('<img src="img/loader.gif" class="loaderBox" />');
	                    },
	                    success: function(data){
	                    	$('.tableClientesInner').html(data);
	                    }
                	});

                	setTimeout(function(){
                		try{
                    		$('.loaderBox').remove();
                    	}catch(e){}
                    	try{
                    		$('.resTipoTel').remove();
                    	}catch(e){}
                	}, 5000);
                }
			});
		}else if(email == "" || tipoCliente == 0 || direccion == ""){
			if(email == ""){
				$('.correoClienteTxtUpdate').css('outline', '1px solid red');
			}else{
				$('.correoClienteTxtUpdate').css('outline', '1px solid #ccc');
			}

			if(direccion == ""){
				$('.direccionClienteTxtUpdate').css('outline', '1px solid red');
			}else{
				$('.direccionClienteTxtUpdate').css('outline', '1px solid #ccc');
			}

			if(tipoCliente == "0"){
				$('.control-tipoClienteUpdate  a').css('outline', '1px solid red');
			}else{
				$('.control-tipoClienteUpdate  a').css('outline', '1px solid #ccc');
			}
		}
	});

	//Eliminar un cliente
	$(document).on('click', '.btnDeleteClienteFirst', function(){
		$( ".btnDeleteCliente" ).attr( "data-userId", $(this).attr("data-userId"));
	});

	$(document).on('click', '.btnDeleteCliente', function(){
		var userId = $(this).attr("data-userId");

		$.ajax({
			type: "POST",
			url: 'includes/php/deleteCliente.php',
            data: {
                userId: userId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	
            	//Update table
            	$.ajax({
            		type: 'POST',
                    url: 'includes/php/updateClientesTable.php',
                    success: function(data){
                    	$('.tableClientesInner').html(data);
                    }
            	});
            }
		});
	});

	//VENTAS
	//Search in venta
	$('.searchBookTxtVenta').on('keyup', function(){
		try{
    		$('.loaderBox').remove();
    	}catch(e){}

		//Ajax call.
		$.ajax({
			type: 'POST',
            url: 'includes/php/searchForBookInVenta.php',
            data: {
                query: $(this).val().trim()  
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.tableBooks').html(data);
            }
		});
	});

	var books = new Array();
	$(document).on('click', '.btnAddToVenta', function(){
		var bookId      = $(this).attr('data-bookId'),
		    name        = $(this).attr('data-name'),
		    price       = $(this).attr('data-price'),
		    cantidad    = parseFloat($(this).attr('data-numberBooks')),
		    existencias = $(this).attr('data-existencias');
		if(existencias <= 0){
			alert("No se puede insertar a la venta, favor de levantar un pedido.");
		}else{
			//Calcular el precio de un articulo
			var priceTotal = parseFloat(price) * cantidad;
			priceTotal = parseFloat(priceTotal).toFixed(2);

			//Agregarle el precio a la venta total y calcular el subtotal
			var priceVenta = parseFloat($('.priceVenta').text().match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/));
			priceVenta = priceVenta + (parseFloat(price) * cantidad);
			priceVenta = parseFloat(priceVenta).toFixed(2);
			$('.priceVenta').html(priceVenta);

			//Calcular IVA
			var priceIva = parseFloat($('.priceIva').text().match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/));
			priceIva = priceVenta * 0.16;
			priceIva = parseFloat(priceIva).toFixed(2);
			$('.priceIva').html(priceIva);

			//Calcular total
			var priceVentaFinal = parseFloat($('.priceVentaFinal').text().match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/));
			priceVentaFinal = parseFloat(priceVenta) + parseFloat(priceIva);
			priceVentaFinal = parseFloat(priceVentaFinal).toFixed(2);
			$('.priceVentaFinal').html(priceVentaFinal);

			//Agregar el libro a los articulo que estan siendo vendidos
			$('.bookInVenta').append("<div class='row' style='margin-left: 0;'><div class='span6' style='font-size: 18px;'>" + name + " x" + cantidad + "</div><div class='span6' style='font-size: 18px;'>$" + priceTotal + "</div></div>");
			
			books.push(bookId + "|" + cantidad + "|" + priceTotal);
			//console.log(books);
		}
	});
		
	$(document).on('click', '.btnAddVarous', function(){
		$('.btnAddToVenta').attr('data-bookId', $(this).attr('data-bookId'));
		$('.btnAddToVenta').attr('data-name', $(this).attr('data-name'));
		$('.btnAddToVenta').attr('data-price', $(this).attr('data-price'));
		$('.btnAddToVenta').attr('data-existencias', $(this).attr('data-existencias'));
	});

	$('.cantidadDeLibrosEnVenta').on('keyup', function(){
		$('.btnAddToVenta').attr('data-numberBooks', $(this).val());
	});

	$('.btnCompletarVenta').click(function(){
		if(typeof books == 'undefined' || books.length <= 0){
			alert("Por favor inserte libros para vender");
		}
	});

	$('.btnDineroRecibido').click(function(){
		if(typeof books == 'undefined' || books.length <= 0){
			alert("Por favor inserte libros para vender");
		}else{
			var dineroRecibido = parseFloat($('.dineroRecibido').val()),
				cambio 		   = dineroRecibido - parseFloat($('.priceVentaFinal').text().match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/)),
				clienteId 	   = parseInt($('.idClienteVenta').val());
			
			if(dineroRecibido < parseFloat($('.priceVentaFinal').text().match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/))){
				alert("Reciba una cantidad mayor o igual al valor de la venta.");
			}else{
				$('.recibidoTxt').html(parseFloat(dineroRecibido).toFixed(2));
				$('.cambioTxt').html(parseFloat(cambio).toFixed(2));
				
				$.ajax({
					type: "POST",
					url: 'includes/php/sellBooks.php',
		            data: {
		            	clienteId: clienteId,
		                books: books
		            },
		            success: function(data){
		            	try{
		            		$('.loaderBox').remove();
		            	}catch(e){}
		            	$('.responseAjax').html(data);
		            }
		        });
				

				if($("#checkRecibo").is(':checked') == true){
					var time = Date.now() / 1000 | 0;
					$.ajax({
						type: "POST",
						url: 'generatepdf.php',
			            data: {
			            	clienteId: clienteId,
			                books: books,
			                priceVenta: parseFloat($('.priceVenta').text().match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/)),
			                priceIva: parseFloat($('.priceIva').text().match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/)),
			                priceTotal: parseFloat($('.priceVentaFinal').text().match(/(\+|-)?((\d+(\.\d+)?)|(\.\d+))/)),
			                time: time
			            },
			            success: function(data){
			            	try{
			            		$('.loaderBox').remove();
			            	}catch(e){}
			            	//console.log(data);

			            	setTimeout(function(){
			            		window.open(
								  'localhost:8080/Libreria/recibo/' + time,
								  '_blank'
								);
			            	}, 5000);
			            }
			        });
				}

				$('.searchBookTxtVenta').val("");
				$('.tableBooks').html("");
				$('.responseVenta').html("Venta Realizada");

				books.length = 0;
			}
		}
	});

	$('.limpiarVenta').click(function(){
		$('.bookInVenta').html("");
		$('.priceVenta').html("0.00");
		$('.priceIva').html("0.00");
		$('.priceVentaFinal').html("0.00");
		$('.recibidoTxt').html("0.00");
		$('.cambioTxt').html("0.00");
		$('.responseVenta').html("");
		$('.responseVentaRealizada').each(function(){
			$(this).html("");
		});

		$('.searchBookTxtVenta').val("");
		$('.tableBooks').html("");

		books.length = 0;
	});

	//Proveedores
	$('.estadoProv').on('change', function() {
		$.ajax({
		  	type: "POST",
			url: 'includes/php/getEstados.php',
		    data: {
		    	estado_id: this.value
		    },
		    beforeSend: function(){
		    	$('.loaderImg').html('<img src="img/loader.gif" class="loaderBox" />');
		    },
		    success: function(data){
		    	try{
		    		$('.loaderBox').remove();
		    	}catch(e){}
		    	$('.municipioProv').html(data);
		    	$('.localidadProv').html('<option value="0">-- Seleccionar Localidad --</option>');
		    }
		});
	});

	$('.municipioProv').on('change', function() {
		$.ajax({
		  	type: "POST",
			url: 'includes/php/getEstados.php',
		    data: {
		    	municipio_id: this.value
		    },
		    beforeSend: function(){
		    	$('.loaderImg').html('<img src="img/loader.gif" class="loaderBox" />');
		    },
		    success: function(data){
		    	try{
		    		$('.loaderBox').remove();
		    	}catch(e){}
		    	$('.localidadProv').html(data);
		    }
		});
	});

	$('.addProveedor').click(function(){
		var rfc 		 = $('.rfcProvTxt').val().trim();
		var nombre 		 = $('.nameProvTxt').val().trim();
		var tel 		 = $('.telProvTxt').val().trim();
		var web 		 = $('.sitioWebProvTxt').val().trim();
		var calle 		 = $('.calleProvTxt').val().trim();
		var numero_calle = $('.numeroProvTxt').val().trim();
		var estado_id	 = $('.estadoProv').val();
		var municipio_id = $('.municipioProv').val();
		var localidad_id = $('.localidadProv').val();
		var cp  		 = $('.cpProvTxt').val().trim();

		if(rfc !== "" && nombre !== "" && tel !== "" && calle !== "" && numero_calle !== "" && estado_id !== "0" && municipio_id !== "0" && localidad_id !== "0" && cp !== "0"){
			console.log("Send Ajax");
			$('.nameProvTxt').css('outline', '1px solid #ccc');
			$('.telProvTxt').css('outline', '1px solid #ccc');
			$('.calleProvTxt').css('outline', '1px solid #ccc');
			$('.numeroProvTxt').css('outline', '1px solid #ccc');
			$('.estadoProv').css('outline', '1px solid #ccc');
			$('.municipioProv').css('outline', '1px solid #ccc');
			$('.localidadProv').css('outline', '1px solid #ccc');
			$('.cpProvTxt').css('outline', '1px solid #ccc');

			$.ajax({
			  	type: "POST",
				url: 'includes/php/insertProveedor.php',
			    data: {
			    	rfc: rfc,
			    	nombre: nombre,
			    	tel: tel,
			    	web: web,
			    	calle: calle,
			    	numero_calle: numero_calle,
			    	estado_id: estado_id,
			    	municipio_id: municipio_id,
			    	localidad_id: localidad_id,
			    	cp: cp
			    },
			    beforeSend: function(){
			    	$('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.addProveedor');
			    },
			    success: function(data){
			    	try{
			    		$('.loaderBox').remove();
			    		$('.resTipoTel').remove();
			    	}catch(e){}
					$(data).insertAfter('.addProveedor');

					//Update table
                	$.ajax({
                		type: 'POST',
	                    url: 'includes/php/updateProveedoresTable.php',
	                    beforeSend: function(){
	                    	$('.tableProveedores').html('<img src="img/loader.gif" class="loaderBox" />');
	                    },
	                    success: function(data){
	                    	$('.tableProveedores').html(data);
	                    }
                	});
			    }
			});
			

		}else{
			if(rfc == ""){
				$('.rfcProvTxt').css('outline', '1px solid red');
			}else{
				$('.rfcProvTxt').css('outline', '1px solid #ccc');
			}

			if(nombre == ""){
				$('.nameProvTxt').css('outline', '1px solid red');
			}else{
				$('.nameProvTxt').css('outline', '1px solid #ccc');
			}

			if(tel == ""){
				$('.telProvTxt').css('outline', '1px solid red');
			}else{
				$('.telProvTxt').css('outline', '1px solid #ccc');
			}

			if(calle == ""){
				$('.calleProvTxt').css('outline', '1px solid red');
			}else{
				$('.calleProvTxt').css('outline', '1px solid #ccc');
			}

			if(numero_calle == ""){
				$('.numeroProvTxt').css('outline', '1px solid red');
			}else{
				$('.numeroProvTxt').css('outline', '1px solid #ccc');
			}

			if(estado_id == "0"){
				$('.estadoProv').css('outline', '1px solid red');
			}else{
				$('.estadoProv').css('outline', '1px solid #ccc');
			}
			if(municipio_id == "0"){
				$('.municipioProv').css('outline', '1px solid red');
			}else{
				$('.municipioProv').css('outline', '1px solid #ccc');
			}
			if(localidad_id == "0"){
				$('.localidadProv').css('outline', '1px solid red');
			}else{
				$('.localidadProv').css('outline', '1px solid #ccc');
			}

			if(cp == ""){
				$('.cpProvTxt').css('outline', '1px solid red');
			}else{
				$('.cpProvTxt').css('outline', '1px solid #ccc');
			}


		}


	});

	//Ver mas de un proveedor
	$(document).on('click', '.btnViewMoreProveedor', function(){
		var userId = $(this).attr("data-userId");

		$.ajax({
			type: "POST",
			url: 'includes/php/getProveedorInfo.php',
            data: {
                userId: userId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.verMasProveedorModal').html(data);
            }
		});
	});

	//Eliminar un proveedor
	$(document).on('click', '.btnDeleteProveedorFirst', function(){
		$( ".btnDeleteProveedor" ).attr( "data-userId", $(this).attr("data-userId"));
	});

	$(document).on('click', '.btnDeleteProveedor', function(){
		var userId = $(this).attr("data-userId");

		$.ajax({
			type: "POST",
			url: 'includes/php/deleteProveedor.php',
            data: {
                userId: userId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	
            	//Update table
            	$.ajax({
            		type: 'POST',
                    url: 'includes/php/updateProveedoresTable.php',
                    beforeSend: function(){
                    	$('.tableProveedores').html('<img src="img/loader.gif" class="loaderBox" />');
                    },
                    success: function(data){
                    	$('.tableProveedores').html(data);
                    }
            	});
            }
		});
	});

	//Pedidos
	var pedidos        = new Array();
	var anticipoMin    = 0;
	var total 	       = 0;
	var counterRow     = 1;
	$(document).on('click', '.btnAddToPedido', function(){
		var existecias = $(this).attr('data-existencias'),
			bookId     = $(this).attr('data-bookId'),
			val 	   = parseFloat($(this).attr('data-valor')),
			aux  	   = null;

		if(existecias > 0){
			alert("No se puede levantar el pedido, el libro existe actualmente.");
		}else{ 
			total += val;
			anticipoMin = (total * 0.5) * 1.16;
			aux = parseFloat(anticipoMin).toFixed(2);
			$('.anticipoTxt').html("<span style='font-size: 18px;'>Sub Total: $" + total.toFixed(2) + "<br />Total (+16%): $" + (total * 1.16).toFixed(2) + "<br />Anticipo Minimo: $" + aux + "</span>");
			if(counterRow < 5){
				$('.librosEnPedido').append("<p class='span3 thumbnail' style='height: 188px;'><img src='img/Libros/" + bookId + ".png' style='width: 50%; height: auto;' /><br />" + $(this).attr('data-name') + " - $" + val.toFixed(2) + "</p>");
				counterRow++;
			}else{
				$('.librosEnPedido').append("<p class='span3 thumbnail' style='margin-left: 0; height: 188px;'><img src='img/Libros/" + bookId + ".png' style='width: 50%; height: auto;' /><br />" + $(this).attr('data-name') + " - $" + val.toFixed(2) + "</p>");
				counterRow = 1;
			}

			pedidos.push(bookId);
		}
	});

	$('.btnAddPedido').click(function(){
		var proveedor = $('.provPedido').val();
		var clienteId = $('.idClientePedido').val().trim();
		var anticipo  = $('.anticipoPedido').val().trim();

		if(proveedor !== "0" && clienteId !== "" && anticipo !== ""){
			$('.control-provrPedido  a').css('outline', '1px solid #ccc');
			$('.idClientePedido').css('outline', '1px solid #ccc');
			$('.anticipoPedido').css('outline', '1px solid #ccc');

			if(typeof pedidos == 'undefined' || pedidos.length <= 0){
				alert("Por favor inserte libros para levantar pedido.");
			}else if(anticipo < anticipoMin){
				alert("Se requiere por lo menos el 50% para levantar el pedido.");
			}else{
				$.ajax({
					type: "POST",
					url: 'includes/php/insertPedido.php',
		            data: {
		                proveedor: proveedor,
		                clienteId: clienteId,
		                anticipo: anticipo,
		                total: (total * 1.16),
		                pedidos: pedidos
		            },
		            beforeSend: function(){
						$('<img src="img/loader.gif" class="loaderBox" />').insertAfter('.btnAddPedido');
		            },
		            success: function(data){
		            	try{
		            		$('.loaderBox').remove();
		            	}catch(e){}
		            	$('.idClientePedido').val("");
		            	$('.anticipoPedido').val("");
		            	$('.searchBookTxt').val("");
		            	$('.librosEnPedido').html("");

		            	$('.resPedido').html(data);

		            	pedidos.length = 0;

		            	setTimeout(function(){
		            		$('.resTipoTel').remove();
		            	}, 3000);
		            }
				});
			}

		}else{
			if(proveedor == "0"){
				$('.control-provrPedido  a').css('outline', '1px solid red');
			}else{
				$('.control-provrPedido  a').css('outline', '1px solid #ccc');
			}

			if(clienteId == ""){
				$('.idClientePedido').css('outline', '1px solid red');
			}else{
				$('.idClientePedido').css('outline', '1px solid #ccc');
			}

			if(anticipo == ""){
				$('.anticipoPedido').css('outline', '1px solid red');
			}else{
				$('.anticipoPedido').css('outline', '1px solid #ccc');
			}
		}

	});

	$('.btnClearPedido').click(function(){
		$('.idClientePedido').val("");
    	$('.anticipoPedido').val("");
    	$('.searchBookTxt').val("");
    	$('.librosEnPedido').html("");
    	$('.anticipoTxt').html("");
    	$('.resPedido').html("");

    	anticipoMin = 0;
		total 	    = 0;
		counterRow  = 1;

    	pedidos.length = 0;
	});

	//Ver mas de un pedido
	$(document).on('click', '.btnViewMorePedido', function(){
		var pedidoId = $(this).attr("data-pedidoId");

		$.ajax({
			type: "POST",
			url: 'includes/php/getPedidoInfo.php',
            data: {
                pedidoId: pedidoId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	$('.verMasPedidoModal').html(data);
            }
		});
	});

	//Eliminar un pedido
	$(document).on('click', '.btnDeletePedidoFirst', function(){
		$( ".btnDeletePedido" ).attr( "data-pedidoId", $(this).attr("data-pedidoId"));
	});

	$(document).on('click', '.btnDeletePedido', function(){
		var pedidoId = $(this).attr("data-pedidoId");

		$.ajax({
			type: "POST",
			url: 'includes/php/deletePedido.php',
            data: {
                pedidoId: pedidoId 
            },
            success: function(data){
            	try{
            		$('.loaderBox').remove();
            	}catch(e){}
            	
            	//Update table
            	$.ajax({
            		type: 'POST',
                    url: 'includes/php/updatePedidosTable.php',
                    beforeSend: function(){
                    	$('.tablePedidos').html('<img src="img/loader.gif" class="loaderBox" />');
                    },
                    success: function(data){
                    	$('.tablePedidos').html(data);
                    }
            	});
            }
		});
	});

	//Tutorial Admin
	$('.next').click(function(){
		$('.tut0').fadeOut(1000, function(){
			$('.tut').fadeIn(1000);
		});
	});

	$('.next1').click(function(){
		$('.tut').fadeOut(1000, function(){
			$('.tut').css("display", "none");
			$('.tut2').fadeIn(1000);
		});
	});

	$('.next2').click(function(){
		$('.tut2').fadeOut(1000, function(){
			$('.tut2').css("display", "none");
			$('.tut3').fadeIn(1000);
		});
	});

	$('.next3').click(function(){
		$('.tut3').fadeOut(1000, function(){
			$('.tut3').css("display", "none");
			$('.tut4').fadeIn(1000);
		});
	});

	$('.next4').click(function(){
		$('.tut4').fadeOut(1000, function(){
			$('.tut4').css("display", "none");
			$('.tut5').fadeIn(1000);
		});
	});

	$('.next5').click(function(){
		$('.tut5').fadeOut(1000, function(){
			$('.tut5').css("display", "none");
			$('.tut6').fadeIn(1000);
		});
	});

	$('.next6').click(function(){
		$('.tut6').fadeOut(1000, function(){
			$('.tut6').css("display", "none");
			$('.tut7').fadeIn(1000);
		});
	});

	$('.next7').click(function(){
		$('.tut7').fadeOut(1000, function(){
			$('.tut7').css("display", "none");
			$('.dropdown').addClass("open");
			$('.tut8').fadeIn(1000);
		});
	});

	$('.next8').click(function(){
		$('.tut8').fadeOut(1000, function(){			
			$('.dropdown').removeClass("open");

			$('.backdrop').fadeOut(1000);
			try{
				$('.tut0').fadeOut(1000);
			}catch(e){}

			//Update to not view tutorial
			$.ajax({
				type: "POST",
				url: 'includes/php/updateTutorial.php',
				success: function(data){
					console.log(data);
				}
			});
		});
	});

	//Tutorial Vendedor
	$('.next').click(function(){
		$('.tut0').fadeOut(1000, function(){
			$('.tutVen').fadeIn(1000);
		});
	});

	$('.nextVen').click(function(){
		$('.tutVen').fadeOut(1000, function(){
			$('.tutVen').css("display", "none");
			$('.tutVen2').fadeIn(1000);
		});
	});

	$('.nextVen2').click(function(){
		$('.tutVen2').fadeOut(1000, function(){
			$('.tutVen2').css("display", "none");
			$('.tutVen3').fadeIn(1000);
		});
	});

	$('.nextVen3').click(function(){
		$('.tutVen3').fadeOut(1000, function(){
			$('.tutVen3').css("display", "none");
			$('.tutVen4').fadeIn(1000);
		});
	});

	$('.nextVen4').click(function(){
		$('.tutVen4').fadeOut(1000, function(){
			$('.tutVen4').css("display", "none");
			$('.tutVen5').fadeIn(1000);
		});
	});

	$('.nextVen5').click(function(){
		$('.tutVen5').fadeOut(1000, function(){
			$('.tutVen5').css("display", "none");
			$('.dropdown').addClass("open");
			$('.tut8').fadeIn(1000);
		});
	});

	$('.skipTutorial').click(function(){
		$('.backdrop').fadeOut(1000);
		try{
			$('.tut0').fadeOut(1000);
		}catch(e){}

		//Update to not view tutorial
		$.ajax({
			type: "POST",
			url: 'includes/php/updateTutorial.php',
			success: function(data){
				//console.log(data);
			}
		});
	});

	//Add proveedor to libro
	$(document).on("click", ".addProveedorBtn", function(){
		var bookId 		= $(this).attr("data-bookId"),
			proveedorId = $('.proveedorBook').val();

		if(proveedorId == "0"){
			alert("Por favor seleccione un proveedor.");
		}else{
			$.ajax({
				type: "POST",
				url: 'includes/php/setProveedorBook.php',
				data: {
					bookId: bookId,
					proveedorId: proveedorId
				},
				beforeSend: function(){
					$('.loaderBoxOuter').html('<img src="img/loader.gif" class="loaderBox" />');
				},
				success: function(data){
					$('.loaderBoxOuter').html(data);
				}
			});
		}

	});


});