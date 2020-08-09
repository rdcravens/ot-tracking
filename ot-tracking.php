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

require_once ('./vendor/autoload.php');
require_once ('./vendor/easypost/lib/easypost.php');

//Reading data from spreadsheet.
$tracking = \EasyPost\EasyPost::setApiKey('uFSLSdRREeyCXFUaOigD4g');
//\EasyPost\EasyPost::setApiKey('uFSLSdRREeyCXFUaOigD4g');
//$tracker = \EasyPost\Tracker::create(array("tracking_code" => "9400110898825022579493","carrier" => "USPS"));

$client = new Google_Client();
$client->setApplicationName("OT Global Protection Ship Tracker");
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig('./credentials.json');
$service = new Google_Service_Sheets($client);

$spreadsheetId = '13CecB3s0czSJIWxQjIBwfpGExTULXk_IdtFMKzplZJ0'; //It is present in your URL
$get_range = 'Tracking!A2:B25';

//Request to get data from spreadsheet.
$response = $service->spreadsheets_values->get($spreadsheetId, $get_range);
$values = $response->getValues();

//var_dump($values);

?>
  <div class="row">
    <div class="col-1" style="text-align: left; font-size: 10px; font-weight: bold;">Order</div>
    <div class="col-1" style="text-align: left; font-size: 10px; font-weight: bold;">Tracking</div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;"></div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;"></div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;"></div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;"></div>
    <div class="col-2" style="text-align: left; font-size: 10px; font-weight: bold;"></div>
  </div>

<?php
for($i=0;$i<count($values);$i++) {

$tracking_code = '1Z7434680496934031';
$carrier = 'UPS';
// create test tracker
//$tracker = \EasyPost\Tracker::create(array('tracking_code' => $tracking_code, 'carrier' => $carrier));
//$data = json_decode($json_data);

?>
  <div class="row desc">
    <div class="col-1" style="text-align: left; font-size: 10px"><?php echo $values[$i][0].'-';  ?></div>
    <div class="col-1" style="text-align: left; font-size: 10px"><?php echo $values[$i][1].'<br>';  ?></div>
    <div class="col-2"><?php //var_dump ($data); ?></div>
    <div class="col-2"></div>
    <div class="col-2"></div>
    <div class="col-2"></div>
    <div class="col-2"></div>
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
