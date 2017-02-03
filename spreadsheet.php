<?php

?>

<html>
<head>
<link href="css/style.css" type="text/css" rel="stylesheet" />
<script language="javascript" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
	<div id="infoBox">
		
	</div>
	<div id="tableBox">
		<table id="sheetTable">
			<thead id="sheetHead">
			</thead>
			<tbody id="sheetBody">
			</tbody>
		</table>
		<table id="header-fixed"></table>
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

		var tableOffset = $("#sheetTable").offset().top;
		var $header = $("#sheetHead").clone();
		var $fixedHeader = $("#header-fixed").append($header);

		$(window).bind("scroll", function() {
			var offset = $(this).scrollTop();

			if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
				$fixedHeader.show();
			}
			else if (offset < tableOffset) {
				$fixedHeader.hide();
			}
		});
	});
	
	$('th').each(function() {
		tdWidth = $(this).width();
		$(this).width(tdWidth+4);
	});
</script>
</html>