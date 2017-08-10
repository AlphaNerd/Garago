
<input type="hidden" value="<?php echo $id ?>" id="id_activiter">
<table id="indicateurs" class="table">
			<thead>
				<th><?php echo __("Num");?></th>
				<th><?php echo __("Description");?></th>
				<th><?php echo __("type");?></th>
				<th><?php echo __("Echéance");?></th>
				<th><?php echo __("cible");?></th>
				<th><?php echo __("Action");?></th>
				</thead>
				<tbody >
				<?php 
				foreach ($listeindicators as $listeindicator) 
				{
					?>
					<tr>
						<td><?php echo $NumeroActiviter; ?>.<?php echo $listeindicator['Indicator']['num']?></td>
						<td><?php echo $listeindicator['Indicator']['description']?></td>
						<td><?php echo $listeindicator['Indicator']['type']?></td>
						<td><?php echo $listeindicator['Indicator']['date_fin']?></td>
						<td><?php echo $listeindicator['Indicator']['cible']?></td>
						<td><i class="fa fa-trash" aria-hidden="true" id="<?php echo $listeindicator['Indicator']['id']?>"></i></td>
					</tr>
				<?php } ?>
				</tbody>
		
		</table>
