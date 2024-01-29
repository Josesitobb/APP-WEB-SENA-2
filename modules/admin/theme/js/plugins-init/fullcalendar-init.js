!function(e) {
    "use strict";
    var t = function() {
        this.$body = e("body"), this.$modal = e("#event-modal"), this.$event = "#external-events div.external-event", this.$calendar = e("#calendar"), this.$saveCategoryBtn = e(".save-category"), this.$categoryForm = e("#add-category form"), this.$extEvents = e("#external-events"), this.$calendarObj = null
    };
    t.prototype.onDrop = function(t, n) {
        var a = t.data("eventObject"),
            o = t.attr("data-class"),
            i = e.extend({}, a);
        i.start = n, o && (i.className = [o]), this.$calendar.fullCalendar("renderEvent", i, !0), e("#drop-remove").is(":checked") && t.remove()
    }, t.prototype.onEventClick = function(t, n, a) {
        var o = this,
            i = e("<form></form>");
        i.append("<label>Change event name</label>");
        i.append("<div class='input-group'><input class='form-control' type=text value='" + t.title + "' /><span class='input-group-btn'><button type='submit' class='btn btn-success waves-effect waves-light'><i class='fa fa-check'></i> Save</button></span></div>");
        i.append("<label>Estilista</label><input class='form-control' type='text' name='stylist' value='" + (t.stylist || '') + "' />");
        i.append("<label>Cliente</label><input class='form-control' type='text' name='client' value='" + (t.client || '') + "' />");
        i.append("<label>Servicio</label><input class='form-control' type='text' name='service' value='" + (t.service || '') + "' />");
        i.append("<label>Fecha</label><input class='form-control' type='text' name='date' value='" + (t.date || '') + "' />");
        i.append("<label>Color</label><input class='form-control' type='text' name='color' value='" + (t.color || '') + "' />");
        o.$modal.modal({
            backdrop: "static"
        });
        o.$modal.find(".delete-event").show().end().find(".save-event").hide().end().find(".modal-body").empty().prepend(i).end().find(".delete-event").unbind("click").on("click", function() {
            o.$calendarObj.fullCalendar("removeEvents", function(e) {
                return e._id == t._id
            }), o.$modal.modal("hide")
        }), o.$modal.find("form").on("submit", function() {
            return t.title = i.find("input[type=text]").val(), t.stylist = i.find("input[name='stylist']").val(), t.client = i.find("input[name='client']").val(), t.service = i.find("input[name='service']").val(), t.date = i.find("input[name='date']").val(), t.color = i.find("input[name='color']").val(), o.$calendarObj.fullCalendar("updateEvent", t), o.$modal.modal("hide"), !1
        })
    }, t.prototype.onSelect = function(t, n, a) {
        var o = this;
        o.$modal.modal({
            backdrop: "static"
        });
        var i = e("<form></form>");
        i.append("<div class='row'></div>");
        i.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Event Name</label><input class='form-control' placeholder='Insert Event Name' type='text' name='title'/></div></div>");
        i.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Estilista</label><input class='form-control' placeholder='Insert Stylist Name' type='text' name='stylist'/></div></div>");
        i.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Cliente</label><input class='form-control' placeholder='Insert Client Name' type='text' name='client'/></div></div>");
        i.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Servicio</label><input class='form-control' placeholder='Insert Service Name' type='text' name='service'/></div></div>");
        i.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Fecha</label><input class='form-control' placeholder='Insert Date' type='text' name='date'/></div></div>");
        i.find(".row").append("<div class='col-md-6'><div class='form-group'><label class='control-label'>Color</label><input class='form-control' placeholder='Insert Color' type='text' name='color'/></div></div>");
        o.$modal.find(".delete-event").hide().end().find(".save-event").show().end().find(".modal-body").empty().prepend(i).end().find(".save-event").unbind("click").on("click", function() {
            i.submit()
        }), o.$modal.find("form").on("submit", function() {
            var e = i.find("input[name='title']").val(),
                a = i.find("input[name='stylist']").val(),
                s = i.find("input[name='client']").val(),
                c = i.find("input[name='service']").val(),
                d = i.find("input[name='date']").val(),
                l = i.find("input[name='color']").val();
            return null !== e && 0 != e.length ? (o.$calendarObj.fullCalendar("renderEvent", {
                title: e,
                start: t,
                end: n,
                allDay: !1,
                className: l,
                stylist: a,
                client: s,
                service: c,
                date: d,
                color: l
            }, !0), o.$modal.modal("hide")) : alert("You have to give a title to your event"), !1
        }), o.$calendarObj.fullCalendar("unselect")
    }, t.prototype.enableDrag = function() {
        e(this.$event).each(function() {
            var t = {
                title: e.trim(e(this).text())
            };
            e(this).data("eventObject", t), e(this).draggable({
                zIndex: 999,
                revert: !0,
                revertDuration: 0
            })
        })
    }, t.prototype.init = function() {
        this.enableDrag();
        var t = new Date,
            n = (t.getDate(), t.getMonth(), t.getFullYear(), new Date(e.now())),
            a = [{
                title: "Hey!",
                start: new Date(e.now() + 158e6),
                className: "bg-dark"
            }, {
                title: "See John Deo",
                start: n,
                end: n,
                className: "bg-danger"
            }, {
                title: "Buy a Theme",
                start: new Date(e.now() + 338e6),
                className: "bg-primary"
            }],
            o = this;
        o.$calendarObj = o.$calendar.fullCalendar({
            slotDuration: "00:15:00",
            minTime: "08:00:00",
            maxTime: "19:00:00",
            defaultView: "month",
            handleWindowResize: !0,
            height: e(window).height() - 200,
            header: {
                left: "prev,next today",
                center: "title",
                right: "month,agendaWeek,agendaDay"
            },
            events: a,
            editable: !0,
            droppable: !0,
            eventLimit: !0,
            selectable: !0,
            drop: function(t) {
                o.onDrop(e(this), t)
            },
            select: function(e, t, n) {
                o.onSelect(e, t, n)
            },
            eventClick: function(e, t, n) {
                o.onEventClick(e, t, n)
            }
        }), this.$saveCategoryBtn.on("click", function() {
            var e = o.$categoryForm.find("input[name='category-name']").val(),
                t = o.$categoryForm.find("select[name='category-color']").val();
            null !== e && 0 != e.length && (o.$extEvents.append('<div class="external-event bg-' + t + '" data-class="bg-' + t + '" style="position: relative;"><i class="fa fa-move"></i>' + e + "</div>"), o.enableDrag())
            
        })
        
    }, e.CalendarApp = new t, e.CalendarApp.Constructor = t
}(window.jQuery), function(e) {
    "use strict";
    e.CalendarApp.init()
}(window.jQuery);