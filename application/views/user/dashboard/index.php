<?php
$user_id = $this->session->userdata('id');
$user_type = $this->session->userdata('user_type');
?>

<div class="panel panel-flat">
    <div class="panel-body">
    	<div class="row">
    		<div class="col-md-12">
    			<div class="row">
    				<div class="col-md-3">
    					<select class="form-control select2" id="tryout">
		    				<?php foreach ($tryout as $key) : ?>
		    					<option value="<?php echo $key['id_library'] ?>"><?php echo $this->Global_m->getvalue('nama_tryout','master_tryout','id_tryout',$key['id_tryout']); ?></option>
		    				<?php endforeach; ?>
		    			</select>
    				</div>
    			</div>
    		</div>
    		<hr>
    		<br>
    		<div class="col-md-12">
    			<div class="chart-container">
					<div class="chart has-fixed-height" id="chart"></div>
				</div>
    		</div>
    	</div>	
    </div>
</div>    

<script type="text/javascript">
	var id = $('#tryout').val();
	$(document).ready(function(){
		$('.select2').select2();
		get_data(id);

		$('#tryout').change(function(){
			var idt = $(this).val();
			get_data(idt);
		})
	})
	
	function get_data(id_tryout) {
		 $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>user/dashboard/get_data',
            data: {
            	id: id_tryout
            },
            beforeSend: function (data) {
                $.blockUI({
                    message: '<i class="icon-spinner4 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#1b2024',
                        opacity: 0.8,
                        zIndex: 1200,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        color: '#fff',
                        zIndex: 1201,
                        padding: 0,
                        backgroundColor: 'transparent'
                    }
                });
            },
            error: function (data) {
                $.unblockUI();
                alert('Proses data gagal', 'info')
            },
            success: function (data) {
                $.unblockUI();
                var obj = JSON.parse(data);
                set_grafik(obj);
            }
        })

	}

	function set_grafik(obj) {

		var dataset = [];
		console.log(obj)
		$.each(obj,function(a,v){
			var series_data = {};
			if(v.nilai == '' || v.nilai == null || isNaN(v.nilai)) {
				var nilai = 0;
			} else {
				var nilai = v.nilai;
			}
			series_data.name = v.nama_paket;
        	series_data.data = [parseFloat(nilai)];
			
            dataset.push(series_data);
		});
		Highcharts.chart('chart', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Nilai Tryout'
		    },
		    subtitle: {
		        text: $('#tryout option:selected').text()
		    },
		    xAxis: {
		        crosshair: true
		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Nilai'
		        }
		    },
		    tooltip: {
		        headerFormat: '<span style="font-size:10px"></span><table>',
		        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
		        footerFormat: '</table>',
		        shared: true,
		        useHTML: true
		    },
		    plotOptions: {
		        column: {
		            pointPadding: 0.2,
		            borderWidth: 0
		        }
		    },
		    series: dataset
		});
	}
</script>