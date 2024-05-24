<?php
  if (!function_exists('entities'))
  {
    function entities($field)
    {
      return !empty($field) ? htmlentities($field) : htmlentities("none");
    }
  }
?>


<div class="w3-container w3-black w3-round-medium" style="width:550px;" >
    <h2><?php echo $name ?></h2>
</div>


<?php if (is_array($entity)): ?>

  <table class="w3-table-all w3-container w3-round-medium w3-card-4 w3-padding-16" style="display: inline-block; max-height: 80vh; overflow-y: overlay;">
    <thead>
      <tr class='w3-black'>
        <th><?php echo implode('</th><th>', array_keys((array)current($entity))); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($entity as $row): ?>
      <tr>
        <td><?php echo implode('</td><td>', array_map('entities', (array)$row)); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table><br><br>

<?php else: ?>

  <table class="w3-table-all w3-container w3-round-medium w3-card-4 w3-padding-16" style="display: inline-block; max-height: 80vh; overflow-y: overlay;">
    <thead>
      <tr class='w3-black'>
        <th><?php echo implode('</th><th>', array_keys((array)$entity)); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo implode('</td><td>', array_map('entities', (array)$entity)); ?></td>
      </tr>
      
    </tbody>
  </table><br><br>

<?php endif; ?>
