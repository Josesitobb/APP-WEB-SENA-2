// Define una función anónima que se ejecuta inmediatamente con el parámetro 'e' (jQuery).
!function(e) {
    "use strict";
    
    // Crea un objeto 't' que contiene referencias a elementos del DOM y configuraciones.
    var t = function() {
        this.$body = e("body");
        this.$modal = e("#event-modal");
        this.$event = "#external-events div.external-event";
        this.$calendar = e("#calendar");
        this.$saveCategoryBtn = e(".save-category");
        this.$categoryForm = e("#add-category form");
        this.$extEvents = e("#external-events");
        this.$calendarObj = null;
    };
    
    // Define un método 'onDrop' para manejar eventos de arrastrar y soltar en el calendario.
    t.prototype.onDrop = function(t, n) {
        var a = t.data("eventObject"),
            o = t.attr("data-class"),
            i = e.extend({}, a);
        i.start = n;
        o && (i.className = [o]);
        this.$calendar.fullCalendar("renderEvent", i, !0);
        e("#drop-remove").is(":checked") && t.remove();
    };

    // Define un método 'onEventClick' para manejar clics en eventos del calendario.
    t.prototype.onEventClick = function(t, n, a) {
        var o = this,
            i = e("<form></form>");
        // ... (crea un formulario para editar detalles del evento)
        // ... (configura acciones al hacer clic en botones en el modal)
        // ... (actualiza el evento en el calendario)
    };

    // Define un método 'onSelect' para manejar la selección de fechas en el calendario.
    t.prototype.onSelect = function(t, n, a) {
        var o = this;
        // ... (crea un formulario para agregar un nuevo evento)
        // ... (configura acciones al hacer clic en botones en el modal)
        // ... (renderiza el nuevo evento en el calendario)
    };

    // Define un método 'enableDrag' para habilitar la funcionalidad de arrastrar y soltar para eventos.
    t.prototype.enableDrag = function() {
        e(this.$event).each(function() {
            var t = {
                title: e.trim(e(this).text())
            };
            e(this).data("eventObject", t);
            e(this).draggable({
                zIndex: 999,
                revert: !0,
                revertDuration: 0
            });
        });
    };

    // Define el método 'init' para inicializar la aplicación.
    t.prototype.init = function() {
        this.enableDrag();
        // ... (crea el objeto 'o' con configuraciones iniciales del calendario)
        this.$calendarObj = this.$calendar.fullCalendar(o);
        // ... (configura acciones al hacer clic en botones y eventos en el calendario)
        // ... (crea eventos de muestra para el calendario)
    };

    // Crea una instancia de la clase 't' y llama al método 'init' para iniciar la aplicación.
    e.CalendarApp = new t;
    e.CalendarApp.Constructor = t;
}(window.jQuery);

// Llama a la función 'init' de 'CalendarApp' tan pronto como se cargue jQuery.
(function(e) {
    "use strict";
    e.CalendarApp.init();
})(window.jQuery);
