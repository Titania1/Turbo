let data = $('.invoice')[0].innerHTML;

function Popup(data) {
	window.print();
	return true;
}

Popup();

$('#printInvoice').click(function() {
	Popup();
});
