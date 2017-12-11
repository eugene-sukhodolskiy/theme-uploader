<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Upload template</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="flexboxgrid.min.css">
	<link rel="stylesheet" type="text/css" href="materialize/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="all.css">
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
		</div>
		<button class="waves-effect waves-light btn red darken-2 white-text upload-theme-btn" data-page="addMeta"><i class="material-icons left">file_upload</i>Upload Theme</button>
	</aside>

	
	<section class="page" id="addMeta">
		<h3>Add new template - step 1</h3>
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
						<input type="text" id="template_name" name="name">
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
						<select name="resolution" class="resolution">
							<!-- <option value="id">PC</option> -->
						</select>
					</div>

					<div class="form-group">
						<label>Compatible Browsers</label>
						<select name="compatible-browsers" class="compatible-browsers">
							<!-- <option value="id">IE 8</option> -->
						</select>
					</div>

					<div class="form-group">
						<label>Compatible With</label>
						<select name="compatible-with" class="compatible-with">
							<!-- <option value="id">Bootstrap</option> -->
						</select>
					</div>

					<div class="form-group">
						<label>File Includes</label>
						<select name="file_type">
							<option value="PNG">PNG</option>
							<option value="JPEG">JPEG</option>
							<option value="PHP">PHP</option>
							<option value="JS">JS</option>
							<option value="HTML">HTML</option>
							<option value="TXT">TXT</option>
							<option value="PSD">PSD</option>
						</select>
					</div>

					<div class="form-group">
						<label>Column</label>
						<select name="column">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>

					<div class="form-group">
						<label>Layout</label>
						<select name="layout">
							<option value="fixed">Fixed</option>
							<option value="responsive">Responsive</option>
							<option value="adaptive">Adaptive</option>
						</select>
					</div>

				</div>
			</div>
		</form>
		<button class="waves-effect waves-light btn  teal lighten-1 white-text next-step-btn"><i class="material-icons right">arrow_forward</i>Next step</button>
	</section>

	<section class="page" id="theme-list">
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
			<h5 class="total right">Total 6</h5>
		</div>

		<div class="row cards-container">
			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="card">
				    <div class="card-image waves-effect waves-block waves-light">
				      <img class="activator" src="images/thumbnail-1.jpg">
				    </div>
				    <div class="card-content">
				      <span class="card-title activator grey-text text-darken-4">Theme title<i class="material-icons right">more_vert</i></span>
				      <p><a href="#">Link on demo</a></p>
				    </div>
				    <div class="card-reveal">
				      <span class="card-title grey-text text-darken-4">Theme title<i class="material-icons right">close</i></span>
				      <p>Theme description. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas quidem saepe doloremque repellat minima quod totam, ducimus maiores vero neque?</p>
				      <a class="waves-effect waves-light btn-flat update-btn blue-text">Update</a>
				    </div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="card">
				    <div class="card-image waves-effect waves-block waves-light">
				      <img class="activator" src="images/thumbnail-2.jpg">
				    </div>
				    <div class="card-content">
				      <span class="card-title activator grey-text text-darken-4">Theme title<i class="material-icons right">more_vert</i></span>
				      <p><a href="#">Link on demo</a></p>
				    </div>
				    <div class="card-reveal">
				      <span class="card-title grey-text text-darken-4">Theme title<i class="material-icons right">close</i></span>
				      <p>Theme description. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas quidem saepe doloremque repellat minima quod totam, ducimus maiores vero neque?</p>
				      <a class="waves-effect waves-light btn-flat update-btn blue-text">Update</a>
				    </div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="card">
				    <div class="card-image waves-effect waves-block waves-light">
				      <img class="activator" src="images/thumbnail-3.jpg">
				    </div>
				    <div class="card-content">
				      <span class="card-title activator grey-text text-darken-4">Theme title<i class="material-icons right">more_vert</i></span>
				      <p><a href="#">Link on demo</a></p>
				    </div>
				    <div class="card-reveal">
				      <span class="card-title grey-text text-darken-4">Theme title<i class="material-icons right">close</i></span>
				      <p>Theme description. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas quidem saepe doloremque repellat minima quod totam, ducimus maiores vero neque?</p>
				      <a class="waves-effect waves-light btn-flat update-btn blue-text">Update</a>
				    </div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="card">
				    <div class="card-image waves-effect waves-block waves-light">
				      <img class="activator" src="images/thumbnail-4.jpg">
				    </div>
				    <div class="card-content">
				      <span class="card-title activator grey-text text-darken-4">Theme title<i class="material-icons right">more_vert</i></span>
				      <p><a href="#">Link on demo</a></p>
				    </div>
				    <div class="card-reveal">
				      <span class="card-title grey-text text-darken-4">Theme title<i class="material-icons right">close</i></span>
				      <p>Theme description. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas quidem saepe doloremque repellat minima quod totam, ducimus maiores vero neque?</p>
				      <a class="waves-effect waves-light btn-flat update-btn blue-text">Update</a>
				    </div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="card">
				    <div class="card-image waves-effect waves-block waves-light">
				      <img class="activator" src="images/thumbnail-5.jpg">
				    </div>
				    <div class="card-content">
				      <span class="card-title activator grey-text text-darken-4">Theme title<i class="material-icons right">more_vert</i></span>
				      <p><a href="#">Link on demo</a></p>
				    </div>
				    <div class="card-reveal">
				      <span class="card-title grey-text text-darken-4">Theme title<i class="material-icons right">close</i></span>
				      <p>Theme description. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas quidem saepe doloremque repellat minima quod totam, ducimus maiores vero neque?</p>
				      <a class="waves-effect waves-light btn-flat update-btn blue-text">Update</a>
				    </div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<div class="card">
				    <div class="card-image waves-effect waves-block waves-light">
				      <img class="activator" src="images/thumbnail-6.jpg">
				    </div>
				    <div class="card-content">
				      <span class="card-title activator grey-text text-darken-4">Theme title<i class="material-icons right">more_vert</i></span>
				      <p><a href="#">Link on demo</a></p>
				    </div>
				    <div class="card-reveal">
				      <span class="card-title grey-text text-darken-4">Theme title<i class="material-icons right">close</i></span>
				      <p>Theme description. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas quidem saepe doloremque repellat minima quod totam, ducimus maiores vero neque?</p>
				      <a class="waves-effect waves-light btn-flat update-btn blue-text">Update</a>
				    </div>
				</div>
			</div>
		</div>

		<a class="btn-floating btn-large waves-effect waves-light red add-new-theme" data-page="addMeta"><i class="material-icons">add</i></a>
	</section>
	

</body>
</html>