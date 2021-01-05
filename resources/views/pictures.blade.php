@extends('home')
@section('main_area')
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
    <!-- <div class="col-sm-3" style="background:#FFFAF0;border-radius:5px; overflow: scroll; height:550px;">
      <h3><i class="fa fa-folder-open-o" style="font-size:30x;color:yellow!important"></i> Media Folder</h3>
        <ul class="nav nav-tabs flex-column bg-light" style="border:2px solid gray!important; overflow: scroll; ">
          <li>
            <div class="well" id="folder_tree"  style="height:440px"></div>
          </li>
        </ul>
    </div> -->
    <div class="col-md-12">
      <div class="tab-content">
      <div class="container">
      <form
        id="fileupload"
        action="https://jquery-file-upload.appspot.com/"
        method="POST"
        enctype="multipart/form-data"
      >
        <div class="row fileupload-buttonbar">
			 <div class="col-md-9 mx-auto" style="margin-bottom:30px;">
				<div class="input-group">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="files[]" multiple>
						<label class="custom-file-label" for="inputGroupFile04">Choisir une image</label>
					</div>
					<div class="input-group-append">
						<button class="btn btn-primary" type="submit" id="inputGroupFileAddon04"><i class="fa fa-download" aria-hidden="true"></i> Télécharger</button>
					</div>
				</div>
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
        <table role="presentation" class="table table-striped " id="imageList">
            <thead>
              <tr>
                <th class="th-sm">Image
                </th>
                <th class="th-sm">Url
                </th>
                <th class="th-sm">Taille
                </th>
                <th class="th-sm">Status
                </th>
              </tr>
             
            </thead>
          <tbody class="files">
          </tbody>
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
<script id="template-download"  type="text/x-tmpl">
  {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download  {%=file.thumbnailUrl?' image':''%}" role="row">
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
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>images/{%=file.name%}</a>
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
          uploaded
        </td>
    </tr>
  {% } %}
</script>

<script>
  var jsonFolderDirInform = JSON.parse(<?php echo json_encode($jsonFolderDirInform);?>);
  var findSelectFlag = false ;
  var imageFolderDir ="" ;
  var reload = false ;

  // $(document).ready(function () {
  //     $('#imageList').DataTable();
  //     $('.dataTables_length').addClass('bs-select');
  //   });
</script>
<script
  src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"
  integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
  crossorigin="anonymous"
></script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{ asset('js/imageJs/vendor/jquery.ui.widget.js') }}" defer></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ asset('js/imageJs/jquery.iframe-transport.js') }}" defer></script> 
<!-- The basic File Upload plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload.js') }}" defer></script>
<!-- The File Upload processing plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-process.js') }}" defer></script> 
<!-- The File Upload image preview & resize plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-image.js') }}" defer></script> 
<!-- The File Upload audio preview plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-audio.js') }}" defer></script> 
<!-- The File Upload video preview plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-video.js') }}" defer></script> 
<!-- The File Upload validation plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-validate.js') }}" defer></script> 
<!-- The File Upload user interface plugin -->
<script src="{{ asset('js/imageJs/jquery.fileupload-ui.js') }}" defer></script> 
<!-- The main application script -->
<script src="{{ asset('js/imageJs/demo.js') }}" defer></script> 
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
  <script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
@endsection