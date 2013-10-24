(function($) {
	$(function() {

		function rowsShadow() {
			var output = '<style class="append">';

			$('#products tbody tr').each(function() {
				output += '#products .' + $(this).attr('class') + ' .cart {height:' + $(this).height() + 'px; line-height:' + $(this).height() + 'px;} html.gecko #products .' + $(this).attr('class') + ' td:first-of-type div {line-height:' + $(this).height() + 'px;} ';
			});

			return output + '</style>';
		}

		// Загрузка списка моделей

		$('#marks a').on('click', function() {
			
			$('#modifications').html(false);
			$('#products').html(false);
			$('#marks').slideUp(200).prev().hide().prev().prev().text('Выбрана марка:');
			$('#show_marks').text($(this).text()).show();
			
			$('#show_marks').on('click', function() {
				$('#marks').slideDown(200);
				$('#models').html(false);
				$('#modifications').html(false);
				$('#products').html(false);
				$(this).hide().next().show().prev().prev().text('Выберите марку из списка:');
			});

			$.ajax({
				url: $('#models').attr('data-url'),
				type: 'GET',
				data: 'mark='+$(this).text(),
				cache: false,
				success: function (html) {
					$('#models').html(html);
				}
			});

			return false;
		});

		// Фильтр по популярности марок

		$('.marks a:contains(Все)').on('click', function() {
			$('#marks .unpop').css('display', 'block');
		});
		$('.marks a:contains(Популярное)').on('click', function() {
			$('#marks .unpop').hide();
		});

		$(document).ajaxComplete(function(e, xhr, settings) {
		
			// Загрузка списка модификаций

			$('#models .wrap a').off('click');
			$('#models .wrap a').on('click', function() {

				$('#products').html(false);
				$('#models .wrap').slideUp(200).prev().hide().prev().prev().text('Выбрана модель:');
				$('#show_models').text($(this).text()).show();

				$('#show_models').on('click', function() {
					$('#models .wrap').slideDown(200);
					$('#modifications').html(false);
					$('#products').html(false);
					$(this).hide().next().show().prev().prev().text('Выберите модель из списка:');
				});

				$.ajax({
					url: $('#modifications').attr('data-url'),
					type: 'GET',
					data: 'mark='+$('#models .wrap').attr('data-mark')+'&model='+$(this).text(),
					cache: false,
					success: function (html) {
						$('#modifications').html(html);
					}
				});

				return false;
			});

			// Фильтр по популярности моделей

			$('.models a:contains(Все)').off('click');
			$('.models a:contains(Все)').on('click', function() {
				$('#models .unpop').css('display', 'block');
			});

			$('.models a:contains(Популярное)').off('click');
			$('.models a:contains(Популярное)').on('click', function() {
				$('#models .unpop').hide();
			});
		
			// Загрузка списка товаров

			$('#modifications .wrap .modif').off('click');
			$('#modifications .wrap .modif').on('click', function() {

				$('#modifications .wrap').slideUp(200).prev().hide().prev().prev().text('Выбрана модификация:');
				$('#show_modifications').text($(this).children('em').text()).show();

				$('#show_modifications').on('click', function() {
					$('#modifications .wrap').slideDown(200);
					$('#products').html(false);
					$(this).hide().next().show().prev().prev().text('Выберите модификацию из списка:');
				});

				$.ajax({
					url: $('#products').attr('data-url'),
					type: 'GET',
					data: 'mark='+$('#modifications .wrap').attr('data-mark')+'&model='+$('#modifications .wrap').attr('data-model')+'&modification='+$(this).children('em').text(),
					cache: false,
					success: function (html) {
						$('#products').html(html);
						$('style.append').remove();
						$('body').append(rowsShadow());
					}
				});

				return false;
			});

			// Фильтр по популярности модификаций

			$('.modifications a:contains(Все)').off('click');
			$('.modifications a:contains(Все)').on('click', function() {
				$('#modifications .unpop').css('display', 'inline-block');
			});

			$('.modifications a:contains(Популярное)').off('click');
			$('.modifications a:contains(Популярное)').on('click', function() {
				$('#modifications .unpop').hide();
			});

			$('#products tbody button').off('click');
			$('#products tbody button').on('click', function() {
				$(this).closest('tr').find('.cart').html('Товар добавлен в <a href="#">корзину!</a>').addClass('added');
			});
		});

	});
})(jQuery);