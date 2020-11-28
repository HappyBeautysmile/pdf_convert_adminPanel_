function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    if(n==1 || n == 2)
    {
      document.getElementById("nextBtn").style.display = "none";
      // alert($('#trumbowyg-demo').html());
  
    }
    if(n==0)
    {
      document.getElementById("nextBtn").style.display = "inline";
    }
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    fixStepIndicator(n)
  }
  
  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      // ... the form gets submitted:
      document.getElementById("regForm").submit();
      return false;
    }
    if(currentTab == 2 && n == 1) {
      changePdfPreview();
      // alert('now ' + dirInform);
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }
  
  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
  }
  
  function generatePossible()
  {
    $(document).ready(function() {
      if($('#selected_folder').val() !="" &&  $('#selected_data').val() !="")
      {
        $('#generator').removeClass('disabled');
        $( "#generator" ).prop( "disabled", false );
      }
      else{
        $('#generator').addClass('disabled');
        $( "#generator" ).prop( "disabled", true );

      }
      // alert($('#selected_folder').val());
    });
  }
