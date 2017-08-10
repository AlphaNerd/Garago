<div>
</div>
<div>
<table class="table">
<thead>
<tr>
<th><?php echo __("Date");?>
</th>
<th><?php echo __("Name");?>
</th>
<th><?php echo __("From");?>
</th>
<th><?php echo __("Cell");?>
</th>
<th><?php echo __("Organization");?>
</th>
<th><?php echo __("Comment");?>
</th>
<th><?php echo __("Option");?>
</th>
</tr>
</thead>
<tbody>
<?php foreach ($comments as $comment) {?>
<tr>
<td><?php echo $comment['Comment']['date_send']; ?></td>
<td><?php echo $comment['Comment']['name']; ?></td>
<td><?php echo $comment['Comment']['email_send']; ?></td>
<td><?php echo $comment['Comment']['ref_cellule']; ?></td>
<td><?php echo $comment['Comment']['organization']; ?></td>
<td><?php echo $comment['Comment']['message']; ?></td>

</tr>
<?php} ?>
</tbody>
</table>

</div>
<pre>
<?php
print_r($comments);

 ?>