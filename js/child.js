jQuery(document).ready(function($) {      

    $('.add-parent-class').parent().addClass('parent-group-class');
        
    $( '.lity-active a' ).attr('data-lity','');    

    //make the beaver col whole link
    $('.fl-callout').each(function() {
        var callout_link = $(this).find('.fl-heading a').first().attr('href');
        if ( $( this ).hasClass( 'downloadable') ) {
          $(this).prepend('<a class="link" download></a>');
        }
        else {
          $(this).prepend('<a class="link"></a>');
      }
        $(this).find('.link').attr('href',callout_link);
    }); 
    //make the beaver col whole link  
    var str = $('.cartcontents').text().replace('items', '');
    $('.cartcontents').text(str);
    var curval = $('.cartcontents').text();
    var trimStr = $.trim(curval);
    $(".cartcontents").html(trimStr);
    $('.cartcontents').prepend('(');
    $('.cartcontents').append(')');

    $('.overlay-right .fl-row-content-wrap').append('<div class="overlay right-overlay"></div>');

    $('.overlay-right .right-col .fl-col-content').each(function() {
        var bgright = $( this ).css('background-image');
        $(this).parent().parent().parent().parent().find('.right-overlay').css('background-image', bgright);
    });

    //$('.list-field input').datepicker({ minDate: 0, dateFormat: 'dd/mm/yy'}).datepicker('widget').wrap('<div class="ll-skin-nigran"/>');    
    $('.date-activate input').addClass('datepicker');

    $(".datepicker").attr( 'readOnly' , 'true' );

    if ( $( '.datepicker' ).length ) {
        $('.datepicker').datepicker({ minDate: 0, dateFormat: 'dd/mm/yy'}).datepicker('widget').wrap('<div class="ll-skin-nigran"/>');
        setTimeout( function(){
            $('.single_add_to_cart_button').addClass('disabled'); 
        }, 1000);
    }

    if(output.extra_child && output.extra_child_second && output.extra_child_third) {
        $('#field_2_7').removeClass('gf_invisible');     
        $('.xtra-field input').keyup(function() {
            computeInput();
        });
    }

    $('.to input,.from input').change(function() {
        if(output.fixed_price) {
            if(output.fixed_price == 1) {
                var result = output.regular_price;
                $('.from input').removeClass('err'); 
                $('.single_add_to_cart_button').removeClass('disabled'); 
                var resultNormal = result - parseInt(output.regular_price);
                var resultDollar = formatCurrency(result);
                $('.ginput_total').text(resultDollar);
                $('.ginput_amount').val(resultNormal);
            }
            else if(output.fixed_price == 2) {
                var result = output.regular_price;
                $('.from input').removeClass('err'); 
                $('.single_add_to_cart_button').removeClass('disabled'); 
                var resultNormal = result - parseInt(output.second_day_price);
                var resultDollar = formatCurrency(result);
                $('.ginput_total').text(resultDollar);
                $('.ginput_amount').val(resultNormal);
                computeInput();
            }
            else {
                computeInput();
            }
        }
        else {
            computeInput();
        }
    });

    if(output.fixed_price) {
        $('.to input').addClass('disabled-input');

        setTimeout( function(){
            $('.ginput_total').text(formatCurrency(output.regular_price));
        }, 1000);
    }

    if(output.price_description) {
        $('#pd1').html(output.price_description);
    }
    else {
        $('.price-module').addClass('hide-module');
    }

    $('.out-of-stock').html('Please contact us to check availability of this product.');

    if(output.no_cart_product) {
        $('.fl-module-fl-woo-cart-button').hide();
        $('#pd1').html('Please contact us to check availability of this product.');
    }

    $('#input_5_20 input').change(function() {
        calc_price_cl('#input_5_51');
        calc_price_eq('#input_5_50');
        calc_price_ss('#input_5_52')
        $('#choice_5_20_5').not(this).prop('checked', false);  
    });

    $('#choice_5_20_5').change(function() {
        $('#field_5_20 input').not(this).prop('checked', false);  
        $('#input_5_50').val(0).change();
    });

    $('#field_5_45 input').change(function() {
        calc_price_cl('#input_5_51');
        calc_price_eq('#input_5_50');
        calc_price_ss('#input_5_52')
        calc_price_in('#input_5_53');
        calc_price_et('#input_5_55');
    });    

    $('#field_5_44 input').change(function() {
        calc_price_cl('#input_5_51');
        calc_price_eq('#input_5_50');
        calc_price_ss('#input_5_52');
        calc_price_in('#input_5_53');
        calc_price_et('#input_5_55');
        calc_price_ac('#input_5_57');
    });

    $('#field_5_54 input').change(function() {
        calc_price_cl('#input_5_51');
        calc_price_eq('#input_5_50');
        calc_price_ss('#input_5_52');
        calc_price_in('#input_5_53');
        calc_price_et('#input_5_55');
        calc_price_ac('#input_5_57');
    });

    $('#field_5_56 input').change(function() {
        calc_price_cl('#input_5_51');
        calc_price_eq('#input_5_50');
        calc_price_ss('#input_5_52');
        calc_price_in('#input_5_53');
        calc_price_et('#input_5_55');
        calc_price_ac('#input_5_57');
    });

    $('#field_5_48 input').change(function() {
        calc_price_cl('#input_5_51');
        calc_price_eq('#input_5_50');
        calc_price_ss('#input_5_52');
        calc_price_in('#input_5_53');
        calc_price_et('#input_5_55');
        calc_price_ac('#input_5_57');
    });

    $('.add_list_item').append('<span>Add Day</span>');
    $('.delete_list_item').append('<span>Remove Day</span>');

    $('.section-simple .wrap').attr('id', 'scroll1');

    $('.vbo-search-submit .btn').click(function() {
    $('html, body').animate({
            scrollTop: $('#scroll1').offset().top
        }, 2000);
    });
    if ( $( '.gform_wrapper' ).length ) {
        gform.addAction( 'gform_list_post_item_add', function ( item, container ) {
            calc_price_eq('#input_5_50');
            calc_price_cl('#input_5_51');
            calc_price_ss('#input_5_52');
            calc_price_in('#input_5_53');
            calc_price_et('#input_5_55');
            calc_price_ac('#input_5_57');
        });

        gform.addAction( 'gform_list_post_item_delete', function ( container ) {
            calc_price_eq('#input_5_50');
            calc_price_cl('#input_5_51');
            calc_price_ss('#input_5_52');
            calc_price_in('#input_5_53');
            calc_price_et('#input_5_55');
            calc_price_ac('#input_5_57');
        } );
    }

    function calc_price_eq(inputID) { 
        var c1Price = chck_price( '#choice_5_20_1', 50, 77, 87, 97, 110 );
        var c2Price = chck_price( '#choice_5_20_2', 60, 90, 105, 120, 135 );
        var c3Price = chck_price( '#choice_5_20_3', 70, 105, 125, 145, 165 );
        var c4Price = chck_price( '#choice_5_20_4', 30, 40, 47, 54, 61 );
        $(inputID).val( parseInt(c1Price) + parseInt(c2Price) + parseInt(c3Price) + parseInt(c4Price) ).change();
    }

    function calc_price_cl(inputID) { 
        var c1Price = chck_price( '#choice_5_44_1', 15, 20, 24, 28, 32 );
        var c2Price = chck_price( '#choice_5_44_2', 12, 18, 21, 24, 27 );
        $(inputID).val( parseInt(c1Price) + parseInt(c2Price) ).change();
    }

    function calc_price_ss(inputID) { 
        var c1Price = chck_price( '#choice_5_45_1', 28, 50, 75, 100, 125 );
        var c2Price = chck_price( '#choice_5_45_2', 28, 50, 75, 100, 125 );
        var c3Price = chck_price( '#choice_5_45_3', 28, 50, 75, 100, 125 );
        if( c1Price > 0 ) {
            var fPrice = c1Price;
        }
        else if( c2Price > 0 ) {
            var fPrice = c2Price;
        }
        else if( c3Price > 0 ) {
            var fPrice = c3Price;
        }
        else {
            var fPrice = 0;
        }
        $(inputID).val( fPrice ).change();
    }

    function calc_price_in(inputID) { 
        var c1Price = chck_price( '#choice_5_54_0', 230, 230, 230, 230, 230 );
        var c2Price = chck_price( '#choice_5_54_1', 200, 200, 200, 200, 200 );
        var c3Price = chck_price( '#choice_5_54_2', 350, 350, 350, 350, 350 );
        var c4Price = chck_price( '#choice_5_54_3', 380, 380, 380, 380, 380 );
        $(inputID).val( parseInt(c1Price) + parseInt(c2Price) + parseInt(c3Price) + parseInt(c4Price) ).change();
    }

    function calc_price_et(inputID) { 
        var c1Price = chck_price( '#choice_5_56_0', 100, 100, 100, 100, 100 );
        var c2Price = chck_price( '#choice_5_56_1', 100, 100, 100, 100, 100 );
        if( c1Price > 0 ) {
            var fPrice = c1Price;
        }
        else if( c2Price > 0 ) {
            var fPrice = c2Price;
        }
        else {
            var fPrice = 0;
        }
        $(inputID).val( fPrice ).change();
    }

    function calc_price_ac(inputID) { 
        var c1Price = chck_price( '#choice_5_48_1', 30, 60, 90, 120, 150 );
        $(inputID).val( parseInt(c1Price) ).change();
    }

    function chck_price( inp, d1, d2, d3, d4, d5 ) {
        var dayInput = $('input[name="input_42[]"]').length;
        if($(inp).is(':checked')) {
            if( dayInput == 1 ) {
                var price = d1;
            }
            else if( dayInput == 2 ) {
                 var price = d2;
            }
            else if( dayInput == 3 ) {
                 var price = d3;
            }
            else if( dayInput == 4 ) {
                 var price = d4;
            }
            else if( dayInput == 5 ) {
                 var price = d5;
            }
            else {
                 var price = 0;
            }
        }
        else {
             var price = 0;
        }

        return price;
    
    }

    function fixedPriceCompute() {
        if(output.fixed_price) {
            var eDate = $('.from input').val().split("/");
            var year = eDate[2];
            var month = eDate[1];
            var day = parseInt(eDate[0]) + parseInt(output.fixed_price);
            var end_date = day + '/'+ month + '/'+ year;
            console.log(end_date);
            $('.to input').val(end_date);
        }
    }

    function computeInput() {
        console.log('hahahaha');
        var startDay = $('.from input').val();
        var endDay = $('.to input').val();
        var extraChild = $('.xtra-field input').val();
        var startDayDate = $('.from input').datepicker('getDate');
        var endDayDate = $('.to input').datepicker('getDate');
        if( startDay && extraChild && !endDay ) {
            var dd   = output.fixed_price;
        }
        else {
             var dd   = (endDayDate - startDayDate)/1000/60/60/24+1;
        }
        console.log(dd);
        if( startDay && endDay || startDay && extraChild ) {
            $('.single_add_to_cart_button').removeClass('disabled');   
            $('.from input').removeClass('err'); 
            $('.to input').removeClass('err');  

            if( dd == 1 ) {
                if( output.extra_child && extraChild > 0 ) {
                    var result = parseInt(output.regular_price) + parseInt(output.extra_child) * parseInt(extraChild);
                }
                else {
                    var result = output.regular_price;
                }
            }
            else if( dd < 1 ) {
                $('.single_add_to_cart_button').addClass('disabled'); 
                $('.from input').addClass('err'); 
                $('.to input').addClass('err');
                var result = 0;
            }
            else if( dd == 2 ) {
                if( output.extra_child_second && extraChild > 0 ) {
                    var result = parseInt(output.second_day_price) + parseInt(output.extra_child_second) * parseInt(extraChild);
                }
                else {
                    var result = output.second_day_price;
                }
            }
            else if( isNaN(dd) ) {
                $('.single_add_to_cart_button').addClass('disabled');  
                $('.from input').addClass('err'); 
                $('.to input').addClass('err');
                var result = 0;
            }
            else {
                var fdd = parseInt(dd) - 2;
                if( output.extra_child_third && extraChild > 0 ) {
                    var childTotal = parseInt(output.extra_child_third) * fdd + parseInt(output.extra_child_second);
                    var mm = childTotal * parseInt(extraChild);
                    var result = parseInt(output.additional_day_price) * fdd + parseInt(output.second_day_price) + mm;
                }
                else {
                    var result = parseInt(output.additional_day_price) * fdd + parseInt(output.second_day_price);
                }

            }
            var resultNormal = result - parseInt(output.regular_price);
            var resultDollar = formatCurrency(result);
            console.log(resultNormal);
            $('.ginput_total').text(resultDollar);
            $('.ginput_amount').val(resultNormal);

        }
        else {
            $('.from input').addClass('err'); 
            $('.to input').addClass('err');
            $('.single_add_to_cart_button').addClass('disabled');  
        }
    }

    function formatCurrency(total) {
        var neg = false;
        if(total < 0) {
            neg = true;
            total = Math.abs(total);
        }
        return (neg ? "-$" : '$') + parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString();
    }


    function isValidDate(s) {
      var bits = s.split('/');
      var d = new Date(bits[2] + '/' + bits[1] + '/' + bits[0]);
      return !!(d && (d.getMonth() + 1) == bits[1] && d.getDate() == Number(bits[0]));
    }

});



