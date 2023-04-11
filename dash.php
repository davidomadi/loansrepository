<?php include("include/header.php");  

?>
<?php 

$ch=curl_init();

curl_setopt($ch, CURLOPT_URL, "http://localhost/loanstracker/include/JSON/loans.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

if($e=curl_error($ch)){
    echo $e;
} else {
    $decode = json_decode($resp, true);
}

curl_close($ch);
?>
    <!-- BEGIN: Page Main-->
    <div id="main">
        <div class="row">
            <div class="content-wrapper-before blue-grey lighten-5"></div>
            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <!--card stats start-->
                        <div id="card-stats" class="pt-0">
                            <div class="row">
                                <div class="col s12 m6 l6 xl3">
                                    <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s7 m7">
                                                    <i class="material-icons background-round mt-5">add</i>
                                                    <p>Total Requests</p>
                                                </div>
                                                <div class="col s5 m5 right-align">

                                                    <?php
                                                        $count_all=$conn->query("SELECT COUNT(*) AS all_requests FROM api_perfornamce");
                                                        $them_all = $count_all->fetch_assoc();
                                                    ?>


                                                    <h3 class="mb-0 white-text"><?= $them_all['all_requests']; ?></h3>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl3">
                                    <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s7 m7">
                                                    <i class="material-icons background-round mt-5">close</i>
                                                    <p>Failed Requests</p>
                                                </div>
                                                <div class="col s5 m5 right-align">
                                                    <?php
                                                        $count_fail=$conn->query("SELECT COUNT(*) AS all_requests FROM api_perfornamce WHERE request_state='FAIL'");
                                                        $fail_all = $count_fail->fetch_assoc();
                                                    ?>
                                                    <h3 class="mb-0 white-text"><?= $fail_all['all_requests'] ?></h3>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col s12 m6 l6 xl3">
                                    <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
                                        <div class="padding-4">
                                            <div class="row">
                                                <div class="col s7 m7">
                                                    <i class="material-icons background-round mt-5">check</i>
                                                    <p>Positive Requests</p>
                                                </div>
                                                <div class="col s5 m5 right-align">
                                                    <?php
                                                        $count_pass=$conn->query("SELECT COUNT(*) AS all_requests FROM api_perfornamce WHERE request_state='PASS'");
                                                        $pass_all = $count_pass->fetch_assoc();
                                                    ?>
                                                    <h3 class="mb-0 white-text"><?= $pass_all['all_requests'] ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col s12 m6 l4">
                                <div class="card padding-4 animate fadeLeft">
                                    <div class="row">
                                        <div class="col s5 m5">
                                            <h5 class="mb-0">Search Account</h5>
                                            <form action="" method="get">
                                                <input type="text" name="account_number" placeholder="account_number">
                                                <button type="submit" value="" class="mb-6 white-text btn waves-effect waves-light gradient-45deg-purple-deep-orange gradient-shadow"> Find Loans </button>
                                            </form>
                                        </div>
                                        <div class="col s7 m7 right-align">
                                            <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">search</i>
                                            <p class="mb-0">Enter Account number</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l8">
                                <div class="card subscriber-list-card animate fadeRight">
                                    <div class="card-content pb-1">
                                        <h4 class="card-title mb-0">Accounts Holders<i class="material-icons float-right">more_vert</i></h4>
                                    </div>

                                    <?php 
                                    $perform=array();
                                    if(isset($_GET['account_number'])){ $ac=$_GET['account_number']; 

                                    if(!is_numeric($ac)){ 
                                        //-------------UPDATE API PERFORMANCE TRACKER--------------------------------

                                        $perform['data']['request_tally']='1';
                                        $perform['data']['request_state']='FAIL';
                                        $perform['data']['details']='Value was not a Number!';

                                        $log_performance = databaseInsert('api_perfornamce', $perform['data']);
                                        $conn->query($log_performance);

                                        //----------------------------------------------------------------------------

                                        ?>



                                        <div class="card-alert card yellow">
                                            <div class="card-content black-text">
                                                <span class="card-title black-text darken-1">
                                                    <i class="material-icons">!</i> Warning!</span>
                                                <p><?php echo "You need to enter a number"; ?></p>
                                            </div>
                                            <button type="button" class="close black-text" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        
                                        <?php
                                    } else {
                                        if (countDigit($ac)==10) { ?>
                                    
                                    <table class="subscription-table responsive-table highlight">
                                        <thead>
                                            <tr>
                                                <th>Account Number</th>
                                                <th>Account Name</th>
                                                <th>Loan Identifier</th>
                                                <th>Amount</th>
                                                <th>Disbursed On</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                       <!-- <?php foreach ($decode as $loan) { 
                                            ?>
                                            <tr>
                                                <td><?= $loan['account_number'] ?></td>
                                                <td><?= $loan['account_name'] ?></td>
                                                <td><?= $loan['description'] ?></td>
                                                <td><?= $loan['amount'] ?></td>
                                            </tr>   

                                        <?php } ?>
                                             -->
                                             <?php
                                                //-------------UPDATE API PERFORMANCE TRACKER--------------------------------
                                                $perform['data']['request_tally']='1';
                                                $perform['data']['request_state']='PASS';
                                                $perform['data']['details']='Account Has at least one Outstanding Loan!';

                                                $log_performance = databaseInsert('api_perfornamce', $perform['data']);
                                                $conn->query($log_performance);

                                                //--------------------------------------------------------------------------
                                                
                                                $file=date("Ymdhm").'-loan.txt';
                                                $fh = fopen('API_REQUESTS/'.$file,'w+') or die($php_errormsg);
                                                $ch2=curl_init();

                                                curl_setopt($ch2, CURLOPT_URL, "http://localhost/loanstracker/include/JSON/loans.json");
                                                curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

                                                $resp = curl_exec($ch2);
                                                //$http_code = curl_getinfo($ch2, CURLINFO_HTTP_CODE);

                                                if($e=curl_error($ch2)){
                                                    echo $e;
                                                } else {
                                                    $decoder = json_decode($resp, true);

                                                    //echo "<h5> CODE: ".$http_code."</h5><br/>";
                                                    foreach ($decoder as $loan) {
                                                        if ($loan['account_number']!==@$ac) {

                                                            continue;
                                                        }   
                                                        elseif($loan['account_number']===@$ac){ 

                                                ?>
                                                           <tr>
                                                                <td><?= $loan['account_number'] ?></td>
                                                                <td><?= $loan['account_name'] ?></td>
                                                                <td><?= $loan['description'] ?></td>
                                                                <td><?= $loan['amount'] ?></td>
                                                                <td><?= date("d-M-Y", strtotime($loan['date_disbursed'])); ?></td>
                                                            </tr>




                                                      <?php 
                                                      fwrite($fh, "Account Number:".$loan['account_number']."\n");
                                                      fwrite($fh, "Account Name:".$loan['account_name']."\n");
                                                      fwrite($fh, "Loan Identifier:".$loan['description']."\n");
                                                      fwrite($fh, "Ammount Disbursed:".$loan['amount']."\n");
                                                      fwrite($fh, "Date Disbursed:".date("d-M-Y", strtotime($loan['date_disbursed']))."\n");
                                                      fwrite($fh, "\n");



                                                       }      
                                                        else { ?>
                                                            <div class="card-content pb-1 text"><h4 class="card-title mb-0"><?php echo "No Loans For ".$ac; ?><i class="material-icons float-right">check</i></h4></div>
    
                                               <?php
                                                $perform['data']['request_tally']='1';
                                                $perform['data']['request_state']='FAIL';
                                                $perform['data']['details']='Account has no Loans!';

                                                $log_performance = databaseInsert('api_perfornamce', $perform['data']);
                                                $conn->query($log_performance);

 
                                                        }
                                                        
                                                    }
                                                     
                                                }

                                                curl_close($ch2);
                                                ?>
                                        </tbody>
                                    </table>
                                    <?php         
                                        } else { 
                                           //-------------UPDATE API PERFORMANCE TRACKER--------------------------------
                                            $perform['data']['request_tally']='1';
                                            $perform['data']['request_state']='FAIL';
                                            $perform['data']['details']='Account Number did not have 10 digits!';

                                            $log_performance = databaseInsert('api_perfornamce', $perform['data']);
                                            $conn->query($log_performance);
                                            //---------------------------------------------------------------------------

                                            ?>
                                        <div class="card-alert card yellow">
                                            <div class="card-content black-text">
                                                <span class="card-title black-text darken-1">
                                                    <i class="material-icons">! </i> Warning!</span>
                                                <p><?php echo "Make sure the Account Number has <b>10 digits</b>."; ?></p>
                                            </div>
                                            <button type="button" class="close black-text" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                            
                                    <?php    }
                                    }
                                    } 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div><!-- START RIGHT SIDEBAR NAV -->
                    
                    
            </div>
        </div>
    </div>
    <!-- END: Page Main-->
<?php include("include/footer.php"); ?>