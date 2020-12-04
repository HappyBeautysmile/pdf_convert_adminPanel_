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
</style>
<div class="container">
  <div class="row" style="margin-top:50px;">
    {{ csrf_field() }}
    <div class="col-sm-10"> 
      <div class="tab-content">
        <div class="tab-pane container active" id="datas_area">
          <div class="text-right" >
              <form method="POST" id="contact" name="13" class="form-horizontal wpc_contact" novalidate="novalidate" enctype="multipart/form-data">
                  <fieldset>
                      <div class="control-group">
                          <!-- File Upload --> 
                          {{ csrf_field() }}
                          <input class="input-file" id="fileInput" type="file" id="fileToUpload" value="Choose a file" name="fileToUpload">
                          <button class="btn btn-success" id="wpc_contact">Upload</button>
                      </div>
                  </fieldset>
              </form>           
            <!-- <form action=" {{URL::to('/xlsxuploadingToJson')}}" method="post" enctype="multipart/form-data">
              Select image to upload:
              {{ csrf_field() }}
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Upload xlsx" name="submit">
            </form> -->
          </div>
          <!-- Search form -->
          <div style="position:relative">
            <div style="width:250px; padding:0 10px;position:absolute ;right:0px ;z-index:10; background-color: white" >
              <form class="form-inline d-flex justify-content-center md-form form-sm active-pink active-pink-2 mt-2">
                <i class="fa fa-search" aria-hidden="true" style="color:#4dd0e1"></i>
                <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" id="dataAuthorSerachInput"
                  aria-label="Search" style="border: none ; border-bottom:2px solid #4dd0e1; ">
              </form>
            </div>
            <table id="datas_table" class="display" width="100%"></table>
          <div>
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
                { title: "Name data"},
                { title: "Create date" },
                { title: "Author" }
              ],
          } );
          var oTable = $('#datas_table').DataTable();   //pay attention to capital D, which is mandatory to retrieve "api" datatables' object, as @Lionel said
            $('#dataAuthorSerachInput').on( 'keyup', function () {
                oTable
                    .columns( 2 )
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
        });
        // alert(src_jsonDataFileArray); 
        
   });
//  xlsx file upload end
</script>
@endsection
