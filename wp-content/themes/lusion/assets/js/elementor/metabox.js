(function($){
    "use strict"

    $(document).ready(function(){
        $('.format-type').hide();
        $( ".post-type-post #gallery_metabox" ).hide();
        var post_format = $(".postbox input.post-format").attr("value");

        if($('#post-format-video').is(':checked') || $('#post-format-audio').is(':checked') ){
            $( ".post-type-video" ).show();
        }
        if($('#post-format-quote').is(':checked')){
                 $( ".post-type-quote" ).show();
        }
        if($('#post-format-link').is(':checked')){
                 $( ".post-type-link" ).show();
        }
        if($('#post-format-0').is(':checked') || $('#post-format-image').is(':checked')
            || $('#post-format-gallery').is(':checked')){
            $( "#view-format-boxes" ).hide();
        }
        if($('#post-format-gallery').is(':checked') ){
             $( "#post #gallery_metabox" ).show();
        }
        $('input.post-format').change(function(){
            if($(this).attr("value")=="video" || $(this).attr("value")=="audio"){
                 $( ".post-type-video" ).show();
            }else{
                 $( ".post-type-video" ).hide();
            }
            if($(this).attr("value")=="gallery"){
                 $( "#post #gallery_metabox" ).show();
            }else{
                 $( "#post #gallery_metabox" ).hide();
            }
            if($(this).attr("value")=="link"){
                 $( ".post-type-link" ).show();
            }else{
                 $( ".post-type-link" ).hide();
            }
            if($(this).attr("value")=="quote"){
                 $( ".post-type-quote" ).show();
            }else{
                 $( ".post-type-quote" ).hide();
            }
            if($(this).attr("value")=="image" || $(this).attr("value")=="0" || $(this).attr("value")=="gallery"){
                 $( "#view-format-boxes" ).hide();
            }else{
                 $( "#view-format-boxes" ).show();
            }
        });

        var imgSelectFrame,
            imgPreviews = $('#gallery-metabox ul.images-list').first();

        $(document).on('click', '#gallery-metabox a.gallery-add-images', function(e) {

            e.preventDefault();

            if ( imgSelectFrame ) imgSelectFrame.close();

            imgSelectFrame = wp.media.frames.imgSelectFrame = wp.media({
                title: $(this).data('uploader-title'),
                button: {
                    text: $(this).data('uploader-button-text'),
                },
                multiple: true
            });

            imgSelectFrame.on('select', function() {
                var listIndex = imgPreviews.children('li').index(imgPreviews.children('li:last')),
                    selection = imgSelectFrame.state().get('selection');

                selection.map(function(attachment, i) {
                    attachment = attachment.toJSON();
                    var index                   = listIndex + (i + 1),
                        attachmentThumbnailObj  = attachment.sizes.thumbnail;

                    if ( attachmentThumbnailObj == undefined ) {
                        attachmentThumbnailObj = attachment.sizes.full;
                    }

                    imgPreviews.append('<li>'
                            + '<input type="hidden" name="sn-gallery-id[' + index + ']" value="' + attachment.id + '"/>'
                            + '<img class="image-preview" src="' + attachmentThumbnailObj.url + '"/>'
                            + '<a class="change-image" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image"><i class="dashicons dashicons-edit"></i></a>'
                            + '<a class="remove-image" href="#"><i class="dashicons dashicons-no"></i></a>'
                        + '</li>');
                });
            });

            makeSortable();

            imgSelectFrame.open();

        });

        $(document).on('click', '#gallery-metabox a.change-image', function(e) {

            e.preventDefault();

            var _this = $(this);

            if ( imgSelectFrame ) imgSelectFrame.close();

            imgSelectFrame = wp.media.frames.imgSelectFrame = wp.media({
                title: $(this).data('uploader-title'),
                button: {
                    text: $(this).data('uploader-button-text'),
                },
                multiple: false
            });

            imgSelectFrame.on( 'select', function() {
                var attachment              = imgSelectFrame.state().get('selection').first().toJSON(),
                    attachmentThumbnailObj  = attachment.sizes.thumbnail;

                if ( attachmentThumbnailObj == undefined ) {
                    attachmentThumbnailObj = attachment.sizes.full;
                }

                var selection = imgSelectFrame.state().get('selection');
                console.log(selection);

                _this.closest('li').find('input:hidden').attr('value', attachment.id);
                _this.closest('li').find('img.image-preview').attr('src', attachmentThumbnailObj.url);
            });

            imgSelectFrame.on( 'open', function(){
                var selected = wp.media.attachment( _this.closest('li').find('input:hidden').attr('value') );
                var selection = imgSelectFrame.state().get('selection');
                selection.add( selected ? [selected] : [] );
                console.log(selection);
            });

            imgSelectFrame.open();

        });

        function resetIndex() {
            imgPreviews.children('li').each(function(i) {
                $(this).find('input:hidden').attr('name', 'sn-gallery-id[' + i + ']');
            });
        }

        function makeSortable() {
            imgPreviews.sortable({
                opacity: 0.6,
                stop: function() {
                    resetIndex();
                }
            });
        }

        $(document).on('click', '#gallery-metabox a.remove-image', function(e) {
            e.preventDefault();

            $(this).closest('li').animate({ opacity: 0 }, 200, function() {
                $(this).remove();
                resetIndex();
            });
        });

        makeSortable();
        $('.button-set-inner label').click(function () {
            var $wrapper = $(this).parent().parent();
            var $parent = $(this).parent();

            var old_val = $('input[type="hidden"]', $wrapper).val();
            var new_val = $(this).attr('data-value');
            if (old_val == new_val) {
                if ($parent.hasClass('allow-clear')) {
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                        var clear_value = '';
                        if (typeof ($parent.attr('data-clear-value') != "undefined")) {
                            clear_value = $parent.attr('data-clear-value');
                        }

                        $('input[type="hidden"]', $wrapper).val(clear_value);
                        $('input[type="hidden"]', $wrapper).trigger('change');
                    }
                    else {
                        $(this).addClass('selected');
                        $('input[type="hidden"]', $wrapper).val(new_val);
                        $('input[type="hidden"]', $wrapper).trigger('change');
                    }
                }
                return;
            }

            $('input[type="hidden"]', $wrapper).val(new_val);
            $('label', $wrapper).removeClass('selected');
            $(this).addClass('selected');
            $('input[type="hidden"]', $wrapper).trigger('change');
        })
    });
    $(document).ready(function () {
        $('.section-row').each(function () {
            var $this = $('.mk-toggle-button'),
                default_value = $this.find('input').val();
            var new_val = $(this).data("data-dependency-mother");
            if (default_value == 'true') {
                $this.addClass('mk-toggle-on').trigger('change');
            }else {
                $this.addClass('mk-toggle-off').trigger('change');
            }
            $this.click(function() {
                var $this = $(this);
                if ($this.hasClass('mk-toggle-on')) {
                    $this.removeClass('mk-toggle-on').addClass('mk-toggle-off');
                    $this.find('input').val('false').trigger('change');
                    $('.section-row#enable_header_custom').stop().slideUp();
                } else {
                    $this.removeClass('mk-toggle-off').addClass('mk-toggle-on');
                    $this.find('input').val('true').trigger('change');
                    $('.section-row#enable_header_custom').stop().slideDown();
                }
            });
        })
    })

})(jQuery);
