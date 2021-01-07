@extends('home')
@section('main_area')
<link href="{{ asset('css/selection.css') }}" rel="stylesheet">
<script>
function blink(ob)
{
if (ob.style.visibility == "visible" )
{
ob.style.visibility = "hidden";
}
else
{
ob.style.visibility = "visible";
}
}
setInterval("blink(fermer)",500);
</script>
<style>
.modal-roni{width:90%!important;padding:2rem!important}.modal-roni-button{width:100px!important}
#datas_table_filter{display: none !important; visibility: hidden !important;}
</style>
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
{{ csrf_field() }}
<div class="container">
	<nav class="navbar nav-tabs navbar-expand-sm navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item step"><a class="nav-link disabled text-body" href="#content">Content&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</a></li>
			<li class="nav-item step"><a class="nav-link disabled text-body" href="#geneator">Générateur&nbsp;&nbsp;&nbsp;&nbsp;>&nbsp;&nbsp;</a></li>
			<li class="nav-item step"><a class="nav-link disabled" href="#pdf_preview">Visualiser les PDF</a></li>
		</ul>
	</nav>
  <div class="tab-content">
    <div id="content" class="container tab-pane active">
        <div style="width:100%;height:700px">
          <div class="tab">
			<div id="trumbowyg-demo" class="trumbowyg"></div>
			<div style="position: sticky; bottom: 0; margin-top: 50px;"" class="text-right">
				<button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)"><span>Suivant <i class="fa fa-angle-double-right" aria-hidden="true"></i></span> </button>
			</div>
          </div>
          <div class="tab" style="height:650px">
			<div class="input-group mb-3" style="margin-top:20px;">
				<input type="text" class="form-control" placeholder="Séléctionnez une DATA" oninput="this.className = ''" name="selected_data" disabled id="selected_data">
				<div class="input-group-append">
					<button class="btn btn-primary" type="button" name="select_data_btn" data-toggle="modal" data-target="#data">Choisir</button>
				</div>
			</div>
			<div class="input-group mb-3" style="margin-top:20px;">
				<input type="text" class="form-control" placeholder="Séléctionnez un DOSSIER" oninput="this.className = ''" name="selected_folder" disabled id="selected_folder">
				<div class="input-group-append">
					<button class="btn btn-primary" type="button" name="select_folder_btn" data-toggle="modal" data-target="#folder" id="selected_btn_folder">Choisir</button>
				</div>
			</div>
			<!-- Modal DATA -->
			<div class="modal fade" id="data" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content modal-roni">
						<p class="h2 text-left" id="staticBackdropLabel">
							Sélectionner une DATA
						</p>
						<div class="tab-pane container active" id="datas_area">
							<div class="row" style="margin-top:20px; margin-bottom:8px;">
								<div class="col-md-6 mx-auto">
									<div class="input-group mb-3">
									  <div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
									  </div>
									  <input type="text" class="form-control" placeholder="Par nom de la data" id="dataNameSerachInput"aria-label="Search">
									</div>
								</div>
								<div class="col-md-6 mx-auto">
									<div class="input-group mb-3">
									  <div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></span>
									  </div>
									  <input type="text" class="form-control" placeholder="Par le nom de l'auteur" id="dataAuthorSerachInput"aria-label="Search">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 mx-auto"><table id="datas_table" class="display" width="100%"></table></div>
							</div>
						</div>
						<div style="margin-top:20px">
							<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal DOSSIER -->
			<div class="modal fade" id="folder">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content modal-roni">
						<p class="h3 text-left">
							Sélectionner un dossier
						</p>
						<div class="well" id="folder_tree"></div>
						<div style="margin-top:20px">
							<button type="button" class="btn btn-link float-right" data-dismiss="modal" aria-label="Close">Annuler</button>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center">
				<button type="button" id ="generator" class="btn btn-warning btn-lg disabled" data-toggle="modal" data-target="#pdfConvertModal" disabled onclick="">Générer les PDF</button>
            </div>
			<div style="position: sticky; bottom: 0; margin-top: 50px;"" class="text-right">
				<button class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i> Précedent </span></button>
			</div>
			<div class="modal fade" id="pdfConvertModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" role="dialog">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content modal-roni">
						<div id="pdfConverting" class="text-center">
							<p class="h2 text-center" id="staticBackdropLabel">
								Création des PDF en cours 
							</p>
							<div class="well text-left">
								<h5 class="card-title"><b>Data choisi :</b> <span id='select_data_name_modal'></span></h5>
								<h5 class="card-title"><b>Dossier choisi :</b> <span id='select_folder_dir_modal'></span></h5>
							</div>
							<div id="fermer" style="visibility: visible"><p class="card-text text-danger text-center"><b>@guest @else {{ Auth::user()-> name }}, @endguest veuillez ne pas fermer cette page</b></p></div>
							<br>
							<div class="text-center">
								<button class="btn btn-primary" type="button" disabled>
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									Veuillez patienter svp
								</button>
							</div>
						</div>
						<input type='hidden' value='' id='dirInform'/>
                        <input type='hidden' value='' id='response_result'/>
						<div id="pdfConvertFinished" class="text-center" style="display: none;">
							<p class="h2 text-center" id="staticBackdropLabel">C'est terminé </p>
							<div class="well text-left">
								<h5 class="card-title">En cliquant le bouton ci-dessous, vous pouvez voir les PDF générés.</h5>
							</div>
							<button type="button" class="btn btn-success" data-dismiss="modal" onclick="nextPrev(1)" id="viewPdfs">Visualiser les PDF</button>
						</div>
					</div>
				</div>
			</div>
          </div>
          <div class="tab">
			<div class="row" style="margin-top:20px">
				<div class="col-md-4 mx-auto">
					<button type="button" class="btn btn-outline-primary" style="float:left" id="backPdfViewBtn" onclick="nextPdfFunc(-1)"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i> Précedent </span></button>
					<button type="button" class="btn btn-outline-primary" style="float:right" id="nextPdfViewBtn" onclick="nextPdfFunc(1)"><span>Suivant <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></button>
					</button>
				</div>
			</div>
			<div class="row">
				<div class="col-md-10 mx-auto" style="margin:20px 0px">
					<iframe src="" id="pdfView" width="90%" height="750px" class="embed-responsive embed-responsive-21by9 border"></iframe>
				</div>
			</div>
          </div>
        </div>
    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
<script>
  var choosedData = [] ;
  var dataUrlArray = JSON.parse(<?php echo json_encode($jsonDataInformDir);?>);
  var jsonFolderDirInform = JSON.parse(<?php echo json_encode($jsonFolderDirInform);?>);
 
  $('#generator').on('click', function() {
    // alert("generator: " + dirInform);
      var requestDirInForm = "./TCPDFCustomize/" + dirInform +"/";
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
			pdfConvertFuncDivide(1);
          },  
        }).done(function() {
          $( this ).addClass( "done" );
      });
    })
  $('#viewPdfs').on('click', function() {
      $soureDir = "./Home1/uploads/media/";
      var requestDirInForm = "./TCPDFCustomize/" + dirInform +'/';
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
<!-- <script src="{{ asset('js/createProject/jsonData.js') }}" ></script> -->
<script src="{{ asset('js/createProject/createProjectFunctions.js') }}" ></script>
<script src="{{ asset('js/createProject/main.js') }}" ></script>
<script src="{{ asset('js/createProject/trumbowygSelf.js') }}" ></script>
<script src="{{ asset('js/createProject/selectFolder.js') }}" ></script>
<script src="{{ asset('js/createProject/pdfConvert.js') }}" rel="preload"></script>
<script src="{{ asset('js/createProject/pdfPreview.js') }}" ></script>
@endsection