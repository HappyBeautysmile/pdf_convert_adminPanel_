<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $data["page_flg"]="data";
        return view('data',$data);
    }
    public function xlsxuploadingToJson()
    {


        $target_dir = "TCPDFCustomize/ResourceData/DATA/2020/";
        // $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . 'upload.xlsx';
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Allow certain file formats
        if($imageFileType != "xlsx" ) {
            echo "Sorry, only xlsx is allowed.".'<br/>';
        $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        } else {
            // echo substr("Hello world",0,strlen("Hello world")-5)."<br>";
            $tmpName = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
            $fileName = substr($tmpName ,0, strlen($tmpName)-5);
            echo "File name is ". $tmpName .'<br/>';

            // $file = $request->file('file');
            // $file->move(base_path('\modo\images'), $file->getClientOriginalName());

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". "upload.xlsx". " has been uploaded.";
            } 
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        return response()->json('[{"a":"b"}]');
        // $str = '[{"a":"b"}]' ;
        // $data["page_flg"]="data";
        // return view('data',$data,$str);
    }
}
