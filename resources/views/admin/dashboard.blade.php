@extends("layouts.master_admin")

@section('page')

<?php

$total = array();
$dates = array();
if(!empty($mtotals)){
foreach ($mtotals as $key=>$value) {
$dates[] = date('M',strtotime($value->date_added));
$total[] = $value->total; 
} 
$ttotal = '"'.implode('","', $total).'"';
$tdates = '"'.implode('","', $dates).'"';
}
elseif(!empty($ytotals)){
foreach ($ytotals as $value) {
$dates[] = date('Y',strtotime($value->date_added));
$total[] = $value->total; 
} 
$ttotal = implode(",", $total);
$tdates = implode(",", $dates);
}
elseif(!empty($wtotals)){
foreach ($wtotals as $value) {
$dates[] = date('l',strtotime($value->date_added));
$total[] = $value->total; 
} 
$ttotal = '"'.implode('","', $total).'"';
$tdates = '"'.implode('","', $dates).'"';
}
else{
foreach (@$order_all as $value) {
// $dates[] = date('d',strtotime($value->date_added));
$total[] = $value->total; 
} 
$ttotal = implode(",", $total);
$tdates = implode(",", $dates);
}


?>




<div id="content">
<div class="page-header">
<div class="container-fluid">
<h1><?php echo $page_title; ?></h1>
<ul class="breadcrumb">
<li><a href="<?php echo url('admin/dashboard'); ?>">Home</a></li>
<li><a href="javascript:void();"><?php echo $page_title; ?></a></li>
</ul>
</div>
</div>
<div class="container-fluid">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-6">
<div class="tile tile-primary">
<div class="tile-heading">Total Orders  <span class="pull-right"> </span></div>
<div class="tile-body">
<i class="fa fa-shopping-cart"></i>
<h2 class="pull-right"><?php echo count($order_all); ?></h2>
</div>
<div class="tile-footer"><a href="<?php echo url('admin/orders'); ?>">View more...</a></div>
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-6">
<div class="tile tile-primary">
<div class="tile-heading">Total Sales  <span class="pull-right"> <?php //echo round(($sales['sale']/$sales['total'])*100 ); ?><!--%--></span></div>
<div class="tile-body">
<i class="fa fa-credit-card"></i>
<h2 class="pull-right"><?php echo round(($sales['sale'])); ?></h2>
</div>
<div class="tile-footer"><a href="<?php echo url('admin/orders'); ?>">View more...</a></div>
</div>
</div>
<div class="col-lg-4 col-md-4 col-sm-6">
<div class="tile tile-primary">
<div class="tile-heading">Total Subscriber <span class="pull-right"> <?php //echo $customer; ?><!--%--></span></div>
<div class="tile-body">
<i class="fa fa-user"></i>
<h2 class="pull-right"><?php echo $customer; ?></h2>
</div>
<div class="tile-footer"><a href="<?php echo url('admin/subscribe'); ?>">View more...</a></div>
</div>
</div>
<!--   <div class="col-lg-3 col-md-3 col-sm-6">
<div class="tile tile-primary">
<div class="tile-heading">People Online</div>
<div class="tile-body">
<i class="fa fa-users"></i>
<h2 class="pull-right">0</h2>
</div>
<div class="tile-footer"><a href="">View more...</a></div>
</div>
</div> -->
</div>
<div class="row">
<div class="col-lg-6 col-md-12 col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-globe"></i> World Map</h3>
</div>
<div id="vmap" style="width: 100%; height: 260px;"></div>
</div>
<link type="text/css" href="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/jqvmap/jqvmap.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/jqvmap/jquery.vmap.js"></script>
<script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/jqvmap/maps/jquery.vmap.world.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function() {
var sample_data = {"af":"16.63","al":"11.58","dz":"158.97","ao":"85.81","ag":"1.1","ar":"351.02","am":"8.83","au":"1219.72","at":"366.26","az":"52.17","bs":"7.54","bh":"21.73","bd":"105.4","bb":"3.96","by":"52.89","be":"461.33","bz":"1.43","bj":"6.49","bt":"1.4","bo":"19.18","ba":"16.2","bw":"12.5","br":"2023.53","bn":"11.96","bg":"44.84","bf":"8.67","bi":"1.47","kh":"11.36","cm":"21.88","ca":"1563.66","cv":"1.57","cf":"2.11","td":"7.59","cl":"199.18","cn":"5745.13","co":"283.11","km":"0.56","cd":"12.6","cg":"11.88","cr":"35.02","ci":"22.38","hr":"59.92","cy":"22.75","cz":"195.23","dk":"304.56","dj":"1.14","dm":"0.38","do":"50.87","ec":"61.49","eg":"216.83","sv":"21.8","gq":"14.55","er":"2.25","ee":"19.22","et":"30.94","fj":"3.15","fi":"231.98","fr":"2555.44","ga":"12.56","gm":"1.04","ge":"11.23","de":"3305.9","gh":"18.06","gr":"305.01","gd":"0.65","gt":"40.77","gn":"4.34","gw":"0.83","gy":"2.2","ht":"6.5","hn":"15.34","hk":"226.49","hu":"132.28","is":"12.77","in":"1430.02","id":"695.06","ir":"337.9","iq":"84.14","ie":"204.14","il":"201.25","it":"2036.69","jm":"13.74","jp":"5390.9","jo":"27.13","kz":"129.76","ke":"32.42","ki":"0.15","kr":"986.26","undefined":"5.73","kw":"117.32","kg":"4.44","la":"6.34","lv":"23.39","lb":"39.15","ls":"1.8","lr":"0.98","ly":"77.91","lt":"35.73","lu":"52.43","mk":"9.58","mg":"8.33","mw":"5.04","my":"218.95","mv":"1.43","ml":"9.08","mt":"7.8","mr":"3.49","mu":"9.43","mx":"1004.04","md":"5.36","mn":"5.81","me":"3.88","ma":"91.7","mz":"10.21","mm":"35.65","na":"11.45","np":"15.11","nl":"770.31","nz":"138","ni":"6.38","ne":"5.6","ng":"206.66","no":"413.51","om":"53.78","pk":"174.79","pa":"27.2","pg":"8.81","py":"17.17","pe":"153.55","ph":"189.06","pl":"438.88","pt":"223.7","qa":"126.52","ro":"158.39","ru":"1476.91","rw":"5.69","ws":"0.55","st":"0.19","sa":"434.44","sn":"12.66","rs":"38.92","sc":"0.92","sl":"1.9","sg":"217.38","sk":"86.26","si":"46.44","sb":"0.67","za":"354.41","es":"1374.78","lk":"48.24","kn":"0.56","lc":"1","vc":"0.58","sd":"65.93","sr":"3.3","sz":"3.17","se":"444.59","ch":"522.44","sy":"59.63","tw":"426.98","tj":"5.58","tz":"22.43","th":"312.61","tl":"0.62","tg":"3.07","to":"0.3","tt":"21.2","tn":"43.86","tr":"729.05","tm":0,"ug":"17.12","ua":"136.56","ae":"239.65","gb":"2258.57","us":"14624.18","uy":"40.71","uz":"37.72","vu":"0.72","ve":"285.21","vn":"101.99","ye":"30.02","zm":"15.69","zw":"5.57"};
$('#vmap').vectorMap({
map: 'world_en',
backgroundColor: '#FFFFFF',
borderColor: '#FFFFFF',
color: '#9FD5F1',
hoverOpacity: 0.7,
selectedColor: '#666666',
enableZoom: true,
showTooltip: true,
values: sample_data,
normalizeFunction: 'polynomial',
onLabelShow: function(event, label, code) {
var cname=label.text();
var dataString = 'cname='+ cname;
$.ajax
({
type: "POST",
url: "<?= url('admin/Backend/get_map'); ?>",
dataType : 'json',
data: dataString,
cache: false,
success: function(data)
{
if(data){
$.each(data.price,function(key,item){
label.html('<strong>'+label.text()+'</strong><br />Order' +data.totaldd+'<br />Sales ₹'+item.price);
});
}
else{
label.html('<strong>'+label.text()+'</strong>');
}
} 
});
}
});
});
//-->
</script>
</div>
<div class="col-lg-6 col-md-12 col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">
<div class="pull-right">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>
<!-- <ul id="range" class="dropdown-menu dropdown-menu-right">
<li><a href="day">Today</a></li>
<li><a href="week">Week</a></li>
<li class="active"><a href="month">Month</a></li>
<li><a href="year">Year</a></li>
</ul> -->
<form method="post" action="">
<select name="calander" onchange="this.form.submit()">
<option value="">Day</option>
<option value="week">Week</option>
<option value="month">Month</option>
<option value="year">Year</option>
</select>
</form>
</div>
<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Sales Analytics</h3>
</div>
<div class="panel-body">
<canvas id="myChart"></canvas>
</div>
</div>
<script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo config('app.ADMIN_CATALOG'); ?>javascript/jquery/flot/jquery.flot.resize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: [<?= $tdates; ?>],
datasets: [{
label: 'Orders',
data: [<?= $ttotal;?>],
backgroundColor: [
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
'#9FD5F1',
],
borderColor: [
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
'#1065D2',
],
borderWidth: 1
}]
},
options: {
scales: {
xAxes: [{
ticks: {
beginAtZero: true,
maxRotation: 0,
minRotation: 0
}
}],
xAxes: [{
ticks: {
beginAtZero: true,
maxRotation: 0,
minRotation: 0
}
}]
}
}
});
</script>

</div>
</div>
<div class="row">
<div class="col-lg-4 col-md-12 col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-calendar"></i> Recent Activity</h3>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<td>Email ID</td>
<td>Modify Date</td>
</tr>
</thead>
<tbody>
<?php if(!empty($admin)) {foreach ($admin as $key => $value){?>
<tr>
<td><?php echo $value->email; ?></td>
<td><?php echo $value->modify_date; ?></td>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<td>Category Name</td>
<td>Modify Date</td>
</tr>
</thead>
<tbody>
<?php if (!empty($category)) {foreach ($category as $key => $value) {?>
<tr>
<td><?php echo $value->name; ?></td>
<td><?php echo $value->modify_date; ?></td>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<td>Product Name</td>
<td>Modify Date</td>
</tr>
</thead>
<tbody>
<?php if (!empty($product)) {foreach ($product as $key => $value) {?>
<tr>
<td><?php echo substr($value->name,0,30); ?></td>
<td><?php echo $value->modify_date; ?></td>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
</div>
<!-- <ul class="list-group">
<li class="list-group-item text-center">No results!</li>
</ul>-->
</div>
</div>
<div class="col-lg-8 col-md-12 col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Latest Order</h3>
</div>
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<td class="text-right">S.No</td>
<td>Customer</td>
<td>Phone</td>
<td>Email</td>
<td>Total</td>
<td>Date Added</td>

<!-- <td class="text-right">Total</td> -->
<td class="text-right">Action</td>
</tr>
</thead>
<tbody>
<?php if (!empty($latest_order)) {$i=1; foreach ($latest_order as $key => $value) {?>
<tr>
<td class="text-center"><?php echo $i++; ?></td>
<td><?php echo $value->firstname.' '.$value->lastname; ?></td>
<td><?php echo $value->telephone; ?></td>
<td><?php echo $value->email; ?></td>
<td class="text-center"><?php echo $value->total; ?></td>
<td class="text-center"><?php echo date('d M Y',strtotime($value->date_added)); ?></td>
<td class="text-right"><a href="<?php echo url('admin/product_enquiry'); ?>"><button class="btn btn-primary">View</button></a></td>
</tr>
<?php } } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>

 @endsection