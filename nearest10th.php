
<!DOCTYPE html>
<html>
    <head>
        <title>Coin Calculator </title>
       
    </head>
    <body>
        <h1>Coin Calculator</h1>
        <p>Enter a value below and click the button to calculate the minimum amount of coins that can be used to make this amount.</p>
        <form class="coin-calculator" action="#">
            <input type="text" name="money" required/>
            <input type="submit" value="Calculate"/>
        </form>
        <h2>Coin Denominations</h2>
        <p>The Amount you entered in dollars: <span class="coin-denomination-amount">0</span></p>
        <h3>Here are the coins you need to make this amount</h3>
        <ul class="coin-denominations">
            <li class="coin-denominations-item">dollar: <span class="coin-denomination-two-pound">0</span></li>
            <li class="coin-denominations-item">50h: <span class="coin-denomination-one-pound">0</span></li>
            <li class="coin-denominations-item">25q: <span class="coin-denomination-fifty-pence">0</span></li>
            <li class="coin-denominations-item">10d: <span class="coin-denomination-twenty-pence">0</span></li>
            <li class="coin-denominations-item">5n: <span class="coin-denomination-two-pence">0</span></li>
            <li class="coin-denominations-item">1p: <span class="coin-denomination-one-pence">0</span></li>
        </ul>
        <script data-main="js/calculate" src="js/require-jquery.js"></script>
    </body>
</html>

<?php 
function have_need($have,$coin_value,$max){
   
    if($have < $coin_value) return(0);
    while(1){
        if($have >= ($max * $coin_value)) return($max);
        $max--;
    }
}
function have_want($have,$coin_value,$max){
    
    if($have < $coin_value) return($have);
    while(1){
        if($have >= ($max * $coin_value)) return($have - ($max * $coin_value));
        $max--;
    }
}
print("<table border=\"2\">");
print("<tr><th align=\"center\"><strong>Dollars</strong></th>");
print("<th align=\"center\"><strong>Half Dollar Coins</strong></th>");
print("<th align=\"center\"><strong>Quarters</strong></th>");
print("<th align=\"center\"><strong>Dimes</strong></th>");
print("<th align=\"center\"><strong>Nickels</strong></th>");
print("<th align=\"center\"><strong>Pennies</strong></th></tr>");


$have = 417;
$have0 = have_want($have,100,1);
$have1 = have_want($have0,50,2);
$have2 = have_want($have1,25,4);
$have3 = have_want($have2,10,10);
$have4 = have_want($have3,5,20);
print ('<tr><td align="right">'.have_need($have,100,1).'</td>');
print ('<td align="right">'.have_need($have0,50,2).'</td>');
print ('<td align="right">'.have_need($have1,25,4).'</td>');
print ('<td align="right">'.have_need($have2,10,10).'</td>');
print ('<td align="right">'.have_need($have3,5,20).'</td>');
print ('<td align="right">'.have_need($have4,1,100).'</td></tr>');
?>