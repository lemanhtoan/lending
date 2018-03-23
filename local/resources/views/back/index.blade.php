@extends('back.template')

@section('main')
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

	<script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartTransction", {
                title:{
                    text: "Thống kê khoản đầu tư - " + <?php echo date('m')?> + '/' +  <?php echo date('Y')?>
                },
                data: [
                    {
                        type: "column",
                        dataPoints: [
                            { label: "Tuần 1",  y: <?php echo $dataTrans['w1'] ?>  },
                            { label: "Tuần 2", y: <?php echo $dataTrans['w2'] ?> },
                            { label: "Tuần 3", y: <?php echo $dataTrans['w3'] ?>  },
                            { label: "Tuần 4",  y: <?php echo $dataTrans['w4'] ?>  }
                        ]
                    }
                ]
            });
            chart.render();

            var chart2 = new CanvasJS.Chart("chartUser", {
                title:{
                    text: "Thống kê khoản vay- " + <?php echo date('m')?> + '/' +  <?php echo date('Y')?>
                },
                data: [
                    {
                        type: "column",
                        dataPoints: [
                            { label: "Tuần 1",  y: <?php echo $dataUser['w1'] ?>  },
                            { label: "Tuần 2", y: <?php echo $dataUser['w2'] ?>  },
                            { label: "Tuần 3", y: <?php echo $dataUser['w3'] ?>  },
                            { label: "Tuần 4",  y: <?php echo $dataUser['w4'] ?>  }
                        ]
                    }
                ]
            });
            chart2.render();
        }
	</script>
	@include('back.partials.entete', ['title' => 'Trang quản trị hệ thống', 'icone' => 'dashboard', 'fil' => 'Trang quản trị hệ thống'])

	<div class="row">

		@include('back/partials/pannel', ['color' => 'primary', 'icone' => 'envelope', 'nbr' => $nbrUsers, 'name' => 'Khách hàng', 'url' => 'user', 'total' => 'Khách hàng'])

		@include('back/partials/pannel', ['color' => 'green', 'icone' => 'user', 'nbr' => $nbrBorrow, 'name' => 'Lượt vay', 'url' => 'borrow', 'total' => 'Lượt vay'])

		@include('back/partials/pannel', ['color' => 'red', 'icone' => 'envelope', 'nbr' => $nbrInvest, 'name' => 'Lượt đầu tư', 'url' => 'invest', 'total' => 'Lượt đầu tư'])

	</div>

	<div class="row" style="margin-top: 30px">
		<div class="col-md-6">
			<div id="chartTransction" style="height: 300px; width: 100%;"></div>
		</div>

		<div class="col-md-6">
			<div id="chartUser" style="height: 300px; width: 100%;"></div>
		</div>
	</div>
	<style>
		.canvasjs-chart-credit {
			display: none;
		}
	</style>
@stop


