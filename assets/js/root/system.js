$(document).ready(function(){
	$('select').selectize({sortField:'text'});
});

function todesimal(bilangan){
    var	reverse = bilangan.toString().split('').reverse().join(''),
        ribuan 	= reverse.match(/\d{1,3}/g);
        ribuan	= ribuan.join('.').split('').reverse().join('');
    return ribuan;
};

if (window.location.href !== url+'index.php/auth/login' && window.location.href !== url+'index.php/auth/lockscreen') {
    $.sessionTimeout({
        keepAliveUrl    : window.location.href,
        logoutUrl       : url+'index.php/auth/login',
        redirUrl        : url+'index.php/auth/lockscreen',
        warnAfter       : 1200000, //1200000
        redirAfter      : 1210000,
        countdownMessage: 'Redirecting in {timer} seconds.',
        countdownBar: true,
    });
};