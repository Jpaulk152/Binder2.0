<?php
use \utilities as u;


u::dd($data);


?>




<?php foreach($tables as $tableName => $table): ?>

  <?php if (count($table) > 0): ?>
  <h3><?php echo $tableName ?></h3>
    <table  class="w3-table-all">
      <thead>
        <tr class='w3-blue'>
          <th><?php echo implode('</th><th>', array_keys(current($table))); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($table as $row): array_map('htmlentities', $row); ?>
        <tr>
          <td><?php echo implode('</td><td>', $row); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
  </table><br><br>
  <?php endif; ?>

<?php endforeach;  ?>



