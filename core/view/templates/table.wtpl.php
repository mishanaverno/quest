<h2 class="title"><?=$title?></h2>
<table class="table table-striped">
	<thead>
		<tr>
		<?php foreach($headers as $k => $v): ?>
		<?php if($v['visibility']): ?>
			<td><?=$v['label']?></td>
		<?php endif; ?>
		<?php endforeach; ?>
		</tr>	
	</thead>
	<tbody>
	<?php foreach ($rows as $k => $v): ?>
		<tr>
		<?php foreach ($v as $kk => $vv):?>
		<?php if($headers[$kk]['visibility']): ?>
			<td><?=$vv?></td>
		<?php endif; ?>
		<?php endforeach; ?>
		</tr>
	<?php endforeach; ?>	
	</tbody>
</table>


