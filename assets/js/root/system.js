$(document).ready(function(){
	$('select').selectize({sortField:'text'});
});

function todesimal(bilangan){
    var	reverse = bilangan.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');
    return ribuan;
};
