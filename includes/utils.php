<?php
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

function setSessionMessage($type, $content) {
  $_SESSION['messages'] = array('type' => $type, 'content' => $content);
}

function getSessionMessage($type)
{
    if (!isset($_SESSION['messages']) || !isset($_SESSION['messages']['type'])) {
        return false;
    }

    if ($_SESSION['messages']['type'] !== $type) {
        return false;
    }

    $ret = $_SESSION['messages']['content'];
    $_SESSION['messages'] = [];
    return $ret;
}

function treatInputNonEmpty($input) {
  if (!isset($input))
    return null;

  $trimmedInput = trim($input);
  if (empty($trimmedInput))
    return null;

  return $trimmedInput;
}
?>
