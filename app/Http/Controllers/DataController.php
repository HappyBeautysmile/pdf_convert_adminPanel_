<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PHPExcel_IOFactory;

class DataController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $jsonDataInformDir = file_get_contents("./TCPDFCustomize/DATA/jsonDataInform.txt");
        $data["page_flg"]="data";
        $data["jsonDataInformDir"]= $jsonDataInformDir;
        return view('data',$data);
    }
    public function xlsxuploadingToJson()
    {
        $target_dir = "TCPDFCustomize/DATA/";
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
            $tmpfname = "./TCPDFCustomize/DATA/upload.xlsx";
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
            file_put_contents("./TCPDFCustomize/DATA/jsonData/".$fileName.".txt", $json_data);
          
            // Recovering
            // $the_data = file_get_contents("./TCPDFCustomize/DATA/jsonData/".$fileName.".txt");
            // $the_array = json_decode($the_data);
            // echo  $the_data;
            // echo  Auth::user()->name;
        }
        // $jsonDataSrcDir = "./TCPDFCustomize/DATA/jsonData/";
        // $src_jsonDataFileArray = scandir($jsonDataSrcDir,0);
        // var_dump($src_jsonDataFileArray);
        $jsonDataInformDir = file_get_contents("./TCPDFCustomize/DATA/jsonDataInform.txt");
        $jsonDataInform = json_decode($jsonDataInformDir);

        $fileExist = false ;
        $currentDay=date('y/m/d')." " .date("H:i", strtotime(date("h:i")));;
        $usersValue= $lastRow - 1;
        // echo "time is " .  $currentDay;
        // foreach ($jsonDataInform as $value) {
        //     if($value[0] == $fileName){
        //         $fileExist = true ;
        //     }
        // }
        for($i = 0; $i < sizeof($jsonDataInform) ;$i++)
        {
            if($jsonDataInform[$i][0] ==$fileName){
                $fileExist = true ;
                $jsonDataInform[$i][1] = $currentDay;
                $usersValue[$i][3] =$usersValue;
            }
        }
        if($fileExist == false)
        {
            array_push($jsonDataInform, array($fileName,$currentDay, Auth::user()->name ,$usersValue));
        }     
        $json_data = json_encode($jsonDataInform);
        file_put_contents("./TCPDFCustomize/DATA/jsonDataInform.txt", $json_data);

        $jsonDataInformDir = file_get_contents("./TCPDFCustomize/DATA/jsonDataInform.txt");
        $jsonDataInform = json_decode($jsonDataInformDir);
       
        // var_dump($jsonDataInform);
        return response()->json($jsonDataInformDir);
        // $data["page_flg"]="data";
        // return 'tested';
    }
}
