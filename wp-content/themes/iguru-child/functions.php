<?php
	
function wgl_child_scripts() {
	wp_enqueue_style( 'wgl-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wgl_child_scripts' );

/**
 * Your code here.
 *
 */


// Phone number validation : format and 10 digits
// Add code in your functions.php file 

function custom_contact_validation_filter( $result, $tag ) {

       // 'contact': is name of tag in contact form

       if ( 'mobile-number' == $tag->name ) {
           $re_format = '/^[0-9]{10}+$/';  //9425786311
           $your_contact = $_POST['mobile-number'];

           if (!preg_match($re_format, $your_contact , $matches)) {
                $result->invalidate($tag, "Please Enter valid phone number." );
           }

       }

       return $result;
 }

add_filter( 'wpcf7_validate_text*', 'custom_contact_validation_filter', 10, 2 );

add_filter( 'wpcf7_validate_text', 'custom_contact_validation_filter', 10, 2 );

/* Comment form validation on same page*/
function comment_validation_init() {
if(is_single() && comments_open() ) { ?>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
$('#commentform').validate({
rules: {
author: {
required: true,
minlength: 2
},
email: {
required: true,
email: true
},
comment: {
required: true,
minlength: 20
}
},
messages: {
author: "Please enter your name",
email: "Please enter a valid email address.",
comment: "Please enter your comment"
},
errorElement: "div",
errorPlacement: function(error, element) {
element.after(error);
}
});
});
</script>
<?php
}
}
add_action('wp_footer', 'comment_validation_init');
?>