/* http://keith-wood.name/countdown.html
 * Spanish initialisation for the jQuery countdown extension
 * Written by Sergio Carracedo Martinez webmaster@neodisenoweb.com (2008) */
(function($) {
	'use strict';
	$.countdown.regionalOptions.es = {
		labels: ['AÃ±os','Meses','Semanas','Días','Horas','Minutos','Segundos'],
		labels1: ['AÃ±o','Mes','Semana','Día','Hora','Minuto','Segundo'],
		compactLabels: ['a','m','s','d'],
		whichLabels: null,
		digits: ['0','1','2','3','4','5','6','7','8','9'],
		timeSeparator: ':',
		isRTL: false
	};
	$.countdown.setDefaults($.countdown.regionalOptions.es);
})(jQuery);