(function($) {
	function initColorPicker(widget) {
		widget.find('.cw-color-picker').wpColorPicker({
			change: _.throttle(function() { // For Customizer
				$(this).trigger('change');
			}, 3000)
		});
	}

	function onFormUpdate(event, widget) {
		initColorPicker(widget);
	}

	$(document).on('widget-added widget-updated', onFormUpdate);

	$(document).ready(function() {
		$('#widgets-right .widget:has(.cw-color-picker)').each(function() {
			initColorPicker($(this));
		});
	});
}(jQuery));