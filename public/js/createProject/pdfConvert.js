    // pdf converting begin **********************
    function pdfConvertFunc(){
        $('#pdfConvertModal').modal({
            backdrop: false            
        });
        $(document).ready(function() {
        var htmldata = getTrumbowygContent();
        var ID = '1';
        var Last_name ='Egor';
        var First_name ='Cotta';
        var City = 'krasnodar';
        var Telephone_no ='112-121-12111';
        var E_mail = 'vitaliy.gmail.com';
        var Birthday_date ="1986.12.2";
        var fields_01 ='This is static';
        var fields_02 ='But if I complete data page,we can get dynamic value ';
        var fields_03 ="Don't worry about it";
        var fields_04 ='Thank you.';
        var fields_05 ='I am very tired!';
        var fields_06 ='I am working very hard without sleeping.';
        var fields_07 ='So I am very tired';
        var fields_08 ='please give me strong!';
        var fields_09 ='How about do you think?';
        var fields_10 ='Are you okay?';
        var htmldata = htmldata.replace("{ID}", ID);
        var htmldata = htmldata.replace("{Last name}", Last_name);
        var htmldata = htmldata.replace("{First name}", First_name);
        var htmldata = htmldata.replace("{City}", City);
        var htmldata = htmldata.replace("{Telephone no}", Telephone_no);
        var htmldata = htmldata.replace("{E-mail}", E_mail);
        var htmldata = htmldata.replace("{Birthday_date}", Birthday_date);
        var htmldata = htmldata.replace("{fields_01}", fields_01);
        var htmldata = htmldata.replace("{fields_02}", fields_02);
        var htmldata = htmldata.replace("{fields_03}", fields_03);
        var htmldata = htmldata.replace("{fields_04}", fields_04);
        var htmldata = htmldata.replace("{fields_05}", fields_05);
        var htmldata = htmldata.replace("{fields_06}", fields_06);
        var htmldata = htmldata.replace("{fields_07}", fields_07);
        var htmldata = htmldata.replace("{fields_08}", fields_08);
        var htmldata = htmldata.replace("{fields_09}", fields_09);
        var htmldata = htmldata.replace("{fields_10}", fields_10);
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
        var date = new Date;
    
        var seconds = date.getSeconds();
        var minutes = date.getMinutes();
        var hour = date.getHours();
    
        var year = date.getFullYear();
        var month = date.getMonth(); // beware: January = 0; February = 1, etc.
        var day = date.getDate();
        convertedPdfName =year +'_' + month + '_' + day +'_' +   hour + '_' + minutes + '_' + seconds;
        $.ajax({
            type:"POST",
            url: "TCPDFCustomize/examples/main.php",
            data: {"htmldata": htmldata,"convertedPdfName" : convertedPdfName ,"dirInform" :dirInform}
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