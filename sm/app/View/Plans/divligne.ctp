

<div class="divligne" id="divligne<?php echo $tab[0] ?>">
	<?php 
for ($i=0; $i <$tab[1] ; $i++) { 
	?>
<div style="resize: both;" class="titreTable">
<div class="composantVertical" style="resize: both;">
<div style="overflow: auto;resize: both;min-height:200px;min-width:200px;">

le contunu de objectif 1 1

</div>

</div>
<button class="delete" id="delete<?php echo $tab[0].'-'.$i;?>"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
<button class="unlock" id="unlock<?php echo $tab[0].'-'.$i;?>"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
<button class="edit" id="edit<?php echo $tab[0].'-'.$i;?>"><i class="fa fa-pencil" aria-hidden="true"></i></button>
</div>

	<?php
}
?>
</div>