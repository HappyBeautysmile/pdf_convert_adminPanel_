<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PHPExcel_IOFactory;

class DataController extends Controller
{
    public function index()
    {

        $jsonDataInformDir = file_get_contents("./TCPDFCustomize/ResourceData/DATA/2020/Janvier/jsonDataInform.txt");
        $data["page_flg"]="data";
        $data["jsonDataInformDir"]= $jsonDataInformDir;
        return view('data',$data);
    }
    public function xlsxuploadingToJson()
    {
        $target_dir = "TCPDFCustomize/ResourceData/DATA/2020/";
        $target_file = $target_dir . 'upload.xlsx';
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "xlsx" ) {
            // echo "Sorry, only xlsx is allowed.".'<br/>';
        $uploadOk = 0;
        }
        if ($uploadOk == 0) {
        // echo "Sorry, your file was not uploaded.";
        } else {
            $tmpName = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
            $fileName = substr($tmpName ,0, strlen($tmpName)-5);
            // echo "File name is ". $tmpName .'<br/>';
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // echo "The file ". "upload.xlsx". " has been uploaded.";
            } 
            else {
                // echo "Sorry, there was an error uploading your file.";
            }
            require realpath(__DIR__.'/Classes/PHPExcel.php');
            $tmpfname = "./TCPDFCustomize/ResourceData/DATA/2020/upload.xlsx";
            $excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
            $excelObj = $excelReader->load($tmpfname);
            $worksheet = $excelObj->getSheet();//
            $lastRow = $worksheet->getHighestRow();
          
            $data = [];
            for ($row = 2; $row <= $lastRow; $row++) {
                $data[] = [
                    'ID' => $worksheet->getCell('A'.$row)->getValue(),
                    'Last name' => $worksheet->getCell('B'.$row)->getValue(),
                    'First name' => $worksheet->getCell('C'.$row)->getValue(),
                    'City' => $worksheet->getCell('D'.$row)->getValue(),
                    'Telephone no' => $worksheet->getCell('E'.$row)->getValue(),
                    'E-mail' => $worksheet->getCell('F'.$row)->getValue(),
                    'Birthday_date' => $worksheet->getCell('G'.$row)->getValue(),
                    'fields_01' => $worksheet->getCell('H'.$row)->getValue(),
                    'fields_02' => $worksheet->getCell('I'.$row)->getValue(),
                    'fields_03' => $worksheet->getCell('J'.$row)->getValue(),
                    'fields_04' => $worksheet->getCell('K'.$row)->getValue(),
                    'fields_05' => $worksheet->getCell('L'.$row)->getValue(),
                    'fields_06' => $worksheet->getCell('M'.$row)->getValue(),
                    'fields_07' => $worksheet->getCell('N'.$row)->getValue(),
                    'fields_08' => $worksheet->getCell('O'.$row)->getValue(),
                    'fields_09' => $worksheet->getCell('P'.$row)->getValue(),
                    'fields_10' => $worksheet->getCell('Q'.$row)->getValue()
                ];
            }
            $json_data = json_encode($data);
            file_put_contents("./TCPDFCustomize/ResourceData/DATA/2020/Janvier/".$fileName.".txt", $json_data);
          
            // Recovering
            // $the_data = file_get_contents("./TCPDFCustomize/ResourceData/DATA/2020/Janvier/".$fileName.".txt");
            // $the_array = json_decode($the_data);
            // echo  $the_data;
            // echo  Auth::user()->name;
        }
        // $jsonDataSrcDir = "./TCPDFCustomize/ResourceData/DATA/2020/Janvier/";
        // $src_jsonDataFileArray = scandir($jsonDataSrcDir,0);
        // var_dump($src_jsonDataFileArray);
        $jsonDataInformDir = file_get_contents("./TCPDFCustomize/ResourceData/DATA/2020/Janvier/jsonDataInform.txt");
        $jsonDataInform = json_decode($jsonDataInformDir);
        $fileExist = false ;
        foreach ($jsonDataInform as $value) {
            if($value[0] == $fileName){
                $fileExist = true ;
            }
        }
        if($fileExist == false)
        {
            array_push($jsonDataInform, array($fileName,'2020/11/2', Auth::user()->name));
            $json_data = json_encode($jsonDataInform);
            file_put_contents("./TCPDFCustomize/ResourceData/DATA/2020/Janvier/jsonDataInform.txt", $json_data);
        }     
        $jsonDataInformDir = file_get_contents("./TCPDFCustomize/ResourceData/DATA/2020/Janvier/jsonDataInform.txt");
        $jsonDataInform = json_decode($jsonDataInformDir);
       

        // var_dump($jsonDataInform);
        return response()->json($jsonDataInformDir);
        // $data["page_flg"]="data";
        // return 'tested';
    }
}
