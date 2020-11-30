
$('#trumbowyg-demo').trumbowyg({
    btns: [
        ['viewHTML'],
        ['undo', 'redo'], // Only supported in Blink browsers
        ['formatting'],
        ['strong', 'em', 'del'],
        ['superscript', 'subscript'],
        ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        ['unorderedList', 'orderedList'],
        ['horizontalRule'],
        ['removeformat'],
        ['fullscreen'],
        ['foreColor', 'backColor'],
        ['fontfamily'],
        ['fontsize'],
        ['historyUndo', 'historyRedo'],
        ['template']
    ]
});
$('#temp').html($('#trumbowyg-demo').trumbowyg('html'));
// var content = $('#trumbowyg-demo').html();
  function getTrumbowygContent(){
    var content = $('#trumbowyg-demo').html();
    return content;
  }
    
    $(document).ready(function() {
        $('#datas_table').DataTable( {
            data: dataUrlArray,
            columns: [
                { title: "Name data" },
                { title: "Create date" },
                { title: "Author" }
            ]
        } );
        var table = $('#datas_table').DataTable();
        $('#datas_table').on( 'click', 'tr', function () {
          // alert( table.row( this ).data()[0]);
          currentFolder_dir ="./TCPDFCustomize/ResourceData/"
          var txt_folder_dir=""
          for(var i = 0 ; i < folder_dir.length ; i++)
          {
            txt_folder_dir += folder_dir[i];
            if(folder_dir.length != i + 1){
              txt_folder_dir +=" > " ;
            }
            currentFolder_dir = currentFolder_dir + folder_dir[i] + "/";
          }
          $('#selected_data').val( table.row( this ).data()[0]);
          $("#select_data_name_modal").html( table.row( this ).data()[0]);
          $("#select_data_name").html( table.row( this ).data()[0]);
          generatePossible();
          $('#data').modal('hide')
        } );
       
    } );