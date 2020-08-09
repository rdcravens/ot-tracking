<head>
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js" integrity="sha384-XEerZL0cuoUbHE4nZReLT7nx9gQrQreJekYhJD9WNWhH8nEW+0c5qq7aIo2Wl30J" crossorigin="anonymous"></script>
<style>
     .desc:nth-child(even) {background-color: #f2f2f2;}
</style>
</style>
</head>
<body>
<?php

//require_once ('./vendor/autoload.php');

//Reading data from spreadsheet.
$tracking_live = Shippo::setApiKey('shippo_live_ec6a3a8f1a1b001866162bb5826ac8b1681ee1e1');
$tracking_test = Shippo::setApiKey('shippo_test_005caf853e23501dafbe806ee9e6dbc932861933');
$tracking_key = $tracking_test;
     
$client = new Google_Client();
$client->setApplicationName("OT Global Protection Ship Tracker");
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig('./credentials.json');
$service = new Google_Service_Sheets($client);

$spreadsheetId = '13CecB3s0czSJIWxQjIBwfpGExTULXk_IdtFMKzplZJ0'; //It is present in your URL
$get_range = 'Tracking!A2:C150';

//Request to get data from spreadsheet.
$response = $service->spreadsheets_values->get($spreadsheetId, $get_range);
$values = $response->getValues();

//var_dump($values);

?>
  <div class="row">
    <div class="col-1" style="text-align: left; font-size: 10px; font-weight: bold;">Order</div>
    <div class="col-1" style="text-align: left; font-size: 10px; font-weight: bold;">Carrier</div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;">Tracking #</div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;">Original ETA</div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;">New ETA</div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;">Current Status</div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;">Status Date</div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;">Notes</div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;">To Address</div>
  </div>

<?php
for($i=0;$i<count($values);$i++) {

$status_params = array(
    'id' => $values[$i][0],
    'carrier' => $values[$i][1]
);
$status = Shippo_Track::get_status($status_params);

?>
  <div class="row desc">
    <div class="col-1" style="text-align: left; font-size: 10px"><?php echo $values[$i][0].'-';  ?></div>
    <div class="col-1" style="text-align: left; font-size: 10px"><?php echo $values[$i][1].'<br>';  ?></div>
    <div class="col-1" style="text-align: left; font-size: 10px"><?php echo $values[$i][2].'<br>';  ?></div>
    <div class="col-1"><?php $webhook_response['original_eta'] ?></div>   
    <div class="col-1"><?php $webhook_response['eta'] ?></div>
    <div class="col-1"><?php $webhook_response['tracking_status'] ?></div>
    <div class="col-1"><?php $webhook_response['status_date'] ?></div>   
    <div class="col-3"><?php echo $values[$i][3].'<br>';  ?></div>
    <div class="col-2"><?php $webhook_response['address_to'] ?></div>
  </div>
<?php 
}
?>

<?php

// Are we updating as well?
//$update_range = 'Tracking!B2:B25';
//$values = [[$value1, $value2]];
//$body = new Google_Service_Sheets_ValueRange([
//      'values' => $values
//]);
//$params = [
//      'valueInputOption' => 'RAW'
//];
//$update_sheet = $service->spreadsheets_values->update($spreadsheetId, $update_range, $body, $params);
?>
</body>
