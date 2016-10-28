<?php 
$table =new \BModel\Modules\DY\BasicSettings();
$table=$table->getDetails();

?>
<div class="panel">
<div class="panel-header">
	<h2>Basic Settings</h2>
</div>
<p>
<table class="table table-striped table-bordered">
<tr>
<td>Site Name</td>
<td>{{ $table['SiteTitle'] }}</td>
</tr>
<tr>
<td>Keywords</td>
<td>{{ $table['Keywords'] }}</td>
</tr>
<tr>
<td>Logo Path</td>
<td>{{ $table['LogoPath'] }}</td>
</tr>
<tr>
<td>Copywrite Text</td>
<td>{{ $table['CopywriteText'] }}</td>
</tr>

</table>

	</p>
</div>