jQuery(document).ready(function($) {
    $(document).on('click', '.pagination a.page-numbers', function(e) {
        e.preventDefault();

        var page = $(this).data('page'),
            $container = $('.tribe-common-l-container');

        $.ajax({
            url: ajaxpagination.ajax_url,
            type: 'POST',
            data: {
                action: 'ajax_pagination',
                nonce: ajaxpagination.nonce,
                page: page
            },
            beforeSend: function() {
                $container.find('.table-responsive').fadeOut('slow');
            },
            success: function(response) {
                $container.html(response);
            }
        });
    });
});

