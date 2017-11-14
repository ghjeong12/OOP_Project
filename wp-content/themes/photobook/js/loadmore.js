jQuery(document).ready(function () {

    // Load more content
    var dt_ppp              = 6; // Post per page
    var dt_pageNumber       = 1;
    var dt_no_more_posts    = photobook_script_vars.no_more_posts;

    jQuery("#dt-ajax-btn").on("click", function () {

        dt_pageNumber++;
        jQuery("#dt-ajax-loading-icon").show();
        jQuery("#dt-ajax-btn").attr('disabled', true);

        var dt_data = {
            action: 'get_ajax_results',
            dt_nonce: photobook_load_more.dt_nonce,
            dt_ppp: dt_ppp,
            dt_pageNumber: dt_pageNumber
        };

        jQuery.post(photobook_load_more.ajax_url, dt_data, function (response) {
            var dt_data = jQuery(response);

            if (dt_data.length) {
                jQuery("#dt-append-ajax-data").append(dt_data);
                jQuery("#dt-ajax-loading-icon").hide();
                jQuery("#dt-ajax-btn").attr("disabled", false);
            } else {
                jQuery("#dt-ajax-loading-icon").hide();
                jQuery("#dt-ajax-btn").attr("disabled", true);
                jQuery("#dt-ajax-btn").html( "<p>" + dt_no_more_posts + "</p>" );
            }
        });
        return false;
    });

});