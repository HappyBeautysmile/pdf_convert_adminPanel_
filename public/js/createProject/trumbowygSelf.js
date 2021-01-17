
$('#trumbowyg-demo').trumbowyg({
    lang: 'fr',
    btns: [
        ['viewHTML'],
        ['historyUndo', 'historyRedo'],
        // ['formatting'],
        ['strong', 'em'],
        ['superscript'], // ['superscript', 'subscript'],
        ['foreColor'],
        // ['foreColor', 'backColor'], 
        // ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        // ['unorderedList', 'orderedList'],
        // ['horizontalRule'],
        // ['removeformat'],
        ['fullscreen'],
        ['fontfamily'],
        ['fontsize'],
        ['template'],
        ['indent', 'outdent']

    ],
    plugins: {
      fontfamily: {
        fontList: [
          {name: 'Chandiluna' ,family : 'Chandiluna'},
          {name: 'Heysweet' ,family : 'heysweet'},
          {name: 'MelanieRoselyn' ,family : 'MelanieRoselyn'},
          
          {name: 'Arial', family: 'Arial, Helvetica, sans-serif'},
          {name: 'Arial Black', family: 'Arial Black, Gadget, sans-serif'},
          {name: 'Comic Sans', family: 'Comic Sans MS, Textile, cursive, sans-serif'},
          {name: 'Courier New', family: 'Courier New, Courier, monospace'},
          {name: 'Georgia', family: 'Georgia, serif'},
          {name: 'Impact', family: 'Impact, Charcoal, sans-serif'},
          {name: 'Lucida Console', family: 'Lucida Console, Monaco, monospace'},
          {name: 'Lucida Sans', family: 'Lucida Sans Uncide, Lucida Grande, sans-serif'},
          {name: 'Palatino', family: 'Palatino Linotype, Book Antiqua, Palatino, serif'},
          {name: 'Tahoma', family: 'Tahoma, Geneva, sans-serif'},
          {name: 'Times New Roman', family: 'Times New Roman, Times, serif'},
          {name: 'Trebuchet', family: 'Trebuchet MS, Helvetica, sans-serif'},
          {name: 'Verdana', family: 'Verdana, Geneva, sans-serif'}
        ]
    },
      templates: [
            {
                name: '#01 Template Test Roni',
                html: '<table align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td align="center" valign="top" bgcolor="#ffffff" style="font-family:Arial, sans-serif;font-size:28px; line-height: 20px; color:#CC0000;text-align: center;"> JE SUIS TEMPLATE 01 </td> </tr> <tr> <td align="center" valign="top" bgcolor="#ffffff" style="font-family:Arial, sans-serif;font-size:18px; line-height: 20px; color:#CC0000;text-align: center;"> Mon ID est {ID}. <br> Mon nom est {Last name} {First name}. <br> Je vis à {City}. <br> Mon numéro de telephone est {Telephone no}. <br> Mon adresse mail est {E-mail}. <br> Ma date de naissance est le {Birthday_date}. <br> Exemples: <br> {fields_01} <br> {fields_02} <br> {fields_03} <br> {fields_04} <br> {fields_05} <br> {fields_06} <br> {fields_07} <br> {fields_08} <br> {fields_09} <br> {fields_10} <br> </td> </tr> </table>'
            },
            {
                name: '#02 Template Test Roni',
                html: '<table align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td align="center" valign="top" bgcolor="#ffffff" style="font-family:Arial, sans-serif;font-size:28px; line-height: 20px; color:#007E33;text-align: center;"> JE SUIS TEMPLATE 02 </td> </tr> <tr> <td align="center" valign="top" bgcolor="#ffffff" style="font-family:Arial, sans-serif;font-size:18px; line-height: 20px; color:#007E33;text-align: center;"> Mon ID est {ID}. <br> Mon nom est {Last name} {First name}. <br> Je vis à {City}. <br> Mon numéro de telephone est {Telephone no}. <br> Mon adresse mail est {E-mail}. <br> Ma date de naissance est le {Birthday_date}. <br> Exemples: <br> {fields_01} <br> {fields_02} <br> {fields_03} <br> {fields_04} <br> {fields_05} <br> {fields_06} <br> {fields_07} <br> {fields_08} <br> {fields_09} <br> {fields_10} <br> </td> </tr> </table>'
          },
          {
                name: '#03 Template Test Roni',
                html: '<table align="center" bgcolor="#FFFFFF" border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td align="center" valign="top" bgcolor="#ffffff" style="font-family:Arial, sans-serif;font-size:28px; line-height: 20px; color:#9933CC;text-align: center;"> JE SUIS TEMPLATE 03 </td> </tr> <tr> <td align="center" valign="top" bgcolor="#ffffff" style="font-family:Arial, sans-serif;font-size:18px; line-height: 20px; color:#9933CC;text-align: center;"> Mon ID est {ID}. <br> Mon nom est {Last name} {First name}. <br> Je vis à {City}. <br> Mon numéro de telephone est {Telephone no}. <br> Mon adresse mail est {E-mail}. <br> Ma date de naissance est le {Birthday_date}. <br> Exemples: <br> {fields_01} <br> {fields_02} <br> {fields_03} <br> {fields_04} <br> {fields_05} <br> {fields_06} <br> {fields_07} <br> {fields_08} <br> {fields_09} <br> {fields_10} <br> </td> </tr> </table>'
          }
        ],
        resizimg: {
          minSize: 64,
          step: 16,
        },
      
      }
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
        var table = $('#datas_table').DataTable();
        $('#datas_table').on( 'click', 'tr', function () {
          // alert( table.row( this ).data()[0]);
          currentFolder_dir ="./TCPDFCustomize/"
          $('#selected_data').val( table.row( this ).data()[0]);
          $("#select_data_name_modal").html( table.row( this ).data()[0]);
          $("#select_data_name").html( table.row( this ).data()[0]);
          generatePossible();
          $('#data').modal('hide')
        } );
       
    } );