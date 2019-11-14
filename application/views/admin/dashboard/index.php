<?php
$user_id = $this->session->userdata('id');
$user_type = $this->session->userdata('user_type');
?>

<div class="card">
	<div class="card-body">
		<div class="col-md-12">
			<div class="card bg-dark">
				<div class="card-body">
					penambahan user hari ini
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<h4>PER-USER-AN</h4>
		<div class="row">
			<div class="col-md-3">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>User Punya Koin</h3><br>
						<h1><b><?php echo $koin ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>User Punya Koin</h3><br>
						<h1><b><?php echo $poin; ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>User Punya Koin Poin</h3><br>
						<h1><b><?php echo $koinpoin; ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Total User (Termasuk Admin)</h3><br>
						<h1><b><?php echo $user; ?></b></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<h4>PER-POIN-AN</h4>
		<div class="row">
			<div class="col-md-4">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Poin dari IG</h3><br>
						<h1><b><?php echo $instagram; ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Poin dari FB</h3><br>
						<h1><b><?php echo $facebook; ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Poin dari Line</h3><br>
						<h1><b><?php echo $line; ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Poin dari Twitter</h3><br>
						<h1><b><?php echo $twitter; ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Poin dari WA</h3><br>
						<h1><b><?php echo $whatsapp; ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Poin dari Lainnya</h3><br>
						<h1><b><?php echo $other; ?></b></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-body">
		<h4>PER-UANG-AN</h4>
		<div class="row">
			<div class="col-md-3">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Revenue</h3><br>
						<h1><b><?php echo number_format($revenue,2,',','.'); ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Total Coin</h3><br>
						<h1><b><?php echo $coin; ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Total Poin</h3><br>
						<h1><b><?php echo $other; ?></b></h1>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card bg-dark">
					<div class="card-body">
						<h3>Perbandingan Poin To Coin</h3><br>
						<h1><b><?php echo $other; ?></b></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card">
			<div class="card-body">
				<h4>PER-TRYOUT-AN</h4>
				<table class="table table-dark table-bordered table-striped table-hover bg-info-700">
							<thead>
								<tr>
									<th>Nama Tryout</th>
									<th>Jumlah User Beli Pake Coin</th>
									<th>Jumlah User Beli Pake Poin</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Eugene</td>
									<td>Kopyov</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Victoria</td>
									<td>Baker</td>
								</tr>
								<tr>
									<td>3</td>
									<td>James</td>
									<td>Alexander</td>
								</tr>
							</tbody>
						</table>
			</div>
		</div>
<div id="content"></div>

<script type="text/javascript">
   
</script>