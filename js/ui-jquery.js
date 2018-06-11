$(function () {
    $("#slider-range-min").slider({
      range: "min",
      value: 500,
      min: 1,
      max: 1000,
      slide: function (event, ui) {
        $("#price").val("€" + ui.value);
      }
    });
    $("#price").val($("#slider-range-min").slider("value"));
  });

  // DATE PICKER FORM

  $(function () {
    var dateFormat = "dd-mm-yy",
      from = $("#inputCheckIn")
        .datepicker({
          defaultDate: "+1w",
          dateFormat: "dd-mm-yy",
          defaultDate: +0,
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
      to = $("#inputCheckOut").datepicker({
        defaultDate: "+1w",
        dateFormat: "dd-mm-yy",
        defaultDate: +2,
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

    // DATE PICKER CONFIRM

    $(function () {
      var dateFormat = "dd-mm-yy",
        from = $("#inputBookIn")
          .datepicker({
            defaultDate: "+1w",
            dateFormat: "dd-mm-yy",
            defaultDate: +0,
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
        to = $("#inputBookOut").datepicker({
          defaultDate: "+1w",
          dateFormat: "dd-mm-yy",
          defaultDate: +2,
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