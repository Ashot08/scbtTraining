jQuery(function ($) {
  var $coachAccess = $('#mbla_coach_access_holder').find('tr'),
    $userRoleWrap = $('.user-role-wrap:first'),
    $roleSelect = $('select#role'),
    $select2 = $('[data-mbla-select-2]'),
    $materialSelect = $('#mbla_stats_material_select'),
    $statsDateTo = $("#mbla_stats_date_to"),
    $statsDateFrom = $("#mbla_stats_date_from");

  if ($coachAccess.length && $userRoleWrap.length) {
    $coachAccess.hide();

    $coachAccess.insertAfter($userRoleWrap);

    checkUserAccessBlock();
  }

  $('.js-mbl-filter-toggle-th').on('click', function (e) {
    e.preventDefault();

    $('body').toggleClass('mbl-filter-visible').removeClass('mbl-search-visible');
  });

  $('.js-mbl-search-toggle-th').on('click', function (e) {
    e.preventDefault();

    $('body').toggleClass('mbl-search-visible').removeClass('mbl-filter-visible');
  });

  $roleSelect.on('change', function () {
    checkUserAccessBlock();
  });

  $('#mbla_coach_access_all input[type="checkbox"]').on('change', function () {
    var $this = $(this),
      $configRows = $('#mbla_coach_access .mbla-autotraining-config-row:not(#mbla_coach_access_all)');

    if ($this.prop('checked')) {
      $configRows.addClass('wpma_disabled_field');
      $configRows.find('input[type="checkbox"]').prop('checked', true);
    } else {
      $configRows.removeClass('wpma_disabled_field');
    }
  });

  $('#mbla_coach_access_stats input[type="checkbox"]').on('change', function () {
    var $this = $(this),
      $configRows = $('#mbla_coach_stats .mbla-autotraining-config-row:not(#mbla_coach_access_stats)');

    if (!$this.prop('checked')) {
      $configRows.addClass('wpma_disabled_field');
    } else {
      $configRows.removeClass('wpma_disabled_field');
    }
  });

  $('#mbl_autotraining_checkbox').on('change', function () {
    var $this = $(this),
        $options = $('#mbla_autotraining_options');

    if($this.prop('checked')) {
      $options.removeClass('hidden');
    } else {
      $options.addClass('hidden');
    }
  });


  function checkUserAccessBlock() {
    if ($roleSelect.length && $roleSelect.val() === 'coach') {
      $coachAccess.fadeIn('fast');
    } else {
      $coachAccess.hide();
    }
  }

  if ($select2.length && typeof $select2.select2 !== 'undefined') {
    $select2.select2();
  }

  if ($materialSelect.length && typeof $materialSelect.select2 !== 'undefined') {
    $materialSelect.select2({
      allowClear: true,
      ajax: {
        url: ajaxurl,
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            q: params.term,
            action: 'mbla_stats_materials'
          };
        },
        processResults: function (data) {
          var options = [];
          if (data) {
            $.each(data, function (index, text) {
              options.push({ id: text[0], text: text[1] });
            });
          }
          return {
            results: options
          };
        },
        cache: true
      },
      minimumInputLength: 0
    });
  }

  $('.mbla-dates-select')
    .on('click', '.selection', function () {
      var $holder = $(this).closest('.mbla-dates-select');
      $holder.addClass('opened');
      $holder.find('#mbla_stats_date_to, #mbla_stats_date_from').each(function () {
        $(this).datepicker('refresh');
      });
    })
    .on('click', '.mbla-date-close', function () {
      $(this).closest('.mbla-dates-select').removeClass('opened');
      updateDatePlaceholder();
      return false;
    })
    .on('click', '.mbla-date-submit', function () {
      $(this).closest('.mbla-dates-select').removeClass('opened');
      updateDatePlaceholder();
      updateHomeworkStats();
      return false;
    });

  if ($statsDateTo.length) {
    $statsDateTo.datepicker({
      dateFormat: 'dd.mm.yy',
      altField: '#mbla_stats_date_to_input'
    });
  }
  if ($statsDateFrom.length) {
    $statsDateFrom.datepicker({
      dateFormat: 'dd.mm.yy',
      defaultDate: $('#mbla_stats_date_from').data('start-date'),
      altField: '#mbla_stats_date_from_input'
    }).bind("change", function () {
      var minValue = $(this).val();
      minValue = $.datepicker.parseDate("dd.mm.yy", minValue);

      if (minValue) {
        minValue.setDate(minValue.getDate());
        $("#mbla_stats_date_to").datepicker("option", "minDate", $(this).val());
      }
    });
  }

  $('.mbla-form-submit').on('click', updateHomeworkStats);
  $('.mbla-form-clear').on('click', function () {
    clearHomeworkStatsForm();
    updateHomeworkStats();
  });

  $('.mbla-stats-filter-button').on('click', function () {
    $('.mbla-stats-filter-block').toggleClass('opened');
  });

  function clearHomeworkStatsForm() {
    var $form = $('#mbla-stats-filter'),
      today = new Date(),
      lastWeek = new Date(today.getFullYear(), today.getMonth(), today.getDate() - 7);

    $form[0].reset();
    $form.find('[data-mbla-select-2]').val('').trigger('change');
    $form.find('#mbla_stats_material_select').val('').trigger('change');

    $('#mbla_stats_date_to_input').attr('value', today.getDay() + '.' + today.getMonth() + '.' + today.getFullYear());
    $('#mbla_stats_date_from_input').attr('value', lastWeek.getDay() + '.' + lastWeek.getMonth() + '.' + lastWeek.getFullYear());

    $('#mbla_stats_date_from').datepicker('setDate', lastWeek);
    $('#mbla_stats_date_to').datepicker('setDate', 'today');
    updateDatePlaceholder();
  }

  function updateHomeworkStats() {
    var $form = $('#mbla-stats-filter'),
      $chartsHolder = $('#mbla-hw-stats-charts'),
      data = $form.serialize();

    mbla_loader($chartsHolder, 'start', true);

    $.post(ajaxurl, data, function (response) {
      $chartsHolder.html(response);
    });
  }

  function updateDatePlaceholder() {
    var dateFrom = $('#mbla_stats_date_from_input').val(),
      dateTo = $('#mbla_stats_date_to_input').val(),
      text;

    if (dateFrom === dateTo) {
      text = dateFrom;
    } else {
      text = (dateFrom + ' - ' + dateTo);
    }

    $('#mbla-dates-placeholder').text(text);
  }

  $.fn.select2.amd.define('customSingleSelectionAdapter', [
    'select2/utils',
    'select2/selection/single',
  ], function (Utils, SingleSelection) {
    const adapter = SingleSelection;
    adapter.prototype.update = function (data) {
      if (data.length === 0) {
        this.clear();
        return;
      }
      var selection = data[0];
      var $rendered = this.$selection.find('.select2-selection__rendered');
      var formatted = this.display(selection, $rendered);
      $rendered.empty().append(formatted);
      $rendered.prop('title', selection.title || selection.text);
    };
    return adapter;
  });

  //For test on settings page
  function iformat(icon) {
    if (!jQuery(icon.element).data('icon')) {
      return icon.text;
    }

    return jQuery(
        '<span class="select-row">'
          + '<i class="iconmoon ' + jQuery(icon.element).data('icon') + '"></i> '
          + icon.text
        + '</span>');
  }

  if( $('*').is('[data-mbla-select-icons]') ) {

    let coachAll = $('#mbla_coach_access_all input[type="checkbox"]');
    let coachAllSelect = $('#mbla_coach_access_all_type');
    let allTypeSelects = $('[data-mbla-select-icons]:not(#mbla_coach_access_all_type)');

    $('[data-mbla-select-icons]').select2({
      width: '180',
      templateSelection: iformat,
      templateResult: iformat,
      selectionAdapter: $.fn.select2.amd.require('customSingleSelectionAdapter'),
      minimumResultsForSearch: Infinity
    });

    coachAll.on('change', function () {
      let $this = $(this);

      if ($this.prop('checked')) {
          coachAllSelect.attr("disabled", false);
          coachAllSelect.trigger('change');
      } else {
          coachAllSelect.attr("disabled", true);
      }
    });

    coachAllSelect.on('change', function () {
        //console.log('dew');
        let $this = $(this);
        allTypeSelects.val($this.val());
        allTypeSelects.select2({
            width: '180',
            templateSelection: iformat,
            templateResult: iformat,
            selectionAdapter: $.fn.select2.amd.require('customSingleSelectionAdapter'),
            minimumResultsForSearch: Infinity
        }).trigger('change');
    });
  }


});

function mbla_loader($elem, action, replace) {
  var tpl = '<div class="loader-ellipse" loader>' +
    '<span class="loader-ellipse__dot"></span>' +
    '<span class="loader-ellipse__dot"></span>' +
    '<span class="loader-ellipse__dot"></span>' +
    '<span class="loader-ellipse__dot"></span>' +
    '</div>';

  action = action || 'start';
  replace = replace !== false;

  if (action === 'start') {
    $elem[replace ? 'html' : 'append'](tpl)
  } else if (action === 'stop') {
    $elem.find('[loader]').remove();
  }
}
function mbla_loader_layout($elem, action)
{
  var $holder = jQuery('<div />', {'class' : 'mbla-loader-holder'});
  if (action === 'start') {
    mbla_loader($holder);
    $elem.append($holder);
  } else if (action === 'stop') {
    $elem.find('.mbla-loader-holder').remove();
  }
}
