@extends('home')
@section('main_area')
<!-- <h1><?php echo gettype($jsonDataInformDir) ?></h1> -->
<?php
  function js_str($s)
  {
      return '"' . addcslashes($s, "\0..\37\"\\") . '"';
  }

  function js_array($array)
  {
      $temp = array_map('js_str', $array);
      return '[' . implode(',', $temp) . ']';
  }
  // echo 'var cities = ', js_array($jsonDataInformDir ), ';';
?>
<style>
.dataTables_wrapper .dataTables_filter {
      float: right;
      text-align: right;
      visibility: hidden;
  }
   .datas_table_length{
    float: right;
  }
.inputroni{height: auto;}  
</style>
<div class="container">
	<div class="row" style="margin-top:50px;">
		{{ csrf_field() }}
		<div class="col-md-12" style="position:relative">
			<div class="tab-content">
				<div class="tab-pane container active" id="datas_area">
					<form method="POST" id="contact" name="13" class="form-horizontal wpc_contact" novalidate="novalidate" enctype="multipart/form-data">
					  <fieldset>
						  <div class="control-group">
							  <!-- File Upload --> 
							  {{ csrf_field() }}
							<div class="row" >
								<div class="col-md-9 mx-auto">
									<div class="input-group mb-3 text-left" style="margin:10px 0px;">
									   <input class="form-control text-left inputroni"  type="file" id="fileToUpload" value="Choose a file" name="fileToUpload">
									   <div class="input-group-prepend">
										<button class="btn btn-primary rounded-right" id="wpc_contact"><i class="fa fa-download" aria-hidden="true"></i> Télécharger</button>
									  </div>
									</div>
								</div>
							</div>
						  </div>
					  </fieldset>
					</form> 
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
			</div>
		</div>
	</div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />
<script>
  
    var dataUrlArray = JSON.parse(<?php echo json_encode($jsonDataInformDir);?>);
    
    function datatUrlPrint(srcData){
      // alert(srcData.length);
      $(document).ready(function() {
        var dataTable= $('#datas_table').DataTable( {
              data: srcData,
              paging: false,
              destroy: true,
              paging: true,
              // searching : true,
              columns: [
                { title: "Nom de la Data"},
                { title: "Date de la création"},
                { title: "Auteur"},
                { title: "Users"}
              ],
          } );
          
          var oTable = $('#datas_table').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
            $('#dataAuthorSerachInput').on( 'keyup', function () {
                oTable
                    .columns( 2 )
                    .search( this.value )
                    .draw();
            } );
            $('#dataNameSerachInput').on( 'keyup', function () {
                oTable
                    .columns( 0 )
                    .search( this.value )
                    .draw();
            } );
      } );

  }
  datatUrlPrint(dataUrlArray);
    // table data end------------------
        //     url: "{{ url('/xlsxuploadingToJson') }}",

//  xlsx file upload begin
  var form = $('form')[0]; // You need to use standard javascript object here
  var formData = new FormData(form);
  var formData = new FormData();
  var src_jsonDataFileArray = [];
    $('.wpc_contact').submit(function(event){
       event.preventDefault();
        formData.append('fileToUpload', $('input[type=file]')[0].files[0]); 
        console.log( $('input[type=file]')[0].files[0]);
        $.ajax({

            url: "{{ url('/xlsxuploadingToJson') }}",
            headers: {
				               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
            enctype: 'multipart/form-data',
            data: formData,
            type: 'POST',
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            success : function(data){
              var contact = JSON.parse(data);  
              dataUrlArray = contact;
              datatUrlPrint(dataUrlArray);
            },
            error : function(data){
              console.log("error" , data); 
            }
        }).done(function() {
            // alert("yes");
            $('#fileToUpload').val("");
      });;
        // alert(src_jsonDataFileArray); 
        
   });
//  xlsx file upload end
</script>
@endsection