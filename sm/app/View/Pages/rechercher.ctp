

  <div ba-panel="" ba-panel-title="Standard Fields" ba-panel-class="with-scroll">
    <div class="panel panel-blur with-scroll animated zoomIn" zoom-in="" ba-panel-blur="" style="background-size: 1530px 861px; background-position: 0px -64px;min-height: 441px">
    <div class="panel-heading clearfix"><h3 class="panel-title">Search Document</h3>
    </div>

<div class="panel" id="body-content">

<?php 
         if(isset($documents))         
if(count($documents))
{
?>

<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>name</th>
      <th>description</th>
      <th>Users</th>
      <th>Creation Date</th>
    </tr>
  </thead>
<tbody>
<?php

foreach ($documents as $document) {
  $username=explode('_',$this->Session->read('username'))
	?>
	<tr onmouseup="colorswap(<?php  echo $document['documents']['id']; ?>)"  mousedown="clearDetail();" style"cursor: pointer;">
      <th scope="row"><?php  echo $document['documents']['id']; ?></th>
      <td><?php  echo $document['documents']['name']; ?></td>
      <td><?php  echo $document['documents']['description']; ?></td>
      <td><?php  //echo $username[0]." ".$username[1]; ?></td>
      <td><?php  echo $document['documents']['date_created']; ?></td>
    </tr>
  </a>
	<?php
}
}
?>

  </tbody>
</table>

</div>
</div>
</div>
