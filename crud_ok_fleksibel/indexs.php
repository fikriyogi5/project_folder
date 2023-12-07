<?php
// Panggil koneksi database Anda dan buat objek Data (atau sesuaikan dengan implementasi Anda)
// include 'php/db.php'; // Gantilah dengan file koneksi Anda
// $data = new Database();


// require_once('php/functions.php'); // Memanggil file functions.php
include dirname( __DIR__ ) . '/Autoloader.php';
// include '../Autoloader.php';
// include '../config/load.php';

// $database = new Database($dbConfig);

// Gantilah 'users' dengan nama tabel pengguna Anda
// $user = $database->read('warga', "nik = " . $_SESSION['user_id'] . "");
// $data = new Functions(); // Membuat objek Functions

// Menghitung jumlah seluruh warga=
// Menghitung jumlah warga laki-laki
// $maleCount = $data->countResidents('jk', 'L');
// $FemaleCount = $data->countResidents('jk', 'P');
// $AllCount = $data->countResidents();
include __DIR__ . '/templates/header.php'; // Memanggil file functions.php
include __DIR__ . '/templates/menu.php'; // Memanggil file functions.php

?>
		<!-- END NAVIGATION -->

		<!-- MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> 
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span> 
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li>Home</li><li>Tables</li><li>Data Tables</li>
				</ol>
				<!-- end breadcrumb -->

			</div>
			<!-- END RIBBON -->

			<!-- MAIN CONTENT -->
			<div id="content">
				
				<!-- widget grid -->
				<section id="widget-grid" class="">
				
					<!-- row -->
					<div class="row">
				
						<!-- NEW WIDGET START -->
						<!-- NEW COL START -->
							<article class="col-sm-12 col-md-4 col-lg-4">
					
								<!-- Widget ID (each widget will need unique ID)-->
								<div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
									<!-- widget options:
									usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
									data-widget-colorbutton="false"
									data-widget-editbutton="false"
									data-widget-togglebutton="false"
									data-widget-deletebutton="false"
									data-widget-fullscreenbutton="false"
									data-widget-custombutton="false"
									data-widget-collapsed="true"
									data-widget-sortable="false"
					
									-->
									<header>
										<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
										<h2>Basic Form Elements </h2>
					
									</header>
					
									<!-- widget div-->
									<div>
					
										<!-- widget edit box -->
										<div class="jarviswidget-editbox">
											<!-- This area used as dropdown edit box -->
					
										</div>
										<!-- end widget edit box -->
					
										<!-- widget content -->
										<div class="widget-body no-padding">
					
											<form class="smart-form">
												<header>
													Standard Form Header
												</header>
					
												<fieldset>
													
													
					
													<section>
														<label class="label">Default text input with maxlength</label>
														<label class="input">
															<input type="text" maxlength="10">
														</label>
														<div class="note">
															<strong>Maxlength</strong> is automatically added via the "maxlength='#'" attribute
														</div>
													</section>
																
												
												</fieldset>
												
												<fieldset>
														
													<section>
														<label class="label">File input</label>
														<div class="input input-file">
															<span class="button"><input type="file" id="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
														</div>
													</section>
					
													<section>
														<label class="label">Input with autocomlete</label>
														<label class="input">
															<input type="text" list="list">
															<datalist id="list">
																<option value="Alexandra">Alexandra</option>
																<option value="Alice">Alice</option>
																<option value="Anastasia">Anastasia</option>
																<option value="Avelina">Avelina</option>
																<option value="Basilia">Basilia</option>
																<option value="Beatrice">Beatrice</option>
																<option value="Cassandra">Cassandra</option>
																<option value="Cecil">Cecil</option>
																<option value="Clemencia">Clemencia</option>
																<option value="Desiderata">Desiderata</option>
																<option value="Dionisia">Dionisia</option>
																<option value="Edith">Edith</option>
																<option value="Eleanora">Eleanora</option>
																<option value="Elizabeth">Elizabeth</option>
																<option value="Emma">Emma</option>
																<option value="Felicia">Felicia</option>
																<option value="Florence">Florence</option>
																<option value="Galiana">Galiana</option>
																<option value="Grecia">Grecia</option>
																<option value="Helen">Helen</option>
																<option value="Helewisa">Helewisa</option>
																<option value="Idonea">Idonea</option>
																<option value="Isabel">Isabel</option>
																<option value="Joan">Joan</option>
																<option value="Juliana">Juliana</option>
																<option value="Karla">Karla</option>
																<option value="Karyn">Karyn</option>
																<option value="Kate">Kate</option>
																<option value="Lakisha">Lakisha</option>
																<option value="Lana">Lana</option>
																<option value="Laura">Laura</option>
																<option value="Leona">Leona</option>
																<option value="Mandy">Mandy</option>
																<option value="Margaret">Margaret</option>
																<option value="Maria">Maria</option>
																<option value="Nanacy">Nanacy</option>
																<option value="Nicole">Nicole</option>
																<option value="Olga">Olga</option>
																<option value="Pamela">Pamela</option>
																<option value="Patricia">Patricia</option>
																<option value="Qiana">Qiana</option>
																<option value="Rachel">Rachel</option>
																<option value="Ramona">Ramona</option>
																<option value="Samantha">Samantha</option>
																<option value="Sandra">Sandra</option>
																<option value="Tanya">Tanya</option>
																<option value="Teresa">Teresa</option>
																<option value="Ursula">Ursula</option>
																<option value="Valerie">Valerie</option>
																<option value="Veronica">Veronica</option>
																<option value="Wilma">Wilma</option>
																<option value="Yasmin">Yasmin</option>
																<option value="Zelma">Zelma</option>
															</datalist> </label>
														<div class="note">
															<strong>Note:</strong> works in Chrome, Firefox, Opera and IE10.
														</div>
													</section>
												</fieldset>
					
												<fieldset>
													
													<section>
														<label class="label">Select Small</label>
														<label class="select">
															<select class="input-sm">
																<option value="0">Choose name</option>
																<option value="1">Alexandra</option>
																<option value="2">Alice</option>
																<option value="3">Anastasia</option>
																<option value="4">Avelina</option>
															</select> <i></i> </label>
													</section>
													
													<section>
														<label class="label">Select default</label>
														<label class="select">
															<select>
																<option value="0">Choose name</option>
																<option value="1">Alexandra</option>
																<option value="2">Alice</option>
																<option value="3">Anastasia</option>
																<option value="4">Avelina</option>
															</select> <i></i> </label>
													</section>
					
													<section>
														<label class="label">Select Large</label>
														<label class="select">
															<select class="input-lg">
																<option value="0">Choose name</option>
																<option value="1">Alexandra</option>
																<option value="2">Alice</option>
																<option value="3">Anastasia</option>
																<option value="4">Avelina</option>
															</select> <i></i> </label>
													</section>
					
													<section>
														<label class="label">Multiple select</label>
														<label class="select select-multiple">
															<select multiple="" class="custom-scroll">
																<option value="1">Alexandra</option>
																<option value="2">Alice</option>
																<option value="3">Anastasia</option>
																<option value="4">Avelina</option>
																<option value="5">Basilia</option>
																<option value="6">Beatrice</option>
																<option value="7">Cassandra</option>
																<option value="8">Clemencia</option>
																<option value="9">Desiderata</option>
															</select> </label>
														<div class="note">
															<strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.
														</div>
													</section>
												</fieldset>
					
												<fieldset>
													<section>
														<label class="label">Textarea</label>
														<label class="textarea"> 										
															<textarea rows="3" class="custom-scroll"></textarea> 
														</label>
														<div class="note">
															<strong>Note:</strong> height of the textarea depends on the rows attribute.
														</div>
													</section>
					
													<section>
														<label class="label">Textarea resizable</label>
														<label class="textarea textarea-resizable"> 										
															<textarea rows="3" class="custom-scroll"></textarea> 
														</label>
													</section>
					
													<section>
														<label class="label">Textarea expandable</label>
														<label class="textarea textarea-expandable"> 										
															<textarea rows="3" class="custom-scroll"></textarea> 
														</label>
														<div class="note">
															<strong>Note:</strong> expands on focus.
														</div>
													</section>
												</fieldset>
					
												<fieldset>
													<section>
														<label class="label">Columned radios</label>
														<div class="row">
															<div class="col col-4">
																<label class="radio">
																	<input type="radio" name="radio" checked="checked">
																	<i></i>Alexandra</label>
																<label class="radio">
																	<input type="radio" name="radio">
																	<i></i>Alice</label>
																<label class="radio">
																	<input type="radio" name="radio">
																	<i></i>Anastasia</label>
															</div>
															<div class="col col-4">
																<label class="radio">
																	<input type="radio" name="radio">
																	<i></i>Avelina</label>
																<label class="radio">
																	<input type="radio" name="radio">
																	<i></i>Basilia</label>
																<label class="radio">
																	<input type="radio" name="radio">
																	<i></i>Beatrice</label>
															</div>
															<div class="col col-4">
																<label class="radio">
																	<input type="radio" name="radio">
																	<i></i>Cassandra</label>
																<label class="radio">
																	<input type="radio" name="radio">
																	<i></i>Clemencia</label>
																<label class="radio">
																	<input type="radio" name="radio">
																	<i></i>Desiderata</label>
															</div>
														</div>
													</section>
					
													<section>
														<label class="label">Inline radios</label>
														<div class="inline-group">
															<label class="radio">
																<input type="radio" name="radio-inline" checked="checked">
																<i></i>Alexandra</label>
															<label class="radio">
																<input type="radio" name="radio-inline">
																<i></i>Alice</label>
															<label class="radio">
																<input type="radio" name="radio-inline">
																<i></i>Anastasia</label>
															<label class="radio">
																<input type="radio" name="radio-inline">
																<i></i>Avelina</label>
															<label class="radio">
																<input type="radio" name="radio-inline">
																<i></i>Beatrice</label>
														</div>
													</section>
												</fieldset>
					
												<fieldset>
													<section>
														<label class="label">Columned checkboxes</label>
														<div class="row">
															<div class="col col-4">
																<label class="checkbox">
																	<input type="checkbox" name="checkbox" checked="checked">
																	<i></i>Alexandra</label>
																<label class="checkbox">
																	<input type="checkbox" name="checkbox">
																	<i></i>Alice</label>
																<label class="checkbox">
																	<input type="checkbox" name="checkbox">
																	<i></i>Anastasia</label>
															</div>
															<div class="col col-4">
																<label class="checkbox">
																	<input type="checkbox" name="checkbox">
																	<i></i>Avelina</label>
																<label class="checkbox">
																	<input type="checkbox" name="checkbox">
																	<i></i>Basilia</label>
																<label class="checkbox">
																	<input type="checkbox" name="checkbox">
																	<i></i>Beatrice</label>
															</div>
															<div class="col col-4">
																<label class="checkbox">
																	<input type="checkbox" name="checkbox">
																	<i></i>Cassandra</label>
																<label class="checkbox">
																	<input type="checkbox" name="checkbox">
																	<i></i>Clemencia</label>
																<label class="checkbox">
																	<input type="checkbox" name="checkbox">
																	<i></i>Desiderata</label>
															</div>
														</div>
													</section>
					
													<section>
														<label class="label">Inline checkboxes</label>
														<div class="inline-group">
															<label class="checkbox">
																<input type="checkbox" name="checkbox-inline" checked="checked">
																<i></i>Alexandra</label>
															<label class="checkbox">
																<input type="checkbox" name="checkbox-inline">
																<i></i>Alice</label>
															<label class="checkbox">
																<input type="checkbox" name="checkbox-inline">
																<i></i>Anastasia</label>
															<label class="checkbox">
																<input type="checkbox" name="checkbox-inline">
																<i></i>Avelina</label>
															<label class="checkbox">
																<input type="checkbox" name="checkbox-inline">
																<i></i>Beatrice</label>
														</div>
													</section>
												</fieldset>
					
												<fieldset>
													<div class="row">
														<section class="col col-5">
															<label class="label">Radio Toggles</label>
															<label class="toggle">
																<input type="radio" name="radio-toggle" checked="checked">
																<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Alexandra</label>
															<label class="toggle">
																<input type="radio" name="radio-toggle">
																<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Anastasia</label>
															<label class="toggle">
																<input type="radio" name="radio-toggle">
																<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Avelina</label>
														</section>
					
														<div class="col col-2"></div>
					
														<section class="col col-5">
															<label class="label">Checkbox Toggles</label>
															<label class="toggle">
																<input type="checkbox" name="checkbox-toggle" checked="checked">
																<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Cassandra</label>
															<label class="toggle">
																<input type="checkbox" name="checkbox-toggle">
																<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Clemencia</label>
															<label class="toggle">
																<input type="checkbox" name="checkbox-toggle">
																<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Desiderata</label>
														</section>
													</div>
												</fieldset>
					
												<fieldset>
													<section>
														<label class="label">Ratings with different icons</label>
														<div class="rating">
															<input type="radio" name="stars-rating" id="stars-rating-5">
															<label for="stars-rating-5"><i class="fa fa-star"></i></label>
															<input type="radio" name="stars-rating" id="stars-rating-4">
															<label for="stars-rating-4"><i class="fa fa-star"></i></label>
															<input type="radio" name="stars-rating" id="stars-rating-3">
															<label for="stars-rating-3"><i class="fa fa-star"></i></label>
															<input type="radio" name="stars-rating" id="stars-rating-2">
															<label for="stars-rating-2"><i class="fa fa-star"></i></label>
															<input type="radio" name="stars-rating" id="stars-rating-1">
															<label for="stars-rating-1"><i class="fa fa-star"></i></label>
															Stars
														</div>
					
														<div class="rating">
															<input type="radio" name="trophies-rating" id="trophies-rating-7">
															<label for="trophies-rating-7"><i class="fa fa-trophy"></i></label>
															<input type="radio" name="trophies-rating" id="trophies-rating-6">
															<label for="trophies-rating-6"><i class="fa fa-trophy"></i></label>
															<input type="radio" name="trophies-rating" id="trophies-rating-5">
															<label for="trophies-rating-5"><i class="fa fa-trophy"></i></label>
															<input type="radio" name="trophies-rating" id="trophies-rating-4">
															<label for="trophies-rating-4"><i class="fa fa-trophy"></i></label>
															<input type="radio" name="trophies-rating" id="trophies-rating-3">
															<label for="trophies-rating-3"><i class="fa fa-trophy"></i></label>
															<input type="radio" name="trophies-rating" id="trophies-rating-2">
															<label for="trophies-rating-2"><i class="fa fa-trophy"></i></label>
															<input type="radio" name="trophies-rating" id="trophies-rating-1">
															<label for="trophies-rating-1"><i class="fa fa-trophy"></i></label>
															Trophies
														</div>
					
														<div class="rating">
															<input type="radio" name="asterisks-rating" id="asterisks-rating-10">
															<label for="asterisks-rating-10"><i class="fa fa-asterisk"></i></label>
															<input type="radio" name="asterisks-rating" id="asterisks-rating-9">
															<label for="asterisks-rating-9"><i class="fa fa-asterisk"></i></label>
															<input type="radio" name="asterisks-rating" id="asterisks-rating-8">
															<label for="asterisks-rating-8"><i class="fa fa-asterisk"></i></label>
															<input type="radio" name="asterisks-rating" id="asterisks-rating-7">
															<label for="asterisks-rating-7"><i class="fa fa-asterisk"></i></label>
															<input type="radio" name="asterisks-rating" id="asterisks-rating-6">
															<label for="asterisks-rating-6"><i class="fa fa-asterisk"></i></label>
															<input type="radio" name="asterisks-rating" id="asterisks-rating-5">
															<label for="asterisks-rating-5"><i class="fa fa-asterisk"></i></label>
															<input type="radio" name="asterisks-rating" id="asterisks-rating-4">
															<label for="asterisks-rating-4"><i class="fa fa-asterisk"></i></label>
															<input type="radio" name="asterisks-rating" id="asterisks-rating-3">
															<label for="asterisks-rating-3"><i class="fa fa-asterisk"></i></label>
															<input type="radio" name="asterisks-rating" id="asterisks-rating-2">
															<label for="asterisks-rating-2"><i class="fa fa-asterisk"></i></label>
															<input type="radio" name="asterisks-rating" id="asterisks-rating-1">
															<label for="asterisks-rating-1"><i class="fa fa-asterisk"></i></label>
															Asterisks
														</div>
														<div class="note">
															<strong>Note:</strong> you can use more than 300 vector icons for rating.
														</div>
													</section>
												</fieldset>
					
												<footer>
													<button type="submit" class="btn btn-primary">
														Submit
													</button>
													<button type="button" class="btn btn-default" onclick="window.history.back();">
														Back
													</button>
												</footer>
											</form>
					
										</div>
										<!-- end widget content -->
					
									</div>
									<!-- end widget div -->
					
								</div>
								<!-- end widget -->
					
							</article>
							<!-- END COL -->
						<!-- WIDGET END -->
						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				
							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">

								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2>Standard Data Tables </h2>
				
								</header>
				
								<!-- widget div-->
								<div>
				
									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->
				
									</div>
									<!-- end widget edit box -->
				
									<!-- widget content -->
									<div class="widget-body no-padding">
				
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>			                
												<tr>
													<th data-hide="phone">ID</th>
													<th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
													<th data-hide="phone"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Phone</th>
													<th>Company</th>
													<th data-hide="phone,tablet"><i class="fa fa-fw fa-map-marker txt-color-blue hidden-md hidden-sm hidden-xs"></i> Zip</th>
													<th data-hide="phone,tablet">City</th>
													<th data-hide="phone,tablet"><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date</th>
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>

									</div>
									<!-- end widget content -->
				
								</div>
								<!-- end widget div -->
				
							</div>
							<!-- end widget -->
				
						</article>
						<!-- WIDGET END -->
				
					</div>
				
					<!-- end row -->
				
					<!-- end row -->
				
				</section>
				<!-- end widget grid -->

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->


		<!-- PAGE FOOTER -->

		<?php include __DIR__ . '/templates/footer.php'; // Memanggil file functions.php ?>
		<!-- END PAGE FOOTER -->


		<script>
		
		// DO NOT REMOVE : GLOBAL FUNCTIONS!
		
		$(document).ready(function() {
			
			pageSetUp();
			
			/* // DOM Position key index //
		
			l - Length changing (dropdown)
			f - Filtering input (search)
			t - The Table! (datatable)
			i - Information (records)
			p - Pagination (paging)
			r - pRocessing 
			< and > - div elements
			<"#id" and > - div with an id
			<"class" and > - div with a class
			<"#id.class" and > - div with an id and class
			
			Also see: http://legacy.datatables.net/usage/features
			*/	
	
			/* BASIC ;*/
				var responsiveHelper_dt_basic = undefined;
				var responsiveHelper_datatable_fixed_column = undefined;
				var responsiveHelper_datatable_col_reorder = undefined;
				var responsiveHelper_datatable_tabletools = undefined;
				
				var breakpointDefinition = {
					tablet : 1024,
					phone : 480
				};
	
				$(document).ready(function () {
				    $('#dt_basic').dataTable({
				        "processing": true,
				        "serverSide": true,
				        "ajax": {
				            "url": "ajax/serverside-umum.php?table=warga", // Specify the table name here
				            "type": "POST"
				        },
				        // Define your DataTables options
						"preDrawCallback" : function() {
							// Initialize the responsive datatables helper once.
							if (!responsiveHelper_dt_basic) {
								responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
							}
						},
						"rowCallback" : function(nRow) {
							responsiveHelper_dt_basic.createExpandIcon(nRow);
						},
						"drawCallback" : function(oSettings) {
							responsiveHelper_dt_basic.respond();
						}
				    });
				});
	
			/* END BASIC */
			
			/* COLUMN FILTER  */
		    var otable = $('#datatable_fixed_column').DataTable({
		    	//"bFilter": false,
		    	//"bInfo": false,
		    	//"bLengthChange": false
		    	//"bAutoWidth": false,
		    	//"bPaginate": false,
		    	//"bStateSave": true // saves sort state using localStorage
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
				"autoWidth" : true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_fixed_column) {
						responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_fixed_column.respond();
				}		
			
		    });
		    
		    // custom toolbar
		    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
		    	   
		    // Apply the filter
		    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
		    	
		        otable
		            .column( $(this).parent().index()+':visible' )
		            .search( this.value )
		            .draw();
		            
		    } );
		    /* END COLUMN FILTER */   
	    
			/* COLUMN SHOW - HIDE */
			$('#datatable_col_reorder').dataTable({
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
				"autoWidth" : true,
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_col_reorder) {
						responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_col_reorder.respond();
				}			
			});
			
			/* END COLUMN SHOW - HIDE */
	
			/* TABLETOOLS */
			$('#datatable_tabletools').dataTable({
				
				// Tabletools options: 
				//   https://datatables.net/extensions/tabletools/button_options
				"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
						"t"+
						"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
				"oLanguage": {
					"sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
				},		
		        "oTableTools": {
		        	 "aButtons": [
		             "copy",
		             "csv",
		             "xls",
		                {
		                    "sExtends": "pdf",
		                    "sTitle": "SmartAdmin_PDF",
		                    "sPdfMessage": "SmartAdmin PDF Export",
		                    "sPdfSize": "letter"
		                },
		             	{
	                    	"sExtends": "print",
	                    	"sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
	                	}
		             ],
		            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
		        },
				"autoWidth" : true,
				"preDrawCallback" : function() {
					// Initialize the responsive datatables helper once.
					if (!responsiveHelper_datatable_tabletools) {
						responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
					}
				},
				"rowCallback" : function(nRow) {
					responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
				},
				"drawCallback" : function(oSettings) {
					responsiveHelper_datatable_tabletools.respond();
				}
			});
			
			/* END TABLETOOLS */
		
		})

		</script>


	</body>

</html>