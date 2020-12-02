@extends('home')

@section('main_area')
<style>
input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}
.select_lable{
  font-size:20px;
  text-align:right;
  font-weight: bold;
}
</style>
<div class="container">
  <div class = "row" style="margin-top:50px;">
      <div class="col-sm-2 select_lable">Select FOLDER</div>
      <div class="col-sm-9"> 
          <p>
          <input class="col-sm-10" placeholder="select folder..." oninput="this.className = ''" name="selected_folder" disabled id="selected_folder">
          <button type="button" class="btn btn-success btn-lg"name="select_folder_btn"  data-toggle="modal" data-target="#folder" id="viewPdfs" >SELECT</button> 
          </p>
      </div>
  </div>
  <div>
    <ul class="nav nav-tabs flex-column">
      <li>ConvertPDF
        <div class="well" id="folder_tree" ></div>
      </li>
    </ul>
  </div>
</div>
<script>
 var jsonTreeData =
    [
        {"id":"100","name":"PROJECTS","text":"PROJECTS","parent_id":"0",  "state" : { "disabled" : false } ,   "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"200","name":"IMAGES","text":"IMAGES","parent_id":"0",   "state" : { "disabled" : false } ,  "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"300","name":"ALL PDF","text":"ALL PDF","parent_id":"0",  "state" : { "disabled" : false }  ,  "data":{},
            "a_attr":{"href":"google.com"}
        },
        {"id":"00","name":"ALL PDF","text":"ALL PROJECT","parent_id":"0", "state" : { "disabled" : false } ,   "data":{},
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
          folder_dir=[];
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
          var txt_folder_dir=""
          for(var i = 0 ; i < folder_dir.length ; i++)
          {
            txt_folder_dir += folder_dir[i];
            if(folder_dir.length != i + 1){
              txt_folder_dir +=" > " ;
            }
          }
          // alert(folder_dir);
          $('#selected_folder').val(txt_folder_dir);
        })
        .jstree({
          'core' : {
          'data' : jsonTreeData
        }
        });
    } );
</script>
@endsection
