$(function () {
    $("#slider-range-min").slider({
      range: "min",
      value: 37,
      min: 1,
      max: 1000,
      slide: function (event, ui) {
        $("#amount").val("€" + ui.value);
      }
    });
    $("#amount").val("€" + $("#slider-range-min").slider("value"));
  });

  // DATE PICKER

  $(function () {
    var dateFormat = "dd-mm-yy",
      from = $("#search-from")
        .datepicker({
          defaultDate: "+1w",
          dateFormat: "dd-mm-yy",
          minDate: 0,
          firstDay: 1,
          dayNames: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
          dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
          monthNamesShort: ["Jan", "Fev", "Mars", "Avr", "Mai", "Juin", "Juil", "Aôut", "Sep", "Oct", "Nov", "Dec"],
          changeMonth: true,
          numberOfMonths: 1
        })
        .on("change", function () {
          to.datepicker("option", "minDate", getDate(this));
        }),
      to = $("#search-to").datepicker({
        defaultDate: "+1w",
        dateFormat: "dd-mm-yy",
        minDate: 1,
        firstDay: 1,
        dayNames: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
        dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        monthNamesShort: ["Jan", "Fev", "Mars", "Avr", "Mai", "Juin", "Juil", "Aôut", "Sep", "Oct", "Nov", "Dec"],
        changeMonth: true,
        numberOfMonths: 1

      })
        .on("change", function () {
          from.datepicker("option", "maxDate", getDate(this));
        });

    function getDate(element) {
      var date;
      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }

      return date;
    }
  });