<?php echo $this->Global_m->getvalue('nama_soal','master_soal','id_soal',$list->id_soal); ?>

<?php $jawaban = $this->Crud_m->all_data('master_jawaban','*',"id_soal=$list->id_soal"); ?>

<?php $no = 1;foreach($jawaban as $key) : ?>
	<input type="radio" name="id_jawaban" value="<?php echo $key['is_true'] ?>" onclick="jawaban(this.value)">&nbsp;<?php echo $key['label']; ?>.&nbsp;<?php echo $key['nama_jawaban']; ?>
	<hr>
<?php $no++;endforeach; ?>
<br>

<script type="text/javascript">
	

	function jawaban(id) {
		$('#id_jawaban').val(id);
	}
</script>


