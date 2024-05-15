<?php


function entities($field)
{
  $field = $field ?? "";
  return htmlentities($field);
}


$headerClasses = '';
$headerStyles = '';

$formClasses = '';
$formStyles = '';

$labelClasses = '';
$labelStyles = '';

$inputClasses = '';
$inputStyles = '';


?>


<?php foreach($data as $name => $object): ?>



  <form class="w3-container w3-card-4 w3-padding-16" style="display: inline-block; max-height: 80vh; overflow-y: overlay;">

    <div class="w3-container w3-black" style="width:550px; margin-bottom: 15px;" >
        <h2><?php echo $name ?></h2>
    </div>
    
    <?php $i = 0; ?>
    <?php foreach ($object as $row): ?>

      <?php if(count($object) > 1): ?>
        <div class="w3-container w3-gray w3-round-medium" style="width:500px;">
          <h6><?php echo $i ?></h6>
        </div>
      <?php endif; ?>

      <?php foreach ($row as $field => $value): ?>

        <div class="w3-group" style="min-width:500px;">
          <div style="min-width:200px;"><label class="w3-black w3-text-white w3-right-align w3-round-medium" style="display:inline-block; padding:5px;"><?php echo $field ?></label></div>
          <input type="text" name=<?php echo $field ?> value= <?php if(!empty($value)) { echo $value; } else echo 'none' ?> class="w3-border-bottom w3-animate-input w3-hover-grey" style="width:300px; padding:5px;"  disabled>
        </div class="w3-group">

      <?php endforeach; ?>
      <?php $i++; ?>
    <?php endforeach; ?>
  </form>

<?php endforeach;  ?>
