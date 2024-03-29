<?php
    /**
     * USE HELPERS
     */

    function base64_to_png($base64_string, $output_file) {
        // open the output file for writing

        $output_file = $output_file.'.png';
        
        $path = PATH_UPLOAD.DS.'signatures';

        if(! file_exists($path)){
            mkdir($path);
        }

        $ifp = fopen( $path.DS.$output_file, 'wb' ); 

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp ); 

        return $output_file; 
    }

    function get_upload_asset()
    {
        return BASE_DIR.DS.'public'.DS.'assets';
    }

    function get_upload_base()
    {
        return BASE_DIR.DS.'public'.DS.'uploads';
    }

    /**
     * @param fileName $_FILES global name
     * dir path
     * arguments accepts['keepName'] = 'if keep name is true then the originnal name will be saved'
     */
    function upload_multiple($fileName , $uploadPath = null , $arguments = [])
    {
        if(is_null($uploadPath))
            $uploadPath = get_upload_base();

        /**
         * Upload Process
         *  */
        $arrNames    = [];
        $arrNamesOld = [];
        $hasWarnings = [];

        /*CHECK IF FILE UPLOAD IS EMPTY*/

        if($_FILES[$fileName]['name'][0] == '')
        {
            return [
                'status' => 'failed' ,
                'result' => [
                    'arrNames' => [],
                    'arrNamesOld' => [],
                    'names' => '',
                    'namesold' => ''
                ]
            ];
        }

        foreach($_FILES[$fileName]['name'] as $name => $value)
        {
			$uploadedName = $_FILES[$fileName]['name'][$name];

			$file_ext = explode('.' , $uploadedName);

			$allowed_ext = array('jpeg' , 'jpg' , 'png' , 'bitmap','csv' , 'xls' ,'xlsx' , 'csv' ,'pdf','docx');


            $ext = strtolower($file_ext[1]);

			if(in_array($ext , $allowed_ext))
			{
				$new_name = md5(rand()).'.'.$ext;
				$sourcePath = $_FILES[$fileName]['tmp_name'][$name];
				$targetPath = $uploadPath.DS.$new_name;


				if(!file_exists($uploadPath)){
					mkdir($uploadPath);
				}

				if(move_uploaded_file($sourcePath, $targetPath)){

					array_push($arrNames, $new_name);
					array_push($arrNamesOld, $uploadedName);
				}
			}else{
				$hasWarnings[] = "file '{$uploadedName}' not been uploaded invalid extension '{$file_ext[1]}'";
			}
        }

        if(!empty($hasWarnings))
        {
            return [
                'status' => 'failed' ,
                'result' => [
                    'err' => $hasWarnings,
                    'images'  => $arrNamesOld
                ]
            ];
        }else {
            return [
                'status' => 'success' ,
                'result' => [
                    'arrNames'    => $arrNames,
                    'arrNamesOld' => $arrNamesOld,
                    'names'       => arr_to_str($arrNames),
                    'namesold'    => arr_to_str($arrNamesOld)
                ],
                'path' => $uploadPath
            ];
        }
    }

    function upload_empty($fileName)
    {
        if ($_FILES[$fileName]['size'] == 0)
            return true;
        return false;
    }

    function upload_image($filename , $uploadPath , $newFileName = null)
    {
        $uploaderImage = new UploaderImage();

        $uploaderImage->setImage($filename)
        ->setName($newFileName)
        ->setPath($uploadPath)
        ->upload();

        if(!empty($uploaderImage->getErrors()))
            return [
                'status' => 'failed' ,
                'result' => [
                    'err'  => $uploaderImage->getErrors(),
                    'name' => $uploaderImage->getName()
                ]
            ];

        $path = $uploaderImage->getPath();
        $name = $uploaderImage->getName();

        $fullPath = $path.DS.$name;
        return [
            'status' => 'success',
            'result' => [
                'name' => $uploaderImage->getName() ,
                'oldname' => $uploaderImage->getNameOld(),
                'extension' => $uploaderImage->getExtension(),
                'path'   => $uploaderImage->getPath(),
                'fullPath' => $fullPath
            ]
        ];
    }

    function upload_document($filename , $uploadPath)
    {

        $uploaderDocument = new UploaderDocument();

        $uploaderDocument->setDocument($filename)
        ->setPath($uploadPath)
        ->upload();

        if(!empty($uploaderDocument->getErrors()))
            return [
                'status' => 'failed' ,
                'result' => [
                    'err'  => $uploaderDocument->getErrors(),
                    'name' => $uploaderDocument->getName()
                ]
            ];

        return [
            'status' => 'success',
            'result' => [
                'name' => $uploaderDocument->getName() ,
                'oldname' => $uploaderDocument->getNameOld(),
                'extension' => $uploaderDocument->getExtension(),
                'path'   => $uploaderDocument->getPath()
            ]
        ];
    }