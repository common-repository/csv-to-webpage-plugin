<?php
namespace csvpearlbells;
class func {
    
     public function __construct() {
         
     }
     public function uploadFile() {
            $allowedExts = array("csv");
            $dir = plugin_dir_path( __FILE__ );
          
            $temp = explode(".", $_FILES["uploadedfile"]["name"]);
            $extension = end($temp);
            $mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
           
            if (in_array($_FILES['uploadedfile']['type'],$mimes )
            && ($_FILES["uploadedfile"]["size"] < 2000000)
            && in_array($extension, $allowedExts))
              {
              if ($_FILES["uploadedfile"]["error"] > 0)
                {
                echo "Return Code: " . $_FILES["uploadedfile"]["error"] . "<br>";
                }
              else
                {
               
                if (file_exists("../upload/" . $_FILES["uploadedfile"]["name"]))
                  {
                  echo $_FILES["uploadedfile"]["name"] . " already exists. ";
                  }
                else
                  {
                  move_uploaded_file($_FILES["uploadedfile"]["tmp_name"],$dir."../upload/".$_FILES["uploadedfile"]["name"]);
                  echo "Stored in: " . "upload/" . $_FILES["uploadedfile"]["name"];
                  }
                }
              }
            else
              {
              echo "Invalid file";
              }  
        }
        
    
}
?>
