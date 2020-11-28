function currentPdfPageFind(){
    for(var i = 2 ; i < srcPdfFileArray.length ; i++)
    {
      if(srcPdfFileArray[i] == convertedPdfName )
      {
        currentPdfPageIndex = i ;
        break ;
      }
    }
    alert("files :   "+srcPdfFileArray.length + "currentPage:  " + currentPdfPageIndex);
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
  }

  function changePdfPreview(){
    document.getElementById("pdfView").src="./TCPDFCustomize/ResourceData/" + dirInform + "/" + convertedPdfName +'.pdf';
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
        document.getElementById("pdfView").src= "./TCPDFCustomize/ResourceData/" + dirInform + "/" + srcPdfFileArray[currentPdfPageIndex];
        });

    }
  }