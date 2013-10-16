(function($) {
	$(function() {

		function scrollDown(id) {
			$('html, body').animate({
				scrollTop: $(id).offset().top
			}, "slow");
		}

		// Загрузка списка моделей

		$('#marks a').on('click', function() {
			
			$('#modifications').html(false);
			$('#products').html(false);

			$.ajax({
				url: $('#models').attr('data-url'),
				type: 'GET',
				data: 'mark='+$(this).text(),
				cache: false,
				success: function (html) {
					$('#models').html(html);
					scrollDown('#models');
				}
			});

			return false;
		});


		$(document).ajaxComplete(function(e, xhr, settings) {
		
			// Загрузка списка модификаций

			$('#models .wrap a').off('click');
			$('#models .wrap a').on('click', function() {

				$('#products').html(false);

				$.ajax({
					url: $('#modifications').attr('data-url'),
					type: 'GET',
					data: 'mark='+$('#models .wrap').attr('data-mark')+'&model='+$(this).text(),
					cache: false,
					success: function (html) {
						$('#modifications').html(html);
						scrollDown('#modifications');
					}
				});

				return false;
			});
		
			// Загрузка списка товаров

			$('#modifications .wrap .modif').off('click');
			$('#modifications .wrap .modif').on('click', function() {

				$.ajax({
					url: $('#products').attr('data-url'),
					type: 'GET',
					data: 'mark='+$('#modifications .wrap').attr('data-mark')+'&model='+$('#modifications .wrap').attr('data-model')+'&modification='+$(this).text(),
					cache: false,
					success: function (html) {
						$('#products').html(html);
						scrollDown('#products');
					}
				});

				return false;
			});
		});

	});
})(jQuery);