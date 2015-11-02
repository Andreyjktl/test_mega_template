    
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    var is_safari = navigator.userAgent.toLowerCase().indexOf('safari') > -1;
    var is_ie6 = false;
    var is_ie7 = false;
    var is_ie8 = false;
    jQuery.each(jQuery.browser, function(i, val){
        if(i=="msie" && jQuery.browser.version.substr(0,3)=="6.0"){is_ie6 = true;}
        if(i=="msie" && jQuery.browser.version.substr(0,3)=="7.0"){is_ie7 = true;}
        if(i=="msie" && jQuery.browser.version.substr(0,3)=="8.0"){is_ie8 = true;}
    });


    // HTML 5 Support for IE
    if ($.browser.msie){
        document.createElement('header');
        document.createElement('footer');
        document.createElement('nav');
        document.createElement('button');
    }
    // -

    // Rubl Style
    $(document).ready(function(){
        $('span.rubl').each(function(){
            line = '<span class="line1">&minus;</span><span class="line2">&minus;</span>';
            $(this).prepend(line);
            font_size = parseInt($(this).css('font-size'));
            font_weight = $(this).css('font-weight');
            if (font_size > 12) {
                if (font_weight == 700 || font_weight == 'bold') {
                    mgtop = parseInt($(this).find('span.line2').css('margin-top')) + 1;
                    if (font_size == 18) { mgtop = mgtop + 1; }
                    if (font_size > 18) { mgtop = mgtop + 2; }
                    if (font_size > 24) { mgtop = mgtop + 1; }
                    $(this).find('span.line2').css({'margin-top':mgtop});
                }
            }
            if ($.browser.webkit) { $('a span.rubl').addClass('webkit'); }
        });
    });
    // -

    $(document).ready(function() {
        function nextSlide() { $('div.promo div.next').click(); }
        var promoTime = 4 * 1000;
        promoIntID = setInterval(nextSlide, promoTime);
        $("div.promo").hover(function() {
            clearInterval(promoIntID);
        },function() {
            promoIntID = setInterval(nextSlide, promoTime);
        });
    });


    $(document).ready(function() {
        if (typeof window.basket == "undefined") {
            return;
        }
        var ids = window.basket;
        for (var i = 0; i < ids.length; i++) {
            var text = $("#buybutton" + ids[i]).data('in-basket');
            $("#buybutton" + ids[i])
                .addClass("disabled")
                .attr("disabled", "disabled")
                .find("span")
                    .html(text);
        };
    });

    // Miracles :)
    $(document).ready(function(){
        section_height = 0;
        $('header div.section').each(function(){
            if ($(this).height() > section_height) {
                section_height = $(this).height();
            }
        });
        $('header div.section').height(section_height);
        section_height = 0;
        $('footer div.td').each(function(){
            if ($(this).height() > section_height) {
                section_height = $(this).height();
            }
        });
        $('footer div.td').height(section_height);
        $('nav ul li:first').addClass('first');
        $('div.auth ul li:first').addClass('first');
        $('div.menu ul li:first').addClass('first');
        if (is_safari && !is_chrome) { $('button').addClass('safari'); }
        if ($.browser.webkit) { $('textarea').addClass('webkit'); }
        if ($('ul.size1 li').length == 6) { $('ul.size1 li:last').addClass('last'); }
        if ($('ul.size2 li').length == 5) { $('ul.size2 li:last').addClass('last'); }
        if ($.browser.opera) {
            $('button').mouseup(function(){
                $(this).css({'position':'static'});
            });
        }
        if ($.browser.mozilla) {
            $('select').addClass('ff');
            $('button.button4').addClass('ff');
            $('div.form div.field p').addClass('ff');
            $('textarea').addClass('ff');
            $('div.sections div.section').addClass('pd');
        }
        if ($.browser.msie) {
            if ($('div.mode h1').length > 0) {
                margin = $('div.mode h1').css('margin-bottom');
                $('div.mode p').css({'margin-bottom':margin});
            } else if ($('div.mode h2').length > 0) {
                margin = $('div.mode h2').css('margin-bottom');
                $('div.mode p').css({'margin-bottom':margin});
            }
        }
        if (is_ie7) {
            $('div.sections div.section').addClass('pd');
            $('hr.full').each(function(){
                $(this).before('<div class="hr"><hr class="full" /></div>');
                $(this).remove();
            });
        }
    });
    // -


    // Search Panel
    $(document).ready(function(){
        panel_width = $('div.panel').width();
        menu_width = $('div.panel div.menu').width();
        search_width = panel_width - menu_width - parseInt($('div.search').css('padding-left')) - parseInt($('div.search').css('padding-right'));
        button_width = $('div.search div.button').width() + parseInt($('div.search div.button').css('padding-left')) + parseInt($('div.search div.button').css('padding-right'));
        field_width = search_width - button_width - parseInt($('div.search div.field').css('padding-left')) - parseInt($('div.search div.field').css('padding-right'));
        $('div.search div.field').css({'width':field_width-2});
    });
    // -


    // Submenu 1
    $(document).ready(function(){
        $('nav ul li').hover(function(){
            if ($(this).find('div.submenu1').length > 0) {
                $(this).find('div.submenu1').css({'display':'block'});
            }
        }, function(){
            $(this).find('div.submenu1').css({'display':'none'});
        });
    });
    // -


    // Submenu 2
    $(document).ready(function(){
        $('div.menu ul li').hover(function(){
            if ($(this).find('div.submenu2').length > 0) {
                $(this).addClass('hovered').addClass('expanded');
                $(this).find('div.submenu2').css({'display':'block'});
                menu_width = $(this).width();
                submenu_width = $(this).find('div.submenu2').width();
                submenu_left = (submenu_width - menu_width) / -2;
                $(this).find('div.submenu2').css({'left':submenu_left});
            }
        }, function(){
            $(this).removeClass('hovered').removeClass('expanded');
            $(this).find('div.submenu2').css({'display':'none'});
        });
    });
    // -


    // Signin Popup
    $(document).ready(function(){
        $('div.auth a.signin').click(function(){
            $('div.auth div.signin').css({'display':'block'});
            return false;
        });
        $('div.auth div.signin div.close').click(function(){
            $('div.auth div.signin').css({'display':'none'});
        });
        $('div.auth div.signin p.tab').click(function(){
            $('div.auth div.signin div.close').trigger('click');
        });
    });
    // -


    // Promo Block
    $(document).ready(function(){
        animation_completed = true;

        // Next
        $('div.promo div.next').click(function(){
            if (animation_completed) {
                animation_completed = false;
                $('ul.promo div.sticker div.bg').addClass('loading');
                active_li = $('ul.promo li.active');
                if ($('ul.promo li.active').next().length > 0) {
                    next_li = $('ul.promo li.active').next();
                } else {
                    next_li = $('ul.promo li:first')
                }
                $('ul.promo li.active div.tires').animate({top: 300}, 300, 'easeOutCirc');
                $('ul.promo li').removeClass('last-active');
                $('ul.promo li.active').removeClass('active').addClass('last-active');
                next_li.find('div.image').fadeTo(0, 0);
                next_li.addClass('active');
                next_li.find('div.tires').css({'top':'-400px'});
                next_li.find('div.tires').animate({top: tires_top}, 250, 'easeOutCirc', function(){
                    $(this).animate({top: tires_top-5}, 70, function(){
                        $(this).animate({top: tires_top}, 40, function(){
                            $(this).animate({top: tires_top-2}, 20, function(){
                                $(this).animate({top: tires_top}, 10);
                                $('ul.promo li.last-active div.tires').css({'top':tires_top});
                                $('ul.promo div.sticker div.bg').removeClass('loading');
                            });
                        });
                    });
                });
                next_li.find('div.image').stop().animate({opacity: 1}, 600, function(){
                    animation_completed = true;
                });
            }
        });

        // Prev
        $('div.promo div.prev').click(function(){
            if (animation_completed) {
                animation_completed = false;
                $('ul.promo div.sticker div.bg').addClass('loading');
                active_li = $('ul.promo li.active');
                if ($('ul.promo li.active').prev().length > 0) {
                    next_li = $('ul.promo li.active').prev();
                } else {
                    next_li = $('ul.promo li:last')
                }
                $('ul.promo li.active div.tires').animate({top: 300}, 300, 'easeOutCirc');
                $('ul.promo li').removeClass('last-active');
                $('ul.promo li.active').removeClass('active').addClass('last-active');
                next_li.find('div.image').fadeTo(0, 0);
                next_li.addClass('active');
                next_li.find('div.tires').css({'top':'-400px'});
                next_li.find('div.tires').animate({top: tires_top}, 250, 'easeOutCirc', function(){
                    $(this).animate({top: tires_top-5}, 70, function(){
                        $(this).animate({top: tires_top}, 40, function(){
                            $(this).animate({top: tires_top-2}, 20, function(){
                                $(this).animate({top: tires_top}, 10);
                                $('ul.promo li.last-active div.tires').css({'top':tires_top});
                                $('ul.promo div.sticker div.bg').removeClass('loading');
                            });
                        });
                    });
                });
                next_li.find('div.image').stop().animate({opacity: 1}, 600, function(){
                    animation_completed = true;
                });
            }
        });

        // Promo Block Onload
        $('ul.promo li:first').addClass('active');
        $('ul.promo li').css({'display':'block'});
        tires_top = parseInt($('div.promo div.tires:first').css('top'));
        $('div.promo div.arrow').hover(function(){
            $(this).addClass('hovered');
        }, function(){
            $(this).removeClass('hovered');
        });

    });
    // -


    // Filter
    $(document).ready(function(){

        // Tabs Hover
        $('div.filter div.top ul li').hover(function(){
            if (!$(this).hasClass('selected')) { $(this).addClass('hovered'); }
        }, function(){
            $(this).removeClass('hovered');
        });

        // Tabs Click
        $('div.filter div.top ul li').click(function(){
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
                $('div.filter div.bottom').css({'display':'none'});
            } else {
                $('div.filter div.bottom').css({'display':'block'});
                $('div.filter div.top ul li').removeClass('selected').removeClass('hovered');
                $(this).addClass('selected');
                $('div.filter div.fieldset').css({'display':'none'});
                tab_index = $(this).index();
                $('div.filter div.fieldset').each(function(){
                    fieldset_index = $(this).index();
                    if (tab_index == fieldset_index) {
                        $(this).css({'display':'block'});
                    }
                });
            }
        });

        // Radio Button Click
        $('div.filter div.selector input').click(function(){
            form_class = 'form.'+$(this).attr('id');
            if ($(this).attr('checked')) {
                $(this).parent().parent().parent().find('form').css({'display':'none'});
                $(form_class).css({'display':'block'});
            }
        });

        // Filter Onload
        $('div.filter div.top ul li').each(function(){
            if ($(this).hasClass('selected')) {
                tab_index = $(this).index();
                $('div.filter div.fieldset').each(function(){
                    fieldset_index = $(this).index();
                    if (tab_index == fieldset_index) {
                        $(this).css({'display':'block'});
                        $('div.filter div.bottom').css({'display':'block'});
                    }
                });
            }
        });
        $('div.filter div.fieldset').each(function(){
            $(this).find('div.selector input').each(function(){
                if ($(this).attr('checked')) {
                    form_class = 'form.'+$(this).attr('id');
                    $(form_class).css({'display':'block'});
                }
            });
        });

    });
    // -


    // Registration
    $(document).ready(function(){
        $('p.reg input').each(function(){
            if ($(this).attr('checked')) {
                form_class = 'div.' + $(this).attr('id');
                $('div.individual').css({'display':'none'});
                $('div.corporation').css({'display':'none'});
                $(form_class).css({'display':'block'});
            }
        });
        $('p.reg input').click(function(){
            if ($(this).attr('checked')) {
                form_class = 'div.' + $(this).attr('id');
                $('div.individual').css({'display':'none'});
                $('div.corporation').css({'display':'none'});
                $(form_class).css({'display':'block'});
            }
        });
    });
    // -


    // Tabs
    $(document).ready(function(){

        // Tabs Hover
        $('ul.tabs li').hover(function(){
            if (!$(this).hasClass('selected')) { $(this).addClass('hovered'); }
        }, function(){
            $(this).removeClass('hovered');
        });
		
        // Tabs IE
        if (is_ie8 || is_ie7) {
            $('ul.tabs').each(function(){
                $(this).find('li:last').addClass('last');
            });
        }

        // Tabs Click
        $('ul.tabs').each(function(){
            $(this).find('li a').click(function(){
                old_hash = $(this).parent().parent().find('li.selected a').attr('href');
                old_tab = 'div.'+old_hash.replace('#','');
                $(old_tab).css({'display':'none'});
                $(this).parent().parent().find('li.selected').removeClass('selected').removeClass('selected-last');
                $(this).parent().addClass('selected');
                if ($(this).parent().hasClass('last')) {
                    $(this).parent().addClass('selected-last');
                }
                hash = $(this).attr('href');
                tab = 'div.'+hash.replace('#','');
                $(tab).css({'display':'block'});
                document.location.replace(hash);
                return false;
            });
        });

        // Tabs Onload
        location_hash = false;
        location_url = document.location;
        location_url = location_url.toString();
        if (location_url.indexOf('#tab-') > 0) {
            location_url = location_url.split('#tab-');
            location_hash = 'tab-'+location_url[1];
        }
        if (location_hash) {
            $('ul.tabs').each(function(){
                $(this).find('li').each(function(){
                    hash = $(this).find('a').attr('href').replace('#','');
                    if (location_hash == hash) {
                        if ($(this).parent().find('li.selected').length > 0) {
                            old_hash = $(this).parent().find('li.selected a').attr('href');
                            old_tab = 'div.'+old_hash.replace('#','');
                            $(old_tab).css({'display':'none'});
                            $(this).parent().find('li.selected').removeClass('selected').removeClass('selected-last');
                        }
                        $(this).addClass('selected');
                        if ($(this).hasClass('last')) {
                            $(this).addClass('selected-last');
                        }
                        tab = 'div.'+hash;
                        $(tab).css({'display':'block'});
                    }
                });
            });
        } else {
            $('ul.tabs').each(function(){
                $(this).find('li').each(function(){
                    hash = $(this).find('a').attr('href');
                    if (hash&&hash.indexOf('#') > -1) {
                        if (hash != '' && hash != '#') {
                            tab = 'div.'+hash.replace('#','');
                            if ($(tab).length > 0) { $(tab).css({'display':'none'}); }
                            if ($(this).hasClass('selected')) {
                                if ($(tab).length > 0) { $(tab).css({'display':'block'}); }
                            }
                        }
                    }
                });
            });
        }

    });
    // -


    // Auto hide/show label on text field
    $(document).ready(function() {
        $('.autolabel').attr('defaultValue', $('.autolabel').val());
        $('.autolabel').focus(function () {
            if ($(this).attr('defaultValue') && $(this).attr('defaultValue') == $(this).val()) {
                $(this).val('');
            }
        });
        $('.autolabel').blur(function () {
            if ($(this).attr('defaultValue') && $(this).val() == '') {
                $(this).val($(this).attr('defaultValue'));
            }
        });
    });
    // -


    // Anchor Links
    $(document).ready(function(){
        $('p.link').each(function(){
            $(this).find('a').click(function(){
                scrollable = 'html';
                if ($.browser.webkit) { scrollable = 'body'; }
                hash = $(this).attr('href').replace('#','');
                scroll_margin = 30;
                anchor_top = $('[name='+hash+']').offset().top - scroll_margin;
                scroll_top = $(scrollable).scrollTop();
                document.location.replace('#'+hash);
                $(scrollable).scrollTop(scroll_top);
                $(scrollable).animate({scrollTop: anchor_top}, 1000, 'easeOutCirc');
                return false;
            });
        });
    });
    // -


    // Popups
    $(document).ready(function(){

        $('div.overlay, div.popup .close-button, div.popup div.close').click(function(){
            if (animation_completed) {
                $('div.popup').css({'display':'none', 'margin':'0'});
                $('div.overlay').css({'display':'none'});
            }
        });

//
//        $('div.overlay').click(function(){
//            if (animation_completed) {
//                $('div.popup').css({'display':'none', 'margin':'0'});
//                $('div.overlay').css({'display':'none'});
//            }
//        });
//        $('div.popup div.close').click(function(){
//            if (animation_completed) {
//                $(this).parent().css({'display':'none', 'margin':'0'});
//                $('div.overlay').css({'display':'none'});
//            }
//        });
    });
    function popupPosition(popup, back){

        // считываем размеры попапа
        popup.css({'display':'block'});
        popup_width = popup.width();
        popup_height = popup.height();
        popup.css({'display':'none'});

        // вычисляем координаты и центрируем попап относительно высоты и ширины браузера
        window_width = $('div.center').width();
        window_height = $(window).height();
        scrolltop = $(window).scrollTop();
        popup_left = (window_width - popup_width) / 2;
        popup_top = ((window_height - popup_height) / 2) + scrolltop - 30;
        if (popup_top < 50) { popup_top = 50; }

        // показываем попап и прозрачную подложку
        if (back) {
            back_height = $(document).height();
            back.css({'height':back_height});
            back.fadeIn(0).fadeTo(0, 0).fadeTo(250, 0.67, function(){
                popup.css({'left':popup_left,'top':popup_top,'display':'block'});
            });
        } else {
            popup.css({'left':popup_left,'top':popup_top,'display':'block'});
        }

    }
    // -


    // Popup: Order Warning
    function orderWarning(){
        popupPosition($('div.warning'), $('div.overlay'));
    }
    // -


    // Popup: Order Added
    function orderAdded(btn){
        popupPosition($('div.added'), $('div.overlay'));
        var text = $(btn).data('in-basket');
        $(btn).addClass("disabled")
            .attr("disabled", "disabled")
            .find("span")
                .html(text);
    }
    // -


    // Popup: Gallery
    $(document).ready(function(){

        // подготовка
        popup_html = '<div class="popup view-photo"><div class="close"></div><div class="arrow prev"></div><div class="arrow next"></div><div class="title"></div><div class="loading"><div class="image"></div></div></div>';
        $('div.center').append(popup_html);
        $('div.view-photo div.close').click(function(){ $('div.overlay').trigger('click'); });
        gallery_length = $('a[rel=gallery]').length;
        last_char = gallery_length.toString();
        last_char = last_char.charAt(last_char.length-1);
        if (last_char == '1') {
            title = '<h3><span>&nbsp;</span></h3>';
        } else {
            title = '<h3><span>&nbsp;</span></h3>';
        }
        $('div.view-photo div.title').html(title);
        title_height = parseInt($('div.view-photo div.title').css('height'));
        preloader = '<div class="preloader"></div>';
        $('body').append(preloader);

        // клик по ссылке с rel="gallery"
        $('a[rel=gallery]').each(function(i){
            $(this).click(function(){
                $('div.view-photo div.image').css({'background-image':'none', 'width':'300px', 'height':'200px'});
                $('div.view-photo div.title h3 span').html(i+1);
                gallery_index = i;
                popupPosition($('div.view-photo'), $('div.overlay'));
                img_url = $(this).attr('href');
                loadingImage(img_url);
                return false;
            });
        });

        // клик по стрелочке "next"
        $('div.view-photo div.next').click(function(){
            if (animation_completed) {
                gallery_next = gallery_index + 1;
                if (gallery_next == gallery_length) { gallery_next = 0; }
                $('a[rel=gallery]').each(function(i){
                    if (gallery_next == i) {
                        img_url = $(this).attr('href');
                    }
                });
                gallery_index = gallery_next;
                loadingImage(img_url);
            }
        });

        // клик по стрелочке "prev"
        $('div.view-photo div.prev').click(function(){
            if (animation_completed) {
                gallery_prev = gallery_index - 1;
                if (gallery_prev < 0) { gallery_prev = gallery_length - 1; }
                $('a[rel=gallery]').each(function(i){
                    if (gallery_prev == i) {
                        img_url = $(this).attr('href');
                    }
                });
                gallery_index = gallery_prev;
                loadingImage(img_url);
            }
        });

        // прелоадинг картинок и анимация попапа
        function loadingImage(img_url){
            $('div.view-photo div.image').css({'background-image':'none'});
            img = '<img src="'+img_url+'" alt="" />';
            $('div.preloader').html(img);
            $('div.preloader').find('img').load(function(){
                animation_completed = false;
                img_url = $(this).attr('src');
                img_width = $(this).width();
                img_height = $(this).height();
                popup_width = parseInt($('div.view-photo div.image').css('width'));
                popup_height = parseInt($('div.view-photo div.image').css('height'));
                margin_left = parseInt($('div.view-photo').css('margin-left'));
                margin_left = margin_left - ((img_width - popup_width) / 2);
                margin_top = parseInt($('div.view-photo').css('margin-top'));
                margin_top = margin_top - ((img_height - popup_height) / 2);
                $('div.view-photo div.title h3 span').html(gallery_index+1);
                $('div.view-photo div.image').fadeTo(0, 0);
                $('div.view-photo div.image').css({'background-image':'url('+img_url+')'});
                $('div.view-photo div.image').stop().animate({width: img_width, height: img_height}, 500, 'easeOutCirc');
                $('div.view-photo').stop().animate({'margin-left': margin_left, 'margin-top': margin_top}, 500, 'easeOutCirc', function(){
                    $('div.view-photo div.image').stop().animate({opacity: 1}, 250, 'linear', function(){
                        animation_completed = true;
                    });
                });
            });
        }

    });
    // -

        jQuery(document).ready(function(){
            jQuery('.buy').click(
                function() {
                    if(jQuery(this).parents('.buy-m').length || jQuery(this).parents('.buy-i').length){
                        var element = jQuery(this).parents('.tocart');
                        var itemID = element.attr('itemID');
                        var available = element.attr('offerStatus');

                        if(jQuery(('#name'+itemID)).length){
                            var itemName = jQuery(('#name'+itemID)).text();
                        }else{
                            var itemName = jQuery("div.content").find('H1:first').text();
                        }
                        var count2Order = jQuery(('#count'+itemID)).attr('value');
                        var price2Order = jQuery(('#price'+itemID)).attr('value');

                        var imgSrc = '';
                    }

                    if(jQuery(this).parents('.buy-m').length){
                        imgSrc = jQuery("#picture").find('IMG:first').attr('src');

                        if(available=='available'){
                            var form_action = element.parents('FORM').attr('action');
                            var form_data = element.parents('FORM').serialize();

                            jQuery.post(form_action, form_data, function() {
                                $.get("/ajax/cart.php", function(data) {
                                    $('#cart-block').html(data);
                                });
                            });

                            jQuery('#buyForm-img').attr('src', imgSrc).css('height', 'auto');
                            if(itemName.length>0)
                                jQuery('#buyForm-itemName').text(itemName);

                            jQuery('#summ-detail .summ-detail-count').text(count2Order);
                            jQuery('#summ-detail .summ-detail-price').text(price2Order);
                            jQuery('#total span').text(count2Order * price2Order);

                            orderAdded(this);
                        }else{
                            jQuery('#buyForm-img-w').attr('src', imgSrc).css('height', 'auto');
                            jQuery('#buyForm-itemName-w').text(itemName);

                            orderWarning();
                        }
                    }

                    if(jQuery(this).parents('.buy-i').length){
                        imgSrc = jQuery("#i"+itemID).attr('src');

                        if(available=='available'){
                            var form_action = element.parents('FORM').attr('action');
                            var form_data = element.parents('FORM').serialize();

                            jQuery.post(form_action, form_data, function() {
                                $.get("/ajax/cart.php", function(data) {
                                    $('#cart-block').html(data);
                                });
                            });

                            jQuery('#buyForm-img').attr('src', imgSrc).css('height', 'auto');
                            jQuery('#buyForm-itemName').text(itemName);

                            jQuery('#summ-detail .summ-detail-count').text(count2Order);
                            jQuery('#summ-detail .summ-detail-price').text(price2Order);
                            jQuery('#total span').text(count2Order * price2Order);

                            orderAdded(this);

                        }else{
                            jQuery('#buyForm-img-w').attr('src', imgSrc).css('height', 'auto');
                            jQuery('#buyForm-itemName-w').text(itemName);

                            orderWarning();
                        }
                    }

                    return false;
        }
            );

            if(jQuery('#season').length){
                jQuery('#season').change(function () {
                    if(jQuery(this).val()=='zima'){
                        jQuery('#pin').attr("disabled","");
                        jQuery('#pin').show();
                    }else{
                        jQuery('#pin').attr("disabled","disabled");
                        jQuery('#pin').hide();
                    }
                });
            }

            // поиск по автомобилю


        });

$.fn.emptySelect = function() {
    return this.each(function(){
      if (this.tagName=='SELECT') this.options.length = 1;
    });
}

$.fn.loadSelect = function(optionsDataArray) {
    return this.emptySelect().each(function(){
      if (this.tagName=='SELECT') {
        var selectElement = this;
        $.each(optionsDataArray,function(index,optionData){
          var option = new Option(optionData.caption,
                                  optionData.value);
          if (optionData.selected) {
                option.selected = true;
          }
          if ($.browser.msie) {
            selectElement.add(option);
          }
          else {
            selectElement.add(option,null);
          }
        });
      }
    });
}

function change_b(ajaxurl, ob) {
    brandValue = jQuery(ob).val();
    sid = jQuery(ob).attr('id');

    if(sid=='ta_brand')
        pref = '#ta';
    else
        pref = '#wa';

    model = jQuery(pref+'_model');
    year = jQuery(pref+'_year');
    mod = jQuery(pref+'_mod');

    year.attr("disabled", true).emptySelect();
    mod.attr("disabled", true).emptySelect();

    if (brandValue == 0) {
        model.attr("disabled",true).emptySelect();
    }else{
        model.attr("disabled",false);
        $.getJSON(ajaxurl, {brand:brandValue}, function (data){model.loadSelect(data);});
    }
}



function change_m(ajaxurl, ob) {
    modelValue = jQuery(ob).val();
    sid = jQuery(ob).attr('id');

    if(sid=='ta_model')
        pref = '#ta';
    else
        pref = '#wa';

    year = jQuery(pref+'_year');
    mod = jQuery(pref+'_mod');

    mod.attr("disabled", true).emptySelect();

    if (modelValue == 0) {
        year.attr("disabled",true).emptySelect();
    }else{
        year.attr("disabled",false);
        $.getJSON(ajaxurl, {model:modelValue}, function (data){year.loadSelect(data);});
    }
}


function change_y(ajaxurl, ob) {
    yearValue = jQuery(ob).val();
    sid = jQuery(ob).attr('id');

    if(sid=='ta_year')
        mod = jQuery('#ta_mod');
    else
        mod = jQuery('#wa_mod');

    if (yearValue == 0) {
        mod.attr("disabled",true).emptySelect();
    }else{
        mod.attr("disabled",false);
        $.getJSON(ajaxurl, {year:yearValue}, function (data){mod.loadSelect(data);});
    }
}
function change_mod(ajaxurl, obj) {
    var submit = null;
    if($(obj).attr('id') == 'ta_mod') {
        submit = $('#ta_submit');
    } else {
        submit = $('#wa_submit');
    }
    if ($(obj).val() == 0) {
        submit.attr("disabled", true);
    } else {
        submit.attr("disabled", false);
    }
}

function validateRange (obj, min, max) {
    var count = $(obj).val().replace(/[^0-9]*/g, '').replace(/^[0]*/, '');
    if (count.toString().length < 1) {
        count = min;
    }
    if (count < min) {
        count = min;
    } else if((typeof count != 'undefined') && (count > max)) {
        count = max;
    }
    $(obj).val(count);
}
$(document).ready(function() {
    $("#ta_form button[type='reset']").click(function(){
        $('#ta_brand option[value=0]').attr('selected', 'selected');
        $('#ta_brand').change();
        $('#ta_submit').attr('disabled', 'disabled');
    });
    $("#wa_form button[type='reset']").click(function(){
        $('#wa_brand option[value=0]').attr('selected', 'selected');
        $('#wa_brand').change();
        $('#wa_submit').attr('disabled', 'disabled');
    });
    var tp = "#tp_brand,#tp_width,#tp_height,#tp_diameter,#tp_season,#tp_pin";
    $(tp).change(function() {
        var elements = tp.split(',');
        var bool = false;
        $('#tp_submit').attr('disabled', 'disabled');
        for (var i = 0; i < elements.length; i++) {
            if ($(elements[i]).val() != 0) {
                bool = true;
            }
        };
        if (bool) {
            $('#tp_submit').removeAttr('disabled');
        } else {
            $('#tp_submit').attr('disabled', 'disabled');
        }
    });
    $("#tp_form button[type='reset']").click(function() {
        $('#tp_submit').attr('disabled', 'disabled');
    });
    var wp = "#wp_brand,#wp_apperture,#wp_center,#wp_width,#wp_diameter,#wp_grab,#wp_count";
    $(wp).change(function() {
        var elements = wp.split(',');
        var bool = false;
        for (var i = 0; i < elements.length; i++) {
            if ($(elements[i]).val() != 0) {
                bool = true;
                break;
            }
        };
        if (bool) {
            $('#wp_submit').removeAttr('disabled');
        } else {
            $('#wp_submit').attr('disabled', 'disabled');
        }
    });
    $("#wp_form button[type='reset']").click(function() {
        $('#wp_submit').attr('disabled', 'disabled');
    });
});