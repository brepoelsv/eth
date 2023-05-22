<html lang="en"><!doctype html>
<head>
<link rel="preconnect" href="https://fonts.gstatic.com" />
<link
  rel="preload"
  as="style"
  href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap"
/>
<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap"
  media="print"
  onload="this.media='all'"
/>
<noscript>
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap"
  />
</noscript>
<script>
var focussearch = 0;
</script>
<script>
  // Render blocking JS:
  if (localStorage.theme) document.documentElement.setAttribute("data-theme", localStorage.theme);
  </script>
 <script type="text/javascript">
if (screen.width <= 1024) {
document.location = "https://m.<?php echo($_SERVER['SERVER_NAME']); ?><?php echo(pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME));?>/<?php echo(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));?>";
//document.location = "https://m.<?php echo($_SERVER['SERVER_NAME']); ?>?>";

}
</script>

<script>
window.addEventListener('resize', function() {
	if (window.innerWidth <= 1024) {
		window.location ="https://m.<?php echo($_SERVER['SERVER_NAME']); ?><?php echo(pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME));?>/<?php echo(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));?>";
	//	window.location ="https://m.<?php echo($_SERVER['SERVER_NAME']); ?>";
	}
});
</script> 

<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-S8PLBPRKRW"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-S8PLBPRKRW');
	</script>
	
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="alternate" media="only screen and (max-width: 1024px)"
            href="https://m.<?php echo($_SERVER['SERVER_NAME']); ?><?php echo(pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME));?>/<?php echo(pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME));?>"> 
    <link rel="stylesheet" href="https://<?php echo($_SERVER['SERVER_NAME']); ?>/cpcdetailv0.00272.css">
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet"> -->

    <link rel="icon" 
      type="image/png" 
      href="/cpclogos/Group 451.png">
    <script src="/websocket.js"></script>
    <script src="https://unpkg.com/lightweight-charts@3.8.0/dist/lightweight-charts.standalone.production.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://d3js.org/d3.v6.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinysort/3.2.5/tinysort.js"></script>
    <?php     
    include '/home/blobber/db/db.php';
    $query = "select count(url_symbol) numberof, lower(ppi.exchange) exchange, lower(ppi.symbol1) symbol1, lower(ppi.symbol2) symbol2, lower(ppi.url_symbol) url_symbol from pagePairsInfos ppi where lower(exchange) = 'binance' and symbol1 = 'eth' and symbol2 = 'usdt'";
               $rec = mysqli_query($conn, $query);
               while ($result = mysqli_fetch_assoc($rec)) {
                   $assocbinance[] = $result;
                   if ($result['numberof'] > 0) {
                       $islistedonexchange = $result['numberof'];
                       $exchange = strtolower($result['exchange']);
                       $symbol1 = strtolower($result['symbol1']);
                       $symbol2 = strtolower($result['symbol2']);
                       $url_sym = strtolower($result['url_symbol']);
                       $symbol1upper = strtoupper($symbol1);
                       $symbol2upper = strtoupper($symbol2);
                       $url_symupper = strtoupper($url_sym);
                       $urlklines = $url_symupper;
                       if (is_numeric(substr($url_symupper, 0, 1)) == 'true' )
                       {
                        $urlklines = substr($url_symupper, 1);
                       }
                   }

               }
    $querycoin = "select TRIM(price)+0 price from binanceRTC" . $symbol1 . " where url_symbol = '" . $url_symupper . "' ";
               $rec = mysqli_query($conn, $querycoin);
               while ($result = mysqli_fetch_assoc($rec)) {
                   $BitPrice  = $result['price'];
                }
?>   

    <?php
                                $memtest = new Memcached();
                                $memtest->addServer("127.0.0.1", 11211);
                                $TTL = 5;
                                $query = "with scope as (SELECT current_price as btc from pageCoinsMainPage where id = 'bitcoin') 
                                SELECT scope.btc, market_cap_rank, logo, name, symbol, current_price, market_cap, volume, 
                                round(price_change_percentage_1h_in_currency,2) price_change_percentage_1h_in_currency,
                                round(price_change_percentage_24h_in_currency,2) price_change_percentage_24h_in_currency, 
                                round(price_change_percentage_7d_in_currency,2) price_change_percentage_7d_in_currency, 
                                round(price_change_percentage_30d_in_currency,2) price_change_percentage_30d_in_currency, 
                                round(price_change_percentage_1y_in_currency,0) price_change_percentage_1y_in_currency, 
                                contentUrl, contentExchange, contentValutaLeft, contentValutaRight, coin from pageCoinsMainPage, scope 
                                where symbol = '$symbol1'";
                                //echo $query;
                                $setKey = "KEY" . md5($query);
                                $getCacheDetail = $memtest->get($setKey);
                                if ($getCacheDetail) {
                                    $assoc2 = $getCacheDetail;
                                    foreach ($assoc2 as $result) {
                                        $market_cap_rank = $result['market_cap_rank']; 
                                        // $logoClean = str_replace('.','puntje', $result['logo']);
                                        // $logoClean =  preg_replace('/[^A-Za-z0-9]/', '', $logoClean);
                                        // $logoClean = str_replace('puntje','.', $logoClean);
                                        // if ( $result['logo'] == 'SYLO.svg')
                                        // {
                                        //   $logoClean = 'SYLO.png';
                                        // }
                                        $logoClean = $result['logo'];
                                        $name = $result['name'];
                                        $symbol = strtoupper($result['symbol']);
                                        $price = $result['current_price'];
                                        $priceinbtc = round($result['current_price']/$result['btc'],8);
                                        $price_change_percentage_1h_in_currency = $result['price_change_percentage_1h_in_currency'];
                                        $price_change_percentage_24h_in_currency = $result['price_change_percentage_24h_in_currency'];
                                        $price_change_percentage_7d_in_currency = $result['price_change_percentage_7d_in_currency'];
                                        $price_change_percentage_30d_in_currency = $result['price_change_percentage_30d_in_currency'];
                                        $price_change_percentage_1y_in_currency = $result['price_change_percentage_1y_in_currency'];
                                       
                                    }
                                } else {
                                    $rec = mysqli_query($conn, $query);
                                    while ($result = mysqli_fetch_assoc($rec)) {
                                        $assoc2[] = $result; // Results storing in array
                                        $memtest->set($setKey, $assoc2, $TTL);
                                        $market_cap_rank = $result['market_cap_rank']; 
                                        // $logoClean = str_replace('.','puntje', $result['logo']);
                                        // $logoClean =  preg_replace('/[^A-Za-z0-9]/', '', $logoClean);
                                        // $logoClean = str_replace('puntje','.', $logoClean);
                                        // if ( $result['logo'] == 'SYLO.svg')
                                        // {
                                        //   $logoClean = 'SYLO.png';
                                        // }
                                        $logoClean = $result['logo'];
                                        $name = $result['name'];
                                        $symbol = strtoupper($result['symbol']);
                                        $price = $result['current_price'];
                                        $priceinbtc = round($result['current_price']/$result['btc'],8);
                                        $price_change_percentage_1h_in_currency = $result['price_change_percentage_1h_in_currency'];
                                        $price_change_percentage_24h_in_currency = $result['price_change_percentage_24h_in_currency'];
                                        $price_change_percentage_7d_in_currency = $result['price_change_percentage_7d_in_currency'];
                                        $price_change_percentage_30d_in_currency = $result['price_change_percentage_30d_in_currency'];
                                        $price_change_percentage_1y_in_currency = $result['price_change_percentage_1y_in_currency'];
                                    }
                                }
                                ?>
<meta name="description" content="Track real-time prices and stay updated with the latest information on Ethereum (<?php echo $symbol1upper ?>) and other cryptocurrencies. Explore live price charts, historical data, and market trends. Join thousands of users relying on CryptoPrediction for accurate and timely crypto information.">

<title>Real-Time Ethereum (<?php echo $symbol1upper ?>) Price Tracker | CryptoPrediction</title>
   
</head>


<body>
<?php function checkInteger($int) {
if ( is_int($int)) {
	return abs($int);
}
else
{  
    if ( floatval($int) >= 0 or floatval($int) < 0)
    {
        return abs(floatval($int));
    }
    else
    {
        return $int;
    }
}
}
?>
        <?php
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Headers: X-Requested-With, replace-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    // header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
?>
<?php

    // $queryuni ="SELECT count(*) numberofuni, sp.id as id, t0id, t0symbol, t1symbol, txCount, t0price, t1price, t1price*1650, floor(unix_timestamp(now())/86400) nu FROM uniswapTradingPairsInfos sp, uniswapPairToTokens spt, uniswapTradingTokenInfos st where
     // sp.id = spt.pair and spt.t0id = st.id and st.symbol ='".$symbol1."' and t1symbol = 'WETH' and txCount > 1000 and txCount = 
     // (select max( distinct cast(txCount as signed)) as txCount FROM uniswapPairToTokens spt where t0symbol ='".$symbol1."' and t1symbol = 'WETH')";
     // $recuniswap = mysqli_query($conn, $queryuni);
    // //echo $queryuni;
     // while ($result = mysqli_fetch_assoc($recuniswap)) {
         // if ($result['numberofuni'] > 0) {
             // $uniswap_pair_id = $result['id'];
             // $uniswap_t0id = $result['t0id'];
             // $nu = $result['nu'];
             // $uni = 1;
         // } else {
             // $uni = 0;
         // }
     // }
     // if ($uni == 1) {
        // $uniswappairnu = $uniswap_pair_id . '-' . $nu;
        // $uniswaptokennu = $uniswap_t0id . '-' . $nu;
    // }

 ?> 
            <?php $clength = "select coinlength, coininteger from coinLength where lower(exchange) = 'binance' and url_symbol = '" . $url_sym . "'";
             // echo $clength;
               $reclength = mysqli_query($conn, $clength);
               while ($result = mysqli_fetch_assoc($reclength)) {
                   $url_coinlength = $result['coinlength'];
                   $url_coininteger = $result['coininteger'];

               }
?>

<div class="grid-body">
    <!-- <div class= "grid-overlay">
    </div> -->
    <div class="grid-headerleftwrapper">
        <a href="https://<?php echo(strtolower($_SERVER['SERVER_NAME'])); ?>" onclick="stopWs();return false;"  >
        <div class="grid-hl1">
		<?php echo "<img src=$logoClean style=\"width: 2.4rem;height: 2.4rem\">"; ?>
    <!--         <svg xmlns="http://www.w3.org/2000/svg" width="23" height="21" viewBox="0 0 24.089 26.08">
            <g id="Group_451" data-name="Group 451" transform="translate(-266.496 -235.986)">
                <g id="Group_450" data-name="Group 450" transform="translate(266.496 235.986)">
                <path id="Path_472" data-name="Path 472" d="M282.887,242.084l-.148.245-1.428,2.387a9.025,9.025,0,0,0-8.657,1.748c-.171.149-.342.3-.506.469a8.978,8.978,0,0,0-2.6,5.459c-.022.1-.03.193-.045.3v.008a.166.166,0,0,1-.03.037,6.793,6.793,0,0,0-.655.907,6.423,6.423,0,0,0-.937,3.384,5.857,5.857,0,0,1-.662-1.041,6.329,6.329,0,0,1-.7-2.32v-.008c-.015-.112-.022-.223-.03-.335a12.477,12.477,0,0,1,.1-1.487,12.059,12.059,0,0,1,16.295-9.75Z" transform="translate(-266.496 -239.275)" fill="#ff9f2f"/>
                <g id="Group_449" data-name="Group 449" transform="translate(1.391)">
                    <path id="Path_473" data-name="Path 473" d="M289.193,241.727l-.886,1.484-1.557,2.607-5.542,9.283-.646,1.084a6.529,6.529,0,0,1-6.264,2.583l-.155-.026a6.526,6.526,0,0,1-3.974-2.389,6.5,6.5,0,0,1,1.588-4.287l.036-.041c-.006.071-.01.143-.011.216,0,.024,0,.048,0,.073a3.521,3.521,0,0,0,6.523,1.84l.059-.1,2.782-4.659,3.065-5.133,1.553-2.6.873-1.462Z" transform="translate(-270.168 -238.603)" fill="#ff9f2f"/>
                    <path id="Path_474" data-name="Path 474" d="M310.8,236.9l3.58-.916a.086.086,0,0,1,.1.062l.916,3.58a.086.086,0,0,1-.127.1l-4.5-2.664A.086.086,0,0,1,310.8,236.9Z" transform="translate(-295.368 -235.986)" fill="#ff9f2f"/>
                </g>
                </g>
                <path id="Path_475" data-name="Path 475" d="M270.263,263.39a6.55,6.55,0,0,0,3.644,2.008l.156.022a6.4,6.4,0,0,0,1,.082h.089a9.052,9.052,0,0,0,13.93-10.353c-.022-.067-.052-.141-.082-.208a.813.813,0,0,0-.067-.171,1.122,1.122,0,0,0-.059-.141c-.022-.052-.045-.1-.067-.149,0-.007-.007-.015-.015-.022a1.386,1.386,0,0,0-.082-.186,1.158,1.158,0,0,1-.082-.164l-.089-.156A8.938,8.938,0,0,0,287,251.885l.267-.446,1.3-2.186c.186.156.372.335.55.513.059.052.112.112.164.164a1.249,1.249,0,0,1,.089.1c.044.045.1.1.141.149l.178.2c.044.052.089.1.141.164l.119.141c.037.044.074.1.111.149s.089.112.134.171l.2.267c.045.067.1.134.141.2s.1.149.149.223.1.149.149.231c.044.067.082.141.126.208.008.008.008.015.015.022s0,.008.007.008c.037.074.082.141.119.216l.008.008c0,.007,0,.007.008.015.03.052.06.1.089.164a1.1,1.1,0,0,1,.082.164.8.8,0,0,1,.045.082.183.183,0,0,0,.03.052c0,.008,0,.008.008.015a.024.024,0,0,0,.008.015l.067.134a.1.1,0,0,1,.015.045c.007.007.015.022.022.03s.008.022.015.037c.03.067.067.141.1.208a1.008,1.008,0,0,0,.059.134c.067.164.141.335.2.506a.976.976,0,0,1,.052.134c.015.044.037.1.052.141s.044.126.067.193a.106.106,0,0,0,.015.045c.007.022.015.052.022.082s.03.1.044.141c.008,0,.008.007.008.015l.067.223c.015.067.037.134.052.2.015.037.022.082.037.127s.022.089.03.126.015.059.022.082a.255.255,0,0,0,.015.074,1.419,1.419,0,0,1,.037.186c.037.164.067.327.1.5.008.067.022.134.03.2.015.082.03.171.037.253v.007l.022.178c.007.03.007.067.015.1.015.149.022.3.037.446a.752.752,0,0,0,.008.127.7.7,0,0,0,.007.126v.082c0,.052.008.111.008.171v.32a12.043,12.043,0,0,1-22.809,5.407.025.025,0,0,1-.008-.015.208.208,0,0,1-.022-.1.265.265,0,0,1,.268-.26.255.255,0,0,1,.178.067" transform="translate(-2.048 -8.24)" fill="#d66b13"/>
            </g>
            </svg>  -->

            <h1><p>&nbsp;<?php echo $symbol1upper ?><!-- VeChain Price Prediction 2021 <?php echo $symbol1upper;echo str_repeat('&nbsp;', 1); ?><?php echo $symbol2upper ?> -- Crypto Prediction Coin -- News, Charts and Real-time updates from Binance --></p></h1> 


        </div>
        </a>
    </div>
    <div class="grid-headermiddlewrapper">
    <?php $queryurl = "select  concat(symbol1,'/',symbol2) pairsinfo, upper(symbol2) as symbol2,  concat(ppi.id1, 'ticker') coin, 
    lower(ppi.exchange) exchange from pagePairsInfos ppi where exchange='Binance' and symbol1 = '$symbol1' and symbol2 = '$symbol2'";
          $recqueryurl = mysqli_query($conn, $queryurl);
                        //echo $queryuni;
                         while ($result = mysqli_fetch_assoc($recqueryurl)) {

                            echo "<a href=\"https://" . $_SERVER['SERVER_NAME'] . "/{$result['exchange']}/{$result['pairsinfo']}/{$result['coin']}\" class=\"active\">";
                            echo "<div class=\"grid-hm1\"><p>Ticker</p></div></a>";
                         }

       


    ?>



                    <!--         <a href="#pricestats" class="active"><div class="grid-hm1"><p>Dashboard</p></div></a> -->
        <a href="#pricechart"><div class="grid-hm2"><p>Charts</p></div></a>
        <a href="#chart"><div class="grid-hm3"><p>Orderbook</p></div></a>
        <a href="#trades"><div class="grid-hm3"><p>Trades</p></div></a>
        <!-- <a><div class="grid-hm4"><p></p></div></a> -->
    </div>
    <div class="grid-headerrightwrapper">
    <div class="grid-hr0"><p>Dominance</p></div>
        <div class="grid-hr0b"><p><span style='font-weight: normal'>btc</span>
        <?php $query = "select round(value,2) as value from getGlobals gG, pageCoinsMainPage pC where totals = 'MARKET_CAP_PERCENTAGE' and gG.symbol = 'btc' and gG.symbol = pC.symbol";
                        $rec = mysqli_query($conn, $query);
                        while ($result = mysqli_fetch_assoc($rec)) {
                            $value= $result['value'];
                            echo $value;echo "%";echo "&nbsp;";
                        }
                     ?>
                     <span style='font-weight: normal'>eth</span>
        <?php $query = "select round(value,2) as value from getGlobals gG, pageCoinsMainPage pC where totals = 'MARKET_CAP_PERCENTAGE' and gG.symbol = 'eth' and gG.symbol = pC.symbol";
                        $rec = mysqli_query($conn, $query);
                        while ($result = mysqli_fetch_assoc($rec)) {
                            $value= $result['value'];
                            echo $value;echo "%";
                        }
                     ?></p></div>
        <div class="grid-hr1"><p>Market Cap</p></div>
        <div class="grid-hr2"><p>
            <?php $query = "select round(value*current_price,0) totalmarketcap from getGlobals gG, pageCoinsMainPage pC where totals = 'TOTAL_MARKET_CAP' and gG.symbol = 'btc' and gG.symbol = pC.symbol";
                        //echo $queryprice;
                        $rec = mysqli_query($conn, $query);
                        while ($result = mysqli_fetch_assoc($rec)) {
                            $totalmarketcap = number_format($result['totalmarketcap']);
                            echo "$";echo $totalmarketcap;
                        }
                        ?>
             <?php $query = "select round(value,2) mcapchange from getGlobals gG where totals = 'MCAP_CHANGE'";
                        //echo $queryprice;
                        $rec = mysqli_query($conn, $query);
                        while ($result = mysqli_fetch_assoc($rec)) {
                            $mcapchange = $result['mcapchange'];
                            if ($mcapchange >= 0) {
                                echo "<span style=\"color:#0FC441; font-size: 1.0rem;\" >";
                                echo $mcapchange;echo "%"; echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9650;"; echo "</p>"; echo "</div>";
                                echo "</span>";
                            }
                            else
                            {
                                echo "<span style=\"color:#EB2020; font-size: 1.0rem;\" >";
                                echo $mcapchange;echo "%"; echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                                echo "</span>";

                            }
                        }
                        ?>    
                    </p></div>
        <div class="grid-hr3"><p>24h Volume</p></div>
        <div class="grid-hr4"><p><?php $query = "select round(value*current_price,0) totalvolume from getGlobals gG, pageCoinsMainPage pC where totals = 'TOTAL_VOLUME' and gG.symbol = 'btc' and gG.symbol = pC.symbol";
                        //echo $queryprice;
                        $rec = mysqli_query($conn, $query);
                        while ($result = mysqli_fetch_assoc($rec)) {
                            $totalvolume = number_format($result['totalvolume']);
                            echo "$";echo $totalvolume;
                        }
                        ?></p></div>
        <div class="grid-hr5">
            <button id = "theme-toggle" type="button">
            <span class="d-block-light d-none"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24.54" viewBox="0 0 24 24.54">
                <g id="Moon_3_" transform="translate(-5.628)">
                    <g id="Group_13" data-name="Group 13" transform="translate(5.628 0.551)">
                    <g id="Group_12" data-name="Group 12">
                        <path id="Path_3" data-name="Path 3" d="M29.288,25.556a.72.72,0,0,0-.862.079A9.326,9.326,0,0,1,15.248,12.463a.719.719,0,0,0-.729-1.175A12.212,12.212,0,1,0,29.6,26.362.717.717,0,0,0,29.288,25.556Z" transform="translate(-5.628 -11.262)" fill="#1f242f"/>
                    </g>
                    </g>
                    <g id="Group_15" data-name="Group 15" transform="translate(16.875)">
                    <g id="Group_14" data-name="Group 14">
                        <path id="Path_4" data-name="Path 4" d="M252.231,10.369a2.2,2.2,0,0,1-2.2-2.2.734.734,0,1,0-1.467,0,2.2,2.2,0,0,1-2.2,2.2.734.734,0,1,0,0,1.467,2.2,2.2,0,0,1,2.2,2.2.734.734,0,1,0,1.467,0,2.2,2.2,0,0,1,2.2-2.2.734.734,0,1,0,0-1.467Zm4.4-7.434a2.2,2.2,0,0,1-2.2-2.2.734.734,0,0,0-1.467,0,2.2,2.2,0,0,1-2.2,2.2.734.734,0,1,0,0,1.467,2.2,2.2,0,0,1,2.2,2.2.734.734,0,0,0,1.467,0,2.2,2.2,0,0,1,2.2-2.2.734.734,0,0,0,0-1.467Z" transform="translate(-245.628)" fill="rgba(25,39,69,0.5)"/>
                    </g>
                    </g>
                </g>
                </svg>
            </span>
            <span class="d-block-dark d-none"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24.54" viewBox="0 0 24 24.54">
                    <g id="Moon_3_" transform="translate(-5.628)">
                        <g id="Group_13" data-name="Group 13" transform="translate(5.628 0.551)">
                        <g id="Group_12" data-name="Group 12">
                            <path id="Path_3" data-name="Path 3" d="M29.288,25.556a.72.72,0,0,0-.862.079A9.326,9.326,0,0,1,15.248,12.463a.719.719,0,0,0-.729-1.175A12.212,12.212,0,1,0,29.6,26.362.717.717,0,0,0,29.288,25.556Z" transform="translate(-5.628 -11.262)" fill="#fff"/>
                        </g>
                        </g>
                        <g id="Group_15" data-name="Group 15" transform="translate(16.875)">
                        <g id="Group_14" data-name="Group 14">
                            <path id="Path_4" data-name="Path 4" d="M252.231,10.369a2.2,2.2,0,0,1-2.2-2.2.734.734,0,1,0-1.467,0,2.2,2.2,0,0,1-2.2,2.2.734.734,0,1,0,0,1.467,2.2,2.2,0,0,1,2.2,2.2.734.734,0,1,0,1.467,0,2.2,2.2,0,0,1,2.2-2.2.734.734,0,1,0,0-1.467Zm4.4-7.434a2.2,2.2,0,0,1-2.2-2.2.734.734,0,0,0-1.467,0,2.2,2.2,0,0,1-2.2,2.2.734.734,0,1,0,0,1.467,2.2,2.2,0,0,1,2.2,2.2.734.734,0,0,0,1.467,0,2.2,2.2,0,0,1,2.2-2.2.734.734,0,0,0,0-1.467Z" transform="translate(-245.628)" fill="rgba(255,255,255,0.5)"/>
                        </g>
                        </g>
                    </g>
                </svg>
            </span>
            </button>
        </div>
    </div>
    <!-- <div class="grid-b"> -->
       <!-- <div id="explain_placeholder"></div> -->
        <!--   <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9490373085041113"
        crossorigin="anonymous"></script>  -->
    <!-- cpindexdesktop -->
       <!--   <ins class="adsbygoogle"
        style="display:block; height: 80px; width:710px"
        data-ad-client="ca-pub-9490373085041113"
        data-ad-slot="5112614934"
        data-full-width-responsive="true"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>  -->
    <!-- </div> -->
     <div class="grid-exchanges">
        <div class="grid-exchange1">
            <div class="exchange">
                <div class="exlogo"><img src="/cpclogos/binance.png" alt="binance logo" style="width: 1.6rem;height: 1.6rem"></div>
                <div class="exname">Binance</div>
                <div class="bitlogo"><img src="/cpclogos/bitcoin.png" alt="bitcoin logo" style="width: 1.6rem;height: 1.6rem"/></div>
                <div class="bitprice">
                    <div id="binanceBTCRTC">
                        <?php $queryprice = "select TRIM(price)+0 price from binanceRTCbtc where url_symbol = 'btcusdt'";
                            //echo $queryprice;
                            $recjson = mysqli_query($conn, $queryprice);
                            while ($resultprice = mysqli_fetch_assoc($recjson)) {
                                $BinanceBitPrice  = $resultprice['price'];
                                //$BitPrice  = $resultprice['price'];
                                $bitcoin = $resultprice['price'];
                                echo "$";echo $BinanceBitPrice;
                            }
                           
                            ?>
                    </div> 
                </div>
                <div class="ethlogo"><img src="/cpclogos/ethereum.png" alt="ethereum logo" style="width: 1.6rem;height: 1.6rem" /></div>
                <div class="ethprice">
                    <div id="binanceETHRTC">
                        <?php $queryprice = "select TRIM(price)+0 price from binanceRTCeth where url_symbol = 'ethusdt' ";
                            //echo $queryprice;
                            $recjson = mysqli_query($conn, $queryprice);
                            while ($resultprice = mysqli_fetch_assoc($recjson)) {
                                $BinanceEthPrice  = $resultprice['price'];
                                echo "$";echo $BinanceEthPrice;
                            }
                        ?>
                    </div> 
                </div>
            </div>
        </div>
        <div class="grid-exchange2">
            <div class="exchange">
                <div class="exlogo">
                    <span class="d-block-light d-none"> 
                        <img src="/cpclogos/huobi-light.png" alt="huobi logo" style="width: 1.4rem;height: 1.6rem" />
                    </span>
                    <span class="d-block-dark d-none"> 
                        <img src="/cpclogos/huobi-dark.png" alt="huobi logo" style="width: 1.4rem;height: 1.6rem" />
                    </span>
                </div>
                <div class="exname">Huobi</div>
                <div class="bitlogo"><img src="/cpclogos/bitcoin.png" alt="ethereum logo" style="width: 1.6rem;height: 1.6rem" /></div>
                <div class="bitprice">
                    <div id="huobiBTCRTC">
                        <?php $queryprice = "select TRIM(price)+0 price from huobiRTCbtc where tid = (select max(tid) from huobiRTCbtc where url_symbol = 'btcusdt' )";
                        //echo $queryprice;
                        $recjson = mysqli_query($conn, $queryprice);
                        while ($resultprice = mysqli_fetch_assoc($recjson)) {
                            $HuobiBitPrice  = $resultprice['price'];
                            echo "$";echo $HuobiBitPrice; 
                        }
                        ?>
                    </div> 
                </div>
                <div class="ethlogo"><img src="/cpclogos/ethereum.png" alt="ethereum logo" style="width: 1.6rem;height: 1.6rem" /></div>
                <div class="ethprice">
                    <div id="huobiETHRTC">
                        <?php $queryprice = "select TRIM(price)+0 price from huobiRTCeth where tid = (select max(tid) from huobiRTCeth where url_symbol = 'ethusdt' )";
                        //echo $queryprice;
                        $recjson = mysqli_query($conn, $queryprice);
                        while ($resultprice = mysqli_fetch_assoc($recjson)) {
                                $HuobiEthPrice  = $resultprice['price'];
                                echo "$";echo $HuobiEthPrice;
                        }
                        ?>
                    </div> 
                </div>
            </div>
        </div>
        <div class="grid-exchange3">
            <div class="exchange">
                <div class="exlogo"><img src="/cpclogos/bitstamp.png" alt="bitstamp logo" style="width: 1.6rem;height: 1.6rem" />  </div>
                <div class="exname">Bitstamp</div>
                <div class="bitlogo"><img src="/cpclogos/bitcoin.png" alt="bitcoin logo" style="width: 1.6rem;height: 1.6rem" />  </div>
                <div class="bitprice">
                    <div id="bitstampBTCRTC">
                        <?php $queryprice = "select TRIM(price)+0 price from bitstampRTCbtcusd";
                        //echo $queryprice;
                        $recjson = mysqli_query($conn, $queryprice);
                        while ($resultprice = mysqli_fetch_assoc($recjson)) {
                                $BitstampBitPrice  = $resultprice['price'];
                                echo "$";echo $BitstampBitPrice; 
                        }
                        ?>
                    </div> 
                </div>
                <div class="ethlogo"><img src="/cpclogos/ethereum.png" alt="ethereum logo" style="width: 1.6rem;height: 1.6rem" />  </div>
                <div class="ethprice">
                    <div id="bitstampETHRTC">
                        <?php $queryprice = "select TRIM(price)+0 price from bitstampRTCethusd";
                        //echo $queryprice;
                        $recjson = mysqli_query($conn, $queryprice);
                        while ($resultprice = mysqli_fetch_assoc($recjson)) {
                                $BitstampEthPrice  = $resultprice['price'];
                                echo "$";echo $BitstampEthPrice;
                        }
                        ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="grid-table-left">
            <div class="grid-title">Losers
            </div>
            <div class="divider">
            </div> 
            <div class="grid-table-header-small">
                <div class="grid-smpos">#
                </div>
                <div class="grid-smsymbol">Symbol
                </div>
                <div class="grid-smchange">24h %Change
                </div>
            </div>
            <div class="divider">
            </div> 
            <ul class="listgainers">
            <?php
                        $query = "SELECT market_cap_rank, logo, symbol,
                        round(price_change_percentage_24h_in_currency,2) price_change_percentage_24h_in_currency, contentUrl, contentExchange, contentValutaLeft, contentValutaRight, coin
                        from pageCoinsMainPage where market_cap_rank < 200 order by  price_change_percentage_24h_in_currency asc LIMIT 10";
                        $rec = mysqli_query($conn, $query);
                            while ($result = mysqli_fetch_assoc($rec)){
                                include '/home/blobber/mainpage/mainpageTableContentvsmall.php';
                            }
                        ?>
            </ul>
            <div class="divider">
            </div> 
            <div class="grid-title">Small Caps
            </div>
            <div class="divider">
            </div> 
            <div class="grid-table-header-small">
                <div class="grid-smpos">#
                </div>
                <div class="grid-smsymbol">Symbol
                </div>
                <div class="grid-smchange">24h %Change
                </div>
            </div>
            <div class="divider">
            </div> 
            <ul class="listsmallcapsgainers">
            <?php
                        $query = "SELECT market_cap_rank, logo, symbol,
                        round(price_change_percentage_24h_in_currency,2) price_change_percentage_24h_in_currency, contentUrl, contentExchange, contentValutaLeft, contentValutaRight, coin
                        from pageCoinsMainPage where market_cap_rank > 200 order by  price_change_percentage_24h_in_currency asc LIMIT 5";
                       // echo $query;
                        $rec = mysqli_query($conn, $query);
                            while ($result = mysqli_fetch_assoc($rec)){
                                include '/home/blobber/mainpage/mainpageTableContentvsmall.php';
                            }
                        ?>
            </ul>
    </div>
    <?php
                                $memtest = new Memcached();
                                $memtest->addServer("127.0.0.1", 11211);
                                $TTL = 5;
                                $query = "with scope as (SELECT current_price as btc from pageCoinsMainPage where id = 'bitcoin') 
                                SELECT scope.btc, market_cap_rank, logo, name, symbol, current_price, market_cap, volume, 
                                round(price_change_percentage_1h_in_currency,2) price_change_percentage_1h_in_currency,
                                round(price_change_percentage_24h_in_currency,2) price_change_percentage_24h_in_currency, 
                                round(price_change_percentage_7d_in_currency,2) price_change_percentage_7d_in_currency, 
                                round(price_change_percentage_30d_in_currency,2) price_change_percentage_30d_in_currency, 
                                round(price_change_percentage_1y_in_currency,0) price_change_percentage_1y_in_currency, 
                                contentUrl, contentExchange, contentValutaLeft, contentValutaRight, coin from pageCoinsMainPage, scope 
                                where symbol = '$symbol1'";
                                //echo $query;
                                $setKey = "KEY" . md5($query);
                                $getCacheDetail = $memtest->get($setKey);
                                if ($getCacheDetail) {
                                    $assoc2 = $getCacheDetail;
                                    foreach ($assoc2 as $result) {
                                        $market_cap_rank = $result['market_cap_rank']; 
                                        // $logoClean = str_replace('.','puntje', $result['logo']);
                                        // $logoClean =  preg_replace('/[^A-Za-z0-9]/', '', $logoClean);
                                        // $logoClean = str_replace('puntje','.', $logoClean);
                                        // if ( $result['logo'] == 'SYLO.svg')
                                        // {
                                        //   $logoClean = 'SYLO.png';
                                        // }
                                        $logoClean = $result['logo'];
                                        $name = $result['name'];
                                        $symbol = strtoupper($result['symbol']);
                                        $price = $result['current_price'];
                                        $priceinbtc = round($result['current_price']/$result['btc'],8);
                                        $price_change_percentage_1h_in_currency = $result['price_change_percentage_1h_in_currency'];
                                        $price_change_percentage_24h_in_currency = $result['price_change_percentage_24h_in_currency'];
                                        $price_change_percentage_7d_in_currency = $result['price_change_percentage_7d_in_currency'];
                                        $price_change_percentage_30d_in_currency = $result['price_change_percentage_30d_in_currency'];
                                        $price_change_percentage_1y_in_currency = $result['price_change_percentage_1y_in_currency'];
                                       
                                    }
                                } else {
                                    $rec = mysqli_query($conn, $query);
                                    while ($result = mysqli_fetch_assoc($rec)) {
                                        $assoc2[] = $result; // Results storing in array
                                        $memtest->set($setKey, $assoc2, $TTL);
                                        $market_cap_rank = $result['market_cap_rank']; 
                                        // $logoClean = str_replace('.','puntje', $result['logo']);
                                        // $logoClean =  preg_replace('/[^A-Za-z0-9]/', '', $logoClean);
                                        // $logoClean = str_replace('puntje','.', $logoClean);
                                        // if ( $result['logo'] == 'SYLO.svg')
                                        // {
                                        //   $logoClean = 'SYLO.png';
                                        // }
                                        $logoClean = $result['logo'];
                                        $name = $result['name'];
                                        $symbol = strtoupper($result['symbol']);
                                        $price = $result['current_price'];
                                        $priceinbtc = round($result['current_price']/$result['btc'],8);
                                        $price_change_percentage_1h_in_currency = $result['price_change_percentage_1h_in_currency'];
                                        $price_change_percentage_24h_in_currency = $result['price_change_percentage_24h_in_currency'];
                                        $price_change_percentage_7d_in_currency = $result['price_change_percentage_7d_in_currency'];
                                        $price_change_percentage_30d_in_currency = $result['price_change_percentage_30d_in_currency'];
                                        $price_change_percentage_1y_in_currency = $result['price_change_percentage_1y_in_currency'];
                                    }
                                }
                                ?>
    <!--START ENKEL VOOR TICKERS 
        END GET 24H REAL TIME DATA from DATABASE and keep feeding with Websockets 
    --> 
                  <?php  $query = "select unix_timestamp(now()) updatedAt, 
                                        ifnull(max(case when diff = '24h' then percdiff end), '-') as 24h, 
                                  ifnull(max(case when diff = '12h' then percdiff end), '-') as 12h, 
                                  ifnull(max(case when diff = '4h' then percdiff end), '-') as 4h, 
                                  ifnull(max(case when diff = '1h' then percdiff end), '-') as 1h, 
                                  ifnull(max(case when diff = '15min' then percdiff end), '-') as 15min from 
                   (select  '$url_sym', '24h' as diff , (
                                 round(( 
                                 ((SELECT close FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(24*60*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(24*60*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual
                              UNION
                              select  '$url_sym','12h', (
                                 round(( 
                                 ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(12*60*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(12*60*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual
                                       UNION
                              select  '$url_sym','4h', (
                                 round(( 
                                 ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(4*60*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(4*60*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual
                              UNION
                              select  '$url_sym','1h', (
                                 round(( 
                                 ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*60*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*60*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual
                              UNION
                              select  '$url_sym','15min', (
                                 round(( 
                                 ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(15*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(15*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual) d";
                                                   $query = "select unix_timestamp(now()) updatedAt, 
                                        ifnull(max(case when diff = '24h' then percdiff end), '-') as 24h, 
                                  ifnull(max(case when diff = '12h' then percdiff end), '-') as 12h, 
                                  ifnull(max(case when diff = '4h' then percdiff end), '-') as 4h, 
                                  ifnull(max(case when diff = '1h' then percdiff end), '-') as 1h, 
                                  ifnull(max(case when diff = '15min' then percdiff end), '-') as 15min from 
                   (select  '$url_sym', '24h' as diff , (
                                 round(( 
                                 ((SELECT close FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(24*60*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(24*60*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual
                              UNION
                              select  '$url_sym','12h', (
                                 round(( 
                                 ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(12*60*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(12*60*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual
                                       UNION
                              select  '$url_sym','4h', (
                                 round(( 
                                 ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(4*60*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(4*60*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual
                              UNION
                              select  '$url_sym','1h', (
                                 round(( 
                                 ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*60*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*60*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual
                              UNION
                              select  '$url_sym','15min', (
                                 round(( 
                                 ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00')) = klstart/1000)-
                                      (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(15*60+1*60) = klstart/1000) )
                              / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                              and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(15*60+1*60) = klstart/1000)
                              )*100,2)
                                       ) as percdiff  from dual) d";
                   
                   
       
       
       
                        $querybak = "select unix_timestamp(now()) updatedAt, 
                                       ifnull(max(case when diff = '24h' then percdiff end), '-') as 24h, 
                                 ifnull(max(case when diff = '12h' then percdiff end), '-') as 12h, 
                                 ifnull(max(case when diff = '4h' then percdiff end), '-') as 4h, 
                                 ifnull(max(case when diff = '1h' then percdiff end), '-') as 1h, 
                                 ifnull(max(case when diff = '15min' then percdiff end), '-') as 15min from 
                  (select  '$url_sym', '24h' as diff , (
                                round(( 
                                ((SELECT close FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-60 = klstart/1000)-
                                     (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(24*60*60+1*60) = klstart/1000) )
                             / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(24*60*60+1*60) = klstart/1000)
                             )*100,2)
                                      ) as percdiff  from dual
                             UNION
                             select  '$url_sym','12h', (
                                round(( 
                                ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-60 = klstart/1000)-
                                     (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(12*60*60+1*60) = klstart/1000) )
                             / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(12*60*60+1*60) = klstart/1000)
                             )*100,2)
                                      ) as percdiff  from dual
                                      UNION
                             select  '$url_sym','4h', (
                                round(( 
                                ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-60 = klstart/1000)-
                                     (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(4*60*60+1*60) = klstart/1000) )
                             / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(4*60*60+1*60) = klstart/1000)
                             )*100,2)
                                      ) as percdiff  from dual
                             UNION
                             select  '$url_sym','1h', (
                                round(( 
                                ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-60 = klstart/1000)-
                                     (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*60*60+1*60) = klstart/1000) )
                             / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*60*60+1*60) = klstart/1000)
                             )*100,2)
                                      ) as percdiff  from dual
                             UNION
                             select  '$url_sym','15min', (
                                round(( 
                                ((SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-60 = klstart/1000)-
                                     (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(15*60+1*60) = klstart/1000) )
                             / (SELECT close  FROM `binanceklines` WHERE url_symbol='$url_sym'
                             and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(15*60+1*60) = klstart/1000)
                             )*100,2)
                                      ) as percdiff  from dual) d";
                    $rec = mysqli_query($conn, $query);
                   while ($result = mysqli_fetch_assoc($rec)) {
                       
                       $h24h = $result['24h'];
                       $h12h = $result['12h'];
                       $h4h = $result['4h'];
                       $h1h = $result['1h'];
                       $h15m = $result['15min'];
       
                       if ($h4h == '-' && $h12h == '-')
                       {
                           $rec = mysqli_query($conn, $querybak);
                           while ($result = mysqli_fetch_assoc($rec)) {
                               $h24h = $result['24h'];
                               $h12h = $result['12h'];
                               $h4h = $result['4h'];
                               $h1h = $result['1h'];
                               $h15m = $result['15min'];
                           }
       
                       }
       
       
       
                   }
                   ?>

<?php $query= "select * from ((SELECT  TRIM(max(high))+0 high24, TRIM(min(low))+0 low24, sum(trades) trade24, sum(vol) vol24 FROM `binanceklines` WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(24*60*60 + 1*60) <= klstart/1000 ) a,
                       (SELECT TRIM(max(high))+0 high12, TRIM(min(low))+0 low12, sum(trades) trade12, sum(vol) vol12 FROM `binanceklines` 
                        WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(12*60*60 + 1*60) <= klstart/1000 ) b,
                       (SELECT TRIM(max(high))+0 high4, TRIM(min(low))+0 low4, sum(trades) trade4, sum(vol) vol4 FROM `binanceklines` 
                        WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(4*60*60 + 1*60) <= klstart/1000 ) c,
                       (SELECT TRIM(max(high))+0 high1, TRIM(min(low))+0 low1, sum(trades) trade1, sum(vol) vol1 FROM `binanceklines` 
                        WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*60*60 + 1*60) <= klstart/1000) d,
                       (SELECT TRIM(max(high))+0 high15, TRIM(min(low))+0 low15, sum(trades) trade15, sum(vol) vol15 FROM `binanceklines` 
                        WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*15*60 + 1*60) <= klstart/1000) e )";
                        $rec = mysqli_query($conn, $query);
                        while ($result = mysqli_fetch_assoc($rec)) {
                            $high15 = $result['high15'];
                            $low15 = $result['low15'];
                            $vol15 = $result['vol15'];
                            $trade15 = $result['trade15'];
                            if (is_int($result['low15'])){
                                    $hilow15 = round ( (($result['high15']-$result['low15'] ) / $result['low15'])*100 , 2);
                                    }
                            else {
                                $hilow15 = 'N/A';
                            }

                            $high1 = $result['high1'];
                            $low1 = $result['low1'];
                            $vol1 = $result['vol1'];
                            $trade1 = $result['trade1'];
                            if (is_int($result['low1'])){
                                $hilow1 = round ( (($result['high1']-$result['low1'] ) / $result['low1'])*100 , 2);
                            }
                            else {
                                $hilow1 = 'N/A';
                            }
                            
                            $high4 = $result['high4'];
                            $low4 = $result['low4'];
                            $vol4 = $result['vol4'];
                            $trade4 = $result['trade4'];
                            if (is_int($result['low4'])){
                                $hilow4 = round ( (($result['high4']-$result['low4'] ) / $result['low4'])*100 , 2);
                            }
                            else {
                                $hilow4 = 'N/A';
                            }
                            
                            $high12 = $result['high12'];
                            $low12 = $result['low12'];
                            $vol12 = $result['vol12'];
                            $trade12 = $result['trade12'];
                            if (is_int($result['low12'])){
                                $hilow12 = round ( (($result['high12']-$result['low12'] ) / $result['low12'])*100 , 2);
                                 }
                            else {
                            $hilow12 = 'N/A';
                            }
                            
                            $high24 = $result['high24'];
                            $low24 = $result['low24'];
                            $vol24 = $result['vol24'];
                            $trade24 = $result['trade24'];
                            if (is_int($result['low24'])){
                                $hilow24 = round ( (($result['high24']-$result['low24'] ) / $result['low24'])*100 , 2);
                            }
                            else {
                                $hilow24 = 'N/A';
                            }
                        }

                        ?>


    <!--EINDE ENKEL VOOR TICKERS 
        END GET 24H REAL TIME DATA from DATABASE and keep feeding with Websockets 
    --> 
    <div class="grid-table-content" id="pricestats">
        <div class="grid-table-stats">
            <div class="grid-table-stats-name"><h2>
                <?php if ( strlen($name) > 10 ) {

                echo $name; echo "&nbsp;"; echo "Price Stats";
                }
                else
                {
                echo $name; echo "&nbsp;"; echo "Price Statistics";

                }
                ?> </h2></div>
            <div class="grid-table-stats-rank"><?php   echo "Rank #";echo $market_cap_rank; ?>
            </div>

                       <div class="grid-table-stats-timef">

                            <div class="nnn1420o05">15m</div>
                            <div class="nnn1420o05">1h</div>
                            <div class="nnn1420o05">4h</div>
                            <div class="nnn1420o05">12h</div>
                            <div class="nnn1420o05">24h</div>

                            <?php if ($h15m >= 0)
                       {

                        echo "<div class=\"nnb1622o1\" id=\"perc15placeholderstats\" >";
                       echo "<span style=\"color:#0FC441\" >";
                       echo checkInteger($h15m); echo "%"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                       echo "</div>";
                       }
                       else {
                        echo "<div class=\"nnb1622o1\" id=\"perc15placeholderstats\" >";
                        echo "<span style=\"color:#EB2020\" >";
                        echo checkInteger($h15m); echo "%"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                        echo "</div>";
                       }
                       ?>
                       <?php if ($h1h >= 0)
                       {
                        echo "<div class=\"nnb1622o1\" id=\"perc1placeholderstats\" >";
                       echo "<span style=\"color:#0FC441\" >";
                       echo checkInteger($h1h); echo "%"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                       echo "</div>";
                       }
                       else {
                        echo "<div class=\"nnb1622o1\" id=\"perc1placeholderstats\" >";
                        echo "<span style=\"color:#EB2020\" >";
                        echo checkInteger($h1h); echo "%"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                        echo "</div>";
                       }
                       ?>
                           <?php if ($h4h >= 0)
                       {
                        echo "<div class=\"nnb1622o1\" id=\"perc4placeholderstats\" >";
                       echo "<span style=\"color:#0FC441\" >";
                       echo checkInteger($h4h); echo "%"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                       echo "</div>";
                       }
                       else {
                        echo "<div class=\"nnb1622o1\" id=\"perc4placeholderstats\" >";
                        echo "<span style=\"color:#EB2020\" >";
                        echo checkInteger($h4h); echo "%"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                        echo "</div>";
                       }
                       ?>
                           <?php if ($h12h >= 0)
                       {
                        echo "<div class=\"nnb1822o1\" id=\"perc12placeholderstats\" >";
                       echo "<span style=\"color:#0FC441\" >";
                       echo checkInteger($h12h); echo "%"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                       echo "</div>";
                       }
                       else {
                        echo "<div class=\"nnb1822o1\" id=\"perc12placeholderstats\" >";
                        echo "<span style=\"color:#EB2020\" >";
                        echo checkInteger($h12h); echo "%"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                        echo "</div>";
                       }
                       ?>
                           <?php if ($h24h >= 0)
                       {
                        echo "<div class=\"nnb1622o1\" id=\"perc24aplaceholderstats\" >";
                       echo "<span style=\"color:#0FC441\" >";
                       echo checkInteger($h24h); echo "%"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                       echo "</div>";
                       }
                       else {
                        echo "<div class=\"nnb1622o1\" id=\"perc24aplaceholderstats\" >";
                        echo "<span style=\"color:#EB2020\" >";
                        echo checkInteger($h24h); echo "%"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                        echo "</div>";
                       }
                       ?>

                       <!--START ENKEL VOOR NIET TICKERS 
                           MOETEN OOK 1h en 24h uit commentaar. Deze zitten reeds in de real-time voor de tickers.     
                           
                           NOG TODO voor tickers en niet-tickers. Automatische update van Coingecko historische data
                    --> 
    
                            <!-- <div class="nnn1420o05">1h</div>
                            <div class="nnn1420o05">24h</div> -->

                                                   <!--EINDE ENKEL VOOR NIET TICKERS 
                           MOETEN OOK 1h en 24h uit commentaar. Deze zitten reeds in de real-time voor de tickers.        
                    --> 
                            <div class="nnn1420o05">7d</div>
                            <div class="nnn1420o05">30d</div>
                            <div class="nnn1420o05">1y</div>

                         <!-- Voor niet tickers moeten deze 2 <div></div> in commentaar. Dit zijn placeholders omdat voor tickers de 1h en 24h niet worden getoond.     
                    -->                           

                            <div class="nnn1420o05"></div>
                            <div class="nnn1420o05"></div>

                            <?php include '/home/blobber/mainpage/mainpageTableContentTicker.php';?>
                        </div>
                        <?php $querysup = "SELECT market_cap_rank,  total_volume,
        case 
            when circulating_supply*" . $price . " > 1000000000 THEN concat(round((circulating_supply*" . $price . ")/1000/1000/1000,2),'B') 
            when circulating_supply*" . $price . " > 100000000 THEN concat(round((circulating_supply*" . $price . ")/1000/1000,2),'M') 
             else concat(round((circulating_supply*" . $price . ")/1000,3),'K') 
        end Mcap, 
        case 
        when total_supply*" . $price . " > 1000000000 THEN concat(round((total_supply*" . $price . ")/1000/1000/1000,2),'B') 
        when total_supply*" . $price . " > 100000000 THEN concat(round((total_supply*" . $price . ")/1000/1000,2),'M') 
         else concat(round((total_supply*" . $price . ")/1000,3),'K') 
        end FullyMcap,
        circulating_supply, 
        IFNULL(total_supply,'∞') as total_supply, 
        IFNULL(max_supply,'∞') as max_supply, 
        IFNULL( round( (circulating_supply/total_supply)*100, 2), 'NA')  percsupply,
        high_24h, low_24h, price_change_24h, round(price_change_percentage_24h,2) price_change_percentage_24h, TRIM(ath)+0 ath , ath_change_percentage, DATE_FORMAT(CONVERT(ath_date,datetime),'%b %d %Y') ath_date,
        TRIM(atl)+0 atl, atl_change_percentage, DATE_FORMAT(CONVERT(atl_date,datetime),'%b %d %Y')  atl_date
        FROM getCoinMarkets where symbol = '" . $symbol1 . "'"; 
                     // echo $querysup;
                           $recsup = mysqli_query($conn, $querysup);
                           while ($resultsupply = mysqli_fetch_assoc($recsup)) {
                               //$market_cap_rank = $resultsupply['market_cap_rank'];
                               $total_volume = $resultsupply['total_volume'];
                               $mcap = $resultsupply['Mcap'];
                               $fullydilutedmcap =  $resultsupply['FullyMcap'];
                               $circulatingsupply = $resultsupply['circulating_supply'];
                               $totalsupply = $resultsupply['total_supply'];
                               $maxsupply = $resultsupply['max_supply'];
                               $percsupply = $resultsupply['percsupply'];
                               $high_24h = $resultsupply['high_24h'];
                               $low_24h = $resultsupply['low_24h'];
                               $price_change_24h = $resultsupply['price_change_24h'];
                               $price_change_percentage_24h = $resultsupply['price_change_percentage_24h'];
                               $ath = $resultsupply['ath'];
                               $ath_change_percentage = $resultsupply['ath_change_percentage'];
                               $ath_date = $resultsupply['ath_date'];
                               $atl = $resultsupply['atl'];
                               $atl_change_percentage = $resultsupply['atl_change_percentage'];
                               $atl_date = $resultsupply['atl_date'];
                              // echo(number_format($supply) . "$");
                              // echo(number_format($circulating_supply) . "$");
                              // echo(number_format($total_supply) . "$");
                               //echo("Ξ");
                           }
        ?>
                       <div class="grid-table-stats-market">

                            <div class="nnn1420o05">Circ. Supply</div>
                            <div class="nnn1420o05">Total Supply</div>
                            <div class="nnn1420o05">Max Supply</div>
                            <div class="nnn1420o05">Ratio Circ./Total Supply</div>
                            <div class="nnn1420o05"></div>
                            <div class="nnb1822o1">
                                <?php if ($circulatingsupply < 1000000 )
                            {
                                echo round($circulatingsupply/1000,2); echo "k";
                            }
                            else if ($circulatingsupply > 1000000 && $circulatingsupply < 1000000000)
                            {
                                echo round($circulatingsupply/1000/1000,3); echo "M";
                            }
                            else if ($circulatingsupply > 1000000000)
                            {
                                echo round($circulatingsupply/1000/1000/1000,4); echo "B";
                            }
                            else
                            {
                                echo $circulatingsupply;
                            }
                             ?></div>
                            <div class="nnb1822o1">
                            <?php if ($totalsupply == '∞' )
                            {
                                echo $totalsupply;
                            } 
                            else if ($totalsupply < 1000000 )
                            {
                                echo round($totalsupply/1000,2); echo "k";
                            }
                            else if ($totalsupply > 1000000 && $totalsupply < 1000000000)
                            {
                                echo round($totalsupply/1000/1000,3); echo "M";
                            }
                            else if ($totalsupply > 1000000000)
                            {
                                echo round($totalsupply/1000/1000/1000,4); echo "B";
                            }
                            else
                            {
                                echo $totalsupply;
                            }
                             ?>
                            </div>
                            <div class="nnb1822o1">
                            <?php if ($maxsupply == '∞' )
                            {
                                echo $maxsupply;
                            } 
                            else if ($maxsupply < 1000000 )
                            {
                                echo round($maxsupply/1000,2); echo "k";
                            }
                            else if ($maxsupply > 1000000 && $maxsupply < 1000000000)
                            {
                                echo round($maxsupply/1000/1000,3); echo "M";
                            }
                            else if ($maxsupply > 1000000000)
                            {
                                echo round($maxsupply/1000/1000/1000,4); echo "B";
                            }
                            else
                            {
                                echo $maxsupply;
                            }
                             ?>
                            </div>
                            <div class="nnb1822o1">
                            <?php if ( $totalsupply == '∞' )
                            {
                                echo '';
                            } 
                            else 
                            {
                                echo round(($circulatingsupply/$totalsupply)*100,2); echo "%";
                                }
                                ?>
                            </div>
                            <div class="nnb1822o1"></div>

                       </div>
                       <div class="grid-table-stats-hilo">

                       

                            <div class="nnn1420o05">24h Range</div>
                            <div class="nnn1420o05">24h High</div>
                            <div class="nnn1420o05">24h Low</div>
                            <div class="nnn1420o05">All Time High</div>
                            <div class="nnn1420o05">% from ATH</div>
<!--                             <div class="nnb1822o1"><?php echo $hilow24; echo "%"; ?></div> -->
 <!--                             <div class="nnb1822o1"><?php echo $low_24h ?></div>  -->

                            <div class="nnb1822o1">
                                <div id="hilow24aplaceholderch"><?php echo $hilow24; echo "%"; ?>
                                </div>
                            </div>

                            <div class="nnb1822o1">
                                <div id="high24aplaceholderch"><?php echo $high24 ?>
                                </div>
                            </div>

                            <div class="nnb1822o1">
                                <div id="low24aplaceholderch"><?php echo $low24 ?>
                                </div>
                            </div>

                            <div class="nnb1822o1">
							    <div id="athPlaceholderprice">
                                </div>
								<?php echo str_repeat('&nbsp;', 1); ?> <img src="/cpclogos/binance.png" alt="binance logo" style="width: 1.6rem;height: 1.6rem">
							</div>
                            <div class="nnb1822o1">
							    <div id="athPlaceholdervalue">
                                </div>
							</div>
                           
                       </div>
           
        </div>



        <div class="grid-table-moon">
            <!-- <div class="grid-table-moon-logo"><?php echo "<img src=/logos/$logoClean style=\"width: 2.4rem;height: 2.4rem\">"; ?></div> -->
            <div class="grid-table-moon-logo"><?php echo "<img src=$logoClean style=\"width: 2.4rem;height: 2.4rem\">"; ?></div>
            <div class="grid-table-moon-name">
            <?php 
                    echo $name;
            ?>
                <div class="grid-table-moon-symbol"><?php echo $symbol; ?></div>

            </div>
            <!-- ENKEL INDIEN EXCHANGE-->
            <div class="grid-table-moon-exchange">
                    <div class="exlogo"><img src="/cpclogos/binance.png" alt="binance logo" style="width: 1.6rem;height: 1.6rem;margin-bottom:0.5rem;"></div>
                    <div class="exname"><span style="margin-bottom: 0.5rem;padding-left: 0.3rem;" >Binance</span></div>
            </div>
            <div class="grid-table-moon-price" id="trades_placeholderBitPrice" ><?php echo $BitPrice; ?> <div class="grid-table-moon-symbol">USDT</div></div>
            <div class="grid-table-moon-priceinbtc" id="trades_placeholderT2" >
                    <?php $queryprice = "select TRIM(price)+0 price from binanceRTCbtc where url_symbol = 'BTC" . $symbol2upper . "' "; 
                    $recjson = mysqli_query($conn, $queryprice);
                    while ($resultprice = mysqli_fetch_assoc($recjson)) {
                    $btcsymbol2 = $resultprice['price'];
                    echo(number_format($BitPrice/$btcsymbol2, 8) . " BTC");
} ?>
                           </div>
            <div class="dividermoon"></div>
<!--            <?php 
                if ($uni == 1) {
                    echo "<div class=\"grid-table-moon-exchange-uni\">";
                    echo "<div class=\"exlogo\"><img src=\"/logos/uniswapuni.png\" alt=\"uniswap logo\" style=\"width: 1.6rem;height: 1.6rem;margin-bottom:0.5rem;\"></div>";
                    echo "<div class=\"exname\"><span style=\"margin-bottom: 0.5rem;padding-left: 0.3rem;\" >Uniswap</span></div>";
                    echo "</div>";
                    echo "<div class=\"grid-table-moon-price-uni\" id=\"headerright_placeholder\" >loading <div class=\"grid-table-moon-symbol\">USDT</div></div>";
                }
            ?>
-->
<!--             <div class="grid-table-moon-exchange-uni">
                    <div class="exlogo"><img src="/logos/uniswapuni.png" alt="uniswap logo" style="width: 1.6rem;height: 1.6rem;margin-bottom:0.5rem;"></div>
                    <div class="exname"><span style="margin-bottom: 0.5rem;padding-left: 0.3rem;" >Uniswap</span></div>
            </div>
            <div class="grid-table-moon-price-uni" id="headerright_placeholder" >loading <div class="grid-table-moon-symbol">USDT</div></div> -->
            <div class="grid-table-moon-priceinbtc-uni" id="trades_placeholderT1" >
                    <?php $queryprice = "select TRIM(price)+0 price from binanceRTCeth where url_symbol = 'ETH" . $symbol2upper . "' "; 
                           $recjson = mysqli_query($conn, $queryprice);
                           while ($resultprice = mysqli_fetch_assoc($recjson)) {
                               $ethsymbol2 = $resultprice['price'];
                               echo(number_format($BitPrice/$ethsymbol2, 8) . " ETH");

} ?>
                           </div>
            <div class="dividermoon-uni"></div>

            <div class="grid-table-moon-cap">
                <div class="nnn1420o1"><span style="opacity:0.5">Volume&nbsp; </span> <img src="/cpclogos/binance.png" alt="binance logo" style="width: 1.6rem;height: 1.6rem"></div>
                <div class="nnn1420o1"><span style="opacity:0.5">Volume&nbsp; </span> <img src="/cpclogos/coingeckosmall.png" alt="coingecko logo" style="width: 1.6rem;height: 1.6rem"></div>

                <div class="nnb1822o1" id="vol24aaplaceholder">
                <?php if ($vol24 < 1000000 )
                            {
                                echo round($vol24/1000,2); echo "k";
                            }
                            else if ($vol24 > 1000000 && $vol24 < 1000000000)
                            {
                                echo round($vol24/1000/1000,3); echo "M";
                            }
                            else if ($vol24 > 1000000000)
                            {
                                echo round($vol24/1000/1000/1000,4); echo "B";
                            }
                            else
                            {
                                echo $vol24;
                            }
                             ?></div>
                <div class="nnb1822o1">
                <?php if ($total_volume < 1000000 )
                            {
                                echo round($total_volume/1000,2); echo "k";
                            }
                            else if ($total_volume > 1000000 && $total_volume < 1000000000)
                            {
                                echo round($total_volume/1000/1000,3); echo "M";
                            }
                            else if ($total_volume > 1000000000)
                            {
                                echo round($total_volume/1000/1000/1000,4); echo "B";
                            }
                            else
                            {
                                echo $total_volume;
                            }
                             ?></div>

                <div class="nnn1420o05">Market Cap</div>
                <div class="nnn1420o05">Fully Diluted MCap</div>
                <div class="nnb1822o1" id="Mcapplaceholder"><?php echo $mcap ?></div>
                <div class="nnb1822o1" id="FullyDilutedMcapplaceholder"><?php echo $fullydilutedmcap ?></div>
            </div>
            <div class="grid-table-moon-ath">
                <div class="nnn1420o05">All Time High</div>
                <div class="nnn1420o05">All Time Low</div>
                <div class="nnb1822o1"><?php echo $ath; echo str_repeat('&nbsp;', 1); ?><img src="/cpclogos/coingeckosmall.png" alt="coingecko logo" style="width: 1.6rem;height: 1.6rem"><div class="nnn1014o05"><?php echo str_repeat('&nbsp;', 1); echo $ath_date ?></div></div>
                <div class="nnb1822o1"><?php echo $atl; echo str_repeat('&nbsp;', 3); ?><div class="nnn1014o05"><?php echo $atl_date ?></div> </div>
            </div>
            <div class="dividermoon2"></div>
            <div class="grid-table-moon-calc">
                <div class="nnb1822o1">Moon Calculator</div>
                <div class="nnn1420o1">if I invested</div>
                <div class="grid-moon-calc">
                    <div class="grid-moon-calc-dollar"><div class="nnn2433o05">$</div></div>
                    <div class="grid-moon-calc-right"><input type="text" name="moondollar" id="moondollar" value="200" onkeyup="moonCalculator()"></div>
                </div>
                <div class="nnn1420o1">in <?php echo $name; ?></div>
                <div class="grid-moon-calc">
                    <div class="grid-moon-calc-days">Days</div>
                    <div class="grid-moon-calc-right"><input type="text" name="moondays" id="moondays" value="100" onkeyup="moonCalculator()" ></div>
                </div>
                <div class="nnn1420o1" id="moongains"></div>
                <div class="nnb2433o1fs" id="moongainsdollar"></div>
            </div>
            <div class="dividermoon3"></div>
            <div class="grid-table-moon-convert">
                <div class="nnb1822o1">Convert</div>
                <div></div>
                <div></div>
                <div class="grid-moon-calc">
                    <div class="grid-moon-calc-days"><div class="nnn1622o05"><?php echo $symbol1upper ?></div></div>
                    <div class="grid-moon-calc-right"><input type="textconvert" name="moonconvertersymbol1" id="moonconvertersymbol1" onkeyup="moonConvertersymbol1()"></div>
                </div>
                <div><div class="nnn1622o05"><span style="padding-top:1rem;padding-left:0.55rem;">&#8644;</span></div></div>
                <div class="grid-moon-calc">
                    <div class="grid-moon-calc-days"><div class="nnn1622o05">USD</div></div>
                    <div class="grid-moon-calc-right"><input type="textconvert" name="moonconvertersymbol2" id="moonconvertersymbol2" value="1" onkeyup="moonConvertersymbol2()"></div>
                </div>
            </div>
        </div>
        <div class="grid-table-chart" id="pricechart" >
            <div class="grid-chart-tradingview-name "><h2>
                <?php if ( strlen($name) > 10 ) {

                echo $name; echo "&nbsp;"; echo "Price Chart";
                }
                else
                {
                echo $name; echo "&nbsp;"; echo "Price Chart";

                }
                ?> 
                </h2>
            </div>
            <div class="grid-table-chart-timef">
                            <div class="timeframe active-link" onclick="updateData('1d')"><p id="1d">24h</p></div>
                            <div class="timeframe" onclick="updateData('7d')"><p id="7d">7d</p></div>
                            <div class="timeframe" onclick="updateData('14d')"><p id="14d">14d</p></div>
                            <div class="timeframe" onclick="updateData('30d')"><p id="30d">30d</p></div>
                            <div class="timeframe" onclick="updateData('180d')"><p id="180d">180d</p></div>
                            <div class="timeframe" onclick="updateData('1y')"><p id="1y">1y</p></div>
                            <div class="timeframe" onclick="updateData('2y')"><p id="2y">2y</p></div>
                            <div class="timeframe" onclick="updateData('all')"><p id="all">All</p></div>
            </div>

            <div id="tradingchart" >
                      <script type="text/javascript">
                       var targetTheme = localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
                       if (targetTheme == 'light')
                        {
                            backgroundColor = '#FFFFFF';
                            backgrounContrastColor = '#F4F4F4';
                            textColor = '#1F242F';

                        }
                        else
                        {
                            backgroundColor = '#1F3053';
                            backgrounContrastColor = '#263A65';
                            textColor = '#FFFFFF';
                        }
                        var chart = LightweightCharts.createChart(document.getElementById("tradingchart"), {
                            rightPriceScale: {
                                visible: true,
                            borderColor: 'rgba(197, 203, 206, 1)',
                            },
                            leftPriceScale: {
                                visible: false,
                            borderColor: 'rgba(197, 203, 206, 1)',
                            },
                            overlay: true,
                            layout: {
                                backgroundColor: backgroundColor,
                                textColor: textColor,
                            },
                            priceFormat: {
                                    type: 'custom',
                                    formatter: (price) => parseFloat(price).toFixed(4)
                                },
                            grid: {
                                horzLines: {
                                color: backgrounContrastColor ,
                                },
                                vertLines: {
                                color: backgrounContrastColor ,
                                },
                            },
                            crosshair: {
                                mode: LightweightCharts.CrosshairMode.Normal,
                            },
                            timeScale: {
                                borderColor: 'rgba(197, 203, 206, 1)',
                                timeVisible: true,
                                secondsVisible: true,
                            },
                            handleScroll: {
                                vertTouchDrag: false,
                            },
                        });




 const candlestickSeries = chart.addCandlestickSeries({
  priceFormat: {type: 'custom', formatter: price => parseFloat(price).toFixed(maxCoinLength)},
});




                        </script> 
            </div> 
        </div>
         <div class="grid-table-chart2">
             <div id="tradingchart2">
               <script>
                    var targetTheme = localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
                        if (targetTheme == 'light')
                            {
                                backgroundColor = '#FFFFFF';
                                backgrounContrastColor = '#F4F4F4';
                                textColor = '#1F242F';

                            }
                            else
                            {
                                backgroundColor = '#1F3053';
                                backgrounContrastColor = '#263A65';
                                textColor = '#FFFFFF';
                            }
                        var chart2 = LightweightCharts.createChart(document.getElementById("tradingchart2"), {
                        rightPriceScale: {
                            visible: true,
                        borderColor: 'rgba(197, 203, 206, 1)',
                        },
                        leftPriceScale: {
                            visible: false,
                        borderColor: 'rgba(197, 203, 206, 1)',
                        },
                        overlay: true,
                        layout: {
                            backgroundColor: backgroundColor,
                            textColor: textColor,
                        },
                        priceFormat: {
                                type: 'custom',
                                formatter: (price) => parseFloat(price).toFixed(4)
                            },
                        grid: {
                            horzLines: {
                            color: backgrounContrastColor ,
                            },
                            vertLines: {
                            color: backgrounContrastColor ,
                            },
                        },
                        crosshair: {
                            mode: LightweightCharts.CrosshairMode.Normal,
                        },
                        timeScale: {
                            borderColor: 'rgba(197, 203, 206, 1)',
                            timeVisible: true,
                            secondsVisible: true,
                        },
                        handleScroll: {
                            vertTouchDrag: false,
                        },
                    });

                    const areaSeries = chart2.addAreaSeries({
	topColor: 'rgba(38,198,218, 0.56)',
	bottomColor: 'rgba(38,198,218, 0.04)',
	lineColor: 'rgba(38,198,218, 1)',
	lineWidth: 2,
    priceFormat: {type: 'custom', formatter: price => parseFloat(price).toFixed(maxCoinLength)},
});


const volumeHistogram = chart2.addHistogramSeries({
  // priceFormat: {type: 'custom', formatter: price => parseFloat(price).toFixed(0)},
  priceFormat : {type: 'volume'},
  priceScaleId: '',
  scaleMargins: {top: 0.9, bottom: 0},
});

            </script>
                </div>
    </div>
</div>
              <!--   		<div class="grid-br2"> -->
<?php 
			    $counterath = 0;
			    $incrPercentage = rand(1,10);
			    $noofTillAth = $BitPrice;	
			    while ( $noofTillAth < $ath ) 
			    {   
				    
			    	$noofTillAth = $BitPrice*pow((1 + ($incrPercentage/100)), 1*$counterath);
				if ( $noofTillAth > $ath )
				{
					//echo $BitPrice*pow((1 + ($incrPercentage/100)), 1*($counterath));
					//echo " "; echo $counterath;
					break;
				}
				$counterath = $counterath + 1;
			    
                }
           //     echo "<p class=\"grid-exchange1\"><span>Due to the recurring cost of the hosted server, this website will no longer keep track of most coins -- mail : root@cryptoprediction.io</p></span>";

			    // echo "<span>To reach a new All Time High, <p class=\"grid-bold\">$name</p> needs to rise <p class=\"grid-bold\">$incrPercentage</p>% daily for the next <p class=\"grid-bold\">$counterath</p> days</span>";
?>
<!-- </div>  -->  
    <div class="grid-table-right">
            <div class="grid-title">Gainers
            </div>
            <div class="divider">
            </div> 
            <div class="grid-table-header-small">
                <div class="grid-smpos">#
                </div>
                <div class="grid-smsymbol">Symbol
                </div>
                <div class="grid-smchange">24h %Change
                </div>
            </div>
            <div class="divider">
            </div>  
            <ul class="listlosers">
            <?php
                        $query = "SELECT market_cap_rank, logo, symbol,
                        round(price_change_percentage_24h_in_currency,2) price_change_percentage_24h_in_currency, contentUrl, contentExchange, contentValutaLeft, contentValutaRight, coin
                        from pageCoinsMainPage where market_cap_rank < 200 order by  price_change_percentage_24h_in_currency desc LIMIT 10";
                        $rec = mysqli_query($conn, $query);
                            while ($result = mysqli_fetch_assoc($rec)){
                                include '/home/blobber/mainpage/mainpageTableContentvsmall.php';
                            }
                        ?>
            </ul>
            <div class="divider">
            </div> 
            <div class="grid-title">Small Caps
            </div>
            <div class="divider">
            </div> 
            <div class="grid-table-header-small">
                <div class="grid-smpos">#
                </div>
                <div class="grid-smsymbol">Symbol
                </div>
                <div class="grid-smchange">24h %Change
                </div>
            </div>
            <div class="divider">
            </div>  
            <ul class="listsmallcapslosers">
            <?php
                        $query = "SELECT market_cap_rank, logo, symbol,
                        round(price_change_percentage_24h_in_currency,2) price_change_percentage_24h_in_currency, contentUrl, contentExchange, contentValutaLeft, contentValutaRight, coin
                        from pageCoinsMainPage where market_cap_rank > 200 order by  price_change_percentage_24h_in_currency desc LIMIT 5";
                        $rec = mysqli_query($conn, $query);
                            while ($result = mysqli_fetch_assoc($rec)){
                                include '/home/blobber/mainpage/mainpageTableContentvsmall.php';
                            }
                        ?>
            </ul>
    </div>
    <div class="grid-table-realtime">
            <div class="grid-table-realtime-name"><h2>
                <?php if ( strlen($name) > 10 ) {

                echo $name; echo "&nbsp;"; echo "Real-Time Ticker";
                }
                else
                {
                echo $name; echo "&nbsp;"; echo "Real-Time Ticker";

                }
                ?> 
                </h2>
            </div>
            <?php 
            echo "<div class=\"grid-table-stats-pairs\">";
                       $memtest = new Memcached();
                       $memtest->addServer("127.0.0.1", 11211);
                       $TTL = 300;
                       $query = "select  concat(symbol1,'/',symbol2) pairsinfo, upper(symbol2) as symbol2,  concat(ppi.id1, 'ticker') coin, lower(ppi.exchange) exchange from pagePairsInfos ppi where exchange='Binance' and id1 = 'ethereum' and symbol2 = '$symbol2'";
                       $setKey = "KEY" . md5($query);
                       $getCacheDetail = $memtest->get($setKey);
                       if ($getCacheDetail) {
                           $assocpairsinfos = $getCacheDetail;
                           foreach ($assocpairsinfos as $result) {
                            echo "<div class=\"grid-table-stats-pairs-childs-first\">";
                               echo "<a href=\"https://" . $_SERVER['SERVER_NAME'] . "/{$result['exchange']}/{$result['pairsinfo']}/{$result['coin']}\">";
       
                               echo $name; echo ' ticker in '; echo  $result['symbol2'];
       
                               echo "</a>";
                            echo "</div>";
                               //$url_sym = $result['url_symbol'];
                           }
                       } else {
                           $rec = mysqli_query($conn, $query);
                           while ($result = mysqli_fetch_assoc($rec)) {
                               $assocpairsinfos[] = $result; // Results storing in array
                               $memtest->set($setKey, $assocpairsinfos, $TTL);
                               echo "<div class=\"grid-table-stats-pairs-childs-first\">";
                               echo "<a href=\"https://" . $_SERVER['SERVER_NAME'] . "/{$result['exchange']}/{$result['pairsinfo']}/{$result['coin']}\">";
       
                               echo $name; echo ' ticker in '; echo  $result['symbol2'];
       
                               echo "</a>";
                               echo "</div>";
                               //$url_sym = $result['url_symbol'];
                           }
                       }

                       $memtest = new Memcached();
                       $memtest->addServer("127.0.0.1", 11211);
                       $TTL = 300;
                       $query = "select  concat(symbol1,'/',symbol2) pairsinfo, upper(symbol2) as symbol2,  concat(ppi.id1, 'ticker') coin, lower(ppi.exchange) exchange from pagePairsInfos ppi where exchange='Binance' and id1 = 'ethereum' and symbol2 != '$symbol2'";
                       $setKey = "KEY" . md5($query);
                       $getCacheDetail2 = $memtest->get($setKey);
                       if ($getCacheDetail2) {
                           $assocpairsinfos2 = $getCacheDetail2;
                           foreach ($assocpairsinfos2 as $result2) {
                            echo "<div class=\"grid-table-stats-pairs-childs-first\">";
                               echo "<a href=\"https://" . $_SERVER['SERVER_NAME'] . "/{$result2['exchange']}/{$result2['pairsinfo']}/{$result2['coin']}\">";
       
                               echo $name; echo ' ticker in '; echo  $result2['symbol2'];
       
                               echo "</a>";
                            echo "</div>";
                               //$url_sym = $result['url_symbol'];
                           }
                       } else {
                           $rec2 = mysqli_query($conn, $query);
                           while ($result2 = mysqli_fetch_assoc($rec2)) {
                               $assocpairsinfos2[] = $result2; // Results storing in array
                               $memtest->set($setKey, $assocpairsinfos2, $TTL);
                               echo "<div class=\"grid-table-stats-pairs-childs-first\">";
                               echo "<a href=\"https://" . $_SERVER['SERVER_NAME'] . "/{$result2['exchange']}/{$result2['pairsinfo']}/{$result2['coin']}\">";
       
                               echo $name; echo ' ticker in '; echo  $result2['symbol2'];
       
                               echo "</a>";
                               echo "</div>";
                               //$url_sym = $result['url_symbol'];
                           }
                       }
            echo "</div>";
            
                       ?>
    </div>
    <div class="grid-table-realtime2">
        <div class="grid-table-realtime-name"><h2>
                <?php if ( strlen($name) > 10 ) {

                echo $name; echo "&nbsp;"; echo "Real-Time Price Changes %";
                }
                else
                {
                echo $name; echo "&nbsp;"; echo "Real-Time Price Changes %";

                }
                ?> 
                </h2>
         </div>
        <div class="grid-ohlc">
                    <div class="htime">
                    <div class="nnn1420o05">
                    <div id="htimeplaceholder">
                    Real-Time
                    </div>       
                    </div>
                    </div>
    
                    <div class="hperc">
                    <div class="nnn1420o05">
                    % change
                    </div>
                    </div>
    
                    <div class="hhigh">
                    <div class="nnn1420o05">
                    high
                    </div>
                    </div>
    
                    <div class="hlow">
                    <div class="nnn1420o05">
                    low
                    </div>
                    </div>
    
                    <div class="hhilow">
                    <div class="nnn1420o05">
                    high-low <> %
                    </div>
                    </div>
    
                    <div class="hvol">
                    <div class="nnn1420o05">
                    volume
                    </div>
                    </div>
    
                    <div class="htrades">
                    <div class="nnn1420o05">
                    n° trades
                    </div>
                    </div>

    
                    <div class="perc24a nnb1822o1" id="perc24aplaceholder">
                    <?php if ($h24h >= 0)
                    {
                    echo "<span style=\"color:#0FC441\" >";
                    echo "<p>";echo checkInteger($h24h); echo "%"; echo "</p>";  echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    
                    }
                    else {
                    echo "<span style=\"color:#EB2020\" >";
                    echo "<p>";echo checkInteger($h24h); echo "%"; echo "</p>"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    }
                    ?>
                    </div>
                    
                    
                    <div class="perc12 nnb1822o1" id="perc12placeholder">
                    <?php if ($h12h >= 0)
                    {
                    echo "<span style=\"color:#0FC441\" >";
                    echo "<p>";echo checkInteger($h12h); echo "%"; echo "</p>"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    
                    }
                    else {
                    echo "<span style=\"color:#EB2020\" >";
                    echo "<p>";echo checkInteger($h12h); echo "%"; echo "</p>"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    }
                    ?>
                    </div>
    
    
    
                    <div class="perc4 nnb1822o1" id="perc4placeholder">
                    <?php if ($h4h >= 0)
                    {
                    echo "<span style=\"color:#0FC441\" >";
                    echo "<p>";echo checkInteger($h4h); echo "%"; echo "</p>"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    
                    }
                    else {
                    echo "<span style=\"color:#EB2020\" >";
                    echo "<p>";echo checkInteger($h4h); echo "%"; echo "</p>"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    }
                    ?>
                    </div>
    
    
    
                    <div class="perc1 nnb1822o1" id="perc1placeholder">
                    <?php if ($h1h >= 0)
                    {
                    echo "<span style=\"color:#0FC441\" >";
                    echo "<p>";echo checkInteger($h1h); echo "%"; echo "</p>"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    
                    }
                    else {
                    echo "<span style=\"color:#EB2020\" >";
                    echo "<p>"; echo checkInteger($h1h); echo "%"; echo "</p>"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    }
                    ?>
                    </div>
                    
                    
    
                    
                    
                    <div class="perc15 nnb1822o1" id="perc15placeholder">
                    <?php if ($h15m >= 0)
                    {
                    echo "<span style=\"color:#0FC441\" >";
                    echo "<p>";echo checkInteger($h15m); echo "%"; echo "</p>"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    
                    }
                    else {
                    echo "<span style=\"color:#EB2020\" >";
                    echo "<p>";echo checkInteger($h15m); echo "%"; echo "</p>"; echo "</span>";echo "<div class=\"arrowdown\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                    }
                    ?>
                    </div>
                    <?php $query= "select * from ((SELECT  TRIM(max(high))+0 high24, TRIM(min(low))+0 low24, sum(trades) trade24, round(sum(vol)/1000/1000,2) vol24 FROM `binanceklines` WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(24*60*60 + 1*60) <= klstart/1000 ) a,
                    (SELECT TRIM(max(high))+0 high12, TRIM(min(low))+0 low12, sum(trades) trade12, round(sum(vol)/1000/1000,2) vol12 FROM `binanceklines` 
                    WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(12*60*60 + 1*60) <= klstart/1000 ) b,
                    (SELECT TRIM(max(high))+0 high4, TRIM(min(low))+0 low4, sum(trades) trade4, round(sum(vol)/1000/1000,2) vol4 FROM `binanceklines` 
                    WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(4*60*60 + 1*60) <= klstart/1000 ) c,
                    (SELECT TRIM(max(high))+0 high1, TRIM(min(low))+0 low1, sum(trades) trade1, round(sum(vol)/1000/1000,2) vol1 FROM `binanceklines` 
                    WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*60*60 + 1*60) <= klstart/1000) d,
                    (SELECT TRIM(max(high))+0 high15, TRIM(min(low))+0 low15, sum(trades) trade15, round(sum(vol)/1000/1000,2) vol15 FROM `binanceklines` 
                    WHERE url_symbol='$url_sym' and unix_timestamp(DATE_FORMAT(now(),'%Y-%m-%d %H:%i:00'))-(1*15*60 + 1*60) <= klstart/1000) e )";
                    $rec = mysqli_query($conn, $query);
                    while ($result = mysqli_fetch_assoc($rec)) {
    
                        echo "<div class=\"min15\">";
                        echo "<div class=\"nnn1420o05\">";
                        echo "15-min";
                        echo "</div>";
                        echo "</div>"; 
                        
                        
                        echo "<div class=\"high15 nnb1822o1\" id=\"high15placeholder\">";echo $result['high15'];
                        echo "</div>";

    
                        echo "<div class=\"low15 nnb1822o1\" id=\"low15placeholder\">";echo $result['low15'];
                        echo "</div>";
    
                        echo "<div class=\"vol15 nnb1822o1\" id=\"vol15placeholder\">";echo $result['vol15'];echo 'M';
                        echo "</div>";
    
                        echo "<div class=\"hilow15 nnb1822o1\" id=\"hilow15placeholder\">";echo round ( (($result['high15']-$result['low15'] ) / $result['low15'])*100 , 2);echo '%';
                        echo "</div>";
    
                        echo "<div class=\"trades15 nnb1822o1\" id=\"trades15placeholder\">";echo $result['trade15'];
                        echo "</div>";
                        
                        echo "<div class=\"min1\">";
                        echo "<div class=\"nnn1420o05\">";
                        echo "1-hour";
                        echo "</div>";
                        echo "</div>"; 
    
                        echo "<div class=\"high1 nnb1822o1\" id=\"high1placeholder\">";echo $result['high1'];
                        echo "</div>";
    
                        echo "<div class=\"low1 nnb1822o1\" id=\"low1placeholder\">";echo $result['low1'];
                        echo "</div>";
    
                        echo "<div class=\"vol1 nnb1822o1\" id=\"vol1placeholder\">";echo $result['vol1'];echo 'M';
                        echo "</div>";
    
                        echo "<div class=\"hilow1 nnb1822o1\" id=\"hilow1placeholder\">";echo round ( (($result['high1']-$result['low1'] ) / $result['low1'])*100 , 2);echo '%';
                        echo "</div>";
    
                        echo "<div class=\"trades1 nnb1822o1\" id=\"trades1placeholder\">";echo $result['trade1'];
                        echo "</div>";
                        
                        echo "<div class=\"min4\">";
                        echo "<div class=\"nnn1420o05\">";
                        echo "4-hour";
                        echo "</div>";
                        echo "</div>"; 
    
                        echo "<div class=\"high4 nnb1822o1\" id=\"high4placeholder\">";echo $result['high4'];
                        echo "</div>";
    
                        echo "<div class=\"low4 nnb1822o1\" id=\"low4placeholder\">";echo $result['low4'];
                        echo "</div>";
    
                        echo "<div class=\"hilow4 nnb1822o1\" id=\"hilow4placeholder\">";echo round ( (($result['high4']-$result['low4'] ) / $result['low4'])*100 , 2);echo '%';
                        echo "</div>";
    
                        echo "<div class=\"vol4 nnb1822o1\" id=\"vol4placeholder\">";echo $result['vol4'];echo 'M';
                        echo "</div>";
    
                        echo "<div class=\"trades4 nnb1822o1\" id=\"trades4placeholder\">";echo $result['trade4'];
                        echo "</div>";
                        
                        echo "<div class=\"min12\">";
                        echo "<div class=\"nnn1420o05\">";
                        echo "12-hour";
                        echo "</div>";
                        echo "</div>"; 
    
    
                        echo "<div class=\"high12 nnb1822o1\" id=\"high12placeholder\">";echo $result['high12'];
                        echo "</div>";
    
                        echo "<div class=\"low12 nnb1822o1\" id=\"low12placeholder\">";echo $result['low12'];
                        echo "</div>";
    
                        echo "<div class=\"hilow12 nnb1822o1\" id=\"hilow12placeholder\">";echo round ( (($result['high12']-$result['low12'] ) / $result['low12'])*100 , 2);echo '%';
                        echo "</div>";
    
                        echo "<div class=\"vol12 nnb1822o1\" id=\"vol12placeholder\">";echo $result['vol12'];echo 'M';
                        echo "</div>";
    
                        echo "<div class=\"trades12 nnb1822o1\" id=\"trades12placeholder\">";echo $result['trade12'];
                        echo "</div>";
                        
                        echo "<div class=\"min24a\">";
                        echo "<div class=\"nnn1420o05\">";
                        echo "24-hour";
                        echo "</div>";  
                        echo "</div>";                  
    
                        echo "<div class=\"high24a nnb1822o1\" id=\"high24aplaceholder\">";echo $result['high24'];
                        echo "</div>";
    
                        echo "<div class=\"low24a nnb1822o1\" id=\"low24aplaceholder\">";echo $result['low24'];
                        echo "</div>";
    
                        echo "<div class=\"vol24a nnb1822o1\" id=\"vol24aplaceholder\">";echo $result['vol24'];echo 'M';
                        echo "</div>";
    
                        echo "<div class=\"hilow24a nnb1822o1\" id=\"hilow24aplaceholder\">";echo round ( (($result['high24']-$result['low24'] ) / $result['low24'])*100 , 2);echo '%';
                        echo "</div>";
    
                        echo "<div class=\"trades24a nnb1822o1\" id=\"trades24aplaceholder\">";echo $result['trade24'];
                        echo "</div>";


                        echo "</div>";
                        
                        ?>
    </div>
    <div class="grid-table-realtime3">
        <div class="grid-table-realtime-name"><h2>
                        <?php if ( strlen($name) > 10 ) {

                        echo $name; echo "&nbsp;"; echo "Index Chart";
                        }
                        else
                        {
                        echo $name; echo "&nbsp;"; echo "Index Chart";

                        }
                        ?> 
                        </h2>
                </div>
        <?php           echo "<div class=\"grid-chart-header\">";
                        if ($islistedonexchange > 0) {
                            echo "<div class=\"grid-table-chart-timefchart\">";
                                echo "<div class=\"timeframe\" onclick=\"updateData('15m')\">";
                                echo "<p id=\"15m\">15m</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('1h')\">";
                                echo "<p id=\"1h\" >1h</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('4h')\">";
                                echo "<p id=\"4h\" >4h</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('8h')\">";
                                echo "<p id=\"8h\" >8h</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('12h')\">";
                                echo "<p id=\"12h\" >12h</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('1d')\">";
                                echo "<p id=\"1d\" >1d</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('3d')\">";
                                echo "<p id=\"3d\" >3d</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('7d')\">";
                                echo "<p id=\"7d\" >7d</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('14d')\">";
                                echo "<p id=\"14d\" >14d</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('30d')\">";
                                echo "<p id=\"30d\" >30d</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('180d')\">";
                                echo "<p id=\"180d\" >180d</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('1y')\">";
                                echo "<p id=\"1y\" >1y</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('2y')\">";
                                echo "<p id=\"2y\" >2y</p>";
                                echo "</div>";
                                echo "<div class=\"timeframe\" onclick=\"updateData('all')\">";
                                echo "<p id=\"all\" >All</p>";
                                echo "</div>";
                            echo "</div>";
                            
                        }
                    echo "<div class=\"Updatetext\" id=\"updatetext\">";echo "</div>";
                // <!-- <button id="show">TradingView</button>
                // <button id="hide">Original</button> -->
                echo "</div>";
                ?>

                    <?php 

                                    if ($islistedonexchange > 0) {
                                        echo "<div id=\"chart2\" class=\"chart2\" ></div>";
                                    } ?>
    </div>

    <div class="grid-table-realtime4">
        <div class="grid-table-realtime-name"><h2>
                    <?php if ( strlen($name) > 10 ) {

                    echo $name; echo "&nbsp;"; echo "Orderbook Chart";
                    }
                    else
                    {
                    echo $name; echo "&nbsp;"; echo "Orderbook Chart";

                    }
                    ?> 
                    </h2>
        </div>
            <?php 

                if ($islistedonexchange > 0) {
                    echo "<div id=\"chart\" class=\"chart\" ></div>";
                } 
            ?>
    </div>
    <div class="grid-table-realtime5">
        <div class="grid-table-realtime-name"><h2>
                <?php if ( strlen($name) > 10 ) {

                echo $name; echo "&nbsp;"; echo "Trades - Bid/Ask";
                }
                else
                {
                echo $name; echo "&nbsp;"; echo "Trades - Bid/Ask";

                }
                ?> 
                </h2>
        </div>
            <?php 

                if ($islistedonexchange > 0) {
                    echo "<div id=\"chart3\" class=\"chart3\" ></div>";
                }
                    echo "<div class=\"grid-trades\" id=\"trades\" >";      
                            echo "<div class=\"grid-container\">";
    
                                echo "<div class=\"Trades\">";
                                    echo "Trades";
                                echo "</div>";

                                
        
                                echo "<div class=\"Order\">";


                                    echo "<div class=\"BidCurrent\" id=\"bids_currentplaceholderbidprice\" >";
                                    echo "</div>";
        
                                    echo "<div class=\"grid-plusmin\">";
        
                                        echo "<div class=\"Min\">";
                                        echo "<button type=\"button\" class=\"buttontbl\" onclick=\"updateCoinLength('-')\">-</button>";
                                        echo "</div>";
            
                                        echo "<div class=\"Step\" id=\"Step\">";
                                        echo "</div>";
            
                                        echo "<div class=\"Plus\">";
                                        echo "<button type=\"button\" class=\"buttontbl\" onclick=\"updateCoinLength('+')\">+</button>";
                                        echo "</div>";
        
                                    echo "</div>";
        
        
                                    echo "<div class=\"AskCurrent\" id=\"asks_currentplaceholderaskprice\">";
                                    echo "</div>";


                                echo "</div>";

                                
                                echo "<div class=\"grid-container-trades\">";

                                    echo "<div class=\"TSub1\">";
                                    echo "Time";
                                    echo "</div>";
            
                                    echo "<div class=\"TSub2\">";
                                    echo "Amount";
                                    echo "</div>";
            
                                    echo "<div class=\"TSub3\">";
                                    echo "Price";
                                    echo "</div>";
            
                                    echo "<div class=\"TSub4\">";
                                    echo "Value";
                                    echo "</div>";

                                echo "</div>";

                                echo "<div class=\"grid-container-trades2\">";

                                    echo "<div class=\"Time\">";
                                    echo "<div id=\"trades_placeholdertime\">";
            
                                    echo "</div>";
                                    echo "</div>";

                                    echo "<div class=\"Volume\">";
                                    echo "<div id=\"trades_placeholdervol\">";
            
                                    echo "</div>";
                                    echo "</div>";
        
        
                                    echo "<div class=\"Price\">";
                                    echo "<div id=\"trades_placeholderprice\">";
            
                                    echo "</div>";
                                    echo "</div>";
                                    
                                    echo "<div class=\"Value\">";
                                    echo "<div id=\"trades_placeholdervalue\">";
            
                                    echo "</div>";
                                    echo "</div>";

                                echo "</div>";
        

                                echo "<div class=\"grid-container-order\">";


                                    echo "<div class=\"TBidValue\">";
                                    echo "Value";
                                    echo "</div>";
            
                                    echo "<div class=\"TBidAmount\">";
                                    echo "Amount";
                                    echo "</div>";
            
                                    echo "<div class=\"TBidPrice\">";
                                    echo "Bid";
                                    echo "</div>";
            
                                    echo "<div class=\"TAskPrice\">";
                                    echo "Ask";
                                    echo "</div>";
            
                                    echo "<div class=\"TAskAmount\">";
                                    echo "Amount";
                                    echo "</div>";
            
                                    echo "<div class=\"TAskValue\">";
                                    echo "Value";
                                    echo "</div>";
                                echo "</div>";
        
                                echo "<div class=\"grid-container-order2\">";        

        
        
                                    echo "<div class=\"BidValue\" id=\"bids_placeholdervalue\">";
                                    echo "</div>";
            
                                    echo "<div class=\"BidAmount\" id=\"bids_placeholderamount\">";
                                    echo "</div>";
            
                                    echo "<div class=\"BidPrice\" id=\"bids_placeholderbidprice\">";
                                    echo "</div>";
            
            
                                    echo "<div class=\"AskValue\" id=\"asks_placeholdervalue\">";
                                    echo "</div>";
            
                                    echo "<div class=\"AskAmount\" id=\"asks_placeholderamount\">";
                                    echo "</div>";
            
                                    echo "<div class=\"AskPrice\" id=\"asks_placeholderaskprice\">";
                                    echo "</div>";

                                echo "</div>";
                            
                        echo "</div>";   
                        echo "</div>";
                        
                        echo "<div class=\"grid-explain \">";
                        echo "<div id=\"explain_placeholder\">";
                        echo "</div>";
                    echo "</div>"; 
       
                       } 
                       ?>
    </div>
</div>
</body>
<script>
    var toggle = document.getElementById("theme-toggle");

    var storedTheme = localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
    if (storedTheme)
        document.documentElement.setAttribute('data-theme', storedTheme)


    toggle.onclick = function() {
        var currentTheme = document.documentElement.getAttribute("data-theme");
        var targetTheme = "light";

        
        chart.applyOptions({
                layout: {
                    backgroundColor: '#FFFFFF',
                    textColor: '#1F242F',
                },
                grid: {
                    horzLines: {
                    color: '#F4F4F4',
                    },
                    vertLines: {
                    color: '#F4F4F4',
                    },
                },
            });


        chart2.applyOptions({
                layout: {
                    backgroundColor: '#FFFFFF',
                    textColor: '#1F242F',
                },
                grid: {
                    horzLines: {
                    color: '#F4F4F4',
                    },
                    vertLines: {
                    color: '#F4F4F4',
                    },
                },
            });


        if (currentTheme === "light") {
            targetTheme = "dark";
            chart.applyOptions({
                layout: {
                    backgroundColor: '#1F3053',
                    textColor: '#FFFFFF',
                },
                grid: {
                    horzLines: {
                    color: '#263A65',
                    },
                    vertLines: {
                    color: '#263A65',
                    },
                },
            });

            chart2.applyOptions({
                layout: {
                    backgroundColor: '#1F3053',
                    textColor: '#FFFFFF',
                },
                grid: {
                    horzLines: {
                    color: '#263A65',
                    },
                    vertLines: {
                    color: '#263A65',
                    },
                },
            });
        }
        //console.log(targetTheme);

        document.documentElement.setAttribute('data-theme', targetTheme)
        localStorage.setItem('theme', targetTheme);
    };
</script>

<script>

const binanceETHRTC = document.getElementById("binanceETHRTC");

const binanceBTCRTC = document.getElementById("binanceBTCRTC");

const huobiETHRTC = document.getElementById("huobiETHRTC");

const huobiBTCRTC = document.getElementById("huobiBTCRTC");

const bitstampETHRTC = document.getElementById("bitstampETHRTC");

const bitstampBTCRTC = document.getElementById("bitstampBTCRTC");

const ethequivalent = document.getElementById("trades_placeholderT1");
       
const btcequivalent = document.getElementById("trades_placeholderT2");

const bsh24 = document.getElementById("trades_placeholderHigh24");

const bsl24 = document.getElementById("trades_placeholderLow24");

const updatedAt = document.getElementById("htimeplaceholder");

const min15 = document.getElementById("min15placeholder");

const perc15 = document.getElementById("perc15placeholder");

const perc15stats = document.getElementById("perc15placeholderstats");

const high15 = document.getElementById("high15placeholder");

const low15 = document.getElementById("low15placeholder");

const hilow15 = document.getElementById("hilow15placeholder");

const vol15 = document.getElementById("vol15placeholder");

const trades15 = document.getElementById("trades15placeholder");

const min1 = document.getElementById("min1placeholder");

const perc1 = document.getElementById("perc1placeholder");

const perc1stats = document.getElementById("perc1placeholderstats");

const high1 = document.getElementById("high1placeholder");

const low1 = document.getElementById("low1placeholder");

const hilow1 = document.getElementById("hilow1placeholder");

const vol1 = document.getElementById("vol1placeholder");

const trades1 = document.getElementById("trades1placeholder");

const min4 = document.getElementById("min4placeholder");

const perc4 = document.getElementById("perc4placeholder");

const perc4stats = document.getElementById("perc4placeholderstats");

const high4 = document.getElementById("high4placeholder");

const low4 = document.getElementById("low4placeholder");

const hilow4 = document.getElementById("hilow4placeholder");

const vol4 = document.getElementById("vol4placeholder");

const trades4 = document.getElementById("trades4placeholder");

const min12 = document.getElementById("min12placeholder");

const perc12 = document.getElementById("perc12placeholder");

const perc12stats = document.getElementById("perc12placeholderstats");

const high12 = document.getElementById("high12placeholder");

const low12 = document.getElementById("low12placeholder");

const hilow12 = document.getElementById("hilow12placeholder");

const vol12 = document.getElementById("vol12placeholder");

const trades12 = document.getElementById("trades12placeholder");

const min24a = document.getElementById("min24aplaceholder");

const perc24a = document.getElementById("perc24aplaceholder");

const perc24astats = document.getElementById("perc24aplaceholderstats");

const high24a = document.getElementById("high24aplaceholder");

const high24ach = document.getElementById("high24aplaceholderch");

const low24a = document.getElementById("low24aplaceholder");

const low24ach = document.getElementById("low24aplaceholderch");

const hilow24a = document.getElementById("hilow24aplaceholder");

const hilow24ach = document.getElementById("hilow24aplaceholderch");

const vol24a = document.getElementById("vol24aplaceholder");

const vol24aa = document.getElementById("vol24aaplaceholder");

const trades24a = document.getElementById("trades24aplaceholder");

const headerr = document.getElementById("headerright_placeholder");

const athprijs = document.getElementById("athPlaceholderprice");

const athplace = document.getElementById("athPlaceholdervalue");

const mcap = document.getElementById("Mcapplaceholder");

var placeholdertime = document.getElementById('trades_placeholdertime'),
    childtime = null,
    ii = 0;
var placeholdervol = document.getElementById('trades_placeholdervol'),
    childvol = null,
    jj = 0;

var placeholderprice = document.getElementById('trades_placeholderprice'),
    childprice = null,
    kk = 0;

var placeholdervalue = document.getElementById('trades_placeholdervalue'),
    childprice = null,
    ll = 0;

var trades = 0;
var datalast = 0;
phpTradesRaw = [];
wsAllTrades = [];
       $.getJSON("/HistoryTrade20Binance<?php echo $url_sym ?>.php", function(json){
           phpTradesRaw = json;
       
       
       let phpTrades = [
             ...phpTradesRaw.map(trade => {return {price: parseFloat(trade.price), amount: parseFloat(trade.amount), microtimestamp: parseInt(trade.microtimestamp), date: parseInt(trade.microtimestamp), type: "trade"}})
           ]
       
       
       //tijdelijk phpTrades uitschakelen in de dotchart 
       //showTradesinCircles = phpTrades;
       showTradesinCircles = [];

       for (ii = 0; ii < phpTrades.length; ii++) {
       
           if ( datalast <= parseFloat(phpTrades[ii].price).toFixed(maxCoinLength)) {
       
       if (ii === 0) {
       placeholdertime.innerHTML = '';
       placeholdervol.innerHTML = '';
       placeholderprice.innerHTML = '';
       placeholdervalue.innerHTML = '';
       }
       childtime = document.createElement('div');
       childtime.setAttribute("id","childtime" + ii);
       childvol = document.createElement('div');
       childvol.setAttribute("id","childvol" + jj);
       childprice = document.createElement('div');
       childprice.setAttribute("id","childprice" + kk);
       childvalue = document.createElement('div');
       childvalue.setAttribute("id","childvalue" + ll);
       
       
       childtime.className = "rowgreen";
       childvol.className = "rowgreen";
       childprice.className = "rowgreen";
       childvalue.className = "rowgreengrey";
       
       
       childtime.innerHTML = new Date(parseInt(phpTrades[ii].microtimestamp)).toLocaleTimeString('en-US', {
          hour12: false,
          hour: 'numeric',
          minute: 'numeric',
          second: 'numeric'
       });
       
       if ( maxCoinInteger == '1' )
              {    
               childvol.innerHTML = parseFloat(phpTrades[ii].amount).toFixed(0);
              }
              else 
              {
               childvol.innerHTML = parseFloat(phpTrades[ii].amount).toFixed(4);
              }
              
       
       
       /*if (parseFloat(phpTrades[ii].price) < 10)
       {
       childprice.innerHTML = parseFloat(phpTrades[ii].price).toFixed(maxCoinLength);
       } 
       else 
       { */
           childprice.innerHTML = parseFloat(phpTrades[ii].price).toFixed(maxCoinLength);
       /* } */
       
       if ( (phpTrades[ii].price*phpTrades[ii].amount).toFixed(0) < 1)
              {    
                   childvalue.innerHTML = '< $' + '1';
              }
              else 
              {
                   childvalue.innerHTML = '$' +(parseFloat(phpTrades[ii].price)*parseFloat(phpTrades[ii].amount)).toFixed(0);
              }
       
       datalast = parseFloat(phpTrades[ii].price);
       
       placeholdertime.insertBefore(childtime, placeholdertime.childNodes[0]);
       placeholdervol.insertBefore(childvol, placeholdervol.childNodes[0]);
       placeholderprice.insertBefore(childprice, placeholderprice.childNodes[0]);
       placeholdervalue.insertBefore(childvalue, placeholdervalue.childNodes[0]);
       
       
       }
       
       if ( datalast  > parseFloat(phpTrades[ii].price) ) {
       
       if (ii === 0) {
       placeholdertime.innerHTML = '';
       placeholdervol.innerHTML = '';
       placeholderprice.innerHTML = '';
       placeholdervalue.innerHTML = '';
       }
       childtime = document.createElement('div');
       childtime.setAttribute("id","childtime" + ii);
       childvol = document.createElement('div');
       childvol.setAttribute("id","childvol" + jj);
       childprice = document.createElement('div');
       childprice.setAttribute("id","childprice" + kk);
       childvalue = document.createElement('div');
       childvalue.setAttribute("id","childvalue" + ll);
       
       childtime.className = "rowred";
       childvol.className = "rowred";
       childprice.className = "rowred";
       childvalue.className = "rowredgrey";
       
       
       childtime.innerHTML = new Date(parseInt(phpTrades[ii].microtimestamp)).toLocaleTimeString('en-US', {
          hour12: false,
          hour: 'numeric',
          minute: 'numeric',
          second: 'numeric'
       });
       
       if ( maxCoinInteger == '1' )
              {    
               childvol.innerHTML = parseFloat(phpTrades[ii].amount).toFixed(0);
              }
              else 
              {
               childvol.innerHTML = parseFloat(phpTrades[ii].amount).toFixed(4);
              }
       
       /*if (parseFloat(phpTrades[ii].price) < 10)
       {
       childprice.innerHTML = parseFloat(phpTrades[ii].price).toFixed(maxCoinLength);
       }
       else 
       { */
           childprice.innerHTML = parseFloat(phpTrades[ii].price).toFixed(maxCoinLength);
       /* } */
       
       if ( (phpTrades[ii].price*phpTrades[ii].amount).toFixed(0) < 1)
              {    
                   childvalue.innerHTML = '< $' + '1';
              }
              else 
              {
                   childvalue.innerHTML = '$' +(parseFloat(phpTrades[ii].price)*parseFloat(phpTrades[ii].amount)).toFixed(0);
              }
       
       datalast = parseFloat(phpTrades[ii].price);
       
       placeholdertime.insertBefore(childtime, placeholdertime.childNodes[0]);
       placeholdervol.insertBefore(childvol, placeholdervol.childNodes[0]);
       placeholderprice.insertBefore(childprice, placeholderprice.childNodes[0]);
       placeholdervalue.insertBefore(childvalue, placeholdervalue.childNodes[0]); 
       
       }
       //ii++;
       jj++;
       kk++;
       ll++;
       trades++;
       
       }
       
              });

var conn = new ab.Session('wss://ws.cryptoprediction.io',
   function() {
    var binancebtcloop = Date.now();
    var binanceethloop = Date.now();
    var huobibtcloop = Date.now();
    var huobiethloop = Date.now();
    var bitstampbtcloop = Date.now();
    var bitstampethloop = Date.now();

        conn.subscribe('binanceethusdt', function(topic, data) {
            const binancemilliseth  = Date.now() - binanceethloop;
            if ( binancemilliseth > 500 )
            {
            binanceETHRTC.innerHTML = '$' + parseFloat(data.price).toFixed(2);
            binanceethloop = Date.now();
            } 
                   }); 
        conn.subscribe('binancebtcusdt', function(topic, data) {
            const binancemillisbtc  = Date.now() - binancebtcloop;
            if ( binancemillisbtc > 500 )
            {
            binanceBTCRTC.innerHTML = '$' + parseFloat(data.price).toFixed(2);
            binancebtcloop = Date.now();
            } 
                   });

        conn.subscribe('huobiethusdt', function(topic, data) {
            const huobimilliseth  = Date.now() - huobiethloop;
            if ( huobimilliseth > 500 )
            {
            huobiETHRTC.innerHTML = '$' + parseFloat(data.price).toFixed(2);
            huobiethloop = Date.now();
            } 
                   }); 
        conn.subscribe('huobibtcusdt', function(topic, data) {
            const huobimillisbtc  = Date.now() - huobibtcloop;
            if ( huobimillisbtc > 500 )
            {
            huobiBTCRTC.innerHTML = '$' + parseFloat(data.price).toFixed(2);
            huobibtcloop = Date.now();
            } 
                   }); 
        conn.subscribe('bitstampethusd', function(topic, data) {
            const bitstampmilliseth  = Date.now() - bitstampethloop;
            if ( bitstampmilliseth > 500 )
            {
            bitstampETHRTC.innerHTML = '$' + parseFloat(data.price).toFixed(2);
            bitstampethloop = Date.now();
            } 
                   }); 
        conn.subscribe('bitstampbtcusd', function(topic, data) {
            const bitstampmillisbtc  = Date.now() - bitstampbtcloop;
            if ( bitstampmillisbtc > 500 )
            {
            bitstampBTCRTC.innerHTML = '$' + parseFloat(data.price).toFixed(2);
            bitstampbtcloop = Date.now();
            } 
                   }); 
              conn.subscribe('binanceh24<?php echo $url_symupper ?>', function(topic, data) {
                 bsh24.innerHTML = '24h-High : ' + addZeroes(data.high24.toString()); 
              });
              conn.subscribe('binancel24<?php echo $url_symupper ?>', function(topic, data) {
                  bsl24.innerHTML = '24h-Low : ' + addZeroes(data.low24.toString());  
              });
              conn.subscribe('binpercdiff<?php echo $url_sym ?>', function(topic, data) {
       
                        updatedAt.innerHTML = new Date(data.updatedAt*1000).toLocaleTimeString('en-US', {
                       hour12: false,
                       hour: 'numeric',
                       minute: 'numeric',
                       second: 'numeric'
                   });
                       //console.log(data);
                        if (parseFloat(data.diff24h) >= 0 && parseFloat(data.diff24h) != 999999999)
                           {
                        //    echo "<span style=\"color:#0FC441\" >";
                      // echo abs($h1h); echo "%"; echo "</span>";echo "<div class=\"arrowup\">"; echo "<p>";echo "&#9660;"; echo "</p>"; echo "</div>";
                           perc24a.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff24h))  + '%</p></p></span><div class="arrowup"><p>&#9660;</p></div>';
                           perc24astats.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff24h))  + '%</p></span><div class="arrowup"><p>&#9660;</p></div>';
                           }
                           if (parseFloat(data.diff24h) < 0 && parseFloat(data.diff24h) != 999999999)
                           {
                           perc24a.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff24h))  + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           perc24astats.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff24h))  + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           }
       
                        if (parseFloat(data.diff12h) >= 0 && parseFloat(data.diff12h) != 999999999)
                           {
                               perc12.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff12h))  + '%</p></span><div class="arrowup"><p>&#9660;</p></div>';
                               perc12stats.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff12h))  + '%</p></span><div class="arrowup"><p>&#9660;</p></div>';
                           }
                           if (parseFloat(data.diff12h) < 0 && parseFloat(data.diff12h) != 999999999)
                           {
                           perc12.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff12h))  + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           perc12stats.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff12h))  + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           }
                       if (parseFloat(data.diff4h) >= 0 && parseFloat(data.diff4h) != 999999999)
                           {
                               perc4.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff4h)) + '%</p></span><div class="arrowup"><p>&#9660;</p></div>';
                               perc4stats.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff4h)) + '%</p></span><div class="arrowup"><p>&#9660;</p></div>';
                           }
                           if (parseFloat(data.diff4h) < 0 && parseFloat(data.diff4h) != 999999999)
                           {
                           perc4.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff4h)) + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           perc4stats.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff4h)) + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           }
                       if (parseFloat(data.diff1h) >= 0 && parseFloat(data.diff1h) != 999999999)
                           {
                           perc1.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff1h))  + '%</p></span><div class="arrowup"><p>&#9660;</p></div>';
                           perc1stats.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff1h))  + '%</p></span><div class="arrowup"><p>&#9660;</p></div>';
                           }
                           if (parseFloat(data.diff1h) < 0 && parseFloat(data.diff1h) != 999999999)
                           {
                           perc1.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff1h))  + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           perc1stats.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff1h))  + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           }
                       if (parseFloat(data.diff15min) >= 0 && parseFloat(data.diff15min) != 999999999)
                           {
                           perc15.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff15min))  + '%</p></span><div class="arrowup"><p>&#9660;</p></div>';
                           perc15stats.innerHTML = '<span  style="color:#0FC441"><p>' + Math.abs(parseFloat(data.diff15min))  + '%</p></span><div class="arrowup"><p>&#9660;</p></div>';
                           }
                       if (parseFloat(data.diff15min) < 0 && parseFloat(data.diff15min) != 999999999)
                           {
                           perc15.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff15min))  + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           perc15stats.innerHTML = '<span  style="color:#EB2020"><p>' + Math.abs(parseFloat(data.diff15min))  + '%</p></span><div class="arrowdown"><p>&#9650;</p></div>';
                           }
                   // bsh24.innerHTML = '24h-High : ' + addZeroes(data.high24.toString()); 
              });
              conn.subscribe('binohlcperc<?php echo $url_sym ?>', function(topic, data) {
       
                  //console.log(data); {url_symbol: "binohlcpercvetusdt", diff: "24h", high: "0.03244500", low: "0.02839400", trade: 107657, …}
                  //bsl24.innerHTML = '24h-Low : ' + addZeroes(data.low24.toString());             
                  switch (data.diff) {
                       case '24h': {
                           high24a.innerHTML = parseFloat(data.high).toFixed(maxCoinLength);
                           high24ach.innerHTML = parseFloat(data.high);
                           low24a.innerHTML = parseFloat(data.low).toFixed(maxCoinLength);
                           low24ach.innerHTML = parseFloat(data.low);
                           hilow24a.innerHTML = parseFloat(((data.high-data.low)/data.low)*100).toFixed(2) + '%';
                           hilow24ach.innerHTML = parseFloat(((data.high-data.low)/data.low)*100).toFixed(2) + '%';
                           vol24a.innerHTML = data.vol + 'M';
                           vol24aa.innerHTML = data.vol + 'M';
                           trades24a.innerHTML = data.trade;
                           break;
                       }
                       case '12h': {
                           high12.innerHTML = parseFloat(data.high).toFixed(maxCoinLength);
                           low12.innerHTML = parseFloat(data.low).toFixed(maxCoinLength);
                           hilow12.innerHTML = parseFloat(((data.high-data.low)/data.low)*100).toFixed(2) + '%';
                           vol12.innerHTML = data.vol + 'M';
                           trades12.innerHTML = data.trade;
                           break;
                       }
                       case '4h': {
                           high4.innerHTML = parseFloat(data.high).toFixed(maxCoinLength);
                           low4.innerHTML = parseFloat(data.low).toFixed(maxCoinLength);
                           hilow4.innerHTML = parseFloat(((data.high-data.low)/data.low)*100).toFixed(2) + '%';
                           vol4.innerHTML = data.vol + 'M';
                           trades4.innerHTML = data.trade;
                           break;
                       }
                       case '1h': {
                           high1.innerHTML = parseFloat(data.high).toFixed(maxCoinLength);
                           low1.innerHTML = parseFloat(data.low).toFixed(maxCoinLength);
                           hilow1.innerHTML = parseFloat(((data.high-data.low)/data.low)*100).toFixed(2) + '%';
                           vol1.innerHTML = data.vol + 'M';
                           trades1.innerHTML = data.trade;
                           break;
                       }
                       case '15min': {
                           high15.innerHTML = parseFloat(data.high).toFixed(maxCoinLength);
                           low15.innerHTML = parseFloat(data.low).toFixed(maxCoinLength);
                           hilow15.innerHTML = parseFloat(((data.high-data.low)/data.low)*100).toFixed(2) + '%';
                           vol15.innerHTML = data.vol + 'M';
                           trades15.innerHTML = data.trade;
                           break;
                       }
                  }
       
              });
              conn.subscribe('binance<?php echo $url_sym ?>', function(topic, data) {
              });
              if ( '<?php echo $symbol1 ?>' != 'eth' )
                  {
                      conn.subscribe('binanceeth<?php echo $symbol2 ?>', function(topic, data) {
                   ethequivalent.innerHTML = (parseFloat(latestprice)/parseFloat(data.price)).toFixed(8) + ' ETH';
                                      }); 
                                   }
               if ( '<?php echo $symbol1 ?>' != 'btc' )
                  {
                      conn.subscribe('binancebtc<?php echo $symbol2 ?>', function(topic, data) {
                   btcequivalent.innerHTML = (parseFloat(latestprice)/parseFloat(data.price)).toFixed(8) + ' BTC';
                          }); 
                       }
              /*conn.subscribe('binance<?php echo $url_sym ?>', function(topic, data) {
                  // console.warn('Subscribed succesfull');
              n = n + 1;
              if ( n == 30)
              {
                  conn.unsubscribe('binance<?php echo $url_sym ?>');
              }  
             */
             // binancetrades.unshift(data);
              
       
          },
          function() {
              console.warn('WebSocket connection closed');
          },
          {'skipSubprotocolCheck': true}
       );
       </script>
       
       <script type="text/javascript">
       
       function addZeroes(num) {
              const dec = num.split('.')[1]
              const len = dec && dec.length > 2 ? dec.length : 2
              return Number(num).toFixed(len)
          };
       
       
       var bidsPlaceholdervalue = document.getElementById("bids_placeholdervalue"),
          bidsPlaceholderamount =  document.getElementById("bids_placeholderamount"),
          bidsPlaceholderbidprice = document.getElementById("bids_placeholderbidprice"),
          asksPlaceholdervalue = document.getElementById("asks_placeholdervalue"),
          asksPlaceholderamount =  document.getElementById("asks_placeholderamount"),
          asksPlaceholderaskprice = document.getElementById("asks_placeholderaskprice"),
          bidsPlaceholderCurrentbidprice = document.getElementById("bids_currentplaceholderbidprice"),
          asksPlaceholderCurrentaskprice = document.getElementById("asks_currentplaceholderaskprice"),
          Step = document.getElementById("Step");
       
       var placeholdertime = document.getElementById('trades_placeholdertime'),
       /*   childtime = null, */
          i = 0,
          trades = 0;
       var placeholdervol = document.getElementById('trades_placeholdervol'),
          childvol = null,
          j = 0;
       
       var placeholderprice = document.getElementById('trades_placeholderprice'),
          childprice = null,
          k = 0;
       
       var placeholdervalue = document.getElementById('trades_placeholdervalue'),
          childprice = null,
          l = 0;
       
       var placeholderBitPrice = document.getElementById('trades_placeholderBitPrice');
       
       var datalast = 0;
       /**
       * This constant is an example of subscription message. By changing its event property to: "bts:unsubscribe"
       * you can delete your subscription and stop receiving events.
       */
       
       var subscribeMsg = {
           "method": "SUBSCRIBE",
               "params":
               [
                   "<?php echo $symbol1; echo $symbol2 ?>@trade" //, 
                   //"vetusdt@depth@100ms"
               ],
               "id": 1
               };
       
       /**
       * Execute a websocket handshake by sending an HTTP upgrade header.
       */
       var ws;
       initWebsocket();
       
       /**
       * Serializes data when it's received.
       */
       var coinba = [];
       var binancebidask = [];
       //var binancetrades = [];
       var previousUpdateIdWs = 0;
       var firstUpdateIdWs;
       var lastUpdateIdWs;
       
       var start = Date.now();
       
       var startminmax = Date.now();
       var startminmaxon = 1;  
       var minmaxinitial = 0;
       var latestprice = <?php echo $BitPrice ?>;

       var startTrades = Date.now();
       var startminmaxTrades = Date.now();
       var startminmaxonTrades = 1;  
       var minmaxinitialTrades = 0;
       var latestpriceTrades = <?php echo $BitPrice ?>;

       var maxPrice = <?php echo $BitPrice * 1.048 ?>;
       var minPrice = <?php echo $BitPrice / 1.048 ?>;
       
       if ( <?php echo $BitPrice ?> > 10000)
           {
           maxPrice = <?php echo $BitPrice * 1.01 ?>;
           minPrice = <?php echo $BitPrice / 1.01 ?>;
           }
           else
           {
           maxPrice = <?php echo $BitPrice * 1.048 ?>;
           minPrice = <?php echo $BitPrice / 1.048 ?>;
           }
       
       maxCoinLength = <?php echo $url_coinlength ?>;
       maxCoinInteger = <?php echo $url_coininteger ?>;
       
       maxLength = maxCoinLength + maxCoinInteger;
       
       optellen = 0;
       
       
       
       
       /*** SERIALIZE DATA ***/
       
       function serializeData(data) {

// https://steemit.com/utopian-io/@steempytutorials/part-2-manage-local-steem-orderbook-via-websocket-stream-from-exchange
// check for orderbook, if empty retrieve

if ( orderbook.length == 0 && updating == 0) {
    console.log('Orderbook is empty');
    lastUpdateId = data['u'];
    updating = 1;
    getOrderbookSnapshot().then(function(data) {
    orderbook = data; // `data` is not `undefined`

});
} 

// get lastUpdateId
else {

lastUpdateId = orderbook[0]['lastUpdateId'];

}



// drop any updates older than the snapshot
if  (updates == 0 ) {
    if (data['U'] <= parseInt(lastUpdateId)+1 && data['u'] >= parseInt(lastUpdateId)+1) {
        orderbook[0]['lastUpdateId'] = data['u'];
        process_updates(data);
        updates = 1;
    } else {
        console.log('discard update');
    }
}
// check if update still in sync with orderbook
else if ( data['U'] == parseInt(lastUpdateId+1) && updating == 1) {
        //console.log('process this update');
        orderbook[0]['lastUpdateId'] = data['u'];
        process_updates(data)
}
else {
     updating = 0;             
     updates = 0;
     console.log('Out of sync, abort ==> Get new snapshot');
     getOrderbookSnapshot().then(function(data) {
     orderbook = data; // `data` is not `undefined`
     updating = 1; 
 });
}

// Loop through all bid and ask updates, call manage_orderbook accordingly
function process_updates(data) {
  //  console.log(orderbook);
        for ( update in data['b'] ) {
            //console.log(data['b'][update]);
         //    console.log('Process bids');
            manage_orderbook('bids', data['b'][update]);
        }
        for ( update in data['a'] ) {
         //    console.log('Process asks');
             //console.log('Updates to be done ');
             //console.log(data['a'][update]);
             manage_orderbook('asks', data['a'][update]);
        }
}


// Update orderbook, differentiate between remove, update and new
function manage_orderbook(side, update) {

// extract values
price  = update[0];
qty = update[1]; 

// loop through orderbook side

    for ( x in orderbook[0][side] ) {
       
        if ( price == orderbook[0][side][x][0] ) {

            // when qty is 0 remove from orderbook, else
            // update values
            if ( qty == 0 ) {
                orderbook[0][side].splice(x, 1); 
             //   console.log('Removed ' + price + ' ' + qty);
                break;
            }
            else {
             //   console.log('PRICE ' + price + ' QTY update ' + orderbook[0][side][x][1] + ' ==> ' + update[1]);
                orderbook[0][side][x][1] = update[1];
                orderbook[0][side][x].splice( 1, 1 ,update[1] );
                //debugger;
                break;
            }
        }
// if the price level is not in the orderbook, 
// insert price level, filter for qty 0
        else if ( ( price > orderbook[0][side][x][0] && side == 'bids') || (price < orderbook[0][side][x][0] && side == 'asks') ) {
            if ( qty != 0 )
            {
            orderbook[0][side].splice(x, 0, [update[0], update[1]]);
         //   console.log('New price ' + price + ' ' + qty);
            //console.log(orderbook);
            //debugger;
            break;

            }
        else {
            break;
            }
        }
    }
}


if (updating == 1){      
  let coinPriceAmount = 
 [
 ...orderbook[0].bids.map(bid => {return {price: parseFloat(bid[0]), amount: parseFloat(bid[1]), side: "bids" }}),
 ...orderbook[0].asks.map(ask => {return {price: parseFloat(ask[0]), amount: parseFloat(ask[1]), side: "asks" }}),


 ];

     
   var coinBids = 
   temp = Object
       .entries(coinPriceAmount)
           .reduce((r,  [k, {price, side, amount}]) => {
      //    console.log("r", r);
      //   console.log("k",  [k, {price, amount}]);
      var price = price * (Math.pow(10,maxCoinLength));
         var price = (Math.round(price/Math.pow(10,optellen))*Math.pow(10,optellen));
         var price = price / (Math.pow(10,maxCoinLength));
         r[side][price] = r[side][price] || { price, amount: 0 };
         r[side][price].amount += amount;
           return r;
       }, { bids: {}, asks: {} }),
   result = Object.fromEntries(
       Object
           .entries(temp)
           .map(([k, o]) => [
               k,
               Object
                   .keys(o)
                   .sort((a, b) => b - a)
                   .map((total => k => ({ ...o[k], total: total += o[k].amount }))(0))
           ])
   );

   result.asks = result.asks.reverse();

   Step.innerHTML = '';
   Step.innerHTML = parseFloat(Math.pow(10,optellen)/Math.pow(10,maxCoinLength)).toFixed(maxCoinLength);
   
   bidsPlaceholdervalue.innerHTML = '';
   bidsPlaceholderamount.innerHTML = '';
   bidsPlaceholderbidprice.innerHTML = '';
   asksPlaceholdervalue.innerHTML = '';
   asksPlaceholderamount.innerHTML = '';
   asksPlaceholderaskprice.innerHTML = '';

   bidLength = Math.min(result.bids.length,30); 
   askLength = Math.min(result.asks.length,30); 
        
   for (iii = 0; iii < bidLength; iii++) {
       bidsPlaceholdervalue.innerHTML =
           bidsPlaceholdervalue.innerHTML + '  $'  + (parseFloat(result.bids[iii].amount*result.bids[iii].price)).toFixed(0) + '<br />';
    if ( maxCoinInteger <= 2)
       {
             bidsPlaceholderamount.innerHTML =
             bidsPlaceholderamount.innerHTML + (parseFloat(result.bids[iii].amount)).toFixed(0) + '<br />';
       }
   else 
       {
            bidsPlaceholderamount.innerHTML =
               bidsPlaceholderamount.innerHTML + (parseFloat(result.bids[iii].amount)).toFixed(2) + '<br />';
       }
       
           bidsPlaceholderbidprice.innerHTML =
           bidsPlaceholderbidprice.innerHTML + (parseFloat(result.bids[iii].price).toFixed(maxCoinLength)) + '<br />';

   }
   
   bidsPlaceholderCurrentbidprice.innerHTML = 'Bid ' + addZeroes((parseFloat(result.bids[0].price).toFixed(maxCoinLength).toString()));

   for (iii = 0; iii < askLength; iii++) {
       asksPlaceholdervalue.innerHTML =
           asksPlaceholdervalue.innerHTML + '  $'  + (parseFloat(result.asks[iii].amount*result.asks[iii].price)).toFixed(0) + '<br />';
   if ( maxCoinInteger <= 2)
       {   
           asksPlaceholderamount.innerHTML =
          asksPlaceholderamount.innerHTML + (parseFloat(result.asks[iii].amount)).toFixed(0) + '<br />';
       }
   else 
       {
          asksPlaceholderamount.innerHTML =
          asksPlaceholderamount.innerHTML + (parseFloat(result.asks[iii].amount)).toFixed(2) + '<br />';
       }     
   
           asksPlaceholderaskprice.innerHTML =
           asksPlaceholderaskprice.innerHTML + (parseFloat(result.asks[iii].price).toFixed(maxCoinLength)) + '<br />';
   } 
   asksPlaceholderCurrentaskprice.innerHTML =  'Ask ' + addZeroes((parseFloat(result.asks[0].price).toFixed(maxCoinLength).toString()));

const millisminmax = Date.now() - startminmax;

if ( minmaxinitial == 0 )
{
   startminmax = Date.now();
   minmaxinitial = 1;
}

if ( (millisminmax > 20000 || startminmaxon == 1) && minmaxinitial == 1)
 {

  //t_maxPrice = Math.max.apply(Math, showTradesinCircles.map(function(o) { return o.price; }));
  //t_minPrice = Math.min.apply(Math, showTradesinCircles.map(function(o) { return o.price; }));
  //var delta = t_maxPrice - t_minPrice;
   if ( latestprice > 1000)
   {
   maxPrice = latestprice * 1.015 ;
   minPrice = latestprice / 1.015 ;
   //console.log(maxPrice + ' ' +  minPrice);
   }
   else
   {
   maxPrice = latestprice * 1.048 ;
   minPrice = latestprice / 1.048 ;
   //console.log(maxPrice + ' ' +  minPrice);   
   }

   startminmax = Date.now();
   startminmaxon = 0;
 }


   const nowTimeinSerializeData = Date.now()*1000;

   


   const millis = Date.now() - start;

  //console.log(`milliseconds elapsed = ${Math.floor(millis)}`);


   if ( millis > 1000 )


   //console.log(showTradesinCircles[0].microtimestamp);

   {
       
           var data = [
           ...result.bids.map(bid => {return {price: bid.price, amount: bid.amount, cumul: bid.price*bid.amount, type: "bid"}}).filter(a => a.amount > 0 && a.price < maxPrice && a.price > minPrice), 
           ...result.asks.map(ask => {return {price: ask.price, amount: ask.amount, cumul: ask.price*ask.amount, type: "ask"}}).filter(a => a.amount > 0 && a.price < maxPrice && a.price > minPrice), 
           ...showTradesinCircles.map(trade => {return {amount: parseFloat(trade.amount), time: parseInt(trade.microtimestamp), price: parseFloat(trade.price), type: 'trade'}}).filter(a => (nowTimeinSerializeData - parseInt(a.time)) < 10000000 && a.amount > 0 ) //last 15s trades
           ]
           
           var xScale = d3.scaleLinear()
           .domain([0, Math.max(...data.map(xValue))])
           .range([0, svgSize.width]);

    const yScaleL = d3.scaleLinear()
      .domain([minPrice, maxPrice]) //d3.extent(data, yValue))
      .range([svgSize.height, 0])
      .nice();


   if (minPrice > 100)
   {
       var yScaleR = d3.scaleLinear()
       .domain([  (minPrice/<?php echo $bitcoin ?>) ,(maxPrice/<?php echo $bitcoin ?>)  ]) //d3.extent(data, yValue))
      .range([svgSize.height, 0])
      .nice();
   }    
   else 
   {
       var yScaleR = d3.scaleLinear()
       .domain([  (minPrice/<?php echo $bitcoin ?>) , (maxPrice/<?php echo $bitcoin ?>)  ]) //d3.extent(data, yValue))
      .range([svgSize.height, 0])
      .nice();
   }

       // const yScale = d3.scaleLinear()
       //     .domain([minPrice, maxPrice]) //.domain(d3.extent(data, yValue))
       //     .range([svgSize.height, 0])
       //     .nice();

       g.selectAll('g').remove();

       var yAxisL = d3.axisLeft(yScaleL)
      .tickSize(-svgSize.width)
      .tickPadding(0.01);

if ('<?php echo $symbol1 ?>' != 'btc')
{ 
   var yAxisR = d3.axisRight(yScaleR)
      .tickPadding(0.01);
}      
  var yAxisGL = g.append('g')
      .call(yAxisL)
      .selectAll("text")
      .attr("transform",`translate(-${margin.left/4},0)`);

if ('<?php echo $symbol1 ?>' != 'btc')
{ 
      var yAxisGR = g.append('g') 
      .call(yAxisR)
      .selectAll("text")
      .attr("transform",`translate(650,0)`);
   }  

       // var yAxis = d3.axisLeft(yScale)
       //     .tickSize(-svgSize.width)
       //     .tickPadding(0.01);
           
       // var yAxisG = g.append('g')
       //     .call(yAxis)
       //     .selectAll("text")
       //     .attr("transform",`translate(-${margin.left/4},0)`);

       var xAxis = d3.axisBottom(xScale)
       .tickSize(svgSize.height)
       .ticks(10)
       .tickPadding(1)
       .tickFormat(function (d) {
           if ((d / 1000) >= 1) {
               if ((d / 1000000000) >= 1) {
                d = d / 1000000000 + "B";
                }
               else if ((d / 1000000) >= 1) {
                d = d / 1000000 + "M";
                }
                else {
                d = d / 1000 + "K";
                }
           }
           return d;
           });


       var xAxisG = g.append('g').call(xAxis)
       .selectAll("text")
       .attr("transform",`translate(0, ${margin.top})`);

       g.selectAll("circle").remove();
  //  g.selectAll("text.foo2").remove();
     g.selectAll("circle")
  .data(data)
 //   .call(log,"data")
    .enter()
    .append("circle")
    .attr("cy", d => yScaleL(yValue(d)))
    .attr("cx", d => xScale(xValue(d)))
    .attr("r",  d => Math.pow(xScale(xValue(d))*0.75, 0.3333) * 3) // calculate radius of ball by volume and scale it 6x
    .attr("fill", d => colorValue(d))
    .attr("stroke", d => strokeValue(d))
    .attr("opacity", d => opacityValue(d))
    .attr("explain2", d => ( colorValue(d) == '#FF0000' ? 
    'A seller wants to sell ' + abbreviateNumber(parseInt(d.price*d.amount)) + ' dollar worth of Ethereum at price ' + parseFloat(d.price) + '$ for ' + parseFloat(d.amount).toFixed(2) + ' Ethereum tokens ' 
    : colorValue(d) == '#29CB1C' ?
    'A buyer wants to buy '  + abbreviateNumber(parseInt(d.price*d.amount)) + ' dollar worth of Ethereum at price ' + parseFloat(d.price) + '$ for ' + parseFloat(d.amount).toFixed(2) + ' Ethereum tokens '
    : 'A trade is made worth ' + abbreviateNumber(parseInt(d.price*d.amount)) + ' dollar of Ethereum at price ' + parseFloat(d.price) + '$ for ' + parseFloat(d.amount).toFixed(2) + ' Ethereum tokens ') ) 
    .on('mouseover', function(d, i) {
      g.selectAll("text.foo2").remove();
      g.selectAll("text.foo3").remove();
//       console.log("mouseover on", this);
//      console.log(i);
//      console.log(data);
    // console.log('EXPLAIN', d3.select(this).attr("explain2"))
     verdorie = d3.select(this).attr("explain2");
    // console.log("Lijn2491");
   //   d3.select(this).attr({
   //           fill: "orange",
   //         });
   data2 = data.filter(function(d){return (i.type === 'ask' ? d.price <= i.price && d.type === i.type: d.price >= i.price && d.type === i.type) ;});
 
   cums = Math.max(...d3.cumsum(data2, d => d.cumul ) );

   if (i.type  === 'ask' )
       { 
         //  console.log('The price of Ethereum will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar is invested in Ethereum');
           verdorie2 = 'The price will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar is invested';
       }
       else if (i.type  === 'bid' )
       {
         //  console.log('The price of Ethereum will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar worth of Ethereum are sold');
           verdorie2 = 'The price of Ethereum will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar worth of Ethereum are sold';
       }
       else
       {
         //  console.log('The price of Ethereum will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar worth of Ethereum are sold');
           verdorie2 = 'The price of Ethereum is  ' + parseFloat(i.price) + ' and this trade is worth ' +   abbreviateNumber(parseInt(i.price*i.amount)) + '$';
       }

     d3.select(this).attr("explain2");
       g.append("text")
       .attr("class", "foo2") 
       .attr("x", 10)
       .attr("y", 15)
       .attr("font-family", "Trebuchet MS,roboto, ubuntu")
       // .attr("font-weight", "bold")
       .style('fill', 'lightgrey')
       // .style('color', 'white')
       .attr("font-size",  "12px") //d => Math.round( (Math.pow(xScale(xValue(d))*0.75, 0.3333) * 4)  / 6)  +'em')
       .text(function() {
             return [verdorie];  // Value of the text
           })
       g.append("text")
       .attr("class", "foo3") 
       .attr("x", 10)
       .attr("y", 30)
       .attr("font-family", "Trebuchet MS,roboto, ubuntu")
       // .attr("font-weight", "bold")
       .style('fill', 'lightgrey')
       // .style('color', 'white')
       .attr("font-size",  "12px") //d => Math.round( (Math.pow(xScale(xValue(d))*0.75, 0.3333) * 4)  / 6)  +'em')
       .text(function() {
             return [verdorie2];  // Value of the text
           });
       // .attr("text-anchor","middle")
       // .attr("alignment-baseline","central")
       
      // .transition()
      // .duration(300)
   })          
   .on('mouseout', function(d, i) {
       g.selectAll("text.foo2").remove();
       g.selectAll("text.foo3").remove();
//     console.log("mouseout 1965", this);
     d3.select(this)
      // .transition()
      // .duration(100)
      // .attr('r', 20);
      // .attr('fill', d => ( colorValue(d) == '#ff0000' ? '#ff0000' : '#29CB1C' ) ) ;
   })   
   

           function log(sel,msg) {
       console.log(msg,sel);
           }

           g.selectAll("text.foo").remove();
       var text = g.selectAll("text.foo")
           .data(data)
           .enter()
           .append("text") 
           .attr("class", "foo")  
           .attr("r",  d => Math.pow(xScale(xValue(d))*0.75, 0.3333) * 3) 
           .attr("cy", d => yScaleL(yValue(d)))
           .attr("cx", d => xScale(xValue(d)))     
           .attr("x",  d => xScale(xValue(d)))  //function(d) { return d.cx; })
           .attr("y", d => yScaleL(yValue(d))) //function(d) { return d.cy; })
           .text(function (d) { return ( Math.pow(xScale(xValue(d))*0.75, 0.3333) * 3 ) > 8 ? abbreviateNumber(parseInt(d.price*d.amount)) : null; })
           //.attr("explain", d => ( Math.pow(xScale(xValue(d))*0.75, 0.3333) * 3 ) > 10 ? abbreviateNumber(parseInt(d.price*d.amount)) : null )
           .attr("text-anchor","middle")
           .attr("alignment-baseline","central")
           .attr("font-family", "Trebuchet MS,roboto, ubuntu")
           .attr("font-weight", "bold")
           .attr("font-size",  d => Math.min(2* (Math.pow(xScale(xValue(d))*0.75, 0.3333) * 3)/3, (2 * (Math.pow(xScale(xValue(d))*0.75, 0.3333) * 3) - 8) / 10 * 24) + "px") //d => Math.round( (Math.pow(xScale(xValue(d))*0.75, 0.3333) * 4)  / 6)  +'em')
           .attr("fill", "lightgrey")
           .attr("explain2", d => ( colorValue(d) == '#FF0000' ? 
    'A seller wants to sell ' + abbreviateNumber(parseInt(d.price*d.amount)) + ' dollar worth of Ethereum at price ' + parseFloat(d.price) + '$ for ' + parseFloat(d.amount).toFixed(2) + ' Ethereum tokens ' 
    : colorValue(d) == '#29CB1C' ?
    'A buyer wants to buy '  + abbreviateNumber(parseInt(d.price*d.amount)) + ' dollar worth of Ethereum at price ' + parseFloat(d.price) + '$ for ' + parseFloat(d.amount).toFixed(2) + ' Ethereum tokens '
    : 'A trade is made worth ' + abbreviateNumber(parseInt(d.price*d.amount)) + ' dollar of Ethereum at price ' + parseFloat(d.price) + '$ for ' + parseFloat(d.amount).toFixed(2) + ' Ethereum tokens ') ) 
    .on('mouseover', function(d, i) {
      g.selectAll("text.foo2").remove();
      g.selectAll("text.foo3").remove();
//       console.log("mouseover on", this);
//      console.log(i);
//      console.log(data);
    // console.log('EXPLAIN', d3.select(this).attr("explain2"))
     verdorie = d3.select(this).attr("explain2");
    // console.log("Lijn2491");
   //   d3.select(this).attr({
   //           fill: "orange",
   //         });
   data2 = data.filter(function(d){return (i.type === 'ask' ? d.price <= i.price && d.type === i.type: d.price >= i.price && d.type === i.type) ;});
 
   cums = Math.max(...d3.cumsum(data2, d => d.cumul ) );

   if (i.type  === 'ask' )
       { 
         //  console.log('The price of Ethereum will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar is invested in Ethereum');
           verdorie2 = 'The price will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar is invested';
       }
       else if (i.type  === 'bid' )
       {
         //  console.log('The price of Ethereum will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar worth of Ethereum are sold');
           verdorie2 = 'The price of Ethereum will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar worth of Ethereum are sold';
       }
       else
       {
         //  console.log('The price of Ethereum will be ' + parseFloat(i.price) + ' when ' + abbreviateNumber(parseInt(cums)) + ' dollar worth of Ethereum are sold');
           verdorie2 = 'The price of Ethereum is  ' + parseFloat(i.price) + ' and this trade is worth ' +   abbreviateNumber(parseInt(i.price*i.amount)) + '$';
       }

     d3.select(this).attr("explain2");
       g.append("text")
       .attr("class", "foo2") 
       .attr("x", 10)
       .attr("y", 15)
       .attr("font-family", "Trebuchet MS,roboto, ubuntu")
       // .attr("font-weight", "bold")
       .style('fill', 'lightgrey')
       // .style('color', 'white')
       .attr("font-size",  "12px") //d => Math.round( (Math.pow(xScale(xValue(d))*0.75, 0.3333) * 4)  / 6)  +'em')
       .text(function() {
             return [verdorie];  // Value of the text
           })
       g.append("text")
       .attr("class", "foo3") 
       .attr("x", 10)
       .attr("y", 30)
       .attr("font-family", "Trebuchet MS,roboto, ubuntu")
       // .attr("font-weight", "bold")
       .style('fill', 'lightgrey')
       // .style('color', 'white')
       .attr("font-size",  "12px") //d => Math.round( (Math.pow(xScale(xValue(d))*0.75, 0.3333) * 4)  / 6)  +'em')
       .text(function() {
             return [verdorie2];  // Value of the text
           });
       // .attr("text-anchor","middle")
       // .attr("alignment-baseline","central")
       
      // .transition()
      // .duration(300)
   })          
   .on('mouseout', function(d, i) {
       g.selectAll("text.foo2").remove();
       g.selectAll("text.foo3").remove();
//     console.log("mouseout 1965", this);
     d3.select(this)
      // .transition()
      // .duration(100)
      // .attr('r', 20);
      // .attr('fill', d => ( colorValue(d) == '#ff0000' ? '#ff0000' : '#29CB1C' ) ) ;
   })   
       
       start = Date.now();
       }
       
}
}

/*** END SERIALIZE DATA ***/
        

		function changePageTitle(price) { 
			var pageTitle = price + ' Ethereum crypto price | CryptoPrediction.io'; 
			document.title = pageTitle; 
		}

      
       /*** SERIALIZE TRADE  ***/
       
       function serializeTrade(data) {

data.q = parseFloat(data.q);
data.p = parseFloat(data.p);

// BEGIN Toon Trades als numerieke data 
       
changePageTitle(data.p);
latestprice = data.p;

Mcapplaceholder.innerHTML = parseFloat((<?php echo $circulatingsupply ?>*latestprice)/1000/1000/1000).toFixed(2) + 'B';

<?php if ( $totalsupply == '∞' )
                    {
                         echo "FullyDilutedMcapplaceholder.innerHTML = '∞'";
                    }
      else {
                        echo "FullyDilutedMcapplaceholder.innerHTML = parseFloat(($totalsupply*latestprice)/1000/1000/1000).toFixed(2) + 'B'";
            }
            ?>
       

if ( datalast <= data.p) {
    if (i === 0) {
            placeholderBitPrice.innerHTML = '';
    }
    childtime = document.createElement('div');
    childtime.setAttribute("id","childtime" + (i + 30));
    childvol = document.createElement('div');
    childvol.setAttribute("id","childvol" + (j + 30));
    childprice = document.createElement('div');
    childprice.setAttribute("id","childprice" + (k + 30));
    childvalue = document.createElement('div');
    childvalue.setAttribute("id","childvalue" + (l + 30));
    childtime.className = "rowgreen";
    childvol.className = "rowgreen";
    childprice.className = "rowgreen";
    childvalue.className = "rowgreengrey";


    childtime.innerHTML =
       new Date(data.E).toLocaleTimeString('en-US', {
           hour12: false,
           hour: 'numeric',
           minute: 'numeric',
           second: 'numeric'
       });

  if ( maxCoinInteger == '1' )
   {    
        childvol.innerHTML = data.q.toFixed(0);
   }
   else 
   {
        childvol.innerHTML = data.q.toFixed(4);
   }


        childprice.innerHTML = data.p.toFixed(maxCoinLength);
        placeholderBitPrice.innerHTML = addZeroes(data.p.toFixed(maxCoinLength).toString()) + '<span style="color:lightgrey"><span style="font-size:0.6em"><?php echo $symbol2 ?></span></span>';

if ( (data.p*data.q).toFixed(0) < 1)
   {    
       childvalue.innerHTML = '< $' + '1';
   }
   else 
   {
    childvalue.innerHTML = '$' +(data.p*data.q).toFixed(0);
   }

    datalast = data.p;
    placeholdertime.insertBefore(childtime, placeholdertime.childNodes[0]);
    placeholdervol.insertBefore(childvol, placeholdervol.childNodes[0]);
    placeholderprice.insertBefore(childprice, placeholderprice.childNodes[0]);
    placeholdervalue.insertBefore(childvalue, placeholdervalue.childNodes[0]);

} 

if ( datalast  > data.p ) {

    childtime = document.createElement('div');
    childtime.setAttribute("id","childtime" + (i + 30));
    childvol = document.createElement('div');
    childvol.setAttribute("id","childvol" + (j + 30));
    childprice = document.createElement('div');
    childprice.setAttribute("id","childprice" + (k + 30));
    childvalue = document.createElement('div');
    childvalue.setAttribute("id","childvalue" + (l + 30));
    childtime.className = "rowred";
    childvol.className = "rowred";
    childprice.className = "rowred";
    childvalue.className = "rowredgrey";

    childtime.innerHTML =
        new Date(data.E).toLocaleTimeString('en-US', {
            hour12: false,
            hour: 'numeric',
            minute: 'numeric',
            second: 'numeric'
        });

   if ( maxCoinInteger == '1' )
   {    
        childvol.innerHTML = data.q.toFixed(0);
   }
   else 
   {
        childvol.innerHTML = data.q.toFixed(4);
   }

        childprice.innerHTML = data.p.toFixed(maxCoinLength);
        placeholderBitPrice.innerHTML = addZeroes(data.p.toString()) + '<span style="color:lightgrey"><span style="font-size:0.6em"><?php echo $symbol2 ?></span></span>';

  if ( (data.p*data.q).toFixed(0) < 1)
   {    
       childvalue.innerHTML = '< $' + '1';
   }
   else 
   {
    childvalue.innerHTML = '$' +(data.p*data.q).toFixed(0);
   }             

    datalast = data.p;

    placeholdertime.insertBefore(childtime, placeholdertime.childNodes[0]);
    placeholdervol.insertBefore(childvol, placeholdervol.childNodes[0]);
    placeholderprice.insertBefore(childprice, placeholderprice.childNodes[0]);
    placeholdervalue.insertBefore(childvalue, placeholdervalue.childNodes[0]);


} 

deletechildtime = "childtime" + i;
deletechildvol = "childvol" + j;
deletechildprice = "childprice" + k;
deletechildvalue = "childvalue" + l;

deletechildtime = document.getElementById(deletechildtime);
placeholdertime.removeChild(deletechildtime); 
deletechildvol = document.getElementById(deletechildvol);
placeholdervol.removeChild(deletechildvol); 
deletechildprice = document.getElementById(deletechildprice);
placeholderprice.removeChild(deletechildprice); 
deletechildvalue = document.getElementById(deletechildvalue);
placeholdervalue.removeChild(deletechildvalue); 

i++;
j++;
k++;
l++;
trades++;

//EINDE toont Trades als numerieke data 

// ENKEL DOTS op Charts

var wsShowTradesinTrades = [];

wsShowTradesinTrades.push(data);

 wsAllTrades.push(data);

// console.log(wsAllTrades);

const millisminmaxTrades = Date.now() - startminmaxTrades;

if ( minmaxinitialTrades == 0 )
{
startminmaxTrades = Date.now();
minmaxinitialTrades = 1;
}

if ( (millisminmaxTrades > 1500 || startminmaxonTrades == 1) && minmaxinitialTrades == 1)
{

//t_maxPrice = Math.max.apply(Math, showTradesinCircles.map(function(o) { return o.price; }));
//t_minPrice = Math.min.apply(Math, showTradesinCircles.map(function(o) { return o.price; }));
//var delta = t_maxPrice - t_minPrice;
if ( latestpriceTrades > 10000)
{
maxPriceSvg3 = latestpriceTrades * 1.008 ;
minPriceSvg3 = latestpriceTrades / 1.008 ;
//console.log(maxPrice + ' ' +  minPrice);
}
else
{
  //  console.log('REFRESH');
maxPriceSvg3 = latestpriceTrades * 1.010 ;
minPriceSvg3 = latestpriceTrades / 1.010 ;
//console.log(maxPrice + ' ' +  minPrice);   
}

startminmaxTrades = Date.now();
startminmaxonTrades = 0;

const nowTimeinSerializeDataSvg3 = Date.now()*1000;


for ( x in wsAllTrades ) {
  if (  ( nowTimeinSerializeDataSvg3 - (parseInt(wsAllTrades[x].E)*1000) ) > 4000000 ) {
            wsAllTrades.splice(x, 1); 
       }

   }

 //  console.log(wsAllTrades.length);
   //debugger;



/* daarna de Array pushes naar showTradesinCircles */
var serializeTradetoShowTradesinCircles = 
[
...wsAllTrades.map(trades => {return {price: parseFloat(trades.p), amount: parseFloat(trades.q), microtimestamp : trades.E*1000, date : parseInt(trades.E), side: "trade" }})
];


//console.log(serializeTradetoShowTradesinCircles);

function toObject(arr) {
var rv = {};
for (var i = 0; i < arr.length; ++i)
rv[i] = arr[i];
return rv;
}


// showTradeinCircles = phpTrades geinitialiseerd (niet meer up to date)
showTradesinCircles = [];

for (var starti = 0; starti < serializeTradetoShowTradesinCircles.length; ++starti)
{
showTradesinCircles.push(toObject(serializeTradetoShowTradesinCircles)[starti]);

}


          
           var dataTrades = [
        ...showTradesinCircles.map(trade => {return {amount: parseFloat(trade.amount), time: parseInt(trade.microtimestamp), price: parseFloat(trade.price), type: 'trade'}})//.filter(a => (nowTimeinSerializeData - parseInt(a.time)) < 4000000 && a.amount > 0 ) //last 15s trades
        ]
        


 //price: 3749.96, amount: 0.2992, microtimestamp: 1630581647012, date: 1630581647012, type: 'trade' //

//          console.log(showTradesinCircles);

 

//     console.log('REFRESH DRAW TRADES');
     
 var xScaleSvg3 = d3.scaleLinear()
        .domain([0, Math.max(...dataTrades.map(xValueSvg3))])
        .range([0, svgSizeSvg3.width]);

 const yScaleLSvg3 = d3.scaleLinear()
   .domain([minPriceSvg3, maxPriceSvg3]) // [Math.min(...dataTrades.map(yValueSvg3) ), Math.max(...dataTrades.map(yValueSvg3) )] ) //[0, Math.max(...dataTrades.map(yValueSvg3))]) // [minPrice, maxPrice]) //d3.extent(data, yValue))
   .range([svgSizeSvg3.height, 0])
  // .nice();

   //console.log(dataTrades);


 gSvg3.selectAll('g').remove();

 var yAxisLSvg3 = d3.axisLeft(yScaleLSvg3)
   .tickSize(-svgSizeSvg3.width)
   .tickPadding(0.01);


 var yAxisGLSvg3 = gSvg3.append('g')
   .call(yAxisLSvg3)
   .selectAll("text")
   .attr("transform",`translate(-${marginSvg3.left/4},0)`);


    var xAxisSvg3 = d3.axisBottom(xScaleSvg3)
    .tickSize(svgSizeSvg3.height)
    .ticks(10)
    .tickPadding(1)
    .tickFormat(function (d) {
           if ((d / 1000) >= 1) {
               if ((d / 1000000000) >= 1) {
                d = d / 1000000000 + "B";
                }
               else if ((d / 1000000) >= 1) {
                d = d / 1000000 + "M";
                }
                else {
                d = d / 1000 + "K";
                }
           }
           return d;
           });


    var xAxisGSvg3 = gSvg3.append('g')
    .call(xAxisSvg3)
    .selectAll("text")
    .attr("transform",`translate(0, ${marginSvg3.top})`);

    gSvg3.selectAll("circle").remove();
  gSvg3.selectAll("circle")
.data(dataTrades)
 .enter()
 .append("circle")
 .attr("cy", d => yScaleLSvg3(yValueSvg3(d)))
 .attr("cx", d => xScaleSvg3(xValueSvg3(d)))
.attr("fill", d => colorValue(d))
  .attr("stroke", d => strokeValue(d))
  .attr("r",  d => Math.pow(xScaleSvg3(xValueSvg3(d))*0.75, 0.3333) * 3 )  // calculate radius of ball by volume and scale it 6x
 .attr("opacity", d => opacityValue(d))

 gSvg3.selectAll("text.foo4").remove();
  gSvg3.selectAll("text.foo4")
        .data(dataTrades)
        .enter()
        .append("text") 
        .attr("class", "foo4")  
        .attr("r",  d => Math.pow(xScaleSvg3(xValueSvg3(d))*0.75, 0.3333) * 3) 
        .attr("cy", d => yScaleLSvg3(yValueSvg3(d)))
        .attr("cx", d => xScaleSvg3(xValueSvg3(d)))     
        .attr("x",  d => xScaleSvg3(xValueSvg3(d)))  //function(d) { return d.cx; })
        .attr("y", d => yScaleLSvg3(yValueSvg3(d))) //function(d) { return d.cy; })
        .text(function (d) { return ( Math.pow(xScaleSvg3(xValueSvg3(d))*0.75, 0.3333) * 3 ) > 8 ?  '$' + (parseFloat(d.price)*parseFloat(d.amount)).toFixed(0) : null; })
        //.attr("explain", d => ( Math.pow(xScale(xValue(d))*0.75, 0.3333) * 3 ) > 10 ? abbreviateNumber(parseInt(d.price*d.amount)) : null )
        .attr("text-anchor","middle")
        .attr("alignment-baseline","central")
        .attr("font-family", "Trebuchet MS,roboto, ubuntu")
        .attr("font-weight", "bold")
        .attr("font-size",  d => Math.min(2* (Math.pow(xScaleSvg3(xValueSvg3(d))*0.75, 0.3333) * 3)/4, (2 * (Math.pow(xScaleSvg3(xValueSvg3(d))*0.75, 0.3333) * 3) - 8) / 10 * 24) + "px") //d => Math.round( (Math.pow(xScale(xValue(d))*0.75, 0.3333) * 4)  / 6)  +'em')
        .attr("fill", "lightgrey")

        startTrades = Date.now();
     //   showTradesinCircles = [];
 }
// END TRADES DOTS
}

setInterval(function(){ latestpriceTrades = latestprice;}, 20000);

/*** END SERIALIZE TRADE ***/
       function initWebsocket() {
           ws = new WebSocket("wss://stream.binance.com:9443/ws/<?php echo $symbol1; echo $symbol2 ?>@depth");

           // local data management
           console.log("init ws");
           orderbook = [];
           lastUpdateId = 0;
           updates = 0;
           updating = 0;
           console.log('initWebsocket updating = 0');
       
           ws.onopen = function() {
               ws.send(JSON.stringify(subscribeMsg));
           };
       
       
           ws.onmessage = function(evt) {
              response = JSON.parse(evt.data);
              //console.log(response);
              /**
               * This switch statement handles message logic. It processes data in case of data event
               * and it reconnects if the server requires.
               */
               switch (response.e) {
                   case 'depthUpdate': {
                       serializeData(response, 2);
                       break;
                   }
                   case 'trade': {
                       serializeTrade(response);
                       break;
                   }
                  /*  case 'bts:request_reconnect': {
                       initWebsocket();
                       break;
                   } */
               }
           };
          /**
           * In case of unexpected close event, try to reconnect.
           */
           ws.onclose = function() {
              console.log('Websocket connection closed');
              initWebsocket();
          };
       }
       </script>
       
       <script>
       
       const margin = {left: 20, top: 6, bottom: 0, right:0}
       const svgSize = {width: 700, height: 320}
       
       const yValue = d => d.price;
       const xValue = d => d.amount;
       //const colorValue = d => d.type == "trade" ? '#003366' : d.type == "bid" ? '#00ff00' : '#ff2020';
       const colorValue = d => d.type == "trade" ? '#2390FD' : d.type == "bid" ? '#29CB1C' : '#FF0000';
       const strokeValue = d => d.type == "trade" ? '#000000' : d.type == "bid" ? '#006620' : '#660020';
       const opacityValue = d => '0.75'; //d => d.type == "trade" ? '0.15' : d.type == "bid" ? '0.25' : '0.25';   
       
       const parseDate = d3.timeFormat("%H:%M:%S");
       
       //const svg = d3.select(".chart").append('svg').attr('width', svgSize.width+120).attr('height', svgSize.height+40);  
       const svg = d3.select(".chart").append('svg').attr("viewBox", `0 0 ${svgSize.width+80} ${svgSize.height+30}`);
       
       const g = svg.append('g').attr('transform', `translate(55,10)`);
       
       function abbreviateNumber(value) {
           var newValue = value;
           if (value >= 10000) {
               newValue = parseInt(value/1000) + 'k';
           }
           if (value >= 1000000) {
               newValue = parseFloat(value/1000000).toFixed(1) + 'm';
           }
           return newValue;
       }
       
       
       function updateCoinLength (value)
       {
       
           if (optellen < maxLength - 1 )
           {
               if (value == '-')
               {
                   optellen = optellen + 1;
               }
           }
               if (optellen > 0)
               {
                   if (value == '+')
                   {
                       optellen = optellen - 1;
                   }
               }
       }
       
       function getOrderbookSnapshot() {

const proxyurl3 = "";
   const url3 = "https://www.binance.com/api/v1/depth?symbol=<?php echo $url_symupper ?>&limit=1000"; 
   let promises3 = [
   fetch(proxyurl3 + url3) 
   .then(response => response.json()) 
   .catch((error) => {
        console.log(error);
        updating = 1;
        console.log('Updating = 1 Fault');
   })
   ]
   console.log('getOrderbookSnapshot()');
   return Promise.all(promises3)
}
      
       </script>
              <script>
       const marginSvg3 = {left: 15, top: 6, bottom: 0, right:0};
       const svgSizeSvg3 = {width: 700, height: 150};
       
       const yValueSvg3 = d => d.price;
       const xValueSvg3 = d => d.amount;
       //const colorValue = d => d.type == "trade" ? '#003366' : d.type == "bid" ? '#00ff00' : '#ff2020';
       const colorValueSvg3 = d => d.type == "trade" ? '#2390FD' : d.type == "bid" ? '#29CB1C' : '#FF0000';
      // const strokeValue = d => d.type == "trade" ? '#000000' : d.type == "bid" ? '#006620' : '#660020';
       const opacityValueSvg3 = d => '0.75'; //d => d.type == "trade" ? '0.15' : d.type == "bid" ? '0.25' : '0.25';   
       
       const parseDateSvg3 = d3.timeFormat("%H:%M:%S");
       
       //const svg = d3.select(".chart").append('svg').attr('width', svgSize.width+120).attr('height', svgSize.height+40);  
       const Svg3 = d3.select(".chart3").append('svg').attr("viewBox", `0 0 ${svgSizeSvg3.width+70} ${svgSizeSvg3.height+30}`);
       
       const gSvg3 = Svg3.append('g').attr('transform', `translate(45,10)`);
        </script>
<!--       <script>
       unij = <?php echo $uni ?>;
       if (unij == 1)
       {
       //console.log('<php echo $uniswaptokennu ?>');
       setInterval( function uniswap(){
           fetch('https://api.thegraph.com/subgraphs/name/uniswap/uniswap-v2', {
         method: 'POST',
         headers: {
           'Content-Type': 'application/json',
           'Accept': 'application/json',
         },
         body: JSON.stringify({query: "{ bundle(id: \"1\" ) { ethPrice }}", "variables":null })
       })
         .then(r => r.json())
         .then(function(data) {
           //headerr.innerHTML = data.data.tokenDayData.token.name + ' ' + parseFloat(data.data.tokenDayData.priceUSD).toFixed(2) + '$';
           ethprice = parseFloat(data.data.bundle.ethPrice);
       //    console.log(data);
       })
           return uniswap;
       }
       (), 2000);
       }
       </script>
       <script>
       if (unij == 1)
       {
       //console.log('<php echo $uniswaptokennu ?>');
       setInterval( function uniswap(){
           fetch('https://api.thegraph.com/subgraphs/name/uniswap/uniswap-v2', {
         method: 'POST',
         headers: {
           'Content-Type': 'application/json',
           'Accept': 'application/json',
         },
         body: JSON.stringify({query: "{pair(id: \"<?php if ($uni == 1) { echo $uniswap_pair_id; } ?>\"){ token0 { id symbol name derivedETH } token1 { id symbol name derivedETH } reserve0 reserve1 reserveUSD trackedReserveETH token0Price token1Price volumeUSD txCount }}", "variables":null })
         })
         .then(r => r.json())
         .then(function(data) {
           //headerr.innerHTML = 'UNISWAP ' + data.data.pair.token0.name + ' ' + parseFloat(data.data.pair.token1Price*ethprice).toFixed(maxCoinLength) + '$' + ' (' + parseFloat(ethprice).toFixed(2) + '$)';
           headerr.innerHTML = parseFloat(data.data.pair.token1Price*ethprice).toFixed(maxCoinLength) + '<div class="grid-table-moon-symbol">USDT</div>'; // + ' (' + parseFloat(ethprice).toFixed(2) + '$)';
           //headerr.innerHTML = data.data.tokenDayData.token.name + ' ' + parseFloat(data.data.tokenDayData.priceUSD).toFixed(2) + '$';
          // console.log('data returned:', data);
       })
           return uniswap;
       }
       (), 2000);
       }
       </script> -->
       <script>
       
       const margin2 = ({top: 10, right: 25, bottom: 16, left: 40});
       
       const svgSize2 = {width: 780, height: 350};
       
       const parseDate2 = d3.timeFormat("%Y-%m-%dT%H:%M:%S.%LZ");
       const parseDate3 = d3.utcParse("%Y-%m-%dT%H:%M:%S.%LZ");
       
       // const svg2 = d3.select(".chart2")
       //            .append('svg')
       //            .attr('width', svgSize2.width)
       //            .attr('height', svgSize2.height)
       //            .style("-webkit-tap-highlight-color", "transparent");
       
       const svg2 = d3.select(".chart2")
                   .append('svg')
                   .attr("preserveAspectRatio", "xMinYMin meet")
          .attr("viewBox", `0 0 ${svgSize2.width} ${svgSize2.height}`)
//.attr("viewBox", `0 0 ${svgSize2.width} ${svgSize2.height}`) zie https://stackoverflow.com/questions/44833788/making-svg-container-100-width-and-height-of-parent-container-in-d3-v4-instead
                   .style("-webkit-tap-highlight-color", "transparent");
       
       // ** Update data section (Called from the onclick)
       var formatMillisecond = d3.timeFormat(".%L"),
          formatSecond = d3.timeFormat(":%S"),
          formatMinute = d3.timeFormat("%I:%M"),
          formatHour = d3.timeFormat("%H:%M"),
          formatDay = d3.timeFormat("%a %d"),
          formatWeek = d3.timeFormat("%b %d"),
          formatMonth = d3.timeFormat("%b"),
          formatYear = d3.timeFormat("%Y");
       
       // Define filter conditions
       function multiFormat(date) {
        return (d3.timeSecond(date) < date ? formatMillisecond
          : d3.timeMinute(date) < date ? formatSecond
          : d3.timeHour(date) < date ? formatMinute
          : d3.timeDay(date) < date ? formatHour
          : d3.timeMonth(date) < date ? (d3.timeWeek(date) < date ? formatDay : formatWeek)
          : d3.timeYear(date) < date ? formatMonth
          : formatYear)(date);
       };
       
       const proxyurl = "";
       const urlath = "https://www.binance.com/api/v3/klines?symbol=<?php echo $url_symupper ?>&interval=1M&limit=100";
       
       var promises = [ 
       fetch(proxyurl + urlath) 
       .then(response => response.json())
       ]
       Promise.all(promises).then((results) => { 
       var ath<?php echo $url_symupper ?> = results[0];
       
       var data = [
       
       ...ath<?php echo $url_symupper ?>.map(<?php echo $url_symupper ?> => {return {name: '<?php echo $url_symupper ?>', value: parseFloat(<?php echo $url_symupper ?>[2]), type: '<?php echo $url_symupper ?>'}})
       ]
       
       //console.log(data);
       
      // console.log(Math.max.apply(Math, data.map(function(o) { return o.value; } ) ) );
       athprice = Math.max.apply(Math, data.map(function(o) { return o.value; } ) );
       
	   athprijs.innerHTML = athprice;
	   
       athplace.innerHTML = (((latestprice-athprice)/athprice)*100).toFixed(2) + '%';
       });
	   
	   
function moonCalculator() {


    var moonInput = document.getElementById('moondays');



    //console.log('MoonInput veld ' + moonInput.value);    

    // document.getElementById('mooncalculator').addEventListener('submit', function (e) {

    //     //prevent the normal submission of the form
    //     e.preventDefault();

    //     console.log(nameInput.value);    
    // });

        
           const nowTime = Math.round(Date.now());

           const daysToEpoch = moonInput.value*24*60*60*1000

            function calcInterval (){

                var calculateInterval = nowTime - daysToEpoch;



                //console.log('nowTime ' + nowTime + ' daysToEpoch ' + daysToEpoch + ' calculateInterval ' + calculateInterval);

                if ( daysToEpoch / (60*1000)  < 1000 )
                 {
                     //console.log(daysToEpoch / (60*1000));
                     interval = '1m';
                     varstarttime = calculateInterval-(1*60*1000);  
                     //console.log ('1m');
                     //console.log (varstarttime);
                 }
                else if ( daysToEpoch / (3*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (3*60*1000));
                    interval = '3m';
                    varstarttime = calculateInterval-(3*60*1000);  
                    //console.log ('3m');
                    //console.log (varstarttime);
                }
                else if ( daysToEpoch / (15*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (15*60*1000));
                    interval = '15m';
                    varstarttime = calculateInterval-(15*60*1000);  
                }
                else if ( daysToEpoch / (30*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (30*60*1000));
                    interval = '30m';
                    varstarttime = calculateInterval-(30*60*1000);  
                }
                else if ( daysToEpoch / (60*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (60*60*1000));
                    interval = '1h';
                    varstarttime = calculateInterval-(60*60*1000);  
                }
                else if ( daysToEpoch / (2*60*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (2*60*60*1000));
                    interval = '2h';
                    varstarttime = calculateInterval-(2*60*60*1000);  
                }
                else if ( daysToEpoch / (4*60*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (4*60*60*1000));
                    interval = '4h';
                    varstarttime = calculateInterval-(4*60*60*1000); 
                }
                else if ( daysToEpoch / (8*60*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (8*60*60*1000));
                    interval = '8h';
                    varstarttime = calculateInterval-(8*60*60*1000); 
                }
                else if ( daysToEpoch / (12*60*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (12*60*60*1000));
                    interval = '12h';
                    varstarttime = calculateInterval-(12*60*60*1000); 
                }
                else if ( daysToEpoch / (24*60*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (24*60*60*1000));
                    interval = '1d';
                    varstarttime = calculateInterval-(24*60*60*1000); 
                }
                else if ( daysToEpoch / (3*24*60*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (3*24*60*60*1000));
                    interval = '3d';
                    varstarttime = calculateInterval-(3*24*60*60*1000); 
                }
                else if ( daysToEpoch / (7*24*60*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (7*24*60*60*1000));
                    interval = '1w';
                    varstarttime = calculateInterval-(7*24*60*60*1000); 
                }
                else if ( daysToEpoch / (30*24*60*60*1000)  < 1000 )
                {
                    //console.log(daysToEpoch / (30*24*60*60*1000));
                    interval = '1M';
                    varstarttime = calculateInterval-(30*24*60*60*1000); 
                }

            }


            calcInterval();
             const proxyurl = "";
            const url0 = "https://www.binance.com/api/v3/klines?symbol=<?php echo $url_symupper ?>&interval=" + interval + "&startTime=" + varstarttime + "&limit=1000";
            
            var promises = [ 
            fetch(proxyurl + url0) 
            .then(response => response.json()),
            ]
            Promise.all(promises).then((results) => { 
            var moonresults = results[0];
            //console.log(moonresults);
            // var moondata = [

            // ...moonresults.map(ETHUSDT=> {return {name: 'matic', date: parseDate3(parseDate2(parseInt(ETHUSDT[0]))), open: parseFloat(ETHUSDT[1]), high: parseFloat(ETHUSDT[2]), low: parseFloat(ETHUSDT[3]), value: parseFloat(ETHUSDT[4]), volume:  parseFloat(ETHUSDT[5]),  nooftrades : parseFloat(ETHUSDT[6]), dateint: parseInt(ETHUSDT[0]), type: 'ETHUSDT'}})]

            //     console.log(moondata);
            var moonresultslength = moonresults.length;
            //<div class="nnn1420o1" id="moongains">ago, you would have&nbsp;<div class="nnb1420o1"><span style="color:#0FC441">gained</span></div></div>
            //<div class="nnb2433o1fs" id="moongainsdollar">$4.666<div class="nnn1622o1"><span style="color:#0FC441">120,02%</span><div class="arrowup">▲</div></div></div>
            var moongains= document.getElementById("moongains");
            var moongainsdollar= document.getElementById("moongainsdollar");
            var moonDollar = document.getElementById('moondollar');



            //console.log('MoonDollar veld ' + moonDollar.value); 
            moongains.innerHTML = '';

            moongainsdollar.innerHTML = '';
            cl0 = new Date(parseInt(moonresults[0][0])).toLocaleTimeString('en-US', {
     year: 'numeric',
   month: 'numeric',
   day: 'numeric', 
   hour12: false,
   hour: 'numeric',
   minute: 'numeric',
   second: 'numeric'
});
op0 = new Date(parseInt(moonresults[moonresultslength-1][0])).toLocaleTimeString('en-US', {
   hour12: false,
   hour: 'numeric',
   minute: 'numeric',
   second: 'numeric'
});
            //<div class="nnn1420o1" id="moongains">ago, you would have&nbsp;<div class="nnb1420o1"><span style="color:#0FC441">gained</span></div></div>
            //<div class="nnb2433o1fs" id="moongainsdollar">$4.666<div class="nnn1622o1"><span style="color:#0FC441">120,02%</span><div class="arrowup">▲</div></div></div>
            if ( (parseFloat(moonresults[moonresultslength-1][1])) > (parseFloat(moonresults[0][4])) )
            {   moongains.innerHTML = '<div class="nnn1420o1" id="moongains">ago, you would have&nbsp;<div class="nnb1420o1"><span style="color:#0FC441">gained</span></div></div>';
                moongainsdollar.innerHTML = '<div class="nnb2433o1fs" id="moongainsdollar"> $' /*+ parseFloat(moonresults[0][4]).toFixed(maxCoinLength).replace(/0+$/, "") +  ' usdt, you lost ' */+ (Math.abs((parseFloat(moonresults[moonresultslength-1][1])-parseFloat(moonresults[0][4]))*moonDollar.value/parseFloat(moonresults[0][4]))).toFixed(2) + ' <div class="nnn1622o1"><span style="color:#0FC441">'+ (Math.abs((parseFloat(moonresults[moonresultslength-1][1])-parseFloat(moonresults[0][4]))*100/parseFloat(moonresults[0][4]))).toFixed(2) + '%</span><div class="arrowup"><p>&#9650;</p></div></div></div>' /* + (0 == 0 ? ' today at ' +  op0  : '<br /> ' ) */
            }
            else {
                moongains.innerHTML =  '<div class="nnn1420o1" id="moongains">ago, you would have&nbsp;<div class="nnb1420o1"><span style="color:#EB2020">lost</span></div></div>';
                moongainsdollar.innerHTML = '<div class="nnb2433o1fs" id="moongainsdollar"> $' /*+ parseFloat(moonresults[0][4]).toFixed(maxCoinLength).replace(/0+$/, "") +  ' usdt, you lost '*/ + (Math.abs((parseFloat(moonresults[moonresultslength-1][1])-parseFloat(moonresults[0][4]))*moonDollar.value/parseFloat(moonresults[0][4]))).toFixed(2) + ' <div class="nnn1622o1"><span style="color:#EB2020">'+ (Math.abs((parseFloat(moonresults[moonresultslength-1][1])-parseFloat(moonresults[0][4]))*100/parseFloat(moonresults[0][4]))).toFixed(2) + '%</span><div class="arrowdown"><p>&#9660;</p></div></div></div>' /* + (0 == 0 ? ' today at ' +  op0  : '<br /> ' ) */
            }

            })
}

</script> 
<script>
function moonConvertersymbol1() {


var moonconvertersymbol1Input = document.getElementById('moonconvertersymbol1');

var moonconvertersymbol2Input = document.getElementById('moonconvertersymbol2');

if (moonconvertersymbol1Input.value == null) {
    console.log('moonconvertersymbol1Input.value == null');
    moonconvertersymbol2Input.value = null;
}

if (moonconvertersymbol1Input.value == '') {
    console.log('moonconvertersymbol1Input.value == "');
    moonconvertersymbol2Input.value = 0;
    console.log('moonconvertersymbol2Input.value = ' + moonconvertersymbol2Input.value);
}

if (moonconvertersymbol1Input.value !== null || moonconvertersymbol1Input.value != '') {
    //console.log('moonconvertersymbol1Input veld ' + moonconvertersymbol1Input.value);
    //console.log('latestprice ' + latestprice);
    //console.log(moonconvertersymbol1Input.value*latestprice)
    if ( moonconvertersymbol1Input.value*latestprice > 1000 ) 
    {
        moonconvertersymbol2.value =  (moonconvertersymbol1Input.value*latestprice).toFixed(0);
    }
   
    if ( moonconvertersymbol1Input.value*latestprice > 100 && moonconvertersymbol1Input.value*latestprice <= 1000) 
    {
        moonconvertersymbol2.value =  (moonconvertersymbol1Input.value*latestprice).toFixed(2);
    }
    
    if (  moonconvertersymbol1Input.value*latestprice > 1 && moonconvertersymbol1Input.value*latestprice <= 100 ) 
    {
        moonconvertersymbol2.value =  (moonconvertersymbol1Input.value*latestprice).toFixed(3);
    }

    if ( moonconvertersymbol1Input.value*latestprice <  1 &&  moonconvertersymbol1Input.value*latestprice >= 0.1) 
    {
        moonconvertersymbol2.value =  (moonconvertersymbol1Input.value*latestprice).toFixed(4);
    }
    
    if ( moonconvertersymbol1Input.value*latestprice < 0.1 &&  moonconvertersymbol1Input.value*latestprice >= 0.01)
    {
        moonconvertersymbol2.value =  (moonconvertersymbol1Input.value*latestprice).toFixed(5);
    }

    if ( moonconvertersymbol1Input.value*latestprice < 0.01 &&  moonconvertersymbol1Input.value*latestprice >= 0.001)
    {
        moonconvertersymbol2.value =  (moonconvertersymbol1Input.value*latestprice).toFixed(6);
    }

    if ( moonconvertersymbol1Input.value*latestprice < 0.001 &&  moonconvertersymbol1Input.value*latestprice >= 0.0001)
    {
        moonconvertersymbol2.value =  (moonconvertersymbol1Input.value*latestprice).toFixed(7);
    }

    if ( moonconvertersymbol1Input.value*latestprice < 0.0001 )
    {
        moonconvertersymbol2.value =  (moonconvertersymbol1Input.value*latestprice).toFixed(8);
    }

    
}
}

</script>    
<script>
function moonConvertersymbol2() {


var moonconvertersymbol1Input = document.getElementById('moonconvertersymbol1');

var moonconvertersymbol2Input = document.getElementById('moonconvertersymbol2');

if (moonconvertersymbol2Input.value == null) {
    moonconvertersymbol1Input.value = null;
}

if (moonconvertersymbol2Input.value == '') {
    moonconvertersymbol1Input.value = '';
}

if (moonconvertersymbol2Input.value !== null || moonconvertersymbol2Input.value != '') {
    //console.log('moonconvertersymbol2Input veld ' + moonconvertersymbol2Input.value);
    //console.log('latestprice ' + latestprice);
    //console.log(moonconvertersymbol2Input.value/latestprice)
    moonconvertersymbol1.value =  moonconvertersymbol2Input.value/latestprice 
    if ( moonconvertersymbol2Input.value/latestprice  > 1000 ) 
    {
        moonconvertersymbol1.value =  (moonconvertersymbol2Input.value/latestprice ).toFixed(0);
    }
   
    if ( moonconvertersymbol2Input.value/latestprice  > 100 && moonconvertersymbol2Input.value/latestprice  <= 1000) 
    {
        moonconvertersymbol1.value =  (moonconvertersymbol2Input.value/latestprice ).toFixed(2);
    }
    
    if (  moonconvertersymbol2Input.value/latestprice  > 1 && moonconvertersymbol2Input.value/latestprice  <= 100 ) 
    {
        moonconvertersymbol1.value =  (moonconvertersymbol2Input.value/latestprice ).toFixed(3);
    }

    if ( moonconvertersymbol2Input.value/latestprice  <  1 &&  moonconvertersymbol2Input.value/latestprice  >= 0.1) 
    {
        moonconvertersymbol1.value =  (moonconvertersymbol2Input.value/latestprice ).toFixed(4);
    }
    
    if ( moonconvertersymbol2Input.value/latestprice  < 0.1 &&  moonconvertersymbol2Input.value/latestprice  >= 0.01)
    {
        moonconvertersymbol1.value =  (moonconvertersymbol2Input.value/latestprice ).toFixed(5);
    }

    if ( moonconvertersymbol2Input.value/latestprice  < 0.01 &&  moonconvertersymbol2Input.value/latestprice  >= 0.001)
    {
        moonconvertersymbol1.value =  (moonconvertersymbol2Input.value/latestprice ).toFixed(6);
    }

    if ( moonconvertersymbol2Input.value/latestprice  < 0.001 &&  moonconvertersymbol2Input.value/latestprice  >= 0.0001)
    {
        moonconvertersymbol1.value =  (moonconvertersymbol2Input.value/latestprice ).toFixed(7);
    }

    if ( moonconvertersymbol2Input.value/latestprice  < 0.0001 )
    {
        moonconvertersymbol1.value =  (moonconvertersymbol2Input.value/latestprice ).toFixed(8);
    }
}

}

</script>    
<script>   


       function updateData(param) {

        console.log('updateData executed');
       
       const nowTime = Math.round(Date.now());
       
       var varstarttime;
       if (param === '15m')
           {
       varstarttime = nowTime - ((15*60*1000)+(1*60*1000));  
       interval = '1m';  
       explain = '15 minutes';    
           }
       else if(param === '1h')
           {
               varstarttime = nowTime - ((60*60*1000)+(1*60*1000));  
               interval = '1m';  
               explain = '1 hour';  
           }
       else if(param === '4h')
           {
               varstarttime = nowTime - ((4*60*60*1000)+(1*60*1000));  
               interval = '1m';  
               explain = '4 hours';  
           }
       else if(param === '8h')
           {
               varstarttime = nowTime - ((8*60*60*1000)+(1*60*1000)); 
               interval = '1m';  
               explain = '8 hours';  
           }
       else if(param === '12h')
           {
               varstarttime = nowTime - ((12*60*60*1000)+(1*60*1000)); 
               interval = '1m';  
               explain = '12 hours';  
           }
       else if(param === '1d')
           {
               varstarttime = nowTime - ((24*60*60*1000)+(3*60*1000)); 
               interval = '3m';  
               explain = '1 day';  
               
           }
       else if(param === '3d')
           {
               varstarttime = nowTime - ((3*24*60*60*1000)+(15*60*1000)); 
               interval = '15m'; 
               explain = '3 days';   
           }
       else if(param === '7d')
       {
           varstarttime = nowTime - ((7*24*60*60*1000)+(15*60*1000)); 
           interval = '15m';  
           explain = '1 week'; 
       }
       else if(param === '14d')
       {
           varstarttime = nowTime - ((14*24*60*60*1000)+(30*60*1000)); 
           interval = '30m';  
           explain = '2 weeks';  
       }
       else if(param === '30d')
       {
           varstarttime = nowTime - ((30*24*60*60*1000)+(60*60*1000)); 
           interval = '1h';  
           explain = '1 month' ; 
       }
       else if(param === '180d')
       {
           varstarttime = nowTime - ((180*24*60*60*1000)+(8*60*60*1000)); 
           interval = '8h';  
           explain = '180 days';  
       }
       else if(param === '1y')
       {
           varstarttime = nowTime - ((365*24*60*60*1000)+(8*60*60*1000)); 
           interval = '12h';  
           explain = '1 year';  
       }
       else if(param === '2y')
       {
           varstarttime = nowTime - ((730*24*60*60*1000)+(24*60*60*1000)); 
           interval = '1d';  
           explain = '2 years';  
       }
       else if(param === 'all')
       {
           varstarttime = nowTime - ((5*730*24*60*60*1000)+(7*24*60*60*1000)); 
           interval = '1w';  
           explain = 'long time';
       }
       
       const proxyurl = "";
const url0 = "https://www.binance.com/api/v3/klines?symbol=ETHUSDT&interval=" + interval + "&startTime=" + varstarttime + "&limit=1000";
const url1 = "https://www.binance.com/api/v3/klines?symbol=BTCUSDT&interval=" + interval + "&startTime=" + varstarttime + "&limit=1000";
var promises = [ 
fetch(proxyurl + url0) 
.then(response => response.json()),
fetch(proxyurl + url1) 
.then(response => response.json()),
]
Promise.all(promises).then((results) => { 
var klineETHUSDT = results[0];
var klineBTCUSDT = results[1];
var data = [


...klineETHUSDT.map(BTCUSDT=> {return {name: 'eth', date: parseDate3(parseDate2(parseInt(BTCUSDT[0]))), open: parseFloat(BTCUSDT[1]), high: parseFloat(BTCUSDT[2]), low: parseFloat(BTCUSDT[3]), value: parseFloat(BTCUSDT[4]), volume:  parseFloat(BTCUSDT[5]),  nooftrades : parseFloat(BTCUSDT[6]), dateint: parseInt(BTCUSDT[0]), type: 'BTCUSDT'}}),

...klineBTCUSDT.map(BTCUSDT=> {return {name: 'btc', date: parseDate3(parseDate2(parseInt(BTCUSDT[0]))), open: parseFloat(BTCUSDT[1]), high: parseFloat(BTCUSDT[2]), low: parseFloat(BTCUSDT[3]), value: parseFloat(BTCUSDT[4]), volume:  parseFloat(BTCUSDT[5]),  nooftrades : parseFloat(BTCUSDT[6]), dateint: parseInt(BTCUSDT[0]), type: 'BTCUSDT'}})]


       var explain_value = document.getElementById("explain_placeholder");
       explain_value.innerHTML = '';

       explain_value.innerHTML = explain_value.innerHTML + 'If you invested 100 dollar ' + explain + ' ago in '+ '<br />'
var klineETHUSDTlength = results[0].length;
cl0 = new Date(parseInt(results[0][0][0])).toLocaleTimeString('en-US', {
     year: 'numeric',
   month: 'numeric',
   day: 'numeric', 
   hour12: false,
   hour: 'numeric',
   minute: 'numeric',
   second: 'numeric'
});
op0 = new Date(parseInt(results[0][klineETHUSDTlength-1][0])).toLocaleTimeString('en-US', {
   hour12: false,
   hour: 'numeric',
   minute: 'numeric',
   second: 'numeric'
});


if ( (parseFloat(results[0][klineETHUSDTlength-1][1])) > (parseFloat(results[0][0][4])) )
  { 
explain_value.innerHTML = explain_value.innerHTML + '...Ethereum at price ' + parseFloat(results[0][0][4]).toFixed(maxCoinLength).replace(/0+$/, "")+  ' usdt, you earned ' + ((parseFloat(results[0][klineETHUSDTlength-1][1])-parseFloat(results[0][0][4]))*100/parseFloat(results[0][0][4])).toFixed(2) + ' dollar'  + (0 == 0 ? ' today at ' +  op0  + '<br />' : '<br /> ')
}
else {
explain_value.innerHTML = explain_value.innerHTML + '...Ethereum at price ' + parseFloat(results[0][0][4]).toFixed(maxCoinLength).replace(/0+$/, "")+  ' usdt, you lost ' + ((parseFloat(results[0][klineETHUSDTlength-1][1])-parseFloat(results[0][0][4]))*100/parseFloat(results[0][0][4])).toFixed(2) + ' dollar'  + (0 == 0 ? ' today at ' +  op0  + '<br />' : '<br /> ')
}
var klineBTCUSDTlength = results[1].length;
cl1 = new Date(parseInt(results[1][0][0])).toLocaleTimeString('en-US', {
     year: 'numeric',
   month: 'numeric',
   day: 'numeric', 
   hour12: false,
   hour: 'numeric',
   minute: 'numeric',
   second: 'numeric'
});
op1 = new Date(parseInt(results[1][klineBTCUSDTlength-1][0])).toLocaleTimeString('en-US', {
   hour12: false,
   hour: 'numeric',
   minute: 'numeric',
   second: 'numeric'
});


if ( (parseFloat(results[1][klineBTCUSDTlength-1][1])) > (parseFloat(results[1][0][4])) )
  { 
explain_value.innerHTML = explain_value.innerHTML + '...Bitcoin at price ' + parseFloat(results[1][0][4]).toFixed(maxCoinLength).replace(/0+$/, "")+  ' usdt, you earned ' + ((parseFloat(results[1][klineBTCUSDTlength-1][1])-parseFloat(results[1][0][4]))*100/parseFloat(results[1][0][4])).toFixed(2) + ' dollar'  + (1 == 0 ? ' today at ' +  op1  + '<br />' : '<br /> ')
}
else {
explain_value.innerHTML = explain_value.innerHTML + '...Bitcoin at price ' + parseFloat(results[1][0][4]).toFixed(maxCoinLength).replace(/0+$/, "")+  ' usdt, you lost ' + ((parseFloat(results[1][klineBTCUSDTlength-1][1])-parseFloat(results[1][0][4]))*100/parseFloat(results[1][0][4])).toFixed(2) + ' dollar'  + (1 == 0 ? ' today at ' +  op1  + '<br />' : '<br /> ')
}

       
       svg2.selectAll('g').remove();   
       var start;
       var end;
       



       var series = d3.groups(data, d => d.name).map(([key, values]) => {
          const v = values[0].value;
          return {key, values: values.map(({date, open, high, low, close, value, volume, nooftrades, name, dateint}) => ({date, open: open, high: high, low: low, close: value, value: value / v, volume: volume, nooftrades: nooftrades, name: name, price: value, dateint: dateint}))};
          })
       

          var dt = new Date();
         var tz = dt.getTimezoneOffset(); 
         tz = -(tz * 60);
         //console.log(tz);

          var dataohlc = [

...klineETHUSDT.map(BTCUSDT=> {return {close: parseFloat(BTCUSDT[4]).toFixed(maxCoinLength), high: parseFloat(BTCUSDT[2]).toFixed(maxCoinLength), low: parseFloat(BTCUSDT[3]).toFixed(maxCoinLength), open: parseFloat(BTCUSDT[1]).toFixed(maxCoinLength), time: parseInt((BTCUSDT[0]/1000)+tz) }}), ]

          var datahistogram = [

...klineETHUSDT.map(BTCUSDT=> {return {color: (parseFloat(BTCUSDT[1]).toFixed(maxCoinLength) > parseFloat(BTCUSDT[4]).toFixed(8)) ? "#ef5350" : "#26a69a", value: parseFloat(BTCUSDT[5]).toFixed(0), time: parseInt((BTCUSDT[0]/1000)+tz) }}), ]

          var dataarea = [

...klineETHUSDT.map(BTCUSDT=> {return {value: parseFloat(BTCUSDT[1]).toFixed(maxCoinLength), time: parseInt((BTCUSDT[0]/1000)+tz) }}), ]

          /*
          var dataohlc = [

...klineADAUSDT.map(ETHUSDT=> {return {close: parseFloat(ETHUSDT[4]).toFixed(maxCoinLength), high: parseFloat(ETHUSDT[2]).toFixed(maxCoinLength), low: parseFloat(ETHUSDT[3]).toFixed(maxCoinLength), open: parseFloat(ETHUSDT[1]).toFixed(maxCoinLength), time: parseInt((ETHUSDT[0]/1000)+tz) }}),
]

var datahistogram = [

...klineADAUSDT.map(ETHUSDT=> {return {color: (parseFloat(ETHUSDT[1]).toFixed(maxCoinLength) > parseFloat(ETHUSDT[4]).toFixed(8)) ? "#ef5350" : "#26a69a", value: parseFloat(ETHUSDT[5]).toFixed(0), time: parseInt((ETHUSDT[0]/1000)+tz) }}),
]

var dataarea = [

...klineADAUSDT.map(ETHUSDT=> {return { value: parseFloat(ETHUSDT[1]).toFixed(maxCoinLength), time: parseInt((ETHUSDT[0]/1000)+tz) }}),
] */
      // console.log(datahistogram);

/*        chart.addLineSeries({
	color: 'rgba(4, 111, 232, 1)',
	lineWidth: 2,
}).setData([
{ time: 1618919888, value: 25.41022485894306 },
{ time: 1618919892, value: 25.134847363259958 },
{ time: 1618919898, value: 24.239250761300525 }
]); */







    areaSeries.setData(dataarea);






	candlestickSeries.setData(dataohlc);


    volumeHistogram.setData(datahistogram);


    chart.timeScale().fitContent();

    chart2.timeScale().fitContent();

   // console.log(candlestickSeries._series._priceScale.rn.ct);

    

/* const candlestickSeries = chart.addCandlestickSeries({ priceScaleId: 'left' });
	candlestickSeries.setData([
{ close: 96.80120024431532, high: 101.92074283374939, low: 89.25819769856513, open: 89.25819769856513, time: 1618919888 },
{ close: 94.87113928076117, high: 104.12503365679314, low: 85.42405005240111, open: 104.12503365679314, time: 1618919892 },
{ close: 100.76494087674855, high: 102.60508417239113, low: 80.76268547064865, open: 92.93299948659636, time: 1618919898 }
]); */


format = date =>
         date.toLocaleString("en-US", {
           weekday: "short",
           month: "short",
           year: "numeric",
           day: "numeric",
           hour: "numeric",
           minute: "numeric"
         })
       
       var xAxis = d3.axisBottom()
       .scale(x)
       .tickFormat(multiFormat);
       
       var xAxis = g => g
       .attr("transform", `translate(0,${svgSize2.height - margin2.bottom - 10})`)
       .call(d3.axisBottom(x).ticks(8).tickSizeOuter(0))
       .call(g => g.select(".domain").remove())
       
       // var xAxis = d3.axisBottom()
       // .scale(x)
       // .tickFormat(multiFormat(new Date('2020-06-24T09:00:00')));
       
       // var xAxis = g => g
       // .attr("transform", `translate(0,${svgSize2.height - margin2.bottom})`)
       // .call(d3.axisBottom(x).ticks(9).scale(x).tickFormat(multiFormat).tickSizeOuter(0))
       // .call(g => g.select(".domain").remove())
       
       var yAxis = g => g
       .attr("transform", `translate(${margin2.left},0)`)
       .call(d3.axisLeft(y)
          .ticks(null, x => +x.toFixed(6) + "x"))
       .call(g => g.selectAll(".tick line").clone()
          .attr("stroke-opacity", d => d === 1 ? null : 0.2)
          .attr("x2", svgSize2.width - margin2.left - margin2.right))
       .call(g => g.select(".domain").remove());
       
       var bisect = d3.bisector(d => d.date).left;
       
       var z = d3.scaleOrdinal(d3.schemeCategory10).domain(data.map(d => d.name));
       
       var k = d3.max(d3.group(data, d => d.name), ([, group]) => d3.max(group, d => d.value) / d3.min(group, d => d.value));
       
       var y = d3.scaleLog()
          .domain([1 / k, k])
          .rangeRound([svgSize2.height - margin2.bottom, margin2.top]);
       
       var x = d3.scaleUtc()
          .domain(d3.extent(data, d => d.date))
          .range([margin2.left, svgSize2.width - margin2.right])
          .clamp(true);
       
       var line = d3.line()
          .x(d => x(d.date))
          .y(d => y(d.value));
       
       
       svg2.append("g")
          .call(xAxis);
       
       svg2.append("g")
          .call(yAxis);
       
       const rule = svg2.append("g")
       .append("line")
          .attr("y1", svgSize2.height)
          .attr("y2", 0)
          .attr("stroke", "lightgrey");
       
       const serie = svg2.append("g")
       .style("font", "normal 11px Trebuchet MS,roboto, ubuntu")  //text size van eth, btc , vet aan rechtkant grafiek
       .selectAll("g")
       .data(series)
       .join("g");
       
       
       serie.append("path")
          .attr("fill", "none")
          .attr("stroke-width", 1)
          .attr("stroke-linejoin", "round")
          .attr("stroke-linecap", "round")
          .attr("stroke", d => z(d.key))
          .attr("d", d => line(d.values))
       
       
       serie.append("text")
          .datum(d => ({key: d.key, value: d.values[d.values.length - 1].value}))
          .attr("fill", "none")
         // .attr("stroke", "black")
         // .attr("stroke-width", 3)
          .attr("x", x.range()[1] + 3)
          .attr("y", d => y(d.value))
          .attr("dy", "0.35em")
          .text(d => d.key)
           .clone(true)
          .attr("fill", d => z(d.key))
          .attr("stroke", null);
       
       d3.transition()
          .ease(d3.easeCubicOut)
          .duration(0)
          .tween("date", () => {
          const i = d3.interpolateDate(x.domain()[1], x.domain()[0]);
          return t => update(i(t));
          });
       
          var tooltipdate = svg2.append("g")
           .append("text")
           // .style("position", "absolute")
          .attr("font-family", "Trebuchet MS,roboto, ubuntu")
          .attr("x", 45 )
           .attr("y", 1)
           .attr("dy", "11px")
           .attr("fill", "lightgrey")
           .attr("text-anchor", "start")
           .attr("font-size", "1.1em")
           .attr("font-weight", "bold")
       
          var tooltip = svg2.append("g")
           .append("text")
           // .style("position", "absolute")
          .attr("font-family", "Trebuchet MS,roboto, ubuntu")
          .attr("x", 45 )
           .attr("y", 16)
           .attr("dy", "11px")
           .attr("fill", "lightgrey")
           .attr("text-anchor", "start")
           .attr("font-size", "1.1em")
       
           var tooltip2 = svg2.append("g")
           .append("text")
           // .style("position", "absolute")
          .attr("font-family", "Trebuchet MS,roboto, ubuntu")
          .attr("x", 45 )
           .attr("y", 31)
           .attr("dy", "11px")
           .attr("fill", "lightgrey")
           .attr("text-anchor", "start")
           .attr("font-size", "1.1em")
       
           var tooltip3 = svg2.append("g")
           .append("text")
           // .style("position", "absolute")
          .attr("font-family", "Trebuchet MS,roboto, ubuntu")
          .attr("x", 45 )
           .attr("y", 46)
           .attr("dy", "11px")
           .attr("fill", "lightgrey")
           .attr("text-anchor", "start")
           .attr("font-size", "1.1em")
       
           var tooltipsecondline = svg2.append("g")
           .append("text")
           // .style("position", "absolute")
          .attr("font-family", "Trebuchet MS,roboto, ubuntu")
          .attr("x", 170 )
           .attr("y", 16)
           .attr("dy", "11px")
           .attr("fill", "lightgrey")
           .attr("text-anchor", "start")
           .attr("font-size", "1.1em")
       
           var tooltip2secondline = svg2.append("g")
           .append("text")
           // .style("position", "absolute")
          .attr("font-family", "Trebuchet MS,roboto, ubuntu")
          .attr("x", 170 )
           .attr("y", 31)
           .attr("dy", "11px")
           .attr("fill", "lightgrey")
           .attr("text-anchor", "start")
           .attr("font-size", "1.1em")
       
           var tooltip3secondline = svg2.append("g")
           .append("text")
           // .style("position", "absolute")
          .attr("font-family", "Trebuchet MS,roboto, ubuntu")
          .attr("x", 170 )
           .attr("y", 46)
           .attr("dy", "11px")
           .attr("fill", "lightgrey")
           .attr("text-anchor", "start")
           .attr("font-size", "1.1em")
       
         function update(date) {
           rule.attr("transform", `translate(${x(date) + 0.5},0)`);
           serie.attr("transform", ({values}) => {
           const i = bisect(values, date, 0, values.length - 1);
           //console.log( parseDate(values[i].dateint), date, y(values[i].value),  y(values[0].value), values[i].value, values[0].value, values[i].name, values[i].price );
           //console.log(values[i].name);
       
          // console.log( parseDate(values[i].dateint) + ' ' + date + ' ' + y(values[i].value) + ' ' + y(values[0].value) + ' ' + values[i].value, values[0].value + ' ' + ((values[i].value- values[0].value)/values[0].value)*100 + ' ' + values[i].name + ' ' +  values[i].price );
       
           tooltipdate.text( parseDate2(values[i].dateint) ) ;
       
       
           if (values[i].name == 'btc') 
           {
          // tooltip.text( y(values[i].value) +  ' ' + y(values[0].value) +  ' ' +values[i].value +  ' ' + values[0].value +  ' ' + values[i].name +  ' ' +values[i].price);
           tooltip
           .text( values[i].name +  ' ' + values[i].price + ' ' + parseFloat(((values[i].value- values[0].value)/values[0].value)*100).toFixed(2) + '%' )
           .style("fill", function(d) {
               if (((values[i].value- values[0].value)/values[0].value)*100 < 0) {return "#FF0000"}
                   else 	{ return "#29CB1C" }
               ;})
       
           tooltipsecondline.text(  'Open: ' + values[i].open + ' High: ' + values[i].high + ' Low: ' + values[i].low + ' Close: ' + values[i].price) // + ' Volume: ' + values[i].volume  + ' N° Trades: ' + values[i].nooftrades) 
       
           }
       
           if (values[i].name == 'eth') 
           {
           tooltip2
           .text( values[i].name +  ' ' + values[i].price + ' ' + parseFloat(((values[i].value- values[0].value)/values[0].value)*100).toFixed(2) + '%' )
           .style("fill", function(d) {
               if (((values[i].value- values[0].value)/values[0].value)*100 < 0) {return "#FF0000"}
                   else 	{ return "#29CB1C" }
               ;})
       
           tooltip2secondline.text(  'Open: ' + values[i].open + ' High: ' + values[i].high + ' Low: ' + values[i].low + ' Close: ' + values[i].price) //  + ' Volume: ' + values[i].volume + ' N° Trades: ' + values[i].nooftrades) 
       
           }
       
           if (values[i].name != 'btc' && values[i].name != 'eth') 
           {
           tooltip3
           .text( values[i].name +  ' ' + values[i].price + ' ' + parseFloat(((values[i].value- values[0].value)/values[0].value)*100).toFixed(2) + '%' )
           .style("fill", function(d) {
               if (((values[i].value- values[0].value)/values[0].value)*100 < 0) {return "#FF0000"}
                   else 	{ return "#29CB1C" }
               ;})
       
           tooltip3secondline.text(  'Open: ' + values[i].open + ' High: ' + values[i].high + ' Low: ' + values[i].low + ' Close: ' + values[i].price) //  + ' Volume: ' + values[i].volume + ' N° Trades: ' + values[i].nooftrades) 
       
           }
       
           return `translate(0,${y(1) - y(values[i].value / values[0].value)})`;
       
       
           });
       
           svg2.property("value", date).dispatch("input");
       }
       
       function moved(event) {
       update(x.invert(d3.pointer(event, this)[0]));
       //console.log(serie);
       }
       
       //update(x.domain()[0]);
       
       svg2.on("mousemove touchmove", moved);
       
       
       
       return svg2.node()
       })
       
       
        //NIET NODIG TE REFRESHEN  return foo2;
       }
       
       updateData('1d');
       moonCalculator();
       moonConvertersymbol2();
       
       
</script>
<script>
    $(document).ready(function() {
        (function update() {

        $.ajax({
                url: "/load_small_capsgainers.php",
                method: "POST",
                dataType: "Text",
                success: function(data)
                {
                    if ( data != '')
                    {
                        $('.listsmallcapsgainers').empty();
                        //console.log('Refresh .listsmallcapsgainers');
                        $('.listsmallcapsgainers').append(data);
                        //$('#cryptoall').html("All Cryptocurrencies");
                    }
                    else
                    {
                       // $('#cryptoall').html("Top 20");    
                    }
                }                    // pass existing options
            }).then(function() {           // on completion, restart
            setTimeout(update, 60000);  // function refers to itself
            });
        })();  
            });
</script> 
<script>
    $(document).ready(function() {
        (function update() {

        $.ajax({
                url: "/load_small_capslosers.php",
                method: "POST",
                dataType: "Text",
                success: function(data)
                {
                    if ( data != '')
                    {
                        $('.listsmallcapslosers').empty();
                        //console.log(data);
                        //console.log('Refresh .listsmallcapslosers');
                        $('.listsmallcapslosers').append(data);
                        //$('#cryptoall').html("All Cryptocurrencies");
                    }
                    else
                    {
                       // $('#cryptoall').html("Top 20");    
                    }
                }                    // pass existing options
            }).then(function() {           // on completion, restart
            setTimeout(update, 60000);  // function refers to itself
            });
        })();  
            });
</script> 
<script>
    $(document).ready(function() {
        (function update() {

        $.ajax({
                url: "/load_gainers.php",
                method: "POST",
                dataType: "Text",
                success: function(data)
                {
                    if ( data != '')
                    {
                        $('.listgainers').empty();
                        //console.log(data);
                        //console.log('Refresh .listgainers');
                        $('.listgainers').append(data);
                        //$('#cryptoall').html("All Cryptocurrencies");
                    }
                    else
                    {
                       // $('#cryptoall').html("Top 20");    
                    }
                }                    // pass existing options
            }).then(function() {           // on completion, restart
            setTimeout(update, 60000);  // function refers to itself
            });
        })();  
            });
</script> 
<script>
    $(document).ready(function() {
        (function update() {

        $.ajax({
                url: "/load_losers.php",
                method: "POST",
                dataType: "Text",
                success: function(data)
                {
                    if ( data != '')
                    {
                        $('.listlosers').empty();
                        //console.log(data);
                        //console.log('Refresh .listlosers');
                        $('.listlosers').append(data);
                        //$('#cryptoall').html("All Cryptocurrencies");
                    }
                    else
                    {
                       // $('#cryptoall').html("Top 20");    
                    }
                }                    // pass existing options
            }).then(function() {           // on completion, restart
            setTimeout(update, 60000);  // function refers to itself
            });
        })();  
            });
</script> 
<script>
$(document).ready(function(){
    var Input = $('input[name=moondays]');
    var default_value = Input.val();
    //console.log('DEFAULT' + default_value);
    Input.focus(function() {
        if (Input.val() == default_value) {
            Input.val("");
        }}).blur(function(){
        if(Input.val().length == 0) {
            Input.val(default_value);
        }});
}); 
</script> 
<script>
$(document).ready(function(){
    var Input = $('input[name=moondollar]');
    var default_value2 = Input.val();
    //console.log('DEFAULT' + default_value);
    Input.focus(function() {
        if (Input.val() == default_value2) {
            Input.val("");
        }}).blur(function(){
        if(Input.val().length == 0) {
            Input.val(default_value2);
        }});
}); 
</script> 
<script>
$(document).ready(function(){
    var Input = $('input[name=moonconvertersymbol1]');
    var default_value2 = Input.val();
    //console.log('DEFAULT' + default_value);
    Input.focus(function() {
        if (Input.val() == default_value2) {
            Input.val("");
        }}).blur(function(){
        if(Input.val().length == 0) {
            Input.val(default_value2);
        }});
}); 
</script> 
<script>
$(document).ready(function(){
    var Input = $('input[name=moonconvertersymbol2]');
    var default_value2 = Input.val();
    //console.log('DEFAULT' + default_value);
    Input.focus(function() {
        if (Input.val() == default_value2) {
            Input.val("");
        }}).blur(function(){
        if(Input.val().length == 0) {
            Input.val(default_value2);
        }});
}); 
</script> 

<script>
    $(document).ready(function() {
        console.log('documentready');
        // (function update() {

        // $.ajax({
        //         url: "load_losers.php",
        //         method: "POST",
        //         dataType: "Text",
        //         success: function(data)
        //         {
        //             if ( data != '')
        //             {
        //                 $('.listlosers').empty();
        //                 //console.log(data);
        //                 //console.log('Refresh .listlosers');
        //                 $('.listlosers').append(data);
        //                 //$('#cryptoall').html("All Cryptocurrencies");
        //             }
        //             else
        //             {
        //                // $('#cryptoall').html("Top 20");    
        //             }
        //         }                    // pass existing options
        //     }).then(function() {           // on completion, restart
        //     setTimeout(update, 60000);  // function refers to itself
        //     });
        // })(); 
        //setInterval(function(){ console.log("Hello"); }, 3000);
        window.setInterval('updateData("1d")', 120000);
            });
</script>
       <script>
       $(document).ready(function(){
   $('.timeframe').on('click', function(){
     $('.timeframe').removeClass('active-link');
     $(this).addClass('active-link');
   })
       }); 
       </script>
</html>
