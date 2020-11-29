@extends('home')

@section('main_area')
<div class="container">
  <div class="row" style="margin-top:50px;">
    <div class="col-sm-3" style="border:2px solid gray;border-radius:5px; overflow: scroll; height:500px;">
      <ul class="nav nav-tabs flex-column">
        <li>HOME
          <div class="well" id="folder_tree" ></div>
        </li>
      </ul>
    </div>
    {{ csrf_field() }}
    <div class="col-sm-8"> 
      <div class="tab-content">
        <div class="tab-pane container active" id="datas_area">
          <div class="text-right" >
              <form method="POST" id="contact" name="13" class="form-horizontal wpc_contact" novalidate="novalidate" enctype="multipart/form-data">
                  <fieldset>
                      <div class="control-group">
                          <!-- File Upload --> 
                          {{ csrf_field() }}
                          <input class="input-file" id="fileInput" type="file" id="fileToUpload" name="fileToUpload">
                          <button class="btn btn-success" id="wpc_contact">Button</button>
                      </div>
                  </fieldset>
              </form>           
            <form action=" {{URL::to('/xlsxuploadingToJson')}}" method="post" enctype="multipart/form-data">
              Select image to upload:
              {{ csrf_field() }}
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Upload xlsx" name="submit">
            </form>
          </div>
          <table id="datas_table" class="display" width="100%"></table>
        </div>
      </div>
    </div>
  </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />

<script>
  var jsonTreeData =
    [
        {"id":"100","name":"PROJECTS","text":"PROJECTS","parent_id":"0",  "state" : { "disabled" : true } ,   "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"200","name":"IMAGES","text":"IMAGES","parent_id":"0",   "state" : { "disabled" : true } ,  "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"300","name":"ALL PDF","text":"ALL PDF","parent_id":"0",  "state" : { "disabled" : true }  ,  "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"00","name":"ALL PDF","text":"ALL PROJECT","parent_id":"0", "state" : { "disabled" : true } ,   "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"1","name":"DATA","text":"DATA","parent_id":"0","state" : { "opened" : true },
                "children":[
                    {
                        "id":"2","name":"2020","text":"2020","parent_id":"1","state" : { "opened" : true },
                        "children":[
                            {"id":"7","name":"Janvier","text":"Janvier","parent_id":"2","state" : { "selected" : true }, "children":[],"data":{},"a_attr":{"href":"google.com"}}
                        ],
                        "data":{},
                        "a_attr":{"href":"google.com"}
                    }
                ],
                "data":{},
                "a_attr":{"href":"google.com"}
            }
    ];
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
              for(var i = 0 ; i < jsonTreeData.length ; i++)
              {
                folder_dir[0] = jsonTreeData[i].name;
                if(data.instance.get_node(data.selected[0]).id == jsonTreeData[i].id)
                {
                  break;
                }
                if(jsonTreeData[i].children !=null)
                {
                  getParent(jsonTreeData[i] ,data.instance.get_node(data.selected[0]).id ,0);
                }
              }
              // alert(folder_dir);
              // $('#selected_data').val( table.row( this ).data()[0]);
              var txt_folder_dir=""
              for(var i = 0 ; i < folder_dir.length ; i++)
              {
                txt_folder_dir += folder_dir[i];
                if(folder_dir.length != i + 1){
                  txt_folder_dir +=" > " ;
                }
              }
              // $('#selected_folder').val(txt_folder_dir);
              // generatePossible();
              // $('#folder').modal('hide')
            }
          }
        })
        .jstree({
          'core' : {
          'data' : jsonTreeData
        }
        });
    } );
    // table data begin------------------
  //  var src_jsonDataFileArray = [];

    var dataUrlArray = [
        [ "Tiger Nixon", "2011/07/25", "Edinburgh"],
        [ "Garrett Winters",  "2011/07/25", "Accountant"],
        [ "Ashton Cox", "2011/07/25","Junior Technical Author" ],
        [ "Cedric Kelly", "2011/07/25","Senior Javascript Developer"  ],
        [ "Airi Satou", "2011/07/25","Accountant" ],
        [ "Brielle Williamson", "2011/07/25","Integration Specialist" ],
        [ "Herrod Chandler","2011/07/25", "Sales Assistant" ],
        [ "Rhona Davidson", "2011/07/25","Integration Specialist"],
        [ "Colleen Hurst", "2008/12/13","Javascript Developer" ],
        [ "Sonya Frost","2008/12/13", "Software Engineer" ],
        [ "Jena Gaines", "2008/12/13","Office Manager"],
        [ "Quinn Flynn", "2008/12/13","Support Lead" ],
        [ "Charde Marshall", "2008/12/13","Regional Director"],
        [ "Haley Kennedy","2008/12/13", "Senior Marketing Designer"],
        [ "Tatyana Fitzpatrick","2008/12/13", "Regional Director"],
        [ "Michael Silva","2012/11/27", "Marketing Designer"],
        [ "Paul Byrd","2012/11/27", "Chief Financial Officer (CFO)"],
        [ "Gloria Little","2012/11/27", "Systems Administrator"],
        [ "Bradley Greer","2012/11/27", "Software Engineer" ],
        [ "Dai Rios","2012/09/26",  "Personnel Lead"],
        [ "Jenette Caldwell","2012/09/26", "Development Lead"],
        [ "Yuri Berry", "2012/09/26", "Chief Marketing Officer (CMO)"],
        [ "Caesar Vance", "2012/09/26", "Pre-Sales Support"],
        [ "Doris Wilder", "2012/09/26", "Sales Assistant" ],
        [ "Angelica Ramos","2012/09/26", "Chief Executive Officer (CEO)"],
        [ "Martena Mccray", "2011/03/09", "Post-Sales support" ],
        [ "Unity Butler", "2011/03/09", "Marketing Designer"]
    ];
    function datatUrlPrint(srcData){
      $(document).ready(function() {
        var dataTable= $('#datas_table').DataTable( {
              data: srcData,
              paging: false,
              destroy: true,
              columns: [
                  { title: "Name data"},
                  { title: "Create date" },
                  { title: "Author" }
              ],
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
              // console.log(contact[0][0]);
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
