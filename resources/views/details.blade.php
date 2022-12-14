@extends('navbar.main')



{{-- <?php
function build_calendar($month, $year) {
    $mysqli = new mysqli('localhost', 'root', '', 'last_project');
    $stmt = $mysqli->prepare("select * from bookings where MONTH(tglmain) = ? AND YEAR(tglmain) = ?");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['tglmain'];
            }
            
            $stmt->close();
        }
    }
    
    
    
     $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

     
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     
     $numberDays = date('t',$firstDayOfMonth);

   
     $dateComponents = getdate($firstDayOfMonth);

    
     $monthName = $dateComponents['month'];

    
     $dayOfWeek = $dateComponents['wday'];

     
    $datetoday = date('Y-m-d');
    
    
    
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-sm btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a class='btn btn-sm btn-primary' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
    
    $calendar.= "<a class='btn btn-sm btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."'>Next Month</a></center><br>";
    
    
        
      $calendar .= "<tr>";

     // Create the calendar headers

     foreach($daysOfWeek as $day) {
          $calendar .= "<th  class='header'>$day</th>";
     } 

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

     $currentDay = 1;

     $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

     if ($dayOfWeek > 0) { 
         for($k=0;$k<$dayOfWeek;$k++){
                $calendar .= "<td  class='empty'></td>"; 

         }
     }
    
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

          // Seventh column (Saturday) reached. Start a new row.

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          $date = "$year-$month-$currentDayRel";
          
            $dayname = strtolower(date('l', strtotime($date)));
            $eventNum = 0;
            $today = $date==date('Y-m-d')? "today" : "";
         if($date<date('Y-m-d')){
             $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-sml'>N/A</button>";
         }elseif(in_array($date, $bookings)){
             $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-sml'>Already Booked</button>";
         }else{
             $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='/timebook?date=".$date."' class='btn btn-success btn-sml'>Book</a>";
         }
         
        //  {{url('book' $date->id )}}
            
        //  book.blade.php?date=".$date."
            
          $calendar .="</td>";
          // Increment counters
 
          $currentDay++;
          $dayOfWeek++;

     }
     
     

     // Complete the row of the last week in month, if necessary

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
            for($l=0;$l<$remainingDays;$l++){
                $calendar .= "<td class='empty'></td>"; 

         }

     }
     
     $calendar .= "</tr>";

     $calendar .= "</table>";

     echo $calendar;

}


    
?> --}}






@section('content')
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Detail Lapangan</title>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">

<style type="text/css">

/* .row > * {
    flex-shrink: 0;
    width: 100%;
    max-width: 100%;
    padding-right: calc(var(--bs-gutter-x) / 2);
    padding-left: calc(var(--bs-gutter-x) / 2);
    margin-top: var(--bs-gutter-y);
} */

    .card-booking {
    box-shadow: 2px 2px 10px rgb(0 0 0 / 10%);
    border-radius: 10px;
}

.card-booking .rate-title {
    font-weight: bold;
    font-size: 13px !important;
}

h5 {
    display: block;
    font-size: 0.83em;
    margin-block-start: 1.67em;
    margin-block-end: 1.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #ffffff;
    background-clip: border-box;
    /* border: 1px solid rgba(0, 0, 0, 0.125); */
    border-radius: 0.25rem;
}
    .btn-pr{
      padding: 8px 8px;
      font-size: 10px;
      border-radius: 7px;
      /* gap: 2px; */
      
    }

    .card-body {
    flex: 1 1 auto;
    padding: 1rem 1rem;
}

    .dropdown-divider {
    height: 0;
    margin: 0.5rem 0;
    overflow: hidden;
    border-top: 1px solid rgba(0, 0, 0, 0.15);
}

    .btn-sml {
    padding: 5px 5px;
    font-size: 9px;
    border-radius: 4px;
    /* color: white; */
    margin-top: 5px;
  
  }

  .table-bordered td, .table-bordered th{
    border: 1px solid#b9b9b9;
  }
  /* .table-bordered{
    border: #0076ad;
  } */

/*****************globals*************/
body {
  font-family: 'open sans';
  background: #C0C0C0;
  overflow-x: hidden; }

img {
  max-width: 100%; }

.preview {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }
  @media screen and (max-width: 996px) {
    .preview {
      margin-bottom: 20px; } }

.preview-pic {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.preview-thumbnail.nav-tabs {
  border: none;
  margin-top: 15px; }
  .preview-thumbnail.nav-tabs li {
    width: 18%;
    margin-right: 2.5%; }
    .preview-thumbnail.nav-tabs li img {
      max-width: 100%;
      display: block; }
    .preview-thumbnail.nav-tabs li a {
      padding: 0;
      margin: 0; }
    .preview-thumbnail.nav-tabs li:last-of-type {
      margin-right: 0; }

.tab-content {
  overflow: hidden; }
  .tab-content img {
    width: 100%;
    -webkit-animation-name: opacity;
            animation-name: opacity;
    -webkit-animation-duration: .3s;
            animation-duration: .3s; }

.card {
  margin-top: 50px;
  background: #eee;
  padding: 3em;
  line-height: 1.5em; }

@media screen and (min-width: 997px) {
  .wrapper {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex; } }

.details {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
      -ms-flex-direction: column;
          flex-direction: column; }

.colors {
  -webkit-box-flex: 1;
  -webkit-flex-grow: 1;
      -ms-flex-positive: 1;
          flex-grow: 1; }

.product-title, .price, .sizes, .colors {
  text-transform: UPPERCASE;
  font-weight: bold; }

.checked, .price span {
  color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
  margin-bottom: 15px; }

.product-title {
  margin-top: 0; }

.size {
  margin-right: 10px; }
  .size:first-of-type {
    margin-left: 40px; }

.color {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
  height: 2em;
  width: 2em;
  border-radius: 2px; }
  .color:first-of-type {
    margin-left: 20px; }

.add-to-cart, .like {
  background: #ff9f1a;
  padding: 1.2em 1.5em;
  border: none;
  text-transform: UPPERCASE;
  font-weight: bold;
  color: #fff;
  -webkit-transition: background .3s ease;
          transition: background .3s ease; }
  .add-to-cart:hover, .like:hover {
    background: #b36800;
    color: #fff; }

.not-available {
  text-align: center;
  line-height: 2em; }
  .not-available:before {
    font-family: fontawesome;
    content: "\f00d";
    color: #fff; }

.orange {
  background: #ff9f1a; }

.green {
  background: #85ad00; }

.blue {
  background: #0076ad; }

.tooltip-inner {
  padding: 1.3em; }

@-webkit-keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }

@keyframes opacity {
  0% {
    opacity: 0;
    -webkit-transform: scale(3);
            transform: scale(3); }
  100% {
    opacity: 1;
    -webkit-transform: scale(1);
            transform: scale(1); } }


    @media only screen and (max-width:760px),
    (min-device-width:802px) and (max-device-width:1020px){
    table,
    thead,
    tbody,
    th,
    td,
    tr{
      display: block;

    }

    .empty{
      display: none;
    }

    th{
      position: absolute;
      top: -9999px;
      left: -9999px;
    }

    tr{
      border: 1px solid #ccc;
    }

    .u{
      border: 3px;
    }

    td{
      border:none;
      border-bottom: 1px solid #eee;
      position: relative;
      padding-left: 50%;
    }

    td:nth-last-of-type(1):before{
      content: "Sunday";
    }

    td:nth-last-of-type(2):before{
      content: "Monday";
    }

    td:nth-last-of-type(3):before{
      content: "Tuesday";
    }

    td:nth-last-of-type(4):before{
      content: "Wednesday";
    }

    td:nth-last-of-type(5):before{
      content: "Thursday";
    }

    td:nth-last-of-type(6):before{
      content: "Friday";
    }

    td:nth-last-of-type(7):before{
      content: "Saturday";
    }

    
  }

  @media only screen and (min-device-width:320px) and (max-device-width:480px){
    body{
      padding: 0;
      margin: 0;

    }
  }

  @media only screen and (min-device-width:802px) and (max-device-width:1020px){
    body{
      width: 495px;
    }
  }

  @media (min-width:641px){
    table{
      table-layout: fixed;
    }

    td{
      width: 33%;
    }
  }
  .row{
      margin-top: 20px;
    }

    .today {
      background-color: rgb(242, 217, 182);
    }
/*# sourceMappingURL=style.css.map */

    </style>

  </head>

  <br><br><br><br><br><br>

  <body>
	
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="/image/{{$product->image}}" /></div>
						  <div class="tab-pane" id="pic-2"><img src="/image/{{$product->image}}" /></div>
						  <div class="tab-pane" id="pic-3"><img src="/image/{{$product->image}}" /></div>
						  <div class="tab-pane" id="pic-4"><img src="/image/{{$product->image}}" /></div>
						  <div class="tab-pane" id="pic-5"><img src="/image/{{$product->image}}" /></div>
						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="/image/{{$product->image}}" /></a></li>
						  <li><a data-target="#pic-2" data-toggle="tab"><img src="/image/{{$product->image}}" /></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src="/image/{{$product->image}}" /></a></li>
						  <li><a data-target="#pic-4" data-toggle="tab"><img src="/image/{{$product->image}}" /></a></li>
						  <li><a data-target="#pic-5" data-toggle="tab"><img src="/image/{{$product->image}}" /></a></li>
						</ul>
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{ $product->nama }}</h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<p class="product-description">{{ $product->subjek }}</p>
						<h4 class="price">Harga: <span>Rp. {{ $product->harga }} /Jam</span></h4>
						<p class="vote"><strong>91%</strong> Menyukainya! <strong>(87 votes)</strong></p>
						<div class="action">
							<!-- <form action="/add-to-cart" method="post">
                      		@csrf
							<button class="add-to-cart btn btn-default" href="" type="button">add to cart</button>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
							</form> -->

			

							<a href="/booking/create">	
							<button class="add-to-cart btn btn-default" type="button">Pesan Sekarang</button>

							</a>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
						</div>
					</div>
				</div>


        {{-- <section>
          <div class="col-lg-4 col-sm-4">
            <div class="sticky-top" style="top: 96px;margin-bottom: 70px;">
          <div class="card card-booking">
            <div class="card-body">
                <h3 class="text-red m-0">Pesan Sekarang !</h3>
                <div class="dropdown-divider"></div>
                  <div class="row">
                    <div class="row">
                      <div class="col-lg-6 col-sm-12">
                        <h5 class="rate-title m-0">Daftar Tarif Weekday :</h5>
                          <p class="badge bg-success my-2" style="font-size: 11px;">Rp. 175.000</p>
                            <ul class="list-unstyled">
                              <li class="list-item">- Session 10:00 - 12:00</li>
                                <li class="list-item">- Session 12:00 - 14:00</li>
                                  <li class="list-item">- Session 14:00 - 16:00</li>
                                    </ul>
                                  <p class="badge bg-success my-2" style="font-size: 11px;">Rp. 200.000</p>
                                <ul class="list-unstyled">
                              <li class="list-item">- Session 06:00 - 08:00</li>
                             <li class="list-item">- Session 08:00 - 10:00</li>
                            </ul>
                         <p class="badge bg-success my-2" style="font-size: 11px;">Rp. 400.000</p>
                       <ul class="list-unstyled">
                      <li class="list-item">- Session 16:00 - 18:00</li>
                    <li class="list-item">- Session 18:00 - 20:00</li>
                  <li class="list-item">- Session 20:00 - 22:00</li>
                 </ul>
               </div>
               <div class="col-lg-6 col-sm-12">
                <h5 class="rate-title m-0">Daftar Tarif Weekend :</h5>
                <p class="badge bg-success my-2" style="font-size: 11px;">Rp. 400.000</p>
                <ul class="list-unstyled">
                <li class="list-item">- Session 06:00 - 08:00</li>
                <li class="list-item">- Session 08:00 - 10:00</li>
                <li class="list-item">- Session 10:00 - 12:00</li>
              <li class="list-item">- Session 12:00 - 14:00</li>
              <li class="list-item">- Session 14:00 - 16:00</li>
              <li class="list-item">- Session 16:00 - 18:00</li>
              <li class="list-item">- Session 18:00 - 20:00</li>
               <li class="list-item">- Session 20:00 - 22:00</li>
                 </ul>
                 </div>
                  </div>
                  </div>
                <br><br>
                 <button class="btn btn-danger w-100 text-uppercase" onclick="SubmitNonPackage()">Book</button>
                  </div>
        </div>
                </div>
            </div>
        </section> --}}


        {{-- <?php
        $dateComponents = getDate();
        if (isset($_GET['month']) && isset($_GET['year'])) {
          $month = $_GET['month'];
          $year = $_GET['year'];
        }else{
          $month = $dateComponents['mon'];
          $year = $dateComponents['year'];
        }
    
        echo build_calendar($month, $year);
        ?> --}}

			</div>
		</div>
    
    
	</div>
  </body>
</html>


@endsection