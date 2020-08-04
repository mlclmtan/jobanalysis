<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Framework</title>
    <link rel="shortcut icon" href="jsfrmwk.png" type="image/x-icon">

    <style>
        .button:hover {background-color: #3e8e41}

        .button:active {
        background-color: #3e8e41;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
        }
    </style>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center my-5">
            <h1>工作機會統計</h1>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <canvas id="lineChart"></canvas>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
                <button type="button" class="button btn btn-primary" id="refresh" onclick="refresh();">Refresh Data</button>
                <button type="button" class="button btn btn-primary" id="in" onclick="datain();">今日輸入</button>
        </div>
    </div>


<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/js/mdb.min.js"></script>

<script>
    let refresh = () =>{
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'jsfrmwkdb.php',
            data: {
                'action': 'refresh'
            },
            success: function (jsarr) {
                if (jsarr[0] == 'NO') {
                    return;
                }
                let v=[], r=[], a=[],d=[];
                jsarr.forEach((element, index) => {
                    d[index] = element['d'];
                    v[index] = element['vue'];
                    r[index] = element['react'];
                    a[index] = element['angular'];
                });

                //line
                let ctxL = document.getElementById("lineChart").getContext('2d');
                let myLineChart = new Chart(ctxL, {
                    type: 'line',
                    data: {
                        labels: d,
                        datasets: [{
                                label: "Vue",
                                data: v,
                                backgroundColor: [
                                    'rgba(0, 255, 132, .05)',
                                ],
                                borderColor: [
                                    'rgba(0, 179, 0, .7)',
                                ],
                                borderWidth: 2
                            },
                            {
                                label: "React",
                                data: r,
                                backgroundColor: [
                                    'rgba(0, 115, 255, .05)',
                                ],
                                borderColor: [
                                    'rgba(0, 25, 255, .7)',
                                ],
                                borderWidth: 2
                            },
                            {
                                label: "Angular",
                                data: a,
                                backgroundColor: [
                                    'rgba(219, 36, 36, .05)',
                                ],
                                borderColor: [
                                    'rgba(255, 0, 0, .7)',
                                ],
                                borderWidth: 2
                            }
                        ]
                    },
                    options: {
                        responsive: true
                    }
                });

            }
        });
    }
    

    let datain = () => { //get and insert must different function
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'jsfrmwkdb.php',
            data: {
                'action': 'datain'
            },
            success: function (jsarr) {
                
                if (jsarr == null) {
                    alert('Duplicate insert');
                    return;
                }else{
                    document.querySelector('#chart').innerHTML = '';
					document.querySelector('#chart').innerHTML='<canvas id="lineChart"></canvas>';
                    refresh();
                }
            }
        });
    }

    refresh();

    function makeReq(hr){
        return new Promise((resolve,reject)=>{
            console.log('waiting for 2pm');
            if(hr==14){
                resolve(1);
            }else{
                reject(0);
            }
        })
    }

    window.setInterval(function(){ // Set interval for checking
        var date = new Date(); // Create a Date object to find out what time it is
        if(date.getHours() === 14){ // Check the time
            datain();
        }
    }, 1800000); // Repeat every 60000 milliseconds (1 day)

</script>
    
</body>
</html>



