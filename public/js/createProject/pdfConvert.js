    
// pdf converting begin **********************
    function pdfConvertFuncDivide(index){
        // console.log(choosedData);
        // alert("chooseData  " + choosedData[0]);
        document.getElementById("pdfConvertFinished").style.display = "none";
        document.getElementById("pdfConverting").style.display = "inline";
        $('#pdfConvertModal').modal({
            backdrop: false            
        });
        $(document).ready(function() {
            var trumbowygData = getTrumbowygContent();
            var htmldata = [] ,k = 0;
            var divideUsers = 100 ;
            // alert(choosedData[0]['Last name']);
            // console.log("choosedData.length  :" + choosedData);
            for(var i = 0 + (index-1) * divideUsers ; i < divideUsers * index; i++)
            // for(var i = 0 + (inde-1) * divideUsers ; i < choosedData.length; i++)
            {
                if(i == choosedData.length) break ;
                if(choosedData[i] == null) {continue ;}
                if(choosedData[i]["ID"]==null) 
                {
                    // console.log("convert:::" + i);
                    continue;
                }
                htmldata[k] = trumbowygData ;
                htmldata[k] = htmldata[k].replaceAll("{ID}", choosedData[i]["ID"]);
                htmldata[k] = htmldata[k].replaceAll("{Last name}", choosedData[i]["Last name"]);
                htmldata[k] = htmldata[k].replaceAll("{First name}", choosedData[i]["First name"]);
                htmldata[k] = htmldata[k].replaceAll("{City}", choosedData[i]["City"]);
                htmldata[k] = htmldata[k].replaceAll("{Telephone no}", choosedData[i]["Telephone no"]);
                htmldata[k] = htmldata[k].replaceAll("{E-mail}", choosedData[i]["E-mail"]);
                htmldata[k] = htmldata[k].replaceAll("{Birthday_date}", choosedData[i]["Birthday_date"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_01}", choosedData[i]["fields_01"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_02}", choosedData[i]["fields_02"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_03}", choosedData[i]["fields_03"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_04}", choosedData[i]["fields_04"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_05}", choosedData[i]["fields_05"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_06}", choosedData[i]["fields_06"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_07}", choosedData[i]["fields_07"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_08}", choosedData[i]["fields_08"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_09}", choosedData[i]["fields_09"]);
                htmldata[k] = htmldata[k].replaceAll("{fields_10}", choosedData[i]["fields_10"]);
                convertedPdfName[k] = choosedData[i]["ID"];
                k++;
            }
            var pdfValue = htmldata.length;
            // console.log('pdfValue   ' + pdfValue);
            dirInform="" ;
            // var dirInform = 'DATA/jsonData/';
            for(var i = 0 ; i < folder_dir.length ; i++)
            {
                dirInform += folder_dir[i];
                if(folder_dir.length != i + 1){
                dirInform +="/" ;
                $('#dirInform').val(dirInform);
                }
            }
            // alert("dirInform : " + dirInform);
            // var date = new Date;
        
            // var seconds = date.getSeconds();
            // var minutes = date.getMinutes();
            // var hour = date.getHours();
        
            // var year = date.getFullYear();
            // var month = date.getMonth(); // beware: January = 0; February = 1, etc.
            // var day = date.getDate();
            $.ajax({
                type:"POST",
                url: "TCPDFCustomize/examples/main.php",
                data: {"htmldata": htmldata,"convertedPdfName" : convertedPdfName ,"dirInform" :dirInform ,"pdfValue" : pdfValue}
                }).done(function() {
                $( this ).addClass( "done" );
                // alert("finished");
                // pdfConvertFinished();
            }).done(function() {
               if(index * divideUsers < choosedData.length)
               {
                    index++;
                    pdfConvertFuncDivide(index);
               }
               else{
                   setTimeout(pdfConvertFinished, 1000);
               }
            });
        });

    }
    function pdfConvertFinished() {
        document.getElementById("pdfConvertFinished").style.display = "inline";
        document.getElementById("pdfConverting").style.display = "none";
    }
    // pdf converting end *****************************