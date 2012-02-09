<?php $this->load->view('default/header'); ?>
welcome


<ul>
<?php foreach($services as $row):?>
<li><?php echo $row->name?> (<?php echo (($row->token)?'connected':'<a href="'.site_url("service/request/".$row->id).'"" onclick="window.open(this.href,\''.$row->name.'_window\',\'height=200,width=700\'); return false;">connect</a>')?>)</li>
<?php endforeach;?>
</ul>

<?php $this->load->view('default/footer'); ?>