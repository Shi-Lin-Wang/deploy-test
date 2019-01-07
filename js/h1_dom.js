var currentNum;
var count = 0;

function start()
{
   document.getElementById( "numButton" ).addEventListener(
      "click", addNum, false );

} 
window.addEventListener( "load", start, false );

function addNum()
{
   count++;
   document.getElementById( "numButton" ).value = count;
}