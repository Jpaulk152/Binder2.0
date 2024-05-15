<?php
function entities($field)
{
  return !empty($field) ? htmlentities($field) : htmlentities("none");
}
?>

<?php foreach($data as $name => $object): ?>

  <?php if (count($object) > 0): ?>
  <h3><?php echo $name ?></h3>
    <table  class="w3-table-all" style="display: inline-block; max-height: 80vh; overflow-y: overlay;">
      <thead>
        <tr class='w3-blue'>
          <th><?php echo implode('</th><th>', array_keys((array)current($object))); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($object as $row): array_map('entities', (array)$row); ?>
        <tr>
          <td><?php echo implode('</td><td>', (array)$row); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
  </table><br><br>
  <?php endif; ?>

<?php endforeach;  ?>
