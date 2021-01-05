
$('#trumbowyg-demo').trumbowyg({
    btns: [
        ['viewHTML'],
        ['historyUndo', 'historyRedo'],
        ['formatting'],
        ['strong', 'em'],
        // ['superscript', 'subscript'],
        // ['link'],
        ['insertImage'],
        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
        // ['unorderedList', 'orderedList'],
        // ['horizontalRule'],
        // ['removeformat'],
        ['fullscreen'],
        ['foreColor', 'backColor'],
        ['fontfamily'],
        ['fontsize'],
        ['template']
    ],
    plugins: {
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
        ]
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