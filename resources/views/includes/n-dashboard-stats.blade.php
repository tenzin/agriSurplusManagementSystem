
<script>
//national dashboard
//product type 
var ctx = document.getElementById('productStats');
var productStats = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Vegetable','Fruit', 'Cereal','nwfp','Maps','Livestock','Dairy'],
        datasets: [{
            label: 'Statistics',
            {{-- //data: [{{$farmer}}, {{$luc}},{{$vsc}}],--}}
            data: [{{$allveg_count}}],
            // data:[45, 67, 67, 34, 45, 67, 100],
            backgroundColor: [
                'rgba(280, 99, 132, 0.8)',
                'rgba(0, 128, 0, 0.8)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(128, 128, 128, 0.4)',
                'rgba(0, 255, 0, 0.8)',
            ],
            borderColor: [


            ],
            borderWidth: 1
        }]
    },

});


//surplus info

var ctx = document.getElementById('surplusStats');
var surplusStats = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Vegetable','Fruit', 'Cereal','nwfp','Maps','Livestock','Dairy'],

        datasets: [{
            label: 'EO-Surplus',
            data: [{{$veg_count}}, {{$fruit_count}}, {{$dairy_count}}, {{$livestock_count}},{{$nwfp_count}},
                  {{$maps_count}},{{$cereal_count}}],
    
            backgroundColor: 'rgba(280, 99, 132, 1)',
            borderColor: [
            ],
            borderWidth: 1
        },
        {
            label: 'CA-Surplus',
            data: [{{$caveg_count}}, {{$cafruit_count}}, {{$cadairy_count}}, {{$calivestock_count}},{{$canwfp_count}},
                  {{$camaps_count}},{{$cacereal_count}}],

            backgroundColor: 'rgba(75, 192, 192, 0.5)',
            borderColor: [
            ],
            borderWidth: 1
        }
      ]
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
    	//display: false
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

//whole surplus
var ctx = document.getElementById('wholesurplus');
var wholesurplus = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb', 'March', 'April','May','Jun','July','Aug','Sept','Oct','Nov','Dec'],
        datasets: [{
            label: 'Statistics',
            data: [{{$casurplus_count[0]}},{{$casurplus_count[1]}},{{$casurplus_count[2]}},{{$casurplus_count[3]}},{{$casurplus_count[4]}},
            {{$casurplus_count[5]}},{{$casurplus_count[6]}},{{$casurplus_count[7]}},
            {{$casurplus_count[8]}},{{$casurplus_count[9]}},{{$casurplus_count[10]}},{{$casurplus_count[11]}}],

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