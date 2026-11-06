/**
 * SIBACOM Admin JavaScript
 */
jQuery(document).ready(function ($) {
  // WordPress Media Library Uploader
  $(document).on('click', '.sibacom-media-upload-btn', function (e) {
    e.preventDefault();
    var button = $(this);
    var targetInputId = button.data('target');
    var targetInput = $(targetInputId);

    var customUploader = wp.media({
      title: 'Select or Upload Logo / Image',
      button: {
        text: 'Use Selected Image'
      },
      multiple: false
    });

    customUploader.on('select', function () {
      var attachment = customUploader.state().get('selection').first().toJSON();
      targetInput.val(attachment.url).trigger('change');
      
      // Update preview if present
      var preview = button.siblings('.sibacom-media-preview');
      if (preview.length) {
        preview.attr('src', attachment.url).show();
      } else {
        button.parent().after('<img src="' + attachment.url + '" class="sibacom-media-preview" style="display:block; margin-top:8px; max-height:80px;" />');
      }
    });

    customUploader.open();
  });

  // AJAX One-Click Demo Import
  $('#sibacom-run-import-btn').on('click', function (e) {
    e.preventDefault();
    var btn = $(this);
    var statusBox = $('#sibacom-import-status');

    if (!confirm('This will create the official SIBACOM pages, schedule sessions, keynote speakers, sponsor galleries, and FAQs. Existing pages with the same slug will not be overwritten. Proceed?')) {
      return;
    }

    btn.prop('disabled', true).text('Importing Demo Content...');
    statusBox.html('<div style="padding:15px; background:#EFF6FF; border:1px solid #BFDBFE; border-radius:10px; color:#1E40AF; margin-top:15px;"><span class="spinner is-active" style="float:none; margin:0 8px 0 0;"></span> Setting up pages, menu, schedules, and speakers...</div>');

    $.ajax({
      url: sibacomAdminData.ajaxUrl,
      type: 'POST',
      data: {
        action: 'sibacom_run_demo_import',
        nonce: sibacomAdminData.nonce
      },
      success: function (res) {
        if (res.success) {
          statusBox.html('<div style="padding:15px; background:#F0FDF4; border:1px solid #BBF7D0; border-radius:10px; color:#166534; margin-top:15px;"><strong>Success!</strong> ' + res.data.message + ' <a href="' + window.location.origin + '" target="_blank" style="margin-left:10px; font-weight:bold; color:#15803D;">View Homepage &rarr;</a></div>');
          btn.text('Import Completed');
        } else {
          statusBox.html('<div style="padding:15px; background:#FEF2F2; border:1px solid #FECACA; border-radius:10px; color:#991B1B; margin-top:15px;"><strong>Error:</strong> ' + res.data.message + '</div>');
          btn.prop('disabled', false).text('Try Again');
        }
      },
      error: function () {
        statusBox.html('<div style="padding:15px; background:#FEF2F2; border:1px solid #FECACA; border-radius:10px; color:#991B1B; margin-top:15px;"><strong>Error:</strong> An unexpected server error occurred during import.</div>');
        btn.prop('disabled', false).text('Try Again');
      }
    });
  });
});

