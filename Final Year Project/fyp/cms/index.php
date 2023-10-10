<?php
include 'Requires/session.php' ;
include 'Requires/header.php' ;
include 'Requires/page_top.php' ;
include 'Connect/connect.php' ;

$adminResult = $mysqli->query("SELECT * FROM system_admin WHERE admin_id = '".$idTmp."' AND admin_trash = 0");
if(mysqli_num_rows($adminResult)){
    $rowAdmin = mysqli_fetch_assoc($adminResult);
}

echo ' 


<div class="warper container-fluid">  

    <!--Title-->
    <div class="page-header"><h1>Dashboard <small>page</small></h1></div>
    <!--Title-->

    <!--Content Area-->
        <div class="panel panel-default" style="border-color:#337ab7">
            <div class="panel-heading" style="background-color:#337ab7"></div>
            <div class="panel-body">
                <div class="page_dashboard phoneHeaderDash" style="font-family: Libre Baskerville, serif;">
                    <h2 style="text-align: center; color: #0A0A0A;font-family: Jost,sans-serif;font-weight: 600;">Hey '.$rowAdmin['admin_username'].'! Welcome to the Dashboard</h2>
                    <p style="font-family: Libre Franklin, sans-serif;">If you need help getting started, check out to our user manual. If you need help, call us at <a href="tel:+6017 622 6799">+6017 622 6799</a> or email us <a href="mailto:kahchuan1911@gmail.com">kahchuan1911@gmail.com</a> to get information on how to use your current screen and where to go for more assistance.</p>
                </div>

                <div class="row laptopHeaderDash" style="font-family: Libre Baskerville, serif;">
                    <div class="col-lg-6" style="padding:40px">
                        <h2 style="color: #0A0A0A;font-family: Jost,sans-serif;font-weight: 600;">Hey '.$rowAdmin['admin_username'].'! Welcome to the Dashboard</h2>
                        <div style="font-family: Libre Franklin, sans-serif; font-size: 16px;
                        line-height: 1.6875;
                        font-weight: 400;color:#0A0A0A;margin: 19px 0 21px;">If you need help getting started, check out to our user manual. If you need help, call us at <a href="tel:+6017 622 6799">+6017 622 6799</a> or email us <a href="mailto:kahchuan1911@gmail.com">kahchuan1911@gmail.com</a> to get information on how to use your current screen and where to go for more assistance.</div>
                    </div>
                    <div class="col-lg-6" style="text-align:center;padding-bottom:40px">
                        <img src="Images/danial.png">
                    </div>
                    
                </div>


            </div>
    </div>
    <!--Content Area-->';

    $query1 = $mysqli->query("SELECT user_id FROM system_user");
    $query2 = $mysqli->query("SELECT user_id FROM system_user WHERE user_trash = 0");
    $query3 = $mysqli->query("SELECT user_id FROM system_user WHERE user_trash = 1");

    echo'
    <!--PC Design-->
    <div class="row laptopDash" >
        <div class="col-lg-4 info-bar-left-adjust">
            <div class="panel panel-primary text-center info-bar-bottom-adjust">
                <div class="panel-heading info-bar-left-heading" style=""></div>
                <div class="panel-body">
                    <div class="row" style="display:flex">
                        <div class="col-lg-4" style="margin:auto">
                            <div style=" padding:1.5rem 0.1rem;background-color:rgba(102,145,231,.18);border-radius:0.25rem" >
                                <i class="fa fa-2x fa-users" style="color:rgb(102,145,231)" aria-hidden="true"></i>
                                
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div style="text-align:left;font-family: Rubik,sans-serif">Total No. Of Registered Users</div>
                            <h4 class="h2 mb-0" style="text-align:left;font-weight: bold;color: black;">'.mysqli_num_rows($query1).'</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary text-center">
                <!--<div class="panel-heading"></div>-->
                <div class="panel-body">
                    <div class="row" style="display:flex">
                        <div class="col-lg-4" style="margin:auto">
                            <div style=" padding:1.5rem 0.1rem;background-color:rgba(232,188,82,.18);;border-radius:0.25rem" >
                                <i class="fa fa-2x fa-user-plus" style="color:rgb(232,188,82)" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div style="text-align:left;font-family: Rubik,sans-serif">Total No. Of Active Users</div>
                            <h4 class="h2 mb-0" style="text-align:left;font-weight: bold;color: black;">'.mysqli_num_rows($query2).'</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 info-bar-right-adjust" >
            <div class="panel panel-primary text-center">
                <!--<div class="panel-heading"></div>-->
                <div class="panel-body">
                    <div class="row" style="display:flex">
                        <div class="col-lg-4" style="margin:auto">
                            <div style=" padding:1.5rem 0.1rem;background-color:rgba(80,195,230,.18);border-radius:0.25rem" >
                                <i class="fa fa-2x fa-user-times" style="color:rgb(80,195,230)" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div style="text-align:left;font-family: Rubik,sans-serif">Total No. Of Passive Users</div>
                            <h4 class="h2 mb-0" style="text-align:left;font-weight: bold;color: black;">'.mysqli_num_rows($query3).'</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Phone Design-->
    <div class="row phoneDash" >
        <div class="col-lg-4 info-bar-left-adjust">
            <div class="panel panel-primary text-center info-bar-bottom-adjust">
                <div class="panel-heading info-bar-left-heading" style=""></div>
                <div class="panel-body">
                    <div style="font-family: Rubik,sans-serif">Total No. Of Registered Users</div>
                    <h4 class="h2 mb-0" style="font-weight: bold;color: black;">'.mysqli_num_rows($query1).'</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary text-center">
                <!--<div class="panel-heading"></div>-->
                <div class="panel-body">
                    <div style="font-family: Rubik,sans-serif">Total No. Of Active Users</div>
                    <h4 class="h2 mb-0" style="font-weight: bold;color: black;">'.mysqli_num_rows($query2).'</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-4 info-bar-right-adjust" >
            <div class="panel panel-primary text-center">
                <!--<div class="panel-heading"></div>-->
                <div class="panel-body">
                    <div style="font-family: Rubik,sans-serif">Total No. Of Passive Users</div>
                    <h4 class="h2 mb-0" style="font-weight: bold;color: black;">'.mysqli_num_rows($query3).'</h4>
                </div>
            </div>
        </div>
    </div>

    <canvas id="myChart" style="width:100%;"></canvas>';

    $result = $mysqli->query("SELECT MONTH(user_createdDate) AS Month, COUNT(user_id) AS Count FROM system_user WHERE user_trash = '0' AND YEAR(user_createdDate) = '".date("Y")."' GROUP BY MONTH(user_createdDate), YEAR(user_createdDate);");

    $monthUser = [];
    if(mysqli_num_rows($result) > 0){
        
        $monthUserArray = [];
        $counter = 1;
        while($resultRow = mysqli_fetch_assoc($result)){
            $monthUserArray[$resultRow['Month']] = $resultRow['Count'];
        }

        for($i = 1 ; $i <= 12 ; $i++){

            if(array_key_exists($i,$monthUserArray)){
                array_push($monthUser,$monthUserArray[$i]);
            }else{
                array_push($monthUser,"0");
            }
            
        }

    }else{
        for($i = 0 ; $i < 12 ; $i++){
            array_push($monthUser,"0");
        }
    }
    //print_r($monthUser);

echo '
</div>';
?>

<script type="text/javascript">
        const ctx = document.getElementById('myChart');
        var arr = <?php echo json_encode($monthUser); ?>;
        //ctx.style.backgroundColor = '#ffffff'; //changing background color

        new Chart(ctx, {
            type: 'bar',
            backgroundColor : '#ffffff',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: '# of User Registered in <?=date("Y")?>',
                    data: arr,
                    borderWidth: 1,
                    // borderColor: 'rgb(75, 192, 192)',
                    // tension: 0.1,
                    
                    }]
            },
            options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
            }
        });
    </script>

<?php
include 'Requires/page_footer.php' ;
?>