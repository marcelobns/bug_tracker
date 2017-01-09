document.addEventListener("DOMContentLoaded", function() {
    $('th.actions a').prepend('<i class="fa fa-plus-circle fa-lg"></i>&nbsp;');
    $('td.actions a[href*="view"]').html('<i class="fa fa-file-text-o fa-lg"></i>');
    $('td.actions a[href*="edit"]').html('<i class="fa fa-pencil fa-lg"></i>');
    $('form[action*="delete"] + a').html('<i class="fa fa-trash-o fa-lg"></i>');
    $('.index table').addClass('table table-condensed table-hover');

    $('div.input:not(.checkbox)').addClass('form-group');
    $('div.input input:not([type="submit"]):not([type="checkbox"]), select, textarea').addClass('form-control');
    $.each($('input[type="checkbox"]'), function(i,o){
        $(o).prependTo($('label[for='+o.id+']'));
    });

    $('.paging .prev a, .paging .prev.disabled').text('«');
    $('.paging .next a, .paging .next.disabled').text('»');

    $('.text-uppercase').blur(function(e){
        e.currentTarget.value = e.currentTarget.value.toUpperCase();
    });

    $('.refresh').click(function(){
        $('.refresh').addClass('fa-spin');
    });

    $('.selectize').selectize({
        selectOnTab: true
    });

    FormFilter.set();
    Bootstrap.set();
    Normalize.set();

    $( "#from" ).datepicker($.extend(locale_date, {
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    }));
    $( "#to" ).datepicker($.extend(locale_date, {
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    }));
}, false);

var Normalize = {
    set : function(){
        $('.fade-in').hide();
        $('.fade-in').fadeIn();
        $('.message').animate({
            opacity: 0.75
        }, 2200);
        $('.message').hover(function(){
            $('.message').css('opacity', 1);
        },function(){
            $('.message').css('opacity', 0.6);
        });
        $('.date_picker').datepicker(locale_date);
        return true;
    },
    date:function(){
        $.each($('.date_picker'), function(i, o){
            if($(o).val() !== ""&& $(o).val().indexOf('/') <= 0){
                var timestamp = $(o).val().split(' ');
                var date = timestamp[0].split('-');
                $(o).val(date[2]+'/'+date[1]+'/'+date[0]);
            }
        });
    }
};
var Bootstrap = {
    set : function(){
        this.modal.removeData();
        return true;
    },
    modal : {
        removeData : function(){
            $('body').on('hide.bs.modal', '.modal', function(){
                $('.modal-content').html('');
                $(this).removeData('bs.modal');
            });
        }
    }
};
var Loading = {
    set :function(){
        this.indicator()
        return true;
    },
    indicator : function(){
        $('.loader').on('click', function() {
            $('#loading-indicator').fadeIn();
        });
        $(document).ajaxSend(function(event, request, settings) {
            $('#loading-indicator').fadeIn();
        });
        $(document).ajaxComplete(function(event, request, settings) {
            $('#loading-indicator').fadeOut();
        });
    }
};
var FormFilter = {
    set : function(){
        $('.submitFormFilter').click(function(){
            if(('.formFilter').data('changed'))
                $('.formFilter').submit();
        });
        $(':input').change(function() {
            $('.formFilter').data('changed', true);
        });

        $('.filter .dropdown-menu').on('click', function (e) {
            $('.filter').hasClass('open') && e.stopPropagation();
        });

        $('.filter').on('shown.bs.dropdown', function (e) {
            $('#'+ e.currentTarget.id +' .select2-search-field input').focus();
        });
        $('.filter').on('hide.bs.dropdown', function (e) {
            $('#'+ e.currentTarget.id +' .select2-open').select2('close');
        });
        $('.Apply').on('click', function (e) {
            $('.refresh').addClass('fa-spin');
            $('.btn-group').hasClass('open') && e.stopPropagation();
            if($('.formFilter').data('changed')){
                $('.formFilter').submit();
            }
        });
        $('.Clear').on('click', function (e) {
            $('.refresh').addClass('fa-spin');
            $('#'+ e.currentTarget.id + 'Filter').hasClass('open');
            $('#'+ e.currentTarget.id+ 'Filter ' +' :input').val('');
            if($('.formFilter').data('changed')){
                $('.formFilter').submit();
            }
        });
    }
};
var Assets = {
    isset : function(args){
        if (typeof args != 'undefined') {
            return true;
        }
        return args;
    }
};

var locale_date = {
    dateFormat: 'dd/mm/yy',
    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
    nextText: 'Próximo',
    prevText: 'Anterior'
};
