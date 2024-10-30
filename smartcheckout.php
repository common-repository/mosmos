<?php
/**
* Plugin Name: WP Mosmos Direct
* Plugin URI: https://mosmos.co.ke/
* Description: Increase your sales by accepting flexible payments from your customers.
* Version: 2.1.7
* Author: Mosmos
* Author URI: https://mosmos.co.ke/
**/

add_action( 'woocommerce_after_add_to_cart_button', 'mosmosbutton' );
add_action( 'woocommerce_after_add_to_cart_button', 'mosmosbutton1' );
function MosmosSettingsLink($links) { 
  $settings_link = '<a href="options-general.php?page=mosmos">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'MosmosSettingsLink' );

function MosmosMyCustomPluginPage()
{
    add_options_page('Mosmos Settings', 'Mosmos', 'manage_options', 'mosmos', 'MosmosMyOptionsPage');
}
  add_action('admin_menu', 'MosmosMyCustomPluginPage');


function MosmosMyOptionsPage()
{
    
    ?>
    <h2>Mosmos Plugin Settings</h2>
   

    <form action="options.php" method="post" width="100%">
         <div class='' style="width:100%;">
<div class="tab" width="100%" style="background:lightgrey;">
  <button type="button" class="tablinks active" onclick="MosmosTabsPage(event, 'London')">Api Settings</button>
  <button type="button" class="tablinks" onclick="MosmosTabsPage(event, 'Paris')">Exclude Categories</button>
  <button type="button" class="tablinks" onclick="MosmosTabsPage(event, 'additional_settings')">Additional Settings</button>
 
</div>
<div id="London" class="tabcontent">
    <?php 
        settings_fields( 'mosmosplugin' );
        
        do_settings_sections( 'mosmos_plugin_one' ); ?>
         <!--<p><?php echo json_encode($all_categories) ?></p>-->
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save changes' ); ?>" />
</div>

<div id="Paris" class="tabcontent">
   <?php 
        settings_fields( 'mosmosplugin' );
        
        do_settings_sections( 'mosmos_plugin_two' ); ?>
         <!--<p><?php echo json_encode($all_categories) ?></p>-->
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save changes' ); ?>" />
</div>
<div id="additional_settings" class="tabcontent">
   <?php 
        settings_fields( 'mosmosplugin' );
        
        do_settings_sections( 'mosmos_plugin_three' ); ?>
         <!--<p><?php echo json_encode($all_categories) ?></p>-->
        <input name="submit" class="button button-primary" type="submit" value="<?php esc_attr_e( 'Save changes' ); ?>" />
</div>


<style>
    /* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;

  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #f0f0f1;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
    
</style>
<script>
    function MosmosTabsPage(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
document.getElementById("London").style.display = "block";

</script>
      
       
    </form>
    <?php
}
function MosmosRegisterCustomConfigurations() {
    register_setting( 'mosmosplugin', 'mosmosplugin', 'mosmosplugin_validate' );
    add_settings_section( 'api_settings', '', 'MosmosPluginText', 'mosmos_plugin_one' );
     add_settings_section( 'api_settings', '', 'MosmosPluginText', 'mosmos_plugin_two' );
     add_settings_section( 'api_settings', '', 'MosmosPluginText', 'mosmos_plugin_three' );
// add_settings_field( 'mosmos_setting_api_tab', 'API Key', 'mosmos_setting_api_tab', 'mosmos_plugin_one', 'api_settings' );
    add_settings_field( 'mosmos_setting_api_key', 'API Key', 'mosmos_setting_api_key', 'mosmos_plugin_one', 'api_settings' );
     add_settings_field( 'mosmos_setting_initial_deposit', 'Initial Deposit', 'mosmos_setting_initial_deposit', 'mosmos_plugin_one', 'api_settings' );
       add_settings_field( 'mosmos_setting_payment_period', 'Payment Period (Months)', 'mosmos_setting_payment_period', 'mosmos_plugin_one', 'api_settings' );
       add_settings_field( 'mosmos_setting_price_type', 'Price Type ', 'mosmos_setting_price_type', 'mosmos_plugin_one', 'api_settings' );
      //  add_settings_field( 'mosmos_setting_booking_type', 'Booking Type ', 'mosmos_setting_booking_type', 'mosmos_plugin_one', 'api_settings' );
      // add_settings_field( 'mosmos_setting_multiple', 'Variable Quantity', 'mosmos_setting_multiple', 'mosmos_plugin_one', 'api_settings' );
       // add_settings_field( 'mosmos_setting_button_text', 'Customise the Lipa Mos Mos button text ', 'mosmos_setting_button_text', 'mosmos_plugin_one', 'api_settings' );
     
         add_settings_field( 'mosmos_setting_categories', 'Exclude Categories ', 'mosmos_setting_categories', 'mosmos_plugin_two', 'api_settings' );
        
       //  add_settings_field( 'additional_configs', '  ', 'additional_configs', 'mosmos_plugin_three', 'api_settings' );
         add_settings_field( 'mosmos_setting_default_button', 'Display Widget  ', 'mosmos_setting_default_button', 'mosmos_plugin_three', 'api_settings' );
         add_settings_field( 'mosmos_setting_custom_button_style', '  ', 'mosmos_setting_custom_button_style', 'mosmos_plugin_three', 'api_settings' );
        // add_settings_field( 'mosmos_setting_multiple', 'Variable Quantity', 'mosmos_setting_multiple', 'mosmos_plugin_one', 'api_settings' );
             // add_settings_field( 'mosmos_setting_label_text', 'Customise the Lipa Mos Mos label text', 'mosmos_setting_label_text', 'mosmos_plugin_one', 'api_settings' );
        
         
         
       
       
       
       
    
  
}
add_action( 'admin_init', 'MosmosRegisterCustomConfigurations' );


function mosmosplugin_validate( $input ) {
   // $newinput['api_key'] = trim( $input['api_key'] );
    // if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['api_key'] ) ) {
    //     $newinput['api_key'] = '';
    // }

    return $input;
}

function MosmosPluginText() {
    echo '';
}
function mosmos_setting_api_tab() {
    $options = get_option( 'mosmosplugin' );
    echo "<div class='row col-12 w-100 btn-danger'>
   <div class='tab'>
  <button class='tablinks'>London</button>
  <button class='tablinks' >Paris</button>
  <button class='tablinks' >Tokyo</button>
</div>

<!-- Tab content -->
 </div>";
}

function mosmos_setting_api_key() {
    $options = get_option( 'mosmosplugin' );
    echo "<div class='row col-12 w-100 btn-danger'>
    <label class='text-black'> Paste Api key in this field <i class='fa fa-question-circle' aria-hidden='true' title='Api key will be used to autenticate your merchant account'></i>
    <textarea id='mosmos_setting_api_key' name='mosmosplugin[api_key]' type='text' value='' placeholder='Mosmos Api Key' class='col-12 form-control' width='100%' style='width:100%'  >" . esc_attr( $options['api_key'] ) . "</textarea> </div>";
}
function mosmos_setting_button_text() {
    $options = get_option( 'mosmosplugin' );
    echo "<div class='row col-12 w-100 btn-danger'>
    <label class='text-black'> Enter to change lipa mosmos button text <i class='fa fa-question-circle' aria-hidden='true' title='button text label'></i>
    <input id='mosmos_setting_button_text' name='mosmosplugin[button_text]' type='text' value='" . esc_attr( $options['button_text']==''?'LIPA MOS MOS':$options['button_text'] ) . "' placeholder='Button text' class='col-12 form-control' width='100%' style='width:100%'/> </div>";
}
function mosmos_setting_label_text() {
    $options = get_option( 'mosmosplugin' );
    echo "<div class='row col-12 w-100 btn-danger'>
    <label class='text-black'> Enter to change lipa mosmos label text <i class='fa fa-question-circle' aria-hidden='true' title='lipamosmos text label'></i>
    <textarea id='mosmos_setting_label_text' name='mosmosplugin[label_text]' type='text' value='' placeholder='Label text' class='col-12 form-control' width='100%' style='width:100%' >" . esc_attr( $options['label_text']==''?'Save with Lipa Mos Mos. Order today and pay the balance in flexible installments at 0% interest.':$options['label_text'] ) . "</textarea> </div>";
}
function mosmos_setting_initial_deposit() {
    $options = get_option( 'mosmosplugin' );
    echo "<div class='row col-12 w-100 btn-danger'>
    <label class='text-black'> Initial deposit <i class='fa fa-question-circle' aria-hidden='true' title='This is initial payment amount'></i>
    <input type='number' id='mosmos_setting_initial_deposit' name='mosmosplugin[initial_deposit]' type='text' value='" . esc_attr( $options['initial_deposit'] ) . "' placeholder='100' class='col-12 form-control' width='100%' style='width:100%'  /> </div>";
}
function mosmos_setting_payment_period() {
    $options = get_option( 'mosmosplugin' );
    echo "<div class='row col-12 w-100 btn-danger'>
    <label class='text-black'> Payment Period (Months) <i class='fa fa-question-circle' aria-hidden='true' title='Expected completion period in (months)'></i>
    <input type='number' id='mosmos_setting_payment_period' name='mosmosplugin[payment_period]' type='text' value='" . esc_attr( $options['payment_period'] ) . "' placeholder='3' class='col-12 form-control' width='100%' style='width:100%'  /> </div>";
}
function mosmos_setting_price_type() {
    $options = get_option( 'mosmosplugin' );
    $pprice_type=$options['price_type'];
        $price_type="none";
        $sale_type="none";
    if($pprice_type==""){
        $price_type="checked";
    }
     if($pprice_type==0){
        $price_type="checked";
    }
     if($pprice_type=="1"){
        $sale_type="checked";
    }
    
    echo "<div class='row col-12 w-100 btn-danger'>
    <label class='text-black'> Select Price Type  <i class='fa fa-question-circle' aria-hidden='true' title='This price is automatically used in creating booking'></i></labe>
       <div  class='form-group'>
         
            <div class='form-check'>
  <input class='form-check-input' type='radio' value='0' name='mosmosplugin[price_type]'  id='regular' ".$price_type."  >
  <label class='form-check-label' for='regular'>
    Regular Price 
  </label>
</div>
     <div  class='form-group'>
           
            <div class='form-check'>
  <input class='form-check-input' type='radio' value='1' name='mosmosplugin[price_type]' id='sale' ".$sale_type."  >
  <label class='form-check-label' for='sale'>
    Sale Price
  </label>
</div>

    </div>";
}
function mosmos_setting_custom_button_style(){
  $options = get_option( 'mosmosplugin' );
  $default_button_style=$options['default_button_style'];
  $default_button=$options['default_button'];
      $default_button_style_enabled="none";
      $default_button_style_disabled="none";
      ;
  if($default_button_style==""){
      $default_button_style_enabled="checked";
  }
   if($default_button_style==0){
      $default_button_style_enabled="checked";
  }
   if($default_button_style=="1"){
      $default_button_style_disabled="checked";
  }
  
  echo "<div class='row col-12 w-100 btn-danger' id='sec_mosmos_b'>
  <label class='text-black'> Widget Style  <i class='fa fa-question-circle' aria-hidden='true' ></i></label> <br>
     <div  class='form-group'>
       
          <div class='form-check'>

<input class='form-check-input' type='radio' value='0' name='mosmosplugin[default_button_style]'   id='regular' ".$default_button_style_enabled."  >
<label class='form-check-label' for='regular'>
 Enable background & border 
</label>
</div>
   <div  class='form-group'>
         
          <div class='form-check'>
<input class='form-check-input' type='radio' value='1' name='mosmosplugin[default_button_style]'  ".$default_button_style_disabled."  >
<label class='form-check-label' for='sale'>
Disable background and border
</label>
</div>

  </div>




  
  ";
  ?>
<script>
  var status_text=<?php echo $default_button; ?>;
  if (status_text!=1) {
    document.getElementById('sec_mosmos_b').style.display='none';
  }

</script>
  <?php
}
function additional_configs() {
  echo "<div class='row col-12 w-100 btn-danger'>
  <h4> Additional Configuration </h4> </div>";
}
function mosmos_setting_default_button() {
  $options = get_option( 'mosmosplugin' );
  $default_button=$options['default_button'];
      $default_button_enabled="none";
      $default_button_disabled="none";
      ;
  if($default_button==""){
      $default_button_enabled="checked";
  }
   if($default_button==0){
      $default_button_enabled="checked";
  }
   if($default_button=="1"){
      $default_button_disabled="checked";
  }
  
  echo "<div class='row col-12 w-100 btn-danger'>

  <label class='text-black'> Display Configurations  <i class='fa fa-question-circle' aria-hidden='true' ></i></label>
     <div  class='form-group'>
       
          <div class='form-check'>
<input class='form-check-input' type='radio' value='0' onClick='return button_style(this)'  name='mosmosplugin[default_button]'  id='regular' ".$default_button_enabled."  >
<label class='form-check-label' for='regular'>
  Use Button Display 
</label>
</div>
   <div  class='form-group'>
         
          <div class='form-check'>
<input class='form-check-input' type='radio' value='1' onClick='return button_style(this)' name='mosmosplugin[default_button]' id='btn_no_default' ".$default_button_disabled."  >
<label class='form-check-label' for='sale'>
  Use Text Display
</label>
</div>

  </div>
  <script>
function button_style(p){
  console.log(p.value);
  if(p.value==0){
    document.getElementById('sec_mosmos_b').style.display='none';
  }
  else{
    document.getElementById('sec_mosmos_b').style.display='block';
  }
}

  </script>
  ";?>

  <?php
}
function mosmos_setting_booking_type() {
  $options = get_option( 'mosmosplugin' );
  $ppbpooking_type=$options['booking_type'];
      $booking_type="none";
      $goal_type="none";
  if($ppbpooking_type==""){
      $booking_type="checked";
  }
   if($ppbpooking_type==0){
      $booking_type="checked";
  }
   if($ppbpooking_type=="1"){
      $goal_type="checked";
  }
  
  echo "<div class='row col-12 w-100 btn-danger'>
  <label class='text-black'> Select Booking Type  <i class='fa fa-question-circle' aria-hidden='true' title='This allows either booking or a goal creating'></i></labe>
     <div  class='form-group'>
       
          <div class='form-check'>
<input class='form-check-input' type='radio' value='0' name='mosmosplugin[booking_type]'  id='booking' ".$booking_type."  >
<label class='form-check-label' for='booking'>
  Booking 
</label>
</div>
   <div  class='form-group'>
         
          <div class='form-check'>
<input class='form-check-input' type='radio' value='1' name='mosmosplugin[booking_type]' id='goal' ".$goal_type."  >
<label class='form-check-label' for='goal'>
 Goal
</label>
</div>

  </div>";
}
function mosmos_setting_multiple() {
  $options = get_option( 'mosmosplugin' );
  $xx=$options['multiple_q'];
      $has_multiple="yes";
      $no_multiple='yes';
      // $goal_type="none";
  if($xx==""){
      $has_multiple="checked";
  }
   if($xx==0){
      $has_multiple="checked";
  }
   if($xx=="1"){
      $no_multiple="checked";
  }
  
  echo "<div class='row col-12 w-100 btn-danger'>
  <label class='text-black'> Change Product Quantity  <i class='fa fa-question-circle' aria-hidden='true' title='This allows customers change product quantity'></i></labe>
     <div  class='form-group'>
       
          <div class='form-check'>
<input class='form-check-input' type='radio' value='0' name='mosmosplugin[multiple_q]'  id='booking' ".$has_multiple."  >
<label class='form-check-label' for='booking'>
  Only Book one item 
</label>
</div>
   <div  class='form-group'>
         
          <div class='form-check'>
<input class='form-check-input' type='radio' value='1' name='mosmosplugin[multiple_q]' id='goal' ".$no_multiple."  >
<label class='form-check-label' for='goal'>
 Allow adding multiple quantity
</label>
</div>

  </div>";
}
function mosmos_setting_categories() {
    $options = get_option( 'mosmosplugin' );
    
    $str='';
    $taxonomy     = 'product_cat';
  $orderby      = 'name';  
  $show_count   = 0;      // 1 for yes, 0 for no
  $pad_counts   = 0;      // 1 for yes, 0 for no
  $hierarchical = 1;      // 1 for yes, 0 for no  
  $title        = '';  
  $empty        = 0;

  $args = array(
         'taxonomy'     => $taxonomy,
         'orderby'      => $orderby,
         'show_count'   => $show_count,
         'pad_counts'   => $pad_counts,
         'hierarchical' => $hierarchical,
         'title_li'     => $title,
         'hide_empty'   => $empty
  );
 $all_categories = get_categories( $args );
    foreach($all_categories as $key=>$category){
        $check="none";
        if(isset($options['categories'.$category->term_id])){
            $check="checked";
        }
       

        $str=$str."  <div class=' form-check' style='float:left;width:20%;'> <input class='form-check-input' type='checkbox' value='".$category->term_id."' name='mosmosplugin[categories".$category->term_id."] '  id='regular".$category->term_id."' ".$check."  >
        
  <label class='form-check-label' for='regular".$category->term_id."' >
    ".$category->name."
  </label>
</div>";


    }
    echo "<div class='row col-12 w-100 btn-danger'>
    <label class='text-black'> Exclude Categories  <i class='fa fa-question-circle' aria-hidden='true' title='Select all categories which do not support mosmos payments'></i>
     <div  class='form-group  '>

         
          ".$str."
  
    </div>";
   
}

add_action( 'woocommerce_after_add_to_cart_button', 'mosmosbutton' );
add_action( 'woocommerce_after_add_to_cart_button', 'mosmosbutton1' );

function mosmosbutton1(){
	global $product;
	 $options = get_option( 'mosmosplugin' );
	$term_list = wp_get_post_terms($product->get_id(),'product_cat',array('fields'=>'ids'));
$cat_id = (int)$term_list[0];
$cateID = $cat_id;
 if($product->get_sale_price()!=''){
  $pp=$product->get_sale_price();
  }else{
  $pp=$product->get_regular_price();
  } 
  $default_button=$options['default_button']

	?>

   
<script>
	var sq='<?php echo esc_attr($cateID) ?>';

	  var tag_id=sq.toString();
    function checkdetails() {
        <?php $options = get_option( 'mosmosplugin' ); ?>
     try {
      document.getElementById('mosmossection').style.visibility = 'block';
     } catch (error) {
      
     }
     try {
      document.getElementById('mosmossection1').style.visibility = 'block';
     } catch (error) {
      
     }
       <?php
$categories=0;
$initialdeposit=100;
$months=3;
$p=isset($options['categories'.$cateID]);
if(isset($options['categories'.$cateID])){
    $categories=true;
}
if(isset($options['initial_deposit']) && $options['initial_deposit']!=''){
   
    $initialdeposit=$options['initial_deposit'];
}

if(isset($options['payment_period']) && $options['payment_period']!=''){
   
    $months=$options['payment_period'];
}
else{
    $initialdeposit=100;
}
?>
var isenabled=<?php echo esc_attr($categories); ?>;
		   
		
        try {
          document.getElementById('mosmossection').style.display  = 'none';
        } catch (error) {
          
        }
        try {
          document.getElementById('mosmossection1').style.display  = 'none';
        } catch (error) {
          
        }
    if (isenabled==1) {
			
				
                //document.getElementById('mosmossection').style.display  = 'none';
				  
              } 
              else{
                mmdeposit=<?php echo esc_attr($initialdeposit); ?>;
				    
            mmperiod=<?php echo esc_attr($months) ?>;
				 try {
         
            document.getElementById('mosmossection').style.display  = 'block';
         } catch (error) {
          
         }

         try {
         
         document.getElementById('mosmossection1').style.display  = 'block';
      } catch (error) {
       
      }
              }
// 			   if(data.pricetype==null || data.pricetype==1){
				   
// 				   <?php
	
// 	if( !$product->is_type('variable')){
		?>

// 	var varProduct=true;

				   if(mmprice==""){
					mmprice='<?php echo esc_attr($pp); ?>';
          default_button= '<?php echo esc_attr($options['default_button']); ?>';
				   }

  
<?php
$options = get_option( 'mosmosplugin' );
$apikey=esc_attr( $options['api_key'] );


?>
var key ='<?php echo esc_attr($apikey); ?>';

// alert(key);
    // xmlhttp.open("GET", "https://mosmosbusiness.com/api/activetags?secret_key="+key, true);
    // xmlhttp.send();
    
}
checkdetails();	
</script>
<?php

}


function mosmosbutton(){
	global $product;
   $options = get_option( 'mosmosplugin' ); 
$default_button=$options['default_button'];
$default_button_style=$options['default_button_style'];
$default_button_style_text=$options['default_button_style_text'];
$section_id='';
if ($default_button_style=='' || $default_button_style==0) {
  # code...
  $section_id='mosmossection';
}else{
  $section_id='mosmossection1'; 
}
if ($default_button=='' || $default_button==0) {
  # code...
  $section_id='mosmossection';
}
	?>
  <script>
    display_style=<?php echo $default_button_style; ?>
  </script>
  <br>
  <br>
<div id="<?php echo $section_id ?>">
<?php 
  if ($default_button=='' || $default_button==0) {
    # code...
    ?>
   
	
  <br>
	<small>
		<p>
      
     Save-to-buy with Mosmos. Order today, lipa balance pole pole bila pressure. Pick up or get your order delivered when you reach your goal.

		</p>
	</small>
  <button id="mmBtn" type="button" > <small>Lipa pole pole with</small> <img style="padding-left: 5px" src='https://mosmos.co.ke/assets/img/logo/web-logo.png' height="70" width="70" /></button>
  <?php  }
  else{
  ?>
  <br>
  
	<small>
		<p id="mmText">
      
    Lipa pole pole with <a href="javascript:void(0)" id="mmBtnlink1">Mosmos</a> for <strong> <?php echo esc_attr($product->get_name()); ?></strong>. <a href="javascript:void(0)" id="mmBtnlink3">Click here</a> to start with only <strong>KES. <?php echo $options['initial_deposit']; ?></strong>, and complete the balance in flexible and convenient installments. <a id="mmBtnlink2" href="javascript:void(0)">Order Now.</a>

		</p>
    </small>
  <!-- <div id="mmBtn"> <small>Lipa pole pole with mosmos</small> </div> -->
<?php 

} ?>
<?php
if ($default_button_style==1) {
  # code...
  ?>
  <style>
    <?php echo $default_button_style_text; ?>
  </style>
  <?php
}
?>
</div>
	<?php
$options = get_option( 'mosmosplugin' );
$apikey=esc_attr( $options['api_key'] );
$booking_type=1;
//esc_attr( $options['booking_type'] );
$url="https://mosmosbusiness.com/js/mosmossmart.js?secret_key=".$apikey;
?>
<script>
  var api_key='<?php echo esc_attr( $options['api_key'] ); ?>';
</script>

 <script type="text/javascript" src="<?php echo esc_attr($url); ?>">
	

</script>
<script>
    display_style='<?php echo esc_attr( $options['default_button']); ?>'; 
    //alert(display_style);
</script>
<!-- <script type="text/javascript" src="https://business.mosmos.co.ke/js/mosmossmart.js?secret_key=eyJpdiI6IjZiVyttd2UrZ2UwY3Nwb21KcXB0dmc9PSIsInZhbHVlIjoiV2ZYbU5ZZ3hUQW5VeUdHWXgrTWpsUT09IiwibWFjIjoiY2Q5MGRkNjAzNjkxMGFiNmY3NDFjNWEzMjMwN2YwZDBmYTRlMmY4OGVhMzExNmJhMmFlZjAzZTFjMWYwMjk0NSJ9">
		   
  


</script> -->
<?php
	
	if( $product->is_type('variable')){
		?>
<script>
	var varProduct=true;
mmitemName='<?php echo esc_attr($product->get_name()); ?>';
var booking_type=1;
var multiple_q='<?php echo esc_attr( $options['multiple_q'] ); ?>';
var api_key='<?php echo esc_attr( $options['api_key'] ); ?>';

</script>


<?php
	}
	else{
		//regular_price
		////echo $product->price;
		?>
<script>
  var booking_type=1;
  var multiple_q='<?php echo esc_attr( $options['multiple_q'] ); ?>';
<?php $options = get_option( 'mosmosplugin' ); ?>
	var varProduct=false;
	var pricetype=<?php echo esc_attr($options['price_type']); ?>;
  var api_key='<?php echo esc_attr( $options['api_key'] ); ?>';


	mmitemName='<?php echo esc_attr($product->get_name()); ?>';
	
 mmis_in_stock=true;
	
 if(pricetype==1){
   mmprice='<?php echo esc_attr($product->get_sale_price()); ?>';  
 }
 else{
     mmprice='<?php echo esc_attr($product->get_regular_price()); ?>';
 }

 mmweight='<?php echo esc_attr($product->get_weight()); ?>';
// console.log(<?php echo esc_attr($product); ?>);
</script>




<?php
	}
	
	
}


add_action( 'woocommerce_before_add_to_cart_quantity', 'MosmosOptionVal' );
function MosmosOptionVal() {
    global $product;

    if ( $product->is_type('variable') ) {
        $variations_data =[]; // Initializing

        // Loop through variations data
        foreach($product->get_available_variations() as $variation ) {
            // Set for each variation ID the corresponding price in the data array (to be used in jQuery)
            $variations_data[$variation['variation_id']] = $variation['display_price'];
        }
        ?>
        <script>
        jQuery(function($) {
            var jsonData = <?php echo json_encode($variations_data); ?>,
                inputVID = 'input.variation_id';
// 			   $('.variations select option').each( function() {
//          alert("helo");
//         });
         jQuery( '.variations_form' ).each( function() {
        jQuery(this).on( 'found_variation', function( event, variation ) {
            //console.log(variation);//all details here
            //var price = variation.display_price;//selectedprice
            var price=variation.display_regular_price;
			mmprice=price;
		
			mmis_in_stock=variation.is_in_stock;
 mmweight=variation.weight;
			mmitemName='<?php echo esc_attr($product->name); ?>';
            console.log(price);
			
        });
    });

        });
		
			
        </script>
        <?php
    }
}

