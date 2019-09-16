
<html lang="en">
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>/* lato-300 - latin */ /* @font-face { font-family: MyFont; font-weight: px number; font-style: normal/italic/oblique; font-display:swap/auto/..; } */ @font-face { font-family: 'Lato'; font-display: swap; font-style: normal; font-weight: 300; src: local('Lato Light'), local('Lato-Light'), url('https://cdn.lensa.com/fonts/Lato/lato-v15-latin-300.woff2') format('woff2'), url('https://cdn.lensa.com/fonts/Lato/lato-v15-latin-300.woff') format('woff'); }</style>
    <title>JOB - HUNTER</title>
    <meta name="title" content="JOB - HUNTER">
    <meta name="description" content="Find a job you love on jobhunter! Search millions of jobs online and find companies who are hiring now on our new job board.">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 兼容ie-->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 移动 -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="jobhunter">
    <meta property="og:locale" content="ch_CN">
    <!-- <meta property="og:image" content="https://cdn.lensa.com/fb_g.png"> -->
    <meta property="og:title" content="Millions of jobs">
    <meta property="og:description" content="Find a job you love on jobhunter! Search millions of jobs online and find companies who are hiring now on our new job board.">
    <meta property="og:url" content="http://domain-name/job_result.php">
    <!-- for seo always used in SNS -->
    <meta name="robots" content="noindex, follow">
    <link rel="stylesheet" href="./site_app_jobhunter_format.css">
    <link rel="stylesheet" href="./site_app_frontend_bundledPages_format.css">
    <link href="./pic/logo.jpeg" rel="shortcut icon">
    <style type="text/css">/* Chart.js */ @-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}} @keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}} .chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style>
  </head>
  
  <body class="">
    <div id="root" style="height: auto !important;">
    <!--<div id="root">-->
      <div class="site-header shadow">
        <a class="logo" href="#">
          <img src="./pic/logo_banner.jpg" alt="jobhunter"></a>
        <div class="search-container">
          <form class="search-form" action="job_result_format.php" method="GET">
            <div class="search-input-wrapper input-small">
              <span class="error">
                <span class="">Please type in a position!</span></span>
              <div class="search-input position-input">
                <span class="icon">
                  <img src="./pic/search.svg" alt="position"></span>
                <span class="lensa-site-autocomplete">
                  <div role="combobox" aria-haspopup="listbox" aria-owns="react-autowhatever-job-title" aria-expanded="false" class="react-autosuggest__container">
                    <input type="text" value="<?php echo $_GET['job-title']?>" autocomplete="off" aria-autocomplete="list" aria-controls="react-autowhatever-job-title" class="field" name="job-title" placeholder="Job title" maxlength="50">
                    <div id="react-autowhatever-job-title" role="listbox" class="react-autosuggest__suggestions-container e2e-suggestions"></div>
                  </div>
                </span>
                <div class="underline-content">
                  <div class="underline"></div>
                </div>
              </div>
            </div>
            <div class="btn-content mobile-left button-small">
              <button type="submit" class="search-btn">
                <span>Search</span></button>
            </div>
          </form>
        </div>

      </div>
        <div class="job-opportunities-page" style="height: auto !important;">
         <div class="job_result_main">
          
<?php

    header('Content-Type:text/html; charset=utf-8');
    //1.获取xml数据
    $queryTerm=$_GET['job-title'];
    $queryTermAnded ="";
    $queryTerm_array = explode(' ', trim($queryTerm));
    foreach ($queryTerm_array as $value) {
      $queryTermAnded.='+';
      $queryTermAnded.=$value;
    }
    $queryTermAnded = substr($queryTermAnded, 1);
    ?>
       <div class="index_word"> your searched term: <?php echo $queryTermAnded ?></div>
       <hr>
    <?php
 
    $request_url = "https://neuvoo.com/services/api-new/search?ip=".getUserIpAddr()."&useragent=".getUserAgent()."&k=".$queryTermAnded."&format=json&l=&country=ca&contenttype=sponsored&limit=15&publisher=a2a69b51&cpcfloor=1";

    $jsondata=file_get_contents("$request_url");


    $value_array = json_decode($jsondata,true); 
    $value_obj = json_decode($jsondata);
    //var_dump($value_obj);
    //var_dump($value_obj->results[0]);
    if (!($value_obj->results)) {
      echo "no result find";
    }else{
      foreach ($value_obj->results as $value) {
        //echo $value->url;
        //echo $value->jobtitle;
        //echo $value->description;
        //echo $value->logo;

?>
      <div class="block-result-main">
        <div class="title-result">
          <a href="<?php echo $value->url ?>"><?php echo $value->jobtitle?></a>
        </div>
        <div class="pic_text_wrapper">
          <div class="icon_comp" style="width: 50px;height: 50px"><img src="<?php echo $value->logo ?>"></div>
          <div class="description"><p class="des_para"><?php echo $value->description ?></p></div>
        
      </div>
        
        <div class="location"><p>Location: <?php echo $value->formattedLocation ?></p></div>
      </div>
<?php
      }
    }
   
?>

<?php
//get user's ip
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function getUserAgent(){
  $Agent = $_SERVER['HTTP_USER_AGENT'];
    $browseinfo='';
    if(preg_match('/Mozilla/', $Agent) && !preg_match('/MSIE/', $Agent)){
        $browseinfo = 'Mozilla';
    }
    if(preg_match('/Opera/', $Agent)) {
        $browseinfo = 'Opera';
    }
    if(preg_match('/Mozilla/', $Agent) && preg_match('/MSIE/', $Agent)){

        $browseinfo = 'Internet Explorer';
    }
    if(preg_match('/Chrome/', $Agent)){
        $browseinfo="Chrome";
    }
    if(preg_match('/Safari/', $Agent)){
        $browseinfo="Safari";
    }
    if(preg_match('/Firefox/', $Agent)){
        $browseinfo="Firefox";
    }
  return $browseinfo;
}
?>

         </div>
        </div>
    </div>
    
  </body>

</html>