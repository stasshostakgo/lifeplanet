<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>LifePlanet</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  
  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/mobile-nav/mobile-nav.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  
  <!-- =======================================================
    Theme Name: NewBiz
    Theme URL: https://bootstrapmade.com/newbiz-bootstrap-business-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

<!--==========================
  rest-api
  ============================-->
<?php
$vmleads_rest = 'https://vmleads.co.uk/integrations/rest?is_test=1';
$vmleads_data = array();

if(!empty($_POST['affiliate_campaign_id'])){
  // print_r($_POST); exit;
    $return = vmleads_curl(
        $vmleads_rest, array_merge(
            $_POST, 
            array(
                'vmform_ip' => vmleads_get_ip(),
                'vmform_siteid' => '1106: https://lifeplanet.co.uk/(Test)'
            )
        )
    );
    
	if(empty($return['error']) && substr($return['code'],0,1) == 2){
    $status= json_decode($return['body'],true);
    ?>
    <script>
      var message = <?php echo $return['body'] ?>;
    </script>
    <?php
		if(!empty($status['redirect'])){
            header('location:'.$status['redirect']);
			exit;
        }
        else{
        }
	}else{
	}

}else{
	$vmleads_data['status'] = array('status'=>'');
	$vmleads_data['field_errors'] = array();
	$vmleads_data['values'] = array();
}

function vmleads_curl($url,$data){
	$current_url = (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	$ch = curl_init();
	$timeout = 10;
    $referer = $current_url;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt($ch, CURLOPT_REFERER, $referer);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$result = array();
	$result['body'] = trim(curl_exec($ch));
	$result['errno'] = curl_errno($ch);
	$result['error'] = curl_error($ch);
	$result['code'] = curl_getinfo($ch,CURLINFO_HTTP_CODE);
	curl_close($ch);
	return  $result;
}

function vmleads_get_ip() {
	$ip = $_SERVER['REMOTE_ADDR'];
	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	return $ip;
}
?>


<div style="position: fixed; top: 2rem; right: 2rem; z-index: 9999999;">
    <!-- Toast message -->
    <div id="toast-message" class="toast fade hide" data-delay="4000" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="si si-bubble text-primary mr-2"></i>
            <strong class="mr-auto">Title</strong>
            <small class="text-muted">just now</small>
            <button type="button" class="ml-2 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="toast-body">
            This is a nice notification based on Bootstrap implementation.
        </div>
    </div>
    <!-- END Toast message-->

    <!-- Toast tofix-->
      <div id="toast-tofix" class="fade hide alert alert-danger row" data-delay="4000" role="alert">
        <div class="message">A simple danger alert—check it out! </div>
        <button type="button" class="close float-right"  data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
    <!-- END Toast tofix-->
</div>

  <!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top">
    <div class="container align-middle">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
        <a href="#" class="scrollto"><img src="img/logo.png" alt="" class="img-fluid img-logo"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="#intro"><img src="img/client_1.png" alt=""></a></li>
          <li><a href="#"><img src="img/client_2.png" alt=""></a></li>
          <li><a href="#"><img src="img/client_3.png" alt=""></a></li>
          <li><a href="#"><img src="img/client_4.png" alt=""></a></li>
          <li><a href="#"><img src="img/client_5.png" alt=""></a></li>
          <li class="#"><a href="#"><img src="img/client_6.png" alt=""></a></li>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">

      <!-- <div class="intro-img">
        <img src="img/intro-img.svg" alt="" class="img-fluid">
      </div> -->

      <div class="intro-info">
        <h2>GET INSURED AND<br>FEEL SECRUED</h2>
        <h5>Lorem ipsum dolor sit amet, consectetur adipiscing<br>elit, sed do eiusmod tempor incididunt ut labore et<br>dolore magna aliqua.</h5>
        <div>
          <a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-get-started scrollto">GET A QUOTE</a>
        </div>
      </div>

    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      Featured-Services
    ============================-->

    <section id="featured-services">
      <div class="container">
        <div class="header-services row">

          <div class="col-lg-4 box box-form">
            <div class="icon"><i class="fa fa-form-bag"></i></div>
            <h4 class=""><a href="#">Fill in our quick<br>from</a></h4>
          </div>

          <div class="col-lg-4 box box-suitable">
            <div class="icon"><i class="fa fa-suitable-bag"></i></div>
            <h4 class=""><a href="#">We scan for suitable<br>insurers</a></h4>
          </div>

          <div class="col-lg-4 box box-quote">
              <div class="icon"><i class="fa fa-quote-bag"></i></div>
            <h4 class=""><a href="#">Reveive your quote.<br>No fees, no obligations.</a></h4>
          </div>

        </div>
        <div class="main-services row">

            <div class="col-lg-4 box icon-box">
              <div class="d-flex justify-content-center"><div class="icon"><i class="fa fa-glass-bag"></i></div></div>
              <h4 class=""><a href="#">We search the major life<br> insurers for your best deal.</a></h4>
            </div>
  
            <div class="col-lg-4 box icon-box">
              <div class="d-flex justify-content-center"><div class="icon"><i class="fa fa-budget-bag"></i></div></div>
              <h4 class=""><a href="#">Premiums start from just £10 a month. That's only 33p per day!*</a></h4>
            </div>
  
            <div class="col-lg-4 box icon-box">
              <div class="d-flex justify-content-center"><div class="icon"><i class="fa fa-smquote-bag"></i></div></div>
              <h4 class=""><a href="#">Free quote. No obligations.</a></h4>
            </div>
  
          </div>
          <div class="main-services row">

              <div class="col-lg-4 box icon-box">
                <div class="d-flex justify-content-center"><div class="icon"><i class="fa fa-amount-bag"></i></div></div>
                <h4 class=""><a href="#">Amounts up to £10 million can be covered.</a></h4>
              </div>
    
              <div class="col-lg-4 box icon-box">
                <div class="d-flex justify-content-center"><div class="icon"><i class="fa fa-secure-bag"></i></div></div>
                <h4 class=""><a href="#">Safe and secure. 2 minute application.</a></h4>
              </div>
    
              <div class="col-lg-4 box icon-box">
                  <div class="d-flex justify-content-center"><div class="icon"><i class="fa fa-thumb-bag"></i></div></div>
                <h4 class=""><a href="#">Top Brands, Top Deals!</a></h4>
              </div>
    
            </div>
            <div class="main-services row">

              <div class="offset-lg-4 col-lg-4 box icon-box">
                <div class="d-flex justify-content-center"><div class="icon"><i class="fa fa-lock-bag"></i></div></div>
                <h4 class=""><a href="#">We use SSL (256 Bit) to secure<br>your information</a></h4>
              </div>
    
            </div>
      </div>
      <div class="container">

        <div class="d-flex align-items-center justify-content-between quote-footer-form">
          <div class="d-flex align-items-center justify-content-between m-4" style="width: 100%">
            <div class="bd-highlight p-2"><span class="shurtcut-command">Get a Free, No-Obligation Quote Now</span></div>
            <div class="bd-highlight p-2"><a href="#" data-toggle="modal" data-target="#modalQuickView" class="btn-get-started scrollto">GET A QUOTE</a></div>
          </div>
        </div>

      </div>
    </section>


    

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header text-center">
          <span>LifePlanet is an independent life insurance website. We strive to help users
            <br>find the best possible life cover quote. Our panel of respected life insurance brokers will work
            <br>hard to find you the best life insurance policy tailored to your personal circumstances.
            <br>They will search and compare hundreds of life cover plans from many high street
            <br>insurers for the best deals available. We search life insurance so you don't have to!
            <br><br>Insurance details published on this site are for information purposes only and do not 
            <br>constitute financial advice nor financial promotions under the Financial Services and 
            <br>Markets Act 2000 or The (Financial Promotions) Order 2005.</span>
        </header>

      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">

        <header class="section-header text-center">
          <span>£5 premium is based on £70,000 of level term cover for a non - smoking individual aged 30 next birth-
            <br>day and in good health . Prices correct as at May / 2015
            <br>
            <br>*subject to eligibility and policy terms/benefits selected
          </span>
        </header>

      </div>
    </section><!-- #services -->

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="container">
      <div class="row">
      <div class="copyright col-lg-5">
        <span>lifeplanet.co.uk © 2009</span><br>
        <a href="#">Contact Us </a>|<a href="#"> Privacy Policy </a>|<a href="#"> Terms & Conditions</a>
      </div>
      <div class="copyright col-lg-7 mt-2">
        <!--
          All the links in the footer should remain intact.
          You can delete the links only if you purchased the pro version.
          Licensing information: https://bootstrapmade.com/license/
          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=NewBiz
        -->
        <span>Life Planet Is Property of 05 Media Ltd Data Protection Act Number ZA521293</span>
      </div>
      </div>
    </div>
  </footer><!-- #footer -->

  <!--==========================
    Modal quick view
  ============================-->
  <div class="modal fade" id="modalQuickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-ml" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-4">
              <!--Carousel Wrapper-->
              <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="img/carousel.png" alt="Third slide">
                  </div>
                </div>
                <!--/.Slides-->
                <!--Controls-->
                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                  <!--<span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>-->
                </a>
                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                  <!--<span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>-->
                </a>
              </div>
              <!--/.Carousel Wrapper-->
            </div>
            <div class="col-lg-8">
              <div class="title">
                <h6 class="h6-responsive"> 
                    Start Your No Obligation
                </h6>

                <h1 class="h1-responsive">
                  <strong>FREE QUOTE</strong>
                </h1>
              </div>

              <form action="##vmform-77" method="POST" id="generate-77">
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="cover_type">Type of cover</label>
                      <select id="cover_type" placeholder="" name="insurance_type" class="form-control form-control-lg">
                        <option value="">Select type of cover</option>
                        <option  value="Life Insurance only">Life Insurance only</option>
                        <option  value="Life Insurance with Critical Illness">Life Insurance with Critical Illness</option>
                        <option  value="Mortgage Life Insurance">Mortgage Life Insurance</option>
                        <option  value="Whole of Life">Whole of Life</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="cover_amount">Amount of cover</label>
                      <select id="cover_amount" name="cover_amount" class="form-control form-control-lg">
                        <option  value="10000">£10,000</option>
                        <option  value="15000">£15,000</option>
                        <option  value="20000">£20,000</option>
                        <option  value="25000">£25,000</option>
                        <option  value="30000">£30,000</option>
                        <option  value="35000">£35,000</option>
                        <option  value="40000">£40,000</option>
                        <option  value="45000">£45,000</option>
                        <option  value="50000">£50,000</option>
                        <option  value="55000">£55,000</option>
                        <option  value="60000">£60,000</option>
                        <option  value="65000">£65,000</option>
                        <option  value="70000">£70,000</option>
                        <option  value="75000">£75,000</option>
                        <option  value="80000">£80,000</option>
                        <option  value="85000">£85,000</option>
                        <option  value="90000">£90,000</option>
                        <option  value="95000">£95,000</option>
                        <option  selected=selected  value="100000">£100,000</option>
                        <option  value="105000">£105,000</option>
                        <option  value="110000">£110,000</option>
                        <option  value="115000">£115,000</option>
                        <option  value="120000">£120,000</option>
                        <option  value="125000">£125,000</option>
                        <option  value="130000">£130,000</option>
                        <option  value="135000">£135,000</option>
                        <option  value="140000">£140,000</option>
                        <option  value="145000">£145,000</option>
                        <option  value="150000">£150,000</option>
                        <option  value="155000">£155,000</option>
                        <option  value="160000">£160,000</option>
                        <option  value="165000">£165,000</option>
                        <option  value="170000">£170,000</option>
                        <option  value="175000">£175,000</option>
                        <option  value="180000">£180,000</option>
                        <option  value="185000">£185,000</option>
                        <option  value="190000">£190,000</option>
                        <option  value="195000">£195,000</option>
                        <option  value="200000">£200,000</option>
                        <option  value="210000">£210,000</option>
                        <option  value="220000">£220,000</option>
                        <option  value="230000">£230,000</option>
                        <option  value="240000">£240,000</option>
                        <option  value="250000">£250,000</option>
                        <option  value="260000">£260,000</option>
                        <option  value="270000">£270,000</option>
                        <option  value="280000">£280,000</option>
                        <option  value="290000">£290,000</option>
                        <option  value="300000">£300,000</option>
                        <option  value="325000">£325,000</option>
                        <option  value="350000">£350,000</option>
                        <option  value="375000">£375,000</option>
                        <option  value="400000">£400,000</option>
                        <option  value="425000">£425,000</option>
                        <option  value="450000">£450,000</option>
                        <option  value="475000">£475,000</option>
                        <option  value="500000">£500,000</option>
                        <option  value="525000">£525,000</option>
                        <option  value="550000">£550,000</option>
                        <option  value="575000">£575,000</option>
                        <option  value="600000">£600,000</option>
                        <option  value="650000">£650,000</option>
                        <option  value="700000">£700,000</option>
                        <option  value="750000">£750,000</option>
                        <option  value="800000">£800,000</option>
                        <option  value="850000">£850,000</option>
                        <option  value="900000">£900,000</option>
                        <option  value="950000">£950,000</option>
                        <option  value="1000000">£1,000,000</option>
                        <option  value="1100000">£1,100,000</option>
                        <option  value="1200000">£1,200,000</option>
                        <option  value="1300000">£1,300,000</option>
                        <option  value="1400000">£1,400,000</option>
                        <option  value="1500000">£1,500,000</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="term_over">Over what term</label>
                      <select id="term_over" name="cover_length" class="form-control form-control-lg">
                        <option  value="1">1 year</option>
                        <option  value="2">2 years</option>
                        <option  value="3">3 years</option>
                        <option  value="4">4 years</option>
                        <option  value="5">5 years</option>
                        <option  value="6">6 years</option>
                        <option  value="7">7 years</option>
                        <option  value="8">8 years</option>
                        <option  value="9">9 years</option>
                        <option  value="10">10 years</option>
                        <option  value="11">11 years</option>
                        <option  value="12">12 years</option>
                        <option  value="13">13 years</option>
                        <option  value="14">14 years</option>
                        <option  value="15">15 years</option>
                        <option  value="16">16 years</option>
                        <option  value="17">17 years</option>
                        <option  value="18">18 years</option>
                        <option  value="19">19 years</option>
                        <option  selected=selected  value="20">20 years</option>
                        <option  value="21">21 years</option>
                        <option  value="22">22 years</option>
                        <option  value="23">23 years</option>
                        <option  value="24">24 years</option>
                        <option  value="25">25 years</option>
                        <option  value="26">26 years</option>
                        <option  value="27">27 years</option>
                        <option  value="28">28 years</option>
                        <option  value="29">29 years</option>
                        <option  value="30">30 years</option>
                        <option  value="31">31 years</option>
                        <option  value="32">32 years</option>
                        <option  value="33">33 years</option>
                        <option  value="34">34 years</option>
                        <option  value="35">35 years</option>
                        <option  value="36">36 years</option>
                        <option  value="37">37 years</option>
                        <option  value="38">38 years</option>
                        <option  value="39">39 years</option>
                        <option  value="40">40 years</option>
                        <option  value="41">41 years</option>
                        <option  value="42">42 years</option>
                        <option  value="43">43 years</option>
                        <option  value="44">44 years</option>
                        <option  value="45">45 years</option>
                        <option  value="46">46 years</option>
                        <option  value="47">47 years</option>
                        <option  value="48">48 years</option>
                        <option  value="49">49 years</option>
                        <option  value="50">50 years</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="cover_ld">Level or decreasing cover</label>
                      <select id="cover_ld" name="level_dec" class="form-control form-control-lg">
                        <option value="">Select</option>
                        <option value="Level">Level</option>
                        <option value="Decreasing">Decreasing</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="cover_ld">Premium type</label>
                      <select id="premium" name="premium" class="form-control form-control-lg">
                        <option value="">Select</option>
                        <option value="guaranteed">Guaranteed</option>
                        <option value="reviewalbe">Reviewable</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="joint_application" id="gridRadios1" value="Just me" checked>
                        <label class="form-check-label" for="gridRadios1">
                          Single Application
                        </label>
                      </div>
                    </div>
                    <div class="form-group col-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="joint_application" id="gridRadios2" value="Me and my partner">
                        <label class="form-check-label" for="gridRadios2">
                          Join Application
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="fa_title">Title</label>
                        <select id="fa_title" name="fa_title" class="form-control form-control-lg">
                          <option value="">Select</option>
                          <option value="Mr">Mr</option>
                          <option value="Mrs">Mrs</option>
                          <option value="Sir">Sir</option>
                          <option value="Dr">Dr</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                          <label for="first_name">First name</label>
                          <input id="first_name" name="first_name" type="text" class="form-control form-control-lg" placeholder="First name">
                      </div>
                      <div class="form-group col-md-4">
                          <label for="last_name">Sure name</label>
                          <input id="last_name" name="last_name" type="text" class="form-control form-control-lg" placeholder="Sure name">
                      </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-7">
                        <label for="dob">Date of birth</label>
                        <input id="dob" name="dob" type="text" class="date-picker form-control form-control-lg" placeholder="Date of birth (01-01-1990)">
                    </div>
                    <div class="form-group col-md-5">
                        <label for="smoker">Is this person a smoker</label>
                        <select id="smoker" name="smoker" class="form-control form-control-lg">
                          <option value="1" selected>No</option>
                          <option value="2">Yes</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-7">
                        <input id="Address" type="text" name="address_line_1" class="form-control form-control-lg" placeholder="Address">
                    </div>
                    <div class="form-group col-md-5">
                        <input class="form-control form-control-lg" id="postcode" name="postcode" placeholder="Postcode" maxlength="8" size="15" type="text" data-parsley-pattern="/^([A-PR-UWYZ0-9][A-HK-Y0-9][AEHMNPRTVXY0-9]?[ABEHMNPRVWXY0-9]? {0,2}[0-9][ABD-HJLN-UW-Z]{2}|GIR 0AA)$/i" data-parsley-required="true" data-parsley-id="5983">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                        <input id="dt_phone" type="text" name="telephone" class="form-control form-control-lg" placeholder="Daytime phone">
                    </div>
                    <div class="form-group col-md-4">
                        <input id="m_phone" type="text" name="mobile" class="form-control form-control-lg" placeholder="mobile (+4407123456789)">
                    </div>
                    <div class="form-group col-md-4">
                        <input id="email" type="text" name="email" class="form-control form-control-lg" placeholder="Email address">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="col-md-4">
                        <a href="javascript:form_submit()" class="btn-get-started">GET A QUOTE</a>
                    </div>
                    <div class="col-md-8">
                        <p>By clicking "Get A Quote" you agree to be contacted by email or telephone
                        <br>by an FCA authorised insurance firm and confirm that you have read
                        <br>and agreed to our <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy.</a></p>
                    </div>
                  </div>
                  <input  class="" type="hidden" name="affiliate_campaign_id" value="77">
                  <input type="hidden" name="vmform_hash" value="8F220" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- #modalQuickView -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  

  <script>
  jQuery(document).ready(function(){
    setTimeout(showAlert, 1000);
  });
    function showAlert(){
      if(typeof message !== 'undefined'){
        console.log(message);
        jQuery('#toast-tofix .message').html("");
        Object.values(message['field_errors']).forEach(getelements);
        jQuery('#toast-tofix').toast('show');
      }
    }
    function getelements(item) {
      jQuery('#toast-tofix .message').append(item);
    }
    function form_submit(){
      var first_error_object = null;
      var message = null
      if($("#cover_type").val()==""){
        $("#cover_type").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#cover_type");
        if(!message) message = "This value is required.";
      }
      else{
        $("#cover_type").removeClass("is-invalid");
      }

      if($("#cover_ld").val()==""){
        $("#cover_ld").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#cover_ld");
        if(!message) message = "This value is required.";
      }
      else{
        $("#cover_ld").removeClass("is-invalid");
      }

      if($("#premium").val()==""){
        $("#premium").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#premium");
        if(!message) message = "This value is required.";
      }
      else{
        $("#premium").removeClass("is-invalid");
      }

      if($("#fa_title").val()==""){
        $("#fa_title").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#fa_title");
        if(!message) message = "This value is required.";
      }
      else{
        $("#fa_title").removeClass("is-invalid");
      }

      if($("#first_name").val()==""){
        $("#first_name").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#first_name");
        if(!message) message = "This value is required.";
      }
      else{
        $("#first_name").removeClass("is-invalid");
      }

      if($("#last_name").val()==""){
        $("#last_name").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#last_name");
        if(!message) message = "This value is required.";
      }
      else{
        $("#last_name").removeClass("is-invalid");
      }

      if($("#dob").val()==""){
        $("#dob").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#dob");
        if(!message) message = "This value is required.";
      }
      else if(!/^(0?[1-9]|[12][0-9]|3[01])[\-](0?[1-9]|1[012])[\-]\d{4}$/.test(String($("#dob").val()))){
        $("#dob").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#dob");
        if(!message) message = "This value should be a valid date. (01-01-1990)";
      }
      else{
        $("#dob").removeClass("is-invalid");
      }

      if($("#Address").val()==""){
        $("#Address").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#Address");
        if(!message) message = "This value is required.";
      }
      else{
        $("#Address").removeClass("is-invalid");
      }
      
      if($("#postcode").val()==""){
        $("#postcode").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#postcode");
        if(!message) message = "This value is required.";
      }
      else if(!/^([A-PR-UWYZ0-9][A-HK-Y0-9][AEHMNPRTVXY0-9]?[ABEHMNPRVWXY0-9]? {0,2}[0-9][ABD-HJLN-UW-Z]{2}|GIR 0AA)$/i.test(String($("#postcode").val()))){
        $("#postcode").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#postcode");
        if(!message) message = "This value should be a valid UK postcode.";
      }
      else{
        $("#postcode").removeClass("is-invalid");
      }
      
      if($("#dt_phone").val()==""){
        $("#dt_phone").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#dt_phone");
        if(!message) message = "This value is required.";
      }
      else if(!/\s*(([+](\s?\d)([-\s]?\d)|0)?(\s?\d)([-\s]?\d){9}|[(](\s?\d)([-\s]?\d)+\s*[)]([-\s]?\d)+)\s*/.test(String($("#dt_phone").val()))){
        $("#dt_phone").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#dt_phone");
        if(!message) message = "This value should be a valid UK phone number.";
      }
      else{
        $("#dt_phone").removeClass("is-invalid");
      }
      
      if( $("#m_phone").val() != "" && !/((\+44(\s\(0\)\s|\s0\s|\s)?)|0)7\d{3}(\s)?\d{6}/g.test(String($("#m_phone").val()))){
        $("#m_phone").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#m_phone");
        if(!message) message = "This value should be a valid UK mobile phone number.";
      }
      else{
        $("#m_phone").removeClass("is-invalid");
      }
      
      if($("#email").val()==""){
        $("#email").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#email");
        if(!message) message = "This value is required.";
      }
      else if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String($("#email").val()).toLowerCase())){
        $("#email").addClass("is-invalid");
        if(!first_error_object) first_error_object = $("#email");
        if(!message) message = "This value should be a valid email.";
      }
      else{
        $("#email").removeClass("is-invalid");
      }

      if(first_error_object){
        $('#toast-tofix .message').html(message);
        jQuery('#toast-tofix').toast('show');
        $("#cover_type").focus();
        first_error_object.focus();
      }
      else{
        $("#generate-77").submit();
      }
    }
  </script>
  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

  <!-- rest-api -->
  <script type="text/javascript">
	if(typeof jQuery != 'undefined' && typeof jQuery.fn.select2 != 'undefined'){
		//init select2
		jQuery(function($){
			$('select.select2').select2();
		});
	}

~function(){

	var form_id = 'generate-77';
	var form_element = document.getElementById(form_id);
	var input_elements = form_element.getElementsByTagName('input');
	var textarea_elements = form_element.getElementsByTagName('textarea');
	var select_elements = form_element.getElementsByTagName('select');

	var rules = [];
	var initial_state = 
    {
        "joint_application":
        {
            "id":112,
            "key":"joint_application",
            "type":"radio",
            "label":"Who is the cover for?",
            "text_format":null,
            "placeholder":null,
            "options":
            {
                "Just me":"Just me",
                "Me and my partner":"Me and my partner"
            },
            "description":"",
            "default":"Just me",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":null,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "insurance_type":
        {
            "id":105,
            "key":"insurance_type",
            "type":"select",
            "label":"Type of insurance",
            "text_format":null,
            "placeholder":null,
            "options":
            {
                "Life Insurance only":"Life Insurance only",
                "Life Insurance with Critical Illness":"Life Insurance with Critical Illness",
                "Mortgage Life Insurance":"Mortgage Life Insurance",
                "Whole of Life":"Whole of Life"
            },
            "description":"<strong>Life Insurance<\/strong> - The insured sum is paid out if you die during the term of the policy.\r\n\r\n<strong>Life Insurance with Critical Illness<\/strong> - As above but also pays out on diagnosis of certain medical conditions as laid out in the policy, i.e. heart attack, some cancers, stroke etc.\r\n\r\n<strong>Whole of Life<\/strong> - A plan that covers you for the rest of your life instead of a set term.\r\n\r\n<strong>Mortgage Life Insurance<\/strong> - The amount of cover reduces over the policy term, usually in line with your outstanding mortgage balance.",
            "default":"Life Insurance only",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":null,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "cover_amount":
        {
            "id":106,
            "key":"cover_amount",
            "type":"select",
            "label":"Amount of cover",
            "text_format":null,
            "placeholder":null,
            "options":
            {
                "10000":"\u00a310,000",
                "15000":"\u00a315,000",
                "20000":"\u00a320,000",
                "25000":"\u00a325,000",
                "30000":"\u00a330,000",
                "35000":"\u00a335,000",
                "40000":"\u00a340,000",
                "45000":"\u00a345,000",
                "50000":"\u00a350,000",
                "55000":"\u00a355,000",
                "60000":"\u00a360,000",
                "65000":"\u00a365,000",
                "70000":"\u00a370,000",
                "75000":"\u00a375,000",
                "80000":"\u00a380,000",
                "85000":"\u00a385,000",
                "90000":"\u00a390,000",
                "95000":"\u00a395,000",
                "100000":"\u00a3100,000",
                "105000":"\u00a3105,000",
                "110000":"\u00a3110,000",
                "115000":"\u00a3115,000",
                "120000":"\u00a3120,000",
                "125000":"\u00a3125,000",
                "130000":"\u00a3130,000",
                "135000":"\u00a3135,000",
                "140000":"\u00a3140,000",
                "145000":"\u00a3145,000",
                "150000":"\u00a3150,000",
                "155000":"\u00a3155,000",
                "160000":"\u00a3160,000",
                "165000":"\u00a3165,000",
                "170000":"\u00a3170,000",
                "175000":"\u00a3175,000",
                "180000":"\u00a3180,000",
                "185000":"\u00a3185,000",
                "190000":"\u00a3190,000",
                "195000":"\u00a3195,000",
                "200000":"\u00a3200,000",
                "210000":"\u00a3210,000",
                "220000":"\u00a3220,000",
                "230000":"\u00a3230,000",
                "240000":"\u00a3240,000",
                "250000":"\u00a3250,000",
                "260000":"\u00a3260,000",
                "270000":"\u00a3270,000",
                "280000":"\u00a3280,000",
                "290000":"\u00a3290,000",
                "300000":"\u00a3300,000",
                "325000":"\u00a3325,000",
                "350000":"\u00a3350,000",
                "375000":"\u00a3375,000",
                "400000":"\u00a3400,000",
                "425000":"\u00a3425,000",
                "450000":"\u00a3450,000",
                "475000":"\u00a3475,000",
                "500000":"\u00a3500,000",
                "525000":"\u00a3525,000",
                "550000":"\u00a3550,000",
                "575000":"\u00a3575,000",
                "600000":"\u00a3600,000",
                "650000":"\u00a3650,000",
                "700000":"\u00a3700,000",
                "750000":"\u00a3750,000",
                "800000":"\u00a3800,000",
                "850000":"\u00a3850,000",
                "900000":"\u00a3900,000",
                "950000":"\u00a3950,000",
                "1000000":"\u00a31,000,000",
                "1100000":"\u00a31,100,000",
                "1200000":"\u00a31,200,000",
                "1300000":"\u00a31,300,000",
                "1400000":"\u00a31,400,000",
                "1500000":"\u00a31,500,000"
            },
            "description":"Choose an amount that reflects your financial needs in the event of a claim. For instance you might want to pay off a mortgage or debts, or leave a lump sum to your family.",
            "default":"100000",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":null,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "cover_length":
        {
            "id":107,
            "key":"cover_length",
            "type":"select",
            "label":"Length of cover",
            "text_format":null,
            "placeholder":null,
            "options":
            {
                "1":"1 year",
                "2":"2 years",
                "3":"3 years",
                "4":"4 years",
                "5":"5 years",
                "6":"6 years",
                "7":"7 years",
                "8":"8 years",
                "9":"9 years",
                "10":"10 years",
                "11":"11 years",
                "12":"12 years",
                "13":"13 years",
                "14":"14 years",
                "15":"15 years",
                "16":"16 years",
                "17":"17 years",
                "18":"18 years",
                "19":"19 years",
                "20":"20 years",
                "21":"21 years",
                "22":"22 years",
                "23":"23 years",
                "24":"24 years",
                "25":"25 years",
                "26":"26 years",
                "27":"27 years",
                "28":"28 years",
                "29":"29 years",
                "30":"30 years",
                "31":"31 years",
                "32":"32 years",
                "33":"33 years",
                "34":"34 years",
                "35":"35 years",
                "36":"36 years",
                "37":"37 years",
                "38":"38 years",
                "39":"39 years",
                "40":"40 years",
                "41":"41 years",
                "42":"42 years",
                "43":"43 years",
                "44":"44 years",
                "45":"45 years",
                "46":"46 years",
                "47":"47 years",
                "48":"48 years",
                "49":"49 years",
                "50":"50 years"
            },
            "description":"Choose a policy term (the number of years you will be protected by the policy). This should align with your financial obligations and needs.",
            "default":"20",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":null,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "first_name":
        {
            "id":97,
            "key":"first_name",
            "type":"text",
            "label":"First name",
            "text_format":null,
            "placeholder":null,
            "options":[],
            "description":"",
            "default":"",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":30,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "last_name":
        {
            "id":98,
            "key":"last_name",
            "type":"text",
            "label":"Last name",
            "text_format":null,
            "placeholder":null,
            "options":[],
            "description":"",
            "default":"",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":30,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "address_line_1":
        {
            "id":108,
            "key":"address_line_1",
            "type":"text",
            "label":"Address line 1",
            "text_format":null,
            "placeholder":null,
            "options":[],
            "description":"",
            "default":"",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":80,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "postcode":
        {
            "id":102,
            "key":"postcode",
            "type":"text",
            "label":"Postcode",
            "text_format":null,
            "placeholder":null,
            "options":[],
            "description":"",
            "default":"",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":8,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "dob":
        {
            "id":103,
            "key":"dob",
            "type":"date-3",
            "label":"Date of birth",
            "text_format":"",
            "placeholder":"",
            "options":[],
            "description":"Your age is one of the factors used to calculate your premium. You must be aged between 18 and 80.",
            "default":"01-01-1970",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"-80,-18",
            "max_length":null,
            "convert_rule":"",
            "convert_source_1":0,
            "convert_source_2":0
        },
        "smoker":
        {
            "id":109,
            "key":"smoker",
            "type":"radio",
            "label":"Have you smoked in the last 12 months?",
            "text_format":null,
            "placeholder":null,
            "options":
            {
                "No":"No",
                "Yes":"Yes"
            },
            "description":"This includes cigarettes, cigars, pipe using, or other tobacco products including nicotine replacements and e-cigarettes.",
            "default":"No",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":null,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "telephone":
        {
            "id":100,
            "key":"telephone",
            "type":"text",
            "label":"Telephone number 1",
            "text_format":null,
            "placeholder":null,
            "options":[],
            "description":"",
            "default":"",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":null,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "mobile":
        {
            "id":101,
            "key":"mobile",
            "type":"text",
            "label":"Telephone number 2",
            "text_format":null,
            "placeholder":null,
            "options":[],
            "description":"",
            "default":"",
            "fieldset":"",
            "required":0,
            "hidden":0,
            "year_range":"",
            "max_length":null,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "email":
        {
            "id":99,
            "key":"email",
            "type":"text",
            "label":"Email",
            "text_format":null,
            "placeholder":null,
            "options":[],
            "description":"",
            "default":"",
            "fieldset":"",
            "required":1,
            "hidden":0,
            "year_range":"",
            "max_length":null,
            "convert_rule":null,
            "convert_source_1":null,
            "convert_source_2":null
        },
        "age":
        {
            "id":265,
            "key":"age",
            "type":"convert",
            "label":"Age",
            "text_format":null,
            "placeholder":null,
            "options":[],
            "description":"",
            "default":"",
            "fieldset":"",
            "required":0,
            "hidden":1,
            "year_range":"",
            "max_length":null,
            "convert_rule":"date_to_age",
            "convert_source_1":103,
            "convert_source_2":null
        },
        "affiliate_campaign_id":
        {
            "id":"","type":"hidden"
        }
    };
	
	for(var i=0;i<input_elements.length;i++){
		~function(el){
			apply_rules(el);
			if(el.type != 'radio' && el.type != 'checkbox'){
				bindEvent(el,'change',event_apply_rules);
			}else{
				bindEvent(el,'click',function(){
					apply_rules(el);
				});
			}
		}(input_elements[i]);
	}
	for(var i=0;i<textarea_elements.length;i++){
		~function(el){
			apply_rules(el);
			bindEvent(el,'change',event_apply_rules);
		}(textarea_elements[i]);
	}
	for(var i=0;i<select_elements.length;i++){
		~function(el){
			apply_rules(el);
			bindEvent(el,'change',event_apply_rules);
		}(select_elements[i]);
	}

	bindEvent(form_element, 'submit', function(){
		for(var i=0;i<input_elements.length;i++){
			if(input_elements[i].type == 'submit'){
				input_elements[i].disabled = 'disabled';
			}
		}
		//Gif
		var items = form_element.parentElement.children;
		for(var i = 0; i < items.length; i++){
			if(items[i].className != 'hideloading'){
				items[i].style.visibility = 'hidden';
			}else{
				items[i].style.display = 'block';
			}
		}
	});

	function apply_rules( e ){
		var key = e.name;
		var type = e.type;

		//get current_rules
		var i;
		for( i in rules ){
			var single_rule = rules[i];
			if( single_rule.key == key || (single_rule.key  + '[]' == key)){
				if(type == 'radio'){
					var elements = document.getElementsByName(key);
					for(var j=0;j<elements.length;j++){
						if(elements[j].checked){
							var value = elements[j].value;
							break;
						}
					}
				}else if(type == 'checkbox'){
					var elements = document.getElementsByName(key);
					var value = [];
					for(var j=0;j<elements.length;j++){
						if(elements[j].checked){
							value.push(elements[j].value);
						}
					}
				}else{
					var value = e.value;
				}
				apply_rule( single_rule,value,initial_state );
			}
		}

		//check fieldset
		var fieldsets = form_element.getElementsByTagName('fieldset');
		for(var i = 0; i < fieldsets.length; i++){

			var fieldset = fieldsets[i];
			var fielddivs = fieldset.getElementsByClassName('field_div').length;
			var hiddendivs =  fieldset.getElementsByClassName('hidden').length;
			if(fielddivs == hiddendivs){
				fieldset.style.display = 'none';
			}else{
				fieldset.style.display = 'block';
			}
		}
	}

	function event_apply_rules(  ){
		apply_rules(this);
	}

	function apply_rule( single_rule,value,initial_state ){
		var rule_method = single_rule.rule_method;
		var rule_value = single_rule.rule_value;
		var set_field = single_rule.then_campaign_field;
		var required = single_rule.required;
		var hidden = single_rule.hidden;

		if( check_condition(rule_method,value,rule_value) ){
			set_element_class(required,hidden,set_field);
		}else{
			var initial_required = initial_state[set_field].required;
			var initial_hidden = initial_state[set_field].hidden;
			set_element_class(initial_required,initial_hidden,set_field);
		}
	}

	function check_condition(rule_method,value,rule_value){

		//if both are numbers
		if(!isNaN(parseFloat(value)) && !isNaN(parseFloat(rule_value))){
			value = parseFloat(value);
			rule_value = parseFloat(rule_value);
		}

		switch(rule_method){
			case 'Equal':
				return (value==rule_value);
			case 'Match':
				return (value.match(rule_value));
			case 'Great Than':
				return (value>rule_value);
			case 'Great Than Or Equal To':
				return (value>=rule_value);
			case 'Less Than':
				return (value<rule_value);
			case 'Less Than Or Equal To':
				return (value<=rule_value);
			case 'Contain':
				return (value.indexOf(rule_value) !== -1);
			case 'In':
				return (rule_value.indexOf(value) !== -1);
		}
	}

	function set_element_class(required,hidden,set_field){
		var element_id = 'field_'+set_field;
		var edit_element = document.getElementById(element_id);
		if(!edit_element) return;
		var class_name = edit_element.className;
		if(required){
			if(!class_name.match(/required/)) class_name += ' required';
		}else{
			class_name = class_name.replace('required','');
		}
		if(hidden){
			if(!class_name.match(/hidden/)) class_name += ' hidden';
		}else{
			class_name = class_name.replace('hidden','');
		}
		edit_element.className = class_name;
	}

	function bindEvent(element, type, handler) {
	   if(element.addEventListener) {
	      element.addEventListener(type, handler, false);
	   } else {
	      element.attachEvent('on'+type, handler);
	   }
	}

	if(typeof document.getElementsByClassName != 'undefined'){
		var tpms = document.getElementsByClassName('tooltipmark');
	}else if(typeof document.querySelectorAll != 'undefined'){
		var tpms = document.querySelectorAll('.tooltipmark');
	}else{
		var tpms = [];
		var re = new RegExp('(^| )tooltipmark( |$)');
		var els = form_element.getElementsByTagName("*");
		for(var i=0,j=els.length; i<j; i++)
			if(re.test(els[i].className))tpms.push(els[i]);
	}
	for(i = 0; i < tpms.length; i++){
		~function(em){
			bindEvent(em, 'mouseover', function(){
				var id = em.parentNode.parentNode.id.replace('field_','');
				var description = initial_state[id].description.replace(/(\r\n|\n\r|\r|\n)/g, '<br>');
				tooltip.show(description);
			})
			bindEvent(em, 'mouseout', function(){
				tooltip.hide();
			})
		}(tpms[i])
	}


	if(typeof document.getElementsByClassName != 'undefined'){
		var ds = document.getElementsByClassName('date-1');
	}else if(typeof document.querySelectorAll != 'undefined'){
		var ds = document.querySelectorAll('.date-1');
	}else{
		var ds = [];
		var re = new RegExp('(^| )date-1( |$)');
		var els = form_element.getElementsByTagName("*");
		for(var i=0,j=els.length; i<j; i++)
			if(re.test(els[i].className))ds.push(els[i]);
	}

	for(i = 0; i < ds.length; i++){
		~function(div){
			var el = div.getElementsByTagName('input')[0]
			var year_from = el.getAttribute('data-year-from');
			var year_to = el.getAttribute('data-year-to');
			var defaultDate = new Date(Date.parse('01-01-'+year_to));
			var picker = new Pikaday({
				field: el,
				format: 'DD-MM-YYYY',
				yearRange: [year_from, year_to],
				defaultDate: defaultDate
			});
		}(ds[i])
	}
}();
</script>

</body>
</html>
