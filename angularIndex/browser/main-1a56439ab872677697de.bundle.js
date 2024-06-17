webpackJsonp(["main"], {
    "./src/$$_lazy_route_resource lazy recursive": function(e, t) {
        function n(e) {
            return Promise.resolve().then(function() {
                throw new Error("Cannot find module '" + e + "'.")
            })
        }

        n.keys = function() {
            return []
        }, n.resolve = n, e.exports = n, n.id = "./src/$$_lazy_route_resource lazy recursive"
    },
    "./src/JDate/constants.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return a
        });
        var a = {
            MONTH_NAMES: ["فروردین", "اردیبهشت", "خرداد", "تیر", "امرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
            ABBR_DAYS: ["۱ش", "۲ش", "۳ش", "۴ش", "۵ش", "ج", "ش"],
            DAYS_NAMES: ["یکشنبه", "دوشنبه", "سه‌شنبه", "چهارشنبه", "پنج‌شنبه", "جمعه", "شنبه"],
            GREGORIAN_EPOCH: 1721425.5,
            PERSIAN_EPOCH: 1948320.5
        }
    },
    "./src/JDate/converter.ts": function(e, t, n) {
        "use strict";
        var a = n("./src/JDate/constants.ts"),
            r = n("./src/JDate/helper.ts"),
            o = function() {
                function e() {}

                return e.leapGregorian = function(e) {
                    return e % 4 == 0 && !(e % 100 == 0 && e % 400 != 0)
                }, e.gregorianToJulian = function(t, n, r) {
                    var o;
                    return o = n <= 2 ? 0 : e.leapGregorian(t) ? -1 : -2, a.a.GREGORIAN_EPOCH - 1 + 365 * (t - 1) + Math.floor((t - 1) / 4) + -Math.floor((t - 1) / 100) + Math.floor((t - 1) / 400) + Math.floor((367 * n - 362) / 12 + (o + r))
                }, e.julianToGregorian = function(t) {
                    var n = Math.floor(t - .5) + .5,
                        o = n - a.a.GREGORIAN_EPOCH,
                        s = Math.floor(o / 146097),
                        i = Object(r.b)(o, 146097),
                        c = Math.floor(i / 36524),
                        l = Object(r.b)(i, 36524),
                        d = Math.floor(l / 1461),
                        p = Object(r.b)(l, 1461),
                        h = Math.floor(p / 365),
                        u = 400 * s + 100 * c + 4 * d + h;
                    4 !== c && 4 !== h && (u += 1);
                    var v, f = n - e.gregorianToJulian(u, 1, 1);
                    v = n < e.gregorianToJulian(u, 3, 1) ? 0 : e.leapGregorian(u) || 2 ? 1 : 2;
                    var m = Math.floor((12 * (f + v) + 373) / 367);
                    return [u, m, n - e.gregorianToJulian(u, m, 1) + 1]
                }, e.leapPersian = function(e) {
                    return 682 * ((e - (e > 0 ? 474 : 473)) % 2820 + 474 + 38) % 2816 < 682
                }, e.persianToJulian = function(e, t, n) {
                    var o = e - (e >= 0 ? 474 : 473),
                        s = 474 + Object(r.b)(o, 2820);
                    return n + (t <= 7 ? 31 * (t - 1) : 30 * (t - 1) + 6) + Math.floor((682 * s - 110) / 2816) + 365 * (s - 1) + 1029983 * Math.floor(o / 2820) + (a.a.PERSIAN_EPOCH - 1)
                }, e.julianToPersian = function(t) {
                    var n, a = Math.floor(t) + .5,
                        o = a - e.persianToJulian(475, 1, 1),
                        s = Math.floor(o / 1029983),
                        i = Object(r.b)(o, 1029983);
                    if (1029982 === i) n = 2820;
                    else {
                        var c = Math.floor(i / 366),
                            l = Object(r.b)(i, 366);
                        n = Math.floor((2134 * c + 2816 * l + 2815) / 1028522) + c + 1
                    }
                    var d = n + 2820 * s + 474;
                    d <= 0 && (d -= 1);
                    var p = a - e.persianToJulian(d, 1, 1) + 1,
                        h = p <= 186 ? Math.ceil(p / 31) : Math.ceil((p - 6) / 30);
                    return [d, h, a - e.persianToJulian(d, h, 1) + 1]
                }, e.persianToGregorian = function(t, n, a) {
                    var r = e.persianToJulian(t, n, a);
                    return e.julianToGregorian(r)
                }, e.gregorianToPersian = function(t, n, a) {
                    var r = e.gregorianToJulian(t, n, a);
                    return e.julianToPersian(r)
                }, e
            }();
        t.a = o
    },
    "./src/JDate/helper.ts": function(e, t, n) {
        "use strict";

        function a(e) {
            return e && 1 === e.length ? "0" + e : e
        }

        function r(e, t) {
            var n = e.match(/[yY]+/);
            if (!n) return e;
            switch (n[0]) {
                case "YYYY":
                case "YYY":
                    return r(e.replace(n, t.getFullYear()), t);
                case "YY":
                    return r(e.replace(n, String(t.getFullYear()).slice(2)), t);
                default:
                    return e
            }
        }

        function o(e, t) {
            var n = e.match(/[mM]+/);
            if (!n) return e;
            switch (n[0]) {
                case "M":
                    return o(e.replace(n, t.getMonth()), t);
                case "MM":
                    var r = a(t.getMonth().toString());
                    return o(e.replace(n, r), t);
                case "MMM":
                case "MMMM":
                    return o(e.replace(n, i.a.MONTH_NAMES[t.getMonth() - 1]), t);
                default:
                    return e
            }
        }

        function s(e, t) {
            var n = e.match(/[dD]+/);
            if (!n) return e;
            switch (n[0]) {
                case "D":
                    return s(e.replace(n, t.getDate()), t);
                case "DD":
                    var r = a(t.getDate().toString());
                    return s(e.replace(n, r), t);
                case "d":
                case "dd":
                    return s(e.replace(n, i.a.ABBR_DAYS[t.getDay()]), t);
                case "ddd":
                case "dddd":
                    return s(e.replace(n, i.a.DAYS_NAMES[t.getDay()]), t);
                default:
                    return e
            }
        }

        t.b = function(e, t) {
            return e - Math.floor(e / t) * t
        }, t.a = function(e, t) {
            if (t > 12 || t <= 0) {
                var n = Math.floor((t - 1) / 12);
                return [e - n, t - 12 * n]
            }
            return [e, t]
        }, t.e = r, t.d = o, t.c = s;
        var i = n("./src/JDate/constants.ts")
    },
    "./src/JDate/jdate.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return o
        });
        var a = n("./src/JDate/converter.ts"),
            r = n("./src/JDate/helper.ts"),
            o = function() {
                function e(t) {
                    void 0 === t && (t = new Date), this.input = t, Array.isArray(t) ? (this.date = t.map(function(e) {
                        return parseInt(e, 10)
                    }), this._d = this.toGregorian()) : t instanceof Date && (this._d = t, this.date = e.toJalali(this.input))
                }

                return e.toJalali = function(e) {
                    var t = a.a.gregorianToJulian(e.getFullYear(), e.getMonth() + 1, e.getDate());
                    return a.a.julianToPersian(t)
                }, e.to_jalali = function(t) {
                    return e.toJalali(t)
                }, e.toGregorian = function(e, t, n) {
                    var r = a.a.julianToGregorian(a.a.persianToJulian(e, t, n));
                    return new Date(r[0], r[1] - 1, r[2])
                }, e.to_gregorian = function(t, n, a) {
                    return e.toGregorian(t, n, a)
                }, e.isLeapYear = function(e) {
                    return a.a.leapPersian(e)
                }, e.daysInMonth = function(t, n) {
                    var a = t - Math.floor(n / 12),
                        r = n - 12 * Math.floor(n / 12);
                    return r < 0 ? (r += 12, a -= 1) : 0 === r && (r = 12), r < 6 ? 31 : r < 11 ? 30 : e.isLeapYear(a) ? 30 : 29
                }, e.prototype.toGregorian = function() {
                    return e.toGregorian(this.date[0], this.date[1], this.date[2])
                }, e.prototype.getFullYear = function() {
                    return this.date[0]
                }, e.prototype.setFullYear = function(e) {
                    return this.date[0] = parseInt(e, 10), this.input = this.toGregorian(), this
                }, e.prototype.getMonth = function() {
                    return this.date[1]
                }, e.prototype.setMonth = function(e) {
                    var t = Object(r.a)(this.getFullYear(), parseInt(e, 10));
                    return this.date[0] = t[0], this.date[1] = t[1], this.input = this.toGregorian(), this
                }, e.prototype.getDate = function() {
                    return this.date[2]
                }, e.prototype.setDate = function(e) {
                    return this.date[2] = parseInt(e, 10), this.input = this.toGregorian(), this
                }, e.prototype.getDay = function() {
                    return this._d.getDay()
                }, e.prototype.format = function(e) {
                    var t = Object(r.e)(e, this);
                    return t = Object(r.d)(t, this), t = Object(r.c)(t, this)
                }, e
            }()
    },
    "./src/app/_directives/form-validation-error/form-validation-error.component.html": function(e, t) {
        e.exports = '<ng-template [ngIf]="touched">\n  <ng-template [ngIf]="!valid">\n    <speech-bubble\n      [invalid]="errorMessage"\n    ></speech-bubble>\n  </ng-template>\n  <ng-template [ngIf]="valid">\n    <speech-bubble [valid]="true"></speech-bubble>\n  </ng-template>\n</ng-template>\n\n'
    },
    "./src/app/_directives/form-validation-error/form-validation-error.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@ngx-translate/core/@ngx-translate/core.es5.js"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = function() {
                function e(e) {
                    this.translation = e, this.errorMessage = null
                }

                return e.prototype.ngOnInit = function() {}, e.prototype.ngOnChanges = function(e) {
                    this.populateErrorMessage()
                }, e.prototype.populateErrorMessage = function() {
                    if (this.valid) this.errorMessage = null;
                    else {
                        var e = Object.keys(this.errors)[0];
                        "required" === e && (e = "valueRequired"), this.setTranslatedError(e, this.errors[e])
                    }
                }, e.prototype.setTranslatedError = function(e, t) {
                    var n = this;
                    this.translation.get("ERRORS." + e, t).subscribe(function(e) {
                        n.errorMessage = e
                    })
                }, o([Object(a.Input)(), s("design:type", Boolean)], e.prototype, "valid", void 0), o([Object(a.Input)(), s("design:type", Boolean)], e.prototype, "touched", void 0), o([Object(a.Input)(), s("design:type", Object)], e.prototype, "errors", void 0), e = o([Object(a.Component)({
                    selector: "form-validation-error",
                    template: n("./src/app/_directives/form-validation-error/form-validation-error.component.html")
                }), s("design:paramtypes", [r.c])], e)
            }()
    },
    "./src/app/_directives/game-world/game-world.component.html": function(e, t) {
        e.exports = '<div class="world" \n[ngClass]="{\'default\': !server.tournament && !server.fireAndSand, \'fireAndSand\': server.fireAndSand, \'tournament\': server.tournament, \'finished\': server.finished}" role="presentation" \n(click)="clicked();">\n  <span class="title">{{ server.title }}</span>\n  <span class="title speed"> ({{server.speed.toLocaleString()}}&times;)</span>\n  <div *ngIf="showFinishTraining && server.finishTrainingEnabled" class="full-width">\n      <span class="finishTrainingInfo bold" [ngClass]="{\'line-through\': !server.finishTrainingEnabled}">+ {{ "SERVER_START_TIME.INSTANT_FINISH_TRAINING" | translate }}</span>\n  </div>\n  <div class="serverTime" title="\'SERVER_AGE\' | translate">\n    <div *ngIf="!server.finished">\n      <span [innerHTML]="\'clock\' | loadInlineSvg | sanitizeHTML"></span>\n      <span [innerHTML]="serverAgeString"></span>\n    </div>\n    <div *ngIf="server.finished">\n      <span [ngStyle]="{\'font-weight\': \'bold\'}" translate=\'SERVER_START_TIME.GAME_WORLD_FINISHED\'></span>\n    </div>\n  </div>\n</div>'
    },
    "./src/app/_directives/game-world/game-world.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return p
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@ngx-translate/core/@ngx-translate/core.es5.js"),
            o = n("./src/JDate/jdate.ts"),
            s = n("./src/app/_services/locale.service.ts"),
            i = n("./node_modules/@angular/common/esm5/http.js"),
            c = n("./src/environments/environment.ts"),
            l = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            d = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            };
        n("./src/frontend/components/WorldBar/WorldSelection.scss");
        var p = function() {
            function e(e, t, n) {
                this.translation = e, this.localeService = t, this.http = n, this.chosen = new a.EventEmitter, this.serverAgeString = null, this.showFinishTraining = !1, this.showFinishTraining = c.a.showFinishTrainingInfo
            }

            return e.prototype.ngOnInit = function() {
                var e = this;
                this.setServerAge(), this.translation.onTranslationChange.subscribe(function() {
                    return e.setServerAge()
                })
            }, e.prototype.formatDate = function(e) {
                var t = e.getDate(),
                    n = e.getMonth(),
                    a = e.getFullYear();
                return ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"][e.getDay()] + " " + (1 + t) + " " + ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][n] + " " + a
            }, e.prototype.setServerAge = function() {
                var e = this;
                if (!this.server.finished) {
                    var t = "SECONDS";
                    if (this.server.secondsPast > 0) {
                        var n = this.server.secondsPast;
                        return n / 86400 >= 1 ? (t = "DAYS", n = Math.round(n / 86400)) : this.server.secondsPast / 3600 >= 1 ? (t = "HOURS", n = Math.round(n / 3600)) : this.server.secondsPast / 60 >= 1 && (t = "MINUTES", n = Math.round(n / 60)), void this.translation.get("SERVER_START_TIME.UNIT_" + t).subscribe(function(t) {
                            e.translation.get("SERVER_START_TIME.SERVER_WAS_STARTED_X_UNIT_AGO", {
                                value: n,
                                unit: t
                            }).subscribe(function(t) {
                                e.translation.get("SERVER_START_TIME.INSTANT_FINISH_TRAINING", {
                                    date: r,
                                    time: i
                                }).subscribe(function(n) {
                                    e.serverAgeString = t
                                })
                            })
                        })
                    }
                    var a = new Date(1e3 * this.server.start),
                        r = this.localeService.data.dateFormat;
                    if ("ir" === this.localeService.data.hrefLang) {
                        var s = new o.a(new Date(a.getFullYear(), a.getMonth(), a.getDate()));
                        r = s.format("ddd DD MMM YY")
                    } else r = this.formatDate(a);
                    var i = (a.getHours() < 10 ? "0" : "") + a.getHours() + ":" + (a.getMinutes() < 10 ? "0" : "") + a.getMinutes();
                    this.translation.get("SERVER_START_TIME.SERVER_WILL_START_AT", {
                        date: r,
                        time: i
                    }).subscribe(function(t) {
                        e.serverAgeString = t
                    })
                }
            }, e.prototype.clicked = function() {
                this.chosen.emit(null)
            }, l([Object(a.Input)(), d("design:type", Object)], e.prototype, "server", void 0), l([Object(a.Output)(), d("design:type", a.EventEmitter)], e.prototype, "chosen", void 0), e = l([Object(a.Component)({
                selector: "game-world",
                template: n("./src/app/_directives/game-world/game-world.component.html")
            }), d("design:paramtypes", [r.c, s.a, i.a])], e)
        }()
    },
    "./src/app/_directives/speech-buble/speech-bubble.component.html": function(e, t) {
        e.exports = '<ng-template [ngIf]="!valid" [ngIfElse]="validTempalte">\n  <svg class="invalid" viewBox="-1 -1 20 20" *ngIf="showIcon">\n    <path d="M2,18.4c6-12.3,14.4-18,14.4-18"></path>\n    <path d="M0.2,2.2C8.8,7,16.1,16.7,16.1,16.7"></path>\n  </svg>\n  <div class="speechBubble">\n    <svg class="arrow" viewBox="-0.5 0 13 24">\n      <polyline class="arrowBorder" points="12,0 12,2 2,12 12,22 12,24"></polyline>\n      <polyline class="arrowCover" points="13,2 3,12 13,22"></polyline>\n    </svg>\n    <span [innerText]="invalid"></span>\n  </div>\n</ng-template>\n<ng-template #validTempalte>\n  <svg  *ngIf="showIcon" class="valid" viewBox="-1 -1 20 20"><path d="M0.3,8.5c0,0,5,4.4,6.3,8.1c1.9-8.8,7.7-16.3,7.7-16.3"></path></svg>\n</ng-template>\n'
    },
    "./src/app/_directives/speech-buble/speech-bubble.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return s
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            o = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            s = function() {
                function e() {
                    this.valid = !1, this.invalid = null, this.showIcon = !0
                }

                return e.prototype.ngOnInit = function() {}, r([Object(a.Input)(), o("design:type", Object)], e.prototype, "valid", void 0), r([Object(a.Input)(), o("design:type", String)], e.prototype, "invalid", void 0), r([Object(a.Input)(), o("design:type", Object)], e.prototype, "showIcon", void 0), e = r([Object(a.Component)({
                    selector: "speech-bubble",
                    template: n("./src/app/_directives/speech-buble/speech-bubble.component.html")
                }), o("design:paramtypes", [])], e)
            }()
    },
    "./src/app/_pipes/buildSourceSet.pipe.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return o
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            o = function() {
                function e() {}

                return e.prototype.transform = function(e) {
                    var t = "";
                    for (var n in e)
                        if (e.hasOwnProperty(n)) {
                            var a = e[n];
                            "" !== t && (t += ","), t += a + " " + n
                        }
                    return t
                }, e = r([Object(a.Pipe)({ name: "buildSourceSet" })], e)
            }()
    },
    "./src/app/_pipes/loadInlineSvg.pipe.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@angular/platform-browser/esm5/platform-browser.js"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = function() {
                function e(e) {
                    this._sanitizer = e
                }

                return e.prototype.transform = function(e) {
                    return n("./src/frontend/static recursive ^\\.\\/.*\\.svg$")("./" + e + ".svg")
                }, e = o([Object(a.Pipe)({ name: "loadInlineSvg" }), s("design:paramtypes", [r.b])], e)
            }()
    },
    "./src/app/_pipes/sanitizeHTML.pipe.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@angular/platform-browser/esm5/platform-browser.js"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = function() {
                function e(e) {
                    this._sanitizer = e
                }

                return e.prototype.transform = function(e) {
                    return this._sanitizer.bypassSecurityTrustHtml(e)
                }, e = o([Object(a.Pipe)({ name: "sanitizeHTML" }), s("design:paramtypes", [r.b])], e)
            }()
    },
    "./src/app/_services/Cache/Adaptors/CacheAdaptorAbstract.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return a
        });
        var a = function() {
            return function() {}
        }()
    },
    "./src/app/_services/Cache/Adaptors/LocaleStorageCacheAdaptor.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return c
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/util/util.js"),
            o = (n.n(r), n("./src/app/_services/Cache/Adaptors/CacheAdaptorAbstract.ts")),
            s = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            i = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            c = function(e) {
                function t() {
                    return null !== e && e.apply(this, arguments) || this
                }

                return s(t, e), t.prototype.exists = function(e) {
                    return !Object(r.isNullOrUndefined)(this.get(e))
                }, t.prototype.get = function(e) {
                    var t = localStorage.getItem(e);
                    if (void 0 !== t && null !== t) {
                        var n = JSON.parse(t);
                        if (!(n.expires > 0 && n.expires < Date.now())) return n.data;
                        this.removeKey(e)
                    } else this.removeKey(e)
                }, t.prototype.removeKey = function(e) {
                    return localStorage.removeItem(e)
                }, t.prototype.set = function(e, t, n) {
                    var a = { expires: n > 0 ? Date.now() + 1e3 * n : 0, data: t };
                    localStorage.setItem(e, JSON.stringify(a))
                }, t.prototype.removeAll = function() {
                    localStorage.clear()
                }, t = i([Object(a.Injectable)()], t)
            }(o.a)
    },
    "./src/app/_services/Cache/cache.service.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return l
        });
        var a = n("./src/app/_services/Cache/Adaptors/LocaleStorageCacheAdaptor.ts"),
            r = n("./node_modules/@angular/core/esm5/core.js"),
            o = n("./node_modules/@angular/common/esm5/common.js"),
            s = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            i = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            c = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            },
            l = function() {
                function e(e) {
                    this.platformId = e, this.prefix = null, this.adaptor = new a.a
                }

                return e.prototype.setGlobalPrefix = function(e) {
                    this.prefix = e
                }, e.prototype.setAdaptor = function(e) {
                    0 === e && (this.adaptor = new a.a)
                }, e.prototype.exists = function(e) {
                    return !Object(o.isPlatformServer)(this.platformId) && this.adaptor.exists(this.fixKey(e))
                }, e.prototype.get = function(e) {
                    if (!Object(o.isPlatformServer)(this.platformId)) return this.adaptor.get(this.fixKey(e))
                }, e.prototype.set = function(e, t, n) {
                    return !Object(o.isPlatformServer)(this.platformId) && this.adaptor.set(this.fixKey(e), t, n)
                }, e.prototype.removeAll = function() {
                    Object(o.isPlatformServer)(this.platformId) || this.adaptor.removeAll()
                }, e.prototype.fixKey = function(e) {
                    return this.prefix + e
                }, e = s([Object(r.Injectable)(), c(0, Object(r.Inject)(r.PLATFORM_ID)), i("design:paramtypes", [Object])], e)
            }()
    },
    "./src/app/_services/api.service.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return f
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@angular/common/esm5/http.js"),
            o = n("./src/environments/environment.ts"),
            s = (n("./node_modules/rxjs/_esm5/add/operator/map.js"), n("./node_modules/rxjs/_esm5/add/operator/toPromise.js")),
            i = (n.n(s), n("./node_modules/rxjs/_esm5/Observable.js")),
            c = n("./src/app/_services/modal.service.ts"),
            l = n("./src/app/_services/Cache/cache.service.ts"),
            d = n("./node_modules/@angular/common/esm5/common.js"),
            p = n("./src/app/_services/cookie.service.ts"),
            h = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            u = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            v = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            },
            f = function() {
                function e(e, t, n, a, r, s, i, c) {
                    this.http = e, this.cacheService = t, this.cookieService = n, this.modalService = a, this.injector = r, this.platformId = s, this.document = i, this.forwardedHost = c, Object(d.isPlatformServer)(this.platformId) ? void 0 === this.forwardedHost || null == this.forwardedHost || (-1 !== this.forwardedHost.indexOf("citvian.org") ? this.apiUrl = "https://api.citvian.org/v1/" : -1 !== this.forwardedHost.indexOf("turbotra.ir") ? this.apiUrl = "http://api.turbotra.ir/v1/" : -1 !== this.forwardedHost.indexOf("turbotra.com") ? this.apiUrl = "https://api.turbotra.com/v1/" : -1 !== this.forwardedHost.indexOf("kingstorm.net") ? this.apiUrl = "https://api.kingstorm.net/v1/" : -1 !== this.forwardedHost.indexOf("molon-lave.net") ? this.apiUrl = "https://api.molon-lave.net/v1/" : -1 !== this.forwardedHost.indexOf("travian-wars.com") ? this.apiUrl = "https://api.travian-wars.com/v1/" : -1 !== this.forwardedHost.indexOf("example.com") ? this.apiUrl = "https://api.example.com/v1/" : -1 !== this.forwardedHost.indexOf("tstravian.ir") ? this.apiUrl = "http://api.tstravian.ir/v1/" : -1 !== this.forwardedHost.indexOf("speedtra.com") ? this.apiUrl = "https://api.speedtra.com/v1/" : -1 !== this.forwardedHost.indexOf("travian.live") ? this.apiUrl = "https://api.travian.live/v1/" : console.log("Could not detect api url")) : this.apiUrl = this.document.location.protocol + "//api." + this.document.location.hostname.replace("www.", "") + "/v1/", (null === this.apiUrl || void 0 === this.apiUrl || this.apiUrl.length <= 0 || -1 !== this.apiUrl.indexOf("localhost") || -1 !== this.apiUrl.indexOf("127.0.0.1")) && (this.apiUrl = "https://api.example.com/v1/"), o.a.production || this.cacheService.removeAll()
                }

                return e.prototype.getEndPoint = function(e, t) {
                    return null == t ? this.apiUrl + e : this.apiUrl + t + "/" + e
                }, e.prototype.request = function(e, t, n, a) {
                    var s = this,
                        c = new r.c({ "Content-Type": "application/json" });
                    return c.append("Accept", "application/json"), t = Object.assign(t, { lang: o.a.translations[o.a.selectedLang].language }), new i.a(function(r) {
                        console.log(s.getEndPoint(n, a));
                        s.http.request(e, s.getEndPoint(n, a), { body: t, headers: c }).subscribe(function(e) {
                            r.next(e.data), r.complete()
                        }, function(e) {
                            Object(d.isPlatformBrowser)(s.platformId) ? alert("failed to communicate with the api service.") : console.log(e)
                        })
                    })
                }, e.prototype.requestWithCache = function(e, t, n) {
                    var a = this;
                    return new i.a(function(r) {
                        a.cacheService.exists(e) ? (r.next(a.cacheService.get(e)), r.complete()) : n.subscribe(function(n) {
                            a.cacheService.set(e, n, t), r.next(n), r.complete()
                        }, function(e) {
                            return r.error(e)
                        })
                    })
                }, e.prototype.activate = function(e, t, n, a) {
                    return this.request("POST", {
                        gameWorld: e,
                        activationCode: t,
                        password: n,
                        captcha: a
                    }, "activate", "register")
                }, e.prototype.resendActivationMail = function(e, t, n) {
                    return this.request("POST", { gameWorld: e, email: t, captcha: n }, "resendActivationMail", "register")
                }, e.prototype.validateActivationCode = function(e, t) {
                    return this.request("POST", { gameWorld: e, activationCode: t }, "validateActivationCode", "servers")
                }, e.prototype.loadServerByID = function(e) {
                    return this.request("POST", { gameWorld: e }, "loadServerByID", "servers")
                }, e.prototype.loadServerByWID = function(e) {
                    return this.request("POST", { worldId: e }, "loadServerByWID", "servers")
                }, e.prototype.getUsernameById = function(e, t) {
                    return this.request("POST", { worldId: e, uid: t }, "usernameById", "servers")
                }, e.prototype.register = function(e, t, n, a, r, o, s, i, c) {
                    return this.request("POST", {
                        gameWorld: e,
                        username: t,
                        email: n,
                        password: r,
                        termsAndConditions: o,
                        subscribeNewsletter: s,
                        registrationKey: a,
                        inviter: i,
                        captcha: c
                    }, "register", "register")
                }, e.prototype.forgotPassword = function(e, t, n) {
                    return this.request("POST", { gameWorldId: e, email: t, captcha: n }, "forgotPassword", "auth")
                }, e.prototype.forgotGameWorld = function(e, t, n) {
                    return this.request("POST", { email: t, captcha: n }, "forgotGameWorld", "auth")
                }, e.prototype.updatePassword = function(e, t, n, a) {
                    return this.request("POST", {
                        worldId: e,
                        uid: t,
                        recoveryCode: n,
                        password: a
                    }, "updatePassword", "auth")
                }, e.prototype.login = function(e, t, n, a, r) {
                    return this.request("POST", {
                        gameWorldId: e,
                        usernameOrEmail: t,
                        password: n,
                        lowResMode: a,
                        captcha: r
                    }, "login", "auth")
                }, e.prototype.getServers = function() {
                    var e = this.request("POST", {}, "loadServers", "servers");
                    return this.requestWithCache("gameWorlds", 60, e)
                }, e.prototype.getNews = function() {
                    var e = this.request("POST", {}, "loadNews", "news");
                    return this.requestWithCache("news", 3600, e)
                }, e.prototype.getConfig = function() {
                    var e = this.request("GET", {}, "loadConfig");
                    return this.requestWithCache("configuration", 3600, e)
                }, e = h([Object(a.Injectable)(), v(5, Object(a.Inject)(a.PLATFORM_ID)), v(6, Object(a.Inject)(d.DOCUMENT)), v(7, Object(a.Optional)()), v(7, Object(a.Inject)("forwardedHost")), u("design:paramtypes", [r.a, l.a, p.a, c.a, a.Injector, Object, Object, String])], e)
            }()
    },
    "./src/app/_services/config.service.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return d
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/api.service.ts"),
            o = (n("./node_modules/rxjs/_esm5/add/operator/map.js"), n("./node_modules/rxjs/_esm5/add/operator/toPromise.js")),
            s = (n.n(o), n("./node_modules/@angular/common/esm5/common.js")),
            i = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            c = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            l = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            },
            d = function() {
                function e(e, t) {
                    this.api = e, this.platformId = t
                }

                return e.prototype.getProperty = function(e, t) {
                    return this.config.hasOwnProperty(e) ? this.config[e] : t
                }, e.prototype.load = function() {
                    var e = this;
                    return this.api.getConfig().toPromise().then(function(t) {
                        e.config = t
                    }).catch(function() {
                        Object(s.isPlatformBrowser)(e.platformId) ? alert("Failed to load the app configuration.") : console.log("Failed to load the app configuration.")
                    })
                }, e = i([Object(a.Injectable)(), l(1, Object(a.Inject)(a.PLATFORM_ID)), c("design:paramtypes", [r.a, Object])], e)
            }()
    },
    "./src/app/_services/cookie.service.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return c
        });
        var a = n("./node_modules/@angular/common/esm5/common.js"),
            r = n("./node_modules/@angular/core/esm5/core.js"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            },
            c = function() {
                function e(e, t) {
                    this.platformId = e, this.document = t, this.documentIsAccessible = Object(a.isPlatformBrowser)(this.platformId)
                }

                return e.prototype.check = function(e) {
                    if (!this.documentIsAccessible) return !1;
                    e = encodeURIComponent(e);
                    return this.getCookieRegExp(e).test(this.document.cookie)
                }, e.prototype.get = function(e) {
                    if (this.documentIsAccessible && this.check(e)) {
                        e = encodeURIComponent(e);
                        var t = this.getCookieRegExp(e).exec(this.document.cookie);
                        return decodeURIComponent(t[1])
                    }
                    return ""
                }, e.prototype.getAll = function() {
                    if (!this.documentIsAccessible) return {};
                    var e = {},
                        t = this.document;
                    if (t.cookie && "" !== t.cookie)
                        for (var n = t.cookie.split(";"), a = 0; a < n.length; a += 1) {
                            var r = n[a].split("=");
                            r[0] = r[0].replace(/^ /, ""), e[decodeURIComponent(r[0])] = decodeURIComponent(r[1])
                        }
                    return e
                }, e.prototype.set = function(e, t, n, a, r, o) {
                    if (this.documentIsAccessible) {
                        var s = encodeURIComponent(e) + "=" + encodeURIComponent(t) + ";";
                        if (n)
                            if ("number" == typeof n) {
                                s += "expires=" + new Date((new Date).getTime() + 1e3 * n * 60 * 60 * 24).toUTCString() + ";"
                            } else s += "expires=" + n.toUTCString() + ";";
                        a && (s += "path=" + a + ";"), r && (s += "domain=" + r + ";"), o && (s += "secure;"), this.document.cookie = s
                    }
                }, e.prototype.delete = function(e, t, n) {
                    this.documentIsAccessible && this.set(e, "", -1, t, n)
                }, e.prototype.deleteAll = function(e, t) {
                    if (this.documentIsAccessible) {
                        var n = this.getAll();
                        for (var a in n) n.hasOwnProperty(a) && this.delete(a, e, t)
                    }
                }, e.prototype.getCookieRegExp = function(e) {
                    var t = e.replace(/([\[\]{}()|=;+?,.*^$])/gi, "\\$1");
                    return new RegExp("(?:^" + t + "|;\\s*" + t + ")=(.*?)(?:;|$)", "g")
                }, e = o([Object(r.Injectable)(), i(0, Object(r.Inject)(r.PLATFORM_ID)), i(1, Object(r.Inject)(a.DOCUMENT)), s("design:paramtypes", [Object, Object])], e)
            }()
    },
    "./src/app/_services/locale.service.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return v
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@ngx-translate/core/@ngx-translate/core.es5.js"),
            o = n("./node_modules/@angular/router/esm5/router.js"),
            s = n("./src/environments/environment.ts"),
            i = n("./src/app/_services/config.service.ts"),
            c = n("./node_modules/@angular/common/esm5/common.js"),
            l = n("./src/app/_services/cookie.service.ts"),
            d = n("./node_modules/@angular/platform-browser/esm5/platform-browser.js"),
            p = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            h = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            u = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            },
            v = function() {
                function e(e, t, n, r, o, s, i) {
                    this.router = e, this.translate = t, this.cookieService = n, this.title = r, this.meta = o, this.config = s, this.document = i, this.data = {}, this.dataChanged = new a.EventEmitter
                }

                return e.prototype.setTranslation = function(e) {
                    var t = this;
                    this.data = s.a.translations[e], this.dataChanged.emit(this.data), this.translate.use(this.data.language), this.cookieService.set("language", e, 31536e6), s.a.selectedLang = e, "ir" === e ? this.document.body.classList.add("farsi") : this.document.body.classList.remove("farsi"), "ltr" === this.data.direction ? (this.document.body.classList.remove("rtl"), this.document.body.classList.add("ltr")) : (this.document.body.classList.remove("ltr"), this.document.body.classList.add("rtl")), this.translate.get("TITLE").subscribe(function(e) {
                        t.title.setTitle(e), t.meta.removeTag('name="og:title"'), t.meta.addTag({
                            name: "og:title",
                            content: e
                        })
                    }), this.translate.get("KEYWORDS").subscribe(function(e) {
                        t.meta.removeTag('name="keywords"'), t.meta.addTag({ name: "keywords", content: e })
                    }), this.translate.get("DESCRIPTION").subscribe(function(e) {
                        t.meta.removeTag("description"), t.meta.removeTag('name="og:description"'), t.meta.addTags([{
                            name: "description",
                            content: e
                        }, { name: "og:description", content: e }])
                    })
                }, e.prototype.redirectToDefaultLang = function(e, t) {
                    this.router.navigate(["/" + this.data.hrefLang], { queryParams: e, fragment: t })
                }, e.prototype.init = function() {
                    var e = this,
                        t = this.cookieService.get("language"),
                        n = this.config.getProperty("defaultLang");
                    s.a.translations.hasOwnProperty(t) && (n = t), s.a.translations.hasOwnProperty(n) || (n = s.a.selectedLang), this.setTranslation(n), this.router.events.subscribe(function(t) {
                        if (t instanceof o.d) {
                            if (null === t.state.root.firstChild || null === t.state.root.firstChild.params || void 0 === t.state.root.firstChild.params.locale) {
                                var n = {},
                                    a = null;
                                return t.state.root.queryParams && (n = t.state.root.queryParams), t.state.root.fragment && (a = t.state.root.fragment), void e.redirectToDefaultLang(n, a)
                            }
                            var r = t.state.root.firstChild.params.locale;
                            s.a.translations.hasOwnProperty(r) ? e.setTranslation(r) : e.redirectToDefaultLang(t.state.root.queryParams, t.state.root.fragment)
                        }
                    })
                }, e = p([Object(a.Injectable)(), u(6, Object(a.Inject)(c.DOCUMENT)), h("design:paramtypes", [o.b, r.c, l.a, d.d, d.c, i.a, Object])], e)
            }()
    },
    "./src/app/_services/login.service.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return c
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/api.service.ts"),
            o = n("./src/app/_services/Cache/cache.service.ts"),
            s = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            i = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            c = function() {
                function e(e, t) {
                    this.apiService = e, this.cacheService = t
                }

                return e.prototype.login = function(e, t, n, a, r) {
                    return this.apiService.login(e, t, n, a, r)
                }, e.prototype.getGameWorlds = function() {
                    return this.apiService.getServers()
                }, e.prototype.getLastGameWorldId = function() {
                    return this.cacheService.exists("lastLoginGameWorld") ? this.cacheService.get("lastLoginGameWorld") : null
                }, e.prototype.setLastGameWorld = function(e) {
                    this.cacheService.set("lastLoginGameWorld", e, { maxAge: 31536e3 })
                }, e = s([Object(a.Injectable)(), i("design:paramtypes", [r.a, o.a])], e)
            }()
    },
    "./src/app/_services/modal.service.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return c
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@angular/common/esm5/common.js"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            },
            c = function() {
                function e(e) {
                    this.document = e, this.modals = [], this.zIndex = 999, this.activeInstances = 0
                }

                return e.prototype.registerViewContainerRef = function(e) {
                    this.viewContainer = e
                }, e.prototype.registerFactoryResolver = function(e) {
                    this.factoryResolver = e
                }, e.prototype.setRouter = function(e) {
                    this.router = e
                }, e.prototype.open = function(e, t) {
                    var n = this;
                    if (!this.activeInstances) {
                        var a = this.factoryResolver.resolveComponentFactory(e),
                            r = this.zIndex,
                            o = this.viewContainer.createComponent(a, 0, this.viewContainer.injector);
                        return Object.assign(o.instance, Object.assign({ zIndex: r }, t)), this.modals[r] = o, this.document.body.classList.add("noOverflow"), this.activeInstances++, o.instance.destroy = function() {
                            delete n.modals[r], n.activeInstances--, 0 === n.activeInstances && n.document.body.classList.remove("noOverflow"), /([^#?]+)[?#]?/i.test(n.router.url) && n.router.navigate([n.router.url.match(/([^#?]+)[?#]?/i)[1]], { queryParams: {} }), o.destroy()
                        }, this.zIndex++, o
                    }
                }, e.prototype.closeAll = function() {
                    this.zIndex = 0, this.modals.forEach(function(e) {
                        e.destroy()
                    })
                }, e = o([Object(a.Injectable)(), i(0, Object(a.Inject)(r.DOCUMENT)), s("design:paramtypes", [Object])], e)
            }()
    },
    "./src/app/_services/translationLoader.service.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return r
        });
        var a = n("./node_modules/rxjs/_esm5/Observable.js"),
            r = (n("./node_modules/rxjs/_esm5/add/observable/of.js"), function() {
                function e() {}

                return e.prototype.getTranslation = function(e) {
                    return a.a.of(n("./src/frontend/locale recursive ^\\.\\/.*\\.json$")("./" + e + ".json"))
                }, e
            }())
    },
    "./src/app/app.component.html": function(e, t) {
        e.exports = '<div class="content">\r\n  <div class="appContainer">\r\n    <router-outlet></router-outlet>\r\n  </div>\r\n</div>\r\n'
    },
    "./src/app/app.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return p
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/locale.service.ts"),
            o = n("./src/environments/environment.ts"),
            s = n("./src/app/_services/Cache/cache.service.ts"),
            i = n("./node_modules/@angular/platform-browser/esm5/platform-browser.js"),
            c = n("./src/app/_services/config.service.ts"),
            l = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            d = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            };
        n("./src/frontend/scss/base/base.scss"), n("./src/frontend/scss/base/typography.scss"), n("./src/frontend/components/AjaxLoader/ButtonAjaxLoader.scss"), n("./src/frontend/components/Box/Box.scss"), n("./src/frontend/components/BoxGrid/BoxGrid.scss"), n("./src/frontend/components/Breadcrumb/Breadcrumb.scss"), n("./src/frontend/components/Button/Button.scss"), n("./src/frontend/components/CookieInfo/CookieInfo.scss"), n("./src/frontend/components/Error/DeprecatedBrowser/DeprecatedBrowser.scss"), n("./src/frontend/components/Flag/Flag.scss"), n("./src/frontend/components/Form/Form.scss"), n("./src/frontend/components/WorldBar/WorldSelection.scss");
        var p = function() {
            function e(e, t, a, r) {
                this.cacheService = e, this.localeService = t, this.config = a, this.meta = r, this.cacheService.setGlobalPrefix(o.a.BUILD_VERSION), t.init();
                var s = n("./src/frontend/static/Travian-Amulett.jpg");
                this.meta.addTag({ name: "og:image", content: s })
            }

            return e.prototype.ngOnInit = function() {}, e = l([Object(a.Component)({
                selector: "app-root",
                template: n("./src/app/app.component.html")
            }), d("design:paramtypes", [s.a, r.a, c.a, i.c])], e)
        }()
    },
    "./src/app/app.module.ts": function(e, t, n) {
        "use strict";

        function a() {
            return new w.a
        }

        function r(e) {
            return function() {
                return e.load()
            }
        }

        n.d(t, "a", function() {
            return de
        });
        var o = n("./src/app/app.component.ts"),
            s = n("./node_modules/@angular/platform-browser/esm5/platform-browser.js"),
            i = n("./node_modules/@angular/core/esm5/core.js"),
            c = n("./src/app/journey/partial/player/playstyle/playstyle.component.ts"),
            l = n("./src/app/journey/partial/news/news.component.ts"),
            d = n("./src/app/journey/partial/player/interaction/interaction.component.ts"),
            p = n("./src/app/journey/partial/player/player.component.ts"),
            h = n("./src/app/journey/partial/build-empire/build-empire.component.ts"),
            u = n("./src/app/journey/partial/battle/battle.component.ts"),
            v = n("./src/app/journey/partial/late-game/late-game.component.ts"),
            f = n("./src/app/journey/partial/play-now/play-now.component.ts"),
            m = n("./src/app/main-navigation/main-navigation.component.ts"),
            g = n("./src/app/footer/footer.component.ts"),
            E = n("./src/app/journey/journey.component.ts"),
            y = n("./node_modules/@angular/router/esm5/router.js"),
            _ = n("./src/app/modal/modal.component.ts"),
            b = n("./src/app/_services/modal.service.ts"),
            M = n("./node_modules/ng-click-outside/lib/index.js"),
            O = (n.n(M), n("./src/app/modal/modal-container/modal-container.component.ts")),
            A = n("./node_modules/@angular/common/esm5/http.js"),
            R = n("./src/app/_pipes/sanitizeHTML.pipe.ts"),
            T = n("./src/app/_services/locale.service.ts"),
            S = n("./src/app/_pipes/buildSourceSet.pipe.ts"),
            I = n("./src/app/journey/partial/fixed-backgrounds/fixed-backgrounds.ts"),
            N = n("./node_modules/@ngx-translate/core/@ngx-translate/core.es5.js"),
            w = n("./src/app/_services/translationLoader.service.ts"),
            C = n("./src/app/_services/config.service.ts"),
            z = n("./src/app/_services/api.service.ts"),
            L = n("./src/app/app.routes.ts"),
            x = n("./src/app/game/playstyle/playstyle.component.ts"),
            G = n("./src/app/game/interaction/interaction.component.ts"),
            D = n("./src/app/game/build-empire/build-empire.component.ts"),
            j = n("./src/app/game/late-game/late-game.component.ts"),
            P = n("./src/app/game/battle/battle.component.ts"),
            F = n("./src/app/sub-page/sub-page.component.ts"),
            W = n("./src/app/breadcrumb/breadcrumb.component.ts"),
            H = n("./src/app/modal/login/login.component.ts"),
            Y = n("./src/app/modal/register/register.component.ts"),
            k = n("./src/app/modal/forgot-password/forgot-password.ts"),
            U = n("./src/app/modal/forgot-game-world/forgot-game-world.ts"),
            B = n("./src/app/modal/activation/activation.component.ts"),
            V = n("./src/app/modal/set-language/set-language.component.ts"),
            J = n("./src/app/modal/recovery/recovery.component.ts"),
            K = n("./src/app/_pipes/loadInlineSvg.pipe.ts"),
            q = n("./node_modules/@angular/forms/esm5/forms.js"),
            Q = n("./src/app/modal/set-language/set-language-lang/set-language-lang.component.ts"),
            X = n("./src/app/_directives/game-world/game-world.component.ts"),
            Z = n("./src/app/_services/login.service.ts"),
            $ = n("./src/app/_directives/speech-buble/speech-bubble.component.ts"),
            ee = n("./src/app/_directives/form-validation-error/form-validation-error.component.ts"),
            te = n("./src/environments/environment.ts"),
            ne = n("./src/app/_services/Cache/cache.service.ts"),
            ae = n("./src/recaptcha/recaptcha-forms.module.ts"),
            re = n("./src/recaptcha/recaptcha-settings.ts"),
            oe = n("./src/recaptcha/recaptcha-loader.service.ts"),
            se = n("./src/recaptcha/recaptcha.module.ts"),
            ie = n("./src/app/_services/cookie.service.ts"),
            ce = n("./src/app/modal/noMail/noMail.component.ts"),
            le = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            de = function() {
                function e() {}

                return e = le([Object(i.NgModule)({
                    declarations: [G.a, x.a, D.a, P.a, j.a, I.a, X.a, $.a, ee.a, ce.a, o.a, _.a, c.a, l.a, d.a, p.a, h.a, u.a, v.a, f.a, m.a, g.a, E.a, O.a, F.a, W.a, Q.a, S.a, K.a, R.a, H.a, B.a, Y.a, k.a, U.a, V.a, J.a],
                    entryComponents: [H.a, B.a, Y.a, k.a, U.a, V.a, J.a, ce.a],
                    imports: [N.b.forRoot({
                        loader: {
                            provide: N.a,
                            useFactory: a
                        }
                    }), se.a, y.c.forRoot(L.a, { enableTracing: !1 }), s.a.withServerTransition({ appId: "travian-index" }), M.ClickOutsideModule, A.b, q.c, q.e, ae.a],
                    providers: [{
                        provide: re.a,
                        useValue: { siteKey: te.a.reCaptchaSiteKey }
                    }, b.a, T.a, w.a, C.a, ie.a, z.a, Z.a, ne.a, oe.a, {
                        provide: i.APP_INITIALIZER,
                        useFactory: r,
                        deps: [C.a],
                        multi: !0
                    }],
                    bootstrap: [_.a, o.a]
                })], e)
            }()
    },
    "./src/app/app.routes.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return l
        });
        var a = n("./src/app/game/playstyle/playstyle.component.ts"),
            r = n("./src/app/game/interaction/interaction.component.ts"),
            o = n("./src/app/game/battle/battle.component.ts"),
            s = n("./src/app/game/late-game/late-game.component.ts"),
            i = n("./src/app/game/build-empire/build-empire.component.ts"),
            c = n("./src/app/journey/journey.component.ts"),
            l = [{ path: ":locale", component: c.a, pathMatch: "full" }, {
                path: ":locale/game",
                children: [{ path: "playstyle", component: a.a }, {
                    path: "playerinteraction",
                    component: r.a
                }, { path: "buildempire", component: i.a }, { path: "battle", component: o.a }, {
                    path: "lategame",
                    component: s.a
                }]
            }, { path: "**", component: c.a }]
    },
    "./src/app/breadcrumb/breadcrumb.component.html": function(e, t) {
        e.exports = '<div class="breadcrumb">\n  <svg viewBox="0 0 25 25" class="filter">\n    <filter class="filter" id="dropShadowBreadCrumbs" width="150%" height="150%">\n      <feGaussianBlur in="SourceAlpha" result="shadow" stdDeviation="1"></feGaussianBlur>\n      <feColorMatrix in="shadow" result="dark" type="matrix"\n                     values="0 0 0 0 0  0 0 0 0 0  0 0 0 0 0  0 0 0 .4 0"></feColorMatrix>\n      <feOffset dx="-2" dy="2" result="offsetblur"></feOffset>\n      <feBlend in="SourceGraphic" in2="offsetblur" mode="normal"></feBlend>\n    </filter>\n  </svg>\n  <div class="crumb">\n    <a [routerLink]="[\'/\', hrefLang]" title="{{ \'BREADCRUMB.Home\' | translate }}" [translate]="\'BREADCRUMB.Home\'"></a>\n    <svg viewBox="0 0 20 20">\n      <path d="M0,0 L20,0 L10,10z" filter="url(#dropShadowBreadCrumbs)"></path>\n    </svg>\n  </div>\n  <div *ngFor="let part of parts" class="crumb">\n    <span *ngIf="part.url == undefined">{{ part.name | translate }}</span>\n    <span *ngIf="part.url !== undefined">\n          <a [routerLink]="part.url" title="{{ part.name | translate }}" [translate]="part.name"></a>\n    </span>\n    <svg viewBox="0 0 20 20">\n      <path d="M0,0 L20,0 L10,10z" filter="url(#dropShadowBreadCrumbs)"></path>\n    </svg>\n  </div>\n</div>\n'
    },
    "./src/app/breadcrumb/breadcrumb.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/locale.service.ts"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = function() {
                function e(e) {
                    var t = this;
                    this.localeService = e, this.parts = [], this.hrefLang = this.localeService.data.hrefLang, this.localeService.dataChanged.subscribe(function(e) {
                        t.hrefLang = e.hrefLang
                    })
                }

                return e.prototype.ngOnInit = function() {}, o([Object(a.Input)(), s("design:type", Object)], e.prototype, "parts", void 0), e = o([Object(a.Component)({
                    selector: "app-breadcrumb",
                    template: n("./src/app/breadcrumb/breadcrumb.component.html")
                }), s("design:paramtypes", [r.a])], e)
            }()
    },
    "./src/app/footer/footer.component.html": function(e, t) {
        e.exports = '<footer class="footer">\n  <div class="footerInnerWrapper">\n    <div class="join"><span [translate]="\'FOOTER.JOIN\'"></span></div>\n    <a [routerLink]="[\'./\']" fragment="register" class="button default">\n      <span [translate]="\'FOOTER.PLAY_NOW\'"></span>\n    </a>\n  </div>\n  <div class="footerInnerWrapper">\n    <div class="legal">\n      <div class="travianGamesLogo"></div>\n      <div class="rightOfLogo">\n        <nav>\n          <div class="footerLinks">\n          </div>\n        </nav>\n        <div class="copyright">\n          <span>\n            © 2004 - 2017 {{ \'FOOTER.COPY_RIGHT\' | translate }}\n          </span>\n        </div>\n      </div>\n    </div>\n  </div>\n</footer>\n'
    },
    "./src/app/footer/footer.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return s
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            o = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            };
        n("./src/frontend/containers/Footer/Footer.scss");
        var s = function() {
            function e() {}

            return e.prototype.ngOnInit = function() {}, e = r([Object(a.Component)({
                selector: "app-footer",
                template: n("./src/app/footer/footer.component.html")
            }), o("design:paramtypes", [])], e)
        }()
    },
    "./src/app/formValidators/activationCodeValidator.ts": function(e, t, n) {
        "use strict";
        t.a = function(e) {
            if (null !== e.value) return e.value.length < 10 ? { activationCodeTooShort: { min: 10 } } : null
        }
    },
    "./src/app/formValidators/emailValidator.ts": function(e, t, n) {
        "use strict";
        t.a = function(e) {
            if (null != e.value) return e.value.length < 5 ? { emailTooShort: { min: 5 } } : a.f.email(e) ? { emailInvalid: !0 } : null
        };
        var a = n("./node_modules/@angular/forms/esm5/forms.js")
    },
    "./src/app/formValidators/functions.ts": function(e, t, n) {
        "use strict";

        function a(e) {
            Object.keys(e.controls).forEach(function(t) {
                var n = e.get(t);
                n instanceof r.a ? n.markAsTouched({ onlySelf: !0 }) : n instanceof r.b && a(n)
            })
        }

        t.a = a;
        var r = n("./node_modules/@angular/forms/esm5/forms.js")
    },
    "./src/app/formValidators/passwordValidator.ts": function(e, t, n) {
        "use strict";
        t.a = function(e) {
            if (null != e.value) return e.value.length < 4 ? { passwordTooShort: { min: 4 } } : null
        }
    },
    "./src/app/formValidators/recaptchaValidator.ts": function(e, t, n) {
        "use strict";
        t.a = function(e) {
            return a.f.required(e) ? { reCaptchaRequired: !0 } : null
        };
        var a = n("./node_modules/@angular/forms/esm5/forms.js")
    },
    "./src/app/formValidators/usernameValidator.ts": function(e, t, n) {
        "use strict";
        t.a = function(e) {
            if (null !== e.value) return e.value.length < 3 ? { usernameTooShort: { min: 3 } } : e.value.length > 15 ? { usernameTooLong: { max: 15 } } : null
        }
    },
    "./src/app/game/GameSectionBaseComponent.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return a
        }), n("./src/frontend/containers/Game/Battle/Battle.scss"), n("./src/frontend/containers/Game/LateGame/LateGame.scss"), n("./src/frontend/containers/Game/Game.scss"), n("./src/frontend/containers/Game/LiveStatisticsComingSoon.scss");
        var a = function() {
            function e() {}

            return e.prototype.ngOnInit = function() {}, e
        }()
    },
    "./src/app/game/battle/battle.component.html": function(e, t) {
        e.exports = '<app-sub-page [contentId]="\'game\'" [breadcrumb]="breadcrumb" [sectionId]="\'battlePage\'">\n  <h1 [translate]="\'GAME.BATTLE.EPIC_WARFARE\'"></h1>\n  <div class="intro"><h2 [translate]="\'GAME.BATTLE.JOURNEY_OF_A_LEGEND\'"></h2>\n    <div><p><span lang="EN-US"><span><span [translate]="\'GAME.BATTLE.JOURNEY_OF_A_LEGEND_DESC\'"></span></span></span>\n    </p>\n    </div>\n  </div>\n  <div class="timeline">\n    <div class="event">\n      <img [src]="images.framedIllu_cart.src" alt="type" [srcset]="images.framedIllu_cart.srcset | buildSourceSet">\n      <div><h3 [translate]="\'GAME.BATTLE.BOLD_BEGINNINGS\'"></h3>\n        <div><p><span lang="EN-US"><span><span [translate]="\'GAME.BATTLE.BOLD_BEGINNINGS_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="event">\n      <img [src]="images.framedIllu_cart.src" alt="type" [srcset]="images.framedIllu_cart.srcset | buildSourceSet">\n      <div><h3 [translate]="\'GAME.BATTLE.STAY_IN_CONTROL\'"></h3>\n        <div><p><span lang="EN-US"><span><span [translate]="\'GAME.BATTLE.STAY_IN_CONTROL_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="event">\n      <img [src]="images.framedIllu_cart.src" alt="type" [srcset]="images.framedIllu_cart.srcset | buildSourceSet">\n      <div><h3 [translate]="\'GAME.BATTLE.GROW_YOUR_BICEPS\'"></h3>\n        <div><p><span lang="EN-US"><span><span [translate]="\'GAME.BATTLE.GROW_YOUR_BICEPS_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n  </div>\n</app-sub-page>\n'
    },
    "./src/app/game/battle/battle.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/game/GameSectionBaseComponent.ts"),
            o = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            s = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            };
        n("./src/frontend/containers/Game/Game.scss");
        var i = function(e) {
            function t() {
                var t = null !== e && e.apply(this, arguments) || this;
                return t.images = {
                    framedIllu_cart: {
                        src: n("./src/frontend/static/framedIllu_cart_1x.png"),
                        srcset: {
                            "1x": n("./src/frontend/static/framedIllu_cart_1x.png"),
                            "2x": n("./src/frontend/static/framedIllu_cart_2x.png")
                        }
                    }
                }, t.breadcrumb = [{ name: "NAVIGATION.Game" }, { name: "NAVIGATION.Battle" }], t
            }

            return o(t, e), t = s([Object(a.Component)({
                selector: "app-battle",
                template: n("./src/app/game/battle/battle.component.html")
            })], t)
        }(r.a)
    },
    "./src/app/game/build-empire/build-empire.component.html": function(e, t, n) {
        e.exports = '<app-sub-page [contentId]="\'game\'" [breadcrumb]="breadcrumb">\n  <h1 [translate]="\'GAME.BUILD_EMPIRE.YOUR_EMPIRE\'"></h1>\n  <div class="boxGrid">\n    <div class="box intro landscape ">\n      <img [src]="images.framedIllu_cart.src" alt="type" [srcset]="images.framedIllu_cart.srcset | buildSourceSet">\n      <div class="content">\n        <div class="boxHeader"><h2 [translate]="\'GAME.BUILD_EMPIRE.THE_ROAD_TO_DOMINION\'"></h2></div>\n        <div class="boxBody"><p><span lang="EN-US"><span><span [translate]="\'GAME.BUILD_EMPIRE.THE_ROAD_TO_DOMINION_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="box live  ">\n      <div class="content">\n        <div class="boxHeader"><h3 [translate]="\'GAME.BUILD_EMPIRE.LIVE_DATA\'"></h3></div>\n        <div class="boxBody">\n          <div class="comingSoonContainer"><img src="' + n("./src/frontend/static/comingSoon.png") + '" alt="Coming soon">\n          </div>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader"><h4 [translate]="\'GAME.BUILD_EMPIRE.CRAFT_A_SCHEME\'"></h4></div>\n        <div class="boxBody"><p><span lang="EN-US"><span><span [translate]="\'GAME.BUILD_EMPIRE.CRAFT_A_SCHEME_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader"><h4 [translate]="\'GAME.BUILD_EMPIRE.HONE_YOUR_SKILLS\'"></h4></div>\n        <div class="boxBody"><p><span lang="EN-US"><span><span [translate]="\'GAME.BUILD_EMPIRE.HONE_YOUR_SKILLS_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader"><h4 [translate]="\'GAME.BUILD_EMPIRE.EXPLORE_EXPAND_AND_EXTERMINATE\'"></h4></div>\n        <div class="boxBody"><p><span lang="EN-US"><span><span [translate]="\'GAME.BUILD_EMPIRE.EXPLORE_EXPAND_AND_EXTERMINATE_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="catchyQuote">“{{ \'GAME.BUILD_EMPIRE.CREATE_A_DYNASTY_OF_A_THOUSAND_YEARS!\' | translate }}”</div>\n  </div>\n</app-sub-page>\n'
    },
    "./src/app/game/build-empire/build-empire.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/game/GameSectionBaseComponent.ts"),
            o = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            s = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            i = function(e) {
                function t() {
                    var t = null !== e && e.apply(this, arguments) || this;
                    return t.images = {
                        framedIllu_cart: {
                            src: n("./src/frontend/static/framedIllu_cart_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/static/framedIllu_cart_1x.png"),
                                "2x": n("./src/frontend/static/framedIllu_cart_2x.png")
                            }
                        }
                    }, t.breadcrumb = [{ name: "NAVIGATION.Game" }, { name: "NAVIGATION.Build empire" }], t
                }

                return o(t, e), t = s([Object(a.Component)({
                    selector: "app-build-empire",
                    template: n("./src/app/game/build-empire/build-empire.component.html")
                })], t)
            }(r.a)
    },
    "./src/app/game/interaction/interaction.component.html": function(e, t, n) {
        e.exports = '<app-sub-page [contentId]="\'game\'" [breadcrumb]="breadcrumb">\n  <h1 [translate]="\'GAME.INTERACTION.FRIENDS_AND_FOES\'"></h1>\n  <div class="boxGrid">\n    <div class="box intro landscape ">\n      <img [src]="images.framedIllu_statue.src" alt="type" [srcset]="images.framedIllu_statue.srcset | buildSourceSet">\n      <div class="content">\n        <div class="boxHeader"><h2 [translate]="\'GAME.INTERACTION.A_TRUE_MMO_EXPERIENCE\'"></h2></div>\n        <div class="boxBody"><p><span lang="EN-US"><span><span\n          [translate]="\'GAME.INTERACTION.A_TRUE_MMO_EXPERIENCE_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="box live  ">\n      <div class="content">\n        <div class="boxHeader"><h3 [translate]="\'GAME.INTERACTION.LIVE_DATA\'"></h3></div>\n        <div class="boxBody">\n          <div class="comingSoonContainer"><img src="' + n("./src/frontend/static/comingSoon.png") + '" alt="Coming soon">\n          </div>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader"><h4 [translate]="\'GAME.INTERACTION.LONG_LASTING_ALLIANCES\'"></h4></div>\n        <div class="boxBody"><p><span lang="EN-US"><span><span\n          [translate]="\'GAME.INTERACTION.LONG_LASTING_ALLIANCES_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader"><h4 [translate]="\'GAME.INTERACTION.TOURNAMENTS_AND_SPECIALS\'"></h4></div>\n        <div class="boxBody"><p><span lang="EN-US"><span><span\n          [translate]="\'GAME.INTERACTION.TOURNAMENTS_AND_SPECIALS_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader"><h4 [translate]="\'GAME.INTERACTION.FORUM_AND_EVENTS\'"></h4></div>\n        <div class="boxBody"><p><span lang="EN-US"><span><span\n          [translate]="\'GAME.INTERACTION.FORUM_AND_EVENTS_DESC\'"></span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="catchyQuote">"{{ \'GAME.INTERACTION.A_GAME_DRIVEN_BY_ITS_COMMUNITY\' | translate }}"</div>\n  </div>\n</app-sub-page>\n'
    },
    "./src/app/game/interaction/interaction.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/game/GameSectionBaseComponent.ts"),
            o = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            s = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            i = function(e) {
                function t() {
                    var t = null !== e && e.apply(this, arguments) || this;
                    return t.images = {
                        framedIllu_statue: {
                            src: n("./src/frontend/static/framedIllu_statue_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/static/framedIllu_statue_1x.png"),
                                "2x": n("./src/frontend/static/framedIllu_statue_2x.png")
                            }
                        }
                    }, t.breadcrumb = [{ name: "NAVIGATION.Game" }, { name: "NAVIGATION.Player interaction" }], t
                }

                return o(t, e), t = s([Object(a.Component)({
                    selector: "app-interaction",
                    template: n("./src/app/game/interaction/interaction.component.html")
                })], t)
            }(r.a)
    },
    "./src/app/game/late-game/late-game.component.html": function(e, t, n) {
        e.exports = '<app-sub-page [contentId]="\'game\'" [breadcrumb]="breadcrumb" [sectionId]="\'lateGamePage\'">\n    <h1 [translate]="\'GAME.LATE_GAME.FINAL_GLORY\'"></h1>\n    <div class="boxGrid">\n      <div class="box intro landscape ">\n        <img [src]="images.framedIllu_wonderOfTheWorld.src" alt="type"\n             [srcset]="images.framedIllu_wonderOfTheWorld.srcset | buildSourceSet">\n        <div class="content">\n          <div class="boxHeader"><h2 [translate]="\'GAME.LATE_GAME.THE_WONDER_OF_THE_WORLD\'"></h2></div>\n          <div class="boxBody"><p><span lang="EN-US"><span><span\n            [translate]="\'GAME.LATE_GAME.THE_WONDER_OF_THE_WORLD_DESC\'"></span></span></span>\n          </p>\n          </div>\n        </div>\n      </div>\n      <div class="box live  ">\n        <div class="content">\n          <div class="boxHeader"><h3 [translate]="\'GAME.LATE_GAME.LIVE_DATA\'"></h3></div>\n          <div class="boxBody">\n            <div class="comingSoonContainer"><img src="' + n("./src/frontend/static/comingSoon.png") + '" alt="Coming soon">\n            </div>\n          </div>\n        </div>\n      </div>\n      <div class="box default  ">\n        <div class="content">\n          <div class="boxHeader"><h4 [translate]="\'GAME.LATE_GAME.THE_GRAND_FINALE\'"></h4></div>\n          <div class="boxBody"><p><span lang="EN-US"><span><span><span\n            [translate]="\'GAME.LATE_GAME.THE_GRAND_FINALE_DESC\'"></span></span></span></span><span\n            lang="EN-US"><span><span> {{ \'GAME.LATE_GAME.THE_RACE_IS_ON\' | translate }}</span></span></span></p>\n          </div>\n        </div>\n      </div>\n      <div class="catchyQuote">“{{ \'GAME.LATE_GAME.REACH_THE_PINNACLE_OF_HUMAN_ACHIEVEMENT!\' | translate }}”</div>\n    </div>\n    <div class="boxGrid">\n      <div class="box intro landscape ">\n        <img [src]="images.framedIllu_boots.src" alt="type" [srcset]="images.framedIllu_boots.srcset | buildSourceSet">\n        <div class="content">\n          <div class="boxHeader"><h2 [translate]="\'GAME.LATE_GAME.ANCIENT_RELICS\'"></h2></div>\n          <div class="boxBody"><p><span lang="EN-US"><span><span><span [translate]="\'GAME.LATE_GAME.ANCIENT_RELICS_DESC\'"></span></span></span></span>\n          </p>\n          </div>\n        </div>\n      </div>\n      <div class="box live  ">\n        <div class="content">\n          <div class="boxHeader"><h3 [translate]="\'GAME.LATE_GAME.LIVE_DATA\'"></h3></div>\n          <div class="boxBody">\n            <div class="comingSoonContainer"><img src="' + n("./src/frontend/static/comingSoon.png") + '" alt="Coming soon">\n            </div>\n          </div>\n        </div>\n      </div>\n      <div class="box default  ">\n        <div class="content">\n          <div class="boxHeader"><h4 [translate]="\'GAME.LATE_GAME.STRANGE_POWERS\'"></h4></div>\n          <div class="boxBody"><p><span lang="EN-US"><span><span><span [translate]="\'GAME.LATE_GAME.STRANGE_POWERS_DESC\'"></span></span></span></span>\n          </p>\n          </div>\n        </div>\n      </div>\n      <div class="box default  ">\n        <div class="content">\n          <div class="boxHeader"><h4 [translate]="\'GAME.LATE_GAME.DARING_ADVENTURES\'"></h4></div>\n          <div class="boxBody"><p><span lang="EN-US"><span><span><span [translate]="\'GAME.LATE_GAME.DARING_ADVENTURES_DESC\'"></span></span></span></span>\n          </p>\n          </div>\n        </div>\n      </div>\n      <div class="box default  ">\n        <div class="content">\n          <div class="boxHeader"><h4 [translate]="\'GAME.LATE_GAME.ANNUAL_SPECIALS\'"></h4></div>\n          <div class="boxBody"><p><span lang="EN-US"><span><span><span [translate]="\'GAME.LATE_GAME.ANNUAL_SPECIALS_DESC\'"></span></span></span></span>\n          </p>\n          </div>\n        </div>\n      </div>\n      <div class="catchyQuote">"{{ \'GAME.LATE_GAME.MYSTERIOUS_POWERS_ARE_WAITING_TO_BE_DISCOVERED\' | translate }}"</div>\n    </div>\n</app-sub-page>\n'
    },
    "./src/app/game/late-game/late-game.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/game/GameSectionBaseComponent.ts"),
            o = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            s = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            i = function(e) {
                function t() {
                    var t = null !== e && e.apply(this, arguments) || this;
                    return t.images = {
                        framedIllu_wonderOfTheWorld: {
                            src: n("./src/frontend/static/framedIllu_wonderOfTheWorld_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/static/framedIllu_wonderOfTheWorld_1x.png"),
                                "2x": n("./src/frontend/static/framedIllu_wonderOfTheWorld_2x.png")
                            }
                        },
                        framedIllu_boots: {
                            src: n("./src/frontend/static/framedIllu_boots_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/static/framedIllu_boots_1x.png"),
                                "2x": n("./src/frontend/static/framedIllu_boots_2x.png")
                            }
                        }
                    }, t.breadcrumb = [{ name: "NAVIGATION.Game" }, { name: "NAVIGATION.Late game" }], t
                }

                return o(t, e), t = s([Object(a.Component)({
                    selector: "app-late-game",
                    template: n("./src/app/game/late-game/late-game.component.html")
                })], t)
            }(r.a)
    },
    "./src/app/game/playstyle/playstyle.component.html": function(e, t, n) {
        e.exports = '<app-sub-page [breadcrumb]="breadcrumb" [contentId]="\'game\'">\n  <h1 [translate]="\'GAME.PLAYSTYLE.CHOOSE_YOUR_LEGEND\'"></h1>\n  <div class="boxGrid">\n    <div class="box intro landscape ">\n      <img [src]="images.framedIllu_weapons.src" alt="type"\n           [srcset]="images.framedIllu_weapons.srcset | buildSourceSet">\n      <div class="content">\n        <div class="boxHeader">\n          <h2 [translate]="\'GAME.PLAYSTYLE.THE_HAMMER\'"></h2>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US">\n            <span>\n            <span [translate]="\'GAME.PLAYSTYLE.THE_HAMMER_DESC\'"></span>\n          </span>\n          </span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box live  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h3 [translate]="\'GAME.PLAYSTYLE.TOP5_ATTACKERS\'"></h3>\n        </div>\n        <div class="boxBody">\n          <div class="comingSoonContainer"><img src="' + n("./src/frontend/static/comingSoon.png") + '" alt="Coming soon">\n          </div>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h4 [translate]="\'GAME.PLAYSTYLE.RAISE_AN_ARMY\'"></h4>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US">\n            <span>\n            <span [translate]="\'GAME.PLAYSTYLE.RAISE_AN_ARMY_DESC\'">\n            </span>\n            </span>\n          </span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h4 [translate]="\'GAME.PLAYSTYLE.RAID_CONQUER_AND_CAUSE_SOME_MAYHEM\'"></h4>\n        </div>\n        <div class="boxBody">\n          <p>\n            <span lang="EN-US">\n            <span>\n              <span [translate]="\'GAME.PLAYSTYLE.RAID_CONQUER_AND_CAUSE_SOME_MAYHEM_DESC\'">\n              </span>\n            </span>\n          </span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h4 [translate]="\'GAME.PLAYSTYLE.YOU_ARE_THE_CHAMPION\'"></h4>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US"><span><span\n            [translate]="\'GAME.PLAYSTYLE.YOU_ARE_THE_CHAMPION_DESC\'"></span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="catchyQuote">"{{ \'GAME.PLAYSTYLE.A_REAL_WARRIOR_EARNS_ALL_HE_CAN_TAKE\' | translate }}"</div>\n  </div>\n  <div class="boxGrid">\n    <div class="box intro landscape ">\n      <img [src]="images.framedIllu_anvil.src" alt="type" [srcset]="images.framedIllu_anvil.srcset | buildSourceSet">\n      <div class="content">\n        <div class="boxHeader">\n          <h2 [translate]="\'GAME.PLAYSTYLE.HARDER_THAN_STEEL\'"></h2>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US"><span><span [translate]="\'GAME.PLAYSTYLE.HARDER_THAN_STEEL_DESC\'"></span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box live  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h3 [translate]="\'GAME.PLAYSTYLE.TOP5_DEFENDERS\'"></h3>\n        </div>\n        <div class="boxBody">\n          <div class="comingSoonContainer"><img src="' + n("./src/frontend/static/comingSoon.png") + '" alt="Coming soon">\n          </div>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h4 [translate]="\'GAME.PLAYSTYLE.THINK_LONG_TERM\'"></h4>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US"><span><span [translate]="\'GAME.PLAYSTYLE.THINK_LONG_TERM_DESC\'"></span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h4 [translate]="\'GAME.PLAYSTYLE.PROTECTOR_OF_THE_PEOPLE\'"></h4>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US"><span><span\n            [translate]="\'GAME.PLAYSTYLE.PROTECTOR_OF_THE_PEOPLE_DESC\'"></span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h4 [translate]="\'GAME.PLAYSTYLE.BE_A_TEAM_PLAYER\'"></h4>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US"><span><span [translate]="\'GAME.PLAYSTYLE.BE_A_TEAM_PLAYER_DESC\'"></span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="catchyQuote">"{{ \'GAME.PLAYSTYLE.THE_TRUE_VICTOR_STILL_STANDS_AT_THE_END\' | translate }}"</div>\n  </div>\n  <div class="boxGrid">\n    <div class="box intro landscape ">\n      <img [src]="images.framedIllu_statue.src" alt="type" [srcset]="images.framedIllu_statue.srcset | buildSourceSet">\n      <div class="content">\n        <div class="boxHeader">\n          <h2 [translate]="\'GAME.PLAYSTYLE.LEAD_WITH_GREATNESS\'"></h2>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US"><span><span [translate]="\'GAME.PLAYSTYLE.LEAD_WITH_GREATNESS_DESC\'"></span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box live  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h3 [translate]="\'GAME.PLAYSTYLE.ALLIANCES\'"></h3>\n        </div>\n        <div class="boxBody">\n          <div class="comingSoonContainer"><img src="' + n("./src/frontend/static/comingSoon.png") + '" alt="Coming soon">\n          </div>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h4 [translate]="\'GAME.PLAYSTYLE.SILVER_TONGUED_AGENT\'"></h4>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US"><span><span [translate]="\'GAME.PLAYSTYLE.SILVER_TONGUED_AGENT_DESC\'"></span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h4 [translate]="\'GAME.PLAYSTYLE.WISE_MENTOR\'"></h4>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US"><span><span [translate]="\'GAME.PLAYSTYLE.WISE_MENTOR_DESC\'"></span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h4 [translate]="\'GAME.PLAYSTYLE.CUNNING_STRATEGIST\'"></h4>\n        </div>\n        <div class="boxBody">\n          <p><span lang="EN-US"><span><span [translate]="\'GAME.PLAYSTYLE.CUNNING_STRATEGIST_DESC\'"></span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="catchyQuote">"{{ \'GAME.PLAYSTYLE.STEER_THE_COURSE_OF_THIS_WORLD_INTO_YOUR_CONTROL\' | translate }}"</div>\n  </div>\n</app-sub-page>\n'
    },
    "./src/app/game/playstyle/playstyle.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/game/GameSectionBaseComponent.ts"),
            o = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            s = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            i = function(e) {
                function t() {
                    var t = null !== e && e.apply(this, arguments) || this;
                    return t.images = {
                        framedIllu_weapons: {
                            src: n("./src/frontend/static/framedIllu_weapons_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/static/framedIllu_weapons_1x.png"),
                                "2x": n("./src/frontend/static/framedIllu_weapons_2x.png")
                            }
                        },
                        framedIllu_anvil: {
                            src: n("./src/frontend/static/framedIllu_anvil_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/static/framedIllu_anvil_1x.png"),
                                "2x": n("./src/frontend/static/framedIllu_anvil_2x.png")
                            }
                        },
                        framedIllu_statue: {
                            src: n("./src/frontend/static/framedIllu_statue_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/static/framedIllu_statue_1x.png"),
                                "2x": n("./src/frontend/static/framedIllu_statue_2x.png")
                            }
                        }
                    }, t.breadcrumb = [{ name: "NAVIGATION.Game" }, { name: "NAVIGATION.Play-style" }], t
                }

                return o(t, e), t = s([Object(a.Component)({
                    selector: "app-playstyle",
                    template: n("./src/app/game/playstyle/playstyle.component.html")
                })], t)
            }(r.a)
    },
    "./src/app/journey/journey.component.html": function(e, t) {
        e.exports = '<div id="journey">\n  <app-journey-fixed-backgrounds></app-journey-fixed-backgrounds>\n  <app-main-navigation></app-main-navigation>\n  <app-journey-play-now></app-journey-play-now>\n  \x3c!--<app-journey-news></app-journey-news>--\x3e\n  <app-journey-player></app-journey-player>\n  <app-journey-build-empire></app-journey-build-empire>\n  <app-journey-battle></app-journey-battle>\n  <app-journey-late-game></app-journey-late-game>\n  <app-footer></app-footer>\n</div>\n'
    },
    "./src/app/journey/journey.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return o
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            };
        n("./src/frontend/containers/Journey/Journey.scss"), n("./src/frontend/containers/Journey/FixedBackgrounds/FixedBackgrounds.scss"), n("./src/frontend/containers/Journey/PlayNow/PlayNow.scss"), n("./src/frontend/containers/Journey/News/News.scss"), n("./src/frontend/containers/Journey/Player/Player.scss"), n("./src/frontend/containers/Journey/Player/Playstyle/Playstyle.scss"), n("./src/frontend/containers/Journey/Player/Interaction/Interaction.scss"), n("./src/frontend/containers/Journey/BuildEmpire/BuildEmpire.scss"), n("./src/frontend/containers/Journey/Battle/Battle.scss"), n("./src/frontend/containers/Journey/LateGame/LateGame.scss");
        var o = function() {
            function e() {}

            return e.prototype.ngOnInit = function() {}, e = r([Object(a.Component)({
                selector: "app-journey",
                template: n("./src/app/journey/journey.component.html")
            })], e)
        }()
    },
    "./src/app/journey/partial/battle/battle.component.html": function(e, t) {
        e.exports = '<section id="battle" class="effectsDisabled">\n  <article>\n    <h2 [translate]="\'JOURNEY.BATTLE.TITLE\'"></h2>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h3 [translate]="\'JOURNEY.BATTLE.BOX_TITLE\'"></h3>\n        </div>\n        <div class="boxBody"><p><span><span><span [translate]="\'JOURNEY.BATTLE.BOX_CONTENT\'"></span></span></span>\n        </p></div>\n      </div>\n    </div>\n  </article>\n  <div id="Battle_parallax_back"></div>\n  <div id="Battle_parallax_front"></div>\n</section>\n'
    },
    "./src/app/journey/partial/battle/battle.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return s
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            o = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            s = function() {
                function e() {}

                return e.prototype.ngOnInit = function() {}, e = r([Object(a.Component)({
                    selector: "app-journey-battle",
                    template: n("./src/app/journey/partial/battle/battle.component.html")
                }), o("design:paramtypes", [])], e)
            }()
    },
    "./src/app/journey/partial/build-empire/build-empire.component.html": function(e, t) {
        e.exports = '<section id="buildEmpire" class="effectsDisabled">\n  <article>\n    <h2 [translate]="\'JOURNEY.BUILD_EXPIRE.STRATEGY_TO_PARADISE\'"></h2>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h3 [translate]="\'JOURNEY.BUILD_EXPIRE.THE_ROAD_TO_DOMINATION\'"></h3>\n        </div>\n        <div class="boxBody"><p><span><span><span [translate]="\'JOURNEY.BUILD_EXPIRE.THE_ROAD_TO_DOMINATION_DESC\'"></span></span></span>\n        </p></div>\n      </div>\n    </div>\n  </article>\n</section>\n'
    },
    "./src/app/journey/partial/build-empire/build-empire.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return s
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            o = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            s = function() {
                function e() {}

                return e.prototype.ngOnInit = function() {}, e = r([Object(a.Component)({
                    selector: "app-journey-build-empire",
                    template: n("./src/app/journey/partial/build-empire/build-empire.component.html")
                }), o("design:paramtypes", [])], e)
            }()
    },
    "./src/app/journey/partial/fixed-backgrounds/fixed-backgrounds.html": function(e, t) {
        e.exports = '<div id="fixedBackgrounds">\n  <img *ngFor="let img of images" [src]="img.src" [ngClass]="img.class" srcset="{{ img.srcset | buildSourceSet }}">\n</div>\n'
    },
    "./src/app/journey/partial/fixed-backgrounds/fixed-backgrounds.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return s
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            o = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            s = function() {
                function e() {
                    this.direction = "ltr", this.images = [], this.fixed_backgrounds = {
                        ltr: [{
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/player_illu_1x.jpg"),
                            class: "playerBG background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/player_illu_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/player_illu_2x.jpg")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/buildEmpire_illu_1x.jpg"),
                            class: "empireBG background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/buildEmpire_illu_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/buildEmpire_illu_2x.jpg")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/battle_illu_1x.jpg"),
                            class: "battleBG background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/battle_illu_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/battle_illu_2x.jpg")
                            }
                        }],
                        rtl: [{
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/player_illu_1x.jpg"),
                            class: "playerBG background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/player_illu_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/player_illu_2x.jpg")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/buildEmpire_illu_1x.jpg"),
                            class: "empireBG background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/buildEmpire_illu_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/buildEmpire_illu_2x.jpg")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/battle_illu_1x.jpg"),
                            class: "battleBG background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/battle_illu_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/battle_illu_2x.jpg")
                            }
                        }]
                    }, this.images = this.fixed_backgrounds[this.direction]
                }

                return e.prototype.ngOnInit = function() {}, e = r([Object(a.Component)({
                    selector: "app-journey-fixed-backgrounds",
                    template: n("./src/app/journey/partial/fixed-backgrounds/fixed-backgrounds.html")
                }), o("design:paramtypes", [])], e)
            }()
    },
    "./src/app/journey/partial/late-game/late-game.component.html": function(e, t) {
        e.exports = '<section id="lateGame" class="effectsDisabled">\n  <div id="LateGame_parallax_back"></div>\n  <div id="LateGame_parallax_front"></div>\n  <div id="LateGame_parallax_start"></div>\n  <div id="LateGame_parallax_end"></div>\n  <article>\n    <h2 [translate]="\'JOURNEY.LATE_GAME.TITLE\'"></h2>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h3 [translate]="\'JOURNEY.LATE_GAME.BOX_TITLE\'"></h3>\n        </div>\n        <div class="boxBody"><p><span><span><span [translate]="\'JOURNEY.LATE_GAME.BOX_CONTENT\'"></span></span></span>\n        </p></div>\n      </div>\n    </div>\n    <div id="artifactPreview">\n      <h2 [translate]="\'JOURNEY.LATE_GAME.UNIQUE_POWERS\'"></h2>\n      <div>\n        <svg>\n          <filter class="filter" id="dropShadowArtifactPreview">\n            <feGaussianBlur in="SourceAlpha" stdDeviation="10"></feGaussianBlur>\n            <feOffset dx="3" dy="3" result="offsetblur"></feOffset>\n            <feMerge>\n              <feMergeNode></feMergeNode>\n              <feMergeNode in="SourceGraphic"></feMergeNode>\n            </feMerge>\n          </filter>\n        </svg>\n        <img *ngFor="let img of images" [src]="img.src" alt="type" [srcset]="img.srcset | buildSourceSet" style="filter: url(\'#dropShadowArtifactPreview\');">\n      </div>\n    </div>\n  </article>\n</section>\n'
    },
    "./src/app/journey/partial/late-game/late-game.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/locale.service.ts"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = function() {
                function e(e) {
                    var t = this;
                    this.localeService = e, this.images = [], this.artifacts_images = {
                        ltr: [{
                            src: n("./src/frontend/containers/Journey/LateGame/ltr/boots_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/LateGame/ltr/boots_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/LateGame/ltr/boots_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/LateGame/ltr/lock_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/LateGame/ltr/lock_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/LateGame/ltr/lock_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/LateGame/ltr/sight_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/LateGame/ltr/sight_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/LateGame/ltr/sight_2x.png")
                            }
                        }],
                        rtl: [{
                            src: n("./src/frontend/containers/Journey/LateGame/rtl/boots_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/LateGame/rtl/boots_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/LateGame/rtl/boots_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/LateGame/rtl/lock_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/LateGame/rtl/lock_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/LateGame/rtl/lock_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/LateGame/rtl/sight_1x.png"),
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/LateGame/rtl/sight_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/LateGame/rtl/sight_2x.png")
                            }
                        }]
                    }, this.images = this.artifacts_images[this.localeService.data.direction], this.localeService.dataChanged.subscribe(function(e) {
                        t.images = t.artifacts_images[e.direction]
                    })
                }

                return e.prototype.ngOnInit = function() {}, e = o([Object(a.Component)({
                    selector: "app-journey-late-game",
                    template: n("./src/app/journey/partial/late-game/late-game.component.html")
                }), s("design:paramtypes", [r.a])], e)
            }()
    },
    "./src/app/journey/partial/news/news.component.html": function(e, t) {
        e.exports = '<section id="news" style="background: black;">\n  <article>\n    <div *ngFor="let row of news" class="box default newsLayout{{row.key}}">\n      <div class="boxTitle">\n        <h1><span [innerText]="row.title"></span></h1></div>\n      <div class="content">\n        <div class="boxBody">\n          <div class="news" [innerHTML]="row.content | sanitizeHTML"></div>\n          <div *ngIf="row.more != \'\'" class="readMore"><A href="{{row.more}}">{{ \'NEWS.READ_MORE\' | translate }}</A></div>\n        </div>\n      </div>\n    </div>\n    <div class="newsArrows">\n      <svg class="back" viewBox="-9 -6.5 13.1 20">\n        <path d="M8.3 10L0 20h4.7L13 10 4.7 0H0l8.3 10z" transform="scale(.3)"></path>\n      </svg>\n      <svg class="forth" viewBox="-9 -6.5 13.1 20">\n        <path d="M8.3 10L0 20h4.7L13 10 4.7 0H0l8.3 10z" transform="scale(.3)"></path>\n      </svg>\n    </div>\n  </article>\n  \x3c!---\n  <div style="margin: 0 auto; width: calc(80vw + .4vw + 15px);">\n    <div *ngFor="let row of news" class="boxGrid">\n      <div class="box default">\n        <div class="content">\n          <div class="boxHeader"><h4 [innerText]="row.title"></h4></div>\n          <div class="boxBody" [innerHTML]="row.content | sanitizeHTML"></div>\n        </div>\n      </div>\n    </div>\n  </div>--\x3e\n</section>\n'
    },
    "./src/app/journey/partial/news/news.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/api.service.ts"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = function() {
                function e(e) {
                    var t = this;
                    this.api = e, this.news = [], e.getNews().subscribe(function(e) {
                        t.news = e
                    })
                }

                return e.prototype.ngOnInit = function() {}, e = o([Object(a.Component)({
                    selector: "app-journey-news",
                    template: n("./src/app/journey/partial/news/news.component.html")
                }), s("design:paramtypes", [r.a])], e)
            }()
    },
    "./src/app/journey/partial/play-now/play-now.component.html": function(e, t) {
        e.exports = '<section id="playNow" class="effectsDisabled">\n  <img *ngFor="let img of images" [src]="img.src" [class]="img.class" srcset="{{ img.srcset | buildSourceSet }}">\n  <article><h1><span>{{ \'JOURNEY.PLAY_NOW.JOIN_THE_FAMOUS\' | translate }}</span>\n    {{ \'JOURNEY.PLAY_NOW.EXPERT_STRATEGY_GAME\' | translate }}\n  </h1>\n    <h2>{{ \'JOURNEY.PLAY_NOW.TRUE_MMO_WITH_THOUSAND_OF_REAL_PLAYERS\' | translate }}</h2>\n    <svg class="filter">\n      <filter class="filter" id="dropShadowPlayNowButton">\n        <feGaussianBlur in="SourceAlpha" stdDeviation="10"></feGaussianBlur>\n        <feOffset dx="3" dy="3" result="offsetblur"></feOffset>\n        <feMerge>\n          <feMergeNode></feMergeNode>\n          <feMergeNode in="SourceGraphic"></feMergeNode>\n        </feMerge>\n      </filter>\n    </svg>\n    <button id="playNowButton" (click)="open(\'register\', $event)" style="filter:url(#dropShadowPlayNowButton);">\n        <svg  viewBox="0 0 392 67">\n          <defs>\n            <linearGradient id="playNowButtonFilterGradient" x1="0%" x2="0%" y1="100%" y2="0%">\n              <stop offset="0%" stop-color="rgb(223,136,2)"></stop>\n              <stop offset="100%" stop-color="rgb(252,163,12)"></stop>\n            </linearGradient>\n            <filter id="playNowButtonFilter" width="392" height="67" x="0" y="0" filterUnits="userSpaceOnUse"\n            >\n              <feOffset in="SourceAlpha" dx=".827" dy="2.884"></feOffset>\n              <feGaussianBlur result="blurOut" stdDeviation="2.236"></feGaussianBlur>\n              <feFlood flood-color="rgb(0, 0, 0)" result="floodOut"></feFlood>\n              <feComposite operator="atop" in="floodOut" in2="blurOut"></feComposite>\n              <feComponentTransfer>\n                <feFuncA type="linear" slope=".6"></feFuncA>\n              </feComponentTransfer>\n              <feMerge>\n                <feMergeNode></feMergeNode>\n                <feMergeNode in="SourceGraphic"></feMergeNode>\n              </feMerge>\n            </filter>\n          </defs>\n          <g filter="url(#playNowButtonFilter)">\n            <text x="196" y="41" fill="rgb(254, 160, 0)" text-anchor="middle">{{ \'JOURNEY.PLAY_NOW.PLAY_NOW\' | translate\n              }}\n            </text>\n            <text x="196" y="41" fill="url(#playNowButtonFilterGradient)" text-anchor="middle">{{\n              \'JOURNEY.PLAY_NOW.PLAY_NOW\' | translate }}\n            </text>\n          </g>\n        </svg>\n    </button>\n  </article>\n  <div id="PlayNow_parallax_back"></div>\n  <div id="PlayNow_parallax_front"></div>\n</section>\n'
    },
    "./src/app/journey/partial/play-now/play-now.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return p
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/locale.service.ts"),
            o = n("./src/app/modal/set-language/set-language.component.ts"),
            s = n("./src/app/modal/register/register.component.ts"),
            i = n("./src/app/modal/login/login.component.ts"),
            c = n("./src/app/_services/modal.service.ts"),
            l = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            d = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            p = function() {
                function e(e, t) {
                    var a = this;
                    this.localeService = e, this.modalService = t, this.images = [], this.play_now_images = {
                        ltr: [{
                            src: n("./src/frontend/containers/Journey/PlayNow/ltr/backgroundScene_1x.jpg"),
                            class: "background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/PlayNow/ltr/backgroundScene_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/PlayNow/ltr/backgroundScene_2x.jpg")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/PlayNow/ltr/army_1x.png"),
                            class: "army",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/PlayNow/ltr/army_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/PlayNow/ltr/army_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/PlayNow/ltr/soldier_1x.png"),
                            class: "soldier",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/PlayNow/ltr/soldier_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/PlayNow/ltr/soldier_2x.png")
                            }
                        }],
                        rtl: [{
                            src: n("./src/frontend/containers/Journey/PlayNow/rtl/backgroundScene_1x.jpg"),
                            class: "background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/PlayNow/rtl/backgroundScene_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/PlayNow/rtl/backgroundScene_2x.jpg")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/PlayNow/rtl/army_1x.png"),
                            class: "army",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/PlayNow/rtl/army_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/PlayNow/rtl/army_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/PlayNow/rtl/soldier_1x.png"),
                            class: "soldier",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/PlayNow/rtl/soldier_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/PlayNow/rtl/soldier_2x.png")
                            }
                        }]
                    }, this.images = this.play_now_images[this.localeService.data.direction], this.localeService.dataChanged.subscribe(function(e) {
                        a.images = a.play_now_images[e.direction]
                    })
                }

                return e.prototype.ngOnInit = function() {}, e.prototype.open = function(e, t) {
                    return "login" === e ? this.modalService.open(i.a) : "register" === e ? this.modalService.open(s.a) : "setLanguage" === e && this.modalService.open(o.a), !0
                }, e = l([Object(a.Component)({
                    selector: "app-journey-play-now",
                    template: n("./src/app/journey/partial/play-now/play-now.component.html")
                }), d("design:paramtypes", [r.a, c.a])], e)
            }()
    },
    "./src/app/journey/partial/player/interaction/interaction.component.html": function(e, t) {
        e.exports = '<section id="interaction" class="effectsDisabled">\n  <article>\n    <h2 [translate]="\'JOURNEY.PLAYER.INTERACTION.PLAY_WITH_THOUSANDS_OF_OTHERS\'"></h2>\n    <div class="box default  ">\n      <div class="content">\n        <div class="boxHeader">\n          <h3 [translate]="\'JOURNEY.PLAYER.INTERACTION.A_TRUE_MMO_EXPERIENCE\'"></h3>\n        </div>\n        <div class="boxBody"><p><span><span><span [translate]="\'JOURNEY.PLAYER.INTERACTION.A_TRUE_MMO_EXPERIENCE_DESC\'"></span></span></span>\n        </p></div>\n      </div>\n    </div>\n  </article>\n  <div id="Interaction_parallax_back"></div>\n  <div id="Interaction_parallax_front"></div>\n</section>\n'
    },
    "./src/app/journey/partial/player/interaction/interaction.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return s
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            o = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            s = function() {
                function e() {}

                return e.prototype.ngOnInit = function() {}, e = r([Object(a.Component)({
                    selector: "app-journey-player-interaction",
                    template: n("./src/app/journey/partial/player/interaction/interaction.component.html")
                }), o("design:paramtypes", [])], e)
            }()
    },
    "./src/app/journey/partial/player/player.component.html": function(e, t) {
        e.exports = '<section id="player" class="effectsDisabled">\n    <div id="News_parallax">\n        <div id="News_parallax_back"></div>\n        <div id="News_parallax_front"></div>\n        <div id="News_parallax_left"></div>\n        <div id="News_parallax_right"></div>\n    </div>\n    <app-journey-player-playstyle></app-journey-player-playstyle>\n    <app-journey-player-interaction></app-journey-player-interaction>\n</section>'
    },
    "./src/app/journey/partial/player/player.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return s
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            o = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            s = function() {
                function e() {}

                return e.prototype.ngOnInit = function() {}, e = r([Object(a.Component)({
                    selector: "app-journey-player",
                    template: n("./src/app/journey/partial/player/player.component.html")
                }), o("design:paramtypes", [])], e)
            }()
    },
    "./src/app/journey/partial/player/playstyle/playstyle.component.html": function(e, t) {
        e.exports = '<section id="playstyle" class="effectsDisabled">\n  <article>\n    <h2>{{ \'JOURNEY.PLAYER.PLAY_STYLE.CHOOSE_YOUR_LEGEND\' | translate }}</h2>\n    <div class="box default" [ngClass]="{\'active\': legend == 1}">\n      <div class="content">\n        <div class="boxHeader"><h3>{{ \'JOURNEY.PLAYER.PLAY_STYLE.LEGENDS.ATTACKER.TITLE\' | translate}}</h3></div>\n        <div class="boxBody">\n          <p>\n            <span>\n              <span>\n              <span>{{ \'JOURNEY.PLAYER.PLAY_STYLE.LEGENDS.ATTACKER.DESC\' | translate}}</span></span></span>\n          </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default" [ngClass]="{\'active\': legend == 2}">\n      <div class="content">\n        <div class="boxHeader"><h3>{{ \'JOURNEY.PLAYER.PLAY_STYLE.LEGENDS.DEFENDER.TITLE\' | translate}}</h3></div>\n        <div class="boxBody"><p><span><span><span>{{ \'JOURNEY.PLAYER.PLAY_STYLE.LEGENDS.DEFENDER.DESC\' | translate}}</span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n    <div class="box default" [ngClass]="{\'active\': legend == 3}">\n      <div class="content">\n        <div class="boxHeader"><h3>{{ \'JOURNEY.PLAYER.PLAY_STYLE.LEGENDS.LEADER.TITLE\' | translate}}</h3></div>\n        <div class="boxBody"><p>\n          <span><span><span>{{ \'JOURNEY.PLAYER.PLAY_STYLE.LEGENDS.LEADER.DESC\' | translate}}</span></span></span>\n        </p>\n        </div>\n      </div>\n    </div>\n  </article>\n  <div class="playstyle">\n    <svg>\n      <filter class="filter" id="grayscale">\n        <feColorMatrix type="saturate" values="0.85"></feColorMatrix>\n        <feColorMatrix type="matrix"\n                       values=".14  0    0   0   0 0  .11   0   0   0 0   0   .14  0   0 0   0    0   1   0 "></feColorMatrix>\n      </filter>\n    </svg>\n    <img *ngFor="let img of legend_images"\n         [src]="img.src" class="{{img.class}} "\n         [ngClass]="{\'active\': legend == img.legend}"\n         [srcset]="img.srcset | buildSourceSet"\n         (click)="changeLegend(img.legend)"\n         [ngStyle]="legend != img.legend ? {\'filter\': \'url(#grayscale)\'} : {}">\n\n    <img *ngFor="let img of legend_overlay_images"\n         [src]="img.src" class="{{img.class}} "\n         [ngClass]="{\'inactive\': legend != img.legend}">\n\n    <svg (click)="changeLegend(2)" class="defender normalOverlay"\n         [ngClass]="{\'active\': legend == 2, \'inactive\': legend != 2}" viewBox="0 0 436 990" width="291.546875"\n         height="662">\n      <path\n        d="M272 2c4 3 20 68 18 79s-7 19-4 31c5 0 8 0 11 2l-8 5c-2 25 4 52 4 82h3c11 7 28-5 42 0s14 24 20 40 24 40 27 52l-2 8 10 14-3 10c3 27 27 35 7 70-5 0-29 6-31 8 11 24 29 42 46 60-28 34 30 78 23 116-3 15-18 31-28 40h-2l-2-18h-3c-10 17-18 38-30 53 7 20 8 54 0 72 4 11 10 23 18 31-8 39-6 93 3 128 3 13-6 12 1 22l-5 7c4 16 11 35 15 51-12 23-52 7-69 3 1 7 3 16-2 19h-10l-9-175-2-33c-5-12-7-1-5-22-18 12-83 35-92 50-10 27-11 71-19 95-5 13 5 28-2 39-21 2-98 33-111 7-2-6 0-10 2-15l18-3v-8l26-17c9-7 14-20 22-28-7-5 3-102-4-119L55 562-1 430l32-59c7-9 65-35 78-38l38 5c1-7 9-39 7-44s-6-10-6-23c15-10 30-22 41-36-29-14-42-96-7-112 8-5 13 1 19 3l19 3c16 7 32 28 34 48 7 0 8 1 11 5l-9 9v3c5 2 13 6 22 4-9-24 0-55-6-78-6 0-6-1-9-3l2-3c8 0 10 0 10-9-10-24-9-70-3-103z"></path>\n    </svg>\n    <svg (click)="changeLegend(1)" class="attacker normalOverlay "\n         [ngClass]="{\'active\': legend == 1, \'inactive\': legend != 1}" viewBox="0 0 507 846" width="336.58251953125"\n         height="561.638916015625">\n      <path\n        d="M184 7c33 6 47 16 61 41l-8-5c2 9 6 14 13 18s6-8 11-14l51-28 9 7c8 23 16 55 53 44-2 25-37 51-63 53 12 16 54 77 45 95 5 16 14 28 18 47 7 34-4 94 1 135l116 25 3 8-8 10-22-9-98-20c-5 11-21 7-34 7 6 47-8 95 0 142 4 19 17 33 20 49s-9 34-6 49 19 35 21 54l-9-3h-1l5 13-22 18c4 8 0 18 3 28 6 21 38 65 1 73-48 11-33-75-37-101-11-4-20-14-32-15v2l4 13c-13 0-16 0-26-4-5-17-6-21-18-28l-7-47h-1c0 24 10 95 2 115l-32 2c-18 5-53 24-74 5 2-6 4-12 7-17 20-4 43-16 49-30s0-11 3-16 6 1 7-8-12-26-16-35l-46-100c2-1-1-71 0-89l-7-5c2-12 2-56-1-58s-18-5-23-16c9-18 21-35 25-57l-6-5c1-8 8-38 15-40s10 2 15 0c2-16 12-61 6-76v2c-9 12-18 25-37 26s-13-9-20-15c-30-23-25-28-34-70-15-1-30 16-39 25s-23-6-21-15l51-24c0-8 0-14 3-18s23-20 35-14l8 8 72-34c-3-12-9-11-13-19-11-20-7-56 8-68s15-6 20-11z"></path>\n    </svg>\n    <svg (click)="changeLegend(3)" class="leader normalOverlay"\n         [ngClass]="{\'active\': legend == 3, \'inactive\': legend != 3}" viewBox="0 0 424 873" width="279.71875"\n         height="575.9375">\n      <path\n        d="M202 1c63-1 36 60 35 98 12 6 20 8 26 23 7 0 12 0 16 3s3 12 7 19 34 25 31 49c-1 6 5 29 2 35s-7 31-4 41c7 24 29 41 43 59 25 31 57 72 65 117-25 9-1 42-5 62s-18 34-26 49c17 37-2 46-7 84-2 18 12 25 13 42-18 38-65 82-116 84 4 21-7 23-21 34 11 13 38 15 45 26l4 12c-16 7-45 15-68 5l-9-8c-12-5-26-1-35-8s-1-16 1-24c-21-3-46-19-60-33v-28c-4 18-14 36-19 52s0 21-3 30l-5-5c0 18 7 35-2 47s-51 10-61-5c2-19 13-32 24-43l-4 2h-3v-3c16-16 10-49 14-78v-21c3-11 0-39 3-46s6-6 7-10-4-15-2-19 7-5 9-11c-11-19-5-18-1-34l-5-18c-3-14 5-31 4-39l-7-17-16-66c-7-31-1-68-9-101l-11-24c-5-2-9-1-11-4-12-23 1-67 7-86l-3-21c7-23 29-36 41-53s8-22 14-32c17-5 31-13 51-17 2-6 8-18 14-21l11-2c1-5 6-10 3-16s-9-8-11-13 1-46 7-54 20-9 27-13z"></path>\n    </svg>\n  </div>\n  <div class="mobileArrows">\n    <svg (click)="changeLegend(legend-1)" class="back" viewBox="-9 -6.5 13.1 20">\n      <path d="M8.3 10L0 20h4.7L13 10 4.7 0H0l8.3 10z" transform="scale(.3)"></path>\n    </svg>\n    <svg (click)="changeLegend(legend+1)" class="forth" viewBox="-9 -6.5 13.1 20">\n      <path d="M8.3 10L0 20h4.7L13 10 4.7 0H0l8.3 10z" transform="scale(.3)"></path>\n    </svg>\n  </div>\n</section>\n'
    },
    "./src/app/journey/partial/player/playstyle/playstyle.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/locale.service.ts"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = function() {
                function e(e) {
                    var t = this;
                    this.legend = 1, this.legend_images = [], this.legend_overlay_images = [], this.base_legend_images = {
                        ltr: [{
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/ltr/defender_1x.png"),
                            class: "defender",
                            legend: 2,
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/Player/Playstyle/ltr/defender_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/Player/Playstyle/ltr/defender_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/ltr/attacker_1x.png"),
                            class: "attacker",
                            legend: 1,
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/Player/Playstyle/ltr/attacker_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/Player/Playstyle/ltr/attacker_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/ltr/leader_1x.png"),
                            class: "leader",
                            legend: 3,
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/Player/Playstyle/ltr/leader_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/Player/Playstyle/ltr/leader_2x.png")
                            }
                        }],
                        rtl: [{
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/rtl/defender_1x.png"),
                            class: "defender",
                            legend: 2,
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/Player/Playstyle/rtl/defender_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/Player/Playstyle/rtl/defender_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/rtl/attacker_1x.png"),
                            class: "attacker",
                            legend: 1,
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/Player/Playstyle/rtl/attacker_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/Player/Playstyle/rtl/attacker_2x.png")
                            }
                        }, {
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/rtl/leader_1x.png"),
                            class: "leader",
                            legend: 3,
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/Player/Playstyle/rtl/leader_1x.png"),
                                "2x": n("./src/frontend/containers/Journey/Player/Playstyle/rtl/leader_2x.png")
                            }
                        }]
                    }, this.base_overlay_images = {
                        ltr: [{
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/ltr/defenderIeOverlay.png"),
                            class: "defender ieOverlay",
                            legend: 2
                        }, {
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/ltr/attackerIeOverlay.png"),
                            class: "attacker ieOverlay",
                            legend: 1
                        }, {
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/ltr/leaderIeOverlay.png"),
                            class: "leader ieOverlay",
                            legend: 3
                        }],
                        rtl: [{
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/rtl/defenderIeOverlay.png"),
                            class: "defender ieOverlay",
                            legend: 2
                        }, {
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/rtl/attackerIeOverlay.png"),
                            class: "attacker ieOverlay",
                            legend: 1
                        }, {
                            src: n("./src/frontend/containers/Journey/Player/Playstyle/rtl/leaderIeOverlay.png"),
                            class: "leader ieOverlay",
                            legend: 3
                        }]
                    }, this.populateImages(e.data.direction), e.dataChanged.subscribe(function(e) {
                        t.populateImages(e.direction)
                    })
                }

                return e.prototype.populateImages = function(e) {
                    this.legend_images = this.base_legend_images[e], this.legend_overlay_images = this.base_overlay_images[e]
                }, e.prototype.ngOnInit = function() {}, e.prototype.changeLegend = function(e) {
                    e > 3 ? e = 1 : e < 1 && (e = 3), this.legend = e
                }, e = o([Object(a.Component)({
                    selector: "app-journey-player-playstyle",
                    template: n("./src/app/journey/partial/player/playstyle/playstyle.component.html")
                }), s("design:paramtypes", [r.a])], e)
            }()
    },
    "./src/app/main-navigation/main-navigation.component.html": function(e, t) {
        e.exports = '<div id="mainNavigation" [ngClass]="{\'collapsed\': collapsed}">\n    <div *ngIf="!cookiesAccepted" class="cookieInfo">\n      <span [translate]="\'COOKIES_ACCEPT.THIS_WEBSITE_USES_COOKIES_DESC\'"></span>\n        <button class="button default" (click)="acceptCookies();">\n          <span [translate]="\'COOKIES_ACCEPT.OK\'"></span>\n        </button>\n        \x3c!--\n          <a href="https://agb.traviangames.com/privacy-international.pdf" target="_blank" title="More information">\n          More information\n        </a>\n      --\x3e\n  </div>\n  <nav class="desktop">\n    <div id="sectionBefore">\n      <ul class="noWrap">\n        <li class="dropdown" *ngFor="let nav of desktopNavigation">\n          <span>{{ (\'NAVIGATION.\' + nav.name) | translate }}</span>\n          <svg *ngIf="nav.children !== undefined && nav.children.length>0" viewBox="0 0 25 25">\n            <filter class="filter" id="dropShadowMainNavigation" width="150%" height="150%">\n              <feGaussianBlur in="SourceAlpha" result="shadow" stdDeviation="1"></feGaussianBlur>\n              <feColorMatrix in="shadow" result="dark" type="matrix"\n                             values="0 0 0 0 0  0 0 0 0 0  0 0 0 0 0  0 0 0 .4 0"></feColorMatrix>\n              <feOffset dx="2" dy="2" result="offsetblur"></feOffset>\n              <feBlend in="SourceGraphic" in2="offsetblur" mode="normal"></feBlend>\n            </filter>\n            <path d="M0,0 L20,0 L10,10z" filter="url(#dropShadowMainNavigation)"></path>\n          </svg>\n          <ul *ngIf="nav.children !== undefined && nav.children.length>0">\n            <li *ngFor="let child of nav.children">\n              <a title="{{ (\'NAVIGATION.\' + child.name) | translate }}" [routerLink]="buildRouteLink(child.url, hrefLang)">\n                {{ (\'NAVIGATION.\' + child.name) | translate }}\n              </a>\n            </li>\n          </ul>\n        </li>\n      </ul>\n    </div>\n    <a class="logo" [routerLink]="[\'/\', hrefLang]" [ngClass]="{\'small\': collapsed}" [innerHTML]="logo | sanitizeHTML">\n    </a>\n    <div id="sectionAfter">\n      <ul class="noWrap">\n        <li>\n          <a (click)="open(\'setLanguage\', $event);">\n            <span class="selectedLanguage language" [innerHTML]="flagSvg | sanitizeHTML"></span>\n          </a>\n        </li>\n        <li>\n          <a (click)="open(\'login\', $event);">\n            <span [translate]="\'NAVIGATION.Login\'"></span>\n          </a>\n        </li>\n        <li *ngIf="!collapsed">\n          <a (click)="open(\'register\', $event);">\n            <span [translate]="\'NAVIGATION.Register\'"></span>\n          </a>\n        </li>\n        <li class="register">\n          <a id="register" class="button default withHiddenButton" [routerLink]="[\'./\']" fragment="register"\n             title="{{ \'NAVIGATION.Register\' | translate }}" [translate]="\'NAVIGATION.Register\'"></a>\n        </li>\n      </ul>\n    </div>\n  </nav>\n  <nav class="mobile " [ngClass]="{\'opened\': mobileNavbarOpen, \'closed\': !mobileNavbarOpen}">\n    <a class="openMenu" title="" (click)="mobileNavbarOpen = true">\n      <svg class="burger" viewBox="0 0 34 31">\n        <path\n          d="M2.5 5h29C32.88 5 34 3.88 34 2.5S32.88 0 31.5 0h-29C1.12 0 0 1.12 0 2.5S1.12 5 2.5 5zm29 8h-29C1.12 13 0 14.12 0 15.5S1.12 18 2.5 18h29c1.38 0 2.5-1.12 2.5-2.5S32.88 13 31.5 13zm0 13h-29C1.12 26 0 27.12 0 28.5S1.12 31 2.5 31h29c1.38 0 2.5-1.12 2.5-2.5S32.88 26 31.5 26z"\n        ></path>\n      </svg>\n    </a>\n    <a class="logo" [routerLink]="[\'/\', hrefLang]" [innerHTML]="logo | sanitizeHTML"></a>\n    <div class="overlay" (click)="closeIfOpen();" role="none presentation"></div>\n    <div class="content " [ngClass]="{\'opened\': mobileNavbarOpen, \'closed\': !mobileNavbarOpen}">\n      <a class="back" (click)="closeIfOpen();"\n         title="{{ \'NAVIGATION.Close\' | translate }}">\n        <div [translate]="\'NAVIGATION.Close\'"></div>\n      </a>\n      <div class="navigationContentWrapper">\n        <ul class="level0">\n          <li *ngFor="let nav of navigation" [ngClass]="nav.className" (click)="expand(nav)">\n            <a (click)="nav.modal != undefined && open(nav.modal, $event);">\n              <svg *ngIf="nav.svgClassName == \'game\'" class="category" viewBox="0 0 30.52 50">\n                <path\n                  d="M12.21 18.48c.97-.27 1.99-.42 3.05-.42 1.06 0 2.08.15 3.05.42v-2.2l2.03-4.07s-.45-4.07-2.03-4.07h-2.03V3.71c1.08-.3 2.3-.98 2.3-1.77C18.58.87 16.36 0 15.26 0c-1.1 0-3.32.87-3.32 1.94 0 .79 1.22 1.47 2.3 1.77v4.43h-2.03s-2.03 1.51-2.03 4.07l2.03 4.07v2.2zm-8.2 10.54c0-4.27 2.51-7.96 6.17-9.77v-2.98L8.15 12.2H4.07C1.82 12.21 0 14.03 0 16.28v24.41c0 2.25 1.82 4.07 4.07 4.07h6.1v-5.97c-3.65-1.81-6.16-5.5-6.16-9.77zm22.44-16.81h-4.07l-2.03 4.07v2.98c3.66 1.81 6.17 5.5 6.17 9.77s-2.51 7.96-6.17 9.77v5.97h6.1c2.25 0 4.07-1.82 4.07-4.07V16.28c0-2.25-1.82-4.07-4.07-4.07zM12.21 39.56v7.23L15.26 50l3.05-3.21v-7.23c-.97.27-1.99.42-3.05.42-1.06 0-2.08-.15-3.05-.42zm-5.6-10.54c0 4.62 3.87 8.36 8.65 8.36s8.65-3.74 8.65-8.36c0-4.62-3.87-8.36-8.65-8.36s-8.65 3.75-8.65 8.36z"></path>\n              </svg>\n              <svg *ngIf="nav.svgClassName == \'media\'" class="category" viewBox="0 0 50 40.48">\n                <path\n                  d="M45.24 0H4.76C2.13 0 0 2.13 0 4.76v21.43c0 2.63 2.13 4.76 4.76 4.76h16.67c-1.05 7.34-9.73 6.38-9.52 9.52H38.1c-.06-3.46-8.58-1.86-9.52-9.52h16.67c2.63 0 4.76-2.13 4.76-4.76V4.76C50 2.13 47.87 0 45.24 0zM19.05 21.43V9.52l14.29 5.95-14.29 5.96z"></path>\n              </svg>\n              <svg *ngIf="nav.svgClassName == \'forum\'" class="category" viewBox="0 0 45.65 50">\n                <path\n                  d="M41.3 21.74H19.57c-2.4 0-4.35 1.95-4.35 4.35v10.87c0 2.4 1.95 4.35 4.35 4.35h18.12l5.8 8.7v-9.3c1.29-.75 2.17-2.14 2.17-3.74V26.09c-.01-2.4-1.95-4.35-4.36-4.35zM23.91 32.61h-4.35v-2.17h4.35v2.17zm8.7 0h-6.52v-2.17h6.52v2.17zm8.69 0h-6.52v-2.17h6.52v2.17zM30.43 15.22V4.35c0-2.4-1.95-4.35-4.35-4.35H4.35C1.95 0 0 1.95 0 4.35v10.87c0 1.61.88 2.99 2.17 3.74v9.3l5.8-8.7h18.12c2.4.01 4.34-1.94 4.34-4.34zm-19.56-4.35H4.35V8.7h6.52v2.17zm2.17-2.17h13.04v2.17H13.04V8.7z"></path>\n              </svg>\n              <span>{{ (\'NAVIGATION.\' + nav.name) | translate }}</span>\n              <div class="subMenuOpener"\n                   *ngIf="nav.children != undefined && nav.children.length>0">\n                <svg class="caret" viewBox="0 0 20 10">\n                  <path d="M0,0 L20,0 L10,10z"></path>\n                </svg>\n              </div>\n            </a>\n          </li>\n          <li>\n            <a (click)="open(\'setLanguage\', $event);">\n              <span class="selectedLanguage language" [innerHTML]="flagSvg | sanitizeHTML"></span>\n              <span><span>{{ (\'NAVIGATION.Language\') | translate }}</span></span>\n              <div class="subMenuOpener">\n                <svg class="caret" viewBox="0 0 20 10">\n                  <path d="M0,0 L20,0 L10,10z"></path>\n                </svg>\n              </div>\n            </a>\n          </li>\n          <li>\n            <a (click)="open(\'login\', $event)" title="{{ (\'NAVIGATION.Log in and play\') | translate }}">\n              <svg class="category" viewBox="0 0 49.94 50">\n                <path d="M13.83 31.2v7.71l9.58-13.71-9.58-13.71v7.71H0v12"></path>\n                <path\n                  d="M16.83 5.19h17.29l-6.85 2.49v17-17l6.85-2.49-6.85 2.49v34.31l8.03 2.82-8.03-2.82V25.72v16.27l8.03 2.82H16.83v-4.15l-5.19 7.42V50h38.3V0h-38.3v2.32l5.19 7.42"></path>\n              </svg>\n              {{ (\'NAVIGATION.Log in and play\') | translate }}</a>\n          </li>\n        </ul>\n        <a id="registerMobile" class="register button default"\n           (click)="open(\'register\', $event)" title="{{ (\'NAVIGATION.Play now\') | translate }}"\n        ><span>{{ (\'NAVIGATION.Play now\') | translate }}</span></a></div>\n    </div>\n    <div class="content "\n         [ngClass]="{\'closed\': navbarChildren.categoryName === undefined, \'opened\': navbarChildren.categoryName !== undefined}">\n      <a class="back" (click)="closeIfOpen(true);" title="{{ (\'NAVIGATION.Back to categories\') | translate }}">\n        <div>{{ (\'NAVIGATION.Back to categories\') | translate }}</div>\n      </a>\n      <div class="navigationContentWrapper">\n        <ul class="level1" *ngIf="navbarChildren.categoryName !== undefined">\n          <li class="currentCategory">\n            <svg *ngIf="navbarChildren.svgClassName == \'game\'" class="category" viewBox="0 0 30.52 50">\n              <path\n                d="M12.21 18.48c.97-.27 1.99-.42 3.05-.42 1.06 0 2.08.15 3.05.42v-2.2l2.03-4.07s-.45-4.07-2.03-4.07h-2.03V3.71c1.08-.3 2.3-.98 2.3-1.77C18.58.87 16.36 0 15.26 0c-1.1 0-3.32.87-3.32 1.94 0 .79 1.22 1.47 2.3 1.77v4.43h-2.03s-2.03 1.51-2.03 4.07l2.03 4.07v2.2zm-8.2 10.54c0-4.27 2.51-7.96 6.17-9.77v-2.98L8.15 12.2H4.07C1.82 12.21 0 14.03 0 16.28v24.41c0 2.25 1.82 4.07 4.07 4.07h6.1v-5.97c-3.65-1.81-6.16-5.5-6.16-9.77zm22.44-16.81h-4.07l-2.03 4.07v2.98c3.66 1.81 6.17 5.5 6.17 9.77s-2.51 7.96-6.17 9.77v5.97h6.1c2.25 0 4.07-1.82 4.07-4.07V16.28c0-2.25-1.82-4.07-4.07-4.07zM12.21 39.56v7.23L15.26 50l3.05-3.21v-7.23c-.97.27-1.99.42-3.05.42-1.06 0-2.08-.15-3.05-.42zm-5.6-10.54c0 4.62 3.87 8.36 8.65 8.36s8.65-3.74 8.65-8.36c0-4.62-3.87-8.36-8.65-8.36s-8.65 3.75-8.65 8.36z"></path>\n            </svg>\n            <span>{{ (\'NAVIGATION.\' + navbarChildren.categoryName) | translate }}</span>\n          </li>\n          <li *ngFor="let child of navbarChildren.children">\n            <a title="{{ (\'NAVIGATION.\' + child.name) | translate }}" [routerLink]="buildRouteLink(child.url, hrefLang)">\n              {{ (\'NAVIGATION.\' + child.name) | translate }}\n            </a>\n          </li>\n        </ul>\n      </div>\n    </div>\n  </nav>\n</div>\n'
    },
    "./src/app/main-navigation/main-navigation.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return f
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/modal/login/login.component.ts"),
            o = n("./src/app/_services/modal.service.ts"),
            s = n("./src/app/_services/locale.service.ts"),
            i = n("./src/app/_services/config.service.ts"),
            c = n("./src/app/modal/register/register.component.ts"),
            l = n("./src/app/modal/set-language/set-language.component.ts"),
            d = n("./src/app/_services/cookie.service.ts"),
            p = n("./node_modules/@angular/common/esm5/common.js"),
            h = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            u = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            v = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            };
        n("./src/frontend/containers/MainNavigation/MainNavigation.scss");
        var f = function() {
            function e(e, t, a, r, o) {
                var s = this;
                this.modalService = e, this.localeService = t, this.config = a, this.platformId = r, this.cookieService = o, this.forceCollapsed = !1, this.collapsed = !1, this.mobileNavbarOpen = !1, this.cookiesAccepted = !1, this.navbarChildren = {
                    categoryName: void 0,
                    svgClassName: void 0,
                    children: void 0
                }, this.desktopNavigation = [{
                    name: "Game",
                    children: [{ name: "Play-style", url: ["game", "playstyle"] }, {
                        name: "Player interaction",
                        url: ["game", "playerinteraction"]
                    }, { name: "Build empire", url: ["game", "buildempire"] }, {
                        name: "Battle",
                        url: ["game", "battle"]
                    }, { name: "Late game", url: ["game", "lategame"] }]
                }], this.navigation = [{
                    name: "Game",
                    className: "game",
                    svgClassName: "game",
                    children: [{ name: "Play-style", url: ["game", "playstyle"] }, {
                        name: "Player interaction",
                        url: ["game", "playerinteraction"]
                    }, { name: "Build empire", url: ["game", "buildempire"] }, {
                        name: "Battle",
                        url: ["game", "battle"]
                    }, { name: "Late game", url: ["game", "lategame"] }]
                }], this.logo = null, this.hrefLang = this.localeService.data.hrefLang, this.flagSvg = n("./src/frontend/components/Flag recursive ^\\.\\/.*\\.svg$")("./" + this.localeService.data.flag + ".svg"), this.localeService.dataChanged.subscribe(function(e) {
                    s.hrefLang = e.hrefLang, s.flagSvg = n("./src/frontend/components/Flag recursive ^\\.\\/.*\\.svg$")("./" + e.flag + ".svg")
                });
                "turbotra" === this.config.getProperty("globalCssClass").toLowerCase() ? this.logo = n("./src/frontend/containers/MainNavigation/turbotra_white.svg") : this.logo = n("./src/frontend/containers/MainNavigation/logoLegends_white.svg"), Object(p.isPlatformServer)(this.platformId) && (this.cookiesAccepted = !0)
            }

            return e.prototype.onScroll = function(e) {
                var t = e.target || e.srcElement || e.currentTarget;
                this.collapsed = this.forceCollapsed || t.documentElement.scrollTop > 400
            }, e.prototype.acceptCookies = function() {
                this.cookieService.set("accepted-cookies", "true", 31536e6), this.cookiesAccepted = !0
            }, e.prototype.buildRouteLink = function(e, t) {
                var n = [];
                return Object.assign(n, e), n.unshift("/" + t), n
            }, e.prototype.open = function(e, t) {
                return "login" === e ? this.modalService.open(r.a) : "register" === e ? this.modalService.open(c.a) : "setLanguage" === e && this.modalService.open(l.a), !0
            }, e.prototype.closeIfOpen = function(e) {
                void 0 === e && (e = !1), this.mobileNavbarOpen && (e || (this.mobileNavbarOpen = !1), this.navbarChildren = {
                    categoryName: void 0,
                    svgClassName: void 0,
                    children: void 0
                })
            }, e.prototype.expand = function(e) {
                this.navbarChildren = { categoryName: e.name, svgClassName: e.svgClassName, children: e.children }
            }, e.prototype.ngOnInit = function() {
                "true" === this.cookieService.get("accepted-cookies") && (this.cookiesAccepted = !0), this.forceCollapsed && (this.collapsed = !0)
            }, h([Object(a.Input)("forceCollapsed"), u("design:type", Object)], e.prototype, "forceCollapsed", void 0), h([Object(a.HostListener)("document:scroll", ["$event", "$event.target"]), u("design:type", Function), u("design:paramtypes", [Object]), u("design:returntype", void 0)], e.prototype, "onScroll", null), e = h([Object(a.Component)({
                selector: "app-main-navigation",
                template: n("./src/app/main-navigation/main-navigation.component.html")
            }), v(3, Object(a.Inject)(a.PLATFORM_ID)), u("design:paramtypes", [o.a, s.a, i.a, Object, d.a])], e)
        }()
    },
    "./src/app/modal/activation/activation.component.html": function(e, t) {
        e.exports = '<app-modal [title]="\'ACTIVATION.activateAccount\' | translate" [modalId]="\'Activation\'" [zIndex]="zIndex"\r\n           [destroy]="destroy">\r\n  <div *ngIf="loaded">\r\n    <div *ngIf="error !== null && error.length > 0">\r\n      <p><span [translate]="error"></span></p>\r\n    </div>\r\n    <ng-template [ngIf]="error === null || error.length <= 0">\r\n      <div class="activationInfo">\r\n        <span *ngIf="data.activationCode === null">{{ \'ACTIVATION.weHaveSentAnEmailContainingActivationCode\' | translate:{gameWorld: data.server} }}</span>\r\n        <span *ngIf="data.activationCode !== null">{{ \'ACTIVATION.WeveRecievedYourActivationKey\' | translate:{gameWorld: data.server} }}</span>\r\n      </div>\r\n      <form [formGroup]="activationForm" (submit)="activationSubmit()">\r\n        <label [style.display]="data.activationCode === null ? \'\' : \'none\'" class="textField invalid"\r\n               for="activationCode"\r\n        >\r\n          <input type="text" name="activationCode" formControlName="activationCode"\r\n                 autocomplete="section-activation off"\r\n                 (blur)="reValidate()" (focus)="reValidate()"\r\n                 [ngClass]="{\'pinLabel\': activationForm.get(\'activationCode\').value != null && activationForm.get(\'activationCode\').value.length > 0}"\r\n          >\r\n          <div class="label"><span translate="ACTIVATION.ActivationCode"></span></div>\r\n          <div class="validation">\r\n            <form-validation-error\r\n              [valid]="activationForm.get(\'activationCode\').valid"\r\n              [errors]="activationForm.get(\'activationCode\').errors"\r\n              [touched]="activationForm.get(\'activationCode\').touched"\r\n            ></form-validation-error>\r\n          </div>\r\n        </label>\r\n        <label class="textField invalid" for="password">\r\n          <input type="password" formControlName="password" name="password"\r\n                 (blur)="reValidate()" (focus)="reValidate()"\r\n                 [ngClass]="{\'pinLabel\': activationForm.get(\'password\').value != null && activationForm.get(\'password\').value.length > 0}"\r\n          >\r\n          <div class="label"><span [translate]="\'LOGIN.PASSWORD\'"></span></div>\r\n          <div class="validation">\r\n            <form-validation-error\r\n              [valid]="activationForm.get(\'password\').valid"\r\n              [errors]="activationForm.get(\'password\').errors"\r\n              [touched]="activationForm.get(\'password\').touched"\r\n            ></form-validation-error>\r\n          </div>\r\n        </label>\r\n        <div id="gCaptchaContainer">\r\n          <re-captcha #captchaRef="reCaptcha" [formControlName]="\'captcha\'"></re-captcha>\r\n        </div>\r\n        <label class="textField invalid captcha" for="captcha">\r\n          <div class="validation">\r\n            <form-validation-error\r\n              [valid]="activationForm.get(\'captcha\').valid"\r\n              [errors]="activationForm.get(\'captcha\').errors"\r\n              [touched]="activationForm.get(\'captcha\').touched"\r\n            ></form-validation-error>\r\n          </div>\r\n        </label>\r\n        <div style="clear: both; float: none;"></div>\r\n        <button [disabled]="ajaxLoading" type="submit" class="button default">\r\n          <span [translate]="\'ACTIVATION.activateAnaPlay\'"></span>\r\n          <div *ngIf="ajaxLoading" class="buttonAjaxLoader"></div>\r\n        </button>\r\n      </form>\r\n      <br/>\r\n      <div class="linkWrapper"><a (click)="openResendMail();" [title]="\'ACTIVATION.IDidNotReceiveAnEmail\' | translate" translate="ACTIVATION.IDidNotReceiveAnEmail"></a></div>\r\n    </ng-template>\r\n  </div>\r\n  <div *ngIf="!loaded">\r\n    {{ \'Loading...\' | translate }}\r\n  </div>\r\n</app-modal>\r\n'
    },
    "./src/app/modal/activation/activation.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return y
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/modal/modal-interface.ts"),
            o = n("./node_modules/@angular/forms/esm5/forms.js"),
            s = n("./src/app/formValidators/passwordValidator.ts"),
            i = n("./src/app/_services/api.service.ts"),
            c = n("./src/app/formValidators/functions.ts"),
            l = n("./src/app/formValidators/recaptchaValidator.ts"),
            d = n("./src/app/formValidators/activationCodeValidator.ts"),
            p = n("./src/app/_services/login.service.ts"),
            h = n("./node_modules/@angular/common/esm5/common.js"),
            u = n("./src/app/_services/modal.service.ts"),
            v = n("./src/app/modal/noMail/noMail.component.ts"),
            f = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            m = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            g = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            E = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            };
        n("./src/frontend/containers/Registration/Activation.scss");
        var y = function(e) {
            function t(t, n, a, r) {
                var o = e.call(this) || this;
                return o.api = t, o.modalService = n, o.loginService = a, o.document = r, o.loaded = !1, o.ajaxLoading = !1, o.error = null, o
            }

            return f(t, e), t.prototype.reValidate = function() {
                this.activationForm.get("activationCode").updateValueAndValidity(), this.activationForm.get("password").updateValueAndValidity()
            }, t.prototype.ngOnInit = function() {
                var e = this;
                this.activationForm = new o.b({
                    activationCode: new o.a(null, [o.f.required, d.a]),
                    password: new o.a(null, [o.f.required, s.a]),
                    captcha: new o.a(null, [l.a])
                }), this.api.loadServerByWID(this.data.server).subscribe(function(t) {
                    t.success ? (e.data.serverId = t.gameWorld.id, null !== e.data.activationCode ? e.api.validateActivationCode(t.gameWorld.id, e.data.activationCode).subscribe(function(t) {
                        t.success ? e.activationForm.get("activationCode").patchValue(e.data.activationCode) : e.error = "ACTIVATION.couldNotProcessActivationCode", e.loaded = !0
                    }) : e.loaded = !0) : (e.error = "ACTIVATION.UnknownOrInvalidGameWorld", e.loaded = !0)
                })
            }, t.prototype.openResendMail = function() {
                this.destroy(), this.modalService.open(v.a, {
                    data: {
                        server: this.data.server,
                        serverId: this.data.serverId
                    }
                })
            }, t.prototype.activationSubmit = function() {
                var e = this;
                this.activationForm.valid ? (this.ajaxLoading = !0, this.api.activate(this.data.serverId, this.activationForm.get("activationCode").value, this.activationForm.get("password").value, this.activationForm.get("captcha").value).subscribe(function(t) {
                    t.success ? t.redirect && (e.loginService.setLastGameWorld(e.data.serverId), e.document.location.assign(t.redirect)) : (t.fields.activationCode && (e.data.activationCode = null, e.activationForm.get("activationCode").markAsTouched(), e.activationForm.get("activationCode").setErrors((n = {}, n[t.fields.activationCode] = !0, n))), t.fields.password && e.activationForm.get("password").setErrors((a = {}, a[t.fields.password] = !0, a)), t.fields.captcha && (e.captchaRef.reset(), e.activationForm.get("captcha").setErrors((r = {}, r[t.fields.captcha] = !0, r)))), e.ajaxLoading = !1;
                    var n, a, r
                })) : Object(c.a)(this.activationForm)
            }, m([Object(a.ViewChild)("captchaRef"), g("design:type", Object)], t.prototype, "captchaRef", void 0), t = m([Object(a.Component)({ template: n("./src/app/modal/activation/activation.component.html") }), E(3, Object(a.Inject)(h.DOCUMENT)), g("design:paramtypes", [i.a, u.a, p.a, Object])], t)
        }(r.a)
    },
    "./src/app/modal/forgot-game-world/forgot-game-world.component.html": function(e, t) {
        e.exports = '<app-modal [title]="\'FORGOT_GAME_WORLD.ForgotGameWorld\' | translate" [modalId]="\'ForgotGameworld\'" [zIndex]="zIndex"\r\n           [destroy]="destroy">\r\n  <img [src]="world_bar_image.src" alt="Game world bar" [srcset]="world_bar_image.srcset | buildSourceSet">\r\n  <ng-template [ngIf]="!success">\r\n    <div class="gameworldInfo">\r\n      <span translate="FORGOT_GAME_WORLD.enterYourEmailAddressAndWeAllSend"></span>\r\n    </div>\r\n    <form [formGroup]="forgotGameWorldForm" (submit)="forgotGameWorldSubmit()">\r\n      <label class="textField invalid" for="email">\r\n        <input type="text"\r\n               formControlName="email"\r\n               name="email"\r\n               (blur)="reValidate()" (focus)="reValidate()"\r\n               [ngClass]="{\'pinLabel\': forgotGameWorldForm.get(\'email\').value != null && forgotGameWorldForm.get(\'email\').value.length > 0}"\r\n        >\r\n        <div class="label"><span translate="FORGOT_GAME_WORLD.Email"></span></div>\r\n        <div class="validation">\r\n          <form-validation-error\r\n            [valid]="forgotGameWorldForm.get(\'email\').valid"\r\n            [errors]="forgotGameWorldForm.get(\'email\').errors"\r\n            [touched]="forgotGameWorldForm.get(\'email\').touched"\r\n          ></form-validation-error>\r\n        </div>\r\n      </label>\r\n      <ng-template [ngIf]="reCaptchaRequired">\r\n        <div id="gCaptchaContainer">\r\n          <re-captcha #captchaRef="reCaptcha" [formControlName]="\'captcha\'"></re-captcha>\r\n        </div>\r\n        <label class="textField invalid captcha" for="captcha">\r\n          <div class="validation">\r\n            <form-validation-error\r\n              [valid]="loginForm.get(\'captcha\').valid"\r\n              [errors]="loginForm.get(\'captcha\').errors"\r\n              [touched]="loginForm.get(\'captcha\').touched"\r\n            ></form-validation-error>\r\n          </div>\r\n        </label>\r\n        <div style="clear: both; float: none;"></div>\r\n      </ng-template>\r\n      <button [disabled]="ajaxLoading" type="submit" class="button default">\r\n        <span translate="FORGOT_GAME_WORLD.requestGameWorlds"></span>\r\n        <div *ngIf="ajaxLoading" class="buttonAjaxLoader"></div>\r\n      </button>\r\n    </form>\r\n  </ng-template>\r\n  <ng-template [ngIf]="success">\r\n    <div class="gameworldInfo">\r\n      <p>\r\n        <span translate="FORGOT_GAME_WORLD.WeHaveSentAListOfAssociatedAccountsToEnteredEmailAddress"></span>\r\n      </p>\r\n    </div>\r\n  </ng-template>\r\n</app-modal>\r\n'
    },
    "./src/app/modal/forgot-game-world/forgot-game-world.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return v
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/modal/modal-interface.ts"),
            o = n("./src/app/_services/locale.service.ts"),
            s = n("./node_modules/@angular/forms/esm5/forms.js"),
            i = n("./src/app/formValidators/functions.ts"),
            c = n("./src/app/_services/api.service.ts"),
            l = n("./src/app/formValidators/recaptchaValidator.ts"),
            d = n("./src/app/formValidators/emailValidator.ts"),
            p = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            h = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            u = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            };
        n("./src/frontend/containers/Login/ForgotGameWorld.scss");
        var v = function(e) {
            function t(t, a) {
                var r = e.call(this) || this;
                return r.localeService = t, r.api = a, r.world_bar_image = {
                    src: "",
                    srcset: {}
                }, r.world_bar_images = {
                    ltr: {
                        src: n("./src/frontend/components/WorldBar/img/ltr/worldDefault_button_1x.jpg"),
                        srcset: {
                            "1x": n("./src/frontend/components/WorldBar/img/ltr/worldDefault_button_1x.jpg"),
                            "2x": n("./src/frontend/components/WorldBar/img/ltr/worldDefault_button_2x.jpg")
                        }
                    },
                    rtl: {
                        src: n("./src/frontend/components/WorldBar/img/rtl/worldDefault_button_1x.jpg"),
                        srcset: {
                            "1x": n("./src/frontend/components/WorldBar/img/rtl/worldDefault_button_1x.jpg"),
                            "2x": n("./src/frontend/components/WorldBar/img/rtl/worldDefault_button_2x.jpg")
                        }
                    }
                }, r.reCaptchaRequired = !1, r.ajaxLoading = !1, r.success = !1, r
            }

            return p(t, e), t.prototype.reValidate = function() {
                this.forgotGameWorldForm.get("email").updateValueAndValidity()
            }, t.prototype.ngOnInit = function() {
                var e = this;
                this.world_bar_image = this.world_bar_images[this.localeService.data.direction], this.localeService.dataChanged.subscribe(function() {
                    e.world_bar_image = e.world_bar_images[e.localeService.data.direction]
                }), this.forgotGameWorldForm = new s.b({
                    email: new s.a(null, [s.f.required, d.a]),
                    captcha: new s.a(null)
                })
            }, t.prototype.forgotGameWorldSubmit = function() {
                var e = this;
                this.forgotGameWorldForm.valid ? (this.ajaxLoading = !0, this.api.forgotGameWorld(this.gameWorldId, this.forgotGameWorldForm.get("email").value, this.forgotGameWorldForm.get("captcha").value).subscribe(function(t) {
                    t.success ? e.success = !0 : t.fields && (t.fields.email && e.forgotGameWorldForm.get("email").setErrors((n = {}, n[t.fields.email] = !0, n)), t.fields.captcha && (e.reCaptchaRequired ? e.captchaRef.reset() : (e.reCaptchaRequired = !0, e.forgotGameWorldForm.get("captcha").setValidators([l.a])), e.forgotGameWorldForm.get("captcha").setErrors((a = {}, a[t.fields.captcha] = !0, a)))), e.ajaxLoading = !1;
                    var n, a
                })) : Object(i.a)(this.forgotGameWorldForm)
            }, h([Object(a.ViewChild)("captchaRef"), u("design:type", Object)], t.prototype, "captchaRef", void 0), t = h([Object(a.Component)({ template: n("./src/app/modal/forgot-game-world/forgot-game-world.component.html") }), u("design:paramtypes", [o.a, c.a])], t)
        }(r.a)
    },
    "./src/app/modal/forgot-password/forgot-password.component.html": function(e, t) {
        e.exports = '<app-modal [title]="\'FORGOT_PASSWORD.ForgotPassword\' | translate" [modalId]="\'ForgotPassword\'" [zIndex]="zIndex"\r\n           [destroy]="destroy">\r\n  <img [src]="world_bar_image.src" alt="Game world bar" [srcset]="world_bar_image.srcset | buildSourceSet">\r\n  <ng-template [ngIf]="!success">\r\n    <div class="passwordInfo">\r\n      <span translate="FORGOT_PASSWORD.WeWillSendAnEmail"></span>\r\n    </div>\r\n    <form [formGroup]="forgotPasswordForm" (submit)="forgotPasswordSubmit()">\r\n      <label class="textField invalid" for="email">\r\n        <input type="text"\r\n               formControlName="email"\r\n               name="email"\r\n               (blur)="reValidate()" (focus)="reValidate()"\r\n               [ngClass]="{\'pinLabel\': forgotPasswordForm.get(\'email\').value != null && forgotPasswordForm.get(\'email\').value.length > 0}"\r\n        >\r\n        <div class="label"><span translate="FORGOT_PASSWORD.Email"></span></div>\r\n        <div class="validation">\r\n          <form-validation-error\r\n            [valid]="forgotPasswordForm.get(\'email\').valid"\r\n            [errors]="forgotPasswordForm.get(\'email\').errors"\r\n            [touched]="forgotPasswordForm.get(\'email\').touched"\r\n          ></form-validation-error>\r\n        </div>\r\n      </label>\r\n      <ng-template [ngIf]="reCaptchaRequired">\r\n        <div id="gCaptchaContainer">\r\n          <re-captcha #captchaRef="reCaptcha" [formControlName]="\'captcha\'"></re-captcha>\r\n        </div>\r\n        <label class="textField invalid captcha" for="captcha">\r\n          <div class="validation">\r\n            <form-validation-error\r\n              [valid]="loginForm.get(\'captcha\').valid"\r\n              [errors]="loginForm.get(\'captcha\').errors"\r\n              [touched]="loginForm.get(\'captcha\').touched"\r\n            ></form-validation-error>\r\n          </div>\r\n        </label>\r\n        <div style="clear: both; float: none;"></div>\r\n      </ng-template>\r\n      <button [disabled]="ajaxLoading" type="submit" class="button default">\r\n        <span translate="FORGOT_PASSWORD.RecoverPassword"></span>\r\n        <div *ngIf="ajaxLoading" class="buttonAjaxLoader"></div>\r\n      </button>\r\n    </form>\r\n  </ng-template>\r\n  <ng-template [ngIf]="success">\r\n    <div class="passwordInfo"><p><span translate="FORGOT_PASSWORD.RequestReceived"></span></p><p><span translate="FORGOT_PASSWORD.emailWillBeSend"></span></p></div>\r\n  </ng-template>\r\n</app-modal>\r\n'
    },
    "./src/app/modal/forgot-password/forgot-password.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return v
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/modal/modal-interface.ts"),
            o = n("./src/app/_services/locale.service.ts"),
            s = n("./node_modules/@angular/forms/esm5/forms.js"),
            i = n("./src/app/formValidators/functions.ts"),
            c = n("./src/app/_services/api.service.ts"),
            l = n("./src/app/formValidators/recaptchaValidator.ts"),
            d = n("./src/app/formValidators/emailValidator.ts"),
            p = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            h = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            u = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            };
        n("./src/frontend/containers/Login/ForgotPassword.scss");
        var v = function(e) {
            function t(t, a) {
                var r = e.call(this) || this;
                return r.localeService = t, r.api = a, r.world_bar_image = {
                    src: "",
                    srcset: {}
                }, r.world_bar_images = {
                    ltr: {
                        src: n("./src/frontend/components/WorldBar/img/ltr/worldDefault_button_1x.jpg"),
                        srcset: {
                            "1x": n("./src/frontend/components/WorldBar/img/ltr/worldDefault_button_1x.jpg"),
                            "2x": n("./src/frontend/components/WorldBar/img/ltr/worldDefault_button_2x.jpg")
                        }
                    },
                    rtl: {
                        src: n("./src/frontend/components/WorldBar/img/rtl/worldDefault_button_1x.jpg"),
                        srcset: {
                            "1x": n("./src/frontend/components/WorldBar/img/rtl/worldDefault_button_1x.jpg"),
                            "2x": n("./src/frontend/components/WorldBar/img/rtl/worldDefault_button_2x.jpg")
                        }
                    }
                }, r.reCaptchaRequired = !1, r.ajaxLoading = !1, r.success = !1, r
            }

            return p(t, e), t.prototype.reValidate = function() {
                this.forgotPasswordForm.get("email").updateValueAndValidity()
            }, t.prototype.ngOnInit = function() {
                var e = this;
                this.world_bar_image = this.world_bar_images[this.localeService.data.direction], this.localeService.dataChanged.subscribe(function() {
                    e.world_bar_image = e.world_bar_images[e.localeService.data.direction]
                }), this.forgotPasswordForm = new s.b({
                    email: new s.a(null, [s.f.required, d.a]),
                    captcha: new s.a(null)
                })
            }, t.prototype.forgotPasswordSubmit = function() {
                var e = this;
                this.forgotPasswordForm.valid ? (this.ajaxLoading = !0, this.api.forgotPassword(this.gameWorldId, this.forgotPasswordForm.get("email").value, this.forgotPasswordForm.get("captcha").value).subscribe(function(t) {
                    t.success ? e.success = !0 : t.fields && (t.fields.email && e.forgotPasswordForm.get("email").setErrors((n = {}, n[t.fields.email] = !0, n)), t.fields.captcha && (e.reCaptchaRequired ? e.captchaRef.reset() : (e.reCaptchaRequired = !0, e.forgotPasswordForm.get("captcha").setValidators([l.a])), e.forgotPasswordForm.get("captcha").setErrors((a = {}, a[t.fields.captcha] = !0, a)))), e.ajaxLoading = !1;
                    var n, a
                })) : Object(i.a)(this.forgotPasswordForm)
            }, h([Object(a.ViewChild)("captchaRef"), u("design:type", Object)], t.prototype, "captchaRef", void 0), t = h([Object(a.Component)({ template: n("./src/app/modal/forgot-password/forgot-password.component.html") }), u("design:paramtypes", [o.a, c.a])], t)
        }(r.a)
    },
    "./src/app/modal/login/login.component.html": function(e, t) {
        e.exports = '<app-modal [title]="(chosen_server == null ? \'LOGIN.CHOOSE_GAME_WORLD\' : \'LOGIN.LOGIN_TO_PLAY\') | translate"\r\n           [modalId]="\'Login\'" [zIndex]="zIndex" [destroy]="destroy">\r\n  <ng-template [ngIf]="loaded" [ngIfElse]="loading">\r\n    <ng-template [ngIf]="gameWorldsCount == 0" [ngIfElse]="login">\r\n      <p><span [translate]="\'LOGIN.THERE_ARE_NO_GAME_WORLDS_FOR_LOGIN\'"></span></p>\r\n    </ng-template>\r\n    <ng-template #login>\r\n      <ng-template [ngIf]="chosen_server !== null">\r\n        <div class="registrationWrapper front">\r\n          \x3c!-- game world --\x3e\r\n          <game-world (click)="changeGameWorld()" [server]="chosen_server"></game-world>\r\n          <div class="linkWrapper">\r\n            <a class="change" (click)="changeGameWorld()"\r\n               [title]="\'LOGIN.CHANGE_GAME_WORLD\' | translate"\r\n               [translate]="\'LOGIN.CHANGE_GAME_WORLD\'"></a>\r\n            <div class="changeInfo" *ngIf="clickOnChangeGameWorldCount > 0 && gameWorldsCount == 1">\r\n              <speech-bubble [invalid]="\'NO_MORE_SERVERS\' | translate" [showIcon]="false"></speech-bubble>\r\n            </div>\r\n          </div>\r\n          <form [formGroup]="loginForm" (submit)="loginAndPlay()">\r\n            <div formGroupName="credentialsForm">\r\n              <label class="textField invalid" for="usernameOrEmail">\r\n                <input\r\n                  type="text" name="usernameOrEmail" formControlName="usernameOrEmail"\r\n                  (blur)="reValidate()" (focus)="reValidate()"\r\n                  [ngClass]="{\'pinLabel\': loginForm.get(\'credentialsForm.usernameOrEmail\').value != null && loginForm.get(\'credentialsForm.usernameOrEmail\').value.length > 0}"\r\n                >\r\n                <div class="label"><span [translate]="\'LOGIN.USERNAME_OR_EMAIL\'"></span></div>\r\n                <div class="validation">\r\n                  <form-validation-error\r\n                    [valid]="loginForm.get(\'credentialsForm.usernameOrEmail\').valid"\r\n                    [errors]="loginForm.get(\'credentialsForm.usernameOrEmail\').errors"\r\n                    [touched]="loginForm.get(\'credentialsForm.usernameOrEmail\').touched"\r\n                  ></form-validation-error>\r\n                </div>\r\n              </label>\r\n              <label class="textField invalid" for="password">\r\n                <input type="password" formControlName="password" name="password"\r\n                       (blur)="reValidate()" (focus)="reValidate()"\r\n                       [ngClass]="{\'pinLabel\': loginForm.get(\'credentialsForm.password\').value != null && loginForm.get(\'credentialsForm.password\').value.length > 0}"\r\n                >\r\n                <div class="label"><span [translate]="\'LOGIN.PASSWORD\'"></span></div>\r\n                <div class="validation">\r\n                  <form-validation-error\r\n                    [valid]="loginForm.get(\'credentialsForm.password\').valid"\r\n                    [errors]="loginForm.get(\'credentialsForm.password\').errors"\r\n                    [touched]="loginForm.get(\'credentialsForm.password\').touched"\r\n                  ></form-validation-error>\r\n                </div>\r\n              </label>\r\n            </div>\r\n            <label class="checkbox ">\r\n              <input type="checkbox" value="on" formControlName="lowRes">\r\n              <svg class="checkbox" viewBox="0 0 20 20">\r\n                <rect x="0.5" y="0.5" width="19" height="19" rx="2.5" ry="2.5"></rect>\r\n              </svg>\r\n              <svg class="checkmark" viewBox="-1 -1 20 20">\r\n                <path d="M0.3,8.5c0,0,5,4.4,6.3,8.1c1.9-8.8,7.7-16.3,7.7-16.3"></path>\r\n              </svg>\r\n              <div class="label inline">\r\n                                           <span class="lowResLabel">\r\n                                           <span [translate]="\'LOGIN.LOW_RES_MODE\'"></span>\r\n                                           <br>\r\n                                           <small [translate]="\'LOGIN.LOW_RES_MODE_DESC\'"></small>\r\n                                        </span>\r\n              </div>\r\n            </label>\r\n            <ng-template [ngIf]="reCaptchaRequired">\r\n              <div id="gCaptchaContainer">\r\n                <re-captcha #captchaRef="reCaptcha" [formControlName]="\'captcha\'"></re-captcha>\r\n              </div>\r\n              <label class="textField invalid captcha" for="captcha">\r\n                <div class="validation">\r\n                  <form-validation-error\r\n                    [valid]="loginForm.get(\'captcha\').valid"\r\n                    [errors]="loginForm.get(\'captcha\').errors"\r\n                    [touched]="loginForm.get(\'captcha\').touched"\r\n                  ></form-validation-error>\r\n                </div>\r\n              </label>\r\n              <div style="clear: both; float: none;"></div>\r\n            </ng-template>\r\n            <button [disabled]="ajaxLoading" type="submit" class="button default">\r\n              <span [translate]="\'LOGIN.LOGIN_AND_PLAY\'"></span>\r\n              <div *ngIf="ajaxLoading" class="buttonAjaxLoader"></div>\r\n            </button>\r\n          </form>\r\n          <br>\r\n          <div class="linkWrapper">\r\n            <a (click)="openForgotMyPassword(chosen_server.id)">\r\n              <span [translate]="\'LOGIN.I_FORGOT_MY_PASSWORD\'"></span>\r\n            </a>\r\n          </div>\r\n        </div>\r\n      </ng-template>\r\n      <ng-template [ngIf]="chosen_server === null">\r\n        <div class="worldSelection shown">\r\n          <div class="transformWrapper">\r\n            <div *ngIf="knownGameWorlds.length>0" class="worldGroup">\r\n              <h4>\r\n                <span [translate]="\'LOGIN.YOU_HAVE_PLAYED_ON\'"></span>\r\n              </h4>\r\n              <game-world *ngFor="let server of knownGameWorlds" (chosen)="chosen_server = server"\r\n                          [server]="server"></game-world>\r\n            </div>\r\n            <div class="worldGroup">\r\n                <h4 *ngIf="knownGameWorlds.length>0"><span [translate]="\'LOGIN.OTHER_GAME_WORLDS\'"></span></h4>\r\n\r\n              <game-world *ngFor="let server of gameWorlds" (chosen)="chosen_server = server"\r\n                          [server]="server"></game-world>\r\n            </div>\r\n            <div class="linkWrapper">\r\n              <a (click)="openForgotMyGameWorld();"><span [translate]="\'LOGIN.I_FORGOT_MY_GAMEWORLD\'"></span></a>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </ng-template>\r\n    </ng-template>\r\n  </ng-template>\r\n  <ng-template #loading>\r\n    {{ \'Loading...\' | translate }}\r\n  </ng-template>\r\n</app-modal>\r\n'
    },
    "./src/app/modal/login/login.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return M
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/modal/modal-interface.ts"),
            o = n("./src/app/_services/login.service.ts"),
            s = n("./node_modules/rxjs/_esm5/observable/IntervalObservable.js"),
            i = n("./src/app/_services/modal.service.ts"),
            c = n("./src/app/modal/forgot-game-world/forgot-game-world.ts"),
            l = n("./src/app/modal/forgot-password/forgot-password.ts"),
            d = n("./node_modules/@angular/forms/esm5/forms.js"),
            p = n("./src/app/formValidators/usernameValidator.ts"),
            h = n("./src/app/formValidators/recaptchaValidator.ts"),
            u = n("./src/app/formValidators/functions.ts"),
            v = n("./node_modules/@angular/common/esm5/common.js"),
            f = n("./src/app/formValidators/passwordValidator.ts"),
            m = n("./src/app/_services/config.service.ts"),
            g = n("./src/app/_services/cookie.service.ts"),
            E = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            y = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            _ = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            b = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            };
        n("./src/frontend/containers/Login/Login.scss");
        var M = function(e) {
            function t(t, n, a, r, o) {
                var s = e.call(this) || this;
                return s.document = t, s.loginService = n, s.configService = a, s.cookieService = r, s.modalService = o, s.gameWorlds = [], s.knownGameWorlds = [], s.chosen_server = null, s.loaded = !1, s.gameWorldsCount = 0, s.reCaptchaRequired = !1, s.ajaxLoading = !1, s.manuallyChosenGameWorldId = null, s.clickOnChangeGameWorldCount = 0, s
            }

            return E(t, e), t.prototype.reValidate = function() {
                this.loginForm.get("credentialsForm.usernameOrEmail").updateValueAndValidity(), this.loginForm.get("credentialsForm.password").updateValueAndValidity()
            }, t.prototype.ngOnInit = function() {
                var e = this;
                this.loginForm = new d.b({
                    credentialsForm: new d.b({
                        usernameOrEmail: new d.a(null, { validators: [d.f.required, p.a] }),
                        password: new d.a(null, { validators: [d.f.required, f.a] })
                    }),
                    lowRes: new d.a(!1),
                    captcha: new d.a(null)
                }), this.loginForm.get("credentialsForm.usernameOrEmail").valueChanges.subscribe(function() {
                    e.loginForm.get("credentialsForm.password").updateValueAndValidity()
                }), this.loginService.getGameWorlds().subscribe(function(t) {
                    e.populateGameWorlds(t, !0), e.manuallyChosenGameWorldId && (e.chosen_server && e.chosen_server.name === e.manuallyChosenGameWorldId || e.gameWorlds.forEach(function(t) {
                        e.manuallyChosenGameWorldId === t.name && (e.chosen_server = t)
                    }))
                }), this.timer = s.a.create(3e5).subscribe(function() {
                    e.loginService.getGameWorlds().subscribe(function(t) {
                        return e.populateGameWorlds(t)
                    })
                })
            }, t.prototype.changeGameWorld = function() {
                this.clickOnChangeGameWorldCount++, this.gameWorldsCount > 1 && (this.chosen_server = null)
            }, t.prototype.populateGameWorlds = function(e, t) {
                var n = this;
                void 0 === t && (t = !1), this.loaded = !1, this.gameWorldsCount = 0, this.gameWorlds = [], this.knownGameWorlds = [];
                var a = this.loginService.getLastGameWorldId();
                this.gameWorldsCount = 0;
                var r = "1" === this.cookieService.get("developerIncluded");
                e.gameWorlds.forEach(function(e) {
                    e.hidden && !r || !n.configService.getProperty("showLoginAfterServerFinished") && e.finished || (a === e.id ? (t && (n.chosen_server = e), n.knownGameWorlds.push(e)) : n.gameWorlds.push(e), ++n.gameWorldsCount)
                }), 1 === this.gameWorldsCount && (this.chosen_server = this.gameWorlds[0]), this.gameWorlds.sort(function(e, t) {
                    return e.start > t.start ? -1 : e.start < t.start ? 1 : 0
                }), this.loaded = !0
            }, t.prototype.loginAndPlay = function() {
                var e = this;
                this.loginForm.valid ? (this.ajaxLoading = !0, this.loginService.login(this.chosen_server.id, this.loginForm.get("credentialsForm.usernameOrEmail").value, this.loginForm.get("credentialsForm.password").value, this.loginForm.get("lowRes").value, this.loginForm.get("captcha").value).subscribe(function(t) {
                    t.fields && (t.fields.usernameOrEmail && e.loginForm.get("credentialsForm.usernameOrEmail").setErrors((n = {}, n[t.fields.usernameOrEmail] = !0, n)), t.fields.password && (e.loginForm.get("credentialsForm.password").setErrors((a = {}, a[t.fields.password] = !0, a)), e.reCaptchaRequired && e.captchaRef && e.captchaRef.reset()), t.fields.captcha && (e.reCaptchaRequired ? e.captchaRef.reset() : (e.reCaptchaRequired = !0, e.loginForm.get("captcha").setValidators([h.a])), e.loginForm.get("captcha").setErrors((r = {}, r[t.fields.captcha] = !0, r)))), t.redirect ? (e.loginService.setLastGameWorld(e.chosen_server.id), e.document.location.assign(t.redirect)) : e.reCaptchaRequired && e.loginForm.get("captcha").updateValueAndValidity(), e.ajaxLoading = !1;
                    var n, a, r
                })) : Object(u.a)(this.loginForm)
            }, t.prototype.openForgotMyGameWorld = function() {
                this.destroy(), this.modalService.open(c.a)
            }, t.prototype.openForgotMyPassword = function(e) {
                this.destroy(), this.modalService.open(l.a, { gameWorldId: e })
            }, t.prototype.ngOnDestroy = function() {
                this.chosen_server = null, this.gameWorlds = [], this.knownGameWorlds = [], this.timer.unsubscribe()
            }, y([Object(a.ViewChild)("captchaRef"), _("design:type", Object)], t.prototype, "captchaRef", void 0), t = y([Object(a.Component)({ template: n("./src/app/modal/login/login.component.html") }), b(0, Object(a.Inject)(v.DOCUMENT)), _("design:paramtypes", [Object, o.a, m.a, g.a, i.a])], t)
        }(r.a)
    },
    "./src/app/modal/modal-container/modal-container.component.html": function(e, t) {
        e.exports = '<div id="overlay" class="Modal" role="presentation" [style.z-index]="zIndex">\r\n    <div (click)="destroy();" class="mobileCloseButton" role="presentation">\r\n        <svg viewBox="-6 -6 20 20" class="modalClose">\r\n            <path d="M2,18.4c6-12.3,14.4-18,14.4-18" transform="scale(.5)"></path>\r\n            <path d="M0.2,2.2C8.8,7,16.1,16.7,16.1,16.7" transform="scale(.5)"></path>\r\n        </svg>\r\n    </div>\r\n    <div id="{{ modalId }}" (clickOutside)="clickOutSide($event);">\r\n        <div class="box default">\r\n            <div class="boxTitle">\r\n                <svg>\r\n                    <defs>\r\n                        <filter class="filter" id="blurMe">\r\n                            <feGaussianBlur in="SourceGraphic" stdDeviation="2"></feGaussianBlur>\r\n                        </filter>\r\n                        <linearGradient id="gradient" x1="0" x2="0" y1="0" y2="1">\r\n                            <stop offset="0%" style="stop-color: rgb(73, 34, 8);"></stop>\r\n                            <stop offset="90%" style="stop-color: rgb(182, 131, 99);"></stop>\r\n                            <stop offset="100%" style="stop-color: rgb(182, 131, 99);"></stop>\r\n                        </linearGradient>\r\n                        <path id="shape" fill="inherit" class="shape"\r\n                              d="M.5 27.6s15.7-6.3 25.7-9c11-3 17-3.5 26.1-3.7 16.2.7 16.9.8 24.7 1 6.1 0 6.6-.6 16.7-.6h13.7s12.8-.8 21.9-2c16.6-2.1 23.8-1 35.3.4 26.2 3.5 39.4 6.5 42.9 7.8.3-3.3.6-5.3.7-7.6.2-3.9.1-4.7.3-13.9C205.5 0 0 .8 0 .8s.3 8.7.3 11.7c0 2.3.4 6.8.5 9.6 0 3.5-.3 5.5-.3 5.5z"\r\n                              style="fill: url(\'#gradient\');"></path>\r\n                        <path id="shape" fill="inherit" class="shapes"\r\n                              d="M.5 27.6s15.7-6.3 25.7-9c11-3 17-3.5 26.1-3.7 16.2.7 16.9.8 24.7 1 6.1 0 6.6-.6 16.7-.6h13.7s12.8-.8 21.9-2c16.6-2.1 23.8-1 35.3.4 26.2 3.5 39.4 6.5 42.9 7.8.3-3.3.6-5.3.7-7.6.2-3.9.1-4.7.3-13.9C205.5 0 0 .8 0 .8s.3 8.7.3 11.7c0 2.3.4 6.8.5 9.6 0 3.5-.3 5.5-.3 5.5z"\r\n                              style="fill: url(\'#gradient\');"></path>\r\n                    </defs>\r\n                    <svg filter="url(#blurMe)">\r\n                        <g>\r\n                            <svg viewBox="0 0 209 28" x="0" y="0" width="86" height="28"\r\n                                 preserveAspectRatio="xMinYMin slice">\r\n                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shape"></use>\r\n                            </svg>\r\n                            <pattern id="pattern" viewBox="0 0 209 28" x="86" y="0" width="28" height="28"\r\n                                     preserveAspectRatio="xMidYMin slice" patternUnits="userSpaceOnUse">\r\n                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shape"></use>\r\n                            </pattern>\r\n                            <rect width="100%" height="28" style="fill: url(\'#pattern\');"></rect>\r\n                            <svg viewBox="0 0 209 28" preserveAspectRatio="xMaxYMin meet">\r\n                                <svg viewBox="0 0 209 28" x="114" y="0" width="95" height="28"\r\n                                     preserveAspectRatio="xMaxYMin slice">\r\n                                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#shape"></use>\r\n                                </svg>\r\n                            </svg>\r\n                        </g>\r\n                    </svg>\r\n                </svg>\r\n                <h1><span>{{ title }}</span></h1>\r\n            </div>\r\n            <div class="content">\r\n                <div class="boxBody">\r\n                    <ng-content></ng-content>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n'
    },
    "./src/app/modal/modal-container/modal-container.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return s
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            o = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            s = function() {
                function e() {}

                return e.prototype.clickOutSide = function(e) {
                    var t = e.target || e.srcElement || e.currentTarget;
                    if (t.attributes && t.attributes.id) {
                        "overlay" === t.attributes.id.nodeValue && this.destroy()
                    }
                }, e.prototype.ngOnDestroy = function() {}, r([Object(a.Input)(), o("design:type", String)], e.prototype, "title", void 0), r([Object(a.Input)(), o("design:type", String)], e.prototype, "modalId", void 0), r([Object(a.Input)(), o("design:type", String)], e.prototype, "zIndex", void 0), r([Object(a.Input)(), o("design:type", Function)], e.prototype, "destroy", void 0), e = r([Object(a.Component)({
                    selector: "app-modal",
                    template: n("./src/app/modal/modal-container/modal-container.component.html")
                })], e)
            }()
    },
    "./src/app/modal/modal-interface.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return a
        });
        var a = function() {
            return function() {}
        }()
    },
    "./src/app/modal/modal.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return g
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/modal.service.ts"),
            o = n("./node_modules/@angular/common/esm5/common.js"),
            s = n("./node_modules/@angular/router/esm5/router.js"),
            i = n("./src/app/modal/login/login.component.ts"),
            c = n("./src/app/modal/register/register.component.ts"),
            l = n("./src/app/modal/set-language/set-language.component.ts"),
            d = n("./src/app/modal/activation/activation.component.ts"),
            p = n("./src/app/modal/forgot-game-world/forgot-game-world.ts"),
            h = n("./src/app/modal/recovery/recovery.component.ts"),
            u = n("./src/app/_services/cookie.service.ts"),
            v = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            f = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            m = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            };
        n("./src/frontend/components/Modal/Modal.scss");
        var g = function() {
            function e(e, t, n, a, r) {
                var o = this;
                this.document = e, this.factoryResolver = t, this.modalService = n, this.cookieService = a, this.router = r, this.router.events.subscribe(function(e) {
                    if (e instanceof s.a) {
                        var t = o.router.parseUrl(o.router.url);
                        o.checkDeveloperMode(t.queryParams), o.handleFragmentChanges(t.fragment)
                    }
                })
            }

            return e.prototype.checkDeveloperMode = function(e) {
                null !== e.developer && void 0 != e.developer && ("1" === e.developer ? this.cookieService.set("developerIncluded", "1", 86400) : this.cookieService.set("developerIncluded", "0", -1))
            }, e.prototype.handleFragmentChanges = function(e) {
                var t = this.router.routerState.root.queryParams.value;
                if ("login" === e) {
                    var n = null;
                    t.server && (n = t.server), this.modalService.open(i.a, { manuallyChosenGameWorldId: n })
                } else if ("register" === e) {
                    n = null;
                    t.server && (n = t.server), this.modalService.open(c.a, { manuallyChosenGameWorldId: n })
                } else if ("setLanguage" === e) this.modalService.open(l.a);
                else if ("activation" === e) {
                    var a = { server: null, activationCode: null };
                    t.activationCode && (a.activationCode = t.activationCode.trim()), t.server && (a.server = t.server), a.server && this.modalService.open(d.a, { data: a })
                } else if ("forgotGameWorld" === e) this.modalService.open(p.a);
                else if ("recovery" === e) {
                    var r = { uid: null, recoveryCode: null, worldId: null };
                    t.recoveryCode && (r.recoveryCode = t.recoveryCode.trim()), t.uid && (r.uid = t.uid), t.server && (r.worldId = t.server), r.uid && r.recoveryCode && r.worldId && this.modalService.open(h.a, { requestInfo: r })
                }
            }, e.prototype.ngOnInit = function() {
                this.modalService.registerFactoryResolver(this.factoryResolver), this.modalService.registerViewContainerRef(this.viewContainerRef), this.modalService.setRouter(this.router)
            }, v([Object(a.ViewChild)("modalplaceholder", { read: a.ViewContainerRef }), f("design:type", Object)], e.prototype, "viewContainerRef", void 0), e = v([Object(a.Component)({
                selector: "app-modal-placeholder",
                template: "<div #modalplaceholder></div>"
            }), m(0, Object(a.Inject)(o.DOCUMENT)), f("design:paramtypes", [Object, a.ComponentFactoryResolver, r.a, u.a, s.b])], e)
        }()
    },
    "./src/app/modal/noMail/noMail.component.html": function(e, t) {
        e.exports = '<app-modal [title]="\'NO_MAIL.activationMail\' | translate" [modalId]="\'NoMail\'" [zIndex]="zIndex"\r\n           [destroy]="destroy">\r\n  <div *ngIf="loaded">\r\n    <div *ngIf="error !== null && error.length > 0">\r\n      <p><span [translate]="error"></span></p>\r\n    </div>\r\n    <div *ngIf="success">\r\n      <p><span [translate]="\'NO_MAIL.weHaveSentAnEmail\'"></span></p>\r\n    </div>\r\n    <ng-template [ngIf]="(error === null || error.length <= 0) && !success">\r\n      <div class="mailInfo">\r\n        <span translate="NO_MAIL.ReEnterYourMail"></span>\r\n      </div>\r\n      <form [formGroup]="resendMailForm" (submit)="noMailSubmit()">\r\n        <label class="textField invalid" for="email">\r\n          <input type="email" formControlName="email" name="email"\r\n                 (blur)="reValidate()" (focus)="reValidate()"\r\n                 [ngClass]="{\'pinLabel\': resendMailForm.get(\'email\').value != null && resendMailForm.get(\'email\').value.length > 0}"\r\n          >\r\n          <div class="label"><span [translate]="\'NO_MAIL.email\'"></span></div>\r\n          <div class="validation">\r\n            <form-validation-error\r\n              [valid]="resendMailForm.get(\'email\').valid"\r\n              [errors]="resendMailForm.get(\'email\').errors"\r\n              [touched]="resendMailForm.get(\'email\').touched"\r\n            ></form-validation-error>\r\n          </div>\r\n        </label>\r\n        <ng-template [ngIf]="reCaptchaRequired">\r\n          <div id="gCaptchaContainer">\r\n            <re-captcha #captchaRef="reCaptcha" [formControlName]="\'captcha\'"></re-captcha>\r\n          </div>\r\n          <label class="textField invalid captcha" for="captcha">\r\n            <div class="validation">\r\n              <form-validation-error\r\n                [valid]="resendMailForm.get(\'captcha\').valid"\r\n                [errors]="resendMailForm.get(\'captcha\').errors"\r\n                [touched]="resendMailForm.get(\'captcha\').touched"\r\n              ></form-validation-error>\r\n            </div>\r\n          </label>\r\n          <div style="clear: both; float: none;"></div>\r\n        </ng-template>\r\n        <button [disabled]="ajaxLoading" type="submit" class="button default">\r\n          <span [translate]="\'NO_MAIL.ResendEmail\'"></span>\r\n          <div *ngIf="ajaxLoading" class="buttonAjaxLoader"></div>\r\n        </button>\r\n      </form>\r\n    </ng-template>\r\n  </div>\r\n  <div *ngIf="!loaded">\r\n    {{ \'Loading...\' | translate }}\r\n  </div>\r\n</app-modal>\r\n'
    },
    "./src/app/modal/noMail/noMail.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return f
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/modal/modal-interface.ts"),
            o = n("./node_modules/@angular/forms/esm5/forms.js"),
            s = n("./src/app/_services/api.service.ts"),
            i = n("./src/app/formValidators/functions.ts"),
            c = n("./node_modules/@angular/common/esm5/common.js"),
            l = n("./src/app/formValidators/emailValidator.ts"),
            d = n("./src/app/formValidators/recaptchaValidator.ts"),
            p = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            h = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            u = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            v = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            };
        n("./src/frontend/containers/Registration/NoMail.scss");
        var f = function(e) {
            function t(t, n) {
                var a = e.call(this) || this;
                return a.api = t, a.document = n, a.loaded = !1, a.success = !1, a.ajaxLoading = !1, a.error = null, a.reCaptchaRequired = !1, a
            }

            return p(t, e), t.prototype.reValidate = function() {
                this.resendMailForm.get("email").updateValueAndValidity()
            }, t.prototype.ngOnInit = function() {
                var e = this;
                this.resendMailForm = new o.b({
                    email: new o.a(null, [o.f.required, l.a]),
                    captcha: new o.a(null, [])
                }), this.api.loadServerByWID(this.data.server).subscribe(function(t) {
                    t.success ? e.data.serverId = t.gameWorld.id : e.error = "NO_MAIL.UnknownOrInvalidGameWorld", e.loaded = !0
                })
            }, t.prototype.noMailSubmit = function() {
                var e = this;
                this.resendMailForm.valid ? (this.ajaxLoading = !0, this.api.resendActivationMail(this.data.serverId, this.resendMailForm.get("email").value, this.resendMailForm.get("captcha").value).subscribe(function(t) {
                    t.success ? e.success = !0 : (t.fields.email && e.resendMailForm.get("email").setErrors((n = {}, n[t.fields.email] = !0, n)), t.fields.captcha && (e.reCaptchaRequired ? e.captchaRef.reset() : (e.reCaptchaRequired = !0, e.resendMailForm.get("captcha").setValidators([d.a])), e.resendMailForm.get("captcha").setErrors((a = {}, a[t.fields.captcha] = !0, a)))), e.ajaxLoading = !1;
                    var n, a
                })) : Object(i.a)(this.resendMailForm)
            }, h([Object(a.ViewChild)("captchaRef"), u("design:type", Object)], t.prototype, "captchaRef", void 0), t = h([Object(a.Component)({ template: n("./src/app/modal/noMail/noMail.component.html") }), v(1, Object(a.Inject)(c.DOCUMENT)), u("design:paramtypes", [s.a, Object])], t)
        }(r.a)
    },
    "./src/app/modal/recovery/recovery.component.html": function(e, t) {
        e.exports = '<app-modal [title]="\'FORGOT_PASSWORD.ForgotPassword\' | translate" [modalId]="\'ForgotPassword\'" [zIndex]="zIndex"\r\n           [destroy]="destroy">\r\n  <img [src]="world_bar_image.src" alt="Game world bar" [srcset]="world_bar_image.srcset | buildSourceSet">\r\n  <ng-template [ngIf]="!success">\r\n    <div class="passwordInfo">\r\n      <span translate="FORGOT_PASSWORD.enterNewPassword"></span>\r\n    </div>\r\n    <form [formGroup]="recoveryForm" (submit)="submitRecovery()">\r\n      <label class="textField invalid" for="password">\r\n        <input type="password"\r\n               formControlName="password"\r\n               name="password"\r\n               (blur)="reValidate()" (focus)="reValidate()"\r\n               [ngClass]="{\'pinLabel\': recoveryForm.get(\'password\').value != null && recoveryForm.get(\'password\').value.length > 0}"\r\n        >\r\n        <div class="label"><span translate="FORGOT_PASSWORD.password"></span></div>\r\n        <div class="validation">\r\n          <form-validation-error\r\n            [valid]="recoveryForm.get(\'password\').valid"\r\n            [errors]="recoveryForm.get(\'password\').errors"\r\n            [touched]="recoveryForm.get(\'password\').touched"\r\n          ></form-validation-error>\r\n        </div>\r\n      </label>\r\n      <button [disabled]="ajaxLoading" type="submit" class="button default">\r\n        <span translate="FORGOT_PASSWORD.setNewPassword"></span>\r\n        <div *ngIf="ajaxLoading" class="buttonAjaxLoader"></div>\r\n      </button>\r\n    </form>\r\n  </ng-template>\r\n  <ng-template [ngIf]="success">\r\n    <div class="passwordInfo">\r\n      <p>\r\n        <span translate="FORGOT_PASSWORD.passwordHasBeenChanged"></span>\r\n      </p>\r\n    </div>\r\n  </ng-template>\r\n</app-modal>\r\n'
    },
    "./src/app/modal/recovery/recovery.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return v
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/modal/modal-interface.ts"),
            o = n("./src/app/_services/locale.service.ts"),
            s = n("./node_modules/@angular/forms/esm5/forms.js"),
            i = n("./src/app/formValidators/functions.ts"),
            c = n("./src/app/_services/api.service.ts"),
            l = n("./src/app/formValidators/passwordValidator.ts"),
            d = n("./node_modules/@angular/router/esm5/router.js"),
            p = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            h = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            u = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            };
        n("./src/frontend/containers/Login/ForgotPassword.scss");
        var v = function(e) {
            function t(t, a, r) {
                var o = e.call(this) || this;
                return o.router = t, o.localeService = a, o.api = r, o.world_bar_image = {
                    src: "",
                    srcset: {}
                }, o.world_bar_images = {
                    ltr: {
                        src: n("./src/frontend/components/WorldBar/img/ltr/worldDefault_button_1x.jpg"),
                        srcset: {
                            "1x": n("./src/frontend/components/WorldBar/img/ltr/worldDefault_button_1x.jpg"),
                            "2x": n("./src/frontend/components/WorldBar/img/ltr/worldDefault_button_2x.jpg")
                        }
                    },
                    rtl: {
                        src: n("./src/frontend/components/WorldBar/img/rtl/worldDefault_button_1x.jpg"),
                        srcset: {
                            "1x": n("./src/frontend/components/WorldBar/img/rtl/worldDefault_button_1x.jpg"),
                            "2x": n("./src/frontend/components/WorldBar/img/rtl/worldDefault_button_2x.jpg")
                        }
                    }
                }, o.reCaptchaRequired = !1, o.ajaxLoading = !1, o.success = !1, o.requestInfo = {
                    uid: null,
                    recoveryCode: null,
                    worldId: null
                }, o
            }

            return p(t, e), t.prototype.reValidate = function() {
                this.recoveryForm.get("password").updateValueAndValidity()
            }, t.prototype.ngOnInit = function() {
                var e = this;
                this.world_bar_image = this.world_bar_images[this.localeService.data.direction], this.localeService.dataChanged.subscribe(function() {
                    e.world_bar_image = e.world_bar_images[e.localeService.data.direction]
                }), this.recoveryForm = new s.b({ password: new s.a(null, [s.f.required, l.a]) })
            }, t.prototype.submitRecovery = function() {
                var e = this;
                this.recoveryForm.valid ? (this.ajaxLoading = !0, this.api.updatePassword(this.requestInfo.worldId, this.requestInfo.uid, this.requestInfo.recoveryCode, this.recoveryForm.get("password").value).subscribe(function(t) {
                    t.success ? e.success = !0 : t.fields && t.fields.password && e.recoveryForm.get("password").setErrors((n = {}, n[t.fields.password] = !0, n)), e.ajaxLoading = !1;
                    var n
                })) : Object(i.a)(this.recoveryForm)
            }, h([Object(a.ViewChild)("captchaRef"), u("design:type", Object)], t.prototype, "captchaRef", void 0), t = h([Object(a.Component)({ template: n("./src/app/modal/recovery/recovery.component.html") }), u("design:paramtypes", [d.b, o.a, c.a])], t)
        }(r.a)
    },
    "./src/app/modal/register/register.component.html": function(e, t) {
        e.exports = '<app-modal [title]="(chosen_server == null ? \'REGISTER.selectGameWorld\' : \'REGISTER.registerToPlay\') | translate"\r\n           [modalId]="\'Registration\'" [zIndex]="zIndex" [destroy]="destroy">\r\n  <ng-template [ngIf]="loaded" [ngIfElse]="loading">\r\n    <ng-template [ngIf]="gameWorldsCount == 0" [ngIfElse]="register">\r\n      <p><span [translate]="\'REGISTER.THERE_ARE_NO_GAME_WORLDS_FOR_REGISTRATION\'"></span></p>\r\n    </ng-template>\r\n    <ng-template #register>\r\n      <ng-template [ngIf]="chosen_server !== null">\r\n        <div class="registrationWrapper">\r\n          \x3c!-- game world --\x3e\r\n          <game-world (click)="changeGameWorld();" [server]="chosen_server"></game-world>\r\n          <div class="linkWrapper">\r\n            <a class="change" (click)="changeGameWorld();"\r\n               [title]="\'REGISTER.changeGameWorld\' | translate"\r\n               [translate]="\'REGISTER.changeGameWorld\'"></a>\r\n            <div class="changeInfo" *ngIf="gameWorldsCount > 1 && clickOnChangeGameWorldCount == 1 && inviter.uid">\r\n              <speech-bubble [invalid]="\'REGISTER.PlayerInvitedYou\' | translate:{player: inviter.playerName}"\r\n                             [showIcon]="false"></speech-bubble>\r\n            </div>\r\n            <div class="changeInfo" *ngIf="clickOnChangeGameWorldCount > 0 && gameWorldsCount == 1">\r\n              <speech-bubble [invalid]="\'NO_MORE_SERVERS\' | translate" [showIcon]="false"></speech-bubble>\r\n            </div>\r\n          </div>\r\n          <div class="invitationInfo" *ngIf="inviter.uid">\r\n            <span>{{ \'REGISTER.PlayerInvitedYouToTravian\' | translate:{player: inviter.playerName} }}</span>\r\n          </div>\r\n          <form [formGroup]="signupForm" (submit)="signupSubmit()">\r\n            <label class="textField invalid" for="username">\r\n              <input\r\n                type="text" name="username" formControlName="username"\r\n                (blur)="reValidate()" (focus)="reValidate()"\r\n                [ngClass]="{\'pinLabel\': signupForm.get(\'username\').value != null && signupForm.get(\'username\').value.length > 0}"\r\n              >\r\n              <div class="label"><span [translate]="\'REGISTER.Username\'"></span></div>\r\n              <div class="validation">\r\n                <form-validation-error\r\n                  [valid]="signupForm.get(\'username\').valid"\r\n                  [errors]="signupForm.get(\'username\').errors"\r\n                  [touched]="signupForm.get(\'username\').touched"\r\n                ></form-validation-error>\r\n              </div>\r\n            </label>\r\n            <label class="textField invalid" for="email">\r\n              <input type="text" formControlName="email" name="email"\r\n                     (blur)="reValidate()" (focus)="reValidate()"\r\n                     [ngClass]="{\'pinLabel\': signupForm.get(\'email\').value != null && signupForm.get(\'email\').value.length > 0}"\r\n              >\r\n              <div class="label"><span [translate]="\'REGISTER.Email\'"></span></div>\r\n              <div class="validation">\r\n                <form-validation-error\r\n                  [valid]="signupForm.get(\'email\').valid"\r\n                  [errors]="signupForm.get(\'email\').errors"\r\n                  [touched]="signupForm.get(\'email\').touched"\r\n                ></form-validation-error>\r\n              </div>\r\n            </label>\r\n            <label *ngIf="!chosen_server.activationRequired" class="textField invalid" for="password">\r\n              <input type="password" formControlName="password" name="password"\r\n                     (blur)="reValidate()" (focus)="reValidate()"\r\n                     [ngClass]="{\'pinLabel\': signupForm.get(\'password\').value != null && signupForm.get(\'password\').value.length > 0}"\r\n              >\r\n              <div class="label"><span [translate]="\'REGISTER.Password\'"></span></div>\r\n              <div class="validation">\r\n                <form-validation-error\r\n                  [valid]="signupForm.get(\'password\').valid"\r\n                  [errors]="signupForm.get(\'password\').errors"\r\n                  [touched]="signupForm.get(\'password\').touched"\r\n                ></form-validation-error>\r\n              </div>\r\n            </label>\r\n            <label *ngIf="chosen_server.registrationKeyRequired" class="textField invalid" for="registrationKey">\r\n              <input type="text" formControlName="registrationKey" name="registrationKey"\r\n                     (blur)="reValidate()" (focus)="reValidate()"\r\n                     [ngClass]="{\'pinLabel\': signupForm.get(\'registrationKey\').value != null && signupForm.get(\'registrationKey\').value.length > 0}"\r\n              >\r\n              <div class="label"><span [translate]="\'REGISTER.RegistrationKey\'"></span></div>\r\n              <div class="validation">\r\n                <form-validation-error\r\n                  [valid]="signupForm.get(\'registrationKey\').valid"\r\n                  [errors]="signupForm.get(\'registrationKey\').errors"\r\n                  [touched]="signupForm.get(\'registrationKey\').touched"\r\n                ></form-validation-error>\r\n              </div>\r\n            </label>\r\n            <br/>\r\n            <label class="checkbox required">\r\n              <input type="checkbox" [value]="signupForm.get(\'termsAndConditions\').value"\r\n                     [checked]="signupForm.get(\'termsAndConditions\').value" formControlName="termsAndConditions">\r\n              <svg class="checkbox" viewBox="0 0 20 20">\r\n                <rect x="0.5" y="0.5" width="19" height="19" rx="2.5" ry="2.5"></rect>\r\n              </svg>\r\n              <svg class="checkmark" viewBox="-1 -1 20 20">\r\n                <path d="M0.3,8.5c0,0,5,4.4,6.3,8.1c1.9-8.8,7.7-16.3,7.7-16.3"></path>\r\n              </svg>\r\n              <div class="label inline">\r\n                <span\r\n                  [innerHTML]="\'REGISTER.IAgreeToTermsAndConditionsAndPrivacyPolicy\' | translate | sanitizeHTML"></span>\r\n              </div>\r\n              <div *ngIf="signupForm.get(\'termsAndConditions\').invalid && signupForm.get(\'registrationKey\').touched"\r\n                   class="speechBubble inline">\r\n                <svg class="arrow" viewBox="-0.5 0 13 24">\r\n                  <polyline class="arrowBorder" points="12,0 12,2 2,12 12,22 12,24"></polyline>\r\n                  <polyline class="arrowCover" points="13,2 3,12 13,22"></polyline>\r\n                </svg>\r\n                <span [translate]="\'ERRORS.ItsNecessaryToReadAndAcceptGTC\'"></span></div>\r\n            </label>\r\n            <label class="checkbox ">\r\n              <input type="checkbox" value="on" formControlName="subscribeNewsletter">\r\n              <svg class="checkbox" viewBox="0 0 20 20">\r\n                <rect x="0.5" y="0.5" width="19" height="19" rx="2.5" ry="2.5"></rect>\r\n              </svg>\r\n              <svg class="checkmark" viewBox="-1 -1 20 20">\r\n                <path d="M0.3,8.5c0,0,5,4.4,6.3,8.1c1.9-8.8,7.7-16.3,7.7-16.3"></path>\r\n              </svg>\r\n              <div class="label"><span translate="REGISTER.Subscribe to newsletter"></span></div>\r\n            </label>\r\n            <ng-template [ngIf]="reCaptchaRequired">\r\n              <br/>\r\n              <div id="gCaptchaContainer">\r\n                <re-captcha #captchaRef="reCaptcha" [formControlName]="\'captcha\'"></re-captcha>\r\n              </div>\r\n              <label class="textField invalid captcha" for="captcha">\r\n                <div class="validation">\r\n                  <form-validation-error\r\n                    [valid]="signupForm.get(\'captcha\').valid"\r\n                    [errors]="signupForm.get(\'captcha\').errors"\r\n                    [touched]="signupForm.get(\'captcha\').touched"\r\n                  ></form-validation-error>\r\n                </div>\r\n              </label>\r\n              <div style="clear: both; float: none;"></div>\r\n            </ng-template>\r\n            <br/>\r\n            <button [disabled]="ajaxLoading" type="submit" class="button default">\r\n              <span [translate]="\'REGISTER.registerNow\'"></span>\r\n              <div *ngIf="ajaxLoading" class="buttonAjaxLoader"></div>\r\n            </button>\r\n          </form>\r\n          <br>\r\n          <div class="linkWrapper">\r\n            <a (click)="openLogin();">\r\n              <span [translate]="\'REGISTER.IAlreadyHaveAnAccount\'"></span>\r\n            </a>\r\n          </div>\r\n          <br/>\r\n          <div class="linkWrapper">\r\n            <a (click)="openActivation();" [title]="\'REGISTER.alreadyRegistered\' | translate" translate="REGISTER.alreadyRegistered"></a></div>\r\n\r\n        </div>\r\n      </ng-template>\r\n      <ng-template [ngIf]="chosen_server === null">\r\n        <div class="worldSelection shown">\r\n          <div class="transformWrapper">\r\n            <div *ngIf="recommendedGameWorlds.length>0" class="worldGroup">\r\n              <h4>\r\n                <span [translate]="\'REGISTER.recommendedGameWorld\'"></span>\r\n              </h4>\r\n              <game-world *ngFor="let server of recommendedGameWorlds" (chosen)="chooseGameWorld(server)"\r\n                          [server]="server"></game-world>\r\n            </div>\r\n            <div class="worldGroup">\r\n              <h4 *ngIf="recommendedGameWorlds.length>0">\r\n                <span [translate]="\'REGISTER.otherGameWorlds\'"></span>\r\n              </h4>\r\n              <game-world *ngFor="let server of gameWorlds" (chosen)="chooseGameWorld(server)"\r\n                          [server]="server"></game-world>\r\n            </div>\r\n          </div>\r\n        </div>\r\n      </ng-template>\r\n    </ng-template>\r\n  </ng-template>\r\n  <ng-template #loading>\r\n    {{ \'Loading...\' | translate }}\r\n  </ng-template>\r\n</app-modal>\r\n'
    },
    "./src/app/modal/register/register.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return R
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/modal/modal-interface.ts"),
            o = n("./src/app/_services/login.service.ts"),
            s = n("./node_modules/rxjs/_esm5/observable/IntervalObservable.js"),
            i = n("./src/app/_services/modal.service.ts"),
            c = n("./node_modules/@angular/forms/esm5/forms.js"),
            l = n("./src/app/formValidators/usernameValidator.ts"),
            d = n("./src/app/formValidators/functions.ts"),
            p = n("./node_modules/@angular/common/esm5/common.js"),
            h = n("./src/app/formValidators/emailValidator.ts"),
            u = n("./src/app/modal/login/login.component.ts"),
            v = n("./src/app/_services/api.service.ts"),
            f = n("./src/app/formValidators/passwordValidator.ts"),
            m = n("./src/app/formValidators/recaptchaValidator.ts"),
            g = n("./src/app/modal/activation/activation.component.ts"),
            E = n("./node_modules/@angular/router/esm5/router.js"),
            y = n("./src/app/_services/config.service.ts"),
            _ = n("./src/app/_services/cookie.service.ts"),
            b = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            M = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            O = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            A = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            };
        n("./src/frontend/containers/Registration/Registration.scss");
        var R = function(e) {
            function t(t, n, a, r, o, s, i) {
                var c = e.call(this) || this;
                return c.document = t, c.api = n, c.loginService = a, c.modalService = r, c.configService = o, c.cookieService = s, c.router = i, c.gameWorlds = [], c.recommendedGameWorlds = [], c.chosen_server = null, c.loaded = !1, c.gameWorldsCount = 0, c.reCaptchaRequired = !1, c.ajaxLoading = !1, c.manuallyChosenGameWorldId = null, c.clickOnChangeGameWorldCount = 0, c.inviter = {
                    gameWorldName: null,
                    uid: null,
                    playerName: null
                }, c
            }

            return b(t, e), t.prototype.ngOnInit = function() {
                var e = this;
                this.signupForm = new c.b({
                    username: new c.a(null, { validators: [c.f.required, l.a] }),
                    password: new c.a(null),
                    registrationKey: new c.a(null),
                    email: new c.a(null, { validators: [c.f.required, h.a] }),
                    termsAndConditions: new c.a(null, [c.f.requiredTrue]),
                    subscribeNewsletter: new c.a(!1),
                    captcha: new c.a(null)
                });
                var t = this.router.routerState.root.queryParams.value;
                if (t.uc) {
                    var n = t.uc.trim().split("_");
                    if (2 === n.length) return void this.api.getUsernameById(n[0], n[1]).subscribe(function(t) {
                        e.inviter = t, e.inviter.gameWorldName && (e.manuallyChosenGameWorldId = e.inviter.gameWorldName), e.requestForGameWorlds()
                    })
                }
                this.requestForGameWorlds()
            }, t.prototype.changeGameWorld = function() {
                this.clickOnChangeGameWorldCount++, this.inviter.uid && this.clickOnChangeGameWorldCount < 2 || (this.inviter = {
                    gameWorldName: null,
                    uid: null,
                    playerName: null
                }, this.gameWorldsCount > 1 && (this.chosen_server = null))
            }, t.prototype.chooseGameWorld = function(e) {
                this.signupForm.get("username").reset(), this.signupForm.get("password").reset(), this.signupForm.get("registrationKey").reset(), this.signupForm.get("email").reset(), e.activationRequired ? this.signupForm.get("password").clearValidators() : this.signupForm.get("password").setValidators([c.f.required, f.a]), this.signupForm.get("password").updateValueAndValidity(), this.reCaptchaRequired && this.captchaRef && this.captchaRef.reset(), this.reCaptchaRequired = !e.activationRequired, this.reCaptchaRequired ? this.signupForm.get("captcha").setValidators([m.a]) : this.signupForm.get("captcha").clearValidators(), e.registrationKeyRequired ? this.signupForm.get("registrationKey").setValidators([c.f.required]) : this.signupForm.get("registrationKey").clearValidators(), this.signupForm.get("registrationKey").updateValueAndValidity(), this.signupForm.get("captcha").updateValueAndValidity(), this.configService.getProperty("autoCheckTermsAndConditions") && this.signupForm.patchValue({ termsAndConditions: !0 }), this.chosen_server = e
            }, t.prototype.reValidate = function() {
                this.signupForm.get("username").updateValueAndValidity(), this.signupForm.get("email").updateValueAndValidity(), this.signupForm.get("password").updateValueAndValidity(), this.signupForm.get("registrationKey").updateValueAndValidity()
            }, t.prototype.requestForGameWorlds = function() {
                var e = this;
                this.loginService.getGameWorlds().subscribe(function(t) {
                    e.populateGameWorlds(t, !0), e.manuallyChosenGameWorldId && e.chooseServerManually(e.manuallyChosenGameWorldId), e.timer = s.a.create(3e5).subscribe(function() {
                        e.loginService.getGameWorlds().subscribe(function(t) {
                            return e.populateGameWorlds(t)
                        })
                    })
                })
            }, t.prototype.chooseServerManually = function(e) {
                if (null == this.chosen_server || this.chosen_server.name !== e) {
                    for (var t in this.gameWorlds)
                        if (this.gameWorlds.hasOwnProperty(t)) {
                            if (void 0 !== (n = this.gameWorlds[t]) && e === n.name) return void this.chooseGameWorld(n)
                        }
                    for (var t in this.recommendedGameWorlds)
                        if (this.gameWorlds.hasOwnProperty(t)) {
                            var n;
                            if (void 0 !== (n = this.recommendedGameWorlds[t]) && e === n.name) return void this.chooseGameWorld(n)
                        }
                }
            }, t.prototype.populateGameWorlds = function(e, t) {
                var n = this;
                void 0 === t && (t = !1), this.loaded = !1, this.gameWorldsCount = 0, this.gameWorlds = [], this.recommendedGameWorlds = [], this.gameWorldsCount = 0, e.gameWorlds.sort(function(e, t) {
                    return e.secondsPast > 0 && t.secondsPast < 0 ? -1 : e.secondsPast < 0 && t.secondsPast < 0 ? e.secondsPast > t.secondsPast ? -1 : 1 : e.start == t.start ? 0 : e.start < t.start ? 1 : -1
                });
                var a = "1" === this.cookieService.get("developerIncluded"),
                    r = !0;
                e.gameWorlds.forEach(function(e) {
                    e.hidden && !a || e.registerClosed || e.finished || (r && t && e.secondsPast >= n.configService.getProperty("registrationRecommendedMinSecondsPast") ? (n.chooseGameWorld(e), n.recommendedGameWorlds.push(e), r = !1) : n.gameWorlds.push(e), n.gameWorldsCount++, 1 === n.gameWorldsCount && n.chooseGameWorld(e))
                }), this.loaded = !0
            }, t.prototype.openLogin = function() {
                this.destroy(), this.modalService.open(u.a)
            }, t.prototype.signupSubmit = function() {
                var e = this;
                this.signupForm.valid ? (this.ajaxLoading = !0, this.api.register(this.chosen_server.id, this.signupForm.get("username").value, this.signupForm.get("email").value, this.signupForm.get("registrationKey").value, this.signupForm.get("password").value, this.signupForm.get("termsAndConditions").value, this.signupForm.get("subscribeNewsletter").value, this.inviter, this.signupForm.get("captcha").value).subscribe(function(t) {
                    if (t.success)
                        if (t.redirect) e.document.location.assign(t.redirect);
                        else {
                            var n = e.chosen_server;
                            e.destroy(), e.modalService.open(g.a, { data: { server: n.name, activationCode: null } })
                        }
                    else t.fields && (t.fields.username && e.signupForm.get("username").setErrors((a = {}, a[t.fields.username] = !0, a)), t.fields.email && e.signupForm.get("email").setErrors((r = {}, r[t.fields.email] = !0, r)), t.fields.password && e.signupForm.get("password").setErrors((o = {}, o[t.fields.password] = !0, o)), t.fields.registrationKey && e.signupForm.get("registrationKey").setErrors((s = {}, s[t.fields.registrationKey] = !0, s)), t.fields.captcha && (e.reCaptchaRequired ? e.captchaRef.reset() : (e.reCaptchaRequired = !0, e.signupForm.get("captcha").setValidators([m.a])), e.signupForm.get("captcha").setErrors((i = {}, i[t.fields.captcha] = !0, i))));
                    e.ajaxLoading = !1;
                    var a, r, o, s, i
                })) : Object(d.a)(this.signupForm)
            }, t.prototype.openActivation = function() {
                var e = this.chosen_server;
                this.destroy(), this.modalService.open(g.a, {
                    data: {
                        server: e.name,
                        serverId: e.id,
                        activationCode: null
                    }
                })
            }, t.prototype.ngOnDestroy = function() {
                this.chosen_server = null, this.gameWorlds = [], this.recommendedGameWorlds = [], this.timer && this.timer.unsubscribe()
            }, M([Object(a.ViewChild)("captchaRef"), O("design:type", Object)], t.prototype, "captchaRef", void 0), t = M([Object(a.Component)({ template: n("./src/app/modal/register/register.component.html") }), A(0, Object(a.Inject)(p.DOCUMENT)), O("design:paramtypes", [Object, v.a, o.a, i.a, y.a, _.a, E.b])], t)
        }(r.a)
    },
    "./src/app/modal/set-language/set-language-lang/set-language-lang.component.html": function(e, t) {
        e.exports = '<label class="radioButton" for="lang-{{language.name}}-{{recommanded ? \'recommended\' : \'other\'}}">\r\n    <input type="radio"\r\n    name="lang-{{language.name}}-{{recommanded ? \'recommended\' : \'other\'}}"\r\n    id="lang-{{language.name}}-{{recommanded ? \'recommended\' : \'other\'}}"\r\n    [checked]="checked" (change)="languageSelected();">\r\n    <svg viewBox="0 0 20 20">\r\n       <circle class="circle" cx="10" cy="10" r="9"></circle>\r\n       <circle class="dot" cx="10" cy="10" r="2"></circle>\r\n    </svg>\r\n    <span>\r\n       <span class=" language" [innerHTML]="loadFlagSvg(language.flag) | sanitizeHTML"></span>\r\n       {{language.langNative}}\r\n       <span class="addition">\r\n          ({{language.countryNative}})\r\n       </span>\r\n    </span>\r\n </label>\r\n'
    },
    "./src/app/modal/set-language/set-language-lang/set-language-lang.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/environments/environment.ts"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = function() {
                function e() {
                    this.recommanded = !1, this.checked = !1, this.langChanged = new a.EventEmitter
                }

                return e.prototype.ngOnInit = function() {
                    this.language = r.a.translations[this.lang]
                }, e.prototype.languageSelected = function() {
                    this.langChanged.emit(this.language.hrefLang)
                }, e.prototype.loadFlagSvg = function(e) {
                    return n("./src/frontend/components/Flag recursive ^\\.\\/.*\\.svg$")("./" + e + ".svg")
                }, o([Object(a.Input)(), s("design:type", Object)], e.prototype, "lang", void 0), o([Object(a.Input)(), s("design:type", Object)], e.prototype, "recommanded", void 0), o([Object(a.Input)(), s("design:type", Object)], e.prototype, "checked", void 0), o([Object(a.Output)(), s("design:type", Object)], e.prototype, "langChanged", void 0), e = o([Object(a.Component)({
                    selector: "app-lang-radio-btn",
                    template: n("./src/app/modal/set-language/set-language-lang/set-language-lang.component.html")
                })], e)
            }()
    },
    "./src/app/modal/set-language/set-language.component.html": function(e, t) {
        e.exports = '<app-modal [title]="\'CHANGE_LANG.SELECT_A_LANG\' | translate" [modalId]="\'languageSelection\'" [zIndex]="zIndex"\r\n           [destroy]="destroy">\r\n  <label *ngIf="false" class="textField " for="lang">\r\n    <span [innerHTML]="\'magnifier\' | loadInlineSvg | sanitizeHTML"></span>\r\n    <input type="text" name="lang" [(ngModel)]="searchLang" (change)="change();"\r\n           [ngClass]="{\'pinLabel\': searchLang != null && searchLang.length > 0}"\r\n    >\r\n    <div class="label"><span [translate]="\'CHANGE_LANG.SEACH_FOR_YOUR_LANGUAGE_OR_COUNTRY\'"></span></div>\r\n  </label>\r\n  <div class="recommended">\r\n    <app-lang-radio-btn (langChanged)="languageChanged($event);" [lang]="recommanded_language" [recommanded]="true"\r\n                        [checked]="selected_language == recommanded_language"></app-lang-radio-btn>\r\n  </div>\r\n  <div class="others">\r\n    <app-lang-radio-btn *ngFor="let lang of other_languages"\r\n                        [lang]="lang" (langChanged)="languageChanged($event);"\r\n                        [recommanded]="false" [checked]="lang == selected_language"></app-lang-radio-btn>\r\n  </div>\r\n</app-modal>\r\n'
    },
    "./src/app/modal/set-language/set-language.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return u
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/modal/modal-interface.ts"),
            o = n("./node_modules/@angular/router/esm5/router.js"),
            s = n("./src/environments/environment.ts"),
            i = n("./src/app/_services/locale.service.ts"),
            c = n("./node_modules/@angular/common/esm5/common.js"),
            l = this && this.__extends || function() {
                var e = Object.setPrototypeOf || { __proto__: [] }
                instanceof Array && function(e, t) {
                    e.__proto__ = t
                } || function(e, t) {
                    for (var n in t) t.hasOwnProperty(n) && (e[n] = t[n])
                };
                return function(t, n) {
                    function a() {
                        this.constructor = t
                    }

                    e(t, n), t.prototype = null === n ? Object.create(n) : (a.prototype = n.prototype, new a)
                }
            }(),
            d = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            p = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            h = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            };
        n("./src/frontend/containers/LanguageSelection/LanguageSelection.scss");
        var u = function(e) {
            function t(t, n, a) {
                var r = e.call(this) || this;
                return r.document = t, r.router = n, r.localeService = a, r.recommanded_language = null, r.other_languages = null, r.selected_language = null, r.searchLang = null, r
            }

            return l(t, e), t.prototype.change = function() {
                this.other_languages.find(this.searchLang)
            }, t.prototype.languageChanged = function(e) {
                this.localeService.setTranslation(e);
                var t = this.router.url.replace(/^\/([^\/]+)(\/?.*?)/g, e + "$2");
                this.document.location.assign(t), this.destroy()
            }, t.prototype.ngOnInit = function() {
                this.searchLang = null, this.selected_language = s.a.selectedLang, this.recommanded_language = s.a.selectedLang, this.other_languages = Object.keys(s.a.translations)
            }, t = d([Object(a.Component)({ template: n("./src/app/modal/set-language/set-language.component.html") }), h(0, Object(a.Inject)(c.DOCUMENT)), p("design:paramtypes", [Object, o.b, i.a])], t)
        }(r.a)
    },
    "./src/app/sub-page/sub-page.component.html": function(e, t) {
        e.exports = '<div [id]="contentId">\n  <app-main-navigation [forceCollapsed]="true"></app-main-navigation>\n  <svg class="filter">\n    <filter class="filter" id="grayscale">\n      <feGaussianBlur in="SourceGraphic" result="blur" stdDeviation=".4"></feGaussianBlur>\n      <feColorMatrix in="blur" result="saturate" type="saturate" values=".6"></feColorMatrix>\n      <feColorMatrix in="saturate" result="color" type="matrix"\n                     values=".4 0   0   0   0 0  .4  0   0   0 0  0   .4  0   0 0  0   0   1   0"></feColorMatrix>\n    </filter>\n    <feMerge>\n      <feMergeNode in="color"></feMergeNode>\n      <feMergeNode in="SourceGraphic"></feMergeNode>\n    </feMerge>\n  </svg>\n  <div *ngIf="sectionId == \'contentPage\'" class="contentPageHeader">\n    <img *ngFor="let img of images" [src]="img.src" [class]="img.class" srcset="{{ img.srcset | buildSourceSet }}">\n    <app-breadcrumb [parts]="breadcrumb"></app-breadcrumb>\n    <h1>{{ title }}</h1>\n  </div>\n  <div *ngIf="sectionId == \'contentPage\'" class="content">\n    <ng-content></ng-content>\n  </div>\n  <section *ngIf="sectionId != \'contentPage\'" [id]="sectionId">\n    <img *ngFor="let img of images" [src]="img.src" [class]="img.class" style="filter: url(\'#grayscale\');"\n         srcset="{{ img.srcset | buildSourceSet }}">\n    <app-breadcrumb [parts]="breadcrumb"></app-breadcrumb>\n    <ng-content></ng-content>\n  </section>\n  <app-footer></app-footer>\n</div>\n'
    },
    "./src/app/sub-page/sub-page.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return i
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/app/_services/locale.service.ts"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            i = function() {
                function e(e) {
                    this.localeService = e, this.images = [], this.battle_page_images = {
                        ltr: [{
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/battle_illu_1x.jpg"),
                            class: "background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/battle_illu_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/battle_illu_2x.jpg")
                            }
                        }],
                        rtl: [{
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/battle_illu_1x.jpg"),
                            class: "background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/battle_illu_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/battle_illu_2x.jpg")
                            }
                        }]
                    }, this.background_images = {
                        ltr: [{
                            src: n("./src/frontend/containers/Journey/PlayNow/ltr/backgroundScene_1x.jpg"),
                            class: "background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/PlayNow/ltr/backgroundScene_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/PlayNow/ltr/backgroundScene_2x.jpg")
                            }
                        }],
                        rtl: [{
                            src: n("./src/frontend/containers/Journey/PlayNow/rtl/backgroundScene_1x.jpg"),
                            class: "background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/PlayNow/rtl/backgroundScene_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/PlayNow/rtl/backgroundScene_2x.jpg")
                            }
                        }]
                    }, this.content_page_images = {
                        ltr: [{
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/contentpage_bg_1x.jpg"),
                            class: "background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/contentpage_bg_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/ltr/contentpage_bg_2x.jpg")
                            }
                        }],
                        rtl: [{
                            src: n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/contentpage_bg_1x.jpg"),
                            class: "background",
                            srcset: {
                                "1x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/contentpage_bg_1x.jpg"),
                                "2x": n("./src/frontend/containers/Journey/FixedBackgrounds/rtl/contentpage_bg_2x.jpg")
                            }
                        }]
                    }, this.breadcrumb = [], this.contentId = "", this.sectionId = "", this.title = ""
                }

                return e.prototype.setImages = function(e) {
                    "battlePage" === this.sectionId ? this.images = this.battle_page_images[e] : "contentPage" === this.sectionId ? this.images = this.content_page_images[e] : this.images = this.background_images[e]
                }, e.prototype.ngOnInit = function() {
                    var e = this;
                    this.setImages(this.localeService.data.direction), this.localeService.dataChanged.subscribe(function(t) {
                        e.setImages(t.direction)
                    })
                }, o([Object(a.Input)(), s("design:type", Object)], e.prototype, "breadcrumb", void 0), o([Object(a.Input)(), s("design:type", Object)], e.prototype, "contentId", void 0), o([Object(a.Input)(), s("design:type", Object)], e.prototype, "sectionId", void 0), o([Object(a.Input)(), s("design:type", Object)], e.prototype, "title", void 0), e = o([Object(a.Component)({
                    selector: "app-sub-page",
                    template: n("./src/app/sub-page/sub-page.component.html")
                }), s("design:paramtypes", [r.a])], e)
            }()
    },
    "./src/environments/environment.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return a
        });
        var a = {
            production: !0,
            reCaptchaSiteKey: "6LektB4lAAAAANDh5BL9hVAABqQ5VLDd-KSuR_Bs",
            selectedLang: "international",
            showFinishTrainingInfo: !1,
            translations: {
                international: {
                    name: "international",
                    flag: "international",
                    language: "en-US",
                    langNative: "English",
                    langEnglish: "English",
                    countryNative: "International",
                    countryEnglish: "International",
                    direction: "ltr",
                    dateFormat: "[month].[day].[year]",
                    hrefLang: "international",
                    reCaptchaLang: "en"
                },
                ae: {
                    name: "ae",
                    flag: "ae",
                    language: "ar-AE",
                    langNative: "العربية",
                    langEnglish: "Arabic",
                    countryNative: "الإمارات العربية",
                    countryEnglish: "United Arab Emirates",
                    direction: "rtl",
                    hrefLang: "ae"
                },
                gr: {
                    name: "gr",
                    flag: "gr",
                    language: "el-GR",
                    langNative: "Ελληνικά",
                    langEnglish: "Greek",
                    countryNative: "Ελλάδα",
                    countryEnglish: "Greece",
                    direction: "ltr",
                    hrefLang: "gr"
                },
                ir: {
                    name: "ir",
                    flag: "ir",
                    language: "fa-IR",
                    langNative: "فارسی",
                    langEnglish: "Farsi",
                    countryNative: " ایران",
                    countryEnglish: "Iran",
                    direction: "rtl",
                    hrefLang: "ir",
                    dateFormat: "[year]/[month]/[day]",
                    reCaptchaLang: "fa"
                }
            },
            BUILD_VERSION: "1.0.0"
        }
    },
    "./src/frontend/components/AjaxLoader/ButtonAjaxLoader.scss": function(e, t) {},
    "./src/frontend/components/Box/Box.scss": function(e, t) {},
    "./src/frontend/components/BoxGrid/BoxGrid.scss": function(e, t) {},
    "./src/frontend/components/Breadcrumb/Breadcrumb.scss": function(e, t) {},
    "./src/frontend/components/Button/Button.scss": function(e, t) {},
    "./src/frontend/components/CookieInfo/CookieInfo.scss": function(e, t) {},
    "./src/frontend/components/Error/DeprecatedBrowser/DeprecatedBrowser.scss": function(e, t) {},
    "./src/frontend/components/Flag recursive ^\\.\\/.*\\.svg$": function(e, t, n) {
        function a(e) {
            return n(r(e))
        }

        function r(e) {
            var t = o[e];
            if (!(t + 1)) throw new Error("Cannot find module '" + e + "'.");
            return t
        }

        var o = {
            "./ae.svg": "./src/frontend/components/Flag/ae.svg",
            "./gr.svg": "./src/frontend/components/Flag/gr.svg",
            "./international.svg": "./src/frontend/components/Flag/international.svg",
            "./ir.svg": "./src/frontend/components/Flag/ir.svg",
            "./tr.svg": "./src/frontend/components/Flag/tr.svg",
            "./uk.svg": "./src/frontend/components/Flag/uk.svg",
            "./us.svg": "./src/frontend/components/Flag/us.svg"
        };
        a.keys = function() {
            return Object.keys(o)
        }, a.resolve = r, e.exports = a, a.id = "./src/frontend/components/Flag recursive ^\\.\\/.*\\.svg$"
    },
    "./src/frontend/components/Flag/Flag.scss": function(e, t) {},
    "./src/frontend/components/Flag/ae.svg": function(e, t) {
        e.exports = '<svg viewBox="0 0 640 480"><path fill="#00732f" d="M0 0h640v160H0z"></path><path fill="#fff" d="M0 160h640v160H0z"></path><path d="M0 320h640v160H0z"></path><path fill="red" d="M0 0h220v480H0z"></path></svg>'
    },
    "./src/frontend/components/Flag/gr.svg": function(e, t) {
        e.exports = '<svg viewBox="0 0 640 480"><path fill="#0d5eaf" d="M0 0h640v53H0z"></path><path fill="#fff" d="M0 53h640v53H0z"></path><path fill="#0d5eaf" d="M0 107h640v53H0z"></path><path fill="#fff" d="M0 160h640v53H0z"></path><path fill="#0d5eaf" d="M0 213h640v53H0z"></path><path fill="#fff" d="M0 267h640v53H0z"></path><path fill="#0d5eaf" d="M0 320h640v53H0z"></path><path fill="#fff" d="M0 373h640v53H0z"></path><path fill="#0d5eaf" d="M0 427h640v53H0zM0 0h237v267H0z"></path><g fill="#fff"><path d="M95 0h47v267H95z"></path><path d="M0 107h237v53H0z"></path></g></svg>'
    },
    "./src/frontend/components/Flag/international.svg": function(e, t) {
        e.exports = '<svg viewBox="0 0 640 480"><path fill="#4B92DB" d="M0 0h640v480H0V0z"></path><g fill="#FFF"><path d="M364.919 377.7c-1.9 2.3-4.4 4.4-6.8 6.3-15.2-16.2-33-34.1-49.9-34.1-10.5 0-18.1 8.2-26.9 14-12.2 8.1-29 12.6-43.4 6.7-7.7-3-15.2-7.5-20.9-14.7 11.3 8 28.3 9.1 41.1 3.7 14.1-6 28.5-14.1 44.6-14.1 23.8.1 46.3 16.6 62.2 32.2zm-175.6-50.8c15.7 18.4 41.4 12.5 62.4 17.1 2.9.6 5.7 1.6 8.8 1.1-2.5-1.6-5.8-1.8-8.7-2.9-16.3-6.3-18.8-24.3-27.7-36.6 11.4 7.8 20.8 18.5 31.5 28.5 7.4 7 16.6 10 26.2 12-2.3.9-5.3.7-7.8 1.3-17.2 4.4-36.3 11.3-54.6 5.1-11.8-4.1-24.1-13.6-30.1-25.6zm-25.2-42.7c9.8 22.9 34.5 24.7 50.8 38.7 3.1 2.7 6.2 5.1 9.6 6.8l.2-.2c-3.8-3.5-7.9-7.7-10.8-12.1-9.4-14-6.2-33.2-13.5-48 6.6 8.1 12.7 16.4 16.5 25.7 6.1 14.9 8.1 31.9 21.8 43.2-14.8-5-31.8-4-45.1-13-13.9-9.4-26.8-24.3-29.5-41.1zm-10.5-46.2c1.4 20.1 22.3 30.9 32.2 47.5 2.1 3.5 4.3 7.2 7.4 10-.5-2.1-2.2-4-3.1-6.2-3.2-7.1-4.6-15.3-3.8-23.8 1-10.3 5.1-19.8 3.5-30.7 8.6 19 5.8 42.8 10.7 63.4 1.1 4.6 3.8 8.5 5.4 12.8-8.4-6.6-19.4-12.4-28.7-19.9-8.9-7.2-16.7-15.7-20.7-26.8-2.9-7.9-3.6-17.4-2.9-26.3zm.6-37.2c1-4.5 1.8-9.2 3.7-13.3-3.6 19 8.7 32.7 12.9 49.2 1.6 6.2 2.1 12.8 4.6 18.6.2.1.4-.1.6-.3-6.1-17.5 2.8-33.7 11.5-47.5 2.3-3.6 3.4-7.8 4.4-12.1.9 7.9-.7 17.1-2.1 25.3-1.8 10.5-5.3 20.4-8.1 30.5-1.8 6.3-1.3 13.5-.4 20.2l-.9-.7c-6.4-12.2-19.2-21.8-23-35.2-3.2-10.7-5.4-23.1-3.2-34.7zm6.8-20.4c0-14.4 5.4-26.1 13.6-36.8.2-.1.4-.4.7-.3-9 14.1-.8 31.8-2 47.8l-1.2 16.4c.2.1.2.6.6.4.5-1.8.7-3.8 1-5.7 2.2-13.2 13.4-22.4 23-31.7 2.3-2.2 3.9-4.8 5-7.6-.8 6.6-2.6 13.3-5.4 19.3-7.3 15.3-21.5 27.7-24.1 45.1-1.3-16.7-11.2-29.2-11.2-46.9zm23.6-48.5c4.5-5.2 9.6-9.2 15.6-10.8-11.7 8.3-11.1 23.1-14.6 35.5-1.3 4.5-3.2 8.8-4.3 13.4l.3.2c1.9-5.3 5.3-10.4 9.6-14.6 8.2-8 20.6-12.8 24.7-24.5-.2 16.3-13.6 28.6-25.9 38.2-5.5 4.3-10.2 10-13.1 16.1.5-4.5.7-8.2.3-12.6-1.2-14.2-2-30.2 7.4-40.9zm47.5-27.4c-8.7 7.8-14.5 17.9-21.2 27-5.5 7.6-13.2 12.2-19.7 18.6 3.5-7.6 4.2-16.2 8.7-23.5 7.7-12.5 20.4-17.3 32.2-22.1z"></path><path d="M275.119 377.7c1.9 2.3 4.4 4.4 6.8 6.3 15.2-16.2 33-34.1 49.9-34.1 10.5 0 18.1 8.2 26.9 14 12.2 8.1 29 12.6 43.4 6.7 7.7-3 15.2-7.5 20.9-14.7-11.3 8-28.3 9.1-41.1 3.7-14.1-6-28.5-14.1-44.6-14.1-23.8.1-46.3 16.6-62.2 32.2zm175.6-50.8c-15.7 18.4-41.4 12.5-62.4 17.1-2.9.6-5.7 1.6-8.8 1.1 2.5-1.6 5.8-1.8 8.7-2.9 16.3-6.3 18.8-24.3 27.7-36.6-11.4 7.8-20.8 18.5-31.5 28.5-7.4 7-16.6 10-26.2 12 2.3.9 5.3.7 7.8 1.3 17.2 4.4 36.3 11.3 54.6 5.1 11.8-4.1 24.1-13.6 30.1-25.6zm25.2-42.7c-9.8 22.9-34.5 24.7-50.8 38.7-3.1 2.7-6.2 5.1-9.6 6.8l-.2-.2c3.8-3.5 7.9-7.7 10.8-12.1 9.4-14 6.2-33.2 13.5-48-6.6 8.1-12.7 16.4-16.5 25.7-6.2 14.9-8.2 31.9-21.9 43.2 14.8-5 31.8-4 45.1-13 14-9.4 26.9-24.3 29.6-41.1zm10.5-46.2c-1.4 20.1-22.3 30.9-32.2 47.5-2.1 3.5-4.3 7.2-7.4 10 .5-2.1 2.2-4 3.1-6.2 3.2-7.1 4.6-15.3 3.8-23.8-1-10.3-5.1-19.8-3.5-30.7-8.6 19-5.8 42.8-10.7 63.4-1.1 4.6-3.8 8.5-5.4 12.8 8.4-6.6 19.4-12.4 28.7-19.9 8.9-7.2 16.7-15.7 20.7-26.8 2.9-7.9 3.6-17.4 2.9-26.3zm-.6-37.2c-1-4.5-1.8-9.2-3.7-13.3 3.6 19-8.7 32.7-12.9 49.2-1.6 6.2-2.1 12.8-4.6 18.6-.2.1-.4-.1-.6-.3 6.1-17.5-2.8-33.7-11.5-47.5-2.3-3.6-3.4-7.8-4.4-12.1-.9 7.9.7 17.1 2.1 25.3 1.8 10.5 5.3 20.4 8.1 30.5 1.8 6.3 1.3 13.5.4 20.2l.9-.7c6.4-12.2 19.2-21.8 23-35.2 3.2-10.7 5.3-23.1 3.2-34.7zm-6.8-20.4c0-14.4-5.4-26.1-13.6-36.8-.2-.1-.4-.4-.7-.3 9 14.1.8 31.8 2 47.8l1.2 16.4c-.2.1-.2.6-.6.4-.5-1.8-.7-3.8-1-5.7-2.2-13.2-13.4-22.4-23-31.7-2.3-2.2-3.9-4.8-5-7.6.8 6.6 2.6 13.3 5.4 19.3 7.3 15.3 21.5 27.7 24.1 45.1 1.3-16.7 11.2-29.2 11.2-46.9zm-23.6-48.5c-4.5-5.2-9.6-9.2-15.6-10.8 11.7 8.3 11.1 23.1 14.6 35.5 1.3 4.5 3.2 8.8 4.3 13.4l-.3.2c-1.9-5.3-5.3-10.4-9.6-14.6-8.2-8-20.6-12.8-24.7-24.5.2 16.3 13.6 28.6 25.9 38.2 5.5 4.3 10.2 10 13.1 16.1-.5-4.5-.7-8.2-.3-12.6 1.2-14.2 2-30.2-7.4-40.9zm-47.5-27.4c8.7 7.8 14.5 17.9 21.2 27 5.5 7.6 13.2 12.2 19.7 18.6-3.5-7.6-4.2-16.2-8.7-23.5-7.7-12.5-20.4-17.3-32.2-22.1z"></path></g><path fill="#FFF" d="M426.1 267l-2.6-1.4c-5.4 11.5-12.6 22.1-21.3 31.1l-15-15.4c7.3-7.8 13.3-16.6 17.6-26.2l-2.6-1.4c-4.3 9.5-10.1 18.1-17.1 25.5l-13.6-14c5.8-6.2 10.5-13.4 13.8-21l-2.5-1.4c-3.3 7.6-7.8 14.5-13.3 20.4l-15-15.4c4.2-4.6 7.4-9.8 9.6-15.5l-2.5-1.4c-2.1 5.5-5.2 10.5-9.1 14.8l-13.6-14c3.9-4.5 6.1-10 6.4-16h19.3c-.2 5.4-1.2 10.5-3 15.2l2.5 1.4c2-5.3 3.2-10.9 3.3-16.7h21.2c-.2 9.7-2.3 18.8-5.9 27.2l2.5 1.4c3.9-8.9 6-18.6 6.2-28.6h19.2c-.2 13.6-3.2 26.5-8.5 38.1l2.6 1.4c5.6-12.2 8.6-25.7 8.8-39.5H435c-.2 17.9-4.3 34.9-11.4 50l2.5 1.4c7.7-16.3 11.8-34.3 11.8-52.9 0-15.9-2.9-31.2-8.6-45.5l-2.6 1.2c5.3 13.5 8.1 27.9 8.3 42.9h-21.2c-.2-11.9-2.4-23.5-6.6-34.2l-2.6 1.2c4 10.4 6.2 21.6 6.4 33.1h-19.2c-.2-8.8-1.8-17.3-4.8-25.2l-2.6 1.2c2.9 7.6 4.4 15.7 4.6 24.1h-21.2c-.2-5.3-1.1-10.5-2.9-15.4l-2.6 1.2c1.6 4.5 2.5 9.3 2.7 14.3h-19.3c-.3-6-2.6-11.6-6.4-16l13.6-14c4.2 4.6 7.4 10 9.4 15.8l2.6-1.2c-2.2-6.1-5.6-11.8-10-16.7l15-15.5c6.4 6.9 11.3 14.8 14.5 23.5l2.6-1.2c-3.4-9-8.5-17.3-15.2-24.4l13.6-14c8.4 8.9 14.9 19.3 19.2 30.6l2.6-1.2c-4.5-11.6-11.2-22.3-19.8-31.5l15-15.5c10.6 11.2 18.8 24.2 24.4 38.3l2.6-1.2c-5.8-14.9-14.6-28.6-26-40.3-11.4-11.8-24.8-20.8-39.3-26.8l-1 2.7c13.7 5.7 26.4 14.1 37.3 25.1l-15 15.5c-8.8-8.8-19-15.6-30-20.2l-1 2.7c10.7 4.5 20.6 11 29.1 19.6l-13.6 14c-6.6-6.6-14.2-11.6-22.5-15.1l-1 2.7c7.9 3.3 15.2 8.2 21.5 14.5l-15 15.5c-4.2-4.1-9.1-7.3-14.3-9.6l-1 2.7c4.9 2.1 9.4 5.1 13.3 8.9l-13.6 14c-4.3-4-9.8-6.3-15.6-6.6v-19.8c5.5.2 10.9 1.4 15.9 3.5l1-2.7c-5.3-2.3-11-3.6-16.9-3.7v-21.9c8.6.2 16.9 2 24.7 5.2l1-2.7c-8.1-3.4-16.8-5.3-25.7-5.4v-19.8c11.4.2 22.5 2.5 32.8 6.8l1-2.7c-10.6-4.4-22-6.8-33.8-7V95.7c14.5.2 28.5 3.1 41.6 8.5l1-2.7c-13.8-5.7-28.7-8.7-44-8.7-18.9 0-36.8 4.7-52.7 12.9l1.3 2.6c15.4-7.9 32.4-12.2 50-12.5v21.9c-14.4.2-28 3.8-40.1 10l1.3 2.5c11.9-6.1 25.1-9.4 38.8-9.6v19.8c-10.7.2-20.8 2.9-29.9 7.4l1.3 2.6c8.8-4.4 18.5-6.8 28.6-7.1v21.9c-6.7.2-13 1.8-18.7 4.6l1.3 2.6c5.4-2.6 11.3-4 17.4-4.2V188c-3 .2-5.8.9-8.5 2l1.3 2.6c2.7-1.1 5.6-1.7 8.6-1.7 6.1 0 11.7 2.4 16 6.8 4.3 4.4 6.6 10.3 6.6 16.5 0 12.9-10.2 23.3-22.7 23.3-6.1 0-11.7-2.4-16-6.8-4.3-4.4-6.6-10.3-6.6-16.5s2.4-12.1 6.6-16.5c2.2-2.2 4.7-3.9 7.4-5.1l-1.3-2.6c-2.6 1.1-5 2.7-7.1 4.6l-13.6-14c3.5-3.4 7.5-6.2 11.8-8.2l-1.3-2.6c-4.6 2.2-8.8 5.2-12.5 8.7l-15-15.5c5.3-5.2 11.2-9.5 17.6-12.7l-1.3-2.6c-6.8 3.4-12.9 7.9-18.3 13.2l-13.6-14c6.9-6.9 14.6-12.5 23-16.7l-1.3-2.5c-8.8 4.5-16.7 10.3-23.7 17.2l-15.1-15.5c8.6-8.7 18.4-15.8 28.9-21.2l-1.3-2.6c-22.9 11.9-41.6 31.2-53 54.9l2.5 1.4c5.3-11.1 12.3-21.4 20.9-30.5l15.1 15.5c-7 7.4-12.9 16-17.3 25.4l2.5 1.4c4.2-9 9.8-17.4 16.8-24.8l13.6 14c-5.5 5.9-10 12.7-13.4 20.2l2.5 1.4c3.2-7.1 7.5-13.7 12.9-19.5l15 15.5c-3.8 4.2-7 9.1-9.2 14.5l2.5 1.4c2-5.1 5-9.7 8.7-13.8l13.6 14c-3.7 4.3-6.1 9.9-6.5 16h-19.3c.2-5.7 1.3-11.1 3.4-16.2l-2.5-1.4c-2.2 5.4-3.6 11.4-3.7 17.6h-21.2c.2-9.8 2.3-19.4 6.2-28.1l-2.5-1.4c-4 9-6.4 18.9-6.6 29.4h-19.2c.2-13.7 3.3-26.9 8.8-38.9l-2.5-1.4c-5.7 12.2-9 25.9-9.2 40.3H205c.2-17.9 4.3-35.1 11.7-50.7l-2.5-1.4c-7.7 16.2-12.1 34.3-12.1 53.5 0 11.7 1.6 23.2 4.7 34.2l2.8-.7c-2.9-10.3-4.5-21-4.7-32h21.2c.1 9.2 1.5 18.1 4 26.7l2.8-.7c-2.5-8.3-3.8-17-3.9-26h19.2c.1 7.3 1.3 14.4 3.4 21.1l2.8-.7c-2-6.5-3.2-13.4-3.3-20.4h21.2c.1 5.2 1.1 10.3 2.7 15l2.8-.7c-1.6-4.5-2.5-9.4-2.7-14.3h19.3c.3 6 2.6 11.6 6.4 16l-13.6 14c-4.2-4.6-7.4-10-9.4-15.7l-2.8.7c2.2 6.3 5.6 12.1 10.2 17.1l-15 15.5c-7.3-7.8-12.7-17.1-15.8-27.2l-2.8.7c3.3 10.6 8.9 20.3 16.6 28.6l-13.6 14c-10.2-10.8-17.5-23.7-21.7-37.7l-2.8.7c4.3 14.5 11.9 27.9 22.4 39.1l-15 15.5c-13.3-14-22.8-30.9-28-49.2l-2.8.7c5.5 19.3 15.6 37 29.8 51.6 9.6 9.9 20.6 17.9 32.5 23.7l1.4-2.6c-11.3-5.5-21.7-13-30.9-22.2l15-15.5c7.8 7.8 16.7 14 26.3 18.6l1.4-2.6c-9.4-4.4-18.1-10.5-25.7-18.1l13.6-14c6.4 6.3 13.7 11.3 21.6 14.7l1.4-2.6c-7.7-3.3-14.8-8.1-21-14.2l15-15.5c4.8 4.7 10.4 8.2 16.5 10.5l1.4-2.6c-5.9-2.1-11.3-5.4-16-9.9l13.6-14c4.3 4 9.8 6.3 15.6 6.6v19.8c-4.6-.1-9-1-13.2-2.5l-1.4 2.6c4.7 1.7 9.6 2.7 14.7 2.8v21.9c-8.8-.2-17.3-2.1-25.2-5.5L292 282c8.3 3.6 17.3 5.6 26.6 5.8v19.8c-12.7-.2-24.9-3.1-36.1-8.3l-1.4 2.6c11.6 5.5 24.4 8.5 37.5 8.7v21.9c-16.9-.2-33.2-4.1-48-11.4l-1.4 2.6c15.7 7.7 32.9 11.8 50.8 11.8 18.8 0 36.8-4.5 53.1-13l-1.3-2.7c-15.2 7.9-32.2 12.5-50.3 12.7v-21.9c14.3-.2 28.1-3.8 40.6-10.2l-1.3-2.6c-11.9 6.1-25.2 9.7-39.3 9.9v-19.8c10.8-.2 21.1-2.9 30.5-7.7l-1.3-2.6c-8.8 4.5-18.7 7.2-29.2 7.4v-21.9c6.9-.2 13.5-1.9 19.5-4.9l-1.3-2.6c-5.5 2.8-11.7 4.4-18.1 4.6v-19.8c5.8-.3 11.2-2.6 15.6-6.6l13.6 14c-3.3 3.2-7 5.8-11 7.8l1.3 2.6c4.3-2.1 8.2-4.9 11.7-8.4l15 15.4c-5 5-10.7 9.1-17 12.3l1.3 2.6c6.4-3.3 12.4-7.6 17.7-12.9l13.6 14c-6.6 6.6-14.2 12.2-22.5 16.5l1.3 2.6c8.4-4.4 16.3-10.1 23.2-17l15 15.4c-8.4 8.4-18 15.5-28.5 21l1.3 2.7c11-5.7 21.2-13.3 30.2-22.6 9.4-9.6 17-20.7 22.7-32.8z"></path><path fill="#FFF" d="M326 186l.1.9h.7l-.1-.9h-.7zM325 184.8h.9v.7h-.9v-.7zM324.1 184.7l.1-.7-.8-.2-.1.8.8.1zM322.6 184.3l-.9-.1.1-.7.9.1-.1.7zM315.7 183.3h.9v.7h-.9v-.7zM314.5 184.9l.1-.7-.8-.1-.1.7.8.1zM313.7 185.9l-.9-.2.2-.7.9.2-.2.7zM312 186.9l-.1-.8.7-.1.1.7-.7.2zM218.4 261.8h-.6v1.3h.9v1.6h.8l-.2-1.9-.9-.3v-.7zM225 270.9l-.4-1.1-.9-2.2 1.8.8.6 1.8.8.6.9 1.8-.5.9-1.3-1.2-1-1.4zM251.8 305.7l-1-1.5 1.5.2 1.5 1.4.6 1.6-.8.5-.5-.7-1.2-.4-.1-1.1zM316.3 194H315l-.2-2.7.7-.5v-1.4h-4.2l-.1-1.4.6-.4-1-.4-.7 1-.2 1.1-1.2.2v.6h-.8v1.6l-3.3 2.9-6.7-.2c-.5 1.1-1.7-.1-1.7-.1-.2-.7-1.9 0-1.9 0 0 1.4-2.3-.6-2.3-.6l-4.2-3.1c-2.4-2.2-5.9.6-6.1 1.2.1 1.7-2.7.4-2.7.4s-2.4-.7-2.7.2c-.4 1-1.9.7-1.9.7l-.2.5-1.2.2-.2.7-1.4.2 3.6-.1c1-.1-.4 2.1-1 2l-1.7.1-.6.6h-1.5l-.7 1-2.3-.1s-1.3 1.1-1.2 1.5c.1.4-.2 1.5-.6 1.5s-1.1 1.1-.8 1.5c.2.4-.7 1.6-.7 1.6l-.2 1.2-.7.2v3.4l-1.4 1v1.5l-2.1 2.4.2 2-1.8 2 .2 2-1.1.4-.2.9-.5 2.6 1.2.1c.6-.2.5 1.6 0 1.9-.5.2-1.8.7-1.1 1.2s-1.9.4-1.9-.4c0-.7-1.4-1.4-1.8-1.1-.4.2-1-1.1-1-1.1-1.3-1.4-5.3.1-5.3.1l-.6 2c-1.3.2-2.1 2.5-2.1 2.5-1.1.4-1.9 1.7-1.5 2.1.4.4-.6.5-.6.5v2.7l-.6.9.1 3c.7 0 .6 1.4.6 1.4-1.2.1-1 1.7-1 1.7l-2.5.9-.5.7-3.1-.1-.8.9-.8-.9h-5.9l-.2-.6-1.2-.2-.1-1.4-1.8.1-.4.7-1.9.1c.1 1.2-1.9 3.1-2.1 2.6-.2-.5-1.5-1.9-1-2.1.6-.2 2.1-.5 2.1-.5v-.6l-4.4-.1-.5.7-1.8.1v2l-.8.3c-.6.4.1 1.7.1 1.7.8.9-.1 2.2-.1 2.2-.7.7.6 2.1.6 2.1 1 .2-.6 1-.6 1 .2 1.2 1 1.6 1 1.6-.7 1.2.5 1.9.5 1.9l.1 2.1.8.5v1.4l.5.9h1.9l-.1-3.1c-1.7-2 1.4-2.5 1.5-1.7.1.7 1.4 1.1 1.4 1.1.2 1.9 2.3 3 2.9 1.1.6-1.9 1.1-.7 1.4.1.4.9 2.6 3 2.6 3h1.8l.2 1.7c2-.1 2.6.1 3.4 3 .8 2.9 3.1 3.6 3.1 3.6l1.7-.1c0-1.5 1.7.3 1.7 1s3.2 3.6 3.2 3.6l3.2.7 3 2.5 2.3-.2h1c.6-2.1 3.4.1 3.7.9.2.7 2.1 2 2.4 1.4.2-.6 1.5-.2 1.8 1.6.2 1.9 1.1 1.5 1.1 1.5l6.8-.1 2.4-2.1 6.1-.1c3.1-.1 1.2-4.5.6-4.5-1.1-.9.4-4.5.4-4.5l-8.7-8.3c-2 0-.2-3-.2-3 1.5-1-.4-2.6-.4-2.6.2-1.5-.8-3.2-.8-3.2-2.1-1.5-1.5-4.3-1.5-4.3v-2c-1.8-1.7.7-2 .7-2 .8-1.5-.6-2.6-.6-2.6l-.1-1.6-1.9-.2-.2-5.8-4.3-6.3c-.8-.3-.2-1.7-.2-1.7 1.1-.6-.2-2.1-.2-2.1l-.1-2.7 2.5-.2.6-1h1.2l-.1-3.2c.6-1.6 2-.7 2-.7l1.7.1 1-1.9.2-1.5-1.3-.1c-1.4-.9-.7-4.1-.7-4.1 2.3-3.5 4.9-1.5 4.9-1.5l1.7-.1c2.5 1.7.2 5 .2 5-.5.7-.2 3.1-.2 3.1l.6 4-1.5 1.4c-1.3.7-1.3 2.5.1 2.9 1 .1.6 2.5-.8.9-2.1 0 1.2 2 .2 1.5 2.1 1.1 1.7-1 1.7-1l2.9-2.4c1.1-.9 3 1.9 3 2.2 0 .4 4.8.1 4.8.1 1.3.9 1.8 3.1 1.8 3.1 1.3-1.7 4-.1 2 .9 1.9 1.2 1.9 2.4 1.9 2.4 1.5-.5 1.5.7 1.5 1.1 0 .4.5-1.9.5-1.9-1.8-1.4 2.4-1.9 1.2.6l-.7 1.1 1.2 1 .1 2.9c2.6-.2 1.9-3.6 1.9-3.6l1.2-.2c0-1.1.8-.5.8-.5-.8-4.2 1.9-5 1.9-5 1.5-.4 1.7-3.7 1.7-3.7-1.1-.5-.5-2.2.7-.7s-.7-3-.7-3l-.9-.9-1.3-.1-.1-1.4h-2.1l-.4 1.7-.8.2-.2-.5-.4 1.4h-2.1l-.1-1.5 1.3-.4.5-.7.4-2h1.5l2-.6c.1-2.1 1.2-1.6 1.2-1.6l.7.6 1.1.9.1.7-.7.4-.1 1 .4 1.4h1c.4-2 2.9-2 3.6-.7l.7-1.7c-1.7-.9 0-2.2.4-1.6.5.6 1.6-1.6 1.6-1.6s.8 1.1 0-.4.6-2.2.6-2.2c-.2-1.5 1.5-1.2 1.5-1.2l.1-2-1.7-.1c-.4 1.7-1.8.2-1.1-.1.7-.4 1.4-1.1 1.4-1.1v-1.2l.7-.2.1-1.2h1.8l1.5-.7.4-.6 1.7-.1 2.4-2.2-.2-1c-1.4 0 0-1.1 0-1.1l-.8-3z"></path><path fill="#FFF" d="M268.4 218.6l-2.1-.2.1.9h.6c1 1.7.1 6 .1 6s-1.4.1-1.7-.6c-.2-.7-.8 1.6-.4 2 .5.4 2.1 0 2.3 1.4.1 1.4 1.1-.9 1.1-.9v-8.6z"></path><path fill="#FFF" d="M267.5 229.4l-1.2-.7v3l1.9 2.6.7-1.8.2-1.1-.8-.4.1-1.8.7-.2.2-.8-1.8 1.2zM269.4 235.8l-.9.1-.1 1 1 .1v-1.2zM268.3 242.1l-1 .1v.9l1-.1v-.9zM269.7 239.1c.3 0 .5-.2.5-.5s-.2-.5-.5-.5-.5.2-.5.5.2.5.5.5z"></path><ellipse cx="270.5" cy="241.2" fill="#FFF" rx=".5" ry=".5"></ellipse><ellipse cx="270.6" cy="227" fill="#FFF" rx=".5" ry=".5"></ellipse><path fill="#FFF" d="M309.5 215.9l.3-1.5.1-1.1.5-.8 1.4-.6v-2.4h-.7l-.1-.8-1.3-.1-.3.6h-.6l-.1 1h.7l.1.7-.4.5-.3.6-.9.3-2.2 2.1-.1 1-.6.9-.7 1.8-2.5.1-.5 2.3.4 1.8 2.1.9.3-1.2.7-.4.1-1.2.5-.9.7-.9.2-1 1.2-.7 1.4-.3.6-.7zM314.3 217.1v-1.7l-.2-1.6-1.8-.9-1.3 1.2-.2 1.7v1.1l-1.2.2-.2 3.4-.9.4.1 1.2-1.3.4-1.3.4-.2 1.6-.9.6-.5 1.5-.6 3.6s1.1 2.1 1.7 1.1 1.5-1.1 1.5-1.1l.4-.9 3.2.1c.2-1.4 1.8-.9 1.8-.2 0 .6 1.2.1 1.2.1l.8-1.4h1.3l.1-1.5.6-.4v-2c1.9-.6 1.7-2.5 1.7-2.5l.5-.6-.2-.9c-1-.4-.5-1.2.1-1s-.8-1.1-.8-1.1c-.7.6-1.3-.7-1.3-.7l-2.1-.1zM316.2 232.2c-.1 1.5-1.9 2-1.9 2l-1.3-.4-.7-.6-.1-1.7 1.1-.1.2.7 2.7.1zM322.6 224.2c.3 1.1.2-1.7.7-1.6.5.1.1-1.7.1-1.7l-2.1 1.6c1.1.1 1.2 1.2 1.3 1.7zM328.9 217.7c.5 1.1.4 2.7 2.1 4 .6.4-.4 1.2-1 .9-.6-.4-2.3-3.1-2.3-3.1v-1.6c.5-1 1-.6 1.2-.2zM329.7 254.9l-.8.6.4.4.3.6.9-1.4-.8-.2z"></path><path fill="none" d="M325.9 253.5v1.5"></path><path fill="#FFF" d="M344.1 251.1l-.4-.6-.9.6.3.6 1-.6zM377.5 277.6l1.1.5.1 2.1c1.4 1.5 6.1.2 6.1-.1 0-.4-.2-4.6-.2-4.6l-.6-.6-.1-3.1c.5-1.6-2.3-4-2.5-3.5s-1.8.1-1.8.6-.9 3-.5 3.9c.5.9-.4.9-.5 1.7-.1.9-1.3 2.4-1.1 3.1zM374.9 272.6c-.2.9-1.1 1.5-1.5 1.1-.5-.4.6.6.8 1.1.2.5.9.5 1.2 0 .2-.5.1-1.6.4-2.1.2-.4-.8-.6-.9-.1zM369.4 249.9h.8v2.4h-.8v-2.4zM381.7 225.9c-.5-.7 2.4-2 2.9-.5s0 1.2-.5 1.1c-.5-.1-1.7.4-2.4-.6zM384.1 210l1.3.3.2-.7-1.4-.3-.1.7zM381 211.7l.7-.3-.3-.6-.1-.4-.4.2-.9.5-.7-.5-.4.6.9.6.2.2.2-.1.7-.5.1.3zM385.4 181.2h-1.8s.6.2-1.1-1.4c-1.7-1.6-2.7.4-2.7.4l-1.9.2v2l-1 .4.1 1.2 1.3-.1s0 1.5.4.9 3.3.1 3.1 1.6c-.1.6 3 2.2 2.6 4.2 1.5.2 1.2 1.9 1.2 1.9l2 .2.6-1.2.6.1v-.7l-1.3-.4-.2-4-.8-.6.2-1-1-.4.5-1.6-.8-1.7zM390.6 193.9l-1-.1-2.1.4-1.2 2.4s.6.4 1.1 1.2c.5.9.7 6-.7 6.8-1.4.9.1.4.1.4l-.2 2.7c.4 1.2 1 .6 1.3 0 .4-.6.7-.7 1.2-1.4.5-.6 1.2-1.7 1.3-2.6.1-.9.7-2.2.4-2.6-.4-.4.4-2.1.4-2.1s.5-1 0-2 .1-2.1.5-2.6l-1.1-.5zM392 199l.2-1 .7.1-.2 1-.7-.1zM392 202.4l-.6-.3.3-.8.6.4-.3.7zM391 192.5l-.5-1.1s0-1 .2-1.5-.5-1-.8-1.1c-.4-.1-.2-1.1-.4-1.6-.1-.5-.9-.9-.9-.9s-.2-1.9-.2-2.2c0-.4-1.1-.9-.7-1.2.4-.4.6-.9 1-1.1.4-.2-.4-2 .2-1.6s.6 1 .8 1.5c.2.5-.1 2.2.5 2.6.6.4-.1 1.6.8 1.6 1 0 .4 2.4.4 2.4s-.2 1.7.4 1.9c.6.1.2 3.1.2 3.1l-1-.8zM383.2 172.4c.4.5 1.1.9 1.1 1.4s-.2.9.5 1 1.2-.1 1.4.5c.2.6.2 1.6.1 2.1s.1 1.2.7 1.2.7.1.7.5.7-1.4.7-1.4c-.6-.5-1.1-1.6-1.1-1.6s-.6-1.7-.6-2c0-.2-.8-.5-1.2-.6-.4-.1-1-1.2-1-1.2l-1.3.1zM384.4 171.3c-.4-.5-.7-.9-1.2-1.1-.5-.2-.8-.5-1.3-.5s-.9-.5-.7-1.1c.2-.6-.4-.9-.4-1.4s.4-.5 1-.1.5.5 1 1.1.7 1.2 1.2 1.1c.5-.1.8 1.1 1.3.7.5-.4.4.9.4.9l-1.3.4zM370.5 185.3c.7.7-3.6.5-3.6 0s.4-2.2 1.4-1.9c1.1.4 1.2-2.2 1.2-2.2s-.9.1-.1-.4 0-1.2-.4-1.6c-.4-.4-.7-1-.7-1h1.7c.7-.5.9-2.9.9-2.9 1.4.5 2.1-.5 2.1-.5s.2.7.7 1.4c.5.6-1.2.9-.6 1.2.6.4.8 1.5.6 1.9-.2.4-1.5.1-1.5-.4s-.5.6 0 1.2-.6 1.5-.8 1.5c-.2 0-1.8.2-.5 1 1.3.7 2.7.4 2.7.4s1.1-.1 1.4.5c.4.6-.1.7-.7.7s-3.4-.2-3.4-.2-.7 1-.4 1.3zM362.9 186.4c.6-.1 2-.2 2.3.1.2.4-.8.9-.8.9l-1.4.2c-.6-.5-.7-1-.1-1.2zM378.2 176c.9-.5 3-.5 2.9-1.2s1.2-1 1.2-1l.4 1.5 1.1.7.1 1.4s.4-.2-1 .1c-1.3.4-.5 1-.5 1l-2.9.1-.4-1.2-.9-1.4zM373.6 169.3c.7 0-.2 2.9 1.7 2.6 1.9-.2.1.9 1.5 1s1.1-1.1 1.5-2c.5-.9.2-1.4-.6-1.6-.8-.2-.8-.2-1.1-1.2-.2-1-1.2-1.2-1.2-1.2l-.4-1.5-1.5 1-1.5 2.1c.1 1.6.9.8 1.6.8zM376.7 179.8l.4-.7.6.3-.3.7-.7-.3zM375.5 178.6h.7v.9h-.7v-.9zM376.1 162.1l.1 1.1-.7.1-.1-1.1.7-.1zM374.1 173.6h.7v.6h-.7v-.6zM372.2 173.6l-.1-.7 1.2-.1.1.7-1.2.1zM362.4 185.6l-.6-.3.3-.9.7.3-.4.9zM358.7 183.3l-.1-.7 1.2-.1.1.7-1.2.1zM335.4 183.2l.1.8 2.6-.2-.1-.7-2.6.1zM333.7 184.2l-.2-1.1.6-.2.3 1.1-.7.2zM333.2 184.9l-.2-.7.3-.1.2.7-.3.1zM339.1 182.8l-.1.9 1.3.1s.6.5.6.9.8.7 1.3.7 1.8-1 1.8-1 .6-1.7.1-1.6c-.5.1-1.4.9-1.5.1-.1-.7-1.5-.4-1.5-.4l-2 .3zM345.1 181.5c0 .4-.2.9.5 1s2-.5 2.1.2.1 1.2 1.1 1.6c.9.4 1.5.5 2.3.5.7 0 2.3-.2 2.3-.2s1.7.3 2 .6c1.3 1.4 2.1 1.7 2.5 1.1.4-.6-.1-2-.2-2.5s-1.8-2.9-2.4-2.4-.7 0-1.8.4-3.3.1-3.4-.4-1.8-.7-1.8-1.2-1.2-1.1-1.1-.4c.1.7-.8 1.1-1.1.9-.3-.2-1 .8-1 .8zM372.4 165.6l.8-2.7c-1.2-.2-1-1.6-1-1.6-.1-1.1-1.8-2.4-2.4-2s-.4-2.6-.4-2.6 1.1-.7 1.5-.4c.5.4-4-6.2-5-5.6-.9.6-3.1-.6-3-1.7.1-1.1-4.3-4.8-4.3-4.8s-1.4-1-1.7-.2c-.2.7-.7 1.2 0 1.6.7.4.6-.6 1.4.2.8.9 2.4 2 1.8 2.7s-1.3 1-1.3 1l.8 1h1.3l.2 2.1s1.4.7 1.8 1.6c.4.9.4 1.4 0 1.9s-1.1 1.4-1 2.2c.1.9 1.1 1.2 1.1 1.2l.9.1.7.4v1.6c.9-.2 2.5 1.1 2.4 2s.2.4 1.4 1.2c1.2.9.8 1 1.7 1.6 1.2.7 2 .3 2.3-.8z"></path><path fill="#FFF" d="M352.8 148.7c-.1-.5-.4-2.2.4-2.1.7.1.2 0 1.1.4.8.4 1-.6 1-.6h1.3l1.7 1.4-.2 1.1-1.2.1c-.6-1-1.8-.6-1.5.2.2.9-.6 2.5-1.1 2.6s-2 .1-1.9-.6c-.1-.8.4-2.5.4-2.5zM351.9 145.3v-1s-.1-1-.7-1-1.7-.7-1.4-1.2c.2-.5-2-1-2-1s-2-2-1.3-1.7c.7.2.4-.9.4-.9s-1.4.2-1.8.1c-.4-.1-.2-1.2-.2-1.2s-1.4-.4-1.4 0 .5.4.7 1.1c.2.7.1 2 1.2 2.2s1.3.5 1.4 1 1.4.6 1.4.6l1 .5 2.7 2.5zM338.7 131.7l-1-.3v1.1l1.3.2-.3-1zM338.7 127.4c-1.2-1 1.7.7 1.7.7.9 0 1.5.7 1.5 1.1 0 .4 1.3.2 1.3.2l.1-.9-1-1.2-.8-.6s-1.3-.1-1.3-.5c0-.2-1.1 1.6-1.5 1.2zM360.5 128.2c-.3 1.1-.5 2.6-1.1 2.6s-.4 1.6-.4 1.6 1.5 0 2 .1.5 1.4.5 1.4c1.8-.1 2.5 2.4 2.3 3s.7.6.7.6 0 2-.2 2.5 1.5.9 2 1.6c.5.7-.2 3.2-.6 3.4-.4.1.9.5.8 1.1s.4 0 .5 1 .4 3.1.4 3.1l1.7.1c.2-1.6 3.3-1.7 3.8-1.5 2 .7 3.6 4 3.6 4.7s-1.3.9-1.3.9l.2 3.6c2 .6 3.7 3.6 3.4 4.1-.2.5 1.4.4 1.4.4.2-2.2 2.3-1.5 2.4-.7.1.7.5 2.4.5 2.4l.6 1.1.8.9 1.3-.1.4.7 1.5.2s1.3 1.5 1.4 1.9 1.9.2 2.4.4c.5.1 1.2.5 1.3 1.1.1.6.8 1.6.8 1.6s1.4.4 1.5.9.7 1.6.7 1.6l1.2 1 .1 1.1 1.3.1.4 1.5 2.1-.1 1.2-.9c1.5-.9 2.6-2 2.7-2.5s.4-2.4 1.5-2c1.2.4.4-2.7.4-2.7s-1.7-1.2-1.5-1.9c.1-.6-1.7-1.9-1.5-2.4.1-.5-1.5-1.5-1.4-2s-.8-1.9-.8-1.9l-1.8-1.7-.2-1.1-1.4-.1-2.9-3.6.1-1-.8-.1v-1.4l-.8-.5-1.3-.1-2.6-3-.2-1.4h-1.3l.2-2.6c.8-1.1.4-3.2.4-3.2s-1.7.9-2.5.5.4-1.2.4-1.2v-1l-.7-.7s-2 .2-2.1-.1l-.5-2-.1-2.1-.8-.4-.1-.7-1.3.1v-1.5l-.7-.2-.7-.4-.1-1.5-2.6-.1-.8-1.2-1-1.5-3-.2-.7-.7-1.2-.2-.8-.4-.4.6-2.3.1-.1.7c-1.4.4-6.2-.1-6.3.3zM373 125c-.2-1 2.4-1.9 3-1.1.6.7 2.3.9 2.5 4.6.1 1.3-2.1-1.4-2.1-1.4l-1.8-.6c-1-.3-1.5-.9-1.6-1.5zM338.1 126.5l-.6-.3.5-1.1.6.3-.5 1.1zM332 114.3l-1.5-1.6v-1.4l-.5-.5-.5-1.7-1.5-.5-1.5.6-1.7 1.1-1.8.2-1 1.1 3.8.4.7 1.2 2.7.2 1.8 1.9c1.6.6 2-.2 1-1zM331.8 108.2c-.3-1.1-1.8 1.4-.2 1.9 1.5.5 3.1 0 3.1 0l.4-.7 5.9.1c.5-.5.7-1.2.7-1.2s1.4-.5 2-.2c.6.2.1-1.7-.5-1.5s-1.8.1-1.8.1h-2.1c-.1-.9-2-.5-2.1 0s-.8.6-.8.6l-2.7.2c-.4.7-1.8 1.2-1.9.7zM320 129.2c1.8.6 2.5.2 2.6-.3s.2-.6 1-.7c.7-.1-.1-1.6-.8-1.5-.7.1-1.4-.2-1.5-.9-.1-.6-1.3-2.2-1.4-1s-.8 1.2-.7 2.1c0 .8.3 2.1.8 2.3zM306.3 130.5c-.1-.4 2.4-.5 2.7-.1.4.4.1 1 1.2 1s.6.7.5 1.1c-.1.4-1.3.2-1.4-.1-.1-.4-1.9-.5-1.9-.5s-.9-.7-1.1-1.4zM345.8 104.7l-.6-.6-.5.5.8.9.3.2.2-.2 1.2-1-.4-.6-1 .8zM339.4 101.2l-.3.6.9.6.2.1.2-.1 1.3-.9-.4-.6-1.1.8-.8-.5zM336.2 127.2l-1.2-.1-.1.7 1.1.1.7 1.2.6-.4-.8-1.3-.1-.2h-.2zM297.1 161.8l.1 1.4h1.8c.7 0-.6-.9-.6-.9s-1.5.2-1.3-.5zM299.3 161.9l.5-.6.7.6-.5.6-.7-.6zM277.7 138.6l.5-.5.7.8-.5.5-.7-.8zM311 297.9l-.3.7.7.4-.2.2.5.5.6-.6.3-.3-.4-.3-1.2-.6zM302.5 289l-.7.6-.3.3.3.3.9.6.4-.6-.5-.3.4-.3-.5-.6zM391.4 266c-.2-.6-.9-.9-.9-.9l-.2.7c.1 0 .1.1.2.1l.1.6c-.1.1-.1.2-.2.2l.5.5c.4-.4.6-.8.5-1.2zM391.3 263.6l.1-1.1 1.2.1-.1 1.1-1.2-.1zM420 254c.5-.3 1.2-.9 1.1.5s-.6.9-1.1 1.4c-.4.4-.7-1.5 0-1.9zM426.1 248.7v-.2c0-.2 0-.5-.2-.8l-.6.3c.1.2.1.3.1.5s0 .5.2.6c.1.1.3.1.5.1l-.1-.7c0 .1.1.2.1.2zM424.5 249.3c.2.8.4 1.5.5 1.5l.7-.3s-.3-.7-.4-1.5l-.8.3zM421.9 252.3l-.7-.1c-.1.6.1 1.3.6 1.4l.1-.7v-.6zM418.8 237.4c0-.2-.2-.4-.4-.5-.5-.2-1.4.2-1.9.5l.4.6c.5-.3 1-.5 1.2-.4l.7-.2zM385.8 197.7c-.5.5-1.5.7-1.5.7l-.4 1.4-.6.5s.1.4 0 1.2c-.1.9-1.2 1.4-1.2 1.4l-.5.6s-2.9.2-3.2 0c-1.1-.5-.4-2 .4-1.9.7.1-.1-2.1-.1-2.1l1-.1s.1-2.2.5-2.2-.1-.7-.6-1.1c-.5-.4-1.1-1.6-1.5-1.5-.5.1-2.4 0-2.4 0l-.4.7-1.3.2s.1 1-.1 1.2c-.7.9-3.4 2.7-2.3-.4l.4-.7v-1.1l-2.1-.1s-1.1-.4-1.1-.9-.1-1.1-.1-1.1l-2.5-2.9-3-.4-.2-.6-1.8-.2c-2.1-1.1-4-.1-3.7 1.7.4 1.9.9 2.6-.2 2.6-1.2 0-1.4-1-1.4-1s-.9-.4-.9.1-.4 1.5 0 2-.5 1.2-.8.9c-.4-.4-1.3-1.5-1.1-1.9.2-.4-1.7-2.7.2-3.1 1.9-.4-.1-1.5.6-1.7l.9-.5h.9l.6-.5-1.5-.2-.9-.1-1.8-.1c-1.8 1.2-2.1 2.7-2.1 2.7-1 1.9-3.2-.7-2.4-1.7.8-1-2.6-.1-3.2.4s-2.4.2-2.4.2c-.4 1.1-2-.1-1.5-.9.5-.7.5-1.2.5-1.2l-.6-.1-.7 1.4c-1.7 0-2.1 1-1.8 1.6.4.6-.5-.1-.7.7-.2.9.1.9.8 1.2.7.4-.4.4.1 1s1.9 0 1.1.9-2.5.5-2.5.5c-.1 1.1-2.4.9-2.6.5s-2-2.6-2-2.6l-2.3-.1c-.2-1.7 1.1-.9 1.5-2.2.5-1.4.7-3.6.7-3.6s-1.9-.1-2 .5-1.3 1-1.3 1-1 .4-.6.9-.7.7-.7.7.2.8-.1 1.1c-.9 1-3.3.1-3.7-.2l-1.4-.6-1.4-1-1.7.7-.5.5h-1.8l-.1 1.5 3.2.4.2 3.1-1.3-.5h-.8l-.4-.7-.7-.1v2.7l.7.6.6.6 1.2.1.2 1.5 3 .1.4.6 1.8.1 3.4 3.6-.2 1.1-.6.4c.2.9-1.5.4-1.5.4v.7l.8.1.8.5 1.2-2.1c1.3-.9 1.9.4 2 1.1.1.7-.6.6-.6.6v1.7l.7.2c1.2 1.5-.5 2.4-.5 2.4l-.4 1.2c-.4 1.1-1.7.9-1.7.9l-.5.7-1.4.4 2.8.4c.3-1 1-1.2 1.3-.7.4.5.4 1.4.4 1.4l.7.1-.1 1.4.7.2v4l.8 1c1.4-.6 1.4.4.7.9s-.2 2.7-.2 2.7l-.6.6v1l-.7.5v1.4c-1.2-.6-2.6-.4-3 0-1.1-.7-3.3-.5-3.3.1.7 1-.8 1.2-.8 1.2l-.8 1c.6 1.2-.6 1.4-.6 1.4v2.4l-1.4 1.4.1 3.2c0 .9 1.8 1 2.1.5.4-.5 1.8 1 1.8 1h1.1l.2-2.2-.7-.4v-3.6l1.2-1.4c1.4-.5 1 3.2 1 3.6.1 1.4.7 1.2 1.3 1 1.2-.5.2 1.4-.7 1.2-.9-.1-.4 1.2-.4 1.2l.6.2-1.1.9-.9 1.1-1.2-.4-1.4-.1-.5-.9-.8-.1-.1 1.7-.6.7-1.4 1.5c1.9 0-.2 1.4-.7 1.4 1.1.4-.1 1.5-2.9.6v.9l-1 .1.8 1 .9.1-.4 2.1c0 1.6-3.9.5-4.3.1l-.1 2.2-.7.1.1 1.5-.1 2.1 1.3-.2v.9l3.2.1 4.6-5.1 2.7-.6c.2-1.2 1.4.2 1.4.2 1.2-.1 1.4.7 1.4.7l1.5.2c1.3.4.5.5.6 1 .1.7.7.5.7.5l.2-1.6.7.1-.7-.9-1.3-.6-1.4-.6c-1-1.4.2-1.1 1.2-1h1.5s1.8 2.5 1.8 3.1.8.7.8.7l1.1-.1.4.9h1.1l.4.7h2.1l.1-1.1-2-.4-.1-1.2-1.4-.4c-.5-2.1.4-2.7.9-1.7l.7.1-.2-1.9.8-.2-.2-2.6-.7-.2v-.9l3 .1c-.2-1.6.1-2.4.1-2.4h.8l.1.6 3.6.4 2.6-3c-.1-.2.3-.4 0-.7-.4-.4-.8 0-1.4-.4s0-2.5-.1-3 2-1.2 1.7-.1c-.4 1.1 0 1.6 0 1.6 1.5-1.5 2.9.1 2.7.5-.1.4.8.7 1.4.4.6-.4 1.3 1.1 1.1 1.9-.2.7-2.4.6-2.5-.1-.1-.7-.5-.5-.7-.1s-1.3.6-1.9.2c-.1-.1-.2-.1-.2-.2l-2.6 3h.2c1.4.9.7 2 .2 2.2s-1.3.2-1.3.2l-.2.5-3.1.2-.2 1.2c-1.5-.3-2.1 1.5-1.8 2.4.4.9 0 1.6 0 1.6l1.3.6 1.7-.5c.2-1.2 1.3-1.5 2.3-2.2.9-.7 2.5 1.4 2 2.4s-.5 1.4-.5 1.4l.1 1.1-1.2.5-1 .5-.1.6h-3.2l-.6.6-1.5.1-.5.7-1.1.1s-1.8.9-1.1 1.9c.7 1-3 .9-3.8-.5-.2 1.2-1.5.1-1.5.1l-1.3-.4-.1-1.9c-.2-1.2-2.5-1.2-2.4-.4.1.9-4.3.4-4.3.4l-1.4.7-1.3.8-.1.6-2.1.2-.9.5-.4-.7h-1l-1 1.4c-2.5.1-4.9 1.6-4.6 2.2.2.6-.9 1.2-.9 1.2l-1.1.4-.7 1.1-1.4.5-.2 2.6-.7.5v1.1l-.8.2v.6l-1.2.1.7 1.9 1 .5c1.7.2.9 2.4.9 2.4l1 .1.5 1.4.9 2c.4 1.5 1.4 1.1 1.9 1s.9 1.5.9 1.5l4.8.1s-.2.5.6.7c.8.2 6.3.5 6.5.1-.2-1.1 3-1.4 4.3-.4s3.1.4 3.1.4l1.8 2.2 1.2 2.7 2 .6 1.4.4.5 2.1 1.1.1.4 1.4c1.3 1-.4 3.1-.4 3.1v2.7l1 .5-.1 1 1.5 1.6 1.8.1 4.5 5 3.6 1.1.6 2 1-.1.7-.6 2.9-.1 1.4-1.4 1.5-.2 13.2-11.6-1.2-.7v-2.7c2.1-1.6 2.3-4.5.2-4.7-1.5-.2-.8-1.9.6-2.1l.8-.4v-1.1l2.7-2.6v-2l-5.9-5.1c-2.6-1 0-7 1.8-6.8 1.8.1-.1-9.2-.1-9.2l-1-.5.2-3H367l-2.1 2.9-.6 2c-.2 2.6-7.6 2.1-8 1.7s-2.9-1.5-2.9-1.5-1.9-1.6-2.3-1.1-2-.6-2-.2-1.5-.9-1.5-.9l-2.4-.9 1.8-.4-.4-1.5 3.1 1.6c.4.5 1.9.4 1.9.4l.5.6s1-.1 1.5.6c.6.7 3.7.1 3.7.1l.8.7 1.3.5 3.7.1.1-2.4.7-.7-.1-1.5.8-.7v-1.2l.7-.2.1-2.7.6-.1v-6l-1.8-1.7c-.1.6-2 .6-2 .6s-.5.9-.8.9c-.4 0 .5 1.1.2 1.9-.2.7-1.2.7-1.2.7l-1.8.5-.5.6h-1.9l-.2-1.6 2.1-.6 1.2-.6.6-1.2c.1-1.2 1.5-1.1 1.5-1.1s2.7-2.4 2.9-3.5c.1-1.1 1.1-4.2 2.7-4.2h3.1c1.2-.5.8-2.1.8-2.1l1.5-.2.2.9s2.1.2 2.4-.1c.2-.4.7-1.2 1.3-.9.6.4 2.5-.9 2.5-.9.1-.9 3.1-.5 3.1-.5l.4-1.1s-2-2.9-2.4-2.9-2.3-1.7-2.5-1.1c-1.9-.5-1.8-3.2-1.8-3.2l-.7-1.7c0-1-1.8-3.1-2.1-2.9-1.8-1.4-.5-3 0-3.1s1.7-1.9 1.7-1.9l.6-1.7 2-.6.2-1.6-1.1-.1s1.2-2.2 1.8-2.2c.6 0 4.5 0 4.9-.2s1.1-2.2 1.1-2.6c0-.4 1-.5 1.3-.6.4-.1 1.2-1.1 1.4-1.6.5 0-.4-3.2-.9-2.7z"></path><path fill="#FFF" d="M320 242.5c.2-.2.4.6.7.5.4-.1.5.7.2.7-.4 0-.4.5-.4.7s0 .7-.3.9c-.3.3-.5.1-.9-.1s-.5-.2-1-.2c-.4 0-.1.7-.1.7s-1.9-.1-1.5-.4c.4-.3.7-.4.4-.6-.3-.2 0-.4 0-.7 0-.4.9-.2.6-.5s0-1.4.4-.7l.3-.7c-.3-.3-.1-.4-.6-.6-.5-.2-.1-1.3-.1-1.3l.1-.7c.2-.9 2-1 2.1-.2s0 1.4 0 1.4l.5.2s-.1.6-.5.6 0 .3-.3.6l.4.4zM314.1 243.5c.3-.6.9-3 1.6-2.2.7.7 1.2 0 1.2 0s.4.4.2 1.1c-.2.7-.4 1.5-.8 1.6s-.8.4-1.3.5c-.6 0-.9-1-.9-1z"></path></svg>'
    },
    "./src/frontend/components/Flag/ir.svg": function(e, t) {
        e.exports = '<svg viewBox="0 0 640 480"><g fill="#fff"><path d="M0 0h639v480H0z"></path><path d="M0 322h639v157.65H0z"></path><path d="M66 345h3v3.08h-3zM60 329h46v3.17H60zM111 329h3v18.9h-3zM96 345h9v3.17h-9z"></path><path d="M96 337h3v10.57h-3zM111 345h17v3.17h-17z"></path><path d="M96 337h17v3.17H96zM60 337h17v3.17H60zM118 329h3v18.9h-3zM126 329h3v18.9h-3z"></path><path d="M96 337h3v10.57h-3z"></path><path d="M96 337h3v10.57h-3zM73 337h3v10.57h-3zM60 337h3v10.57h-3zM87 337h3v10.57h-3z"></path><path d="M96 337h3v10.57h-3zM75 345h14v3.17H75zM81 337h9v3.17h-9zM21 345h9v3.17h-9zM35 329h3v18.9h-3zM0 329h30v3.17H0z"></path><path d="M21 337h3v10.57h-3zM36 345h17v3.17H36zM0 337h1v3.17H0z"></path><path d="M43 329h3v18.9h-3zM21 337h17v3.17H21zM51 329h3v18.9h-3z"></path><path d="M21 337h3v10.57h-3z"></path><path d="M21 337h3v10.57h-3zM11 337h3v10.57h-3zM0 337h1v10.57H0z"></path><path d="M21 337h3v10.57h-3zM0 345h13v3.17H0zM5 337h9v3.17H5zM141 345h3v3.08h-3zM134 329h46v3.17h-46zM185 329h3v18.9h-3zM171 345h9v3.17h-9z"></path><path d="M171 337h3v10.57h-3zM186 345h17v3.17h-17zM134 337h17v3.17h-17z"></path><path d="M171 337h17v3.17h-17zM201 329h3v18.9h-3zM193 329h3v18.9h-3z"></path><path d="M171 337h3v10.57h-3z"></path><path d="M171 337h3v10.57h-3zM134 337h3v10.57h-3zM148 337h3v10.57h-3z"></path><path d="M171 337h3v10.57h-3zM161 337h3v10.57h-3z"></path><path d="M156 337h9v3.17h-9zM149 345h14v3.17h-14zM216 345h3v3.08h-3zM210 329h46v3.17h-46zM246 345h9v3.17h-9zM261 329h3v18.9h-3z"></path><path d="M246 337h3v10.57h-3zM261 345h17v3.17h-17zM210 337h17v3.17h-17z"></path><path d="M246 337h17v3.17h-17zM268 329h3v18.9h-3zM276 329h3v18.9h-3z"></path><path d="M246 337h3v10.57h-3z"></path><path d="M246 337h3v10.57h-3z"></path><path d="M246 337h3v10.57h-3zM223 337h3v10.57h-3zM210 337h3v10.57h-3zM237 337h3v10.57h-3z"></path><path d="M225 345h14v3.17h-14zM231 337h9v3.17h-9z"></path><g><path d="M292 345h3v3.08h-3zM285 329h46v3.17h-46zM322 345h9v3.17h-9zM336 329h3v18.9h-3z"></path><path d="M322 337h3v10.57h-3zM337 345h17v3.17h-17zM285 337h17v3.17h-17z"></path><path d="M322 337h17v3.17h-17zM352 329h3v18.9h-3zM344 329h3v18.9h-3z"></path><path d="M322 337h3v10.57h-3z"></path><path d="M322 337h3v10.57h-3zM285 337h3v10.57h-3zM299 337h3v10.57h-3zM312 337h3v10.57h-3z"></path><path d="M322 337h3v10.57h-3zM300 345h14v3.17h-14zM306 337h9v3.17h-9z"></path></g><path d="M0 0h639v157.65H0z"></path><g><path d="M412 329h3v18.9h-3zM368 345h3v3.08h-3zM361 329h46v3.17h-46zM398 345h9v3.17h-9z"></path><path d="M398 337h3v10.57h-3zM413 345h17v3.17h-17z"></path><path d="M398 337h17v3.17h-17zM361 337h17v3.17h-17zM428 329h3v18.9h-3zM420 329h3v18.9h-3z"></path><path d="M398 337h3v10.57h-3z"></path><path d="M398 337h3v10.57h-3zM375 337h3v10.57h-3zM361 337h3v10.57h-3zM388 337h3v10.57h-3z"></path><path d="M398 337h3v10.57h-3zM376 345h14v3.17h-14zM382 337h9v3.17h-9z"></path></g><g><path d="M488 329h3v18.9h-3zM443 345h3v3.08h-3zM437 329h46v3.17h-46zM473 345h9v3.17h-9z"></path><path d="M473 337h3v10.57h-3zM488 345h17v3.17h-17z"></path><path d="M473 337h17v3.17h-17zM437 337h17v3.17h-17zM503 329h3v18.9h-3zM495 329h3v18.9h-3z"></path><path d="M473 337h3v10.57h-3z"></path><path d="M473 337h3v10.57h-3zM437 337h3v10.57h-3zM450 337h3v10.57h-3z"></path><path d="M473 337h3v10.57h-3zM464 337h3v10.57h-3z"></path><path d="M452 345h14v3.17h-14zM458 337h9v3.17h-9z"></path></g><g><path d="M519 345h3v3.08h-3zM512 329h46v3.17h-46zM549 345h9v3.17h-9zM563 329h3v18.9h-3z"></path><path d="M564 345h17v3.17h-17zM549 337h3v10.57h-3zM512 337h17v3.17h-17z"></path><path d="M549 337h17v3.17h-17zM571 329h3v18.9h-3zM579 329h3v18.9h-3z"></path><path d="M549 337h3v10.57h-3z"></path><path d="M549 337h3v10.57h-3zM526 337h3v10.57h-3zM512 337h3v10.57h-3z"></path><path d="M549 337h3v10.57h-3zM539 337h3v10.57h-3z"></path><path d="M527 345h14v3.17h-14zM533 337h9v3.17h-9z"></path></g><g><path d="M639 329v19M625 345h9v3.17h-9zM595 345h3v3.08h-3zM588 329h46v3.17h-46zM640 345v3"></path><path d="M625 337h3v10.57h-3zM639 337v3M588 337h17v3.17h-17z"></path><path d="M625 337h14v3.17h-14z"></path><path d="M625 337h3v10.57h-3z"></path><path d="M625 337h3v10.57h-3zM602 337h3v10.57h-3zM588 337h3v10.57h-3zM615 337h3v10.57h-3z"></path><path d="M625 337h3v10.57h-3zM603 345h14v3.17h-14zM609 337h9v3.17h-9z"></path></g><g><path d="M60 134h46v3.17H60zM66 150h3v3.08h-3zM96 150h9v3.17h-9zM111 134h3v18.9h-3z"></path><path d="M96 143h3v10.57h-3zM111 150h17v3.17h-17zM60 142h17v3.17H60z"></path><path d="M96 142h17v3.17H96zM126 134h3v18.9h-3zM118 134h3v18.9h-3z"></path><path d="M96 143h3v10.57h-3z"></path><path d="M96 143h3v10.57h-3zM60 143h3v10.57h-3zM73 143h3v10.57h-3zM87 143h3v10.57h-3z"></path><path d="M96 143h3v10.57h-3zM75 150h14v3.17H75zM81 142h9v3.17h-9z"></path></g><g><path d="M21 150h9v3.17h-9zM0 134h30v3.17H0zM35 134h3v18.9h-3z"></path><path d="M21 143h3v10.57h-3zM36 150h17v3.17H36zM0 142h1v3.17H0z"></path><path d="M51 134h3v18.9h-3zM43 134h3v18.9h-3zM21 142h17v3.17H21z"></path><path d="M21 143h3v10.57h-3z"></path><path d="M21 143h3v10.57h-3z"></path><path d="M21 143h3v10.57h-3zM0 143h1v10.57H0zM11 143h3v10.57h-3z"></path><path d="M5 142h9v3.17H5zM0 150h13v3.17H0z"></path></g><g><path d="M134 134h46v3.17h-46zM141 150h3v3.08h-3zM171 150h9v3.17h-9zM185 134h3v18.9h-3z"></path><path d="M171 143h3v10.57h-3zM186 150h17v3.17h-17zM134 142h17v3.17h-17z"></path><path d="M171 142h17v3.17h-17zM193 134h3v18.9h-3zM201 134h3v18.9h-3z"></path><path d="M171 143h3v10.57h-3z"></path><path d="M171 143h3v10.57h-3zM134 143h3v10.57h-3zM148 143h3v10.57h-3z"></path><path d="M171 143h3v10.57h-3zM161 143h3v10.57h-3z"></path><path d="M149 150h14v3.17h-14zM156 142h9v3.17h-9z"></path></g><g><path d="M261 134h3v18.9h-3zM210 134h46v3.17h-46zM216 150h3v3.08h-3zM246 150h9v3.17h-9z"></path><path d="M246 143h3v10.57h-3zM261 150h17v3.17h-17z"></path><path d="M246 142h17v3.17h-17zM210 142h17v3.17h-17zM268 134h3v18.9h-3zM276 134h3v18.9h-3z"></path><path d="M246 143h3v10.57h-3z"></path><path d="M246 143h3v10.57h-3zM223 143h3v10.57h-3zM210 143h3v10.57h-3zM237 143h3v10.57h-3z"></path><path d="M246 143h3v10.57h-3zM225 150h14v3.17h-14zM231 142h9v3.17h-9z"></path></g><g><path d="M292 150h3v3.08h-3zM285 134h46v3.17h-46zM322 150h9v3.17h-9zM336 134h3v18.9h-3z"></path><path d="M322 143h3v10.57h-3zM337 150h17v3.17h-17z"></path><path d="M322 142h17v3.17h-17zM285 142h17v3.17h-17zM352 134h3v18.9h-3zM344 134h3v18.9h-3z"></path><path d="M322 143h3v10.57h-3z"></path><path d="M322 143h3v10.57h-3zM299 143h3v10.57h-3z"></path><path d="M322 143h3v10.57h-3zM285 143h3v10.57h-3zM312 143h3v10.57h-3z"></path><path d="M300 150h14v3.17h-14zM306 142h9v3.17h-9z"></path></g><g><path d="M361 134h46v3.17h-46zM368 150h3v3.08h-3zM398 150h9v3.17h-9zM412 134h3v18.9h-3z"></path><path d="M413 150h17v3.17h-17zM398 143h3v10.57h-3z"></path><path d="M398 142h17v3.17h-17zM428 134h3v18.9h-3zM361 142h17v3.17h-17zM420 134h3v18.9h-3z"></path><path d="M398 143h3v10.57h-3z"></path><path d="M398 143h3v10.57h-3zM375 143h3v10.57h-3zM361 143h3v10.57h-3z"></path><path d="M398 143h3v10.57h-3zM388 143h3v10.57h-3z"></path><path d="M376 150h14v3.17h-14zM382 142h9v3.17h-9z"></path></g><g><path d="M443 150h3v3.08h-3zM437 134h46v3.17h-46zM488 134h3v18.9h-3zM473 150h9v3.17h-9z"></path><path d="M473 143h3v10.57h-3zM488 150h17v3.17h-17zM437 142h17v3.17h-17z"></path><path d="M473 142h17v3.17h-17zM503 134h3v18.9h-3zM495 134h3v18.9h-3z"></path><path d="M473 143h3v10.57h-3z"></path><path d="M473 143h3v10.57h-3z"></path><path d="M473 143h3v10.57h-3zM450 143h3v10.57h-3zM437 143h3v10.57h-3zM464 143h3v10.57h-3z"></path><path d="M452 150h14v3.17h-14zM458 142h9v3.17h-9z"></path></g><g><path d="M519 150h3v3.08h-3zM512 134h46v3.17h-46zM549 150h9v3.17h-9zM563 134h3v18.9h-3z"></path><path d="M549 143h3v10.57h-3zM564 150h17v3.17h-17zM512 142h17v3.17h-17z"></path><path d="M579 134h3v18.9h-3zM549 142h17v3.17h-17zM571 134h3v18.9h-3z"></path><path d="M549 143h3v10.57h-3z"></path><path d="M549 143h3v10.57h-3zM526 143h3v10.57h-3zM512 143h3v10.57h-3z"></path><path d="M549 143h3v10.57h-3zM539 143h3v10.57h-3z"></path><path d="M533 142h9v3.17h-9zM527 150h14v3.17h-14z"></path></g><g><path d="M639 134v19M625 150h9v3.17h-9zM595 150h3v3.08h-3zM588 134h46v3.17h-46zM640 150v3"></path><path d="M625 143h3v10.57h-3zM639 142v3M588 142h17v3.17h-17z"></path><path d="M625 142h14v3.17h-14z"></path><path d="M625 143h3v10.57h-3z"></path><path d="M625 143h3v10.57h-3zM602 143h3v10.57h-3zM588 143h3v10.57h-3zM615 143h3v10.57h-3z"></path><path d="M625 143h3v10.57h-3zM603 150h14v3.17h-14zM609 142h9v3.17h-9z"></path></g><path d="M507 318h6v9.85h-6zM15 318h6v9.85h-6zM430 318h6v9.85h-6zM468 318h6v9.85h-6zM619 318h6v9.85h-6zM543 318h6v9.85h-6zM581 318h6v9.85h-6zM393 318h6v9.85h-6zM128 318h6v9.85h-6zM90 318h6v9.85h-6zM166 318h6v9.85h-6zM354 318h6v9.85h-6zM52 318h6v9.85h-6zM317 318h6v9.85h-6zM279 318h6v9.85h-6zM241 318h6v9.85h-6zM203 318h6v9.85h-6zM581 152h6v9.85h-6zM543 152h6v9.85h-6zM468 152h6v9.85h-6zM507 152h6v9.85h-6zM619 152h6v9.85h-6zM90 152h6v9.85h-6zM15 152h6v9.85h-6zM52 152h6v9.85h-6zM354 152h6v9.85h-6zM241 152h6v9.85h-6zM430 152h6v9.85h-6zM279 152h6v9.85h-6zM166 152h6v9.85h-6zM203 152h6v9.85h-6zM317 152h6v9.85h-6zM393 152h6v9.85h-6zM128 152h6v9.85h-6z"></path><g><path d="M342 185c8 10 32 63-15 99-22 17-8 18-8 20 36-19 47-45 47-67s-12-44-24-52zM278 288c-41-51-3-96 15-105-73 24-41 99-15 105z"></path><path d="M346 183c18 9 56 54 15 105 25-6 58-81-15-105zM312 284c-47-35-23-89-15-99-12 8-24 28-24 51s11 49 47 67c0-2 14-3-8-19zM319 180c1 4 20 8 18-11-3 7-12 7-18 4s-15 3-18-4c-3 14 11 18 18 11z"></path><path d="M320 290l6 11c12 1 30 3 38-2-14 0-31-2-44-9zM276 299c9 5 26 3 38 2l6-11c-13 7-31 9-44 9z"></path><path d="M311 189l1 114 8 8 7-9 1-112-9-8-8 7"></path></g></g><path fill="#fff" d="M0 0h639v480H0z"></path><path fill="#da0000" d="M0 322h639v157.65H0z"></path><g fill="#fff"><path d="M66 345h3v3.08h-3zM60 329h46v3.17H60zM111 329h3v18.9h-3zM96 345h9v3.17h-9z"></path><path d="M96 337h3v10.57h-3zM111 345h17v3.17h-17z"></path><path d="M96 337h17v3.17H96zM60 337h17v3.17H60zM118 329h3v18.9h-3zM126 329h3v18.9h-3z"></path><path d="M96 337h3v10.57h-3z"></path><path d="M96 337h3v10.57h-3zM73 337h3v10.57h-3zM60 337h3v10.57h-3zM87 337h3v10.57h-3z"></path><path d="M96 337h3v10.57h-3zM75 345h14v3.17H75zM81 337h9v3.17h-9z"></path></g><g fill="#fff"><path d="M21 345h9v3.17h-9zM35 329h3v18.9h-3zM0 329h30v3.17H0z"></path><path d="M21 337h3v10.57h-3zM36 345h17v3.17H36zM0 337h1v3.17H0z"></path><path d="M43 329h3v18.9h-3zM21 337h17v3.17H21zM51 329h3v18.9h-3z"></path><path d="M21 337h3v10.57h-3z"></path><path d="M21 337h3v10.57h-3zM11 337h3v10.57h-3zM0 337h1v10.57H0z"></path><path d="M21 337h3v10.57h-3zM0 345h13v3.17H0zM5 337h9v3.17H5z"></path></g><g fill="#fff"><path d="M141 345h3v3.08h-3zM134 329h46v3.17h-46zM185 329h3v18.9h-3zM171 345h9v3.17h-9z"></path><path d="M171 337h3v10.57h-3zM186 345h17v3.17h-17zM134 337h17v3.17h-17z"></path><path d="M171 337h17v3.17h-17zM201 329h3v18.9h-3zM193 329h3v18.9h-3z"></path><path d="M171 337h3v10.57h-3z"></path><path d="M171 337h3v10.57h-3zM134 337h3v10.57h-3zM148 337h3v10.57h-3z"></path><path d="M171 337h3v10.57h-3zM161 337h3v10.57h-3z"></path><path d="M156 337h9v3.17h-9zM149 345h14v3.17h-14z"></path></g><g fill="#fff"><path d="M216 345h3v3.08h-3zM210 329h46v3.17h-46zM246 345h9v3.17h-9zM261 329h3v18.9h-3z"></path><path d="M246 337h3v10.57h-3zM261 345h17v3.17h-17zM210 337h17v3.17h-17z"></path><path d="M246 337h17v3.17h-17zM268 329h3v18.9h-3zM276 329h3v18.9h-3z"></path><path d="M246 337h3v10.57h-3z"></path><path d="M246 337h3v10.57h-3z"></path><path d="M246 337h3v10.57h-3zM223 337h3v10.57h-3zM210 337h3v10.57h-3zM237 337h3v10.57h-3z"></path><path d="M225 345h14v3.17h-14zM231 337h9v3.17h-9z"></path></g><g fill="#fff"><path d="M292 345h3v3.08h-3zM285 329h46v3.17h-46zM322 345h9v3.17h-9zM336 329h3v18.9h-3z"></path><path d="M322 337h3v10.57h-3zM337 345h17v3.17h-17zM285 337h17v3.17h-17z"></path><path d="M322 337h17v3.17h-17zM352 329h3v18.9h-3zM344 329h3v18.9h-3z"></path><path d="M322 337h3v10.57h-3z"></path><path d="M322 337h3v10.57h-3zM285 337h3v10.57h-3zM299 337h3v10.57h-3zM312 337h3v10.57h-3z"></path><path d="M322 337h3v10.57h-3zM300 345h14v3.17h-14zM306 337h9v3.17h-9z"></path></g><path fill="#239f40" d="M0 0h639v157.65H0z"></path><g fill="#fff"><path d="M412 329h3v18.9h-3zM368 345h3v3.08h-3zM361 329h46v3.17h-46zM398 345h9v3.17h-9z"></path><path d="M398 337h3v10.57h-3zM413 345h17v3.17h-17z"></path><path d="M398 337h17v3.17h-17zM361 337h17v3.17h-17zM428 329h3v18.9h-3zM420 329h3v18.9h-3z"></path><path d="M398 337h3v10.57h-3z"></path><path d="M398 337h3v10.57h-3zM375 337h3v10.57h-3zM361 337h3v10.57h-3zM388 337h3v10.57h-3z"></path><path d="M398 337h3v10.57h-3zM376 345h14v3.17h-14zM382 337h9v3.17h-9z"></path></g><g fill="#fff"><path d="M488 329h3v18.9h-3zM443 345h3v3.08h-3zM437 329h46v3.17h-46zM473 345h9v3.17h-9z"></path><path d="M473 337h3v10.57h-3zM488 345h17v3.17h-17z"></path><path d="M473 337h17v3.17h-17zM437 337h17v3.17h-17zM503 329h3v18.9h-3zM495 329h3v18.9h-3z"></path><path d="M473 337h3v10.57h-3z"></path><path d="M473 337h3v10.57h-3zM437 337h3v10.57h-3zM450 337h3v10.57h-3z"></path><path d="M473 337h3v10.57h-3zM464 337h3v10.57h-3z"></path><path d="M452 345h14v3.17h-14zM458 337h9v3.17h-9z"></path></g><g fill="#fff"><path d="M519 345h3v3.08h-3zM512 329h46v3.17h-46zM549 345h9v3.17h-9zM563 329h3v18.9h-3z"></path><path d="M564 345h17v3.17h-17zM549 337h3v10.57h-3zM512 337h17v3.17h-17z"></path><path d="M549 337h17v3.17h-17zM571 329h3v18.9h-3zM579 329h3v18.9h-3z"></path><path d="M549 337h3v10.57h-3z"></path><path d="M549 337h3v10.57h-3zM526 337h3v10.57h-3zM512 337h3v10.57h-3z"></path><path d="M549 337h3v10.57h-3zM539 337h3v10.57h-3z"></path><path d="M527 345h14v3.17h-14zM533 337h9v3.17h-9z"></path></g><g fill="#fff"><path d="M639 329v19M625 345h9v3.17h-9zM595 345h3v3.08h-3zM588 329h46v3.17h-46zM640 345v3"></path><path d="M625 337h3v10.57h-3zM639 337v3M588 337h17v3.17h-17z"></path><path d="M625 337h14v3.17h-14z"></path><path d="M625 337h3v10.57h-3z"></path><path d="M625 337h3v10.57h-3zM602 337h3v10.57h-3zM588 337h3v10.57h-3zM615 337h3v10.57h-3z"></path><path d="M625 337h3v10.57h-3zM603 345h14v3.17h-14zM609 337h9v3.17h-9z"></path></g><g fill="#fff"><path d="M60 134h46v3.17H60zM66 150h3v3.08h-3zM96 150h9v3.17h-9zM111 134h3v18.9h-3z"></path><path d="M96 143h3v10.57h-3zM111 150h17v3.17h-17zM60 142h17v3.17H60z"></path><path d="M96 142h17v3.17H96zM126 134h3v18.9h-3zM118 134h3v18.9h-3z"></path><path d="M96 143h3v10.57h-3z"></path><path d="M96 143h3v10.57h-3zM60 143h3v10.57h-3zM73 143h3v10.57h-3zM87 143h3v10.57h-3z"></path><path d="M96 143h3v10.57h-3zM75 150h14v3.17H75zM81 142h9v3.17h-9z"></path></g><g fill="#fff"><path d="M21 150h9v3.17h-9zM0 134h30v3.17H0zM35 134h3v18.9h-3z"></path><path d="M21 143h3v10.57h-3zM36 150h17v3.17H36zM0 142h1v3.17H0z"></path><path d="M51 134h3v18.9h-3zM43 134h3v18.9h-3zM21 142h17v3.17H21z"></path><path d="M21 143h3v10.57h-3z"></path><path d="M21 143h3v10.57h-3z"></path><path d="M21 143h3v10.57h-3zM0 143h1v10.57H0zM11 143h3v10.57h-3z"></path><path d="M5 142h9v3.17H5zM0 150h13v3.17H0z"></path></g><g fill="#fff"><path d="M134 134h46v3.17h-46zM141 150h3v3.08h-3zM171 150h9v3.17h-9zM185 134h3v18.9h-3z"></path><path d="M171 143h3v10.57h-3zM186 150h17v3.17h-17zM134 142h17v3.17h-17z"></path><path d="M171 142h17v3.17h-17zM193 134h3v18.9h-3zM201 134h3v18.9h-3z"></path><path d="M171 143h3v10.57h-3z"></path><path d="M171 143h3v10.57h-3zM134 143h3v10.57h-3zM148 143h3v10.57h-3z"></path><path d="M171 143h3v10.57h-3zM161 143h3v10.57h-3z"></path><path d="M149 150h14v3.17h-14zM156 142h9v3.17h-9z"></path></g><g fill="#fff"><path d="M261 134h3v18.9h-3zM210 134h46v3.17h-46zM216 150h3v3.08h-3zM246 150h9v3.17h-9z"></path><path d="M246 143h3v10.57h-3zM261 150h17v3.17h-17z"></path><path d="M246 142h17v3.17h-17zM210 142h17v3.17h-17zM268 134h3v18.9h-3zM276 134h3v18.9h-3z"></path><path d="M246 143h3v10.57h-3z"></path><path d="M246 143h3v10.57h-3zM223 143h3v10.57h-3zM210 143h3v10.57h-3zM237 143h3v10.57h-3z"></path><path d="M246 143h3v10.57h-3zM225 150h14v3.17h-14zM231 142h9v3.17h-9z"></path></g><g fill="#fff"><path d="M292 150h3v3.08h-3zM285 134h46v3.17h-46zM322 150h9v3.17h-9zM336 134h3v18.9h-3z"></path><path d="M322 143h3v10.57h-3zM337 150h17v3.17h-17z"></path><path d="M322 142h17v3.17h-17zM285 142h17v3.17h-17zM352 134h3v18.9h-3zM344 134h3v18.9h-3z"></path><path d="M322 143h3v10.57h-3z"></path><path d="M322 143h3v10.57h-3zM299 143h3v10.57h-3z"></path><path d="M322 143h3v10.57h-3zM285 143h3v10.57h-3zM312 143h3v10.57h-3z"></path><path d="M300 150h14v3.17h-14zM306 142h9v3.17h-9z"></path></g><g fill="#fff"><path d="M361 134h46v3.17h-46zM368 150h3v3.08h-3zM398 150h9v3.17h-9zM412 134h3v18.9h-3z"></path><path d="M413 150h17v3.17h-17zM398 143h3v10.57h-3z"></path><path d="M398 142h17v3.17h-17zM428 134h3v18.9h-3zM361 142h17v3.17h-17zM420 134h3v18.9h-3z"></path><path d="M398 143h3v10.57h-3z"></path><path d="M398 143h3v10.57h-3zM375 143h3v10.57h-3zM361 143h3v10.57h-3z"></path><path d="M398 143h3v10.57h-3zM388 143h3v10.57h-3z"></path><path d="M376 150h14v3.17h-14zM382 142h9v3.17h-9z"></path></g><g fill="#fff"><path d="M443 150h3v3.08h-3zM437 134h46v3.17h-46zM488 134h3v18.9h-3zM473 150h9v3.17h-9z"></path><path d="M473 143h3v10.57h-3zM488 150h17v3.17h-17zM437 142h17v3.17h-17z"></path><path d="M473 142h17v3.17h-17zM503 134h3v18.9h-3zM495 134h3v18.9h-3z"></path><path d="M473 143h3v10.57h-3z"></path><path d="M473 143h3v10.57h-3z"></path><path d="M473 143h3v10.57h-3zM450 143h3v10.57h-3zM437 143h3v10.57h-3zM464 143h3v10.57h-3z"></path><path d="M452 150h14v3.17h-14zM458 142h9v3.17h-9z"></path></g><g fill="#fff"><path d="M519 150h3v3.08h-3zM512 134h46v3.17h-46zM549 150h9v3.17h-9zM563 134h3v18.9h-3z"></path><path d="M549 143h3v10.57h-3zM564 150h17v3.17h-17zM512 142h17v3.17h-17z"></path><path d="M579 134h3v18.9h-3zM549 142h17v3.17h-17zM571 134h3v18.9h-3z"></path><path d="M549 143h3v10.57h-3z"></path><path d="M549 143h3v10.57h-3zM526 143h3v10.57h-3zM512 143h3v10.57h-3z"></path><path d="M549 143h3v10.57h-3zM539 143h3v10.57h-3z"></path><path d="M533 142h9v3.17h-9zM527 150h14v3.17h-14z"></path></g><g fill="#fff"><path d="M639 134v19M625 150h9v3.17h-9zM595 150h3v3.08h-3zM588 134h46v3.17h-46zM640 150v3"></path><path d="M625 143h3v10.57h-3zM639 142v3M588 142h17v3.17h-17z"></path><path d="M625 142h14v3.17h-14z"></path><path d="M625 143h3v10.57h-3z"></path><path d="M625 143h3v10.57h-3zM602 143h3v10.57h-3zM588 143h3v10.57h-3zM615 143h3v10.57h-3z"></path><path d="M625 143h3v10.57h-3zM603 150h14v3.17h-14zM609 142h9v3.17h-9z"></path></g><path fill="#d90000" d="M507 318h6v9.85h-6zM15 318h6v9.85h-6zM430 318h6v9.85h-6zM468 318h6v9.85h-6zM619 318h6v9.85h-6zM543 318h6v9.85h-6zM581 318h6v9.85h-6zM393 318h6v9.85h-6zM128 318h6v9.85h-6zM90 318h6v9.85h-6zM166 318h6v9.85h-6zM354 318h6v9.85h-6zM52 318h6v9.85h-6zM317 318h6v9.85h-6zM279 318h6v9.85h-6zM241 318h6v9.85h-6zM203 318h6v9.85h-6z"></path><path fill="#239e3f" d="M581 152h6v9.85h-6zM543 152h6v9.85h-6zM468 152h6v9.85h-6zM507 152h6v9.85h-6zM619 152h6v9.85h-6zM90 152h6v9.85h-6zM15 152h6v9.85h-6zM52 152h6v9.85h-6zM354 152h6v9.85h-6zM241 152h6v9.85h-6zM430 152h6v9.85h-6zM279 152h6v9.85h-6zM166 152h6v9.85h-6zM203 152h6v9.85h-6zM317 152h6v9.85h-6zM393 152h6v9.85h-6zM128 152h6v9.85h-6z"></path><g fill="#da0000"><path d="M342 185c8 10 32 63-15 99-22 17-8 18-8 20 36-19 47-45 47-67s-12-44-24-52zM278 288c-41-51-3-96 15-105-73 24-41 99-15 105z"></path><path d="M346 183c18 9 56 54 15 105 25-6 58-81-15-105zM312 284c-47-35-23-89-15-99-12 8-24 28-24 51s11 49 47 67c0-2 14-3-8-19zM319 180c1 4 20 8 18-11-3 7-12 7-18 4s-15 3-18-4c-3 14 11 18 18 11z"></path><path d="M320 290l6 11c12 1 30 3 38-2-14 0-31-2-44-9zM276 299c9 5 26 3 38 2l6-11c-13 7-31 9-44 9z"></path><path d="M311 189l1 114 8 8 7-9 1-112-9-8-8 7"></path></g></svg>'
    },
    "./src/frontend/components/Flag/tr.svg": function(e, t) {
        e.exports = '<svg viewBox="0 0 640 480"><path fill="#f31930" d="M0 0h640v480H0z"></path><path fill="#fff" d="M407 247c0 66-55 120-122 120s-122-53-122-120 55-120 122-120 122 54 122 120z"></path><path fill="#f31830" d="M413 247c0 53-44 96-98 96s-98-43-98-96 44-96 98-96 98 43 98 96z"></path><path fill="#fff" d="M431 191v44l-41 11 41 15v41l27-32 40 14-23-34 28-34-44 12-26-37z"></path></svg>'
    },
    "./src/frontend/components/Flag/uk.svg": function(e, t) {
        e.exports = '<svg viewBox="0 0 640 480"><path fill="#006" d="M0 0h640v480H0z"></path><path fill="#fff" d="M427 240l213-106V26L320 186l107 54m-107 54l320 160V346L427 240l-107 54m-107-54L0 346v108l320-160-107-54m107-54L0 26v108l213 106 107-54"></path><path fill="#fff" d="M240 160h160v160H240zm0 320h160v.01H240zm0-160h160v159.99H240zm160-160h240v160H400zM240 0h160v160H240zM0 160h240v160H0z"></path><path fill="#c00" d="M272 192h96v96h-96zm0 288h96v.01h-96zm96-288h272v96H368zM160 320L0 400v36l232-116h-72m112-32h96v191.99h-96zm208-128l160-80V44L408 160h72m0 160l160 80v-36l-88-44h-72M272 0h96v192h-96zM0 192h272v96H0zm160-32L0 80v36l88 44h72"></path></svg>'
    },
    "./src/frontend/components/Flag/us.svg": function(e, t) {
        e.exports = '<svg viewBox="0 0 640 480"><path fill="#bd3d44" d="M0 0h640v37H0zm0 74h640v37H0zm0 74h640v37H0zm0 74h640v37H0zm0 74h640v37H0zm0 74h640v37H0zm0 74h640v37H0z"></path><path fill="#fff" d="M0 37h640v37H0zm0 74h640v37H0zm0 74h640v37H0zm0 74h640v37H0zm0 74h640v37H0zm0 74h640v37H0z"></path><path fill="#192f5d" d="M0 0h327v258H0z"></path><path fill="#fff" d="M27 11l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h9l-8 6 3 10-8-6-8 6 3-10-8-6h11zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zM55 37l3 10h9l-8 6 3 10-8-6-8 6 3-10-8-6h11zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zM27 63l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h9l-8 6 3 10-8-6-8 6 3-10-8-6h11zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zM55 89l3 10h9l-8 6 3 10-8-6-8 6 3-10-8-6h11zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zM27 114l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h9l-8 6 3 10-8-6-8 6 3-10-8-6h11zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zM55 140l3 10h9l-8 6 3 10-8-6-8 6 3-10-8-6h11zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zM27 166l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h9l-8 6 3 10-8-6-8 6 3-10-8-6h11zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zM55 192l3 10h9l-8 6 3 10-8-6-8 6 3-10-8-6h11zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zM27 218l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h9l-8 6 3 10-8-6-8 6 3-10-8-6h11zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10zm55 0l3 10h10l-8 6 3 10-8-6-8 6 3-10-8-6h10z"></path></svg>'
    },
    "./src/frontend/components/Form/Form.scss": function(e, t) {},
    "./src/frontend/components/Modal/Modal.scss": function(e, t) {},
    "./src/frontend/components/WorldBar/WorldSelection.scss": function(e, t) {},
    "./src/frontend/components/WorldBar/img/ltr/worldDefault_button_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/0d5c5c92989b3c9a6ca003db91fc25a1.jpg"
    },
    "./src/frontend/components/WorldBar/img/ltr/worldDefault_button_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/eb6193da9a64c6cb59865e13e3b4191a.jpg"
    },
    "./src/frontend/components/WorldBar/img/rtl/worldDefault_button_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/ca3baa03c13cdc1413585165d8dd16ec.jpg"
    },
    "./src/frontend/components/WorldBar/img/rtl/worldDefault_button_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/308e51b348ec3743f18b7d4b29644777.jpg"
    },
    "./src/frontend/containers/Footer/Footer.scss": function(e, t) {},
    "./src/frontend/containers/Game/Battle/Battle.scss": function(e, t) {},
    "./src/frontend/containers/Game/Game.scss": function(e, t) {},
    "./src/frontend/containers/Game/LateGame/LateGame.scss": function(e, t) {},
    "./src/frontend/containers/Game/LiveStatisticsComingSoon.scss": function(e, t) {},
    "./src/frontend/containers/Journey/Battle/Battle.scss": function(e, t) {},
    "./src/frontend/containers/Journey/BuildEmpire/BuildEmpire.scss": function(e, t) {},
    "./src/frontend/containers/Journey/FixedBackgrounds/FixedBackgrounds.scss": function(e, t) {},
    "./src/frontend/containers/Journey/FixedBackgrounds/ltr/battle_illu_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/eeb60031f65b574c2c5de4b8653a364a.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/ltr/battle_illu_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/8f1d8e6346a35647b47131929c601b6b.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/ltr/buildEmpire_illu_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/3300c5e7844b5d6fbab7e69b677c9eb6.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/ltr/buildEmpire_illu_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/d012afa95c7d93c619bd2d75e27dfad2.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/ltr/contentpage_bg_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/39df6c274caee680d99c3de446e8e7a4.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/ltr/contentpage_bg_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/1d4d786f41f481bb3bd92cccd4e2fa51.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/ltr/player_illu_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/68958e0b7d5a7772dd085c9d36a9d13a.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/ltr/player_illu_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/50f9092f5f4fa13731d5fadf4e31995f.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/rtl/battle_illu_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/6311abcb77c20b100ed8bb7f479263ef.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/rtl/battle_illu_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/e84be1f15c883f23e925d6b024bee4cf.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/rtl/buildEmpire_illu_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/8eeb150315cb56013cea3d0f25c70d6b.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/rtl/buildEmpire_illu_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/139ee9dba6ae412f0101295527c3889d.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/rtl/contentpage_bg_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/a5a01c7b31923a430c2df637bcd34f08.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/rtl/contentpage_bg_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/6ca3f3265bf012a9ce772449afa9ef95.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/rtl/player_illu_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/ddbdaa68df8c8a98384b04ba67b5875a.jpg"
    },
    "./src/frontend/containers/Journey/FixedBackgrounds/rtl/player_illu_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/14062b0d4f0e3e9be4d4604d5a640cc4.jpg"
    },
    "./src/frontend/containers/Journey/Journey.scss": function(e, t) {},
    "./src/frontend/containers/Journey/LateGame/LateGame.scss": function(e, t) {},
    "./src/frontend/containers/Journey/LateGame/ltr/boots_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/0b0e743d895606c4b478b12c1f254ed3.png"
    },
    "./src/frontend/containers/Journey/LateGame/ltr/boots_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/063f10384db71c19d4067a03bdb33e37.png"
    },
    "./src/frontend/containers/Journey/LateGame/ltr/lock_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/d7803be740898cd62339e439bb892dc3.png"
    },
    "./src/frontend/containers/Journey/LateGame/ltr/lock_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/3b7e4539494ca4a879ab97542523b772.png"
    },
    "./src/frontend/containers/Journey/LateGame/ltr/sight_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/69b213aee73419fd3d21d8d4a898eafb.png"
    },
    "./src/frontend/containers/Journey/LateGame/ltr/sight_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/f5bc286deafebed833c91cab4f4c2cc1.png"
    },
    "./src/frontend/containers/Journey/LateGame/rtl/boots_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/bb54180a7915d7dc2e8dbadc17eef66e.png"
    },
    "./src/frontend/containers/Journey/LateGame/rtl/boots_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/fa9ea1cd83cfa3cbb98a83eba2dbe54e.png"
    },
    "./src/frontend/containers/Journey/LateGame/rtl/lock_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/21822cb540d400edf4c2b3c6ac542c0a.png"
    },
    "./src/frontend/containers/Journey/LateGame/rtl/lock_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/cefd5028b8c1c2e3ff5e84c5e90d9af2.png"
    },
    "./src/frontend/containers/Journey/LateGame/rtl/sight_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/51240123798fb04ed3ec725f6f875d5c.png"
    },
    "./src/frontend/containers/Journey/LateGame/rtl/sight_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/0d893841bda932fdc3792178fb4d191c.png"
    },
    "./src/frontend/containers/Journey/News/News.scss": function(e, t) {},
    "./src/frontend/containers/Journey/PlayNow/PlayNow.scss": function(e, t) {},
    "./src/frontend/containers/Journey/PlayNow/ltr/army_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/173bc7739e285df4d64d3f96d4956286.png"
    },
    "./src/frontend/containers/Journey/PlayNow/ltr/army_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/92bea06fe33c40359d5c4ef5209d5c8a.png"
    },
    "./src/frontend/containers/Journey/PlayNow/ltr/backgroundScene_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/e43dc1247eac7e4be77b7447291b1844.jpg"
    },
    "./src/frontend/containers/Journey/PlayNow/ltr/backgroundScene_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/eda0fb72201f2e06c8a8742d26094c45.jpg"
    },
    "./src/frontend/containers/Journey/PlayNow/ltr/soldier_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/0b4ab6d9bd1b95c0ae72c263390dbe61.png"
    },
    "./src/frontend/containers/Journey/PlayNow/ltr/soldier_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/097ac5247a2b71e05576b2e6ab46df61.png"
    },
    "./src/frontend/containers/Journey/PlayNow/rtl/army_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/d8608ca668c6dffd5628047f06f7decd.png"
    },
    "./src/frontend/containers/Journey/PlayNow/rtl/army_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/a4efad4b2bfed8c7543aebeba814a091.png"
    },
    "./src/frontend/containers/Journey/PlayNow/rtl/backgroundScene_1x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/0f8d113763834581fc2fd87381131b42.jpg"
    },
    "./src/frontend/containers/Journey/PlayNow/rtl/backgroundScene_2x.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/b1fdc7a825f2957f261f48ed58a3b948.jpg"
    },
    "./src/frontend/containers/Journey/PlayNow/rtl/soldier_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/d8530483cb4f747a7cd57a1fb378a85f.png"
    },
    "./src/frontend/containers/Journey/PlayNow/rtl/soldier_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/8f97cf4990d26db85f7dd750993cedea.png"
    },
    "./src/frontend/containers/Journey/Player/Interaction/Interaction.scss": function(e, t) {},
    "./src/frontend/containers/Journey/Player/Player.scss": function(e, t) {},
    "./src/frontend/containers/Journey/Player/Playstyle/Playstyle.scss": function(e, t) {},
    "./src/frontend/containers/Journey/Player/Playstyle/ltr/attackerIeOverlay.png": function(e, t, n) {
        e.exports = n.p + "./dist/ee280015996008708a906fc7a9d83a60.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/ltr/attacker_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/6893dd4abd92c347f1f82863785fb2d5.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/ltr/attacker_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/38680c212e71edb94a8d62e1fe98a988.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/ltr/defenderIeOverlay.png": function(e, t, n) {
        e.exports = n.p + "./dist/06b8b0bf4e2ba9a895e5c63561a2b632.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/ltr/defender_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/8b8c3560513710475cae235c784c9f23.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/ltr/defender_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/ddf88826ca0091ae8f098b3aea3a01e1.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/ltr/leaderIeOverlay.png": function(e, t, n) {
        e.exports = n.p + "./dist/ea262328e312e34f21e1d0f96297eb89.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/ltr/leader_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/ace77be8a9421650e1d6a627116be331.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/ltr/leader_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/7a9227a1491994378f43535e8a68149f.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/rtl/attackerIeOverlay.png": function(e, t, n) {
        e.exports = n.p + "./dist/de66de2acade6d1ed8323b8232a1e14f.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/rtl/attacker_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/1f02e9ad6621561730e438990a04956f.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/rtl/attacker_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/1be751f0eedd3f8df07894d0b5d0dd36.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/rtl/defenderIeOverlay.png": function(e, t, n) {
        e.exports = n.p + "./dist/ff6be81426f12c5f6dc72b9752205fcd.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/rtl/defender_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/ec28969824a1608cbe7f37df31c0d97c.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/rtl/defender_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/f7dad25f84835d6112223cbe11d70243.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/rtl/leaderIeOverlay.png": function(e, t, n) {
        e.exports = n.p + "./dist/6d0bfe1e11b2ec67df3c64c7f3bce3e2.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/rtl/leader_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/acb8dd3403610777f0cdb075bd9f0a3e.png"
    },
    "./src/frontend/containers/Journey/Player/Playstyle/rtl/leader_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/ad0abff1a36c663875aa86016af068c7.png"
    },
    "./src/frontend/containers/LanguageSelection/LanguageSelection.scss": function(e, t) {},
    "./src/frontend/containers/Login/ForgotGameWorld.scss": function(e, t) {},
    "./src/frontend/containers/Login/ForgotPassword.scss": function(e, t) {},
    "./src/frontend/containers/Login/Login.scss": function(e, t) {},
    "./src/frontend/containers/MainNavigation/MainNavigation.scss": function(e, t) {},
    "./src/frontend/containers/MainNavigation/logoLegends_white.svg": function(e, t) {
        e.exports = '<svg version="1.1" id="Layer_1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 172.7 60" style="enable-background:new 0 0 172.7 60;" xml:space="preserve"><path fill="#ffffff" d="M52.9 34.4c-.2-.3-.3-.7-.3-1.3 0-.8-.1-1.2-.1-1.3l-.1-3.9.1-6.6c0-1.1.1-2.2.1-3.3.1-1.5.2-2.4.3-2.8.1 0 .3 0 .6-.1h.4c2.6 0 4.1.3 4.4.8.1.1.1.4.3.8.1.4.2.5.2.5s.1 0 .2-.1V17c0-.4.1-.9.2-1.4.2-.5.3-1 .5-1.6l-.4-.1c-.9.2-1.9.4-3.1.4h-5l-6.5-.3c-.3 0-.5.4-.8 1.2-.1.5-.3 1-.4 1.4-.2.5-.3.8-.3.8v.2h.2c.1-.4.3-.7.6-1 .3-.3.6-.5.9-.6.3-.1.9-.2 2.1-.4 1.3-.2 2.1-.3 2.5-.3.3 0 .4 1.5.4 4.5l-.1 8.6c-.1 2.2-.3 3.7-.3 4.6-.1.9-.2 1.5-.4 1.8-.1.1-.2.2-.4.2-.2.1-.3.2-.3.3l.5.1c.2-.1.4-.1.5-.1 1.1-.1 1.8-.2 1.9-.2l2.8.2c.2 0 .3-.1.4-.2 0 0-.3-.1-.8-.2-.4-.2-.7-.3-.8-.5zm19.7-.1c.6.7 1.4 1 2.3 1h.9c1.2-.1 1.8-.2 1.9-.3-.1 0-.4-.1-.8-.3-.2-.1-.5-.2-.6-.4-.5-.4-1.1-1.2-1.7-2.2-.5-.9-1-1.8-1.4-2.7-.3-.5-.7-1.3-1.4-2.4-.4-.8-.7-1.2-.7-1.2 0-.1.4-.5 1-1.1.7-.7 1.3-1.4 1.6-2.1.6-1 .9-2.2.9-3.4 0-1.8-.7-3.1-2.1-3.9-1-.6-2.3-1-3.7-1l-2.8.1c-.9 0-1.6.1-2.1.1l-1.5.1c-.1 0-.3.1-.6.2l.3.1c.2.1.2.1.3.2.4 1 .6 2 .6 3l.1 3.9v2s0 .3-.1.8c0 .5-.1.7-.1.8v2l-.2 4.2c0 1.9-.1 3-.2 3.3-.3.4-.5.6-.6.7 1.2-.2 2-.3 2.3-.3h2.2s.3-.1.9-.2c-.1-.1-.2-.1-.4-.1-.9 0-1.4-1-1.4-3v-5.4c0-.2.1-.4.3-.4 1.2 0 2 .2 2.4.6.5.5 1 1.3 1.5 2.1.4.7.8 1.5 1.2 2.2.8 1.7 1.4 2.7 1.7 3zm-5.2-8.2h-1.8l.1-11.3h.9c1.4 0 2.6.8 3.6 2.5.9 1.5 1.4 2.9 1.4 4.3 0 1.9-.3 3.1-.9 3.6-.4.7-1.5.9-3.3.9zm33.6 8.6c-.4-.2-.7-.5-.9-.9-1.2-2-2.5-4.9-3.8-8.6-.9-2.6-1.7-5.1-2.6-7.7-.2-.7-.5-1.3-.7-2-.4-1-.9-1.5-1.3-1.5h-3.2c-.2 0-.4.1-.6.1-.2 0-.3.1-.3.2.1.1.2.1.2.1h.5c.3 0 .5.1.8.3.2.2.3.5.3.8 0 .5-.9 3-2.6 7.5-1.6 4.1-2.7 6.9-3.4 8.5-.7 1.6-1.5 2.8-2.5 3.6.3 0 .8 0 1.4.1.7.1 1.1.1 1.4.1l3.6-.5c-.7-.2-1.4-.5-2.1-.8-.6-.3-.9-.8-.9-1.7 0-.8.4-2.2 1.1-4.1l.6-1.8c.4-1 .8-1.6 1-1.6h5.4c.8 1.8 1.4 3.2 1.8 4.2.4 1.1.9 2.3 1.3 3.5.8 1.7 1.7 2.6 2.7 2.6l3-.2c.3.1.1 0-.2-.2zm-8.5-10.3h-5.4l2.8-7.4c.4.7.6 1.3.8 1.7l1.8 5.4v.3zm20.7-10.2c.3-.1.6.2.8.7.2.4.2.8.2 1.3 0 1.3-.8 4.2-2.3 8.5-1 2.8-1.8 4.9-2.5 6.4-1.6-3.7-2.8-6.9-3.8-9.4-.8-2.3-1.5-4-1.8-5.1-.5-1.4-.8-2.1-.8-2.1-.3-.1-.8-.2-1.6-.2h-2.6c-.3 0-.5.1-.6.3.2.1.4.1.6.2.2.1.3.2.5.3 1.1 1.5 2.3 3.7 3.5 6.7.7 1.5 1.6 3.9 2.8 7.1 1.1 3 1.7 4.6 1.8 4.9.6 1.2.9 1.8 1 1.9 2.8-7.3 5.8-14.6 9-21.8h-4.2v.3zm7.8 3.6c0 .3.1.6.1.8v6.8l-.1 4.9-.5 5.1h4.2c.1-.1.1-.2.1-.2-.5-.2-.7-.3-.7-.3-.2-.2-.3-.5-.3-.9 0-.3-.1-.6-.1-1l.1-9.6c.1-3.6.2-6.7.5-9.4h-.3c.1 0-.1 0-.6.1s-1 .1-1.7.1h-1.5c.5.5.7 1.1.8 1.8-.1.5-.1 1.2 0 1.8zm27 16.9c-.4-.2-.7-.5-.9-.9-1.2-2-2.5-4.9-3.8-8.6-.9-2.6-1.7-5.1-2.6-7.7-.2-.7-.5-1.3-.7-2-.4-1-.9-1.5-1.3-1.5l-3.1.1c-.2 0-.4.1-.6.1-.2 0-.3.1-.3.2.1.1.2.1.2.1h.5c.3 0 .5.1.8.3.2.2.3.5.3.8 0 .5-.9 3-2.6 7.5-1.6 4.1-2.7 6.9-3.4 8.5-.7 1.6-1.5 2.8-2.5 3.6.3 0 .8 0 1.4.1.7.1 1.1.1 1.4.1l3.6-.5c-.7-.2-1.4-.5-2.1-.8-.6-.3-.9-.8-.9-1.7 0-.8.4-2.2 1.1-4.1l.6-1.8c.4-1 .8-1.6 1-1.6h5.4c.8 1.8 1.4 3.2 1.8 4.2.4 1.1.9 2.3 1.3 3.5.8 1.7 1.7 2.6 2.7 2.6l3-.2c.2 0 .1-.1-.3-.3zm-8.4-10.3h-5.4L137 17c.4.7.6 1.3.8 1.7l1.8 5.4v.3zm29.7-10.2c-.4 0-1 .2-2 .5-.8.3-1.3.5-1.4.6.2 0 .8 0 1.7-.1.2 0 .3.1.3.2.1 1.4.2 2.5.2 3.2.1 2.1.2 4.4.3 6.6l.1 4.6c0 .2 0 .3-.1.4-3.4-3.8-5.7-6.3-6.8-7.6-2.8-3.3-4.8-6.1-6.2-8.6-2.1.2-3.8.3-4.9.5 1.3.6 2.1 1.4 2.5 2.4.3.6.4 1.6.4 3l-.2 3.7v1.7c0 3.8-.2 6.4-.6 7.9-.1.4-.3.7-.7 1-.5.4-.8.7-.9.7.5.1 1.1.2 2 .2.7 0 1.5-.1 2.5-.3 1.3-.3 2-.5 2-.5-.6-.1-1.1-.2-1.4-.2-.5 0-.9-.1-1.4-.4-.1-.1-.2-.3-.3-.5 0-.1-.1-.3-.1-.7-.2-1.9-.3-3.2-.3-4-.1-3.9-.1-7.1 0-9.7 1.1 1.3 3.1 3.5 5.8 6.7 1.8 2.1 4.3 4.9 7.5 8.4.9.9 1.3 1.4 1.4 1.4.1 0 .1 0 .2-.1.1-1.8.2-3.7.3-5.5.2-3.6.3-5.6.3-6.1v-1.4c0-.3.2-2.6.6-6.9.2-.1.7-.3 1.3-.5.6-.2.9-.3 1.1-.5l-3.2-.1zm-112 27.6H56v9.5h6v-1.2h-4.7m14.5-3.2h5.3v-1.1h-5.3v-2.9h5.7v-1.1h-7v9.5h7.2v-1.2h-5.9m19.1-2.6h2.8v1.8c-.3.2-.7.5-1.2.7s-1.1.3-1.6.3c-.6 0-1.2-.1-1.8-.4-.6-.3-1-.7-1.3-1.3-.3-.6-.4-1.3-.4-2.1 0-.7.1-1.3.4-1.9.1-.3.3-.7.6-.9.3-.3.6-.5 1-.7.4-.2.9-.3 1.5-.3.5 0 .9.1 1.3.2s.7.4.9.7c.2.3.4.7.5 1.1l1.2-.3c-.2-.6-.4-1.2-.7-1.6s-.8-.7-1.3-.9c-.6-.2-1.2-.3-1.9-.3-1 0-1.8.2-2.5.6s-1.3 1-1.7 1.8c-.4.8-.6 1.7-.6 2.6 0 .9.2 1.8.6 2.5s1 1.3 1.8 1.7 1.6.6 2.6.6c.7 0 1.4-.1 2.1-.4.7-.2 1.3-.6 1.9-1.1v-3.5H91v1.1zm14.2-.6h5.4v-1.1h-5.4v-2.9h5.7v-1.1h-7v9.5h7.3v-1.2h-6m21-.9l-5.1-7.4h-1.3v9.5h1.3v-7.5l5 7.5h1.3v-9.5h-1.2m16.8.8c-.4-.3-.9-.6-1.4-.7-.4-.1-1-.1-1.7-.1h-3.3v9.5h3.5c.6 0 1.1-.1 1.6-.2s.8-.3 1.2-.5c.3-.2.6-.5.9-.9.3-.4.5-.8.7-1.4.2-.6.3-1.2.3-1.9 0-.8-.1-1.6-.4-2.3-.5-.5-.9-1.1-1.4-1.5zm-.1 5.7c-.2.5-.4.9-.7 1.2-.2.2-.5.4-.9.5s-.9.2-1.5.2h-2.1V43h2c.8 0 1.3.1 1.7.2.5.2.9.5 1.2 1.1.3.5.5 1.3.5 2.3.1.6 0 1.2-.2 1.7zm15.9-2c-.4-.2-1.1-.4-2.1-.6-1-.2-1.7-.5-1.9-.7-.2-.2-.4-.5-.4-.8 0-.4.2-.7.5-1 .4-.3.9-.4 1.7-.4.7 0 1.3.2 1.7.5.4.3.6.8.7 1.4l1.2-.1c0-.6-.2-1.1-.5-1.5-.3-.4-.7-.8-1.3-1-.5-.2-1.2-.3-1.9-.3-.6 0-1.2.1-1.8.3-.5.2-.9.5-1.2.9-.3.4-.4.9-.4 1.3s.1.8.3 1.2c.2.4.6.6 1 .9.4.2 1 .4 1.9.6.9.2 1.5.4 1.7.5.4.2.7.3.9.6.2.2.3.5.3.8 0 .3-.1.6-.3.8-.2.2-.5.4-.8.6-.4.1-.8.2-1.3.2s-1-.1-1.5-.3-.8-.4-1-.7c-.2-.3-.3-.7-.4-1.2l-1.2.1c0 .6.2 1.2.5 1.7s.8.9 1.4 1.1 1.3.4 2.2.4c.7 0 1.3-.1 1.9-.4.6-.2 1-.6 1.3-1 .3-.4.4-.9.4-1.4 0-.5-.1-1-.4-1.3-.2-.7-.6-1-1.2-1.2z"></path><image width="156" height="250" xlink:href="data:image/png;base64,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" transform="matrix(0.24 0 0 0.24 0 0)" overflow="visible"></image></svg>'
    },
    "./src/frontend/containers/MainNavigation/turbotra_white.svg": function(e, t) {
        e.exports = '<svg version="1.1" id="Layer_1" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 172.7 60" style="enable-background:new 0 0 172.7 60;" xml:space="preserve"><style type="text/css"> .st0{display:none;fill:#FFFFFF;} .st1{fill:#FFFFFF;stroke:#FFFFFF;stroke-miterlimit:10;} </style><path class="st0" d="M161.7,37.3h-49c-0.8,0-1.5-0.2-2-0.6c-0.9,0.8-2.1,1.3-3.3,1.3c-2.2,0-4.4-0.1-6.7-0.5 c-2.8-0.5-4.1-3.7-3.5-6.2c0.6-2.8,3.6-4,6.2-3.5c0.1,0,0.1,0,0.2,0s0.2,0,0.2,0c0.4,0,0.7,0,1.1,0.1c0.8,0,1.7,0,2.5,0 c1.8,0,3.2,0.9,4.1,2.2c0.2-0.1,0.4-0.1,0.5-0.2c0.5-1,1.6-1.7,3-1.7c1.5,0,2.4,0.7,3,1.7h43.7c0.4,0,0.8,0.1,1.2,0.2V2.7 c-50.8,0-101.5,0-152.3,0v54.8c50.8,0,101.5,0,152.3,0V37.1C162.5,37.2,162.1,37.3,161.7,37.3z M143.7,24c2-5.6,4.1-11.2,6.2-16.8 c0.3-0.7,1.2-1.6,1.8-1.7c0.7,0,1.7,0.8,1.9,1.6c2.3,6,4.5,12,6.7,18c0.1,0.4,0.2,0.8,0.3,1.4c-2.8,0.6-3.2,0.5-3.8-1.9 c-0.5-1.8-1.5-2.7-3.4-2.4c-0.6,0.1-1.1,0.1-1.7,0c-2.7-0.4-4.7,0.1-5.2,3.3c-0.2,1.4-1,1.5-3.5,0.9C143.3,25.6,143.5,24.8,143.7,24 z M126,6.9c0-0.5,0.9-1.4,1.5-1.5c2.6-0.1,5.2-0.2,7.8,0c2.5,0.2,4.4,1.5,5,4c0.7,2.7,0.5,5.3-1.8,7.3c-0.4,0.4-0.9,0.7-1.5,1.1 c1.4,2.8,2.8,5.6,4.2,8.3c-2.5,1.1-3.4,0.8-4.4-1.3c-0.9-1.9-2-3.7-2.8-5.6c-0.8-1.8-2.3-1.4-3.6-1.1c-0.5,0.1-0.9,1.4-1,2.2 c-0.2,1.6-0.2,3.3-0.2,4.9c0,1.1-0.5,1.5-1.5,1.5s-1.8-0.2-1.8-1.4C125.9,19.2,125.9,13.1,126,6.9z M110.4,5.5 c4.2-0.1,8.4-0.1,12.5,0c0.4,0,1,1,1.1,1.6c0,0.4-0.6,1.1-1.1,1.4c-0.4,0.2-1,0.1-1.5,0.1c-3.1,0-3.1,0-3.1,3.2c0,2,0,3.9,0,5.9l0,0 c0,2.5,0,4.9,0,7.4c0,1.1-0.3,1.8-1.6,1.8c-1.4,0.1-1.8-0.5-1.8-1.8c0-4.7-0.1-9.4,0-14.1c0-1.9-0.5-2.8-2.5-2.5 c-0.6,0.1-1.3,0.2-1.9,0s-1.4-0.9-1.4-1.3C109.3,6.6,110,5.5,110.4,5.5z M74.5,7.2c0-1.2,0.5-1.8,1.7-1.8c2.7,0.1,5.3,0,8,0.2 C87,5.9,88.5,7.3,89,9.7c0.5,2.5-0.3,4.6-2.4,6c2.6,2.1,3.5,4.4,2.6,7.1c-0.8,2.5-3,3.9-6.3,3.9c-2.2,0-4.3,0-6.5,0 c-1.3,0-1.9-0.4-1.9-1.8C74.5,19.1,74.5,13.1,74.5,7.2z M37.9,5.4c1.2,0,1.7,0.5,1.7,1.7c0,4-0.1,8,0,12c0.1,3.4,1.6,4.8,4.9,4.5 c1.7-0.1,2.9-1,3.3-2.7c0.2-0.9,0.3-1.7,0.3-2.6c0-3.6,0-7.1,0-10.7c0-1.2-0.1-2.3,1.7-2.3s1.6,1.3,1.6,2.4c0,1.9,0,3.8,0,5.7h0.1 c-0.1,2.7,0,5.3-0.4,8c-0.6,3.7-3.4,5.7-7.2,5.7c-3.9,0-6.5-2-7.2-5.7c-0.2-0.7-0.3-1.5-0.3-2.3c0-4.1,0-8.1,0-12.2 C36.4,6,36.8,5.4,37.9,5.4z M18.6,27.4c0,6.4,0,12.8,0,19.2c0,2.2-3.6,4.8-5.7,4.1c-0.3-0.1-0.7-0.6-0.8-0.9 c-0.2-0.5-0.1-1.1-0.1-1.7c0-12.6,0-25.2,0-37.8c0-2.7,2.8-5.1,5.5-4.5c0.5,0.1,1,1.1,1.1,1.7c0.1,2.5,0.1,4.9,0.1,7.4 C18.6,19.1,18.6,23.2,18.6,27.4z M19.8,7c0-0.5,0.9-1.5,1.4-1.5c4.1-0.1,8.1-0.1,12.2-0.1c1.1,0,1.5,0.7,1.3,1.6 c-0.2,0.6-0.8,1.1-1.3,1.4c-0.4,0.3-1,0.1-1.4,0.1c-3,0-3,0-3,3.2c0,2,0,3.9,0,5.9c0,2.4,0,4.8,0,7.2c0,1.1-0.2,2-1.6,2 s-1.7-0.8-1.7-1.9c0-4.7-0.1-9.4,0-14.1c0-1.7-0.5-2.5-2.2-2.3c-0.7,0.1-1.6,0.2-2.3-0.1C20.6,8.2,19.8,7.5,19.8,7z M37.3,45.3 c-0.1,2.5-1.4,3.8-3.9,3.9c-1.5,0-3.1,0.1-4.6,0c-1.1-0.1-1.5,0.2-1.9,1.3c-0.5,1.3-1.3,2.6-2.4,3.5c-1.7,1.5-2.5,1.1-3.5-1.5 c3.3-0.6,3.4-2.9,3.3-5.5c-0.1-3,0-6,0-8.9c0-1.9,0.3-2.2,3-2.6c0,1.5,0,2.9,0,4.3c0,1.5-0.1,3.1,0.1,4.6c0.1,0.7,0.7,1.7,1.2,1.8 c1.6,0.2,3.3,0.2,4.9,0c0.4,0,0.8-1,0.9-1.6c0.1-2.2,0.1-4.4,0-6.7c-0.1-1.7,0.7-2.5,2.6-2.4c0.1,0.5,0.3,1,0.3,1.6 C37.3,39.9,37.4,42.6,37.3,45.3z M36.9,33.9c-0.6-0.2-1.3,0.1-2-0.1c-0.7-0.1-1.5-0.3-2.1-0.7c-0.3-0.2-0.3-1.3,0-1.5 c0.6-0.4,1.3-0.6,2.1-0.7c0.6-0.1,1.4,0.1,2-0.1c1-0.3,2.5,0.5,2.5,1.5C39.4,33.4,37.9,34.2,36.9,33.9z M57.5,56.5 c-0.7-1-1.6-1.7-1.5-2.3c0-0.6,1-1.2,1.6-1.8c0.6,0.6,1.6,1.2,1.6,1.8C59.2,54.8,58.3,55.5,57.5,56.5z M60.8,46.5 c-0.1,1.6-1.5,2.6-3.2,2.7c-1.5,0.1-3,0.1-4.6,0c-1.4-0.1-2.2,0.3-2.6,1.8c-0.7,2.6-2.7,3.9-5.3,4.3c-0.8,0.1-1.9,0.6-2.1-0.8 c-0.1-1.1,0.4-1.7,1.5-2c0.9-0.2,1.8-0.8,2.6-1.3c0.3-0.2,0.6-1,0.4-1.3c-0.1-0.3-0.8-0.5-1.2-0.6c-3.7-0.4-4.6-1.3-4.6-5.2 c0-4.8,1.8-7.7,5.3-8.9c2.6-0.8,3.8,0,3.8,2.7c0,2.2,0.1,4.4,0,6.7c0,1.4,0.5,1.9,1.9,1.9c5.3,0.1,5.3,0.2,5.3-5.1 c0-1.1,0-2.3,0-3.4c0.1-1.9,0.3-2.1,2.7-2.3C60.9,39.4,61,43,60.8,46.5z M68.3,49c0,1.9-0.8,3.6-2.4,4.8c-2,1.5-2.6,1.4-4-1.2 c3.3-0.7,3.7-2.9,3.5-5.6c-0.1-2.8,0-5.7-0.1-8.5c0-1.7,0.6-2.8,2.7-2.8c0.1,0.6,0.3,1.1,0.3,1.7C68.4,41.2,68.4,45.1,68.3,49z M66.4,24.7c-0.8-1.6-1.6-3.3-2.5-4.9c-0.8-1.6-2.3-2.3-4-1.6c-0.4,0.2-0.8,0.9-0.8,1.4c-0.1,1.8-0.1,3.5,0,5.3 c0,1.2-0.3,1.9-1.7,1.9c-1.3,0-1.6-0.7-1.6-1.8c0-6,0-11.9,0-17.9c0-1.1,0.4-1.7,1.5-1.7c2.6,0,5.2-0.1,7.8,0.1c2.5,0.1,4.3,1.5,5,4 c0.9,2.9,0.1,5.8-2,7.4c-0.4,0.3-0.8,0.6-1.4,1c1.5,2.9,2.9,5.6,4.4,8.4C68.3,27.3,67.6,27,66.4,24.7z M90.4,47 c-0.3,1.5-1.7,2.2-3.2,2.2s-3,0.1-4.6,0c-1.2-0.1-1.8,0.3-2.1,1.6c-0.8,2.8-2.9,4.2-5.7,4.5c-0.6,0.1-1.2-0.5-1.8-0.8 c0.4-0.6,0.8-1.4,1.3-1.9c1-0.8,2.2-1.3,3.2-2.1c0.2-0.1,0.1-0.6,0.3-1.1c-0.9-0.1-1.6-0.1-2.3-0.2c-1.5-0.1-2.7-0.7-3.3-2.1 c-1.8-4,0.3-9.9,4.3-11.8c2.8-1.3,4.3-0.4,4.3,2.7c0,2.2,0,4.4,0,6.7c0,1.2,0.4,1.8,1.6,1.7c1.3-0.1,2.5-0.1,3.8,0 c1.4,0.1,1.8-0.6,1.7-1.9c0-2.1,0-4.2-0.1-6.3c-0.1-1.8,0.6-2.8,2.9-2.8C90.9,39.4,91.3,43.3,90.4,47z M92.8,32.8 C92.3,33.4,91.7,34,91,34c-1,0.1-2.1-0.3-3.2-0.4c-0.1,0.2-0.1,0.4-0.2,0.6c-0.5-0.4-1.2-0.8-1.5-1.3c-0.2-0.3,0.1-1.1,0.4-1.4 c0.5-0.4,1.2-0.6,1.8-0.6c0.8-0.1,1.6-0.1,2.4,0c0.6,0.1,1.3,0.3,1.8,0.7C92.8,31.8,93,32.6,92.8,32.8z M92.8,20.1 c-0.1-2.7-0.1-5.5,0-8.2c0.2-3.7,3-6.5,6.3-6.7c4.6-0.3,7.5,1.6,8.3,5.7c0.3,1.7,0.3,3.4,0.5,5.1c-0.1,1.7-0.1,3.4-0.5,5.1 c-0.8,3.9-3.9,6.2-7.8,5.9C95.8,26.9,93,24,92.8,20.1z M105.1,49.6c-0.4,0-0.8,0-1.1,0c0,0.1,0,0.2-0.1,0.2c-0.9-0.3-1.9-0.6-2.8-1 c-0.3-0.1-0.3-0.8-0.5-1.2c0.4-0.1,0.9-0.4,1.3-0.4c1,0.1,2.1,0.5,3.1,0.5c0.4,0,0.9-0.7,1.3-1.1c-0.4-0.4-0.7-1-1.2-1.2 c-0.7-0.3-1.6-0.4-2.4-0.6c-2.2-0.7-2.8-3.4-1.1-5c1.2-1.1,4.2-1.3,5.5-0.2c0.3,0.2,0.4,0.7,0.5,1.1c-0.4,0.2-0.8,0.5-1.3,0.5 c-1,0-2-0.2-2.9-0.2c-0.3,0-0.9,0.6-0.9,1c0,0.3,0.5,0.8,0.9,1c0.7,0.3,1.4,0.5,2.2,0.7c1.6,0.4,2.8,1.3,2.7,3.2 C108.3,48.3,107,49.4,105.1,49.6z M118.6,45.4c-2.2-0.1-2.8,0.8-2.6,2.8c0,0.4-0.6,0.9-0.9,1.4c-0.3-0.5-0.9-1-1-1.5 c-0.1-1.2,0-2.5,0-3.8l0,0c0-1.1,0.1-2.3,0-3.4c-0.1-1.7,0.6-2.3,2.2-2.1c0.8,0.1,1.5,0,2.3,0c2,0.1,3.2,1.3,3.3,3.2 C121.9,44,120.7,45.5,118.6,45.4z M130.5,43.3c0.7,0,1.4-0.1,2.1,0.1c0.3,0.1,0.6,0.5,0.9,0.8c-0.3,0.3-0.5,0.8-0.8,0.8 c-0.7,0.1-1.4,0.1-2.1,0.1c-1,0-1.5,0.3-1.5,1.4c0,1.1,0.6,1.4,1.6,1.4c0.9,0,1.9,0,2.8,0.1c0.3,0,0.8,0.5,0.8,0.8s-0.5,0.8-0.8,0.8 c-1.8,0.1-3.6,0.1-5.3,0c-0.4,0-0.9-0.9-1-1.5c-0.1-1.3,0-2.7,0-4l0,0c0-1.3,0-2.5,0-3.8c0-1.1,0.4-1.6,1.6-1.6c1.5,0.1,3,0,4.6,0.1 c0.4,0,0.7,0.5,1.1,0.7c-0.4,0.3-0.7,0.8-1.1,0.9c-0.9,0.1-1.8-0.1-2.6,0.1c-0.6,0.1-1.2,0.7-1.4,1.3 C128.9,42.8,129.5,43.4,130.5,43.3z M146.4,49.6c-1.7,0.1-3.4,0.1-5.1,0c-0.4,0-1-0.8-1.1-1.2c-0.2-1.4-0.2-2.9-0.3-4.4 c0.1-5.7,0.5-6.1,6.2-5.2c0.2,0,0.6,0,0.7,0.2c0.2,0.2,0.4,0.6,0.3,0.8c-0.1,0.3-0.5,0.7-0.7,0.7c-1,0.1-2.1-0.1-3,0.2 c-0.5,0.1-1.2,0.7-1.4,1.3c-0.3,1,0.3,1.5,1.4,1.5c0.6,0,1.2-0.1,1.7,0s0.8,0.5,1.3,0.8c-0.4,0.3-0.7,0.7-1.2,0.9s-1.1,0.1-1.7,0.1 c-1-0.1-1.6,0.2-1.5,1.3c0,1.1,0.6,1.4,1.6,1.4c0.9,0,1.9,0,2.8,0.1c0.3,0,0.6,0.5,0.8,0.8C147,49,146.7,49.6,146.4,49.6z M160.7,46.8c-0.2,1.5-1.3,2.4-2.8,2.7c-4.2,0.9-5,0.2-5-4c0-0.4,0-0.9,0-1.3c0-0.6-0.1-1.2,0-1.7c0.4-1.3-1.2-3.6,1.7-3.8 c4.2-0.3,6,0.7,6.2,3.7C161,43.9,160.9,45.4,160.7,46.8z"></path><path class="st1" d="M18.5,26.3c0,6.8,0,13.6,0,20.4c0,2.3-3.8,5.1-6,4.3c-0.3-0.1-0.7-0.6-0.8-1c-0.2-0.5-0.1-1.2-0.1-1.8 c0-13.4,0-26.7,0-40.1c0-2.9,3-5.4,5.8-4.8c0.5,0.1,1.1,1.2,1.2,1.8c0.1,2.7,0.1,5.2,0.1,7.8C18.5,17.5,18.5,21.9,18.5,26.3z"></path><path class="st1" d="M86.6,14.5c2.6,2.1,3.5,4.4,2.6,7.1c-0.8,2.6-3.2,4-6.7,3.9c-1.8,0-3.7,0-5.5,0c-2.1,0.1-2.8-0.3-2.4-3 c0-5.4,0-10.6-0.1-16C74.3,4.8,74.8,4,76.2,4c2.7,0.1,5.3,0,8,0.2C87,4.6,88.5,6,89,8.4C89.6,10.9,88.7,13,86.6,14.5z M81.3,22.5 L81.3,22.5c0.6,0,1.3,0,1.9,0c2-0.2,3.1-1.3,3-3.2c0-1.9-1.1-3-3.1-3.1c-1.2-0.1-2.4,0-3.6,0c-1.5,0-1.7,1-1.5,2 c0.3,1.5-1.3,3.6,1.3,4.3C80,22.6,80.6,22.5,81.3,22.5z M81.4,13.5c0.6,0,1.1,0,1.7,0c2.2-0.1,3.4-1.6,2.7-3.7 c-0.7-2-2.4-1.9-4.1-1.9c-3.9,0-3.9,0-3.7,3.9c0.1,1.2,0.5,1.8,1.7,1.7C80.2,13.5,80.8,13.5,81.4,13.5z"></path><path class="st1" d="M137,16.9c1.4,2.8,2.8,5.6,4.2,8.3c-2.5,1.1-3.4,0.8-4.4-1.3c-0.9-1.9-2-3.7-2.8-5.6c-0.8-1.8-2.3-1.4-3.6-1.1 c-0.5,0.1-0.9,1.4-1,2.2c-0.2,1.6-0.2,3.3-0.2,4.9c0,1.1-0.5,1.5-1.5,1.5s-1.8-0.2-1.8-1.4c0-6.1,0-12.3,0.1-18.4 c0-0.5,0.9-1.4,1.5-1.5c2.6-0.1,5.2-0.2,7.8,0c2.5,0.2,4.4,1.5,5,4c0.7,2.7,0.5,5.3-1.8,7.3C138.1,16.1,137.6,16.4,137,16.9z M129.5,7.5c0,0.7-0.1,1.1-0.1,1.6c0.1,5.4-0.8,4.8,4.9,4.8c2.1,0,3-1.1,2.9-3.3c-0.1-2.1-0.9-3-3-3.1 C132.7,7.5,131.2,7.5,129.5,7.5z"></path><path class="st1" d="M66.3,17c1.5,2.9,2.9,5.6,4.4,8.4c-2.8,0.9-3.4,0.7-4.6-1.6c-0.8-1.6-1.6-3.3-2.5-4.9c-0.8-1.6-2.3-2.3-4-1.6 c-0.4,0.2-0.8,0.9-0.8,1.4c-0.1,1.8-0.1,3.5,0,5.3c0,1.2-0.3,1.9-1.7,1.9c-1.3,0-1.6-0.7-1.6-1.8V6.2c0-0.9,0.8-1.7,1.7-1.7 c2.5,0,5.1-0.1,7.6,0.1c2.5,0.1,4.3,1.5,5,4c0.9,2.9,0.1,5.8-2,7.4C67.3,16.2,66.9,16.5,66.3,17z M62.5,7.5c-0.8,0-1.5-0.1-2.3,0 c-0.5,0.1-1.1,0.7-1.2,1.1c-0.1,1.4-0.1,2.8,0,4.1c0,0.4,0.6,1,0.9,1c1.8,0.1,3.5,0.2,5.3-0.1c0.6-0.1,1.3-1,1.5-1.7 C67.6,8.8,66.3,7.5,62.5,7.5z"></path><path class="st1" d="M61.4,34.6c0,3.7,0.2,7.3-0.1,10.9c-0.1,1.6-1.5,2.6-3.2,2.7c-1.5,0.1-3,0.1-4.6,0c-1.4-0.1-2.2,0.3-2.6,1.8 c-0.7,2.6-2.7,3.9-5.3,4.3c-0.8,0.1-1.9,0.6-2.1-0.8c-0.1-1.1,0.4-1.7,1.5-2c0.9-0.2,1.8-0.8,2.6-1.3c0.3-0.2,0.6-1,0.4-1.3 c-0.1-0.3-0.8-0.5-1.2-0.6c-3.7-0.4-4.6-1.3-4.6-5.2c0-4.8,1.8-7.7,5.3-8.9c2.6-0.8,3.8,0,3.8,2.7c0,2.2,0.1,4.4,0,6.7 c0,1.4,0.5,1.9,1.9,1.9c5.3,0.1,5.3,0.2,5.3-5.1c0-1.1,0-2.3,0-3.4C58.7,35,59,34.8,61.4,34.6z M47.8,36.7c-2.8,1.5-4.2,5.6-3,7.9 c0.2,0.4,1.1,0.7,1.7,0.7c0.4,0,1.2-0.5,1.2-0.8C47.9,42,47.8,39.5,47.8,36.7z"></path><path class="st1" d="M90.4,34.5c0.2,3.9,0.6,7.8-0.3,11.5c-0.3,1.5-1.7,2.2-3.2,2.2s-3,0.1-4.6,0c-1.2-0.1-1.8,0.3-2.1,1.6 c-0.8,2.8-2.9,4.2-5.7,4.5c-0.6,0.1-1.2-0.5-1.8-0.8c0.4-0.6,0.8-1.4,1.3-1.9c1-0.8,2.2-1.3,3.2-2.1c0.2-0.1,0.1-0.6,0.3-1.1 c-0.9-0.1-1.6-0.1-2.3-0.2c-1.5-0.1-2.7-0.7-3.3-2.1c-1.8-4,0.3-9.9,4.3-11.8c2.8-1.3,4.3-0.4,4.3,2.7c0,2.2,0,4.4,0,6.7 c0,1.2,0.4,1.8,1.6,1.7c1.3-0.1,2.5-0.1,3.8,0c1.4,0.1,1.8-0.6,1.7-1.9c0-2.1,0-4.2-0.1-6.3C87.5,35.5,88.1,34.5,90.4,34.5z M77.9,37c-2.8,1-4.5,5.8-3,7.8c0.3,0.4,1.3,0.5,2,0.5c0.3,0,0.9-0.7,0.9-1.1C78,41.8,77.9,39.5,77.9,37z"></path><path class="st1" d="M107.8,15.1c-0.1,1.7-0.1,3.4-0.5,5.1c-0.8,3.9-3.9,6.2-7.8,5.9c-3.7-0.3-6.6-3.1-6.8-7c-0.1-2.7-0.1-5.5,0-8.2 c0.2-3.7,3-6.5,6.3-6.7c4.6-0.3,7.5,1.6,8.3,5.7C107.7,11.7,107.7,13.4,107.8,15.1z M104.5,15.5C104.5,15.5,104.4,15.5,104.5,15.5 c-0.1-1.6,0.1-3.2-0.1-4.7c-0.2-1.9-1.7-3.1-3.6-3.2c-2-0.1-3.8,0.9-4,2.7c-0.3,3.2-0.4,6.4-0.1,9.6c0.2,2,2.3,3,4.5,2.8 c1.9-0.2,3.1-1.5,3.3-3.5C104.5,17.9,104.5,16.7,104.5,15.5z"></path><path class="st1" d="M51.5,12.5c-0.1,2.7,0,5.3-0.4,7.9c-0.6,3.7-3.4,5.7-7.2,5.7c-3.9,0-6.5-2-7.2-5.7c-0.2-0.7-0.3-1.5-0.3-2.3 c0-4.1,0-8.2,0-12.3c0-1.1,0.4-1.7,1.7-1.7c0.9,0,1.7,0.8,1.7,1.7c0,4.1-0.1,8.1,0,12.2c0.1,3.5,1.6,4.9,5,4.6 c1.7-0.1,2.9-1,3.4-2.7c0.2-0.9,0.3-1.7,0.3-2.6c0-3.7,0-7.4,0-10.7c0-1.1-0.1-2.1,1.5-2.1c1.6,0,1.5,1.2,1.5,2.2c0,1.7,0,3.8,0,5.7 C51.5,12.5,51.5,12.5,51.5,12.5z"></path><path class="st1" d="M160.7,25.5c-2.8,0.6-3.2,0.5-3.8-1.9c-0.5-1.8-1.5-2.7-3.4-2.4c-0.6,0.1-1.1,0.1-1.7,0 c-2.7-0.4-4.7,0.1-5.2,3.3c-0.2,1.4-1,1.5-3.5,0.9c0.2-0.8,0.4-1.7,0.7-2.5c2-5.6,4.1-11.2,6.2-16.8c0.3-0.7,1.2-1.6,1.8-1.7 c0.7,0,1.7,0.8,1.9,1.6c2.3,6,4.5,12,6.7,18C160.6,24.5,160.6,24.9,160.7,25.5z M154.8,17.5c-1-2.9-1.8-5.4-2.7-8 c-0.2,0-0.2,0-0.4,0c-0.9,2.7-1.8,5.3-2.7,8H154.8z"></path><path class="st1" d="M21.2,51.6c3.3-0.6,3.4-2.9,3.3-5.5c-0.1-3,0-6,0-8.9c0-1.9,0.3-2.2,3-2.6c0,1.5,0,2.9,0,4.3 c0,1.5-0.1,3.1,0.1,4.6c0.1,0.7,0.7,1.7,1.2,1.8c1.6,0.2,3.3,0.2,4.9,0c0.4,0,0.8-1,0.9-1.6c0.1-2.2,0.1-4.4,0-6.7 c-0.1-1.7,0.7-2.5,2.6-2.4c0.1,0.5,0.3,1,0.3,1.6c0,2.7,0.1,5.5,0,8.2c-0.1,2.5-1.4,3.8-3.9,3.9c-1.5,0-3.1,0.1-4.6,0 c-1.1-0.1-1.5,0.2-1.9,1.3c-0.5,1.3-1.3,2.6-2.4,3.5C23,54.5,22.2,54.1,21.2,51.6z"></path><path class="st1" d="M118.5,16.6c0,2.5,0,4.9,0,7.4c0,1.1-0.3,1.8-1.6,1.8c-1.4,0.1-1.8-0.5-1.8-1.8c0-4.7-0.1-9.4,0-14.1 c0-1.9-0.5-2.8-2.5-2.5c-0.6,0.1-1.3,0.2-1.9,0s-1.4-0.9-1.4-1.3c0-0.6,0.7-1.6,1.2-1.7c4.2-0.1,8.4-0.1,12.5,0c0.4,0,1,1,1.1,1.6 c0,0.4-0.6,1.1-1.1,1.4c-0.4,0.2-1,0.1-1.5,0.1c-3.1,0-3.1,0-3.1,3.2C118.5,12.6,118.5,14.6,118.5,16.6L118.5,16.6z"></path><path class="st1" d="M29.5,16.6c0,2.4,0,4.8,0,7.2c0,1.1-0.2,2-1.6,2s-1.7-0.8-1.7-1.9c0-4.7-0.1-9.4,0-14.1c0-1.7-0.5-2.5-2.2-2.3 c-0.7,0.1-1.6,0.2-2.3-0.1c-0.6-0.2-1.4-1-1.4-1.4c0-0.5,0.9-1.5,1.4-1.5c4.1-0.1,8.1-0.1,12.2-0.1c1.1,0,1.5,0.7,1.3,1.6 c-0.2,0.6-0.8,1.1-1.3,1.4c-0.4,0.3-1,0.1-1.4,0.1c-3,0-3,0-3,3.2C29.5,12.6,29.5,14.6,29.5,16.6z"></path><path class="st1" d="M61.9,51.6c3.3-0.7,3.7-2.9,3.5-5.6c-0.1-2.8,0-5.7-0.1-8.5c0-1.7,0.6-2.8,2.7-2.8c0.1,0.6,0.3,1.1,0.3,1.7 c0,3.9,0,7.8-0.1,11.8c0,1.9-0.8,3.6-2.4,4.8C64,54.3,63.3,54.2,61.9,51.6z"></path><path class="st1" d="M152.9,43.2c0-0.6-0.1-1.2,0-1.7c0.4-1.3-1.2-3.6,1.7-3.8c4.2-0.3,6,0.7,6.2,3.7c0.1,1.4,0,2.9-0.2,4.3 c-0.2,1.5-1.3,2.4-2.8,2.7c-4.2,0.9-5,0.2-5-4C152.9,44.1,152.9,43.7,152.9,43.2z M154.5,43.1c0,0.5,0,1,0,1.5 c0.1,1-0.4,2.4,1.4,2.3c1.5-0.1,2.6-0.6,2.6-2.3c0-1,0.1-2,0-3c-0.1-1.7-1.4-1.9-2.7-2c-1.5,0-1.2,1.1-1.3,2 C154.5,42.1,154.5,42.6,154.5,43.1z"></path><path class="st1" d="M140,43c0.1-5.7,0.5-6.1,6.2-5.2c0.2,0,0.6,0,0.7,0.2c0.2,0.2,0.4,0.6,0.3,0.8c-0.1,0.3-0.5,0.7-0.7,0.7 c-1,0.1-2.1-0.1-3,0.2c-0.5,0.1-1.2,0.7-1.4,1.3c-0.3,1,0.3,1.5,1.4,1.5c0.6,0,1.2-0.1,1.7,0s0.8,0.5,1.3,0.8 c-0.4,0.3-0.7,0.7-1.2,0.9s-1.1,0.1-1.7,0.1c-1-0.1-1.6,0.2-1.5,1.3c0,1.1,0.6,1.4,1.6,1.4c0.9,0,1.9,0,2.8,0.1 c0.3,0,0.6,0.5,0.8,0.8c-0.3,0.3-0.6,0.8-0.8,0.8c-1.7,0.1-3.4,0.1-5.1,0c-0.4,0-1-0.8-1.1-1.2C140,45.9,140,44.4,140,43z"></path><path class="st1" d="M127.5,43.1c0-1.3,0-2.5,0-3.8c0-1.1,0.4-1.6,1.6-1.6c1.5,0.1,3,0,4.6,0.1c0.4,0,0.7,0.5,1.1,0.7 c-0.4,0.3-0.7,0.8-1.1,0.9c-0.9,0.1-1.8-0.1-2.6,0.1c-0.6,0.1-1.2,0.7-1.4,1.3c-0.3,1,0.3,1.5,1.4,1.5c0.7,0,1.4-0.1,2.1,0.1 c0.3,0.1,0.6,0.5,0.9,0.8c-0.3,0.3-0.5,0.8-0.8,0.8c-0.7,0.1-1.4,0.1-2.1,0.1c-1,0-1.5,0.3-1.5,1.4c0,1.1,0.6,1.4,1.6,1.4 c0.9,0,1.9,0,2.8,0.1c0.3,0,0.8,0.5,0.8,0.8s-0.5,0.8-0.8,0.8c-1.8,0.1-3.6,0.1-5.3,0c-0.4,0-0.9-0.9-1-1.5 C127.4,45.7,127.5,44.4,127.5,43.1L127.5,43.1z"></path><path class="st1" d="M114.1,43.3c0-1.1,0.1-2.3,0-3.4c-0.1-1.7,0.6-2.3,2.2-2.1c0.8,0.1,1.5,0,2.3,0c2,0.1,3.2,1.3,3.3,3.2 c0.1,2-1.1,3.5-3.2,3.4c-2.2-0.1-2.8,0.8-2.6,2.8c0,0.4-0.6,0.9-0.9,1.4c-0.3-0.5-0.9-1-1-1.5C114,45.8,114.1,44.6,114.1,43.3 L114.1,43.3z M115.9,39.5c0.5,1.4-0.6,3.2,1.8,3.2c1.2,0,2.3-0.2,2.1-1.7C119.4,38.7,117.6,39.8,115.9,39.5z"></path><path class="st1" d="M103.9,48.5c-0.9-0.3-1.9-0.6-2.8-1c-0.3-0.1-0.3-0.8-0.5-1.2c0.4-0.1,0.9-0.4,1.3-0.4c1,0.1,2.1,0.5,3.1,0.5 c0.4,0,0.9-0.7,1.3-1.1c-0.4-0.4-0.7-1-1.2-1.2c-0.7-0.3-1.6-0.4-2.4-0.6c-2.2-0.7-2.8-3.4-1.1-5c1.2-1.1,4.2-1.3,5.5-0.2 c0.3,0.2,0.4,0.7,0.5,1.1c-0.4,0.2-0.8,0.5-1.3,0.5c-1,0-2-0.2-2.9-0.2c-0.3,0-0.9,0.6-0.9,1c0,0.3,0.5,0.8,0.9,1 c0.7,0.3,1.4,0.5,2.2,0.7c1.6,0.4,2.8,1.3,2.7,3.2c-0.1,1.6-1.4,2.7-3.2,2.9C104.7,48.5,104.3,48.5,103.9,48.5 C104,48.3,104,48.4,103.9,48.5z"></path><path class="st1" d="M87.6,33.2c-0.5-0.4-1.2-0.8-1.5-1.3c-0.2-0.3,0.1-1.1,0.4-1.4c0.5-0.4,1.2-0.6,1.8-0.6c0.8-0.1,1.6-0.1,2.4,0 c0.6,0.1,1.3,0.3,1.8,0.7c0.3,0.2,0.5,1.1,0.3,1.3C92.3,32.4,91.7,33,91,33c-1,0.1-2.1-0.3-3.2-0.4C87.8,32.8,87.7,33,87.6,33.2z"></path><path class="st1" d="M39.4,31.4c0,1-1.5,1.8-2.5,1.5c-0.6-0.2-1.3,0.1-2-0.1c-0.7-0.1-1.5-0.3-2.1-0.7c-0.3-0.2-0.3-1.3,0-1.5 c0.6-0.4,1.3-0.6,2.1-0.7c0.6-0.1,1.4,0.1,2-0.1C38,29.6,39.5,30.4,39.4,31.4z"></path><path class="st1" d="M57.5,55.5c-0.7-1-1.6-1.7-1.5-2.3c0-0.6,1-1.2,1.6-1.8c0.6,0.6,1.6,1.2,1.6,1.8C59.2,53.8,58.3,54.5,57.5,55.5 z"></path><path class="st0" d="M81.3,23.6c-0.6,0-1.3,0.1-1.9,0c-2.6-0.7-1-2.8-1.3-4.3c-0.2-1-0.1-2.1,1.5-2c1.2,0,2.4,0,3.6,0 c2,0.1,3.1,1.2,3.1,3.1s-1,3-3,3.2C82.5,23.6,81.9,23.6,81.3,23.6L81.3,23.6z"></path><path class="st0" d="M81.4,14.1c-0.6,0-1.1,0-1.7,0c-1.2,0.1-1.6-0.6-1.7-1.7c-0.2-3.9-0.2-3.9,3.7-3.9c1.7,0,3.4-0.1,4.1,1.9 c0.7,2.1-0.4,3.6-2.7,3.7C82.5,14.1,81.9,14.1,81.4,14.1z"></path><path class="st0" d="M129.5,8.5c1.7,0,3.2,0,4.7,0c2.1,0,2.9,0.9,3,3.1s-0.8,3.3-2.9,3.3c-5.7,0-4.8,0.6-4.9-4.8 C129.4,9.7,129.4,9.2,129.5,8.5z"></path><path class="st0" d="M62.5,8.5c3.7,0,5.1,1.3,4.2,4.4c-0.2,0.7-0.9,1.7-1.5,1.7c-1.7,0.2-3.5,0.2-5.3,0.1c-0.3,0-0.9-0.6-0.9-1 c-0.1-1.4-0.1-2.8,0-4.1c0-0.4,0.7-1,1.2-1.1C61,8.4,61.8,8.5,62.5,8.5z"></path><path class="st0" d="M47.8,37.7c0,2.8,0,5.3-0.1,7.8c0,0.3-0.8,0.8-1.2,0.8c-0.6,0-1.5-0.3-1.7-0.7C43.6,43.4,45.1,39.3,47.8,37.7z"></path><path class="st0" d="M77.9,38c0,2.6,0,4.9,0,7.2c0,0.4-0.6,1.1-0.9,1.1c-0.7,0-1.7,0-2-0.5C73.4,43.8,75.1,39,77.9,38z"></path><path class="st0" d="M104.2,16.5c0,1.2,0.1,2.4,0,3.6c-0.1,2-1.4,3.3-3.3,3.5c-2.2,0.3-4.3-0.7-4.5-2.8c-0.3-3.2-0.2-6.4,0.1-9.6 c0.2-1.8,2-2.8,4-2.7c1.9,0.1,3.4,1.3,3.6,3.2C104.3,13.3,104.1,14.9,104.2,16.5C104.1,16.5,104.2,16.5,104.2,16.5z"></path><path class="st0" d="M154.8,18.9c-2.1,0-3.8,0-5.8,0c0.9-2.7,1.8-5.4,2.7-8.1c0.1,0,0.3,0,0.4,0C153,13.4,153.8,16,154.8,18.9z"></path><path class="st0" d="M154.9,44.1c0-0.5,0-1,0-1.5c0-0.9-0.3-2.1,1.3-2c1.3,0,2.6,0.3,2.7,2c0.1,1,0,2,0,3c0,1.7-1.1,2.3-2.6,2.3 c-1.8,0.1-1.3-1.3-1.4-2.3C154.9,45.1,154.9,44.6,154.9,44.1z"></path><path class="st0" d="M115.9,40.5c1.7,0.2,3.5-0.8,3.9,1.5c0.2,1.5-0.9,1.7-2.1,1.7C115.3,43.7,116.3,42,115.9,40.5z"></path></svg>'
    },
    "./src/frontend/containers/Registration/Activation.scss": function(e, t) {},
    "./src/frontend/containers/Registration/NoMail.scss": function(e, t) {},
    "./src/frontend/containers/Registration/Registration.scss": function(e, t) {},
    "./src/frontend/locale recursive ^\\.\\/.*\\.json$": function(e, t, n) {
        function a(e) {
            return n(r(e))
        }

        function r(e) {
            var t = o[e];
            if (!(t + 1)) throw new Error("Cannot find module '" + e + "'.");
            return t
        }

        var o = {
            "./ar-AE.json": "./src/frontend/locale/ar-AE.json",
            "./el-GR.json": "./src/frontend/locale/el-GR.json",
            "./en-US.json": "./src/frontend/locale/en-US.json",
            "./fa-IR.json": "./src/frontend/locale/fa-IR.json"
        };
        a.keys = function() {
            return Object.keys(o)
        }, a.resolve = r, e.exports = a, a.id = "./src/frontend/locale recursive ^\\.\\/.*\\.json$"
    },
    "./src/frontend/locale/ar-AE.json": function(e, t) {
        e.exports = {
            TITLE: "ترافيان - لعبة تخطيط إستراتيجية متعددة اللاعبين على الإنترنت",
            DESCRIPTION: "ترافيان من أفضل ألعاب المتصفح على الإنترنت",
            KEYWORDS: "ترافيان",
            JOURNEY: {
                PLAY_NOW: {
                    JOIN_THE_FAMOUS: "انضم إلى عالم الشهرة",
                    EXPERT_STRATEGY_GAME: "لعبة استراتيجية للخبراء",
                    TRUE_MMO_WITH_THOUSAND_OF_REAL_PLAYERS: "رائدة الألعاب الجماعية على الإنترنت بالفعل مع آلاف اللاعبين الحقيقيين!",
                    PLAY_NOW: "العبها الأن"
                },
                PLAYER: {
                    INTERACTION: {
                        PLAY_WITH_THOUSANDS_OF_OTHERS: "العب مع آلاف اللاعبين الآخرين",
                        A_TRUE_MMO_EXPERIENCE: "تجربة لعبة جماعية حقيقية",
                        A_TRUE_MMO_EXPERIENCE_DESC: "اكتب قصة تتحدث عن شبكة معقدة من تفاعل مجموعة لاعبين. انطلق في عالم شاسع جدًا، بحيث أن أسرع الفرسان يحتاج أيامًا لقطعه. سيكون الجرمان المتوحشون والرومان الأشداء والإغريق الأقوياء إلى جانبك - أو في طريقك. أنظمة التجارة المدارة من قبل اللاعبين بشكل كامل تمكّن الشخص المناسب من تحقيق الثروة. حاول تملّك كل تحفة نادرة - أو قم بتشييد أسرع أعجوبة عالم في تاريخ العالم. في Travian: Legends يمكنك أن تكون أي شيء تريد."
                    },
                    PLAY_STYLE: {
                        CHOOSE_YOUR_LEGEND: "اختر أسطورتك",
                        LEGENDS: {
                            DEFENDER: {
                                TITLE: "أقسى من الفولاذ",
                                DESC: "لا تُكسب الحروب في يوم واحد. دع الحمقى يدورون حول أنفسهم ويضربون بعضهم بينما تؤسِّس اقتصادًا مزدهرًا لإمبراطوريتك. ستقف في أعلى نقطة بحصونك وتشاهد ساخرًا كيف تتساقط الجيوش الجرارة صرعى على أبوابها. انتصر على خصومك في كل خطوة لهم. جهّز الفخاخ لقواتهم واحصل على الفدية لتحرير أسراهم. تعاون مع جيرانك وعزز العمود الفقري لتحالفك الحامي الحقيقي لشعوبكم."
                            },
                            ATTACKER: {
                                TITLE: "المطرقة",
                                DESC: "اسمع صوت الطبول وأنت تجري باتجاه بوابات خصومك. اضحك في وجوههم المرتعبة ودفاعاتهم المتواضعة. التباهي بالنفس - جهد يضيع. ستذهب بالبضاعة قبل أن يمتطي أصدقاؤهم خيولهم. لكن النهب لا يكفي. سيكبر خصمك وكذلك رغبتك بالمزيد. أنت حُر. حُر في احتلال كل ركن من هذا العالم حتى يقرّ لك الجميع بالولاء في حضورك."
                            },
                            LEADER: {
                                TITLE: "قُد جيوشك بكل فخر وعزة",
                                DESC: "أليكساندر. قيصر. أنت. حياة بعض القادة تشكل فصولًا في التاريخ. انهض بتحالفك لتحوّله من حشد للمقاتلين إلى قوة لا تقهر. القائد الحقيقي لا يجلس في قلعته منتظرًا اللحظة المناسبة. استخدم شخصيتك ودبلوماسيتك لتحافظ على السلطة. ناور منافسيك واحفظ إمبراطوريتك من التفتت. لا تكن مجرد جزء من القصة. حدّث عنها. هذا عصرك."
                            }
                        }
                    }
                },
                BUILD_EXPIRE: {
                    STRATEGY_TO_PARADISE: "جنة خبراء التخطيط",
                    THE_ROAD_TO_DOMINATION: "الطريق إلى السلطة",
                    THE_ROAD_TO_DOMINATION_DESC: "لقد بدأت كل النهضات العظمى بنفس الطريقة: بوضع الحجر الأول في مكانه. لذا، فالأمر كله بين يديك. وسّع مُلكك لتصبح نقطة انطلاقك الأولى التي تتفئ بظل شجرة إمبراطورية لا تغيب عنها الشمس. استكشف العالم واعثر على واحات الثروة. وفي نهاية المطاف، اقضِ على كل من يحاول الوقوف في طريقك. ستظهر ثمار عملك في كل مبنى وكل جندي وكل تقدّم يحرز ازدهارًا لإمبراطوريتك."
                },
                BATTLE: {
                    TITLE: "حرب ملحميّة متعددة اللاعبين",
                    BOX_TITLE: "أثبت نفسك",
                    BOX_CONTENT: "دمارٌ ملتهبٌ يصل لهبه أعالي السماء وأطلال مبانٍ وآمال محطّمة في الدفاع. تهتز الأرض بقدوم الجيش وتسودّ السماء من الدخان. مرحبًا بك في ملعب الكبار. أثبت معدنك ضد آلاف اللاعبين الآخرين واكسب مكانتك في عالم ترافيان. تفوق باستخدام أفضل خطة أو قم بنهبهم كل ساعة. لا يُصنع التاريخ في قاعات البلديات، بل يتم تقريره في ساحات المعركة. هل أنت جبان - أم مقتحم؟"
                },
                LATE_GAME: {
                    TITLE: "لحظات الخلود",
                    BOX_TITLE: "أعجوبة العالم",
                    BOX_CONTENT: "لن تشعر بالقوة الحقيقية حتى تبني شيئًا هائلًا ويتوقف كل العالم ليشيد بهذا الإنجاز. شيّد أعجوبة العالم مع أعضاء تحالفك وسيكون السيرفر لك. ستخوض أكبر الحروب وستصارع أقوى الاتحادات وفي النهاية قد تضطر لخطوة واحدة في اتخاذ القرار. في لحظة الحقيقة هذه، يصبح الأصدقاء خصومًا مريرين والمنافسون القدامى تحالفات يائسة. إنه أوان الأبطال ليصيروا أساطيرًا. هل أنت مستعد؟",
                    UNIQUE_POWERS: "قوىً فريدة"
                }
            },
            NAVIGATION: {
                Game: "اللعبة",
                "Play-style": "نمط اللعبة",
                "Player interaction": "تفاعل اللعب",
                "Build empire": "إبن إمبراطورية",
                Battle: "معركة",
                "Late game": "لعبة سابقة",
                Language: "اللغة",
                "Log in and play": "سجل دخولك لتلعب",
                "Play now": "العبها الآن",
                "Back to categories": "الرجوع",
                Register: "التسجيل",
                Login: "تسجيل الدخول",
                Close: "إغلاق"
            },
            FOOTER: {
                JOIN: "انضم لمعركة ملحمية مع آلاف من اللاعبين الحقيقيين!",
                PLAY_NOW: "العبها الآن",
                COPY_RIGHT: "Travian Games GmbH. All rights reserved."
            },
            NEWS: { READ_MORE: "إقراء المزيد..." },
            GAME: {
                PLAYSTYLE: {
                    CHOOSE_YOUR_LEGEND: "اختر أسطورتك",
                    TOP5_ATTACKERS: "أفضل 5 مهاجمين",
                    TOP5_DEFENDERS: "أفضل 5 مدافعين",
                    ALLIANCES: "التحالفات",
                    THE_HAMMER: "المطرقة",
                    THE_HAMMER_DESC: "أنت تقود الدفّة دومًا. أنت رأس الرمح أو مدقّ المدماك الذي يهدم أول سور. المعارك تنقل اسمك والخصوم يرتعشون خوفًا حين ذكره. قريبًا تقود الجيوش الكبيرة وتنهب بلا هوادة في طريقك عبر الأراضين. ولكن لا ترتكب أخطاءً - فهذا الدرب ليس سهلًا. إذا كنت لا تحسن المنافسة، فهذا الطريق لا يناسبك. ولكن إذا كنت ممن يخاطرون بحياتهم وبكل شي مقابل المجد ومكافآت لا حدود لها - فانضم لنا. كن المطرقة.",
                    RAISE_AN_ARMY: "أسّس جيشًا",
                    RAISE_AN_ARMY_DESC: "هل تودّ أن تقود الحشود الواسعة التي تسد الأفق مسببًا الرعب للخصوم التي تهرب حين تشاهد هذا المنظر؟ أو أنك تفضّل فريق خبراء عسكريين، يضرب عشرات الرجال في كل مرة دون انزعاج. الأمر متروك لك في كيفية السيطرة. ولا تقلق بشأن الدفاعات. لا أحد يرغب في أن يعطي جيشك سببًا لزيارته.",
                    RAID_CONQUER_AND_CAUSE_SOME_MAYHEM: "انهب واحتل وسبّب بعض الفوضى.",
                    RAID_CONQUER_AND_CAUSE_SOME_MAYHEM_DESC: "خطتك المفضّلة تبدأ بثورة. لمَ تضيّع وقتك في حصد الموارد في حين أنه بإمكانك طرق باب جارك بأدب. اقهر الخصوم المشتركين وسيكون الأغراب أصدقاءك. والأصدقاء يتبرعون بالموارد بسعادة لحفظ السلام. قريبًا ستُسمع كلمة المحارب الذي يتحقق له ما يريد وتُنفّذ طلباته بكل احترام.",
                    YOU_ARE_THE_CHAMPION: "أنت البطل",
                    YOU_ARE_THE_CHAMPION_DESC: "هل تحتل قراهم أم تمسحها عن بكرة أبيها؟ أي المباني تختارها أولًا كهدف لمقاليعك؟ بعض القرارات أصعب من غيرها. ولكن لا داعٍ لاتخاذ كل القرارات بنفسك. اعثر على بعض الحلفاء وضاعف قوتك وهجومك من كل الزوايا. لا تختر كيف تقاتل - بل كيف تربح.",
                    A_REAL_WARRIOR_EARNS_ALL_HE_CAN_TAKE: " المحارب الحقيقي يكسب كل ما يمكنه أخذه ",
                    HARDER_THAN_STEEL: "أقسى من الفولاذ",
                    HARDER_THAN_STEEL_DESC: "قف على رجليك. واصل الهجوم تلو الهجوم إلى أن يصيبهم التعب ويصبحوا يائسين. لا تضيّع وقتك في المعارك الصغيرة. أنت في هذا على المدى الطويل. قريبًا سيقضي حجم أسوارك على كل أمل في غزوك. وستعيش قرى خصومك الضئيلة في ظلال قلعتك. لن تمر براعتك في التخطيط دون أن يلاحظها أحد. تجمّعوا مع بعض وشكّلوا قوة خارقة في منطقتكم ثم أنهوا هذه الحرب وفق شروطكم.",
                    THINK_LONG_TERM: "فكّر على المدى البعيد",
                    THINK_LONG_TERM_DESC: "الوقت هو حليفك الأكبر. يقوى موقعك في منطقتك مع انهزام كل منافس. حسّن التدريبات الخاصة بقواتك وطوّر أسلحتها حتى يتفوق جيش على الجميع في المعركة. توسّع في الاستيطان في أراضٍ جديدة وطوّر المباني التخصصية واستثمر في النواحي الحضارية والاجتماعية. مع أساس قوي ستتجاوز منافسيك حتى يحين وقت [greatest achievement](رابط إلى صفحة أعجوبة العالم).",
                    PROTECTOR_OF_THE_PEOPLE: "حامي السكان",
                    PROTECTOR_OF_THE_PEOPLE_DESC: "لن يضطر جيشك حتى لهشّ الذباب في قريتك. أضعف منافسيك عن طريق دعم جيرانك سرًا. لا شي أكثر جلبًا للسعادة من جيش غير مستعد يتحطّم على أبواب حصونك. مساعدة الأصدقاء تجلب منافع كثيرة. إضافة للموارد والتأييد المفتوح فإن رابطة دفاع قوية ستؤمّن حمايتك من الوقوع في مأزق. تأتي القوة الدبلوماسية مع براعتك وحمايتك.",
                    BE_A_TEAM_PLAYER: "كن لاعبًا في فريق",
                    BE_A_TEAM_PLAYER_DESC: "ستكون قرارات التحالف في مصلحتك حين يكون اللاعبين معتمدين على دفاعاتك. اضمن دعم بقية التحالفات وكن اللاصق الذي يُبقي الاتحاد مرتبطًا. بينما يتقاتل الآخرون للسيطرة على التحف القوية، تبقى تحفتك محمية بأمان. وحين يبدأ تحالفك بتشييد أعجوبة العالم، ستكون أنت حاميها. بفضل قوات كل أعضاء تحالفك المجتمعة في حصنك، سيكون النصر حليفك.",
                    THE_TRUE_VICTOR_STILL_STANDS_AT_THE_END: " يبقى المنتصر الحقيقي صامدًا للنهاية ",
                    LEAD_WITH_GREATNESS: "قُد جيوشك بكل فخر وعزة",
                    LEAD_WITH_GREATNESS_DESC: "لا إمبراطوريات بدون قادة. كن مركز تحالفك وقده للمجد على مستوى غير مسبوق. مع خبراتك الدبلوماسية يمكنك إيجاد حلول لا يمكن لأحد غيرك الوصول لها. اعقد المعاهدات التي تضمن لموقعك الأمان. ضع الخطط المحكمة وادفع الخصوم ليقاتل بعضهم بعضًا وادفعهم دفعًا حتى يدين الجميع بالولاء بين يديك. اعزف سيمفونية الحرب بما يرضيك.",
                    SILVER_TONGUED_AGENT: "عنصر لسان فضي",
                    SILVER_TONGUED_AGENT_DESC: "التواصل هو أقوى أداة بين يديك. حافظ على روح الفريق العالية في تحالفك وتغلّب على المشاكل قبل أن تتفاقم. ستعتمد الاتحادات على خبرتك الدبلوماسية في خفض التوتر والخطط القوية التي ترضي جميع الأطراف. تفاوض بحزم مع خصومك وقم بتوضيح نقطة أن تحالفك لا يتنازل أبدًا. تهديد الآن وبعدها عدم الإضرار بأحد. على الأقل ليس من طرفك.",
                    WISE_MENTOR: "ناصح حكيم",
                    WISE_MENTOR_DESC: "قائد قوي ينفخ روح العظمة في الآخرين. استكشاف أعضاء جدد وتحضير خطط فردية لهم ليكونوا رصيدًا قويًا. ادعم المستشارين الموهوبين وحولهم لقادة مؤهلين. ستقاتل جنبًا إلى جنب مع شركاء موثوقين وتشكل صداقات تستمر أكثر من مجرد لعبة سيرفر. أنت المحرك الذي يحوّل مجموعة من الغرباء ليعملوا معًا بإتقان كالساعة.",
                    CUNNING_STRATEGIST: "خطط بارعة",
                    CUNNING_STRATEGIST_DESC: "يعتمد عليك أعضاء تحالفك في أوقات الحاجة. نسّق الدفاعات بسلاسة ولا تكشف ثغراتك لخصومك. تصرّف بحكمة واكسب المعارك دون أن تفقد جنديًا واحدًا. ستنسق غزوات بهذا المقياس الملحمي وستكون هذه الغزوات معروفة كالأساطير لدى الجميع. عندما يحين الوقت، قم بوضع خطة محكمة ونفذها على مدى أشهر ثم استمتع بإتمامها.",
                    STEER_THE_COURSE_OF_THIS_WORLD_INTO_YOUR_CONTROL: " تحكّم بانضباط هذا العالم وفق سيطرتك "
                },
                INTERACTION: {
                    FRIENDS_AND_FOES: "الأصدقاء والخصوم",
                    A_TRUE_MMO_EXPERIENCE: "تجربة لعبة جماعية حقيقية",
                    A_TRUE_MMO_EXPERIENCE_DESC: "أنت بعيد عن الوحدة في Travian: Legends. السيرفر حي ويتغيّر، وذلك بفضل المجتمع الضخم الذي يتفاعل في التحالفات والتجارة والحرب القديمة الجيدة. كل جولة لعب تخبر عن قصة مختلفة. الاحتلالات المشتركة في منتصف الليل والمؤامرات في كل اتجاه والصداقات المتينة.  كل حركة لها تأثيرها وكل قرار له تبعاته. استوطن بالقرب من أصدقائك - أو اذهب باتجاه الإثارة.",
                    LIVE_DATA: "Live data",
                    LONG_LASTING_ALLIANCES: "تحالفات طويلة الأمد",
                    LONG_LASTING_ALLIANCES_DESC: "توفر ترافيان الكثير من الفرص للعمل الجماعي. اتصل بجيرانك وشكل فرقًا لصد التحديات المشتركة وبذلك تكوّن صداقات جديدة. تعلم من الخبراء الذي يوجهونك من خلال السيرفرات حتى تصير واحدًا منهم. تشارك بعض التحالفات في كل سيرفر ولديها صداقات تمتد خارج اللعبة. الدعم المتبادل والبقاء متحدين في كل نكسة يخلق اتحادًا فريدًا ويخلّد ذكريات لا تُنسى.",
                    TOURNAMENTS_AND_SPECIALS: "البطولات والإصدارات الخاصة",
                    TOURNAMENTS_AND_SPECIALS_DESC: "من الصعب أن تشعر بالملل في Travian: Legends. في كل عام إصدار خاص يثور على ترافيان التقليدية. وتستمر الرحلة الملحمية الحالية في أوروبا مع الإغريق والجرمان والرومان المتحاربين للسيطرة على مناطقهم. البطولات السنوية تمنحك الفرصة لإثبات جدارتك تجاه أفضل اللاعبين حول العالم. يمكنك الحصول على الجوائز والشهرة الواسعة.",
                    FORUM_AND_EVENTS: "المنتدى والفعاليات",
                    FORUM_AND_EVENTS_DESC: "انضم لمجتمع مليء بلاعبين متحمسين لديهم نفس طريقة تفكيرك. المنتدى مكان رائع للاستشارات ومناقشة الخطط وإيجاد الحلفاء للجولة القادمة أو لمجرد التسلّي. تابع المزيد من الفعاليات التي ترتبها شركة ألعاب ترافيان. فعاليات مثل حفل ميلاد ترافيان العاشر، حيث يلتقي اللاعبون والمطورون في الحياة الواقعية، يتبادلون الضحكات والقصص ويلعبون الألعاب حتى وقت متأخر من الليل.",
                    A_GAME_DRIVEN_BY_ITS_COMMUNITY: " لعبة يديرها محبّوها "
                },
                BUILD_EMPIRE: {
                    YOUR_EMPIRE: "إمبراطوريتك",
                    THE_ROAD_TO_DOMINION: "الطريق إلى السلطة",
                    THE_ROAD_TO_DOMINION_DESC: "هذا ليس فعل رجل عادي. ستحتاج لرؤيا لمّاحة تلهم جميع السكان بها. أنشئ مدينة يعشقها شعبك بعمق، مدينة يدافعون عنها عن قناعة. هل أسست إمبراطورية تجارية أم دولة ذات اكتفاء ذاتي؟ هل ستتعامل مع التهديدات برحمة - أم سترد عليها الصاع صاعين؟ حقق رؤيتك بحماس ودافع عنها ضد كل الصعاب. لن يتمكن أحدٌ من إيقافك.",
                    LIVE_DATA: "Live data",
                    CRAFT_A_SCHEME: "صغ مخططًا",
                    CRAFT_A_SCHEME_DESC: "كن حذقًا في خياراتك. تحتاج لخبير لمعرفة متى توسّع حدودك ومتى يكون من الأفضل تقوية البنى التحتية. إن جيشًا بلا إمدادات يفقد زخمه بسرعة. هل ستحمي ثغور توسعاتك وتترك مركز دولتك مفتوحًا أم ستترك الأمر لوقته حتى تقرر ذلك؟ مع زيادة التخطيط تصبح قوتك أكبر.",
                    HONE_YOUR_SKILLS: "اصقل مهاراتك",
                    HONE_YOUR_SKILLS_DESC: "هناك طرق كثيرة للتخصص. تكيّف مع الظروف بتحويل قراك لمعسكرات جيوش أو مراكز حضارية أو لمراكز تدريب أو لمحميات موارد. ادرس منافسيك جيدًا وضع أفضل الخطط العسكرية لقهرهم. درّب بطلك ليساعدك حيث يجب أن يفعل، سواء في إنتاج الموارد في قريتك أو كملهم لجيوشك في ساحة المعركة. الخطط السرية موجودة في كل مكان: تنتظر من يكشف عنها.",
                    EXPLORE_EXPAND_AND_EXTERMINATE: "استكشف وتوسّع وأبِد",
                    EXPLORE_EXPAND_AND_EXTERMINATE_DESC: "يوفّر عالم ترافيان مجالات لا حصر لها في الاستكشاف. استكشف واحات الموارد وضمها لك وضاعف انتاجك. وفي حال بقيت بحاجة الموارد، أجبر جيرانك على تزويدك بها - أو ابتلع قراك لتروي حاجتك. وكن حذرًا حين تتعثر بقطعة أثرية ثقيلة قديمة محروسة بشدة. تقول الأساطير أن المرء حين يخطف أي شيء ويعرف كيف يستخدمه، فإن ذلك سيولد لديه قوة عظيمة.",
                    "CREATE_A_DYNASTY_OF_A_THOUSAND_YEARS!": " أسّس أسرة حاكمة لآلاف السنين! "
                },
                BATTLE: {
                    EPIC_WARFARE: "Epic Warfare",
                    JOURNEY_OF_A_LEGEND: "جولة أسطورة",
                    JOURNEY_OF_A_LEGEND_DESC: "بفضل آلاف اللاعبين في السيرفر فإن الفعاليات تكون ملحمية حقًا. فالتحالفات الضخمة تنشأ لتسيطر على العالم ثم تتلاشى إلى رماد. تتطور نزاعات التحالف عبر الشهور بينما يغير كشف الأوراق والخيانات مسار التاريخ باستمرار. كل جولة جديدة مليئة بالمفاجآت. وفي نفس الوقت يعطيك الأمد البعيد الفرصة لترتب خطة محكمة. أثبت نفسك ضد أعتى الخصوم واضمن مكانك على العرش.",
                    BOLD_BEGINNINGS: "بدايات جسورة",
                    BOLD_BEGINNINGS_DESC: "شيّد قريتك الأولى. انهب جيرانك واستخدام مواردهم لتطوير مدينة مزدهرة وجيش قوي. لا حاجة للتواضع.",
                    STAY_IN_CONTROL_DESC: "وسّع إقليمك وابنِ قوة إقليمية. شغّل كل المحركات لإنتاج جيش جبار قادر على خطف تحفة.",
                    GROW_YOUR_BICEPS: "ابق متحكمًّا",
                    GROW_YOUR_BICEPS_DESC: "كن قريبًا من أصحابك واهزم خصومك! تفقّد منطقة نفوذك باستمرار حتى تقضي على أي تهديدات محتملة. أسس تحالفًا مع أناس جديرين بثقتك."
                },
                LATE_GAME: {
                    FINAL_GLORY: "المجد النهائي",
                    THE_WONDER_OF_THE_WORLD: "أعجوبة العالم",
                    THE_WONDER_OF_THE_WORLD_DESC: "كل ما قمت بإنجازه يتلخص في هذه المهمة. جبل من ذهب وفضة صنعه الإنسان، مع حدائق منحدرة وأنهار تعكس أشعة الشمس بطريقة سحرية. أعظم إنجاز لك. بتشييد أعجوبة العالم، ستترك بصمتك في كتب تاريخ ترافيان. تتمحور كل اللعبة حول الوصول لذروة الإنجاز البشري هذه. ولكن تحالفًا واحدًا فقط هو من سينتصر.",
                    THE_GRAND_FINALE: "النهائي الأكبر",
                    THE_GRAND_FINALE_DESC: "مرحبًا بك في التحدي النهائي. لإنهاء هذا الأمر، أنت بحاجة لجيوش وموارد من مصادر غير معروفة سابقًا. ينبغي على تحالفك أن يبذل أقصى استطاعته حين تنسيق العمل على أعجوبة العالم والدفاع عنها ضد القوى المتحدة من بقية أنحاء السيرفر - بدون أن يهمل الأعضاء الدفاع عن عضوياتهم نفسها. غير ذلك ينبغي عليك تدمير منافسيك لتتأكد من أنهم لن يضربوك أثناء انشغالك بأمور أخرى. بدأ السباق.",
                    THE_RACE_IS_ON: "بدأ السباق.",
                    "REACH_THE_PINNACLE_OF_HUMAN_ACHIEVEMENT!": " احصل على صفوة الإنجاز البشري! ",
                    ANCIENT_RELICS: "آثار قديمة",
                    ANCIENT_RELICS_DESC: "أثناء ترحالك ستمر على حصون من حضارات سابقة، الناتار. هم في الوقت الحاضر مجرد ظل لحجم هيمنتهم السابقة، لكن مقدار مكرهم أمر لا يستطيع مجاراتهم به أحد. وببطء تتفوق باقي القبائل بالحجم على الناتار الذين يبدؤون بالاختباء والدفاع عن تحفهم بكل ما بقي لديهم من قوة. فإذا كنت مقدمًا على تملّك مثل هذه القطعة، ستكون بين يديك قوة لا توصف. ولكن كن حذرًا - فكل العالم يتوق لها. وستكون أنت محطّ أنظارهم.",
                    STRANGE_POWERS: "قوى غريبة",
                    STRANGE_POWERS_DESC: "تملك هذه التحف التي صنعت بالمعارف القديمة قوى صعبة الفهم على إنساننا العادي. ضع واحدة منها في قريتك وراقب الأبنية كيف تتصلب وكيف تصير الأسوار غير قابلة للاختراق. وتحف أخرى تعزز قدرتك العسكرية وتمكّن قواتك من إنهاء تدريباتها بزمن أقل. أكثر التحف فرادة هي تلك التي تملك قوة تؤثر في كل أجزاء إمبراطوريتك - من أقصى جنوبها إلى حدودها الشمالية. ",
                    DARING_ADVENTURES: "مغامرات جريئة",
                    DARING_ADVENTURES_DESC: "أنت بطل قريتك وستكون هناك فرص خطيرة جدًا لدرجة أن الأشجع فقط سيحصل عليها. همسات من وحوش قاتلة وشائعات عن كنوز مسكونة وصرخات استغاثة خدّاعة بالمؤكّد. يوجهون لك النداء. في مغامراتك ومع بعض الحظ ستجد أكوامًا من الموارد والكنوز والأسلحة القوية.",
                    ANNUAL_SPECIALS: "الإصدارات السنوية الخاصة",
                    ANNUAL_SPECIALS_DESC: "هناك دومًا بعض الميزات الجديدة والمثيرة في الإصدارات السنوية الخاصة من Travian: Legends. مؤخرًا كانت التحالفات تتصارع للسيطرة على أقاليم في أوروبا القديمة. العمل الجماعي صار أهم من ذي قبل فالتحالف المسيطر على المساحة الأكبر هو الوحيد القادر على الاستفادة من القوة الفريدة في الإقليم. إضافة لذلك يمكن للاعبين تمويل تعاونيات تطويرية في مجالات مثل التعدين أو التجارة والتي تفيد كل أعضاء التحالف.",
                    LIVE_DATA: "Live data",
                    MYSTERIOUS_POWERS_ARE_WAITING_TO_BE_DISCOVERED: " قوى خفيّة بانتظار من يكتشفها... "
                }
            },
            BREADCRUMB: { Home: "الرئيسية" },
            CHANGE_LANG: { SELECT_A_LANG: "اختبار اللغة", SEACH_FOR_YOUR_LANGUAGE_OR_COUNTRY: "أبحث عن بلدك أو لغتك" },
            COOKIES_ACCEPT: {
                THIS_WEBSITE_USES_COOKIES_DESC: "يستخدم هذا الموقع ملفات تعريف الارتباط لضمان حصولك على أفضل أداء له.",
                OK: "موافق"
            },
            LOGIN: {
                LOGIN: "تسجيل الدخول",
                YOU_HAVE_PLAYED_ON: "You've played on",
                I_FORGOT_MY_GAMEWORLD: "نسيت السيرفر الذي ألعب فيه",
                CHANGE_GAME_WORLD: "تغيير السيرفر",
                LOGIN_AND_PLAY: "سجل دخولك و العب",
                I_FORGOT_MY_PASSWORD: "لقد نسيت كلمة المرور",
                LOW_RES_MODE: "وضعية الدقة المنخفضة",
                LOW_RES_MODE_DESC: "(لاتصالات الإنترنت البطيئة وأجهزة الهاتف المحمول)",
                USERNAME_OR_EMAIL: "اسم المستخدم أو الإيميل",
                PASSWORD: "كلمة المرور",
                CHOOSE_GAME_WORLD: "أختار السيرفر",
                LOGIN_TO_PLAY: "سجل دخولك لتلعب",
                OTHER_GAME_WORLDS: "سيرفرات أخرى",
                THERE_ARE_NO_GAME_WORLDS_FOR_LOGIN: "لايوجد سيرفرات متاحة"
            },
            ERRORS: {
                usernameTooShort: "اسم المستخدم قصير يجب أن يكون أكثر من  {{min}} أحرف",
                usernameTooLong: "اسم المستخدم طويل جدا يجب أن يكون أقل من  {{max}} أحرف",
                userDoesNotExists: "الاسم غير متاح",
                accountIsInactive: "الحساب غير نشط",
                passwordTooShort: "كلمة المرور قصيرة يجب أن تكون أكثر {{min}} حرف",
                passwordWrong: "كلمة المرور خاطئة",
                valueRequired: "حقل مطلوب",
                reCaptchaRequired: "التحقق مطلوب",
                invalidCaptcha: "صورة التحقق غير صحيح",
                activationNotFound: "التفعيل غير صحيح",
                emailUnknown: "البريد الإلكتروني غير صحيح",
                emailInvalid: "البريد الإلكتروني غير صحيح",
                unknownGameWorld: "السيرفر غير موجود!",
                emailTooShort: "البريد الإلكتروني قصير يجب أن يكون أقل من {{min}} حرف",
                passwordWasNotUpdated: "لم يتم تحديث كلمة المرور",
                noRecoveryCodeIncluded: "noRecoveryCode",
                noUidIncluded: "noUid",
                passwordInsecure: "كلمة المرور غير أمنة، يجب ادخال كلمة مرور أخرى",
                gameworldNotYetStarted: "السيرفر لم يبدأ بعد",
                noAccountsAssociatedWithEmailAddress: "لم نجد لك حساب على هذا البريد الإلكتروني",
                usernameBlacklisted: "الاسم غير متاح",
                passwordLikeName: "كلمة المرور مطابقة لإسم المستخدم",
                invalidChars: "يحتوي الاسم على احرف غير صحيحة",
                codeDoesNotExist: "رمز التفعيل غير صحيح",
                registrationCodeInvalid: "Invalid key",
                nameAlreadyExists: "اسم المستخدم موجود بالفعل",
                emailAlreadyRegistered: "هذا البريد موجود بالفعل",
                registrationClosed: "التسجيل غير متاح في هذا السيرفر",
                activationCodeTooShort: "رمز التفعيل قصير جدا يجب أن يكون  {{min}} حرف",
                ItsNecessaryToReadAndAcceptGTC: "يجب عليك قراءة الشروط والأحكام والموافقة عليها",
                weVeAlreadySentAFewEmailWithinShortTime: "لقد قمنا بالفعل بالإرسال لإعادة الرسالة مرة أخرى يجب الإنتظار لوقت ثم طلب الارسال"
            },
            FORGOT_PASSWORD: {
                ForgotPassword: "نسيت كلمة المرور",
                WeWillSendAnEmail: "تم ارسال كلمة مرور جديدة",
                Email: "البريد الإلكتروني",
                RecoverPassword: "إستعادة كلمة المرور",
                RequestReceived: "Request received.",
                emailWillBeSend: "سيتم إرسال بريد إلكتروني مع مزيد من التعليمات.",
                enterNewPassword: "أدخل كلمة مرور جديدة",
                setNewPassword: "كلمة مرور جديدة",
                password: "كلمة المرور",
                passwordHasBeenChanged: "تم تغيير كلمة المرور"
            },
            FORGOT_GAME_WORLD: {
                ForgotGameWorld: "نسيت سيرفر اللعب",
                enterYourEmailAddressAndWeAllSend: "أدخل بريدك الإلكتروني وسنقوم بإرسال جميع السيرفرات التي تلعب بها.",
                requestGameWorlds: "ارسال",
                WeHaveSentAListOfAssociatedAccountsToEnteredEmailAddress: "لقد قمنا بارسال جميع الحسابات الموجودة على البريد الإلكتروني",
                Email: "Email"
            },
            ACTIVATION: {
                activateAccount: "تفعيل الحساب",
                activateAnaPlay: "فعل الحساب والعب",
                ActivationCode: "رمز التفعيل",
                IDidNotReceiveAnEmail: "لم تصل رسالة التفعيل",
                UnknownOrInvalidGameWorld: "السيرفر غير متاح أو غير معروف",
                weHaveSentAnEmailContainingActivationCode: "لقد قمنا بإرسال رسالة تفعيل على بريدك الالكتروني السيرفر {{gameWorld}} قم بكتابة كلمة المرور",
                couldNotProcessActivationCode: "لا يمكن معالجة رمز التفعيل",
                WeveRecievedYourActivationKey: "We've received your activation key through the link you clicked in the email. You can now activate your account on game world com3. Please set your password."
            },
            NO_MAIL: {
                activationMail: "تفعيل البريد",
                UnknownOrInvalidGameWorld: "السيرفر غير متاح أو غير معروف",
                ResendEmail: "إعادة الإرسال",
                email: "البريد الإلكتروني",
                ReEnterYourMail: "اعد كتابة البريد الإلكتروني حتى نقوم بإرسال رسالة التفعيل",
                weHaveSentAnEmail: "لقد ارسالنا لك رسالة التفعيل ستجدها بالبريد قم باتباع التعليمات في الرسالة"
            },
            REGISTER: {
                THERE_ARE_NO_GAME_WORLDS_FOR_REGISTRATION: "التسجيل غير متاح",
                registerToPlay: "سجل والعب",
                selectGameWorld: "أختار سيرفر ",
                changeGameWorld: "تغيير السيرفر",
                registerNow: "التسجيل الآن",
                IAlreadyHaveAnAccount: "لدي حساب بالفعل",
                recommendedGameWorld: "السيرفر الموصى به",
                otherGameWorlds: "سيرفر أخر",
                Username: "اسم المستخدم",
                Password: "كلمة المرور",
                Email: "البريد الإلكتروني",
                PlayerInvitedYou: "{{player}} invited you to play in this game world. Click on it again to change it anyway.",
                PlayerInvitedYouToTravian: "{{player}} أرسل لك دعوة للعب في ترافيان",
                RegistrationKey: "Registration key",
                IAgreeToTermsAndConditionsAndPrivacyPolicy: 'أوافق على <a target="_blank" class="inline" title="Terms &amp; Conditions" href="/terms.php">الشروط والأحكام</a>  و  <a href="/privacy.php" target="_blank" class="inline" title="Privacy Policy">سياسة الخصوصية</a>',
                "Subscribe to newsletter": "اشترك في النشرة الإخبارية",
                alreadyRegistered: "مسجل بالفعل؟ تابع لعملية التنشيط هنا"
            },
            SERVER_AGE: "مدة السيرفر",
            "Loading...": "يرجى الإنتظار...",
            NO_MORE_SERVERS: "لا يوجد سيرفرات أخرى.",
            SERVER_START_TIME: {
                INSTANT_FINISH_TRAINING: "يوجد إنهاء فوري للقوات",
                SERVER_WILL_START_AT: "ستبدأ اللعبة في {{date}} {{time}}",
                SERVER_WAS_STARTED_X_UNIT_AGO: "{{value}} {{unit}}",
                UNIT_SECONDS: "ثواني",
                UNIT_HOURS: "ساعة",
                UNIT_DAYS: "أيام",
                UNIT_MINUTES: "دقيقة",
                GAME_WORLD_FINISHED: "إنتهت اللعبة"
            }
        }
    },
    "./src/frontend/locale/el-GR.json": function(e, t) {
        e.exports = {
            TITLE: "TRAVIAN - το απόλυτο online παιχνίδι στρατηγικής",
            DESCRIPTION: "Travian is one of the best multi-player strategy games for your browser!",
            KEYWORDS: "Travian,Onlime game,strategy game,multiplayer game,Romans,Teutens,Guals,Aspidanetwork,Molon-lave,Citvian,Travian speed,SpeedTra, SpeedTravian, Travian games, MultiSpeed",
            JOURNEY: {
                PLAY_NOW: {
                    JOIN_THE_FAMOUS: "ΜΠΕΙΤΕ ΣΤΟ ΚΛΑΜΠ ΤΩΝ ΔΙΑΣΗΜΩΝ",
                    EXPERT_STRATEGY_GAME: "ΠΑΙΧΝΙΔΙ ΣΤΡΑΤΗΓΙΚΗΣ ΓΙΑ ΤΟΥΣ ΑΡΙΣΤΟΥΣ",
                    TRUE_MMO_WITH_THOUSAND_OF_REAL_PLAYERS: "Το αληθινό αυθεντικό MMO με χιλιάδες αληθινούς παίκτες!",
                    PLAY_NOW: "PLAY NOW"
                },
                PLAYER: {
                    INTERACTION: {
                        PLAY_WITH_THOUSANDS_OF_OTHERS: "Παίξτε με χιλιάδες άλλους",
                        A_TRUE_MMO_EXPERIENCE: "Μια πραγματική εμπειρία MMO",
                        A_TRUE_MMO_EXPERIENCE_DESC: "Συμμετάσχετε σε μια ιστορία η αφήγηση της οποίας εκτυλίσσεται σε έναν σύνθετο ιστό από ενέργειες των παικτών. Περιηγηθείτε σε έναν κόσμο τόσο αχανή που ακόμα κι ο γρηγορότερος αναβάτης θα έκανε μέρες για να τον διασχίσει. Αδάμαστοι Τεύτονες, σκληροτράχηλοι Ρωμαίοι και ευρηματικοί Γαλάτες θα είναι στο πλευρό σας ή απέναντί σας. Συστήματα εμπορικών συναλλαγών που είναι πλήρως διαχειριζόμενα από τους παίκτες επιτρέπουν στο κατάλληλο άτομο να φτιάξει περιουσία. Προσπαθήστε να αποκτήσετε κάθε μοναδικό πολύτιμο ή μαγικό αντικείμενο ή φτιάξτε πιο γρήγορα από ποτέ στην ιστορία κάποιο Θαύμα του Κόσμου. Στο Travian: Legends μπορείτε να είστε αυτός που εσείς θέλετε."
                    },
                    PLAY_STYLE: {
                        CHOOSE_YOUR_LEGEND: "Επιλέξτε το θρύλο σας",
                        LEGENDS: {
                            DEFENDER: {
                                TITLE: "Πιο σκληρός κι από ατσάλι",
                                DESC: "Μείνετε σταθερός κι αμετακίνητος στη θέση σας. Αντέξτε στη μια επίθεση μετά την άλλη μέχρι οι αντίπαλοί σας να εξουθενωθούν και να απελπιστούν. Μη χαραμίζετε το χρόνο σας σε μικροσυμπλοκές κι ανούσιες μάχες. Για εσάς αυτό που μετράει είναι πάντα το μακροπρόθεσμο κέρδος. Σύντομα, το μέγεθος των τειχών σας θα γκρεμίσει οριστικά κάθε ελπίδα κατάκτησης και τα ασήμαντα χωριά των εχθρών σας θα φυτοζωούν στη σκιά των κάστρων σας. Η επιδεξιότητά σας στη στρατηγική δεν θα μείνει απαρατήρητη. Συνάψτε συμμαχίες, σχηματίζοντας μια περιφερειακή υπερδύναμη και τερματίστε τον πόλεμο με τους δικούς σας όρους."
                            },
                            ATTACKER: {
                                TITLE: "Η Σφύρα",
                                DESC: "Νιώστε τον ήχο των τυμπάνων καθώς προελαύνετε στις πύλες των εχθρών σας. Καγχάστε μπροστά στα έντρομα πρόσωπά τους και την πενιχρή άμυνά τους. Τα κέρατα του πολέμου ήχησαν, μια χαμένη προσπάθεια. Θα έχετε γίνει καπνός με τα λάφυρά σας, προτού προλάβουν να ανέβουν στα άλογά τους. Αλλά οι επιδρομές δεν αρκούν. Ο στρατός σας θα μεγαλώσει και το ίδιο κι η λαχτάρα σας για ακόμα περισσότερα. Είστε ελεύθερος. Ελεύθερος να κατακτήσετε κάθε γωνιά αυτού το κόσμου μέχρι όλοι να γονατίζουν στην παρουσία σας."
                            },
                            LEADER: {
                                TITLE: "Ηγηθείτε με το μεγαλείο σας",
                                DESC: "Χωρίς ηγέτες, δεν υπάρχουν αυτοκρατορίες. Γίνετε το κέντρο της συμμαχίας σας και οδηγήστε την σε επίπεδα δόξας χωρίς προηγούμενο. Με την εμπειρία και τις ικανότητές σας στη διπλωματία, μπορείτε να βρίσκετε τις λύσεις που κανείς άλλος δεν μπορεί Διευθετήστε συμμαχίες που θα καταστήσουν την επικράτειά σας απρόσβλητη. Επινοήστε πανούργες στρατηγικές, στρέψτε τους εχθρούς σας τον έναν εναντίον του άλλου και εκμεταλλευτείτε κάθε πιθανή ευκαιρία έως ότου όλος ο κόσμος ακολουθεί το δικό σας θέλημα. Διευθύνετε τη συμφωνική του πολέμου όπως εσείς θέλετε."
                            }
                        }
                    }
                },
                BUILD_EXPIRE: {
                    STRATEGY_TO_PARADISE: "Παράδεισος για τους εξπέρ της στρατηγικής",
                    THE_ROAD_TO_DOMINATION: "Ο δρόμος προς την κυριαρχία",
                    THE_ROAD_TO_DOMINATION_DESC: "Δεν πρόκειται για το κατόρθωμα ενός συνηθισμένου ανθρώπου. Απαιτείται ένα όραμα τόσο ξεκάθαρο, τόσο λαμπρό, που θα εμπνεύσει έναν ολόκληρο πληθυσμό. Οικοδομήστε μια πόλη που ο λαός σας πραγματικά θα λατρέψει, μια πόλη που θα υπερασπιστούν με πάθος και αποφασιστικότητα. Θα ιδρύσετε μια αυτοκρατορία που βασίζεται στο εμπόριο ή μια επικράτεια που είναι αυτάρκης; Θα αντιμετωπίσετε τις απειλές με επιείκεια ή με ασύμμετρη επίδειξη ισχύος; Όποιο κι αν είναι το όραμά σας, επιδιώξτε το με ζήλο και υπερασπιστείτε το με οποιοδήποτε κόστος. Κανένας δεν θα μπορέσει να σας σταματήσει."
                },
                BATTLE: {
                    TITLE: "Επικών διαστάσεων μάχες MMO",
                    BOX_TITLE: "Αποδείξτε την αξία σας",
                    BOX_CONTENT: "Αποκαΐδια και στάχτες που στροβιλίζονται στους ουρανούς, γκρεμίζοντας κτίρια και κάθε ελπίδα για άμυνα. Το έδαφος τρέμει από τον στρατό που επελαύνει, καθώς ο ουρανός σκοτεινιάζει από τον καπνό. Καλώς ορίσατε στην παιδική χαρά των ενηλίκων. Αποδείξτε την αξία σας αντιμέτωπος με χιλιάδες άλλους παίκτες και κερδίστε τη θέση σας στον κόσμο του Travian. Διακριθείτε χάρη στην πιο έξυπνη στρατηγική σας ή απλώς εξουθενώστε τους εχθρούς σας με διαρκείς επιδρομές κάθε ώρα και στιγμή. Η Ιστορία δεν γράφεται στα παλιά δημαρχεία, αλλά στα πεδία της μάχης Είστε ένας δειλός ή ένας κατακτητής;"
                },
                LATE_GAME: {
                    TITLE: "Μνημεία για την αιωνιότητα",
                    BOX_TITLE: "Το Θαύμα του Κόσμου",
                    BOX_CONTENT: "Δεν έχετε νιώσει τι σημαίνει πραγματική δύναμη μέχρι να χτίσετε κάτι τόσο μνημειώδες που όλος ο κόσμος στέκεται μπροστά του με σεβασμό. Προχωρήστε στην ανέγερση ενός Θαύματος του Κόσμου μαζί με τη συμμαχία σας, και ο server είναι δικός σας. Θα συμμετάσχετε στις μεγαλύτερες πολεμικές αναμετρήσεις και στις ισχυρότερες συμμαχίες αλλά στο τέλος ίσως όλα κριθούν από μία και μόνο αποφασιστική κίνηση. Σε εκείνη τη στιγμή της αλήθειας, φίλοι μπορούν να γίνουν άσπονδοι εχθροί και παλιοί αντίπαλοι να σχηματίσουν συμμαχίες μέσα στην απόγνωσή τους. Είναι η ώρα που οι ήρωες θα γίνουν θρύλοι. Είστε έτοιμος;",
                    UNIQUE_POWERS: "Μοναδικές δυνάμεις"
                }
            },
            NAVIGATION: {
                Game: "ΠΑΙΧΝΙΔΙ",
                "Play-style": "Στυλ παιχνιδιού",
                "Player interaction": "Αλληλεπίδραση παικτών",
                "Build empire": "Δημιουργία αυτοκρατορίας",
                Battle: "Μάχη",
                "Late game": "Όψιμο παιχνίδι",
                Language: "Γλώσσα",
                "Log in and play": "Συνδέσου για να παίξεις",
                "Play now": "Παίξε τώρα",
                "Back to categories": "Πίσω στις κατηγορίες",
                Register: "ΕΓΓΡΑΦΗ",
                Login: "ΣΥΝΔΕΣΗ",
                Close: "Κλείσε"
            },
            FOOTER: {
                JOIN: "Ελάτε κι εσείς σε μια επική μάχη με χιλιάδες πραγματικούς παίκτες!",
                PLAY_NOW: "Παίξε τώρα",
                COPY_RIGHT: "© 2004 - 2018 Travian Games GmbH. Με την επιφύλαξη παντός δικαιώματος."
            },
            NEWS: { READ_MORE: "Περισσότερα..." },
            GAME: {
                PLAYSTYLE: {
                    CHOOSE_YOUR_LEGEND: "Επιλέξτε το θρύλο σας",
                    TOP5_ATTACKERS: "Top 5 επιθετικοί",
                    TOP5_DEFENDERS: "Top 5 αμυντικοί",
                    ALLIANCES: "Συμμαχίες",
                    THE_HAMMER: "Η Σφύρα",
                    THE_HAMMER_DESC: "Είστε πάντα μπροστάρης στην έφοδο. Είστε η αιχμή του δόρατος ή η κεφαλή του κριού που γκρεμίζει το πρώτο τείχος. Το όνομά σας γίνεται διάσημο στις μάχες και οι εχθροί σας τρέμουν στο άκουσμά του. Σύντομα πρόκειται να διοικήσετε μεγάλους στρατούς και να λαφυραγωγήσετε τα πάντα στο πέρασμά σας. Αλλά μην ξεγελαστείτε: το μονοπάτι αυτό δεν θα το διαβείτε εύκολα. Εάν δεν αντέχετε τον σκληρό ανταγωνισμό, η πρόκληση αυτή δεν είναι για εσάς. Αλλά, εάν είστε διατεθειμένος να ρισκάρετε τα πάντα για ανταμοιβές και δόξα χωρίς τέλος, τότε ελάτε κι εσείς μαζί μας. Γίνετε η σφύρα.",
                    RAISE_AN_ARMY: "Στρατολογήστε ένα στράτευμα",
                    RAISE_AN_ARMY_DESC: "Θέλετε να ηγηθείτε μιας ορδής τόσο μεγάλης που χάνεται στον ορίζοντα, κάνοντας τους εχθρούς σας να τραπούν σε φυγή και μόνο που την αντικρίζουν; Ή προτιμάτε μια μικρότερη δύναμη από σκληροτράχηλους επαγγελματίες που θα κάνουν τη φονική δουλειά εύκολα, γρήγορα και αποτελεσματικά; Το πώς θα κυριαρχήσετε εξαρτάται μόνο από εσάς. Και μην ανησυχείτε για τα αμυντικά έργα. Κανένας δεν θα θέλει να δώσει αφορμές για επισκέψεις στο στρατό σας.",
                    RAID_CONQUER_AND_CAUSE_SOME_MAYHEM: "Επιδοθείτε σε ένα όργιο επιδρομών, κατακτήσεων και λεηλασίας",
                    RAID_CONQUER_AND_CAUSE_SOME_MAYHEM_DESC: "Η αγαπημένη σας στρατηγική ξεκινά με έναν μανιασμένο χαμό. Γιατί να χάνετε χρόνο συλλέγοντας πόρους όταν μπορείτε να …χτυπήσετε την πόρτα του γείτονά σας και να του τις ζητήσετε ευγενικά. Βρεθείτε μαζί αντιμέτωποι με κοινούς σας εχθρούς και οι ξένοι θα γίνουν φίλοι σας. Και οι φίλοι είναι πάντα πρόθυμοι να συνεισφέρουν σε πόρους, προκειμένου να διατηρηθεί η ειρήνη. Σύντομα, θα διαδοθούν φήμες για έναν πολεμιστή που παίρνει πάντα αυτό που θέλει και έτσι οι απαιτήσεις σας θα γίνονται σεβαστές.",
                    YOU_ARE_THE_CHAMPION: "Είστε πρόμαχος",
                    YOU_ARE_THE_CHAMPION_DESC: "Θα κατακτήσετε τα χωριά των εχθρών σας ή θα τα κάψετε συθέμελα; Ποιο κτίριο θα γνωρίσει πρώτο την οργή των καταπελτών σας; Μερικές αποφάσεις είναι δυσκολότερες από άλλες, αλλά δεν είναι ανάγκη να τις παίρνετε όλες μόνος σας. Βρείτε μερικούς συμμάχους, πολλαπλασιάστε την ισχύ σας και επιτεθείτε από παντού. Μην επιλέγετε το πώς θα πολεμήσετε: επιλέξτε το πώς θα νικήσετε.",
                    A_REAL_WARRIOR_EARNS_ALL_HE_CAN_TAKE: "Ένας πραγματικός μαχητής κερδίζει όλα όσα μπορεί.",
                    HARDER_THAN_STEEL: "Πιο σκληρός κι από ατσάλι",
                    HARDER_THAN_STEEL_DESC: "Μείνετε σταθερός κι αμετακίνητος στη θέση σας. Αντέξτε στη μια επίθεση μετά την άλλη μέχρι οι αντίπαλοί σας να εξουθενωθούν και να απελπιστούν. Μη χαραμίζετε το χρόνο σας σε μικροσυμπλοκές κι ανούσιες μάχες. Για εσάς αυτό που μετράει είναι πάντα το μακροπρόθεσμο κέρδος. Σύντομα, το μέγεθος των τειχών σας θα γκρεμίσει οριστικά κάθε ελπίδα κατάκτησης και τα ασήμαντα χωριά των εχθρών σας θα φυτοζωούν στη σκιά των κάστρων σας. Η επιδεξιότητά σας στη στρατηγική δεν θα μείνει απαρατήρητη. Συνάψτε συμμαχίες, σχηματίζοντας μια περιφερειακή υπερδύναμη και τερματίστε τον πόλεμο με τους δικούς σας όρους.",
                    THINK_LONG_TERM: "Σκεφτείτε μακροπρόθεσμα",
                    THINK_LONG_TERM_DESC: "Ο χρόνος είναι ο σημαντικότερος σύμμαχός σας Με κάθε εξουθενωμένο αντίπαλό σας, η θέση σας στην περιοχή ενδυναμώνεται. Εκλεπτύνετε τις πολεμικές σας ασκήσεις και σφυρηλατήστε ισχυρότερα όπλα έως ότου ο στρατός σας υπερτερεί σε σχέση με οποιονδήποτε άλλον στη μάχη. Επεκτείνετε την επικράτειά σας με νέους οικισμούς, προωθήστε την οικοδόμηση εξειδικευμένων κτιρίων και επενδύστε στην ανάπτυξη μια κοινωνίας με υψηλό πολιτισμικό και βιωτικό επίπεδο. Με ένα τέτοιο ισχυρό θεμέλιο, θα είστε σε θέση να διατηρήσετε την επικράτεια και την εξουσία σας περισσότερο από τους αντιπάλους σας έως ότου έρθει η στιγμή για το μεγαλύτερό σας επίτευγμα [greatest achievement](σύνδεσμος προς σελίδα ΠΘ).",
                    PROTECTOR_OF_THE_PEOPLE: "Προστάτης του λαού",
                    PROTECTOR_OF_THE_PEOPLE_DESC: "Ο στρατός σας δεν προορίζεται για να πιάνει μύγες στο χωριό σας. Εξουθενώστε τους αντιπάλους σας στέλνοντας κρυφά βοήθεια στους γείτονές σας. Λίγα πράγματα είναι τόσο απολαυστικά όσο ένας απροετοίμαστος στρατός που υφίσταται μια ταπεινωτική ήττα μπροστά από τα τείχη του οχυρού σας. Η παροχή βοήθειας σε φίλους αποφέρει πολλά οφέλη. Πέρα από το πλεονέκτημα της συλλογής πόρων και των αμοιβαίων εκδουλεύσεων, ένας ισχυρός αμυντικός δεσμός θα διασφαλίσει ότι δεν θα βρεθείτε ποτέ σε δύσκολη θέση. Ως απόρροια της ισχύος σας και της προστασίας που παρέχετε, έρχεται και η διπλωματική ισχύς.",
                    BE_A_TEAM_PLAYER: "Παίξτε ως μέλος μιας ομάδας",
                    BE_A_TEAM_PLAYER_DESC: "Οι αποφάσεις της συμμαχίας θα είναι υπέρ σας όταν οι σύμμαχοί σας εξαρτώνται από τα δικά σας αμυντικά έργα. Διασφαλίστε την υποστήριξη προς τους άλλους συμμάχους σας και γίνετε ο συνεκτικός κρίκος που διατηρεί ενωμένες τις συμμαχίες. Ενόσω άλλοι μάχονται για την κατοχή πολύτιμων αντικειμένων, τα δικά σας φυλάσσονται καλά Και όταν η συμμαχία σας ανεγείρει κάποιο Θαύμα του Κόσμου, θα γίνεται ο φύλακάς του. Με τις συνδυασμένες δυνάμεις όλης της συμμαχίας σας στο φρούριό σας, η νίκη θα είναι δική σας.",
                    THE_TRUE_VICTOR_STILL_STANDS_AT_THE_END: "Ο πραγματικός νικητής είναι αυτός που στο τέλος στέκεται ακόμα όρθιος.",
                    LEAD_WITH_GREATNESS: "Ηγηθείτε με το μεγαλείο σας",
                    LEAD_WITH_GREATNESS_DESC: "Χωρίς ηγέτες, δεν υπάρχουν αυτοκρατορίες. Γίνετε το κέντρο της συμμαχίας σας και οδηγήστε την σε επίπεδα δόξας χωρίς προηγούμενο. Με την εμπειρία και τις ικανότητές σας στη διπλωματία, μπορείτε να βρίσκετε τις λύσεις που κανείς άλλος δεν μπορεί Διευθετήστε συμμαχίες που θα καταστήσουν την επικράτειά σας απρόσβλητη. Επινοήστε πανούργες στρατηγικές, στρέψτε τους εχθρούς σας τον έναν εναντίον του άλλου και εκμεταλλευτείτε κάθε πιθανή ευκαιρία έως ότου όλος ο κόσμος ακολουθεί το δικό σας θέλημα. Διευθύνετε τη συμφωνική του πολέμου όπως εσείς θέλετε.",
                    SILVER_TONGUED_AGENT: "Ο πράκτορας με τη γλώσσα από ασήμι",
                    SILVER_TONGUED_AGENT_DESC: "Η επικοινωνία είναι το πιο ισχυρό εργαλείο που διαθέτετε. Διατηρήστε ακμαίο το ηθικό στις τάξεις των συμμάχων σας και επιλύστε τα προβλήματα προτού καλά-καλά προκύψουν. Οι συνομοσπονδίες συμμάχων θα εξαρτώνται από την επιδεξιότητά σας στη διπλωματία για την εξομάλυνση εντάσεων και την κατάρτιση σχεδίων που θα κερδίσουν την εύνοια όλων των συμβαλλομένων. Διαπραγματευτείτε αφ’ υψηλού με τους εχθρούς σας και ξεκαθαρίστε τους ότι η συμμαχία σας δεν πρόκειται να υποχωρήσει. Μια απειλή από καιρό σε καιρό δεν έβλαψε ποτέ κανέναν. Τουλάχιστον όχι κάποιον από τη δική σας παράταξη.",
                    WISE_MENTOR: "Σοφός σύμβουλος",
                    WISE_MENTOR_DESC: "Ένας ισχυρός ηγέτης εμπνέει το μεγαλείο και σε άλλους. Εντοπίστε νέα μέλη και συλλάβετε μεμονωμένες στρατηγικές για καθένα από αυτά, προκειμένου να καταστούν χρήσιμα εργαλεία στα χέρια σας. Υποστηρίξτε ταλαντούχους συμβούλους και μετατρέψτε τους σε ικανούς ηγέτες. Θα πολεμήσετε ώμο προς ώμο με έμπιστους συντρόφους και θα συνάψετε φιλίες που ξεπερνούν τα ψηφιακά όρια ενός κόσμου παιχνιδιού. Είστε το γρανάζι που μετατρέπει μια ομάδα ξένων μεταξύ τους σε ένα καλοκουρδισμένο ρολόι.",
                    CUNNING_STRATEGIST: "Πανούργος στη στρατηγική",
                    CUNNING_STRATEGIST_DESC: "Οι εταίροι σας στη συμμαχία βασίζονται σε εσάς όταν έχουν ανάγκη. Συντονίστε την άμυνά σας γρήγορα και μην επιτρέψετε στους εχθρούς σας να εκμεταλλευτούν την παραμικρή αδυναμία. Δράστε σοφά και κερδίστε μάχες, χωρίς να χάσετε ούτε έναν στρατιώτη. Θα ενορχηστρώσετε εισβολές τέτοιας επικής κλίμακας που θα καταλήξουν να γίνουν μύθοι πασίγνωστοι. Κι όταν έρθει η ώρα, εκπονήστε μια στρατηγική που ξεδιπλώνει τις πτυχές της σε περίοδο μηνών και απολαύστε την τέλεια υλοποίησή της.",
                    STEER_THE_COURSE_OF_THIS_WORLD_INTO_YOUR_CONTROL: "Έχετε το τιμόνι αυτού του κόσμου στα χέρια σας: καθορίστε την πορεία σας."
                },
                INTERACTION: {
                    FRIENDS_AND_FOES: "Φίλοι κι εχθροί",
                    A_TRUE_MMO_EXPERIENCE: "Μια πραγματική εμπειρία MMO",
                    A_TRUE_MMO_EXPERIENCE_DESC: "Δεν είστε καθόλου μόνος σας στο Travian: Legends. Ο κόσμος του παιχνιδιού είναι ζωντανός και μεταβάλλεται διαρκώς, χάρη σε μια τεράστια κοινότητα χρηστών που αλληλεπιδρά μέσω συμμαχιών, εμπορίου και, κλασικά, πολεμικών αναμετρήσεων. Κάθε γύρος του παιχνιδιού αφηγείται και μια διαφορετική ιστορία. Κατακτήσεις από κοινού εν μέσω της νυκτός, ίντριγκες προς πάσα κατεύθυνση και φιλίες φτιαγμένες από ατσάλι.  Κάθε ενέργεια, κάθε κίνηση έχει τον αντίκτυπό της, κάθε απόφαση τις συνέπειές της. Εποικίστε περιοχές κοντά στους φίλους σας ή απλώς εκεί που υπάρχει δράση.",
                    LIVE_DATA: "Ζωντανά δεδομένα",
                    LONG_LASTING_ALLIANCES: "Συμμαχίες που διαρκούν",
                    LONG_LASTING_ALLIANCES_DESC: "Το Travian παρέχει πάμπολλες ευκαιρίες για ομαδικό παιχνίδι. Ελάτε σε επαφή με τους γείτονές σας, ενωθείτε απέναντι σε κοινές απειλές και καταλήξτε να κάνετε νέους φίλους. Μάθετε από έμπειρους συμβούλους που σας καθοδηγούν τους διαφόρους κόσμους, μέχρι κι εσείς να αναδειχθείτε σε έναν από αυτούς. Μερικές συμμαχίες διατηρούνται σε κάθε server και οι φιλίες που δημιουργούνται επεκτείνονται και εκτός παιχνιδιού. Η αμοιβαία υποστήριξη και η διατήρηση της ενότητας ακόμα και μετά από αναποδιές δημιουργεί δεσμούς με συναρπαστικές αναμνήσεις.",
                    TOURNAMENTS_AND_SPECIALS: "Τουρνουά και ειδικές εκδόσεις",
                    TOURNAMENTS_AND_SPECIALS_DESC: "Είναι δύσκολο να βαρεθεί κάποιος στο Travian: Legends. Κάθε χρόνο, κυκλοφορεί μια ειδική έκδοση που δίνει έναν αέρα ανανέωσης στο κλασικό παιχνίδι του Travian. Το επικό ταξίδι προς το παρόν συνεχίζει προς το παρόν στην Ευρώπη, όπου Γαλάτες, Ρωμαίοι και Τεύτονες μάχονται για τον έλεγχο των εδαφών της. Ετήσια τουρνουά σάς δίνουν την ευκαιρία να αποδείξετε την αξία σας αντιμέτωποι με τους καλύτερους παίκτες στον κόσμο. Μπορείτε να κερδίσετε πολλές επιβραβεύσεις και αιώνια φήμη.",
                    FORUM_AND_EVENTS: "Φόρουμ και Εκδηλώσεις",
                    FORUM_AND_EVENTS_DESC: "Συμμετάσχετε κι εσείς σε μια κοινότητα με πολλούς ενθουσιώδεις φίλους με παρόμοια ενδιαφέροντα. Το φόρουμ αποτελεί ένα εξαιρετικό μέσο όπου μπορείτε να ανταλλάσσετε συμβουλές, να συζητάτε στρατηγικές, να βρίσκετε συμμάχους για το επόμενο παιχνίδι ή απλώς να κουβεντιάσετε. Να έχετε το νου σας για διάφορες εκδηλώσεις και event που φιλοξενούνται από την Travian Games. Εκδηλώσεις, όπως το 10ο πάρτι γενεθλίων, όπου παίκτες συναντήθηκαν με τους προγραμματιστές στην πραγματική ζωή, αντάλλαξαν εμπειρίες, γέλασαν και έπαιξαν παιχνίδια μέχρι αργά τη νύχτα.",
                    A_GAME_DRIVEN_BY_ITS_COMMUNITY: "Ένα παιχνίδι που βασίζεται στην κοινότητα των παικτών του."
                },
                BUILD_EMPIRE: {
                    YOUR_EMPIRE: "Η δική σας αυτοκρατορία",
                    THE_ROAD_TO_DOMINION: "Ο δρόμος προς την κυριαρχία",
                    THE_ROAD_TO_DOMINION_DESC: "Δεν πρόκειται για το κατόρθωμα ενός συνηθισμένου ανθρώπου. Απαιτείται ένα όραμα τόσο ξεκάθαρο, τόσο λαμπρό, που θα εμπνεύσει έναν ολόκληρο πληθυσμό. Οικοδομήστε μια πόλη που ο λαός σας πραγματικά θα λατρέψει, μια πόλη που θα υπερασπιστούν με πάθος και αποφασιστικότητα. Θα ιδρύσετε μια αυτοκρατορία που βασίζεται στο εμπόριο ή μια επικράτεια που είναι αυτάρκης; Θα αντιμετωπίσετε τις απειλές με επιείκεια ή με ασύμμετρη επίδειξη ισχύος; Όποιο κι αν είναι το όραμά σας, επιδιώξτε το με ζήλο και υπερασπιστείτε το με οποιοδήποτε κόστος. Κανένας δεν θα μπορέσει να σας σταματήσει.",
                    LIVE_DATA: "Ζωντανά δεδομένα",
                    CRAFT_A_SCHEME: "Εκπονήστε ένα σχέδιο δράσης",
                    CRAFT_A_SCHEME_DESC: "Αποδειχθείτε έξυπνοι στις επιλογές που κάνετε. Είναι θέμα εμπειρίας και ικανότητας να ξέρετε πότε πρέπει να επεκτείνετε την επικράτειά σας και πότε είναι καλύτερα να ενισχύσετε τις υποδομές σας. Ένας στρατός χωρίς προμήθειες χάνει γρήγορα την ορμητικότητά του. Θα φυλάξετε τις προκεχωρημένες σας θέσεις και θα αφήσετε το κέντρο αφύλακτο ή θα αφήσετε την τύχη να αποφασίσει για τη μοίρα τους; Όσο καλύτερο το σχέδιό σας, τόσο πιο ισχυρός θα γίνετε.",
                    HONE_YOUR_SKILLS: "Τελειοποιήστε τις δεξιότητές σας",
                    HONE_YOUR_SKILLS_DESC: "Υπάρχουν πολλοί τρόποι για να εξειδικευτείτε. Προσαρμοστείτε στις περιστάσεις, μετατρέποντας τα χωριά σας σε οχυρά, πολιτιστικά κέντρα, στρατόπεδα ή χώρους συγκέντρωσης πόρων. Αναλύστε τους αντιπάλους σας και σχεδιάστε την τέλεια πολεμική στρατηγική για να ανατρέψετε τη δική τους. Εκπαιδεύστε τον ήρωά σας για να βοηθά εκεί όπου υπάρχει μεγαλύτερη ανάγκη, είτε πρόκειται για προμήθειες για το χωριό σας είτε για ωμή δύναμη στο πεδίο της μάχης. Παντού υπάρχουν κρυφές στρατηγικές, που περιμένουν να τις ανακαλύψετε.",
                    EXPLORE_EXPAND_AND_EXTERMINATE: "Εξερευνήστε, επεκταθείτε, εξολοθρεύστε",
                    EXPLORE_EXPAND_AND_EXTERMINATE_DESC: "Ο κόσμος του Travian σάς προσφέρει άπειρες περιοχές προς εξερεύνηση. Ανακαλύψτε οάσεις με πόρους, διεκδικήστε τες και διπλασιάστε την παραγωγή σας. Εάν είστε ακόμα …πεινασμένοι, μπορείτε να πιέσετε τους γείτονές σας να υποστηρίξουν την επικράτειά σας, αν θέλουν να παραμείνουν ανεξάρτητοι και να μην ενσωματωθούν σε αυτήν. Εάν τυχόν στο δρόμο σας βρεθεί κάποιο παλιό πολύτιμο αντικείμενο που φυλάσσεται καλά, να έχετε το νου σας. Οι θρύλοι λένε ότι όποιος κλέψει ένα και καταφέρει να μάθει πώς χρησιμοποιείται θα αποκτήσει τρομακτική δύναμη.",
                    "CREATE_A_DYNASTY_OF_A_THOUSAND_YEARS!": "Δημιουργήστε μια δυναστεία που θα διαρκέσει χίλια χρόνια!"
                },
                BATTLE: {
                    EPIC_WARFARE: "Επικών διαστάσεων μάχες",
                    JOURNEY_OF_A_LEGEND: "Η πορεία ενός θρύλου",
                    JOURNEY_OF_A_LEGEND_DESC: "Με τη συμμετοχή χιλιάδων παικτών στους server, τα γεγονότα που διαδραματίζονται είναι πραγματικά επικών διαστάσεων. Μεγάλες συνομοσπονδίες συμμάχων αναρριχώνται στο βάθρο του παγκόσμιου επικυρίαρχου κι άλλες υφίστανται συντριπτική ήττα, αφήνοντας πίσω τους μόνο αποκαΐδια. Οι σφοδροί ανταγωνισμοί μεταξύ των Συμμαχιών διαρκούν για μήνες, ενώ δραματικές αναμετρήσεις και προδοσίες αλλάζουν διαρκώς τη ροή της ιστορίας. Κάθε νέος γύρος είναι γεμάτος εκπλήξεις. Την ίδια στιγμή, η μεγάλη διάρκειά του σας δίνει την ευκαιρία να εκπονήσετε μια στρατηγική εις βάθος. Αποδείξτε την αξία σας απέναντι στους καλύτερους αντιπάλους και κερδίστε τη θέση σας στο θρόνο.",
                    BOLD_BEGINNINGS: "Τολμηρό ξεκίνημα",
                    BOLD_BEGINNINGS_DESC: "Οικοδομήστε το πρώτο σας χωριό. Κάντε επιδρομές εναντίον των γειτόνων σας και χρησιμοποιήστε τους πόρους τους για να αναπτύξετε μια ακμάζουσα πόλη κι έναν απειλητικό στρατό. Δεν χρειάζεται να είστε ταπεινοί.",
                    STAY_IN_CONTROL: "Διατηρήστε τον έλεγχο",
                    STAY_IN_CONTROL_DESC: "Κρατήστε τους φίλους σας κοντά σας και τους εχθρούς σας στο χώμα. Ανά τακτά χρονικά διαστήματα να περιτρέχετε τις γειτονικές σας περιοχές για να αποτρέπετε τυχόν απειλές. Συνάψτε συμμαχίες με άτομα της εμπιστοσύνης σας.",
                    GROW_YOUR_BICEPS: "Γυμνάστε τους δικεφάλους σας",
                    GROW_YOUR_BICEPS_DESC: "Επεκτείνετε την περιοχή σας και αναδειχθείτε σε τοπική υπερδύναμη. Καταβάλετε κάθε δυνατή προσπάθεια για να φτιάξετε έναν πανίσχυρο στρατό που είναι ικανός να φέρει στην κατοχή σας ένα πολύτιμο αντικείμενο."
                },
                LATE_GAME: {
                    FINAL_GLORY: "Τελική δόξα",
                    THE_WONDER_OF_THE_WORLD: "Το Θαύμα του Κόσμου",
                    THE_WONDER_OF_THE_WORLD_DESC: "Όλα όσα έχετε κάνει καταλήγουν σε αυτόν το σκοπό. Ένα ανθρωποποίητο βουνό από λευκό και χρυσό, με μια σειρά κήπων και ποταμών που αντικατοπτρίζουν το φως του ήλιου με θεϊκό, σχεδόν, τρόπο. Το κορυφαίο σας επίτευγμα. Οικοδομώντας ένα Θαύμα του Κόσμου, θα αφήσετε το δικό σας στίγμα στα βιβλία της Ιστορίας του Travian. Όλος ο κόσμος του παιχνιδιού αναλώνεται στον αγώνα για μια θέση στην κορυφή των επιτευγμάτων του ανθρώπου, αλλά μόνο μία συμμαχία θα τα καταφέρει.",
                    THE_GRAND_FINALE: "Το μεγάλο φινάλε",
                    THE_GRAND_FINALE_DESC: "Καλωσορίσατε την υπέρτατη πρόκληση. Για να τα καταφέρετε, απαιτούνται στρατοί αλλά και πόροι σε κλίμακα που δεν έχει προηγούμενο. Η συμμαχία σας θα πρέπει να δώσει τα πάντα σε αυτήν την αναμέτρηση, καθώς συντονίζει την οικοδόμηση του Θαύματος του Κόσμου και αμύνεται κατά των συνδυασμένων δυνάμεων του υπόλοιπου server, κι όλα αυτά χωρίς να παραμελεί τα δικά της αμυντικά έργα. Επίσης, πρέπει να καταστρέψετε τους αντιπάλους σας, για να διασφαλίσετε ότι δεν θα σας νικήσουν εκείνοι. Ο αγώνας ξεκίνησε.",
                    THE_RACE_IS_ON: "Ο αγώνας ξεκίνησε.",
                    "REACH_THE_PINNACLE_OF_HUMAN_ACHIEVEMENT!": "Κατακτήστε την κορυφή των ανθρώπινων επιτευγμάτων!",
                    ANCIENT_RELICS: "Αρχαία πολύτιμα αντικείμενα",
                    ANCIENT_RELICS_DESC: "Στα ταξίδια σας θα συναντήσετε οχυρά ενός παλιού πολιτισμού, των Natar. Σήμερα, δεν είναι παρά η σκιά του παρελθόντος τους, ωστόσο το ταλέντο τους στην κατεργαριά παραμένει χωρίς αντίπαλο. Σιγά-σιγά, άλλες φυλές άρχισαν να τους ξεπερνούν σε μέγεθος και οι Natar άρχισαν να κρύβονται, υπερασπιζόμενοι τα πολύτιμα αντικείμενά τους με ό,τι τους απέμεινε. Εάν καταφέρετε να πάρετε ένα τέτοιο πολύτιμο αντικείμενο στην κατοχή σας, θα έχετε αδιανόητη ισχύ στη διάθεσή σας. Αλλά να είστε προσεκτικοί: όλος ο κόσμος τα εποφθαλμιά Και θα βρεθείτε στο μάτι του κυκλώνα.",
                    STRANGE_POWERS: "Παράξενες δυνάμεις",
                    STRANGE_POWERS_DESC: "Αυτά τα απομεινάρια αρχαίας γνώσης έχουν δυνάμεις που ο μέσος άνθρωπος δυσκολεύεται να πιστέψει. Τοποθετήστε κάποιο στο χωριό σας και παρακολουθήστε τα κτίριά σας να γίνονται πιο ανθεκτικά και τα τείχη σας αδιαπέραστα. Κάποια άλλα, ενισχύουν το πολεμικό σας σθένος και επιτρέπουν στα στρατεύματά σας να ολοκληρώνουν την εκπαίδευσή τους πολύ πιο γρήγορα. Τα πιο μοναδικά πολύτιμα αντικείμενα διαθέτουν τόση ισχύ που επηρεάζουν όλη σας την αυτοκρατορία: από την πιο νότια εσχατιά της ως τα βόρεια σύνορά σας.",
                    DARING_ADVENTURES: "Παράτολμες περιπέτειες",
                    DARING_ADVENTURES_DESC: "Είστε ο ήρωας του χωριού σας. Θα υπάρξουν περιστάσεις τόσο επικίνδυνες, που μόνο οι γενναιότεροι των γενναίων θα μπορούσαν να τις αντιμετωπίσουν. Ψίθυροι για θανατηφόρα θεριά, φήμες για στοιχειωμένους θησαυρούς και κραυγές για βοήθεια που είναι σίγουρα τέχνασμα. Σας καλούν. Ξεκινήστε για περιπέτειες και με λίγη τύχη θα βρείτε ένα σωρό πόρους, θησαυρούς και πανίσχυρα όπλα.",
                    ANNUAL_SPECIALS: "Ετήσιες ειδικές εκδόσεις",
                    ANNUAL_SPECIALS_DESC: "Μπορείτε πάντα να περιμένετε νέες, συναρπαστικές δυνατότητες στην ετήσια ειδική έκδοση του Travian: Legends. Στην πιο πρόσφατη, διάφορες συμμαχίες μάχονται για την κυριαρχία σε αρχαίες περιοχές της Ευρώπης. Η συνεργασία και το ομαδικό πνεύμα είναι πιο σημαντικά από ποτέ, επειδή μόνον η συμμαχία πλειοψηφεί μπορεί να διεκδικήσει το ρόλο περιφερειακής δύναμης. Επίσης, οι παίκτες μπορούν να συγχρηματοδοτήσουν αναπτυξιακά έργα σε τομείς όπως η μεταλλουργία ή το εμπόριο, από τα οποία επωφελούνται όλα τα μέλη της συμμαχίας.",
                    LIVE_DATA: "Ζωντανά δεδομένα",
                    MYSTERIOUS_POWERS_ARE_WAITING_TO_BE_DISCOVERED: "Μυστήριες δυνάμεις περιμένουν να τις ανακαλύψετε…"
                }
            },
            BREADCRUMB: { Home: "Αρχική σελίδα" },
            CHANGE_LANG: {
                SELECT_A_LANG: "Επιλέξτε γλώσσα",
                SEACH_FOR_YOUR_LANGUAGE_OR_COUNTRY: "Αναζητήστε τη γλώσσα ή τη χώρα σας"
            },
            COOKIES_ACCEPT: {
                THIS_WEBSITE_USES_COOKIES_DESC: "Αυτός ο ιστότοπος χρησιμοποιεί cookies, προκειμένου οι επισκέπτες να απολαμβάνουν την καλύτερη δυνατή εμπειρία χρήσης.",
                OK: "OK"
            },
            LOGIN: {
                LOGIN: "ΣΥΝΔΕΣΗ",
                YOU_HAVE_PLAYED_ON: "Έχετε παίξει στον ",
                I_FORGOT_MY_GAMEWORLD: "Ξέχασα τον κόσμο παιχνιδιού μου",
                CHANGE_GAME_WORLD: "Αλλαγή κόσμου παιχνιδιού",
                LOGIN_AND_PLAY: "Συνδέσου για να παίξεις",
                I_FORGOT_MY_PASSWORD: "Ξέχασα τον κωδικό μου",
                LOW_RES_MODE: "Προβολή χαμηλής ανάλυσης",
                LOW_RES_MODE_DESC: "(για αργή ταχύτητα σύνδεσης και κινητές συσκευές)",
                USERNAME_OR_EMAIL: "Όνομα χρήστη ή email",
                PASSWORD: "Κωδικός",
                CHOOSE_GAME_WORLD: "Επέλεξε κόσμο παιχνιδιού",
                LOGIN_TO_PLAY: "Συνδέσου για να παίξεις",
                OTHER_GAME_WORLDS: "'Αλοι κόσμη παιχνιδιού",
                THERE_ARE_NO_GAME_WORLDS_FOR_LOGIN: "Δεν υπάρχουν διαθέσιμοι κόσμη παιχνιδιού"
            },
            ERRORS: {
                usernameTooShort: "Το όνομα λογαριασμού είναι πολύ μικρό; πρέπει να αποτελείται από τουλάχιστον {{min}} χαρακτήρες",
                usernameTooLong: "Το όνομα λογαριασμού είναι πολύ μεγάλο; πρέπει να αποτελείται το πολύ από {{max}} χαρακτήρες",
                userDoesNotExists: "Ο χρήστης αυτός δεν υπάρχει",
                accountIsInactive: "Ο λογαριασμός δεν είναι ενεργοποιημένος",
                passwordTooShort: "Ο κωδικός σας είναι πολύ μικρός; πρέπει να αποτελείται από τουλάχιστον {{min}} χαρακτήρες",
                passwordWrong: "Λάθος κωδικός",
                valueRequired: "Η τιμή απαιτείται",
                reCaptchaRequired: "Captcha απαιτείται",
                invalidCaptcha: "Μη έγκυρο captcha",
                activationNotFound: "Η διαδικασία ενεργοποίησης δεν βρέθηκε.",
                emailUnknown: "Αυτή η διεύθυνση ηλεκτρονικού ταχυδρομείου είναι άγνωστη σε εμάς",
                emailInvalid: "Η διεύθυνση ηλεκτρονικού ταχυδρομείου που υποδεικνύεται δεν είναι έγκυρη",
                unknownGameWorld: "Άγνωστος κόσμος παιχνιδιού!",
                emailTooShort: "Το email είναι πολύ μικρό; πρέπει να αποτελείται από τουλάχιστον {{min}} χαρακτήρες",
                passwordWasNotUpdated: "Ο κωδικός πρόσβασης ΔΕΝ ενημερώθηκε",
                noRecoveryCodeIncluded: "noRecoveryCode",
                noUidIncluded: "noUid",
                passwordInsecure: "Μη ασφαλής κωδικός πρόσβασης, πληκτρολογήστε διαφορετικό",
                gameworldNotYetStarted: "Ο κόσμος του παιχνιδιού δεν έχει ξεκινήσει ακόμη.",
                noAccountsAssociatedWithEmailAddress: "Δυστυχώς, δεν βρήκαμε έναν λογαριασμό που συσχετίζεται με τη δεδομένη διεύθυνση ηλεκτρονικού ταχυδρομείου.",
                usernameBlacklisted: "Αυτό το όνομα δεν είναι διαθέσιμο.",
                passwordLikeName: "Ο κωδικός πρόσβασης ταιριάζει με το όνομα.",
                invalidChars: "Αυτό το όνομα περιέχει μη έγκυρους χαρακτήρες",
                codeDoesNotExist: "Αυτός ο κωδικός ενεργοποίησης δεν υπάρχει",
                registrationCodeInvalid: "Μη έγκυρο κλειδί",
                nameAlreadyExists: "Αυτό το όνομα υπάρχει ήδη",
                emailAlreadyRegistered: "Η διεύθυνση ηλεκτρονικού ταχυδρομείου είναι ήδη καταχωρημένη",
                registrationClosed: "Η εγγραφή δεν είναι διαθέσιμη σε αυτόν τον κόσμο παιχνιδιών",
                activationCodeTooShort: "Ο κωδικός ενεργοποίησης είναι πολύ μικρός; πρέπει να είναι τουλάχιστον {{min}} χαρακτήρες",
                ItsNecessaryToReadAndAcceptGTC: "Πρέπει να διαβάσετε και να αποδεχθείτε τους γενικούς Όρους και Προϋποθέσεις",
                weVeAlreadySentAFewEmailWithinShortTime: "Έχουμε ήδη στείλει μερικά μηνύματα ηλεκτρονικού ταχυδρομείου σε αυτή τη διεύθυνση μέσα σε λίγα λεπτά. Παρακαλώ δοκιμάστε ξανά αργότερα."
            },
            FORGOT_PASSWORD: {
                ForgotPassword: "Ξεχάσατε τον κωδικό",
                WeWillSendAnEmail: "Θα σας στείλουμε έναν νέο κωδικό πρόσβασης. Θα ενεργοποιηθεί μόλις επιβεβαιώσετε την παραλαβή.",
                Email: "Email",
                RecoverPassword: "Ανάκτηση κωδικού πρόσβασης",
                RequestReceived: "Η αίτημα ελήφθη.",
                emailWillBeSend: "Θα σταλεί ένα μήνυμα ηλεκτρονικού ταχυδρομείου με περισσότερες οδηγίες. Αυτό μπορεί να διαρκέσει μερικά λεπτά.",
                enterNewPassword: "Εισάγετε νέο κωδικό.",
                setNewPassword: "Ορίστε νέο κωδικό πρόσβασης",
                password: "Κωδικός",
                passwordHasBeenChanged: "Ο κωδικός πρόσβασης έχει αλλάξει."
            },
            FORGOT_GAME_WORLD: {
                ForgotGameWorld: "Ξέχασα τον κόσμο παιχνιδιού",
                enterYourEmailAddressAndWeAllSend: "Εισάγετε τη διεύθυνση ηλεκτρονικού ταχυδρομείου σας και θα σας στείλουμε όλους τους σχετικούς κόσμους παιχνιδιών.",
                requestGameWorlds: "Ζητήστε κόσμους παιχνιδιών",
                WeHaveSentAListOfAssociatedAccountsToEnteredEmailAddress: "Έχουμε στείλει μια λίστα όλων των λογαριασμών που σχετίζονται με τη διεύθυνση ηλεκτρονικού ταχυδρομείου που έχετε εισάγει.",
                Email: "Email"
            },
            ACTIVATION: {
                activateAccount: "Ενεργοποίηση λογαριασμού",
                activateAnaPlay: "Ενεργοποιήστε και παίξτε",
                ActivationCode: "Κωδικός ενεργοποίησης",
                IDidNotReceiveAnEmail: "Δεν έλαβα μήνυμα ηλεκτρονικού ταχυδρομείου",
                UnknownOrInvalidGameWorld: "Άγνωστος ή άκυρος κόσμος παιχνιδιού",
                weHaveSentAnEmailContainingActivationCode: "Έχουμε στείλει ένα μήνυμα ηλεκτρονικού ταχυδρομείου που περιέχει έναν σύνδεσμο ενεργοποίησης στη διεύθυνση ηλεκτρονικού ταχυδρομείου που έχετε εισάγει. Χρησιμοποιήστε αυτό για να ενεργοποιήσετε το λογαριασμό σας στον κόσμο παιχνιδιού {{gameWorld}} και ορίστε κωδικό πρόσβασής.",
                couldNotProcessActivationCode: "Δεν ήταν δυνατή η επεξεργασία του κωδικού ενεργοποίησης",
                WeveRecievedYourActivationKey: "Λάβαμε το κλειδί ενεργοποίησης μέσω του συνδέσμου στον οποίο κάνατε κλικ στο μήνυμα ηλεκτρονικού ταχυδρομείου. Τώρα μπορείτε να ενεργοποιήσετε το λογαριασμό σας στον κόσμο του παιχνιδιού {{gameWorld}}. Ορίστε τον κωδικό πρόσβασής σας."
            },
            NO_MAIL: {
                activationMail: "E-mail ενεργοποίησης",
                UnknownOrInvalidGameWorld: "Άγνωστος ή άκυρος κόσμος παιχνιδιού",
                ResendEmail: "Ξαναστείλτε email",
                email: "Email",
                ReEnterYourMail: "Καταχωρίστε ξανά τη διεύθυνση ηλεκτρονικού ταχυδρομείου σας και θα στείλουμε ξανά το μήνυμα ηλεκτρονικού ταχυδρομείου ενεργοποίησης.",
                weHaveSentAnEmail: "Έχουμε ξανά στείλει ένα μήνυμα ηλεκτρονικού ταχυδρομείου που περιέχει έναν σύνδεσμο ενεργοποίησης στη διεύθυνση ηλεκτρονικού ταχυδρομείου που έχετε εισάγει. Χρησιμοποιήστε το για να ενεργοποιήσετε το λογαριασμό σας και να ορίσετε έναν κωδικό πρόσβασης."
            },
            REGISTER: {
                THERE_ARE_NO_GAME_WORLDS_FOR_REGISTRATION: "Δεν υπάρχουν διαθέσιμοι κόσμοι παιχνιδιών για εγγραφή",
                registerToPlay: "Εγγραφείτε για να παίξετε",
                selectGameWorld: "Επιλέξτε κόσμο παιχνιδιού",
                changeGameWorld: "Αλλαγή κόσμου παιχνιδιού",
                registerNow: "Κάνε εγγραφή τώρα",
                IAlreadyHaveAnAccount: "Έχω ήδη ένα λογαριασμό",
                recommendedGameWorld: "Προτεινόμενος κόσμος παιχνιδιών",
                otherGameWorlds: "Άλλοι κόσμη παιχνιδιού",
                Username: "Όνομα χρήστη",
                Password: "Κωδικός",
                Email: "Email",
                PlayerInvitedYou: "Ο παίκτης{{player}} σας προσκάλεσε να παίξετε σε αυτόν τον κόσμο παιχνιδιού. Κάντε κλικ σε αυτό ξανά για να το αλλάξετε ούτως ή άλλως.",
                PlayerInvitedYouToTravian: "Ο παίκτης {{player}} σας προσκάλεσε να παίξετε Travian: Legends",
                RegistrationKey: "Κλειδί εγγραφής",
                IAgreeToTermsAndConditionsAndPrivacyPolicy: 'Συμφωνώ <a target="_blank" class="inline" title="Terms &amp; Conditions" href="https://www.travian.com/international/terms">όροι και προϋποθέσεις</a>  and <a href="//agb.traviangames.com/privacy-en.pdf" target="_blank" class="inline" title="Privacy Policy">Privacy Policy</a>',
                "Subscribe to newsletter": "Εγγραφείτε στο ενημερωτικό δελτίο",
                alreadyRegistered: "'Εχετε ήδη καταχωρηθεί? Συνεχίστε τη διαδικασία ενεργοποίησης εδώ."
            },
            SERVER_AGE: "Διάρκεια κόσμου",
            "Loading...": "Φόρτωση...",
            NO_MORE_SERVERS: "Δεν υπάρχουν διαθέσιμοι κόσμη παιχνιδιού.",
            SERVER_START_TIME: {
                INSTANT_FINISH_TRAINING: "Άμεσο τελείωμα εκπαίδευσης",
                SERVER_WILL_START_AT: "Ο κόσμος παιχνιδιού θα αρχήσει στις {{date}} {{time}}",
                SERVER_WAS_STARTED_X_UNIT_AGO: "{{value}} {{unit}}",
                UNIT_SECONDS: "δευτερόλεπτα",
                UNIT_HOURS: "ώρες",
                UNIT_DAYS: "μέρες",
                UNIT_MINUTES: "λεπτά",
                GAME_WORLD_FINISHED: "Ο κόσμος παιχνιδιού έχει τελειώσει"
            }
        }
    },
    "./src/frontend/locale/en-US.json": function(e, t) {
        e.exports = {
            TITLE: "TRAVIAN - the online multiplayer strategy game",
            DESCRIPTION: "Travian is one of the best multi-player strategy games for your browser!",
            KEYWORDS: "Travian,Onlime game,strategy game,multiplayer game,Romans,Teutens,Guals,Citvian,Travian speed,SpeedTra, SpeedTravian, Travian games, MultiSpeed",
            JOURNEY: {
                PLAY_NOW: {
                    JOIN_THE_FAMOUS: "Join the famous",
                    EXPERT_STRATEGY_GAME: "EXPERT STRATEGY GAME",
                    TRUE_MMO_WITH_THOUSAND_OF_REAL_PLAYERS: "The true MMO pioneer with thousands of real players!",
                    PLAY_NOW: "PLAY NOW"
                },
                PLAYER: {
                    INTERACTION: {
                        PLAY_WITH_THOUSANDS_OF_OTHERS: "Play with thousands of others",
                        A_TRUE_MMO_EXPERIENCE: "A true MMO experience",
                        A_TRUE_MMO_EXPERIENCE_DESC: "Enter a story entirely told by a complex web of player actions. Travel a world so vast that it takes days for the fastest rider to cross it. Ferocious Teutons, tough Romans and crafty Gauls will be on your side - or in your way. Trade systems fully run by players enable the right person to make a fortune. Try owning every unique artifact - or build the fastest Wonder of the World in history. In Travian: Legends you can be whoever you want."
                    },
                    PLAY_STYLE: {
                        CHOOSE_YOUR_LEGEND: "Choose your legend",
                        LEGENDS: {
                            DEFENDER: {
                                TITLE: "Harder than Steel",
                                DESC: "Wars aren't won in a day. Let all the fools run around bashing each other while you establish a thriving economy. You will be standing on top of fortified walls, mocking countless armies losing their spirit. Outsmart your opponents on every move they make. Lay traps for their troops and hold the prisoners ransom. Cooperate with your neighbors, form the backbone of your alliance and become a true protector of the people."
                            },
                            ATTACKER: {
                                TITLE: "The Hammer",
                                DESC: "Feel the sound of drums as you run towards the gates of your enemies. Laugh at their terrified faces and their tiny defenses. The horns get blown – a wasted effort. You will be gone with the goods before their friends mount their horses. But raids aren't enough. Your army will grow, and so will your hunger for more. You are free. Free to conquer every corner of this world until all kneel in your presence."
                            },
                            LEADER: {
                                TITLE: "Lead with Greatness",
                                DESC: "Alexander. Caesar. You. Some leaders shape entire eras of history. Rise up to turn your alliance from a horde of warriors into an uncontested force. A true leader doesn't sit in his castle waiting for the right moment. Use your charisma and diplomatic guile to sustain power, manipulate your rivals and hold your empire together forever. Don't just be part of the story. Tell it. This era is yours."
                            }
                        }
                    }
                },
                BUILD_EXPIRE: {
                    STRATEGY_TO_PARADISE: "Strategy Expert Paradise",
                    THE_ROAD_TO_DOMINATION: "The road to dominion",
                    THE_ROAD_TO_DOMINATION_DESC: "The greatest ascents all began the same way: by laying the first stone. From there it's entirely in your hands. Expand your reach until that first settlement in the shade of a tree becomes an empire on which the sun never sets. Explore the world and find oases of wealth. And, ultimately, eliminate all those trying to get in your way. The fruits of your labor will show with each building, each soldier and each advance that makes your civilization flourish."
                },
                BATTLE: {
                    TITLE: "Epic MMO Warfare",
                    BOX_TITLE: "Prove yourself",
                    BOX_CONTENT: "Flaming debris soaring through the sky, shattering buildings and hopes of defense. The ground shakes from the incoming army as the sky turns dark from smoke. Welcome to the playground for grown-ups. Prove what you are made of against thousands of other players and earn your place in the world of Travian. Excel with the smartest strategy or just raid them on the hour, every hour. History isn't made in old town halls, it's decided on the battlefield. Are you a coward - or a conqueror?"
                },
                LATE_GAME: {
                    TITLE: "Monuments of Eternity",
                    BOX_TITLE: "The Wonder of the World",
                    BOX_CONTENT: "You haven't experienced true power until you build something so monumental, the whole world pauses to pay it tribute. Erect a Wonder of the World together with your alliance and the server is yours. The largest wars will be fought, the strongest confederacies will struggle and in the end it might be down to one single deciding move. In this moment of truth, friends become bitter enemies and old rivals form desperate alliances. It's time for heroes to become legends. Are you ready?",
                    UNIQUE_POWERS: "Unique Powers"
                }
            },
            NAVIGATION: {
                Game: "Game",
                "Play-style": "Play-style",
                "Player interaction": "Player interaction",
                "Build empire": "Build empire",
                Battle: "Battle",
                "Late game": "Late game",
                Language: "Language",
                "Log in and play": "Log in and play",
                "Play now": "Play now",
                "Back to categories": "Back to categories",
                Register: "Register",
                Login: "Login",
                Close: "Close"
            },
            FOOTER: {
                JOIN: "Join an epic battle with thousands of real players!",
                PLAY_NOW: "Play now",
                COPY_RIGHT: "Travian Games GmbH. All rights reserved."
            },
            NEWS: { READ_MORE: "Read more..." },
            GAME: {
                PLAYSTYLE: {
                    CHOOSE_YOUR_LEGEND: "Choose your legend",
                    TOP5_ATTACKERS: "Top 5 attackers",
                    TOP5_DEFENDERS: "Top 5 defenders",
                    ALLIANCES: "Alliances",
                    THE_HAMMER: "The Hammer",
                    THE_HAMMER_DESC: "You are always leading the charge. You are the tip of the spear or the ram that knocks down the first wall. Battles carry your name and enemies shiver at its mention. Soon will you command large armies and relentlessly pillage your way across the lands. But make no mistake - this path is not an easy one. If you can’t handle competition, this one's not for you. But if you'd risk life and limb for boundless rewards and glory - join us. Be the hammer.",
                    RAISE_AN_ARMY: "Raise an army",
                    RAISE_AN_ARMY_DESC: "Do you want to lead a horde as wide as the horizon, causing enemies to flee at the sheer sight of it? Or do you prefer a squad of military experts, beating a dozen men each without breaking a sweat. How you dominate is up to you. And don't worry about defenses. Nobody wants to give your army a reason to visit.",
                    RAID_CONQUER_AND_CAUSE_SOME_MAYHEM: "Raid, conquer and cause some mayhem",
                    RAID_CONQUER_AND_CAUSE_SOME_MAYHEM_DESC: "Your favorite strategy begins with a rampage. Why waste time harvesting resources, when you can knock down your neighbor's door and ask politely. Demolish common enemies and strangers will become friends. And friends happily donate resources to keep peace. Soon, word will spread of the warrior who seizes what he wants and your demands will be met with respect.",
                    YOU_ARE_THE_CHAMPION: "You are the champion",
                    YOU_ARE_THE_CHAMPION_DESC: "Do you conquer their villages or burn them to the ground? Which building should meet your catapults first? Some decisions are harder than others, but you don't have to make them by yourself. Find some allies, multiply your power and attack from all angles. Don’t choose how to fight – choose how to win.",
                    A_REAL_WARRIOR_EARNS_ALL_HE_CAN_TAKE: "A real warrior earns all he can take.",
                    HARDER_THAN_STEEL: "Harder than Steel",
                    HARDER_THAN_STEEL_DESC: "Stand your ground. Outlast attack after attack until they grow tired and desperate. Don't waste your time with petty fights. You are in this for the long run. Soon, the size of your walls will crush any hopes of conquest and your foe's puny villages will live in the shadow of your fortress. Your strategic finesse won't go unnoticed. Group together, form a regional superpower and end this war on your terms.",
                    THINK_LONG_TERM: "Think Long Term",
                    THINK_LONG_TERM_DESC: "Time is your greatest ally. With each worn down opponent, your position in the region strengthens. Refine your drills and forge stronger weaponry until your army outclasses everyone in battle. Expand with new settlements, push the construction of specialized buildings and invest into a cultured and healthy society. With a strong foundation, you will outlast your opponents until it’s time for your [greatest achievement](link to WW page).",
                    PROTECTOR_OF_THE_PEOPLE: "Protector of the People",
                    PROTECTOR_OF_THE_PEOPLE_DESC: "Your army won't have to catch flies in your village. Weaken your opponents by sending secret support to your neighbors. Nothing is more satisfying than an unprepared army crashing into your stronghold. Helping friends brings many benefits. On top of resources and open favors, a strong defensive bond will make sure you never are in trouble. With your prowess and protection comes diplomatic power.",
                    BE_A_TEAM_PLAYER: "Be a Team Player",
                    BE_A_TEAM_PLAYER_DESC: "Alliance decisions will be in your favor when they depend on your defenses. Ensure support to other allies and become the glue that holds confederacies together. While others fight over powerful artifacts, yours are safely protected. And when your alliance erects a Wonder of the World, you will be its guardian. With the combined forces of your whole alliance in your fortress, victory will be yours.",
                    THE_TRUE_VICTOR_STILL_STANDS_AT_THE_END: "The true victor still stands at the end.",
                    LEAD_WITH_GREATNESS: "Lead with Greatness",
                    LEAD_WITH_GREATNESS_DESC: "Without leaders, there are no empires. Become the center of your alliance and lead it to glory of an unprecedented scale. With your diplomatic expertise, you find the solutions that nobody else can. Arrange treaties that make your domain untouchable. Devise cunning strategies, play enemies off against each other and pull every string until the whole realm follows your will. Conduct the symphony of war to your liking.",
                    SILVER_TONGUED_AGENT: "Silver-Tongued Agent",
                    SILVER_TONGUED_AGENT_DESC: "Communication is your most powerful tool. Keep spirits in your alliance high and solve problems before they arise. Confederacies will depend on your diplomatic finesse to ease tensions and craft plans that appease all parties. Sternly negotiate with your enemies and make it clear that your alliance doesn't back down. A threat now and then hasn't hurt anybody. At least not on your end.",
                    WISE_MENTOR: "Wise Mentor",
                    WISE_MENTOR_DESC: "A strong leader inspires greatness in others. Scout for new members and conceive individual strategies for them to become powerful assets. Support talented advisers and turn them into capable leaders. You will fight side by side with trusted companions and form friendships outlasting a single game world. You are the gear that turns a group of strangers into a perfect clockwork.",
                    CUNNING_STRATEGIST: "Cunning Strategist",
                    CUNNING_STRATEGIST_DESC: "Your fellow alliance members rely on you in times of need. Coordinate defenses swiftly and don’t give your enemies a single opening. Act wisely and win battles without losing a single soldier. You will orchestrate invasions of such epic scale, they'll become myths known to all. When it's time, craft a strategy that unfolds over months and enjoy its perfect execution.",
                    STEER_THE_COURSE_OF_THIS_WORLD_INTO_YOUR_CONTROL: "Steer the course of this world into your control."
                },
                INTERACTION: {
                    FRIENDS_AND_FOES: "Friends and Foes",
                    A_TRUE_MMO_EXPERIENCE: "A True MMO Experience",
                    A_TRUE_MMO_EXPERIENCE_DESC: "You’re far from alone in Travian: Legends. The world is alive and ever-changing, thanks to a massive community interacting in alliances, trade and good old war. Each game round tells a different story. Collective conquests in the middle of the night, intrigues in every direction and friendships of steel.&nbsp; Every move has an impact, every decision has a consequence. Settle closer to your friends – or go right towards the action.",
                    LIVE_DATA: "Live data",
                    LONG_LASTING_ALLIANCES: "Long-Lasting Alliances",
                    LONG_LASTING_ALLIANCES_DESC: "Travian provides plenty of opportunities for teamwork. Contact your neighbors, team up against common threats and end up making new friends. Learn from experienced mentors that guide you through the worlds until you become one yourself. Some alliances come together every server and have friendships extending beyond the game. Supporting each other and returning united from every setback creates bonds with amazing memories.",
                    TOURNAMENTS_AND_SPECIALS: "Tournaments and Specials",
                    TOURNAMENTS_AND_SPECIALS_DESC: "It's hard to get bored in Travian: Legends. Every year a special version comes out that takes a fresh spin on the Travian classic. The epic journey currently continues through Europe, with Gauls, Romans and Teutons battling to control its regions. Yearly tournaments give you the chance to prove yourself against the best players in the world. You can obtain plenty of prizes and everlasting fame.",
                    FORUM_AND_EVENTS: "Forum and Events",
                    FORUM_AND_EVENTS_DESC: "Join a community of lots of enthusiastic, like-minded people. The forum is a great place for getting advice, discussing strategies, finding allies for the next game or just a bit of banter. Look out for events hosted by Travian Games. Events, like the 10th birthday party, where players and developers met up in real life, exchanged stories and laughs, and played games until late into the night.",
                    A_GAME_DRIVEN_BY_ITS_COMMUNITY: "A game driven by its community."
                },
                BUILD_EMPIRE: {
                    YOUR_EMPIRE: "Your Empire",
                    THE_ROAD_TO_DOMINION: "The road to dominion",
                    THE_ROAD_TO_DOMINION_DESC: "This isn't an average man's deed. You will need a vision so brilliant that it inspires a whole population. Build a city that your people truly worship; a city they will defend with conviction. Do you found a trade empire or raise a self-sufficient domain? Will you deal with threats mercifully – or double the stakes? Conduct your vision with fervor and defend it against all odds. No one will be able to stop you.",
                    LIVE_DATA: "Live data",
                    CRAFT_A_SCHEME: "Craft a scheme",
                    CRAFT_A_SCHEME_DESC: "Be smart about your options. It takes an expert to know when to expand your domain and when it's better to strengthen your infrastructure. An army without supplies quickly loses momentum. Will you guard your outposts and leave your center open or do you let chance decide their fate? The better your plan, the more powerful you will become.",
                    HONE_YOUR_SKILLS: "Hone your skills",
                    HONE_YOUR_SKILLS_DESC: "There are plenty of ways to specialize. Adapt to the circumstances by turning your villages into strongholds, cultural centers, military camps or resource havens. Analyze your opponents and produce the perfect military strategy to trump theirs. Train your hero to help where they are needed most, be it supplies for your village, or raw power on the battlefield. Hidden strategies are everywhere, waiting to be uncovered.",
                    EXPLORE_EXPAND_AND_EXTERMINATE: "Explore, Expand and Exterminate",
                    EXPLORE_EXPAND_AND_EXTERMINATE_DESC: "The Travian world offers innumerable areas to explore. Discover resource oases, proclaim them and double your productions. If you're still hungry, you can coerce your neighbors to support your domain - or let them be swallowed by it. When you stumble across an old, heavily guarded artifact, be advised. Legends say that whoever steals one and solves how to use it will yield incredible power.",
                    "CREATE_A_DYNASTY_OF_A_THOUSAND_YEARS!": "Create a dynasty of a thousand years!"
                },
                BATTLE: {
                    EPIC_WARFARE: "Epic Warfare",
                    JOURNEY_OF_A_LEGEND: "Journey of a Legend",
                    JOURNEY_OF_A_LEGEND_DESC: "With thousands of players on the server, events are truly epic. Grand confederacies rise to world domination and turn into nothing but ashes. Alliance feuds play out over months, while dramatic showdowns and betrayals constantly change the course of history. Each new round is loaded with surprises. At the same time, its longevity gives you the chance to craft a profound strategy. Prove yourself against the finest adversaries and earn your place on the throne.",
                    BOLD_BEGINNINGS: "Bold Beginnings",
                    BOLD_BEGINNINGS_DESC: "Raise your first village. Raid your neighbors and use their resources to develop a flourishing city and a menacing army. No need to be humble.",
                    STAY_IN_CONTROL: "Stay in Control",
                    STAY_IN_CONTROL_DESC: "Keep your friends close and your enemies down. Regularly run down your surroundings to scotch any threats. Found an alliance with people worthy of your trust.",
                    GROW_YOUR_BICEPS: "Grow your Biceps",
                    GROW_YOUR_BICEPS_DESC: "Expand your territory and build a regional powerhouse. Throw on all engines to produce a mighty army capable of conquering an artifact."
                },
                LATE_GAME: {
                    FINAL_GLORY: "Final Glory",
                    THE_WONDER_OF_THE_WORLD: "The Wonder of the World",
                    THE_WONDER_OF_THE_WORLD_DESC: "Everything you have done boils down to this task. A man-made mountain of white and gold, with descending series of gardens and rivers, reflecting the sunlight in almost divine ways. Your greatest achievement. By building a Wonder of the World, you will leave your mark in the history books of Travian. The whole game world races to reach this peak of human accomplishment, but only one alliance will be successful.",
                    THE_GRAND_FINALE: "The Grand Finale",
                    THE_GRAND_FINALE_DESC: "Welcome to the ultimate challenge. To pull this off, you need armies and resources of previously unknown proportions. Your alliance will have to give its performance of a lifetime when it coordinates the building of the Wonder of the World and defends it against the combined forces of the rest of the server – all without neglecting its own defenses. Also, you have to destroy your opponents to make sure they don’t beat you to the show.",
                    THE_RACE_IS_ON: "The race is on.",
                    "REACH_THE_PINNACLE_OF_HUMAN_ACHIEVEMENT!": "Reach the pinnacle of human achievement!",
                    ANCIENT_RELICS: "Ancient Relics",
                    ANCIENT_RELICS_DESC: "On your travels you will come across forts of an old civilization, the Natars. Nowadays, they are just a shadow of their former dominion, yet their prowess in artifice is still unchallenged. Slowly, other tribes have begun surpassing them in size and the Natars went into hiding, defending their artifacts with all they have left. If you come to own such a relic, you will have unspeakable strength at your hands. But be wary – the whole world is eyeing them. And you will be at the center of their gaze.",
                    STRANGE_POWERS: "Strange Powers",
                    STRANGE_POWERS_DESC: "These relics of ancient knowledge have powers too hard to believe for the common man. Place a certain one in your village and watch your buildings harden and your walls become impenetrable. Others enhance your military vigor and enable your troops to finish their training much faster. The most unique artifacts are of such power they affect your whole empire - from its southernmost state to its northern borders.",
                    DARING_ADVENTURES: "Daring Adventures",
                    DARING_ADVENTURES_DESC: "You are the hero of your village. There will be opportunities so dangerous, only the bravest would take them on. Whispers of deadly beasts, rumors of haunted treasures and cries for help that are surely a ruse. They call for you. Go on adventures and with luck, you will find heaps of resources, treasures and powerful weapons.",
                    ANNUAL_SPECIALS: "Annual Specials",
                    ANNUAL_SPECIALS_DESC: "There are always exciting new features in the annual special of Travian: Legends. Most recently, alliances fight over control of ancient European regions. Teamwork is more important than ever, because only the alliance that holds the majority can tap into the regional powers. In addition, people can fund collaborative developments in areas like metallurgy or trading that benefit all members of the alliance.",
                    LIVE_DATA: "Live data",
                    MYSTERIOUS_POWERS_ARE_WAITING_TO_BE_DISCOVERED: "Mysterious powers are waiting to be discovered…"
                }
            },
            BREADCRUMB: { Home: "Home" },
            CHANGE_LANG: {
                SELECT_A_LANG: "Select a language",
                SEACH_FOR_YOUR_LANGUAGE_OR_COUNTRY: "Search for your language or country"
            },
            COOKIES_ACCEPT: {
                THIS_WEBSITE_USES_COOKIES_DESC: "This website uses cookies to ensure you get the best experience of our website.",
                OK: "OK"
            },
            LOGIN: {
                LOGIN: "Login",
                YOU_HAVE_PLAYED_ON: "You've played on",
                I_FORGOT_MY_GAMEWORLD: "I forgot my game world",
                CHANGE_GAME_WORLD: "Change game world",
                LOGIN_AND_PLAY: "Log in and play",
                I_FORGOT_MY_PASSWORD: "I forgot my password",
                LOW_RES_MODE: "Low resolution mode",
                LOW_RES_MODE_DESC: "(for slow internet connections & mobile devices)",
                USERNAME_OR_EMAIL: "Username or email",
                PASSWORD: "Password",
                CHOOSE_GAME_WORLD: "Select game world",
                LOGIN_TO_PLAY: "Login to play",
                OTHER_GAME_WORLDS: "Other game worlds",
                THERE_ARE_NO_GAME_WORLDS_FOR_LOGIN: "There are no game worlds available for login"
            },
            ERRORS: {
                usernameTooShort: "Your account name is too short; it must be at least {{min}} characters",
                usernameTooLong: "Your account name is too long; it must have no more than {{max}} characters",
                userDoesNotExists: "User does not exist",
                accountIsInactive: "Account is inactive",
                passwordTooShort: "Your password is too short; it must be at least {{min}} characters",
                passwordWrong: "Password is wrong",
                valueRequired: "Value is required",
                reCaptchaRequired: "Captcha is required",
                invalidCaptcha: "Invalid captcha",
                activationNotFound: "Activation process not found.",
                emailUnknown: "This email address is unknown to us",
                emailInvalid: "Your indicated email address is invalid",
                unknownGameWorld: "Unknown game world!",
                emailTooShort: "Your email is too short; it should be at least {{min}} characters",
                passwordWasNotUpdated: "Password was NOT updated",
                noRecoveryCodeIncluded: "noRecoveryCode",
                noUidIncluded: "noUid",
                passwordInsecure: "Password is insecure, please enter a different one",
                gameworldNotYetStarted: "The game world has not yet started.",
                noAccountsAssociatedWithEmailAddress: "Sorry, we didn't find an account associated to the given email address.",
                usernameBlacklisted: "This name is not available.",
                passwordLikeName: "Password matches the name.",
                invalidChars: "This name contains invalid characters",
                codeDoesNotExist: "This activation code does not exist",
                registrationCodeInvalid: "Invalid key",
                nameAlreadyExists: "This name already exists",
                emailAlreadyRegistered: "Email address is already registered",
                registrationClosed: "Registration is not available on this game world",
                activationCodeTooShort: "Activation code is too short; it must be at least {{min}} characters",
                ItsNecessaryToReadAndAcceptGTC: "You have to read and accept the Terms & Conditions",
                weVeAlreadySentAFewEmailWithinShortTime: "We've already sent a few Emails to that address within a few minutes. Please try again later."
            },
            FORGOT_PASSWORD: {
                ForgotPassword: "Forgot password",
                WeWillSendAnEmail: "We will send you a new password. It will be activated as soon as you confirm receipt.",
                Email: "Email",
                RecoverPassword: "Recover password",
                RequestReceived: "Request received.",
                emailWillBeSend: "An email will be sent with further instructions. This might take a few minutes.",
                enterNewPassword: "Enter new password.",
                setNewPassword: "Set new password",
                password: "Password",
                passwordHasBeenChanged: "The password has been changed."
            },
            FORGOT_GAME_WORLD: {
                ForgotGameWorld: "Forgot game world",
                enterYourEmailAddressAndWeAllSend: "Enter your email address and we will send you all associated game worlds.",
                requestGameWorlds: "Request game worlds",
                WeHaveSentAListOfAssociatedAccountsToEnteredEmailAddress: "We've sent a list of all accounts associated with the entered email address.",
                Email: "Email"
            },
            ACTIVATION: {
                activateAccount: "Activate account",
                activateAnaPlay: "Activate and play",
                ActivationCode: "Activation code",
                IDidNotReceiveAnEmail: "I didn't receive an email",
                UnknownOrInvalidGameWorld: "Unknown or invalid gameworld",
                weHaveSentAnEmailContainingActivationCode: "We've sent an email containing an activation link to the entered email address. Use this to activate your account on game world {{gameWorld}} and set a password.",
                couldNotProcessActivationCode: "Could not process activation code",
                WeveRecievedYourActivationKey: "We've received your activation key through the link you clicked in the email. You can now activate your account on game world com3. Please set your password."
            },
            NO_MAIL: {
                activationMail: "Activation email",
                UnknownOrInvalidGameWorld: "Unknown or invalid gameworld",
                ResendEmail: "Re-send email",
                email: "Email",
                ReEnterYourMail: "Re-enter your email address and we will re-send the activation email.",
                weHaveSentAnEmail: "We've re-sent an email containing an activation link to the entered email address. Use this to activate your account and set a password."
            },
            REGISTER: {
                THERE_ARE_NO_GAME_WORLDS_FOR_REGISTRATION: "There are no game worlds available for registration",
                registerToPlay: "Register to play",
                selectGameWorld: "Select game world",
                changeGameWorld: "Change game world",
                registerNow: "Register now",
                IAlreadyHaveAnAccount: "I already have an account",
                recommendedGameWorld: "Recommended game world",
                otherGameWorlds: "Other game worlds",
                Username: "Username",
                Password: "Password",
                Email: "Email",
                PlayerInvitedYou: "{{player}} invited you to play in this game world. Click on it again to change it anyway.",
                PlayerInvitedYouToTravian: "{{player}} invited you to play Travian: Legends",
                RegistrationKey: "Registration key",
                IAgreeToTermsAndConditionsAndPrivacyPolicy: 'I agree to <a target="_blank" class="inline" title="Terms &amp; Conditions" href="https://www.travian.com/international/terms">Terms & Conditions</a>  and <a href="//agb.traviangames.com/privacy-en.pdf" target="_blank" class="inline" title="Privacy Policy">Privacy Policy</a>',
                "Subscribe to newsletter": "Subscribe to newsletter",
                alreadyRegistered: "Already registered? Continue the activation process here."
            },
            SERVER_AGE: "Server age",
            "Loading...": "Loading...",
            NO_MORE_SERVERS: "No more game worlds available.",
            SERVER_START_TIME: {
                INSTANT_FINISH_TRAINING: "Instant finish training",
                SERVER_WILL_START_AT: "Game will start on {{date}} {{time}}",
                SERVER_WAS_STARTED_X_UNIT_AGO: "{{value}} {{unit}}",
                UNIT_SECONDS: "seconds",
                UNIT_HOURS: "hours",
                UNIT_DAYS: "days",
                UNIT_MINUTES: "minutes",
                GAME_WORLD_FINISHED: "Game world finished"
            }
        }
    },
    "./src/frontend/locale/fa-IR.json": function(e, t) {
        e.exports = {
            TITLE: "تراوین  بازی استراتژیک آنلاین",
            DESCRIPTION: "استاد تاکتيک‌هاي باستاني با رومي‌ها، گول‌ها و يا توتن‌ها شويد!",
            KEYWORDS: "تراوین,رومی ها,توتن ها, گول ها, بازی اینترنتی",
            JOURNEY: {
                PLAY_NOW: {
                    JOIN_THE_FAMOUS: "پیوستن به فرد مشهور",
                    EXPERT_STRATEGY_GAME: "بازی استراتژیک حرفه‌ای‌ها",
                    TRUE_MMO_WITH_THOUSAND_OF_REAL_PLAYERS: "پیشگام واقعی بازی چندنفره آنلاین گسترده با هزاران نفر از بازیکنان واقعی!",
                    PLAY_NOW: "هم اکنون بازی کنید"
                },
                PLAYER: {
                    INTERACTION: {
                        PLAY_WITH_THOUSANDS_OF_OTHERS: "با هزاران بازیکن دیگر، حماسه خود را شکل دهید",
                        A_TRUE_MMO_EXPERIENCE: "تجربه‌ای واقعی از بازی چندنفره گسترده آنلاین",
                        A_TRUE_MMO_EXPERIENCE_DESC: "وارد داستانی شوید که به‌کلی توسط رشته‌ای درهم‌تنیده از اقدامات بازیکنان روایت می‌شود. جهانی آنقدر وسیع را درنوردید که سریعترین سوارکاران هم برای گذر از یک سو تا سوی دیگر آن روزها سپری می‌کنند. توتن‌های خشمگین، رومیان سرسخت و گول‌های دغل‌باز یا در کنار شما خواهند بود یا بر سر راه شما. سیستم‌های تجاری که به‌طور کامل توسط بازیکنان اداره می‌شوند امکانی را فراهم‌کنند که فرد اصلح ثروت به دست آورد. سعی کنید کتیبه های منحصربه‌فرد را از آن خود کنید یا به سرعت یک دهکده عجایب جهان را بنا نهید. در تراوین نسخه اسطوره‌ها، شما می‌توانید هرکسی که می‌خواهید باشید."
                    },
                    PLAY_STYLE: {
                        CHOOSE_YOUR_LEGEND: "اسطوره خود را انتخاب کنید",
                        LEGENDS: {
                            DEFENDER: {
                                TITLE: "سخت‌تر از فولاد",
                                DESC: "کسی در یک روز پیروز جنگ نشده است. بگذارید همه احمق‌ها به همدیگر بتازند و در این حین اقتصاد پررونقی را برای خود به وجود آورید. شما بر فراز دیوارهای مستحکم خواهید ایستاد و لشکریان بی‌شماری را که روحیه خود را باخته‌اند مورد تمسخر قرار خواهید داد. در برابر هر حرکتی که رقبای شما انجام می‌دهند هوشیارتر از آنها عمل کنید. برای سربازان آنها دام بگسترانید و با در اختیار داشتن زندانیان آنها باجگیری کنید. با همسایگان خود همکاری کنید، ستون اصلی اتحاد خود را بنا نهید و به محافظ حقیقی مردم بدل شوید."
                            },
                            ATTACKER: {
                                TITLE: "چکش",
                                DESC: "هنگام یورش بردن به سمت دروازه دشمن، صدای طبل‌ها را احساس کنید. چهره وحشت‌زده آنها و دفاع ضعیفشان را به سخره بگیرید. در شیپورها دمیده می‌شود - چه تلاش بیهوده‌ای. قبل از اینکه دوستان آنها سوار اسب‌هایشان شوند، شما منابع قیمتی آنها را با خود خواهید برد. اما حملات کافی نیستند. ارتش شما بزرگتر خواهد شد، و به تبع آن به آذوقه بیشتری نیاز خواهید داشت. شما آزادید. آزادید هر گوشه از این جهان را فتح کنید تا اینکه همه در محضر شما زانو بزنند."
                            },
                            LEADER: {
                                TITLE: "با ابهت رهبری کنید",
                                DESC: "کوروش کبیر. شاپور دوم (بزرگ). شما. برخی از مقتدرترین امپراتوران کل ادوار تاریخ را شکل می‌دهند. به پا خیزید و اتحاد خود را از انبوه جنگجویان به نیرویی شکست‌ناپذیر مبدل سازید. رهبر واقعی کسی نیست که در قلعه بر تختش تکیه بزند و منتظر لحظه مناسب باشد. با توسل به جذبه و حیله و ترفند سیاستمدارانه، قدرت را در دستان خود نگهدارید، رقبای خود در چنگ خود داشته باشید و انسجام امپراتوری خود را تا ابد حفظ کنید. فقط جزئی از داستان نباشید. آن را روایت کنید. این دوره متعلق به شما است."
                            }
                        }
                    }
                },
                BUILD_EXPIRE: {
                    STRATEGY_TO_PARADISE: "مکان ایده‌آل متخصصان استراتژی",
                    THE_ROAD_TO_DOMINATION: "جاده‌ای به سوی سلطه‌جویی",
                    THE_ROAD_TO_DOMINATION_DESC: "بلندترین عمارت‌ها همگی به شکلی واحد آغاز می‌شوند: با گذاشتن اولین سنگ. از اینجا به بعد همه چیز در دستان خودتان است. قلمروی خود را چنان بگسترانید که آن آبادی کوچکی که ابتدا از سایه یک درخت تجاوز نمی کرد، تبدیل به یک امپراتوری با شرق و غرب بی کران شود. در جهان کاوش کنید و مأمن مکنت و ثروت را بیابید. و در نهایت همه کسانی را که بر سر راهتان قرار می‌گیرند نابود کنید. نتیجه کار شما با هر ساختمان، هر سرباز و هر پیشرفتی که باعث می‌شود تمدنتان شکوفا شود نشان داده خواهد شد."
                },
                BATTLE: {
                    TITLE: "جنگ حماسی با حضور هزاران بازیکن",
                    BOX_TITLE: "خودتان را ثابت کنید",
                    BOX_CONTENT: "آوارهای شعله‌وری که سر به فلک می‌کشند و سازه‌ها و امید دفاع را در هم می‌کوبند. زمین از حرکت ارتش نزدیک‌شونده به لرزه در می‌آید و آسمان از دود تاریک می‌شود. به زمین بازی آدم بزرگ‌ها خوش آمدید. کارهایی را که در برابر هزاران بازیکن دیگر انجام داده‌اید ثابت کنید و جایگاه خود را در دنیای تراوین بدست آورده‌اید. با هوشمندانه‌ترین استراتژی از دیگر بازیکنان پیشی بگیرید یا اینکه در طی روز بارها و بارها به آنها حمله‌ور شوید. تاریخ در تالارهای قدیمی شهر شکل نمی‌گیرد، بلکه این صحنه نبرد است آن را تعیین می‌کند. شما ترسویید یا فاتح؟"
                },
                LATE_GAME: {
                    TITLE: "آثار جاودانگی",
                    BOX_TITLE: "اعجوبه جهان",
                    BOX_CONTENT: "شما تا زمانی که چیزی به‌یادماندنی نسازید که کل جهان برای ادای احترام از حرکت بازایستد، قدرت واقعی را تجربه نکرده‌اید. با اتحاد خود یکی از عجایب جهان را بسازید آن وقت، سرور متعلق به شما است. بزرگترین جنگ‌ها به وقوع خواهد پیوست، قوی‌ترین هم‌پیمانان باهم مبارزه خواهند کرد و در نهایت همه چیز ممکن است به یک حرکت تعیین‌کننده بستگی داشته باشد. در این لحظه از حقیقت، دوست به دشمن نفرت‌انگیز مبدل می‌شود و رقیب قدیمی از روی ناچاری با شما اتحاد تشکیل می‌دهد. وقت آن فرا رسیده است که قهرمانان به اسطوره مبدل شوند. آماده‌اید؟",
                    UNIQUE_POWERS: "قدرت‌های بی‌نظیر"
                }
            },
            NAVIGATION: {
                Game: "بازی",
                "Play-style": "سبک بازی",
                "Player interaction": "ارتباط با بازیکنان",
                "Build empire": "ساختن امپراتوری",
                Battle: "نبرد",
                "Late game": "آخر بازی",
                Language: "زبان",
                "Log in and play": "وارد اکانت شوید و بازی کنید",
                "Play now": "هم اکنون بازی کنید",
                "Back to categories": "بازگشت به دسته‌ها",
                Register: "ثبت نام",
                Login: "ورود",
                Close: "بستن"
            },
            FOOTER: {
                JOIN: "به نبردی حماسی با حضور هزاران بازیکن حرفه ای وارد شوید!",
                PLAY_NOW: "هم اکنون بازی کنید",
                COPY_RIGHT: "شرکت بازی‌های تراوین کلیه حقوق محفوظ است."
            },
            NEWS: { READ_MORE: "ادامه..." },
            GAME: {
                PLAYSTYLE: {
                    CHOOSE_YOUR_LEGEND: "اسطوره خود را انتخاب کنید",
                    TOP5_ATTACKERS: "",
                    TOP5_DEFENDERS: "",
                    ALLIANCES: "",
                    THE_HAMMER: "چکش",
                    THE_HAMMER_DESC: "همیشه رهبری حمله با شماست. شما نوک نیزه یا دژکوبی هستید که دیوار اول را در هم می‌کوبد. نبردها نام شما را همراه خود می‌برند، و دشمن‌ها با شنیدن آن نام تنشان به لرزه می‌افتد. چیزی نمی‌گذرد که فرمانده ارتش‌های عظیم می‌شوید و با بی‌رحمی به غارت مسیرتان در سرزمین‌ها بپردازید. اما اشتباه نکنید - این مسیر مسیر آسانی نیست. اگر نمی‌توانید رقابت را در دست بگیرید، این مناسب شما نیست. ولی اگر می‌خواهید جان و زندگی‌تان را به خطر بیاندازید تا به جوایز و افتخاراتی دست یابید، به ما ملحق شوید. نقش این چکش را شما بازی کنید.",
                    RAISE_AN_ARMY: "ارتشی برپا کنید.",
                    RAISE_AN_ARMY_DESC: "آیا می‌خواهید سپاهی به وسعت افق را رهبری کنید که دشمن با دیدنش پا به فرار بگذارد؟ یا ترجیح می‌دهید گردانی از متخصصین نظامی داشته باشید که هرکدامشان بدون یک قطره عرق ریختن ده‌ها مرد را از پای در می‌آورد؟ اینکه چطور سلطه‌گری کنید به خودتان بستگی دارد. نگران نیروهای تدافعی هم نباشید. هیچ‌کس نمی‌خواهد دلیلی برای ملاقات با ارتش شما جور کند.",
                    RAID_CONQUER_AND_CAUSE_SOME_MAYHEM: "بتازید، تسخیر کنید و آشوبی برپا کنید.",
                    RAID_CONQUER_AND_CAUSE_SOME_MAYHEM_DESC: "استراتژی مورد علاقه‌تان با یک یورش آغاز می‌شود. چرا وقت‌تان را برای جمع‌آوری منابع صرف کنید در حالی که می‌توانید در خانه همسایه را بزنید و مؤدبانه درخواست کنید. دشمنان مشترک‌تان را از بین ببرید تا غریبه‌ها با شما دوست شوند. و دوستان هم با خوشنودی منابع را به شما اهدا می‌کنند تا حافظ صلح باشند. طی مدتی کوتاه، خبر جنگجویی پخش می‌شود که خواسته‌هایش را تسخیر می‌کند و آنگاه به تقاضاهای شما با احترام پاسخ داده می‌شود.",
                    YOU_ARE_THE_CHAMPION: "شما قهرمان هستید.",
                    YOU_ARE_THE_CHAMPION_DESC: "آیا روستاهایشان را فتح می‌کنید یا به آتش می‌کشید؟ اول کدام ساختمان باید منجنیق‌هایتان را در خود جای دهد؟ گرفتن بعضی از تصمیمات سخت‌تر از بعضی دیگر است، اما لزومی ندارد آنها را تنها اتخاذ کنید. تعدادی گروه هم‌پیمان بیابید، قدرت‌تان را چندبرابر کنید و از همه جهات حمله کنید. برای نحوه جنگیدن تصمیم نگیرید – بلکه برای نحوه بردن تصمیم‌گیری کنید.",
                    A_REAL_WARRIOR_EARNS_ALL_HE_CAN_TAKE: "جنگجوی واقعی هرچه بتواند بدست می‌آورد.",
                    HARDER_THAN_STEEL: "سخت‌تر از فولاد",
                    HARDER_THAN_STEEL_DESC: "روی زمین‌تان بایستید. حمله‌ها را یکی پس از دیگری وارد کنید تا اینکه خسته و مأیوس شوند. وقت‌تان را با جنگ‌های کوچک تلف نکنید. شما برای نبردی دراز وارد این داستان شده‌اید. چیزی نخواهد گذشت که بزرگی دیوارهایتان امید همه را به تسخیر آن ناامید می‌کند، و روستاهای کوچک دشمن زیر سایه سنگر شما قرار خواهد گرفت. تاکتیک راهبردی شما از چشم‌ها پوشیده نخواهد ماند. با هم گروهی بسازید، یک ابرقدرت منطقه‌ای تشکیل دهید و این جنگ را به دستور خود تمام کنید.",
                    THINK_LONG_TERM: "دوراندیش باشید",
                    THINK_LONG_TERM_DESC: "زمان بزرگترین دوست شماست. هربار که حریفی به زمین زده شود، جایگاه شما در منطقه تقویت می‌گردد. تمرینات نظامی‌تان را بهبود بخشید و تسلیحات قوی‌تری شکل دهید تا ارتش‌تان از همه افراد حاضر در نبرد تفوق پیدا کند. با ایجاد آبادی‌های جدید گسترش دهید، ساخت و ساز تأسیسات تخصصی را کلنگ بزنید، و روی تشکیل جامعه‌ای متمدن و سالم سرمایه‌گذاری کنید. با داشتن بنیادی قدرتمند، از همه رقبا پیشی می‌گیرید تا اینکه زمان [greatest achievement] (Link to WW page) فرا می‌رسد.",
                    PROTECTOR_OF_THE_PEOPLE: "محافظ انسان‌ها",
                    PROTECTOR_OF_THE_PEOPLE_DESC: "ارتش‌تان در روستای شما انگشت به دهان نخواهد ماند. با ارسال پشتیبانی مخفی به همسایگان خود، رقبایتان را تضعیف کنید. هیچ‌چیز لذت‌بخش‌تر از این نیست که یک ارتش ناآماده در دژ شما تاخت و تاز کند. کمک به دوستان مزیت‌های بسیاری را به همراه می‌آورد. علاوه بر منابع و الطاف بسیار، یک پیوند دفاعی قوی نیز اطمینان‌بخش این خواهد بود که هرگز در دردسر نخواهید افتاد. با دلاوری و قدرت حفاظتی شما، توان دیپلماتیک حاصل می‌شود.",
                    BE_A_TEAM_PLAYER: "یک بازیکن تیمی باشید",
                    BE_A_TEAM_PLAYER_DESC: "وقتی تصمیمات هم‌پیمانان متکی به نیروهای تدافعی شما باشد، در جهت منافع شما اتخاذ خواهد شد. از ارائه پشتیبانی به سایر هم‌پیمانان دریغ نکنید و همانند پیوندی بین کنفدراسیون‌ها عمل کنید. با این حال که دیگران بر سر دست‌ساخته‌های ارزشمند جنگ می‌کنند، مال شما محفوظ است. و وقتی هم‌پیمان شما یکی از «عجایب جهان» را بنا می‌کند، شما نگهبان آن خواهید بود. با ترکیب شدن نیروهای تمامی هم‌پیمانان شما در دژ، پیروزی از آن شما خواهد بود.",
                    THE_TRUE_VICTOR_STILL_STANDS_AT_THE_END: "پیروز واقعی در پایان قد علم می‌کند.",
                    LEAD_WITH_GREATNESS: "با ابهت رهبری کنید",
                    LEAD_WITH_GREATNESS_DESC: "بدون رهبر هیچ امپراتوری وجود نخواهد داشت. تبدیل به قلب گروه هم‌پیمان خود شوید و آن را به شکوه و عظمتی بی‌سابقه برسانید. به کمک تخصص خود در زمینه دیپلماسی، راهکارهایی پیدا می‌کنید که دیگران از یافتن آن عاجزند. معاهده‌هایی را تنظیم کنید که دسترسی به قلمروتان را غیرممکن می‌کند. راهبردهایی هوشمندانه بکار بگیرید، دشمنان را به جان هم بیندازید و به هر دری بزنید تا اینکه کل قلمرو پیرو خواسته شما شوند. سمفونی جنگ را به دلخواه خود اجرا کنید.",
                    SILVER_TONGUED_AGENT: "نماینده زبان‌باز",
                    SILVER_TONGUED_AGENT_DESC: "قویترین ابزار شما ارتباطات است. روحیه گروه هم‌پیمان را در سطح بالا حفظ کنید و مشکلات را قبل از بروزشان برطرف نمایید. کنفدراسیون‌ها برای رفع تنش‌ها و ایجاد طرح‌هایی که رضایت همه طرفین را به همراه داشته باشد بر قدرت دیپلماتیک شما تکیه خواهند کرد. مذاکرات تندی را با دشمنان‌تان داشته باشید و برایشان روشن سازید که گروه هم‌پیمان شما به عقب‌نشینی تن نمی‌دهد. تهدیدی در زمان حال می‌تواند از آسیب افراد در آینده جلوگیری کند. حداقل افراد سمت شما.",
                    WISE_MENTOR: "مربی عاقل",
                    WISE_MENTOR_DESC: "رهبر قوی عظمت و ابهت را در دیگران القا می‌کند. به دنبال اعضای جدید باشید و راهبردهای انحصاری را برای آنها شکل دهید تا تبدیل به دارایی‌های قدرتمندی برایتان شوند. حامی مشاوران مجرب باشید و آنها را به رهبرانی توانا تبدیل کنید. شما دوشا دوش هم‌رزمان معتمد می‌جنگید و دوستی‌هایی را شکل می‌دهید که فراتر از یک دنیای بازی پابرجا می‌ماند. شما اهرمی هستید که گروهی از غریبه‌ها را به سیستمی منظم و عالی تبدیل می‌کند.",
                    CUNNING_STRATEGIST: "استراتژیست زیرک",
                    CUNNING_STRATEGIST_DESC: "هم‌پایه‌های شما در گروه هم‌پیمان در مواقع نیاز به شما تکیه می‌کنند. نیروهای تدافعی را سریعاً هماهنگ کنید و حتی یک روزنه هم برای دشمن نگذارید. عاقلانه عمل کنید و بدون از دست دادن حتی یک سرباز، برنده نبردها شوید. شما حملاتی در مقیاس حماسی را رهبری خواهید کرد؛ این حملات تبدیل به افسانه‌هایی آشنا برای همگان می‌شود. در وقت مناسب، راهبردی را طرح کنید که طی ماه‌ها برملا می‌شود، و از اجرای بی‌نقص آن لذت ببرید.",
                    STEER_THE_COURSE_OF_THIS_WORLD_INTO_YOUR_CONTROL: "جریان این جهان را به اختیار خود بچرخانید."
                },
                INTERACTION: {
                    FRIENDS_AND_FOES: "دوستان و دشمنان",
                    A_TRUE_MMO_EXPERIENCE: "تجربه‌ای واقعی از بازی چندنفره گسترده آنلاین",
                    A_TRUE_MMO_EXPERIENCE_DESC: "در تراوین تنها نیستید: افسانه‌ها. به لطف جامعه‌ای عظیم که در گروه‌های هم‌پیمان، تجارت و جنگی کهن تعامل دارند، جهان زنده است و در حال تغییر. هر دور از بازی داستان متفاوتی دارد. فتح‌های دسته‌جعی در نیمه شب، دسیسه‌ها در هر سو و دوستی‌های پولادین.  هر حرکتی اثری میگذارد، و هر تصمیمی پیامدی دارد. در نزدیکی دوستانتان سکنی گزینید، یا مستقیم سراغ عمل بروید.",
                    LIVE_DATA: "",
                    LONG_LASTING_ALLIANCES: "هم‌پیمانان پایدار",
                    LONG_LASTING_ALLIANCES_DESC: "تراوین دنیایی از فرصت‌های کار تیمی را فراهم می‌سازد. با همسایگان در تماس باشید، در مقابل تهدیدهای مشترک تیم تشکیل دهید و در نهایت دوستی‌هایی برپا سازید. از مربیان مجرب که شما را در جهان‌های مختلف راهنمایی می‌کنند درس بیاموزید تا اینکه خودتان مربی شوید. بعضی از هم‌پیمانان هر سرور دور هم جمع می‌شوند و دوستی‌هایی را شکل می‌دهند که فراتر از این بازی پابرجا می‌ماند. پشتیبانی از یکدیگر و بازگشت متحدانه از هر عقب‌نشینی باعث ایجاد پیوندهایی همراه با خاطرات دلپذیر می‌شود.",
                    TOURNAMENTS_AND_SPECIALS: "مسابقات و رویدادهای ویژه",
                    TOURNAMENTS_AND_SPECIALS_DESC: "در تراوین خستگی معنی ندارد: افسانه‌ها. هرساله نسخه‌ای ویژه عرضه می‌شود که ظاهری تازه را در مقایسه با تراوین کلاسیک به نمایش می‌گذارد. این سفر حماسی در حال حاضر در اروپا جریان دارد، و فرانسوی‌ها، رومیان و توتُن‌ها برای در دست گرفتن کنترل منطقه‌هایشان می‌جنگند. مسابقات سالانه این فرصت را به شما می‌دهد که خود را در مقابل بهترین بازیکنان حاضر در جهان نشان دهید. می‌توانید انبوهی از جوایز و شهرت بی‌پایان بدست آورید.",
                    FORUM_AND_EVENTS: "انجمن و رویدادها",
                    FORUM_AND_EVENTS_DESC: "به جامعه‌ای متشکل از بسیاری افراد پرشور و هم‌رأی ملحق شوید. این انجمن مکانی عالی برای دریافت مشاوره، بحث و گفتگو پیرامون راهبردها، یافتن هم‌پیمانان برای بازی بعدی یا صرفاً کمی شوخی و مزاح است. منتظر رویدادهایی که از طرف شرکت «Travian Games» میزبانی می‌شود باشید. رویدادهایی مانند دهمین سالگرد تولد، که در آن بازیکنان و توسعه‌دهندگان در زندگی واقعی باهم ملاقات می‌کردند، داستان ها را می‌خواندند و می‌خندیدند و تا دیر وقت شب بازی می‌کردند.",
                    A_GAME_DRIVEN_BY_ITS_COMMUNITY: "یک بازی جذاب بر گرفته از نظرات بازیکنان و جامعه بزرگ تراوین."
                },
                BUILD_EMPIRE: {
                    YOUR_EMPIRE: "امپراتوری شما",
                    THE_ROAD_TO_DOMINION: "جاده‌ای به سوی سلطه‌جویی",
                    THE_ROAD_TO_DOMINION_DESC: "این کار یک مرد عادی نیست. باید نگرشی آنقدر شفاف داشته باشید که کل یک جمع را الهام بخشد. شهری را بسازید که مردمان شما حقیقتاً آن را بپرستند؛ شهری که با اعتقاد راسخ از آن دفاع خواهند کرد. امپراتوری تجارت‌محوری را پایه‌گذاری می‌کنید یا یک قلمرو خودکفا می‌سازید؟ آیا با تهدیدها مهربانانه برخورد می‌کنید - یا تهدیدی بدتر از آن را برمی‌گردانید؟ نگرشتان را با اشتیاق به اجرا بگذارید و از آن در برابر همه مخالفان دفاع کنید. هیچ کسی یارای متوقف کردن شما را نخواهد داشت.",
                    LIVE_DATA: "",
                    CRAFT_A_SCHEME: "طرحی بریزید",
                    CRAFT_A_SCHEME_DESC: "نسبت به گزینه‌هایتان هوشمندانه عمل کنید. دانستن اینکه چه زمانی باید قلمروتان را گسترش دهید و چه زمانی برای تقویت زیرساخت‌ها بهتر است به یک کارشناس نیاز دارد. ارتشی که ساز و برگ نداشته باشد به سرعت از حرکت باز می‌ایستد. آیا از پایگاه‌های مرزی محافظت می‌کنید و مرکز را آزاد رها می‌کنید، یا می‌گذارید سرنوشتشان را شانس رقم بزند؟ هرچه بهتر برنامه‌ریزی کنید، قدرتمندتر خواهید شد.",
                    HONE_YOUR_SKILLS: "مهارت‌هایتان را شکوفا کنید",
                    HONE_YOUR_SKILLS_DESC: "هزاران راه برای کسب تخصص وجود دارد. با تبدیل کردن روستاهای خود به دژها، مراکز فرهنگی، کمپ‌های نظامی یا انبارهای منابع، با شرایط وفق پیدا کنید. حریف‌هایتان را تحلیل کنید و بهترین راهبرد نظامی را برای خنثی کردن راهبرد آنها ایجاد نمایید. قهرمانتان را طوری آموزش دهید که به بهترین نحو کمک ارائه دهد؛ این کمک می‌تواند تهیه ساز و برگ‌های مورد نیاز روستا باشد، یا ارائه قدرت محض در میدان نبرد. راهبردهای مخفی همه‌جا هستند، آماده اینکه برملا شوند.",
                    EXPLORE_EXPAND_AND_EXTERMINATE: "کاوش کنید، گسترش دهید و منهدم کنید",
                    EXPLORE_EXPAND_AND_EXTERMINATE_DESC: "جهان تراوین دارای مناطق بی‌شماری برای کاوش و جستجو است. واحه‌های منبع‌خیز را کشف کنید، آنها را رسماً به مالکیت خود در آوردید، و تولیداتتان را دوبرابر کنید. اگر هنوز هم تشنه هستید، می‌توانید همسایگانتان را وادار به حمایت از قلمرو خود بکنید - یا بگذارید در آن غرق شوند. اگر به صورت اتفاقی به یک دست‌ساخته قدیمی و شدیداً محافظت‌شده برخوردید، آگاه باشید. در افسانه‌ها گفته شده که اگر کسی چیزی بدزدد و نحوه استفاده از آن را بفهمد، قدرتی خارق‌العاده به بار خواهد آورد.",
                    "CREATE_A_DYNASTY_OF_A_THOUSAND_YEARS!": "امپراتوری هزار ساله‌ای برپا کنید!"
                },
                BATTLE: {
                    EPIC_WARFARE: "جنگ حماسی",
                    JOURNEY_OF_A_LEGEND: "سفر یک افسانه",
                    JOURNEY_OF_A_LEGEND_DESC: "به خاطر وجود هزاران بازیکن در این سرور، رویدادها واقعاً حماسی هستند. کنفدراسیون‌های بزرگ برای سلطه‌جویی بر جهان قیام می‌کنند و عاقبتشان چیزی جز خاکستر نیست. دشمنی بین هم‌پیمانان با گذشت ماه‌ها بروز می‌کند، و از آن طرف پس‌رفت‌ها و خیانت‌ها مدام باعث تغییر مسیر حرکت تاریخ می‌شود. هر دور جدیدی از بازی مملو از شگفتی‌های مختلف است. از طرفی، طولانی بودن آن فرصت مناسب را در اختیارتان می‌گذارد که راهبرد پخته‌ و کارآمدی را طرح کنید. استقامت خود را در برابر شدیدترین دشواری‌ها نشان دهید و جایگاهتان را در تخت پادشاهی بدست آورید.",
                    BOLD_BEGINNINGS: "آغازهای متهورانه",
                    BOLD_BEGINNINGS_DESC: "اولین روستایتان را برپا کنید. به همسایگان حمله کنید و از منابعشان استفاده نمایید تا شهری پررونق و ارتشی خطرناک بسازید. لازم نیست متواضع رفتار کنید.",
                    STAY_IN_CONTROL: "کنترل‌تان را حفظ کنید",
                    STAY_IN_CONTROL_DESC: "دوستانتان را در نزدیک خود و دشمنان را دور از خود نگه دارید. به طور مرتب محیط پیرامون‌تان را کنترل کنید تا از هرگونه خطر و تهدید جلوگیری نمایید. با افرادی که ارزش اعتماد دارند یک گروه هم‌پیمان تشکیل دهید.",
                    GROW_YOUR_BICEPS: "عضلاتتان را پرورش دهید",
                    GROW_YOUR_BICEPS_DESC: "قلمروتان را گسترش دهید و یک نیروگاه منطقه‌ای بسازید. همه موتورها را بکار بیاندازید تا ارتشی قدرتمند و توانا در تسخیر دست‌ساخته‌ها ایجاد کنید."
                },
                LATE_GAME: {
                    FINAL_GLORY: "شکوه نهایی",
                    THE_WONDER_OF_THE_WORLD: "اعجوبه جهان",
                    THE_WONDER_OF_THE_WORLD_DESC: "هرچه انجام داده‌اید به این کار برمی‌گردد. کوهی دست‌ساخته انسان از رنگ سفید و طلایی، با مجموعه‌ای از باغ‌ها و رودخانه‌های رو به پایین، که نور خورشید را تقریباً به شکلی ملکوتی منعکس می‌کنند. بزرگترین دستاورد شما. با ساختن یکی از «عجایب جهان»، نقطه برجسته‌ای را در کتاب‌های تاریخ تراوین برجا خواهید گذاشت. کل جهان بازی در رقابت است تا به این نقطه عطف از دستاورد انسانی برسد، اما فقط یکی از گروه‌های هم‌پیمان پیروز خواهد شد.",
                    THE_GRAND_FINALE: "فینال بزرگ",
                    THE_GRAND_FINALE_DESC: "به چالش نهایی خوش آمدید. برای پشت سر گذاشتن این مرحله، نیاز به ارتش‌ها و منابعی دارید که جزئیات آن از قبل مشخص باشد. گروه هم‌پیمان شما وقتی عملیات ساخت «اعجوبه جهان» را برنامه‌ریزی می‌کند باید عملکردش را به سطح نهایی برساند و از آن در مقابل نیروهای مرکب متشکل از سایر اعضای سرور دفاع نماید - بدون اینکه از نیروهای تدافعی خود غافل شود. علاوه بر این، باید رقبای خود را نابود کنید تا خیالتان راحت باشد که شکستی متوجه شما نشود. مسابقه در جریان است.",
                    THE_RACE_IS_ON: "مسابقه در جریان است.",
                    "REACH_THE_PINNACLE_OF_HUMAN_ACHIEVEMENT!": "به نهایت افتخارات یک انسان دست پیدا کنید!",
                    ANCIENT_RELICS: "آثار باستانی",
                    ANCIENT_RELICS_DESC: "در سفرهایتان با قلعه‌هایی از تمدن کهن، یعنی ناتارها، روبرو خواهید شد. امروزه آنها تنها سایه‌ای از سلطه‌گری گذشته خود هستند، اما مهارت آنها در تولید دست‌ساخته‌ها همچنان حریف می‌طلبد. آرام آرام سایر قبایل شروع به پیشی گرفتن از آنها از لحاظ تعداد نفرات شدند و ناتارها به خفا رفتند و با هرآنچه برجای مانده بود به دفاع از دست‌ساخته‌هایشان پرداختند. اگر بخواهید مالک چنین اثری شوید، قدرتی غیر قابل بیان در دست دارید. ولی هشیار باشید - کل جهان چشم به آن دوخته است. و شما نیز در مرکز نگاهشان قرار می‌گیرید.",
                    STRANGE_POWERS: "قدرت‌های شگفت‌انگیز",
                    STRANGE_POWERS_DESC: "این آثار برجای مانده از دانش باستان دارای قدرت‌هایی است که باورش برای انسان‌های عادی خیلی سخت است. شخصی را در روستایتان برای پاییدن ساختمان‌های خود بگمارید تا دیوارهایتان نفوذناپذیر باشند. سایرین به افزایش قدرت نظامی شما می‌پردازند و به نیروهایتان کمک می‌کنند تا آموزش‌شان را بسیار سریعتر به اتمام برسانند. منحصر به‌فردترین دست‌ساخته‌ها دارای چنان قدرتی هستند که کل امپراتوری شما را تحت تأثیر قرار می‌دهند - از جنوبی‌ترین ایالت گرفته تا مرزهای شمالی آن.",
                    DARING_ADVENTURES: "ماجراهای جسورانه",
                    DARING_ADVENTURES_DESC: "شما قهرمان روستایتان هستید. فرصت‌هایی چنان خطرناک وجود دارند که فقط شجاع‌ترین‌ها می‌توانند از آنها استفاده کنند. زمزمه‌های وجود جانوران غول‌پیکر، شایعات مربوط به گنج‌های دزدیده‌شده و فریادهای درخواست کمک که قطعاً همگی حیله و نیرنگ است. آنها شما را فرا می‌خوانند. وارد ماجراها شوید و با شانس خود، انبوهی از منابع، گنج‌ها و سلاح‌های قدرتمند را خواهید یافت.",
                    ANNUAL_SPECIALS: "رویدادهای ویژه سالانه",
                    ANNUAL_SPECIALS_DESC: "همواره ویژگی‌های جدید و هیجان‌انگیزی در رویدادهای ویژه سالانه تراوین وجود دارد: افسانه‌ها. اخیراً گروه‌های هم‌پیمان بر سر کنترل مناطق اروپای قدیم جنگ می‌کنند. کار تیمی از همیشه اهمیت بیشتری پیدا کرده است، زیرا فقط گروه هم‌پیمانی که اکثریت جمعیت را داشته باشد می‌تواند از قدرت‌های منطقه بهره بگیرد. علاوه بر این، افراد می‌توانند بودجه پیشرفت‌های مشترکی را در حوزه‌هایی همچون متالورژی یا تجارت تأمین کنند که برای تمامی اعضای گروه هم‌پیمان منفعت خواهد داشت.",
                    LIVE_DATA: "",
                    MYSTERIOUS_POWERS_ARE_WAITING_TO_BE_DISCOVERED: "نیروهای اسرارآمیز در انتظار کشف شدن هستند..."
                }
            },
            BREADCRUMB: { Home: "صفحه‌ی اصلی" },
            CHANGE_LANG: {
                SELECT_A_LANG: "یک زبان انتخاب کنید",
                SEACH_FOR_YOUR_LANGUAGE_OR_COUNTRY: "یک زبان یا یک کشور جستجو کنید"
            },
            COOKIES_ACCEPT: {
                THIS_WEBSITE_USES_COOKIES_DESC: "این وب‌سایت برای اینکه بهترین تجربه را به شما ارائه دهد از کوکی‌ها استفاده می کند.",
                OK: "تایید"
            },
            LOGIN: {
                LOGIN: "Login",
                YOU_HAVE_PLAYED_ON: "شما بازی کرده اید در",
                I_FORGOT_MY_GAMEWORLD: "من سرور بازی‌ام را فراموش کرده‌ام",
                CHANGE_GAME_WORLD: "تغییر سرور",
                LOGIN_AND_PLAY: "وارد اکانت شوید و بازی کنید",
                I_FORGOT_MY_PASSWORD: "رمز عبورم را فراموش کرده‌ام",
                LOW_RES_MODE: "حالت وضوح پایین",
                LOW_RES_MODE_DESC: "(مخصوص اتصال به اینترنت کم‌سرعت و دستگاه‌های همراه)",
                USERNAME_OR_EMAIL: "نام کاربری یا ایمیل",
                PASSWORD: "رمز عبور",
                CHOOSE_GAME_WORLD: "یک جهان بازی انتخاب کنید",
                LOGIN_TO_PLAY: "برای بازی کردن وارد اکانت خود شوید",
                OTHER_GAME_WORLDS: "سایر سرورها",
                THERE_ARE_NO_GAME_WORLDS_FOR_LOGIN: "هیچ جهان بازی برای ورود یافت نشد."
            },
            ERRORS: {
                usernameTooShort: "نام حساب شما بیش از حد کوتاه است؛ باید حداقل متشکل از {{min}} نویسه باشد",
                usernameTooLong: "نام کاربری شما طولانی است، باید حداکثر متشکل از {{max}} نویسه باشد",
                userDoesNotExists: "چنین کاربری وجود ندارد",
                accountIsInactive: "این حساب کاربری غیر فعال است.",
                passwordTooShort: "رمز عبورتان بیش از حد کوتاه است؛ باید حداقل متشکل از {{min}} نویسه باشد",
                passwordWrong: "رمز عبور اشتباه است",
                valueRequired: "مقدار الزامی است",
                reCaptchaRequired: "کد امنیتی الزامی است",
                invalidCaptcha: "کد امنیتی صحیح نیست",
                activationNotFound: "پروسه فعال سازی اکانت یافت نشد.",
                emailUnknown: "این آدرس ایمیل برای ما ناشناخته است",
                emailInvalid: "آدرس ایمیل وارده شما نامعتبر است",
                unknownGameWorld: "جهان بازی یافت نشد.",
                emailTooShort: "ایمیل شما بیش از حد کوتاه است؛ باید حداقل متشکل از {{min}} نویسه باشد",
                passwordWasNotUpdated: "رمز عبور بروز نشد",
                noRecoveryCodeIncluded: "کد بازیابی وارد نشده است",
                noUidIncluded: "شناسه کاربری در درخواست یافت نشد",
                passwordInsecure: "رمز عبور وارد شده ناامن است. لطفا رمز دیگری انتخاب کنید",
                gameworldNotYetStarted: "این جهان بازی هنوز شروع نشده است",
                noAccountsAssociatedWithEmailAddress: "متأسفانه نتوانستیم حسابی را در ارتباط با آدرس ایمیل واردشده پیدا کنیم.",
                usernameBlacklisted: "این نام در دسترس نیست",
                passwordLikeName: "رمز عبور با نام کاربری برابر است",
                invalidChars: "نام کاربری شامل حروف غیر مجاز می باشد",
                codeDoesNotExist: "کد فعال سازی یافت نشد",
                registrationCodeInvalid: "کد وارد شده صحیح نیست",
                nameAlreadyExists: "این نام از قبل وجود داشته است",
                emailAlreadyRegistered: "آدرس ایمیل وارده نامعتبر است یا از قبل مورد استفاده قرار گرفته است",
                registrationClosed: "ثبت نام در این جهان بازی بسته شده است.",
                activationCodeTooShort: "کد فعال‌سازی بیش از حد کوتاه است؛ باید حداقل متشکل از {{min}} نویسه باشد",
                ItsNecessaryToReadAndAcceptGTC: "لازم است شرایط و ضوابط را مطالعه نموده و با آن موافقت نمایید",
                weVeAlreadySentAFewEmailWithinShortTime: "ما تعدادی ایمیل در زمان کوتاه به این آدرس ارسال کرده ایم. لطفا بعدا امتحان کنید."
            },
            FORGOT_PASSWORD: {
                ForgotPassword: "رمز عبور را فراموش کرده‌ام",
                WeWillSendAnEmail: "رمز عبور جدیدی برایتان ارسال خواهد شد. به محض اینکه دریافت نامه را تأیید کنید، این رمز عبور فعال خواهد شد.",
                Email: "ایمیل",
                RecoverPassword: "بازیابی رمز عبور",
                RequestReceived: "درخواست دریافت شد.",
                emailWillBeSend: "ایمیلی حاوی دستورالعمل‌های بیشتر برایتان ارسال خواهد شد. ممکن است دقایقی طول بکشد",
                enterNewPassword: "رمز عبور جدید را وارد کنید",
                setNewPassword: "تعیین رمز عبور جدید",
                password: "رمز عبور",
                passwordHasBeenChanged: "رمز عبور با موفقیت تغییر کرد."
            },
            FORGOT_GAME_WORLD: {
                ForgotGameWorld: "جهان بازی را فراموش کرده‌ام",
                enterYourEmailAddressAndWeAllSend: "آدرس ایمیل‌تان را وارد کنید تا کلیه سرورهای مرتبط را برایتان پیدا کنیم.",
                requestGameWorlds: "درخواست یافتن سرور های بازی",
                WeHaveSentAListOfAssociatedAccountsToEnteredEmailAddress: "ما لیستی از کلیه اکانت های مرتبط با آدرس ایمیل واردشده را برایتان یافتیم. این اکانت ها به ایمیل شما ارسال شدند.",
                Email: "ایمیل"
            },
            ACTIVATION: {
                activateAccount: "فعال کردن اکانت",
                activateAnaPlay: "اکانت را فعال نمایید و بازی کنید",
                ActivationCode: "کد فعال سازی",
                IDidNotReceiveAnEmail: "ایمیلی دریافت نکردم",
                UnknownOrInvalidGameWorld: "جهان بازی شناخته شده نیست",
                weHaveSentAnEmailContainingActivationCode: "ما ایمیلی که حاوی لینک فعال‌سازی است را به آدرس ایمیل واردشده ارسال کردیم. از این لینک برای فعال کردن اکانت خود در سرور {{gameWorld}} و تعیین رمز عبور استفاده نمایید.",
                couldNotProcessActivationCode: "فادر به پردازش کد فعال سازی نبودیم. ممکن است کد قبلا استفاده شده باشد.",
                WeveRecievedYourActivationKey: "ما رمز فعال‌سازی‌تان را از طریق لینکی که در ایمیل روی آن کلیک کردید دریافت نمودیم. اکنون می‌توانید اکانت تان را در سرور {{gameworld}} فعال کنید. لطفاً رمز عبورتان را تعیین کنید."
            },
            NO_MAIL: {
                activationMail: "ایمیل فعال‌سازی",
                UnknownOrInvalidGameWorld: "جهان بازی شناخته شده نیست",
                ResendEmail: "ارسال مجدد ایمیل",
                email: "ایمیل",
                ReEnterYourMail: "آدرس ایمیل‌تان را دوباره وارد کنید تا ایمیل فعال‌سازی را مجدداً برایتان ارسال نماییم.",
                weHaveSentAnEmail: "ما ایمیلی که حاوی لینک فعال‌سازی است را مجدداً به آدرس ایمیل واردشده ارسال کردیم. از این لینک برای فعال کردن اکانت خود و تعیین رمز عبور استفاده نمایید."
            },
            REGISTER: {
                THERE_ARE_NO_GAME_WORLDS_FOR_REGISTRATION: "جهان بازی برای ثبت نام یافت نشد.",
                registerToPlay: "برای بازی کردن ثبت نام کنید",
                selectGameWorld: "سرور را انتخاب کنید",
                changeGameWorld: "تغییر سرور",
                registerNow: "هم اکنون ثبت نام کنید",
                IAlreadyHaveAnAccount: "من از قبل اکانت دارم",
                recommendedGameWorld: "سرور پیشنهادی",
                otherGameWorlds: "سایر سرورها",
                Username: "نام کاربری",
                Password: "رمز عبور",
                Email: "ایمیل",
                PlayerInvitedYou: "{{player}} شما را دعوت کرده که در این سرور بازی کنید. برای تغییر آن به هر شکل، روی آن دوباره کلیک کنید.",
                PlayerInvitedYouToTravian: "{{player}} شما را دعوت کرده که در تراوین نسخه اسطوره ها بازی کنید",
                RegistrationKey: "کد ثبت نام",
                IAgreeToTermsAndConditionsAndPrivacyPolicy: '<span>من با <a target="_blank" class="inline" title="شرایط و ضوابط" href="https://www.travian.ir/ir/terms">شرایط و ضوابط</a> و <a href="//agb.traviangames.com/privacy-fa.pdf" target="_blank" class="inline" title="سیاست حفظ حریم خصوصی">سیاست حفظ حریم خصوصی</a> موافقت می&zwnj;کنم</span>',
                "Subscribe to newsletter": "دریافت اشتراک برای خبرنامه",
                alreadyRegistered: "قبلا ثبت نام کرده اید؟ برای ادامه فرایند فعال سازی اینجا کلیک کنید."
            },
            SERVER_AGE: "عمر جهان بازی",
            "Loading...": "درحال بارگزاری...",
            NO_MORE_SERVERS: "جهان بازی دیگری در دسترس نیست.",
            SERVER_START_TIME: {
                INSTANT_FINISH_TRAINING: "اتمام فوری تربیت لشکریان",
                SERVER_WILL_START_AT: "شروع سرور در {{date}} ساعت {{time}}",
                SERVER_WAS_STARTED_X_UNIT_AGO: "{{value}} {{unit}}",
                UNIT_SECONDS: "ثانیه",
                UNIT_HOURS: "ساعت",
                UNIT_DAYS: "روز",
                UNIT_MINUTES: "دقیقه",
                GAME_WORLD_FINISHED: "پایان یافته"
            }
        }
    },
    "./src/frontend/scss/base/base.scss": function(e, t) {},
    "./src/frontend/scss/base/typography.scss": function(e, t) {},
    "./src/frontend/static recursive ^\\.\\/.*\\.svg$": function(e, t, n) {
        function a(e) {
            return n(r(e))
        }

        function r(e) {
            var t = o[e];
            if (!(t + 1)) throw new Error("Cannot find module '" + e + "'.");
            return t
        }

        var o = {
            "./clock.svg": "./src/frontend/static/clock.svg",
            "./magnifier.svg": "./src/frontend/static/magnifier.svg"
        };
        a.keys = function() {
            return Object.keys(o)
        }, a.resolve = r, e.exports = a, a.id = "./src/frontend/static recursive ^\\.\\/.*\\.svg$"
    },
    "./src/frontend/static/Travian-Amulett.jpg": function(e, t, n) {
        e.exports = n.p + "./dist/634fb7f970e9d81e753b5116efc297ff.jpg"
    },
    "./src/frontend/static/clock.svg": function(e, t) {
        e.exports = '<svg class="clock" viewBox="0 0 74 74"><circle cx="37" cy="37" r="33"></circle><path d="M33.67 13v27.33h26"></path></svg>'
    },
    "./src/frontend/static/comingSoon.png": function(e, t, n) {
        e.exports = n.p + "./dist/14b391ee33be91f967b7ca9e1d5d94cf.png"
    },
    "./src/frontend/static/framedIllu_anvil_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/f4e4eac93d1f7ca81422ead7e90c7563.png"
    },
    "./src/frontend/static/framedIllu_anvil_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/1081fb464af54e080bb78425c25c0b71.png"
    },
    "./src/frontend/static/framedIllu_boots_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/d27e346c6320cb9974d96c497225ae80.png"
    },
    "./src/frontend/static/framedIllu_boots_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/06ed8d53fb66c3b066caf394d835d578.png"
    },
    "./src/frontend/static/framedIllu_cart_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/f19e7efad201c25d5dda4cea8bbb6998.png"
    },
    "./src/frontend/static/framedIllu_cart_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/8f84bd8de102664b525e82883e60b303.png"
    },
    "./src/frontend/static/framedIllu_statue_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/5296ecf68138ca8c856734019c184119.png"
    },
    "./src/frontend/static/framedIllu_statue_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/abcd775efdfdfd52ff1623ea6494d0de.png"
    },
    "./src/frontend/static/framedIllu_weapons_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/1d76976be78b3d43c8b5fcbf76f9839b.png"
    },
    "./src/frontend/static/framedIllu_weapons_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/d38383467ee21054114e8cfa587a3bdb.png"
    },
    "./src/frontend/static/framedIllu_wonderOfTheWorld_1x.png": function(e, t, n) {
        e.exports = n.p + "./dist/17bc63758d9c445ff28cb93738070251.png"
    },
    "./src/frontend/static/framedIllu_wonderOfTheWorld_2x.png": function(e, t, n) {
        e.exports = n.p + "./dist/5708cd4551a125149e789af7256ab294.png"
    },
    "./src/frontend/static/magnifier.svg": function(e, t) {
        e.exports = '<svg class="magnifier" viewBox="0 0 20 20"><path d="M19.688 16.839l-.12-.121-4.808-4.808c.668-1.151 1.056-2.485 1.065-3.911.029-4.365-3.487-7.926-7.852-7.953h-.052C3.581.046.048 3.551.02 7.898c-.028 4.365 3.488 7.926 7.852 7.954h.052c1.45 0 2.81-.393 3.979-1.077l4.804 4.804.121.12c.363.363.952.363 1.315 0l1.545-1.545c.363-.363.363-.952 0-1.315zM7.919 12.847c-2.7-.017-4.883-2.228-4.866-4.929.017-2.683 2.214-4.866 4.896-4.866h.033c1.308.009 2.534.526 3.453 1.457.92.93 1.421 2.164 1.413 3.472-.009 1.302-.522 2.525-1.446 3.443-.924.918-2.149 1.423-3.451 1.423h-.032z"></path></svg>'
    },
    "./src/main.ts": function(e, t, n) {
        "use strict";
        Object.defineProperty(t, "__esModule", { value: !0 });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@angular/platform-browser-dynamic/esm5/platform-browser-dynamic.js"),
            o = n("./src/app/app.module.ts");
        n("./src/environments/environment.ts").a.production && Object(a.enableProdMode)(), Object(r.a)().bootstrapModule(o.a, { preserveWhitespaces: !1 }).catch(function(e) {
            return console.log(e)
        })
    },
    "./src/recaptcha/recaptcha-common.module.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return s
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/recaptcha/recaptcha.component.ts"),
            o = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            s = function() {
                function e() {}

                return e = o([Object(a.NgModule)({ declarations: [r.a], exports: [r.a] })], e)
            }()
    },
    "./src/recaptcha/recaptcha-forms.module.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return c
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@angular/forms/esm5/forms.js"),
            o = n("./src/recaptcha/recaptcha-common.module.ts"),
            s = n("./src/recaptcha/recaptcha-value-accessor.directive.ts"),
            i = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            c = function() {
                function e() {}

                return e = i([Object(a.NgModule)({ declarations: [s.a], exports: [s.a], imports: [r.c, o.a] })], e)
            }()
    },
    "./src/recaptcha/recaptcha-loader.service.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return p
        });
        var a = n("./node_modules/@angular/common/esm5/common.js"),
            r = n("./node_modules/@angular/core/esm5/core.js"),
            o = (n("./node_modules/rxjs/_esm5/add/observable/of.js"), n("./node_modules/rxjs/_esm5/BehaviorSubject.js")),
            s = n("./node_modules/rxjs/_esm5/Observable.js"),
            i = n("./src/app/_services/locale.service.ts"),
            c = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            l = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            d = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            },
            p = (new r.InjectionToken("recaptcha-language"), function() {
                function e(e, n, r) {
                    this.document = e, this.platformId = n, this.localeService = r, this.language = this.localeService.data.reCaptchaLang, this.init(), this.ready = Object(a.isPlatformBrowser)(this.platformId) ? t.ready.asObservable() : s.a.of()
                }

                return t = e, e.prototype.init = function() {
                    if (!t.ready && Object(a.isPlatformBrowser)(this.platformId)) {
                        window.ng2recaptchaloaded = function() {
                            t.ready.next(grecaptcha)
                        }, t.ready = new o.a(null);
                        var e = document.createElement("script");
                        e.innerHTML = "";
                        var n = this.language ? "&hl=" + this.language : "";
                        e.src = "https://www.google.com/recaptcha/api.js?render=explicit&onload=ng2recaptchaloaded" + n, e.async = !0, e.defer = !0, this.document.head.appendChild(e)
                    }
                }, e = t = c([Object(r.Injectable)(), d(0, Object(r.Inject)(a.DOCUMENT)), d(1, Object(r.Inject)(r.PLATFORM_ID)), l("design:paramtypes", [Object, Object, i.a])], e);
                var t
            }())
    },
    "./src/recaptcha/recaptcha-settings.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return a
        });
        var a = new(n("./node_modules/@angular/core/esm5/core.js").InjectionToken)("recaptcha-settings")
    },
    "./src/recaptcha/recaptcha-value-accessor.directive.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return c
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./node_modules/@angular/forms/esm5/forms.js"),
            o = n("./src/recaptcha/recaptcha.component.ts"),
            s = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            i = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            c = function() {
                function e(e) {
                    this.host = e
                }

                return t = e, e.prototype.writeValue = function(e) {
                    e || this.host.reset()
                }, e.prototype.registerOnChange = function(e) {
                    this.onChange = e
                }, e.prototype.registerOnTouched = function(e) {
                    this.onTouched = e
                }, e.prototype.onResolve = function(e) {
                    this.onChange && this.onChange(e), this.onTouched && this.onTouched()
                }, s([Object(a.HostListener)("resolved", ["$event"]), i("design:type", Function), i("design:paramtypes", [String]), i("design:returntype", void 0)], e.prototype, "onResolve", null), e = t = s([Object(a.Directive)({
                    providers: [{
                        multi: !0,
                        provide: r.d,
                        useExisting: Object(a.forwardRef)(function() {
                            return t
                        })
                    }],
                    selector: "re-captcha[formControlName],re-captcha[formControl],re-captcha[ngModel]"
                }), i("design:paramtypes", [o.a])], e);
                var t
            }()
    },
    "./src/recaptcha/recaptcha.component.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return d
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/recaptcha/recaptcha-loader.service.ts"),
            o = n("./src/recaptcha/recaptcha-settings.ts"),
            s = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            i = this && this.__metadata || function(e, t) {
                if ("object" == typeof Reflect && "function" == typeof Reflect.metadata) return Reflect.metadata(e, t)
            },
            c = this && this.__param || function(e, t) {
                return function(n, a) {
                    t(n, a, e)
                }
            },
            l = 0,
            d = function() {
                function e(e, t, n) {
                    this.loader = e, this.zone = t, this.id = "ngrecaptcha-" + l++, this.resolved = new a.EventEmitter, n && (this.siteKey = n.siteKey, this.theme = n.theme, this.type = n.type, this.size = n.size, this.badge = n.badge)
                }

                return e.prototype.ngAfterViewInit = function() {
                    var e = this;
                    this.subscription = this.loader.ready.subscribe(function(t) {
                        null != t && (e.grecaptcha = t, e.renderRecaptcha())
                    })
                }, e.prototype.ngOnDestroy = function() {
                    this.grecaptchaReset(), this.subscription && this.subscription.unsubscribe()
                }, e.prototype.execute = function() {
                    "invisible" === this.size && null != this.widget && this.grecaptcha.execute(this.widget)
                }, e.prototype.reset = function() {
                    null != this.widget && (this.grecaptcha.getResponse(this.widget) && this.resolved.emit(null), this.grecaptchaReset())
                }, e.prototype.expired = function() {
                    this.resolved.emit(null)
                }, e.prototype.captchaReponseCallback = function(e) {
                    this.resolved.emit(e)
                }, e.prototype.grecaptchaReset = function() {
                    var e = this;
                    null != this.widget && this.zone.runOutsideAngular(function() {
                        return e.grecaptcha.reset(e.widget)
                    })
                }, e.prototype.renderRecaptcha = function() {
                    var e = this;
                    this.widget = this.grecaptcha.render(this.id, {
                        badge: this.badge,
                        callback: function(t) {
                            e.zone.run(function() {
                                return e.captchaReponseCallback(t)
                            })
                        },
                        "expired-callback": function() {
                            e.zone.run(function() {
                                return e.expired()
                            })
                        },
                        sitekey: this.siteKey,
                        size: this.size,
                        tabindex: this.tabIndex,
                        theme: this.theme,
                        type: this.type
                    })
                }, s([Object(a.Input)(), Object(a.HostBinding)("attr.id"), i("design:type", Object)], e.prototype, "id", void 0), s([Object(a.Input)(), i("design:type", String)], e.prototype, "siteKey", void 0), s([Object(a.Input)(), i("design:type", String)], e.prototype, "theme", void 0), s([Object(a.Input)(), i("design:type", String)], e.prototype, "type", void 0), s([Object(a.Input)(), i("design:type", String)], e.prototype, "size", void 0), s([Object(a.Input)(), i("design:type", Number)], e.prototype, "tabIndex", void 0), s([Object(a.Input)(), i("design:type", String)], e.prototype, "badge", void 0), s([Object(a.Output)(), i("design:type", Object)], e.prototype, "resolved", void 0), e = s([Object(a.Component)({
                    exportAs: "reCaptcha",
                    selector: "re-captcha",
                    template: ""
                }), c(2, Object(a.Optional)()), c(2, Object(a.Inject)(o.a)), i("design:paramtypes", [r.a, a.NgZone, Object])], e)
            }()
    },
    "./src/recaptcha/recaptcha.module.ts": function(e, t, n) {
        "use strict";
        n.d(t, "a", function() {
            return c
        });
        var a = n("./node_modules/@angular/core/esm5/core.js"),
            r = n("./src/recaptcha/recaptcha-common.module.ts"),
            o = n("./src/recaptcha/recaptcha-loader.service.ts"),
            s = n("./src/recaptcha/recaptcha.component.ts"),
            i = this && this.__decorate || function(e, t, n, a) {
                var r, o = arguments.length,
                    s = o < 3 ? t : null === a ? a = Object.getOwnPropertyDescriptor(t, n) : a;
                if ("object" == typeof Reflect && "function" == typeof Reflect.decorate) s = Reflect.decorate(e, t, n, a);
                else
                    for (var i = e.length - 1; i >= 0; i--)(r = e[i]) && (s = (o < 3 ? r(s) : o > 3 ? r(t, n, s) : r(t, n)) || s);
                return o > 3 && s && Object.defineProperty(t, n, s), s
            },
            c = function() {
                function e() {}

                return t = e, e.forRoot = function() {
                    return { ngModule: t, providers: [o.a] }
                }, e = t = i([Object(a.NgModule)({ exports: [s.a], imports: [r.a] })], e);
                var t
            }()
    },
    0: function(e, t, n) {
        e.exports = n("./src/main.ts")
    }
}, [0]);