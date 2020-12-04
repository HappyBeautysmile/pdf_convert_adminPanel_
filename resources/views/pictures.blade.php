@extends('home')

@section('main_area')

<style>
  #navigation {
    margin: 10px 0;
  }
  @media (max-width: 767px) {
    #title,
    #description {
      display: none;
    }
  }
</style>
<!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('dist/themes/default/style.min.css') }}" rel="stylesheet">
<script src="{{ asset('dist/jstree.min.js') }}" defer></script> -->
<link rel="stylesheet"  href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css"/>
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link href="{{ asset('css/imageCss/jquery.fileupload.css') }}" rel="stylesheet">
<link href="{{ asset('css/imageCss/jquery.fileupload-ui.css') }}" rel="stylesheet">

<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript>
  <link href="{{ asset('css/imageCss/jquery.fileupload-noscript.css') }}" rel="stylesheet">
</noscript>
<noscript>
  <link href="{{ asset('css/imageCss/jquery.fileupload-ui-noscript.css') }}" rel="stylesheet">
</noscript>

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
      <div class="container">
      <form
        id="fileupload"
        action="https://jquery-file-upload.appspot.com/"
        method="POST"
        enctype="multipart/form-data"
      >
        <div class="row fileupload-buttonbar">
          <div class="col-lg-11">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Add files...</span>
              <input type="file" name="files[]" multiple />
            </span>
            <button type="submit" class="btn btn-primary start">
              <i class="glyphicon glyphicon-upload"></i>
              <span>Start upload</span>
            </button>
            <button type="reset" class="btn btn-warning cancel">
              <i class="glyphicon glyphicon-ban-circle"></i>
              <span>Cancel upload</span>
            </button>
            <button type="button" class="btn btn-danger delete">
              <i class="glyphicon glyphicon-trash"></i>
              <span>Delete selected</span>
            </button>
            <input type="checkbox" class="toggle" />
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
          </div>
          <!-- The global progress state -->
          <div class="col-lg-1 fileupload-progress fade">
            <!-- The global progress bar -->
            <div
              class="progress progress-striped active"
              role="progressbar"
              aria-valuemin="0"
              aria-valuemax="100"
            >
              <div
                class="progress-bar progress-bar-success"
                style="width: 0%;"
              ></div>
            </div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
          </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped">
          <tbody class="files"></tbody>
        </table>
      </form>
 
    </div>
    <!-- The blueimp Gallery widget -->
    <div
      id="blueimp-gallery"
      class="blueimp-gallery blueimp-gallery-controls"
      aria-label="image gallery"
      aria-modal="true"
      role="dialog"
      data-filter=":even"
    >
      <div class="slides" aria-live="polite"></div>
      <h3 class="title"></h3>
      <a
        class="prev"
        aria-controls="blueimp-gallery"
        aria-label="previous slide"
        aria-keyshortcuts="ArrowLeft"
      ></a>
      <a
        class="next"
        aria-controls="blueimp-gallery"
        aria-label="next slide"
        aria-keyshortcuts="ArrowRight"
      ></a>
      <a
        class="close"
        aria-controls="blueimp-gallery"
        aria-label="close"
        aria-keyshortcuts="Escape"
      ></a>
      <a
        class="play-pause"
        aria-controls="blueimp-gallery"
        aria-label="play slideshow"
        aria-keyshortcuts="Space"
        aria-pressed="false"
        role="button"
      ></a>
      <ol class="indicator"></ol>
    </div>
      </div>
    </div>
  </div>
</div>
<script>
  var jsonFolderDirInform =
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
              for(var i = 0 ; i < jsonFolderDirInform.length ; i++)
              {
                folder_dir[0] = jsonFolderDirInform[i].name;
                if(data.instance.get_node(data.selected[0]).id == jsonFolderDirInform[i].id)
                {
                  break;
                }
                if(jsonFolderDirInform[i].children !=null)
                {
                  getParent(jsonFolderDirInform[i] ,data.instance.get_node(data.selected[0]).id ,0);
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
          'data' : jsonFolderDirInform
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
 <!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
  {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-upload {%=o.options.loadImageFileTypes.test(file.type)?' image':''%}">
          <td>
              <span class="preview"></span>
          </td>
          <td>
              <p class="name">{%=file.name%}</p>
              <strong class="error text-danger"></strong>
          </td>
          <td>
              <p class="size">Processing...</p>
              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
          </td>
          <td>
              {% if (!o.options.autoUpload && o.options.edit && o.options.loadImageFileTypes.test(file.type)) { %}
                <button class="btn btn-success edit" data-index="{%=i%}" disabled>
                    <i class="glyphicon glyphicon-edit"></i>
                    <span>Edit</span>
                </button>
              {% } %}
              {% if (!i && !o.options.autoUpload) { %}
                  <button class="btn btn-primary start" disabled>
                      <i class="glyphicon glyphicon-upload"></i>
                      <span>Start</span>
                  </button>
              {% } %}
              {% if (!i) { %}
                  <button class="btn btn-warning cancel">
                      <i class="glyphicon glyphicon-ban-circle"></i>
                      <span>Cancel</span>
                  </button>
              {% } %}
          </td>
      </tr>
  {% } %}
</script>
    <!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
  {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download  {%=file.thumbnailUrl?' image':''%}">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
  {% } %}
</script>

<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"
  integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
  crossorigin="anonymous"
></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{ asset('js/imageJs/vendor/jquery.ui.widget.js') }}" defer></script> -->
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ asset('js/imageJs/jquery.iframe-transport.js') }}" defer></script> -->
<!-- The basic File Upload plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload.js') }}" defer></script> -->
<!-- The File Upload processing plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-process.js') }}" defer></script> -->
<!-- The File Upload image preview & resize plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-image.js') }}" defer></script> -->
<!-- The File Upload audio preview plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-audio.js') }}" defer></script> -->
<!-- The File Upload video preview plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-video.js') }}" defer></script> -->
<!-- The File Upload validation plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-validate.js') }}" defer></script> -->
<!-- The File Upload user interface plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-ui.js') }}" defer></script> -->
<!-- The main application script -->
<script src="{{ asset('js/imageJs/demo.js') }}" defer></script> -->
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
  <script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
@endsection
