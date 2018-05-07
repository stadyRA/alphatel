<?php
if (! defined ( 'BOOST' )) { exit ( "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> Эй, не озоруй. К данному файлу я тебе запрещаю прямой доступ. Теперь-то мне ясно, кто ковыряет мой сайт." ); }
if($msgraph) {
?>
	<script type="text/javascript">
	$(function () {
		var chart;
		$(document).ready(function() {
		chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container', type: 'line'
		},
		title: {
			text: 'Запросы к мастерсерверу'
		},
		subtitle: {
			text: 'за последние 7 дней'
		},
		xAxis: {
			categories: ['6 дней назад', '5 дней назад', '4 дня назад', '3 дня назад', '2 дня назад', 'Вчера', 'Сегодня']
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Количество IP адресов'
			}
		},
		legend: {
			layout: 'vertical',	backgroundColor: '#FFFFFF', align: 'left', verticalAlign: 'top', x: 100, y: 70, floating: true, shadow: true
		},
		tooltip: {
			formatter: function() {
				return this.y +' игрока(ов)';
			}
		},
		plotOptions: {
			column: {
				pointPadding: 0.2, borderWidth: 0
			}
		},
		series: [{
		name: 'Все запросы',
			<?php 
				$res = mysql_query("SELECT * FROM `settings` WHERE `type` = 'masterserver'") or die(mysql_error());
				$row = mysql_fetch_assoc($res);
				echo $row['all_ips'];
			?>
		},
		{
		name: 'Уникальные запросы',
		<?php 
			echo $row['uniqie_ips'];
		?>
		}]
		});
		});

	});
	</script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/modules/exporting.js"></script>
	<div id="container" style="min-width: 500px; height: 300px; margin: 0 auto"></div>
<?php
}
?>