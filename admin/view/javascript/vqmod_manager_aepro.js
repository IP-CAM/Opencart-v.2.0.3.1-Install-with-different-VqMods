$(document).ready(function() {
// alerts & popups
	$(".alert-success").hide(0).delay(10).fadeIn(500);
	$(".alert-success").show(0).delay(5000).fadeOut(2000);

// selected rows
    $('td#cbox_checked_all input').change(function() {
        $('#cbox_selected tr').toggleClass("dangertr", this.checked);
		$('#cbox_selected tr td.cbox_checked').toggleClass("dangertd", this.checked);
    });
	$('td.cbox_checked:first-child input').change(function() {
		$(this).closest('tr').toggleClass("dangertr", this.checked);
		$(this).parent('td').toggleClass("dangertd", this.checked);
    });
});	

function selectedRows() {
    $('td#cbox_checked_all input').change(function() {
        $('#cbox_selected tr').toggleClass("dangertd", this.checked);
    });
	$('td.cbox_checked:first-child input').change(function() {
        $(this).closest('tr').toggleClass("dangertr", this.checked);
    });
}

// saving overlay
function saveOverlay() {
   var docHeight = $(document).height();
   $("body").append("<div id='overlay'><span class='saving-spinner'><img src='view/image/ajax-spinner.gif' alt='Saving' /></span></div>");
   $("#overlay").height(docHeight);  
}