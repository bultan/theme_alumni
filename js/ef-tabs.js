/* ----------- EF Tabs ----------- */

(function($){

	var ef = window.ef || ef || {};

	ef.tabs = {

		showTabContent: function(){
			var $tab = $(this);
			var tabToShow = $tab.attr('href');
			var tabHeight = $(tabToShow).attr('data-height');
			var tabContainer = $tab.data('tab-container');

			if ( $tab.is('.is-active') ) return false;

			$tab.addClass('is-active').siblings().removeClass('is-active');

			if ( tabContainer ) {
				$(tabContainer).animate({
					height: tabHeight
				}, 500);
				$(tabContainer).find('.is-visible').fadeOut(500, function(){
					$(tabToShow).fadeIn(500).addClass('is-visible').removeClass('is-hidden')
					.siblings().removeClass('is-visible').addClass('is-hidden');
				});
			} else {
				$tab.parent().next('.tabs-content-container').animate({
					height: tabHeight
				}, 500);
				$tab.parent().next('.tabs-content-container').find('.is-visible').fadeOut(500, function(){
					$(tabToShow).fadeIn(500).addClass('is-visible').removeClass('is-hidden')
					.siblings().removeClass('is-visible').addClass('is-hidden');
				});
			}

			return false;
		},
		setTabHeights: function(){
			$('.tab-content').each(function(){
				var $tabContent = $(this);
				var tabHeight = $tabContent.outerHeight(true, true);
				$tabContent.attr('data-height', tabHeight);
				$tabContent.addClass('is-hidden');

				if ( $tabContent.index() === 0 ) {
					$tabContent.removeClass('is-hidden').addClass('is-visible');
				}
			});
		},
		init: function(){
			if ( $('.tabs-container').length ) {

				$('.tab-controls').on('click', '.tab', ef.tabs.showTabContent);
				$(window).resize(ef.tabs.setTabHeights).trigger('resize');
				$('.tab-controls .tab').each(function(){
					var $tab = $(this);
					if ( $tab.index() === 0 ) {
						$tab.trigger('click');
					}
				});

			}
		}
	};

	window.ef = ef;
	setTimeout(ef.tabs.init, 1000);

})(jQuery);

