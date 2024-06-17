window.Travian = {
    applicationId: "travian", Defaults: TravianDefaults || {}, emptyFunction: function () {
    }, ajax: function (options) {
        if (typeof options === "undefined") {
            options = {}
        }
        if (typeof options.url === "undefined") {
            options.url = "ajax.php"
        }
        if (options.data && typeof options.data === "object") {
            options.data.ajaxToken = typeof Travian.motorCosmetologyRioted === "function" ? Travian.motorCosmetologyRioted() : undefined;
            if (options.data.cmd) {
                options.url = options.url + (options.url.indexOf("?") === -1 ? "?" : "&") + "cmd=" + options.data.cmd
            }
        }
        var callbacks = {
            onComplete: options.onComplete || Travian.emptyFunction,
            onSuccess: options.onSuccess || Travian.emptyFunction,
            onError: options.onError
        };
        var requestOptions = Object.assign({}, Travian.Defaults.ajaxOptions || {}, {
            method: "POST",
            dataType: "json",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            headers: {"X-Request": "JSON"},
            complete: function (response, status) {
                callbacks.onComplete(response.data)
            },
            success: function (response, status) {
                var responsePayload = response.response;
                if (responsePayload.data && responsePayload.data.javascript) {
                    eval(responsePayload.data.javascript)
                }
                if (responsePayload.javascript) {
                    eval(responsePayload.javascript)
                }
                if (responsePayload.error) {
                    if (responsePayload.errorMsg === null) {
                        responsePayload.errorMsg = "Ajax Request error and no text. That is not so good."
                    }
                    if (typeof callbacks.onError === "function") {
                        callbacks.onError(responsePayload.data, responsePayload.errorMsg);
                        return
                    }
                } else {
                    if (responsePayload.reload) {
                        window.location.reload()
                    } else {
                        if (responsePayload.redirectTo) {
                            window.location.href = responsePayload.redirectTo
                        }
                    }
                }
                callbacks.onSuccess(responsePayload.data, responsePayload)
            },
            error: function (response, shortDescription, httpResponseTitle) {
                if (typeof callbacks.onError === "function") {
                    callbacks.onError({}, httpResponseTitle)
                }
            }
        }, options);
        return jQuery.ajax(requestOptions)
    }, getDirection: function () {
        if (!this.direction) {
            this.direction = jQuery("body").css("direction").toLowerCase()
        }
        return this.direction
    }, insertScript: (function () {
        var a = [];
        var b = function (c) {
            if (a.length === 0) {
                jQuery("script[src]").each(function (d, e) {
                    e = jQuery(e);
                    a.push({src: e[0].src, id: e[0].id, defer: e[0].defer, defaultURL: false})
                })
            }
            return jQuery.grep(a, function (d) {
                return d.src === c.src
            }).length > 0
        };
        return function (c, d) {
            var e = this;
            if (!c) {
                return
            }
            if (c && c.$family && c.$family.name === "array") {
                jQuery.each(c, function (f, g) {
                    e.insertScript(g)
                });
                return
            }
            if (typeof c === "string") {
                c = {src: c}
            }
            var d = d || this.emptyFunction;
            if (b(c)) {
                d();
                return
            }
            a.push(c);
            jQuery("<script>").attr("type", "text/javascript").attr("id", (c.id ? c.id : undefined)).appendTo("head").on("load", d).attr("src", c.src).attr("defer", !!c.defer)
        }
    })(), popup: function (b, a) {
        a = a || {};
        var c = Object.keys(a).filter(function (d) {
            return a[d]
        }).reduce(function (e, d) {
            return e + "," + d + "=yes"
        }, "");
        return window.open(b, a.id || "_blank", c, true)
    }, isToggleClosed: function (d, c) {
        d = jQuery(d);
        c = jQuery(c);
        var b = (c.attr("class").indexOf("Mirrored") >= 0);
        var a = d.hasClass("hide"), e = a && c.hasClass("switchClosed");
        if (b) {
            e = a && c.hasClass("switchClosedMirrored")
        }
        return e
    }, toggleSwitch: function (c, b) {
        c = jQuery(c);
        b = jQuery(b);
        c.toggleClass("hide");
        var a = (b.attr("class").indexOf("Mirrored") >= 0);
        b.toggleClass("switchClosed");
        if (a) {
            b.toggleClass("switchClosedMirrored")
        }
        b.toggleClass("switchOpened");
        if (a) {
            b.toggleClass("switchOpenedMirrored")
        }
        return this
    }, toggleSwitchDescription: function (c, a, b) {
        if (typeOf(c) === "element") {
            c = [c]
        }
        c.each(function (d) {
            if (d.hasClass("switchClosed")) {
                d.setTitle(a)
            } else {
                d.setTitle(b)
            }
        });
        return this
    }, forceDisplay: function (a) {
        var b = typeof a === "undefined" ? jQuery(".forceDisplayElement") : a;
        b.each(function (c) {
            c.addClass("invisible");
            c.removeClass("invisible")
        })
    }, adjustButtonDisableState: function () {
        jQuery(".disableButtonHandler").each(function (a, b) {
            b = jQuery(b);
            if (b.css("display") === "none" || b.css("visibility") === "hidden") {
                b.find("button").each(function (c, d) {
                    d = jQuery(d);
                    var e = d.attr("olddisabled") === undefined ? d.attr("disabled") === "true" : d.attr("olddisabled") !== "false";
                    d.attr("olddisabled", e).attr("disabled", true)
                })
            } else {
                b.find("button").each(function (c, d) {
                    d = jQuery(d);
                    var e = d.attr("olddisabled");
                    if (e !== undefined) {
                        d.attr("disabled", e !== "false")
                    } else {
                        d.attr("disabled", false)
                    }
                })
            }
        })
    }, isMobile: function () {
        var a = false;
        var b = navigator.userAgent || navigator.vendor || window.opera;
        if (/ipad|ipod|(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|windows nt.+touch|xda|xiino/i.test(b) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(b.substr(0, 4))) {
            a = true
        }
        return a
    }, parseURL: function (b) {
        var c = document.createElement("a"), a = {};
        c.href = b;
        c.search.substr(1).split("&").forEach(function (f) {
            var e = f.split("=");
            var d = decodeURIComponent(e[0]);
            if (d.length > 0) {
                a[d] = e[1]
            }
        });
        return {
            protocol: c.protocol,
            host: c.host,
            hostname: c.hostname,
            port: c.port,
            pathname: c.pathname,
            searchObject: a,
            hash: c.hash
        }
    }, composeURL: function (a) {
        var b = a.protocol + "//" + a.host;
        if (a.port !== "") {
            b += ":" + port
        }
        b += this.composeURI(a);
        return b
    }, composeURI: function (a) {
        var d = a.pathname;
        var b = "?";
        for (var c in a.searchObject) {
            if (a.searchObject.hasOwnProperty(c)) {
                d += b + c + "=" + a.searchObject[c];
                b = "&"
            }
        }
        d += a.hash;
        return d
    }, getScript: function (e, g, c) {
        c = c || {};
        var f = (typeof c.forceCallback === "undefined" ? true : !!c.forceCallback);
        var a = jQuery("script");
        if (a) {
            for (var d = a.length - 1; d >= 0; d--) {
                if (a[d].src && a[d].src === e) {
                    return (f ? g : false)
                }
            }
        }
        var b = (typeof c.useCache === "undefined" ? true : !!c.useCache);
        if (b) {
            jQuery.ajax({url: e, dataType: "script", success: g, cache: true})
        } else {
            jQuery.getScript(e, g)
        }
        return true
    }, getCss: function (c) {
        var a = jQuery("link");
        if (a) {
            for (var b = a.length - 1; b >= 0; b--) {
                if (a[b].href && a[b].href === c) {
                    return false
                }
            }
        }
        jQuery('<link rel="stylesheet" type="text/css" href="' + c + '"/>').appendTo("head");
        return true
    }
};
Travian.Helpers = {
    substitute: function (b, a, c) {
        return b.replace(c || (/\\?\{([^{}]+)\}/g), function (e, d) {
            if (e.charAt(0) === "\\") {
                return e.slice(1)
            }
            return (a[d] != null) ? a[d] : ""
        })
    }, capitalizeFirstLetter: function capitalizeFirstLetter(a) {
        return a.charAt(0).toUpperCase() + a.slice(1)
    }, mergeOne: function (b, a, c) {
        switch (typeof c) {
            case"object":
                if (typeof b[a] === "object") {
                    Travian.Helpers.deepmergeObject(b[a] || {}, c)
                } else {
                    b[a] = Object.assign({}, c)
                }
                break;
            case"array":
                b[a] = c.slice(0);
                break;
            default:
                b[a] = c
        }
        return b
    }, deepmergeObject: function (e) {
        for (var d = 1, a = arguments.length; d < a; d++) {
            var b = arguments[d];
            for (var c in b) {
                Travian.Helpers.mergeOne(e, c, b[c])
            }
        }
        return e
    }
};
Travian.Browser = (function () {
    var a, c = {chrome: false, mozilla: false, opera: false, msie: false, safari: false};
    var b = function (f) {
        f = f.toLowerCase();
        var e = /(chrome)[ \/]([\w.]+)/.exec(f) || /(webkit)[ \/]([\w.]+)/.exec(f) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(f) || /(msie) ([\w.]+)/.exec(f) || f.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(f) || [];
        return {browser: e[1] || "", version: e[2] || "0"}
    };
    var d = navigator.userAgent.toLowerCase();
    if (d.indexOf("chrome") > -1) {
        c.chrome = true
    } else {
        if (d.indexOf("safari") > -1) {
            c.safari = true
        } else {
            if (d.indexOf("opera") > -1) {
                c.opera = true
            } else {
                if (d.indexOf("firefox") > -1) {
                    c.mozilla = true
                } else {
                    if (d.indexOf("msie") > -1) {
                        c.msie = true
                    }
                }
            }
        }
    }
    a = b(navigator.userAgent);
    if (a.browser) {
        c[a.browser] = true;
        c.version = a.version
    }
    if (c.chrome) {
        c.webkit = true
    }
    if (c.safari) {
        c.webkit = true
    }
    return c
})();
Travian.Draggable = function (b, a) {
    this.options = Object.assign({
        onDrag: function (c, d) {
        },
        snap: 6,
        unit: "px",
        grid: false,
        style: true,
        limit: false,
        handle: false,
        invert: false,
        unDraggableTags: ["button", "input", "a", "textarea", "select", "option"],
        preventDefault: true,
        stopPropagation: true,
        compensateScroll: false,
        modifiers: {x: "left", y: "top"}
    }, a);
    this.attach = function () {
        this.handles.on("mousedown", this.bound.start);
        this.handles.on("touchstart", this.bound.start);
        if (this.options.compensateScroll) {
            this.offsetParent.on("scroll", this.bound.scrollListener)
        }
        return this
    };
    this.detach = function () {
        this.handles.off("mousedown", this.bound.start);
        this.handles.off("touchstart", this.bound.start);
        if (this.options.compensateScroll) {
            this.offsetParent.off("scroll", this.bound.scrollListener)
        }
        return this
    };
    this.scrollListener = function () {
        if (!this.mouse.start) {
            return
        }
        var c = {x: this.offsetParent.scrollTop(), y: this.offsetParent.scrollLeft()};
        if (this.element.css("position") === "absolute") {
            var d = this.sumValues(c, this.compensateScroll.last, -1);
            this.mouse.now = this.sumValues(this.mouse.now, d, 1)
        } else {
            this.compensateScroll.diff = this.sumValues(c, this.compensateScroll.start, -1)
        }
        if (this.offsetParent !== window) {
            this.compensateScroll.diff = this.sumValues(this.compensateScroll.start, c, -1)
        }
        this.compensateScroll.last = c;
        this.render(this.options)
    };
    this.sumValues = function (f, e, h) {
        var d = {}, c = this.options;
        for (var g in c.modifiers) {
            if (!c.modifiers[g]) {
                continue
            }
            d[g] = f[g] + e[g] * h
        }
        return d
    };
    this.start = function (c) {
        if (this.options.unDraggableTags.indexOf(c.target.getAttribute("tag")) !== -1) {
            return
        }
        var m = this.options;
        if (c.which === 3 || c.button === 2) {
            return
        }
        if (m.preventDefault) {
            c.preventDefault()
        }
        if (m.stopPropagation) {
            c.stopPropagation()
        }
        this.compensateScroll.start = this.compensateScroll.last = {
            x: this.offsetParent.scrollTop(),
            y: this.offsetParent.scrollLeft()
        };
        this.compensateScroll.diff = {x: 0, y: 0};
        this.mouse.start = {x: c.pageX, y: c.pageY};
        var f = m.limit;
        this.limit = {x: [], y: []};
        var h, k, d = this.offsetParent === window ? null : this.offsetParent;
        for (h in m.modifiers) {
            if (m.modifiers.hasOwnProperty(h)) {
                var e = this.element.css(m.modifiers[h]);
                if (e && !e.match(/px$/)) {
                    if (!k) {
                        k = this.element.getCoordinates(d)
                    }
                    e = k[m.modifiers[h]]
                }
                if (m.style) {
                    this.value.now[h] = parseInt(e || 0)
                } else {
                    this.value.now[h] = this.element[m.modifiers[h]]
                }
                if (m.invert) {
                    this.value.now[h] *= -1
                }
                this.mouse.pos[h] = this.mouse.start[h] - this.value.now[h];
                if (f && f[h]) {
                    var g = 2;
                    while (g--) {
                        var j = f[h][g];
                        if (j || j === 0) {
                            this.limit[h][g] = (typeof j === "function") ? j() : j
                        }
                    }
                }
            }
        }
        if (typeof this.options.grid === "number") {
            this.options.grid = {x: this.options.grid, y: this.options.grid}
        }
        var l = {
            mousemove: this.bound.check,
            mouseup: this.bound.cancel,
            touchmove: this.bound.check,
            touchend: this.bound.cancel
        };
        this.document.on(l)
    };
    this.check = function (c) {
        if (this.options.preventDefault) {
            c.preventDefault()
        }
        var d = Math.round(Math.sqrt(Math.pow(c.pageX - this.mouse.start.x, 2) + Math.pow(c.pageY - this.mouse.start.y, 2)));
        if (d > this.options.snap) {
            this.cancel();
            this.document.on({
                mousemove: this.bound.drag,
                mouseup: this.bound.stop,
                touchmove: this.bound.drag,
                touchend: this.bound.stop
            })
        }
    };
    this.drag = function (d) {
        var c = this.options;
        if (c.preventDefault) {
            d.preventDefault()
        }
        this.mouse.now = this.sumValues({x: d.pageX, y: d.pageY}, this.compensateScroll.diff, -1);
        this.render(c);
        this.options.onDrag(this.element, d)
    };
    this.render = function (c) {
        for (var d in c.modifiers) {
            if (c.modifiers.hasOwnProperty(d)) {
                if (!c.modifiers[d]) {
                    continue
                }
                this.value.now[d] = this.mouse.now[d] - this.mouse.pos[d];
                if (c.invert) {
                    this.value.now[d] *= -1
                }
                if (c.limit && this.limit[d]) {
                    if ((this.limit[d][1] || this.limit[d][1] === 0) && (this.value.now[d] > this.limit[d][1])) {
                        this.value.now[d] = this.limit[d][1]
                    } else {
                        if ((this.limit[d][0] || this.limit[d][0] === 0) && (this.value.now[d] < this.limit[d][0])) {
                            this.value.now[d] = this.limit[d][0]
                        }
                    }
                }
                if (c.grid[d]) {
                    this.value.now[d] -= ((this.value.now[d] - (this.limit[d][0] || 0)) % c.grid[d])
                }
                if (c.style) {
                    this.element.css(c.modifiers[d], this.value.now[d] + c.unit)
                } else {
                    this.element[c.modifiers[d]] = this.value.now[d]
                }
            }
        }
    };
    this.cancel = function (c) {
        this.document.off({
            mousemove: this.bound.check,
            mouseup: this.bound.cancel,
            touchmove: this.bound.check,
            touchend: this.bound.cancel
        })
    };
    this.stop = function (d) {
        var c = {
            mousemove: this.bound.drag,
            mouseup: this.bound.stop,
            touchmove: this.bound.drag,
            touchend: this.bound.stop
        };
        this.document.off(c);
        this.mouse.start = null
    };
    this.element = jQuery(b);
    this.document = jQuery(document);
    this.handles = jQuery(this.options.handle) || this.element;
    this.mouse = {now: {}, pos: {}};
    this.value = {start: {}, now: {}};
    this.offsetParent = this.element.parent();
    this.selection = "selectstart" in document ? "selectstart" : "mousedown";
    this.compensateScroll = {start: {}, diff: {}, last: {}};
    this.bound = {
        start: this.start.bind(this),
        check: this.check.bind(this),
        drag: this.drag.bind(this),
        stop: this.stop.bind(this),
        cancel: this.cancel.bind(this),
        scrollListener: this.scrollListener.bind(this)
    };
    this.attach()
};
Travian.Moveable = function (b, a) {
    this.options = Object.assign({
        onDrop: function (e, g, f) {
        }, droppables: [], container: false, precalculate: false, includeMargins: true, checkDroppables: true
    }, a);
    this.setContainer = function (e) {
        this.container = jQuery(e)
    };
    this.start = function (e) {
        if (this.container) {
            this.options.limit = this.calculateLimit()
        }
        if (this.options.precalculate) {
            this.positions = this.droppables.map(function (f) {
                return f.getCoordinates()
            })
        }
        this.parent.start.call(this, e)
    };
    this.calculateLimit = function () {
        var o = this.element, j = this.container, i = jQuery(o.parent() || document.body), m = j.getCoordinates(i),
            h = {}, g = {}, p = {}, l = {}, r = {}, f = {x: i.scrollTop(), y: i.scrollLeft()};
        ["top", "right", "bottom", "left"].each(function (v) {
            h[v] = parseInt(o.css("margin-" + v));
            g[v] = parseInt(o.css("border-" + v));
            p[v] = parseInt(j.css("margin-" + v));
            l[v] = parseInt(j.css("border-" + v));
            r[v] = parseInt(i.css("padding-" + v))
        }, this);
        var k = o.offsetWidth + h.left + h.right, u = o.offsetHeight + h.top + h.bottom, n = 0 + f.x, q = 0 + f.y,
            t = m.right - l.right - k + f.x, e = m.bottom - l.bottom - u + f.y;
        if (this.options.includeMargins) {
            n += h.left;
            q += h.top
        } else {
            t += h.right;
            e += h.bottom
        }
        if (o.css("position") === "relative") {
            var s = o.getCoordinates(i);
            s.left -= parseInt(o.css("left"));
            s.top -= parseInt(o.css("top"));
            n -= s.left;
            q -= s.top;
            if (j.css("position") !== "relative") {
                n += l.left;
                q += l.top
            }
            t += h.left - s.left;
            e += h.top - s.top;
            if (j !== i) {
                n += p.left + r.left;
                if (!r.left && n < 0) {
                    n = 0
                }
                q += i === document.body ? 0 : p.top + r.top;
                if (!r.top && q < 0) {
                    q = 0
                }
            }
        } else {
            n -= h.left;
            q -= h.top;
            if (j !== i) {
                n += m.left + l.left;
                q += m.top + l.top
            }
        }
        return {x: [n, t], y: [q, e]}
    };
    this.getDroppableCoordinates = function (g) {
        var f = g.getCoordinates();
        if (g.css("position") === "fixed") {
            var e = window.getScroll();
            f.left += e.x;
            f.right += e.x;
            f.top += e.y;
            f.bottom += e.y
        }
        return f
    };
    this.checkDroppables = function () {
        var e = this.droppables.filter(function (h, g) {
            h = this.positions ? this.positions[g] : this.getDroppableCoordinates(h);
            var f = this.mouse.now;
            return (f.x > h.left && f.x < h.right && f.y < h.bottom && f.y > h.top)
        }, this).getLast();
        if (this.overed !== e) {
            this.overed = e
        }
    };
    this.drag = function (e) {
        this.parent.drag.call(this, e);
        if (this.options.checkDroppables && this.droppables.length) {
            this.checkDroppables()
        }
    };
    this.stop = function (e) {
        this.checkDroppables();
        this.options.onDrop(this.element, this.overed, e);
        this.overed = null;
        return this.parent.stop.call(this, e)
    };
    Travian.Draggable.call(this, b, this.options);
    this.droppables = jQuery(this.options.droppables);
    this.setContainer(this.options.container || document.body);
    if (this.options.style) {
        if (this.options.modifiers.x === "left" && this.options.modifiers.y === "top") {
            var c = b.position(), d = b.css(["left", "top"]);
            if (c && (d.left === "auto" || d.top === "auto")) {
                b.offset(b.position())
            }
        }
        if (b.css("position") === "static") {
            b.css("position", "absolute")
        }
    }
    this.overed = null
};
Travian.Moveable.prototype = Object.create(Travian.Draggable.prototype);
Travian.Moveable.constructor = Travian.Moveable;
Travian.Moveable.parent = Travian.Draggable.prototype;

function addNsEvent(b, e) {
    var c = b.split("."), a = c[0], d = c[1];
    this.bindCache = this.bindCache || {};
    if (this.bindCache[b]) {
        this.bindCache[b].push(e)
    } else {
        this.bindCache[b] = [e]
    }
    this.addEvent(a, e);
    return this
}

function removeNsEvent(c) {
    if (typeof this.bindCache === "undefined" || !this.bindCache.hasOwnProperty(c)) {
        return this
    }
    var b = c.split(".")[0], a = 0, d = this.bindCache[c], e;
    for (; e = d[a++];) {
        this.removeEvent(b, e)
    }
    return this
}

function removeNsEvents(d) {
    var a, c, b = this;
    Object.each(this.bindCache, function (f, e) {
        if (e.contains(".") && e.split(".").getLast() === d) {
            a = 0;
            for (; c = f[a++];) {
                b.removeEvent(e.split(".")[0], c)
            }
        }
    });
    return this
}

Travian.Cookie = {
    get: function (b) {
        var e = encodeURIComponent(b) + "=";
        var a = document.cookie.split(";");
        for (var d = 0; d < a.length; d++) {
            var f = a[d];
            while (f.charAt(0) === " ") {
                f = f.substring(1, f.length)
            }
            if (f.indexOf(e) === 0) {
                return decodeURIComponent(f.substring(e.length, f.length))
            }
        }
        return null
    }, set: function (d, e, b) {
        var a;
        if (b) {
            var c = new Date();
            c.setTime(c.getTime() + (b * 1000));
            a = "; expires=" + c.toGMTString()
        } else {
            a = ""
        }
        document.cookie = encodeURIComponent(d) + "=" + encodeURIComponent(e) + a + "; path=/"
    }, remove: function (a) {
        Travian.Cookie.set(a, "", -1)
    }
};
Travian.Cookie.Object = function (a) {
    this.content = JSON.parse(Travian.Cookie.get(a)) || {};
    this.id = a;
    this.set = function (b, c) {
        this.content[b] = c;
        Travian.Cookie.set(a, JSON.stringify(this.content))
    };
    this.get = function (b) {
        return this.content[b]
    }
};
Travian.Storage = (function () {
    var c = null;
    var d = function (k, j) {
        var l = f(k);
        j = g(j);
        if (l === null) {
        } else {
            l.removeItem(j)
        }
    };
    var a = function (k, j) {
        return {data: k, time: (new Date()).getTime(), cachingTime: j}
    };
    var i = function (k, j) {
        var m = f(k);
        var l = null;
        j = g(j);
        if (m === null) {
            return null
        } else {
            l = m.getItem(j)
        }
        if (l == null || typeof l === "undefined") {
            return null
        }
        return JSON.decode(l)
    };
    var f = function (k) {
        var j = k ? "localStorage" : "sessionStorage";
        if (!window[j]) {
            return null
        }
        return window[j]
    };
    var b = function () {
        if (c === null) {
            c = jQuery("input").css({type: "hidden", behavior: "url(#default#userData)"}).appendTo("body")
        }
        return c
    };
    var g = function (j) {
        return "Travian." + j
    };
    var e = function (k, j, l) {
        var n = f(k);
        var m = JSON.encode(l);
        j = g(j);
        if (n === null) {
            return null
        } else {
            n.setItem(j, m)
        }
    };
    var h = function (l, k) {
        var j = l.cachingTime;
        if (typeof k.cachingTime !== "undefined" && k.cachingTime !== null) {
            j = k.cachingTime
        }
        return k.time !== false && (new Date()).getTime() - k.time > j
    };
    return {
        cachingTime: 365 * 24 * 60 * 60 * 1000, clear: function (j, k) {
            d(k, j);
            return this
        }, get: function (j, k) {
            var l = i(k, j);
            if (l === null) {
                return null
            }
            if (h(this, l) === true) {
                return null
            }
            return l.data
        }, set: function (k, m, l, j) {
            var n = a(m, j);
            e(l, k, n);
            return this
        }
    }
})();
Travian.Translation = {
    keys: {}, add: function (b, c) {
        var a = {};
        if (typeof b !== "object") {
            a[b] = c
        } else {
            a = b
        }
        this.keys = Object.assign({}, this.keys, a);
        return this
    }, get: function (a) {
        return this.keys[a]
    }, translate: function (b, a) {
        a = a || {};
        return b.replace(/\\?\{([^{}]+)\}/g, function (d, c) {
            return Travian.Translation.keys[c] || a[c] || "{" + c + "}"
        })
    }
};
Travian.Tip = (function () {
    var c = function (d) {
        var e = {title: "", text: ""};
        if (typeof d === "undefined") {
            return false
        }
        var g = d.split("||");
        if (g.length === 1) {
            e.text = g[0]
        } else {
            if (g.length === 2) {
                e.title = g[0];
                e.text = g[1]
            } else {
                return false
            }
        }
        var f = document.createElement("textarea");
        f.innerHTML = e.title;
        e.title = f.value;
        f.innerHTML = e.text;
        e.text = f.value;
        jQuery(f).remove();
        return e
    };
    var b = function (e) {
        var d, f;
        e.each(function (g, h) {
            if (h.title !== "") {
                if (h.tagName === "title") {
                    h = jQuery(h);
                    f = h.parent("path")[0];
                    d = c(h[0].textContent);
                    h.remove()
                } else {
                    f = h;
                    d = c(h.title);
                    jQuery(h).removeAttr("title")
                }
                if (d === false) {
                    return
                }
                Travian.Tip.set(f, d)
            }
        })
    };
    var a = function (i) {
        var f = jQuery(window);
        var g = {x: f.width(), y: f.height()};
        var h = {x: i.element.width(), y: i.element.height()};
        var e = Object.assign({}, i.mousePosition);
        var d = {x: f.scrollLeft(), y: f.scrollTop()};
        if ((i.mousePosition.x - d.x) > g.x) {
            i.mousePosition.x = g.x
        }
        if ((i.mousePosition.y - d.y) > g.y) {
            i.mousePosition.y = g.y
        }
        e.x = i.mousePosition.x + i.options.offset.x;
        e.y = i.mousePosition.y + i.options.offset.y;
        if ((e.x + h.x - d.x) > g.x - i.options.windowPadding.x) {
            e.x = i.mousePosition.x - i.options.offset.x - h.x
        }
        if ((e.y + h.y - d.y) > g.y - i.options.windowPadding.y) {
            e.y = i.mousePosition.y - i.options.offset.y - h.y
        }
        if (e.x < d.x + i.options.windowPadding.x) {
            e.x = d.x + i.options.windowPadding.x
        }
        if (e.y < d.y + i.options.windowPadding.y) {
            e.y = d.y + i.options.windowPadding.y
        }
        i.element.css({left: e.x, top: e.y})
    };
    return Object.create({
        displayState: "hide",
        element: null,
        elementCurrent: null,
        elementTitle: null,
        elementText: null,
        lastText: "",
        lastTitle: "",
        mousePosition: {x: 0, y: 0},
        options: {
            html: '<div class="tip"><div class="tip-container"><div class="tl"></div><div class="tr"></div><div class="tc"></div><div class="ml"></div><div class="mr"></div><div class="mc"></div><div class="bl"></div><div class="br"></div><div class="bc"></div><div class="tip-contents"><div class="title elementTitle"></div><div class="text elementText"></div></div></div></div>',
            hideDelay: 250,
            maxWidthInPercent: 0.33,
            minWidthInPixels: 200,
            offset: {x: 16, y: 16},
            showDelay: 100,
            windowPadding: {x: 10, y: 10},
            zIndex: 10000
        },
        timer: null,
        show: function (e) {
            if (typeof e === "string") {
                e = {title: "", text: e, unescaped: false}
            }
            if (!e.text && !e.title) {
                this.hide();
                return this
            }
            this.updateContent(e);
            var d = this.element;
            if (this.displayState !== "show") {
                this.displayState = "show";
                clearTimeout(this.timer);
                this.timer = setTimeout(function () {
                    d.fadeIn(400)
                }, this.options.showDelay)
            }
            return this
        },
        hide: function () {
            var d = this.element;
            if (this.displayState !== "hide") {
                this.displayState = "hide";
                clearTimeout(this.timer);
                this.timer = setTimeout(function () {
                    d.fadeOut(400)
                }, this.options.hideDelay)
            }
            return this
        },
        init: function () {
            this.render();
            this.refresh()
        },
        render: function () {
            var d = this;
            this.element = jQuery("<div/>");
            this.element.css({position: "absolute", top: 0, left: 0, display: "none", zIndex: this.options.zIndex});
            this.element.html(this.options.html);
            this.element.appendTo("body");
            this.elementTitle = this.element.find(".elementTitle");
            this.elementText = this.element.find(".elementText");
            this.elementContainer = this.element.find(".tip-container");
            this.elementContents = this.element.find(".tip-contents");
            jQuery("body").mousemove(function (f) {
                d.mousePosition.x = f.pageX;
                d.mousePosition.y = f.pageY;
                if (d.displayState !== "show") {
                    return
                }
                a(d)
            });
            return this
        },
        setContent: function (d, e) {
            jQuery(d).prop("_travianTooltip", typeof e === "string" ? c(e) : e)
        },
        set: function (d, e) {
            var f = this;
            d = jQuery(d);
            if (!d.prop("_travianTooltip")) {
                d.on({
                    mouseover: function (h) {
                        var g = jQuery(h.delegateTarget);
                        f.elementCurrent = g;
                        f.show(g.prop("_travianTooltip"))
                    }, mouseout: function (g) {
                        f.elementCurrent = null;
                        f.hide()
                    }
                })
            }
            this.setContent(d, e);
            return this
        },
        updateContent: function (g) {
            var f = Object.assign({}, g);
            var e = null;
            if (typeof f.title === "undefined" || !f.title) {
                f.title = ""
            }
            if (typeof f.text === "undefined" || !f.text) {
                f.text = ""
            }
            f.title = Travian.Translation.translate(f.title);
            f.text = Travian.Translation.translate(f.text);
            if (this.lastText !== f.text || this.lastTitle !== f.title) {
                if (typeof f.unescaped === "undefined" || f.unescaped !== true) {
                }
                this.elementTitle.html(f.title);
                if (f.title.length > 0) {
                    this.elementTitle.show()
                } else {
                    this.elementTitle.hide()
                }
                this.elementText.html(f.text);
                if (f.text.length > 0) {
                    this.elementText.show()
                } else {
                    this.elementText.hide()
                }
                var d = Math.max(Math.floor(jQuery("body").width() * this.options.maxWidthInPercent), this.options.minWidthInPixels);
                this.elementContents.css({
                    wordBreak: "normal",
                    wordWrap: "normal",
                    width: "auto",
                    whiteSpace: "normal",
                    "max-width": d
                });
                var h = this.elementContents.width();
                if (h > d) {
                    this.elementContents.css({wordWrap: "break-word", wordBreak: "break-all"})
                }
                a(this);
                this.lastText = f.text;
                this.lastTitle = f.title
            }
            return this
        },
        updateAllInElement: function (d) {
            b(jQuery(d).find('[title][title!=""], path title'))
        },
        refresh: function () {
            this.updateAllInElement(document.body)
        }
    })
})();
jQuery(function () {
    Travian.Tip.init()
});
Travian.Dialog = {
    CLOSE_CONTEXT_FORMSUBMIT: "formSubmit",
    CLOSE_CONTEXT_OVERLAYBACKGROUND: "overlayBackground",
    CLOSE_CONTEXT_CANCELBUTTON: "cancelButton",
    CLOSE_CONTEXT_CLOSEONCLICKOK: "closeOnClickOk",
    CLOSE_CONTEXT_CLOSEONESCKEY: "closeOnEscKey"
};
Travian.Dialog.Dialog = function (a) {
    this.buttonTemplates = {button: ""};
    this.DIALOG_TYPE_MODAL = "modal";
    this.DIALOG_TYPE_NONMODAL = "nonmodal";
    this.overlay = false;
    this.options = Object.assign({
        cssClass: "white",
        buttonOk: true,
        keepOpen: false,
        buttonTextOk: null,
        buttonCloseOnClickOk: false,
        buttonCancel: true,
        buttonTextCancel: null,
        elementFocus: "dialogButtonOk",
        maxWidthInPercent: 0.75,
        topHeaderOffset: 0,
        resizeDialogIfOverflow: true,
        relativeTo: null,
        scroll: true,
        title: null,
        useEscKey: true,
        submitMethod: "get",
        submitUrl: undefined,
        overlayCancel: true,
        draggable: false,
        enableBackground: true,
        saveOnUnload: false,
        dragPosition: null,
        darkOverlay: false,
        savePositionForSession: {preferenceKey: null},
        type: null,
        enableBringToFront: true,
        stickToUrlOnRestore: false,
        dialogOrigin: null,
        infoIcon: null,
        buttonTextInfo: null,
        preventFormSubmit: false,
        destroyElement: true,
        fx: {open: {opacity: 1}, close: {opacity: 0}, duration: 400},
        onOkay: Travian.emptyFunction,
        onClose: Travian.emptyFunction,
        afterClose: Travian.emptyFunction,
        onOpen: Travian.emptyFunction,
        onDrag: Travian.emptyFunction
    }, a);
    this.toggleFormState = function (b) {
        this.buttonOk.toggleClass("disabled", b).disabled = b;
        return this
    };
    this.disableForm = function () {
        return this.toggleFormState(true)
    };
    this.enableForm = function () {
        return this.toggleFormState(false)
    };
    this.correctDialogPosition = function (c) {
        var b = Travian.WindowManager.width, i = Travian.WindowManager.height, h = this.wrapper.width(),
            d = this.wrapper.height(), g = c.left, f = c.top, e = jQuery(document).scrollTop() || 0;
        if (g < 0) {
            g = 0
        } else {
            if (g + h >= b) {
                g = b - h
            }
        }
        if (f < 0) {
            f = 0
        } else {
            if (f + d >= (i + e)) {
                f = (i + e) - d
            }
        }
        return {left: g, top: f}
    };
    this.render = function () {
        var e = this;
        var b = jQuery("body");
        var f = jQuery("<div/>").html(this.buttonTemplates.button);
        var c = f.find("button").first();
        if (this.options.savePositionForSession.preferenceKey) {
            var d = Travian.Game.Preferences.get(this.options.savePositionForSession.preferenceKey);
            if (d !== null) {
                d = JSON.parse(d);
                this.options.savePositionForSession.position = d.position
            }
        }
        if (!c) {
            throw ("Button for Dialog must not be empty.")
        }
        c.addClass("green");
        c.addClass("ok");
        c.addClass("dialogButtonOk");
        c.attr("type", "submit");
        this.wrapper = jQuery('<div class="dialogWrapper"></div>').css({position: "absolute", opacity: 0});
        this.wrapper.html('<div class="dialog ' + this.options.cssClass + '"><div class="dialog-container"><div class="dialog-background-tl"></div><div class="dialog-background-tr"></div><div class="dialog-background-tc"></div><div class="dialog-background-ml"></div><div class="dialog-background-mr"></div><div class="dialog-background-mc"></div><div class="dialog-background-bl"></div><div class="dialog-background-br"></div><div class="dialog-background-bc"></div><div class="dialog-contents"><form action="?" method="get" accept-charset="UTF-8"><div class="dialog-dragbar"><div class="dragbar-inner-left"></div><div class="dragbar-inner-mid"></div><div class="dragbar-inner-right"></div></div><div class="iconButton small info"></div><div id="dialogCancelButton" class="iconButton small cancel"></div><div class="title"></div><div class="content" id="dialogContent"></div><div class="buttons">' + f.html() + "</div></form></div></div></div>");
        b.prepend(this.wrapper);
        jQuery(window).resize(function () {
            e.updatePosition(200, true);
            e.triggerPositionsSync()
        });
        this.content = this.wrapper.find("div#dialogContent");
        this.title = this.wrapper.find("div.title");
        this.setTitle(this.options.title);
        this.elementContainer = this.wrapper.find("div.dialog-container");
        this.elementContents = this.wrapper.find("div.dialog-contents");
        this.infoButton = this.wrapper.find("div.info");
        this.dialogDragbar = this.wrapper.find("div.dialog-dragbar");
        if (this.options.infoIcon) {
            this.setInfoIcon(this.options.infoIcon)
        }
        if (this.options.draggable) {
            this.wrapper.addClass("dragWrapper");
            new Travian.Moveable(this.wrapper, {
                droppables: this.title, handle: this.dialogDragbar, onDrop: function (h) {
                    var g = jQuery(h).position();
                    e.options.dragPosition = e.correctDialogPosition(g);
                    if (e.options.savePositionForSession.preferenceKey !== null) {
                        e.options.savePositionForSession.position = e.correctDialogPosition(g)
                    }
                }, onDrag: function (h) {
                    var g = jQuery(h);
                    g.css(e.correctDialogPosition(g.position()));
                    e.options.onDrag(e);
                    e.triggerPositionsSync()
                }
            });
            this.title.css("drag")
        }
        if (this.options.enableBringToFront) {
            this.wrapper.mousedown(function () {
                e.bringToFront()
            })
        }
        this.form = this.wrapper.find("form").on("submit", function (g) {
            if (e.form.disabled) {
                g.stopPropagation();
                return false
            }
            e.disableForm();
            e.options.onOkay(e, e.content);
            if (e.options.keepOpen === false) {
                e.close(Travian.Dialog.CLOSE_CONTEXT_FORMSUBMIT)
            }
            if (e.options.preventFormSubmit) {
                g.stopPropagation();
                return false
            }
        });
        this.form.disabled = false;
        if (this.options.submitMethod) {
            this.form.attr("method", this.options.submitMethod)
        }
        if (this.options.submitUrl) {
            this.form.attr("action", this.options.submitUrl)
        }
        this.buttonOk = this.wrapper.find("button.ok");
        if (this.options.buttonOk === false) {
            this.buttonOk.closest(".buttons").hide()
        } else {
            this.buttonOk.html(this.options.buttonTextOk);
            Travian.Tip.set(this.buttonOk, this.options.buttonTextOk)
        }
        if (this.options.buttonCloseOnClickOk) {
            this.buttonOk.click(function (g) {
                e.close(Travian.Dialog.CLOSE_CONTEXT_CLOSEONCLICKOK)
            })
        }
        this.wrapper.find(".cancel").click(function (g) {
            e.close(Travian.Dialog.CLOSE_CONTEXT_CANCELBUTTON)
        });
        this.buttonCancel = this.wrapper.find("button.cancel");
        if (this.options.buttonCancel === false) {
            this.buttonCancel.hide()
        } else {
            this.buttonCancel.html(this.options.buttonTextCancel);
            Travian.Tip.set(this.buttonCancel, this.options.buttonTextCancel)
        }
        if (e.options.enableBackground) {
            this.overlay = new Travian.Dialog.DarkBackgroundOverlay(document.body, {
                open: {opacity: (e.options.darkOverlay) ? 0.8 : 0.3},
                duration: this.options.fx.duration,
                animateFunction: this.animateFunction,
                onClick: function () {
                    if (e.options.overlayCancel) {
                        e.close(Travian.Dialog.CLOSE_CONTEXT_OVERLAYBACKGROUND)
                    }
                }
            })
        }
        this.bringToFront()
    };
    this.updateInfoButton = function (b) {
        this.options = Object.assign(this.options, b);
        if (this.options.infoIcon) {
            this.setInfoIcon(this.options.infoIcon)
        }
        return this
    };
    this.displayButtonOk = function (b) {
        if (typeof b === "undefined" || b === null || b === true) {
            this.buttonOk.closest(".buttons").show();
            this.buttonOk.show()
        } else {
            this.buttonOk.hide()
        }
    };
    this.setContent = function (e, c) {
        this.content.empty();
        this.content.append(e);
        var d = jQuery("body").width();
        var b = this.elementContents.width();
        if (this.options.resizeDialogIfOverflow && Math.floor(d * this.options.maxWidthInPercent) < b) {
            this.elementContainer.css({width: Math.floor(d * this.options.maxWidthInPercent)})
        }
        if (c) {
            this.options.elementFocus = c
        }
        jQuery(this.options.elementFocus).focus();
        this.updatePosition();
        Travian.Tip.updateAllInElement(this.wrapper);
        jQuery(window).trigger("domAltered", this.wrapper);
        return this
    };
    this.setTitle = function (b) {
        this.options.title = b;
        this.title.html(this.options.title);
        if (!this.options.title) {
            this.title.hide()
        }
        return this
    };
    this.calculatePosition = function () {
        var f = {x: 0, y: 0};
        var e = jQuery("body");
        var i = jQuery(this.options.relativeTo);
        var b = {x: e.width(), y: e.height()};
        if (this.wrapper.css("position") && i.is(e)) {
            var g = jQuery(window);
            f = {x: g.scrollLeft(), y: g.scrollTop()}
        }
        var h = {width: this.wrapper.width(), height: this.wrapper.height()};
        var j = {x: i.width(), y: i.height()};
        var c = {x: i.offset().left, y: i.offset().top};
        c.x = this.checkValue(c.x);
        c.y = this.checkValue(c.y);
        var d = {left: f.x + c.x + j.x / 2 - h.width / 2, top: f.y + c.y + j.y / 2 - h.height / 2};
        if ((h.height + this.options.topHeaderOffset) > j.y) {
            d.top = f.y + c.y + 40;
            if (this.wrapper.css("position") === "fixed") {
                this.wrapper.css({position: "absolute"})
            }
        }
        d.left = this.checkValue(d.left, 5);
        d.top = this.checkValue(d.top, 40);
        if (Travian.getDirection() === "rtl" && (d.left + h.width) > b.x) {
            d.left = b.x - h.width - 5
        }
        return d
    };
    this.checkValue = function (c, b) {
        return (c < 0) ? (b || 0) : c
    };
    this.updatePosition = function (f, e) {
        var c = this.elementContents.width();
        this.dialogDragbar.css({width: c + 20});
        var d = this.dialogDragbar.find(".dragbar-inner-mid");
        if (d) {
            d.css({width: c})
        }
        if (this.options.savePositionForSession.preferenceKey && this.options.savePositionForSession.position && (typeof e === "undefined" || !e)) {
            this.setPosition(this.options.savePositionForSession.position)
        } else {
            if (this.options.dragPosition && typeof this.options.dragPosition.x !== "undefined" && typeof this.options.dragPosition.y !== "undefined") {
                this.setPosition(this.options.dragPosition)
            } else {
                var b = this.calculatePosition();
                this.setPosition({x: b.left, y: b.top}, f)
            }
        }
    };
    this.hide = function () {
        this.wrapper.hide();
        if (this.overlay) {
            this.overlay.overlay.hide()
        }
    };
    this.unhide = function () {
        this.wrapper.show();
        if (this.overlay) {
            this.overlay.overlay.show()
        }
    };
    this.dispose = function () {
        if (this.options.useEscKey) {
            jQuery("body").off(".dialog")
        }
        if (typeof Travian.WindowManager !== "undefined") {
            Travian.WindowManager.unregister(this)
        }
        if (this.options.destroyElement === true) {
            jQuery(this.wrapper).remove()
        }
        if (this.overlay) {
            this.overlay.remove();
            this.overlay = false
        }
    };
    this.toElement = function () {
        return this.wrapper
    };
    this.setPosition = function (b, c) {
        this.wrapper.css({left: b.x, top: b.y});
        return b
    };
    this.setPositionExtended = function (b) {
        this.wrapper.css({left: b.x, top: b.y, marginLeft: b.marginLeft + "px", marginTop: b.marginTop + "px"});
        return b
    };
    this.bringToFront = function () {
        if (typeof Travian.WindowManager === "undefined") {
            return false
        }
        if (Travian.WindowManager.getCurrentZIndex() === parseInt(this.wrapper.css("zIndex"))) {
            return false
        }
        var b = Travian.WindowManager.getZIndex();
        this.wrapper.css({zIndex: b});
        if (this.overlay) {
            this.overlay.overlay.css({zIndex: (b - 5)})
        }
    };
    this.getOrigin = function () {
        return this.dialogOrigin
    };
    this.setInfoIcon = function (b) {
        if (b) {
            this.options.infoIcon = b;
            var c = this;
            this.infoButton.off("click");
            this.infoButton.show();
            this.infoButton.on("click", function () {
                if (typeof c.options.infoIcon === "string") {
                    return window.open(c.options.infoIcon, "_blank")
                }
                if (typeof c.options.infoIcon === "function") {
                    return c.options.infoIcon()
                }
            });
            if (this.options.buttonTextInfo) {
                Travian.Tip.set(this.infoButton, this.options.buttonTextInfo)
            }
        } else {
            this.infoButton.hide()
        }
        return this
    };
    this.updateCssClass = function (b) {
        if (b) {
            var f = this.options.cssClass.split(" ");
            var e = this.wrapper.find("div.dialog");
            if (e) {
                for (var d = 0; d < f.length; d++) {
                    e.removeClass(f[d])
                }
                this.options.cssClass = b;
                var g = (b).split(" ");
                for (var c = 0; c < g.length; c++) {
                    if (g[c] !== "") {
                        e.addClass(g[c])
                    }
                }
            }
        }
        return this
    };
    this.makeInputAmountable = function (d, b, g) {
        var f = b || Number.MAX_VALUE;
        var e = function (k, i, m) {
            k = jQuery(k);
            var l = i || Number.MAX_VALUE;
            var j = parseInt(k.val()) || 0;
            var h = Math.max(0, Math.min(j, l));
            k.val(h);
            if (m) {
                m(h)
            }
        };
        var c = function (h, j, i) {
            if (h === 8 || h === 46 || (h === 65 && (j === true || i === true)) || (h === 67 && (j === true || i === true)) || (h === 88 && (j === true || i === true)) || (h === 86 && (j === true || i === true)) || (h >= 35 && h <= 39)) {
                return true
            }
            return (((h >= 48 && h <= 57) || (h >= 96 && h <= 105)))
        };
        jQuery(d).on({
            keydown: function (h) {
                if (!c(h.keyCode, h.ctrlKey, h.metaKey)) {
                    h.preventDefault()
                }
            }, keyup: function () {
                e(this, f, g)
            }, paste: function () {
                e(this, f, g)
            }, change: function () {
                e(this, f, g)
            }, blur: function () {
                e(this, f, g)
            }, input: function () {
                e(this, f, g)
            }
        })
    };
    this.triggerPositionsSync = function () {
        jQuery.event.trigger({type: "dialogDraggingSync", dialog: this});
        return this
    };
    Object.assign(this.options, a);
    this.animateFunction = this.options.fx.duration === 0 ? function (d, b, c, e) {
        d.css(b);
        if (typeof e === "function") {
            e()
        }
    } : function (c, b, e, d) {
        c.animate(b, e, d)
    };
    if (typeof Travian.Templates.ButtonTemplate !== "undefined") {
        this.buttonTemplates.button = Travian.Templates.ButtonTemplate
    }
    if (this.options.type === this.DIALOG_TYPE_NONMODAL) {
        this.options.enableBringToFront = true;
        this.options.enableBackground = false;
        this.options.draggable = true
    }
    if (this.options.type === this.DIALOG_TYPE_MODAL) {
        this.options.enableBringToFront = false;
        this.options.enableBackground = true;
        this.options.draggable = false
    }
    if (!this.options.dialogOrigin) {
        this.options.dialogOrigin = location.pathname
    }
    this.options.relativeTo = this.options.relativeTo || document.body;
    this.options.relativeTo = jQuery(this.options.relativeTo);
    if (this.options.buttonTextOk === null) {
        this.options.buttonTextOk = Travian.Translation.get("allgemein.ok")
    }
    if (this.options.buttonTextCancel === null) {
        this.options.buttonTextCancel = Travian.Translation.get("allgemein.cancel")
    }
    this.render();
    if (typeof Travian.WindowManager !== "undefined") {
        Travian.WindowManager.register(this)
    }
};
Travian.Dialog.Dialog.prototype.isAjax = function () {
    return false
};
Travian.Dialog.Dialog.prototype.reload = Travian.emptyFunction;
Travian.Dialog.Dialog.prototype.show = function () {
    var c = this;
    this.open = true;
    this.updatePosition();
    c.triggerPositionsSync();
    var b = function () {
        c.options.onOpen(c, c.content);
        var d = jQuery(c.options.elementFocus);
        if (d.length > 0) {
            d.focus()
        }
    };
    this.animateFunction(this.wrapper, this.options.fx.open, this.options.fx.duration, b);
    if (this.overlay) {
        this.overlay.open()
    }
    if (c.buttonOk && (c.options.buttonTextOk === Travian.Translation.get("allgemein.ok"))) {
        if (!Travian.isMobile()) {
            try {
                jQuery(c.buttonOk).focus()
            } catch (a) {
            }
        }
    }
    if (this.options.useEscKey) {
        jQuery("body").one("keyup.dialog", function (d) {
            if (d.keyCode === 27) {
                c.close(Travian.Dialog.CLOSE_CONTEXT_CLOSEONESCKEY)
            }
        })
    }
    return this
};
Travian.Dialog.Dialog.prototype.close = function (a) {
    var c = this;
    this.open = false;
    this.options.onClose(this, this.content);
    var b = function () {
        c.dispose()
    };
    this.animateFunction(this.wrapper, this.options.fx.close, this.options.fx.duration, b);
    if (this.overlay) {
        this.overlay.close()
    }
    if (this.options.savePositionForSession.preferenceKey && this.options.savePositionForSession.position) {
        Travian.Game.Preferences.set(this.options.savePositionForSession.preferenceKey, JSON.stringify(this.options.savePositionForSession))
    }
    Travian.Tip.hide();
    this.options.afterClose();
    return this
};
Travian.Dialog.DarkBackgroundOverlay = function (a, b) {
    this.options = Object.assign({
        color: "#000",
        duration: 400,
        zIndex: 5000,
        open: {opacity: 0.5},
        close: {opacity: 0},
        animateFunction: function (d, c, f, e) {
            d.animate(c, f, e)
        },
        onClick: function () {
            this.close()
        }.bind(this)
    }, b);
    this.container = jQuery(a);
    this.overlay = jQuery("<div/>").attr("id", this.options.id).attr("class", "overlay").css({
        position: "fixed",
        background: this.options.color,
        left: 0,
        top: 0,
        opacity: 0,
        "z-index": this.options.zIndex,
        height: "100%",
        width: "100%"
    }).click(this.options.onClick).appendTo(this.container);
    this.open = function () {
        this.options.animateFunction(this.overlay, this.options.open, this.options.duration);
        return this
    };
    this.close = function () {
        this.options.animateFunction(this.overlay, this.options.close, this.options.duration);
        return this
    };
    this.remove = function () {
        this.overlay.remove()
    }
};
Travian.WindowManager = {
    windows: [], currentZIndex: 6000, zIndexMaxValue: 9900, width: 630, height: 460, register: function (a) {
        if (typeof a.options.context === "undefined") {
            a.options.context = "noContext"
        }
        a.identifier = this.__createIdentifier();
        this.windows.push(a);
        return a
    }, unregister: function (a) {
        this.windows = this.windows.filter(function (b) {
            return b !== a
        })
    }, closeWindow: function (a) {
        a.close()
    }, hideWindow: function (a) {
        a.hide()
    }, showWindow: function (a) {
        a.unhide()
    }, hideByContext: function (a) {
        var b = this;
        this.eachWindow(function (c) {
            if (!b.checkContext(a, c)) {
                return false
            }
            b.hideWindow(c)
        })
    }, showByContext: function (a) {
        var b = this;
        this.eachWindow(function (c) {
            if (!b.checkContext(a, c)) {
                return false
            }
            b.showWindow(c)
        })
    }, closeByContext: function (a) {
        var b = this;
        this.eachWindow(function (c) {
            if (!b.checkContext(a, c)) {
                return false
            }
            b.closeWindow(c)
        })
    }, getWindowsByContext: function (a) {
        var c = this;
        var b = [];
        this.eachWindow(function (d) {
            if (!c.checkContext(a, d)) {
                return false
            }
            b.push(d)
        });
        return b
    }, checkContext: function (b, a) {
        if (typeof a.options.context !== "undefined") {
            if (a.options.context === b) {
                return true
            }
        }
        return false
    }, eachWindow: function (b) {
        for (var a = 0; a < this.windows.length; a++) {
            b(this.windows[a])
        }
    }, getWindows: function () {
        return this.windows
    }, reloadWindow: function (a) {
        a.reload()
    }, reloadWindowsByContext: function (a) {
        var b = this;
        this.eachWindow(function (c) {
            if (!b.checkContext(a, c)) {
                return false
            }
            b.reloadWindow(c)
        })
    }, __createIdentifier: function () {
        return this.windows.length
    }, cleanupZIndex: function () {
        var a = 0;
        this.eachWindow(function (c) {
            var d = jQuery(c).css("zIndex");
            var b = (d - 3000);
            if (b > a) {
                a = b
            }
            jQuery(c).css({zIndex: b})
        });
        this.currentZIndex = a
    }, getZIndex: function () {
        if (this.currentZIndex >= this.zIndexMaxValue) {
            this.cleanupZIndex()
        }
        this.currentZIndex += 10;
        return this.currentZIndex
    }, getCurrentZIndex: function () {
        return this.currentZIndex
    }, checkOpenWindowByContext: function (a) {
        var c = false;
        var b = this;
        this.eachWindow(function (d) {
            if (b.checkContext(a, d)) {
                c = true
            }
        });
        return c
    }, checkForModalDialogs: function () {
        var a = false;
        this.eachWindow(function (b) {
            if (b.options.type === Travian.Dialog.DIALOG_TYPE_MODAL) {
                a = true
            }
        });
        return a
    }, getWindowDimensions: function () {
        var a = Travian.WindowManager.width, b = Travian.WindowManager.height;
        if (document.body && document.body.offsetWidth) {
            a = document.body.offsetWidth;
            b = document.body.offsetHeight
        }
        if (document.compatMode === "CSS1Compat" && document.documentElement && document.documentElement.offsetWidth) {
            a = document.documentElement.offsetWidth;
            b = document.documentElement.offsetHeight
        }
        if (window.innerWidth && window.innerHeight) {
            a = window.innerWidth;
            b = window.innerHeight
        }
        return {width: a, height: b}
    }, closeAllWindows: function () {
        var a = this;
        this.eachWindow(function (b) {
            a.closeWindow(b)
        })
    }, storeDocumentSize: function () {
        var a = jQuery(document);
        Travian.WindowManager.width = a.width();
        Travian.WindowManager.height = a.height()
    }
};
jQuery(Travian.WindowManager.storeDocumentSize);
jQuery(window).on("resize", Travian.WindowManager.storeDocumentSize);
Travian.RestoreWindowManager = {
    preferenceKey: "WMBlueprints", initialize: function () {
        jQuery(function () {
            var b = Travian.Game.Preferences.get(Travian.RestoreWindowManager.preferenceKey);
            if (b === null) {
                return false
            }
            b = JSON.parse(b);
            for (var a = 0; a < b.length; a++) {
                if (b[a].options.stickToUrlOnRestore && b[a].options.dialogOrigin !== location.pathname) {
                    return false
                }
                if (jQuery("#sidebarBoxMenu").length > 0) {
                    return false
                }
                new Travian.Dialog.Ajax(b[a].options)
            }
        });
        jQuery(window).on("beforeunload", function () {
            var a = [];
            Travian.WindowManager.eachWindow(function (b) {
                if (b.options.saveOnUnload) {
                    if (!b.isAjax()) {
                        return
                    }
                    delete b.options.relativeTo;
                    a.push({options: b.options});
                    if (b.options.savePositionForSession.preferenceKey !== null) {
                        Travian.Game.Preferences.set(b.options.savePositionForSession.preferenceKey, JSON.stringify(b.options.savePositionForSession))
                    }
                }
            });
            Travian.Game.Preferences.set(Travian.RestoreWindowManager.preferenceKey, JSON.stringify(a))
        })
    }
};
Travian.RestoreWindowManager.initialize();
Travian.Dialog.Ajax = function (a) {
    this.isAjax = function () {
        return true
    };
    Travian.Dialog.Dialog.call(this, a);
    if (typeof a.preview !== "undefined" && a.preview.enabled) {
        var b = a.preview;
        this.setContent(document.getElementById(b.contentElement).html()).setTitle(b.title).setInfoIcon(b.infoIcon).updateCssClass(b.dialogCSSClass).show();
        b.onShow(this)
    } else {
        this.request()
    }
};
Travian.Dialog.Ajax.prototype = Object.create(Travian.Dialog.Dialog.prototype);
Travian.Dialog.Ajax.constructor = Travian.Dialog.Ajax;
Travian.Dialog.Ajax.prototype.reload = function () {
    this.request()
};
Travian.Dialog.Ajax.prototype.request = function () {
    var a = this;
    Travian.ajax({
        data: this.options.data, onSuccess: function (b) {
            if (b.html !== "") {
                a.setContent(b.html).setTitle(b.title).setInfoIcon(b.infoIcon).updateCssClass(b.cssClass).show()
            } else {
                a.close()
            }
        }
    });
    return this
};
var Digitarald = {
    AutoCompleter: function (b, a) {
        this.selected = null;
        this.options = {
            minLength: 1,
            markQuery: true,
            width: "inherit",
            maxChoices: 10,
            injectChoice: null,
            customChoices: null,
            emptyChoices: null,
            visibleChoices: true,
            className: "autocompleter-choices",
            zIndex: 42,
            delay: 400,
            observerOptions: {},
            autoSubmit: false,
            overflow: false,
            overflowMargin: 25,
            selectFirst: false,
            filter: null,
            filterCase: false,
            filterSubset: false,
            forceSelect: false,
            selectMode: true,
            choicesMatch: null,
            multiple: false,
            separator: ", ",
            separatorSplit: /\s*[,;]\s*/,
            autoTrim: false,
            allowDupes: false,
            fx: {open: {opacity: 1}, close: {opacity: 0}, duration: 200},
            fxFunc: function (f, e, h, g) {
                f.animate(e, h, g)
            }
        };
        this.arrayUnique = function (e) {
            return e.reduce(function (f, g) {
                if (f.indexOf(g) < 0) {
                    f.push(g)
                }
                return f
            }, [])
        };
        this.destroy = function () {
            this.choices = this.selected = this.choices.destroy()
        };
        this.onCommand = function (i) {
            if (!i) {
                return this.prefetch()
            }
            var h = i.keyCode || i.which;
            if (i && !i.shiftKey && h) {
                switch (h) {
                    case 13:
                        if (this.element.val() !== this.opted) {
                            return true
                        }
                        if (this.selected && this.visible) {
                            this.choiceSelect(this.selected);
                            return this.options.autoSubmit
                        }
                        break;
                    case 38:
                    case 40:
                        if (!this.prefetch() && this.queryValue !== null) {
                            var f = (h === 38);
                            var g = this.selected ? (f ? "prev" : "next") : (f ? "last" : "first");
                            this.choiceOver((this.selected || this.choices.find("li"))[g](this.options.choicesMatch), true)
                        }
                        return false;
                    case 27:
                    case 9:
                        this.hideChoices(true);
                        break
                }
            }
            return true
        };
        this.selectRange = function (g, j, e) {
            if (g.setSelectionRange) {
                g.focus();
                g.setSelectionRange(j, e)
            } else {
                var h = g.get("data-value");
                var i = h.substr(j, e - j).replace(/\r/g, "").length;
                j = h.substr(0, j).replace(/\r/g, "").length;
                var f = g.createTextRange();
                f.collapse(true);
                f.moveEnd("character", j + i);
                f.moveStart("character", j);
                f.select()
            }
            return this
        };
        this.setSelection = function (j) {
            var k = this.selected.attr("data-value"), l = k;
            var e = this.searchFor.length, g = k.length;
            if (k.substr(0, e).toLowerCase() !== this.searchFor.toLowerCase()) {
                e = 0
            }
            if (this.options.multiple) {
                var i = this.options.separatorSplit;
                l = this.element.val();
                e += this.queryIndex;
                g += this.queryIndex;
                var f = l.substr(this.queryIndex).split(i, 1)[0];
                l = l.substr(0, this.queryIndex) + k + l.substr(this.queryIndex + f.length);
                if (j) {
                    var h = l.split(this.options.separatorSplit).filter(function (n) {
                        return this.test(n)
                    }, /[^\s,]+/);
                    if (!this.options.allowDupes) {
                        h = this.arrayUnique(h)
                    }
                    var m = this.options.separator;
                    l = h.join(m) + m;
                    g = l.length
                }
            }
            this.observer.setValue(l);
            this.opted = l;
            if (j || this.selectMode === "pick") {
                e = g
            }
            this.selectRange(this.element[0], e, g)
        };
        this.showChoices = function () {
            var h = this.options.choicesMatch, k = this.choices.children("li[value='" + h + "']").first();
            this.selected = this.selectedValue = null;
            if (!k) {
                return
            }
            if (!this.visible) {
                this.visible = true;
                this.choices.css({display: "inherit"});
                this.options.fxFunc(this.choices, this.options.fx.open, this.options.fx.duration)
            }
            if (this.options.selectFirst || this.typeAhead || k.inputValue === this.searchFor) {
                this.choiceOver(k, this.typeAhead)
            }
            var g = this.choices.children("li[value='" + h + "']"), f = this.options.maxChoices;
            var i = {overflowY: "hidden", height: ""};
            this.overflown = false;
            if (g.length > f) {
                i.overflowY = "scroll";
                i.height = this.choices.offset().top - g[f].offset().top;
                this.overflown = true
            }
            if (this.options.visibleChoices) {
                var j = this.element.offset();
                var e = this.element.outerHeight();
                i.left = j.left;
                i.top = j.top + e
            }
            this.choices.css(i)
        };
        this.hideChoices = function (e) {
            if (e) {
                var g = this.element.val();
                if (this.options.forceSelect) {
                    g = this.opted
                }
                if (this.options.autoTrim) {
                    g = g.split(this.options.separatorSplit).filter(function (h) {
                        return h
                    }).join(this.options.separator)
                }
                this.observer.setValue(g)
            }
            if (!this.visible) {
                return
            }
            this.visible = false;
            if (this.selected) {
                this.selected.removeClass("autocompleter-selected")
            }
            this.observer.clear();
            var f = function () {
                this.choices.css({display: "none"})
            }.bind(this);
            this.options.fxFunc(this.choices, this.options.fx.open, this.options.fx.duration, f)
        };
        this.prefetch = function () {
            var j = this.element.val(), i = j, h = j;
            if (this.options.multiple) {
                var f = this.options.separatorSplit;
                var e = this.element[0].selectionStart;
                var k = j.substr(0, e).split(f);
                var g = k.length - 1;
                e -= k[g].length;
                i = k;
                h = k[g].toLowerCase()
            }
            if (h.length < this.options.minLength) {
                this.hideChoices()
            } else {
                if (h === this.searchFor || (this.visible && i === this.selectedValue)) {
                    if (this.visible) {
                        return false
                    }
                    this.showChoices()
                } else {
                    this.searchFor = h;
                    this.queryValue = i;
                    this.queryIndex = e;
                    this.query(this.queryValue)
                }
            }
            return true
        };
        this.update = function (k) {
            this.choices.empty();
            var h = k && typeof k;
            if (h === "object" && !k.length) {
                (this.options.emptyChoices || this.hideChoices).call(this)
            } else {
                if (this.options.maxChoices < k.length && !this.options.overflow) {
                    k.length = this.options.maxChoices
                }
                for (var g = 0; g < k.length; g++) {
                    var f = k[g];
                    if (this.options.injectChoice) {
                        this.options.injectChoice(f)
                    } else {
                        var j = this.markQueryValue(f);
                        var e = jQuery("<li />").attr("data-value", f).html(j);
                        this.addChoiceEvents(e).appendTo(this.choices)
                    }
                }
                this.showChoices()
            }
        };
        this.choiceOver = function (g, h) {
            if (!g || g.length === 0 || g === this.selected) {
                return
            }
            if (this.selected) {
                this.selected.removeClass("autocompleter-selected")
            }
            this.selected = g.addClass("autocompleter-selected");
            if (!this.selectMode) {
                this.opted = this.element.val()
            }
            if (!h) {
                return
            }
            this.selectedValue = this.selected.attr("data-value");
            if (this.overflown) {
                var j = this.selected.position(), i = this.options.overflowMargin, k = this.choices.scrollTop,
                    e = this.choices.offsetHeight, f = k + e;
                if (j.top - i < k && k) {
                    this.choices.scrollTop = Math.max(j.top - i, 0)
                } else {
                    if (j.bottom + i > f) {
                        this.choices.scrollTop = Math.min(j.bottom - e + i, f)
                    }
                }
            }
            if (this.selectMode) {
                this.setSelection()
            }
        };
        this.choiceSelect = function (e) {
            if (e && e.length > 0) {
                this.choiceOver(e)
            }
            this.setSelection(true);
            this.searchFor = false;
            this.hideChoices()
        };
        this.escapeRegExp = function (e) {
            return String(e).replace(/([-.*+?^${}()|[\]\/\\])/g, "\\$1")
        };
        this.filter = function (e) {
            return (e || this.tokens).filter(function (f) {
                return this.test(f)
            }, new RegExp(((this.options.filterSubset) ? "" : "^") + this.escapeRegExp(this.searchFor), (this.options.filterCase) ? "" : "i"))
        };
        this.markQueryValue = function (e) {
            return (!this.options.markQuery || !this.searchFor) ? e : e.replace(new RegExp("(" + ((this.options.filterSubset) ? "" : "^") + this.escapeRegExp(this.searchFor) + ")", (this.options.filterCase) ? "" : "i"), '<span class="autocompleter-queried">$1</span>')
        };
        this.addChoiceEvents = function (e) {
            return e.on({mouseover: this.choiceOver.bind(this, e), click: this.choiceSelect.bind(this, e)})
        };
        this.Observer = function (g, e, f) {
            this.delay = f || 1000;
            this.timeout = null;
            this.equals = function (i, h) {
                return (i === h || JSON.stringify(i) === JSON.stringify(h))
            };
            this.changed = function () {
                var h = this.element.val();
                if (this.equals(this.value, h)) {
                    return
                }
                this.clear();
                this.value = h;
                this.timeout = setTimeout(this.onFired, this.delay, [this.value, this.element])
            };
            this.setValue = function (h) {
                this.value = h;
                this.element.val(h);
                return this.clear()
            };
            this.clear = function () {
                clearTimeout(this.timeout);
                return this
            };
            this.element = g;
            this.onFired = e;
            this.value = this.element.get("data-value");
            this.element.on("keyup", this.changed.bind(this))
        };
        Object.assign(this.options, a);
        var c = jQuery(this.options.customChoices);
        this.choices = c.length > 0 ? c : jQuery("<ul/>").addClass(this.options.className).css({
            zIndex: this.options.zIndex,
            display: "none"
        }).appendTo("body");
        this.element = b.prop("autocomplete", "off").on("keydown", this.onCommand.bind(this)).on("click", this.onCommand.bind(this, false)).on("focusout", this.hideChoices.bind(this, true));
        this.observer = new this.Observer(this.element, this.prefetch.bind(this), this.options.delay);
        this.searchFor = null;
        this.queryValue = null;
        if (this.options.filter) {
            this.filter = this.options.filter.bind(this)
        }
        var d = this.options.selectMode;
        this.typeAhead = (d === "type-ahead");
        this.selectMode = (d === true) ? "selection" : d
    }
};
Digitarald.AutoCompleter.prototype.query = function (a) {
};
Travian.DoubleClickPreventer = function () {
    this.prevent = false;
    this.timeout = 400;
    this.timerId = 0;
    this.check = function () {
        if (this.prevent) {
            return false
        }
        this.prevent = true;
        var a = this;
        this.timerId = setTimeout(function () {
            a.prevent = false
        }, this.timeout);
        return true
    };
    this.cancelTimer = function () {
        if (this.timerId) {
            clearTimeout(this.timerId);
            this.timerId = 0;
            this.prevent = false
        }
    }
};
Travian.DoubleClickPreventer.globalPrevent = false;
Travian.DoubleClickPreventer.globalTimeout = 400;
Travian.DoubleClickPreventer.globalCheck = function () {
    var a = Travian.DoubleClickPreventer.prevent;
    if (a === false) {
        Travian.DoubleClickPreventer.prevent = true;
        Travian.DoubleClickPreventer.timer = setTimeout(function () {
            Travian.DoubleClickPreventer.prevent = false
        }, Travian.DoubleClickPreventer.timeout)
    }
    return !a
};
Travian.Form = function () {
    this.elements = {};
    this.addElement = function (a, b) {
        b.setName(a);
        this.elements[a] = b;
        return this
    };
    this.addInputElementByName = function (a, c) {
        var b = Travian.Form.Element.Input.createElementByName(this, a, c);
        this.addElement(a, b);
        return this
    };
    this.onElementChanged = function (b) {
        var c = b.isDirty();
        if (c === false) {
            var a;
            for (a in this.elements) {
                if (this.elements[a].isDirty()) {
                    c = true;
                    break
                }
            }
        }
        this.onDirty(c);
        return this
    }
};
Travian.Form.prototype.onClick = function (a) {
    return this
};
Travian.Form.prototype.onDirty = function (a) {
    return this
};
Travian.Form.UnloadHelper = Object.create({
    formQueryString: "input, textarea, select",
    message: null,
    identifierCount: 0,
    htmlForms: {},
    formStates: {},
    initialize: function () {
        var a = this;
        window.onbeforeunload = function () {
            var b = a.isEnabled();
            if (b) {
                return a.message
            } else {
                return
            }
        }
    },
    isEnabled: function () {
        var b;
        for (b in this.formStates) {
            if (this.formStates[b]) {
                return true
            }
        }
        for (b in this.htmlForms) {
            var c = jQuery("#" + b);
            if (c === null) {
                delete this.htmlForms[b];
                continue
            }
            var a = this.htmlForms[b];
            var d = this.generateFormHash(c);
            if (a !== d) {
                return true
            }
        }
        return false
    },
    enableSecurity: function (a) {
        if (a === null) {
            a = this.getIdentifier()
        }
        this.formStates[a] = true;
        return a
    },
    disableSecurity: function (a) {
        this.formStates[a] = false
    },
    getIdentifier: function () {
        this.identifierCount++;
        return this.identifierCount
    },
    generateFormHash: function (b) {
        var a = "";
        b.find(this.formQueryString).each(function () {
            var d = jQuery(this);
            var c = d.prop("tagName").toLowerCase();
            var f = d.attr("type");
            if (typeof f === "string") {
                f = f.toLowerCase()
            }
            switch (true) {
                case c === "input" && (f === "checkbox" || f === "radio"):
                    a += d.is(":checked");
                    break;
                case c === "input" || c === "textarea":
                    a += d.val();
                    break;
                case c === "select":
                    var e = d.find("option:selected");
                    if (e.length > 0) {
                        a += e.prop("value")
                    }
                    break
            }
        });
        return jQuery.md5(a)
    },
    watchHtmlForm: function (a) {
        var b = this;
        a.delegate(this.formQueryString, "change", function () {
            b.updateSubmitButtons(a)
        });
        this.htmlForms[a.attr("id")] = this.generateFormHash(a);
        a.on("submit", function () {
            b.htmlForms[a.attr("id")] = b.generateFormHash(a)
        });
        this.updateSubmitButtons(a)
    },
    unwatchHtmlForm: function (a) {
        delete this.htmlForms[a.attr("id")]
    },
    updateSubmitButtons: function (b) {
        var c = this;
        var a = (c.htmlForms[b.attr("id")] === c.generateFormHash(b));
        b.find("input[type=submit], button[type=submit]").each(function () {
            jQuery(this).toggleClass("disabled", a)[0].disabled = a
        })
    }
});
Travian.Form.UnloadHelper.initialize();
Travian.Form.Element = function (a) {
    this.form = null;
    this.name = null;
    this.initialize = function (b) {
        this.form = b
    };
    this.onClick = function () {
        this.form.onClick(this);
        return this
    };
    this.setForm = function (b) {
        this.form = b;
        return this
    };
    this.setName = function (b) {
        this.name = b;
        return this
    };
    this.getName = function () {
        return this.name
    };
    this.initialize(a)
};
Travian.Form.Element.prototype.onChange = function () {
    this.form.onElementChanged(this);
    return this
};
Travian.Form.Element.prototype.isDirty = function () {
    return false
};
Travian.Form.Element.Input = function (b, a) {
    this.originalValue = null;
    this.currentValue = null;
    this.type = null;
    this.element = null;
    this.initialize = function (d, c) {
        Travian.Form.Element.call(this, d);
        this.element = c;
        this.originalValue = this.currentValue = this.getValue();
        this.initEvents()
    };
    this.getInput = function () {
        return this.element
    };
    this.onChange = function () {
        this.currentValue = this.getValue();
        Travian.Form.Element.prototype.onChange.call(this);
        return this
    };
    this.isDirty = function () {
        return this.originalValue !== this.currentValue
    };
    this.initialize(b, a)
};
Travian.Form.Element.Input.prototype = Object.create(Travian.Form.Element.prototype);
Travian.Form.Element.Input.constructor = Travian.Form.Element.Input;
Travian.Form.Element.Input.createElementByName = function (d, a, c) {
    var f = null;
    if (typeof c === "undefined") {
        c = jQuery(document)
    }
    var e = c.find('[name="' + a + '"]');
    if (e.length === 0) {
        throw new Error('Element with name "' + a + '" not found.')
    }
    var b = jQuery(e[0]);
    switch (b.prop("tagName").toLowerCase()) {
        case"input":
            f = b.attr("type");
            if (f === "radio" || f === "checkbox") {
                b = e
            }
            break;
        default:
            f = b.get(0).nodeName.toLowerCase();
            break
    }
    f = f.charAt(0).toUpperCase() + f.slice(1).toLowerCase();
    if (!Travian.Form.Element.Input[f]) {
        throw new Error('Element type "' + f + '" not yet implemented!')
    }
    return new Travian.Form.Element.Input[f](d, b)
};
Travian.Form.Element.Input.prototype.initEvents = function () {
    var a = this;
    this.element.on("change", function () {
        a.onChange()
    });
    return this
};
Travian.Form.Element.Input.prototype.getValue = function () {
    return this.element.val()
};
Travian.Form.Element.Input.Button = function (b, a) {
    this.initEvents = function () {
        var c = this;
        this.element.on("click", function () {
            c.onClick()
        });
        return this
    };
    this.getValue = function () {
        return null
    };
    Travian.Form.Element.Input.call(this, b, a)
};
Travian.Form.Element.Input.Button.prototype = Object.create(Travian.Form.Element.Input.prototype);
Travian.Form.Element.Input.Button.constructor = Travian.Form.Element.Input.Button;
Travian.Form.Element.Input.Checkbox = function (b, a) {
    this.valueBefore = null;
    this.initEvents = function () {
        var c = this;
        this.valueBefore = this.getValue();
        this.element.on("click", function () {
            if (c.getValue() !== c.valueBefore) {
                c.valueBefore = c.getValue();
                c.onChange()
            }
        });
        return this
    };
    this.getValue = function () {
        var c = null;
        if (this.element.length > 0) {
            this.element.each(function (e, f) {
                var d = jQuery(f);
                if (d.is(":checked")) {
                    c = d.val()
                }
            })
        }
        return c
    };
    Travian.Form.Element.Input.call(this, b, a)
};
Travian.Form.Element.Input.Checkbox.prototype = Object.create(Travian.Form.Element.Input.prototype);
Travian.Form.Element.Input.Checkbox.constructor = Travian.Form.Element.Input.Checkbox;
Travian.Form.Element.Input.Radio = function (b, a) {
    this.valueBefore = null;
    this.initEvents = function () {
        var c = this;
        this.valueBefore = this.getValue();
        this.element.on("click", function () {
            if (c.getValue() !== c.valueBefore) {
                c.valueBefore = c.getValue();
                c.onChange()
            }
        });
        return this
    };
    this.getValue = function () {
        var c = null;
        if (this.element.length > 0) {
            this.element.each(function (e, f) {
                var d = jQuery(f);
                if (d.is(":checked")) {
                    c = d.val()
                }
            })
        }
        return c
    };
    Travian.Form.Element.Input.call(this, b, a)
};
Travian.Form.Element.Input.Radio.prototype = Object.create(Travian.Form.Element.Input.prototype);
Travian.Form.Element.Input.Radio.constructor = Travian.Form.Element.Input.Radio;
Travian.Form.Element.Input.Text = function (b, a) {
    Travian.Form.Element.Input.call(this, b, a)
};
Travian.Form.Element.Input.Text.prototype = Object.create(Travian.Form.Element.Input.prototype);
Travian.Form.Element.Input.Text.constructor = Travian.Form.Element.Input.Text;
Travian.Form.Element.Input.Textarea = function (b, a) {
    Travian.Form.Element.Input.call(this, b, a)
};
Travian.Form.Element.Input.Textarea.prototype = Object.create(Travian.Form.Element.Input.prototype);
Travian.Form.Element.Input.Textarea.constructor = Travian.Form.Element.Input.Textarea;
Travian.Formatter = function (a) {
    this.options = Object.assign({
        languageKey: "de-DE",
        formatType: "type3",
        decimalSeperator: ",",
        forceDecimal: true
    }, a);
    this.getFormattedNumber = function (d) {
        if (isNaN(d) || d === undefined || d === null || d === "") {
            return 0
        }
        if (parseInt(d) !== d) {
            d = String(parseFloat(d))
        } else {
            d = String(parseFloat(d)) + ".0"
        }
        var f = d.match(/([\d.,\s-]*?)[.,]?(\d*)?$/);
        var g = {left: f[1], right: f[2]};
        g.left = g.left.replace(/[\s,.'"]*/g, "");
        var c = false;
        if (g.left < 0) {
            c = true
        }
        g.left = g.left.replace(/[-]*/g, "");
        var e = 0;
        if (this.typeFunctions[this.options.formatType] === undefined) {
            throw"Der Zahlenformattyp" + this.options.formatType + "ist unbekannt!"
        }
        e = this.typeFunctions[this.options.formatType].createNumberFunction(g, this.options);
        if (c === true) {
            e = "-" + e
        }
        return e
    };
    this.setOptionLanguageKey = function (c) {
        var d = this.getDefinitionByLanguage(c);
        if (d !== false) {
            this.options.formatType = d.type;
            this.options.decimalSeperator = d.decimalSeperator;
            return true
        }
        return false
    };
    this.getAvailableTypes = function () {
        var c = [];
        Object.each(this.typeFunctions, function (e, d) {
            c.push(d)
        });
        return c
    };
    this.removeNonDigits = function (c) {
        var d = c.match(/\d/g);
        d = parseInt(d.join(""));
        return d
    };
    this.getDefinitionByLanguage = function (g) {
        var f = this;
        var e = false;
        for (var c in this.languageDefinitions) {
            var d = this.languageDefinitions[c];
            if (d.languages.indexOf(g) !== -1) {
                e = f.languageDefinitions[c];
                break
            }
        }
        return e
    };
    this.languageDefinitions = {
        1: {
            decimalSeperator: ",",
            type: "type1",
            languages: ["bg-BG", "cs-CZ", "et-EE", "fi-FI", "fr-FR", "hu-HU", "lt-LT", "lv-LV", "pl-PL", "pt-PT", "ru-RU", "sk-SK", "sv-SE", "uk-UA"]
        },
        2: {decimalSeperator: ".", type: "type2", languages: ["bs-BA-Latn", "en-US", "ja-JP", "ms-MY", "th-TH", "com"]},
        3: {
            decimalSeperator: ",",
            type: "type3",
            languages: ["ar-AE", "da-DK", "de-DE", "el-GR", "es-CL", "es-ES", "fa-IR", "he-IL", "hr-HR", "id-ID", "it-IT", "nl-NL", "no-NO", "pt-BR", "ro-RO", "sl-SI", "sr-RS-Cyrl", "tr-TR", "vi-VN"]
        },
        4: {decimalSeperator: ".", type: "type4", languages: ["in"]}
    };
    this.typeFunctions = {
        type1: {
            createNumberFunction: function (g, d) {
                var c = "";
                var f = g.left.split("").reverse().join("");
                for (var e = 0; e <= (f.length - 1);
                     e++) {
                    if (e % 3 === 0 && e !== 0) {
                        c += " "
                    }
                    c += f.charAt(e)
                }
                c = c.split("").reverse().join("");
                if (g.right !== undefined && d.forceDecimal === true) {
                    c += "," + g.right
                }
                return c
            }
        }, type2: {
            createNumberFunction: function (g, d) {
                var c = "";
                var f = g.left.split("").reverse().join("");
                for (var e = 0; e <= (f.length - 1); e++) {
                    if (e % 3 === 0 && e !== 0) {
                        c += ","
                    }
                    c += f.charAt(e)
                }
                c = c.split("").reverse().join("");
                if (g.right !== undefined && d.forceDecimal === true) {
                    c += "." + g.right
                }
                return c
            }
        }, type3: {
            createNumberFunction: function (g, d) {
                var c = "";
                var f = g.left.split("").reverse().join("");
                for (var e = 0; e <= (f.length - 1); e++) {
                    if (e % 3 === 0 && e !== 0) {
                        c += "."
                    }
                    c += f.charAt(e)
                }
                c = c.split("").reverse().join("");
                if (g.right !== undefined && d.forceDecimal === true) {
                    c += "," + g.right
                }
                return c
            }
        }, type4: {
            createNumberFunction: function (k, e) {
                var d = "";
                var h = 3;
                var g = k.left.split("").reverse().join("");
                var c = 0;
                for (var f = 0; f <= (g.length - 1); f++) {
                    if (c % h === 0 && c !== 0) {
                        d += ",";
                        h = 2;
                        c = 0
                    }
                    d += g.charAt(f);
                    c++
                }
                d = d.split("").reverse().join("");
                if (k.right !== undefined && e.forceDecimal === true) {
                    d += "." + k.right
                }
                return d
            }
        }, seperatorless: {
            createNumberFunction: function (e, d) {
                var c = e.left;
                if (e.right !== undefined && d.forceDecimal === false) {
                    c += d.decimalSeperator + e.right
                }
                return c
            }
        }, toInt: {
            createNumberFunction: function (d, c) {
                return d.left
            }
        }, toIntRounded: {
            createNumberFunction: function (e, d) {
                if (e.right === undefined) {
                    return e.left
                }
                var c = e.left + "." + e.right;
                return (Number.convert(c)).round()
            }
        }
    };
    if (a === undefined || a.languageKey === undefined) {
        this.options.languageKey = Travian.Game.language
    }
    if (this.options.languageKey !== undefined) {
        var b = this.getDefinitionByLanguage(this.options.languageKey);
        if (b !== false) {
            this.options.formatType = b.type;
            this.options.decimalSeperator = b.decimalSeperator
        }
    }
};
Travian.Formatter.Filter = {
    aNumber: function (a) {
        if (!a.value.match(/^[0-9\-\.,]+$/)) {
            a.value = a.value.replace(/[^0-9\-\.,]/g, "")
        }
    }
};
Travian.Seasons = Object.create({
    currentSeason: null, setState: function (c) {
        var a = jQuery("body");
        var b = Travian.Seasons.currentSeason.cssClassName;
        a.find("span.pleaseSaveYourChanges").removeClass("hidden");
        c ? a.addClass(b) : a.removeClass(b);
        Travian.Seasons.currentSeason.setState(c)
    }
});
Travian.Seasons.Season = function () {
};
Travian.Seasons.Season.prototype.cssClassName = "";
Travian.Seasons.Season.prototype.setState = function (a) {
};
Travian.Seasons.Season.prototype.restart = function (a) {
};
Travian.Seasons.Season.prototype.setPreferences = function (a) {
    return a
};
Travian.Seasons.currentSeason = new Travian.Seasons.Season();
Travian.Seasons.Winter = function () {
    this.cssClassName = "season-winter";
    this.snowSettings = {
        enabled: false,
        maxFlakes: 250,
        maxFlakeRadius: 3,
        maxDensity: 25,
        screenWidth: 0,
        screenHeight: 0,
        moveToBackground: true
    };
    this.snowFlakes = [];
    this.context = null;
    this.wind = 0;
    this.animationFrame = null;
    this.animationTime = 0;
    this.restarting = false;
    this.bodyWrapperHeight = 0;
    this.updateState = function () {
        var e = jQuery("body");
        var j = jQuery(document);
        this.bodyWrapperHeight = jQuery("#bodyWrapper").height();
        var f = (!e.hasClass("ie") || e.hasClass("ie11"));
        if (this.snowSettings.enabled && f) {
            this.snowSettings.screenWidth = j.width();
            this.snowSettings.screenHeight = j.height();
            var g = (this.snowSettings.moveToBackground ? "movedToBackground" : "");
            var d;
            if (!this.snowSettings.moveToBackground) {
                d = e
            } else {
                d = jQuery("#background")
            }
            d.prepend('<canvas id="snowAnimation" class="' + g + '" width="' + this.snowSettings.screenWidth + '" height="' + this.snowSettings.screenHeight + '"></canvas>');
            this.context = document.getElementById("snowAnimation").getContext("2d");
            this.context.fillStyle = "rgba(255, 255, 255, 0.8)";
            this.context.width = this.snowSettings.screenWidth;
            this.context.height = this.snowSettings.screenHeight;
            for (var h = 0; h < this.snowSettings.maxFlakes; h++) {
                this.snowFlakes.push({
                    x: parseFloat((Math.random() * this.snowSettings.screenWidth).toFixed(2)),
                    y: parseFloat((Math.random() * this.snowSettings.screenHeight).toFixed(2)),
                    radius: parseFloat((Math.random() * this.snowSettings.maxFlakeRadius).toFixed(2)),
                    density: parseFloat((Math.random() * this.snowSettings.maxDensity).toFixed(2))
                })
            }
            this.animationTime = Date.now();
            this.animationFrame = requestAnimationFrame(this.runAnimation);
            jQuery(window).on("resize.travianSnowAnimation", this.restart)
        }
        this.restarting = false
    };
    this.runAnimation = function () {
        var d = jQuery("#bodyWrapper").height();
        if (d !== c.bodyWrapperHeight) {
            c.restart()
        } else {
            if (c.animationFrame !== null) {
                var e = Date.now();
                if ((e - c.animationTime) > 24) {
                    c.drawTheSnow();
                    c.updateSnowFlakePositions();
                    c.animationTime = e
                }
                c.animationFrame = requestAnimationFrame(c.runAnimation)
            }
        }
    };
    this.updateSnowFlakePositions = function () {
        c.wind += 0.01;
        var d = 6;
        if (Math.sin(c.wind) > -0.1 && Math.sin(c.wind) < 0.1) {
            d = 10
        }
        var e;
        for (var f = 0; f < c.snowFlakes.length; f++) {
            e = c.snowFlakes[f];
            e.x = parseFloat((e.x + Math.sin(c.wind) * 2).toFixed(2));
            e.y = parseFloat((e.y + Math.cos(c.wind + e.density) + 1 + e.radius / 2).toFixed(2));
            if ((e.y + e.radius > c.snowSettings.screenHeight) || (e.x + e.radius) < e.radius * -1 || (e.x + e.radius) > c.snowSettings.screenWidth + e.radius) {
                if (f % d > 0) {
                    e.x = Math.random() * c.snowSettings.screenWidth;
                    e.y = e.radius * -1
                } else {
                    if (Math.random() > 0.5) {
                        e.x = e.radius * -1;
                        e.y = Math.random() * c.snowSettings.screenHeight
                    } else {
                        e.x = c.snowSettings.screenWidth;
                        e.y = Math.random() * c.snowSettings.screenHeight
                    }
                }
            }
        }
    };
    this.drawTheSnow = function () {
        var e = Math.PI * 2;
        c.context.clearRect(0, 0, c.snowSettings.screenWidth, c.snowSettings.screenHeight);
        c.context.beginPath();
        var d;
        var g = c.context;
        for (var f = 0; f < c.snowFlakes.length; f++) {
            d = c.snowFlakes[f];
            g.moveTo(d.x, d.y);
            g.arc(d.x, d.y, d.radius, 0, e)
        }
        c.context.fill()
    };
    this.restart = function () {
        jQuery(window).off("resize.travianSnowAnimation");
        c.restarting = true;
        cancelAnimationFrame(c.animationFrame);
        c.animationFrame = null;
        c.context = null;
        var d = jQuery("canvas#snowAnimation");
        c.snowFlakes = [];
        d.remove();
        c.updateState()
    };
    this.setState = function (e) {
        var d = e && jQuery("input[name=option_seasonal_snow_enabled]").is(":checked");
        this.setPreferences({enabled: d});
        this.restart()
    };
    this.setPreferences = function (d) {
        this.snowSettings = Object.assign(this.snowSettings, d);
        return this.snowSettings
    };
    this.isActive = function () {
        return (jQuery("body").attr("class") || "").split(" ").indexOf(this.cssClassName) > -1
    };
    Travian.Seasons.Season.call(this);
    var c = this;
    var a = {};
    try {
        a = JSON.parse(Travian.Game.Preferences.get("snowAnimation"))
    } catch (b) {
    }
    this.setPreferences(a);
    if (this.isActive()) {
        this.restart()
    }
};
Travian.Seasons.Winter.prototype = Object.create(Travian.Seasons.Season.prototype);
Travian.Seasons.Winter.constructor = Travian.Seasons.Winter;
Travian.Seasons.Winter.writeNewPreferences = function (a) {
    jQuery("body").find("span.pleaseSaveYourChanges").removeClass("hidden");
    jQuery("input[name=option_seasonal_snow_preferencesSettings]").val(JSON.stringify(a)).trigger("change")
};
Travian.Seasons.Winter.setSettingsElementState = function (b, c) {
    var a = b.find("input, select");
    if (c) {
        b.removeClass("disabled");
        a.prop("disabled", false)
    } else {
        b.addClass("disabled");
        a.prop("disabled", true)
    }
};
Travian.Seasons.Winter.bindSettingsEvents = function (a, b) {
    Travian.Seasons.Winter.setSettingsElementState(b, a.is(":checked"));
    a.on("change", function () {
        Travian.Seasons.Winter.setSettingsElementState(b, this.checked)
    });
    b.find("#option_seasonal_snow_enabled").on("change", function () {
        var c = this.checked;
        if (!Travian.Seasons.currentSeason.restarting) {
            setTimeout(function () {
                var d = Travian.Seasons.currentSeason.setPreferences({enabled: c});
                Travian.Seasons.Winter.writeNewPreferences(d);
                Travian.Seasons.currentSeason.restart()
            }, 100)
        }
    });
    b.find("#option_seasonal_snow_maxFlakes").on("change", function () {
        var c = Math.min(2500, Math.max(25, parseInt(jQuery(this).val())));
        if (!Travian.Seasons.currentSeason.restarting) {
            setTimeout(function () {
                var d = Travian.Seasons.currentSeason.setPreferences({maxFlakes: c});
                Travian.Seasons.Winter.writeNewPreferences(d);
                Travian.Seasons.currentSeason.restart()
            }, 100)
        }
    });
    b.find("#option_seasonal_snow_maxFlakeRadius").on("change", function () {
        var c = Math.min(10, Math.max(3, parseInt(jQuery(this).val())));
        if (!Travian.Seasons.currentSeason.restarting) {
            setTimeout(function () {
                var d = Travian.Seasons.currentSeason.setPreferences({maxFlakeRadius: c});
                Travian.Seasons.Winter.writeNewPreferences(d);
                Travian.Seasons.currentSeason.restart()
            }, 100)
        }
    });
    b.find("#option_seasonal_snow_moveToBackground").on("change", function () {
        var c = parseInt(jQuery(this).val()) === 1;
        if (!Travian.Seasons.currentSeason.restarting) {
            setTimeout(function () {
                var d = Travian.Seasons.currentSeason.setPreferences({moveToBackground: c});
                Travian.Seasons.Winter.writeNewPreferences(d);
                Travian.Seasons.currentSeason.restart()
            }, 100)
        }
    })
};
jQuery(function () {
    if (Travian.Defaults.Season === "winter") {
        Travian.Seasons.currentSeason = new Travian.Seasons.Winter()
    }
});
Travian.Game = {
    currentPage: window.location.href.split("/").pop().split(".php", 2).shift(),
    eventJamHtml: null,
    speed: 1,
    version: 4,
    worldId: null,
    gotoPage: function (c, d, a, b) {
        Travian.ajax({
            data: {cmd: d, data: {page: c, entries: b}}, onSuccess: function (e) {
                jQuery(a).html(e.result)
            }
        });
        return this
    },
    iPopup: function (b, c) {
        var a = new Travian.Dialog.Dialog({
            title: Travian.Translation.translate("{allgemein.anleitung}"),
            buttonOk: false,
            enableBackground: false,
            draggable: true,
            fx: {open: {opacity: 1}, close: {opacity: 0}, duration: 0}
        });
        a.setContent('<iframe class="popup" frameborder="0" id="Frame" src="manual.php?typ=' + c + "&amp;gid=" + b + '" width="475" height="525" scrolling="no" border="0" allowTransparency="true"></iframe>');
        a.show();
        return false
    },
    iPopupUrl: function (a, c) {
        var b = new Travian.Dialog.Dialog({
            title: c,
            buttonOk: false,
            enableBackground: false,
            draggable: true,
            fx: {open: {opacity: 1}, close: {opacity: 0}, duration: 0}
        });
        b.setContent('<iframe class="popup" frameborder="0" id="Frame" src="' + a + '" width="475" height="500" scrolling="yes" border="0" allowTransparency="true"></iframe>');
        b.show();
        return false
    },
    unitZoom: function (b) {
        var a = new Travian.Dialog.Dialog({buttonOk: false});
        a.setContent('<div class="zoomTop"></div><div class="zoomMiddle"><img src="img/x.gif" class="unitBig u' + b + 'Big" /></div><div class="zoomBottom"></div>');
        a.show();
        return false
    },
    showEditVillageDialog: function (e, a, c, b) {
        var d = jQuery("div#villageNameField").html().replace(/\"/g, "&quot;");
        new Travian.Dialog.Dialog({
            title: e, buttonTextOk: c, preventFormSubmit: true, onOkay: function (f, g) {
                Travian.ajax({
                    data: {cmd: "changeVillageName", name: jQuery("input#villageNameInput").val(), did: b},
                    onSuccess: function (h) {
                        jQuery("#villageNameField").html(h.name)
                    }
                })
            }
        }).setContent(a + ' <input type="text" id="villageNameInput" name="villageName" value="' + d + '" maxlength="20" class="text" />').show();
        return this
    }
};
jQuery(function () {
    Travian.TimersAndCounters.init();
    var a = jQuery("*.dynamic_img");
    a.on({
        mouseenter: function (b) {
            jQuery(this).addClass("over")
        }, mouseleave: function (b) {
            jQuery(this).removeClass("over").removeClass("clicked")
        }, mousedown: function (b) {
            jQuery(this).removeClass("over").addClass("clicked")
        }
    })
});
Travian.Game.Preferences = {
    preferences: {WMBlueprints: "[]"}, initialize: function (a) {
        var c = this;
        for (var b in a) {
            if (a.hasOwnProperty(b)) {
                switch (a[b]) {
                    case"true":
                        c.preferences[b] = true;
                        break;
                    case"false":
                        c.preferences[b] = false;
                        break;
                    case"null":
                        c.preferences[b] = null;
                        break;
                    default:
                        c.preferences[b] = a[b]
                }
            }
        }
    }, get: function (a) {
        if (this.preferences[a] !== undefined) {
            return this.preferences[a]
        }
        return null
    }, set: function (a, b) {
        if (this.preferences[a] !== b) {
            this.preferences[a] = b;
            Travian.ajax({data: {cmd: "preferences", key: a, value: b}})
        }
    }
};
Travian.Game.Layout = {
    states: {travian_toggle: ["expanded", "collapsed"]}, goldIsUpdating: false, toggleBox: function (f, c, j) {
        var g = c + "_" + j;
        var k = this.states[c];
        var b = Travian.Game.Preferences.get(g);
        if (k.indexOf(b) === -1) {
            b = k[0]
        }
        var d = "";
        for (var e = 0; e < k.length; e++) {
            var a = k[e];
            f.removeClass(a);
            if (a !== b) {
                d = a;
                f.addClass(d);
                var h = Travian.Translation.get(j + "_" + d);
                f.find("button.toggle").prop("title", h);
                Travian.Tip.refresh()
            }
        }
        Travian.Game.Preferences.set(g, d)
    }, loadLayoutButtonTitle: function (a, c, b) {
        Travian.ajax({
            data: {cmd: "getLayoutButtonTitle", boxId: c, buttonId: b}, onSuccess: function (e) {
                var d = {title: e.newTitle, text: e.newText, unescaped: false};
                Travian.Tip.setContent(a, d);
                Travian.Tip.show(d)
            }
        })
    }, setInfoboxItemsRead: function () {
        var b = jQuery("#sidebarBoxInfobox");
        if (b && b.hasClass("toggleable")) {
            var a = jQuery("#sidebarBoxInfobox li.unreaded");
            if (a.length > 0) {
                if (b.hasClass("collapsed") && a.length > 0) {
                    Travian.ajax({
                        data: {cmd: "infoboxSetReaded", infoIds: a}, onSuccess: function (c) {
                            jQuery("#sidebarBoxInfobox li.unreaded").removeClass("unreaded");
                            if (typeof c.messageCounterContent !== "undefined") {
                                jQuery("#sidebarBoxInfobox span.messageShortInfo").html(c.messageCounterContent)
                            }
                        }
                    })
                }
            }
        }
    }, setupInfoboxItemsDeletionWithMessage: function (b, a) {
        jQuery("a.infoboxDeleteButton").each(function (c, f) {
            var d = jQuery(f);
            var e = d.attr("data-id");
            d.click(function (h) {
                var g = new Travian.Dialog.Dialog({
                    preventFormSubmit: true, buttonTextOk: a, onOkay: function () {
                        Travian.ajax({
                            data: {cmd: "infoboxDelete", id: e}, onSuccess: function () {
                                window.location.href = window.location.href
                            }
                        })
                    }
                });
                g.setContent(b);
                g.show();
                return false
            })
        })
    }, updateGold: function (b) {
        Travian.Game.Layout.goldIsUpdating = true;
        var a = parseInt(jQuery(".ajaxReplaceableGoldAmount").first().html());
        Travian.ajax({
            data: {cmd: "getGoldAmount"}, onSuccess: function (d) {
                var c = d.goldAmount;
                if (c !== a) {
                    jQuery(".ajaxReplaceableGoldAmount").html(c);
                    if (typeof b === "function") {
                        b()
                    } else {
                        if (typeof b === "string" && typeof b.split(".").reduce(function (f, e) {
                            return f[e]
                        }, window) === "function") {
                            b.split(".").reduce(function (f, e) {
                                return f[e]
                            }, window)
                        }
                    }
                }
                Travian.Game.Layout.goldIsUpdating = false
            }
        })
    }, updateResources: function (a) {
        if (a === undefined) {
            Travian.ajax({
                data: {cmd: "getResources"}, onSuccess: function (c) {
                    Travian.Game.Layout.updateResources(c)
                }
            })
        } else {
            for (var b = 1; b <= 4; b++) {
                resources.storage["l" + b] = parseInt(a["l" + b])
            }
            Travian.TimersAndCounters.init()
        }
    }, toggleBackgroundOverlay: function () {
        var a = jQuery("#backgroundOverlay");
        if (a.length > 0) {
            a.removeClass("visible");
            setTimeout(function () {
                a.remove()
            }, 500)
        } else {
            a = jQuery('<div id="backgroundOverlay"/>');
            jQuery("body").prepend(a);
            a.addClass("visible")
        }
    }
};
Travian.Game.ColorPicker = function (a, b) {
    this.selectColor = function (c) {
        var d = this;
        this.container.find("div.moocolorcheckbox-container").removeClass(d.options.selectedClassName);
        this.container.find('div[colorPick="' + c + '"]').each(function (e, f) {
            jQuery(f).parent("div").addClass(d.options.selectedClassName);
            d.options.onChange(c)
        });
        return this
    };
    this.draw = function () {
        var c = this;
        this.container.empty();
        this.options.colors.forEach(function (d) {
            var e = jQuery("<div/>").addClass(c.options.className + " moocolorcheckbox-container").css({
                "float": "left",
                cursor: "pointer"
            }).on("click", function () {
                c.selectColor(d)
            }).appendTo(c.container);
            jQuery("<div/>").addClass("entry").html("&nbsp;").css({"background-color": d}).attr("colorPick", d).appendTo(e)
        });
        return this
    };
    this.options = Object.assign({}, {
        colors: [],
        defaultColor: -1,
        className: "moocolorcheckbox",
        selectedClassName: "moocolorcheckbox_selected"
    }, b);
    this.container = jQuery(a);
    this.container.css("overflow", "hidden");
    this.draw();
    if (this.options.defaultColor >= 0) {
        this.selectColor(this.options.colors[this.options.defaultColor])
    }
};
Travian.Game.ImagePicker = function (a, b) {
    this.selectImage = function (d) {
        var e = this;
        this.container.find("div").removeClass(e.options.selectedClassName);
        this.container.find('img[src$="' + d + '"]').each(function (g, f) {
            jQuery(f).parent("div").addClass(e.options.selectedClassName);
            e.options.onChange(d)
        });
        return this
    };
    this.options = Object.assign({}, {
        images: [],
        defaultImage: -1,
        className: "mooimagecheckbox",
        selectedClassName: "mooimagecheckbox_selected",
        onChange: Travian.emptyFunction
    }, b);
    this.container = a;
    this.container.css({overflow: "hidden"});
    var c = this;
    c.container.empty();
    this.options.images.forEach(function (d) {
        jQuery("<div/>").addClass(c.options.className).html('<img src="' + d + '" alt="" />').css({
            "float": "left",
            cursor: "pointer"
        }).on("click", function () {
            c.selectImage(d)
        }).appendTo(c.container)
    });
    if (this.options.defaultImage >= 0) {
        this.selectImage(this.options.images[this.options.defaultImage])
    }
};
Travian.Game.SwitchDown = function (a) {
    this.switchDownElement = jQuery(a);
    var b = this;
    this.switchDownElement.on("click", function (c) {
        b.switchDownElement.children().toggleClass("hide");
        c.stopPropagation();
        return false
    })
};
Travian.Game.AddLine = function (a) {
    this.options = Object.assign({
        insertAfterLastEntry: true,
        elements: {add: null, insert: null, table: null, template: null},
        entryCount: 0,
        maxEntries: false,
        selectors: {add: ".addLine.addElement", insert: ".addLine.insertElement", template: ".addLine.templateElement"},
        onAddBefore: Travian.emptyFunction,
        onAddAfter: Travian.emptyFunction,
        onCloneBefore: Travian.emptyFunction,
        onCloneAfter: Travian.emptyFunction,
        onInsertBefore: Travian.emptyFunction,
        onInsertAfter: Travian.emptyFunction,
        onInsertInputBefore: Travian.emptyFunction,
        onInsertInputAfter: Travian.emptyFunction
    }, a);
    var b = this;
    if (!this.options.elements.table) {
        throw"Table element for Travian.Game.AddLine is not definied"
    }
    this.options.elements.table = jQuery(this.options.elements.table);
    "template add insert".split(" ").forEach(function (c) {
        if (!b.options.elements[c]) {
            b.options.elements[c] = b.options.elements.table.find(b.options.selectors[c])
        }
        if (!b.options.elements[c]) {
            throw'Element "' + c + '" for Travian.Game.AddLine is not definied'
        }
    });
    this.options.elements.add.addClass("addLine removeElement");
    this.options.elements.template = this.options.elements.template.clone(true);
    this.options.elements.add.removeClass("addLine removeElement");
    this.options.elements.add.on("click", function (g) {
        g.stopPropagation();
        b.options.onAddBefore();
        b.options.onCloneBefore();
        var f = b.options.elements.template.clone(true);
        b.options.onCloneAfter(f);
        var d = f.find("label, input, textarea, button, select");
        b.options.onInsertBefore(f);
        d.each(function (e, h) {
            if (h.tagName.toLowerCase() === "input") {
                if (h.type.toLowerCase() === "checkbox" || h.type.toLowerCase() === "radio") {
                    h.tagName.checked = false
                } else {
                    if (h.type.toLowerCase() === "text" || h.type.toLowerCase() === "password") {
                        h.tagName.value = ""
                    }
                }
            } else {
                if (h.tagName.toLowerCase() === "select") {
                    h.tagName.selectedIndex = -1
                } else {
                    if (h.tagName.toLowerCase() === "textarea") {
                        h.tagName.value = ""
                    }
                }
            }
            b.options.onInsertInputBefore(b.options.entryCount, f, h)
        });
        b.options.elements.insert.after(f.css({opacity: 0}));
        f.animate({opacity: 1});
        var c = f.find(".addLine.removeElement");
        if (c) {
            c.after(b.options.elements.add);
            c.remove()
        }
        b.options.entryCount++;
        if (b.options.maxEntries !== false && b.options.maxEntries === b.options.entryCount) {
            b.options.elements.add.dispose();
            Travian.Tip.hide()
        }
        d.each(function (e) {
            b.options.onInsertInputAfter(f, e)
        });
        b.options.onInsertAfter(f);
        if (b.options.insertAfterLastEntry === true) {
            b.options.elements.insert = f
        }
        b.options.onAddAfter(f)
    })
};
Travian.Game.InstantTabs = function (b) {
    var a = b.find(".tabNavi .container");
    a.on("click", function (h) {
        h.preventDefault();
        var f = this;
        var d = 0;
        a.each(function (e, i) {
            if (f != null) {
                if (i === f) {
                    f = null
                } else {
                    d++
                }
            }
        });
        a.removeClass("active");
        jQuery(this).addClass("active");
        var c = b.find(".tabContainer");
        c.addClass("hide");
        var g = c.get(d);
        jQuery(g).removeClass("hide");
        return false
    })
};
Travian.Game.AutoCompleter = function (b, c, a) {
    this.query = function (d) {
        Travian.ajax({
            data: {cmd: "autoComplete", type: this.options.type, search: d},
            onSuccess: this.update.bind(this),
            onError: function () {
                this.update([])
            }.bind(this)
        })
    };
    Digitarald.AutoCompleter.call(this, b, Object.assign({
        minLength: 2,
        maxChoices: 10,
        width: "auto",
        fxOptions: false,
        emptyChoices: function () {
            jQuery("<li />").html(Travian.Translation.translate("{cropfinder.keine_ergebnisse}")).appendTo(this.choices);
            this.showChoices()
        }.bind(this)
    }, a || {}, {type: c}))
};
Travian.Game.AutoCompleter.prototype = Object.create(Digitarald.AutoCompleter.prototype);
Travian.Game.AutoCompleter.constructor = Travian.Game.AutoCompleter;
Travian.Game.AutoCompleter.UserName = function (a) {
    Travian.Game.AutoCompleter.call(this, a, "username", {
        multiple: true,
        separator: "; ",
        autoTrim: true,
        allowDupes: false
    })
};
Travian.Game.AutoCompleter.UserName.prototype = Object.create(Travian.Game.AutoCompleter.prototype);
Travian.Game.AutoCompleter.UserName.constructor = Travian.Game.AutoCompleter.UserName;
Travian.Game.AutoCompleter.VillageName = function (a) {
    Travian.Game.AutoCompleter.call(this, a, "villagename", {maxChoices: 20})
};
Travian.Game.AutoCompleter.VillageName.prototype = Object.create(Travian.Game.AutoCompleter.prototype);
Travian.Game.AutoCompleter.VillageName.constructor = Travian.Game.AutoCompleter.VillageName;
Travian.Game.Messages = {
    check_in_progress: false, recipients_checked: false, addressBookInstance: null, checkRecipients: function (b, a) {
        if (!Travian.Game.Messages.check_in_progress) {
            Travian.Game.Messages.check_in_progress = true;
            Travian.ajax({
                data: {cmd: "checkRecipient", recipients: b}, onComplete: function () {
                    Travian.Game.Messages.check_in_progress = false
                }, onSuccess: function () {
                    Travian.Game.Messages.recipients_checked = true;
                    a.trigger("submit")
                }, onError: function (c, e) {
                    var d = new Travian.Dialog.Dialog({preventFormSubmit: true});
                    d.setContent(e);
                    d.show()
                }
            })
        }
    }, showAddressBook: function () {
        if (Travian.Game.Messages.addressBookInstance === null) {
            Travian.Game.Messages.addressBookInstance = new Travian.Game.Messages.AddressBook("#adressbook")
        }
        if (!Travian.Game.Messages.addressBookInstance.open) {
            Travian.Game.Messages.addressBookInstance.show()
        }
    }, addRecipient: function (b) {
        var c = jQuery("#receiver");
        var a = c.val().split(";").map(function (d) {
            return d.trim()
        }).filter(function (d) {
            return d !== ""
        });
        a.push(b);
        c.val(a.join("; "))
    }
};
Travian.Game.Messages.AddressBook = function (a) {
    this.close = function () {
        this.hide();
        Travian.Dialog.Dialog.prototype.close.call(this);
        return this
    };
    this.show = function () {
        Travian.Dialog.Dialog.prototype.show.call(this);
        this.unhide();
        return this
    };
    Travian.Dialog.Dialog.call(this, {
        title: Travian.Translation.translate("{nachrichten.adressbuch}"),
        buttonTextOk: Travian.Translation.translate("{allgemein.save}"),
        submitMethod: "post",
        submitUrl: "messages.php?t=1",
        destroyElement: false,
        enableBackground: false
    });
    var b = jQuery(a);
    b.removeClass("hide");
    var c = this;
    b.find("td.pla a").on("click", function (d) {
        Travian.Game.Messages.addRecipient(jQuery(d.target).html());
        d.preventDefault();
        c.close()
    });
    this.setContent(b)
};
Travian.Game.Messages.AddressBook.prototype = Object.create(Travian.Dialog.Dialog.prototype);
Travian.Game.Messages.AddressBook.constructor = Travian.Dialog.Dialog;
Travian.Game.Notice = function (b, a) {
    this.maxNotesLength = -1;
    this.element = jQuery("#notice");
    this.initialize = function (d, c) {
        if (typeof d === "undefined") {
            d = -1
        }
        this.maxNotesLength = parseInt(d);
        if (typeof c === "undefined") {
            c = jQuery("#notice")
        }
        this.element = c;
        var e = this;
        jQuery("#send").on("click", function (f) {
            if (!e.DoubleClickPreventer) {
                e.DoubleClickPreventer = new Travian.DoubleClickPreventer();
                e.DoubleClickPreventer.timeout = 250
            }
            if (!e.DoubleClickPreventer.check()) {
                return
            }
            if (!e.checkMaxLength()) {
                f.preventDefault();
                e.showNoticeTooLongMessage()
            }
        })
    };
    this.showNoticeTooLongMessage = function () {
        var c = new Travian.Dialog.Dialog({preventFormSubmit: true});
        c.setContent(Travian.Translation.get("nachrichten.notice_too_long"));
        c.show()
    };
    this.checkMaxLength = function () {
        if (this.element.length === 0) {
            return false
        }
        if (this.maxNotesLength < 0) {
            return true
        }
        return this.element.val().length <= this.maxNotesLength
    };
    this.initialize(b, a)
};
Travian.Game.BBEditor = function (b, a) {
    this.preview = null;
    this.textArea = null;
    this.id = null;
    this.initialize = function (d, c) {
        var e = this;
        this.id = d;
        this.textArea = jQuery("#" + d);
        this.toolbar = jQuery("#" + d + "_toolbar");
        this.preview = jQuery("#" + d + "_preview");
        this.preview.css("display", "none");
        this.preview.addClass("preview");
        jQuery("#" + d + "_previewButton").on("click", jQuery.proxy(function (f) {
            e.fetchPreview(f)
        }, e));
        jQuery("#" + d + "_resourceButton").on("click", jQuery.proxy(function (f) {
            e.showToolbarWindow(f)
        }, e));
        jQuery("#" + d + "_smilieButton").on("click", jQuery.proxy(function (f) {
            e.showToolbarWindow(f)
        }, e));
        jQuery("#" + d + "_troopButton").on("click", jQuery.proxy(function (f) {
            e.showToolbarWindow(f)
        }, e));
        this.textArea.on("click", jQuery.proxy(function (f) {
            e.hideToolbarWindow(f)
        }, e));
        this.addEvent(this.toolbar, jQuery.proxy(function (f) {
            e.insertTag(f)
        }, e));
        c = typeof c !== "undefined" ? c : false;
        if (c === true) {
            this.fetchPreview()
        }
    };
    this.addEvent = function (f, e) {
        var d = jQuery(f).children();
        for (var c = 0; c < d.length; c++) {
            if (Travian.Game.BBEditor.getInformationFromClass(d[c], "bbTag")) {
                jQuery(d[c]).on("click", e)
            }
        }
    };
    this.insertTag = function (h) {
        var g = this;
        h.preventDefault();
        this.hidePreview();
        var d;
        if (jQuery(h.target).is("button")) {
            d = jQuery(h.target)
        } else {
            d = jQuery(h.target).parent()
        }
        var c = Travian.Game.BBEditor.getInformationFromClass(d[0], "bbTag");
        var f = this.textArea[0].scrollTop;
        switch (Travian.Game.BBEditor.getInformationFromClass(d[0], "bbType")) {
            case"d":
                g.insertAroundCursor(this.textArea, "[" + c + "]", "[/" + c + "]");
                break;
            case"s":
                g.insertAtCursor(this.textArea, c);
                break;
            case"o":
                g.insertAtCursor(this.textArea, ("[" + Travian.Game.BBEditor.getInformationFromClass(d[0], "bbTag") + "]"));
                break
        }
        this.textArea[0].scrollTop = f
    };
    this.showToolbarWindow = function (h) {
        var g = this;
        h.preventDefault();
        var f = h.target;
        var d = jQuery("#" + g.id + "_" + Travian.Game.BBEditor.getInformationFromClass(f, "bbWin"));
        var c = true;
        if (d.css("display") === "block") {
            c = false
        }
        g.hideToolbarWindow();
        if (c) {
            d.show();
            d.css("display", "block")
        }
    };
    this.hideToolbarWindow = function (g) {
        var f = this;
        if (g) {
            g.preventDefault()
        }
        var d = jQuery("#" + f.id + "_toolbarWindows").children();
        for (var c = 0; c < d.length; c++) {
            jQuery(d[c]).css("display", "none")
        }
    };
    this.fetchPreview = function (d) {
        var c = this;
        if (typeof d !== "undefined") {
            d.preventDefault()
        }
        if (c.textArea.css("display") === "none" || c.textArea.val().length < 1) {
            c.hidePreview();
            return
        }
        Travian.ajax({
            data: {cmd: "bb", nl2br: 1, target: c.id, text: c.textArea.val()}, onSuccess: function (e) {
                c.showPreview(e)
            }
        })
    };
    this.showPreview = function (c) {
        if (c.error === true) {
            alert(c.errorMsg)
        } else {
            this.preview.html(c.text);
            this.preview.css("display", "block");
            this.textArea.css("display", "none")
        }
    };
    this.hidePreview = function () {
        this.preview.css("display", "none");
        this.textArea.css("display", "inline")
    };
    this.insertAroundCursor = function (e, g, c) {
        var d = e[0].selectionStart;
        var f = e[0].selectionEnd;
        var j = e.val().substring(d, f);
        var i = g + j + c;
        var h = e.val();
        e.val(h.substring(0, d) + i + h.substring(f));
        e.focus();
        e[0].selectionStart = d + g.length;
        e[0].selectionEnd = d + g.length
    };
    this.insertAtCursor = function (d, g) {
        var c = d[0].selectionStart;
        var e = d[0].selectionEnd;
        var f = d.val();
        d.val(f.substring(0, c) + g + f.substring(e));
        d.focus();
        d[0].selectionStart = c + g.length;
        d[0].selectionEnd = c + g.length
    };
    this.initialize(b, a)
};
Travian.Game.BBEditor.getInformationFromClass = function (c, d) {
    var b = jQuery(c);
    if (c.nodeName.toLowerCase() === "img") {
        c = b.parent("button")[0];
        if (!c) {
            c = b.parent("a")[0]
        }
    }
    var a = jQuery(c).attr("class").split(" ").filter(function (e) {
        return e.indexOf(d) === 0
    });
    if (a.length > 0 && a[0].length > 0) {
        a = a[0].substr(0, a[0].length - 1).split("{");
        if (a.length === 2) {
            a = a[1]
        } else {
            a = null
        }
    }
    return a
};
Travian.Game.RaidList = {
    data: null, weAreAdding: false, addSlot: function (b, a, e, c) {
        var d = this;
        c = c || null;
        Travian.ajax({
            data: {
                cmd: "raidList",
                method: "ActionAddSlotForm",
                listId: b,
                weAreAdding: (Travian.Game.RaidList.weAreAdding ? true : null),
                x: a,
                y: e,
                context: c
            }, onSuccess: function (f) {
                d.dialog({buttonOk: false, context: "raidAddSlotDialog"}, f.html);
                return true
            }
        })
    }, editSlot: function (b, c, a, d) {
        var e = this;
        d = d || null;
        Travian.ajax({
            data: {cmd: "raidList", method: "actionEditSlotForm", listId: b, slotId: c, pageReload: a, context: d},
            onSuccess: function (f) {
                e.dialog({buttonOk: false, context: "raidAddSlotDialog", raidListId: b}, f.html);
                return true
            }
        })
    }, deleteSlot: function (b, a) {
        var c = this;
        Travian.ajax({
            data: {cmd: "raidList", method: "actionDeleteSlot", slotId: b}, onSuccess: function () {
                var d = Travian.WindowManager.getWindowsByContext("raidAddSlotDialog").pop();
                if (a !== false || !d.options.hasOwnProperty("raidListId")) {
                    window.location.reload()
                } else {
                    c.refreshList(d.options.raidListId);
                    d.close()
                }
                return true
            }
        })
    }, addSlotPopupWrapper: function (b, a, c) {
        Travian.Game.RaidList.weAreAdding = true;
        Travian.Game.RaidList.addSlotWrapper(b, a, c)
    }, editSlotPopupWrapper: function (a, b) {
        Travian.Game.RaidList.weAreAdding = false;
        Travian.Game.RaidList.editSlotWrapper(a, b)
    }, addSlotWrapper: function (b, a, e) {
        var c = Travian.WindowManager.getWindows();
        var d = (c.length) ? c[c.length - 1] : null;
        if (c.length > 0 && !!d) {
            c[c.length - 1].close()
        }
        Travian.Game.RaidList.addSlot(b, a, e)
    }, editSlotWrapper: function (a, b) {
        var c = Travian.WindowManager.getWindows();
        var d = (c.length) ? c[c.length - 1] : null;
        if (c.length > 0 && !!d) {
            c[c.length - 1].close()
        }
        Travian.Game.RaidList.editSlot(a, b, true, "map")
    }, dialog: function (a, c) {
        var b = new Travian.DiainvalidTimeFormatlog.Dialog(Object.assign({preventFormSubmit: true}, a));
        b.setContent(c);
        b.show()
    }, decodeComponent: function (a) {
        return decodeURIComponent(a.replace(/\+/g, " "))
    }, parseQueryString: function (c, f, a) {
        var e = this;
        if (f == null) {
            f = true
        }
        if (a == null) {
            a = true
        }
        var d = c.split(/[&;]/), b = {};
        if (!d.length) {
            return b
        }
        d.forEach(function (k) {
            var g = k.indexOf("=") + 1, i = g ? k.substr(g) : "",
                h = g ? k.substr(0, g - 1).match(/([^\]\[]+|(\B)(?=\]))/g) : [k], j = b;
            if (!h) {
                return
            }
            if (a) {
                i = e.decodeComponent(i)
            }
            h.forEach(function (m, l) {
                if (f) {
                    m = e.decodeComponent(m)
                }
                var n = j[m];
                if (l < h.length - 1) {
                    j = j[m] = n || {}
                } else {
                    if (typeof n === "array") {
                        n.push(i)
                    } else {
                        j[m] = n != null ? [n, i] : i
                    }
                }
            })
        });
        return b
    }, saveSlot: function (b, c, d, a) {
        var e = this;
        Travian.ajax({
            data: {cmd: "raidList", method: "ActionCheckForForeignSlotEntry", listId: b, slotId: c, x: d.x, y: d.y},
            onSuccess: function (g) {
                if (!(typeof g != "undefined" && g.hasOwnProperty("entryExists"))) {
                    return
                }
                if (g.entryExists) {
                    var f = new Travian.Dialog.Dialog({
                        buttonOk: true,
                        buttonCloseOnClickOk: true,
                        preventFormSubmit: true,
                        type: Travian.Dialog.DIALOG_TYPE_MODAL,
                        onOkay: function () {
                            e.persistSlotEntry(b, c, d, a)
                        }
                    });
                    f.setContent('<div class="centeredText">' + Travian.Translation.get("raidList.overwriteFarmListEntry") + "<br>" + Travian.Translation.get("raidList.thisWillOverwriteAnExistingFarmListEntry") + "</div>");
                    f.show()
                } else {
                    e.persistSlotEntry(b, c, d, a)
                }
            },
            onError: function (g, f) {
                var h = new Travian.Dialog.Dialog({
                    buttonOk: true,
                    buttonCloseOnClickOk: true,
                    preventFormSubmit: true,
                    type: Travian.Dialog.DIALOG_TYPE_MODAL
                });
                h.setContent(f);
                h.show()
            }
        })
    }, persistSlotEntry: function (b, c, f, a) {
        var e = this, d = jQuery("#raidListSlot #edit_form .troops");
        c = Travian.Game.RaidList.weAreAdding ? null : (c || null);
        d.siblings(".error").remove();
        Travian.ajax({
            data: {
                cmd: "raidList",
                method: "ActionAddSlot",
                listId: b,
                slotId: c,
                x: f.x,
                y: f.y,
                t1: f.t1,
                t2: f.t2,
                t3: f.t3,
                t4: f.t4,
                t5: f.t5,
                t6: f.t6,
                t7: f.t7,
                t8: f.t8,
                t9: f.t9,
                t10: f.t10
            }, onSuccess: function (g) {
                Travian.WindowManager.getWindowsByContext("raidAddSlotDialog").pop().close();
                if (a !== false) {
                    var l = null;
                    if (typeof g != "undefined" && typeof g.updatedSlotId != "undefined" && g.updatedSlotId > 0) {
                        l = g.updatedSlotId
                    } else {
                        if (c !== null) {
                            l = c
                        }
                    }
                    var i = l !== null ? "#slot-row-" + l : "";
                    var k = Math.floor(Date.now() / 1000);
                    var h = window.location.href;
                    var j = Travian.parseURL(h);
                    j.searchObject.lid = b;
                    j.searchObject.xx = k;
                    j.hash = i;
                    delete j.searchObject.action;
                    window.location = Travian.composeURL(j)
                } else {
                    e.refreshList(b);
                    if (typeof g.updatedFarmListId != "undefined" && g.updatedFarmListId > 0) {
                        e.refreshList(g.updatedFarmListId)
                    }
                }
                return true
            }, onError: function (h, g) {
                var i = new Travian.Dialog.Dialog({
                    buttonOk: true,
                    buttonCloseOnClickOk: true,
                    preventFormSubmit: true,
                    type: Travian.Dialog.DIALOG_TYPE_MODAL
                });
                i.setContent(g);
                i.show()
            }
        })
    }, refreshList: function (a) {
        if (this.data) {
            var b = jQuery("#list" + a).find('input[name="sort"]').val();
            this.loadList(a, b, this.data[a].directions[b])
        }
    }, loadList: function (b, a, f) {
        var e = this;
        var d = jQuery("#list" + b);
        var c = d.find(".loading");
        c.removeClass("hide");
        Travian.ajax({
            data: {cmd: "raidListSlots", lid: b, sort: a, direction: f}, onComplete: function () {
                c.addClass("hide")
            }, onSuccess: function (g) {
                d.find(".listContent").html(g.html).removeClass("hide");
                d.find(".openedClosedSwitch").removeClass("switchClosed").addClass("switchOpened");
                e.data[b] = g.list;
                d.find("input[name=sort]").val(g.sort);
                d.find("input[name=direction]").val(g.direction)
            }
        });
        return this
    }, showCreateNewList: function () {
        var a = this;
        Travian.ajax({
            data: {cmd: "raidList", method: "actionAddListForm"}, onSuccess: function (b) {
                a.dialog({buttonOk: false}, b.html)
            }
        })
    }, createNewList: function () {
        var a = {
            did: jQuery("select#did option:selected").val(),
            listName: jQuery('input[name="listName"]').val(),
            cmd: "raidList",
            method: "actionAddList"
        };
        Travian.ajax({
            data: a, onSuccess: function (b) {
                if (b.validation_message) {
                    jQuery("#raidListCreate #error").html(b.validation_message)
                } else {
                    window.location.reload()
                }
            }
        })
    }, showUpdateList: function (a) {
        var b = this;
        Travian.ajax({
            data: {cmd: "raidList", method: "actionUpdateListForm", listId: a}, onSuccess: function (c) {
                b.dialog({buttonOk: false}, c.html)
            }
        })
    }, updateList: function (a) {
        var b = {
            method: "actionUpdateList",
            cmd: "raidList",
            listId: a,
            listName: jQuery('input[name="listName"]').val()
        };
        Travian.ajax({
            data: b, onSuccess: function (c) {
                if (c.validation_message) {
                    jQuery("#raidListCreate #error").html(c.validation_message)
                } else {
                    window.location.reload()
                }
            }
        })
    }, markAllSlotsOfAListForRaid: function (a, b) {
        jQuery.each(this.data[a].slots, function (c, d) {
            d.marked = b
        });
        jQuery("#list" + a).find(".markSlot").each(function (c, d) {
            jQuery(d).prop("checked", b)
        });
        this.updateTroopSummaryForAList(a);
        return this
    }, markSlotForRaid: function (a, b, c, d) {
        this.data[a].slots[b].marked = c;
        if (typeof d === "undefined" || d) {
            this.updateTroopSummaryForAList(a)
        }
        return this
    }, setData: function (a) {
        this.data = a
    }, sort: function (a, b) {
        return this.loadList(a, b, this.data[a].directions[b] !== "asc" ? "asc" : "desc")
    }, toggleList: function (a, f) {
        f = f || 0;
        if (typeof this.data[a] === "undefined") {
            this.loadList(a)
        }
        for (var b in this.data) {
            if (this.data.hasOwnProperty(b)) {
                var e = jQuery("#list" + b);
                var d = e.find(".listContent");
                var c = e.find(".openedClosedSwitch");
                if (b == a) {
                    Travian.toggleSwitch(d, c)
                } else {
                    if (!f) {
                        continue
                    }
                    d.addClass("hide");
                    c.addClass("switchClosed").removeClass("switchOpened")
                }
            }
        }
        return this
    }, updateListsVisibility: function (a) {
        var f = jQuery("#list" + a), e = f.find(".listContent"), d = f.find(".openedClosedSwitch"), g = false, b, c;
        if (f.find(".listContent.hide").length === 0) {
            g = true
        }
        if (!g) {
            for (b in this.data) {
                if (this.data.hasOwnProperty(b) && b !== a) {
                    c = jQuery("#list" + b);
                    if (c.find(".listContent.hide").length === 0) {
                        Travian.toggleSwitch(e, d)
                    }
                }
            }
        }
        Travian.toggleSwitch(e, d);
        if (!g) {
            jQuery("html, body").animate({scrollTop: f.offset().top}, 100)
        }
        return this
    }, updateTroopSummaryForAList: function (c) {
        var e = this;
        var d = '<span class="{alert}">{selected}/{available}';
        var b = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var a = d;
        jQuery.each(this.data[c].slots, function (f, h) {
            if (h.marked) {
                for (var g = 1; g <= 10; g++) {
                    b[g] += h.troops[g]
                }
            }
        });
        jQuery("#list" + c).find(".troopSelectionValue").each(function (f, g) {
            g = jQuery(g);
            a = d;
            if (b[f + 1] > 0) {
                a = Travian.Helpers.substitute(a, {
                    selected: b[f + 1],
                    available: e.data[c].troops[f + 1],
                    alert: b[f + 1] > e.data[c].troops[f + 1] ? "alert" : ""
                });
                g.html(a).parent(".troopSelectionUnit").show()
            } else {
                g.parent(".troopSelectionUnit").hide()
            }
        });
        return this
    }, confirm: function (a) {
        var c = jQuery('input[name="sort"]').val();
        var f = jQuery('input[name="direction"]').val();
        var e = jQuery('input[name="lid"]').val();
        var d = [];
        jQuery(".markSlot.check:checked").each(function (h, i) {
            i = jQuery(i);
            var g = i.attr("id");
            g = g.replace("slot", "");
            d.push(g)
        });
        var b = "new";
        if (typeof a !== "undefined") {
            b = "retry"
        }
        new Travian.Dialog.Ajax({
            data: {cmd: "raidListCaptcha", sort: c, direction: f, lid: e, slots: d, attempt: b},
            buttonOk: false,
            darkOverlay: true
        })
    }, RaidSlot: function (d, c, a, b) {
        this.id = d;
        this.context = c;
        this.targets = a;
        this.reloadPage = b;
        this.updateRaidList = function () {
            var e = jQuery("#xCoordInput").val();
            var f = jQuery("#yCoordInput").val();
            this.update({listId: this.getSelectedListId(), x: e, y: f})
        };
        this.updateTargetId = function () {
            var e = jQuery("#target_id").val();
            var f = this.targets.find(function (g) {
                return g.did == e
            });
            if (f) {
                jQuery("#xCoordInput").val(f.x);
                jQuery("#yCoordInput").val(f.y);
                this.update({listId: this.getSelectedListId(), x: f.x, y: f.y})
            }
        };
        this.update = function (e) {
            var f = Object.assign({
                cmd: "raidList",
                method: "actionCheckSlotExists",
                slotId: this.id,
                pageReload: this.pageReload,
                context: this.context
            }, e);
            Travian.ajax({
                data: f, onSuccess: function (g) {
                    if (g.update) {
                        Travian.WindowManager.getWindowsByContext("raidAddSlotDialog").pop().setContent(g.html)
                    }
                }
            })
        };
        this.getSelectedListId = function () {
            return jQuery("select#lid option:selected").val()
        }
    }
};
Travian.Game.Reports = {
    editRights: function (b, a) {
        Travian.ajax({
            data: {cmd: "reportRightsGet", reportId: a.datas.reportId}, onSuccess: function (f) {
                a.datas = Object.assign({}, a.datas || {}, f || {});
                var d = '<div class="reports" id="editRights"><div><input type="checkbox" id="right1" class="check" /> {anonymOpponent}</div><div><input type="checkbox" id="right2" class="check" /> {anonymMyself}</div><div><input type="checkbox" id="right3" class="check" /> {hiddenOwnTroops}</div><div><input type="checkbox" id="right4" class="check" /> {hiddenOtherTroops}</div><div class="description">{description}<br /><textarea id="description"></textarea></div></div>';
                var e = Travian.Helpers.substitute(d, a.text);
                var c = new Travian.Dialog.Dialog({
                    relativeTo: b,
                    buttonTextOk: a.text.buttonTextOk,
                    buttonTextCancel: a.text.buttonTextCancel,
                    title: a.text.title,
                    preventFormSubmit: true,
                    onOpen: function (g, h) {
                        jQuery("#right1").prop("checked", a.datas.right1);
                        jQuery("#right2").prop("checked", a.datas.right2);
                        jQuery("#right3").prop("checked", a.datas.right3);
                        jQuery("#right4").prop("checked", a.datas.right4);
                        jQuery("#description").html(a.datas.description)
                    },
                    onOkay: function (g, h) {
                        Travian.ajax({
                            data: {
                                cmd: "reportRightsSet",
                                data: Object.assign({}, a.datas, {
                                    right1: jQuery("#right1").prop("checked"),
                                    right2: jQuery("#right2").prop("checked"),
                                    right3: jQuery("#right3").prop("checked"),
                                    right4: jQuery("#right4").prop("checked"),
                                    description: jQuery("#description").val()
                                })
                            }
                        });
                        return false
                    }
                });
                c.setContent(e);
                c.show()
            }
        });
        return false
    }
};
var reload_enabled = true;
var auto_reload = 1;
var delayTimeForReload = 0;
var resources = {};
Travian.TimersAndCounters = {
    timeCounters: [],
    resourceCounters: {},
    startedAt: Math.floor(Date.now() / 1000),
    pathReload: "reload=auto",
    timeToInt: function (a) {
        var c, b;
        c = a.split(":");
        b = c[0] * 3600 + c[1] * 60 + c[2] * 1;
        return b
    },
    intToTime: function (c, f) {
        var a, e, b, d;
        if (c < (0 - delayTimeForReload - 1)) {
            d = f ? "0:00:0?" : (Travian.Game.eventJamHtml || "0:00:0?")
        } else {
            c = Math.max(0, c);
            a = Math.floor(c / 3600);
            e = Math.floor(c / 60) % 60;
            b = c % 60;
            d = a + ":";
            if (e < 10) {
                d += "0"
            }
            d += e + ":";
            if (b < 10) {
                d += "0"
            }
            d += b
        }
        return d
    },
    init: function () {
        this.initResourcesCounters();
        this.initTimers();
        this.dropReload()
    },
    initTimers: function () {
        this.startedAt = Math.floor(Date.now() / 1000);
        this.timeCounters = [];
        this.initTimersInContext(document)
    },
    initTimer: function (c) {
        var b, a;
        switch (c.getAttribute("counting")) {
            case"down":
                b = parseInt(c.getAttribute("value")) || 0;
                a = {
                    node: c,
                    value: b,
                    counting: "down",
                    reloadDelay: b < delayTimeForReload ? delayTimeForReload * 1000 : 0,
                    inReload: false
                };
                break;
            default:
                a = {node: c, value: this.timeToInt(c.innerHTML || "00:00:00"), counting: "up", inReload: false};
                break
        }
        this.updateTimerValue(a);
        if (a.value > -1) {
            this.timeCounters.push(a)
        }
    },
    initTimersInContext: function (b) {
        var a, c = b.getElementsByClassName("timer");
        for (a = 0; a < c.length; a++) {
            this.initTimer(c[a])
        }
        this.executeTimers()
    },
    updateTimerValue: function (d) {
        var b = Math.floor(Date.now() / 1000) - this.startedAt;
        var a;
        var c = false;
        switch (d.counting) {
            case"down":
                a = d.value - b;
                d.node.innerHTML = this.intToTime(a);
                d.node.setAttribute("value", a);
                if (a < 1) {
                    c = true
                }
                break;
            case"up":
                d.node.innerHTML = this.intToTime((d.value + b) % 86400);
                break
        }
        return c
    },
    executeTimers: function () {
        if (this.timeCounters.length > 0) {
            window.setTimeout("Travian.TimersAndCounters.executeTimers()", 1000)
        }
        for (var a = 0; a < this.timeCounters.length; a++) {
            var b = this.timeCounters[a];
            if (this.updateTimerValue(b) && !b.inReload && window.reload_enabled) {
                b.inReload = true;
                this.processReload(b.reloadDelay)
            }
        }
    },
    initResourcesCounters: function () {
        this.resourceCounters = {};
        this.initResourcesCounter("l1", "lbar1");
        this.initResourcesCounter("l2", "lbar2");
        this.initResourcesCounter("l3", "lbar3");
        this.initResourcesCounter("l4", "lbar4")
    },
    initResourcesCounter: function (a, c) {
        var b = document.getElementById(a);
        try {
            var f = resources.production[a];
            if (f !== 0) {
                this.resourceCounters[a] = {
                    startInMs: Date.now(),
                    production: f,
                    initialResources: resources.storage[a],
                    maximumResources: resources.maxStorage[a],
                    minimumResources: 0,
                    tickInMs: Math.max(Math.round(Math.abs(3600000 / f)), 100),
                    bar: document.getElementById(c),
                    node: b
                };
                this.executeCounter(a)
            }
        } catch (d) {
        }
    },
    executeCounter: function (f) {
        var b = this.resourceCounters[f];
        var a = Date.now() - b.startInMs;
        var e = Math.floor(b.initialResources + a * (b.production / 3600000));
        switch (true) {
            case (e >= b.maximumResources):
                e = b.maximumResources;
                break;
            case (e <= b.minimumResources):
                e = b.minimumResources;
                break;
            default:
                window.setTimeout("Travian.TimersAndCounters.executeCounter('" + f + "')", b.tickInMs)
        }
        var g = new Travian.Formatter({forceDecimal: false});
        b.node.innerHTML = g.getFormattedNumber(e);
        resources.storage[f] = e;
        var d = jQuery(b.bar);
        if (d.length > 0) {
            var c = Math.round(100 * e / b.maximumResources);
            d.removeClass("stockFull");
            if (e >= b.maximumResources) {
                d.addClass("stockFull")
            }
            d.css({width: c + "%"})
        }
    },
    dropReload: function () {
        var c, b, d, a;
        c = document.location.href;
        b = document.location.hash;
        if (b !== "") {
            a = c.indexOf(b);
            c = c.substring(0, a)
        }
        d = c.indexOf(this.pathReload);
        if (d !== -1) {
            c = c.substring(0, d - 1) + b;
            window.history.pushState({id: c}, "", c)
        }
    },
    processReload: function (b) {
        var a;
        switch (auto_reload) {
            case 0:
                a = this.modalReload;
                break;
            case 1:
                a = Travian.WindowManager.checkForModalDialogs() ? this.modalReload : this.plainReload;
                break;
            case 2:
                if (typeof window.customReload === "function") {
                    a = window.customReload
                } else {
                    a = this.modalReload()
                }
                break
        }
        setTimeout(a, b + 1000)
    },
    plainReload: function () {
        window.location.href = window.location.href
    },
    modalReload: function () {
        var c, b, a;
        c = window.location.href;
        b = window.location.hash;
        if (b !== "") {
            a = c.indexOf(b);
            c = c.substring(0, a)
        }
        if (c.indexOf(this.pathReload) === -1) {
            if (c.indexOf("?") === -1) {
                c += "?" + this.pathReload
            } else {
                c += "&" + this.pathReload
            }
        }
        document.location.href = c + b
    }
};
Travian.Game.Hero = {};
Travian.Game.Hero.Editor = function () {
    var a = null;
    return function (b) {
        this.unloadIdentifier = null;
        this.options = Object.assign({
            element: null,
            command: null,
            attributes: null,
            urlHeroImage: null,
            elementHeroImage: null
        }, b);
        this.hideAll = function () {
            var c = this.options.element.find(".attributes .container .infoOpen").removeClass("infoOpen");
            c.find(".headline").removeClass("switchOpened").addClass("switchClosed");
            this.options.element.find(".attributes .container .details").hide();
            return this
        };
        this.initialize = function () {
            var e = this;
            e.initializeAttributes();
            var d = e.options.element.find("#save");
            if (d !== null) {
                d.on("click", function (f) {
                    e.sendAction("save", function () {
                        var g = Travian.parseURL(e.options.urlHeroImage);
                        delete (g.searchObject.code);
                        g.searchObject.time = (new Date()).getTime();
                        jQuery("." + e.options.elementHeroImage).attr("src", Travian.composeURI(g))
                    });
                    f.preventDefault()
                })
            }
            var c = e.options.element.find("#random");
            if (c !== null) {
                c.off("click", a);
                a = function (f) {
                    e.sendAction("random");
                    f.preventDefault()
                };
                c.on("click", a)
            }
            this.bindGenderSwitch();
            this.storeAttributesInInput(this.options.attributes)
        };
        this.initializeAttributes = function () {
            var c = this;
            if (typeof c.options.element !== "object") {
                c.options.element = jQuery("#" + this.options.element)
            }
            this.hideAll();
            this.options.element.find(".attributes .container .info .headline").on("click", function (d) {
                d.preventDefault();
                c.showAttribute(jQuery(this).parent(".info"))
            });
            this.options.element.find(".attributes .container .attribute").on("click", function (f) {
                var g = parseInt(f.target.id.split("attribute_button_")[1]);
                var d = jQuery(f.target).parents(".info").attr("id");
                c.options.attributes[d] = g;
                c.sendAction("show");
                f.preventDefault()
            })
        };
        this.sendAction = function (c, e) {
            if (c === "save") {
                Travian.Form.UnloadHelper.disableSecurity(this.unloadIdentifier)
            } else {
                this.unloadIdentifier = Travian.Form.UnloadHelper.enableSecurity(this.unloadIdentifier)
            }
            var d = this;
            Travian.ajax({
                data: {cmd: this.options.command, action: c, attribs: this.options.attributes},
                onSuccess: function (f) {
                    jQuery(".hero_head .image").html(f.html);
                    if (f.attributesHtml) {
                        jQuery("#attributesContainer").html(f.attributesHtml);
                        d.initializeAttributes()
                    }
                    d.options.attributes = f.attributes;
                    d.storeAttributesInInput(f.attributes);
                    (e || Travian.emptyFunction)()
                }
            });
            return this
        };
        this.showAttribute = function (c) {
            c = jQuery(c);
            var d = c.hasClass("infoOpen");
            this.hideAll();
            if (!d) {
                c.addClass("infoOpen");
                c.find(".headline").removeClass("switchClosed").addClass("switchOpened");
                c.find(".details").show()
            }
            return this
        };
        this.storeAttributesInInput = function (d) {
            var c = this.options.element.find("input[name=attributes]");
            if (c !== null) {
                c.val(encodeURI(JSON.stringify(d)))
            }
            return this
        };
        this.switchGender = function (c) {
            if (this.options.element.hasClass("genderSwitch")) {
                jQuery("#heroEditorActivateMale, #heroEditorActivateFemale").removeClass("iconActive disabled");
                if (c === "male") {
                    this.options.element.removeClass("female").addClass("male");
                    jQuery("#heroEditorActivateMale").addClass("iconActive disabled")
                } else {
                    this.options.element.removeClass("male").addClass("female");
                    jQuery("#heroEditorActivateFemale").addClass("iconActive disabled")
                }
            }
            this.options.attributes.gender = c;
            this.sendAction("gender")
        };
        this.bindGenderSwitch = function () {
            var c = this;
            jQuery("#heroEditorActivateMale, #heroEditorActivateFemale").on("click", function (d) {
                if (jQuery(this).attr("id") === "heroEditorActivateMale" && c.options.element.hasClass("male") === false) {
                    c.switchGender("male")
                } else {
                    if (jQuery(this).attr("id") === "heroEditorActivateFemale" && c.options.element.hasClass("female") === false) {
                        c.switchGender("female")
                    }
                }
                d.preventDefault()
            })
        };
        this.initialize()
    }
}();
Travian.Game.Hero.Editor.constructor = Travian.Game.Hero.Editor;
Travian.Game.Hero.Inventory = function (a) {
    this.dragStatus = false;
    this.equippedOnClick = false;
    this.dropOnSlotFailed = false;
    this.items = [];
    this.options = Object.assign({
        a: null,
        c: null,
        gender: "male",
        heroState: {},
        isInVillage: true,
        isDead: false,
        data: [],
        heroBodyHash: false,
        images: "img/hero/items/item{typeId}.png",
        text: {
            moveDialogDescription: "Anzahl der zu verschiebenden Items: {inputField}",
            useDialogDescription: "Anzahl der zu anwendenden Items: {inputField}",
            useOneDialogTitle: "Soll dieser Gegenstand wirklich benutzt werden?",
            buttonOk: "Ok",
            buttonCancel: "Cancel"
        }
    }, a);
    this.startDrop = false;
    this.DoubleClickPreventer = null;
    this.createAndAddItem = function (b) {
        var c = Object.assign({placeElement: undefined, html_id: "item_" + b.id}, b || {});
        if (JSON.stringify(this.items).indexOf(JSON.stringify(c)) === -1) {
            this.items.push(c)
        }
        return this
    };
    this.createDivs = function () {
        var e = this;
        var f = jQuery("#placeHolder");
        var d = function (h) {
            if (e.dropOnSlotFailed) {
                e.dropOnSlotFailed = false;
                return
            }
            if (!e.DoubleClickPreventer) {
                e.DoubleClickPreventer = new Travian.DoubleClickPreventer()
            }
            var g = Travian.isMobile() || e.DoubleClickPreventer.check();
            if (h.isUseable && g) {
                if (!Travian.isMobile() || (h.clickedFirstTime && Travian.isMobile())) {
                    Travian.Tip.hide();
                    e.moveToMatchingPlace(h)
                } else {
                    if (e.startDrop !== true) {
                        e.mark(h.slot)
                    }
                    h.clickedFirstTime = true
                }
            }
        };
        var c = function (g) {
            e = this;
            if (g.isUseable) {
                if (e.startDrop !== true) {
                    e.mark(g.slot)
                }
            }
        };
        var b = function (g) {
            e = this;
            if (g.isUseable) {
                if (e.startDrop !== true) {
                    e.unMark(g.slot)
                }
            }
        };
        jQuery.each(this.items, function (h, k) {
            k.isUseable = (k.slot === "bag" || e.options.isInVillage);
            if (e.options.isDead && !k.isUsableIfDead) {
                k.isUseable = false
            }
            var j = "";
            if (!k.isUseable) {
                if (e.options.isDead) {
                    j = e.options.text.notMoveableTextDead
                } else {
                    j = e.options.text.notMoveableText
                }
                j += "<br />"
            }
            j += k.attributes.join("<br />");
            var i = jQuery("<div/>").attr("id", "item_" + k.id).addClass("item " + e.options.gender + "_item_" + k.typeId + " " + (k.isUseable ? "" : "disabled")).css("position", "relative").html('<div class="amount">' + k.amount + "</div>").on({
                click: jQuery.proxy(d, e, k),
                mouseover: jQuery.proxy(c, e, k),
                mouseout: jQuery.proxy(b, e, k)
            }).appendTo(f);
            Travian.Tip.set(i, {unescaped: true, title: "(" + k.amount + ") " + k.name, text: j});
            i[0].item = k;
            i[0].item.element = i;
            var g = null;
            if (k.placeId < 0) {
                g = jQuery("#" + k.slot);
                i.addClass("onHero")
            } else {
                g = jQuery("#inventory_" + k.placeId)
            }
            g.addClass(k.isUseable ? "" : "disabled");
            e.moveToDrop(i, g, true)
        });
        this.makeDraggable();
        this.options.elementHeroBody[0].src = String(this.options.urlBodyImage).replace((/\\?\{([^{}]+)\}/g), jQuery.proxy(this.substitute, {heroBodyHash: e.options.heroBodyHash}));
        return this
    };
    this.substitute = function (c, b) {
        if (c.charAt(0) == "\\") {
            return c.slice(1)
        }
        return (this[b] != null) ? this[b] : ""
    };
    this.dialog = function (b) {
        var f = this;
        var h = b.text;
        var e = b.amount;
        var g = b.amount;
        var d = b.calculate;
        delete (b.text);
        delete (b.amount);
        delete (b.calculate);
        b.onOpen = function (k, l) {
            var j = l.children("input#amount.text");
            if (j.length > 0) {
                var i = function (t) {
                    if (d) {
                        var u = 1 + d.bonusPercent / 100;
                        var m = t * Math.round(d.valuePerItem * u);
                        var q = t * d.valuePerItem;
                        var n = m - q;
                        var r = l.find(".displayUseValue");
                        var s = l.find(".displayUseBonusP");
                        var o = l.find(".displayUseBonus");
                        var p = l.find(".displayAfterUse");
                        if (r.length > 0) {
                            r.html(q)
                        }
                        if (s.length > 0) {
                            s.html(d.bonusPercent)
                        }
                        if (o.length > 0) {
                            o.html(n)
                        }
                        if (p.length > 0) {
                            p.html(d.currentValue + m)
                        }
                    }
                };
                j.val(e);
                i(e);
                k.makeInputAmountable(j, g, i.bind(f))
            }
            return true
        };
        b = Object.assign(b, {
            buttonTextOk: this.options.text.buttonOk,
            buttonTextCancel: this.options.text.buttonCancel
        });
        h = String(h).replace((/\\?\{([^{}]+)\}/g), jQuery.proxy(this.substitute, {
            inputField: '<input class="text" id="amount" type="text" value="0" />',
            equipmentBonus: '<span class="displayUseBonusP">0</span>'
        }));
        var c = new Travian.Dialog.Dialog(b);
        c.setContent(h);
        c.show();
        return this
    };
    this.executeMovement = function (e, c, b) {
        var d = this;
        Travian.ajax({
            data: {
                cmd: "heroInventory",
                id: e,
                drid: c,
                amount: b,
                eqOnClick: d.equippedOnClick,
                a: this.options.a,
                c: this.options.c
            }, onSuccess: function (l) {
                d.equippedOnClick = false;
                d.options.c = l.checkSum;
                d.options.heroState = Object.assign(d.options.heroState, l.heroState || {});
                if (l.heroBodyHash) {
                    d.options.heroBodyHash = l.heroBodyHash
                }
                jQuery.each(d.items, function (i, o) {
                    jQuery("#" + o.html_id).remove()
                });
                d.items = [];
                jQuery.each(l.items, function (i, o) {
                    d.createAndAddItem(o)
                });
                jQuery(".inventory").each(function (i, o) {
                    jQuery(o).remove()
                });
                var n = l.inventorySize;
                if (l.heroData.freePoints > 0) {
                    jQuery("div.hero_inventory .attribute .setPoint").show()
                }
                for (var h = 1, g = null; h <= n; h++) {
                    g = jQuery("<div/>").attr("id", "inventory_" + h).addClass("inventory draggable").insertBefore(jQuery("#itemsToSale").find(".market"))
                }
                d.createDivs();
                var k = jQuery("#attributes");
                var j = jQuery(".heroHealthBarBox");
                var f = jQuery(".heroXpBarBox");
                jQuery.each(l.heroData, function (o, q) {
                    var p = k.find("." + o);
                    if (p.length > 0) {
                        var r = p.find(".current");
                        var s = p.find(".progress .bar").not(".setted");
                        var u = p.find(".points");
                        var i = p.find(".tooltip");
                        if (p.hasClass("res")) {
                            var t = jQuery("#setResource").find(".resource label .current");
                            jQuery(t).each(function (v, w) {
                                jQuery(w).html(q["resourceHero" + v])
                            })
                        }
                        if (p.hasClass("tooltip")) {
                            i.push(p)
                        }
                        if (r.length > 0 && r.find(".value").length > 0) {
                            r = r.find(".value")
                        }
                        if (typeof q.current !== "undefined" && r.length > 0) {
                            r.html(q.current)
                        }
                        if (typeof q.percent !== "undefined" && s.length > 0) {
                            s.css("width", q.percent + "%");
                            if (typeof q.backgroundColor !== "undefined") {
                                s.css("backgroundColor", q.backgroundColor)
                            }
                            if (typeof q.points !== "undefined" && u.length > 0) {
                                if (u.find("input").length > 0) {
                                    u.find("input").val(q.points)
                                } else {
                                    u.html(q.points)
                                }
                            }
                            if (typeof q.tooltip !== "undefined" && i.length) {
                                jQuery.each(i, function (v, w) {
                                    jQuery(w).attr("title", q.tooltip);
                                    Travian.Tip.refresh()
                                })
                            }
                        }
                    }
                });
                if (k[0].className !== "hero-dead") {
                    k.find(".experience").find(".value").html(l.heroData.experience.current);
                    var m = k.find(".health");
                    if (m.length > 0) {
                        m.find(".value").html(l.heroData.health.percent + "%");
                        m.find(".bar").css("width", l.heroData.health.percent + "%")
                    }
                    j.prop("title", l.heroData.health.tooltipSidebar);
                    j.find(".bar").css("width", l.heroData.health.percent + "%");
                    f.prop("title", l.heroData.experience.tooltipSidebar);
                    f.find(".bar").css("width", l.heroData.experience.percent + "%")
                }
                if (typeof d.DoubleClickPreventer !== "undefined") {
                    d.DoubleClickPreventer.cancelTimer()
                }
                d.dragStatus = false;
                if (d.options.afterRequestCallback[l.itemTypeId]) {
                    d.options.afterRequestCallback[l.itemTypeId](d, d.options, b, l)
                }
            }
        });
        return this
    };
    this.findFirstFreeInventory = function () {
        var b = null;
        jQuery(".inventory").each(function (c, d) {
            if (jQuery(d).children().length === 0 && b == null) {
                b = d;
                return false
            }
        });
        return jQuery(b)
    };
    this.initialize = function () {
        var b = this;
        jQuery.each(this.options.data, function (c, d) {
            b.createAndAddItem(d)
        });
        this.createDivs()
    };
    this.isInventoryId = function (b) {
        return b.substr(0, 9) === "inventory"
    };
    this.makeDraggable = function () {
        var c = this;
        var b = jQuery(".draggable");
        var d = jQuery("#text");
        jQuery(".item").each(function (e, f) {
            if (f.item.isUseable === false) {
                return
            }
            if (!Travian.isMobile()) {
                jQuery(f).on("mousedown", function (h) {
                    c.dropOnSlotFailed = false;
                    h.preventDefault();
                    c.startDrop = true;
                    var g = this;
                    g.item.dragOrigin = jQuery(this).parent(".draggable");
                    jQuery("body").on("mousemove.inventoryItem", function (j) {
                        if (!c.startDrop) {
                            return
                        }
                        if (!c.dragStatus && h.pageX === j.pageX && h.pageY === j.pageY) {
                            return
                        }
                        c.dragStatus = true;
                        jQuery("#content").children().css({userSelect: "none"});
                        var i = jQuery(g);
                        i.offset({left: j.pageX - i.width() / 2, top: j.pageY - i.height() / 2});
                        i.addClass("whileDragging").removeClass("onHero")
                    })
                });
                jQuery(f).on("mouseup", function (i) {
                    jQuery("#content").children().css({userSelect: "auto"});
                    jQuery("body").off("mousemove.inventoryItem");
                    if (!c.dragStatus) {
                        c.startDrop = false;
                        return false
                    }
                    var h = jQuery(this);
                    var j = this.item;
                    var g = i.pageX;
                    var m = i.pageY;
                    var k = false;
                    var l = false;
                    jQuery(b).each(function (n, o) {
                        if (!l) {
                            o = jQuery(o);
                            var s = o.offset();
                            var q = s.left;
                            var p = s.left + o.width();
                            var t = s.top;
                            var r = s.top + o.height();
                            if (g >= q && g <= p && m >= t && m <= r) {
                                l = true;
                                if (c.isInventoryId(o.prop("id"))) {
                                    c.moveToDrop(h, o, false);
                                    k = true
                                } else {
                                    if (j.slot === o.attr("id")) {
                                        c.moveToDrop(h, jQuery("#" + j.slot), false);
                                        k = true
                                    }
                                }
                            }
                        }
                    });
                    if (!k) {
                        if (!c.isInventoryId(j.dragOrigin[0].id)) {
                            h.addClass("onHero")
                        }
                        c.dragStatus = false;
                        c.dropOnSlotFailed = true;
                        c.moveToDrop(h, j.dragOrigin, true)
                    }
                    h.removeClass("whileDragging");
                    Travian.Tip.hide();
                    k = false;
                    c.startDrop = false
                })
            }
        });
        return this
    };
    this.mark = function (b) {
        jQuery("#" + b).addClass("heroMarked");
        return this
    };
    this.moveItem = function (d, b, c) {
        if (c) {
            this.executeMovement(d[0].item.id, b.attr("id"), c)
        } else {
            d.detach().appendTo(b)
        }
        this.resetItemDrop(d);
        d[0].item.placeElement = jQuery(b);
        return this
    };
    this.moveToDrop = function (h, e, c) {
        var i = this;
        var d = null;
        var g = {
            title: "",
            text: "",
            executeAfterOkay: true,
            show: true,
            onOpen: Travian.emptyFunction,
            onOkay: Travian.emptyFunction,
            onClose: Travian.emptyFunction,
            relativeTo: h[0],
            amount: h[0].item.amount,
            preventFormSubmit: true
        };
        var b = false;
        h[0].item.dragOrigin = null;
        var f = function () {
            if (!g.executeAfterOkay) {
                i.resetItemDrop(h);
                return
            }
            var j;
            if (c) {
                j = false
            } else {
                if (b === true) {
                    var k = jQuery("#amount");
                    j = (k.length > 0) ? k.val() : 1
                } else {
                    j = h[0].item.amount
                }
            }
            i.moveItem(h, e, j)
        };
        if (c !== true && !this.isInventoryId(e.attr("id")) && ((h[0].item.instant && h[0].item.amount === 1) || h[0].item.amount > 1)) {
            if (this.options.useOneDialogTitleCallbacks[h[0].item.typeId]) {
                g = Object.assign(g, this.options.useOneDialogTitleCallbacks[h[0].item.typeId](h[0].item, this.options, g) || {})
            }
            b = true;
            if (g.title === "") {
                g.title = h[0].item.name
            }
            if (g.text === "") {
                if (h[0].item.instant) {
                    if (h[0].item.amount === 1) {
                        g.text = this.options.text.useOneDialogTitle
                    } else {
                        g.text = this.options.text.useDialogDescription
                    }
                } else {
                    g.text = this.options.text.moveDialogDescription
                }
            }
            if (g.show) {
                g.onOkay = function () {
                    f();
                    return true
                };
                this.dialog(g)
            }
        } else {
            f()
        }
        return this
    };
    this.moveToMatchingPlace = function (c) {
        if (this.dragStatus === false) {
            var d = c.slot;
            this.equippedOnClick = true;
            if (c.placeElement[0] == jQuery("#" + d)[0]) {
                var b = this.findFirstFreeInventory();
                this.moveToDrop(c.element, b)
            } else {
                this.moveToDrop(c.element, jQuery("#" + d))
            }
            this.unMark(d)
        } else {
            this.dragStatus = false
        }
        return this
    };
    this.resetItemDrop = function (b) {
        b.css({left: 0, top: 0});
        return this
    };
    this.unMark = function (b) {
        jQuery("#" + b).removeClass("heroMarked");
        return this
    };
    this.initialize()
};
Travian.Game.Hero.SilverExchange = function (a) {
    this.options = Object.assign({
        exchangeOptions: {
            directionType: "SilverToGold",
            showExchangeTypeElement: null,
            inputElement: null,
            resultValueElements: [],
            inputValueElements: [],
            baseMultiplier: 1,
            maxAmount: null,
            submitButton: null,
            submitButton2: null,
            handleMaxFunction: null,
            submitButtonClickListener: null
        },
        messages: {
            notEnoughGold: null,
            autoCorrect: null,
            disabledSubmitTooltip: null,
            enabledSubmitTooltip: null,
            maxAmountTooltip: null
        },
        maxAmountChangedFunction: null
    }, a);
    this.isWaiting = false;
    this.lastUseTimestamp = 0;
    this.initialize = function () {
        this.checkFileInputExtension();
        if (this.options.exchangeOptions.showExchangeTypeElement.length > 0) {
            this.assignListenerToShowExchangeType(this.options.exchangeOptions.showExchangeTypeElement)
        }
        if (this.options.exchangeOptions.submitButton.length > 0 && this.options.exchangeOptions.directionType === "SilverToGold") {
            var b = this;
            this.options.exchangeOptions.submitButton.on("click", function (c) {
                b.sendAction(jQuery(this));
                c.preventDefault()
            })
        }
        if (this.options.exchangeOptions.inputElement.length > 0) {
            this.assignListenerToExchangeInput(this.options.exchangeOptions.inputElement)
        }
    };
    this.checkFileInputExtension = function () {
        if (jQuery.fn.filterInputTG !== undefined) {
            return false
        }
        jQuery.fn.extend({
            filterInputTG: function (b) {
                var c = b.regex;
                var e = this;

                function d(k) {
                    var n = 0, i = 0, m, j, h, g, l;
                    if (typeof k.selectionStart == "number" && typeof k.selectionEnd == "number") {
                        n = k.selectionStart;
                        i = k.selectionEnd
                    } else {
                        k.focus();
                        j = document.selection.createRange();
                        if (j && j.parentElement() == k) {
                            g = k.value.length;
                            m = k.value.replace(/\r\n/g, "\n");
                            h = k.createTextRange();
                            h.moveToBookmark(j.getBookmark());
                            l = k.createTextRange();
                            l.collapse(false);
                            if (h.compareEndPoints("StartToEnd", l) > -1) {
                                n = i = g
                            } else {
                                n = -h.moveStart("character", -g);
                                n += m.slice(0, n).split("\n").length - 1;
                                if (h.compareEndPoints("EndToEnd", l) > -1) {
                                    i = g
                                } else {
                                    i = -h.moveEnd("character", -g);
                                    i += m.slice(0, i).split("\n").length - 1
                                }
                            }
                        }
                    }
                    return {start: n, end: i}
                }

                function f(m) {
                    m = m || event;
                    var k = e.val();
                    var i = 0;
                    var l = 0;
                    if (m.type == "keypress") {
                        i = m.charCode | i
                    } else {
                        l = m.keyCode | l
                    }
                    var h = d(m.target);
                    if (i == 0 && l != 8 && l != 46) {
                        return true
                    }
                    if (i == 0 && (l == 8 || l == 46)) {
                        if (typeof (b.success) === "function") {
                            var j = "";
                            if (h.start == 0 && (h.end - h.start) > 0) {
                                j = k.substr(0, h.start - 1) + k.substr(h.end)
                            } else {
                                if (h.end == k.length && (h.end - h.start) > 0) {
                                    j = k.substr(0, h.start) + k.substr(h.end + 1)
                                } else {
                                    if ((h.end - h.start) > 0) {
                                        j = k.substr(0, h.start) + k.substr(h.end)
                                    } else {
                                        if ((h.end - h.start) == 0) {
                                            if (l == 8) {
                                                j = k.substr(0, h.start - 1) + k.substr(h.end)
                                            }
                                            if (l == 46) {
                                                j = k.substr(0, h.start) + k.substr(h.end + 1)
                                            }
                                        }
                                    }
                                }
                            }
                            return b.success.call(this, j)
                        }
                    }
                    var n = k.substr(0, h.start);
                    var g = k.substr(h.end);
                    k = n + String.fromCharCode(i) + g;
                    if (i > 0 && c.test(k)) {
                        if (typeof (b.success) === "function") {
                            return b.success.call(this, k)
                        }
                        return true
                    } else {
                        if (typeof (b.failure) === "function") {
                            return b.failure.call(this, k)
                        }
                    }
                    return false
                }

                return (this.on("keydown", f) && this.on("keypress", f))
            }
        })
    };
    this.assignListenerToExchangeInput = function (b) {
        var d = this;
        var c = function (e) {
            d.hideAllMessages();
            if (d.options.exchangeOptions.submitButton.length > 0 && d.options.exchangeOptions.submitButton2 && d.options.exchangeOptions.submitButton2.length > 0) {
                d.options.exchangeOptions.submitButton2.addClass("hide");
                d.options.exchangeOptions.submitButton.removeClass("hide")
            }
            return d.updateExchangeValue(e)
        };
        b.filterInputTG({regex: /^[1-9][0-9]{0,6}$/, success: c});
        return this
    };
    this.updateExchangeValue = function (h) {
        this.setLastUseTimestamp();
        var e = this.options.exchangeOptions;
        var c = parseInt(h, 10) || 0;
        var g = 0;
        var d = "enabledSubmitTooltip";
        var b = e.handleMaxFunction;
        var f = true;
        if (e.maxAmount !== null && "function" == typeof b && c > e.maxAmount) {
            g = b.call(this, c);
            d = "maxAmountTooltip";
            this.updateElementsTooltip(e.submitButton, "maxAmountTooltip");
            if (e.submitButton2 && e.submitButton2.length > 0) {
                this.updateElementsTooltip(e.submitButton2, "maxAmountTooltip")
            }
            jQuery("#silverExchange .exchangeType" + this.options.exchangeOptions.directionType + " input").val(c);
            f = false
        } else {
            g = c
        }
        g = Math.floor(g * e.baseMultiplier);
        if (e.submitButton.length > 0 && g === 0) {
            this.disableElement(e.submitButton);
            d = "disabledSubmitTooltip";
            if (e.submitButton2 && e.submitButton2.length > 0) {
                this.disableElement(e.submitButton2)
            }
        } else {
            if (e.submitButton.length > 0) {
                this.enableElement(e.submitButton);
                if (e.submitButton2 && e.submitButton2.length > 0) {
                    this.enableElement(e.submitButton2)
                }
            }
        }
        this.updateElementsTooltip(e.submitButton, d);
        if (e.submitButton2 && e.submitButton2.length > 0) {
            this.updateElementsTooltip(e.submitButton2, d)
        }
        this.setElementsValue(e.resultValueElements, g);
        this.setElementsValue(e.inputValueElements, c);
        return f
    };
    this.setElementsValue = function (e, d) {
        if (typeof e === "object" && (e instanceof Array)) {
            for (var b = 0;
                 b < e.length; b++) {
                var c = e[b].setType;
                switch (true) {
                    case jQuery.inArray(c, ["html", "val", "text"]) !== -1:
                        e[b].element[c](d);
                        break;
                    case (typeof c === "object" && c.hasOwnProperty("attr")):
                        e[b].element.attr(c.attr, d);
                        break;
                    case (typeof c === "object" && c.hasOwnProperty("prop")):
                        e[b].element.prop(c.prop, d);
                        break;
                    default:
                }
            }
        }
        return this
    };
    this.assignListenerToShowExchangeType = function (c) {
        var d = this;
        var b = function (e) {
            d.switchToExchangeType();
            e.preventDefault()
        };
        c.on("click", b);
        return this
    };
    this.switchToExchangeType = function () {
        this.setLastUseTimestamp();
        this.inactivateEach("#silverExchange .directionButtons .directionButton");
        this.activate(this.options.exchangeOptions.showExchangeTypeElement);
        this.inactivateEach(jQuery("#silverExchange .exchangeType"));
        this.activate(jQuery("#silverExchange .exchangeType" + this.options.exchangeOptions.directionType));
        this.hideAllMessages();
        this.updateExchangeValue(jQuery("#silverExchange .exchangeType" + this.options.exchangeOptions.directionType + " input").val());
        return this
    };
    this.inactivateEach = function (b) {
        jQuery(b).each(function (c, e) {
            var d = jQuery(e);
            d.removeClass("active");
            d.addClass("disabled")
        })
    };
    this.activate = function (b) {
        b.addClass("active");
        b.removeClass("disabled");
        return this
    };
    this.showMessageByKey = function (b) {
        var c = this.options.messages[b];
        this.showMessage(c);
        return this
    };
    this.showMessage = function (c) {
        var b = '<span class="' + c.type + '">' + c.message + "</span>";
        jQuery("#silverExchange .exchangeMessageLine").html(b);
        return this
    };
    this.hideAllMessages = function () {
        jQuery("#silverExchange .exchangeMessageLine").html("<span>&nbsp;</span>");
        return this
    };
    this.updateElementsTooltip = function (b, c) {
        if (this.options.messages[c] && this.options.messages[c].message) {
            Travian.Tip.set(b, this.options.messages[c].message)
        }
    };
    this.sendAction = function (d) {
        var h = this;
        h.setLastUseTimestamp();
        if (this.isButtonInactive(d)) {
            return false
        }
        if (this.isWaiting === true) {
            return false
        }
        this.isWaiting = true;
        this.disableElement(d);
        var c = jQuery("#silverExchange .exchangeType input.text");
        c.each(function () {
            h.disableElement(jQuery(this))
        });
        var e = new Date().getTime();
        var g = this.options.exchangeOptions.directionType;
        var f = c.filter("input[class^=silverInput]").val();
        var b = c.filter("input[class^=goldInput]").val();
        Travian.ajax({
            data: {cmd: "silverExchange", exTyp: g, s: f, g: b}, onSuccess: function (i) {
                if (i.errorMessage) {
                    h.setError(i)
                } else {
                    var k = Math.max(0, 500 - (new Date().getTime() - e));
                    var j = function (l) {
                        if (l.message) {
                            h.isWaiting = false;
                            h.hideAllMessages();
                            h.overrideGoldAndSilver(l.oldGold, l.oldSilver, l.newGold, l.newSilver);
                            h.enableElement(d);
                            c.each(function () {
                                h.enableElement(jQuery(this))
                            });
                            if (h.options.exchangeOptions.directionType === "SilverToGold") {
                                h.options.exchangeOptions.maxAmount = l.newSilver
                            } else {
                                h.options.exchangeOptions.maxAmount = l.newGold
                            }
                            if (h.options.maxAmountChangedFunction == "function") {
                                h.options.maxAmountChangedFunction.call(this, {
                                    oldGold: l.oldGold,
                                    oldSilver: l.oldSilver,
                                    newGold: l.newGold,
                                    newSilver: l.newSilver
                                })
                            }
                            jQuery(document).trigger("TG:changeMaxGoldToSilverAmounts", {
                                oldGold: l.oldGold,
                                oldSilver: l.oldSilver,
                                newGold: l.newGold,
                                newSilver: l.newSilver
                            });
                            h.updateExchangeValue(jQuery("#silverExchange .exchangeType" + h.options.exchangeOptions.directionType + " input").val());
                            h.showMessage(l.message);
                            var m = Travian.parseURL(window.location.href);
                            h.updateHeroAuctionContent(m.searchObject.action, {
                                filter: m.searchObject.filter,
                                page: m.searchObject.page
                            })
                        }
                    };
                    setTimeout(j.bind(h), k, i)
                }
            }
        });
        return this
    };
    this.setMaxAmounts = function (b) {
        if (this.options.exchangeOptions.directionType === "SilverToGold") {
            this.options.exchangeOptions.maxAmount = b.newSilver
        } else {
            this.options.exchangeOptions.maxAmount = b.newGold
        }
        return this
    };
    this.disableElement = function (b) {
        b.addClass("disabled");
        return this
    };
    this.enableElement = function (b) {
        b.removeClass("disabled");
        return this
    };
    this.isButtonInactive = function (b) {
        return b.hasClass("disabled")
    };
    this.overrideGoldAndSilver = function (b, e, h, g) {
        if (h === undefined && g === undefined) {
            return this
        }
        var c;
        var d;
        var f = function (k, l) {
            l = jQuery(l);
            if (this.type === "gold") {
                c = parseInt(b);
                d = parseInt(h)
            } else {
                c = parseInt(e);
                d = parseInt(g)
            }
            var j = l.html();
            var m = new Travian.Formatter({forceDecimal: false});
            j = m.removeNonDigits(j);
            var i = c - j;
            l.html(d + i)
        };
        jQuery(".ajaxReplaceableSilverAmountDiff").each(jQuery.proxy(f, {type: "silver"}));
        jQuery(".ajaxReplaceableGoldAmountDiff").each(jQuery.proxy(f, {type: "gold"}));
        jQuery(".ajaxReplaceableSilverAmount").each(function (i, j) {
            jQuery(j).html(g)
        });
        jQuery(".ajaxReplaceableGoldAmount").each(function (i, j) {
            jQuery(j).html(h)
        });
        return this
    };
    this.setLastUseTimestamp = function () {
        window.lastTimestampUseSilverExchange = new Date().getTime()
    };
    this.updateHeroAuctionContent = function (f, b) {
        var d = b || {};
        var e = {cmd: "heroAuctionContent", action: f};
        for (var c in d) {
            if (d.hasOwnProperty(c) && !e[c]) {
                e[c] = d[c]
            }
        }
        Travian.ajax({
            data: e, onSuccess: function (g) {
                if (g.html) {
                    var h = jQuery("#auction");
                    h.html(g.html);
                    Travian.Tip.updateAllInElement(h);
                    Travian.TimersAndCounters.initTimers()
                }
            }
        })
    };
    this.initialize()
};
Travian.Game.Hero.HorseToggle = {
    waitingForResponse: false, init: function () {
        jQuery("#horseToggleBox > div button").on({
            mouseover: this.fnOnMouseOver,
            mouseout: this.fnOnMouseOut,
            click: this.fnOnClick
        })
    }, fnOnMouseOver: function () {
        var a = jQuery(this).parents().eq(2);
        if (a.length > 0 && a.hasClass("inactive")) {
            a.addClass("hover")
        }
    }, fnOnMouseOut: function () {
        var a = jQuery(this).parents().eq(2);
        if (a.length > 0 && a.hasClass("inactive")) {
            a.removeClass("hover")
        }
    }, fnOnClick: function () {
        if (Travian.Game.Hero.HorseToggle.waitingForResponse) {
            return false
        }
        var b = jQuery(this).parents().eq(2);
        if (b.length > 0 && b.hasClass("inactive")) {
            var a = jQuery("#horseToggleBox > div.inactive");
            var c = jQuery("#horseToggleBox > div.active");
            a.find(".button button").addClass("disabled")[0].disabled = true;
            Travian.Game.Hero.HorseToggle.waitingForResponse = true;
            Travian.ajax({
                data: {cmd: "horseToggle"}, onSuccess: function (e) {
                    if (e.changed) {
                        var d = jQuery(".speed .powervalue .current");
                        if (d.length > 0) {
                            d.html(e.newSpeed)
                        }
                        jQuery("#heroSpeedValueNumber").html(e.newSpeed);
                        a.removeClass("inactive").addClass("active");
                        c.removeClass("active").addClass("inactive");
                        jQuery(window).trigger("domAltered", jQuery("#horseToggleBox > div.inactive"));
                        jQuery(window).trigger("domAltered", jQuery("#horseToggleBox > div.active"))
                    }
                    a.find(".button button").removeClass("disabled")[0].disabled = false;
                    Travian.Game.Hero.HorseToggle.waitingForResponse = false
                }
            })
        }
    }
};
Travian.Game.Hero.Properties = {};
Travian.Game.Hero.Properties.PropertyForm = function () {
    this.unloadIdentifier = null;
    this.onDirty = function (d) {
        var c = this.elements.saveHeroAttributes.getInput();
        var b = jQuery(".heroAttributesFormMessage");
        if (d) {
            b.removeClass("hide");
            c.removeClass("disabled")[0].disabled = false;
            this.unloadIdentifier = Travian.Form.UnloadHelper.enableSecurity(this.unloadIdentifier)
        } else {
            b.addClass("hide");
            c.addClass("disabled")[0].disabled = true;
            Travian.Form.UnloadHelper.disableSecurity(this.unloadIdentifier)
        }
        if (typeof this.elements.resetHeroAttributes !== "undefined") {
            var a = this.elements.resetHeroAttributes.getInput();
            a[0].disabled = a.hasClass("disabled")
        }
        return this
    };
    this.onClick = function (a) {
        switch (a.getName()) {
            case"saveHeroAttributes":
                this.saveHeroAttributes();
                break;
            case"resetHeroAttributes":
                this.resetHeroAttributes();
                break;
            default:
                return
        }
        return this
    };
    this.saveHeroAttributes = function () {
        var a = {
            cmd: "heroSetAttributes",
            resource: this.elements.resource.getValue(),
            attackBehaviour: this.elements.attackBehaviour.getValue()
        };
        if (this.elements.properties !== undefined) {
            a.attributes = this.elements.properties.getPropertyValues()
        }
        Travian.Form.UnloadHelper.disableSecurity(this.unloadIdentifier);
        Travian.ajax({data: a})
    };
    this.resetHeroAttributes = function () {
        Travian.ajax({data: {cmd: "heroResetAttributes"}})
    };
    Travian.Form.call(this)
};
Travian.Game.Hero.Properties.PropertyForm.prototype = Object.create(Travian.Form.prototype);
Travian.Game.Hero.Properties.PropertyForm.constructor = Travian.Game.Hero.Properties.PropertyForm;
Travian.Game.Hero.PropertySetter = function (b, a) {
    this.options = Object.assign({
        availablePoints: 0,
        element: null,
        selectorBtnMinus: ".pointsValueSetter.sub a",
        selectorBtnPlus: ".pointsValueSetter.add a",
        elementAvailablePoints: ""
    }, a);
    this.getAvailablePoints = function () {
        return this.options.availablePoints - this.getSettedPoints()
    };
    this.getPropertyValues = function () {
        var c = {};
        jQuery.each(this.options.attributes, function (d, e) {
            c[e.getId()] = e.getSettedPoints()
        });
        return c
    };
    this.isDirty = function () {
        return this.getSettedPoints() > 0
    };
    this.initialize = function (c) {
        var d = this;
        Travian.Form.Element.call(this, c);
        jQuery.each(this.options.attributes, function (e, f) {
            f.setPropertySetter(d)
        });
        this.options.element = jQuery("#" + this.options.element);
        this.options.elementAvailablePoints = jQuery("#" + this.options.elementAvailablePoints);
        this.update()
    };
    this.getSettedPoints = function () {
        var c = 0;
        jQuery.each(this.options.attributes, function (d, e) {
            c += e.getSettedPoints()
        });
        return c
    };
    this.update = function () {
        jQuery.each(this.options.attributes, function (d, e) {
            e.updateButtons()
        });
        var c = this.getAvailablePoints() + "/" + this.options.availablePoints;
        this.options.elementAvailablePoints.html(c);
        this.onChange();
        return this
    };
    this.initialize(b)
};
Travian.Game.Hero.PropertySetter.prototype = Object.create(Travian.Form.Element.prototype);
Travian.Game.Hero.PropertySetter.constructor = Travian.Game.Hero.PropertySetter;
Travian.Game.Hero.PropertySetter.Attribute = function (a) {
    this.options = Object.assign({
        id: null,
        element: null,
        value: null,
        usedPoints: null,
        maxPoints: null,
        elementBtnMinus: ".pointsValueSetter.sub a",
        elementBtnPlus: ".pointsValueSetter.add a",
        elementInput: ".points input",
        elementProgressBar: ".progress .bar.setted",
        elementValue: ".current .value"
    }, a);
    this.propertySetter = null;
    this.settedPoints = 0;
    this.getId = function () {
        return this.options.id
    };
    this.getMaxPoints = function () {
        return this.options.maxPoints
    };
    this.getPropertySetter = function () {
        if (this.propertySetter === null) {
            throw"missing propertySetter in Travian.Game.Hero.PropertySetter.Attribute"
        }
        return this.propertySetter
    };
    this.getSettedPoints = function () {
        return this.settedPoints
    };
    this.getTotalPoints = function () {
        return this.settedPoints + this.options.usedPoints
    };
    this.initialize = function () {
        var f = this;
        this.options.element = jQuery("#" + this.options.element);
        this.options.elementBtnMinus = this.options.element.find(this.options.elementBtnMinus);
        this.options.elementBtnPlus = this.options.element.find(this.options.elementBtnPlus);
        this.options.elementInput = this.options.element.find(this.options.elementInput);
        this.options.elementProgressBar = this.options.element.find(this.options.elementProgressBar);
        this.options.elementValue = this.options.element.find(this.options.elementValue);
        var h = null;
        var b = false;
        var c = function (i, j) {
            j.preventDefault();
            if (b === false) {
                f[i + "Point"]()
            }
            b = false;
            return false
        };
        var e = function (i) {
            i.preventDefault();
            if (h) {
                clearInterval(h)
            }
            jQuery(i.target).removeClass("click");
            return false
        };
        var g = function (j, k) {
            k.preventDefault();
            if (h) {
                clearInterval(h)
            }
            b = true;
            jQuery(k.target).addClass("click");
            var i = jQuery(document.body);
            i.off("mouseup", e);
            i.on("mouseup", e);
            f[j + "Point"]();
            h = setInterval(f[j + "Point"].bind(f), 200);
            return false
        };
        var d = function (k) {
            var i = null;
            var j = (k.originalEvent.wheelDelta > 0 ? 1 : -1);
            k.preventDefault();
            if (h) {
                clearInterval(h)
            }
            f.setSettedPoints(f.getSettedPoints() + j);
            if (j > 0) {
                i = f.options.elementBtnPlus;
                f.options.elementBtnMinus.removeClass("click")
            } else {
                i = f.options.elementBtnMinus;
                f.options.elementBtnPlus.removeClass("click")
            }
            i.addClass("click");
            h = setTimeout(function () {
                i.removeClass("click")
            }, 100);
            return false
        };
        this.options.elementBtnMinus.on({
            click: jQuery.proxy(c, this, "sub"),
            mousedown: jQuery.proxy(g, this, "sub"),
            mousewheel: d
        });
        this.options.elementBtnPlus.on({
            click: jQuery.proxy(c, this, "add"),
            mousedown: jQuery.proxy(g, this, "add"),
            mousewheel: d
        });
        this.options.elementInput.on({
            change: function (j) {
                var i = parseInt(f.options.elementInput.val());
                if (isNaN(i)) {
                    i = f.getTotalPoints()
                }
                f.setSettedPoints(i - f.options.usedPoints)
            }, mousewheel: d
        })
    };
    this.setPropertySetter = function (b) {
        this.propertySetter = b;
        return this
    };
    this.setSettedPoints = function (c) {
        c = parseInt(c);
        if (isNaN(c)) {
            c = this.settedPoints
        }
        if (c < 0) {
            c = 0
        }
        if (c > this.getMaxPoints() - this.options.usedPoints) {
            c = this.getMaxPoints() - this.options.usedPoints
        }
        var b = this.getPropertySetter().getAvailablePoints();
        if (this.settedPoints < c && b < c - this.settedPoints) {
            c = this.settedPoints + b
        }
        this.settedPoints = c;
        return this.update()
    };
    this.addPoint = function (b) {
        if (b == null || b === "") {
            b = 1
        }
        if (b < 0) {
            b = 0
        }
        return this.setSettedPoints(this.getSettedPoints() + b)
    };
    this.subPoint = function (b) {
        if (b == null || b === "") {
            b = 1
        }
        if (b < 0) {
            b = 0
        }
        return this.setSettedPoints(this.getSettedPoints() - b)
    };
    this.updateButtons = function () {
        this.options.elementBtnPlus.toggleClass("disabled", this.getTotalPoints() >= this.getMaxPoints() || this.getPropertySetter().getAvailablePoints() === 0);
        this.options.elementBtnMinus.toggleClass("disabled", this.getSettedPoints() === 0);
        return this
    };
    this.initialize()
};
Travian.Game.Hero.PropertySetter.Attribute.prototype.calculateValue = function () {
    return 0
};
Travian.Game.Hero.PropertySetter.Attribute.prototype.update = function () {
    this.options.elementValue.html(this.calculateValue());
    this.options.elementInput.val(this.options.usedPoints + this.getSettedPoints());
    this.options.elementProgressBar.css("width", Math.max(0, Math.min(100, Math.round(100 / Math.min(this.getMaxPoints() + 4, 100) * this.getSettedPoints()))) + "%");
    this.getPropertySetter().update();
    return this
};
Travian.Game.Hero.PropertySetter.Attribute.Power = function (a) {
    this.options = Object.assign({valueOfItems: 0, valueBonus: 0}, a);
    this.calculateValue = function () {
        return 100 + this.getTotalPoints() * this.options.valueBonus + this.options.valueOfItems
    };
    Travian.Game.Hero.PropertySetter.Attribute.call(this, this.options)
};
Travian.Game.Hero.PropertySetter.Attribute.Power.prototype = Object.create(Travian.Game.Hero.PropertySetter.Attribute.prototype);
Travian.Game.Hero.PropertySetter.Attribute.Power.constructor = Travian.Game.Hero.PropertySetter.Attribute.Power;
Travian.Game.Hero.PropertySetter.Attribute.OffBonus = function (a) {
    this.calculateValue = function () {
        return Math.round(this.getTotalPoints() * 0.2 * 10) / 10 + "%"
    };
    Travian.Game.Hero.PropertySetter.Attribute.call(this, a)
};
Travian.Game.Hero.PropertySetter.Attribute.OffBonus.prototype = Object.create(Travian.Game.Hero.PropertySetter.Attribute.prototype);
Travian.Game.Hero.PropertySetter.Attribute.OffBonus.constructor = Travian.Game.Hero.PropertySetter.Attribute.OffBonus;
Travian.Game.Hero.PropertySetter.Attribute.DefBonus = function (a) {
    this.calculateValue = function () {
        return Math.round(this.getTotalPoints() * 0.2 * 10) / 10 + "%"
    };
    Travian.Game.Hero.PropertySetter.Attribute.call(this, a)
};
Travian.Game.Hero.PropertySetter.Attribute.DefBonus.prototype = Object.create(Travian.Game.Hero.PropertySetter.Attribute.prototype);
Travian.Game.Hero.PropertySetter.Attribute.DefBonus.constructor = Travian.Game.Hero.PropertySetter.Attribute.DefBonus;
Travian.Game.Hero.PropertySetter.Attribute.ProductionPoints = function (a) {
    this.calculateValue = function () {
        return this.getTotalPoints()
    };
    this.options = Object.assign({pointWorth: [6, 20, 20, 20, 20]}, a);
    this.elementResources = [];
    this.getPossibleBonusProductionForResource = function (b) {
        if (b === 0) {
            return this.calculateValue() * this.options.pointWorth[0] * Travian.Game.speed
        }
        if (b <= 4) {
            return this.calculateValue() * this.options.pointWorth[b] * Travian.Game.speed
        }
        return 0
    };
    this.initialize = function () {
        Travian.Game.Hero.PropertySetter.Attribute.call(this, this.options);
        var b = this;
        var c = jQuery("#setResource");
        if (c.length > 0) {
            c.find("div.resource label:not(.baseCrop) span.current").each(function (d) {
                b.elementResources[d] = this
            })
        }
    };
    this.update = function () {
        var b = this;
        jQuery.each(this.elementResources, function (c, e) {
            var d = jQuery(e);
            if (d.length > 0) {
                d.html(b.getPossibleBonusProductionForResource(c))
            }
        });
        return Travian.Game.Hero.PropertySetter.Attribute.prototype.update.call(this)
    };
    this.initialize()
};
Travian.Game.Hero.PropertySetter.Attribute.ProductionPoints.prototype = Object.create(Travian.Game.Hero.PropertySetter.Attribute.prototype);
Travian.Game.Hero.PropertySetter.Attribute.ProductionPoints.constructor = Travian.Game.Hero.PropertySetter.Attribute.ProductionPoints;
Travian.Game.Hero.PropertySetter.Attribute.RegenBonus = function (a) {
    this.calculateValue = function () {
        return Math.round(this.getTotalPoints() * 0.5 * 10) / 10 + "%"
    };
    Travian.Game.Hero.PropertySetter.Attribute.call(this, a)
};
Travian.Game.Hero.PropertySetter.Attribute.RegenBonus.prototype = Object.create(Travian.Game.Hero.PropertySetter.Attribute.prototype);
Travian.Game.Hero.PropertySetter.Attribute.RegenBonus.constructor = Travian.Game.Hero.PropertySetter.Attribute.RegenBonus;
Travian.Game.WelcomeScreen = {
    dialog: null, show: function () {
        Travian.Game.WelcomeScreen.dialog = new Travian.Dialog.Ajax({
            data: {cmd: "welcomeScreen"},
            context: "welcomeScreen",
            buttonOk: false,
            darkOverlay: true,
            buttonCancel: false,
            overlayCancel: false
        })
    }, showIntroductionScreen: function () {
        Travian.Game.WelcomeScreen.dialog = new Travian.Dialog.Ajax({
            data: {cmd: "welcomeScreen", introduction: true},
            context: "introductionScreen",
            buttonOk: false,
            darkOverlay: true,
            buttonCancel: true,
            overlayCancel: true,
            cssClass: "white introductionScreen"
        })
    }, bindEvents: function () {
        var a = jQuery(".welcomeScreen");
        jQuery(".welcomeScreen .startPlaying").on("click", function () {
            Travian.Game.WelcomeScreen.dialog.close()
        });
        jQuery(".welcomeScreen .previewVideoContainer").on("click", function () {
            var b;
            if (!a.hasClass("heroItemsEnabled")) {
                b = '<iframe width="568" height="320" src="https://www.youtube.com/embed/bOtcpFmtO04?rel=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>'
            } else {
                b = '<iframe width="568" height="320" src="https://www.youtube.com/embed/fkcrmCTv0d4?rel=0&amp;showinfo=0&amp;autoplay=1" frameborder="0" allowfullscreen></iframe>'
            }
            jQuery(".welcomeScreen .previewVideoContainer").html(b);
            jQuery(".welcomeScreen .welcomeScreenHeader .overlay").addClass("active")
        });
        jQuery(".welcomeScreen .readMore, .welcomeScreen .readLess").on("click", function () {
            Travian.Game.WelcomeScreen.toggleState()
        });
        jQuery(".welcomeScreen .feature").on("click", function () {
            Travian.Game.WelcomeScreen.extend()
        })
    }, toggleState: function () {
        var a = jQuery(".welcomeScreen");
        if (a.hasClass("extended")) {
            Travian.Game.WelcomeScreen.collapse()
        } else {
            Travian.Game.WelcomeScreen.extend()
        }
    }, extend: function () {
        var a = jQuery(".welcomeScreen");
        if (!a.hasClass("extended")) {
            a.addClass("extended")
        }
        setTimeout(function () {
            Travian.Game.WelcomeScreen.dialog.updatePosition(500)
        }, 1000)
    }, collapse: function () {
        var a = jQuery(".welcomeScreen");
        if (a.hasClass("extended")) {
            a.removeClass("extended")
        }
        setTimeout(function () {
            Travian.Game.WelcomeScreen.dialog.updatePosition(500)
        }, 1000)
    }
};
Travian.Game.Activation = function () {
    this.arrowShapes = {tribe1: "", tribe2: "", tribe3: "", tribe4: "", tribe5: ""};
    this.basicShape = "M10 10 V230 H[ARROW_POSITION] l20 20 l20 -20 H530 V10 Z";
    this.initialize = function () {
        var a = this;
        a.createArrowShapes();
        a.updateArrowPositions();
        a.bindEvents()
    };
    this.bindEvents = function () {
        var a = this;
        jQuery("#tribeSelectors").find('input[name="vid"]').on("change", function () {
            a.updateArrowPositions()
        })
    };
    this.createArrowShapes = function () {
        var d = this;
        var c = jQuery("#tribeSelectors");
        var h = c.find("label").outerWidth(true);
        var g = c.find('input[name="vid"]').length;
        var f = c.width();
        var e = (f - g * h) / 2;
        var a;
        for (var b = 0; b < g; b++) {
            a = e + b * h + h / 3.3333;
            d.arrowShapes["tribe" + (b + 1)] = d.basicShape.replace("[ARROW_POSITION]", a)
        }
    };
    this.updateArrowPositions = function () {
        var c = this;
        var b = jQuery("#tribeSelectors").find('input[name="vid"]');
        if (jQuery("body.rtl").length > 0) {
            b = b.toArray().reverse()
        }
        for (var a = 0; a < b.length; a++) {
            if (b[a].checked === true) {
                TweenLite.to(jQuery("#presentation svg .inner, #presentation svg .outer"), 0.25, {morphSVG: c.arrowShapes["tribe" + (a + 1)]})
            }
        }
    };
    this.initialize()
};
Travian.Game.Overlay = {
    elementsForOverlay: [{
        groupID: "mainPage",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: 0,
        offsetY2: 0,
        members: [{selector: "#logo", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "villageSwitch",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 5,
        offsetY1: -5,
        offsetY2: -5,
        helperOffsetRTLX2: 4,
        members: [{selector: "#n1", x1: null, x2: null, y1: null, y2: null}, {
            selector: "#n2",
            x1: null,
            x2: null,
            y1: null,
            y2: null
        }]
    }, {
        groupID: "mainNavigation",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 8,
        offsetY1: -5,
        offsetY2: 0,
        helperOffsetRTLX2: -2,
        members: [{selector: "#n3", x1: null, x2: null, y1: null, y2: null}, {
            selector: "#n4",
            x1: null,
            x2: null,
            y1: null,
            y2: null
        }, {selector: "#n5", x1: null, x2: null, y1: null, y2: null}, {
            selector: "#n6",
            x1: null,
            x2: null,
            y1: null,
            y2: null
        }]
    }, {
        groupID: "premiumFeatures",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 0,
        offsetY1: -25,
        offsetY2: -7,
        helperOffsetY1: 1,
        helperOffsetY2: -1,
        helperOffsetRTLX2: 14,
        members: [{selector: "#n7", x1: null, x2: null, y1: null, y2: null}, {
            selector: "#goldSilver",
            x1: null,
            x2: null,
            y1: null,
            y2: null
        }]
    }, {
        groupID: "outOfGame",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 70,
        offsetX2: 70,
        offsetY1: 0,
        offsetY2: 0,
        helperOffsetRTLX2: -71,
        members: [{selector: "#outOfGame", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "villageResources",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 10,
        offsetY1: -5,
        offsetY2: 10,
        helperOffsetY1: -4,
        helperOffsetRTLX2: -6,
        members: [{
            selector: "#stockBarWarehouseWrapper",
            x1: null,
            x2: null,
            y1: null,
            y2: null
        }, {selector: "#stockBarResource1", x1: null, x2: null, y1: null, y2: null}, {
            selector: "#stockBarResource2",
            x1: null,
            x2: null,
            y1: null,
            y2: null
        }, {selector: "#stockBarResource3", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "villageCrop",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 10,
        offsetY1: -5,
        offsetY2: 10,
        helperOffsetY1: -4,
        helperOffsetRTLX2: -6,
        members: [{
            selector: "#stockBarGranaryWrapper",
            x1: null,
            x2: null,
            y1: null,
            y2: null
        }, {
            selector: "#stockBarResource4",
            x1: null,
            x2: null,
            y1: null,
            y2: null
        }, {selector: "#stockBarFreeCropWrapper", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "sidebarBoxHero",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: -75,
        offsetY2: 12,
        members: [{selector: "#sidebarBoxHero", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "sidebarBoxAlliance",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: -14,
        offsetY2: 0,
        members: [{
            selector: "#sidebarBoxAlliance",
            x1: null,
            x2: null,
            y1: null,
            y2: null
        }, {selector: "#sidebarBoxAllianceNoNews", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "sidebarBoxInfobox",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: -3,
        offsetY2: 0,
        members: [{selector: "#sidebarBoxInfobox", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "sidebarBoxLinklist",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: -20,
        offsetY2: 0,
        members: [{selector: "#sidebarBoxLinklist", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "sidebarBoxActiveVillage",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: -20,
        offsetY2: 10,
        members: [{selector: "#sidebarBoxActiveVillage", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "sidebarBoxVillagelist",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: -16,
        offsetY2: 0,
        members: [{selector: "#sidebarBoxVillagelist", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "sidebarBoxQuestmaster",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: -121,
        offsetY2: 0,
        members: [{selector: "#sidebarBoxQuestmaster", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "sidebarBoxDailyquests",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: -15,
        offsetY2: 0,
        helperOffsetY1: -15,
        members: [{selector: "#sidebarBoxDailyquests", x1: null, x2: null, y1: null, y2: null}]
    }, {
        groupID: "sidebarBoxWheelOfFortune",
        x1: null,
        x2: null,
        y1: null,
        y2: null,
        offsetX1: 0,
        offsetX2: 7,
        offsetY1: -10,
        offsetY2: 0,
        members: [{selector: "#sidebarBoxWheelOfFortune", x1: null, x2: null, y1: null, y2: null}]
    }],
    texts: null,
    canvas: null,
    readingDirection: "ltr",
    readingDirectionFrom: "left",
    readingDirectionTo: "right",
    scrollOffsetX: 0,
    onClose: Travian.emptyFunction,
    createOverlay: function () {
        var e = this;
        var d = jQuery(document);
        var c = d.width();
        var a = d.height();
        var b = jQuery('<div id="overlayUI" style="width: ' + c + "px; height: " + a + 'px;"><canvas id="overlayUICanvas" width="' + c + '" height="' + a + '"></canvas><div class="overlayContent"><div class="overlaySubcontent"><p class="overlayTitle">' + e.texts.defaultTitle + '</p><p class="overlayDescription">' + e.texts.defaultDescription + '</p><a class="overlayCloseLink" href="#" onclick="Travian.Game.Overlay.closeOverlay();">' + e.texts.closeLink + "</a></div></div>").fadeOut(1);
        jQuery("body").prepend(b);
        b.fadeIn(200);
        jQuery(e.elementsForOverlay).each(function (f, g) {
            e.addDarkBackground(g);
            jQuery(g.members).each(function (i, h) {
                jQuery(h.selector).addClass("overlayUIAffected")
            })
        });
        e.scrollOffsetX = (e.readingDirection === "rtl" ? Math.abs(c - jQuery(window).width()) : 0)
    },
    handleOverlay: function () {
        var e = this;
        var a = jQuery("#overlayUI");
        var g = jQuery("#overlayUICanvas");
        this.canvas = g[0].getContext("2d");
        var c = a.width();
        var i = a.height();
        this.canvas.width = c;
        this.canvas.height = i;
        e.drawCanvas(0, 0);
        var f = a.find(".overlayTitle");
        var h = a.find(".overlayDescription");
        var d = a.find(".overlayCloseLink");
        var b;
        a.on("mousemove.travianOverlay", function (j) {
            e.drawCanvas(j.pageX, j.pageY);
            b = false;
            jQuery(e.elementsForOverlay).each(function (k, l) {
                if (l.x1 !== null) {
                    if (j.pageX >= l.x1 && j.pageX <= l.x2 && j.pageY >= l.y1 && j.pageY <= l.y2) {
                        b = true;
                        f.html(e.texts[l.groupID + "Title"]);
                        h.html(e.texts[l.groupID + "Description"]);
                        d.addClass("hide")
                    }
                }
            });
            if (!b) {
                f.html(e.texts.defaultTitle);
                h.html(e.texts.defaultDescription);
                d.removeClass("hide")
            }
        })
    },
    drawCanvas: function (b, a) {
        var c = this;
        c.canvas.clearRect(0, 0, c.canvas.width, c.canvas.height);
        this.canvas.beginPath();
        this.canvas.fillStyle = "rgba(0,0,0,0.85)";
        this.canvas.fillRect(0, 0, this.canvas.width, this.canvas.height);
        this.canvas.closePath();
        jQuery(this.elementsForOverlay).each(function (d, e) {
            if (e.x1 !== null) {
                if (b >= e.x1 && b <= e.x2 && a >= e.y1 && a <= e.y2) {
                    c.canvas.clearRect(e.x1 + c.scrollOffsetX, e.y1, (e.x2 - e.x1), (e.y2 - e.y1));
                    c.canvas.strokeStyle = "rgba(255,255,255,0.3)"
                } else {
                    c.canvas.strokeStyle = "rgba(255,255,255,1)"
                }
                c.canvas.lineWidth = 1;
                c.canvas.strokeRect(e.x1 + c.scrollOffsetX, e.y1, (e.x2 - e.x1), (e.y2 - e.y1))
            }
        })
    },
    getElementDimensions: function () {
        var a, e, c, b, f, d;
        jQuery(this.elementsForOverlay).each(function (g, h) {
            c = h.x1;
            b = h.x2;
            f = h.y1;
            d = h.y2;
            jQuery(h.members).each(function (i, j) {
                a = jQuery(j.selector);
                if (a.length > 0) {
                    e = a.offset();
                    e.top = parseInt(e.top);
                    e.left = parseInt(e.left);
                    j.x1 = e.left;
                    j.x2 = e.left + a.width();
                    j.y1 = e.top;
                    j.y2 = e.top + a.height();
                    if (c === null || j.x1 < c) {
                        c = j.x1
                    }
                    if (b === null || j.x2 > b) {
                        b = j.x2
                    }
                    if (f === null || j.y1 < c) {
                        f = j.y1
                    }
                    if (d === null || j.y2 > d) {
                        d = j.y2
                    }
                }
            });
            if (c !== null && b !== null && f !== null && d !== null) {
                h.x1 = c - 4 + h.offsetX1;
                h.x2 = b - 4 + h.offsetX2;
                h.y1 = f + h.offsetY1;
                h.y2 = d + h.offsetY2
            }
        })
    },
    addDarkBackground: function (g) {
        var f = this;
        var e, h;
        var b = (this.readingDirection === "rtl" && typeof g.helperOffsetRTLX1 !== "undefined" ? g.helperOffsetRTLX1 : 0);
        var a = (this.readingDirection === "rtl" && typeof g.helperOffsetRTLX2 !== "undefined" ? g.helperOffsetRTLX2 : 0);
        var c = (this.readingDirection === "rtl" ? 1 : 0);
        jQuery(g.members).each(function (i, j) {
            h = jQuery(j.selector);
            if (h.length > 0) {
                if (typeof e === "undefined") {
                    e = h
                } else {
                    if (f.readingDirection === "ltr" && h.offset().left < e.offset().left) {
                        e = h
                    }
                    if (f.readingDirection === "rtl" && h.offset().left > e.offset().left) {
                        e = h
                    }
                }
            }
        });
        if (typeof e !== "undefined" && e.length > 0) {
            var d = jQuery('<div class="overlayUIBackgroundHelper"></div>').css({
                "background-color": "rgba(0,0,0,0.85)",
                position: "absolute",
                width: (g.x2 - g.x1),
                height: (g.y2 - g.y1),
                "margin-left": (typeof g.helperOffsetX1 !== "undefined" ? g.helperOffsetX1 : g.offsetX1) - 4 + b,
                "margin-right": (typeof g.helperOffsetX2 !== "undefined" ? g.helperOffsetX2 : g.offsetX2) + a - 10 * c,
                "margin-top": (typeof g.helperOffsetY1 !== "undefined" ? g.helperOffsetY1 : g.offsetY1),
                "margin-bottom": (typeof g.helperOffsetY2 !== "undefined" ? g.helperOffsetY2 : g.offsetY2),
                "z-index": -1
            }).fadeOut(1);
            e.prepend(d);
            d.fadeIn(200)
        }
    },
    removeAllBackgroundHelpers: function () {
        jQuery(".overlayUIBackgroundHelper").fadeOut(200);
        jQuery(".overlayUIAffected").removeClass("overlayUIAffected");
        setTimeout(function () {
            jQuery(".overlayUIBackgroundHelper").remove()
        }, 250)
    },
    handleResize: function () {
        var a = this;
        jQuery(window).on("resize.travianOverlay", function () {
            a.closeOverlay();
            setTimeout(function () {
                a.openOverlay()
            }, 300)
        })
    },
    openOverlay: function () {
        var a = this;
        Travian.ajax({
            data: {cmd: "overlay"}, onSuccess: function (b) {
                a.texts = b.texts;
                if (jQuery("body").hasClass("rtl")) {
                    a.readingDirection = "rtl";
                    a.readingDirectionFrom = "right";
                    a.readingDirectionTo = "left"
                }
                a.getElementDimensions();
                a.createOverlay();
                a.handleOverlay();
                a.handleResize()
            }
        })
    },
    closeOverlay: function () {
        var a = jQuery("#overlayUI");
        a.fadeOut(200);
        this.removeAllBackgroundHelpers();
        setTimeout(function () {
            a.remove()
        }, 250);
        jQuery(window).off("resize.travianOverlay");
        a.off("mousemove.travianOverlay");
        jQuery(this.elementsForOverlay).each(function (b, c) {
            c.x1 = null;
            c.x2 = null;
            c.y1 = null;
            c.y2 = null
        });
        Travian.Game.Overlay.onClose()
    }
};
Travian.Game.Highlight = function (c) {
    this.options = Object.assign({
        cssHighlighted: "highlighted on",
        element: null,
        renderer: "rectangle",
        rendererOptions: {}
    }, c);
    this.active = false;
    this.renderer = null;
    this.activate = function () {
        if (this.active === false) {
            this.active = true;
            this.renderer.activate();
            this.getElement().addClass(this.options.cssHighlighted)
        }
        return this
    };
    this.deactivate = function (e) {
        if (this.active === true) {
            this.active = false;
            this.getElement().removeClass(this.options.cssHighlighted);
            this.renderer.deactivate(e)
        }
        return this
    };
    this.getElement = function () {
        return this.options.element
    };
    this.toggle = function () {
        if (this.active) {
            return this.deactivate()
        }
        return this.activate()
    };
    this.options.element = jQuery(this.options.element);
    if (this.options.element.length === 0) {
        throw"missing element for highlighting!"
    }
    var d = function a(e) {
        return e.charAt(0).toUpperCase() + e.slice(1)
    }(this.options.renderer);
    var b = Travian.Game.Highlight.Renderer[d];
    if (typeof b === "undefined") {
        throw'unknown renderer "' + d + '"'
    }
    this.renderer = new b(this.options.rendererOptions, this)
};
Travian.Game.Highlight.Renderer = {};
Travian.Game.Highlight.Renderer.Renderer = function (a) {
    this.parentContainer = a;
    if (this.parentContainer === null) {
        throw"missing parent container of type Travian.Game.Highlight"
    }
};
Travian.Game.Highlight.Renderer.Renderer.prototype.getElement = function () {
    return this.parentContainer.getElement()
};
Travian.Game.Highlight.Renderer.Renderer.prototype.activate = function () {
    return this
};
Travian.Game.Highlight.Renderer.Renderer.prototype.deactivate = function () {
    return this
};
Travian.Game.Highlight.Renderer.Rectangle = function (b, d) {
    var a = function (f) {
        var e = f.offset();
        var g = {left: e.left, top: e.top, width: f.outerWidth(), height: f.outerHeight()};
        g.right = g.left + g.width;
        g.bottom = g.top + g.height;
        return g
    };
    var c = function (k, m) {
        if (!m) {
            m = k.data.renderer
        }
        var i = jQuery(m.getElement());
        var o = a(i);
        if (m._lastCoordinates && m._lastCoordinates.left === o.left && m._lastCoordinates.top === o.top && m._lastCoordinates.width === o.width && m._lastCoordinates.height === o.height && m._lastCoordinates.right === o.right && m._lastCoordinates.bottom === o.bottom) {
            return
        }
        var g = m.getElementLeft();
        var q = m.getElementTopLeft();
        var n = m.getElementTop();
        var h = m.getElementTopRight();
        var p = m.getElementRight();
        var l = m.getElementBottomLeft();
        var f = m.getElementBottom();
        var j = m.getElementBottomRight();
        g.css({left: o.left - g.width(), top: o.top, height: o.height}).show();
        q.css({left: o.left - q.width(), top: o.top - q.height()}).show();
        n.css({left: o.left, top: o.top - n.height(), width: o.width}).show();
        h.css({left: o.right, top: o.top - h.height()}).show();
        p.css({left: o.right, top: o.top, height: o.height}).show();
        j.css({left: o.right, top: o.bottom}).show();
        f.css({left: o.left, top: o.bottom, width: o.width}).show();
        l.css({left: o.left - l.width(), top: o.bottom}).show();
        m._lastCoordinates = o
    };
    this.elements = {
        left: null,
        topLeft: null,
        top: null,
        topRight: null,
        right: null,
        bottomLeft: null,
        bottom: null,
        bottomRight: null
    };
    this.invalidTypes = ["area"];
    this.options = Object.assign({
        cssClassLeft: "highlighted rectangle left",
        cssClassTopLeft: "highlighted rectangle top left",
        cssClassTop: "highlighted rectangle top",
        cssClassTopRight: "highlighted rectangle top right",
        cssClassRight: "highlighted rectangle right",
        cssClassBottomLeft: "highlighted rectangle bottom left",
        cssClassBottom: "highlighted rectangle bottom",
        cssClassBottomRight: "highlighted rectangle bottom right",
        zIndex: 6000,
        draggable: false
    }, b);
    this.activate = function () {
        var e = this;
        c(null, e);
        $(document).find(".openedClosedSwitch").on("click.highlight", {renderer: e}, c);
        if (e.options.draggable) {
            $(document).off("dialogDraggingSync").on("dialogDraggingSync", {renderer: e}, c)
        }
        return this
    };
    this.deactivate = function () {
        $(document).find(".openedClosedSwitch").off("click.highlight");
        this.getElementLeft().hide();
        this.getElementTopLeft().hide();
        this.getElementTop().hide();
        this.getElementTopRight().hide();
        this.getElementRight().hide();
        this.getElementBottomLeft().hide();
        this.getElementBottom().hide();
        this.getElementBottomRight().hide();
        this._lastCoordinates = null;
        if (this.options.draggable) {
            $(document).off("dialogDraggingSync")
        }
        return this
    };
    this.getElementBottom = function () {
        if (this.elements.bottom === null) {
            this.elements.bottom = jQuery("<div />").hide().addClass(this.options.cssClassBottom).css({
                position: "absolute",
                left: 0,
                top: 0,
                zIndex: this.options.zIndex
            });
            this.elements.bottom.appendTo("body")
        }
        return this.elements.bottom
    };
    this.getElementBottomLeft = function () {
        if (this.elements.bottomLeft === null) {
            this.elements.bottomLeft = jQuery("<div />").hide().addClass(this.options.cssClassBottomLeft).css({
                position: "absolute",
                left: 0,
                top: 0,
                zIndex: this.options.zIndex
            });
            this.elements.bottomLeft.appendTo("body")
        }
        return this.elements.bottomLeft
    };
    this.getElementBottomRight = function () {
        if (this.elements.bottomRight === null) {
            this.elements.bottomRight = jQuery("<div />").hide().addClass(this.options.cssClassBottomRight).css({
                position: "absolute",
                left: 0,
                top: 0,
                zIndex: this.options.zIndex
            });
            this.elements.bottomRight.appendTo("body")
        }
        return this.elements.bottomRight
    };
    this.getElementLeft = function () {
        if (this.elements.left === null) {
            this.elements.left = jQuery("<div />").hide().addClass(this.options.cssClassLeft).css({
                position: "absolute",
                left: 0,
                top: 0,
                zIndex: this.options.zIndex
            });
            this.elements.left.appendTo("body")
        }
        return this.elements.left
    };
    this.getElementTop = function () {
        if (this.elements.top === null) {
            this.elements.top = jQuery("<div />").hide().addClass(this.options.cssClassTop).css({
                position: "absolute",
                left: 0,
                top: 0,
                zIndex: this.options.zIndex
            });
            this.elements.top.appendTo("body")
        }
        return this.elements.top
    };
    this.getElementTopLeft = function () {
        if (this.elements.topLeft === null) {
            this.elements.topLeft = jQuery("<div />").hide().addClass(this.options.cssClassTopLeft).css({
                position: "absolute",
                left: 0,
                top: 0,
                zIndex: this.options.zIndex
            });
            this.elements.topLeft.appendTo("body")
        }
        return this.elements.topLeft
    };
    this.getElementTopRight = function () {
        if (this.elements.topRight === null) {
            this.elements.topRight = jQuery("<div />").hide().addClass(this.options.cssClassTopRight).css({
                position: "absolute",
                left: 0,
                top: 0,
                zIndex: this.options.zIndex
            });
            this.elements.topRight.appendTo("body")
        }
        return this.elements.topRight
    };
    this.getElementRight = function () {
        if (this.elements.right === null) {
            this.elements.right = jQuery("<div />").hide().addClass(this.options.cssClassRight).css({
                position: "absolute",
                left: 0,
                top: 0,
                zIndex: this.options.zIndex
            });
            this.elements.right.appendTo("body")
        }
        return this.elements.right
    };
    Travian.Game.Highlight.Renderer.Renderer.call(this, d);
    if (this.invalidTypes.indexOf(this.getElement().prop("tagName").toLowerCase()) !== -1) {
        throw"invalid tag type for rectangle-highlighting!"
    }
};
Travian.Game.Highlight.Renderer.Rectangle.prototype = Object.create(Travian.Game.Highlight.Renderer.Renderer.prototype);
Travian.Game.Highlight.Renderer.Rectangle.constructor = Travian.Game.Highlight.Renderer.Rectangle;
Travian.Game.Highlight.Renderer.Image = function (a, b) {
    this.elements = {background: null, placeholder: null};
    this.options = Object.assign({borderSurround: 4, cssBackground: "highlighted background"}, a);
    this.validTypes = ["div", "span", "a", "li", "img", "input", "button"];
    this.activate = function () {
        var c = this.getElement();
        this.getElementBackground().css({
            position: "absolute",
            left: c.position().left - this.options.borderSurround,
            right: "auto",
            top: c.position().top - this.options.borderSurround,
            width: c.width() + 2 * this.options.borderSurround,
            height: c.height() + 2 * this.options.borderSurround
        }).show();
        return this
    };
    this.deactivate = function (c) {
        c = (typeof c === "undefined" ? false : c);
        if (c) {
            this.getElementBackground().remove();
            this.elements.background = null
        } else {
            this.getElementBackground().hide()
        }
        return this
    };
    this.getElementBackground = function () {
        if (this.elements.background === null) {
            var c = this.getElement();
            this.elements.background = c.clone(false).empty().addClass(this.options.cssBackground).insertBefore(c).hide()
        }
        return this.elements.background
    };
    Travian.Game.Highlight.Renderer.Renderer.call(this, b);
    if (this.validTypes.indexOf(this.getElement().prop("tagName").toLowerCase()) === -1) {
        throw"invalid tag type for image-highlighting!"
    }
};
Travian.Game.Highlight.Renderer.Image.prototype = Object.create(Travian.Game.Highlight.Renderer.Renderer.prototype);
Travian.Game.Highlight.Renderer.Image.constructor = Travian.Game.Highlight.Renderer.Image;
Travian.AdventureList = function () {
    this.openDurationsCalulator = function () {
        var a = jQuery("#durationCalculations");
        a.toggleClass("hide");
        if (!a.hasClass("hide")) {
            this.calculateDurations()
        }
    };
    this.calculateDurations = function () {
        var a = jQuery("#adventureListForm");
        var b = jQuery("#changeVillage").val();
        Travian.ajax({
            data: {
                cmd: "calculateDurationsForAdventure",
                adventureKids: jQuery.map(a.find("input[name*=adventureKid]"), function (c) {
                    return c.value
                }),
                currentKidAndDid: b,
                originalWalkTimes: jQuery.map(a.find("input[name*=adventureWalktimeOriginalVillage]"), function (c) {
                    return c.value
                })
            }, onSuccess: function (c) {
                if (c.noAdventures === false) {
                    for (var d in c.responseArray) {
                        if (c.responseArray.hasOwnProperty(d)) {
                            jQuery("#" + d).html(c.responseArray[d])
                        }
                    }
                }
            }
        })
    }
};
Travian.Game.BuildingUpgradeView = {
    initialize: function () {
        jQuery("#build .buildingDescription .headline .openedClosedSwitch").on("click", function () {
            var b = jQuery(this);
            var a = jQuery("#build .buildingDescription");
            if (a.hasClass("collapsed")) {
                a.removeClass("collapsed");
                b.removeClass("switchClosed");
                b.addClass("switchOpened");
                Travian.Game.Preferences.set("buildingDescriptionCollapsed", false)
            } else {
                a.addClass("collapsed");
                b.addClass("switchClosed");
                b.removeClass("switchOpened");
                Travian.Game.Preferences.set("buildingDescriptionCollapsed", true)
            }
        })
    }
};
Travian.Game.TrainingTroops = {
    did: null,
    favouriteTroops: [],
    trainTroopsContainer: null,
    favouriteTroopsContainer: null,
    nonFavouriteTroopsContainer: null,
    isAnimating: false,
    initialize: function () {
        var a = this;
        a.trainTroopsContainer = jQuery(".trainUnits");
        a.favouriteTroopsContainer = jQuery("#favouriteTroops");
        a.nonFavouriteTroopsContainer = jQuery("#nonFavouriteTroops");
        a.did = parseInt(a.trainTroopsContainer.find("input[name=did]").val());
        a.loadFavouriteTroops();
        a.trainTroopsContainer.find(".troop button.favourite").on("click", function () {
            if (!a.isAnimating) {
                a.isAnimating = true;
                var c = jQuery(this);
                c.attr("disabled", "disabled");
                var b = parseInt(c.attr("data-troopID"));
                if (c.hasClass("faved")) {
                    a.removeFromFavourites(b);
                    c.removeClass("faved")
                } else {
                    a.addToFavourites(b);
                    c.addClass("faved")
                }
            }
        })
    },
    loadFavouriteTroops: function () {
        var a = Travian.Game.Preferences.get("favouriteTroopsInVillage" + this.did);
        if (a !== null) {
            this.favouriteTroops = a.split(",")
        }
    },
    saveFavouriteTroops: function () {
        Travian.Game.Preferences.set("favouriteTroopsInVillage" + this.did, this.favouriteTroops.join(","))
    },
    addToFavourites: function (b) {
        this.favouriteTroops.push("" + b);
        this.favouriteTroops.sort();
        var a = this.trainTroopsContainer.find(".innerTroopWrapper.troop" + b);
        a.addClass("favourite");
        this.orderTroopSection(b);
        this.saveFavouriteTroops()
    },
    removeFromFavourites: function (b) {
        var c = this.favouriteTroops.indexOf("" + b);
        if (c !== -1) {
            this.favouriteTroops.splice(c, 1)
        }
        this.favouriteTroops.sort();
        var a = this.trainTroopsContainer.find(".innerTroopWrapper.troop" + b);
        a.removeClass("favourite");
        this.orderTroopSection(b);
        this.saveFavouriteTroops()
    },
    orderTroopSection: function (e) {
        var i = this;
        var g = i.favouriteTroopsContainer.find(".action.troop" + e);
        var k = i.nonFavouriteTroopsContainer.find(".action.troop" + e);
        var h = g.offset();
        var c = k.offset();
        var j = i.trainTroopsContainer.find(".innerTroopWrapper.troop" + e);
        var b = j.offset();
        var a = j.find("button.favourite");
        var d;
        var f = j.parent().height();
        if (j.hasClass("favourite")) {
            d = Math.round(b.top - h.top + f);
            if (d > f) {
                j.addClass("moving");
                g.removeClass("empty");
                k.addClass("empty");
                j.animate({top: d * -1}, 1000);
                setTimeout(function () {
                    j.detach();
                    j.appendTo(g);
                    j.animate({top: 0}, 0);
                    setTimeout(function () {
                        j.removeClass("moving");
                        a.attr("disabled", false);
                        i.isAnimating = false
                    }, 50)
                }, 1000)
            } else {
                g.addClass("noAnimation").removeClass("empty");
                k.addClass("noAnimation").addClass("empty");
                j.detach();
                j.appendTo(g);
                setTimeout(function () {
                    g.removeClass("noAnimation");
                    k.removeClass("noAnimation");
                    a.attr("disabled", false);
                    i.isAnimating = false
                }, 50)
            }
        } else {
            d = Math.round(b.top - c.top + f);
            if (d * -1 >= f) {
                j.addClass("moving");
                k.removeClass("empty");
                g.addClass("empty");
                j.animate({top: d * -1}, 1000);
                setTimeout(function () {
                    j.detach();
                    j.appendTo(k);
                    j.animate({top: 0}, 0);
                    setTimeout(function () {
                        j.removeClass("moving");
                        a.attr("disabled", false);
                        i.isAnimating = false
                    }, 50)
                }, 1000)
            } else {
                k.addClass("noAnimation").removeClass("empty");
                g.addClass("noAnimation").addClass("empty");
                j.detach();
                j.appendTo(k);
                setTimeout(function () {
                    k.removeClass("noAnimation");
                    g.removeClass("noAnimation");
                    a.attr("disabled", false);
                    i.isAnimating = false
                }, 50)
            }
        }
    }
};
Travian.Game.Marketplace = function (a) {
    this.merchantsAvailable = 0;
    this.capacityPerMerchant = 0;
    this.merchantCapacity = 0;
    this.merchantsMax = 0;
    this.initialize = function (b) {
        this.merchantsAvailable = Math.max(b.merchantsAvailable, 0);
        this.capacityPerMerchant = b.capacityPerMerchant;
        this.merchantCapacity = this.merchantsAvailable * this.capacityPerMerchant;
        this.autoCompleter = b.autoCompleter;
        this.merchantsMax = b.merchantsMax;
        this.updateAutoCompleter()
    };
    this.refresh = function (b) {
        this.merchantsAvailable = Math.max(b, 0);
        this.merchantCapacity = this.merchantsAvailable * this.capacityPerMerchant;
        jQuery("#merchantCapacityValue").html(this.merchantCapacity);
        jQuery(".merchantsAvailable").html(this.merchantsAvailable);
        this.visualizeMerchantCapacity()
    };
    this.enableAllLinks = function () {
        var b;
        for (b = 1; b <= 4; b++) {
            linkToUpdate = jQuery("#addRessourcesLink" + b);
            linkToUpdate.removeClass("notClickable");
            linkToUpdate[0].disabled = false
        }
    };
    this.enableAllInputFields = function () {
        var b = 0;
        for (b = 1; b < 5; b++) {
            jQuery("#r" + b).removeClass("disabled");
            jQuery("#r" + b)[0].readOnly = 0
        }
    };
    this.disableAllLinks = function () {
        var b;
        for (b = 1; b <= 4; b++) {
            linkToUpdate = jQuery("#addRessourcesLink" + b);
            linkToUpdate.addClass("notClickable");
            linkToUpdate[0].disabled = true
        }
    };
    this.disableAllInputFields = function () {
        var b = 0;
        for (b = 1; b < 5; b++) {
            jQuery("#r" + b).addClass("disabled");
            jQuery("#r" + b)[0].readOnly = 1
        }
    };
    this.setNotice = function (b) {
        if (b.notice && b.formular) {
            jQuery("#note").html(b.notice);
            jQuery(".destination").html(b.formular);
            this.enableAllLinks();
            this.enableAllInputFields();
            var c = 1;
            for (c = 1; c < 5; c++) {
                jQuery("#r" + c).val("")
            }
            if (b.button) {
                jQuery("#button").html(b.button)
            }
            jQuery(".run_dropdown").removeClass("hide")
        }
    };
    this.setError = function (b) {
        if (b.errorMessage) {
            jQuery("#prepareError").html(b.errorMessage);
            jQuery("#note").html("")
        }
    };
    this.sendRessources = function () {
        var b = this;
        Travian.ajax({
            data: {
                cmd: "prepareMarketplace",
                t: jQuery("#t").val(),
                id: jQuery("#id").val(),
                a: jQuery("#a").val(),
                sz: jQuery("#sz").val(),
                kid: jQuery("#kid").val(),
                c: jQuery("#c").val(),
                x2: jQuery("#x2").length ? jQuery("#x2").first().val() : 1,
                r1: jQuery("#r1").val(),
                r2: jQuery("#r2").val(),
                r3: jQuery("#r3").val(),
                r4: jQuery("#r4").val()
            }, onSuccess: function (c) {
                if (c.errorMessage) {
                    b.setError(c)
                } else {
                    if (c.notice) {
                        jQuery(".run_dropdown").removeClass("hide");
                        jQuery("div .destination").html(c.formular);
                        b.setNotice(c);
                        b.reloadMarketPlace();
                        Travian.TimersAndCounters.initResourcesCounters();
                        b.updateAutoCompleter()
                    }
                }
            }
        })
    };
    this.prepare = function () {
        var d = this;
        var c = 1;
        if (jQuery("#x2").length) {
            var b = jQuery("#x2").first();
            if (b.attr("type") == "checkbox") {
                c = b[0].checked ? 2 : 1
            } else {
                c = b.val()
            }
        }
        Travian.ajax({
            data: {
                cmd: "prepareMarketplace",
                r1: jQuery("#r1").val(),
                r2: jQuery("#r2").val(),
                r3: jQuery("#r3").val(),
                r4: jQuery("#r4").val(),
                dname: jQuery("#enterVillageName").val(),
                x: jQuery("#xCoordInput").val(),
                y: jQuery("#yCoordInput").val(),
                id: jQuery("#id").val(),
                t: jQuery("#t").val(),
                x2: c
            }, onSuccess: function (e) {
                if (e.errorMessage) {
                    d.setError(e)
                } else {
                    if (e.formular) {
                        d.disableAllLinks();
                        d.disableAllInputFields();
                        jQuery(".destination").html(e.formular);
                        jQuery(".run_dropdown").addClass("hide");
                        jQuery("#prepareError").html("");
                        jQuery("#note").html("");
                        jQuery("#r1").focus()
                    }
                }
                if (e.button) {
                    jQuery("#button").html('<div id="prepareError" class="error">' + jQuery("#prepareError").html() + "</div>" + e.button + '<div class="clear"></div>')
                }
                return false
            }
        })
    };
    this.goBack = function () {
        var b = this;
        this.enableAllLinks();
        this.enableAllInputFields();
        Travian.ajax({
            data: {
                cmd: "marketPlaceGoBack",
                kid: jQuery("#kid").val(),
                x2: jQuery("#x2").length ? jQuery("#x2").first().val() : 1,
                dname: jQuery("#dname") ? jQuery("#dname").val() : ""
            }, onSuccess: function (c) {
                jQuery(".destination").html(c.formular);
                jQuery("#button").html('<div id="prepareError" class="error"></div>' + c.button + '<div class="clear"></div>');
                jQuery(".run_dropdown").removeClass("hide");
                b.updateAutoCompleter()
            }
        })
    };
    this.reloadMarketPlace = function () {
        var b = this;
        Travian.ajax({
            data: {cmd: "reloadMarketplace"}, onSuccess: function (c) {
                jQuery("#merchantsOnTheWayFormular").html(c.merchantsOnTheWay);
                Travian.Game.Layout.updateResources(c.storage);
                b.refresh(c.merchantsAvailable)
            }
        })
    };
    this.visualizeMerchantCapacity = function () {
        this.merchantCapacity = this.merchantsAvailable * this.capacityPerMerchant;
        var b = this.summarizeInput();
        this.setSelectedRessourcesInfo(b);
        this.setNotEnoughMerchantsError(b);
        this.updateLinks()
    };
    this.validateAndVisualizeMerchantCapacity = function (b) {
        this.validateResources(b);
        this.visualizeMerchantCapacity()
    };
    this.validateResources = function (e) {
        var c = this.getValue(e);
        var f = this.clipToStorageMaximum(e, c);
        var b = c + f;
        var d = c;
        if (c > b) {
            d = b
        }
        this.setValue(e, d)
    };
    this.validateTradeRouteResources = function (b) {
        var d = Math.max(0, this.getValue(b));
        this.setValue(b, d);
        var g = this.summarizeInput();
        var c = this.merchantsMax * this.capacityPerMerchant;
        var h = {};
        var f = jQuery("#tradeSaveButton");
        var e = jQuery("#tradeRouteError");
        if (g > c) {
            h = {MERCHANTS_NEEDED: Math.ceil(g / this.capacityPerMerchant), MERCHANTS_AVAILABLE: this.merchantsMax};
            e.addClass("error").html(Travian.Helpers.substitute(Travian.Translation.translate("{notEnoughMerchants}"), h, /\\?\[([^\[\]]+)\]/g));
            f.addClass("disabled").attr("disabled", true)
        } else {
            e.removeClass("error").html("");
            f.removeClass("disabled").attr("disabled", false)
        }
    };
    this.validateTradeRouteResourcesSanity = function () {
        for (var b = 1; b <= 4; b++) {
            var c = Math.max(0, this.getValue(b));
            this.setValue(b, c)
        }
        var d = this.summarizeInput();
        if (d == 0) {
            jQuery("#tradeRouteError").addClass("error").html(Travian.Translation.translate("{resourcesNumberInvalid}"));
            return false
        }
        return true
    };
    this.validateTradeRouteSendTime = function () {
        var c = jQuery("#tradeSaveButton");
        var b = jQuery("#tradeRouteError");
        if (!this.validateTradeRouteSendTimeSanity()) {
            b.addClass("error").html(Travian.Translation.translate("{invalidTimeFormat}"));
            c.addClass("disabled").attr("disabled", true);
            return false
        }
        b.removeClass("error").html("");
        c.removeClass("disabled").attr("disabled", false);
        return true
    };
    this.validateTradeRouteSendTimeSanity = function () {
        var e = false;
        var c = jQuery("#tradeRouteEdit").find(".timeSelector");
        var d = jQuery("#tradeRouteError");
        var b = c.find("input[name=hour]");
        var f = c.find("input[name=minute]");
        if (b.length === 0 && f.length === 0) {
            e = false
        } else {
            b = b.val();
            f = f.val();
            e = (jQuery.isNumeric(b) && b >= 0 && b <= 23) && (jQuery.isNumeric(f) && f >= 0 && f <= 59)
        }
        !e && d.addClass("error").html(Travian.Translation.translate("{invalidTimeFormat}"));
        return e
    };
    this.furtherMerchantsAvailable = function () {
        return ((this.merchantCapacity - this.summarizeInput()) >= 0)
    };
    this.updateLinks = function () {
        var b;
        for (b = 1; b <= 4; b++) {
            jQuery("#addRessourcesLink" + b).toggleClass("notClickable", (this.getValueToAddToRessources(b) == 0))
        }
    };
    this.addRessources = function (d) {
        if (jQuery("#addRessourcesLink" + d)[0].disabled) {
            return
        }
        var c = this.getValueToAddToRessources(d);
        var b = this.getValue(d);
        if (c != 0) {
            this.setValue(d, c + b)
        }
        this.visualizeMerchantCapacity()
    };
    this.getValueToAddToRessources = function (e) {
        var b = 0;
        var d = this.summarizeInput();
        var c = this.merchantCapacity - d;
        if (c > 0) {
            if (c < this.capacityPerMerchant) {
                b = c
            } else {
                if (c >= this.capacityPerMerchant) {
                    b = this.capacityPerMerchant
                }
            }
        } else {
            if (c == 0) {
                b = 0
            } else {
                b = c
            }
        }
        b = this.clipToStorageMaximum(e, b);
        return b
    };
    this.clipToStorageMaximum = function (e, c) {
        var d = this.getStorageFor(e);
        var b = this.getValue(e);
        if (c > 0) {
            c = Math.min(c, (d - b))
        } else {
            if ((b + c) > d) {
                c = d - b
            }
        }
        return c
    };
    this.getStorageFor = function (b) {
        var c = "l" + (b);
        return window.resources.storage[c]
    };
    this.setValue = function (c, b) {
        var d = parseInt(b);
        if (!isNaN(d)) {
            jQuery("#r" + c).val(Math.max(d, 0))
        }
    };
    this.setSelectedRessourcesInfo = function (b) {
        jQuery("#sumResources").toggleClass("notEnoughMerchants", (b > this.merchantCapacity)).html(b)
    };
    this.setNotEnoughMerchantsError = function (d) {
        var g = {};
        var e = this.getNeededMerchants(d);
        var f = jQuery("#prepareError");
        var c = null;
        jQuery("#merchantsNeededNumber").html(e);
        if (jQuery(".prepare").length > 0) {
            c = jQuery(".prepare").first()
        }
        if (e > this.merchantsAvailable) {
            g = {MERCHANTS_NEEDED: e, MERCHANTS_AVAILABLE: this.merchantsAvailable};
            f.addClass("error").html(Travian.Helpers.substitute(Travian.Translation.translate("{notEnoughMerchants}"), g, /\\?\[([^\[\]]+)\]/g));
            c.addClass("disabled").attr("disabled", true);
            jQuery("#note").html("");
            jQuery("#merchantsNeeded").addClass("error");
            jQuery(".merchantCapacity").addClass("error");
            jQuery("#sumResources").addClass("error")
        } else {
            jQuery("#merchantsNeeded").removeClass("error");
            jQuery(".merchantCapacity").removeClass("error");
            jQuery("#sumResources").removeClass("error");
            if (f.length > 0) {
                f.html("")
            } else {
                var b = jQuery("#button").html();
                jQuery("#button").html('<div id="prepareError" class="error"></div>' + b + '<div class="clear"></div>')
            }
            c.removeClass("disabled").attr("disabled", false)
        }
    };
    this.getNeededMerchants = function (b) {
        return Math.ceil(b / this.capacityPerMerchant)
    };
    this.getValue = function (c) {
        var b = parseInt(jQuery("#r" + c).val());
        if (!isNaN(b)) {
            return b
        }
        return 0
    };
    this.summarizeInput = function () {
        var c = 0;
        for (var b = 1; b <= 4; b++) {
            c += this.getValue(b)
        }
        return c
    };
    this.updateAutoCompleter = function () {
        var b = jQuery("#enterVillageName");
        if (this.autoCompleter && b.length > 0) {
            new Travian.Game.AutoCompleter.VillageName(b)
        }
        return this
    };
    this.initialize(a)
};
Travian.Game.Marketplace.getPreferences = function () {
    var c = Travian.Game.Preferences.get("tradeRoutesOrder");
    var b, a;
    if (c != null) {
        b = c.charAt(0);
        a = c.charAt(1)
    } else {
        b = "2";
        a = "a"
    }
    return {sortingColumn: b, sortingOrder: a}
};
Travian.Game.Marketplace.toggleSorting = function (c) {
    var b = Travian.Game.Marketplace.getPreferences();
    var a;
    if (c == b.sortingColumn) {
        a = b.sortingColumn + (b.sortingOrder == "a" ? "d" : "a")
    } else {
        a = c + "a"
    }
    Travian.Game.Preferences.set("tradeRoutesOrder", a)
};
Travian.Game.Marketplace.toggleTradeRoutes = function (c, b) {
    var a = b.checked ? 1 : 0;
    Travian.ajax({data: {cmd: "toggleTradeRoutes", routeId: c, enabled: a}});
    return false
};
Travian.Game.Marketplace.updateVillageListLinks = function (b) {
    var d = ["dname", "x", "y"];
    var c = jQuery(b).serializeArray().reduce(function (f, e) {
        f[e.name] = encodeURIComponent(e.value);
        return f
    }, {});
    var a = jQuery("#sidebarBoxVillagelist");
    a.find("li").each(function (f, h) {
        var e = jQuery(h).find("a");
        var j = Travian.parseURL(e.attr("href"));
        for (var g = 0; g < d.length; g++) {
            if (c[d[g]] !== undefined) {
                j.searchObject[d[g]] = c[d[g]]
            }
        }
        e.attr("href", Travian.composeURL(j))
    })
};
Travian.Game.Marketplace.onLoad = function () {
    var a = Travian.Game.Marketplace.getPreferences();
    jQuery("a.sorting#sorting" + a.sortingColumn).addClass(a.sortingOrder == "a" ? "asc" : "desc")
};
Travian.Game.Marketplace.constructor = Travian.Game.Marketplace;
Travian.Game.Marketplace.ExchangeResources = function (a) {
    var b = a;
    this.calculateRest = function () {
        var f = b.find('span[id^="org"]');
        var g = b.find("span#sum").html();
        var c = b.find('input[name^="desired"]');
        var e = b.find('span[id^="diff"]');
        var d = 0;
        c.each(function (i, h) {
            var k = parseInt(h.value || 0);
            var j = k - parseInt(f[i].innerHTML);
            e[i].innerHTML = j > 0 ? "+" + j : j;
            d += k
        });
        jQuery("#newsum").text(d);
        jQuery("#remain").text(g - d);
        this.testSum()
    };
    this.fillup = function (c) {
        jQuery('input[name="desired[' + c + ']"]').val(resources.maxStorage["l" + (c + 1)] || 0);
        this.calculateRest()
    };
    this.testSum = function () {
        if (document.getElementById("remain").innerHTML !== "0") {
            document.getElementById("submitText").style.display = "block";
            document.getElementById("submitButton").style.display = "none"
        } else {
            document.getElementById("submitText").style.display = "none";
            document.getElementById("submitButton").style.display = "block"
        }
        Travian.adjustButtonDisableState()
    };
    this.distribute = function (e) {
        var d = [];
        var g = b.find('span[id^="org"]');
        var c = b.find('input[name^="desired"]');
        var h = b.find("span#sum");
        c.each(function (i, j) {
            d[i] = j.value
        });
        var f = this;
        Travian.ajax({
            data: {cmd: "exchangeResources", did: e, desired: d}, onSuccess: function (i) {
                c.each(function (k, j) {
                    g[k].innerHTML = i.resources[k];
                    j.value = i.distributed[k]
                });
                h.html(i.resources.reduce(function (k, j) {
                    return k + j
                }, 0));
                f.calculateRest()
            }, onError: function (i, j) {
                (new Travian.Dialog.Dialog()).setContent(j).show()
            }
        });
        return false
    };
    this.calculateRest()
};
Travian.Game.RallyPoint = {
    initialize: function (a) {
        a.find("input[type=text]").each(function (b, c) {
            c = jQuery(c);
            c.on({
                keydown: function (d) {
                    var e = d.keyCode, g = d.ctrlKey, f = d.metaKey;
                    if (e === 8 || e === 46 || (e === 65 && (g === true || f === true)) || (e === 67 && (g === true || f === true)) || (e === 88 && (g === true || f === true)) || (e === 86 && (g === true || f === true)) || (e >= 35 && e <= 39) || (e === 9) || (e === 13)) {
                        return true
                    }
                    if (!(((e >= 48 && e <= 57) || (e >= 96 && e <= 105)))) {
                        d.preventDefault()
                    }
                }, input: function (e) {
                    var d = parseInt(c.val().replace(/^0+/, "")) || 0;
                    if (isNaN(d) || d === 0 || d < 0) {
                        d = ""
                    }
                    c.val(d)
                }
            })
        })
    }
};
Travian.AttackSymbol = {
    markAttackSymbol: function (d) {
        var a = jQuery("img#markSymbol_" + d);
        var b = a.prop("class");
        var c = parseInt(b.replace(/[^0-9]/gi, "")) || 0;
        c = (c + 1) % 4;
        a.removeClass().addClass("markAttack markAttack" + c);
        Travian.ajax({data: {cmd: "markIncomingAttacks", data: {id: d, state: c}}})
    }
};
Travian.Game.RallyPoint.CoordinatesInputHelper = function (a) {
    this.options = Object.assign({
        coordinateXInputId: "xCoordInput",
        coordinateYInputId: "yCoordInput",
        allowedPattern: /^([0-9\-\.,]+)\|([0-9\-\.,]+)$/
    }, a)
};
Travian.Game.RallyPoint.CoordinatesInputHelper.prototype.insertCoordinates = function (b) {
    var d = b.clipboardData || window.clipboardData,
        a = d.getData("text/plain").replace(/[\u202D\u202C\u202E]/g, "").replace(/−/g, "-").replace(/[^0-9\-\|]/g, "");
    var c = a.match(this.options.allowedPattern);
    b.preventDefault();
    if (c !== null) {
        jQuery("#" + this.options.coordinateXInputId).val(c[1]);
        jQuery("#" + this.options.coordinateYInputId).val(c[2]).focus()
    } else {
        jQuery(b.target).val(a.replace(/[^0-9\-]/g, ""))
    }
};
Travian.Game.AllianceMembers = function (a) {
    this.options = Object.assign({data: {}, saveOnUnload: false}, a);
    this.initialize = function () {
        Travian.Dialog.Ajax.call(this, this.options)
    };
    this.request = function () {
        var b = this;
        Travian.ajax({
            data: this.options.data, onSuccess: function (c) {
                if (c.close || c.html === "") {
                    b.close();
                    Travian.WindowManager.closeAllWindows();
                    window.location.reload()
                } else {
                    b.setContent(c.html).setTitle(c.title).setInfoIcon(c.infoIcon).updateCssClass(c.cssClass);
                    b.show()
                }
            }, onFailure: function (d, c) {
                jQuery("#playerNotePopupError").innerHTML = c
            }
        });
        return this
    };
    this.isAjax = function () {
        return true
    };
    this.reload = function () {
        this.request()
    };
    this.initialize()
};
Travian.Game.AllianceMembers.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.AllianceMembers.constructor = Travian.Game.AllianceMembers;
Travian.Game.AllianceDonation = {
    dialog: null, bonusSelected: false, getDonationParams: function (a) {
        this.calculateSum(a);
        return {
            bid: jQuery("#bid").val(),
            did: jQuery("#did").val(),
            r1: jQuery("#" + a + "1").val(),
            r2: jQuery("#" + a + "2").val(),
            r3: jQuery("#" + a + "3").val(),
            r4: jQuery("#" + a + "4").val(),
            amount: this.toNaturalNumber(jQuery("#" + a + "Sum").html())
        }
    }, wasGoldUsed: function (a) {
        return ["donate_gold", "donate_gold_confirm"].indexOf(a) !== -1
    }, calculateSum: function (a) {
        var c = 0;
        for (var b = 1; b <= 4; b++) {
            c += this.toNaturalNumber(jQuery("#" + a + b).val())
        }
        jQuery("#" + a + "Sum").html(c.toString());
        this.checkAndChangeScalingPopup(a, c);
        this.checkButtonState(a)
    }, updateBID: function (a) {
        jQuery("#bid").val(a)
    }, checkButtonState: function (b) {
        var g = this;
        var c = jQuery("#" + b + "Sum").html() != 0;
        var f = false;
        var h = document.getElementsByName("bonus");
        for (var e = 0; e < h.length; e++) {
            if (h[e].checked) {
                f = true;
                jQuery("#bonusNotSelectedMessage").hide();
                this.updateBID(jQuery(h[e]).val());
                break
            }
        }
        var j = jQuery("#limitReached").val() == 1;
        var d = c && f && !j;
        if (!f) {
            this.updateBID(null)
        }
        g.bonusSelected = f;
        if (jQuery("#gold").val() == 1) {
            var a = jQuery("#canTriple").val() != 0;
            if (d && a) {
                jQuery("#donate_gold").removeClass("disabled")
            } else {
                jQuery("#donate_gold").addClass("disabled")
            }
        }
        if (d) {
            jQuery("#donate_green").removeClass("disabled")
        } else {
            jQuery("#donate_green").addClass("disabled")
        }
    }, fillUp: function (b, c, a) {
        if (b.disabled !== true) {
            c = Math.max(c, 0);
            jQuery(b).val(c);
            this.checkAndChange(b, c, a)
        }
    }, checkAndChange: function (c, d, a) {
        c = jQuery(c);
        var b = Math.min(this.toNaturalNumber(c.val()), d);
        if (c.val() !== b.toString()) {
            c.val(b)
        }
        this.calculateSum(a)
    }, toNaturalNumber: function (a) {
        a = parseInt(a);
        if (isNaN(a)) {
            a = 0
        }
        if (a < 0) {
            a = 0
        }
        return a
    }, donate: function (b, d, c) {
        var a = jQuery("#donate_gold_confirm");
        if (d !== "donate_gold") {
            jQuery("#contributeButtons").find("button").addClass("disabled");
            if (a.length > 0) {
                if (a.hasClass("disabled")) {
                    return
                } else {
                    a.off("click").addClass("disabled")
                }
            }
        }
        jQuery(".bonus-donation-response").removeClass("visible");
        Travian.ajax({
            data: {cmd: "donateResources", params: c, action: d}, onSuccess: function (e) {
                if (e.html !== "") {
                    Travian.Game.AllianceDonation.showDialog(e.html)
                } else {
                    Travian.Game.AllianceDonation.closeDialog()
                }
                var g = Travian.Game.AllianceDonation.wasGoldUsed(d);
                var f = Travian.Game.AllianceDonation.getResourceAnimationSpeed(c.amount, g);
                if (e.newTotal > 0) {
                    Travian.Game.AllianceDonation.refreshDailyDonation(e.newTotal, d, c.amount, g);
                    Travian.Game.AllianceDonation.refreshProgressBarTitle(e.limit - e.newTotal)
                }
                if (e.reload === true) {
                    Travian.Game.AllianceDonation.countDownResources(c.amount, false);
                    setTimeout(function () {
                        Travian.Game.AllianceDonation.refreshDonationForm(e.limitReached);
                        jQuery(".bonus-donation-response").html(e.responseText);
                        Travian.Game.AllianceDonation.refreshAllianceBonusOverview()
                    }, f)
                }
                if (e.goldChanged === true) {
                    Travian.Game.Layout.updateGold()
                }
                if (e.resourcesChanged === true) {
                    Travian.Game.Layout.updateResources()
                }
            }, onFailure: function (e) {
                Travian.Game.AllianceDonation.checkButtonState("donate");
                Travian.Game.AllianceDonation.showErrorDialog(e.responseText);
                return false
            }
        })
    }, closeDialog: function () {
        if (this.dialog !== null) {
            this.dialog.close()
        }
    }, showDialog: function (a) {
        var b = this;
        this.closeDialog();
        this.dialog = new Travian.Dialog.Dialog({
            buttonOk: false,
            type: Travian.Dialog.Dialog.DIALOG_TYPE_MODAL,
            onClose: function () {
                b.checkButtonState("donate")
            }
        });
        this.dialog.setContent(a);
        this.dialog.show()
    }, showErrorDialog: function (a) {
        var c = this;
        var b = new Travian.Dialog.Dialog({
            buttonOk: true,
            type: Travian.Dialog.DIALOG_TYPE_MODAL,
            onClose: function () {
                c.closeDialog();
                c.refreshDonationForm(true);
                c.refreshDonationLimitBar();
                c.refreshAllianceBonusOverview()
            }
        });
        b.setContent(a);
        b.show()
    }, showScaleDown: function (b) {
        var a = document.getElementById(b).innerHTML;
        this.showDialog(a);
        this.scaleDown("scale")
    }, scaleDown: function (a) {
        var d = parseInt(jQuery("#leftResources").val());
        var f = parseInt(jQuery("#multiplicationFactor").val());
        d = parseInt(d / f);
        var g = 0;
        var c = new Array(5);
        var h = new Array(5);
        for (var e = 1; e <= 4; e++) {
            h[e] = this.toNaturalNumber(jQuery("#" + a + e).val());
            c[e] = h[e];
            g += c[e]
        }
        if (g === 0) {
            this.closeDialog()
        }
        if (d >= g) {
            this.closeDialog()
        }
        var j = d / g;
        g = 0;
        for (e = 1; e <= 4; e++) {
            if (c[e] > 0) {
                c[e] = Math.floor(c[e] * j);
                g += c[e]
            }
        }
        var b = d - g;
        while (b > 0) {
            for (e = 1; e <= 4 && b > 0; e++) {
                if (h[e] > 0) {
                    c[e]++;
                    b--
                }
            }
        }
        for (e = 1; e <= 4; e++) {
            jQuery("#" + a + e).val(c[e]);
            jQuery("#donate" + e).val(c[e])
        }
        jQuery("#" + a + "Sum").html(d.toString());
        jQuery("#donateSum").html(d.toString());
        this.checkAndChangeScalingPopup(a, d);
        setTimeout(function () {
            Travian.Game.AllianceDonation.changeScaleButton(true)
        }, 250)
    }, checkAndChangeScalingPopup: function (b, a) {
        var e = jQuery("#" + b + "SumMultiplied");
        var d = a;
        if (e.length > 0) {
            d = this.toNaturalNumber(e[0].dataset.multiplicator) * a;
            e.html(d.toString())
        }
        if (b === "scale") {
            var c = this.toNaturalNumber(jQuery("#resourcesUntilLimit")[0].dataset.limit);
            this.changeScaleButton((c >= d))
        }
    }, changeScaleButton: function (a) {
        if (a) {
            jQuery("#buttonScale").hide();
            jQuery("#scale").addClass("disabled");
            jQuery(".bonus-scaleDown").addClass("scaled");
            jQuery("#buttonDonate").show()
        } else {
            jQuery("#buttonDonate").hide();
            jQuery("#scale").removeClass("disabled");
            jQuery(".bonus-scaleDown").removeClass("scaled");
            jQuery("#buttonScale").show()
        }
    }, donateScaled: function (c, a) {
        var b = this.getDonationParams(a);
        this.closeDialog();
        this.donate(a, c.id, b)
    }, refreshGoldConfirmation: function () {
        var a = jQuery("#donate_gold");
        a.addClass("disabled");
        var b = Travian.Game.AllianceDonation.getDonationParams("donate");
        Travian.Game.AllianceDonation.donate("donate", a.id, b)
    }, refreshDonationForm: function (c) {
        var a = jQuery("#contributionForm"), b = this;
        if (!a) {
            return
        }
        setTimeout(function () {
            jQuery("#contributionForm").find("input:checked").prop("checked", false)
        }, 100);
        Travian.ajax({
            data: {cmd: "donationForm"}, onSuccess: function (d) {
                a.html(d.form);
                jQuery(window).trigger("domAltered", jQuery("#contributionForm"));
                if (c) {
                    Travian.TimersAndCounters.init()
                }
                jQuery(".bonus-donation-response").addClass("visible");
                b.initBonusIcons();
                Travian.Tip.refresh();
                b.bonusSelected = false;
                b.initContributeDisabledAction()
            }
        })
    }, refreshDonationLimitBar: function () {
        var a = jQuery("#myDailyContributionLimit");
        if (!a) {
            return
        }
        a.addClass("hidden");
        Travian.ajax({
            data: {cmd: "donationLimitBar"}, onSuccess: function (b) {
                a.html(b.limitBar);
                jQuery(window).trigger("domAltered", jQuery("#myDailyContributionLimit"));
                Travian.Tip.refresh();
                a.removeClass("hidden")
            }
        })
    }, refreshAllianceBonusOverview: function () {
        var a = jQuery("#allianceBonusOverview"), b = this;
        if (!a) {
            return
        }
        Travian.ajax({
            data: {cmd: "allianceBonusOverview"}, onSuccess: function (c) {
                a.html(c.overview);
                b.initBonusOverview();
                Travian.Tip.refresh()
            }
        })
    }, refreshDailyDonation: function (f, a, h, l) {
        var m = jQuery("#donatedToday");
        var e = jQuery("#dailyContributionTitleText");
        var q = jQuery(".donationValueNumber");
        var i = jQuery(".donationMaxNumber");
        var k = jQuery("#dailyContributionTitleArrow");
        var j = parseInt(m.val());
        var p = parseInt(jQuery("#dailyLimit").val());
        var b = Math.min(100, ((f / p) * 100));
        var o = "lightGreen";
        if (a === "donate_gold" || a === "donate_gold_confirm") {
            o = "gold"
        }
        k.addClass(o);
        var r = this.getResourceAnimationSpeed(h, l);
        var s = 20;
        h = l ? h * 3 : h;
        var c = Math.round(h / s);
        var g = r / s;
        k.css({transition: "width " + r + "ms, opacity 500ms", width: b.toString() + "%"});
        var n = 1;
        var d = setInterval(function () {
            j = j + c;
            if (j < f) {
                q.html(j);
                i.html(p)
            }
            if (n === s) {
                q.html(f);
                i.html(p);
                k.removeClass(o);
                clearInterval(d)
            }
            n++
        }, g);
        if (b === 100) {
            jQuery(".bonus-donation-response").addClass("white");
            k.css({width: "100%"});
            jQuery("#limitReached").val(1);
            setTimeout(function () {
                k.addClass("complete");
                e.addClass("complete").removeClass("white");
                jQuery(".bonus-donation-response").addClass("complete")
            }, r + 500)
        }
        m.val(f)
    }, countDownResources: function (g, c) {
        var b = this.getResourceAnimationSpeed(g, c);
        var h = 20;
        var d = [];
        var f = [];
        jQuery("#contributeButtons").find("button").addClass("disabled");
        var e = 0;
        jQuery(".resourceInput input").each(function (l, k) {
            var m = parseInt(jQuery(k).val());
            d[e] = m;
            var i = m / h;
            if (i < 1) {
                i = 1
            }
            f[e] = i;
            e++
        });
        var a = 1;
        var j = setInterval(function () {
            for (var k = 0; k < d.length; k++) {
                var m = d[k] - f[k];
                if (m > 0) {
                    d[k] = m;
                    jQuery(jQuery(".resourceInput input")[k]).val(parseInt(m))
                }
            }
            if (a === h) {
                for (var l = 0; l < d.length; l++) {
                    jQuery(jQuery(".resourceInput input")[l]).val(0)
                }
                clearInterval(j)
            }
            a++
        }, b / h)
    }, getResourceAnimationSpeed: function (f, a) {
        var e = 500;
        var b = 2000;
        if (a) {
            f = f * 3
        }
        var c = parseInt(jQuery("#dailyLimit").val());
        var d = e + f * (b - e) / c;
        d = Math.max(e, Math.min(b, d));
        return d
    }, initBonusIcons: function () {
        var a = jQuery("#contributionBox").find("#bonusSelection .bonusButtonRound");
        a.off("click");
        a.on("click", function (c) {
            c.preventDefault();
            var b = jQuery("#bonusBox" + jQuery(this).attr("data-index"));
            if (b.find(".bonusInfo").hasClass("hide")) {
                b.find("button").trigger("click")
            }
            jQuery("html, body").animate({scrollTop: b.offset().top}, 250)
        })
    }, initBonusOverview: function () {
        var a = jQuery(".bonusCollapse");
        var b;
        try {
            b = JSON.decode(Travian.Game.Preferences.get("allianceBonusesOverview") || "{}")
        } catch (d) {
            b = {}
        }
        var c = function () {
            a.each(function (f, e) {
                var i = jQuery(e).attr("ref");
                var g = jQuery(e).children("img.openedClosedSwitch");
                if (i.length > 0 && g.length > 0) {
                    var h = jQuery(".bonusInfo." + i);
                    b[i] = !Travian.isToggleClosed(h[0], g[0])
                }
            });
            Travian.Game.Preferences.set("allianceBonusesOverview", JSON.stringify(b))
        };
        if (a.length > 0) {
            a.each(function (f, e) {
                jQuery(e).on("click", function (j) {
                    var i = jQuery(this).attr("ref");
                    var g = jQuery(this).children("img.openedClosedSwitch");
                    if (i.length > 0 && g.length > 0) {
                        var h = jQuery(".bonusInfo." + i);
                        Travian.toggleSwitch(h[0], g[0]);
                        c()
                    }
                })
            })
        }
    }, playLevelUpRewardAnimation: function (f, b, c, a) {
        Travian.Game.Layout.toggleBackgroundOverlay();
        var d = jQuery("#backgroundOverlay");
        var e = jQuery("#bonusLevelUpRewardTemplate").html();
        d.prepend(e);
        d.find(".bonusLevelUpReward .bonusRepresentation > div").addClass(f);
        d.find(".bonusLevelUpReward .banner .description p:first-of-type").html(c);
        d.find(".bonusLevelUpReward .banner .description p:last-of-type").html(a);
        setTimeout(function () {
            d.find(".stoneDisplay").addClass("visible");
            d.find(".stoneDisplayHeader").addClass("visible");
            d.find(".banner").addClass("visible");
            d.find(".swords").addClass("visible").addClass("locked");
            setTimeout(function () {
                d.find(".bonusRepresentation .stage1").addClass("visible");
                setTimeout(function () {
                    d.find(".bonusRepresentation .glow").addClass("visible");
                    setTimeout(function () {
                        d.find(".bonusRepresentation .stage2").addClass("visible");
                        setTimeout(function () {
                            d.find(".bonusRepresentation .stage1").removeClass("visible");
                            d.find(".bonusRepresentation .glow").removeClass("visible");
                            d.find(".banner").addClass("enlarged");
                            setTimeout(function () {
                                d.find(".stoneDisplayHeader .level1 .glow").addClass("visible");
                                d.find(".stoneDisplayHeader .level1 .star").addClass("visible");
                                setTimeout(function () {
                                    d.find(".stoneDisplayHeader .level1 .glow").removeClass("visible")
                                }, 150);
                                if (b >= 2) {
                                    setTimeout(function () {
                                        d.find(".stoneDisplayHeader .level2 .glow").addClass("visible");
                                        d.find(".stoneDisplayHeader .level2 .star").addClass("visible");
                                        setTimeout(function () {
                                            d.find(".stoneDisplayHeader .level2 .glow").removeClass("visible")
                                        }, 150);
                                        if (b >= 3) {
                                            setTimeout(function () {
                                                d.find(".stoneDisplayHeader .level3 .glow").addClass("visible");
                                                d.find(".stoneDisplayHeader .level3 .star").addClass("visible");
                                                setTimeout(function () {
                                                    d.find(".stoneDisplayHeader .level3 .glow").removeClass("visible")
                                                }, 250);
                                                if (b >= 4) {
                                                    setTimeout(function () {
                                                        d.find(".stoneDisplayHeader .level4 .glow").addClass("visible");
                                                        d.find(".stoneDisplayHeader .level4 .star").addClass("visible");
                                                        setTimeout(function () {
                                                            d.find(".stoneDisplayHeader .level4 .glow").removeClass("visible")
                                                        }, 250);
                                                        if (b >= 5) {
                                                            setTimeout(function () {
                                                                d.find(".stoneDisplayHeader .level5 .glow").addClass("visible");
                                                                d.find(".stoneDisplayHeader .level5 .star").addClass("visible");
                                                                setTimeout(function () {
                                                                    d.find(".stoneDisplayHeader .level5 .glow").removeClass("visible")
                                                                }, 250)
                                                            }, 500)
                                                        }
                                                    }, 500)
                                                }
                                            }, 500)
                                        }
                                    }, 500)
                                }
                                setTimeout(function () {
                                    d.find(".bonusRepresentation .glow").addClass("step2 visible");
                                    setTimeout(function () {
                                        d.find(".bonusRepresentation .glow").removeClass("visible");
                                        d.find(".banner").removeClass("enlarged");
                                        d.find(".bonusLevelUpReward").addClass("faded");
                                        setTimeout(function () {
                                            Travian.Game.Layout.toggleBackgroundOverlay()
                                        }, 750)
                                    }, 750)
                                }, (2800 - (5 - b) * 500))
                            }, 1250)
                        }, 100)
                    }, 300)
                }, 800)
            }, 750)
        }, 250)
    }, refreshProgressBarTitle: function (c) {
        var a = jQuery("div.progressBarDailyLimit");
        var b = a.attr("data-tooltip").match(/(^.*)(\[AMOUNT\])(.*$)/);
        a.title = b[1] + c + b[3];
        Travian.Tip.refresh()
    }, initContributeDisabledAction: function () {
        var a = this;
        jQuery("#contributeButtons").find("button").on("click", function () {
            a.calculateSum("donate");
            if (!a.bonusSelected && parseInt(jQuery("#donateSum").html()) > 0) {
                jQuery("#bonusNotSelectedMessage").show()
            }
        })
    }
};
Travian.Game.AllianceLeave = function (a) {
    this.options = Object.assign({data: {}, saveOnUnload: false}, a);
    this.initialize = function () {
        Travian.Dialog.Ajax.call(this, this.options)
    };
    this.isAjax = function () {
        return true
    };
    this.reload = function () {
        this.request()
    };
    this.initialize()
};
Travian.Game.AllianceLeave.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.AllianceLeave.constructor = Travian.Game.AllianceLeave;
Travian.Game.PaymentWizard = function (a) {
    var b = this;
    this.options = Travian.Helpers.deepmergeObject({
        data: {
            cmd: "paymentWizard",
            goldProductId: "",
            goldProductLocation: "",
            location: "",
            activeTab: "buyGold",
            formData: {}
        },
        keepOpen: true,
        buttonCancel: true,
        buttonOk: false,
        context: "paymentWizard",
        cssClass: "brown",
        draggable: false,
        infoIcon: true,
        saveOnUnload: false,
        scroll: false,
        type: this.DIALOG_TYPE_MODAL,
        topHeaderOffset: 45,
        preview: {
            enabled: true,
            contentElement: "paymentWizardV2ContentPreview",
            title: "",
            infoIcon: "",
            dialogCSSClass: "brown",
            resultCached: false,
            onShow: function (c) {
                if (typeof c.options.preview.resultCached !== "undefined" && c.options.preview.resultCached === true) {
                    c.setContent(document.getElementById(c.options.preview.contentElement).html());
                    document.getElementById(c.options.preview.contentElement).set("html", "");
                    jQuery(window).trigger("shopUIV2RestorePreview");
                    c.reload()
                } else {
                    c.reload();
                    document.getElementById(c.options.preview.contentElement).html("")
                }
            }
        },
        darkOverlay: true,
        overlayCancel: false,
        resizeDialogIfOverflow: false,
        useCallback: false,
        callback: Travian.emptyFunction(),
        callbackScope: null,
        onClose: function (d) {
            Travian.Game.PaymentWizardEventListener.PaymentWizardObject = null;
            if (b.options.useCallback === true && typeof b.options.callback === "function") {
                b.options.callback({scope: b.options.callbackScope})
            }
            jQuery(window).trigger("paymentWizardOnCloseEvent");
            Travian.Game.Layout.updateGold(b.options.callback);
            if (b.options.data.activeTab === "buyGold" && b.options.preview.enabled) {
                var c = document.getElementById("#dialogContent").html();
                document.getElementById(b.options.preview.contentElement).html(c);
                Travian.Game.PaymentWizardEventListener.preview.resultCached = true
            }
        }
    }, a);
    this.initialize = function () {
        var e = this;
        var d = function (g) {
            var f = jQuery(g.target).parent(".tabButton").attr("class").split(" ");
            if (f[1] === "pros") {
                e.options.callback = null
            }
            e.options.data.activeTab = f[1];
            e.reload();
            g.stopPropagation();
            return false
        };
        var c = e.options.onOpen;
        e.options.onOpen = function () {
            var f = jQuery("#paymentWizard");
            f.find(".header .tabButton").each(function (g, h) {
                h = jQuery(h);
                h.off("click");
                h.on("click", d)
            }, this);
            if (f.length > 0) {
                f.find(".iconButton.info").attr("title", Travian.Translation.get("paymentWizard.infoButtonLabel"));
                e.updateInfoButton({
                    buttonTextInfo: Travian.Translation.get("paymentWizard.infoButtonLabel"),
                    infoIcon: function () {
                        window.open(f.find(".paymentWizardAnswersLink").val())
                    }
                })
            }
            if (e.options.data.activeTab === "buyGold" || e.options.data.activeTab === "") {
                e.initializeBuyGoldTab()
            } else {
                if (e.options.data.activeTab === "pros") {
                    e.initializeProsTab()
                } else {
                    if (e.options.data.activeTab === "earnGold") {
                        e.initializeEarnGoldTab()
                    }
                }
            }
            if (c && (typeof c === "function")) {
                c()
            }
        };
        Travian.Dialog.Ajax.call(this, e.options);
        return this
    };
    this.initializeBuyGoldTab = function () {
        var l = this;
        var h = jQuery("#paymentWizard");
        var d = h.find(".contentWrapper .infoArea");
        var i = h.find(".contentWrapper .contentArea");
        var k = function (o, p) {
            if (!o.hasClass(p)) {
                o = o.parent("." + p)
            }
            return o
        };
        var e = function (p) {
            var o = d.find(".buyGoldLocation")[0];
            l.options.data.goldProductLocation = o.options[o.selectedIndex].value;
            l.options.data.goldProductId = "";
            l.reload();
            p.stopPropagation();
            return false
        };
        var c = function (o) {
            d.find(".buyGoldInfoStep.locationStep").each(function (p) {
                p.fadeOut()
            });
            d.find(".buyGoldInfoStep.locationStep.buyGoldFormStep").fadeIn();
            o.stopPropagation();
            return false
        };
        var g = function (o) {
            l.options.data.goldProductId = "";
            l.reload();
            o.stopPropagation();
            return false
        };
        var f = function (p) {
            var o = k(jQuery(p.target), "goldProduct");
            if (o != null) {
                var q = o.find(".goldProductId").attr("data-voucher");
                if (q) {
                    voucherPopup();
                    p.stopPropagation();
                    return false
                }
                l.options.data.goldProductId = o.find(".goldProductId").val();
                l.reload()
            }
            p.stopPropagation();
            return false
        };
        var n = function (r) {
            var p = k(jQuery(r.target), "providerLink");
            if (p != null) {
                var s, t;
                var o = p.find(".providerId").val();
                try {
                    s = p.find(".popupWidth").val()
                } catch (q) {
                    s = 800
                }
                try {
                    t = p.find(".popupHeight").val()
                } catch (q) {
                    t = 600
                }
                l.options.useCallback = true;
                l.openProvider(l.options.data.goldProductId, o, s, t)
            }
            r.stopPropagation();
            return false
        };
        var m = function (q) {
            if (!l.DoubleClickPreventer) {
                l.DoubleClickPreventer = new Travian.DoubleClickPreventer();
                l.DoubleClickPreventer.timeout = 2000
            }
            if (!l.DoubleClickPreventer.check()) {
                q.stopPropagation();
                return false
            }
            var r = i.find(".paymentOpenOffersResult")[0];
            if (r) {
                r.destroy()
            }
            var p = jQuery(q.target);
            p.hide();
            var o = p.parent(".footerItem");
            if (p.hasClass("ordersHide") === true) {
                o.find(".ordersShow").fadeIn();
                i.find(".buyGoldContent").fadeOut();
                i.find(".openOffers").fadeOut();
                q.stopPropagation();
                return false
            }
            o.down(".ordersHide").fadeIn();
            i.down(".buyGoldContent").fadeOut();
            i.down(".openOffers").fadeIn();
            Travian.ajax({
                data: {cmd: "paymentWizardOpenOffers"}, onSuccess: function (t) {
                    var s = i.find(".openOffers")[0];
                    s.empty();
                    if (t.noResult === false) {
                        s.html(t.html)
                    } else {
                        s.html(t.errorMsg)
                    }
                }
            });
            q.stopPropagation();
            return false
        };
        if (d.find(".buyGoldLocation").length > 0) {
            d.find(".buyGoldLocation")[0].on("change", e)
        }
        if (d.find("a").length > 0) {
            d.find("a")[0].on("click", c)
        }
        var j = d.find(".changeGoldProduct");
        if (j.length > 0) {
            j[0].on("click", g)
        }
        i.find(".goldProduct").each(function (o, p) {
            p.on("click", f)
        });
        i.find(".paymentProvider").each(function (o, p) {
            p.on("click", n)
        });
        d.find(".openOrdersLink").each(function (o, p) {
            p.on("click", m)
        });
        return this
    };
    this.updatePosition = function (e, d) {
        var c = this.calculatePosition();
        this.setPosition({x: c.left, y: c.top}, e)
    };
    this.initializeEarnGoldTab = function () {
        var j = this;
        var c = jQuery("#paymentWizard.earnGold");
        var d = c.find(".contentWrapper .earnGoldPage").parent();
        var e = function (l) {
            if (!l || l === "" || typeof l === "undefined") {
                l = "earnGoldOverview"
            }
            d.children().hide();
            d.children("." + l).show();
            return this
        };
        var i = function (m) {
            var o = undefined;
            var n = jQuery(m.target).attr("class").split(" ");
            for (var l = 0; l < n.length; l++) {
                if (n[l].indexOf("earnGold") === 0) {
                    o = n[l];
                    break
                }
            }
            e(o);
            m.stopPropagation();
            return false
        };
        c.find("a.showEarnGoldPage").on("click", i);
        var g = function (n) {
            var m = d.find(".receiverLines").children().length;
            if (m < 6) {
                var l = Travian.Translation.translate("{earnGoldContentMailSendReceiverCount}").replace("[RECEIVER_COUNT]", m + 1);
                var o = jQuery('<div class="receiverLine">' + l + ' <input type="text" class="text" name="receiver[]" /></div>');
                o.appendTo(d.find(".receiverLines"));
                if (m >= 5) {
                    d.find(".receiverLinkLine").hide()
                }
            }
            n.stopPropagation();
            return false
        };
        d.find(".earnGoldAddLink").on("click", g);
        d.find(".earnGoldSendMailCancel").on("click", function () {
            j.options.data.formData = {};
            j.options.data.location = "";
            j.reload()
        });
        d.find(".earnGoldSendMailSubmit").on("click", function () {
            var l = {};
            l.receiver = [];
            d.find(".receiverLines input").each(function (m, n) {
                l.receiver.push(jQuery(n).val())
            });
            l.message = d.find(".earnGoldSendMailMessage").val();
            j.options.data.formData = l;
            j.options.data.location = "earnGoldMailSend";
            j.reload()
        });
        var f = false;
        var h = function (l) {
            if (f) {
                return this
            }
            f = true;
            Travian.ajax({
                data: {cmd: "paymentWizardAdvertisedPersons", page: l}, onSuccess: function (m) {
                    if (m.errorMessage) {
                        j.setError(m)
                    } else {
                        if (m.html) {
                            f = false;
                            d.find(".earnGoldAdvertisedPersonsList").html(m.html);
                            d.find(".paginator a").on("click", function (o) {
                                var n = jQuery(o.target);
                                if (n.prop("tagName").toLowerCase() !== "a") {
                                    n = n.parent("a")
                                }
                                l = n.attr("href").toString().split("=")[1];
                                h(l);
                                o.stopPropagation();
                                return false
                            })
                        }
                    }
                }
            });
            return this
        };
        var k = d.find("a.showEarnGoldPage.earnGoldDrumUps");
        if (k !== null) {
            k.on("click", function (l) {
                h()
            })
        }
        e(j.options.data.location)
    };
    this.initializeProsTab = function () {
        var d = this;
        var c = jQuery("#featureCollectionWrapper");
        c.find(".prosButton").each(function (e, f) {
            f = jQuery(f);
            f.off("click");
            f.on("click", function (g) {
                d.options.useCallback = true;
                d.options.callback = function () {
                    window.location.href = window.location.href;
                    window.location.reload()
                };
                d.requestSend = true;
                if (jQuery(this).hasClass("productionboostWood")) {
                    jQuery(window).trigger("startWayOfPayment", ["productionboostWood", "paymentWizard"])
                } else {
                    if (jQuery(this).hasClass("productionboostClay")) {
                        jQuery(window).trigger("startWayOfPayment", ["productionboostClay", "paymentWizard"])
                    } else {
                        if (jQuery(this).hasClass("productionboostIron")) {
                            jQuery(window).trigger("startWayOfPayment", ["productionboostIron", "paymentWizard"])
                        } else {
                            if (jQuery(this).hasClass("productionboostCrop")) {
                                jQuery(window).trigger("startWayOfPayment", ["productionboostCrop", "paymentWizard"])
                            } else {
                                if (jQuery(this).hasClass("plus")) {
                                    jQuery(window).trigger("startWayOfPayment", ["plus", "paymentWizard"])
                                } else {
                                    if (jQuery(this).hasClass("goldclub")) {
                                        jQuery(window).trigger("startWayOfPayment", ["goldclub", "paymentWizard"])
                                    }
                                }
                            }
                        }
                    }
                }
                return false
            })
        });
        c.find(".checkbox").each(function (e, f) {
            f = jQuery(f);
            f.off("click");
            f.on("click", function (g) {
                if (jQuery(this).hasClass("prolongProductionboostWood")) {
                    return d.toggleAutoprolong("productionboostWood", "productionBoost")
                } else {
                    if (jQuery(this).hasClass("prolongProductionboostClay")) {
                        return d.toggleAutoprolong("productionboostClay", "productionBoost")
                    } else {
                        if (jQuery(this).hasClass("prolongProductionboostIron")) {
                            return d.toggleAutoprolong("productionboostIron", "productionBoost")
                        } else {
                            if (jQuery(this).hasClass("prolongProductionboostCrop")) {
                                return d.toggleAutoprolong("productionboostCrop", "productionBoost")
                            } else {
                                if (jQuery(this).hasClass("prolongPlus")) {
                                    return d.toggleAutoprolong("plus", "plus")
                                }
                            }
                        }
                    }
                }
                g.stopPropagation();
                return false
            })
        });
        c.find(".feature").on("mouseover", function (f) {
            var e = jQuery(this).find(".premiumFeatureName").val();
            if (!e || e === d.lastFeatureName) {
                f.stopPropagation();
                return false
            }
            var g = jQuery("#paymentWizard");
            g.find(".infoArea .premiumFeature").hide();
            g.find(".contentArea .feature .dynamicContent").hide();
            jQuery(this).find(".dynamicContent").show();
            g.find(".infoArea .premiumFeature").filter("." + e).show();
            d.lastFeatureName = e
        });
        if (c.length > 0) {
            Travian.TimersAndCounters.initTimersInContext(c[0])
        }
    };
    this.toggleAutoprolong = function (f, c) {
        var e = this;
        var d = {};
        d.cmd = "premiumFeature";
        d.featureKey = f;
        d.toggleAutoprolong = 1;
        Travian.ajax({
            data: d, onSuccess: function (g) {
                e.reload()
            }
        })
    };
    this.openProvider = function (d, c, e, f) {
        window.open("/tgpay.php?product=" + d + "&provider=" + c, "tgpay", "scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=" + e + ",height=" + f)
    };
    this.initialize()
};
Travian.Game.PaymentWizard.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.PaymentWizard.constructor = Travian.Game.PaymentWizard;
var shopUIV2;

function ShopUIV2() {
    this.allowSlidePackages = true;
    this.allowSlidePaymentMethods = true;
    this.goldPackagesPages = [];
    this.goldPackagesPagesSize = 0;
    this.paymentMethodsPages = [];
    this.paymentMethodsPageSize = 0;
    this.selectedPaymentMethod = false;
    this.rtl = false;
    this.initialize = function () {
        var b = this;
        if ($$(".paymentWizardDirectionRTL").length > 0) {
            this.rtl = true
        }
        b.slidingContentInnerPackage = $$("#packageSlider .slidingContentInner")[0];
        b.slidingContentOuterPackage = $$("#packageSlider .slidingContentOuter")[0];
        b.slidingContentOuterWidthPackage = b.slidingContentOuterPackage.getDimensions();
        b.slidingContentOuterWidthPackage = parseInt(b.slidingContentOuterWidthPackage.x);
        b.slidingContentInnerPackage.set("tween", {
            duration: 500,
            transition: "linear",
            link: "cancel",
            onComplete: function () {
                b.allowSlidePackages = true
            }
        });
        b.slidingContentInnerPaymentMethods = $$("#paymentMethodsSlider .slidingContentInner")[0];
        b.slidingContentOuterPaymentMethods = $$("#paymentMethodsSlider .slidingContentOuter")[0];
        b.slidingContentOuterWidthPaymentMethods = b.slidingContentOuterPaymentMethods.getDimensions();
        b.slidingContentOuterWidthPaymentMethods = parseInt(b.slidingContentOuterWidthPaymentMethods.x);
        b.slidingContentInnerPaymentMethods.set("tween", {
            duration: 500,
            transition: "linear",
            link: "cancel",
            onComplete: function () {
                b.allowSlidePaymentMethods = true
            }
        });
        var a = 0;
        $$("#packageSlider .productsPage").each(function (d) {
            b.goldPackagesPages[a] = d;
            if (b.goldPackagesPagesSize == 0) {
                var c = d.getStyle("width");
                c = parseInt(c.replace("px", ""));
                b.goldPackagesPagesSize = c
            }
            a++
        });
        b.initializePaymentMethods();
        setTimeout(function () {
            b.packageSliderButtonCheck();
            b.paymentMethodsSliderButtonCheck();
            b.bindEvents();
            b.updateResultBox();
            setTimeout(function () {
                $$("#packageSlider .package.hideForLoading").removeClass("hideForLoading")
            }, 500)
        }, 250)
    };
    this.initializePaymentMethods = function () {
        var b = this;
        $$("#paymentMethodsSlider .loading")[0].removeClass("hide");
        if (typeof $$(".package.selected input.goldProductId")[0] === "undefined") {
            return
        }
        var a = parseInt($$(".package.selected input.goldProductId")[0].get("value"));
        $$("#paymentMethodsSlider .slidingContent")[0].empty();
        b.updateResultBox();
        Travian.ajax({
            data: {cmd: "paymentProviders", selectedPackage: a}, onSuccess: function (d) {
                if (typeof $$("#paymentMethodsSlider .slidingContent")[0] === "undefined") {
                    return false
                }
                $$("#paymentMethodsSlider .slidingContent")[0].set("html", d.html);
                if (!b.rtl) {
                    b.slidingContentInnerPaymentMethods.setStyle("margin-left", 0)
                } else {
                    b.slidingContentInnerPaymentMethods.setStyle("margin-right", 0)
                }
                b.paymentMethodsPages = [];
                b.paymentMethodsPageSize = 0;
                var c = 0;
                $$(".methodsPage").each(function (f) {
                    b.paymentMethodsPages[c] = f;
                    if (b.paymentMethodsPageSize == 0) {
                        var e = f.getStyle("width");
                        e = parseInt(e.replace("px", ""));
                        b.paymentMethodsPageSize = e
                    }
                    c++
                });
                $$("#paymentMethodsSlider .methodItem").each(function (g) {
                    g.addEvent("click", b.methodItemClickEvent);
                    if (b.selectedPaymentMethod !== false) {
                        if (parseInt(g.getChildren()[0].get("value")) == b.selectedPaymentMethod) {
                            $$("#paymentMethodsSlider .methodItem").removeClass("selected");
                            g.addClass("selected");
                            for (var e = 0; e < b.paymentMethodsPages.length; e++) {
                                if (b.paymentMethodsPages[e] == g.getParent()) {
                                    var f = e * b.paymentMethodsPageSize;
                                    if (f == 0) {
                                        f = 1
                                    }
                                    b.allowSlidePaymentMethods = false;
                                    $$("#paymentMethodsSlider .methodsPage").removeClass("visible").addClass("hidden");
                                    b.paymentMethodsPages[e].removeClass("hidden").addClass("visible");
                                    if (!b.rtl) {
                                        b.slidingContentInnerPaymentMethods.tween("margin-left", f * -1)
                                    } else {
                                        b.slidingContentInnerPaymentMethods.tween("margin-right", f * -1)
                                    }
                                    b.updateResultBox()
                                }
                            }
                        }
                    }
                });
                b.paymentMethodsSliderButtonCheck();
                $$("#paymentMethodsSlider .loading")[0].addClass("hide")
            }
        })
    };
    this.packageSliderButtonCheck = function () {
        var a = this;
        if (typeof a.goldPackagesPages[0] != "undefined") {
            if (a.goldPackagesPages[0].hasClass("visible")) {
                if (!$$("#packageSlider .slideArea.area1")[0].hasClass("inactive")) {
                    $$("#packageSlider .slideArea.area1")[0].addClass("inactive")
                }
            } else {
                $$("#packageSlider .slideArea.area1")[0].removeClass("inactive")
            }
            if (a.goldPackagesPages[a.goldPackagesPages.length - 1].hasClass("hidden")) {
                if ($$("#packageSlider .slideArea.area2")[0].hasClass("inactive")) {
                    $$("#packageSlider .slideArea.area2")[0].removeClass("inactive")
                }
            } else {
                $$("#packageSlider .slideArea.area2")[0].addClass("inactive")
            }
        }
    };
    this.paymentMethodsSliderButtonCheck = function () {
        var a = this;
        if (typeof a.paymentMethodsPages[0] != "undefined") {
            if (a.paymentMethodsPages[0].hasClass("visible")) {
                if (!$$("#paymentMethodsSlider .slideArea.area1")[0].hasClass("inactive")) {
                    $$("#paymentMethodsSlider .slideArea.area1")[0].addClass("inactive")
                }
            } else {
                $$("#paymentMethodsSlider .slideArea.area1")[0].removeClass("inactive")
            }
            if (a.paymentMethodsPages[a.paymentMethodsPages.length - 1].hasClass("hidden")) {
                if ($$("#paymentMethodsSlider .slideArea.area2")[0].hasClass("inactive")) {
                    $$("#paymentMethodsSlider .slideArea.area2")[0].removeClass("inactive")
                }
            } else {
                $$("#paymentMethodsSlider .slideArea.area2")[0].addClass("inactive")
            }
        }
    };
    this.bindEvents = function () {
        var a = this;
        $$("#packageSlider .slideArea.area1").addEvent("click", function () {
            a.packageSlideLeft()
        });
        $$("#packageSlider .slideArea.area2").addEvent("click", function () {
            a.packageSlideRight()
        });
        $$("#packageSlider .package").addEvent("click", function () {
            if (!this.hasClass("selected")) {
                $$(".package").removeClass("selected");
                this.addClass("selected");
                a.initializePaymentMethods()
            }
        });
        $$("#phonePackages .package").addEvent("click", function () {
            if (!this.hasClass("selected")) {
                $$(".package").removeClass("selected");
                this.addClass("selected");
                a.initializePaymentMethods()
            }
        });
        $$("#paymentMethodsSlider .slideArea.area1").addEvent("click", function () {
            a.paymentMethodsSlideLeft()
        });
        $$("#paymentMethodsSlider .slideArea.area2").addEvent("click", function () {
            a.paymentMethodsSlideRight()
        });
        $$("#paymentMethodsSlider .methodItem").addEvent("click", a.methodItemClickEvent);
        $$("#paymentMethodsSlider").addEvent("click", function () {
            a.updateResultBox();
            a.saveSelectedPaymentMethod()
        });
        $$("#overview .resultBox .activeButton").addEvent("click", function () {
            a.buyNowAction()
        });
        $$(".buyGoldLocation").addEvent("change", function () {
            a.changeLocation()
        });
        $$("#vouchers .package").addEvent("click", function () {
            voucherPopup()
        });
        window.addEvent("shopUIV2RestorePreview", function () {
            $$("#paymentMethodsSlider .loading")[0].removeClass("hide");
            $$("#packageSlider .slidingContentInner")[0].set("html", "");
            $$("#paymentMethodsSlider .slidingContentInner")[0].set("html", "");
            $$("#phonePackages .package").destroy();
            $$("#vouchers .package").destroy();
            $$("#packageSlider .slideArea > div").removeClass("active").addClass("inactive");
            $$("#paymentMethodsSlider .slideArea > div").removeClass("active").addClass("inactive");
            $$(".resultBox .goldUnits").set("html", "");
            $$(".resultBox #goldBalanceNew").set("html", "");
            $$(".resultBox #priceToPay").set("html", "")
        })
    };
    this.methodItemClickEvent = function () {
        if (!this.hasClass("inactive") && !this.hasClass("defect")) {
            $$("#paymentMethodsSlider .methodItem").removeClass("selected");
            this.addClass("selected")
        }
    };
    this.updateResultBox = function () {
        if (typeof $$(".package.selected .goldUnits")[0] === "undefined") {
            return
        }
        $$(".resultBox #packageGoldAmount .goldUnits")[0].set("html", $$(".package.selected .goldUnits")[0].get("html"));
        $$(".resultBox #goldBalanceNew")[0].set("html", (parseInt($$(".package.selected .goldUnits")[0].get("html")) + parseInt($$(".accountBalance span")[0].get("html"))));
        $$(".resultBox #priceToPay")[0].set("html", $$(".package.selected .price")[0].get("html"));
        if ($$("#paymentMethodsSlider .methodItem.selected")[0]) {
            $$(".resultBox .inactiveButton").addClass("hide");
            $$(".resultBox .activeButton").removeClass("hide")
        } else {
            $$(".resultBox .activeButton").addClass("hide");
            $$(".resultBox .inactiveButton").removeClass("hide")
        }
    };
    this.saveSelectedPaymentMethod = function () {
        var a = this;
        if ($$("#paymentMethodsSlider .methodItem.selected")[0]) {
            a.selectedPaymentMethod = parseInt($$("#paymentMethodsSlider .methodItem.selected input.providerId")[0].get("value"))
        }
    };
    this.packageSlideLeft = function () {
        var g = this;
        if (g.allowSlidePackages) {
            var f = "";
            var a = "";
            var b = false;
            for (var c = g.goldPackagesPages.length - 1; c >= 0; c--) {
                if (g.goldPackagesPages[c].hasClass("visible")) {
                    f = g.goldPackagesPages[c];
                    b = true
                }
                if (b && g.goldPackagesPages[c].hasClass("hidden")) {
                    a = g.goldPackagesPages[c];
                    break
                }
            }
            if (a != "") {
                var e = 0;
                if (!g.rtl) {
                    e = g.slidingContentInnerPackage.getStyle("margin-left")
                } else {
                    e = g.slidingContentInnerPackage.getStyle("margin-right")
                }
                e = parseInt(e.replace("px", ""));
                var d = (e + g.goldPackagesPagesSize);
                if (d == 0) {
                    d = 1
                }
                f.removeClass("visible").addClass("hidden");
                a.removeClass("hidden").addClass("visible");
                g.allowSlidePackages = false;
                if (!g.rtl) {
                    g.slidingContentInnerPackage.tween("margin-left", d)
                } else {
                    g.slidingContentInnerPackage.tween("margin-right", d)
                }
            }
        }
        g.packageSliderButtonCheck()
    };
    this.packageSlideRight = function () {
        var g = this;
        if (g.allowSlidePackages) {
            var f = "";
            var a = "";
            var b = false;
            for (var c = 0; c < g.goldPackagesPages.length; c++) {
                if (g.goldPackagesPages[c].hasClass("visible")) {
                    f = g.goldPackagesPages[c];
                    b = true
                }
                if (g.goldPackagesPages[c].hasClass("hidden")) {
                    if (b) {
                        a = g.goldPackagesPages[c];
                        break
                    }
                }
            }
            if (a != "") {
                var e = 0;
                if (!g.rtl) {
                    e = g.slidingContentInnerPackage.getStyle("margin-left")
                } else {
                    e = g.slidingContentInnerPackage.getStyle("margin-right")
                }
                e = parseInt(e.replace("px", "")) * -1;
                var d = (e + g.goldPackagesPagesSize) * -1;
                f.removeClass("visible").addClass("hidden");
                a.removeClass("hidden").addClass("visible");
                g.allowSlidePaymentMethods = false;
                if (!g.rtl) {
                    g.slidingContentInnerPackage.tween("margin-left", d)
                } else {
                    g.slidingContentInnerPackage.tween("margin-right", d)
                }
            }
        }
        g.packageSliderButtonCheck()
    };
    this.paymentMethodsSlideLeft = function () {
        var g = this;
        if (g.allowSlidePaymentMethods) {
            var f = "";
            var a = "";
            var b = false;
            for (var c = g.paymentMethodsPages.length - 1; c >= 0; c--) {
                if (g.paymentMethodsPages[c].hasClass("visible")) {
                    f = g.paymentMethodsPages[c];
                    b = true
                }
                if (b && g.paymentMethodsPages[c].hasClass("hidden")) {
                    a = g.paymentMethodsPages[c];
                    break
                }
            }
            if (a != "") {
                var e = 0;
                if (!g.rtl) {
                    e = g.slidingContentInnerPaymentMethods.getStyle("margin-left")
                } else {
                    e = g.slidingContentInnerPaymentMethods.getStyle("margin-right")
                }
                e = parseInt(e.replace("px", ""));
                var d = (e + g.paymentMethodsPageSize);
                if (d == 0) {
                    d = 1
                }
                f.removeClass("visible").addClass("hidden");
                a.removeClass("hidden").addClass("visible");
                g.allowSlidePaymentMethods = false;
                if (!g.rtl) {
                    g.slidingContentInnerPaymentMethods.tween("margin-left", d)
                } else {
                    g.slidingContentInnerPaymentMethods.tween("margin-right", d)
                }
            }
        }
        g.paymentMethodsSliderButtonCheck()
    };
    this.paymentMethodsSlideRight = function () {
        var g = this;
        if (g.allowSlidePaymentMethods) {
            var f = "";
            var a = "";
            var b = false;
            for (var c = 0; c < g.paymentMethodsPages.length; c++) {
                if (g.paymentMethodsPages[c].hasClass("visible")) {
                    f = g.paymentMethodsPages[c];
                    b = true
                }
                if (g.paymentMethodsPages[c].hasClass("hidden")) {
                    if (b) {
                        a = g.paymentMethodsPages[c];
                        break
                    }
                }
            }
            if (a != "") {
                var e = 0;
                if (!g.rtl) {
                    e = g.slidingContentInnerPaymentMethods.getStyle("margin-left")
                } else {
                    e = g.slidingContentInnerPaymentMethods.getStyle("margin-right")
                }
                e = parseInt(e.replace("px", "")) * -1;
                var d = (e + g.paymentMethodsPageSize) * -1;
                f.removeClass("visible").addClass("hidden");
                a.removeClass("hidden").addClass("visible");
                g.allowSlidePaymentMethods = false;
                if (!g.rtl) {
                    g.slidingContentInnerPaymentMethods.tween("margin-left", d)
                } else {
                    g.slidingContentInnerPaymentMethods.tween("margin-right", d)
                }
            }
        }
        g.paymentMethodsSliderButtonCheck()
    };
    this.buyNowAction = function () {
        if ($$("#overview .resultBox .inactiveButton.hide")[0]) {
            var e = parseInt($$(".package.selected input.goldProductId")[0].get("value"));
            var b = parseInt($$("#paymentMethodsSlider .methodItem.selected input.providerId")[0].get("value"));
            var d = 800;
            var f = 600;
            if ($$("#paymentMethodsSlider .methodItem.selected input.popupWidth")[0]) {
                d = $$("#paymentMethodsSlider .methodItem.selected input.popupWidth")[0]
            }
            if ($$("#paymentMethodsSlider .methodItem.selected input.popupHeight")[0]) {
                f = $$("#paymentMethodsSlider .methodItem.selected input.popupHeight")[0]
            }
            var a = (screen.width - d) / 2;
            var c = (screen.height - f) / 2;
            window.open("/tgpay.php?product=" + e + "&provider=" + b, "tgpay", "scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=" + d + ",height=" + f + ",left=" + a + ",top=" + c)
        }
    };
    this.changeLocation = function () {
        var b = $$("select.buyGoldLocation")[0].getSelected()[0].get("value");
        var a = (new Overlay(document.body, {opacity: 0.8, duration: 250})).open();
        Travian.Game.PaymentWizardEventListener.PaymentWizardObject && Travian.Game.PaymentWizardEventListener.PaymentWizardObject.close();
        jQuery(window).trigger("startPaymentWizard", {
            data: {
                cmd: "paymentWizard",
                goldProductId: "",
                goldProductLocation: b,
                location: "",
                activeTab: "buyGold",
                formData: {}
            }, onOpen: function () {
                a.close().dispose()
            }
        })
    };
    this.selectPackage = function (e) {
        var d = this;
        var f = $$(".package input[value=" + e + "]")[0];
        e = f.getParent();
        var a = e.getParent();
        if (a.id != "phonePackages") {
            if (a.hasClass("hidden")) {
                for (var b = 0; b < d.goldPackagesPages.length; b++) {
                    if (d.goldPackagesPages[b] == a) {
                        var c = b * d.goldPackagesPagesSize;
                        if (c == 0) {
                            c = 1
                        }
                        d.allowSlidePackages = false;
                        $$("#packageSlider .productsPage").removeClass("visible").addClass("hidden");
                        d.goldPackagesPages[b].removeClass("hidden").addClass("visible");
                        if (!d.rtl) {
                            d.slidingContentInnerPackage.tween("margin-left", c * -1)
                        } else {
                            d.slidingContentInnerPackage.tween("margin-right", c * -1)
                        }
                    }
                }
            }
        }
        $$(".package").removeClass("selected");
        e.addClass("selected")
    }
}

Travian.Game.VideoFeatureShowVideo = function (a) {
    this.request = function () {
        var c = this;
        this.options.data.context = this.context;
        Travian.ajax({
            data: this.options.data, onSuccess: function (d) {
                c.setContent(d.html);
                c.show();
                c.updateInfoButton({
                    buttonTextInfo: Travian.Translation.get("videoFeature.infoButtonLabel"), infoIcon: function () {
                        window.open(jQuery("#videoFeature").find(".videoFeatureAnswersLink").val())
                    }
                })
            }
        });
        return this
    };
    this.close = function (c) {
        if (typeof this.requestSend !== "undefined" && this.requestSend === true) {
            return window.location.reload()
        }
        if (c === Travian.Dialog.CLOSE_CONTEXT_OVERLAYBACKGROUND) {
            new Travian.Game.VideoFeatureAbort()
        } else {
            window.reload_enabled = true;
            Travian.Dialog.Ajax.prototype.close.call(this)
        }
    };
    var b = this;
    Travian.Dialog.Ajax.call(this, Object.assign({
        data: {cmd: "adSalesVideo"},
        keepOpen: false,
        buttonCancel: false,
        buttonOk: false,
        context: "videoFeatureShowVideo",
        cssClass: "videoFeatureV2",
        draggable: false,
        infoIcon: true,
        saveOnUnload: false,
        scroll: false,
        type: this.DIALOG_TYPE_NONMODAL,
        darkOverlay: true,
        overlayCancel: true,
        resizeDialogIfOverflow: false,
        useCallback: false,
        callback: Travian.emptyFunction(),
        callbackScope: null,
        onClose: function (c) {
            Travian.Game.VideoFeatureEventListener.VideoFeatureObject = null;
            if (b.options.useCallback === true && typeof b.options.callback === "function") {
                b.options.callback({scope: b.options.callbackScope})
            }
            jQuery(window).trigger("VideoDialogOnCloseEvent")
        }
    }, a))
};
Travian.Game.VideoFeatureShowVideo.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.VideoFeatureShowVideo.constructor = Travian.Game.VideoFeatureShowVideo;
Travian.Game.VideoFeatureInfo = function (a) {
    this.request = function () {
        var b = this;
        this.options.data.context = this.context;
        Travian.ajax({
            data: this.options.data, onSuccess: function (c) {
                b.setContent(c.html);
                b.show();
                b.updateInfoButton({
                    buttonTextInfo: Travian.Translation.get("videoFeature.infoButtonLabel"),
                    infoIcon: function () {
                        window.open(jQuery("#videoFeature").find(".videoFeatureAnswersLink").val())
                    }
                })
            }
        });
        return this
    };
    Travian.Dialog.Ajax.call(this, Object.assign({
        data: {cmd: "adSalesVideo", subAction: "info"},
        keepOpen: false,
        buttonCancel: true,
        buttonOk: false,
        context: "videoFeatureInfo",
        cssClass: "videoFeatureV2",
        draggable: false,
        infoIcon: true,
        saveOnUnload: false,
        scroll: false,
        type: this.DIALOG_TYPE_MODAL,
        darkOverlay: true,
        overlayCancel: true,
        resizeDialogIfOverflow: false,
        useCallback: false,
        callback: Travian.emptyFunction(),
        callbackScope: null
    }, a))
};
Travian.Game.VideoFeatureInfo.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.VideoFeatureInfo.constructor = Travian.Game.VideoFeatureInfo;
Travian.Game.VideoFeatureAbort = function (a) {
    this.abortVideo = function () {
        Travian.WindowManager.closeByContext("videoFeatureAbort");
        Travian.WindowManager.closeByContext("videoFeatureShowVideo")
    };
    Travian.Dialog.Ajax.call(this, Object.assign({
        data: {cmd: "adSalesVideo", subAction: "abort"},
        keepOpen: false,
        buttonCancel: false,
        buttonOk: false,
        context: "videoFeatureAbort",
        draggable: false,
        infoIcon: false,
        saveOnUnload: false,
        scroll: false,
        type: this.DIALOG_TYPE_NONMODAL,
        cssClass: "white",
        darkOverlay: true,
        overlayCancel: false,
        resizeDialogIfOverflow: false,
        useCallback: false,
        callback: Travian.emptyFunction(),
        callbackScope: null
    }, a))
};
Travian.Game.VideoFeatureAbort.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.VideoFeatureAbort.constructor = Travian.Game.VideoFeatureAbort;
Travian.Game.VideoFeatureSuccess = function (a) {
    Travian.Dialog.Ajax.call(this, Object.assign({
        data: {cmd: "adSalesVideo", subAction: "success"},
        keepOpen: false,
        buttonCancel: false,
        buttonOk: true,
        context: "videoFeatureSuccess",
        draggable: false,
        infoIcon: false,
        saveOnUnload: false,
        scroll: false,
        type: this.DIALOG_TYPE_NONMODAL,
        cssClass: "white",
        darkOverlay: true,
        overlayCancel: true,
        resizeDialogIfOverflow: false,
        useCallback: false,
        callback: Travian.emptyFunction(),
        callbackScope: null,
        preventFormSubmit: true,
        onOkay: function () {
            Travian.Game.Preferences.set("adSalesVideoSuccessDialogDisabled", jQuery("input#dontShowThisAgain").is(":checked"))
        }
    }, a))
};
Travian.Game.VideoFeatureSuccess.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.VideoFeatureSuccess.constructor = Travian.Game.VideoFeatureSuccess;
Travian.Game.MoreGames = function (a) {
    this.activeCounterElement = null;
    this.activeCounter = 0;
    this.autoHoverDelay = 3000;
    this.timeoutId = 0;
    this.elements = null;
    this.options = Object.assign({countOfGamesToShow: 0}, a);
    this.initialize = function () {
        this.elements = jQuery("div.moreGames .game.game-image");
        if (this.options.countOfGamesToShow) {
            this.events().toggleChildren(this.activeCounter).autoHover()
        }
    };
    this.autoHover = function () {
        var b = this;
        if (b.timeoutId) {
            clearTimeout(b.timeoutId)
        }
        b.timeoutId = setTimeout(function () {
            b.toggleChildren(b.activeCounter);
            b.toggleChildren((b.activeCounter + 1) % b.options.countOfGamesToShow);
            b.autoHover()
        }.bind(b), b.autoHoverDelay);
        return b
    };
    this.events = function () {
        var d = this;
        var c = function (e) {
            d = this;
            clearTimeout(d.timeoutId);
            if (e === d.activeCounter) {
                return
            }
            if (d.activeCounterElement.length > 0) {
                d.toggleChildren(d.activeCounter)
            }
            d.toggleChildren(e)
        };
        var b = function () {
            d = this;
            d.autoHover()
        };
        this.elements.each(function (e, f) {
            jQuery(f).on({mouseenter: jQuery.proxy(c, d, e), mouseleave: jQuery.proxy(b, d)})
        });
        return this
    };
    this.toggleChildren = function (b) {
        this.activeCounter = b;
        this.activeCounterElement = jQuery(this.elements[b]);
        this.activeCounterElement.find("img").each(function (c, d) {
            jQuery(d).toggleClass("hide")
        });
        return this
    };
    this.initialize()
};
Travian.Game.VideoFeatureEventListener = Object.create({
    VideoFeatureObject: null, options: null, infoScreenEnabled: true, videoOptions: {}, initialize: function (a) {
        if (typeof a !== "undefined") {
            this.options = a
        }
        this.DoubleClickPreventer = new Travian.DoubleClickPreventer();
        this.DoubleClickPreventer.timeout = 1000;
        this.bindEvents();
        var b = Travian.Game.Preferences.get("adSalesVideoInfoScreen");
        this.infoScreenEnabled = b === null || b === "enabled";
        return this
    }, bindEvents: function () {
        var a = this;
        jQuery(window).on("showVideoWindow", function (c, b) {
            if (undefined === a.VideoFeatureObject || null === a.VideoFeatureObject) {
                if (!a.DoubleClickPreventer.check()) {
                    return false
                }
                if (!a.infoScreenEnabled) {
                    a.VideoFeatureObject = a.startVideoDialog(b)
                } else {
                    a.videoOptions = b;
                    a.showVideoInfoDialog()
                }
            } else {
                a.VideoFeatureObject.options = Object.assign({}, a.VideoFeatureObject.options, b || {});
                a.VideoFeatureObject.reload()
            }
        });
        jQuery(window).on("showVideoWindowAfterInfoScreen", function () {
            Travian.WindowManager.closeByContext("videoFeatureInfo");
            if (undefined === a.VideoFeatureObject || null === a.VideoFeatureObject) {
                a.VideoFeatureObject = a.startVideoDialog(a.videoOptions)
            } else {
                a.VideoFeatureObject.options = Object.assign({}, a.VideoFeatureObject.options, options || {});
                a.VideoFeatureObject.reload()
            }
        });
        jQuery(window).on("toggleAdSalesVideoInfoScreen", function (b, c) {
            Travian.Game.Preferences.set("adSalesVideoInfoScreen", c);
            a.infoScreenEnabled = c === "enabled"
        })
    }, addEvent: function (c, a, b) {
        if (c.addEventListener) {
            c.addEventListener(a, b, false)
        } else {
            if (c.attachEvent) {
                c.attachEvent("on" + a, b)
            }
        }
    }, onMessage: function (f, d) {
        if (f.originalEvent.origin === "http://media.oadts.com" || f.originalEvent.origin === "https://media.oadts.com") {
            var b = f.originalEvent.data;
            if (b === "videoStart") {
                Travian.ajax({
                    data: {cmd: "adSalesVideo", action: "start", vrid: d.vrid}, onSuccess: function (e) {
                    }
                })
            } else {
                if (b === "noVideo") {
                } else {
                    if (b === "videoEnds") {
                    } else {
                        if (b.indexOf("videoEnds:") === 0) {
                            var a = b.replace("videoEnds:", ""), c = a.indexOf(":");
                            Travian.ajax({
                                data: {
                                    cmd: "adSalesVideo",
                                    action: "build",
                                    vrid: a.substring(0, c),
                                    hash: a.substring(c + 1)
                                }, onSuccess: function (e) {
                                }
                            })
                        } else {
                        }
                    }
                }
            }
        }
    }, startVideoDialog: function (a) {
        window.reload_enabled = false;
        return new Travian.Game.VideoFeatureShowVideo(a)
    }, showVideoInfoDialog: function () {
        new Travian.Game.VideoFeatureInfo()
    }
});
jQuery(function () {
    Travian.Game.VideoFeatureEventListener.initialize()
});
Travian.Game.PaymentWizardEventListener = Object.create({
    DoubleClickPreventer: null, PaymentWizardObject: null, preview: {enabled: false}, initialize: function () {
        this.DoubleClickPreventer = new Travian.DoubleClickPreventer();
        this.DoubleClickPreventer.timeout = 2000;
        this.bindEvents()
    }, bindEvents: function () {
        var a = this;
        jQuery(window).on("paymentWizardOnCloseEvent", function (b) {
            a.PaymentWizardObject = null;
            a.preview = {enabled: false}
        });
        jQuery(window).on("startPaymentWizard", function (c, b) {
            b.preview = a.preview;
            if (!a.DoubleClickPreventer.check()) {
                return false
            }
            if (undefined === a.PaymentWizardObject || null === a.PaymentWizardObject) {
                a.PaymentWizardObject = a.startPaymentWizard(b)
            } else {
                a.PaymentWizardObject.options = Travian.Helpers.deepmergeObject({}, a.PaymentWizardObject.options, b || {});
                a.PaymentWizardObject.reload()
            }
        });
        jQuery(window).on("paymentWizardFillPreview", function (d, b, e, c) {
            a.preview.enabled = b;
            a.preview.title = e;
            a.preview.infoIcon = c
        })
    }, startPaymentWizard: function (a) {
        return new Travian.Game.PaymentWizard(a)
    }
});
jQuery(function () {
    Travian.Game.PaymentWizardEventListener.initialize()
});
Travian.Game.WayOfPaymentEventListener = Object.create({
    WayOfPaymentObject: null, initialize: function () {
        this.DoubleClickPreventer = new Travian.DoubleClickPreventer();
        this.DoubleClickPreventer.timeout = 500;
        this.bindEvents()
    }, bindEvents: function () {
        var a = this;
        jQuery(window).on("buttonClicked", function (d, c, b) {
            if (typeof b.wayOfPayment === "object" && a.DoubleClickPreventer.check()) {
                a.WayOfPaymentObject = a.startWayOfPayment(b.wayOfPayment.featureKey, b.wayOfPayment.context, b.wayOfPayment.dataCallback, b.wayOfPayment.confirmPopup, b.wayOfPayment.closeAllDialogs)
            }
        });
        jQuery(window).on("startWayOfPayment", function (f, g, d, e, b, c) {
            if (!a.DoubleClickPreventer.check()) {
                return false
            }
            a.WayOfPaymentObject = a.startWayOfPayment(g, d, e, b, c)
        })
    }, startWayOfPayment: function (e, c, d, a, b) {
        return new Travian.Game.WayOfPayment(e, c, d, a, b)
    }
});
jQuery(function () {
    Travian.Game.WayOfPaymentEventListener.initialize()
});
Travian.Game.ButtonEventListener = {
    bindEvents: function () {
        jQuery(window).on("buttonClicked", function (c, b, a) {
            jQuery(b).blur();
            if (typeof a.dialog === "object" && a.dialog && Travian.DoubleClickPreventer.globalCheck()) {
                return new Travian.Dialog.Ajax(a.dialog)
            }
            if (typeof a.plusDialog === "object" && a.plusDialog && Travian.DoubleClickPreventer.globalCheck()) {
                return new Travian.Game.PlusDialog(a.plusDialog)
            }
            if (typeof a.productionBoostDialog === "object" && a.productionBoostDialog && Travian.DoubleClickPreventer.globalCheck()) {
                return new Travian.Game.ProductionBoostDialog(a.productionBoostDialog)
            }
            if (typeof a.reportSpamMessagesDialog === "object" && a.reportSpamMessagesDialog && Travian.DoubleClickPreventer.globalCheck()) {
                return new Travian.Game.ReportSpamMessagesDialog(a.reportSpamMessagesDialog)
            }
            if (typeof a.goldclubDialog === "object" && a.goldclubDialog && Travian.DoubleClickPreventer.globalCheck()) {
                return new Travian.Game.GoldclubDialog(a.goldclubDialog)
            }
            if (typeof a.questButtonTipsToggle !== "undefined" && a.questButtonTipsToggle) {
                if (typeof a.questButtonActivateTips !== "undefined" && a.questButtonActivateTips && typeof a.questButtonDeactivateTips !== "undefined" && a.questButtonDeactivateTips) {
                    return Travian.Game.Quest.toggleHighlights(a.questButtonActivateTips, a.questButtonDeactivateTips)
                }
            }
            if (typeof a.questButtonGainReward !== "undefined" && a.questButtonGainReward) {
                return Travian.Game.Quest.rewardButtonClick(a.questId)
            }
            if (typeof a.questButtonNext !== "undefined" && a.questButtonNext) {
                return Travian.Game.Quest.nextButtonClick(a.questId)
            }
            if (typeof a.questButtonSkipTutorial !== "undefined" && a.questButtonSkipTutorial) {
                return Travian.Game.Quest.skipButtonClick()
            }
            if (typeof a.questButtonOverview !== "undefined" && a.questButtonOverview) {
                return Travian.Game.Quest.openTodoListDialog()
            }
            if (typeof a.questButtonOverviewAchievements !== "undefined" && a.questButtonOverviewAchievements) {
                return Travian.Game.Quest.openTodoListDialog("", true)
            }
            if (typeof a.questButtonCloseOverlay !== "undefined" && a.questButtonCloseOverlay) {
                return Travian.Game.Quest.closeDialog()
            }
            if (typeof a.overlay !== "undefined" && a.overlay && Travian.DoubleClickPreventer.globalCheck()) {
                return Travian.Game.Overlay.openOverlay()
            }
            if (typeof a.villageDialog !== "undefined" && a.villageDialog && Travian.DoubleClickPreventer.globalCheck()) {
                return Travian.Game.showEditVillageDialog(a.villageDialog.title, a.villageDialog.description, a.villageDialog.saveText, a.villageDialog.villageId)
            }
            if (typeof a.redirectUrl !== "undefined" && a.redirectUrl && Travian.DoubleClickPreventer.globalCheck()) {
                window.location.href = a.redirectUrl;
                return false
            }
            if (typeof a.redirectUrlExternal !== "undefined" && a.redirectUrlExternal && Travian.DoubleClickPreventer.globalCheck()) {
                window.open(a.redirectUrlExternal);
                return false
            }
        });
        jQuery(window).on("tabClicked", function (c, b, a) {
            if (typeof a.dialog === "object" && a.dialog && Travian.DoubleClickPreventer.globalCheck()) {
                return new Travian.Dialog.Ajax(a.dialog)
            }
            if (typeof a.plusDialog === "object" && a.plusDialog && Travian.DoubleClickPreventer.globalCheck()) {
                return new Travian.Game.PlusDialog(a.plusDialog)
            }
            if (typeof a.goldclubDialog === "object" && a.goldclubDialog && Travian.DoubleClickPreventer.globalCheck()) {
                return new Travian.Game.GoldclubDialog(a.goldclubDialog)
            }
        })
    }
};
jQuery(function () {
    Travian.Game.ButtonEventListener.bindEvents()
});
Travian.Game.WayOfPayment = function (e, c, d, a, b) {
    this.featureKey = null;
    this.context = null;
    this.confirmPopup = null;
    this.closeAllDialogs = null;
    this.initialize = function (k, h, i, f, g) {
        if (typeof k === "undefined") {
            throw ("Feature Key must not be empty!")
        }
        var j = {};
        if (typeof i === "string" && typeof this[i] === "function") {
            j = this[i]()
        }
        if (typeof i === "string" && typeof i.split(".").reduce(function (m, l) {
            return m[l]
        }, window) === "function") {
            j = i.split(".").reduce(function (m, l) {
                return m[l]
            }, window)()
        }
        if (typeof i === "function") {
            j = i()
        }
        this.featureKey = k;
        this.context = h;
        this.confirmPopup = f;
        this.closeAllDialogs = g;
        if (typeof f !== "undefined" && typeof f === "object") {
            this.checkConfirmation(j)
        } else {
            this.bookPremiumFeature(j)
        }
    };
    this.checkConfirmation = function (f) {
        var g = this;
        Travian.ajax({
            data: {cmd: "getGoldAmount"}, onSuccess: function (i) {
                var h = i.goldAmount;
                var j = f.coins;
                if (h > 0 && j <= h) {
                    g.showCustomConfirmationPopup(g.confirmPopup, f)
                } else {
                    g.bookPremiumFeature(f)
                }
            }
        })
    };
    this.showCustomConfirmationPopup = function (f, g) {
        new Travian.Dialog.Ajax({
            buttonOk: false,
            data: {cmd: f.name, goldAmount: g.coins},
            context: this.context,
            elementFocus: f.options["elementFocus"] || "spendGold_confirm_btn"
        })
    };
    this.bookPremiumFeature = function (f) {
        var g = {cmd: "premiumFeature", featureKey: this.featureKey, context: this.context};
        if (typeof f !== "undefined") {
            g = Object.assign(f, g)
        }
        var h = this;
        Travian.ajax({
            data: g, onSuccess: function (i) {
                if (i.hasOwnProperty("functionToCall")) {
                    if (typeof h[i.functionToCall] === "function") {
                        h[i.functionToCall](i.options, i.context)
                    } else {
                        if (typeof window[i.functionToCall] === "function") {
                            window[i.functionToCall](i.options, i.context)
                        }
                    }
                }
            }, onError: function (i, j) {
                new Travian.Dialog.Dialog({preventFormSubmit: true}).setContent(j).show()
            }
        })
    };
    this.renderDialog = function (f) {
        var g = f.dialogOptions;
        var h = f.html;
        if (Travian.WindowManager.getWindowsByContext("convertGoldPopup")) {
            Travian.WindowManager.closeByContext("convertGoldPopup")
        }
        if (typeof this.closeAllDialogs !== "undefined" && this.closeAllDialogs !== null && this.closeAllDialogs) {
            Travian.WindowManager.closeAllWindows()
        }
        f.context = this.featureKey;
        $dialog = new Travian.Dialog.Dialog(g);
        $dialog.setContent(h);
        $dialog.show();
        return $dialog
    };
    this.closeDialog = function (f, g) {
        Travian.WindowManager.closeByContext(g)
    };
    this.hideDialog = function (f, g) {
        Travian.WindowManager.hideByContext(g)
    };
    this.unhideDialog = function (f, g) {
        Travian.WindowManager.showByContext(g)
    };
    this.reloadDialog = function (f, g) {
        if (g === null && undefined !== f.scope) {
            g = f.scope.context
        }
        Travian.WindowManager.reloadWindowsByContext(g)
    };
    this.reloadUrl = function () {
        window.location.href = window.location.href.split("#")[0]
    };
    this.openPaymentWizard = function (h, f) {
        var g;
        var i = Travian.emptyFunction;
        if (typeof h.goldProductId !== "undefined") {
            g = h.goldProductId
        }
        if (typeof h.callback !== "undefined" && typeof h.callback === "function") {
            i = h.callback
        }
        if (typeof h.callback === "string" && typeof h.callback.split(".").reduce(function (k, j) {
            return k[j]
        }, window) === "function") {
            i = h.callback.split(".").reduce(function (k, j) {
                return k[j]
            }, window)
        }
        this.closeDialog(h, "smallestPackage");
        jQuery(window).trigger("startPaymentWizard", {
            data: {goldProductId: g, activeTab: "buyGold"},
            callback: i,
            callbackScope: this
        })
    };
    this.openPaymentWizardWithProsTab = function () {
        jQuery(window).trigger("startPaymentWizard", {data: {activeTab: "pros"}})
    };
    this.initialize(e, c, d, a, b)
};
Travian.Game.WayOfPayment.constructor = Travian.Game.WayOfPayment;
Travian.Game.PlusDialog = function (a) {
    this.requestSent = false;
    this.contentReloaded = false;
    this.request = function () {
        var b = this;
        this.options.data.context = this.context;
        Travian.ajax({
            data: this.options.data, onSuccess: function (c) {
                b.setContent(b.createContent(b, c));
                b.show()
            }
        });
        return this
    };
    this.createContent = function (k, g) {
        var l = this;
        var b = jQuery('<div class="paymentPopupDialogWrapper"></div>');
        var c = jQuery("<h1></h1>");
        var j = jQuery('<span class="headlineText">' + g.title + "</span>");
        c.append(j);
        var e = jQuery('<span class="goldWrapper">' + g.gold + "</span>");
        c.append(e);
        c.append(jQuery('<div class="clear"></div>'));
        var m = jQuery('<h2 class="subHeadline">' + g.subHeadLine + "</h2>");
        var o = jQuery('<div class="goldButtonWrapper"></div>');
        var p = jQuery("<div>" + g.goldButton + "</div>");
        var h = jQuery('<div class="buttonSubTitle">' + g.buttonSubtitle + "</div>");
        o.append(p);
        o.append(h);
        var n = jQuery('<h3 class="extraFeatures">' + g.plusPopupButtonExtraFeatures + "</h3>");
        var i = jQuery("<div></div>");
        var f = jQuery('<div class="furtherFeatures"></div>');
        jQuery.each(g.features, function (r, q) {
            if (r === l.options.featureKey) {
                i.append(jQuery('<div class="feature featureInfo">' + l.options.featureMarkup(q.title, q.text, r) + "</div>"))
            } else {
                f.append(jQuery('<div class="feature featureInfo">' + l.options.featureMarkup(q.title, q.text, r) + "</div>"))
            }
        });
        var d = jQuery('<p class="furtherInfos">' + g.furtherInfos + "</p>");
        b.append(c);
        b.append(i);
        b.append(m);
        b.append(o);
        b.append(n);
        b.append(f);
        b.append(d);
        p.on("click", function () {
            l.goldButtonClicked()
        });
        return b
    };
    this.reload = function () {
        this.contentReloaded = true;
        Travian.Dialog.Ajax.prototype.reload.call(this)
    };
    this.goldButtonClicked = function () {
        this.requestSent = true;
        jQuery(window).trigger("startWayOfPayment", ["plus", "plus"]);
        return false
    };
    this.close = function () {
        if (this.requestSent && this.contentReloaded) {
            return window.location.reload()
        }
        Travian.Dialog.Ajax.prototype.close.call(this)
    };
    Travian.Dialog.Ajax.call(this, Object.assign({
        data: {cmd: "plusPopup"},
        saveOnUnload: false,
        cssClass: "brown premiumFeaturePackage premiumFeaturePlus",
        buttonOk: false,
        context: "plus",
        darkOverlay: true,
        overlayCancel: false,
        featureMarkup: function (c, b, d) {
            return ['<div class="featureImage ' + d + '"></div>', '<div class="featureContent">', '<h3 class="featureTitle">' + c + "</h3>", '<div class="featureText">' + b + "</div>", "</div>", '<div class="clear"></div>'].join("")
        }
    }, a))
};
Travian.Game.PlusDialog.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.PlusDialog.constructor = Travian.Game.PlusDialog;
Travian.Game.GoldclubDialog = function (a) {
    this.options = Object.assign({
        data: {cmd: "goldclubPopup"},
        cssClass: "brown premiumFeaturePackage premiumFeatureGoldclub",
        buttonOk: false,
        context: "goldclub",
        darkOverlay: true,
        overlayCancel: false,
        saveOnUnload: false,
        featureMarkup: function (c, b, d) {
            return ['<div class="featureImage ' + d + '"></div>', '<div class="featureContent">', '<h3 class="featureTitle">' + c + "</h3>", '<div class="featureText">' + b + "</div>", "</div>", '<div class="clear"></div>'].join("")
        }
    }, a);
    this.request = function () {
        var b = this;
        this.options.data.context = this.context;
        Travian.ajax({
            data: this.options.data, onSuccess: function (c) {
                b.setContent(b.createContent(b, c));
                b.show()
            }
        });
        return this
    };
    this.initialize = function () {
        Travian.Dialog.Ajax.call(this, this.options)
    };
    this.createContent = function (l, h) {
        var m = this;
        var b = jQuery('<div class="paymentPopupDialogWrapper"></div>');
        var c = jQuery("<h1></h1>");
        var k = jQuery('<span class="headlineText">' + h.title + "</span>");
        c.append(k);
        var e = jQuery('<span class="goldWrapper">' + h.gold + "</span>");
        c.append(e);
        c.append(jQuery('<div class="clear"></div>'));
        var n = jQuery('<h2 class="subHeadline">' + h.subHeadLine + "</h2>");
        var o = jQuery('<div class="goldButtonWrapper"></div>');
        var p = jQuery("<div>" + h.goldButton + "</div>");
        var i = jQuery('<div class="buttonSubTitle">' + h.buttonSubtitle + "</div>");
        o.append(p);
        o.append(i);
        var g = jQuery('<h3 class="extraFeatures">' + h.goldclubPopupButtonExtraFeatures + "</h3>");
        var j = jQuery("<div></div>");
        var f = jQuery('<div class="furtherFeatures"></div>');
        jQuery.each(h.features, function (r, q) {
            if (r === m.options.featureKey) {
                j.append(jQuery('<div class="feature featureInfo">' + m.options.featureMarkup(q.title, q.text, r) + "</div>"))
            } else {
                f.append(jQuery('<div class="feature featureInfo">' + m.options.featureMarkup(q.title, q.text, r) + "</div>"))
            }
        });
        var d = jQuery('<p class="furtherInfos">' + h.furtherInfos + "</p>");
        b.append(c);
        b.append(j);
        b.append(n);
        b.append(o);
        b.append(g);
        b.append(f);
        b.append(d);
        p.on("click", function () {
            m.goldButtonClicked()
        });
        return b
    };
    this.goldButtonClicked = function () {
        this.requestSend = true;
        jQuery(window).trigger("startWayOfPayment", ["goldclub", "goldclub"]);
        return false
    };
    this.initialize()
};
Travian.Game.GoldclubDialog.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.GoldclubDialog.constructor = Travian.Game.GoldclubDialog;
Travian.Game.ProductionBoostDialog = function (a) {
    this.request = function () {
        var b = this;
        this.options.data.context = this.context;
        Travian.ajax({
            data: this.options.data, onSuccess: function (c) {
                b.setContent(b.createContent(b, c));
                b.bindElements();
                b.show()
            }
        });
        return this
    };
    this.toggleAutoprolong = function (e, b) {
        var d = this;
        var c = {};
        c.cmd = "premiumFeature";
        c.featureKey = e;
        c.toggleAutoprolong = 1;
        Travian.ajax({
            data: c, onSuccess: function () {
                Travian.WindowManager.reloadWindowsByContext(b)
            }, onFailure: function () {
                d.reload()
            }
        })
    };
    this.createContent = function (h, f) {
        var b = jQuery('<div class="paymentPopupDialogWrapper"/>');
        var i = jQuery('<h1 class="headline"></h1>').html(f.title);
        var e = jQuery('<span class="goldWrapper"></span>').html(f.gold);
        i.append(e);
        var c = jQuery('<h3 class="subHeadLine"></h3>').html(f.productionBoostChooseText);
        var j = jQuery('<div class="featureCollection" id="featureCollectionWrapper"></div>');
        for (var k in f.features) {
            var g = jQuery('<div class="feature featureBooking">').html(h.options.featureMarkup(k, f.features[k].title, f.features[k].subtitle, f.features[k].subtitleClassExtension, f.features[k].button, f.features[k].buttonSubtitle));
            j.append(g)
        }
        var d = jQuery('<p class="furtherInfos"/>').html(f.furtherInfos);
        b.append(i);
        b.append(c);
        b.append(j);
        b.append(d);
        return b
    };
    this.bindElements = function () {
        var b = this;
        var c = jQuery("#featureCollectionWrapper");
        c.find("button.productionBoostButton").each(function (d, e) {
            var f = jQuery(e);
            f.off("click");
            f.on("click", function (h) {
                b.requestSend = true;
                var g = jQuery(window);
                var i = jQuery(this);
                if (i.hasClass("wood")) {
                    g.trigger("startWayOfPayment", ["productionboostWood", "productionBoost"])
                } else {
                    if (i.hasClass("clay")) {
                        g.trigger("startWayOfPayment", ["productionboostClay", "productionBoost"])
                    } else {
                        if (i.hasClass("iron")) {
                            g.trigger("startWayOfPayment", ["productionboostIron", "productionBoost"])
                        } else {
                            if (i.hasClass("crop")) {
                                g.trigger("startWayOfPayment", ["productionboostCrop", "productionBoost"])
                            }
                        }
                    }
                }
                return false
            })
        });
        c.find(".checkbox").each(function (d, e) {
            var f = jQuery(e);
            f.off("click");
            f.on("click", function (g) {
                if (f.hasClass("prolongProductionboostWood")) {
                    return b.toggleAutoprolong("productionboostWood", "productionBoost")
                } else {
                    if (f.hasClass("prolongProductionboostClay")) {
                        return b.toggleAutoprolong("productionboostClay", "productionBoost")
                    } else {
                        if (f.hasClass("prolongProductionboostIron")) {
                            return b.toggleAutoprolong("productionboostIron", "productionBoost")
                        } else {
                            if (f.hasClass("prolongProductionboostCrop")) {
                                return b.toggleAutoprolong("productionboostCrop", "productionBoost")
                            } else {
                                if (f.hasClass("prolongPlus")) {
                                    return b.toggleAutoprolong("plus", "plus")
                                }
                            }
                        }
                    }
                }
                return false
            })
        })
    };
    this.close = function () {
        if (typeof this.requestSend !== "undefined" && this.requestSend === true) {
            return window.location.reload()
        }
        Travian.Dialog.Ajax.prototype.close.call(this)
    };
    Travian.Dialog.Ajax.call(this, Object.assign({
        data: {cmd: "productionBoostPopup"},
        cssClass: "brown premiumFeatureProductionBoost",
        buttonOk: false,
        context: "productionBoost",
        darkOverlay: true,
        overlayCancel: false,
        saveOnUnload: false,
        featureMarkup: function (e, g, c, b, d, f) {
            return ['<div class="featureImage ' + e + '"></div>', '<div class="featureContent">', '<h3 class="featureTitle productionBoostTitle">' + g + "</h3>", '<div class="featureRemainingTime productionBoostSubtitle subtitle ' + b + '">' + c + "</div>", '<div class="featureButton productionBoostButtonPos">' + d + "</div>", '<div class="featureDuration featureRenewal productionBoostButtonSubtitle subtitle">' + f + "</div>", "</div>", '<div class="clear"></div>'].join("")
        }
    }, a))
};
Travian.Game.ProductionBoostDialog.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.ProductionBoostDialog.constructor = Travian.Game.ProductionBoostDialog;
Travian.Game.GoldTransferDialog = function (a, c, b) {
    this.request = function () {
        var d = this;
        this.options.data.context = this.context;
        Travian.ajax({
            data: this.options.data, onSuccess: function (e) {
                if (e.showDialog === true) {
                    d.setContent(d.createContent(d, e));
                    d.show();
                    return true
                } else {
                    window.location.href = window.location.href;
                    window.location.reload()
                }
            }
        });
        return this
    };
    this.createContent = function (e, d) {
        return d.statusText
    };
    this.close = function () {
        window.location.href = window.location.href;
        window.location.reload()
    };
    Travian.Dialog.Ajax.call(this, {
        data: {
            cmd: "goldTransfer",
            code: c,
            messageId: a,
            accept: b ? 1 : 0,
            refuse: b ? 0 : 1
        }, saveOnUnload: false
    })
};
Travian.Game.GoldTransferDialog.prototype = Object.create(Travian.Dialog.Ajax.prototype);
Travian.Game.GoldTransferDialog.constructor = Travian.Game.GoldTransferDialog;
Travian.Game.Quest = Object.create({
    options: {isTutorial: false, listData: {}, tutorialData: {}, dialogListData: {}, highlightSelectors: {}},
    tipsTurnoffAjaxTrigger: false,
    highlightObjects: [],
    highlightsToggle: undefined,
    setOptions: function (a) {
        this.options = Object.assign({}, this.options, a)
    },
    dialog: {quest: null, achievement: null},
    mentorClick: function (a) {
        if (Travian.WindowManager.getWindowsByContext("quest").length > 0) {
            Travian.WindowManager.closeByContext("quest")
        } else {
            if (this.options.isTutorial === true) {
                if (typeof a === "undefined" || a === "") {
                    throw ("Keine ID zur Darstellung an den Questdialog übergeben!")
                }
                this.openInformationDialog(a, this.options.tutorialData.answersLink)
            } else {
                this.openTodoListDialog(this.options.dialogListData.answersLink)
            }
        }
    },
    rewardButtonClick: function (b) {
        Travian.WindowManager.closeByContext("quest");
        var a = {cmd: "quest", questTutorialId: b, action: "reward"};
        if (b.search(/DailyQuest/) !== -1) {
            a = {cmd: "dailyquests", questId: b, action: "reward"}
        }
        Travian.ajax({data: a})
    },
    skipButtonClick: function () {
        Travian.ajax({data: {cmd: "quest", action: "skip"}})
    },
    nextButtonClick: function (a) {
        Travian.ajax({data: {cmd: "quest", questTutorialId: a, action: "next"}})
    },
    createHighlights: function () {
        var d = this;
        var b;
        for (b = 0; b < this.highlightObjects.length; b++) {
            this.highlightObjects[b].deactivate(true)
        }
        this.highlightObjects = [];
        for (b = 0; b < this.options.highlightSelectors.length; b++) {
            var c = this.options.highlightSelectors[b];
            var a = jQuery(c.selector);
            if (a.length > 0) {
                a.each(function (f, h) {
                    var i = 1000;
                    var g = {};
                    if (c.selector.match(/^\.dialog/)) {
                        i = Travian.WindowManager.getCurrentZIndex() + 2;
                        g.draggable = true
                    }
                    var e = new Travian.Game.Highlight({
                        element: h,
                        renderer: c.renderer,
                        rendererOptions: Object.assign({zIndex: i}, g)
                    });
                    d.highlightObjects.push(e);
                    if (d.highlightsToggle === true) {
                        e.activate()
                    }
                });
                break
            }
        }
    },
    toggleHighlights: function (b, a) {
        this.highlightsToggle ? this.disableHightlights(b, a) : this.enableHighlighs(b, a)
    },
    enableHighlighs: function (b, a) {
        this.highlightsToggle = true;
        Travian.Game.Preferences.set("highlightsToggle", this.highlightsToggle);
        this.drawHighlights(b, a)
    },
    disableHightlights: function (b, a) {
        this.highlightsToggle = false;
        Travian.Game.Preferences.set("highlightsToggle", this.highlightsToggle);
        this.drawHighlights(b, a)
    },
    drawHighlights: function (e, b) {
        var d = this.highlightsToggle;
        var a = jQuery("#questTutorialLightBulb");
        if (a.length > 0) {
            if (d === true) {
                a.addClass("bulbActive").removeClass("bulbWhite");
                if (b) {
                    Travian.Tip.set(a, b);
                    Travian.Tip.show(b)
                }
            } else {
                a.removeClass("bulbActive").addClass("bulbWhite");
                if (e) {
                    Travian.Tip.set(a, e);
                    Travian.Tip.show(e)
                }
            }
        }
        if (typeof this.tipsTurnoffAjaxTrigger === "function" && d === false) {
            this.tipsTurnoffAjaxTrigger()
        }
        this.createHighlights();
        for (var c = 0; c < this.highlightObjects.length; c++) {
            if (d === true) {
                this.highlightObjects[c].activate()
            } else {
                this.highlightObjects[c].deactivate(true)
            }
        }
    },
    openInformationDialog: function (f, a, b) {
        var c = (this.options.isTutorial ? "tutorial" : "quest");
        var e = "quest";
        if (f.search(/Achievement/) !== -1 || f.search(/DailyQuest/) !== -1) {
            e = "achievement"
        }
        var d = this;
        if (this.dialog[e] === null) {
            Travian.WindowManager.closeByContext("quest");
            this.dialog[e] = new Travian.Dialog.Ajax({
                resizeDialogIfOverflow: false,
                data: {cmd: "quest", questTutorialId: f, action: b},
                context: e,
                buttonOk: false,
                enableBackground: this.options.isTutorial,
                darkOverlay: this.options.isTutorial,
                draggable: true,
                savePositionForSession: {preferenceKey: "QuestDialogPosition"},
                saveOnUnload: true,
                overlayCancel: false,
                infoIcon: a,
                cssClass: "white questInformation " + f + " " + c,
                preventFormSubmit: true,
                buttonTextInfo: Travian.Translation.get("answers." + f.toLowerCase() + "_title") || "Answers",
                topHeaderOffset: (e === "achievement" ? 40 : 0),
                fx: {open: {opacity: 1}, close: {opacity: 0}, duration: 0},
                onOpen: function () {
                    d.drawHighlights()
                },
                onClose: function () {
                    d.dialog[e] = null;
                    if (d.options.isTutorial) {
                        if (d.options.tutorialData.id === "Tutorial_01") {
                            Travian.Game.Preferences.set("firstTutorialClosed", true)
                        }
                    }
                },
                afterClose: function () {
                    d.drawHighlights()
                }
            })
        } else {
            if (f.search(/DailyQuest/) !== -1) {
                this.dialog[e].options.data.cmd = "dailyquests";
                this.dialog[e].options.data.questId = f
            } else {
                this.dialog[e].options.data.cmd = "quest";
                this.dialog[e].options.data.questTutorialId = f
            }
            this.dialog[e].displayButtonOk(false);
            this.dialog[e].options.data.action = b;
            this.dialog[e].options.infoIcon = a;
            this.dialog[e].options.buttonTextInfo = Travian.Translation.get("answers." + f.toLowerCase() + "_title") || "Answers";
            this.dialog[e].request()
        }
        this.dialog[e].wrapper.find("form").off("submit");
        this.dialog[e].wrapper.find("form").on("submit", function (g) {
            g.stopPropagation();
            return false
        })
    },
    openTodoListDialog: function (i, g) {
        var f = this;
        var d = "quest";
        var h = "quest";
        var e = false;
        var b = "";
        var a = false;
        var c = true;
        if (typeof g !== "undefined" && g !== null) {
            d = "dailyquests";
            h = "achievement";
            e = true;
            b = Travian.Translation.get("allgemein.close_with_capital_c");
            a = true;
            c = false
        }
        if (this.dialog[h] === null) {
            Travian.WindowManager.closeByContext(d);
            this.dialog[h] = new Travian.Dialog.Ajax({
                resizeDialogIfOverflow: false,
                data: {cmd: d},
                context: h,
                buttonOk: e,
                buttonTextOk: b,
                buttonCloseOnClickOk: a,
                enableBackground: false,
                draggable: true,
                infoIcon: i,
                savePositionForSession: {preferenceKey: "QuestDialogAchievementPosition"},
                saveOnUnload: c,
                overlayCancel: false,
                cssClass: "white questTodoList",
                preventFormSubmit: true,
                topHeaderOffset: (h === "achievement" ? 40 : 0),
                fx: {open: {opacity: 1}, close: {opacity: 0}, duration: 0},
                onClose: function () {
                    f.dialog[h] = null
                }
            })
        } else {
            this.dialog[h].options.data.cmd = d;
            this.dialog[h].displayButtonOk(e);
            this.dialog[h].options.infoIcon = null;
            this.dialog[h].options.data.questId = undefined;
            this.dialog[h].options.data.questTutorialId = undefined;
            this.dialog[h].options.data.action = undefined;
            this.dialog[h].request()
        }
    },
    bindListDelegation: function (a) {
        var b = this;
        a.on("click", function (f) {
            f.stopPropagation();
            var d = jQuery(f.delegateTarget);
            var c = d.attr("data-questId");
            var e = d.attr("data-category");
            if (e && c) {
                b.openInformationDialog(c, b.options.listData[e].quests[c].answersLink)
            }
        })
    },
    initializeQuests: function () {
        if (this.options.isTutorial && this.options.tutorialData.id === "Tutorial_01" && Travian.Game.Preferences.get("firstTutorialClosed") !== true) {
            if (Travian.WindowManager.getWindowsByContext("quest").length === 0) {
                this.openInformationDialog(this.options.tutorialData.id, this.options.tutorialData.answersLink)
            }
        }
    },
    addListData: function (b) {
        var b = b || {};
        for (var a in b) {
            if (b.hasOwnProperty(a)) {
                this.options.listData[a] = b[a]
            }
        }
    },
    closeDialog: function () {
        if (this.dialog.quest !== null) {
            this.dialog.quest.close()
        }
    }
});
jQuery(function () {
    Travian.Game.Quest.highlightsToggle = Travian.Game.Preferences.get("highlightsToggle");
    Travian.Game.Quest.drawHighlights(false, false)
});
Travian.Game.ReportSpamMessagesDialog = {
    reportSpam: function (d, f, g, h, a) {
        var e = [];
        var b = '<select size="1" id="spamReason">';
        for (var i in a) {
            if (a.hasOwnProperty(i)) {
                b += '<option value="' + i + '">' + a[i] + "</option>"
            }
        }
        b += '</select><br/><br/><span class="notice">' + h + "</span>";
        var c = new Travian.Dialog.Dialog({
            title: f,
            keepOpen: true,
            buttonTextOk: g,
            preventFormSubmit: true,
            onOpen: function () {
                c.disableForm()
            },
            onOkay: function () {
                if (e.length > 0) {
                    Travian.ajax({
                        data: {cmd: "reportSpamMessage", messageId: d, spamReason: e.val()},
                        onSuccess: function (j) {
                            if (undefined !== j.reportingSuccessful && j.reportingSuccessful) {
                                c.setContent(j.reportingSuccessful);
                                jQuery(".dialog button").html(j.closeButtonText);
                                jQuery("#reportSpam").addClass("disabled").off("click").attr("onclick", function () {
                                    return false
                                });
                                c.enableForm();
                                jQuery(".dialog form").on("submit", function (k) {
                                    k.stopPropagation();
                                    c.close()
                                })
                            }
                        }
                    })
                }
            }
        });
        c.setContent(b);
        c.show();
        e = jQuery("#spamReason");
        e.on("change", function () {
            var j = e.val() === "not_chosen";
            c.toggleFormState(j)
        })
    }
};
Travian.Game.Village = {
    toggleBuildingLevels: function () {
        var c = jQuery("#lswitch"), b;
        c.toggleClass("lswitchMinus").toggleClass("lswitchPlus");
        b = c.hasClass("lswitchPlus");
        if (b) {
            Travian.Game.Preferences.set("t4level", 1)
        } else {
            Travian.Game.Preferences.set("t4level", undefined)
        }
        var d = new TimelineLite();
        var a = jQuery(".buildingSlot .level");
        if (b) {
            d.staggerTo(".buildingSlot .level", 0.3, {
                opacity: 0,
                marginTop: "20px",
                ease: Power4.easeOut
            }, 0.02, "+=0", function () {
                a.find("div.labelLayer").each(function (e, g) {
                    var i = jQuery(g);
                    var h = i.html(), f = i.parent();
                    i.remove();
                    f.html(h).removeClass("colorLayer")
                });
                d.staggerTo(".buildingSlot .level", 0.3, {opacity: 1, marginTop: 0, ease: Power4.easeOut}, 0.02)
            })
        } else {
            d.staggerTo(".buildingSlot .level", 0.3, {
                opacity: 0,
                marginTop: "20px",
                ease: Power4.easeOut
            }, 0.02, "+=0", function () {
                a.each(function (e, f) {
                    var g = jQuery(f);
                    var i = g.html(), h = jQuery("<div/>").addClass("labelLayer").html(i);
                    g.addClass("colorLayer").html("").append(h)
                });
                d.staggerTo(".buildingSlot .level", 0.3, {opacity: 1, marginTop: 0, ease: Power4.easeOut}, 0.02)
            })
        }
    }, initializeWallStates: function () {
        var b = jQuery(".a40 svg");
        var a = jQuery(b.find("path"));
        a.hover(function () {
            b.addClass("hover")
        }, function () {
            b.removeClass("hover")
        });
        a.on("mousedown touchstart", function () {
            b.addClass("active")
        });
        a.on("mouseup mouseleave blur touchend", function () {
            b.removeClass("active")
        })
    }
};
Travian.TabManager = {
    handlers: {
        payment: function (a) {
            jQuery(window).trigger("startPaymentWizard", {data: {activeTab: a}})
        }
    }, applyAnchor: function (a) {
        var b = a.split("-"), c = b[0].substring(1);
        delete b[0];
        if (b.length && Travian.TabManager.handlers[c] !== undefined) {
            return Travian.TabManager.handlers[c](b.join(""))
        }
    }
};
jQuery(function () {
    var a = window.location.hash.trim();
    if (a !== "") {
        Travian.TabManager.applyAnchor(a)
    }
});
Travian.Game.Vacation = {
    dialog: null, updateVacationTime: function (d, b) {
        var c = parseInt(Date.now()) + parseInt(d) * 86400000, a = function (g, j) {
            var e = function (n) {
                    return (n < 10) ? "0" + n : n
                }, f = new Date(g.getTime() + g.getTimezoneOffset() * 60000 + j * 1000), l = e(f.getDate()),
                i = e(f.getMonth() + 1), k = e(f.getFullYear() % 100), h = e(f.getHours()), m = e(f.getMinutes());
            return l + "." + i + "." + k + ", " + h + ":" + m
        };
        jQuery("#vacationTime").html(a(new Date(c), b))
    }, closeDialog: function () {
        if (this.dialog !== null) {
            this.dialog.close()
        }
    }, showDialog: function (a) {
        this.closeDialog();
        this.dialog = new Travian.Dialog.Dialog({
            buttonOk: false,
            type: Travian.Dialog.DIALOG_TYPE_MODAL,
            submitMethod: "post",
            submitUrl: "options.php?s=4",
            keepOpen: true
        });
        this.dialog.setContent(a);
        this.dialog.show()
    }, openConfirmation: function () {
        Travian.ajax({
            data: {cmd: "vacationModeConfirmation", params: jQuery("#dayInput").val()},
            onSuccess: function (a) {
                if (a.html !== "") {
                    Travian.Game.Vacation.showDialog(a.html)
                } else {
                    Travian.Game.Vacation.closeDialog()
                }
            }
        })
    }
};
Travian.Game.Arifact = {
    setAutoProlongue: function (b, a) {
        Travian.ajax({data: {cmd: "artifact", id: b, action: "reactivate", state: a ? 1 : 0}})
    }
};
Travian.Game.Map = (function () {
    var a = 0;
    return {
        _map: null, Containers: null, version: 1, getNewId: function () {
            a++;
            return "mapId" + a
        }, isPositionInRect: function (c, b) {
            return (c.x0 <= b.x && c.y0 <= b.y && b.x <= c.x1 && b.y <= c.y1)
        }, register: function (b) {
        }, wrapCoordinate: function (f, e) {
            var d = Travian.Defaults.Map.Size;
            var c = ((f - d.left) % d.width + d.width) % d.width + d.left;
            var b = ((e - d.bottom) % d.height + d.height) % d.height + d.bottom;
            return {$x: c, $y: b}
        }, xy2id: function (d, c) {
            var e = this.wrapCoordinate(d, c);
            var b = Travian.Defaults.Map.Size;
            return (b.top - e.$y) * b.width + (e.$x - b.left) + 1
        }
    }
})();
Travian.Game.Map.Base = function (a, d) {
    this.options = Object.assign({}, a);
    var c;
    for (c in a) {
        if (a.hasOwnProperty(c)) {
            this[c] = a[c]
        }
    }
    if (this.id == null) {
        this.id = Travian.Game.Map.getNewId()
    }
    if (d) {
        this.parentContainer = d;
        for (var b = 0; b < this.globalProperties.length; b++) {
            c = this.globalProperties[b];
            if (this.parentContainer[c]) {
                this[c] = this.parentContainer[c]
            }
        }
        if (d.classType === "Travian.Game.Map.Container") {
            this.mapContainer = d
        } else {
            if (d.mapContainer) {
                this.mapContainer = this.parentContainer.mapContainer
            }
        }
    }
};
Travian.Game.Map.Base.prototype.classType = "Travian.Game.Map.Base";
Travian.Game.Map.Base.prototype.id = null;
Travian.Game.Map.Base.prototype.element = null;
Travian.Game.Map.Base.prototype.position = null;
Travian.Game.Map.Base.prototype.mapCoordinates = null;
Travian.Game.Map.Base.prototype.contextMenu = null;
Travian.Game.Map.Base.prototype.transition = null;
Travian.Game.Map.Base.prototype.updater = null;
Travian.Game.Map.Base.prototype.globalProperties = ["cookie", "dataStore", "transition", "updater", "contextMenu"];
Travian.Game.Map.Base.prototype.parentContainer = null;
Travian.Game.Map.Base.prototype.render = function (a) {
    a = a || {};
    if (!a.nodeType) {
        a.nodeType = "<div/>"
    }
    this.element = jQuery(a.nodeType).prop("unselectable", "on");
    return this
};
Travian.Game.Map.Base.prototype.destroy = function () {
    if (this.element) {
        this.element.remove()
    }
};
Travian.Game.Map.Base.prototype.isCoordinatesInRect = function (a) {
    return (this.mapCoordinates.x <= a.x && this.mapCoordinates.y <= a.y && a.x <= this.mapCoordinates.right && a.y <= this.mapCoordinates.top)
};
Travian.Game.Map.Base.prototype.isPositionInRect = function (a) {
    return Travian.Game.Map.isPositionInRect({
        x0: this.position.x,
        y0: this.position.y,
        x1: this.position.x + this.position.width,
        y1: this.position.y + this.position.height
    }, a)
};
Travian.Game.Map.Container = (function () {
    var b = function (e) {
        var h = false;
        var d = false;
        var n = null;
        var i = {count: 0, shift: false, control: false, alt: false, keys: {}, fn: null};
        for (var m in e.keyboard) {
            if (e.keyboard.hasOwnProperty(m)) {
                var j = e.keyboard[m];
                if (typeof e.keyboard[m] === "string") {
                    e.keyboard[m] = {fn: e.keyboard[m]}
                }
                e.keyboard[m] = Object.assign({periodical: 1}, e.keyboard[m]);
                if (typeof e.keyboard[m].fn === "string") {
                    i.keys[m] = false
                }
            }
        }
        var o = e.containerRender.css("cursor");
        var c = function (p) {
            return jQuery(p.target).closest("div.dialog-container").length
        };
        var l = function (r, p, t, q) {
            if (c(r)) {
                return
            }
            if (!e.isEventsEnabled()) {
                return
            }
            var s = (r.which === 3 || r.button === 2);
            if (e.containerViewSize.x <= p && e.containerViewSize.y <= t && p <= e.containerViewSize.right && t <= e.containerViewSize.bottom && q === e.containerMover.get(0) && !s) {
                h = true;
                d = false;
                n = {x: p, y: t};
                r.stopPropagation()
            }
        };
        var g = function (q, p, s) {
            if (e.containerViewSize.x <= p && e.containerViewSize.y <= s && p <= e.containerViewSize.right && s <= e.containerViewSize.bottom) {
                e.currentMousePosition.browserAbsolute.x = p;
                e.currentMousePosition.browserAbsolute.y = s;
                e.currentMousePosition.browser.x = p - e.containerSize.x - e.elementSize.x;
                e.currentMousePosition.browser.y = s - e.containerSize.y - e.elementSize.y;
                e.currentMousePosition.map = e.transition.translateToMap(e.currentMousePosition.browser, {})
            } else {
                e.currentMousePosition.browserAbsolute.x = null;
                e.currentMousePosition.browserAbsolute.y = null;
                e.currentMousePosition.browser.x = null;
                e.currentMousePosition.browser.y = null;
                e.currentMousePosition.map.x = null;
                e.currentMousePosition.map.y = null
            }
            if (!h) {
                return
            }
            if (!e.isEventsEnabled()) {
                return
            }
            var r = {x: p - n.x, y: -(s - n.y)};
            if ((Math.abs(r.x) + Math.abs(r.y)) > 0) {
                n = {x: p, y: s};
                d = true;
                e.containerRender.css({cursor: "move"});
                e.move(r)
            }
            q.stopPropagation()
        };
        var k = function (q, p, t) {
            if (c(q)) {
                return
            }
            if (!e.isEventsEnabled()) {
                return
            }
            var s = (q.which === 3 || q.button === 2);
            if (p !== null && t !== null && e.containerViewSize.x <= p && e.containerViewSize.y <= t && p <= e.containerViewSize.right && t <= e.containerViewSize.bottom && !s && !d && h && !Travian.WindowManager.checkOpenWindowByContext("map")) {
                var r = e.transition.translateToMap({
                    x: p - e.containerViewSize.x - e.elementSize.x,
                    y: t - e.containerViewSize.y - e.elementSize.y
                }, {});
                if (e.tileDisplayInformation.type === "dialog") {
                    new Travian.Dialog.Ajax(Object.assign({}, e.tileDisplayInformation.optionsDialog, {
                        context: "map",
                        stickToUrlOnRestore: true,
                        data: {cmd: "viewTileDetails", x: r.x, y: r.y},
                        onOpen: function (v, u) {
                            jQuery(u).find('a[href^="karte.php"]').on("click", function (x) {
                                x.preventDefault();
                                var w = Travian.parseURL(x.target.href);
                                e.moveTo({x: parseInt(w.searchObject.x || "0"), y: parseInt(w.searchObject.y || "0")});
                                v.close();
                                return false
                            })
                        }
                    }))
                } else {
                    Travian.popup(Travian.Helpers.substitute(e.tileDisplayInformation.optionsPopup.url, r), e.tileDisplayInformation.optionsPopup.windowOptions)
                }
            }
            e.containerRender.css({cursor: o});
            if (d) {
                q.stopPropagation();
                e.updateBrowserURL(e.transition.getPointOfCenterInView())
            }
            h = false;
            d = false
        };
        var f = null;
        jQuery(window).on({
            selectstart: function (p) {
                if (c(p)) {
                    return
                }
                if (!e.isEventsEnabled()) {
                    return
                }
                if (!d) {
                    return
                }
                p.stopPropagation();
                return false
            }, dragstart: function (p) {
                if ($(p.target).closest("div.dialog-container").length) {
                    return
                }
                if (!e.isEventsEnabled()) {
                    return
                }
                if (!d) {
                    return
                }
                p.stopPropagation();
                return false
            }, mousedown: function (p) {
                l(p, p.pageX, p.pageY, p.target)
            }, mousemove: function (p) {
                if (c(p)) {
                    return
                }
                g(p, p.pageX, p.pageY);
                p.preventDefault()
            }, mouseup: function (p) {
                k(p, p.pageX, p.pageY)
            }, wheel: function (p) {
                if (!e.isEventsEnabled()) {
                    return
                }
                if (e.containerViewSize.x <= p.pageX && e.containerViewSize.y <= p.pageY && p.pageX <= e.containerViewSize.right && p.pageY <= e.containerViewSize.bottom && p.target === e.containerMover.get(0)) {
                    var q = e.transition.translateToMap({
                        x: p.pageX - e.containerViewSize.x - e.elementSize.x,
                        y: p.pageY - e.containerViewSize.y - e.elementSize.y
                    }, {});
                    if (p.originalEvent.deltaY > 0) {
                        e.zoomOut(q)
                    } else {
                        if (p.originalEvent.deltaY < 0) {
                            e.zoomIn(q)
                        }
                    }
                    p.preventDefault()
                }
            }, touchstart: function (p) {
                f = p;
                l(p, p.touches[0].pageX, p.touches[0].pageY, p.touches[0].target)
            }, touchend: function (r) {
                var q = f.touches[0].pageX, p = f.touches[0].pageY;
                f = null;
                k(r, q, p);
                if (r.target === e.containerMover.get(0)) {
                    return false
                }
            }, keydown: function (p) {
                if (!e.isEventsEnabled()) {
                    return
                }
                if (p.shiftKey) {
                    i.shift = true
                }
                if (p.ctrlKey) {
                    i.control = true
                }
                if (p.altKey) {
                    i.alt = true
                }
                if (i.keys[p.keyCode] === false && p.target.nodeName.toLowerCase() !== "input") {
                    i.count++;
                    i.keys[p.keyCode] = true;
                    p.stopPropagation();
                    if (!i.fnTimer) {
                        i.fn = function () {
                            var u = 0;
                            for (var r in i.keys) {
                                if (i.keys.hasOwnProperty(r) && i.keys[r]) {
                                    var t = i.keys[r];
                                    if (t) {
                                        if (!e.keyboard[r]) {
                                            return
                                        }
                                        var w = e.keyboard[r].fn;
                                        if (w === false || !e[w]) {
                                            return
                                        }
                                        var s = "";
                                        if (w.substring(0, 4) === "move") {
                                            s = "normal";
                                            var q = e.keyboard.speed.slow;
                                            var v = e.keyboard.speed.fast;
                                            if (i[q] && !i[v]) {
                                                s = "slow"
                                            } else {
                                                if (!i[q] && i[v]) {
                                                    s = "fast"
                                                }
                                            }
                                        } else {
                                            if (w.substring(0, 4) === "zoom") {
                                                s = null
                                            }
                                        }
                                        e[w](s)
                                    }
                                    u += e.keyboard[r].periodical
                                }
                            }
                            if (u > 0) {
                                i.fnTimer = requestAnimationFrame(i.fn)
                            }
                        };
                        if (e.keyboard[p.keyCode].periodical === 0) {
                            i.fn()
                        } else {
                            if (e.keyboard[p.keyCode].periodical > 0) {
                                i.fnTimer = requestAnimationFrame(i.fn)
                            }
                        }
                    }
                }
            }, keyup: function (p) {
                if (!e.isEventsEnabled()) {
                    return
                }
                if (!p.shift) {
                    i.shift = false
                }
                if (!p.control) {
                    i.control = false
                }
                if (!p.alt) {
                    i.alt = false
                }
                if (i.keys[p.keyCode]) {
                    i.count--;
                    i.keys[p.keyCode] = false;
                    p.stopPropagation();
                    if (i.count === 0 && i.fnTimer) {
                        cancelAnimationFrame(i.fnTimer);
                        i.fnTimer = null;
                        e.updateBrowserURL(e.transition.getPointOfCenterInView())
                    }
                }
            }
        });
        window.addEventListener("touchmove", function (p) {
            if (p.target === e.containerMover.get(0)) {
                p.preventDefault()
            }
            g(p, p.touches[0].pageX, p.touches[0].pageY);
            return false
        }, {passive: false})
    };
    var a = function (c) {
        this.blocks = null;
        this.classType = "Travian.Game.Map.Container";
        this.containerRender = null;
        this.containerSize = null;
        this.containerViewSize = null;
        this.currentMousePosition = {
            browserAbsolute: {x: null, y: null},
            browser: {x: null, y: null},
            map: {x: null, y: null}
        };
        this.element = null;
        this.elementSize = null;
        this.eventsEnabled = true;
        this.gridDisplayed = true;
        this.loading = false;
        this.forcedUpdates = 0;
        this.savedURL = {};
        this.mapMarks = {};
        this.addSymbol = function (i) {
            var j = this.blocks.find(function (k) {
                return k.isCoordinatesInRect(i.position)
            });
            if (j) {
                j.addSymbol(i)
            }
            return this
        };
        this.deleteSymbol = function (i) {
            var j = this.blocks.find(function (k) {
                return k.isCoordinatesInRect(i.position)
            });
            if (j) {
                j.deleteSymbol(i)
            }
            return this
        };
        this.disableEvents = function () {
            this.eventsEnabled = false;
            return this
        };
        this.enableEvents = function () {
            this.eventsEnabled = true;
            return this
        };
        this.forceUpdateBlocksLayer = function (i) {
            this.forcedUpdates = this.forcedUpdates + 1;
            this.blocks.forEach(function (j) {
                j.forceUpdateLayer(i)
            });
            return this
        };
        this.forceUpdateBlocksSymbols = function (j, i) {
            this.blocks.forEach(function (k) {
                k.forceUpdateSymbols(j, i)
            });
            return this
        };
        this.getContentForTooltip = function (i) {
            var j = this.blocks.find(function (k) {
                return k.isPositionInRect(i)
            });
            return j ? j.getContentForTooltip(i) : false
        };
        this.setContainerSizes = function (i) {
            this.containerViewSize = {
                x: i.x,
                y: i.y,
                width: i.width,
                height: i.height,
                right: i.x + i.width,
                bottom: i.y + i.height
            };
            this.containerSize = {
                x: this.containerViewSize.x,
                y: this.containerViewSize.y,
                width: Math.ceil(this.containerViewSize.width / this.blockSize.width) * this.blockSize.width,
                height: Math.ceil(this.containerViewSize.height / this.blockSize.height) * this.blockSize.height,
                right: this.containerViewSize.x + Math.ceil(this.containerViewSize.width / this.blockSize.width) * this.blockSize.width,
                bottom: this.containerViewSize.y + Math.ceil(this.containerViewSize.height / this.blockSize.height) * this.blockSize.height
            }
        };
        this.positionChange = function () {
            var j = Object.assign(this.containerRender.getDimensions({computeSize: true}), this.containerRender.getPosition());
            var i = {x: this.containerViewSize.x - j.x, y: this.containerViewSize.y - j.y};
            this.setContainerSizes(j);
            this.miniMap.containerPosition = this.miniMap.container.getPosition();
            this.transition.containerPositionChange(i)
        };
        this.invalidateBlockVersionCache = function () {
            for (var i in this.blocks) {
                if (this.blocks.hasOwnProperty(i)) {
                    this.blocks[i].invalidateVersionCache()
                }
            }
            return this
        };
        this.isEventsEnabled = function () {
            return this.eventsEnabled
        };
        this.updateBrowserURL = function (i) {
            this.savedURL.searchObject = Object.assign(this.savedURL.searchObject, i);
            window.history.replaceState(this.savedURL, document.title, Travian.composeURI(this.savedURL));
            jQuery(document).trigger("toolbar.updateCoordinates", [i])
        };
        this.move = function (i) {
            this.transition.move(i);
            if (this.blocks !== null) {
                this.blocks.forEach(function (j) {
                    j.move(i)
                })
            }
            if (this.loading) {
                if (!this.blockInitialDelta) {
                    this.blockInitialDelta = {x: 0, y: 0}
                }
                this.blockInitialDelta.x += i.x;
                this.blockInitialDelta.y += i.y
            }
            this.onMove(this, i);
            return this
        };
        this.moveDown = function (i) {
            if (typeof i === "string") {
                i = this.speeds[i]
            }
            if (!i) {
                return this
            }
            return this.move({x: 0, y: i})
        };
        this.moveLeft = function (i) {
            if (typeof i === "string") {
                i = this.speeds[i]
            }
            if (!i) {
                return this
            }
            return this.move({x: i, y: 0})
        };
        this.moveLeftDown = function (i) {
            if (typeof i === "string") {
                i = this.speeds[i]
            }
            if (!i) {
                return this
            }
            return this.move({x: i, y: i})
        };
        this.moveLeftUp = function (i) {
            if (typeof i === "string") {
                i = this.speeds[i]
            }
            if (!i) {
                return this
            }
            return this.move({x: i, y: -i})
        };
        this.moveRight = function (i) {
            if (typeof i === "string") {
                i = this.speeds[i]
            }
            if (!i) {
                return this
            }
            return this.move({x: -i, y: 0})
        };
        this.moveRightDown = function (i) {
            if (typeof i === "string") {
                i = this.speeds[i]
            }
            if (!i) {
                return this
            }
            return this.move({x: -i, y: i})
        };
        this.moveRightUp = function (i) {
            if (typeof i === "string") {
                i = this.speeds[i]
            }
            if (!i) {
                return this
            }
            return this.move({x: -i, y: -i})
        };
        this.moveTo = function (j) {
            var i = this.transition.translateToBrowser({x: Math.floor(j.x), y: Math.floor(j.y)});
            i.x += this.blockSize.width / this.transition.elementsPerBlock.x / 2;
            i.y += this.blockSize.height / this.transition.elementsPerBlock.y / 2;
            i.x += (this.containerSize.width - this.containerViewSize.width) / 2;
            i.y += (this.containerSize.height - this.containerViewSize.height) / 2;
            this.updateBrowserURL(j);
            return this.move({x: this.elementSize.width / 2 - i.x, y: -(this.elementSize.height / 2 - i.y)})
        };
        this.moveUp = function (i) {
            if (typeof i === "string") {
                i = this.speeds[i]
            }
            if (!i) {
                return
            }
            return this.move({x: 0, y: -i})
        };
        this.render = function () {
            this.container = jQuery("<div/>").css({
                overflow: "hidden",
                position: "relative",
                left: 0,
                top: 0,
                width: "100%",
                height: "100%",
                right: 0,
                bottom: 0
            }).prop("unselectable", "on").attr("oncontextmenu", "return false;").prependTo(this.containerRender);
            this.elementSize = {
                x: -this.blockSize.width * this.blockOverflow,
                y: -this.blockSize.height * this.blockOverflow,
                width: this.containerSize.width + this.blockSize.width * this.blockOverflow * 2,
                height: this.containerSize.height + this.blockSize.height * this.blockOverflow * 2
            };
            Travian.Game.Map.Base.prototype.render.call(this);
            this.element.css({
                position: "absolute",
                left: this.elementSize.x,
                top: this.elementSize.y,
                width: this.elementSize.width,
                height: this.elementSize.height
            }).prependTo(this.container);
            this.containerMover = jQuery("<div/>").css({
                overflow: "hidden",
                position: "absolute",
                left: 0,
                top: 0,
                width: this.containerViewSize.width,
                height: this.containerViewSize.height,
                zIndex: 100,
                backgroundColor: "transparent",
                opacity: 1
            }).prop("unselectable", "on").appendTo(this.container);
            this.onRender(this);
            this.moveTo(this.mapInitialPosition);
            this.renderBlocks();
            if (this.gridDisplayed) {
                this.showGrid()
            }
            b(this);
            return this
        };
        this.renderBlocks = function () {
            if (this.blocks) {
                return this
            }
            this.blocks = [];
            var k = Math.ceil(this.elementSize.width / this.blockSize.width);
            var j = Math.ceil(this.elementSize.height / this.blockSize.height);
            var m = Object.assign({x: 0, y: 0}, this.blockInitialDelta);
            delete (this.blockInitialDelta);
            var o = null;
            var r = null;
            var l = null;
            for (var p = 0, n = 0; p < j; p++) {
                for (var q = 0; q < k; q++) {
                    o = Travian.Game.Map.Layer.Block.getCorrectPosition({
                        x: q * this.blockSize.width + m.x,
                        y: p * this.blockSize.height - m.y,
                        width: this.blockSize.width,
                        height: this.blockSize.height
                    }, this).position;
                    r = this.transition.translateToMap(o, {});
                    l = {id: n++, version: 0};
                    if (this.data.blocks[r.x] && this.data.blocks[r.x][r.y] && this.data.blocks[r.x][r.y][r.right] && this.data.blocks[r.x][r.y][r.right][r.top]) {
                        l = Object.assign({}, l, this.data.blocks[r.x][r.y][r.right][r.top])
                    }
                    this.blocks.push(new Travian.Game.Map.Layer.Block(Object.assign({}, this.options.block, {
                        id: l.id,
                        symbolTypes: this.symbolTypes,
                        position: o,
                        mapCoordinates: r,
                        version: l.version
                    }), this))
                }
            }
            return this
        };
        this.toggleMiniMap = function () {
            return this.miniMap.animate()
        };
        this.toggleOutline = function () {
            return this.outline.animate()
        };
        this.hideGrid = function () {
            this.cookie.set("grid", false);
            this.gridDisplayed = false;
            return this.updateGrid()
        };
        this.showGrid = function () {
            this.cookie.set("grid", true);
            this.gridDisplayed = true;
            return this.updateGrid()
        };
        this.toggleGrid = function () {
            return this.gridDisplayed ? this.hideGrid() : this.showGrid()
        };
        this.updateGrid = function () {
            var j = this;
            var i = j.gridDisplayed ? this.grid[this.transition.zoomLevel] : false;
            this.element.find(".imageMark").each(function (k, l) {
                jQuery(l).css({
                    backgroundColor: "transparent",
                    backgroundImage: i !== false ? "url(" + i + ")" : "none",
                    backgroundPosition: "left top",
                    backgroundRepeat: "repeat"
                })
            });
            return this
        };
        this.updateSymbolData = function (i) {
            var j = this.blocks.find(function (k) {
                return k.isCoordinatesInRect(i.position)
            });
            if (j) {
                j.updateSymbolData(i)
            }
            return this
        };
        this.zoom = function (k, j) {
            var i = this.transition.zoomLevel;
            if (this.transition.zoom(k)) {
                this.savedURL.searchObject.zoom = this.transition.zoomLevel;
                this.onZoom(this);
                if (T4_feature_flags.territory && i === 3 || this.transition.zoomLevel === 3) {
                    this.dataStore.removeAllOfType(Travian.Game.Map.DataStore.TYPE_TOOLTIP)
                }
                this.moveTo(j);
                if (this.gridDisplayed) {
                    this.updateGrid()
                }
            }
            return this
        };
        this.zoomIn = function (i) {
            if (!i) {
                i = this.transition.getPointOfCenterInView()
            }
            return this.zoom(-1, i)
        };
        this.zoomOut = function (i) {
            if (!i) {
                i = this.transition.getPointOfCenterInView()
            }
            return this.zoom(1, i)
        };
        this.loading = true;
        if (typeof c === "undefined") {
            c = Travian.Game.Map.Options.Default
        }
        Travian.Game.Map.Base.call(this, c);
        this.onMove = this.onMove || Travian.emptyFunction;
        this.onCreate = this.onCreate || Travian.emptyFunction;
        this.onRender = this.onRender || Travian.emptyFunction;
        this.onZoom = this.onZoom || Travian.emptyFunction;
        Travian.Game.Map.register(this);
        this.cookie = new Travian.Cookie.Object(this.id);
        this.containerRender = this.container = jQuery(this.container);
        Travian.Game.Map._map = this;
        var h = {
            x: this.containerRender.offset().left,
            y: this.containerRender.offset().top,
            width: this.containerRender.width(),
            height: this.containerRender.height()
        };
        this.setContainerSizes(h);
        for (var e = 0; e < this.globalProperties.length; e++) {
            var g = this.globalProperties[e];
            var f = Travian.Helpers.capitalizeFirstLetter(g);
            if (Travian.Game.Map[f]) {
                this[g] = new Travian.Game.Map[f](this[g] || {}, this)
            }
        }
        if (this.data.elements) {
            this.dataStore.setMultiple(Travian.Game.Map.DataStore.TYPE_TILE, this.data.elements)
        }
        var d = this.cookie.get("grid");
        if (typeof d !== "undefined") {
            this.gridDisplayed = !!d
        }
        this.onCreate(this);
        this.savedURL = Travian.parseURL(window.location.href);
        this.render();
        this.loading = false;
        jQuery("window").on({resize: this.positionChange.bind(this)})
    };
    a.prototype = Object.create(Travian.Game.Map.Base.prototype);
    a.constructor = a;
    return a
})();
Travian.Game.Map.Transition = (function () {
    var a = [];
    var e = function (h, g) {
        var f = false;
        do {
            f = false;
            if (Math.round(h.x) > g.border.right) {
                h.x = g.border.left + (h.x - g.border.right) - 1;
                f = true
            } else {
                if (Math.round(h.x) < g.border.left) {
                    h.x = g.border.right - (g.border.left - h.x) + 1;
                    f = true
                }
            }
            if (Math.round(h.right) > g.border.right) {
                h.right = g.border.left + (h.right - g.border.right) - 1;
                f = true
            } else {
                if (Math.round(h.right) < g.border.left) {
                    h.right = g.border.right - (g.border.left - h.right) + 1;
                    f = true
                }
            }
            if (Math.round(h.y) > g.border.top) {
                h.y = g.border.bottom + (h.y - g.border.top) - 1;
                f = true
            } else {
                if (Math.round(h.y) < g.border.bottom) {
                    h.y = g.border.top - (g.border.bottom - h.y) + 1;
                    f = true
                }
            }
            if (Math.round(h.top) > g.border.top) {
                h.top = g.border.bottom + (h.top - g.border.top) - 1;
                f = true
            } else {
                if (Math.round(h.top) < g.border.bottom) {
                    h.top = g.border.top - (g.border.bottom - h.top) + 1;
                    f = true
                }
            }
        } while (f);
        return h
    };
    var b = function (f) {
        f.elementsPerBlock = f.zoomOptions.sizes[f.zoomLevel - 1];
        f.pixelPerTile = {
            x: f.mapContainer.blockSize.width / f.elementsPerBlock.x,
            y: f.mapContainer.blockSize.height / f.elementsPerBlock.y
        };
        f.elementsInView = {
            x: f.elementsPerBlock.x * f.mapContainer.containerSize.width / f.mapContainer.blockSize.width,
            y: f.elementsPerBlock.y * f.mapContainer.containerSize.height / f.mapContainer.blockSize.height
        }
    };
    var d = function (i, g) {
        var h = {
            x: i.mapContainer.containerSize.x + i.mapContainer.elementSize.x,
            y: i.mapContainer.containerSize.y + i.mapContainer.elementSize.y
        };
        var f = i.mapContainer.blockSize.height / i.elementsPerBlock.y;
        return {
            x: (g.x - i.positionOrigin.map.x) * i.pixelPerTile.x + i.positionOrigin.browser.x - h.x,
            y: (i.positionOrigin.map.y - g.y) * i.pixelPerTile.y - f - h.y + i.positionOrigin.browser.y
        }
    };
    var c = function (f, g) {
        this.classType = "Travian.Game.Map.Transition";
        this.elementsPerBlock = null;
        this.pixelPerTile = null;
        this.zoomLevel = null;
        this.zoomOptions = null;
        this.border = null;
        this.mapContainer = null;
        this.getPointOfCenterInView = function () {
            var h = {
                x: this.mapContainer.containerViewSize.x + this.mapContainer.containerViewSize.width / 2,
                y: this.mapContainer.containerViewSize.y + this.mapContainer.containerViewSize.height / 2
            };
            h.x -= this.mapContainer.containerSize.x;
            h.y -= this.mapContainer.containerSize.y;
            h.x -= this.mapContainer.elementSize.x;
            h.y -= this.mapContainer.elementSize.y;
            return this.translateToMap(h, {})
        };
        this.containerPositionChange = function (h) {
            this.positionOrigin.browser.x -= h.x;
            this.positionOrigin.browser.y += h.y
        };
        this.move = function (h) {
            this.positionOrigin.browser.x += h.x;
            this.positionOrigin.browser.y -= h.y;
            this.onMove(this, h);
            return this
        };
        this.registerCallbackOnZoom = function (h) {
            a.push(h);
            return this
        };
        this.translateToBrowser = function (i) {
            var j = {
                x: this.mapContainer.containerSize.x + this.mapContainer.elementSize.x,
                y: this.mapContainer.containerSize.y + this.mapContainer.elementSize.y
            };
            var h = this.mapContainer.blockSize.height / this.elementsPerBlock.y;
            return {
                x: (i.x - this.positionOrigin.map.x) * this.pixelPerTile.x + this.positionOrigin.browser.x - j.x,
                y: (this.positionOrigin.map.y - i.y) * this.pixelPerTile.y - h - j.y + this.positionOrigin.browser.y
            }
        };
        this.translateToMap = function (j, k) {
            k = Object.assign({round: true, correct: true}, k || {});
            var l = {
                x: this.mapContainer.containerSize.x + this.mapContainer.elementSize.x,
                y: this.mapContainer.containerSize.y + this.mapContainer.elementSize.y
            };
            var i = this.mapContainer.blockSize.height / this.elementsPerBlock.y;
            if (typeof j.height !== "undefined") {
                i = j.height
            }
            var h = null;
            if (k.round) {
                h = {
                    x: Math.floor((j.x + l.x - this.positionOrigin.browser.x) / this.pixelPerTile.x) + this.positionOrigin.map.x,
                    y: this.positionOrigin.map.y - Math.floor((j.y + i + (l.y - this.positionOrigin.browser.y)) / this.pixelPerTile.y)
                }
            } else {
                h = {
                    x: ((j.x + l.x - this.positionOrigin.browser.x) / this.pixelPerTile.x) + this.positionOrigin.map.x - 1,
                    y: this.positionOrigin.map.y - ((j.y + i + (l.y - this.positionOrigin.browser.y)) / this.pixelPerTile.y)
                }
            }
            if (j.width) {
                h.right = h.x + j.width / this.pixelPerTile.x - 1
            }
            if (j.height) {
                h.top = h.y + j.height / this.pixelPerTile.y - 1
            }
            if (k.correct) {
                h = e(h, this)
            }
            return h
        };
        this.zoom = function (j) {
            if (j === 0 || (j < 0 && this.zoomLevel + j < 1) || (j > 0 && this.zoomLevel + j > this.zoomOptions.sizes.length)) {
                return false
            }
            this.zoomLevel += j;
            b(this);
            this.onZoom(this);
            for (var h = 0; h < a.length; h++) {
                a[h](this)
            }
            return true
        };
        Travian.Game.Map.Base.call(this, f, g);
        this.onMove = this.onMove || Travian.emptyFunction;
        this.onCreate = this.onCreate || Travian.emptyFunction;
        this.onZoom = this.onZoom || Travian.emptyFunction;
        this.zoomLevel = this.zoomOptions.level;
        this.positionOrigin = {
            browser: {
                x: this.mapContainer.containerSize.x,
                y: this.mapContainer.containerSize.y + this.mapContainer.containerSize.height
            }, map: {x: 0, y: 0}
        };
        b(this);
        this.onCreate(this)
    };
    c.prototype = Object.create(Travian.Game.Map.Base.prototype);
    c.constructor = c;
    return c
})();
Travian.Game.Map.Transition.Precision = 2;
Travian.Game.Map.Updater = (function () {
    var b = function (i) {
        if (Object.keys(i.objects.ajax).length <= 0) {
            return false
        }
        i.updateWorking(1);
        var g = [];
        for (var h in i.objects.ajax) {
            if (i.objects.ajax.hasOwnProperty(h)) {
                var f = i.objects.ajax[h].getRequestData();
                if (f !== false) {
                    g.push(f)
                }
            }
        }
        i.requestObject.multiple = Travian.ajax({
            url: i.url,
            data: Object.assign({}, i.parameters.multiple, {data: g, zoomLevel: i.transition.zoomLevel}),
            onSuccess: function (j) {
                i.updateWorking(-1);
                i.setContentDataAndRefresh(j);
                c(i)
            },
            onError: function (j) {
                i.updateWorking(-1);
                i.setContentDataAndRefresh(j);
                c(i)
            }
        });
        return true
    };
    var a = function (h, g) {
        h.updateWorking(1);
        var f = {
            x0: g.position.x + h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].left,
            y0: g.position.y + h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].bottom,
            x1: g.position.x + h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].right,
            y1: g.position.y + h.options.positionOptions.areaAroundPosition[h.transition.zoomLevel].top
        };
        if (h.requestObject.position) {
            h.requestObject.position.abort();
            h.requestObject.position = null;
            h.updateWorking(-1)
        }
        h.requestObject.position = Travian.ajax({
            url: h.url, data: Object.assign({}, h.parameters.position, {
                data: Object.assign({}, g.position, {
                    zoomLevel: h.transition.zoomLevel,
                    ignorePositions: h.dataStore.getPositionsOfData(g.dataStoreType).filter(function (i) {
                        return Travian.Game.Map.isPositionInRect(f, i)
                    }).map(function (i) {
                        return Travian.Game.Map.xy2id(i.x, i.y)
                    })
                })
            }), onSuccess: function (i) {
                h.updateWorking(-1);
                (g.onSuccess || Travian.emptyFunction)(i)
            }, onError: function (i) {
                h.updateWorking(-1);
                (g.onError || Travian.emptyFunction)(i)
            }
        })
    };
    var d = function (g, f) {
        f.element.attr("src", f.srcUrl);
        if (f.finishedLoading) {
            f.finishedLoading()
        }
        delete (g.loadings[f.blockContainer.updaterId][f.updaterId]);
        if (Object.keys(g.loadings[f.blockContainer.updaterId]).length === 0) {
            f.blockContainer.layers.loading.hide()
        }
        g.requestCountImages--;
        g.updateWorking(-1);
        c(g)
    };
    var c = function (f) {
        if (f.requestCountImages >= f.maxRequestCount) {
            return
        }
        Object.keys(f.objects.images).map(function (h, g) {
            return {imageId: h, priority: f.objects.images[h].getPriority()}
        }).sort(function (h, g) {
            return h.priority - g.priority
        }).some(function (h, i) {
            var j = f.objects.images[h.imageId];
            var g = function () {
                d(f, j)
            };
            delete (f.objects.images[j.updaterId]);
            f.requestCountImages++;
            f.updateWorking(1);
            if (!j.imageLoader) {
                j.imageLoader = jQuery(new Image()).on("load", g)
            }
            j.refreshSrcUrl();
            j.imageLoader.attr("src", j.srcUrl);
            return f.requestCountImages >= f.maxRequestCount
        })
    };
    var e = function (f, g) {
        this.lastRequestPosition = {x: null, y: null};
        this.loadings = {};
        this.requestCount = 0;
        this.requestCountImages = 0;
        this.maxRequestCount = 5;
        this.requestDelayId = {multiple: null, position: null};
        this.requestObject = {multiple: null, position: null};
        this.classType = "Travian.Game.Map.Updater";
        this.register = function (i, h) {
            if (!this.objects[i]) {
                return this
            }
            if (!h.updaterId) {
                h.updaterId = Travian.Game.Map.getNewId()
            }
            if (!this.objects[i][h.updaterId]) {
                this.objects[i][h.updaterId] = h
            }
            if (i === "images") {
                if (!h.blockContainer.updaterId) {
                    h.blockContainer.updaterId = Travian.Game.Map.getNewId()
                }
                if (!this.loadings[h.blockContainer.updaterId]) {
                    this.loadings[h.blockContainer.updaterId] = {}
                }
                this.loadings[h.blockContainer.updaterId][h.updaterId] = true;
                h.blockContainer.layers.loading.show()
            }
            this.request();
            return this
        };
        this.request = function () {
            var h = this;
            if (this.requestObject.multiple && this.requestObject.multiple.cancel) {
                this.requestObject.multiple.cancel();
                this.requestObject.multiple = null;
                this.updateWorking(-1)
            }
            if (this.requestDelayId.multiple) {
                clearTimeout(this.requestDelayId.multiple);
                this.requestDelayId.multiple = null
            }
            this.requestDelayId.multiple = setTimeout(function () {
                if (b(h) === false) {
                    c(h)
                }
            }, this.requestDelayTime.multiple);
            return this
        };
        this.requestPosition = function (h) {
            var i = this;
            if (this.lastRequestPosition.x === h.position.x && this.lastRequestPosition.y === h.position.y) {
                return this
            }
            this.lastRequestPosition.x = h.position.x;
            this.lastRequestPosition.y = h.position.y;
            if (this.requestObject.position && this.requestObject.position.cancel) {
                this.requestObject.position.cancel();
                this.requestObject.position = null;
                this.updateWorking(-1)
            }
            if (this.requestDelayId.position) {
                clearTimeout(this.requestDelayId.position);
                this.requestDelayId.position = null
            }
            this.requestDelayId.position = setTimeout(function () {
                a(i, h)
            }, this.requestDelayTime.position);
            return this
        };
        this.setContentDataAndRefresh = function (n) {
            if (n.blocks) {
                for (var j in n.blocks) {
                    if (n.blocks.hasOwnProperty(j)) {
                        for (var l in n.blocks[j]) {
                            if (n.blocks[j].hasOwnProperty(l)) {
                                for (var i in n.blocks[j][l]) {
                                    if (n.blocks[j][l].hasOwnProperty(i)) {
                                        for (var k in n.blocks[j][l][i]) {
                                            if (n.blocks[j][l][i].hasOwnProperty(k)) {
                                                var h = {x: j, y: l, right: i, top: k};
                                                var o = Object.assign({}, this.dataStore.get(Travian.Game.Map.DataStore.TYPE_BLOCKS, h, "block") || {}, n.blocks[j][l][i][k]);
                                                this.dataStore.push({
                                                    type: Travian.Game.Map.DataStore.TYPE_BLOCKS,
                                                    position: h,
                                                    index: "block",
                                                    data: o
                                                })
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                this.mapContainer.invalidateBlockVersionCache()
            }
            if (n.elements) {
                this.dataStore.setMultiple(Travian.Game.Map.DataStore.TYPE_TILE, n.elements)
            }
            for (var m in this.objects.ajax) {
                if (this.objects.ajax.hasOwnProperty(m)) {
                    if (this.objects.ajax[m].refreshContent) {
                        this.objects.ajax[m].refreshContent()
                    }
                    delete (this.objects.ajax[m])
                }
            }
            return this
        };
        this.updateWorking = function (h) {
            this.requestCount += h;
            if (this.elementWorking.length > 0) {
                if (this.requestCount > 0) {
                    this.elementWorking.css({visibility: "visible"})
                } else {
                    this.elementWorking.css({visibility: "hidden"})
                }
                this.elementWorking.html(this.requestCount)
            }
            return this
        };
        Travian.Game.Map.Base.call(this, f, g);
        this.objects = {ajax: {}, images: {}};
        this.elementWorking = jQuery(this.elementWorking)
    };
    e.prototype = Object.create(Travian.Game.Map.Base.prototype);
    e.constructor = e;
    return e
})();
Travian.Game.Map.ContextMenu = function (a, d) {
    this.classType = "Travian.Game.Map.ContextMenu";
    this.addAction = function (f) {
        var h = this;
        var g = false;
        f.element = jQuery(f.element);
        if (f.element.length > 0 && !g) {
            var e = f.element.find("a");
            if (e.length > 0) {
                e.on("click", function (i) {
                    f.fn(h, h.mapPosition, h.contentData)
                });
                this.actions.push(f)
            } else {
                f.element.hide()
            }
        }
        return this
    };
    this.disable = function () {
        this.options.disabled = true;
        return this
    };
    this.enable = function () {
        this.options.disabled = false;
        return this
    };
    this.hide = function () {
        if (this.shown) {
            this.fx(this.menu, false);
            this.parentContainer.enableEvents();
            this.menu.hide();
            this.shown = false
        }
        return this
    };
    this.show = function () {
        this.fx(this.menu, true);
        this.parentContainer.disableEvents();
        this.menu.show();
        this.shown = true;
        return this
    };
    this.startListener = function () {
        var e = this;
        this.targets.each(function (f, g) {
            jQuery(g).on(e.options.trigger, function (h) {
                if (h.target === e.parentContainer.containerMover.get(0) && !e.options.disabled) {
                    if (e.options.stopEvent) {
                        h.stopPropagation()
                    }
                    e.options.element = jQuery(g);
                    e.menu.css({
                        left: (h.pageX + e.options.offsets.x),
                        top: (h.pageY + e.options.offsets.y),
                        position: "absolute"
                    });
                    e.show()
                }
            })
        });
        jQuery("body").on("click", function () {
            e.hide()
        });
        return this
    };
    this.update = function () {
        var e = this;
        if (this.options.disabled || !this.shown) {
            return this
        }
        this.contentData = this.parentContainer.dataStore.get(Travian.Game.Map.DataStore.TYPE_TOOLTIP, this.mapPosition);
        this.actions.forEach(function (f) {
            if (e.contentData != null && f.shouldDisplay(e.contentData)) {
                f.element.show()
            } else {
                f.element.hide()
            }
        });
        this.menu.find("div.separator").each(function (g, h) {
            var i = jQuery(h);
            var f = i.prev();
            if (f.find(".entry:visible").length === 0) {
                f.hide();
                i.hide()
            } else {
                f.show();
                i.show()
            }
        });
        return this
    };
    this.options = Object.assign({
        actions: {},
        menu: "#contextmenu",
        stopEvent: true,
        targets: "#mapContainer",
        trigger: "contextmenu",
        offsets: {x: 0, y: 0},
        onShow: Travian.emptyFunction,
        onHide: Travian.emptyFunction,
        onClick: Travian.emptyFunction,
        fadeSpeed: 200
    }, a);
    this.parentContainer = d;
    this.mapPosition = null;
    this.menu = jQuery(this.options.menu);
    this.targets = jQuery(this.options.targets);
    this.fx = function (f, e) {
        f.animate({opacity: e ? 1 : 0}, this.options.fadeSpeed, function () {
            f.css({display: e ? "block" : "none"})
        })
    };
    this.hide().startListener();
    this.menu.css({position: "absolute", top: "-900000px", display: "block"});
    this.menu.detach().appendTo("body");
    this.actions = [];
    for (var b in this.options.actions) {
        if (this.options.actions.hasOwnProperty(b)) {
            this.addAction(this.options.actions[b])
        }
    }
    var c = this;
    this.targets.each(function (e, f) {
        jQuery(f).on(c.options.trigger, function (g) {
            c.mapPosition = c.parentContainer.transition.translateToMap({
                x: g.pageX - c.parentContainer.containerSize.x - c.parentContainer.elementSize.x,
                y: g.pageY - c.parentContainer.containerSize.y - c.parentContainer.elementSize.y
            });
            c.update()
        })
    })
};
Travian.Game.Map.DataStore = (function () {
    var f = 0;
    var e = function (g) {
        for (var h in g.options.useStorageForType) {
            if (g.options.useStorageForType.hasOwnProperty(h) && g.options.useStorageForType[h]) {
                Travian.Storage.set("mapDataContainer." + h, g.data[h], g.options.persistentStorage)
            }
        }
    };
    var c = function (i, l, g) {
        var j = g.x;
        var m = g.y;
        var h = typeof g.right !== "undefined" ? g.right : j;
        var k = typeof g.top !== "undefined" ? g.top : m;
        if (!i.data[l]) {
            i.data[l] = {all: {}}
        }
        if (!i.data[l][j]) {
            i.data[l][j] = {}
        }
        if (!i.data[l][j][m]) {
            i.data[l][j][m] = {}
        }
        if (!i.data[l][j][m][h]) {
            i.data[l][j][m][h] = {}
        }
        if (!i.data[l][j][m][h][k]) {
            i.data[l][j][m][h][k] = {}
        }
        if (!i.data[l][j][m][h][k].id) {
            f++;
            i.data[l][j][m][h][k].id = f
        }
        i.data[l][j][m][h][k].position = g;
        return i.data[l][j][m][h][k]
    };
    var b = function (i, l, g) {
        var j = g.x;
        var m = g.y;
        var h = typeof g.right !== "undefined" ? g.right : j;
        var k = typeof g.top !== "undefined" ? g.top : m;
        if (!i.data[l]) {
            return null
        }
        if (!i.data[l][j]) {
            return null
        }
        if (!i.data[l][j][m]) {
            return null
        }
        if (!i.data[l][j][m][h]) {
            return null
        }
        if (!i.data[l][j][m][h][k]) {
            return null
        }
        if (d(i, i.data[l][j][m][h][k], l)) {
            return null
        }
        return i.data[l][j][m][h][k]
    };
    var d = function (g, i, h) {
        return i.time !== false && (new Date()).getTime() - i.time > g.cachingTimeForType[h]
    };
    var a = function (g, j) {
        this.classType = "Travian.Game.Map.DataStore";
        this.data = {};
        this.get = function (m, k, l) {
            var n = b(this, m, k);
            if (n == null) {
                return null
            }
            if (typeof l !== "undefined") {
                if (n.data[l]) {
                    return n.data[l]
                }
                return null
            }
            return n.data
        };
        this.getDataForArea = function (o, m, k) {
            var s = [];
            var n = Object.assign({}, m);
            if (!this.data[o] || !this.data[o].all) {
                return s
            }
            if (n.x > n.right) {
                n.right += this.parentContainer.transition.border.width
            }
            if (n.y > n.top) {
                n.top += this.parentContainer.transition.border.height
            }
            for (var r in this.data[o].all) {
                if (this.data[o].all.hasOwnProperty(r)) {
                    var q = this.data[o].all[r];
                    var p = {x: q.position.x, y: q.position.y};
                    if (n.x > p.x) {
                        p.x += this.parentContainer.transition.border.width
                    }
                    if (n.y > p.y) {
                        p.y += this.parentContainer.transition.border.height
                    }
                    if (d(this, q, o) === false && n.x <= p.x && p.x <= n.right && n.y <= p.y && p.y <= n.top) {
                        if (k) {
                            for (var l in q.data) {
                                if (q.data.hasOwnProperty(l)) {
                                    s.push(q.data[l])
                                }
                            }
                        } else {
                            s.push(q.data)
                        }
                    }
                }
            }
            return s
        };
        this.getPositionsOfData = function (k) {
            var l = this;
            if (!this.data[k] || !this.data[k].all) {
                return []
            }
            return Object.keys(this.data[k].all).filter(function (m) {
                return d(l, l.data[k].all[m], k) === false
            }).map(function (m) {
                return l.data[k].all[m].position
            })
        };
        this.push = function (k) {
            if (typeof k.time === "undefined") {
                k.time = (new Date()).getTime()
            }
            if (k.time === -1) {
                k.time = false
            }
            var l = c(this, k.type, k.position);
            if (!l.data) {
                l.data = {}
            }
            l.data[k.index] = k.data;
            l.time = k.time;
            this.data[k.type].all[l.id] = l;
            return this
        };
        this.refresh = function (k) {
            var l = b(this, k.type, k.position);
            if (l != null) {
                if (typeof k.time === "undefined") {
                    k.time = (new Date()).getTime()
                }
                if (k.time === -1) {
                    k.time = false
                }
                l.time = k.time
            }
            return this
        };
        this.remove = function (m, k, l) {
            var n = b(this, m, k);
            if (n == null) {
                return this
            }
            if (typeof l !== "undefined") {
                if (n.data[l]) {
                    delete (n.data[l])
                }
                return this
            }
            n.time = 0;
            return this
        };
        this.removeAllOfType = function (k) {
            if (this.data[k] !== undefined) {
                delete (this.data[k])
            }
        };
        this.saveDataToStorage = function () {
            e(this);
            return this
        };
        this.set = function (k) {
            if (typeof k.time === "undefined") {
                k.time = (new Date()).getTime()
            }
            if (k.time === -1) {
                k.time = false
            }
            var n = c(this, k.type, k.position);
            n.data = k.data;
            n.time = k.time;
            this.data[k.type].all[n.id] = n;
            if (k.data.symbols) {
                for (var l in k.data.symbols) {
                    if (k.data.symbols.hasOwnProperty(l)) {
                        var m = k.data.symbols[l];
                        if (!m.dataId) {
                            m.dataId = m.type + "-" + index
                        }
                        this.push({
                            type: Travian.Game.Map.DataStore.TYPE_SYMBOL,
                            position: k.position,
                            data: m,
                            index: m.dataId,
                            time: false
                        })
                    }
                }
            }
            return this
        };
        this.setMultiple = function (n, k, o) {
            for (var m = 0; m < k.length; m++) {
                var l = k[m];
                this.set({type: n, position: l.position, data: l, time: o})
            }
            e(this);
            return this
        };
        Travian.Game.Map.Base.call(this, g, j);
        var i;
        for (i in this.options.clearStorageForType) {
            if (this.options.clearStorageForType.hasOwnProperty(i) && this.options.clearStorageForType[i]) {
                Travian.Storage.clear("mapDataContainer." + i, this.options.persistentStorage)
            }
        }
        for (i in this.options.useStorageForType) {
            if (this.options.useStorageForType.hasOwnProperty(i) && this.options.useStorageForType[i]) {
                this.data[i] = Travian.Storage.get("mapDataContainer." + i, this.options.persistentStorage) || {};
                if (!this.data[i].all) {
                    this.data[i].all = {}
                } else {
                    var h = Math.max(Object.keys(this.data[i].all).map(function (k) {
                        return parseInt(k)
                    }));
                    if (h > f) {
                        f = h
                    }
                }
            }
        }
    };
    a.TYPE_BLOCKS = "blocks";
    a.TYPE_SYMBOL = "symbol";
    a.TYPE_TILE = "tile";
    a.TYPE_TOOLTIP = "tooltip";
    a.prototype = Object.create(Travian.Game.Map.Base.prototype);
    a.constructor = a;
    return a
})();
Travian.Game.Map.Tips = {
    lastText: "",
    lastTitle: "",
    tooltipHtml: '<span class="xCoord">({x}</span><span class="pi">|</span><span class="yCoord">{y})</span><span class="clear"></span>',
    render: function (c, a) {
        var b = this;
        Travian.Tip.set(a, {title: "", text: ""});
        jQuery(a).on("mousemove", function (g) {
            var f = {
                x: g.pageX - c.containerSize.x - c.elementSize.x,
                y: g.pageY - c.containerSize.y - c.elementSize.y
            };
            var d = c.getContentForTooltip(f);
            if (d === false) {
                d = {title: "", text: Travian.Helpers.substitute(b.tooltipHtml, c.transition.translateToMap(f))}
            }
            if (b.lastText !== d.text || b.lastTitle !== d.title) {
                d.unescaped = true;
                Travian.Tip.show(d);
                b.lastText = d.text;
                b.lastTitle = d.title
            }
        });
        return this
    }
};
Travian.Game.Map.Rulers = (function () {
    var b = function (h, g) {
        g += h.delta.x[h.transition.zoomLevel];
        if (g < h.transition.border.left) {
            g = h.transition.border.right - (h.transition.border.left - g) + 1
        } else {
            if (g > h.transition.border.right) {
                g = h.transition.border.left + (g - h.transition.border.right) - 1
            }
        }
        return g
    };
    var a = function (h, g) {
        g += h.delta.y[h.transition.zoomLevel];
        if (g < h.transition.border.bottom) {
            g = h.transition.border.top - (h.transition.border.bottom - g) + 1
        } else {
            if (g > h.transition.border.top) {
                g = h.transition.border.bottom + (g - h.transition.border.top) - 1
            }
        }
        return g
    };
    var f = function (g) {
        g.elements.moverX.css({backgroundImage: "url(" + Travian.Helpers.substitute(g.imgSource.x, {zoomLevel: g.transition.zoomLevel}) + ")"});
        g.elements.moverY.css({backgroundImage: "url(" + Travian.Helpers.substitute(g.imgSource.y, {zoomLevel: g.transition.zoomLevel}) + ")"})
    };
    var e = function (m) {
        if (m.elements.coordinates) {
            m.elements.coordinates.x.forEach(function (o) {
                o.remove()
            });
            m.elements.coordinates.y.forEach(function (o) {
                o.remove()
            })
        }
        m.elements.coordinates = {x: [], y: []};
        var n = m.transition.elementsInView.x + m.transition.elementsPerBlock.x * 2;
        var l = m.steps.x[m.transition.zoomLevel];
        for (var g = 0, h = null, j = null; g < n; g += l) {
            h = jQuery("<div/>").addClass("coordinate zoom" + m.transition.zoomLevel).css({
                position: "absolute",
                left: g * m.mapContainer.blockSize.width / m.transition.elementsPerBlock.x,
                top: 0,
                width: l * m.mapContainer.blockSize.width / m.transition.elementsPerBlock.x,
                height: m.containerSize.height
            }).appendTo(m.elements.moverX);
            h.rulerLeft = g * m.mapContainer.blockSize.width / m.transition.elementsPerBlock.x;
            m.elements.coordinates.x[g] = h
        }
        var k = m.transition.elementsInView.y + m.transition.elementsPerBlock.y * 2;
        var i = m.steps.y[m.transition.zoomLevel];
        for (g = 0, h = null, j = null; g < k; g += i) {
            h = jQuery("<div/>").addClass("coordinate zoom" + m.transition.zoomLevel).css({
                position: "absolute",
                left: 0,
                top: g * m.mapContainer.blockSize.height / m.transition.elementsPerBlock.y,
                width: m.containerSize.width,
                height: i * m.mapContainer.blockSize.height / m.transition.elementsPerBlock.y
            }).appendTo(m.elements.moverY);
            h.rulerTop = g * m.mapContainer.blockSize.height / m.transition.elementsPerBlock.y;
            m.elements.coordinates.y[g] = h
        }
        c(m, true, true)
    };
    var c = function (j, h, g) {
        var i = false;
        do {
            i = false;
            if (j.position.x < -2 * j.mapContainer.blockSize.width) {
                j.position.x += j.mapContainer.blockSize.width * 1;
                h = true;
                i = true
            }
            if (j.position.x > 0) {
                j.position.x += j.mapContainer.blockSize.width * -1;
                h = true;
                i = true
            }
            if (j.position.y < -2 * j.mapContainer.blockSize.height) {
                j.position.y += j.mapContainer.blockSize.height * 1;
                g = true;
                i = true
            }
            if (j.position.y > 0) {
                j.position.y += j.mapContainer.blockSize.height * -1;
                g = true;
                i = true
            }
        } while (i);
        j.elements.moverX.css({left: j.position.x});
        j.elements.moverY.css({top: j.position.y});
        if (h && j.elements.coordinates) {
            jQuery(j.elements.coordinates.x).each(function (k, m) {
                if (m && m.length > 0) {
                    var l = j.transition.translateToMap({
                        x: j.position.x + m.rulerLeft - j.mapContainer.elementSize.x,
                        y: 0
                    });
                    m.html(b(j, l.x))
                }
            })
        }
        if (g && j.elements.coordinates) {
            jQuery(j.elements.coordinates.y).each(function (k, m) {
                if (m && m.length > 0) {
                    var l = j.transition.translateToMap({
                        x: 0,
                        y: j.position.y + m.rulerTop - j.mapContainer.elementSize.y
                    });
                    m.html(a(j, l.y))
                }
            })
        }
    };
    var d = function (g, h) {
        this.classType = "Travian.Game.Map.Rulers";
        this.destroy = function () {
            this.elements.containerX.remove();
            this.elements.containerY.remove();
            return this
        };
        this.render = function (i) {
            var j = this;
            this.position = {x: this.mapContainer.blockSize.width, y: this.mapContainer.blockSize.height};
            this.elements = {
                containerX: jQuery("<div/>").addClass(this.cls.x).css({
                    position: "absolute",
                    left: 0,
                    right: 0,
                    width: this.mapContainer.containerViewSize.width,
                    overflow: "hidden"
                }).appendTo(this.mapContainer.containerRender),
                containerY: jQuery("<div/>").addClass(this.cls.y).css({
                    position: "absolute",
                    top: 0,
                    bottom: 0,
                    height: this.mapContainer.containerViewSize.height,
                    overflow: "hidden"
                }).appendTo(this.mapContainer.containerRender)
            };
            this.containerSize = {width: this.elements.containerY.width(), height: this.elements.containerX.height()};
            this.elements.containerX.css({height: this.containerSize.height});
            if (this.direction.toLowerCase() === "ltr") {
                this.elements.containerY.css({left: -this.containerSize.width})
            } else {
                if (this.direction.toLowerCase() === "rtl") {
                    this.elements.containerY.css({right: -this.containerSize.width})
                }
            }
            this.elements.moverX = jQuery("<div/>").css({
                position: "absolute",
                left: 0,
                top: 0,
                width: this.mapContainer.containerSize.width + 2 * this.mapContainer.blockSize.width,
                height: "100%",
                backgroundPosition: "left top",
                backgroundColor: "transparent",
                backgroundRepeat: "repeat-x"
            }).appendTo(this.elements.containerX);
            this.elements.moverY = jQuery("<div/>").css({
                position: "absolute",
                left: 0,
                top: 0,
                width: "100%",
                height: this.mapContainer.containerSize.height + 2 * this.mapContainer.blockSize.height,
                backgroundPosition: "left top",
                backgroundColor: "transparent",
                backgroundRepeat: "repeat-y"
            }).appendTo(this.elements.containerY);
            f(this);
            e(this);
            c(this);
            return this
        };
        this.move = function (i) {
            this.position.x += i.x;
            this.position.y -= i.y;
            c(this);
            return this
        };
        this.zoom = function () {
            f(this);
            e(this);
            c(this);
            return this
        };
        if (!g.direction) {
            g.direction = jQuery("body").css("direction")
        }
        Travian.Game.Map.Base.call(this, g, h);
        this.position = {x: 0, y: 0}
    };
    d.prototype = Object.create(Travian.Game.Map.Base.prototype);
    d.constructor = d;
    return d
})();
Travian.Game.Map.MiniMap = (function () {
    var c = function (i) {
        var e = i.transition.translateToMap({x: -i.mapContainer.elementSize.x, y: -i.mapContainer.elementSize.y}, {});
        var h = i.transition.translateToMap({
            x: 0,
            y: 0,
            width: i.mapContainer.containerViewSize.width,
            height: i.mapContainer.containerViewSize.height
        }, {round: false, correct: false});
        h.width = h.right - h.x;
        h.height = h.top - h.y;
        var g = {
            x: i.containerSize.width / i.transition.border.width,
            y: i.containerSize.height / i.transition.border.height
        };
        i.position = {
            x: e.x * g.x + i.containerSize.width / 2 - 1,
            y: e.y * g.y + i.containerSize.height / 2 - h.height * g.y - 1,
            width: h.width * g.x,
            height: h.height * g.y
        };
        var f = i.position;
        if (f.width >= i.containerSize.width) {
            f.x = -1
        }
        if (f.height >= i.containerSize.height) {
            f.y = -1
        }
        i.element.css({left: f.x, bottom: f.y, width: f.width, height: f.height});
        var d = Object.assign({}, f);
        if (f.x < 0) {
            f.x += i.containerSize.width
        } else {
            if (f.x + f.width > i.containerSize.width) {
                f.x -= i.containerSize.width
            }
        }
        if (f.y < 0) {
            f.y += i.containerSize.height
        } else {
            if (f.y + f.height > i.containerSize.height) {
                f.y -= i.containerSize.height
            }
        }
        i.elementHelpers[0].css({left: f.x, bottom: f.y, width: f.width, height: f.height});
        i.elementHelpers[1].css({left: d.x, bottom: f.y, width: f.width, height: f.height});
        i.elementHelpers[2].css({left: f.x, bottom: d.y, width: f.width, height: f.height})
    };
    var b = function (g, f) {
        var d = {
            x: f.containerSize.width / f.transition.border.width,
            y: f.containerSize.height / f.transition.border.height
        };
        return {
            x: Math.floor((g.pageX - f.containerPosition.x) / d.x - Math.abs(f.transition.border.left)),
            y: -Math.floor((g.pageY - f.containerPosition.y) / d.y - Math.abs(f.transition.border.bottom))
        }
    };
    var a = function (d, e) {
        this.classType = "Travian.Game.Map.MiniMap";
        this.expanded = false;
        this.animate = function () {
            var g = this;
            this.elements.container.stop(true);
            this.expanded = this.cookie.get("minimap-expanded") || false;
            var f = function () {
                return !g.expanded ? g.elements.container._height.min : g.elements.container._height.max
            };
            this.expanded = !this.expanded;
            this.cookie.set("minimap-expanded", this.expanded);
            this.elements.headlineExpander.toggleClass("expand collapse");
            this.elements.container.animate({height: f()}, 200);
            this.parentContainer.outline.update(this.elements.container.height() - f());
            return this
        };
        this.getContentForTooltip = function (f, h) {
            var g = b(h, this);
            return {text: Travian.Helpers.substitute(this.tooltipHtml, g)}
        };
        this.render = function (h) {
            var k = this;
            this.container = jQuery(this.container).css({overflow: "hidden"}).prop("unselectable", "on").on("click", function (i) {
                k.mapContainer.moveTo(b(i, k))
            });
            Travian.Game.Map.Base.prototype.render.call(this, h);
            this.element.addClass("view").css({position: "absolute", zIndex: 3}).appendTo(this.container);
            jQuery("<div/>").addClass("inner").css({
                height: "100%",
                opacity: 0.25,
                width: "100%"
            }).appendTo(this.element);
            this.elementHelpers = [];
            for (var j = 0; j < 3; j++) {
                var f = jQuery("<div/>").addClass("view").css({
                    position: "absolute",
                    zIndex: 3
                }).appendTo(this.container);
                jQuery("<div/>").addClass("inner").css({height: "100%", opacity: 0.25, width: "100%"}).appendTo(f);
                this.elementHelpers.push(f)
            }
            this.containerSize = {width: this.container.width(), height: this.container.height()};
            this.containerPosition = {x: this.container.offset().left, y: this.container.offset().top};
            this.elementSize = {width: this.element.width(), height: this.element.height()};
            if (this.showToolTip) {
                Travian.Game.Map.MiniMap.Tips.render(this, this.container.find("img"))
            }
            c(this);
            var g = jQuery(this.containerContent);
            this.elements = {
                container: g,
                headline: g.find(".headline"),
                headlineExpander: g.find(".iconButton"),
                background: g.find(".background")
            };
            this.expanded = this.cookie.get("minimap-expanded");
            this.elements.headlineExpander.addClass(this.expanded === true ? "collapse" : "expand");
            var l = function () {
                k.elements.container._height = {
                    max: k.elements.container.height(),
                    min: k.elements.headline.height() + parseInt(k.elements.headline.css("margin-top")) + parseInt(k.elements.headline.css("margin-bottom"))
                };
                if (k.expanded !== true) {
                    k.elements.container.css({height: k.elements.container._height.min})
                }
                k.elements.headline.on("click", function (i) {
                    k.animate()
                })
            };
            l()
        };
        this.move = function () {
            c(this);
            return this
        };
        this.zoom = function () {
            c(this);
            return this
        };
        Travian.Game.Map.Base.call(this, d, e);
        this.position = {x: 0, y: 0, width: 0, height: 0}
    };
    a.prototype = Object.create(Travian.Game.Map.Base.prototype);
    a.constructor = a;
    return a
})();
Travian.Game.Map.MiniMap.Tips = {
    lastText: "",
    lastTitle: "",
    tooltipHtml: '<span class="xCoord">({x}</span><span class="pi">|</span><span class="yCoord">{y})</span><span class="clear"></span>',
    render: function (c, a) {
        var b = this;
        Travian.Tip.set(a, {title: "", text: ""});
        jQuery(a).on("mousemove", function (g) {
            var f = {
                x: g.pageX - c.containerSize.width - c.elementSize.width,
                y: g.pageY - c.containerSize.height - c.elementSize.height
            };
            var d = c.getContentForTooltip(f, g);
            if (d === false) {
                d = {title: "", text: Travian.Helpers.substitute(b.tooltipHtml, c.transition.translateToMap(f))}
            }
            if (b.lastText !== d.text || b.lastTitle !== d.title) {
                d.unescaped = true;
                Travian.Tip.show(d);
                b.lastText = d.text;
                b.lastTitle = d.title
            }
        });
        return this
    }
};
Travian.Game.Map.Toolbar = function (a, b) {
    this.classType = "Travian.Game.Map.Toolbar";
    this.render = function (c) {
        var f = this;
        this.element = jQuery(this.element);
        this.zoomIn = this.element.find(".iconButton.zoomIn").on("click", function (g) {
            f.mapContainer.zoomIn()
        });
        this.zoomOut = this.element.find(".iconButton.zoomOut").on("click", function (g) {
            f.mapContainer.zoomOut()
        });
        var e = function () {
            f.zoomDropDownDataContainer._dropped = false;
            f.zoomDropDownDataContainer.css({height: f.zoomDropDownDataContainer._styleBackup.height});
            f.zoomDropDownEntries.each(function (g, i) {
                var h = jQuery(i);
                if (h.hasClass("selected")) {
                    h.addClass("display")
                }
                h.addClass("hide").removeClass("selected")
            });
            jQuery(f.zoomDropDownEntries[f.transition.zoomLevel - 1]).removeClass("hide").addClass("display")
        };
        this.zoomDropDownDataContainer = this.element.find(".dropdown .dataContainer");
        this.zoomDropDownEntries = this.zoomDropDownDataContainer.find(".entry");
        this.zoomDropDownDataContainer._styleBackup = {
            height: this.zoomDropDownDataContainer.height(),
            maxHeight: this.zoomDropDownEntries.toArray().reduce(function (h, g) {
                return h + jQuery(g).height()
            }, 0)
        };
        this.zoomDropDownClick = this.element.find(".dropdown .iconButton.dropDownImage").on("click", function (g) {
            if (!f.mapContainer.isEventsEnabled()) {
                return
            }
            g.stopPropagation();
            if (f.zoomDropDownDataContainer._dropped) {
                e();
                return
            }
            f.zoomDropDownDataContainer._dropped = true;
            f.zoomDropDownEntries.each(function (h, j) {
                var i = jQuery(j);
                if (i.hasClass("display")) {
                    i.addClass("selected")
                }
                i.removeClass("display").removeClass("hide")
            });
            f.zoomDropDownDataContainer.css({height: f.zoomDropDownDataContainer._styleBackup.maxHeight})
        });
        this.zoomDropDownEntries.each(function (g, i) {
            var h = jQuery(i);
            h.on("click", function (j) {
                j.stopPropagation();
                if (!f.zoomDropDownDataContainer._dropped) {
                    return
                }
                f.zoomDropDownDataContainer._dropped = false;
                f.zoomDropDownDataContainer.css({height: f.zoomDropDownDataContainer._styleBackup.height});
                f.zoomDropDownEntries.each(function (k, l) {
                    jQuery(l).addClass("hide").removeClass("selected")
                });
                h.removeClass("hide").addClass("display");
                f.mapContainer.zoom(g + 1 - f.mapContainer.transition.zoomLevel, f.mapContainer.transition.getPointOfCenterInView())
            })
        });
        jQuery("body").on("click", function () {
            if (f.zoomDropDownDataContainer._dropped) {
                e()
            }
        });
        var d = this.element.find(".viewFull");
        if (d.length > 0) {
            this.viewFull = d.on("click", function (g) {
                window.location.href = Travian.Helpers.substitute(f.viewFullScreenUrl, Object.assign({}, f.mapContainer.transition.getPointOfCenterInView(), {zoom: f.mapContainer.transition.zoomLevel}))
            })
        }
        d = this.element.find(".iconButton.viewNormal");
        if (d.length > 0) {
            this.viewNormal = this.element.find(".iconButton.viewNormal").on("click", function (g) {
                window.location.href = Travian.Helpers.substitute(f.viewNormalUrl, Object.assign({}, f.mapContainer.transition.getPointOfCenterInView(), {zoom: f.mapContainer.transition.zoomLevel}))
            })
        }
        this.filterPlayer = this.element.find(".iconButton.filterMy").on("click", function (g) {
            Travian.ajax({
                data: {cmd: "mapSetting", data: {type: "outline", outline: "user"}}, onSuccess: function (h) {
                    f.filterPlayer[h.result ? "addClass" : "removeClass"]("checked");
                    f.filterPlayer.checked = h.result;
                    f.mapContainer.forceUpdateBlocksLayer("imageMark");
                    f.mapContainer.forceUpdateBlocksSymbols("player", h.result)
                }
            })
        });
        this.filterPlayer.checked = this.filterPlayer.hasClass("checked");
        this.filterAlliance = this.element.find(".iconButton.filterAlliance");
        if (!this.filterAlliance.hasClass("disabled")) {
            this.filterAlliance.on("click", function (g) {
                Travian.ajax({
                    data: {cmd: "mapSetting", data: {type: "outline", outline: "alliance"}},
                    onSuccess: function (h) {
                        f.filterAlliance[h.result ? "addClass" : "removeClass"]("checked");
                        f.filterAlliance.checked = h.result;
                        f.mapContainer.forceUpdateBlocksLayer("imageMark");
                        f.mapContainer.forceUpdateBlocksSymbols("alliance", h.result)
                    }
                })
            });
            this.filterAlliance.checked = this.filterAlliance.hasClass("checked")
        }
        d = this.element.find(".iconButton.linkCropfinder");
        if (d.length > 0 && !(d.parent().hasClass("iconRequireGold"))) {
            d.on("click", function (g) {
                window.location.href = "cropfinder.php"
            })
        }
        this.coordinateEnter = jQuery("#mapCoordEnter").on("submit", function (g) {
            var h = {
                x: parseInt(f.coordinateEnter.find("input.coordinates.x").val()),
                y: parseInt(f.coordinateEnter.find("input.coordinates.y").val())
            };
            if (!isNaN(h.x) && !isNaN(h.y)) {
                f.mapContainer.moveTo(h)
            }
            g.stopPropagation();
            return false
        });
        jQuery(document).on("toolbar.updateCoordinates", function (h, g) {
            var i = jQuery("#mapCoordEnter");
            i.find("input.coordinates.x").val(g.x);
            i.find("input.coordinates.y").val(g.y)
        });
        this.update()
    };
    this.update = function () {
        var c = this;
        if (this.transition.zoomLevel === 1) {
            this.zoomIn.addClass("disabled");
            this.zoomOut.removeClass("disabled")
        } else {
            if (this.transition.zoomLevel === this.transition.zoomOptions.sizes.length) {
                this.zoomIn.removeClass("disabled");
                this.zoomOut.addClass("disabled")
            } else {
                this.zoomIn.removeClass("disabled");
                this.zoomOut.removeClass("disabled")
            }
        }
        this.zoomDropDownEntries.each(function (d, f) {
            var e = jQuery(f);
            if (c.zoomDropDownDataContainer._dropped) {
                e.removeClass("selected")
            } else {
                e.addClass("hide").removeClass("display")
            }
        });
        jQuery(this.zoomDropDownEntries[this.transition.zoomLevel - 1]).removeClass("hide").addClass(this.zoomDropDownDataContainer._dropped ? "selected" : "display")
    };
    this.zoom = function () {
        this.update()
    };
    Travian.Game.Map.Base.call(this, a, b)
};
Travian.Game.Map.Toolbar.prototype = Object.create(Travian.Game.Map.Base.prototype);
Travian.Game.Map.Toolbar.constructor = Travian.Game.Map.Toolbar;
Travian.Game.Map.Outline = (function () {
    var a = function (b, c) {
        this.classType = "Travian.Game.Map.Outline";
        this.expanded = false;
        this.animate = function () {
            var d = this;
            this.element.stop(true);
            if (this.expanded === false) {
                this.expanded = true;
                this.elements.tabContainer.show();
                this.cookie.set("outline-expanded", true);
                this.elements.headlineExpander.removeClass("expand").addClass("collapse");
                this.element.animate({height: this.element._height.max}, 200, function () {
                    for (var e in d.parentContainer.mapMarks) {
                        if (d.parentContainer.mapMarks.hasOwnProperty(e)) {
                            d.parentContainer.mapMarks[e].update(false)
                        }
                    }
                })
            } else {
                this.expanded = false;
                this.cookie.set("outline-expanded", false);
                this.elements.headlineExpander.removeClass("collapse").addClass("expand");
                this.element.animate({height: this.element._height.min}, 200, function () {
                    d.elements.tabContainer.hide()
                })
            }
            return this
        };
        this.render = function (d) {
            var e = this;
            this.element = jQuery(this.element);
            this.elements = {
                headline: this.element.find(".headline"),
                headlineExpander: this.element.find(".headline").find(".iconButton"),
                tabContainer: this.element.find(".tabContainer"),
                mapMarks: this.element.find("#mapMarks"),
                background: this.element.find(".background")
            };
            this.expanded = this.cookie.get("outline-expanded");
            this.elements.headlineExpander.addClass(this.expanded === true ? "collapse" : "expand");
            var f = function () {
                e.element._height = {
                    max: e.parentContainer.containerViewSize.height - parseInt(e.element.css("bottom")) - e.parentContainer.miniMap.elements.container.height() - 2,
                    min: e.element.height()
                };
                e.elements.tabContainer.hide();
                if (e.expanded === true) {
                    e.elements.tabContainer.show();
                    e.element.css({height: e.element._height.max});
                    for (var g in e.parentContainer.mapMarks) {
                        if (e.parentContainer.mapMarks.hasOwnProperty(g)) {
                            e.parentContainer.mapMarks[g].update(false)
                        }
                    }
                }
                e.elements.headlineExpander.on("click", function (h) {
                    e.animate()
                })
            };
            f();
            return this
        };
        this.update = function (d) {
            var e = this;
            this.element._height.max += d;
            if (this.expanded) {
                this.element.stop(true);
                this.element.animate({height: this.element._height.max}, 200, function () {
                    for (var f in e.parentContainer.mapMarks) {
                        if (e.parentContainer.mapMarks.hasOwnProperty(f)) {
                            e.parentContainer.mapMarks[f].update(false)
                        }
                    }
                })
            }
            return this
        };
        Travian.Game.Map.Base.call(this, b, c);
        this.render(b)
    };
    a.prototype = Object.create(Travian.Game.Map.Base.prototype);
    a.constructor = a;
    return a
})();
Travian.Game.Map.Layer = function (a, b) {
    Travian.Game.Map.Base.call(this, a, b);
    if (this.position === null && this.parentContainer !== null) {
        this.position = {
            x: 0,
            y: 0,
            width: Math.ceil(this.parentContainer.element.width()),
            height: Math.ceil(this.parentContainer.element.height())
        }
    }
    if (this.parentContainer.classType === "Travian.Game.Map.Layer.Block") {
        this.blockContainer = this.parentContainer
    } else {
        if (this.parentContainer.blockContainer) {
            this.blockContainer = this.parentContainer.blockContainer
        }
    }
    if (typeof a.version !== "undefined") {
        this.setVersion(a.version)
    }
    this.render()
};
Travian.Game.Map.Layer.prototype = Object.create(Travian.Game.Map.Base.prototype);
Travian.Game.Map.Layer.constructor = Travian.Game.Map.Layer;
Travian.Game.Map.Layer.prototype.classType = "Travian.Game.Map.Layer";
Travian.Game.Map.Layer.prototype.parentContainer = null;
Travian.Game.Map.Layer.prototype.position = null;
Travian.Game.Map.Layer.prototype.render = function (a) {
    Travian.Game.Map.Base.prototype.render.call(this, a);
    if (this.id !== null) {
        this.element.addClass(this.id)
    }
    if (this.position) {
        this.element.css({
            position: "absolute",
            left: this.position.x,
            top: this.position.y,
            width: this.position.width,
            height: this.position.height
        })
    }
    if (this.zIndex) {
        this.element.css({zIndex: this.zIndex + 1})
    }
    if (this.parentContainer && this.parentContainer.element) {
        this.element.appendTo(this.parentContainer.element)
    }
    return this
};
Travian.Game.Map.Layer.prototype.finishedLoading = function () {
    return this
};
Travian.Game.Map.Layer.prototype.forceUpdateContent = function () {
    return this
};
Travian.Game.Map.Layer.prototype.getContentForTooltip = function (a) {
    return false
};
Travian.Game.Map.Layer.prototype.getRequestData = function () {
    return false
};
Travian.Game.Map.Layer.prototype.hide = function () {
    this.element.hide();
    return this
};
Travian.Game.Map.Layer.prototype.refreshContent = function () {
    return this
};
Travian.Game.Map.Layer.prototype.setVersion = function (a) {
    return this
};
Travian.Game.Map.Layer.prototype.show = function () {
    this.element.show();
    return this
};
Travian.Game.Map.Layer.prototype.update = function () {
    this.element.css({left: this.position.x + "px", top: this.position.y + "px"});
    return this
};
Travian.Game.Map.Layer.prototype.updateContent = function () {
    return this
};
Travian.Game.Map.Layer.Block = (function () {
    var g = function (l, k, j) {
        k.position = k.position || j;
        if (typeof k.text === "undefined" && typeof k.title === "undefined") {
            k.text = Travian.Helpers.substitute(l.tooltipHtml, {x: k.position.x, y: k.position.y})
        }
        return k
    };
    var i = function (n, q) {
        var p = Object.assign({}, q);
        var s = n.transition.getPointOfCenterInView();
        var m = Object.assign({}, n.mapCoordinates);
        p.x = parseFloat(p.x);
        p.y = parseFloat(p.y);
        s.x = parseFloat(s.x);
        s.y = parseFloat(s.y);
        m.x = parseFloat(m.x);
        m.y = parseFloat(m.y);
        var l = function (y) {
            return y > 0 ? 1 : y < 0 ? -1 : 0
        };
        var w = {
            x: (n.transition.border.right - Math.abs(p.x) < n.transition.border.right / 2),
            y: (n.transition.border.top - Math.abs(p.y) < n.transition.border.top / 2)
        };
        var o = {
            x: (n.transition.border.right - Math.abs(s.x) < n.transition.border.right / 2),
            y: (n.transition.border.top - Math.abs(s.y) < n.transition.border.top / 2)
        };
        var v = {
            x: (n.transition.border.right - Math.abs(m.x) < n.transition.border.right / 2),
            y: (n.transition.border.top - Math.abs(m.y) < n.transition.border.top / 2)
        };
        var j = l(p.x);
        var u = l(s.x);
        if ((w.x || o.x) && (j + u === 0 && j !== u)) {
            p.x += u * n.transition.border.width
        }
        var x = l(p.y);
        var r = l(s.y);
        if ((w.y || o.y) && (x + r === 0 && x !== r)) {
            p.y += r * n.transition.border.height
        }
        var t = l(m.x);
        if ((v.x || o.x) && (t + u === 0 && t !== u)) {
            m.x += u * n.transition.border.width
        }
        var k = l(m.y);
        if ((v.y || o.y) && (k + r === 0 && k !== r)) {
            m.y += r * n.transition.border.height
        }
        return {
            x: (p.x - m.x) * n.transition.pixelPerTile.x,
            y: (n.transition.elementsPerBlock.y - (p.y - m.y) - 1) * n.transition.pixelPerTile.y
        }
    };
    var d = function (o, m) {
        if (!m.type) {
            throw"Missing symbol type for symbol: " + m.dataId
        }
        if (m.position) {
            m.x = m.position.x;
            m.y = m.position.y
        }
        var l = o.symbolTypes[m.type];
        if (!l || !l["class"] || !l.visibleInZoom[o.transition.zoomLevel]) {
            return
        }
        if (!o.symbols[m.x]) {
            o.symbols[m.x] = {}
        }
        if (!o.symbols[m.x][m.y]) {
            o.symbols[m.x][m.y] = {}
        }
        var n = i(o, {x: m.x, y: m.y});
        var k = o.symbols[m.x][m.y];
        var j = f(o, l, k);
        k[m.dataId] = new l["class"](Object.assign({}, l, m, {
            positionOfTile: {x: n.x, y: n.y},
            positionInTile: j,
            position: {
                x: n.x + j.x,
                y: n.y + j.y,
                width: l.sizes[o.transition.zoomLevel].width,
                height: l.sizes[o.transition.zoomLevel].height
            },
            positionDefault: {
                x: n.x + j.x,
                y: n.y + j.y,
                width: l.sizes[o.transition.zoomLevel].width,
                height: l.sizes[o.transition.zoomLevel].height
            },
            symbolSize: {width: l.sizes[o.transition.zoomLevel].width, height: l.sizes[o.transition.zoomLevel].height}
        }), o)
    };
    var e = function (k) {
        c(k);
        var j = k.dataStore.getDataForArea(Travian.Game.Map.DataStore.TYPE_SYMBOL, k.mapCoordinates, true);
        j.forEach(function (l) {
            d(k, l)
        })
    };
    var c = function (l) {
        for (var j in l.symbols) {
            if (l.symbols.hasOwnProperty(j)) {
                for (var m in l.symbols[j]) {
                    if (l.symbols[j].hasOwnProperty(m)) {
                        for (var k in l.symbols[j][m]) {
                            if (l.symbols[j][m].hasOwnProperty(k)) {
                                l.symbols[j][m][k].destroy()
                            }
                        }
                    }
                }
            }
        }
        l.symbols = {}
    };
    var f = function (o, n, k) {
        var j = {x: false, y: false};
        var l = n.sizes[o.transition.zoomLevel].width;
        var m = Object.keys(k).reverse().find(function (q) {
            var p = k[q].position.x === k[q].positionDefault.x;
            p = p && k[q].position.y === k[q].positionDefault.y;
            p = p && k[q].position.width === k[q].positionDefault.width;
            p = p && k[q].position.height === k[q].positionDefault.height;
            return p
        });
        if (m) {
            j.x = k[m].positionInTile.x;
            j.x += l
        }
        if (j.x === false) {
            j.x = 0
        }
        if (j.x + l > (o.position.width / o.transition.elementsPerBlock.x)) {
            j.x = 0;
            j.y += n.sizes[o.transition.zoomLevel].height
        }
        return j
    };
    var h = function (o, j, n) {
        if (typeof n === "undefined") {
            n = {}
        }
        if (typeof n.tiles !== "undefined" && n.tiles.length !== 0) {
            for (var k in n.tiles) {
                if (n.tiles.hasOwnProperty(k)) {
                    var l = n.tiles[k];
                    l = g(o, l, j);
                    if (l.position.x === j.x && l.position.y === j.y) {
                        n.tile = l
                    }
                    o.dataStore.set({position: l.position, type: Travian.Game.Map.DataStore.TYPE_TOOLTIP, data: l})
                }
            }
            o.dataStore.saveDataToStorage()
        }
        if (j.x === o.mapContainer.currentMousePosition.map.x && j.y === o.mapContainer.currentMousePosition.map.y) {
            o.mapContainer.contextMenu.update();
            var m = Object.assign({unescaped: true}, o.dataStore.get(Travian.Game.Map.DataStore.TYPE_TOOLTIP, j));
            Travian.Tip.set(o.mapContainer.containerMover, m);
            Travian.Tip.show(m)
        }
    };
    var a = function (l, j, k) {
        if (l.mapContainer.currentMousePosition.map.x == null || l.mapContainer.currentMousePosition.map.y == null) {
            return
        }
        if (j.x !== l.mapContainer.currentMousePosition.map.x || j.y !== l.mapContainer.currentMousePosition.map.y) {
            return
        }
        l.mapContainer.containerMover.setTitle({title: "", text: Travian.Helpers.substitute("{x}|{y}", j)})
    };
    var b = function (j, k) {
        this.mapCoordinates = null;
        this.layers = null;
        this.symbols = {};
        this.dataStore = null;
        this.versionCache = null;
        this.classType = "Travian.Game.Map.Layer.Block";
        this.addSymbol = function (l) {
            d(this, l);
            return this
        };
        this.deleteSymbol = function (l) {
            if (!this.symbols || !this.symbols[l.position.x] || !this.symbols[l.position.x][l.position.y]) {
                return this
            }
            if (this.symbols[l.position.x][l.position.y][l.dataId]) {
                this.symbols[l.position.x][l.position.y][l.dataId].destroy();
                delete (this.symbols[l.position.x][l.position.y][l.dataId])
            }
            return this
        };
        this.forceUpdateLayer = function (l) {
            if (this.layers[l]) {
                this.layers[l].forceUpdateContent()
            }
            return this
        };
        this.forceUpdateSymbols = function (n, m) {
            if (this.symbols) {
                for (var l in this.symbols) {
                    if (this.symbols.hasOwnProperty(l)) {
                        for (var q in this.symbols[l]) {
                            if (this.symbols[l].hasOwnProperty(q)) {
                                for (var p in this.symbols[l][q]) {
                                    if (this.symbols[l][q].hasOwnProperty(p)) {
                                        var o = this.symbols[l][q][p];
                                        if (o.layer === n) {
                                            o.forceUpdate(m)
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return this
        };
        this.getContentForTooltip = function (l) {
            var p = this;
            var m = this.transition.translateToMap(l);
            if (this.symbols && this.symbols[m.x] && this.symbols[m.x][m.y] && this.symbols[m.x][m.y] !== 0) {
                var q = false;
                var o = (function (r) {
                    for (var s in r) {
                        if (r.hasOwnProperty(s)) {
                            var t = r[s];
                            q = t.getContentForTooltip();
                            if (q !== false && t.isPositionInRect({x: l.x - p.position.x, y: l.y - p.position.y})) {
                                return t
                            }
                        }
                    }
                })(this.symbols[m.x][m.y]);
                if (o && q !== false) {
                    return q
                }
            }
            var n = this.dataStore.get(Travian.Game.Map.DataStore.TYPE_TOOLTIP, m);
            if (n != null && (n.text !== undefined || n.title !== undefined)) {
                n = {text: n.text, title: n.title}
            } else {
                n = {title: "", text: Travian.Translation.translate(this.tooltipHtml, m)};
                this.requestDataForPosition(m)
            }
            return n
        };
        this.getData = function () {
            return Object.assign({
                loaded: false,
                version: 0
            }, this.dataStore.get(Travian.Game.Map.DataStore.TYPE_BLOCKS, this.mapCoordinates, "block") || {})
        };
        this.getRequestData = function () {
            return {
                position: {
                    x0: this.mapCoordinates.x,
                    y0: this.mapCoordinates.y,
                    x1: this.mapCoordinates.right,
                    y1: this.mapCoordinates.top
                }
            }
        };
        this.getVersion = function () {
            if (this.versionCache == null) {
                this.versionCache = this.getData().version
            }
            return this.versionCache
        };
        this.invalidateVersionCache = function () {
            this.versionCache = null;
            return this
        };
        this.move = function (m) {
            if (m.x === 0 && m.y === 0) {
                return this
            }
            this.position.x += m.x;
            this.position.y -= m.y;
            var l = Travian.Game.Map.Layer.Block.getCorrectPosition(this.position, this.mapContainer);
            this.position = l.position;
            this.mapCoordinates = this.transition.translateToMap(this.position);
            this.update(l.updateInnerContent);
            return this
        };
        this.refreshContent = function (l) {
            if (l) {
                var n = this.getData();
                n.loaded = true;
                this.setData(n)
            }
            Travian.Game.Map.Layer.prototype.refreshContent.call(this);
            for (var m in this.layers) {
                if (this.layers.hasOwnProperty(m)) {
                    this.layers[m].refreshContent()
                }
            }
            e(this);
            return this
        };
        this.render = function (l) {
            var q = this;
            this.layers = {};
            Travian.Game.Map.Layer.prototype.render.call(this, l);
            this.mapCoordinates = this.transition.registerCallbackOnZoom(function () {
                q.mapCoordinates = q.transition.translateToMap(q.position);
                q.update(true)
            }).translateToMap(this.position);
            for (var n in this.mapContainer.layers) {
                if (this.mapContainer.layers.hasOwnProperty(n)) {
                    var m = this.mapContainer.layers[n];
                    if (!m["class"]) {
                        continue
                    }
                    var o = Object.assign({}, m, {index: n});
                    this.layers[o.id] = new m["class"](o, this)
                }
            }
            var p = this.getData();
            p.loaded = true;
            this.setData(p);
            e(this);
            return this
        };
        this.requestDataForPosition = function (l) {
            var m = this;
            this.updater.requestPosition({
                dataStoreType: Travian.Game.Map.DataStore.TYPE_TOOLTIP,
                position: l,
                onSuccess: function (o, n) {
                    h(m, l, o)
                },
                onError: function (o, n) {
                    a(m, l, o)
                }
            });
            return this
        };
        this.setData = function (l) {
            this.dataStore.push({
                type: Travian.Game.Map.DataStore.TYPE_BLOCKS,
                position: this.mapCoordinates,
                index: "block",
                data: Object.assign({loaded: false, version: 0}, l)
            });
            return this
        };
        this.setVersion = function (l) {
            var m = this.getData();
            m.version = l;
            return this.setData(m)
        };
        this.update = function (l) {
            Travian.Game.Map.Layer.prototype.update.call(this);
            this.updateContent(l);
            return this
        };
        this.updateContent = function (l) {
            Travian.Game.Map.Layer.prototype.updateContent.call(this);
            for (var m in this.layers) {
                if (this.layers.hasOwnProperty(m)) {
                    this.layers[m].updateContent(l)
                }
            }
            if (l) {
                c(this);
                if (this.getData.loaded) {
                    this.refreshContent(false)
                } else {
                    this.updater.register("ajax", this)
                }
            }
            return this
        };
        this.updateSymbolData = function (l) {
            if (!this.symbols || !this.symbols[l.position.x] || !this.symbols[l.position.x][l.position.y]) {
                return this
            }
            if (this.symbols[l.position.x][l.position.y][l.dataId]) {
                this.symbols[l.position.x][l.position.y][l.dataId].updateData(l)
            }
            return this
        };
        Travian.Game.Map.Layer.call(this, j, k)
    };
    b.prototype = Object.create(Travian.Game.Map.Layer.prototype);
    b.constructor = b;
    return b
})();
Travian.Game.Map.Layer.Block.getCorrectPosition = function (b, c) {
    var a = {position: b, updateInnerContent: false, updateBlockPosition: false};
    do {
        a.updateBlockPosition = false;
        if (a.position.x < 0 && Math.abs(a.position.x) >= c.blockSize.width) {
            a.position.x = c.elementSize.width + a.position.x;
            a.updateInnerContent = true;
            a.updateBlockPosition = true
        } else {
            if (a.position.x + a.position.width > c.elementSize.width) {
                a.position.x = a.position.x - c.elementSize.width;
                a.updateInnerContent = true;
                a.updateBlockPosition = true
            }
        }
        if (a.position.y < 0 && Math.abs(a.position.y) >= c.blockSize.height) {
            a.position.y = c.elementSize.height + a.position.y;
            a.updateInnerContent = true;
            a.updateBlockPosition = true
        } else {
            if (a.position.y + a.position.height > c.elementSize.height) {
                a.position.y = a.position.y - c.elementSize.height;
                a.updateInnerContent = true;
                a.updateBlockPosition = true
            }
        }
    } while (a.updateBlockPosition);
    return a
};
Travian.Game.Map.Layer.Image = function (a, b) {
    this.image = null;
    this.srcUrl = null;
    this.getPriority = function () {
        var e = {
            x: this.blockContainer.mapCoordinates.x + (this.blockContainer.mapCoordinates.right - this.blockContainer.mapCoordinates.x) / 2,
            y: this.blockContainer.mapCoordinates.y + (this.blockContainer.mapCoordinates.top - this.blockContainer.mapCoordinates.y) / 2
        };
        var c = this.transition.getPointOfCenterInView();
        var d = {x: c.x - e.x, y: c.y - e.y};
        return Math.pow(d.x, 2) + Math.pow(d.y, 2)
    };
    this.getSrcUrl = function () {
        return Travian.Helpers.substitute(this.src, {
            x: this.parentContainer.mapCoordinates.x,
            y: this.parentContainer.mapCoordinates.y,
            right: this.parentContainer.mapCoordinates.right,
            top: this.parentContainer.mapCoordinates.top,
            width: this.position.width,
            height: this.position.height,
            time: this.time,
            forcedUpdates: this.mapContainer.forcedUpdates,
            version: this.blockContainer.getVersion(),
            uid: this.uid
        })
    };
    this.refreshSrcUrl = function () {
        this.srcUrl = this.getSrcUrl();
        return this
    };
    this.render = function (c) {
        Travian.Game.Map.Layer.prototype.render.call(this, {nodeType: '<img src="' + this.srcInit + '">'});
        this.time = (new Date()).getTime();
        this.updateContent();
        return this
    };
    Travian.Game.Map.Layer.call(this, a, b)
};
Travian.Game.Map.Layer.Image.prototype = Object.create(Travian.Game.Map.Layer.prototype);
Travian.Game.Map.Layer.Image.constructor = Travian.Game.Map.Layer.Image;
Travian.Game.Map.Layer.Image.prototype.classType = "Travian.Game.Map.Layer.Image";
Travian.Game.Map.Layer.Image.prototype.updateContent = function (a) {
    var b = this.getSrcUrl();
    if (this.srcUrl !== b || a) {
        this.refreshSrcUrl();
        this.updater.register("images", this)
    }
    return this
};
Travian.Game.Map.Layer.ImageMark = function (a, b) {
    this.classType = "Travian.Game.Map.Layer.ImageMark";
    this.finishedLoading = function () {
        Travian.Game.Map.Layer.Image.prototype.finishedLoading.call(this);
        this.show();
        return this
    };
    this.forceUpdateContent = function () {
        this.time = (new Date()).getTime();
        this.updateContent(true);
        return this
    };
    this.updateContent = function (c) {
        Travian.Game.Map.Layer.Image.prototype.updateContent.call(this, c);
        if (c) {
            this.hide()
        }
        return this
    };
    Travian.Game.Map.Layer.Image.call(this, a, b)
};
Travian.Game.Map.Layer.ImageMark.prototype = Object.create(Travian.Game.Map.Layer.Image.prototype);
Travian.Game.Map.Layer.ImageMark.constructor = Travian.Game.Map.Layer.Image;
Travian.Game.Map.Layer.Loading = function (a, b) {
    this.classType = "Travian.Game.Map.Layer.Loading";
    this.render = function (c) {
        Travian.Game.Map.Layer.prototype.render.call(this, c);
        this.element.css(this.styles).hide();
        return this
    };
    this.updateContent = function (c) {
        return this
    };
    Travian.Game.Map.Layer.call(this, a, b)
};
Travian.Game.Map.Layer.Loading.prototype = Object.create(Travian.Game.Map.Layer.prototype);
Travian.Game.Map.Layer.Loading.constructor = Travian.Game.Map.Layer;
Travian.Game.Map.Layer.Symbol = function (a, b) {
    this.byUser = false;
    this.visible = true;
    this.destroy = function () {
        if (this.element) {
            this.element.remove()
        }
        return this
    };
    this.forceUpdate = function (c) {
        if (this.byUser) {
            this.visible = c;
            this.element[c ? "show" : "hide"]()
        }
        return this
    };
    a.mapCoordinates = a.mapCoordinates || b.transition.translateToMap({
        x: a.position.x + b.position.x,
        y: a.position.y + b.position.y
    });
    a.id = a.id || Travian.Game.Map.getNewId();
    a.parameters = a.parameters || {};
    Travian.Game.Map.Layer.call(this, a, b)
};
Travian.Game.Map.Layer.Symbol.prototype = Object.create(Travian.Game.Map.Layer.prototype);
Travian.Game.Map.Layer.constructor = Travian.Game.Map.Layer;
Travian.Game.Map.Layer.Symbol.prototype.classType = "Travian.Game.Map.Layer.Symbol";
Travian.Game.Map.Layer.Symbol.prototype.updateData = function (a) {
    this.title = a.title;
    this.text = a.text
};
Travian.Game.Map.Layer.Symbol.prototype.getContentForTooltip = function () {
    if (this.visible && (this.title || this.text)) {
        return {title: this.title, text: this.text}
    }
    return false
};
Travian.Game.Map.Layer.Symbol.prototype.render = function (a) {
    Travian.Game.Map.Layer.prototype.render.call(this, {nodeType: "<img/>"}, a);
    this.element.attr("src", Travian.Helpers.substitute(this.imgSource, Object.assign({}, this.parameters, {
        width: this.symbolSize.width,
        height: this.symbolSize.height,
        zoomLevel: this.transition.zoomLevel
    }))).css({
        position: "absolute",
        left: this.position.x,
        top: this.position.y,
        width: this.position.width,
        height: this.position.height
    });
    return this
};
Travian.Game.Map.Layer.Symbol.Flag = function (a, b) {
    this.classType = "Travian.Game.Map.Layer.Symbol.Flag";
    this.index = null;
    this.render = function (d) {
        this.parameters.index = this.index || 1;
        Travian.Game.Map.Layer.Symbol.prototype.render.call(this, d);
        var c = Travian.Game.Map.Options.Toolbar;
        var e = this.layer === "alliance" ? "filterAlliance" : "filterPlayer";
        if (this.mapContainer.toolbar) {
            c = this.mapContainer.toolbar
        }
        this.forceUpdate(c[e].checked);
        return this
    };
    this.updateData = function (c) {
        Travian.Game.Map.Layer.Symbol.prototype.updateData.call(this, c);
        this.parameters.index = this.index = c.index;
        this.element.attr("src", Travian.Helpers.substitute(this.imgSource, Object.assign({}, this.parameters, {
            zoomLevel: this.transition.zoomLevel,
            width: this.symbolSize.width,
            height: this.symbolSize.height
        })))
    };
    Travian.Game.Map.Layer.Symbol.call(this, a, b)
};
Travian.Game.Map.Layer.Symbol.Flag.prototype = Object.create(Travian.Game.Map.Layer.Symbol.prototype);
Travian.Game.Map.Layer.Symbol.constructor = Travian.Game.Map.Layer.Symbol;
Travian.Game.Map.Layer.Symbol.Attack = function (a, b) {
    this.classType = "Travian.Game.Map.Layer.Symbol.Attack";
    Travian.Game.Map.Layer.Symbol.call(this, a, b)
};
Travian.Game.Map.Layer.Symbol.Attack.prototype = Object.create(Travian.Game.Map.Layer.Symbol.prototype);
Travian.Game.Map.Layer.Symbol.Attack.constructor = Travian.Game.Map.Layer.Symbol;
Travian.Game.Map.Layer.Symbol.BattleGround = function (a, b) {
    this.classType = "Travian.Game.Map.Layer.Symbol.BattleGround";
    this.getContentForTooltip = function () {
        return false
    };
    this.render = function (c) {
        this.position = {
            x: this.positionOfTile.x,
            y: this.positionOfTile.y,
            width: this.transition.pixelPerTile.x,
            height: this.transition.pixelPerTile.y
        };
        Travian.Game.Map.Layer.Symbol.prototype.render.call(this, c);
        return this
    };
    Travian.Game.Map.Layer.Symbol.call(this, a, b)
};
Travian.Game.Map.Layer.Symbol.BattleGround.prototype = Object.create(Travian.Game.Map.Layer.Symbol.prototype);
Travian.Game.Map.Layer.Symbol.BattleGround.constructor = Travian.Game.Map.Layer.Symbol.BattleGround;
Travian.Game.Map.Layer.Symbol.Adventure = function (a, b) {
    this.classType = "Travian.Game.Map.Layer.Symbol.Adventure";
    this.render = function (c) {
        this.position = {
            x: this.positionOfTile.x + this.transition.pixelPerTile.x - this.position.width,
            y: this.positionOfTile.y + this.transition.pixelPerTile.y - this.position.height,
            width: this.position.width,
            height: this.position.height
        };
        Travian.Game.Map.Layer.Symbol.prototype.render.call(this, c);
        return this
    };
    Travian.Game.Map.Layer.Symbol.call(this, a, b)
};
Travian.Game.Map.Layer.Symbol.Adventure.prototype = Object.create(Travian.Game.Map.Layer.Symbol.prototype);
Travian.Game.Map.Layer.Symbol.Adventure.constructor = Travian.Game.Map.Layer.Symbol.Adventure;
Travian.Game.Map.Layer.Symbol.Reinforcement = function (a, b) {
    this.classType = "Travian.Game.Map.Layer.Symbol.Reinforcement";
    this.render = function (c) {
        this.position = {
            x: this.positionOfTile.x,
            y: this.positionOfTile.y + this.transition.pixelPerTile.y - this.position.height,
            width: this.position.width,
            height: this.position.height
        };
        Travian.Game.Map.Layer.Symbol.prototype.render.call(this, c);
        return this
    };
    Travian.Game.Map.Layer.Symbol.call(this, a, b)
};
Travian.Game.Map.Layer.Symbol.Reinforcement.prototype = Object.create(Travian.Game.Map.Layer.Symbol.prototype);
Travian.Game.Map.Layer.Symbol.Reinforcement.constructor = Travian.Game.Map.Layer.Symbol.Reinforcement;
Travian.Game.Map.MapMark = function (a, b) {
    this.classType = "Travian.Game.Map.MapMark";
    this.render = function () {
        this.element = jQuery(this.element);
        for (var e in this.layers) {
            if (this.layers.hasOwnProperty(e)) {
                var d = this.layers[e];
                this.layers[e] = new d["class"](d, this)
            }
        }
        this.update();
        for (var c = 0; c < this.data.length; c++) {
            var f = this.data[c];
            if (!f.layer || !this.layers[f.layer]) {
                continue
            }
            this.layers[f.layer].addData(f)
        }
        return this
    };
    this.update = function () {
        var g = [];
        var f = this.element.height();
        for (var e in this.layers) {
            if (this.layers.hasOwnProperty(e)) {
                var d = this.layers[e];
                g.push({data: d.elements.data, expandContainer: d.elements.expandContainer, expanded: d.expanded});
                f -= d.element.outerHeight() - d.elements.expandContainer.outerHeight()
            }
        }
        for (var c = 0; c < g.length; c++) {
            var h = g[c];
            h.data.parent().css({height: f});
            h.expandContainer.css({height: h.expanded ? f : 0})
        }
    };
    Travian.Game.Map.Base.call(this, a, b);
    this.render()
};
Travian.Game.Map.MapMark.prototype = Object.create(Travian.Game.Map.Base.prototype);
Travian.Game.Map.MapMark.constructor = Travian.Game.Map.MapMark;
Travian.Game.Map.MapMark.Layer = function (b, c) {
    Travian.Game.Map.Base.call(this, b, c);
    var a = this.cookie.get("markLayer-" + this.parentContainer.typeId + "-" + this.typeId + "-expanded");
    if (a != null) {
        this.expanded = a
    }
    this.datas = {};
    this.render()
};
Travian.Game.Map.MapMark.Layer.prototype = Object.create(Travian.Game.Map.Base.prototype);
Travian.Game.Map.MapMark.Layer.constructor = Travian.Game.Map.MapMark.Layer;
Travian.Game.Map.MapMark.Layer.prototype.classType = "Travian.Game.Map.MapMark.Layer";
Travian.Game.Map.MapMark.Layer.prototype.addData = function (a) {
    return this
};
Travian.Game.Map.MapMark.Layer.prototype.deleteData = function (a) {
    if (this.datas[a.id]) {
        delete (this.datas[a.id])
    }
    return this
};
Travian.Game.Map.MapMark.Layer.prototype.render = function (a) {
    var b = this;
    this.element = jQuery("<div/>").addClass("collapseContainer").html(Travian.Helpers.substitute(this.html, Object.assign({}, a || {}, {
        data: "scroll-dataContainer",
        add: "addButton",
        expandButton: "expandButton",
        expandContainer: "expandContainer",
        title: this.title
    }))).appendTo(this.parentContainer.element);
    this.elements = {
        data: this.element.find(".scroll-dataContainer"),
        title: this.element.find(".title"),
        add: this.element.find(".addButton"),
        expandButton: this.element.find(".expandButton"),
        expandContainer: this.element.find(".expandContainer")
    };
    if (!this.editable && this.elements.add) {
        this.elements.add.hide()
    }
    if (this.elements.expandButton) {
        this.elements.expandButton.addClass(this.expanded ? "collapse" : "expand");
        this.elements.expandButton.on("click", function (f) {
            if (!b.expanded) {
                for (var d in b.parentContainer.layers) {
                    if (b.parentContainer.layers.hasOwnProperty(d)) {
                        var c = b.parentContainer.layers[d];
                        c.expanded = false;
                        c.elements.expandButton.removeClass("collapse").addClass("expand");
                        b.cookie.set("markLayer-" + c.parentContainer.typeId + "-" + c.typeId + "-expanded", c.expanded)
                    }
                }
                b.expanded = true;
                b.elements.expandButton.removeClass("expand").addClass("collapse");
                b.cookie.set("markLayer-" + b.parentContainer.typeId + "-" + b.typeId + "-expanded", true)
            }
            b.parentContainer.update()
        })
    }
    this.elements.data.scrollbar();
    return this
};
Travian.Game.Map.MapMark.Layer.Mark = function (a, c) {
    this.classType = "Travian.Game.Map.MapMark.Layer.Mark";
    this.dialogInstance = null;
    this.addData = function (d) {
        var e = new Travian.Game.Map.MapMark.Layer.Data.Mark(Object.assign({}, d, this.optionsData, {editable: this.editable}), this);
        this.datas[e.id] = e;
        return this
    };
    this.add = function (d) {
        var e = this;
        if (!this.editable) {
            return this
        }
        Travian.ajax({
            data: {
                cmd: "mapMultiMarkAdd",
                data: {
                    x: d.position.x,
                    y: d.position.y,
                    type: this.typeId,
                    color: d.color || 0,
                    owner: this.parentContainer.typeId,
                    text: d.text || undefined,
                    title: d.title || undefined
                }
            }, onSuccess: function (f) {
                e.addData(f);
                e.mapContainer.forceUpdateBlocksLayer("imageMark");
                e.dialogInstance.close();
                e.dialogInstance = null
            }, onError: function (g, f) {
                e.dialogInstance.enableForm().toElement().find(".errorMessage").html(f);
                return false
            }
        });
        return this
    };
    this.render = function (d) {
        var e = this;
        Travian.Game.Map.MapMark.Layer.prototype.render.call(this, d);
        this.elements.add.on("click", function (f) {
            e.showDialog()
        });
        return this
    };
    this.showDialog = function (d) {
        var f = this;
        d = Object.assign({
            color: this.color,
            onOkay: this.add.bind(this),
            onOpen: Travian.emptyFunction,
            position: {x: "", y: ""}
        }, d || {});
        this.color = d.color;
        var e = Travian.Helpers.substitute(this.dialog.html, {
            select: "select",
            textX: this.dialog.textX,
            textY: this.dialog.textY,
            textDisplay: "textDisplay",
            coord: "coord",
            inputX: "inputX",
            inputY: "inputY"
        });
        this.dialogInstance = new Travian.Dialog.Dialog({
            keepOpen: true,
            relativeTo: this.mapContainer.container,
            elementFocus: d.position.x === "" ? this.dialog.elementFocusNew : this.dialog.elementFocusEdit,
            buttonTextOk: this.dialog.textOkay,
            buttonTextCancel: this.dialog.textCancel,
            title: this.dialog.title,
            preventFormSubmit: true,
            onOpen: function (h, i) {
                i.find("input.inputX").val(d.position.x);
                i.find("input.inputY").val(d.position.y);
                var g = new Travian.Game.ColorPicker(i.find(".select"), {
                    colors: f.colorsArray,
                    defaultColor: f.color,
                    onChange: function (j, k) {
                        f.colorsArray.map(function (l, m) {
                            if (l === j) {
                                f.color = m
                            }
                        })
                    }
                });
                d.onOpen(h, i, g)
            },
            onOkay: function (g, h) {
                d.onOkay({
                    color: f.color,
                    position: {x: h.find("input.inputX").val(), y: h.find("input.inputY").val()}
                }, g, h)
            }
        });
        this.dialogInstance.setContent(e);
        this.dialogInstance.show();
        return this
    };
    Travian.Game.Map.MapMark.Layer.call(this, a, c);
    this.colorsArray = [];
    for (var b in this.colors) {
        if (this.colors.hasOwnProperty(b) && typeof this.colors[b] === "string") {
            this.colorsArray.push(this.colors[b])
        }
    }
};
Travian.Game.Map.MapMark.Layer.Mark.prototype = Object.create(Travian.Game.Map.MapMark.Layer.prototype);
Travian.Game.Map.MapMark.Layer.Mark.constructor = Travian.Game.Map.MapMark.Layer;
Travian.Game.Map.MapMark.Layer.Flag = function (a, c) {
    this.classType = "Travian.Game.Map.MapMark.Layer.Flag";
    this.dialogInstance = null;
    this.add = function (d) {
        var e = this;
        if (!this.editable) {
            return this
        }
        if (d.index < this.indexes.min) {
            d.index = this.indexes.max
        }
        if (d.index > this.indexes.max) {
            d.index = this.indexes.min
        }
        Travian.ajax({
            data: {
                cmd: "mapFlagAdd",
                data: {
                    x: d.position.x,
                    y: d.position.y,
                    color: d.index || this.indexes.min,
                    owner: this.parentContainer.typeId,
                    text: d.text || undefined,
                    title: d.title || undefined
                }
            }, onSuccess: function (f) {
                f.type = "flag";
                e.dataStore.push({
                    type: Travian.Game.Map.DataStore.TYPE_SYMBOL,
                    index: f.dataId,
                    position: f.position,
                    data: f,
                    time: false
                });
                e.addData(f);
                f.position = d.position;
                f.layer = e.parentContainer.typeId;
                e.mapContainer.addSymbol(f);
                e.dialogInstance.close();
                e.dialogInstance = null
            }, onError: function (g, f) {
                e.dialogInstance.enableForm().toElement().find(".errorMessage").html(f);
                return false
            }
        });
        return this
    };
    this.addData = function (e) {
        var d = new Travian.Game.Map.MapMark.Layer.Data.Flag(Object.assign({}, e, this.optionsData, {editable: this.editable}), this);
        this.datas[d.id] = d;
        return this
    };
    this.render = function (d) {
        Travian.Game.Map.MapMark.Layer.prototype.render.call(this, d);
        var e = this;
        this.elements.add.on("click", function (f) {
            e.showDialog(d)
        });
        return this
    };
    this.showDialog = function (d) {
        var f = this;
        d = Object.assign({
            index: this.index,
            onOkay: this.add.bind(this),
            onOpen: Travian.emptyFunction,
            text: "",
            position: {x: "", y: ""}
        }, d || {});
        this.index = d.index;
        var e = Travian.Helpers.substitute(this.dialog.html, {
            select: "select",
            textX: this.dialog.textX,
            textY: this.dialog.textY,
            textDisplay: "textDisplay",
            coord: "coord",
            inputX: "inputX",
            inputY: "inputY",
            inputText: "inputText"
        });
        this.dialogInstance = new Travian.Dialog.Dialog({
            keepOpen: true,
            relativeTo: this.mapContainer.container,
            elementFocus: d.position.x === "" ? this.dialog.elementFocusNew : this.dialog.elementFocusEdit,
            buttonTextOk: this.dialog.textOkay,
            buttonTextCancel: this.dialog.textCancel,
            title: this.dialog.title,
            preventFormSubmit: true,
            onOpen: function (h, i) {
                i.find("input.inputX").val(d.position.x);
                i.find("input.inputY").val(d.position.y);
                i.find("input.inputText").val(d.text);
                var g = new Travian.Game.ImagePicker(i.find(".select"), {
                    images: f.imagesArray,
                    defaultImage: f.index - f.indexes.min,
                    onChange: function (j) {
                        f.imagesArray.map(function (l, k) {
                            if (l === j) {
                                f.index = k + 1
                            }
                        })
                    }
                });
                d.onOpen(h, i, g)
            },
            onOkay: function (g, h) {
                if (f.index < f.indexes.min) {
                    f.index += f.indexes.min - 1
                }
                d.onOkay({
                    index: f.index,
                    text: h.find("input.inputText").val(),
                    position: {x: h.find("input.inputX").val(), y: h.find("input.inputY").val()}
                }, g, h)
            }
        });
        this.dialogInstance.setContent(e);
        this.dialogInstance.show();
        return this
    };
    Travian.Game.Map.MapMark.Layer.call(this, a, c);
    this.imagesArray = [];
    for (var b = this.indexes.min; b <= this.indexes.max; b++) {
        this.imagesArray.push(Travian.Helpers.substitute(this.imgSource, {index: b}))
    }
};
Travian.Game.Map.MapMark.Layer.Flag.prototype = Object.create(Travian.Game.Map.MapMark.Layer.prototype);
Travian.Game.Map.MapMark.Layer.Flag.constructor = Travian.Game.Map.MapMark.Layer;
Travian.Game.Map.MapMark.Layer.Data = function (a, b) {
    Travian.Game.Map.MapMark.Layer.call(this, a, b)
};
Travian.Game.Map.MapMark.Layer.Data.prototype = Object.create(Travian.Game.Map.MapMark.Layer.prototype);
Travian.Game.Map.MapMark.Layer.Data.constructor = Travian.Game.Map.MapMark.Layer;
Travian.Game.Map.MapMark.Layer.Data.prototype.classType = "Travian.Game.Map.MapMark.Layer.Data";
Travian.Game.Map.MapMark.Layer.Data.prototype.del = function () {
    this.destroy();
    this.parentContainer.deleteData(this);
    return this
};
Travian.Game.Map.MapMark.Layer.Data.prototype.render = function (a) {
    var b = this;
    this.element = jQuery("<div/>").html(Travian.Helpers.substitute(this.html, Object.assign({}, a || {}, {
        entry: this.id,
        text: "textContainer",
        "delete": "deleteButton",
        select: "selectLink",
        editDelete: "editDeleteContainer"
    }))).appendTo(this.parentContainer.elements.data);
    this.elements = {
        text: this.element.find(".textContainer"),
        "delete": this.element.find(".deleteButton"),
        select: this.element.find(".selectLink"),
        editDelete: this.element.find(".editDeleteContainer")
    };
    this.elements["delete"].on("click", function (c) {
        b.del()
    });
    this.elements.text.html(this.text);
    if (!this.editable && this.elements.editDelete) {
        this.elements.editDelete.hide()
    }
    return this
};
Travian.Game.Map.MapMark.Layer.Data.Mark = (function () {
    var a = function (c) {
        c.elements.color.css({backgroundColor: c.parentContainer.colors[c.color]})
    };
    var b = function (c, d) {
        this.classType = "Travian.Game.Map.MapMark.Layer.Data.Mark";
        this.del = function () {
            var e = this;
            if (!this.editable) {
                return this
            }
            Travian.ajax({
                data: {
                    cmd: "mapFlagOrMultiMarkDelete",
                    data: {dataId: this.dataId, owner: this.parentContainer.parentContainer.typeId, type: "mark"}
                }, onSuccess: function (f) {
                    if (f.result) {
                        e.destroy();
                        e.mapContainer.forceUpdateBlocksLayer("imageMark")
                    }
                }
            });
            return this
        };
        this.render = function (e) {
            var f = this;
            Travian.Game.Map.MapMark.Layer.Data.prototype.render.call(this, {
                color: "colorContainer",
                urlLink: "urlLink"
            });
            this.elements.color = this.element.find(".colorContainer");
            this.elements.urlLink = this.element.find(".urlLink");
            if (this.elements.urlLink) {
                this.elements.urlLink.href = Travian.Helpers.substitute(this.urlLink, {markId: this.markId})
            }
            if (this.editable) {
                this.elements.select.on("click", function (g) {
                    f.parentContainer.showDialog({
                        color: f.color, onOpen: function (i, j, h) {
                            j.find(".coord").each(function (k, l) {
                                jQuery(l).hide()
                            });
                            j.find(".textDisplay").show().html(f.text)
                        }, onOkay: function (h, i, j) {
                            f.setColor(h.color)
                        }
                    })
                })
            }
            this.elements.urlLink.on("click", function (g) {
                if (f.elements.urlLink) {
                    window.location.href = f.elements.urlLink.href
                }
            });
            a(this);
            return this
        };
        this.setColor = function (e) {
            var f = this;
            if (!this.editable) {
                return this
            }
            if (typeof e !== "number") {
                return this
            }
            if (e < this.parentContainer.colors.min) {
                e = this.parentContainer.colors.max
            }
            if (e > this.parentContainer.colors.max) {
                e = this.parentContainer.colors.min
            }
            Travian.ajax({
                data: {
                    cmd: "mapMultiMarkUpdate",
                    data: {color: e, dataId: this.dataId, owner: this.parentContainer.parentContainer.typeId}
                }, onSuccess: function (g) {
                    if (g) {
                        f.color = e;
                        a(f);
                        f.mapContainer.forceUpdateBlocksLayer("imageMark")
                    }
                    f.parentContainer.dialogInstance.close();
                    f.parentContainer.dialogInstance = null
                }, onError: function (h, g) {
                    f.parentContainer.dialogInstance.enableForm().toElement().find(".errorMessage").html(g);
                    return false
                }
            });
            return this
        };
        c.color = Number(c.color);
        Travian.Game.Map.MapMark.Layer.Data.call(this, c, d)
    };
    b.prototype = Object.create(Travian.Game.Map.MapMark.Layer.Data.prototype);
    b.constructor = b;
    return b
})();
Travian.Game.Map.MapMark.Layer.Data.Flag = (function () {
    var a = function (c) {
        c.elements.text.html(c.text);
        c.elements.index.html('<img src="' + Travian.Helpers.substitute(c.parentContainer.imgSource, {index: c.index}) + '" alt="" />')
    };
    var b = function (c, d) {
        this.classType = "Travian.Game.Map.MapMark.Layer.Data.Flag";
        this.del = function () {
            var e = this;
            if (!this.editable) {
                return this
            }
            Travian.ajax({
                data: {
                    cmd: "mapFlagOrMultiMarkDelete",
                    data: {dataId: this.dataId, owner: this.parentContainer.parentContainer.typeId, type: "flag"}
                }, onSuccess: function (f) {
                    if (f.result) {
                        e.destroy();
                        e.dataStore.remove(Travian.Game.Map.DataStore.TYPE_SYMBOL, {x: e.x, y: e.y}, e.dataId);
                        e.mapContainer.deleteSymbol({position: {x: e.x, y: e.y}, dataId: e.dataId})
                    }
                }
            });
            return this
        };
        this.render = function (e) {
            var f = this;
            Travian.Game.Map.MapMark.Layer.Data.prototype.render.call(this, {
                index: "indexContainer",
                urlLink: "urlLink"
            });
            this.elements.index = this.element.find(".indexContainer");
            this.elements.urlLink = this.element.find(".urlLink");
            if (this.editable) {
                this.elements.select.on("click", function (g) {
                    f.parentContainer.showDialog({
                        index: f.index, text: f.text, position: {x: f.x, y: f.y}, onOpen: function (i, j, h) {
                            f.dialogInstance = i;
                            j.find("input.inputX").prop("disabled", true);
                            j.find("input.inputY").prop("disabled", true)
                        }, onOkay: function (h, i, j) {
                            f.setIndex(h.index, h.text)
                        }
                    })
                })
            }
            this.elements.urlLink.on("click", function (g) {
                if (f.mapContainer.isEventsEnabled()) {
                    f.mapContainer.moveTo({x: f.x, y: f.y})
                }
            });
            a(this);
            return this
        };
        this.setIndex = function (e, g) {
            var f = this;
            if (!this.editable) {
                return this
            }
            if (typeof e !== "number") {
                return this
            }
            if (e < this.parentContainer.indexes.min) {
                e = this.parentContainer.indexes.max
            }
            if (e > this.parentContainer.indexes.max) {
                e = this.parentContainer.indexes.min
            }
            Travian.ajax({
                data: {
                    cmd: "mapFlagUpdate",
                    data: {index: e, text: g, dataId: this.dataId, owner: this.parentContainer.parentContainer.typeId}
                }, onSuccess: function (h) {
                    if (h) {
                        f.index = e;
                        f.text = g;
                        a(f);
                        var i = f.dataStore.get(Travian.Game.Map.DataStore.TYPE_SYMBOL, {x: f.x, y: f.y}, f.dataId);
                        i.index = f.index;
                        i.text = f.text;
                        f.dataStore.push({
                            type: Travian.Game.Map.DataStore.TYPE_SYMBOL,
                            position: {x: f.x, y: f.y},
                            index: f.dataId,
                            data: i,
                            time: false
                        });
                        f.mapContainer.updateSymbolData({
                            position: {x: f.x, y: f.y},
                            dataId: f.dataId,
                            index: f.index,
                            text: f.text
                        })
                    }
                    f.dialogInstance.close();
                    f.dialogInstance = null
                }, onError: function (i, h) {
                    f.parentContainer.dialogInstance.enableForm().toElement().down(".errorMessage").html(h);
                    return false
                }
            });
            return this
        };
        c.index = Number(c.index);
        Travian.Game.Map.MapMark.Layer.Data.call(this, c, d)
    };
    b.prototype = Object.create(Travian.Game.Map.MapMark.Layer.Data.prototype);
    b.constructor = b;
    return b
})();
Travian.Game.Map.Options = {};
Travian.Game.Map.Options.Symbols = {
    flag: {
        "class": Travian.Game.Map.Layer.Symbol.Flag,
        imgSource: "img/map/flag/flag-{index}/{width}x{height}.png",
        byUser: true,
        zIndex: 10,
        visibleInZoom: {1: true, 2: true, 3: false, 4: false},
        sizes: {
            1: {width: 16, height: 16},
            2: {width: 10, height: 10},
            3: {width: 6, height: 6},
            4: {width: 4, height: 4}
        }
    },
    attack: {
        "class": Travian.Game.Map.Layer.Symbol.Attack,
        imgSource: "img/map/attack/attack-{attackType}/{width}x{height}.gif",
        zIndex: 10,
        visibleInZoom: {1: true, 2: true, 3: false, 4: false},
        sizes: {
            1: {width: 16, height: 16},
            2: {width: 10, height: 10},
            3: {width: 6, height: 6},
            4: {width: 4, height: 4}
        }
    },
    battleGround: {
        "class": Travian.Game.Map.Layer.Symbol.BattleGround,
        imgSource: "img/map/battleground/battleground-{center}-{north}-{east}-{south}-{west}-{width}x{height}.png",
        zIndex: 9,
        visibleInZoom: {1: true, 2: true, 3: false, 4: false},
        sizes: {
            1: {width: 16, height: 16},
            2: {width: 8, height: 8},
            3: {width: 4, height: 4},
            4: {width: 4, height: 4}
        }
    },
    adventure: {
        "class": Travian.Game.Map.Layer.Symbol.Adventure,
        imgSource: "img/map/adventure/difficulty-{difficulty}/{width}x{height}.png",
        zIndex: 10,
        visibleInZoom: {1: true, 2: true, 3: false, 4: false},
        sizes: {
            1: {width: 16, height: 16},
            2: {width: 8, height: 8},
            3: {width: 6, height: 6},
            4: {width: 4, height: 4}
        }
    },
    reinforcement: {
        "class": Travian.Game.Map.Layer.Symbol.Reinforcement,
        imgSource: "img/map/reinforcement/{width}x{height}.gif",
        zIndex: 10,
        visibleInZoom: {1: true, 2: true, 3: false, 4: false},
        sizes: {
            1: {width: 16, height: 16},
            2: {width: 10, height: 10},
            3: {width: 6, height: 6},
            4: {width: 4, height: 4}
        }
    }
};
Travian.Game.Map.Options.Rulers = {
    direction: null,
    imgSource: {x: "img/map/rulers/x-{zoomLevel}.gif", y: "img/map/rulers/y-{zoomLevel}.gif"},
    cls: {x: "ruler x", y: "ruler y"},
    steps: {x: {1: 1, 2: 1, 3: 10, 4: 20}, y: {1: 1, 2: 1, 3: 10, 4: 20}},
    delta: {x: {1: 0, 2: 0, 3: 0, 4: 0}, y: {1: 0, 2: 0, 3: -9, 4: -19}}
};
Travian.Game.Map.Options.MiniMap = {
    container: "#miniMap",
    containerContent: "#minimapContainer",
    showToolTip: true,
    classLines: {x: "lines", y: "lines"},
    tooltipHtml: '<span class="xCoord">({x}</span><span class="pi">|</span><span class="yCoord">{y})</span><span class="clear"></span>'
};
Travian.Game.Map.Options.Toolbar = {
    element: "#toolbar",
    viewFullScreenUrl: "karte.php?fullscreen=1&x={x}&y={y}&zoom={zoom}",
    viewNormalUrl: "karte.php?x={x}&y={y}&zoom={zoom}",
    filterPlayer: {checked: true},
    filterAlliance: {checked: true}
};
Travian.Game.Map.Options.Outline = {element: "#outline"};
Travian.Game.Map.Options.MapMark = Travian.Game.Map.Options.MapMark || {};
Travian.Game.Map.Options.MapMark.Mark = {
    "class": Travian.Game.Map.MapMark.Layer.Mark,
    title: "",
    typeId: "player",
    editable: true,
    expanded: false,
    color: 0,
    colors: {
        0: "#C0C0C0",
        1: "#FF7722",
        2: "#B15BDB",
        3: "#DF4E78",
        4: "#34822F",
        5: "#3F90C5",
        6: "#C2AF09",
        7: "#8B1C1C",
        8: "#575BD2",
        9: "#4FE600",
        min: 0,
        max: 9
    },
    html: '<div class="title">{title} <a href="#" class="add {add}">+</a></div><div class="iconButton {expandButton} small"></div><div class="clear"></div><div class="{expandContainer}"><div class="{data}"></div></div>',
    dialog: {
        title: "",
        textOkay: "okay",
        textCancel: "cancel",
        textX: "X:",
        textY: "Y:",
        elementFocusNew: "coordinateDialogX",
        elementFocusEdit: "coordinateDialogX",
        html: '<div class="mapMarkMark"><div class="color {select}"></div><div class="{coord}"><span>{textX}</span><input id="coordinateDialogX" class="text coordinates x {inputX}" type="text" /><span>{textY}</span><input class="text coordinates y {inputY}" type="text" /></div><div class="{textDisplay}"></div></div>'
    },
    optionsData: {
        urlLink: "spieler.php?uid={markId}",
        html: '<div class="entry flag {entry}"><div class="marker color"><a href="#" class="{select} {color}"></a></div><div class="text"><a href="#" class="{urlLink} {text}"></a></div><div class="iconButton delete small {editDelete} {delete}"></div><div class="clear"></div></div>'
    }
};
Travian.Game.Map.Options.MapMark = Travian.Game.Map.Options.MapMark || {};
Travian.Game.Map.Options.MapMark.Flag = {
    "class": Travian.Game.Map.MapMark.Layer.Flag,
    title: "",
    editable: true,
    expanded: true,
    typeId: "flag",
    index: 1,
    indexes: {min: 1, max: 20},
    imgSource: Travian.Helpers.substitute(Travian.Game.Map.Options.Symbols.flag.imgSource, {
        index: "{index}",
        zoomLevel: 1,
        width: 16,
        height: 16
    }),
    html: '<div class="title">{title} <a href="#" class="add {add}">+</a></div><div class="iconButton {expandButton} small"></div><div class="clear"></div><div class="{expandContainer}"><div class="{data}"></div></div>',
    dialog: {
        title: "",
        textOkay: "okay",
        textCancel: "cancel",
        textX: "X:",
        textY: "Y:",
        elementFocusNew: "coordinateDialogX",
        elementFocusEdit: "coordinateDialogText",
        html: '<div class="mapMarkField"><div class="flag {select}"></div><div class="{coord}"><span>{textX}</span><input id="coordinateDialogX" class="text coordinates x {inputX}" type="text" /><span>{textY}</span><input class="text coordinates y {inputY}" type="text" /></div><div class="{textDisplay}"><input id="coordinateDialogText" class="text {inputText}" type="text" /></div><p class="error errorMessage"></p></div>'
    },
    optionsData: {html: '<div class="entry flag {entry}"><div class="marker index"><a href="#" class="{select} {index}"></a></div><div class="text"><a href="#" class="{urlLink} {text}"></a></div><div class="iconButton delete small {editDelete} {delete}"></div><div class="clear"></div></div>'}
};
Travian.Game.Map.Options.Default = {
    container: "#mapContainer",
    containerViewSize: null,
    tileDisplayInformation: {
        type: "dialog",
        optionsPopup: {url: "position_details.php?x={x}&y={y}", windowOptions: {}},
        optionsDialog: {buttonOk: false, data: {cmd: "viewTileDetails", x: null, y: null}}
    },
    blockOverflow: 1,
    blockSize: {width: 170, height: 150},
    mapInitialPosition: {x: 0, y: 0},
    grid: {1: "/img/map/grid/grid-1.gif", 2: "/img/map/grid/grid-2.gif", 3: "/img/map/grid/grid-3.gif", 4: false},
    speeds: {slow: 5, normal: 20, fast: 40},
    symbolTypes: Travian.Game.Map.Options.Symbols,
    onCreate: function (a) {
    },
    onRender: function (c) {
        Travian.Game.Map.Tips.render(c, c.containerMover);
        c.rulers = new Travian.Game.Map.Rulers(Travian.Game.Map.Options.Rulers, c);
        c.rulers.render();
        c.miniMap = new Travian.Game.Map.MiniMap(Travian.Game.Map.Options.MiniMap, c);
        c.miniMap.render();
        if (c.mapMarks) {
            for (var b in c.mapMarks) {
                if (c.mapMarks.hasOwnProperty(b)) {
                    var a = c.mapMarks[b];
                    if (a.enabled === true) {
                        c.mapMarks[b] = new Travian.Game.Map.MapMark(a, c)
                    } else {
                        delete (c.mapMarks[b])
                    }
                }
            }
        }
        c.outline = new Travian.Game.Map.Outline(Travian.Game.Map.Options.Outline, c);
        c.toolbar = new Travian.Game.Map.Toolbar(Travian.Game.Map.Options.Toolbar, c);
        c.toolbar.render()
    },
    onMove: function (a, b) {
        if (a.rulers) {
            a.rulers.move(b)
        }
        if (a.miniMap) {
            a.miniMap.move()
        }
    },
    onZoom: function (a) {
        if (a.rulers) {
            a.rulers.zoom()
        }
        if (a.miniMap) {
            a.miniMap.zoom()
        }
        if (a.toolbar) {
            a.toolbar.zoom()
        }
    }
};
Travian.Game.Map.Options.Default.contextMenu = {
    targets: "#mapContainer",
    zIndex: 2000,
    menu: "#contextmenu",
    actions: [{
        element: "#contextMenuSendTroops", displayOn: "did", shouldDisplay: function (a) {
            return (typeof a[this.displayOn] !== "undefined")
        }, fn: function (c, b, a) {
            window.location.href = "build.php?gid=16&tt=2&x=" + a.position.x + "&y=" + a.position.y
        }
    }, {
        element: "#contextMenuSendTraders", displayOn: "uid", shouldDisplay: function (a) {
            var c = (typeof a[this.displayOn] !== "undefined");
            var b = (a.title !== "{k.bt}");
            return (c && b)
        }, fn: function (c, b, a) {
            window.location.href = "build.php?gid=17&t=5&x=" + a.position.x + "&y=" + a.position.y
        }
    }, {
        element: "#contextMenuMarkPlayerAlliance", displayOn: "aid", shouldDisplay: function (a) {
            return (typeof a[this.displayOn] !== "undefined")
        }, fn: function (c, b, a) {
            c.parentContainer.mapMarks.player.layers.alliance.showDialog({position: b})
        }
    }, {
        element: "#contextMenuMarkPlayerPlayer", displayOn: "uid", shouldDisplay: function (a) {
            return (typeof a[this.displayOn] !== "undefined")
        }, fn: function (c, b, a) {
            c.parentContainer.mapMarks.player.layers.player.showDialog({position: b})
        }
    }, {
        element: "#contextMenuFlagPlayer", displayOn: true, shouldDisplay: function (a) {
            return true
        }, fn: function (c, b, a) {
            c.parentContainer.mapMarks.player.layers.flag.showDialog({position: b})
        }
    }, {
        element: "#contextMenuMarkAllianceAlliance", displayOn: "aid", shouldDisplay: function (a) {
            return (typeof a[this.displayOn] !== "undefined")
        }, fn: function (c, b, a) {
            c.parentContainer.mapMarks.alliance.layers.alliance.showDialog({position: b})
        }
    }, {
        element: "#contextMenuMarkAlliancePlayer", displayOn: "uid", shouldDisplay: function (a) {
            return (typeof a[this.displayOn] !== "undefined")
        }, fn: function (c, b, a) {
            c.parentContainer.mapMarks.alliance.layers.player.showDialog({position: b})
        }
    }, {
        element: "#contextMenuFlagAlliance", displayOn: true, shouldDisplay: function (a) {
            return true
        }, fn: function (c, b, a) {
            c.parentContainer.mapMarks.alliance.layers.flag.showDialog({position: b})
        }
    }]
};
Travian.Game.Map.Options.Default.transition = {
    onCreate: function (a) {
    },
    onMove: function (a, b) {
    },
    onZoom: function (a) {
    },
    zoomOptions: {level: 1, sizes: [{x: 10, y: 10}, {x: 20, y: 20}, {x: 120, y: 120}]},
    border: Travian.Defaults.Map.Size
};
Travian.Game.Map.Options.Default.layers = [{
    id: "loading",
    styles: {background: "#000000 url(img/loading.gif) center center no-repeat", opacity: 0.5},
    "class": Travian.Game.Map.Layer.Loading,
    zIndex: 20
}, {
    id: "image",
    src: "map_block.php?tx0={x}&ty0={y}&tx1={right}&ty1={top}&w={width}&h={height}&version={version}",
    srcInit: "img/x.gif",
    "class": Travian.Game.Map.Layer.Image,
    zIndex: 1
}, {
    id: "imageMark",
    src: "map_mark.php?tx0={x}&ty0={y}&tx1={right}&ty1={top}&w={width}&h={height}&updates={forcedUpdates}",
    srcInit: "img/x.gif",
    "class": Travian.Game.Map.Layer.ImageMark,
    zIndex: 2
}];
Travian.Game.Map.Options.Default.block = {tooltipHtml: '<span class="xCoord">({x}</span><span class="pi">|</span><span class="yCoord">{y})</span><span class="clear"></span><br />{k.loadingData}'};
Travian.Game.Map.Options.Default.updater = {
    maxRequestCount: 5,
    parameters: {multiple: {cmd: "mapInfo"}, position: {cmd: "mapPositionData"}},
    requestDelayTime: {multiple: 100, position: 300},
    url: "ajax.php",
    elementWorking: "#working",
    positionOptions: {
        areaAroundPosition: {
            1: {left: -5, bottom: -4, right: 5, top: 4},
            2: {left: -10, bottom: -8, right: 10, top: 8},
            3: {left: -25, bottom: -25, right: 25, top: 25},
            4: {left: -25, bottom: -25, right: 25, top: 25}
        }
    }
};
Travian.Game.Map.Options.Default.keyboard = {
    37: "moveLeft",
    65: "moveLeft",
    100: "moveLeft",
    39: "moveRight",
    68: "moveRight",
    102: "moveRight",
    38: "moveUp",
    87: "moveUp",
    104: "moveUp",
    40: "moveDown",
    83: "moveDown",
    98: "moveDown",
    103: "moveLeftUp",
    97: "moveLeftDown",
    105: "moveRightUp",
    99: "moveRightDown",
    speed: {slow: "control", fast: "shift"},
    61: {fn: "zoomIn", periodical: 0},
    107: {fn: "zoomIn", periodical: 0},
    109: {fn: "zoomOut", periodical: 0},
    71: {fn: "toggleGrid", periodical: 0},
    77: {fn: "toggleMiniMap", periodical: 0},
    79: {fn: "toggleOutline", periodical: 0}
};
Travian.Game.Map.Options.Default.dataStore = {
    cachingTimeForType: {
        blocks: 30 * 60 * 1000,
        symbol: 10 * 60 * 1000,
        tile: 10 * 60 * 1000,
        tooltip: 2 * 60 * 1000
    },
    persistentStorage: false,
    useStorageForType: {blocks: false, symbol: false, tile: false, tooltip: true},
    clearStorageForType: {blocks: false, symbol: false, tile: false, tooltip: false}
};
Travian.Game.Map.Options.Default.data = {elements: []};
Travian.Game.Map.Options.Default.mapMarks = {
    player: {
        enabled: true,
        data: [],
        element: "#tabPlayer",
        typeId: "player",
        layers: {
            alliance: Object.assign({}, Travian.Game.Map.Options.MapMark.Mark, {
                typeId: "alliance",
                optionsData: Object.assign({}, Travian.Game.Map.Options.MapMark.Mark.optionsData, {urlLink: "allianz.php?aid={markId}"})
            }),
            player: Object.assign({}, Travian.Game.Map.Options.MapMark.Mark, {typeId: "player"}),
            flag: Object.assign({}, Travian.Game.Map.Options.MapMark.Flag, {indexes: {min: 1, max: 10}})
        }
    },
    alliance: {
        enabled: true,
        data: [],
        element: "#tabAlliance",
        typeId: "alliance",
        layers: {
            alliance: Object.assign({}, Travian.Game.Map.Options.MapMark.Mark, {
                typeId: "alliance",
                optionsData: Object.assign({}, Travian.Game.Map.Options.MapMark.Mark.optionsData, {urlLink: "allianz.php?aid={markId}"})
            }),
            player: Object.assign({}, Travian.Game.Map.Options.MapMark.Mark, {typeId: "player"}),
            flag: Object.assign({}, Travian.Game.Map.Options.MapMark.Flag, {indexes: {min: 11, max: 20}})
        }
    }
};