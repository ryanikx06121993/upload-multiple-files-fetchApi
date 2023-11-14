<?php

    // echo var_dump($_FILES);
    // echo json_encode($_SERVER);
   // echo var_dump($_POST);
   $dbHost     = "localhost";
   $dbUsername = "root";
   $dbPassword = "";
   $dbName     = "filesaple";
   
   // Create database connection
   $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
   
   // Check connection
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }



    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Count total files
        $countfiles = count($_FILES['file']['name']);
        $count = 0;
                 // Upload directory
                 $upload_location = "uploads/";
        for($i=0;$i < $countfiles;$i++){
                $filename = $_FILES['file']['name'][$i];
                $fullpath = $_FILES['file']['full_path'][$i];
                $type = $_FILES['file']['type'][$i];
                $tmpname = $_FILES['file']['tmp_name'][$i];
                $error = $_FILES['file']['error'][$i];
                $size = $_FILES['file']['size'][$i];
       
                   // File path
                $path = $upload_location.$filename;
                                // file extension
                $file_extension = pathinfo($path, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);

                // Valid file extensions
                $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");
    
                // Check extension
                if(in_array($file_extension,$valid_ext)){


                    $sql = $conn->prepare("INSERT INTO filedata (filename,file) VALUES (?, ?)");  
                    $sql->bind_param("ss", $_POST['filename'], $filename); 
                    if($sql->execute()) {

                        // Upload file
                        if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$path)){
                        $messages['status'] = TRUE;
                        $messages['response'] = "Successfully upload insert files";
                        }else {
                            $messages['status'] = FALSE;
                            $messages['response'] = "Error upload insert files";
                        } 
                    }else{
                        $messages['status'] = FALSE;
                        $messages['response'] = "Error inserting data";
                    }
                }else {
                    $messages['status'] = FALSE;
                    $messages['response'] = "Error file extension";
                }



        }

        echo json_encode($messages);

    }else {
        echo json_encode(array('error'=> 'Form not set'));
    }


?>