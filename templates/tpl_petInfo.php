<?php 
include_once('../database/queries/db_post.php');

function drawGendersRadio() {
    /*
    * Draws Gender options
    */
?>
    <p>Gender<br><input type="radio" id="male" name="gender" value="0">
    <label for="male">Male</label><br>
    <input type="radio" id="female" name="gender" value="1">
    <label for="female">Female</label><br></p>

<?php }

function drawOption($option_id, $option_name, $is_selected) {
    /*
    * Draws a given option with its $option_id and $option_name
    */
    if ($is_selected)
        echo '<option value="' . $option_id . '" selected>' . $option_name . '</option>';
    else
        echo '<option value="' . $option_id . '">' . $option_name . '</option>';
}
?>

<?php function drawOptions($any_option, $options, $options_name, $options_id, $selected_value) {
    /*
    * Draws a set of $options with the $options_id and $options_name tags
    */

    echo $options_name . '<select name="' . $options_id . '" id="' . $options_id . '">';

    if ($any_option)
        drawOption('any', 'Any', false);

    foreach ($options as $option) {
        if ($selected_value == $option['id'])
            drawOption($option['id'], $option['name'], true);
        else
            drawOption($option['id'], $option['name'], false);
        echo "\n";
    }
    echo'</select>';
}
?>

<?php function drawSpecies($any_option, $selected_value) {
    /*
    * Draws a given species
    */
    $allSpecies = getSpecies();
    $options = array();
    foreach ($allSpecies as $species) {
        $option = array(
            'id' => $species['id'],
            'name' => $species['animal_name'] . ' - ' . $species['species_name']
        );
        array_push($options, $option);
    }
    drawOptions($any_option, $options, 'species', 'species', $selected_value);
}
?>

<?php function drawCities($any_option, $selected_value) {
    /*
    * Draws all Cities in the database
    */

    $cities = getCities();
    drawOptions($any_option, $cities, 'city', 'city', $selected_value);
}
?>


<?php function drawColors($any_option, $selected_value) {
    /*
    * Draws all colors in the database
    */
    $colors = getColors();
    drawOptions($any_option, $colors, 'colors', 'color', $selected_value);
}
?>

<?php function drawGenders($any_option, $selected_value) {
    /*
    * Draws all colors in the database
    */
    $option_male = array(
        'id' => '0',
        'name' => 'Male'
    );
    $option_female = array(
        'id' => '1',
        'name' => 'Female'
    );
    $genders = array($option_male, $option_female);
    drawOptions($any_option, $genders, 'gender', 'gender', $selected_value);
}
?>
