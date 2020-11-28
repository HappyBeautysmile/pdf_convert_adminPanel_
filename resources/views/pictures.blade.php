@extends('home')

@section('main_area')
<div class="container">
  <div class="row" style="margin-top:50px;">
	<div class="col-sm-3" style="background:#FFFAF0;border-radius:5px; overflow: scroll; height:550px;">
		<h3><i class="fa fa-folder-open-o" style="font-size:30x;color:yellow!important"></i> Media Folder</h3>
      <ul class="nav nav-tabs flex-column bg-light" style="border:2px solid gray!important; overflow: scroll; ">
        <li>Media Folder
          <div class="well" id="folder_tree" ></div>
        </li>
      </ul>
    </div>
    <div class="col-sm-8"> 
      <div class="tab-content">
        <div class="tab-pane container active" id="datas_area">
			<h3>Media Library <button class="btn btn-outline-primary waves-effect" style="margin-bottom:10px" id="createData"><i class="fa fa-image" style="font-size:30x;"></i> Add New</button> </h3>
          <table id="datas_table" class="display" width="100%"></table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  var jsonTreeData =
    [
        {"id":"100","name":"Background","text":"Background","parent_id":"0",    "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"200","name":"Animals","text":"Animals","parent_id":"0",    "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"300","name":"Persons image","text":"Persons image","parent_id":"0",    "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"400","name":"ALL Icons","text":"ALL Icons","parent_id":"0",    "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"1","name":"Test","text":"Test","parent_id":"0",
                "children":[
                    {
                        "id":"2","name":"Cars","text":"Cars","parent_id":"1",
                        "children":[
                            {"id":"7","name":"Samsung","text":"Samsung","parent_id":"2","children":[],"data":{},"a_attr":{"href":"google.com"}},
                            {"id":"8","name":"Apple","text":"Apple","parent_id":"2","children":[],"data":{},"a_attr":{"href":"google.com"}}
                        ],
                        "data":{},
                        "a_attr":{"href":"google.com"}
                    },
                    {
                        "id":"3","name":"Laptop","text":"Laptop","parent_id":"1",
                        "children":[
                            {"id":"4","name":"Keyboard","text":"Keyboard","parent_id":"3","children":[],"data":{},"a_attr":{"href":"google.com"}},
                            {"id":"5","name":"Computer Peripherals","text":"Computer Peripherals","parent_id":"3",
                                "children":[
                                    {"id":"6","name":"Printers","text":"Printers","parent_id":"5","children":[],"data":{},"a_attr":{"href":"google.com"}},
                                    {"id":"10","name":"Monitors","text":"Monitors","parent_id":"5","children":[],"data":{},"a_attr":{"href":"google.com"}}
                                ],
                                "data":{},"a_attr":{"href":"google.com"}},
                            {"id":"11","name":"Dell","text":"Dell","parent_id":"3","children":[],"data":{},"a_attr":{"href":"google.com"}}
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
    var dataSet = [
        [ "Tiger Nixon", "2011/07/25", "2011/04/25", "Edinburgh"],
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
    
    $(document).ready(function() {
      var dataTable= $('#datas_table').DataTable( {
            data: dataSet,
            columns: [
                { title: "Name data"},
                { title: "Create date" },
                { title: "Author" }
            ],
        } );
        var counter = 1;
// date type begin
        var d = new Date(),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
        if (month.length < 2) 
            month = '0' + month;
        if (day.length < 2) 
            day = '0' + day;
        // alert([year, month, day].join('/'))
// date type end

        dataTable.column( '1:visible' )
                    .order( 'dec' )
                    .draw();
        $('#createData').on( 'click', function () {
            dataTable.row.add( [
                "NEW",
                [year, month, day].join('/'),
                "NEW"
            ] ).draw( false );
    
            counter++;
        } );
    
        // Automatically add a first row of data
        $('#createData').click();

        $('#datas_table').on( 'click', 'tr', function () {
          // alert( table.row( this ).data()[0]);
          // $('#selected_data').val( table.row( this ).data()[0]);
          // generatePossible();
          // $('#data').modal('hide')
        } );
       
    } );
    // table data end------------------

</script>

@endsection
