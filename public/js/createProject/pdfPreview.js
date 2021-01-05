function currentPdfPageFind(){
  // alert("files :   "+srcPdfFileArray.length + "currentPage:  " + currentPdfPageIndex +"page Name  " + srcPdfFileArray[currentPdfPageIndex]);
  if(srcPdfFileArray.length <= 3)
  {
      $("#nextPdfViewBtn").addClass("disabled");
      $("#nextPdfViewBtn").prop('disabled',true);
      $("#backPdfViewBtn").addClass('disabled');
      $("#backPdfViewBtn").prop('disabled',true);
  }
  else
  {
    $("#nextPdfViewBtn").removeClass("disabled");
    $("#nextPdfViewBtn").prop('disabled',false);
    $("#backPdfViewBtn").removeClass('disabled');
    $("#backPdfViewBtn").prop('disabled',false);
  }
  // alert("srcPdfFileArray length :" + srcPdfFileArray.length + " dirInform: " + dirInform + " currentPdfPageIndex: " + currentPdfPageIndex + "srcPdfFileArray :" + srcPdfFileArray[currentPdfPageIndex]);
  // alert(currentFolder_dir  + "sd as as "+ srcPdfFileArray[currentPdfPageIndex]);
  document.getElementById("pdfView").src=  currentFolder_dir + dirInform+'/' + srcPdfFileArray[currentPdfPageIndex];
}

  function nextPdfFunc(index)
  {
    // alert("nextStep" : currentPdfPageIndex + index) ;
    if(srcPdfFileArray.length > 3){
      $(document).ready(function() {
        if(currentPdfPageIndex + index + 1== srcPdfFileArray.length)
        {
          $("#nextPdfViewBtn").addClass("disabled");
          $("#nextPdfViewBtn").prop('disabled',true);
        
        }
        else if(currentPdfPageIndex < srcPdfFileArray.length)
        {
          $("#nextPdfViewBtn").removeClass("disabled");
          $("#nextPdfViewBtn").prop('disabled',false);
        }
        if(currentPdfPageIndex + index == 2)
        {
          $("#backPdfViewBtn").addClass('disabled');
          $("#backPdfViewBtn").prop('disabled',true);
        }
        else if(currentPdfPageIndex > 1)
        {
          $("#backPdfViewBtn").removeClass('disabled');
          $("#backPdfViewBtn").prop('disabled',false);
        }
        if(currentPdfPageIndex + index > 1  && currentPdfPageIndex + index < srcPdfFileArray.length){
          currentPdfPageIndex += index ;
        }
        // alert("here is" + currentFolder_dir  + srcPdfFileArray[currentPdfPageIndex])
        document.getElementById("pdfView").src=  currentFolder_dir + dirInform + '/' + srcPdfFileArray[currentPdfPageIndex];
        });
    }
  }

  function currentConvertPdfPagesGetFunc()
  {
    var tmpPdfFileArray=[] , inc = 2 ;
    tmpPdfFileArray[0]="";
    tmpPdfFileArray[1]=".";
    // alert("srcPdfFilearray  " + srcPdfFileArray.length + "srcPdfFileData0 :" + srcPdfFileArray[0] + "srcOdfFukeArray 0 type: " + typeof(srcPdfFileArray[0]));
    // alert("chooseData : " + choosedData[0]['ID'] + "chooseDataType : " + typeof(choosedData[0]['ID']));
    for(var i = 0 ; i < choosedData.length; i++)
    {
      for(var t = 0 ; t < srcPdfFileArray.length ; t++)
      {
        // console.log('erro' + choosedData[i]['ID']);
        if(choosedData[i]['ID'] == null) continue;
        var str = choosedData[i]['ID'].toString();
        if((srcPdfFileArray[t]).search(str) > -1 && srcPdfFileArray[t].length == str.length + 4)        
        {
          tmpPdfFileArray[inc++] =srcPdfFileArray[t];
          break ;
        }
      }
    }
    srcPdfFileArray = tmpPdfFileArray ;
    // alert("Func srpdffilearray length: " +srcPdfFileArray.length);
  }
