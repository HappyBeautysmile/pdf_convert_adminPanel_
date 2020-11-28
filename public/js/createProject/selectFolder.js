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
                $('#selected_folder').val(txt_folder_dir);
                $("#select_folder_dir_modal").html( txt_folder_dir);
                $("#select_folder_dir").html( txt_folder_dir);
                
                generatePossible();
                $('#folder').modal('hide')
              }
            }
          })
          .jstree({
            'core' : {
            'data' : jsonTreeData
          }
          });
      } );
      // select folder tree event -end-*******************