
<?php

Abstract class Application_Form_Abstract extends Zend_Form 
{ 
	public $_decoratorName = array(	'Decorator', 
					'Callback', 
                                        'Captcha', 
                                        'Description', 
                                        'DtDdWrapper', 
                                        'Errors', 
                                        'Exception', 
                                        'Fieldset', 
                                        'File', 
                                        'Form', 
                                        'FormElements', 
                                        'FormErrors', 
                                        'HtmlTag', 
                                        'Image', 
                                        'Interface', 
                                        'Label', 
                                        'PrepareElement', 
                                        'Tooltip', 
                                        'ViewHelper', 
                                        'ViewScript' 
								); 

	/* Método Principal al que invocaremos para crear un elemento de formulario */
	protected function setInput($type, $name, $label='', $value=null, $filter=array(), $attr=null, $description=null, $mark=null, $markAttr=array(), $options=null, $noEscape=false) 
	{ 
		if (!isset($filter['required'])) $filter['required']=false; 
		
		//creamos el input 
		if ($type == 'captcha') 
		{ 
			$input = $this->createElement($type, $name, array('captcha' => 'Figlet')); 
		} else 
		{ 
			$input = $this->createElement($type, $name); 
		}
		 
		//Para que no meta los valores de elementos múltiples como array 
		if ($type == 'MultiCheckbox' || $type == 'Multiselect' || $type == 'Radio' || $type == 'Select') 
		{ 
			$input->setRegisterInArrayValidator(false); 
		} 

		//insertamos el label 
		if ($type != 'Image') 
		{ 
			$input->setLabel($label); 
		} 
		 
		//definimos el valor 
		if ($value!=null) 
		{ 
			if ($type == 'Image') 
			{ 
				$input->setImageValue($value); 
			} elseif ($type == 'hash') 
			{ 
				$input->setSalt($value); 
				$input->getValidator('Identical')->setMessage('Error al recibir el formulario, por favor, inténtelo de nuevo.'); 
			} else 
			{ 
				$input->setValue($value); 
			} 
		} 
		//definimos los filtros 
		$input->setRequired($filter['required']);//requerido true|false 
		if ($filter['required'] === true)
		{
			$mensNotEmpty = $this->genMessage('NotEmpty', $type);
			$input->addErrorMessage($mensNotEmpty["messages"]);
		}
		$input->addFilter('StripTags');//Elimina etiquetas html y xml 
		$input->addFilter('StringTrim');//Filtra caracteres 
		//Validadores Basicos 
		if (isset($filter['validator'])) 
		{ 
			foreach ($filter['validator'] as $validator) 
			{ 
				$message = $this->genMessage($validator, $type); 
				if (count($message) > 0) 
				{ 
					//el segundo parámetro indica:
					//false=muertra todos los errores, 
					//true=solo uno 
					$input->addValidator($validator, false, $message); 
				} else 
				{ 
					$input->addValidator($validator); 
				} 
			} 
		} 

		//Validador caracteres entre 
		if (isset($filter['StringLength'])) 
		{ 
			$message = $this->genMessage('StringLength', $type); 
			$input->addValidator(	'StringLength', 
					false, 
					array( 
							'min' => $filter['StringLength'][0], 
							'max' => $filter['StringLength'][1], 
							'messages' => $message['messages'] 
					) 
			); 
		}
		//Validador entre 
		if (isset($filter['Between'])) 
		{ 
			$message = $this->genMessage('Between', $type); 
			$input->addValidator(	'Between', 
									false, 
									array( 
											'min' => $filter['Between'][0], 
											'max' => $filter['Between'][1], 
											'messages' => $message['messages'] 
										) 
								); 
		} 

		//Validador más grande que 
		if (isset($filter['GreaterThan'])) 
		{ 
			$message = $this->genMessage('GreaterThan', $type); 
			$input->addValidator(	'GreaterThan', 
									false, 
									array( 
											'min' => $filter['GreaterThan'], 
											'messages' => $message['messages'] 
										) 
								); 
		} 

		//Validador más pequeño que 
		if (isset($filter['LessThan'])) 
		{ 
			$message = $this->genMessage('LessThan', $type); 
			$input->addValidator(	'LessThan', 
									false, 
									array( 
											'max' => $filter['LessThan'], 
											'messages' => $message['messages'] 
										) 
								); 
		} 
		 
		//insetamos los atributos 
		if (is_array($attr)) 
		{ 
			$input->setAttribs($attr); 
		} 
		
		//escribimos la descripcion 
		if ($description!=null) 
		{ 
			$input->setDescription($description); 
		} 
		
		//creamos los decoradores segun lo marcado 
		//borramos los decoradores si se trata de un campo oculto 
		if ($type=='Hidden') 
		{ 
			$input->removeDecorator('DtDdWrapper'); 
		} 
		
		//comprobamos como debemos tratar el label 
		if (isset($label[0]) && $label[0]=='<') 
		{ 
			$tlab=2;//RENDERIZA 
		} elseif (isset($label[0])) 
		{ 
			$tlab=1;//SETEA 
		} else 
		{ 
			$tlab=0;//IGNORA 
		} 
		
		//comprobamos como debemos tratar la descripcion 
		if (isset($description[0]) && $description[0]=='<') 
		{ 
			$tdec=2;//RENDERIZA 
		} elseif (isset($description[0])) 
		{ 
			$tdec=1;//SETEA 
		} else 
		{ 
			$tdec=0;//IGNORA 
		} 
		 
		//Por defecto Zend maqueta con dd dl si se quiere de esta forma no se setea los decoradores 
		if ($mark!='dl') 
		{ 
			$decorators=$this->genDecorator($mark, $markAttr, $tlab, $tdec, $type); 
			$input->setDecorators($decorators); 
		} 
		
		//insertar las opciones en caso de Select o Radio 
		if (is_array($options)) 
		{ 
			foreach ($options as $key => $value) 
			{ 
				$input->addMultiOption($key, $value); 
			} 
		} 
		
		if ($noEscape == true) 
		{ 
			$input->setAttrib("escape", false); 
		} 
		 
		return $input; 
	} 
	
	/* Método para designar los decoradores del formulario */
	protected function genDecorator($mark, $markAttr=array(), $tlab=0, $tdes=0, $type='') 
	{	 
		switch($mark) 
		{ 
			//Decoradores de tabla 
			case 'table': 
				//definimos los atributos por defecto 
				if ($tdes==2) 
				{ 
					$dattr['desc'] = array('escape' => false,'tag'=>'', 'class'=>'');
				} elseif ($tdes==1) 
				{ 
					$dattr['desc'] = array('mens' => false,'tag'=>'span', 'class'=>'mens');
				} 
				$dattr['span'] = array('tag' => 'span'); 
				$dattr['td'] = array('tag' => 'td', 'align'=>"left", 'valign'=>"top"); 
				if ($tlab==2) 
				{ 
					$dattr['label'] = array('escape' => false,'tag'=>'td', 'class'=>'');
				} elseif ($tlab==1) 
				{ 
					$dattr['label'] = array('tag' => 'td'); 
				} 
				$dattr['tr'] = array('tag' => 'tr'); 
				//insertamos los atributos especificados 
				if (is_array($markAttr)) 
				{ 
					foreach ($markAttr as $keyA => $valueA) 
					{ 
						if (is_array($valueA)) 
						{ 
							foreach ($valueA as $keyB => $valueB) 
							{ 
								if ($keyB == 'del') 
								{ 
									unset($dattr[$keyA]); 
								} else 
								{ 
									$dattr[$keyA][$keyB] = $valueB; 
								} 
							} 
						} 
					} 
				} 
				//creamos los decoradores 
				if ($type == 'File') 
				{ 
					$decorators[]='File'; 
			    	$decorators[]='Errors'; 
				} else 
				{ 
					$decorators[]='ViewHelper'; 
				    $decorators[]='Errors'; 
					$decorators[]='ViewHelper'; 
				} 
				if (isset($dattr['desc'])) 
				{ 
					$decorators[]=array('Description', $dattr['desc']); 
				} 
				if (isset($dattr['span'])) 
				{ 
				$decorators[]=array('decorator' => array('span' => 'HtmlTag'), 'options' => $dattr['span']); 
				} 
				if (isset($dattr['td'])) 
				{ 
					$decorators[]=array('decorator' => array('td' => 'HtmlTag'), 'options' => $dattr['td']); 
				} 
				if (isset($dattr['label'])) 
				{ 
					$decorators[]=array('Label', $dattr['label']); 
				} 
				if (isset($dattr['tr'])) 
				{ 
					$decorators[]=array('decorator' => array('tr' => 'HtmlTag'), 'options' => $dattr['tr'] ); 
				} 
				break; 
			
			//decoradores de párrafo 
			case 'p': 
				if ($tdes==2) 
				{ 
					$dattr['desc'] = array('escape' => false,'tag'=>'', 'class'=>'', 'placement'=>'Label'); 
				} elseif ($tdes==1) 
				{ 
					$dattr['desc'] = array('tag'=>'p', 'class'=>'mens', 'placement'=>'Label'); 
				} 
				if ($tlab==2) 
				{ 
					$dattr['label'] = array('escape' => false, 'tag'=>'span', 'class'=>'', 'placement'=>'Label');//RENDERIZA EL LABEL COMO HTML 
				} elseif ($tlab==1) 
				{ 
					$dattr['label'] = array('tag' => 'td'); 
				} 
				$dattr['p'] = array('tag' => 'p'); 
				//Para posicionar los elementos usar el parámetro placement 
				//'placement'=>'PREPPEND' antes del input y 'placement'=>'APPEND' despues del input 
				//insertamos los atributos especificados 
				if (is_array($markAttr)) 
				{ 
					foreach ($markAttr as $keyA => $valueA) 
					{ 
						if (is_array($valueA)) 
						{ 
							foreach ($valueA as $keyB => $valueB) 
							{ 
								if ($keyB == 'del') 
								{ 
									unset($dattr[$keyA]); 
								} else 
								{ 
									$dattr[$keyA][$keyB] = $valueB; 
								} 
							} 
						} 
					} 
				} 
				//creamos los decoradores 
				if ($type == 'File') 
				{ 
					$decorators[]='File'; 
			    	$decorators[]='Errors'; 
				} else 
				{ 
					$decorators[]='ViewHelper'; 
				    $decorators[]='Errors'; 
					$decorators[]='ViewHelper'; 
				} 
				if (isset($dattr['desc'])) 
				{ 
					$decorators[]=array('Description', $dattr['desc']); 
				} 
				if (isset($dattr['label'])) 
				{ 
					$decorators[]=array('Label', $dattr['label']); 
				} 
				if (isset($dattr['p'])) 
				{ 
			    	$decorators[]=array('decorator' => array('p' => 'HtmlTag'), 'options' => $dattr['p']); 
				} 
				break; 

			//decoradores de cabecera 3 
			case 'h3': 
				if ($tdes==2) 
				{ 
					$dattr['desc'] = array('escape' => false,'tag'=>'', 'class'=>'', 'placement'=>'Label'); 
				} elseif ($tdes==1) 
				{ 
					$dattr['desc'] = array('tag'=>'h3', 'placement'=>'Label'); 
				} 
				if ($tlab==2) 
				{ 
					$dattr['label'] = array('escape' => false, 'tag'=>'span', 'class'=>'', 'placement'=>'Label');//RENDERIZA EL LABEL COMO HTML 
				} elseif ($tlab==1) 
				{ 
					$dattr['label'] = array('tag' => 'td'); 
				} 
				
				//Para posicionar los elementos usar el parametro placement 
				//'placement'=>'PREPPEND' antes del input y 'placement'=>'APPEND' despues del input 
				//insertamos los atributos especificados 
				if (is_array($markAttr)) 
				{ 
					foreach ($markAttr as $keyA => $valueA) 
					{ 
						if (is_array($valueA)) 
						{ 
							foreach ($valueA as $keyB => $valueB) 
							{ 
								if ($keyB == 'del') 
								{ 
									unset($dattr[$keyA]); 
								} else 
								{ 
									$dattr[$keyA][$keyB] = $valueB; 
								} 
							} 
						} 
					} 
				} 
				//creamos los decoradores 
				if ($type == 'File') 
				{ 
					$decorators[]='File'; 
			    	$decorators[]='Errors'; 
				} else 
				{ 
					$decorators[]='ViewHelper'; 
				    $decorators[]='Errors'; 
					$decorators[]='ViewHelper'; 
				} 
				if (isset($dattr['desc'])) 
				{ 
					$decorators[]=array('Description', $dattr['desc']); 
				} 
				if (isset($dattr['label'])) 
				{ 
					$decorators[]=array('Label', $dattr['label']); 
				} 
			    
				break; 

			//resetear decoradores 
			case '': 
			case null: 
				//insertamos los atributos especificados 
				if (is_array($markAttr)) 
				{ 
					foreach ($markAttr as $keyA => $valueA) 
					{ 
						if (is_array($valueA)) 
						{ 
							foreach ($valueA as $keyB => $valueB) 
							{ 
								if ($keyB == 'del') 
								{ 
									if (isset($dattr[$keyA])) 
									{ 
										unset($dattr[$keyA]); 
									} 
								} else 
								{ 
									if (in_array(ucfirst($keyA), $this->_decoratorName)) 
									{ 
										$name = ucfirst($keyA); 
										$dattr[$name][$keyB] = $valueB; 
									} else 
									{ 
										$dattr['ViewHelper']=array($keyA => array($keyA => 'HtmlTag'), 'options' => $valueA); 
									} 
									 
								} 
							} 
						} 
					} 
				} 
				if ($type == 'File') 
				{ 
					$decorators[]='File'; 
				} else 
				{ 
					$decorators[]='ViewHelper'; 
				} 
		    	$decorators[]='Errors'; 
		    	 
		    	if (isset($dattr) && is_array($dattr)) 
		    	{ 
					foreach ($dattr as $key => $value) 
					{ 
						$decorators[]=array($key, $value); 
					} 
		    	} 
				break; 
			default: 
				$decorators=array(); 
				break; 
		} 

		return $decorators; 
	}

	/* Método para generar Mensajes personalizados según el Validador del Elemento de Formulario */

	protected function genMessage($validator, $type=null) 
	{ 
		//Lista de validadores mas importantes: 
		//Zend_Validate_Alnum (alnum), 
		//Zend_Validate_Alpha (alpha), 
		//Zend_Validate_Digits (digits), 
		//Zend_Validate_StringLength (stringLength), 
		//Zend_Validate_EmailAddress (emailAddress) , 
		//Zend_Validate_NotEmpty (notEmpty). 
		$message=array(); 
		switch ($validator) 
		{ 
			case 'NotEmpty': 
				if ($type == 'Select' || $type == 'Checkbox' || $type == 'MultiCheckbox' || $type == 'Multiselect' || $type == 'Radio') 
				{ 
					$message=array('messages'=>'debe seleccionar una opción.'); 
				} elseif ($type == 'File') 
				{ 
					$message=array('messages'=>'debe seleccionar un archivo.'); 
				} else 
				{ 
					$message=array('messages'=>'No puede estar vacio.'); 
				} 
				break; 
			case 'EmailAddress': 
				$message=array('messages'=> array( 
									Zend_Validate_EmailAddress::INVALID => 
										'"%value%" debe ser una dirección de email válida con formato basico usuario@hostname', 
									Zend_Validate_EmailAddress::INVALID_FORMAT => 
										'"%value%" debe ser una dirección de email válida con formato basico usuario@hostname', 
									Zend_Validate_EmailAddress::INVALID_HOSTNAME => 
										'"%hostname%" no es un nombre de host válido para la dirección de correo electrónico "%value%"', 
									Zend_Validate_EmailAddress::INVALID_MX_RECORD => 
										'"%hostname%" no parece tener un registro MX válido para la dirección de correo electrónico "%value%"', 
									Zend_Validate_EmailAddress::DOT_ATOM => 
										'"%localPart%" no corresponde con el formato de punto-atómico', 
									Zend_Validate_EmailAddress::QUOTED_STRING => 
										'"%localPart%" no corresponde al formato de cita de cadena', 
									Zend_Validate_EmailAddress::INVALID_LOCAL_PART => 
										'"%localPart%" no es una localización válida para el dirección de correo electrónico "%value%', 
									Zend_Validate_EmailAddress::LENGTH_EXCEEDED => 
										'"%value%" supera la longitud permitida')); 
				break; 
			case 'Digits': 
				$message=array('messages'=> array( 
									Zend_Validate_Digits::NOT_DIGITS => 
										'"%value%" debe ser un valor numérico.', 
									Zend_Validate_Digits::STRING_EMPTY => 
										'"%value%" es una cadena vacía')); 
				break; 
			case 'Alnum': 
				$message=array('messages'=> array( 
									Zend_Validate_Alnum::NOT_ALNUM => 
										'"%value%" debe ser un valor alfabético o numérico.', 
									Zend_Validate_Alnum::STRING_EMPTY => 
										'"%value%" es una cadena vacía')); 
				break; 
			case 'Alpha': 
				$message=array('messages'=> array( 
									Zend_Validate_Alpha::NOT_ALPHA => 
										'"%value%" debe ser un valor alfabético', 
									Zend_Validate_Alpha::STRING_EMPTY => 
										'"%value%" es una cadena vacía')); 
				break; 
			case 'Barcode': 
				$message=array('messages'=>'Los mensajes son lanzados por una subclase'); 
				break; 
			case 'Barcode_Ean13': 
				$message=array('messages'=> array( 
									Zend_Validate_Barcode_Ean13::INVALID => 
										'"%value%" no es un codigo de barras EAN-13 valido', 
									Zend_Validate_Barcode_Ean13::INVALID_LENGTH => 
										'"%value%" debería tener 13 caracteres', 
									Zend_Validate_Barcode_Ean13::NOT_NUMERIC => 
										'"%value%" debe contener sólo caracteres numéricos' 
									)); 
				break; 
			case 'Barcode_UpcA': 
				$message=array('messages'=> array( 
									Zend_Validate_Barcode_UpcA::INVALID => 
										'"%value%" no es un codigo de barras UPC-A valido', 
									Zend_Validate_Barcode_UpcA::INVALID_LENGTH => 
										'"%value%" debería tener 12 caracteres')); 
				break; 
			case 'Between': 
				$message=array('messages'=> array( 
									Zend_Validate_Between::NOT_BETWEEN => 
										'"%value%" no esta entre "%min%" y "%max%", ni es uno de ellos.' 
									, 
									Zend_Validate_Between::NOT_BETWEEN_STRICT => 
										'"%value%" no esta estrictamente entre "%min%" y "%max%"' 
									) 
								); 
				break; 
			case 'Ccnum': 
				$message=array('messages'=> array( 
									Zend_Validate_Ccnum::LENGTH => 
										'"%value%" debe tener entre 13 y 19 dígitos', 
									Zend_Validate_Ccnum::CHECKSUM => 
										'Algoritmo Luhn (mod-10 checksum) falló en "%value%"')); 
				break; 
			case 'Date': 
				$message=array('messages'=> array( 
									Zend_Validate_Date::FALSEFORMAT	=> 
										'"%value%" no se ajusta a formato de fecha dado', 
									Zend_Validate_Date::INVALID	=> 
										'"%value%" no es una fecha válida', 
									Zend_Validate_Date::NOT_YYYY_MM_DD => 
										'"%value%" no es del formato YYYY-MM-DD);')); 
				break; 
			case 'Db_Abstract': 
				$message=array('messages' => array( 
									Zend_Validate_Db_Abstract::ERROR_NO_RECORD_FOUND => 
										'No se encontraron registros que coincidan con "%value%"', 
									Zend_Validate_Db_Abstract::ERROR_RECORD_FOUND => 
										'Se encontó un registro que coinciden con "%value%"')); 
				break; 
			case 'File_Count': 
				$message=array('messages'=> array( 
									Zend_Validate_File_Count::TOO_MUCH => 
										'Demasiados archivos, se permite un maximo de "%max%", pero hay "%count%"', 
									Zend_Validate_File_Count::TOO_LESS => 
										'Pocos archivos, se permite un mínimo de "%min%", pero hay "%count%"')); 
				break; 
			case 'File_Crc32': 
				$message=array('messages' => array( 
									Zend_Validate_File_Crc32::DOES_NOT_MATCH => 
										'El archivo "%value%" no coincide con los dados CRC32 hash', 
									Zend_Validate_File_Crc32::NOT_DETECTED => 
										'No hay hash crc32 detectado para el archivo dado', 
									Zend_Validate_File_Crc32::NOT_FOUND => 
										'El archivo "%value%" no se pudo encontrar')); 
				break; 
			case 'File_ExcludeExtension': 
				$message=array('messages'=>array( 
									Zend_Validate_File_ExcludeExtension::FALSE_EXTENSION => 
										'El archivo "%value%" tiene una extensión falsa', 
									Zend_Validate_File_ExcludeExtension::NOT_FOUND => 
										'El archivo "%value%" no se ha encontrado')); 
				break; 
			case 'File_ExcludeMimeType': 
				$message=array('messages'=>array( 
									Zend_Validate_File_ExcludeMimeType::FALSE_TYPE => 
										'El archivo "%value%" tiene un tipo MIME falso de "%type%"', 
									Zend_Validate_File_ExcludeMimeType::NOT_DETECTED => 
										'El tipo MIME del archivo "%value%" no pudo ser detectado', 
									Zend_Validate_File_ExcludeMimeType::NOT_READABLE => 
										'El archivo "%value%" no se puede leer')); 
				break; 
			case 'File_Exists': 
				$message=array('messages'=>array( 
									Zend_Validate_File_Exists::DOES_NOT_EXIST => 
										'El archivo "%value%" no existe')); 
				break; 
			case 'File_Extension': 
				$message=array('messages'=>array( 
									Zend_Validate_File_Extension::FALSE_EXTENSION => 
										'El archivo "%value%" tiene una extensión falsa', 
									Zend_Validate_File_Extension::NOT_FOUND => 
										'El archivo "%value%" no se ha encontrado')); 
				break; 
			case 'File_FilesSize': 
				$message=array('messages'=> array( 
									Zend_Validate_File_FilesSize::TOO_BIG => 
										'La suma de todos los archivos debe tener un tamaño máximo de "%max%", pero se ha detectado "%size%"', 
									Zend_Validate_File_FilesSize::TOO_SMALL => 
										'La suma de todos los archivos debe tener un tamaño mínimo de "%min%", pero se ha detectado "%size%"', 
									Zend_Validate_File_FilesSize::NOT_READABLE => 
										'Uno o más archivos no se pueden leer')); 
				break; 
			case 'File_Hash': 
				$message=array('messages'=> array( 
									Zend_Validate_File_Hash::DOES_NOT_MATCH => 
										'El archivo "%value%" no coincide con los valores hash dados', 
									Zend_Validate_File_Hash::NOT_DETECTED => 
										'No se detectó Hash para el archivo dado', 
									Zend_Validate_File_Hash::NOT_FOUND => 
										'El archivo "%value%" no se pudo encontrar')); 
				break; 
			case 'File_ImageSize': 
				$message=array('messages'=>array( 
									Zend_Validate_File_ImageSize::WIDTH_TOO_BIG => 
										'Anchura máxima permitida para la imagen "%value%" debe ser "%maxwidth%" pero se ha detectado "%width%"', 
									Zend_Validate_File_ImageSize::WIDTH_TOO_SMALL => 
										'Anchura mínima permitida para la imagen "%value%" debe ser "%minwidth%" pero se ha detectado "%width%"', 
									Zend_Validate_File_ImageSize::HEIGHT_TOO_BIG => 
										'Altura máxima permitida para la imagen "%value%" debe ser "%maxheight%" pero se ha detectado "%height%"', 
									Zend_Validate_File_ImageSize::HEIGHT_TOO_SMALL => 
										'Altura mínima permitida para la imagen "%value%" debe ser "%minheight%" pero se ha detectado "%height%"', 
									Zend_Validate_File_ImageSize::NOT_DETECTED => 
										'El tamaño de la imagen "%value%" no se pudo detectar', 
									Zend_Validate_File_ImageSize::NOT_READABLE => 
										'La imagen "%value%" no se puede leer')); 
				break; 
			case 'File_IsCompressed': 
				$message=array('messages'=>array( 
									Zend_Validate_File_IsCompressed::FALSE_TYPE => 
										'El archivo "%value%" no esta comprimido, se detectó "%type%"', 
									Zend_Validate_File_IsCompressed::NOT_DETECTED => 
										'El tipo MIME del archivo "%value%" no pudo ser detectado', 
									Zend_Validate_File_IsCompressed::NOT_READABLE => 
										'El archivo "%value%" no se puede leer')); 
				break; 
			case 'File_IsImage': 
				$message=array('messages'=> array( 
									Zend_Validate_File_IsImage::FALSE_TYPE => 
										'El archivo "%value%" no es una imagen, se detectó "%type%"', 
									Zend_Validate_File_IsImage::NOT_DETECTED => 
										'El tipo MIME del archivo "%value%" no pudo ser detectado', 
									Zend_Validate_File_IsImage::NOT_READABLE => 
										'El archivo "%value%" no se puede leer')); 
				break; 
			case 'File_Md5': 
				$message=array('messages'=> array( 
									Zend_Validate_File_Md5::DOES_NOT_MATCH => 
										'El archivo "%value%" no coincide con los hashes md5 dados', 
									Zend_Validate_File_Md5::NOT_DETECTED => 
										'No se ha detectado hash md5 para el archivo dado', 
									Zend_Validate_File_Md5::NOT_FOUND => 
										'El archivo "%value%" no se pudo encontrar')); 
				break; 
			case 'File_MimeType': 
				$message=array('messages'=> array( 
									Zend_Validate_File_MimeType::FALSE_TYPE => 
										'El archivo "%value%" tiene un tipo MIME falso de "%type%"', 
									Zend_Validate_File_MimeType::NOT_DETECTED => 
										'El tipo MIME del archivo "%value%" no pudo ser detectado', 
									Zend_Validate_File_MimeType::NOT_READABLE => 
										'El archivo "%value%" no se pudo encontrar')); 
				break; 
			case 'File_NotExists': 
				$message=array('messages'=> array( 
									Zend_Validate_File_NotExists::DOES_EXIST => 
										'El fichero "%value%" no existe')); 
				break; 
			case 'File_Sha1': 
				$message=array('messages'=> array( 
									Zend_Validate_File_Sha1::DOES_NOT_MATCH => 
										'El archivo "%value%" no coincide con los valores hash SHA1 dados', 
									Zend_Validate_File_Sha1::NOT_DETECTED => 
										'No se ha detectado hash SHA1 del archivo dado', 
									Zend_Validate_File_Sha1::NOT_FOUND => 
										'El archivo "%value%" no se pudo encontrar')); 
				break; 
			case 'File_Size': 
				$message=array('messages'=> array( 
									Zend_Validate_File_Size::TOO_BIG => 
										'Tamaño máximo permitido para "%value%" archivo es "%max%" pero se detectó un tamaño de %size%', 
									Zend_Validate_File_Size::TOO_SMALL => 
										'Tamaño mínimo permitido para "%value%" archivo es "%min%" pero se detectó un tamaño de %size%', 
									Zend_Validate_File_Size::NOT_FOUND => 
										'El archivo "%value%" no se pudo encontrar')); 
				break; 
			case 'File_Upload': 
				$message=array('messages'=> array( 
									Zend_Validate_File_Upload::INI_SIZE => 
										'El archivo "%value%" excede el tamaño definido inicialmente', 
									Zend_Validate_File_Upload::FORM_SIZE => 
										'El archivo "%value%" excede el tamaño definido en el formulario', 
									Zend_Validate_File_Upload::PARTIAL => 
										'El archivo "%value%" fue subido sólo parcialmente', 
									Zend_Validate_File_Upload::NO_FILE => 
										'El archivo "%value%" no se ha subido', 
									Zend_Validate_File_Upload::NO_TMP_DIR => 
										'No se encontró el directorio temporal para el archivo "%value%"', 
									Zend_Validate_File_Upload::CANT_WRITE => 
										'El archivo "%value%" no se puede escribir', 
									Zend_Validate_File_Upload::EXTENSION => 
										'La extensión ha devuelto un error al cargar el archivo "%value%"', 
									Zend_Validate_File_Upload::ATTACK => 
										'El archivo "%value%" el archivo subido es ilegal, posible ataque', 
									Zend_Validate_File_Upload::FILE_NOT_FOUND => 
										'El archivo "%value%" no se ha encontrado', 
									Zend_Validate_File_Upload::UNKNOWN => 
										'Error desconocido al subir el archivo "%value%"')); 
				break; 
			case 'File_WordCount': 
				$message=array('messages'=> array( 
									Zend_Validate_File_WordCount::TOO_MUCH => 
										'Exceso de palabras, están permitido un máximo de "%max%" pero se contaron "%count%"', 
									Zend_Validate_File_WordCount::TOO_LESS => 
										'Pocas palabras, están permitido un mínimo de "%min%" pero se contaron "%count%"', 
									Zend_Validate_File_WordCount::NOT_FOUND => 
										'El archivo "%value%" no se ha encontrado')); 
				break; 
			case 'Float': 
				$message=array('messages'=> array( 
									Zend_Validate_Float::NOT_FLOAT => 
										'"%value%" no parece ser un número decimal')); 
				break; 
			case 'GreaterThan': 
				$message=array('messages'=> array( 
									Zend_Validate_GreaterThan::NOT_GREATER => 
										'"%value%" no es mayor que "%min%"')); 
				break; 
			case 'Hex': 
				$message=array('messages'=> array( 
									Zend_Validate_Hex::NOT_HEX => 
										'"%value%" no tiene sólo dígitos con carácteres hexadecimales')); 
				break; 
			case 'Hostname': 
				$message=array('messages'=> array( 
									Zend_Validate_Hostname::IP_ADDRESS_NOT_ALLOWED => 
										'"%value%" parece ser una dirección IP, pero las direcciones IP no estan permitidas', 
									Zend_Validate_Hostname::UNKNOWN_TLD => 
										'"%value%" parece ser un nombre de host DNS pero no se encuentra TLD en el listado conocido', 
									Zend_Validate_Hostname::INVALID_DASH => 
										'"%value%" parece ser un nombre de host DNS, pero contiene un guión (-) en una posición no válida', 
									Zend_Validate_Hostname::INVALID_HOSTNAME_SCHEMA => 
										'"%value%" parece ser un nombre de host DNS pero no se pudo comparar contra de esquema nombre de host para TLD "%tld%"', 
									Zend_Validate_Hostname::UNDECIPHERABLE_TLD => 
										'"%value%" parece ser un nombre de host DNS pero no puede extraer la parte TLD', 
									Zend_Validate_Hostname::INVALID_HOSTNAME => 
										'"%value%" no coincide con la estructura esperada para un nombre de host DNS', 
									Zend_Validate_Hostname::INVALID_LOCAL_NAME => 
										'"%value%" no parece ser un nombre válido de red local', 
									Zend_Validate_Hostname::LOCAL_NAME_NOT_ALLOWED => 
										'"%value%" parece ser un nombre de red local, pero los nombres de la red local no estan permitidos')); 
				break; 
			case 'Iban': 
				$message=array('messages'=> array( 
									Zend_Validate_Iban::NOTSUPPORTED => 
										'"%value%" no tiene IBAN', 
									Zend_Validate_Iban::FALSEFORMAT => 
										'"%value%" tiene un formato de falso', 
									Zend_Validate_Iban::CHECKFAILED => 
										'"%value%" no ha pasado la verificación IBAN')); 
				break; 
			case 'Identical': 
				$message=array('messages'=>array( 
									Zend_Validate_Identical::NOT_SAME => 
										'"%token%" no coincide con "%value%"', 
									Zend_Validate_Identical::MISSING_TOKEN => 
										'No se recivió la clave del formulario')); 
				break; 
			case 'InArray': 
				$message=array('messages'=> ARRAY( 
									Zend_Validate_InArray::NOT_IN_ARRAY => 
											'"%value%" no encontrado.')); 
				break; 
			case 'Int': 
				$message=array('messages'=> array( 
									Zend_Validate_Int::NOT_INT => 
										'"%value%" debe ser un valor entero.')); 
				break; 
			case 'Ip': 
				$message=array('messages'=> array( 
									Zend_Validate_Ip::NOT_IP_ADDRESS => 
										'"%value%" no parece ser una dirección IP válida')); 
				break; 
			case 'LessThan': 
				$message=array('messages'=> array( 
									Zend_Validate_LessThan::NOT_LESS => 
										'"%value%" no es menor que "%max%"')); 
				break; 
			case 'Regex': 
				$message=array('messages'=> array( 
									Zend_Validate_Regex::NOT_MATCH => 
										'"%value%" no coincide con el patrón "%pattern%"')); 
				break; 
			case 'StringLength': 
				$message=array('messages'=> array( 
									Zend_Validate_StringLength::TOO_SHORT => 
										'"%value%" es menor que "%min%" caracteres de largo', 
									Zend_Validate_StringLength::TOO_LONG => 
										'"%value%" es mayor que "%max%" caracteres de largo')); 
				break; 
			default: 
				$message=array(); 
				break; 
		} 
		return $message; 
	} 
}

