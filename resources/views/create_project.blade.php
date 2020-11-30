@extends('home')

@section('main_area')

<link href="{{ asset('css/createProject.css') }}" rel="stylesheet">
<?php
  $soureDir = "./Home1/uploads/media/";
  
  // Sort in descending order
  // $src_pdfFileArray = scandir($dir,1);
  $src_pdfFileArray = scandir($soureDir,0);
  $currentPdfPageIndex = 4;

  // print_r($a);
  // print_r($src_pdfFileArray);
  $currentPdfPageName=$src_pdfFileArray[2];
  // print_r($currentPdfPageName);
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
<div class="container">
   <nav class="navbar  nav-tabs navbar-expand-sm navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item  step">
                <a class="nav-link" href="#content">Content ></a>
            </li>
            <li class="nav-item step">
                <a class="nav-link" href="#geneator">Geneator ></a>
            </li>
            <li class="nav-item step">
                <a class="nav-link disabled" href="#pdf_preview">PDF Preview</a>
            </li>
        </ul>
    </nav>
  <!-- Tab panes -->
  <div class="tab-content">
    <div id="content" class="container tab-pane active"><br>
        <div style="width:100%;height:600px">
          <!-- One "tab" for each step in the form: -->
          <div class="tab">
              <h1>Content:</h1>
              <div id="trumbowyg-demo">
              </div>
          </div>
          <div class="tab">
              <h1>Geneator:</h1>
              <div class="row">
                <div class="col-sm-2 select_lable" >Select DATA</div>
                <div class="col-sm-9"> 
                  <p>
                    <input class="col-sm-10" placeholder="select data..." oninput="this.className = ''" name="selected_data" disabled id="selected_data">
                    <button type="button" class="btn btn-success btn-lg"name="select_data_btn"  data-toggle="modal" data-target="#data" >SELECT</button> 
                  </p>
                </div>
              </div>
              </br>
                
              <div class="row">
                <div class="col-sm-2 select_lable">Select FOLDER</div>
                <div class="col-sm-9"> 
                  <p>
                    <input class="col-sm-10" placeholder="select folder..." oninput="this.className = ''" name="selected_folder" disabled id="selected_folder">
                    <!-- <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">   -->
                    {{ csrf_field() }}
                        <button type="button" class="btn btn-success btn-lg"name="select_folder_btn"  data-toggle="modal" data-target="#folder" id="selected_btn_folder">SELECT</button> 
                        <!-- <input type="text" name="name" id = 'soureDir' value="<?php echo $soureDir;?>"> -->
                    <!-- </form> -->
                  </p>
                </div>
              </div>
                <!-- The Modal -->
                <div class="modal fade" id="data">
                  <div class="modal-dialog modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h1 class="modal-title">Select DATA</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                      </div>
                      <!-- navbar navbar-expand-md navbar-light bg-success shadow-sm -->
                      <!-- Modal body -->
                      <div class="modal-body modal-content" >
                          <div class="row">
                              <!-- Nav pills -->
                              <div class="col-sm-3 select_lable" style="text-align:left!important">
                                <ul class="nav nav-tabs flex-column">
                                  <li>HOME
                                      <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                          <a class="nav-link disabled" data-toggle="pill" href="#projects"><i class="fa fa-angle-right"></i> PROJECTS</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link disabled" data-toggle="pill" href="#images"><i class="fa fa-angle-right"></i> IMAGES</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link disabled" data-toggle="pill" href="#allPdf"><i class="fa fa-angle-right"></i> ALL PDF</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link disabled" data-toggle="pill" href="#allProject"><i class="fa fa-angle-right"></i> ALL PROJECT</a>
                                        </li>
                                        <li class="nav-item">
                                          <a class="nav-link active" data-toggle="pill" href="#datas_area" id='data_choose_btn'><i class="fa fa-angle-right"></i> DATA</a>
                                        </li>
                                      </ul>
                                    </li>
                                  </ul>
                                </div>
                              <!-- Tab panes -->
                              <div class="col-sm-9 select_lable" style="text-align:left!important">
                                <div class="tab-content">
                                  <div class="tab-pane container fade" id="projects">...projects
                                  </div>
                                  <div class="tab-pane container fade" id="images">..images.</div>
                                  <div class="tab-pane container fade" id="allPdf">..allPdf.</div>
                                  <div class="tab-pane container fade" id="allProject">..allProject.</div>
                                  <div class="tab-pane container active" id="datas_area">
                                        <table id="datas_table" class="display" width="100%"></table>
                                  </div>
                                </div>
                              </div>
                          </div>     
                      </div>
                      
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- The Modal -->
                <div class="modal fade" id="folder">
                  <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h1 class="modal-title">Select Folder</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                      </div>
                      
                      <!-- Modal body -->
                      <div class="modal-body">
                          <ul class="nav nav-tabs flex-column">
                            <li>HOME
                                <div class="well" id="folder_tree"></div>
                              </li>
                            </ul>
                      </div>
                      
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                      
                    </div>
                  </div>
                </div>
              <div class="text-center">
                  <button type="button" id = "generator" class="btn btn-success btn-lg disabled" data-toggle="modal" data-target="#pdfConvertModal" disabled onclick="">Generator</button>
              </div>
              <div class="modal fade" id="pdfConvertModal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <center>
                        <div class="modal-header" style="display: inline;">
                        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                           <h2 class="modal-title text-success" >PDF CONVERT</h2>
                        </div>
                        <div class="modal-body">
                            <h3 ><span class="text-success">DATA = </span> <span id='select_data_name_modal'></span></h3>
                            <h3 ><span class="text-success">FOLDER = </span> <span id='select_folder_dir_modal'></span></h3>
                            <div id="pdfConverting">
                                <h3 class="text-secondary">Please Wait</h3>
                                <div class="spinner-border text-secondary">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <input type='hidden' value='' id='dirInform'/>
                            <input type='hidden' value='' id='response_result'/>
                            <div id="pdfConvertFinished">
                                <h3 class="text-success">Finished</h3>
                                <button type="button" class="btn btn-success btn-lg" data-dismiss="modal" onclick="nextPrev(1)" id="viewPdfs">View PDFs</button>
                            </div>
                        </div>
                    </center>
                  </div>
                  
                </div>
              </div>
          </div>
          <div class="tab">
            <center><h2 class="text-success">PDF Preview</h2></center>
            <div class="row">
              <div class="col-sm-4" style="">
                <div class="" style="height: 50%;padding-top:30px;">
                  <h5 id ='' ><span class="text-success">DATA = </span><span id='select_data_name'></span></h5>
                  <h5 id =''><span class="text-success">FOLDER = </span><span id='select_folder_dir'></span></h5>
                </div>
                <div class="" style="height: 50%;">
                  <button type="button" class="btn btn-outline-info btn-lg" style="float:left" id="backPdfViewBtn" onclick="nextPdfFunc(-1)"><span><i class="fa fa-hand-o-left" style="font-size:25px"></i> BACK </span> </button>
                  <button type="button" class="btn btn-outline-info btn-lg" style="float:right" id="nextPdfViewBtn" onclick="nextPdfFunc(1)"><span>NEXT <i class="fa fa-hand-o-right" style="font-size:25px"></i></span> </button>
                </div>
              </div>
              <div class="col-sm-8" style="">
                <!-- <iframe src="./uploads/media/1.pdf"  width="100%" height="500px"> -->
                <iframe src="" id="pdfView" width="100%" height="500px">
                </iframe>
              </div>
            </div>
          </div>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button class="btn  btn-secondary btn-lg" id="prevBtn" onclick="nextPrev(-1)"><i class="fa fa-hand-o-left"></i> Previous</button>
                <button type="button" class="btn btn-success btn-lg" id="nextBtn" onclick="nextPrev(1)"><span>Next <i class="fa fa-hand-o-right"></i></span> </button>
            </div>
        </div>
    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />

<script>
  var choosedData = [];
  var dataUrlArray = JSON.parse(<?php echo json_encode($jsonDataInformDir);?>);
 
  $('#generator').on('click', function() {
      var requestDirInForm = "./TCPDFCustomize/ResourceData/" + dirInform +"/";
      var fileName = $('#selected_data').val();
      $.ajax({
          type:"POST",
          url: "{{ url('/pdfGenerate') }}",
          headers: {
				               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				           },
          data: {"fileName" : fileName},
          success:function(data){
            choosedData = data["jsonData"];
            pdfConvertFunc()
            // alert(choosedData[0]['Last name']);
          },  
        }).done(function() {
          $( this ).addClass( "done" );
      });
    })
  $('#viewPdfs').on('click', function() {
      $soureDir = "./Home1/uploads/media/";
      var requestDirInForm = "./TCPDFCustomize/ResourceData/" + dirInform +'/';
      var fileName = $('#selected_data').val();
      // alert("soureDir is" + requestDirInForm) ;
      $.ajax({
          type:"POST",
          url: "{{ url('/operating') }}",
          headers: {
				               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				           },
          data: {"soureDir" :requestDirInForm ,"fileName" : fileName},
          success:function(data){
            srcPdfFileArray = data['src_pdfFileArray'];
            // alert("srcPdfFileArray length:  " + srcPdfFileArray.length + "pageName is + " + srcPdfFileArray[2]);
            currentConvertPdfPagesGetFunc();
            // alert("CreatePage srpdffilearray length: " +srcPdfFileArray.length);

            currentPdfPageFind();
          },  
        }).done(function() {
          $( this ).addClass( "done" );
      });
    })
  
</script>
<script src="{{ asset('js/createProject/jsonData.js') }}" ></script>
<script src="{{ asset('js/createProject/createProjectFunctions.js') }}" ></script>
<script src="{{ asset('js/createProject/main.js') }}" ></script>
<script src="{{ asset('js/createProject/trumbowygSelf.js') }}" ></script>
<script src="{{ asset('js/createProject/selectFolder.js') }}" ></script>
<script src="{{ asset('js/createProject/pdfConvert.js') }}" ></script>
<script src="{{ asset('js/createProject/pdfPreview.js') }}" ></script>

@endsection
