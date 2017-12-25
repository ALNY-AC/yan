// @ts-nocheck
var config = {

}

$(function () {

    $(document).on('click', '[data-panel-id]', function () {
        var $this = $(this);
        $('[data-panel-id]').parent().removeClass('active');
        $($this).parent().addClass('active');

        var id = $this.attr('data-panel-id');

        $('.o-panel-hide').hide();
        $(id).show();

        return false;
    });

})