
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<?php foreach($tables as $tableName => $table): ?>

  <h1><?php echo $tableName ?></h1>
  <?php if (count($table) > 0): ?>
    <table  class="w3-table-all">
      <thead>
        <tr class='w3-blue'>
          <th><?php echo implode('</th class="w3-border-black"><th>', array_keys(current($table))); ?></th>
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



