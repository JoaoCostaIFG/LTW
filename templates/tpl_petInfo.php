<?php 
include_once('../database/queries/db_post.php');

function drawOption($option_id, $option_name) {
    /*
    * Draws a given option with its $option_id and $option_name
    */
    echo '<option value="' . $option_id . '">' . $option_name . '</option>';
}
?>

<?php function drawOptions($options, $options_name, $options_id) {
    /*
    * Draws a set of $options with the $options_id and $options_name tags
    */
    echo '<p>' . $options_name . '<select name="' . $options_name . '" id="' . $options_id . '">';

    foreach ($options as $option)
        drawOption($option['id'], $option['name']);
    echo'</p></select>';
}
?>

<?php function drawSpecies() {
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
    drawOptions($options, 'Species', 'species');
}
?>

<?php function drawCities() {
    /*
    * Draws all Cities in the database
    */

    $cities = getCities();
    drawOptions($cities, 'Cities', 'cities');
}
?>


<?php function drawColors() {
    /*
    * Draws all colors in the database
    */
    $colors = getColors();
    drawOptions($colors, 'Colors', 'colors');
}
?>
