(function ($) {
    $(document).ready(
        function () {
            $('[data-toggle="popover"]').popover({placement: 'left', trigger: "manual"});
        }
    );
    $(document).on('click', '[data-toggle="popover"]', function (e) {
        $(e.target).popover('show');
    }).on('shown.bs.popover', function (e) {
        var container = $(e.target);
        container.on('mouseout', function () {
                container.popover('hide');
        });
    });


})(jQuery);