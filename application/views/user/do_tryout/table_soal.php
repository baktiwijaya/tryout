<?php echo $list->nama_soal; ?>

<?php $jawaban = $this->Crud_m->all_data('master_jawaban','*',"id_soal=$list->id_soal"); ?>

<?php foreach($jawaban as $key) : ?>
	<input type="radio" name="jawaban" value="<?php echo $key['is_true'] ?>">&nbsp;<?php echo $key['nama_jawaban']; ?>
	<br>
<?php endforeach; ?>
<br>
<button type="button" class="btn btn-primary">Lanjutkan</button>