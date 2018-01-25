<style>
	.report_container{
		border:1px solid #ccc;
		padding:10px;
	}
</style>
<?php 

  $i=0; $categories = ""; $budget = ""; $released=""; $total_budget = 0; $total_released=0;
  foreach($finance_report as $r){
     $categories .=  "\"".$r->grant_name."\",";
     $budget.=$r->budget.",";
	 $released.=$r->released.",";
	 $total_budget+=$r->budget;
	 $total_released+=$r->released;
    if($i==count($finance_report)){
      $categories = rtrim($categories,",");
      $budget = rtrim($budget,",");
      $released = rtrim($released,",");
    }
  }
?>
<script src="<?php echo base_url()."assets/js/highcharts.js";?>"></script>





<div class="container">

<div class="row">

<div class="col-md-6 report_container">
	<div class="col-md-12">
		<div id="overall_chart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th>Work Load</th>
					<td>
					<?php 
					$work_load =  $dashboard->previous_agreement_amount + $dashboard->current_agreement_amount - $dashboard->previous_expenses;
					echo $work_load;
					?>
					</td>
				</tr>
				<tr>
					<th>Budget</th>
					<td><?php echo $total_budget;?></td>
				</tr>
				<tr>
					<th>Released</th>
					<td><?php echo $total_released;?></td>
				</tr>
				<tr>
					<th>Expenditure</th>
					<td><?php $expenditure= $dashboard->previous_expenses + $dashboard->current_expenses; echo $expenditure?></td>
				</tr>
				<tr>
					<th>Balance</th>
					<td><?php echo $total_budget - $expenditure;?></td>
				</tr>
			</tbody>
		</table>
	</div>
	
</div>
<div class="col-md-6 report_container">
	<div class="col-md-12">
		<div id="status_chart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered">
			<thead>
				<th>Work Status</th>
				<th>Within Agreement Date</th>
				<th>Beyond Agreement Date</th>
				<th>Total</th>
			</thead>
			<tbody>
				<tr>
					<td>Not Started</td>
					<td><?php echo $dashboard->not_started_within;?></td>
					<td><?php echo $dashboard->not_started_beyond;?></td>
					<td><?php echo $dashboard->not_started_within+$dashboard->not_started_beyond;?></td>
				</tr>
				<tr>
					<td>In Progress</td>
					<td><?php echo $dashboard->in_progress_within;?></td>
					<td><?php echo $dashboard->in_progress_beyond;?></td>
					<td><?php echo $dashboard->in_progress_within+$dashboard->in_progress_beyond;?></td>
				</tr>
				<tr>
					<td>Completed</td>
					<td><?php echo $dashboard->completed_within;?></td>
					<td><?php echo $dashboard->completed_beyond;?></td>
					<td><?php echo $dashboard->completed_within+$dashboard->completed_beyond;?></td>
				</tr>
			</tbody>
		</table>
	</div>
	
</div>
</div>
<div class="row">
<div class="col-md-6 report_container">
	<div class="col-md-12">
		<div id="length_chart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th>Target Length</th>
					<td><?php echo $dashboard->target_length;?></td>
				</tr>
				<tr>
					<th>Completed Length</th>
					<td><?php echo $dashboard->completed_length;?></td>
				</tr>
			</tbody>
		</table>
	</div>
	
</div>
<div class="col-md-6 report_container">
	<div class="col-md-12">
		<div id="work_load_chart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th>Spillover</th>
					<td><?php echo $dashboard->previous_agreement_amount - $dashboard->previous_expenses;?></td>
				</tr>
				<tr>
					<th>New Sanction</th>
					<td><?php echo $dashboard->current_agreement_amount;?></td>
				</tr>
			</tbody>
		</table>
	</div>
	
</div>

</div>
<div class="row">
<div class="col-md-6 report_container">
	<div class="col-md-12">
		<div id="expenditure_chart" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered">
			<tbody>
				<tr>
					<th>Expenditure</th>
					<td><?php echo $dashboard->current_expenses;?></td>
				</tr>
				<tr>
					<th>Pending Bills</th>
					<td><?php echo $dashboard->pending_bills;?></td>
				</tr>
				<tr>
					<th>Probable Expenditure</th>
					<td><?php echo $dashboard->targets_remaining_year;?></td>
				</tr>
			</tbody>
		</table>
	</div>
	
</div>

<div class="row">
  <div class="col-md-6 report_container">
    <div id="finance_report" style="min-width: 310px; max-width: 800px; height: 530px; margin: 0 auto"></div>
  </div>
</div>

</div>



<script type="text/javascript">

$(function(){
	Highcharts.setOptions({
		lang: {
			thousandsSep: ','
		}
	});
	Highcharts.chart('finance_report', {
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Finance Report'
		},
		subtitle: {
			text: 'APPRED'
		},
		xAxis: {
			categories: [<?php echo $categories;?>],
			title: {
				text: null
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Crores',
				align: 'high'
			},
			labels: {
				overflow: 'justify'
			}
		},
		tooltip: {
			valueSuffix: ' Crores'
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -40,
			y: 0,
			floating: true,
			borderWidth: 1,
			backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			shadow: true
		},
		credits: {
			enabled: false
		},
		series: [{
			name: 'Budget',
			data: [<?php echo $budget;?>]
		}, {
			name: 'Released',
			data: [<?php echo $released;?>]
		}]
	});

	
	Highcharts.chart('overall_chart', {
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Finance Report'
		},
		xAxis: {
			categories: ["Work Load","Budget Allocated","Budget Released","Expenditure"],
			title: {
				text: null
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Crores',
				align: 'high'
			},
			labels: {
				overflow: 'justify'
			}
		},
		tooltip: {
			valueSuffix: ' Crores'
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: -40,
			y: 0,
			floating: true,
			borderWidth: 1,
			backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			shadow: true
		},
		credits: {
			enabled: false
		},
		series: [{
			name: 'INR',
			data: [<?php echo $work_load.",".$total_budget.",".$total_released.",".$expenditure;?>]
		}]
	});

	Highcharts.chart('status_chart', {
      chart: {
          type: 'bar'
      },
      title: {
          text: 'Work Status'
      },
      xAxis: {
          categories: ["Not Started","In Progress","Completed"],
          title: {
              text: null
          }
      },
      yAxis: {
          min: 0,
          title: {
              text: 'Works',
              align: 'high'
          },
          labels: {
              overflow: 'justify'
          }
      },
      plotOptions: {
          bar: {
              dataLabels: {
                  enabled: true
              }
          },
			series: {
				stacking: 'normal'
			}
      },
      legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'top',
          x: 0,
          y: 0,
          floating: true,
          borderWidth: 1,
          backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
          shadow: true
      },
      credits: {
          enabled: false
      },
      series: [{
		  	name:'Within Agreement',
			data: [<?php echo $dashboard->not_started_within.",".$dashboard->in_progress_within.",".$dashboard->completed_within;?>]
		},{
		  	name:'Beyond Agreement',
			data: [<?php echo $dashboard->not_started_beyond.",".$dashboard->in_progress_beyond.",".$dashboard->completed_beyond;?>]
		}]
  });
  
  	
	Highcharts.chart('length_chart', {
		chart: {
			type: 'bar'
		},
		title: {
			text: 'Length'
		},
		xAxis: {
			categories: ["Target Length (Kms)","Completed Length (Kms)"],
			title: {
				text: null
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Kms',
				align: 'high'
			},
			labels: {
				overflow: 'justify'
			}
		},
		tooltip: {
			valueSuffix: ' Kms'
		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'top',
			x: 0,
			y: 0,
			floating: true,
			borderWidth: 1,
			backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
			shadow: true
		},
		credits: {
			enabled: false
		},
		series: [{
			name: 'Length',
			data: [<?php echo $dashboard->target_length.",".$dashboard->completed_length;?>]
		}]
	});


	Highcharts.chart('work_load_chart', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Work Loads'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
					}
				}
			}
		},
		series: [{
			name: 'Crores',
			colorByPoint: true,
			data: [{
				name: 'Spillover',
				y: <?php echo $dashboard->previous_agreement_amount - $dashboard->previous_expenses; ?>
			}, {
				name: 'New Sanction',
				y: <?php echo $dashboard->current_agreement_amount; ?>
			}]
		}]
	});;
	
	Highcharts.chart('expenditure_chart', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: 'Expenditure'
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
					}
				}
			}
		},
		series: [{
			name: 'Crores',
			colorByPoint: true,
			data: [{
				name: 'Expenditure',
				y: <?php echo $dashboard->current_expenses; ?>
			}, {
				name: 'Pending Bills',
				y: <?php echo $dashboard->pending_bills; ?>
			}, {
				name: 'Probable Expenditure',
				y: <?php echo $dashboard->targets_remaining_year; ?>
			}]
		}]
	});;


});
</script>
