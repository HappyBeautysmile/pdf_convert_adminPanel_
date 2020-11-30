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
