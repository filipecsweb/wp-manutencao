jQuery(window).load(function(){
	var select = 'select[name*="maintenance_type"]';

	var value = jQuery(select).val();

	/**
	 * Get value of select tag and open its table
	 */
	if('page' == value){
		jQuery('.form-table.'+value+'_type').addClass('active');
	}
	else if('redirect' == value){
		jQuery('.form-table.'+value+'_type').addClass('active');

	}

	/**
	 * On select change
	 */
	jQuery(select).change(function(){
		value = this.value;

		jQuery('.form-table').filter(function(){
			return jQuery(this).hasClass('active');
		}).removeClass('active');

		if('page' == value){
			jQuery('.form-table.'+value+'_type').addClass('active');
		}
		else if('redirect' == value){
			jQuery('.form-table.'+value+'_type').addClass('active');

		}
	});
});