<?php
function denoinations()
class Program
{

    //Allowable denominations
    const int penny = 1;
    const int nickel = 5;
    const int dime = 10;
    const int quarter = 25;

    const int maxCurrencyLevelForTest =55; //1-n where n<=99

    static void Main(string[] args)
    {         
        int minPenniesNeeded = 0;
        int minNickelsNeeded = 0; 
        int minDimesNeeded = 0; 
        int minQuartersNeeded = 0;


        if (maxCurrencyLevelForTest == penny)
        {
            minPenniesNeeded = 1;
        }
        else if (maxCurrencyLevelForTest < nickel)
        {
            minPenniesNeeded = MinCountNeeded(penny, maxCurrencyLevelForTest);                
        }
        else if (maxCurrencyLevelForTest < dime)
        {
            minPenniesNeeded = MinCountNeeded(penny, nickel - 1);
            minNickelsNeeded = MinCountNeeded(nickel, maxCurrencyLevelForTest);                
        }
        else if (maxCurrencyLevelForTest < quarter)
        {
            minPenniesNeeded = MinCountNeeded(penny, nickel - 1);
            minNickelsNeeded = MinCountNeeded(nickel, dime - 1);
            minDimesNeeded = MinCountNeeded(dime, maxCurrencyLevelForTest);
        }
        else
        {
            minPenniesNeeded = MinCountNeeded(penny, nickel - 1);
            minNickelsNeeded = MinCountNeeded(nickel, dime - 1);
            minDimesNeeded = MinCountNeeded(dime, quarter - 1);

            var maxPossilbleValueWithoutQuarters = (minPenniesNeeded * penny + minNickelsNeeded * nickel + minDimesNeeded * dime);
            if (maxCurrencyLevelForTest > maxPossilbleValueWithoutQuarters)
            {               
                minQuartersNeeded = (((maxCurrencyLevelForTest - maxPossilbleValueWithoutQuarters)-1) / quarter) + 1;
            }
        }


        var minCoinsNeeded = minPenniesNeeded + minNickelsNeeded+minDimesNeeded+minQuartersNeeded;

        Console.WriteLine(String.Format("Min Number of coins needed: {0}", minCoinsNeeded));
        Console.WriteLine(String.Format("Penny: {0} needed", minPenniesNeeded));
        Console.WriteLine(String.Format("Nickels: {0} needed", minNickelsNeeded));
        Console.WriteLine(String.Format("Dimes: {0} needed", minDimesNeeded));
        Console.WriteLine(String.Format("Quarters: {0} needed", minQuartersNeeded));
        Console.ReadLine();
    }

    private static int MinCountNeeded(int denomination, int upperRange)
    {
        int remainder;
        return System.Math.DivRem(upperRange, denomination,out remainder);
    }
}
?>