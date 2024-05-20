
<div class="w3-container w3-black w3-round-medium" style="margin-top: 15px;" >
  <h2 id="name"><?php echo $name ?></h2>
</div>

<?php if (is_array($entity)): ?>

  <?php foreach($entity as $object): ?>
    
    <form class="w3-container w3-round-medium w3-card-4 w3-padding-16" style="display: inline-block; max-height: 80vh; overflow-y: overlay; margin: 10px;">

        <?php foreach ($object as $field => $value): ?>

          <div class="w3-group" style="min-width:500px;">

            <input type="text" name=<?php echo $field ?> value= '<?php if(!empty($value)) { echo $value; } ?>' class="w3-border-bottom w3-hover-grey" style="width:300px; padding:5px;"  <?php if(empty($method)) { echo 'disabled'; } ?> >
            <label class="w3-black w3-text-white w3-right-align w3-round-medium" style="display:inline-block; padding:5px;"><?php echo $field ?></label>

          </div class="w3-group">

        <?php endforeach; ?>
        
        <?php if(!empty($method)) { echo '<input class="w3-button w3-black w3-hover-blue w3-round-medium" type="submit" value="submit">'; } ?>
        
    </form>

  <?php endforeach;?>



<?php else: $object = $entity ?>

  <form class="w3-container w3-round-medium w3-card-4 w3-padding-16" style="display: inline-block; max-height: 80vh; overflow-y: overlay; margin: 10px;">

    <?php foreach ($object as $field => $value): ?>

      <div class="w3-group" style="min-width:500px;">

        <input type="text" name=<?php echo $field ?> value= '<?php if(!empty($value)) { echo $value; } ?>' class="w3-border-bottom w3-hover-grey" style="width:300px; padding:5px;"  <?php if(empty($method)) { echo 'disabled'; } ?> >
        <label class="w3-black w3-text-white w3-right-align w3-round-medium" style="display:inline-block; padding:5px;"><?php echo $field ?></label>

      </div class="w3-group">

    <?php endforeach; ?>

    <?php if(!empty($method)) { echo '<input class="w3-button w3-black w3-hover-blue w3-round-medium" onclick="javascript:'.$method.'(event)" value="submit">'; } ?>

</form>

<?php endif; ?>


<?php
  if (!empty($method))
  {
    echo '
      <script>
        document.querySelector("form").addEventListener("submit", '.$method.');
      </script>
    ';
  }
?>

