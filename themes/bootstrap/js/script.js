(function($) {
    $(function() {

        // Вспомогательная функция для отрисовки тени строк таблицы продуктов

        function rowsShadow() {
            var output = '<style class="append">';

            $('#products tbody tr').each(function() {
                output += '#products .' + $(this).attr('class') + ' .cart {height:' + $(this).height() + 'px; line-height:' + $(this).height() + 'px;} html.gecko #products .' + $(this).attr('class') + ' td:first-of-type div {line-height:' + $(this).height() + 'px;} ';
            });

            return output + '</style>';
        }

        // Обработчик выбора марки селекта

        function onChangeMarkSelect(successFunction) {
            $('#Modification_markname').on('change', function() {
                $('#Modification_model_id').remove();

                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'get',
                    data: 'mark=' + $(this).find('option:selected').text(),
                    success: function(data) {
                        $('label[for="Modification_modelname"]').after(data);
                        if (successFunction) {
                            successFunction();
                        }
                    }
                });
            });
        }

        // Подсчет общей стоимости покупки
        
        function totalCounting() {
            var prices = 0,
                mounting_prices = 0;

            $('.price span').each(function() {
                prices += parseFloat($(this).text());
            });

            $('.mounting_price span').each(function() {
                prices += parseFloat($(this).text());
            });

            $('.total span').text(prices + mounting_prices);
        }

        // Errorblock формы корзины

        function cartFormError(msg, ths) {
            $('#cart_form .alert-error').html(msg).show();
            $(ths).addClass('error');

            return false;
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
                    data: 'mark=' + $('#models .wrap').attr('data-mark') + '&model=' + $(this).text(),
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
                $('#show_modifications').attr('data-modifid', $(this).attr('data-id')).text($(this).children('em').text()).show();

                $('#show_modifications').on('click', function() {
                    $('#modifications .wrap').slideDown(200);
                    $('#products').html(false);
                    $(this).hide().next().show().prev().prev().text('Выберите модификацию из списка:');
                });

                $.ajax({
                    url: $('#products').attr('data-url'),
                    type: 'GET',
                    data: 'mark=' + $('#modifications .wrap').attr('data-mark') +
                        '&model=' + $('#modifications .wrap').attr('data-model') +
                        '&modification=' + $(this).children('em').text(),
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

            // Добавление товара в корзину

            $('#products tbody button').off('click');
            $('#products tbody button').on('click', function() {
                var row = $(this).closest('tr');
                
                row.find('.cart').html('Товар добавлен в <a href="' + $('#products').attr('data-cart') + '">корзину!</a>').addClass('added');

                $.ajax({
                    url: $('#products .table.first').attr('data-url'),
                    type: 'get',
                    data: 'pid=' + row.attr('data-pid') +
                        '&mark=' + $('#show_marks').text() +
                        '&model=' + $('#show_models').text() +
                        '&modification=' + $('#show_modifications').text() +
                        '&modifid=' + $('#show_modifications').attr('data-modifid'),
                    success: function () {
                        var glassName = $(row).closest('table').find('caption').text();

                        $('#cartModal').modal('show').find('.modal-body p').text(
                            'Стекло ' + glassName.substring(0, glassName.length - 1) +
                            ' для ' + $('#show_marks').text() + ' ' +
                            $('#show_models').text() + ' ' + $('#show_modifications').text()
                        );
                    }
                });
            });
        });

        if ($('body').is('.modification_form')) {
            
            $.ajax({
                url: $('#Modification_markname').attr('data-url'),
                type: 'get',
                data: 'mark=AUDI',
                beforeSend: function() {
                    $('#Modification_model_id').remove();
                },
                success: function(data) {
                    $('label[for="Modification_modelname"]').after(data);
                }
            });

            onChangeMarkSelect();
        }

        if ($('body').is('.manage')) {

            onChangeMarkSelect(function() {
                $('#Modification_model_id').prepend('<option disabled selected>');
            });
        }

        if ($('body').is('.modification_update_form')) {

             $.ajax({
                url: $('#Modification_markname').attr('data-url'),
                type: 'get',
                data: 'mark=' + $('#Modification_markname option:selected').text(),
                beforeSend: function() {
                    $('#Modification_model_id').remove();
                },
                success: function(data) {
                    $('label[for="Modification_modelname"]').after(data);
                    $('#Modification_model_id').find('option[value="' + $('#Modification_markname').attr('data-model_id') + '"]').attr('selected', 'selected');
                }
            });

            onChangeMarkSelect();
        }

        // Корзина

        if ($('body').is('.cart') && $('#content table').is('.table')) {

            totalCounting();

            $('.without').on('click', function() {
                var total = parseFloat($('.total span').text());

                total -= parseFloat($(this).prev().text());
                $('.total span').text(total);

                $(this).off('click').parent().html(false);
            });

            $('label[for="Order_mounting"]').on('click', function() {
                if ($('#Order_mounting').is(':checked')) {
                    $('.address, .date').show();
                } else {
                    $('.address, .date, .time').hide();
                    $('#Order_address').val('');
                }
            });

            $('.date label.radio label').on('click', function() {

                $('[for="Order_date"] span').css('visibility', 'visible').text('Вы выбрали день: ' + $(this).text() + '\t ');
                $('.time').show().find('input').removeAttr('checked');

                // ie8 - не работает псевдоселектор :checked даже с selectivizr
                if ($('html').is('.ie8')) {
                    $('.date label.radio [type="radio"]').removeAttr('checked').next().css('background-color', '#fff');
                    $(this).css('background-color', '#e9e9e9').prev().attr('checked', 'checked');
                }
            });

            $('.time label.radio [type="radio"]').on('click', function() {
                var span = $('[for="Order_date"] span');

                if ($(this).attr('checked')) {
                    span.text(span.text().match(/.+\t/) + 'на время: ' + $(this).next().text());
                }

            });

            // Удаление товара из корзины

            $('.table .remove').on('click', function() {
                var row = $(this).closest('tr');

                $('#pid_' + row.attr('data-pid')).remove();

                $.ajax({
                    url: $('.table').attr('data-url'),
                    type: 'get',
                    data: 'pid=' + row.attr('data-pid'),
                    success: function () {
                        row.remove();
                        totalCounting();

                        if ($('.table tbody tr').length === 0) {
                            window.location.reload();
                        }
                    }
                });
            });

            // Валидация данных

            $('#cart_form').on('submit', function() {
                
                if ($('#Order_clientname').val() === '') {
                    return cartFormError('Не заполнено поле <strong>Имя</strong>', $('#Order_clientname'));
                }

                if (!$('#Order_clientname').val().match(/^[А-Яа-яёЁ \-]+$/)) {
                    return cartFormError('Недопустимые символы в поле <strong>Имя</strong>', $('#Order_clientname'));
                }
                
                if ($('#Order_phone').val() === '') {
                    return cartFormError('Не заполнено поле <strong>Телефон</strong>', $('#Order_phone'));
                }

                if (!$('#Order_phone').val().match(/^[0-9\(\)\+ \-]+$/)) {
                    return cartFormError('Недопустимые символы в поле <strong>Телефон</strong>', $('#Order_phone'));
                }
                
                if ($('#Order_mounting').is(':checked')) {
                    
                    if ($('#Order_address').val() === '') {
                        return cartFormError('Не заполнено поле <strong>Адрес</strong>', $('#Order_address'));
                    }

                    if (!$('#Order_address').val().match(/^[ЁёА-Яа-я0-9,\.\-\; ]+$/)) {
                        return cartFormError('Недопустимые символы в поле <strong>Адрес</strong>', $('#Order_address'));
                    }
                }
            });
        }

    });
})(jQuery);