<?php

?>

<html>
<head>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script language="javascript" type="text/javascript"></script>
<script type="text/javascript" src="/tablesorter/jquery-latest.js"></script> 
<script type="text/javascript" src="/tablesorter/jquery.tablesorter.js"></script> 
</head>
<body>
	<div id="tableBox">
		<table id="sheetTable" class="tablesorter">
			<thead id="sheetHead">
			</thead>
			<tbody id="sheetBody">
			</tbody>
		</table>
	</div>
	<div id="infoBox">
		<div id="title">Currently Editing: <?php echo $_GET["id"] ?></div>
		<div id="buttons">
			<button class="functionButton" id="saveButton">Save</button>
			<button class="functionButton" id="exportButton">Export</button>
			<button class="functionButton" id="printButton">Print</button>
		</div>
	</div>
</body>
<script>
	function colName(n) {
        var ordA = 'a'.charCodeAt(0);
        var ordZ = 'z'.charCodeAt(0);
        var len = ordZ - ordA + 1;
      
        var s = "";
        while(n >= 0) {
            s = String.fromCharCode(n % len + ordA) + s;
            n = Math.floor(n / len) - 1;
        }
        return s;
    };
	
	var json = $.getJSON( "<?php echo $_GET["id"] ?>", function( data ) {
		var headers = "";
		var headerCheck = 0;
		$.each(data, function(index, value ) { 
			var row = "";
			row += "<tr>";
			row += "<td class='rowNum'></td>";
			headers += "<tr><th class='rowTop'></th>";
			var headerNum = 0;
			for (var k in value) {
				row += "<td contenteditable='true'>"+value[k]+"</td>";
				headerNum++;
			};
			for (i = 0; i < 23; i++){
				row += "<td contenteditable='true'></td>";
				headerNum++;
			};
			for (n = 0; n < headerNum; n++){
				headers += "<th>"+colName(n)+"</th>"
			};
			row += "</tr>";
			headers += "</tr>";
			$("#sheetBody").append(row);
			if(headerCheck == 0){
				$("#sheetHead").append(headers);
				headerCheck++;
			};
		});
		
		$('th').each(function() {
			tdWidth = $(this).width();
			$(this).width(tdWidth);
		});
		
		$(document).ready(function() { 
			$("#sheetTable").tablesorter();
		}); 

	});
	
	$('th').each(function() {
		tdWidth = $(this).width();
		$(this).width(tdWidth+4);
	});
</script>
</html>