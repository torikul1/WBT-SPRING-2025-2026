<?php




echo"Write a PHP script to calculate the area and perimeter of a Rectangle, and display the result. Hints: The area of a Rectangle = length × width, perimeter = 2 × (length + width)";
$length=6;
$width=7;
$area=$length * $width;
$perimeter= ($length+$width)+2;
echo"The area of a rectangle is:";
echo"$area <br>";

echo"premeter is:";
echo"$perimeter <br>";



echo"Write a PHP script to calculate the VAT (Value Added Tax) over an amount Hints: VAT = 15% of the amount";
$price=500;

$vat= $price*(15/100);
echo"Vat is: $vat <br>";

//problem 3 odd or even

echo"Write a PHP script to find whether a given number is odd or even Hints: use IF-ELSE";
$num=6;
echo"Given number is :6 <br>";

if ($num%2===0) {
  echo "This number is even";
} else {
  echo "this number is odd";
}



echo"Write a PHP script to find the largest number from three given numbers Hints: use IF-ELSE";
$num1=7;
$num2=5;
echo"given number is : 7 and 5 <br>";
if ($num1>$num2) {
  echo "$num1 is greater <br>";
} else {
  echo "$num2 is greater <br>";
}


//print odd number
echo"Write a PHP script to print all the odd numbers between 10 to 100 Hints: use LOOP & IF-ELSE";
for ($x = 10; $x <= 100; $x++) {
    if ($x%2==0) {
  
} else {
  echo "$x <br>";
}

}


//find element from an array;

echo"Write a PHP script to search an element from an array Hints: use LOOP, IF-ELSE & ARRAY";
$arrr = array(1,4,3,6,7,8);

echo"want to find 7 <br>";
for ($x = 0; $x <= 5; $x++) {

    if ($arrr[$x]===7) {
        echo"item found <br>";
  
} else {
 // echo"item not found <br>";
}

}


//problem 7:
echo"Print the following shapes Hints: use NESTED LOOP";

for ($x = 0; $x <= 2; $x++) {
 for ($y =1 ; $y <= $x+1; $y++) {
    echo"*";

}
echo"<br>";

}



for ($x = 0; $x <= 2; $x++) {
 for ($y =1 ; $y <= 3-$x; $y++) {
    echo"$y";

}
echo"<br>";

}



$char='A';
for ($x = 0; $x <= 2; $x++) {
 for ($y =1 ; $y <= $x+1 ; $y++) {
    echo"$char";
    $char++;

}
echo"<br>";

}













?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
</body>
</html>