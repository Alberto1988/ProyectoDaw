$(document).ready(function() {
				var oTable = $('#example').dataTable( {
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": "./datatable/php/server_processing.php"
					
})});