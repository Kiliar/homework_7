<ul style="list-style:none">
    <li>
        <?php 
            $meta_a_values = array('1','2','3','4');
            $meta_a = @get_post_meta($post->ID, 'meta_a', true);
            foreach ($meta_a_values as $meta_a_value) {
                unset($checked);
                if(isset($meta_a) && $meta_a_value == $meta_a) {$checked = 'checked';}
                echo '<label for="meta_a-'.$meta_a_value.'">meta_a-'.$meta_a_value.'</label>';
                echo '<input type="radio" id="meta_a-'.$meta_a_value.'" name="meta_a" value="'.$meta_a_value.'"'.$checked.' />';
            }
        ?>
    </li>
    <li>
        <label for="meta_b">meta_a</label>
        <input type="text" id="meta_b" name="meta_b" value="<?php echo @get_post_meta($post->ID, 'meta_b', true); ?>" />
    </li>
    <li>
        <label for="meta_c">meta_a</label>
        <input type="text" id="meta_c" name="meta_c" value="<?php echo @get_post_meta($post->ID, 'meta_c', true); ?>" />
    </li>
</ul>
<a id="on_click_ajax_magic" onclick="return false" href="#">Do you wanna see some magic?</a> 
<?php 
    add_action( 'admin_footer', 'ajax_magic_javascript' ); // Write our JS below here

function ajax_magic_javascript() { ?>
    <script type="text/javascript" >
    jQuery(document).ready(function($) {
        $("#on_click_ajax_magic").on("click", function() {
            var 
                $meta_a = $("input:radio[name=meta_a]:checked"),
                $meta_b = $("input[name=meta_b]"),
                $meta_c = $("input[name=meta_c]"),
                data = {
                'action': 'ajax_magic',
                'ajax_post_id': <?php the_ID(); ?>,
                'meta_a': $meta_a.val(),
                'meta_b': $meta_b.val(),
                'meta_c': $meta_c.val()
                 };
                console.log($meta_a.val(),$meta_b.val(),$meta_c.val());
                $.post(ajaxurl, data, function(response) {
                console.log(response);
                if(response == 0 || response == -1) {
                    alert("Failed");
                } else {
                    alert(response);
                };
            });
        });
    });
    </script> <?php
} 

?>