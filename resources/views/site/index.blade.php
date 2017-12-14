<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload template</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="flexboxgrid.min.css">
	<link rel="stylesheet" type="text/css" href="materialize/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="all.css">
	<script type="text/javascript">
		var TOKEN = "{{$token}}"
	</script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="model.js"></script>
	<script type="text/javascript" src="view.js"></script>
	<script type="text/javascript" src="controller.js"></script>
	<script type="text/javascript" src="app.js"></script>
</head>
<body class="grey lighten-4">
	
	<aside class="sidebar grey darken-4">
		<h4>My products</h4>
		<div class="main-nav">
			<ul class="cms-list">
				<!-- <li><a href="#" class="item"><span class="count">10</span>Joomla</a></li> -->
			</ul>
			<div class="preloader-container">
				<div class="preloader-wrapper active">
				    <div class="spinner-layer spinner-red-only">
				      <div class="circle-clipper left">
				        <div class="circle"></div>
				      </div><div class="gap-patch">
				        <div class="circle"></div>
				      </div><div class="circle-clipper right">
				        <div class="circle"></div>
				      </div>
				    </div>
				  </div>
			</div>
		</div>
		<button class="waves-effect waves-light btn red darken-2 white-text upload-theme-btn" data-page="addMeta"><i class="material-icons left">file_upload</i>Upload Theme</button>
	</aside>

	
	<section class="page" id="addMeta">

		<h3>Add new template - step 1</h3>
		<div class="preloader-container">
			<div class="preloader-wrapper active">
			    <div class="spinner-layer spinner-red-only">
			      <div class="circle-clipper left">
			        <div class="circle"></div>
			      </div><div class="gap-patch">
			        <div class="circle"></div>
			      </div><div class="circle-clipper right">
			        <div class="circle"></div>
			      </div>
			    </div>
			</div>
		</div>
		<form method="post">
			<div class="row">
				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Select CMS</label>
						<select name="cms" class="cms-list-select">
							<!-- <option value="WordPress">WordPress</option> -->
						</select>
					</div>

					<div class="input-field">
						<label for="template_name">Template name *</label>
						<input type="text" id="template_name" name="template_name">
					</div>

					<div class="input-field">
						<label for="description">Description *</label>
						<textarea id="description" type="text" class="materialize-textarea" name="description"></textarea>
					</div>

					<div class="form-group">
						<label><i class="material-icons">label</i> Keywords</label>
						<input id="keywords" type="text" name="keywords" data-keywords-value="" data-keywords-container=".keywords-container">
						<div class="keywords-container" data-keywords-field="#keywords"></div>
					</div>
				</div>

				<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
					<div class="form-group">
						<label>Select Resolution</label>
						<select name="resolution" class="resolution" multiple="multiple" >
							<!-- <option value="id">PC</option> -->
						</select>
					</div>

					<div class="form-group">
						<label>Compatible Browsers</label>
						<select name="compatible-browsers" class="compatible-browsers" multiple="multiple" >
							<!-- <option value="id">IE 8</option> -->
						</select>
					</div>

					<div class="form-group">
						<label>Compatible With</label>
						<select name="compatible-with" class="compatible-with" multiple="multiple" >
							<!-- <option value="id">Bootstrap</option> -->
						</select>
					</div>

					<div class="form-group">
						<label>Software</label>
						<select name="software" class="software" multiple="multiple" >
							<!-- <option value="id">Bootstrap</option> -->

						</select>
					</div>

					<div class="form-group">
						<label>File Includes</label>
						<select name="file_type" class="file-type" multiple="multiple" >
							<!-- <option value="id">PNG</option> -->
						</select>
					</div>

					<div class="form-group">
						<label>Column</label>
						<select name="column" class="column-count">
							<!-- <option value="id">1</option> -->
						</select>
					</div>

					<div class="form-group">
						<label>Layout</label>
						<select name="layout" class="layout-type">
							<!-- <option value="id">Fixed</option> -->
						</select>
					</div>

				</div>
			</div>
		</form>
		<button class="waves-effect waves-light btn  teal lighten-1 white-text next-step-btn" data-page="uploadTheme"><i class="material-icons right">arrow_forward</i>Next step</button>
	</section>

	<section class="page" id="themeList">
		<div class="row">
			<nav class="grey darken-2 nav-container">
			    <div class="nav-wrapper">
			      <div class="search right">
			      	<input type="text" name="search" placeholder="Search">
			      </div>
			      <ul id="nav-mobile" class="left hide-on-med-and-down">
			        <li><a href="#">Featured</a></li>
			        <li><a href="#">Popular</a></li>
			        <li><a href="#">Latest</a></li>
			      </ul>
			    </div>
			</nav>
		</div>

		<div class="row">
			<h5 class="total right">Total <span>0</span></h5>
		</div>

		<div class="preloader-container">
			<div class="preloader-wrapper active">
			    <div class="spinner-layer spinner-red-only">
			      <div class="circle-clipper left">
			        <div class="circle"></div>
			      </div><div class="gap-patch">
			        <div class="circle"></div>
			      </div><div class="circle-clipper right">
			        <div class="circle"></div>
			      </div>
			    </div>
			</div>
		</div>

		<div class="row cards-container">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 card-for-clone" style="display: none">
				<div class="card">
				    <div class="card-image waves-effect waves-block waves-light">
				      <img class="activator" src="images/thumbnail-1.jpg">
				    </div>
				    <div class="card-content">
				      <span class="card-title activator grey-text text-darken-4"><span class="c-title">Theme title</span><i class="material-icons right">more_vert</i></span>
				      <p><a class="link-on-demo" href="#">Link on demo</a></p>
				    </div>
				    <div class="card-reveal">
				      <span class="card-title grey-text text-darken-4"><span class="c-title">Theme title</span><i class="material-icons right">close</i></span>
				      <p class="description">Theme description. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas quidem saepe doloremque repellat minima quod totam, ducimus maiores vero neque?</p>
				      <a class="waves-effect waves-light btn-flat update-btn blue-text upldate-template-btn">Update</a>
				    </div>
				</div>
			</div>

		</div>

		<a class="btn-floating btn-large waves-effect waves-light red add-new-theme" data-page="addMeta"><i class="material-icons">add</i></a>
	</section>

	<section class="page" id="uploadTheme">
		<div class="row">
        <div class="col s12 m12 l12 xl12">
          <div class="card">
            <div class="card-image">
              <div class="drag-and-upload">
              	<input type="file" class="file-field" name="theme-archive" multiple="multiple">
              	<i class="material-icons file-select-clicker">cloud_upload</i>
              </div>
              <span class="card-title grey-text darken-4">Drag and Drop or click to cloud icon for upload template archive and preview images. Only formats: zip, png, jpg</span>
            </div>
            <div class="card-content">
              <div class="thumbnail-container drag-and-order">
              	
              </div>
            </div>
            <div class="card-action">
              <div class="row">
              	<div class="col-xs-4 col-sm-2 col-md-1 col-lg-1 zip-icon">
              		<i class="material-icons">archive</i>
              	</div>
              	<div class="col-xs-4 col-sm-4 col-md-2 col-lg-2 zip-title"></div>
              	<div class="col-xs-4 col-sm-6 col-md-9 col-lg-9 send-and-upload">
              		<button class="btn waves-effect waves-light green darken-1 uploadToServ">Upload</button>
              		<div class="preloader-container">
						<div class="preloader-wrapper">
						    <div class="spinner-layer spinner-red-only">
						      <div class="circle-clipper left">
						        <div class="circle"></div>
						      </div><div class="gap-patch">
						        <div class="circle"></div>
						      </div><div class="circle-clipper right">
						        <div class="circle"></div>
						      </div>
						    </div>
						</div>
					</div>
              	</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="waves-effect waves-light btn  teal lighten-1 white-text next-step-btn" data-page="addMeta"><i class="material-icons left">arrow_back</i>Previus step</button>
	</section>
	

</body>
</html>