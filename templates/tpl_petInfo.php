<?php 
require_once '../database/queries/db_post.php';
require_once '../includes/utils.php';

function drawGendersRadio()
{
    /*
    * Draws Gender options
    * TODO remove <p>
    */
    ?>
    <p>Gender<br><input type="radio" id="male" name="gender" value="0">
    <label for="male">Male</label><br>
    <input type="radio" id="female" name="gender" value="1">
    <label for="female">Female</label><br></p>

<?php } ?>

<?php function drawSpecies($any_option, $selected_value)
{
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
    drawOptions($any_option, $options, 'Species', 'species', $selected_value);
}
?>

<?php function drawCities($any_option, $selected_value)
{
    /*
    * Draws all Cities in the database
    */

    $cities = getCities();
    drawOptions($any_option, $cities, 'City', 'city', $selected_value);
}
?>


<?php function drawColors($any_option, $selected_value)
{
    /*
    * Draws all colors in the database
    */
    $colors = getColors();
    drawOptions($any_option, $colors, 'Colors', 'color', $selected_value);
}
?>

<?php function drawGenders($any_option, $selected_value)
{
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
    drawOptions($any_option, $genders, 'Gender', 'gender', $selected_value);
}
?>

<?php function drawSizes($any_option, $selected_value)
{
    /*
    * Draws all colors in the database
    */
    $option_small = array(
        'id' => '1',
        'name' => 'Small'
    );
    $option_medium = array(
        'id' => '2',
        'name' => 'Medium'
    );
    $option_big = array(
        'id' => '3',
        'name' => 'Big'
    );
    $sizes = array($option_small, $option_medium, $option_big);
    drawOptions($any_option, $sizes, 'Size', 'size', $selected_value);
}
?>

<?php function drawStates($has_accepted_proposal, $selected_value)
{
    /*
    * -- 1 being prepared for adopt, 2 ready for adoption, 3 being prep and accepted, 4 being delivered, 5 delivered
    * Draws all colors in the database
    */
    $option_preparing = array(
        'id' => '1',
        'name' => 'Preparing for Adoption'
    );
    $states = array($option_preparing);

    if ($has_accepted_proposal) {
        $option_ready_delivery = array(
            'id' => '4',
            'name' => 'Ready for Delivery'
        );

        $option_delivered = array(
            'id' => '5',
            'name' => 'Delivered'
        );

        array_push($states, $option_delivered, $option_ready_delivery);
    } else {
        $option_ready_adoption = array(
            'id' => '2',
            'name' => 'Ready for Adoption'
        );
        array_push($states, $option_ready_adoption);
    }
    drawOptions(false, $states, 'State', 'state', $selected_value);
}
?>
