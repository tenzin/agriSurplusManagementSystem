
<script>
var ctx = document.getElementById('userStats');
var userStats = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Farmer Group','Land User Certificate', 'ARDC','Vegetable Supply Company'],
        datasets: [{
            label: 'Statistics',
            data: [{{$farmer}}, {{$luc}}, {{$ardc}},{{$vsc}}],
            backgroundColor: [
                'rgba(280, 99, 132, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.2)',
            ],
            borderColor: [


            ],
            borderWidth: 1
        }]
    },

});

var ctx = document.getElementById('surplus');
var surplus = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Vegetable','Fruit', 'Livestock', 'Dairy','NWFP','MAPS','Cereal'],
        datasets: [{
            label: 'Statistics',
            {{--// data: [{{$lob}}, {{$gov_count}}, {{$service_count}}, {{$app_count}}],--}}
            data: [500, 5, 100, 10, 45, 6, 9],
            backgroundColor: [
                'rgba(280, 99, 132, 0.1)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(153, 102, 255, 0.2)',

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',

            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend: {
        	display: false
        },
      	tooltips: {
        	callbacks: {
          	label: function(tooltipItem) {
            console.log(tooltipItem)
            	return tooltipItem.yLabel;
            }
          }
        }
    }
});


var ctx = document.getElementById('monthsurplus');
var monthsurplus = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb', 'March', 'April','May','Jun','July','Aug','Sept','Oct','Nov','Dec'],
        datasets: [{
            label: 'Statistics',
            {{--// data: [{{$lob}}, {{$gov_count}}, {{$service_count}}, {{$app_count}}],--}}
            data: [500, 5, 100, 10, 45, 6, 9],
            backgroundColor: [
                'rgba(280, 99, 132, 0.1)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(280, 99, 132, 0.1)',


            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',

            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        legend: {
        	display: false
        },
      	tooltips: {
        	callbacks: {
          	label: function(tooltipItem) {
            console.log(tooltipItem)
            	return tooltipItem.yLabel;
            }
          }
        }
    }
});
</script>