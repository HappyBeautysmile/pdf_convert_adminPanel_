
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
    var dataSet = [
        [ "Tiger Nixon", "5421", "2011/04/25", "Edinburgh"],
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
        $('#datas_table').DataTable( {
            data: dataSet,
            columns: [
                { title: "Name data" },
                { title: "Create date" },
                { title: "Author" }
            ]
        } );
        var table = $('#datas_table').DataTable();
        $('#datas_table').on( 'click', 'tr', function () {
          // alert( table.row( this ).data()[0]);
          $('#selected_data').val( table.row( this ).data()[0]);
          $("#select_data_name_modal").html( table.row( this ).data()[0]);
          $("#select_data_name").html( table.row( this ).data()[0]);
          generatePossible();
          $('#data').modal('hide')
        } );
       
    } );