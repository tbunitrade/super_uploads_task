<?php 

if ( isset( $_FILES['file']) )
{
    $file   =   $_FILES['file'];    

    //print_r($file);

    //исключения делаем exceptions
    $file_name  =   $file['name'];
    $file_tmp   =   $file['tmp_name'];
    $file_size  =   $file['size'];
    //addons
    $file_error =   $file['error'] ;

    // мои расширения файлов, file extensions 
    $file_ext   =   explode('.', $file_name); // similar in MVC when we looking for Class action
    $file_ext   =   strtolower(end($file_ext));// similar as UPPERCASE

    //print_r($file_ext);

    $allowed = array('txt','jpg');//what we can to load

    if ( in_array($file_ext, $allowed)) 
    {        
        if ($file_error === 0) {            
            if ($file_size <= 2097152 ) // bytes 2 mb 
            {
                $file_name_new = uniqid('', true) . '.' . $file_ext;
                //echo $file_name_new; //check that name created Well
                $file_destination = 'upload/' . $file_name_new;
                echo $file_destination; //

                //move uploaded file function
                //we send request

                if (move_uploaded_file($file_tmp, $file_destination)) {
                    echo $file_destination;
                    ?>
                        <script>
                            alert('Load Success.')
                        </script>
                    <?php
                }

            }

        }
    }
}

echo '<br>' . 'here out data';