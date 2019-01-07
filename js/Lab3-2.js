var descriptionElement = new Array();
var descriptionVal = ["maxValue", "minValue", "avgValue"];
function start(){
	var arr = new Array();
	for(i=0; i<10; i++){
	arr[i] = parseInt(window.prompt("輸入第"+(i+1)+"個數字"));
	descriptionElement[i] = i;
	}  
	output( "Array arr:", arr, document.getElementById( "output1" ) , descriptionElement);
	output( "Array val:", arr, document.getElementById( "output2" ) ,descriptionVal);
	}
function output( heading, theArray, output, description ){  //表格印出所有元素
	var maxValue = maximum(theArray);
	var minValue = minimum(theArray);
	var avgValue = avg(theArray);
	var val = [maxValue,minValue,avgValue];
			
	var print = new Array();
	if(description[0] == "maxValue"){
		print = val;
	}else{
		print = theArray;
	}
			
	var content = "<h2>" + heading + "</h2><table>" +
		"<thead><th>Index</th><th>Value</th></thead><tbody>";
	for ( var i = 0; i < print.length; ++i ){
		content += "<tr><td>" + description[i] + "</td><td>" + print[ i ] +"</td></tr>";
	}
	content += "</tbody></table>";
	output.innerHTML = content;
	}
function maximum(arr){ //最大值
	return Math.max(...arr);
	} 
function minimum(arr){ //最小值
	return Math.min(...arr);
	}  		 
function avg(arr){ //平均值
	var sum=0;
	for(i=0; i<10; i++){
		sum += arr[i];
	}
	return (sum/arr.length);
	}
window.addEventListener( "load", start, false );