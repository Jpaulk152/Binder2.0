
<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

<?php foreach($menus as $menuName => $menu): ?>

  <?php if (count($menu) > 0): ?>
  <h3><?php echo $menuName ?></h3>
    <table  class="w3-table-all">
      <thead>
        <tr class='w3-blue'>
          <th><?php echo implode('</th class="w3-border-black"><th>', array_keys(current($menu))); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($menu as $row): array_map('htmlentities', $row); ?>
        <tr>
          <td><?php echo implode('</td><td>', $row); ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
  </table><br><br>
  <?php endif; ?>

<?php endforeach;  ?>



