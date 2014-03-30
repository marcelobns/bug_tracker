//TODO: Organizar(Modulos)
$(function(){
    $('.select2').select2();
    $(".select2-open").select2().on('select2-focus', function(){
        $(this).select2('open');
    }).on("select2-open", function() {
        $("#select2-drop-mask").hide();
    });

    $('.fade-in').hide();
    $('.fade-in').fadeIn();

    $('.message').animate({
        opacity: 0.6
    }, 1800);
    $('.message').hover(function(){
        $('.message').css('opacity', 1);
    },function(){
        $('.message').css('opacity', 0.6);
    });

    if(localStorage['actions-toggle'] === undefined){
        localStorage['actions-toggle'] = 'open';
    }
    if(localStorage['actions-toggle'] == 'open'){
        actions_open();
    } else {
        actions_close();
    }
});

$('body').on('hide.bs.modal', '.modal', function(){
    $(".modal-content").html('');
    $(this).removeData('bs.modal');
});

$('.loader').on('click', function() {
    $('#loading-indicator').fadeIn();
});

$(document).ajaxSend(function(event, request, settings) {
    $('#loading-indicator').fadeIn();
});

$(document).ajaxComplete(function(event, request, settings) {
    $('#loading-indicator').fadeOut();
});

$('.uppercase').blur(function(e){
    $('#'+e.currentTarget.id).val(($('#'+e.currentTarget.id).val()).toUpperCase());
});

function actions_close(){
    $('.actions-toggle').prev().css('width', '100%');
    $('.actions-toggle').prev().css('float', 'none');
    $('.actions-toggle').hide();
    $('#actions-hide').hide();
    $('#actions-show').show();
    localStorage['actions-toggle'] = "close";
}
function actions_open(){
    $('#actions-show').hide();
    $('.actions-toggle').prev().animate({
        width: '76%',
        float: 'right'
    }, 300, function(){
        $('.actions-toggle').show();
        $('#actions-hide').show();
    });
    localStorage['actions-toggle'] = "open";
}
$('#actions-hide').click(function(){
    actions_close();
    });
$('#actions-show').click(function(){
    actions_open();
});
$('.phone').mask('9999-9999');

$('.submitFormFilter').click(function(){
    if(('.formFilter').data('changed'))
        $('.formFilter').submit();
});
$(':input').change(function() {
    $('.formFilter').data('changed', true);
});
if(!Modernizr.inputtypes.date){
    $('.date.filter-normalized').attr('type','date');
    $('input[type=date]').mask('9999-99-99');
    $('input[type=date]').datepicker({
            dateFormat: 'yy-mm-dd'
        });
};
$('.date.filter-normalized').attr('type','date');

$('.date-filter .dropdown-menu').on('click', function (e) {
    $('.date-filter').hasClass('open') && e.stopPropagation();
});
$('.date.filter-normalized').attr('type','date');

var opacity;
$('tr').hover(function(e){
    opacity = $('#'+ e.currentTarget.id).css('opacity');
    $('#'+ e.currentTarget.id).css('opacity', 1);
}, function(e){
    $('#'+ e.currentTarget.id).css('opacity', opacity);
});

$('.Apply').on('click', function (e) {
    $('.btn-group').hasClass('open') && e.stopPropagation();
    if($('.formFilter').data('changed'))
        $('.formFilter').submit();
});