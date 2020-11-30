    // pdf converting begin **********************
    function pdfConvertFunc(){
        console.log(choosedData[0]);
        // alert("chooseData  " + choosedData[0]);

        $('#pdfConvertModal').modal({
            backdrop: false            
        });
        $(document).ready(function() {
            var trumbowygData = getTrumbowygContent();
            var htmldata = [];
            // alert(choosedData[0]['Last name']);
            for(var i = 0 ; i < choosedData.length; i++)
            {
                htmldata[i] = trumbowygData ;
                htmldata[i] = htmldata[i].replace("{ID}", choosedData[i]["ID"]);
                htmldata[i] = htmldata[i].replace("{Last name}", choosedData[i]["Last name"]);
                htmldata[i] = htmldata[i].replace("{First name}", choosedData[i]["First name"]);
                htmldata[i] = htmldata[i].replace("{City}", choosedData[i]["City"]);
                htmldata[i] = htmldata[i].replace("{Telephone no}", choosedData[i]["Telephone no"]);
                htmldata[i] = htmldata[i].replace("{E-mail}", choosedData[i]["E-mail"]);
                htmldata[i] = htmldata[i].replace("{Birthday_date}", choosedData[i]["Birthday_date"]);
                htmldata[i] = htmldata[i].replace("{fields_01}", choosedData[i]["fields_01"]);
                htmldata[i] = htmldata[i].replace("{fields_02}", choosedData[i]["fields_02"]);
                htmldata[i] = htmldata[i].replace("{fields_03}", choosedData[i]["fields_03"]);
                htmldata[i] = htmldata[i].replace("{fields_04}", choosedData[i]["fields_04"]);
                htmldata[i] = htmldata[i].replace("{fields_05}", choosedData[i]["fields_05"]);
                htmldata[i] = htmldata[i].replace("{fields_06}", choosedData[i]["fields_06"]);
                htmldata[i] = htmldata[i].replace("{fields_07}", choosedData[i]["fields_07"]);
                htmldata[i] = htmldata[i].replace("{fields_08}", choosedData[i]["fields_08"]);
                htmldata[i] = htmldata[i].replace("{fields_09}", choosedData[i]["fields_09"]);
                htmldata[i] = htmldata[i].replace("{fields_10}", choosedData[i]["fields_10"]);
                convertedPdfName[i] = choosedData[i]["ID"];

            }
            var pdfValue = htmldata.length;
            dirInform="" ;
            // var dirInform = 'DATA/2020/Janvier';
            for(var i = 0 ; i < folder_dir.length ; i++)
            {
                dirInform += folder_dir[i];
                if(folder_dir.length != i + 1){
                dirInform +="/" ;
                $('#dirInform').val(dirInform);
                }
            }
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
            });
        });
        document.getElementById("pdfConvertFinished").style.display = "none";
        document.getElementById("pdfConverting").style.display = "inline";
        setTimeout(pdfConvertFinished, 1000);
    }
    function pdfConvertFinished() {
        document.getElementById("pdfConvertFinished").style.display = "inline";
        document.getElementById("pdfConverting").style.display = "none";
    }
    // pdf converting end *****************************