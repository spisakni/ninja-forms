<?php

add_action( 'admin_menu', 'ninja_forms_add_menu' );
function ninja_forms_add_menu(){
	$plugins_url = plugins_url();

	$capabilities = 'manage_options';
	$capabilities = apply_filters( 'ninja_forms_admin_menu_capabilities', $capabilities );

	$page = add_menu_page("Ninja Forms" , __( 'Forms', 'ninja-forms' ), $capabilities, "ninja-forms", "ninja_forms_admin", NINJA_FORMS_URL."/images/ninja-head-ico-small.png" );
	/*
	$all_forms = add_submenu_page("ninja-forms", __( 'Forms', 'ninja-forms' ), __( 'All Forms', 'ninja-forms' ), $capabilities, "ninja-forms", "ninja_forms_admin");
	$new_form = add_submenu_page("ninja-forms", __( 'Add New', 'ninja-forms' ), __( 'Add New', 'ninja-forms' ), $capabilities, "ninja-forms&tab=form_settings&form_id=new", "ninja_forms_admin");
	$subs = add_submenu_page("ninja-forms", __( 'Submissions', 'ninja-forms' ), __( 'Submissions', 'ninja-forms' ), $capabilities, "ninja-forms-subs", "ninja_forms_admin");
	$import = add_submenu_page("ninja-forms", __( 'Import/Export', 'ninja-forms' ), __( 'Import / Export', 'ninja-forms' ), $capabilities, "ninja-forms-impexp", "ninja_forms_admin");
	$settings = add_submenu_page("ninja-forms", __( 'Ninja Form Settings', 'ninja-forms' ), __( 'Settings', 'ninja-forms' ), $capabilities, "ninja-forms-settings", "ninja_forms_admin");
	$system_status = add_submenu_page("ninja-forms", __( 'System Status', 'ninja-forms' ), __( 'System Status', 'ninja-forms' ), $capabilities, "ninja-forms-system-status", "ninja_forms_admin");
	$extend = add_submenu_page("ninja-forms", __( 'Ninja Form Extensions', 'ninja-forms' ), __( 'Extend', 'ninja-forms' ), $capabilities, "ninja-forms-extend", "ninja_forms_admin");
	*/
	add_action('admin_print_styles-' . $page, 'ninja_forms_admin_css');
	add_action('admin_print_styles-' . $page, 'ninja_forms_admin_js');
	/*
	add_action('admin_print_styles-' . $new_form, 'ninja_forms_admin_css');
	add_action('admin_print_styles-' . $new_form, 'ninja_forms_admin_js');

	add_action('admin_print_styles-' . $settings, 'ninja_forms_admin_js');
	add_action('admin_print_styles-' . $settings, 'ninja_forms_admin_css');

	add_action('admin_print_styles-' . $import, 'ninja_forms_admin_js');
	add_action('admin_print_styles-' . $import, 'ninja_forms_admin_css');

	add_action('admin_print_styles-' . $subs, 'ninja_forms_admin_js');
	add_action('admin_print_styles-' . $subs, 'ninja_forms_admin_css');

	add_action('admin_print_styles-' . $system_status, 'ninja_forms_admin_js');
	add_action('admin_print_styles-' . $system_status, 'ninja_forms_admin_css');

	add_action('admin_print_styles-' . $extend, 'ninja_forms_admin_js');
	add_action('admin_print_styles-' . $extend, 'ninja_forms_admin_css');

	add_action( 'load-' . $page, 'ninja_forms_load_screen_options_tab' );
	//add_action( 'load-' . $all_forms, 'ninja_forms_load_screen_options_tab' );
	add_action( 'load-' . $settings, 'ninja_forms_load_screen_options_tab' );
	add_action( 'load-' . $import, 'ninja_forms_load_screen_options_tab' );
	add_action( 'load-' . $subs, 'ninja_forms_load_screen_options_tab' );
	add_action( 'load-' . $system_status, 'ninja_forms_load_screen_options_tab' );
	add_action( 'load-' . $extend, 'ninja_forms_load_screen_options_tab' );
	*/
}

function ninja_forms_admin(){
	global $wpdb, $ninja_forms_tabs, $ninja_forms_sidebars, $current_tab, $ninja_forms_tabs_metaboxes, $ninja_forms_admin_update_message;

	?>

	<div id="icon-ninja-custom-forms" class="icon32"><br></div>
	<h2>Form Editor - Your Form Title - ID : 16</h2>

	<div id="nav-menus-frame">
	<div id="menu-settings-column" class="metabox-holder">

		<div class="clear"></div>

		<div id="side-sortables" class="accordion-container">

			<ul class="outer-border">

				<li class="control-section accordion-section  open add-page top" id="add-page">
					<h3 class="accordion-section-title hndle" tabindex="0" title="Pages">General Fields</h3>
					<div class="accordion-section-content ">
						<div class="inside">
							<div class="button button-secondary ninja-forms-field-button">Single Line Text</div>
							<div class="button button-secondary ninja-forms-field-button">Multi Line Text</div>
							<div class="button button-secondary ninja-forms-field-button">Checkbox</div>
							<div class="button button-secondary ninja-forms-field-button">Dropdown List</div>
						</div><!-- .inside -->
					</div><!-- .accordion-section-content -->
				</li><!-- .accordion-section -->

				<li class="control-section accordion-section   add-custom-links" id="add-custom-links">
					<h3 class="accordion-section-title hndle" tabindex="0" title="Links">Advanced Fields</h3>
					<div class="accordion-section-content ">
						<div class="inside">
						</div><!-- .inside -->
					</div><!-- .accordion-section-content -->
				</li><!-- .accordion-section -->

				<li class="control-section accordion-section   add-category" id="add-category">
					<h3 class="accordion-section-title hndle" tabindex="0" title="Categories">Calculation Fields</h3>
					<div class="accordion-section-content ">
						<div class="inside">
						</div><!-- .inside -->
					</div><!-- .accordion-section-content -->
				</li><!-- .accordion-section -->

				<li class="control-section accordion-section   add-post_format bottom" id="add-post_format">
					<h3 class="accordion-section-title hndle" tabindex="0" title="Format">Layout Elements</h3>
					<div class="accordion-section-content  bottom">
						<div class="inside">
						</div><!-- .inside -->
					</div><!-- .accordion-section-content -->
				</li><!-- .accordion-section -->

			</ul><!-- .outer-border -->
		</div><!-- .accordion-container -->
	</div><!-- /#menu-settings-column -->

	<div id="menu-management-liquid">
		<div id="menu-management">
			<div class="menu-edit ">
				<div id="nav-menu-header">
					<div class="major-publishing-actions">
						<div class="publishing-action">
							<a href="#ex1" rel="modal:open"><input type="button" id="form_settings" class="open-settings-modal button button-secondary" value="Form Settings"></a>
						</div><!-- END .publishing-action -->
					</div><!-- END .major-publishing-actions -->
				</div><!-- END .nav-menu-header -->
				<div id="post-body">
					<div id="post-body-content">
						<h3>Forms Structure</h3>
						<p>Drag each item into the order you prefer. Click edit to reveal additional options.</p>
						<ul class="ninja-row ninja-drop" data-cols="0" style="padding:10px;" id="1">

						</ul>
						<ul class="ninja-row ninja-drop" data-cols="1" style="padding:2px;" id="2">
							<li class="ninja-col-1-1" data-size="1-1" id="4x4">
								<div class="ninja-forms-admin-field label-above open-settings-modal">
									<label>First Name</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 1
									</div>
								</div>
							</li>
						</ul>
						<ul class="ninja-row ninja-drop" data-cols="0" style="padding:10px;" id="3">

						</ul>
						<ul class="ninja-row ninja-drop" data-cols="2" style="padding:2px;">
							<li class="ninja-col-1-2" data-size="1-2" id="1 - 2x4">
								<div class="ninja-forms-admin-field label-above open-settings-modal">
									<label>Last Name</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 2
									</div>
								</div>
								<div class="nf-right-handlebar"></div>
							</li>

							<li class="ninja-col-1-2" data-size="1-2" id="2 - 2x4">
								<div class="ninja-forms-admin-field label-above">
									<div class="nf-left-handlebar"></div>
									<label>Email Address</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 3
									</div>
								</div>
							</li>
						</ul>
						<ul class="ninja-row ninja-drop" data-cols="0" style="padding:10px;">

						</ul>
						<ul class="ninja-row ninja-drop" data-cols="3" style="padding:2px;">
							<li class="ninja-col-1-3" data-size="1-3" id="1 - 1x3">
								<div class="ninja-forms-admin-field label-above">
									<label>Phone Number</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 4
									</div>
								</div>
								<div class="nf-right-handlebar"></div>
							</li>

							<li class="ninja-col-1-3" data-size="1-3" id="2 - 1x3">
								<div class="nf-left-handlebar"></div>
								<div class="ninja-forms-admin-field label-above">
									<label>Address 1</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 5
									</div>
								</div>
								<div class="nf-right-handlebar"></div>
							</li>

							<li class="ninja-col-1-3" data-size="1-3" id="3 - 1x3">
								<div class="nf-left-handlebar"></div>
								<div class="ninja-forms-admin-field label-above">
									<label>Address 2</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 6
									</div>
								</div>
							</li>
						</ul>
						<ul class="ninja-row ninja-drop" data-cols="0" style="padding:10px;">

						</ul>						
						<ul class="ninja-row" data-cols="4" style="padding:2px;">
							<li class="ninja-col-1-4" data-size="1-4" id="1 - 1x4">
								<div class="ninja-forms-admin-field label-above">
									<label>City</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 7
									</div>
								</div>
							</li>

							<li class="ninja-col-1-4" data-size="1-4" id="2 - 1x4">
								<div class="ninja-forms-admin-field label-above">
									<label>State</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 8
									</div>
								</div>
							</li>

							<li class="ninja-col-1-4" data-size="1-4" id="3 - 1x4">
								<div class="ninja-forms-admin-field label-above">
									<label>Zip</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 9
									</div>
								</div>
							</li>

							<li class="ninja-col-1-4" data-size="1-4" id="4 - 1x4">
								<div class="ninja-forms-admin-field label-above">
									<label>Country</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 10
									</div>
								</div>
							</li>
						</ul>
						<ul class="ninja-row ninja-drop" data-cols="0" style="padding:10px;">

						</ul>						
						<!-- <ul class="ninja-row">
							<li class="ninja-col-1-3" data-size="1-3">
								<div class="ninja-forms-admin-field label-above open-settings-modal">
									<label>Label</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 20
									</div>
								</div>
								<div class="nf-right-handlebar"></div>
							</li>							
							<li class="ninja-col-2-3" data-size="2-3">
								<div class="ninja-forms-admin-group label-above">
									<div class="nf-left-handlebar"></div>
									<label>Contact Info</label>

									<div class="ninja-forms-admin-field label-above open-settings-modal">
										<label>Label</label>
										<input type="text" disabled />
										<div class="nf-footer-left">
											<a href="#" class="open-settings-modal">Edit</a>
										</div>
										<div class="nf-footer-right">
											Single Line Text - ID : 20
										</div>
									</div>

									<div class="ninja-forms-admin-field label-above open-settings-modal">
										<label>Label</label>
										<input type="text" disabled />
										<div class="nf-footer-left">
											<a href="#" class="open-settings-modal">Edit</a>
										</div>
										<div class="nf-footer-right">
											Single Line Text - ID : 20
										</div>
									</div>

									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Group - ID : 20
									</div>
								</div>
							</li>
							
						</ul>-->
						
						<ul class="ninja-row ninja-drop" data-cols="2" style="padding:2px;">
							<li class="ninja-col-1-2" data-size="1-2">
								<div class="ninja-forms-admin-field label-above open-settings-modal">
									<label>Profile Name</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 20
									</div>
								</div>
								<div class="nf-right-handlebar"></div>
							</li>

							<li class="ninja-col-1-2" data-size="1-2">
								<div class="ninja-forms-admin-field label-above">
									<div class="nf-left-handlebar"></div>
									<label>Website</label>
									<input type="text" disabled />
									<div class="nf-footer-left">
										<a href="#" class="open-settings-modal">Edit</a>
									</div>
									<div class="nf-footer-right">
										Single Line Text - ID : 20
									</div>
								</div>
							</li>
						</ul>
						<ul class="ninja-row ninja-drop" data-cols="0" style="padding:10px;">

						</ul>

					</div><!-- /#post-body-content -->
				</div><!-- /#post-body -->
				<div id="nav-menu-footer">
					<div class="major-publishing-actions">
						<div class="publishing-action">
							<a class="submitdelete deletion menu-delete" href="/wp-admin/nav-menus.php?action=delete&amp;menu=6&amp;0=http%3A%2F%2Fnf.com%2Fwp-admin%2F&amp;_wpnonce=27e3bc67f9">Delete Form</a>
						</div><!-- END .publishing-action -->
					</div><!-- END .major-publishing-actions -->
				</div><!-- /#nav-menu-footer -->
			</div><!-- /.menu-edit -->
		</div><!-- /#menu-management -->
	</div><!-- /#menu-management-liquid -->
	</div>

  <div id="ex1" style="display:none;">
  	<a class="media-modal-close" href="#" title="Close">
  		<span class="media-modal-icon"></span>
  	</a>
  	<div class="media-frame wp-core-ui" id="__wp-uploader-id-0">

		<div class="media-frame-menu">
			<div class="media-menu">
				<a href="#" class="media-menu-item active" id="basic_settings">Basic Settings</a>
				<a href="#" class="media-menu-item" id="user_email_settings">User Emails</a>
				<a href="#" class="media-menu-item">Admin Emails</a>
				<div class="separator"></div>
				<a href="#" class="media-menu-item">Misc.</a>
			</div>
		</div>
		
		<div class="media-frame-title">
			<h1>Basic Settings</h1>
		</div>
		<!--
		<div class="media-frame-router">
			
			<div class="media-router">
				<a href="#" class="media-menu-item">Tab #1</a>
				<a href="#" class="media-menu-item active">Tab #2</a>
			</div>
			
		</div>
		-->
		<div class="media-frame-content" id="my-content-id">

			<p>Place your settings here.</p>
			<div class="hidden">
				<?php wp_editor( 'Hello World', 'hidden_input' ) ;?>
			</div>

		</div>

	</div>

 
  </div>

	<script type="text/html" id="tmpl-form-settings">
		<br />
		<% _.each(settings, function(setting){
			var setting_id = setting.get( 'id' );
			var value = setting.get( 'current_value' );

			%>
			<div>
			<%
			switch( setting.get('type') ) {
				case 'checkbox':
					%>
					<label>
						<input type="checkbox" id="<%= setting.id %>" class="<%= setting.get('class') %>" value="1" <% if ( value == 1 ) { %>checked<%}%>>
						<%= setting.get('label') %>
					</label>
					<%
					break;
				case 'select':
					%>
					<label>
						<%= setting.get('label') %>
						<select id="<%= setting.get('id') %>">
						<%
						_.each(setting.get('options'), function(option) {
							%>
							<option value="<%= option.value %>" <% if ( value == option.value ) { %> selected <% } %>><%= option.label %></option>
							<%
						});
						%>
						</select>
					</label>
					<%
					break;
				case 'textarea':
					%>
					<label>
						<%= setting.get('label') %>
						<textarea id="<%= setting.get('id') %>"><%= value %></textarea>
					</label>
					<%
					break;
			}
			%>
			</div>
		<% }); %>
	</script>
<?php

}

if(is_admin()){
	require_once(ABSPATH . 'wp-admin/includes/post.php');
}

function ninja_forms_get_current_tab(){
	global $ninja_forms_tabs;
	if(isset($_REQUEST['page'])){
		$current_page = $_REQUEST['page'];


		if(isset($_REQUEST['tab'])){
			$current_tab = $_REQUEST['tab'];
		}else{
			if(isset($ninja_forms_tabs[$current_page]) AND is_array($ninja_forms_tabs[$current_page])){
				$first_tab = array_slice($ninja_forms_tabs[$current_page], 0, 1);
				foreach($first_tab as $key => $val){
					$current_tab = $key;
				}
			}else{
				$current_tab = '';
			}
		}
		return $current_tab;
	}else{
		return false;
	}
}

function ninja_forms_date_to_datepicker($date){
	$pattern = array(

		//day
		'd',		//day of the month
		'j',		//3 letter name of the day
		'l',		//full name of the day
		'z',		//day of the year

		//month
		'F',		//Month name full
		'M',		//Month name short
		'n',		//numeric month no leading zeros
		'm',		//numeric month leading zeros

		//year
		'Y', 		//full numeric year
		'y'		//numeric year: 2 digit
	);
	$replace = array(
		'dd','d','DD','o',
		'MM','M','m','mm',
		'yy','y'
	);
	foreach($pattern as &$p)	{
		$p = '/'.$p.'/';
	}
	return preg_replace($pattern,$replace,$date);
}

function str_putcsv($array, $delimiter = ',', $enclosure = '"', $terminator = "\n") {
	# First convert associative array to numeric indexed array
	foreach ($array as $key => $value) $workArray[] = $value;

	$returnString = '';                 # Initialize return string
	$arraySize = count($workArray);     # Get size of array

	for ($i=0; $i<$arraySize; $i++) {
		# Nested array, process nest item
		if (is_array($workArray[$i])) {
			$returnString .= str_putcsv($workArray[$i], $delimiter, $enclosure, $terminator);
		} else {
			switch (gettype($workArray[$i])) {
				# Manually set some strings
				case "NULL":     $_spFormat = ''; break;
				case "boolean":  $_spFormat = ($workArray[$i] == true) ? 'true': 'false'; break;
				# Make sure sprintf has a good datatype to work with
				case "integer":  $_spFormat = '%i'; break;
				case "double":   $_spFormat = '%0.2f'; break;
				case "string":   $_spFormat = '%s'; $workArray[$i] = str_replace("$enclosure", "$enclosure$enclosure", $workArray[$i]); break;
				# Unknown or invalid items for a csv - note: the datatype of array is already handled above, assuming the data is nested
				case "object":
				case "resource":
				default:         $_spFormat = ''; break;
			}
							$returnString .= sprintf('%2$s'.$_spFormat.'%2$s', $workArray[$i], $enclosure);
				$returnString .= ($i < ($arraySize-1)) ? $delimiter : $terminator;
		}
	}
	# Done the workload, return the output information
	return $returnString;
}