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
            // $str = "test";
            // echo($str{0});
            // require_once __DIR__."/phpexcel/Classes/PHPExcel.php";

            // print json data 
            // require_once __DIR__.'./Classes/PHPExcel.php';
            // require_once '../Classes/PHPExcel/IOFactory.php';
            require __DIR__.'/Classes/PHPExcel.php';
            $str ="sadfsd";
            echo $str[0];
            $tmpfname = "uploads/upload.xlsx";
            $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
            $excelObj = $excelReader->load($tmpfname);
            $worksheet = $excelObj->getSheet();//
            $lastRow = $worksheet->getHighestRow();
          
            $data = [];
            for ($row = 1; $row <= $lastRow; $row++) {
                $data[] = [
                    'A' => $worksheet->getCell('A'.$row)->getValue(),
                    'B' => $worksheet->getCell('B'.$row)->getValue(),
                    'C' => $worksheet->getCell('C'.$row)->getValue()
                ];
            }
          
            echo json_encode($data);
            $json_data = json_encode($data);
            file_put_contents("records.txt", $json_data);
          
            // Recovering
            $the_data = file_get_contents("records.txt");
            $the_array = json_decode($the_data);

            
        }
        $str = '[{"a":"b"}]' ;
        return response()->json('[{"a":"b"}]');
        // $data["page_flg"]="data";
        // return view('data',$data,$str);
    }
}
