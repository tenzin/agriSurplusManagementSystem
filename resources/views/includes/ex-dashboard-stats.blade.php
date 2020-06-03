
<script>
var ctx = document.getElementById('surplus');
var surplus = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Vegetable','Fruit','Dairy','Livestock','NWFP','MAPS','Cereal'],
        datasets: [{
            label: 'Statistics',
            data: [{{$veg_count}}, {{$fruit_count}}, {{$dairy_count}}, {{$livestock_count}},{{$nwfp_count}},
                  {{$maps_count}},{{$cereal_count}}],
                  
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
            data: [{{$surplus_count[0]}},{{$surplus_count[1]}},{{$surplus_count[2]}},{{$surplus_count[3]}},{{$surplus_count[4]}},
            {{$surplus_count[5]}},{{$surplus_count[6]}},{{$surplus_count[7]}},
            {{$surplus_count[8]}},{{$surplus_count[9]}},{{$surplus_count[10]}},{{$surplus_count[11]}}],
           
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