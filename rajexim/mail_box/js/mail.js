
// Mail.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -

"use strict";

 $(document).ready(function() {



    // MAILBOX-COMPOSE.HTML
    // =================================================================

    if ($('#mailbox-mail-compose').length) {


        // SUMMERNOTE
        // =================================================================
        // Require Summernote
        // http://hackerwins.github.io/summernote/
        // =================================================================
        $('#mailbox-mail-compose').summernote({
            height:500
        });


        // Show The CC Input Field
        // =================================================================
        $('#mailbox-toggle-cc').on('click', function(){
            $('#mailbox-cc-input').toggleClass('hide');
        });



        // Show The BCC Input Field
        // =================================================================
        $('#mailbox-toggle-bcc').on('click', function(){
            $('#mailbox-bcc-input').toggleClass('hide');
        });



        // Attachment button.
        // =================================================================
        $('.btn-file :file').on('fileselect', function(event, numFiles, label, fileSize) {
            $('#mailbox-attach-file').html('<strong class="box-block text-capitalize"><i class="fa fa-paperclip fa-fw"></i> '+label+'</strong><small class="text-muted">'+fileSize+'</small>');
        });


        return;
    }





    // MAILBOX-MESSAGE.HTML
    // =================================================================

    // SUMMERNOTE
    // =================================================================
    // Require Summernote
    // http://hackerwins.github.io/summernote/
    // =================================================================
    if( $('#mailbox-mail-textarea').length ){
        $('#mailbox-mail-textarea').on('click', function(){
            $(this).empty().summernote({
                height:300,
                focus: true
            });
            $('#mailbox-mail-send-btn').removeClass('hide');
        });
        return;
    }





});

