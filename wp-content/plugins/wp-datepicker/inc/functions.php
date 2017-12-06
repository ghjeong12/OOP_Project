<?php
	defined( 'ABSPATH' ) or die( __('No script kiddies please!', 'wp-datepicker') );


	//FOR QUICK DEBUGGING
	if(!function_exists('pre')){
	function pre($data){
			if(isset($_GET['debug'])){
				pree($data);
			}
		}	 
	} 
	
	if(!function_exists('pree')){
	function pree($data){
				echo '<pre>';
				print_r($data);
				echo '</pre>';	
		
		}	 
	} 




	function wpdp_menu()
	{



		 add_options_page('WP Datepicker', 'WP Datepicker', 'update_core', 'wp_dp', 'wp_dp');



	}

	function wp_dp(){ 



		if ( !current_user_can( 'install_plugins' ) )  {



			wp_die( __( 'You do not have sufficient permissions to access this page.', 'wp-datepicker' ) );



		}



		global $wpdb, $wpdp_dir, $wpdp_pro, $wpdp_data; 

		
		include($wpdp_dir.'inc/wpdp_settings.php');
		

	}	



	
	

	function wpdp_plugin_links($links) { 
		global $wpdp_premium_link, $wpdp_pro;
		
		$settings_link = '<a href="options-general.php?page=wp_dp">'.__('Settings', 'wp-datepicker').'</a>';
		
		if($wpdp_pro){
			array_unshift($links, $settings_link); 
		}else{
			 
			$wpdp_premium_link = '<a href="'.$wpdp_premium_link.'" title="'.__('Go Premium', 'wp-datepicker').'" target=_blank>'.__('Go Premium', 'wp-datepicker').'</a>'; 
			array_unshift($links, $settings_link, $wpdp_premium_link); 
		
		}
		
		
		return $links; 
	}
	
	function register_wpdp_scripts() {
		
			
		if (is_admin ()){
		
			wp_enqueue_media ();
		
			
			 
			wp_enqueue_script(
				'wpdp-scripts1',
				plugins_url('js/scripts.js', dirname(__FILE__)),
				array('jquery')
			);	
			
			
		
			wp_register_style('wpdp-style1', plugins_url('css/admin-styles.css', dirname(__FILE__)));	
			
			wp_enqueue_style( 'wpdp-style1' );
			
			wp_enqueue_script(
				'wpdp-scripts3',
				plugins_url('js/jqColorPicker.min.js', dirname(__FILE__)),
				array('jquery')
			);					
		
		}else{
					

		}
			wp_register_style('wpdp-style2', plugins_url('css/front-styles.css', dirname(__FILE__)));	
			
			wp_enqueue_style( 'wpdp-style2' );	

			
			wp_enqueue_script(
				'wpdp-scripts2',
				plugins_url('js/scripts-front.js', dirname(__FILE__)),
				array('jquery', 'jquery-ui-datepicker')
			);	
			
			
			$wp_datepicker_language = wpdp_slashes(get_option( 'wp_datepicker_language'));
			if($wp_datepicker_language!=''){
				$lang = explode('|', $wp_datepicker_language);
				$filename = (!empty($lang)?end($lang):$lang);
				
				if(substr($filename, 0, strlen('Select'))!='Select'){
					wp_enqueue_script(
						'wpdp-i18n',
						plugins_url('js/i18n/'.$filename, dirname(__FILE__)),
						array('jquery')
					);	
				}
			}
			
			
		
			
			wp_register_style('wpdp-style3', plugins_url('css/jquery-ui.css', dirname(__FILE__)));	
			
			wp_enqueue_style( 'wpdp-style3' );	
			
			
			if(wp_is_mobile()){
				
				wp_enqueue_style( 'jquery.ui.datepicker.mobile', plugins_url('css/mobile/jquery.ui.datepicker.mobile.css', dirname(__FILE__)), array(), date('Yhi'));
				/*wp_enqueue_script(
					'wpdp-datepicker-ui',
					plugins_url('js/mobile/jQuery.ui.datepicker.js', dirname(__FILE__)),
					array('jquery')
				);*/	
				wp_enqueue_script(
					'wpdp-datepicker-mobile',
					plugins_url('js/mobile/jquery.ui.datepicker.mobile.js', dirname(__FILE__)),
					array('jquery')
				);	
											
			}
							
	} 
		
	if(!function_exists('wp_datepicker')){
	function wp_datepicker(){

		
		}
	}
	
	
	if(!function_exists('wpdp_footer_scripts')){
	function wpdp_footer_scripts(){
		$wpdp_selectors = get_option( 'wp_datepicker');
		
		if($wpdp_selectors!=''){ 	
			$wpdp_selectors = wpdp_slashes($wpdp_selectors);
?>	
	
	<script type="text/javascript" language="javascript">
	

	jQuery(document).ready(function($){
		
		if($('.wpcf7-form-control.wpcf7-repeater-add').length>0){
			$('.wpcf7-form-control.wpcf7-repeater-add').on('click', function(){
				wpdp_refresh(jQuery, true);
			});
		}
		
<?php
			global $wpdp_options;
			//pree($wpdp_options);
			$options = array();
			if(!empty($wpdp_options)){
				$wpdp_options_db = get_option('wpdp_options');
				foreach($wpdp_options as $option=>$type){
					if(!isset($wpdp_options_db[$option])){
						$wpdp_options_db[$option] = '';
					}
					//pree($type);
					switch($type){
						default: 
							$val = $wpdp_options_db[$option];
							//pree($option);
							//pree($val);
							if($val==''){
								switch($option){
									case 'dateFormat':
										//$val = get_option('date_format'); pree($val);
										$val = 'mm/dd/yy'; //pree($val);
									break;
								}
							}
								
							$val = '"'.$val.'"';
							
						break;
						case 'checkbox':
							$val = ($wpdp_options_db[$option]==true?'true':'false');//exit;
						break;
					}
					$options[] = $option.': '.$val.'';
					//$options[] = array('key'=>$option, 'val'=>$val);
				}
			}
			//pre($options);
?>
	
});
var wpdp_refresh_first = true;
var wpdp_counter = 0;
function wpdp_refresh($, force){
<?php 
			if(!is_admin() || (isset($_GET['page']) && $_GET['page']!='wp_dp')): 
		
			$wp_datepicker_language = wpdp_slashes(get_option( 'wp_datepicker_language'));
			$wp_datepicker_months = get_option( 'wp_datepicker_months');
			if($wp_datepicker_language != ''){
				$code = current(explode('|', $wp_datepicker_language));
?>
		
				
				//$("<?php echo $wpdp_selectors; ?>").datepicker({<?php echo implode(', ', $options); ?>});
<?php
				$wpdp_selectors = explode(',', $wpdp_selectors);
				if(!empty($wpdp_selectors)){
					foreach($wpdp_selectors as $wpdp_selector){
						$wpdp_selector = trim($wpdp_selector);
?>	
				if(wpdp_refresh_first || force){
					$("<?php echo $wpdp_selector; ?>").datepicker( "destroy" );
					$("<?php echo $wpdp_selector; ?>").removeClass("hasDatepicker");
					wpdp_refresh_first = false;
				}
				$("<?php echo $wpdp_selector; ?>").on('mouseover, mousemove', function(){
				if(wpdp_counter>2)
				clearInterval(wpdp_intv);		
				
				if(!$("<?php echo $wpdp_selector; ?>").hasClass('hasDatepicker')){
				<?php if($wp_datepicker_months): ?>
				$.datepicker.regional.<?php echo $code; ?>.monthNamesShort = $.datepicker.regional.<?php echo $code; ?>.monthNames;
				<?php endif; ?>
					
				$("<?php echo $wpdp_selector; ?>").datepicker($.datepicker.regional[ "<?php echo $code; ?>" ]);
<?php 
					if(!empty($options)){
						
						foreach($options as $option){	
						$opt = explode(':', $option);
						
						$key = current($opt);
						
						array_shift($opt);
						
						
						$val = implode(':', $opt);
						if($val!=''){
?>
				$("<?php echo $wpdp_selector; ?>").datepicker( "option", "<?php echo $key; ?>", <?php echo $val; ?> );
<?php
						}
						}
					}
?>
				}
				});

<?php
					}
				}
?>
		
<?php
			}else{
?>
				$("<?php echo $wpdp_selectors; ?>").datepicker({dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'], <?php echo implode(', ', $options); ?>});
<?php				
			}
?>
		$('.ui-datepicker').addClass('notranslate');
<?php 
			endif; 
?>
}
	var wpdp_intv = setInterval(function(){
		wpdp_counter++;
		wpdp_refresh(jQuery, false);
	}, 100);
	
	</script>    
<?php		
		}
	}
	}
	
	function wpdp_slashes($str, $s=false){
		return str_replace(array('"'), "'", stripslashes($str));
	}
	
	function wpdp_free_settings(){
		global $wpdp_pro, $wpdp_fonts, $wpdp_options, $wpdp_styles;
		//pree($_POST);
				
		$wpdp_fonts = unserialize(base64_decode($wpdp_fonts));
		if(!empty($_POST) && !$wpdp_pro){
			//pree($_POST);exit;
			if(isset($_POST['wpdp_options']))
			update_option('wpdp_options', $_POST['wpdp_options']);
			
		}
		

?>
	<div class="wpdp_free_settings">
    
    
    <?php
		if(!empty($wpdp_options)){

			
			//pree($_POST);
			//pree($wpdp_options_db);
			foreach($wpdp_options as $item=>$type){
				?>
                
                <div style="clear:both; margin-top:20px;">
                <label for="<?php echo $item; ?>"><?php echo ucwords($item); ?>:</label>
                <?php 
					switch($type){
						case 'text':
						?>
                
                <input id="<?php echo $item; ?>" type="text" value="<?php echo (''!=wpdp_get($item))?wpdp_get($item):''; ?>" name="wpdp_options[<?php echo $item; ?>]" /> <a href="http://api.jqueryui.com/datepicker/#option-<?php echo $item; ?>" target="_blank" title="<?php _e('Click here for documentation about', 'wp-datepicker'); ?> <?php echo $item; ?>" style="text-decoration:none">?</a>
                <?php
						break;
						case 'checkbox':
						?>
                
                <input id="<?php echo $item; ?>" type="checkbox" value="1" <?php echo (''!=wpdp_get($item) && wpdp_get($item)==1)?'checked':''; ?> name="wpdp_options[<?php echo $item; ?>]" /> <a href="http://api.jqueryui.com/datepicker/#option-<?php echo $item; ?>" target="_blank" title="<?php _e('Click here for documentation about', 'wp-datepicker'); ?> <?php echo $item; ?>" style="text-decoration:none">?</a>
                <?php
						break;						
					}
						?>
                </div>
                <?php
			}
		}
    ?>
    </div>
<?php		
	}	
	if(!function_exists('wpdp_get')){
		function wpdp_get($index){
			global $wpdp_options;
			
			$wpdp_options_db = get_option('wpdp_options');
			$val = '';
			if(isset($wpdp_options_db[$index])){
				$val = $wpdp_options_db[$index];
			}
			return $val;
		}
	}	