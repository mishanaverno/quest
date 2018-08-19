<h2 class="title"><?=$title?></h2>
<table class="table table-striped">
	<thead>
		<tr>
		<?php foreach($headers as $k => $v): ?>
		<?php if($v['visibility']): ?>
			<td><?=$v['label']?></td>
		<?php endif; ?>
		<?php endforeach; ?>
			<td>Управление</td>
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
			<td>
				<a href="/admin?<?=GETP::add(['action'=>'edit','id'=>$v['id']], 'string')?>" class="icon-control"><i class="fas fa-edit"></i></a>
				<a href="/admin?<?=GETP::add(['action'=>'delete','id'=>$v['id']], 'string')?>" class="icon-control color-red"><i class="fas fa-trash"></i></a>
			</td>
		</tr>
	<?php endforeach; ?>	
	</tbody>
</table>

