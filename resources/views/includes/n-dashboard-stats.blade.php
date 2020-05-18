
<script>
//national dashboard
var ctx = document.getElementById('productStats');
var productStats = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Vegetable','Fruit', 'Cereal','nwfp','Maps','Livestock','Dairy'],
        datasets: [{
            label: 'Statistics',
            {{-- //data: [{{$farmer}}, {{$luc}},{{$vsc}}],--}}
            data:[45, 67, 67, 34, 45, 67, 100],
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
</script>