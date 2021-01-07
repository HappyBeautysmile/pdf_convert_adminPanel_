@extends('home')
@section('main_area')
<style>
.modal-roni{width:95%!important;padding:2rem!important}.modal-roni-button{width:100px!important}
</style>
<script>
  function getSourceFiles()
  {
    <?php
      $soureDir = "./Home1/uploads/media/";
      // Sort in descending order
      // $src_pdfFileArray = scandir($dir,1);
      $src_pdfFileArray = scandir($soureDir,0);
      $currentPdfPageIndex = 4;
      // print_r($a);
      $currentPdfPageName=$src_pdfFileArray[2];
      //convert php array to javascript array _____begin
      function js_str($s)
      {
          return '"' . addcslashes($s, "\0..\37\"\\") . '"';
      }

      function js_array($array)
      {
          $temp = array_map('js_str', $array);
          return '[' . implode(',', $temp) . ']';
      }
      //convert php array to javascript array _____end
      // echo 'var cities = ', js_array($src_pdfFileArray), ';';
      $src_pdfFile = "./Home1/uploads/media/".$currentPdfPageName;
    ?>
  }
</script>
<div class="container">
	<div class="col-md-9 mx-auto">
		<div class="input-group mb-3" style="margin-top:30px;">
			<input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Séléctionnez un dossier" oninput="this.className = ''" name="selected_folder" disabled id="selected_folder">
			<div class="input-group-prepend">
				<button class="btn btn-primary rounded-right" type="button" name="select_folder_btn" data-toggle="modal" data-target="#folder" id="viewPdfs">Choisir</button>
			</div>
		</div>
	</div>
	<div class="modal fade" id="folder" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-left">
			<div class="modal-content modal-roni">
				<p class="h3 text-left" id="staticBackdropLabel">
					Choisir un dossier
				</p>
				<div class="well" id="folder_tree"></div>
				<div style="margin-top:20px">
					<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top:40px;">
		<div class="col-md-4 mx-auto">
			<button type="button" class="btn btn-outline-primary" style="float:left" id="backPdfViewBtn" onclick="nextPdfFunc(-1)"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i> Précedent </span></button>
			<button type="button" class="btn btn-outline-primary" style="float:right" id="nextPdfViewBtn" onclick="nextPdfFunc(1)"><span>Suivant <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
			</button>
    </div>
		<div class="col-md-4 mx-auto">
      <div class="input-group mb-3" >
        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" placeholder="Please input pdf name"  name="inputPdfName"  id="inputPdfName">
        <div class="input-group-prepend">
          <button class="btn btn-primary rounded-right" type="button" name="select_pdfName_btn" onclick="searchPdfFunc()"  id="pdfName_btn">Search</button>
        </div>
      </div>
    </div>
    
	</div>
	<div class="row">
		<div class="col-md-10 mx-auto" style="margin:20px 0px">
			<iframe src="" id="pdfView" width="90%" height="777px" class="embed-responsive embed-responsive-21by9 border bg-white"></iframe>
		</div>
	</div>
</div>
<!-- <script src="{{ asset('js/createProject/jsonData.js') }}" ></script> -->
<script>
  var srcPdfFileArray = <?php echo js_array($src_pdfFileArray);?>;//convert php array to javascript array
  var jsonFolderDirInform = JSON.parse(<?php echo json_encode($jsonFolderDirInform);?>);
  var currentPdfPageIndex =2;
  var sourceDir ="./Home1/uploads/media";
  var folder_dir =["ok"];
  var convertedPdfName ="";
  var dirInform ="./Home/uploads/media";
  var currentFolder_dir = "";
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
    document.getElementById("pdfView").src=  currentFolder_dir  + srcPdfFileArray[currentPdfPageIndex];
  }
  function nextPdfFunc(index)
  {
    // console.log("currentPdfPageIndex :"  + currentPdfPageIndex);
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
        document.getElementById("pdfView").src=  currentFolder_dir  + srcPdfFileArray[currentPdfPageIndex];
        });
    }
  }
  function searchPdfFunc()
  {
    // console.log(srcPdfFileArray);
    var checkPdfId = -1;
    var  searchName="";
    $(document).ready(function() {
        searchName = $('#inputPdfName').val();
        console.log("searchPdfName :" + searchName);
        $("#pdfView").attr("src",currentFolder_dir  +searchName+".pdf");
      });
   
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
    // select folder tree event -begin-*******************
    $(document).ready(function() {
      $('#folder_tree')
        .on("changed.jstree", function (e, data) {
          if(data.selected.length) {
            if(data.instance.get_node(data.selected[0]).children.length ==0)
            {
              function getParent(tree, childNode, index)
              {
                var i, res;
                if (tree!="[object Object]" || !tree.children.length) {
                  return null;
                }
                for (var i = 0 ;i < tree.children.length; i++) {
                  if (tree.children[i].id == childNode) {
                    folder_dir[index++] = tree.name ;
                    folder_dir[index++] = tree.children[i].name ;
                    return tree;
                  }
                  if(tree.children[i].children != null && tree.children[i].children.length > 0){
                    folder_dir[index] = tree.name ;
                    res = getParent(tree.children[i], childNode, index + 1);
                    if (res) {
                      return res;
                    }
                  }
                }
                return null;
              }
              folder_dir=[];
              for(var i = 0 ; i < jsonFolderDirInform.length ; i++)
              {
                folder_dir[0] = jsonFolderDirInform[i].name;
                if(data.instance.get_node(data.selected[0]).id == jsonFolderDirInform[i].id)
                {
                  break;
                }
                if(jsonFolderDirInform[i].children !=null)
                {
                  getParent(jsonFolderDirInform[i] ,data.instance.get_node(data.selected[0]).id ,0);
                }
              }
              // alert(folder_dir);
              // $('#selected_data').val( table.row( this ).data()[0]);
              currentFolder_dir ="./TCPDFCustomize/"
              var txt_folder_dir=""
              for(var i = 0 ; i < folder_dir.length ; i++)
              {
                txt_folder_dir += folder_dir[i];
                if(folder_dir.length != i + 1){
                  txt_folder_dir +=" > " ;
                }
                currentFolder_dir = currentFolder_dir + folder_dir[i] + "/";
              }
              $('#selected_folder').val(txt_folder_dir);
            //   alert(folder_dir[0]);
              nextPdfFunc(currentPdfPageIndex);
              generatePossible();
              $('#folder').modal('hide');
              // alert(currentFolder_dir);
              $.ajax({
                  type:"POST",
                  url: "{{ url('/pdfInformArray') }}",
                  headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                  data: {"soureDir" :currentFolder_dir},
                  success:function(data){
                    srcPdfFileArray = [];
                    srcPdfFileArray[0]="",srcPdfFileArray[1]="";
                    inc = 2 ;
                    for(var i = 2 ; i < data.length ; i++)
                    {
                      if(data[i].search(".pdf") > 0)
                      {
                        srcPdfFileArray[inc++] = data[i];
                      }
                    }
                    currentPdfPageIndex = 2;
                    currentPdfPageFind();
                  },  
                }).done(function() {
                  $( this ).addClass( "done" );
              });
            }
          }
        })
        .jstree({
          'core' : {
          'data' : jsonFolderDirInform
        }
        });
    } );
    
</script>
</div>
@endsection