<?php

//function drawPetPhoto($photo_id, $photo_extension, $class) {
    //$photo_path = "../static/images/" . $photo_id . "." . $photo_extension;
?>
    
    <!-- <div class="<?php echo $class; ?>" >
        <div style="background: url(<?php echo $photo_path; ?>) no-repeat center /auto 100%"></div>
    </div> -->
<?php
//}

function drawOption($option_id, $option_name, $is_selected)
{
    /*
    * Draws a given option with its $option_id and $option_name
    */
    if ($is_selected) {
        echo '<option value="' . $option_id . '" selected>' . $option_name . '</option>';
    } else {
        echo '<option value="' . $option_id . '">' . $option_name . '</option>';
    }
}

function drawOptions($any_option, $options, $options_name, $options_id, $selected_value)
{
    /*
    * Draws a set of $options with the $options_id and $options_name tags
    */
    ?>
      <?php
        echo '<label for="' . $options_id . '">' . $options_name . '</label>';
        echo '<select name="' . $options_id . '" id="' . $options_id . '">';

        if ($any_option) {
            drawOption('any', 'Any', false);
        }

        foreach ($options as $option) {
            if ($selected_value == $option['id']) {
                drawOption($option['id'], $option['name'], true);
            } else {
                drawOption($option['id'], $option['name'], false);
            }
            echo "\n"; // improve readability
        }
        ?>
      </select>
    <?php
}
?>
