/**
 * Juicebox-Pro 1.3.2
 *
 * Copyright (c) 2013 Juicebox. All rights reserved.
 * http://www.juicebox.net
 *
 * BY USING THIS SOFTWARE, YOU AGREE TO THE JUICEBOX TERMS OF USE
 * http://www.juicebox.net/terms
 *
 * Support and Documentation: http://www.juicebox.net/support
 *
 * Build Time: 05/30/2013 10:15:35 PM
 */
var juicebox_lib = juicebox_lib ? juicebox_lib : {};
(function(aq, ap) {
    var an = aq.document,
        bN = aq.navigator,
        bE = aq.location;
    var al = (function() {
        var bT = function(b4, b3) {
                return new bT.fn.init(b4, b3, E)
            },
            bX = aq.jQuery,
            H = aq.$,
            E, b1 = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,
            bO = /\S/,
            J = /^\s+/,
            F = /\s+$/,
            I = /\d/,
            B = /^<(\w+)\s*\/?>(?:<\/\1>)?$/,
            bP = /^[\],:{}\s]*$/,
            bZ = /\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,
            bR = /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
            K = /(?:^|:|,)(?:\s*\[)+/g,
            z = /(webkit)[ \/]([\w.]+)/,
            bU = /(opera)(?:.*version)?[ \/]([\w.]+)/,
            bS = /(msie) ([\w.]+)/,
            bV = /(mozilla)(?:.*? rv:([\w.]+))?/,
            C = /-([a-z]|[0-9])/ig,
            b2 = /^-ms-/,
            bW = function(b4, b3) {
                return (b3 + "").toUpperCase()
            },
            b0 = bN.userAgent,
            bY, D, e, M = Object.prototype.toString,
            G = Object.prototype.hasOwnProperty,
            A = Array.prototype.push,
            L = Array.prototype.slice,
            bQ = String.prototype.trim,
            w = Array.prototype.indexOf,
            y = {};
        bT.fn = bT.prototype = {
            constructor: bT,
            init: function(b4, b3, b9) {
                var b8, b6, b5, b7;
                if (!b4) {
                    return this
                }
                if (b4.nodeType) {
                    this.context = this[0] = b4;
                    this.length = 1;
                    return this
                }
                if (b4 === "body" && !b3 && an.body) {
                    this.context = an;
                    this[0] = an.body;
                    this.selector = b4;
                    this.length = 1;
                    return this
                }
                if (typeof b4 === "string") {
                    if (b4.charAt(0) === "<" && b4.charAt(b4.length - 1) === ">" && b4.length >= 3) {
                        b8 = [null, b4, null]
                    } else {
                        b8 = b1.exec(b4)
                    }
                    if (b8 && (b8[1] || !b3)) {
                        if (b8[1]) {
                            b3 = b3 instanceof bT ? b3[0] : b3;
                            b7 = (b3 ? b3.ownerDocument || b3 : an);
                            b5 = B.exec(b4);
                            if (b5) {
                                if (bT.isPlainObject(b3)) {
                                    b4 = [an.createElement(b5[1])];
                                    bT.fn.attr.call(b4, b3, true)
                                } else {
                                    b4 = [b7.createElement(b5[1])]
                                }
                            } else {
                                b5 = bT.buildFragment([b8[1]], [b7]);
                                b4 = (b5.cacheable ? bT.clone(b5.fragment) : b5.fragment).childNodes
                            }
                            return bT.merge(this, b4)
                        } else {
                            b6 = an.getElementById(b8[2]);
                            if (b6 && b6.parentNode) {
                                if (b6.id !== b8[2]) {
                                    return b9.find(b4)
                                }
                                this.length = 1;
                                this[0] = b6
                            }
                            this.context = an;
                            this.selector = b4;
                            return this
                        }
                    } else {
                        if (!b3 || b3.jquery) {
                            return (b3 || b9).find(b4)
                        } else {
                            return this.constructor(b3).find(b4)
                        }
                    }
                } else {
                    if (bT.isFunction(b4)) {
                        return b9.ready(b4)
                    }
                }
                if (b4.selector !== ap) {
                    this.selector = b4.selector;
                    this.context = b4.context
                }
                return bT.makeArray(b4, this)
            },
            selector: "",
            jquery: "1.7",
            length: 0,
            size: function() {
                return this.length
            },
            toArray: function() {
                return L.call(this, 0)
            },
            get: function(b3) {
                return b3 == null ? this.toArray() : (b3 < 0 ? this[this.length + b3] : this[b3])
            },
            pushStack: function(b4, b3, b6) {
                var b5 = this.constructor();
                if (bT.isArray(b4)) {
                    A.apply(b5, b4)
                } else {
                    bT.merge(b5, b4)
                }
                b5.prevObject = this;
                b5.context = this.context;
                if (b3 === "find") {
                    b5.selector = this.selector + (this.selector ? " " : "") + b6
                } else {
                    if (b3) {
                        b5.selector = this.selector + "." + b3 + "(" + b6 + ")"
                    }
                }
                return b5
            },
            each: function(b4, b3) {
                return bT.each(this, b4, b3)
            },
            ready: function(b3) {
                bT.bindReady();
                D.add(b3);
                return this
            },
            eq: function(b3) {
                return b3 === -1 ? this.slice(b3) : this.slice(b3, +b3 + 1)
            },
            first: function() {
                return this.eq(0)
            },
            last: function() {
                return this.eq(-1)
            },
            slice: function() {
                return this.pushStack(L.apply(this, arguments), "slice", L.call(arguments).join(","))
            },
            map: function(b3) {
                return this.pushStack(bT.map(this, function(b4, b5) {
                    return b3.call(b4, b5, b4)
                }))
            },
            end: function() {
                return this.prevObject || this.constructor(null)
            },
            push: A,
            sort: [].sort,
            splice: [].splice
        };
        bT.fn.init.prototype = bT.fn;
        bT.extend = bT.fn.extend = function() {
            var cb, b5, b3, b4, b9, ca, b8 = arguments[0] || {},
                b7 = 1,
                b6 = arguments.length,
                cc = false;
            if (typeof b8 === "boolean") {
                cc = b8;
                b8 = arguments[1] || {};
                b7 = 2
            }
            if (typeof b8 !== "object" && !bT.isFunction(b8)) {
                b8 = {}
            }
            if (b6 === b7) {
                b8 = this;
                --b7
            }
            for (; b7 < b6; b7++) {
                if ((cb = arguments[b7]) != null) {
                    for (b5 in cb) {
                        b3 = b8[b5];
                        b4 = cb[b5];
                        if (b8 === b4) {
                            continue
                        }
                        if (cc && b4 && (bT.isPlainObject(b4) || (b9 = bT.isArray(b4)))) {
                            if (b9) {
                                b9 = false;
                                ca = b3 && bT.isArray(b3) ? b3 : []
                            } else {
                                ca = b3 && bT.isPlainObject(b3) ? b3 : {}
                            }
                            b8[b5] = bT.extend(cc, ca, b4)
                        } else {
                            if (b4 !== ap) {
                                b8[b5] = b4
                            }
                        }
                    }
                }
            }
            return b8
        };
        bT.extend({
            noConflict: function(b3) {
                if (aq.$ === bT) {
                    aq.$ = H
                }
                if (b3 && aq.jQuery === bT) {
                    aq.jQuery = bX
                }
                return bT
            },
            isReady: false,
            readyWait: 1,
            holdReady: function(b3) {
                if (b3) {
                    bT.readyWait++
                } else {
                    bT.ready(true)
                }
            },
            ready: function(b3) {
                if ((b3 === true && !--bT.readyWait) || (b3 !== true && !bT.isReady)) {
                    if (!an.body) {
                        return setTimeout(bT.ready, 1)
                    }
                    bT.isReady = true;
                    if (b3 !== true && --bT.readyWait > 0) {
                        return
                    }
                    D.fireWith(an, [bT]);
                    if (bT.fn.trigger) {
                        bT(an).trigger("ready").unbind("ready")
                    }
                }
            },
            bindReady: function() {
                if (D) {
                    return
                }
                D = bT.Callbacks("once memory");
                if (an.readyState === "complete") {
                    return setTimeout(bT.ready, 1)
                }
                if (an.addEventListener) {
                    an.addEventListener("DOMContentLoaded", e, false);
                    aq.addEventListener("load", bT.ready, false)
                } else {
                    if (an.attachEvent) {
                        an.attachEvent("onreadystatechange", e);
                        aq.attachEvent("onload", bT.ready);
                        var b3 = false;
                        try {
                            b3 = aq.frameElement == null
                        } catch (b4) {}
                        if (an.documentElement.doScroll && b3) {
                            x()
                        }
                    }
                }
            },
            isFunction: function(b3) {
                return bT.type(b3) === "function"
            },
            isArray: Array.isArray || function(b3) {
                return bT.type(b3) === "array"
            },
            isWindow: function(b3) {
                return b3 && typeof b3 === "object" && "setInterval" in b3
            },
            isNumeric: function(b3) {
                return b3 != null && I.test(b3) && !isNaN(b3)
            },
            type: function(b3) {
                return b3 == null ? String(b3) : y[M.call(b3)] || "object"
            },
            isPlainObject: function(b4) {
                if (!b4 || bT.type(b4) !== "object" || b4.nodeType || bT.isWindow(b4)) {
                    return false
                }
                try {
                    if (b4.constructor && !G.call(b4, "constructor") && !G.call(b4.constructor.prototype, "isPrototypeOf")) {
                        return false
                    }
                } catch (b5) {
                    return false
                }
                var b3;
                for (b3 in b4) {}
                return b3 === ap || G.call(b4, b3)
            },
            isEmptyObject: function(b4) {
                for (var b3 in b4) {
                    return false
                }
                return true
            },
            error: function(b3) {
                throw b3
            },
            parseJSON: function(b3) {
                if (typeof b3 !== "string" || !b3) {
                    return null
                }
                b3 = bT.trim(b3);
                if (aq.JSON && aq.JSON.parse) {
                    return aq.JSON.parse(b3)
                }
                if (bP.test(b3.replace(bZ, "@").replace(bR, "]").replace(K, ""))) {
                    return (new Function("return " + b3))()
                }
                bT.error("Invalid JSON: " + b3)
            },
            parseXML: function(b4) {
                var b3, b5;
                try {
                    if (aq.DOMParser) {
                        b5 = new DOMParser();
                        b3 = b5.parseFromString(b4, "text/xml")
                    } else {
                        b3 = new ActiveXObject("Microsoft.XMLDOM");
                        b3.async = "false";
                        b3.loadXML(b4)
                    }
                } catch (b6) {
                    b3 = ap
                }
                if (!b3 || !b3.documentElement || b3.getElementsByTagName("parsererror").length) {
                    bT.error("Invalid XML: " + b4)
                }
                return b3
            },
            noop: function() {},
            globalEval: function(b3) {
                if (b3 && bO.test(b3)) {
                    (aq.execScript || function(b4) {
                        aq["eval"].call(aq, b4)
                    })(b3)
                }
            },
            camelCase: function(b3) {
                return b3.replace(b2, "ms-").replace(C, bW)
            },
            nodeName: function(b4, b3) {
                return b4.nodeName && b4.nodeName.toUpperCase() === b3.toUpperCase()
            },
            each: function(b4, b3, b9) {
                var b8, b6 = 0,
                    b7 = b4.length,
                    b5 = b7 === ap || bT.isFunction(b4);
                if (b9) {
                    if (b5) {
                        for (b8 in b4) {
                            if (b3.apply(b4[b8], b9) === false) {
                                break
                            }
                        }
                    } else {
                        for (; b6 < b7;) {
                            if (b3.apply(b4[b6++], b9) === false) {
                                break
                            }
                        }
                    }
                } else {
                    if (b5) {
                        for (b8 in b4) {
                            if (b3.call(b4[b8], b8, b4[b8]) === false) {
                                break
                            }
                        }
                    } else {
                        for (; b6 < b7;) {
                            if (b3.call(b4[b6], b6, b4[b6++]) === false) {
                                break
                            }
                        }
                    }
                }
                return b4
            },
            trim: bQ ? function(b3) {
                return b3 == null ? "" : bQ.call(b3)
            } : function(b3) {
                return b3 == null ? "" : b3.toString().replace(J, "").replace(F, "")
            },
            makeArray: function(b4, b3) {
                var b6 = b3 || [];
                if (b4 != null) {
                    var b5 = bT.type(b4);
                    if (b4.length == null || b5 === "string" || b5 === "function" || b5 === "regexp" || bT.isWindow(b4)) {
                        A.call(b6, b4)
                    } else {
                        bT.merge(b6, b4)
                    }
                }
                return b6
            },
            inArray: function(b4, b3, b5) {
                var b6;
                if (b3) {
                    if (w) {
                        return w.call(b3, b4, b5)
                    }
                    b6 = b3.length;
                    b5 = b5 ? b5 < 0 ? Math.max(0, b6 + b5) : b5 : 0;
                    for (; b5 < b6; b5++) {
                        if (b5 in b3 && b3[b5] === b4) {
                            return b5
                        }
                    }
                }
                return -1
            },
            merge: function(b5, b3) {
                var b7 = b5.length,
                    b6 = 0;
                if (typeof b3.length === "number") {
                    for (var b4 = b3.length; b6 < b4; b6++) {
                        b5[b7++] = b3[b6]
                    }
                } else {
                    while (b3[b6] !== ap) {
                        b5[b7++] = b3[b6++]
                    }
                }
                b5.length = b7;
                return b5
            },
            grep: function(b4, b3, b9) {
                var b8 = [],
                    b7;
                b9 = !!b9;
                for (var b5 = 0, b6 = b4.length; b5 < b6; b5++) {
                    b7 = !!b3(b4[b5], b5);
                    if (b9 !== b7) {
                        b8.push(b4[b5])
                    }
                }
                return b8
            },
            map: function(ca, b9, b8) {
                var b7, cb, b6 = [],
                    b4 = 0,
                    b3 = ca.length,
                    b5 = ca instanceof bT || b3 !== ap && typeof b3 === "number" && ((b3 > 0 && ca[0] && ca[b3 - 1]) || b3 === 0 || bT.isArray(ca));
                if (b5) {
                    for (; b4 < b3; b4++) {
                        b7 = b9(ca[b4], b4, b8);
                        if (b7 != null) {
                            b6[b6.length] = b7
                        }
                    }
                } else {
                    for (cb in ca) {
                        b7 = b9(ca[cb], cb, b8);
                        if (b7 != null) {
                            b6[b6.length] = b7
                        }
                    }
                }
                return b6.concat.apply([], b6)
            },
            guid: 1,
            proxy: function(b4, b3) {
                if (typeof b3 === "string") {
                    var b7 = b4[b3];
                    b3 = b4;
                    b4 = b7
                }
                if (!bT.isFunction(b4)) {
                    return ap
                }
                var b6 = L.call(arguments, 2),
                    b5 = function() {
                        return b4.apply(b3, b6.concat(L.call(arguments)))
                    };
                b5.guid = b4.guid = b4.guid || b5.guid || bT.guid++;
                return b5
            },
            access: function(cb, ca, b9, b8, b7, b6) {
                var b5 = cb.length;
                if (typeof ca === "object") {
                    for (var b3 in ca) {
                        bT.access(cb, b3, ca[b3], b8, b7, b9)
                    }
                    return cb
                }
                if (b9 !== ap) {
                    b8 = !b6 && b8 && bT.isFunction(b9);
                    for (var b4 = 0; b4 < b5; b4++) {
                        b7(cb[b4], ca, b8 ? b9.call(cb[b4], b4, b7(cb[b4], ca)) : b9, b6)
                    }
                    return cb
                }
                return b5 ? b7(cb[0], ca) : ap
            },
            now: function() {
                return (new Date()).getTime()
            },
            uaMatch: function(b4) {
                b4 = b4.toLowerCase();
                var b3 = z.exec(b4) || bU.exec(b4) || bS.exec(b4) || b4.indexOf("compatible") < 0 && bV.exec(b4) || [];
                return {
                    browser: b3[1] || "",
                    version: b3[2] || "0"
                }
            },
            sub: function() {
                function b3(b7, b6) {
                    return new b3.fn.init(b7, b6)
                }
                bT.extend(true, b3, this);
                b3.superclass = this;
                b3.fn = b3.prototype = this();
                b3.fn.constructor = b3;
                b3.sub = this.sub;
                b3.fn.init = function b4(b7, b6) {
                    if (b6 && b6 instanceof bT && !(b6 instanceof b3)) {
                        b6 = b3(b6)
                    }
                    return bT.fn.init.call(this, b7, b6, b5)
                };
                b3.fn.init.prototype = b3.fn;
                var b5 = b3(an);
                return b3
            },
            browser: {}
        });
        bT.each("Boolean Number String Function Array Date RegExp Object".split(" "), function(b4, b3) {
            y["[object " + b3 + "]"] = b3.toLowerCase()
        });
        bY = bT.uaMatch(b0);
        if (bY.browser) {
            bT.browser[bY.browser] = true;
            bT.browser.version = bY.version
        }
        if (bT.browser.webkit) {
            bT.browser.safari = true
        }
        if (bO.test("\xA0")) {
            J = /^[\s\xA0]+/;
            F = /[\s\xA0]+$/
        }
        E = bT(an);
        if (an.addEventListener) {
            e = function() {
                an.removeEventListener("DOMContentLoaded", e, false);
                bT.ready()
            }
        } else {
            if (an.attachEvent) {
                e = function() {
                    if (an.readyState === "complete") {
                        an.detachEvent("onreadystatechange", e);
                        bT.ready()
                    }
                }
            }
        }

        function x() {
            if (bT.isReady) {
                return
            }
            try {
                an.documentElement.doScroll("left")
            } catch (b3) {
                setTimeout(x, 1);
                return
            }
            bT.ready()
        }
        if (typeof define === "function" && define.amd && define.amd.jQuery) {
            define("jquery", [], function() {
                return bT
            })
        }
        return bT
    })();
    var bc = {};

    function ai(w) {
        var e = bc[w] = {},
            x, y;
        w = w.split(/\s+/);
        for (x = 0, y = w.length; x < y; x++) {
            e[w[x]] = true
        }
        return e
    }
    al.Callbacks = function(C) {
        C = C ? (bc[C] || ai(C)) : {};
        var B = [],
            D = [],
            x, y, w, z, A, F = function(G) {
                var H, K, J, I, L;
                for (H = 0, K = G.length; H < K; H++) {
                    J = G[H];
                    I = al.type(J);
                    if (I === "array") {
                        F(J)
                    } else {
                        if (I === "function") {
                            if (!C.unique || !E.has(J)) {
                                B.push(J)
                            }
                        }
                    }
                }
            },
            e = function(H, G) {
                G = G || [];
                x = !C.memory || [H, G];
                y = true;
                A = w || 0;
                w = 0;
                z = B.length;
                for (; B && A < z; A++) {
                    if (B[A].apply(H, G) === false && C.stopOnFalse) {
                        x = true;
                        break
                    }
                }
                y = false;
                if (B) {
                    if (!C.once) {
                        if (D && D.length) {
                            x = D.shift();
                            E.fireWith(x[0], x[1])
                        }
                    } else {
                        if (x === true) {
                            E.disable()
                        } else {
                            B = []
                        }
                    }
                }
            },
            E = {
                add: function() {
                    if (B) {
                        var G = B.length;
                        F(arguments);
                        if (y) {
                            z = B.length
                        } else {
                            if (x && x !== true) {
                                w = G;
                                e(x[0], x[1])
                            }
                        }
                    }
                    return this
                },
                remove: function() {
                    if (B) {
                        var G = arguments,
                            I = 0,
                            J = G.length;
                        for (; I < J; I++) {
                            for (var H = 0; H < B.length; H++) {
                                if (G[I] === B[H]) {
                                    if (y) {
                                        if (H <= z) {
                                            z--;
                                            if (H <= A) {
                                                A--
                                            }
                                        }
                                    }
                                    B.splice(H--, 1);
                                    if (C.unique) {
                                        break
                                    }
                                }
                            }
                        }
                    }
                    return this
                },
                has: function(G) {
                    if (B) {
                        var H = 0,
                            I = B.length;
                        for (; H < I; H++) {
                            if (G === B[H]) {
                                return true
                            }
                        }
                    }
                    return false
                },
                empty: function() {
                    B = [];
                    return this
                },
                disable: function() {
                    B = D = x = ap;
                    return this
                },
                disabled: function() {
                    return !B
                },
                lock: function() {
                    D = ap;
                    if (!x || x === true) {
                        E.disable()
                    }
                    return this
                },
                locked: function() {
                    return !D
                },
                fireWith: function(H, G) {
                    if (D) {
                        if (y) {
                            if (!C.once) {
                                D.push([H, G])
                            }
                        } else {
                            if (!(C.once && x)) {
                                e(H, G)
                            }
                        }
                    }
                    return this
                },
                fire: function() {
                    E.fireWith(this, arguments);
                    return this
                },
                fired: function() {
                    return !!x
                }
            };
        return E
    };
    var bb = [].slice;
    al.extend({
        Deferred: function(z) {
            var y = al.Callbacks("once memory"),
                x = al.Callbacks("once memory"),
                w = al.Callbacks("memory"),
                e = "pending",
                B = {
                    resolve: y,
                    reject: x,
                    notify: w
                },
                D = {
                    done: y.add,
                    fail: x.add,
                    progress: w.add,
                    state: function() {
                        return e
                    },
                    isResolved: y.fired,
                    isRejected: x.fired,
                    then: function(F, E, G) {
                        C.done(F).fail(E).progress(G);
                        return this
                    },
                    always: function() {
                        return C.done.apply(C, arguments).fail.apply(C, arguments)
                    },
                    pipe: function(G, F, E) {
                        return al.Deferred(function(H) {
                            al.each({
                                done: [G, "resolve"],
                                fail: [F, "reject"],
                                progress: [E, "notify"]
                            }, function(J, I) {
                                var M = I[0],
                                    L = I[1],
                                    K;
                                if (al.isFunction(M)) {
                                    C[J](function() {
                                        K = M.apply(this, arguments);
                                        if (K && al.isFunction(K.promise)) {
                                            K.promise().then(H.resolve, H.reject, H.notify)
                                        } else {
                                            H[L + "With"](this === C ? H : this, [K])
                                        }
                                    })
                                } else {
                                    C[J](H[L])
                                }
                            })
                        }).promise()
                    },
                    promise: function(F) {
                        if (F == null) {
                            F = D
                        } else {
                            for (var E in D) {
                                F[E] = D[E]
                            }
                        }
                        return F
                    }
                },
                C = D.promise({}),
                A;
            for (A in B) {
                C[A] = B[A].fire;
                C[A + "With"] = B[A].fireWith
            }
            C.done(function() {
                e = "resolved"
            }, x.disable, w.lock).fail(function() {
                e = "rejected"
            }, y.disable, w.lock);
            if (z) {
                z.call(C, C)
            }
            return C
        },
        when: function(B) {
            var y = bb.call(arguments, 0),
                w = 0,
                e = y.length,
                C = new Array(e),
                x = e,
                z = e,
                D = e <= 1 && B && al.isFunction(B.promise) ? B : al.Deferred(),
                F = D.promise();

            function E(G) {
                return function(H) {
                    y[G] = arguments.length > 1 ? bb.call(arguments, 0) : H;
                    if (!(--x)) {
                        D.resolveWith(D, y)
                    }
                }
            }

            function A(G) {
                return function(H) {
                    C[G] = arguments.length > 1 ? bb.call(arguments, 0) : H;
                    D.notifyWith(F, C)
                }
            }
            if (e > 1) {
                for (; w < e; w++) {
                    if (y[w] && y[w].promise && al.isFunction(y[w].promise)) {
                        y[w].promise().then(E(w), D.reject, A(w))
                    } else {
                        --x
                    }
                }
                if (!x) {
                    D.resolveWith(D, y)
                }
            } else {
                if (D !== B) {
                    D.resolveWith(D, e ? [B] : [])
                }
            }
            return F
        }
    });
    al.support = (function() {
        var M = an.createElement("div"),
            bO = an.documentElement,
            z, bP, G, x, F, A, D, w, E, H, C, L, J, y, B, I, bQ;
        M.setAttribute("className", "t");
        M.innerHTML = "   <link/><table></table><a href='/a' style='top:1px;float:left;opacity:.55;'>a</a><input type='checkbox'/><nav></nav>";
        z = M.getElementsByTagName("*");
        bP = M.getElementsByTagName("a")[0];
        if (!z || !z.length || !bP) {
            return {}
        }
        G = an.createElement("select");
        x = G.appendChild(an.createElement("option"));
        F = M.getElementsByTagName("input")[0];
        D = {
            leadingWhitespace: (M.firstChild.nodeType === 3),
            tbody: !M.getElementsByTagName("tbody").length,
            htmlSerialize: !!M.getElementsByTagName("link").length,
            style: /top/.test(bP.getAttribute("style")),
            hrefNormalized: (bP.getAttribute("href") === "/a"),
            opacity: /^0.55/.test(bP.style.opacity),
            cssFloat: !!bP.style.cssFloat,
            unknownElems: !!M.getElementsByTagName("nav").length,
            checkOn: (F.value === "on"),
            optSelected: x.selected,
            getSetAttribute: M.className !== "t",
            enctype: !!an.createElement("form").enctype,
            submitBubbles: true,
            changeBubbles: true,
            focusinBubbles: false,
            deleteExpando: true,
            noCloneEvent: true,
            inlineBlockNeedsLayout: false,
            shrinkWrapBlocks: false,
            reliableMarginRight: true
        };
        F.checked = true;
        D.noCloneChecked = F.cloneNode(true).checked;
        G.disabled = true;
        D.optDisabled = !x.disabled;
        try {
            delete M.test
        } catch (K) {
            D.deleteExpando = false
        }
        if (!M.addEventListener && M.attachEvent && M.fireEvent) {
            M.attachEvent("onclick", function() {
                D.noCloneEvent = false
            });
            M.cloneNode(true).fireEvent("onclick")
        }
        F = an.createElement("input");
        F.value = "t";
        F.setAttribute("type", "radio");
        D.radioValue = F.value === "t";
        F.setAttribute("checked", "checked");
        M.appendChild(F);
        w = an.createDocumentFragment();
        w.appendChild(M.lastChild);
        D.checkClone = w.cloneNode(true).cloneNode(true).lastChild.checked;
        M.innerHTML = "";
        M.style.width = M.style.paddingLeft = "1px";
        E = an.getElementsByTagName("body")[0];
        C = an.createElement(E ? "div" : "body");
        L = {
            visibility: "hidden",
            width: 0,
            height: 0,
            border: 0,
            margin: 0,
            background: "none"
        };
        if (E) {
            al.extend(L, {
                position: "absolute",
                left: "-999px",
                top: "-999px"
            })
        }
        for (I in L) {
            C.style[I] = L[I]
        }
        C.appendChild(M);
        H = E || bO;
        H.insertBefore(C, H.firstChild);
        D.appendChecked = F.checked;
        D.boxModel = M.offsetWidth === 2;
        if ("zoom" in M.style) {
            M.style.display = "inline";
            M.style.zoom = 1;
            D.inlineBlockNeedsLayout = (M.offsetWidth === 2);
            M.style.display = "";
            M.innerHTML = "<div style='width:4px;'></div>";
            D.shrinkWrapBlocks = (M.offsetWidth !== 2)
        }
        M.innerHTML = "<table><tr><td style='padding:0;border:0;display:none'></td><td>t</td></tr></table>";
        J = M.getElementsByTagName("td");
        bQ = (J[0].offsetHeight === 0);
        J[0].style.display = "";
        J[1].style.display = "none";
        D.reliableHiddenOffsets = bQ && (J[0].offsetHeight === 0);
        M.innerHTML = "";
        if (an.defaultView && an.defaultView.getComputedStyle) {
            A = an.createElement("div");
            A.style.width = "0";
            A.style.marginRight = "0";
            M.appendChild(A);
            D.reliableMarginRight = (parseInt((an.defaultView.getComputedStyle(A, null) || {
                marginRight: 0
            }).marginRight, 10) || 0) === 0
        }
        if (M.attachEvent) {
            for (I in {
                    submit: 1,
                    change: 1,
                    focusin: 1
                }) {
                B = "on" + I;
                bQ = (B in M);
                if (!bQ) {
                    M.setAttribute(B, "return;");
                    bQ = (typeof M[B] === "function")
                }
                D[I + "Bubbles"] = bQ
            }
        }
        al(function() {
            var bX, bZ, b0, bY, bS, bT, bR = 1,
                bW = "position:absolute;top:0;left:0;width:1px;height:1px;margin:0;",
                bV = "visibility:hidden;border:0;",
                e = "style='" + bW + "border:5px solid #000;padding:0;'",
                bU = "<div " + e + "><div></div></div><table " + e + " cellpadding='0' cellspacing='0'><tr><td></td></tr></table>";
            E = an.getElementsByTagName("body")[0];
            if (!E) {
                return
            }
            bX = an.createElement("div");
            bX.style.cssText = bV + "width:0;height:0;position:static;top:0;margin-top:" + bR + "px";
            E.insertBefore(bX, E.firstChild);
            C = an.createElement("div");
            C.style.cssText = bW + bV;
            C.innerHTML = bU;
            bX.appendChild(C);
            bZ = C.firstChild;
            b0 = bZ.firstChild;
            bS = bZ.nextSibling.firstChild.firstChild;
            bT = {
                doesNotAddBorder: (b0.offsetTop !== 5),
                doesAddBorderForTableAndCells: (bS.offsetTop === 5)
            };
            b0.style.position = "fixed";
            b0.style.top = "20px";
            bT.fixedPosition = (b0.offsetTop === 20 || b0.offsetTop === 15);
            b0.style.position = b0.style.top = "";
            bZ.style.overflow = "hidden";
            bZ.style.position = "relative";
            bT.subtractsBorderForOverflowNotVisible = (b0.offsetTop === -5);
            bT.doesNotIncludeMarginInBodyOffset = (E.offsetTop !== bR);
            E.removeChild(bX);
            C = bX = null;
            al.extend(D, bT)
        });
        C.innerHTML = "";
        H.removeChild(C);
        C = w = G = x = E = A = M = F = null;
        return D
    })();
    al.boxModel = al.support.boxModel;
    var a9 = /^(?:\{.*\}|\[.*\])$/,
        aL = /([A-Z])/g;
    al.extend({
        cache: {},
        uuid: 0,
        expando: "jQuery" + (al.fn.jquery + Math.random()).replace(/\D/g, ""),
        noData: {
            embed: true,
            object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
            applet: true
        },
        hasData: function(e) {
            e = e.nodeType ? al.cache[e[al.expando]] : e[al.expando];
            return !!e && !af(e)
        },
        data: function(H, F, E, D) {
            if (!al.acceptData(H)) {
                return
            }
            var B, y, C, G = al.expando,
                A = typeof F === "string",
                I = H.nodeType,
                w = I ? al.cache : H,
                x = I ? H[al.expando] : H[al.expando] && al.expando,
                z = F === "events";
            if ((!x || !w[x] || (!z && !D && !w[x].data)) && A && E === ap) {
                return
            }
            if (!x) {
                if (I) {
                    H[al.expando] = x = ++al.uuid
                } else {
                    x = al.expando
                }
            }
            if (!w[x]) {
                w[x] = {};
                if (!I) {
                    w[x].toJSON = al.noop
                }
            }
            if (typeof F === "object" || typeof F === "function") {
                if (D) {
                    w[x] = al.extend(w[x], F)
                } else {
                    w[x].data = al.extend(w[x].data, F)
                }
            }
            B = y = w[x];
            if (!D) {
                if (!y.data) {
                    y.data = {}
                }
                y = y.data
            }
            if (E !== ap) {
                y[al.camelCase(F)] = E
            }
            if (z && !y[F]) {
                return B.events
            }
            if (A) {
                C = y[F];
                if (C == null) {
                    C = y[al.camelCase(F)]
                }
            } else {
                C = y
            }
            return C
        },
        removeData: function(D, B, A) {
            if (!al.acceptData(D)) {
                return
            }
            var z, y, x, C = al.expando,
                E = D.nodeType,
                e = E ? al.cache : D,
                w = E ? D[al.expando] : al.expando;
            if (!e[w]) {
                return
            }
            if (B) {
                z = A ? e[w] : e[w].data;
                if (z) {
                    if (al.isArray(B)) {
                        B = B
                    } else {
                        if (B in z) {
                            B = [B]
                        } else {
                            B = al.camelCase(B);
                            if (B in z) {
                                B = [B]
                            } else {
                                B = B.split(" ")
                            }
                        }
                    }
                    for (y = 0, x = B.length; y < x; y++) {
                        delete z[B[y]]
                    }
                    if (!(A ? af : al.isEmptyObject)(z)) {
                        return
                    }
                }
            }
            if (!A) {
                delete e[w].data;
                if (!af(e[w])) {
                    return
                }
            }
            if (al.support.deleteExpando || !e.setInterval) {
                delete e[w]
            } else {
                e[w] = null
            }
            if (E) {
                if (al.support.deleteExpando) {
                    delete D[al.expando]
                } else {
                    if (D.removeAttribute) {
                        D.removeAttribute(al.expando)
                    } else {
                        D[al.expando] = null
                    }
                }
            }
        },
        _data: function(w, e, x) {
            return al.data(w, e, x, true)
        },
        acceptData: function(w) {
            if (w.nodeName) {
                var e = al.noData[w.nodeName.toLowerCase()];
                if (e) {
                    return !(e === true || w.getAttribute("classid") !== e)
                }
            }
            return true
        }
    });
    al.fn.extend({
        data: function(w, C) {
            var B, e, y, A = null;
            if (typeof w === "undefined") {
                if (this.length) {
                    A = al.data(this[0]);
                    if (this[0].nodeType === 1 && !al._data(this[0], "parsedAttrs")) {
                        e = this[0].attributes;
                        for (var z = 0, x = e.length; z < x; z++) {
                            y = e[z].name;
                            if (y.indexOf("data-") === 0) {
                                y = al.camelCase(y.substring(5));
                                bo(this[0], y, A[y])
                            }
                        }
                        al._data(this[0], "parsedAttrs", true)
                    }
                }
                return A
            } else {
                if (typeof w === "object") {
                    return this.each(function() {
                        al.data(this, w)
                    })
                }
            }
            B = w.split(".");
            B[1] = B[1] ? "." + B[1] : "";
            if (C === ap) {
                A = this.triggerHandler("getData" + B[1] + "!", [B[0]]);
                if (A === ap && this.length) {
                    A = al.data(this[0], w);
                    A = bo(this[0], w, A)
                }
                return A === ap && B[1] ? this.data(B[0]) : A
            } else {
                return this.each(function() {
                    var D = al(this),
                        E = [B[0], C];
                    D.triggerHandler("setData" + B[1] + "!", E);
                    al.data(this, w, C);
                    D.triggerHandler("changeData" + B[1] + "!", E)
                })
            }
        },
        removeData: function(e) {
            return this.each(function() {
                al.removeData(this, e)
            })
        }
    });

    function bo(x, w, A) {
        if (A === ap && x.nodeType === 1) {
            var z = "data-" + w.replace(aL, "-$1").toLowerCase();
            A = x.getAttribute(z);
            if (typeof A === "string") {
                try {
                    A = A === "true" ? true : A === "false" ? false : A === "null" ? null : al.isNumeric(A) ? parseFloat(A) : a9.test(A) ? al.parseJSON(A) : A
                } catch (y) {}
                al.data(x, w, A)
            } else {
                A = ap
            }
        }
        return A
    }

    function af(w) {
        for (var e in w) {
            if (e === "data" && al.isEmptyObject(w[e])) {
                continue
            }
            if (e !== "toJSON") {
                return false
            }
        }
        return true
    }

    function bA(y, e, B) {
        var A = e + "defer",
            x = e + "queue",
            w = e + "mark",
            z = al._data(y, A);
        if (z && (B === "queue" || !al._data(y, x)) && (B === "mark" || !al._data(y, w))) {
            setTimeout(function() {
                if (!al._data(y, x) && !al._data(y, w)) {
                    al.removeData(y, A, true);
                    z.fire()
                }
            }, 0)
        }
    }
    al.extend({
        _mark: function(w, e) {
            if (w) {
                e = (e || "fx") + "mark";
                al._data(w, e, (al._data(w, e) || 0) + 1)
            }
        },
        _unmark: function(w, e, z) {
            if (w !== true) {
                z = e;
                e = w;
                w = false
            }
            if (e) {
                z = z || "fx";
                var y = z + "mark",
                    x = w ? 0 : ((al._data(e, y) || 1) - 1);
                if (x) {
                    al._data(e, y, x)
                } else {
                    al.removeData(e, y, true);
                    bA(e, z, "mark")
                }
            }
        },
        queue: function(w, e, y) {
            var x;
            if (w) {
                e = (e || "fx") + "queue";
                x = al._data(w, e);
                if (y) {
                    if (!x || al.isArray(y)) {
                        x = al._data(w, e, al.makeArray(y))
                    } else {
                        x.push(y)
                    }
                }
                return x || []
            }
        },
        dequeue: function(x, w) {
            w = w || "fx";
            var z = al.queue(x, w),
                y = z.shift(),
                e = {};
            if (y === "inprogress") {
                y = z.shift()
            }
            if (y) {
                if (w === "fx") {
                    z.unshift("inprogress")
                }
                al._data(x, w + ".run", e);
                y.call(x, function() {
                    al.dequeue(x, w)
                }, e)
            }
            if (!z.length) {
                al.removeData(x, w + "queue " + w + ".run", true);
                bA(x, w, "queue")
            }
        }
    });
    al.fn.extend({
        queue: function(e, w) {
            if (typeof e !== "string") {
                w = e;
                e = "fx"
            }
            if (w === ap) {
                return al.queue(this[0], e)
            }
            return this.each(function() {
                var x = al.queue(this, e, w);
                if (e === "fx" && x[0] !== "inprogress") {
                    al.dequeue(this, e)
                }
            })
        },
        dequeue: function(e) {
            return this.each(function() {
                al.dequeue(this, e)
            })
        },
        delay: function(x, w) {
            x = al.fx ? al.fx.speeds[x] || x : x;
            w = w || "fx";
            return this.queue(w, function(y, e) {
                var z = setTimeout(y, x);
                e.stop = function() {
                    clearTimeout(z)
                }
            })
        },
        clearQueue: function(e) {
            return this.queue(e || "fx", [])
        },
        promise: function(E, D) {
            if (typeof E !== "string") {
                D = E;
                E = ap
            }
            E = E || "fx";
            var C = al.Deferred(),
                e = this,
                x = e.length,
                A = 1,
                y = E + "defer",
                z = E + "queue",
                B = E + "mark",
                w;

            function F() {
                if (!(--A)) {
                    C.resolveWith(e, [e])
                }
            }
            while (x--) {
                if ((w = al.data(e[x], y, ap, true) || (al.data(e[x], z, ap, true) || al.data(e[x], B, ap, true)) && al.data(e[x], y, al.Callbacks("once memory"), true))) {
                    A++;
                    w.add(F)
                }
            }
            F();
            return C.promise()
        }
    });
    var a8 = /[\n\t\r]/g,
        au = /\s+/,
        be = /\r/g,
        f = /^(?:button|input)$/i,
        R = /^(?:button|input|object|select|textarea)$/i,
        j = /^a(?:rea)?$/i,
        aB = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
        T = al.support.getSetAttribute,
        bw, bi, aP;
    al.fn.extend({
        attr: function(w, e) {
            return al.access(this, w, e, true, al.attr)
        },
        removeAttr: function(e) {
            return this.each(function() {
                al.removeAttr(this, e)
            })
        },
        prop: function(w, e) {
            return al.access(this, w, e, true, al.prop)
        },
        removeProp: function(e) {
            e = al.propFix[e] || e;
            return this.each(function() {
                try {
                    this[e] = ap;
                    delete this[e]
                } catch (w) {}
            })
        },
        addClass: function(y) {
            var e, z, x, A, B, C, w;
            if (al.isFunction(y)) {
                return this.each(function(D) {
                    al(this).addClass(y.call(this, D, this.className))
                })
            }
            if (y && typeof y === "string") {
                e = y.split(au);
                for (z = 0, x = this.length; z < x; z++) {
                    A = this[z];
                    if (A.nodeType === 1) {
                        if (!A.className && e.length === 1) {
                            A.className = y
                        } else {
                            B = " " + A.className + " ";
                            for (C = 0, w = e.length; C < w; C++) {
                                if (!~B.indexOf(" " + e[C] + " ")) {
                                    B += e[C] + " "
                                }
                            }
                            A.className = al.trim(B)
                        }
                    }
                }
            }
            return this
        },
        removeClass: function(y) {
            var e, z, x, B, A, C, w;
            if (al.isFunction(y)) {
                return this.each(function(D) {
                    al(this).removeClass(y.call(this, D, this.className))
                })
            }
            if ((y && typeof y === "string") || y === ap) {
                e = (y || "").split(au);
                for (z = 0, x = this.length; z < x; z++) {
                    B = this[z];
                    if (B.nodeType === 1 && B.className) {
                        if (y) {
                            A = (" " + B.className + " ").replace(a8, " ");
                            for (C = 0, w = e.length; C < w; C++) {
                                A = A.replace(" " + e[C] + " ", " ")
                            }
                            B.className = al.trim(A)
                        } else {
                            B.className = ""
                        }
                    }
                }
            }
            return this
        },
        toggleClass: function(e, y) {
            var x = typeof e,
                w = typeof y === "boolean";
            if (al.isFunction(e)) {
                return this.each(function(z) {
                    al(this).toggleClass(e.call(this, z, this.className, y), y)
                })
            }
            return this.each(function() {
                if (x === "string") {
                    var z, B = 0,
                        A = al(this),
                        C = y,
                        D = e.split(au);
                    while ((z = D[B++])) {
                        C = w ? C : !A.hasClass(z);
                        A[C ? "addClass" : "removeClass"](z)
                    }
                } else {
                    if (x === "undefined" || x === "boolean") {
                        if (this.className) {
                            al._data(this, "__className__", this.className)
                        }
                        this.className = this.className || e === false ? "" : al._data(this, "__className__") || ""
                    }
                }
            })
        },
        hasClass: function(x) {
            var e = " " + x + " ",
                y = 0,
                w = this.length;
            for (; y < w; y++) {
                if (this[y].nodeType === 1 && (" " + this[y].className + " ").replace(a8, " ").indexOf(e) > -1) {
                    return true
                }
            }
            return false
        },
        val: function(z) {
            var y, e, x, w = this[0];
            if (!arguments.length) {
                if (w) {
                    y = al.valHooks[w.nodeName.toLowerCase()] || al.valHooks[w.type];
                    if (y && "get" in y && (e = y.get(w, "value")) !== ap) {
                        return e
                    }
                    e = w.value;
                    return typeof e === "string" ? e.replace(be, "") : e == null ? "" : e
                }
                return ap
            }
            x = al.isFunction(z);
            return this.each(function(B) {
                var A = al(this),
                    C;
                if (this.nodeType !== 1) {
                    return
                }
                if (x) {
                    C = z.call(this, B, A.val())
                } else {
                    C = z
                }
                if (C == null) {
                    C = ""
                } else {
                    if (typeof C === "number") {
                        C += ""
                    } else {
                        if (al.isArray(C)) {
                            C = al.map(C, function(D) {
                                return D == null ? "" : D + ""
                            })
                        }
                    }
                }
                y = al.valHooks[this.nodeName.toLowerCase()] || al.valHooks[this.type];
                if (!y || !("set" in y) || y.set(this, C, "value") === ap) {
                    this.value = C
                }
            })
        }
    });
    al.extend({
        valHooks: {
            option: {
                get: function(w) {
                    var e = w.attributes.value;
                    return !e || e.specified ? w.value : w.text
                }
            },
            select: {
                get: function(B) {
                    var z, e, A, x, y = B.selectedIndex,
                        C = [],
                        D = B.options,
                        w = B.type === "select-one";
                    if (y < 0) {
                        return null
                    }
                    e = w ? y : 0;
                    A = w ? y + 1 : D.length;
                    for (; e < A; e++) {
                        x = D[e];
                        if (x.selected && (al.support.optDisabled ? !x.disabled : x.getAttribute("disabled") === null) && (!x.parentNode.disabled || !al.nodeName(x.parentNode, "optgroup"))) {
                            z = al(x).val();
                            if (w) {
                                return z
                            }
                            C.push(z)
                        }
                    }
                    if (w && !C.length && D.length) {
                        return al(D[y]).val()
                    }
                    return C
                },
                set: function(w, e) {
                    var x = al.makeArray(e);
                    al(w).find("option").each(function() {
                        this.selected = al.inArray(al(this).val(), x) >= 0
                    });
                    if (!x.length) {
                        w.selectedIndex = -1
                    }
                    return x
                }
            }
        },
        attrFn: {
            val: true,
            css: true,
            html: true,
            text: true,
            data: true,
            width: true,
            height: true,
            offset: true
        },
        attr: function(y, x, D, C) {
            var B, w, A, z = y.nodeType;
            if (!y || z === 3 || z === 8 || z === 2) {
                return ap
            }
            if (C && x in al.attrFn) {
                return al(y)[x](D)
            }
            if (!("getAttribute" in y)) {
                return al.prop(y, x, D)
            }
            A = z !== 1 || !al.isXMLDoc(y);
            if (A) {
                x = x.toLowerCase();
                w = al.attrHooks[x] || (aB.test(x) ? bi : bw)
            }
            if (D !== ap) {
                if (D === null) {
                    al.removeAttr(y, x);
                    return ap
                } else {
                    if (w && "set" in w && A && (B = w.set(y, D, x)) !== ap) {
                        return B
                    } else {
                        y.setAttribute(x, "" + D);
                        return D
                    }
                }
            } else {
                if (w && "get" in w && A && (B = w.get(y, x)) !== null) {
                    return B
                } else {
                    B = y.getAttribute(x);
                    return B === null ? ap : B
                }
            }
        },
        removeAttr: function(x, e) {
            var B, A, y, w, z = 0;
            if (x.nodeType === 1) {
                A = (e || "").split(au);
                w = A.length;
                for (; z < w; z++) {
                    y = A[z].toLowerCase();
                    B = al.propFix[y] || y;
                    al.attr(x, y, "");
                    x.removeAttribute(T ? y : B);
                    if (aB.test(y) && B in x) {
                        x[B] = false
                    }
                }
            }
        },
        attrHooks: {
            type: {
                set: function(w, e) {
                    if (f.test(w.nodeName) && w.parentNode) {
                        al.error("type property can't be changed")
                    } else {
                        if (!al.support.radioValue && e === "radio" && al.nodeName(w, "input")) {
                            var x = w.value;
                            w.setAttribute("type", e);
                            if (x) {
                                w.value = x
                            }
                            return e
                        }
                    }
                }
            },
            value: {
                get: function(w, e) {
                    if (bw && al.nodeName(w, "button")) {
                        return bw.get(w, e)
                    }
                    return e in w ? w.value : null
                },
                set: function(w, e, x) {
                    if (bw && al.nodeName(w, "button")) {
                        return bw.set(w, e, x)
                    }
                    w.value = e
                }
            }
        },
        propFix: {
            tabindex: "tabIndex",
            readonly: "readOnly",
            "for": "htmlFor",
            "class": "className",
            maxlength: "maxLength",
            cellspacing: "cellSpacing",
            cellpadding: "cellPadding",
            rowspan: "rowSpan",
            colspan: "colSpan",
            usemap: "useMap",
            frameborder: "frameBorder",
            contenteditable: "contentEditable"
        },
        prop: function(x, w, B) {
            var A, e, z, y = x.nodeType;
            if (!x || y === 3 || y === 8 || y === 2) {
                return ap
            }
            z = y !== 1 || !al.isXMLDoc(x);
            if (z) {
                w = al.propFix[w] || w;
                e = al.propHooks[w]
            }
            if (B !== ap) {
                if (e && "set" in e && (A = e.set(x, B, w)) !== ap) {
                    return A
                } else {
                    return (x[w] = B)
                }
            } else {
                if (e && "get" in e && (A = e.get(x, w)) !== null) {
                    return A
                } else {
                    return x[w]
                }
            }
        },
        propHooks: {
            tabIndex: {
                get: function(w) {
                    var e = w.getAttributeNode("tabindex");
                    return e && e.specified ? parseInt(e.value, 10) : R.test(w.nodeName) || j.test(w.nodeName) && w.href ? 0 : ap
                }
            }
        }
    });
    al.attrHooks.tabindex = al.propHooks.tabIndex;
    bi = {
        get: function(w, e) {
            var y, x = al.prop(w, e);
            return x === true || typeof x !== "boolean" && (y = w.getAttributeNode(e)) && y.nodeValue !== false ? e.toLowerCase() : ap
        },
        set: function(w, e, y) {
            var x;
            if (e === false) {
                al.removeAttr(w, y)
            } else {
                x = al.propFix[y] || y;
                if (x in w) {
                    w[x] = true
                }
                w.setAttribute(y, y.toLowerCase())
            }
            return y
        }
    };
    if (!T) {
        aP = {
            name: true,
            id: true
        };
        bw = al.valHooks.button = {
            get: function(w, e) {
                var x;
                x = w.getAttributeNode(e);
                return x && (aP[e] ? x.nodeValue !== "" : x.specified) ? x.nodeValue : ap
            },
            set: function(w, e, y) {
                var x = w.getAttributeNode(y);
                if (!x) {
                    x = an.createAttribute(y);
                    w.setAttributeNode(x)
                }
                return (x.nodeValue = e + "")
            }
        };
        al.attrHooks.tabindex.set = bw.set;
        al.each(["width", "height"], function(e, w) {
            al.attrHooks[w] = al.extend(al.attrHooks[w], {
                set: function(y, x) {
                    if (x === "") {
                        y.setAttribute(w, "auto");
                        return x
                    }
                }
            })
        });
        al.attrHooks.contenteditable = {
            get: bw.get,
            set: function(w, e, x) {
                if (e === "") {
                    e = "false"
                }
                bw.set(w, e, x)
            }
        }
    }
    if (!al.support.hrefNormalized) {
        al.each(["href", "src", "width", "height"], function(e, w) {
            al.attrHooks[w] = al.extend(al.attrHooks[w], {
                get: function(y) {
                    var x = y.getAttribute(w, 2);
                    return x === null ? ap : x
                }
            })
        })
    }
    if (!al.support.style) {
        al.attrHooks.style = {
            get: function(e) {
                return e.style.cssText.toLowerCase() || ap
            },
            set: function(w, e) {
                return (w.style.cssText = "" + e)
            }
        }
    }
    if (!al.support.optSelected) {
        al.propHooks.selected = al.extend(al.propHooks.selected, {
            get: function(w) {
                var e = w.parentNode;
                if (e) {
                    e.selectedIndex;
                    if (e.parentNode) {
                        e.parentNode.selectedIndex
                    }
                }
                return null
            }
        })
    }
    if (!al.support.enctype) {
        al.propFix.enctype = "encoding"
    }
    if (!al.support.checkOn) {
        al.each(["radio", "checkbox"], function() {
            al.valHooks[this] = {
                get: function(e) {
                    return e.getAttribute("value") === null ? "on" : e.value
                }
            }
        })
    }
    al.each(["radio", "checkbox"], function() {
        al.valHooks[this] = al.extend(al.valHooks[this], {
            set: function(w, e) {
                if (al.isArray(e)) {
                    return (w.checked = al.inArray(al(w).val(), e) >= 0)
                }
            }
        })
    });
    var a7 = /\.(.*)$/,
        bv = /^(?:textarea|input|select)$/i,
        ab = /\./g,
        bB = / /g,
        aR = /[^\w\s.|`]/g,
        l = /^([^\.]*)?(?:\.(.+))?$/,
        X = /\bhover(\.\S+)?/,
        a6 = /^key/,
        bx = /^(?:mouse|contextmenu)|click/,
        ag = /^(\w*)(?:#([\w\-]+))?(?:\.([\w\-]+))?$/,
        aj = function(w) {
            var e = ag.exec(w);
            if (e) {
                e[1] = (e[1] || "").toLowerCase();
                e[3] = e[3] && new RegExp("(?:^|\\s)" + e[3] + "(?:\\s|$)")
            }
            return e
        },
        i = function(w, e) {
            return ((!e[1] || w.nodeName.toLowerCase() === e[1]) && (!e[2] || w.id === e[2]) && (!e[3] || e[3].test(w.className)))
        },
        bM = function(e) {
            return al.event.special.hover ? e : e.replace(X, "mouseenter$1 mouseleave$1")
        };
    al.event = {
        add: function(I, G, F, D, B) {
            var z, A, L, K, J, E, e, H, w, y, x, C;
            if (I.nodeType === 3 || I.nodeType === 8 || !G || !F || !(z = al._data(I))) {
                return
            }
            if (F.handler) {
                w = F;
                F = w.handler
            }
            if (!F.guid) {
                F.guid = al.guid++
            }
            L = z.events;
            if (!L) {
                z.events = L = {}
            }
            A = z.handle;
            if (!A) {
                z.handle = A = function(M) {
                    return typeof al !== "undefined" && (!M || al.event.triggered !== M.type) ? al.event.dispatch.apply(A.elem, arguments) : ap
                };
                A.elem = I
            }
            G = bM(G).split(" ");
            for (K = 0; K < G.length; K++) {
                J = l.exec(G[K]) || [];
                E = J[1];
                e = (J[2] || "").split(".").sort();
                C = al.event.special[E] || {};
                E = (B ? C.delegateType : C.bindType) || E;
                C = al.event.special[E] || {};
                H = al.extend({
                    type: E,
                    origType: J[1],
                    data: D,
                    handler: F,
                    guid: F.guid,
                    selector: B,
                    namespace: e.join(".")
                }, w);
                if (B) {
                    H.quick = aj(B);
                    if (!H.quick && al.expr.match.POS.test(B)) {
                        H.isPositional = true
                    }
                }
                x = L[E];
                if (!x) {
                    x = L[E] = [];
                    x.delegateCount = 0;
                    if (!C.setup || C.setup.call(I, D, e, A) === false) {
                        if (I.addEventListener) {
                            I.addEventListener(E, A, false)
                        } else {
                            if (I.attachEvent) {
                                I.attachEvent("on" + E, A)
                            }
                        }
                    }
                }
                if (C.add) {
                    C.add.call(I, H);
                    if (!H.handler.guid) {
                        H.handler.guid = F.guid
                    }
                }
                if (B) {
                    x.splice(x.delegateCount++, 0, H)
                } else {
                    x.push(H)
                }
                al.event.global[E] = true
            }
            I = null
        },
        global: {},
        remove: function(I, G, E, D) {
            var B = al.hasData(I) && al._data(I),
                K, L, F, x, y, z, J, C, A, w, H;
            if (!B || !(J = B.events)) {
                return
            }
            G = bM(G || "").split(" ");
            for (K = 0; K < G.length; K++) {
                L = l.exec(G[K]) || [];
                F = L[1];
                x = L[2];
                if (!F) {
                    x = x ? "." + x : "";
                    for (z in J) {
                        al.event.remove(I, z + x, E, D)
                    }
                    return
                }
                C = al.event.special[F] || {};
                F = (D ? C.delegateType : C.bindType) || F;
                w = J[F] || [];
                y = w.length;
                x = x ? new RegExp("(^|\\.)" + x.split(".").sort().join("\\.(?:.*\\.)?") + "(\\.|$)") : null;
                if (E || x || D || C.remove) {
                    for (z = 0; z < w.length; z++) {
                        H = w[z];
                        if (!E || E.guid === H.guid) {
                            if (!x || x.test(H.namespace)) {
                                if (!D || D === H.selector || D === "**" && H.selector) {
                                    w.splice(z--, 1);
                                    if (H.selector) {
                                        w.delegateCount--
                                    }
                                    if (C.remove) {
                                        C.remove.call(I, H)
                                    }
                                }
                            }
                        }
                    }
                } else {
                    w.length = 0
                }
                if (w.length === 0 && y !== w.length) {
                    if (!C.teardown || C.teardown.call(I, x) === false) {
                        al.removeEvent(I, F, B.handle)
                    }
                    delete J[F]
                }
            }
            if (al.isEmptyObject(J)) {
                A = B.handle;
                if (A) {
                    A.elem = null
                }
                al.removeData(I, ["events", "handle"], true)
            }
        },
        customEvent: {
            getData: true,
            setData: true,
            changeData: true
        },
        trigger: function(J, I, H, G) {
            if (H && (H.nodeType === 3 || H.nodeType === 8)) {
                return
            }
            var E = J.type || J,
                y = [],
                w, x, C, K, A, z, F, D, B, L;
            if (E.indexOf("!") >= 0) {
                E = E.slice(0, -1);
                x = true
            }
            if (E.indexOf(".") >= 0) {
                y = E.split(".");
                E = y.shift();
                y.sort()
            }
            if ((!H || al.event.customEvent[E]) && !al.event.global[E]) {
                return
            }
            J = typeof J === "object" ? J[al.expando] ? J : new al.Event(E, J) : new al.Event(E);
            J.type = E;
            J.isTrigger = true;
            J.exclusive = x;
            J.namespace = y.join(".");
            J.namespace_re = J.namespace ? new RegExp("(^|\\.)" + y.join("\\.(?:.*\\.)?") + "(\\.|$)") : null;
            z = E.indexOf(":") < 0 ? "on" + E : "";
            if (G || !H) {
                J.preventDefault()
            }
            if (!H) {
                w = al.cache;
                for (C in w) {
                    if (w[C].events && w[C].events[E]) {
                        al.event.trigger(J, I, w[C].handle.elem, true)
                    }
                }
                return
            }
            J.result = ap;
            if (!J.target) {
                J.target = H
            }
            I = I != null ? al.makeArray(I) : [];
            I.unshift(J);
            F = al.event.special[E] || {};
            if (F.trigger && F.trigger.apply(H, I) === false) {
                return
            }
            B = [
                [H, F.bindType || E]
            ];
            if (!G && !F.noBubble && !al.isWindow(H)) {
                L = F.delegateType || E;
                A = null;
                for (K = H.parentNode; K; K = K.parentNode) {
                    B.push([K, L]);
                    A = K
                }
                if (A && A === H.ownerDocument) {
                    B.push([A.defaultView || A.parentWindow || aq, L])
                }
            }
            for (C = 0; C < B.length; C++) {
                K = B[C][0];
                J.type = B[C][1];
                D = (al._data(K, "events") || {})[J.type] && al._data(K, "handle");
                if (D) {
                    D.apply(K, I)
                }
                D = z && K[z];
                if (D && al.acceptData(K)) {
                    D.apply(K, I)
                }
                if (J.isPropagationStopped()) {
                    break
                }
            }
            J.type = E;
            if (!J.isDefaultPrevented()) {
                if ((!F._default || F._default.apply(H.ownerDocument, I) === false) && !(E === "click" && al.nodeName(H, "a")) && al.acceptData(H)) {
                    if (z && H[E] && ((E !== "focus" && E !== "blur") || J.target.offsetWidth !== 0) && !al.isWindow(H)) {
                        A = H[z];
                        if (A) {
                            H[z] = null
                        }
                        al.event.triggered = E;
                        H[E]();
                        al.event.triggered = ap;
                        if (A) {
                            H[z] = A
                        }
                    }
                }
            }
            return J.result
        },
        dispatch: function(K) {
            K = al.event.fix(K || aq.event);
            var J = ((al._data(this, "events") || {})[K.type] || []),
                C = J.delegateCount,
                y = [].slice.call(arguments, 0),
                D = !K.exclusive && !K.namespace,
                A = (al.event.special[K.type] || {}).handle,
                w = [],
                H, F, z, L, G, B, x, e, E, I, M;
            y[0] = K;
            K.delegateTarget = this;
            if (C && !K.target.disabled && !(K.button && K.type === "click")) {
                for (z = K.target; z != this; z = z.parentNode || this) {
                    G = {};
                    x = [];
                    for (H = 0; H < C; H++) {
                        e = J[H];
                        E = e.selector;
                        I = G[E];
                        if (e.isPositional) {
                            I = (I || (G[E] = al(E))).index(z) >= 0
                        } else {
                            if (I === ap) {
                                I = G[E] = (e.quick ? i(z, e.quick) : al(z).is(E))
                            }
                        }
                        if (I) {
                            x.push(e)
                        }
                    }
                    if (x.length) {
                        w.push({
                            elem: z,
                            matches: x
                        })
                    }
                }
            }
            if (J.length > C) {
                w.push({
                    elem: this,
                    matches: J.slice(C)
                })
            }
            for (H = 0; H < w.length && !K.isPropagationStopped(); H++) {
                B = w[H];
                K.currentTarget = B.elem;
                for (F = 0; F < B.matches.length && !K.isImmediatePropagationStopped(); F++) {
                    e = B.matches[F];
                    if (D || (!K.namespace && !e.namespace) || K.namespace_re && K.namespace_re.test(e.namespace)) {
                        K.data = e.data;
                        K.handleObj = e;
                        L = (A || e.handler).apply(B.elem, y);
                        if (L !== ap) {
                            K.result = L;
                            if (L === false) {
                                K.preventDefault();
                                K.stopPropagation()
                            }
                        }
                    }
                }
            }
            return K.result
        },
        props: "attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
        fixHooks: {},
        keyHooks: {
            props: "char charCode key keyCode".split(" "),
            filter: function(w, e) {
                if (w.which == null) {
                    w.which = e.charCode != null ? e.charCode : e.keyCode
                }
                return w
            }
        },
        mouseHooks: {
            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement wheelDelta".split(" "),
            filter: function(x, w) {
                var B, z, e, y = w.button,
                    A = w.fromElement;
                if (x.pageX == null && w.clientX != null) {
                    B = x.target.ownerDocument || an;
                    z = B.documentElement;
                    e = B.body;
                    x.pageX = w.clientX + (z && z.scrollLeft || e && e.scrollLeft || 0) - (z && z.clientLeft || e && e.clientLeft || 0);
                    x.pageY = w.clientY + (z && z.scrollTop || e && e.scrollTop || 0) - (z && z.clientTop || e && e.clientTop || 0)
                }
                if (!x.relatedTarget && A) {
                    x.relatedTarget = A === x.target ? w.toElement : A
                }
                if (!x.which && y !== ap) {
                    x.which = (y & 1 ? 1 : (y & 2 ? 3 : (y & 4 ? 2 : 0)))
                }
                return x
            }
        },
        fix: function(w) {
            if (w[al.expando]) {
                return w
            }
            var x, A, e = w,
                y = al.event.fixHooks[w.type] || {},
                z = y.props ? this.props.concat(y.props) : this.props;
            w = al.Event(e);
            for (x = z.length; x;) {
                A = z[--x];
                w[A] = e[A]
            }
            if (!w.target) {
                w.target = e.srcElement || an
            }
            if (w.target.nodeType === 3) {
                w.target = w.target.parentNode
            }
            if (w.metaKey === ap) {
                w.metaKey = w.ctrlKey
            }
            return y.filter ? y.filter(w, e) : w
        },
        special: {
            ready: {
                setup: al.bindReady
            },
            focus: {
                delegateType: "focusin",
                noBubble: true
            },
            blur: {
                delegateType: "focusout",
                noBubble: true
            },
            beforeunload: {
                setup: function(w, e, x) {
                    if (al.isWindow(this)) {
                        this.onbeforeunload = x
                    }
                },
                teardown: function(w, e) {
                    if (this.onbeforeunload === e) {
                        this.onbeforeunload = null
                    }
                }
            }
        },
        simulate: function(x, w, A, z) {
            var y = al.extend(new al.Event(), A, {
                type: x,
                isSimulated: true,
                originalEvent: {}
            });
            if (z) {
                al.event.trigger(y, null, w)
            } else {
                al.event.dispatch.call(w, y)
            }
            if (y.isDefaultPrevented()) {
                A.preventDefault()
            }
        }
    };
    al.event.handle = al.event.dispatch;
    al.removeEvent = an.removeEventListener ? function(w, e, x) {
        if (w.removeEventListener) {
            w.removeEventListener(e, x, false)
        }
    } : function(w, e, x) {
        if (w.detachEvent) {
            w.detachEvent("on" + e, x)
        }
    };
    al.Event = function(w, e) {
        if (!(this instanceof al.Event)) {
            return new al.Event(w, e)
        }
        if (w && w.type) {
            this.originalEvent = w;
            this.type = w.type;
            this.isDefaultPrevented = (w.defaultPrevented || w.returnValue === false || w.getPreventDefault && w.getPreventDefault()) ? h : bD
        } else {
            this.type = w
        }
        if (e) {
            al.extend(this, e)
        }
        this.timeStamp = w && w.timeStamp || al.now();
        this[al.expando] = true
    };

    function bD() {
        return false
    }

    function h() {
        return true
    }
    al.Event.prototype = {
        preventDefault: function() {
            this.isDefaultPrevented = h;
            var w = this.originalEvent;
            if (!w) {
                return
            }
            if (w.preventDefault) {
                w.preventDefault()
            } else {
                w.returnValue = false
            }
        },
        stopPropagation: function() {
            this.isPropagationStopped = h;
            var w = this.originalEvent;
            if (!w) {
                return
            }
            if (w.stopPropagation) {
                w.stopPropagation()
            }
            w.cancelBubble = true
        },
        stopImmediatePropagation: function() {
            this.isImmediatePropagationStopped = h;
            this.stopPropagation()
        },
        isDefaultPrevented: bD,
        isPropagationStopped: bD,
        isImmediatePropagationStopped: bD
    };
    al.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout"
    }, function(w, e) {
        al.event.special[w] = al.event.special[e] = {
            delegateType: e,
            bindType: e,
            handle: function(z) {
                var y = this,
                    D = z.relatedTarget,
                    B = z.handleObj,
                    x = B.selector,
                    C, A;
                if (!D || B.origType === z.type || (D !== y && !al.contains(y, D))) {
                    C = z.type;
                    z.type = B.origType;
                    A = B.handler.apply(this, arguments);
                    z.type = C
                }
                return A
            }
        }
    });
    if (!al.support.submitBubbles) {
        al.event.special.submit = {
            setup: function() {
                if (al.nodeName(this, "form")) {
                    return false
                }
                al.event.add(this, "click._submit keypress._submit", function(y) {
                    var w = y.target,
                        x = al.nodeName(w, "input") || al.nodeName(w, "button") ? w.form : ap;
                    if (x && !x._submit_attached) {
                        al.event.add(x, "submit._submit", function(e) {
                            if (this.parentNode) {
                                al.event.simulate("submit", this.parentNode, e, true)
                            }
                        });
                        x._submit_attached = true
                    }
                })
            },
            teardown: function() {
                if (al.nodeName(this, "form")) {
                    return false
                }
                al.event.remove(this, "._submit")
            }
        }
    }
    if (!al.support.changeBubbles) {
        al.event.special.change = {
            setup: function() {
                if (bv.test(this.nodeName)) {
                    if (this.type === "checkbox" || this.type === "radio") {
                        al.event.add(this, "propertychange._change", function(e) {
                            if (e.originalEvent.propertyName === "checked") {
                                this._just_changed = true
                            }
                        });
                        al.event.add(this, "click._change", function(e) {
                            if (this._just_changed) {
                                this._just_changed = false;
                                al.event.simulate("change", this, e, true)
                            }
                        })
                    }
                    return false
                }
                al.event.add(this, "beforeactivate._change", function(x) {
                    var w = x.target;
                    if (bv.test(w.nodeName) && !w._change_attached) {
                        al.event.add(w, "change._change", function(e) {
                            if (this.parentNode && !e.isSimulated) {
                                al.event.simulate("change", this.parentNode, e, true)
                            }
                        });
                        w._change_attached = true
                    }
                })
            },
            handle: function(w) {
                var e = w.target;
                if (this !== e || w.isSimulated || w.isTrigger || (e.type !== "radio" && e.type !== "checkbox")) {
                    return w.handleObj.handler.apply(this, arguments)
                }
            },
            teardown: function() {
                al.event.remove(this, "._change");
                return bv.test(this.nodeName)
            }
        }
    }
    if (!al.support.focusinBubbles) {
        al.each({
            focus: "focusin",
            blur: "focusout"
        }, function(e, y) {
            var x = 0,
                w = function(z) {
                    al.event.simulate(y, z.target, al.event.fix(z), true)
                };
            al.event.special[y] = {
                setup: function() {
                    if (x++ === 0) {
                        an.addEventListener(e, w, true)
                    }
                },
                teardown: function() {
                    if (--x === 0) {
                        an.removeEventListener(e, w, true)
                    }
                }
            }
        })
    }
    al.fn.extend({
        on: function(w, C, B, A, z) {
            var y, x;
            if (typeof w === "object") {
                if (typeof C !== "string") {
                    B = C;
                    C = ap
                }
                for (x in w) {
                    this.on(x, C, B, w[x], z)
                }
                return this
            }
            if (B == null && A == null) {
                A = C;
                B = C = ap
            } else {
                if (A == null) {
                    if (typeof C === "string") {
                        A = B;
                        B = ap
                    } else {
                        A = B;
                        B = C;
                        C = ap
                    }
                }
            }
            if (A === false) {
                A = bD
            } else {
                if (!A) {
                    return this
                }
            }
            if (z === 1) {
                y = A;
                A = function(e) {
                    al().off(e);
                    return y.apply(this, arguments)
                };
                A.guid = y.guid || (y.guid = al.guid++)
            }
            return this.each(function() {
                al.event.add(this, w, A, B, C)
            })
        },
        one: function(w, e, y, x) {
            return this.on.call(this, w, e, y, x, 1)
        },
        off: function(x, w, A) {
            if (x && x.preventDefault && x.handleObj) {
                var z = x.handleObj;
                al(x.delegateTarget).off(z.namespace ? z.type + "." + z.namespace : z.type, z.selector, z.handler);
                return this
            }
            if (typeof x === "object") {
                for (var y in x) {
                    this.off(y, w, x[y])
                }
                return this
            }
            if (w === false || typeof w === "function") {
                A = w;
                w = ap
            }
            if (A === false) {
                A = bD
            }
            return this.each(function() {
                al.event.remove(this, x, A, w)
            })
        },
        bind: function(w, e, x) {
            return this.on(w, null, e, x)
        },
        unbind: function(w, e) {
            return this.off(w, null, e)
        },
        live: function(w, e, x) {
            al(this.context).on(w, this.selector, e, x);
            return this
        },
        die: function(w, e) {
            al(this.context).off(w, this.selector || "**", e);
            return this
        },
        delegate: function(w, e, y, x) {
            return this.on(e, w, y, x)
        },
        undelegate: function(w, e, x) {
            return arguments.length == 1 ? this.off(w, "**") : this.off(e, w, x)
        },
        trigger: function(w, e) {
            return this.each(function() {
                al.event.trigger(w, e, this)
            })
        },
        triggerHandler: function(w, e) {
            if (this[0]) {
                return al.event.trigger(w, e, this[0], true)
            }
        },
        toggle: function(z) {
            var y = arguments,
                e = z.guid || al.guid++,
                w = 0,
                x = function(B) {
                    var A = (al._data(this, "lastToggle" + z.guid) || 0) % w;
                    al._data(this, "lastToggle" + z.guid, A + 1);
                    B.preventDefault();
                    return y[A].apply(this, arguments) || false
                };
            x.guid = e;
            while (w < y.length) {
                y[w++].guid = e
            }
            return this.click(x)
        },
        hover: function(w, e) {
            return this.mouseenter(w).mouseleave(e || w)
        }
    });
    al.each(("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu").split(" "), function(e, w) {
        al.fn[w] = function(y, x) {
            if (x == null) {
                x = y;
                y = null
            }
            return arguments.length > 0 ? this.bind(w, y, x) : this.trigger(w)
        };
        if (al.attrFn) {
            al.attrFn[w] = true
        }
        if (a6.test(w)) {
            al.event.fixHooks[w] = al.event.keyHooks
        }
        if (bx.test(w)) {
            al.event.fixHooks[w] = al.event.mouseHooks
        }
    });
    (function() {
        var bO = /((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^\[\]]*\]|['"][^'"]*['"]|[^\[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,
            A = "sizcache" + (Math.random() + "").replace(".", ""),
            G = 0,
            M = Object.prototype.toString,
            z = false,
            y = true,
            K = /\\/g,
            bQ = /\r\n/g,
            bS = /\W/;
        [0, 0].sort(function() {
            y = false;
            return 0
        });
        var L = function(b5, b4, b3, b2) {
            b3 = b3 || [];
            b4 = b4 || an;
            var b1 = b4;
            if (b4.nodeType !== 1 && b4.nodeType !== 9) {
                return []
            }
            if (!b5 || typeof b5 !== "string") {
                return b3
            }
            var bU, b6, b9, bT, b0, b8, b7, bY, bW = true,
                bV = L.isXML(b4),
                bX = [],
                bZ = b5;
            do {
                bO.exec("");
                bU = bO.exec(bZ);
                if (bU) {
                    bZ = bU[3];
                    bX.push(bU[1]);
                    if (bU[2]) {
                        bT = bU[3];
                        break
                    }
                }
            } while (bU);
            if (bX.length > 1 && H.exec(b5)) {
                if (bX.length === 2 && I.relative[bX[0]]) {
                    b6 = C(bX[0] + bX[1], b4, b2)
                } else {
                    b6 = I.relative[bX[0]] ? [b4] : L(bX.shift(), b4);
                    while (bX.length) {
                        b5 = bX.shift();
                        if (I.relative[b5]) {
                            b5 += bX.shift()
                        }
                        b6 = C(b5, b6, b2)
                    }
                }
            } else {
                if (!b2 && bX.length > 1 && b4.nodeType === 9 && !bV && I.match.ID.test(bX[0]) && !I.match.ID.test(bX[bX.length - 1])) {
                    b0 = L.find(bX.shift(), b4, bV);
                    b4 = b0.expr ? L.filter(b0.expr, b0.set)[0] : b0.set[0]
                }
                if (b4) {
                    b0 = b2 ? {
                        expr: bX.pop(),
                        set: E(b2)
                    } : L.find(bX.pop(), bX.length === 1 && (bX[0] === "~" || bX[0] === "+") && b4.parentNode ? b4.parentNode : b4, bV);
                    b6 = b0.expr ? L.filter(b0.expr, b0.set) : b0.set;
                    if (bX.length > 0) {
                        b9 = E(b6)
                    } else {
                        bW = false
                    }
                    while (bX.length) {
                        b8 = bX.pop();
                        b7 = b8;
                        if (!I.relative[b8]) {
                            b8 = ""
                        } else {
                            b7 = bX.pop()
                        }
                        if (b7 == null) {
                            b7 = b4
                        }
                        I.relative[b8](b9, b7, bV)
                    }
                } else {
                    b9 = bX = []
                }
            }
            if (!b9) {
                b9 = b6
            }
            if (!b9) {
                L.error(b8 || b5)
            }
            if (M.call(b9) === "[object Array]") {
                if (!bW) {
                    b3.push.apply(b3, b9)
                } else {
                    if (b4 && b4.nodeType === 1) {
                        for (bY = 0; b9[bY] != null; bY++) {
                            if (b9[bY] && (b9[bY] === true || b9[bY].nodeType === 1 && L.contains(b4, b9[bY]))) {
                                b3.push(b6[bY])
                            }
                        }
                    } else {
                        for (bY = 0; b9[bY] != null; bY++) {
                            if (b9[bY] && b9[bY].nodeType === 1) {
                                b3.push(b6[bY])
                            }
                        }
                    }
                }
            } else {
                E(b9, b3)
            }
            if (bT) {
                L(bT, b1, b3, b2);
                L.uniqueSort(b3)
            }
            return b3
        };
        L.uniqueSort = function(e) {
            if (D) {
                z = y;
                e.sort(D);
                if (z) {
                    for (var bT = 1; bT < e.length; bT++) {
                        if (e[bT] === e[bT - 1]) {
                            e.splice(bT--, 1)
                        }
                    }
                }
            }
            return e
        };
        L.matches = function(bT, e) {
            return L(bT, null, null, e)
        };
        L.matchesSelector = function(bT, e) {
            return L(e, null, null, [bT]).length > 0
        };
        L.find = function(b0, bZ, bY) {
            var bX, bU, bW, bV, e, bT;
            if (!b0) {
                return []
            }
            for (bU = 0, bW = I.order.length; bU < bW; bU++) {
                e = I.order[bU];
                if ((bV = I.leftMatch[e].exec(b0))) {
                    bT = bV[1];
                    bV.splice(1, 1);
                    if (bT.substr(bT.length - 1) !== "\\") {
                        bV[1] = (bV[1] || "").replace(K, "");
                        bX = I.find[e](bV, bZ, bY);
                        if (bX != null) {
                            b0 = b0.replace(I.match[e], "");
                            break
                        }
                    }
                }
            }
            if (!bX) {
                bX = typeof bZ.getElementsByTagName !== "undefined" ? bZ.getElementsByTagName("*") : []
            }
            return {
                set: bX,
                expr: b0
            }
        };
        L.filter = function(b5, b4, b3, b2) {
            var b1, bU, bT, b9, b7, bV, bX, bY, b6, bW = b5,
                b8 = [],
                b0 = b4,
                bZ = b4 && b4[0] && L.isXML(b4[0]);
            while (b5 && b4.length) {
                for (bT in I.filter) {
                    if ((b1 = I.leftMatch[bT].exec(b5)) != null && b1[2]) {
                        bV = I.filter[bT];
                        bX = b1[1];
                        bU = false;
                        b1.splice(1, 1);
                        if (bX.substr(bX.length - 1) === "\\") {
                            continue
                        }
                        if (b0 === b8) {
                            b8 = []
                        }
                        if (I.preFilter[bT]) {
                            b1 = I.preFilter[bT](b1, b0, b3, b8, b2, bZ);
                            if (!b1) {
                                bU = b9 = true
                            } else {
                                if (b1 === true) {
                                    continue
                                }
                            }
                        }
                        if (b1) {
                            for (bY = 0;
                                (b7 = b0[bY]) != null; bY++) {
                                if (b7) {
                                    b9 = bV(b7, b1, bY, b0);
                                    b6 = b2 ^ b9;
                                    if (b3 && b9 != null) {
                                        if (b6) {
                                            bU = true
                                        } else {
                                            b0[bY] = false
                                        }
                                    } else {
                                        if (b6) {
                                            b8.push(b7);
                                            bU = true
                                        }
                                    }
                                }
                            }
                        }
                        if (b9 !== ap) {
                            if (!b3) {
                                b0 = b8
                            }
                            b5 = b5.replace(I.match[bT], "");
                            if (!bU) {
                                return []
                            }
                            break
                        }
                    }
                }
                if (b5 === bW) {
                    if (bU == null) {
                        L.error(b5)
                    } else {
                        break
                    }
                }
                bW = b5
            }
            return b0
        };
        L.error = function(e) {
            throw "Syntax error, unrecognized expression: " + e
        };
        var J = L.getText = function(bT) {
            var bV, bW, e = bT.nodeType,
                bU = "";
            if (e) {
                if (e === 1) {
                    if (typeof bT.textContent === "string") {
                        return bT.textContent
                    } else {
                        if (typeof bT.innerText === "string") {
                            return bT.innerText.replace(bQ, "")
                        } else {
                            for (bT = bT.firstChild; bT; bT = bT.nextSibling) {
                                bU += J(bT)
                            }
                        }
                    }
                } else {
                    if (e === 3 || e === 4) {
                        return bT.nodeValue
                    }
                }
            } else {
                for (bV = 0;
                    (bW = bT[bV]); bV++) {
                    if (bW.nodeType !== 8) {
                        bU += J(bW)
                    }
                }
            }
            return bU
        };
        var I = L.selectors = {
            order: ["ID", "NAME", "TAG"],
            match: {
                ID: /#((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
                CLASS: /\.((?:[\w\u00c0-\uFFFF\-]|\\.)+)/,
                NAME: /\[name=['"]*((?:[\w\u00c0-\uFFFF\-]|\\.)+)['"]*\]/,
                ATTR: /\[\s*((?:[\w\u00c0-\uFFFF\-]|\\.)+)\s*(?:(\S?=)\s*(?:(['"])(.*?)\3|(#?(?:[\w\u00c0-\uFFFF\-]|\\.)*)|)|)\s*\]/,
                TAG: /^((?:[\w\u00c0-\uFFFF\*\-]|\\.)+)/,
                CHILD: /:(only|nth|last|first)-child(?:\(\s*(even|odd|(?:[+\-]?\d+|(?:[+\-]?\d*)?n\s*(?:[+\-]\s*\d+)?))\s*\))?/,
                POS: /:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^\-]|$)/,
                PSEUDO: /:((?:[\w\u00c0-\uFFFF\-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/
            },
            leftMatch: {},
            attrMap: {
                "class": "className",
                "for": "htmlFor"
            },
            attrHandle: {
                href: function(e) {
                    return e.getAttribute("href")
                },
                type: function(e) {
                    return e.getAttribute("type")
                }
            },
            relative: {
                "+": function(bU, e) {
                    var bZ = typeof e === "string",
                        bX = bZ && !bS.test(e),
                        bY = bZ && !bX;
                    if (bX) {
                        e = e.toLowerCase()
                    }
                    for (var bV = 0, bT = bU.length, bW; bV < bT; bV++) {
                        if ((bW = bU[bV])) {
                            while ((bW = bW.previousSibling) && bW.nodeType !== 1) {}
                            bU[bV] = bY || bW && bW.nodeName.toLowerCase() === e ? bW || false : bW === e
                        }
                    }
                    if (bY) {
                        L.filter(e, bU, true)
                    }
                },
                ">": function(bU, e) {
                    var bY, bW = typeof e === "string",
                        bV = 0,
                        bT = bU.length;
                    if (bW && !bS.test(e)) {
                        e = e.toLowerCase();
                        for (; bV < bT; bV++) {
                            bY = bU[bV];
                            if (bY) {
                                var bX = bY.parentNode;
                                bU[bV] = bX.nodeName.toLowerCase() === e ? bX : false
                            }
                        }
                    } else {
                        for (; bV < bT; bV++) {
                            bY = bU[bV];
                            if (bY) {
                                bU[bV] = bW ? bY.parentNode : bY.parentNode === e
                            }
                        }
                        if (bW) {
                            L.filter(e, bU, true)
                        }
                    }
                },
                "": function(bU, bT, bX) {
                    var bW, bV = G++,
                        e = bP;
                    if (typeof bT === "string" && !bS.test(bT)) {
                        bT = bT.toLowerCase();
                        bW = bT;
                        e = w
                    }
                    e("parentNode", bT, bV, bU, bW, bX)
                },
                "~": function(bU, bT, bX) {
                    var bW, bV = G++,
                        e = bP;
                    if (typeof bT === "string" && !bS.test(bT)) {
                        bT = bT.toLowerCase();
                        bW = bT;
                        e = w
                    }
                    e("previousSibling", bT, bV, bU, bW, bX)
                }
            },
            find: {
                ID: function(bU, bT, bV) {
                    if (typeof bT.getElementById !== "undefined" && !bV) {
                        var e = bT.getElementById(bU[1]);
                        return e && e.parentNode ? [e] : []
                    }
                },
                NAME: function(bU, e) {
                    if (typeof e.getElementsByName !== "undefined") {
                        var bX = [],
                            bW = e.getElementsByName(bU[1]);
                        for (var bV = 0, bT = bW.length; bV < bT; bV++) {
                            if (bW[bV].getAttribute("name") === bU[1]) {
                                bX.push(bW[bV])
                            }
                        }
                        return bX.length === 0 ? null : bX
                    }
                },
                TAG: function(bT, e) {
                    if (typeof e.getElementsByTagName !== "undefined") {
                        return e.getElementsByTagName(bT[1])
                    }
                }
            },
            preFilter: {
                CLASS: function(bU, bT, b0, bZ, bY, bX) {
                    bU = " " + bU[1].replace(K, "") + " ";
                    if (bX) {
                        return bU
                    }
                    for (var bV = 0, bW;
                        (bW = bT[bV]) != null; bV++) {
                        if (bW) {
                            if (bY ^ (bW.className && (" " + bW.className + " ").replace(/[\t\n\r]/g, " ").indexOf(bU) >= 0)) {
                                if (!b0) {
                                    bZ.push(bW)
                                }
                            } else {
                                if (b0) {
                                    bT[bV] = false
                                }
                            }
                        }
                    }
                    return false
                },
                ID: function(e) {
                    return e[1].replace(K, "")
                },
                TAG: function(bT, e) {
                    return bT[1].replace(K, "").toLowerCase()
                },
                CHILD: function(bT) {
                    if (bT[1] === "nth") {
                        if (!bT[2]) {
                            L.error(bT[0])
                        }
                        bT[2] = bT[2].replace(/^\+|\s*/g, "");
                        var e = /(-?)(\d*)(?:n([+\-]?\d*))?/.exec(bT[2] === "even" && "2n" || bT[2] === "odd" && "2n+1" || !/\D/.test(bT[2]) && "0n+" + bT[2] || bT[2]);
                        bT[2] = (e[1] + (e[2] || 1)) - 0;
                        bT[3] = e[3] - 0
                    } else {
                        if (bT[2]) {
                            L.error(bT[0])
                        }
                    }
                    bT[0] = G++;
                    return bT
                },
                ATTR: function(bU, bT, bZ, bY, bX, bW) {
                    var bV = bU[1] = bU[1].replace(K, "");
                    if (!bW && I.attrMap[bV]) {
                        bU[1] = I.attrMap[bV]
                    }
                    bU[4] = (bU[4] || bU[5] || "").replace(K, "");
                    if (bU[2] === "~=") {
                        bU[4] = " " + bU[4] + " "
                    }
                    return bU
                },
                PSEUDO: function(bU, bT, bY, bX, bW) {
                    if (bU[1] === "not") {
                        if ((bO.exec(bU[3]) || "").length > 1 || /^\w/.test(bU[3])) {
                            bU[3] = L(bU[3], null, null, bT)
                        } else {
                            var bV = L.filter(bU[3], bT, bY, true ^ bW);
                            if (!bY) {
                                bX.push.apply(bX, bV)
                            }
                            return false
                        }
                    } else {
                        if (I.match.POS.test(bU[0]) || I.match.CHILD.test(bU[0])) {
                            return true
                        }
                    }
                    return bU
                },
                POS: function(e) {
                    e.unshift(true);
                    return e
                }
            },
            filters: {
                enabled: function(e) {
                    return e.disabled === false && e.type !== "hidden"
                },
                disabled: function(e) {
                    return e.disabled === true
                },
                checked: function(e) {
                    return e.checked === true
                },
                selected: function(e) {
                    if (e.parentNode) {
                        e.parentNode.selectedIndex
                    }
                    return e.selected === true
                },
                parent: function(e) {
                    return !!e.firstChild
                },
                empty: function(e) {
                    return !e.firstChild
                },
                has: function(bT, bU, e) {
                    return !!L(e[3], bT).length
                },
                header: function(e) {
                    return (/h\d/i).test(e.nodeName)
                },
                text: function(bT) {
                    var e = bT.getAttribute("type"),
                        bU = bT.type;
                    return bT.nodeName.toLowerCase() === "input" && "text" === bU && (e === bU || e === null)
                },
                radio: function(e) {
                    return e.nodeName.toLowerCase() === "input" && "radio" === e.type
                },
                checkbox: function(e) {
                    return e.nodeName.toLowerCase() === "input" && "checkbox" === e.type
                },
                file: function(e) {
                    return e.nodeName.toLowerCase() === "input" && "file" === e.type
                },
                password: function(e) {
                    return e.nodeName.toLowerCase() === "input" && "password" === e.type
                },
                submit: function(bT) {
                    var e = bT.nodeName.toLowerCase();
                    return (e === "input" || e === "button") && "submit" === bT.type
                },
                image: function(e) {
                    return e.nodeName.toLowerCase() === "input" && "image" === e.type
                },
                reset: function(bT) {
                    var e = bT.nodeName.toLowerCase();
                    return (e === "input" || e === "button") && "reset" === bT.type
                },
                button: function(bT) {
                    var e = bT.nodeName.toLowerCase();
                    return e === "input" && "button" === bT.type || e === "button"
                },
                input: function(e) {
                    return (/input|select|textarea|button/i).test(e.nodeName)
                },
                focus: function(e) {
                    return e === e.ownerDocument.activeElement
                }
            },
            setFilters: {
                first: function(e, bT) {
                    return bT === 0
                },
                last: function(bT, bU, e, bV) {
                    return bU === bV.length - 1
                },
                even: function(e, bT) {
                    return bT % 2 === 0
                },
                odd: function(e, bT) {
                    return bT % 2 === 1
                },
                lt: function(bT, bU, e) {
                    return bU < e[3] - 0
                },
                gt: function(bT, bU, e) {
                    return bU > e[3] - 0
                },
                nth: function(bT, bU, e) {
                    return e[3] - 0 === bU
                },
                eq: function(bT, bU, e) {
                    return e[3] - 0 === bU
                }
            },
            filter: {
                PSEUDO: function(b1, b0, bW, bZ) {
                    var bY = b0[1],
                        bT = I.filters[bY];
                    if (bT) {
                        return bT(b1, bW, b0, bZ)
                    } else {
                        if (bY === "contains") {
                            return (b1.textContent || b1.innerText || J([b1]) || "").indexOf(b0[3]) >= 0
                        } else {
                            if (bY === "not") {
                                var bX = b0[3];
                                for (var bV = 0, bU = bX.length; bV < bU; bV++) {
                                    if (bX[bV] === b1) {
                                        return false
                                    }
                                }
                                return true
                            } else {
                                L.error(bY)
                            }
                        }
                    }
                },
                CHILD: function(bZ, bY) {
                    var bX, b2, bW, b1, bT, bV, b0, e = bY[1],
                        bU = bZ;
                    switch (e) {
                        case "only":
                        case "first":
                            while ((bU = bU.previousSibling)) {
                                if (bU.nodeType === 1) {
                                    return false
                                }
                            }
                            if (e === "first") {
                                return true
                            }
                            bU = bZ;
                        case "last":
                            while ((bU = bU.nextSibling)) {
                                if (bU.nodeType === 1) {
                                    return false
                                }
                            }
                            return true;
                        case "nth":
                            bX = bY[2];
                            b2 = bY[3];
                            if (bX === 1 && b2 === 0) {
                                return true
                            }
                            bW = bY[0];
                            b1 = bZ.parentNode;
                            if (b1 && (b1[A] !== bW || !bZ.nodeIndex)) {
                                bV = 0;
                                for (bU = b1.firstChild; bU; bU = bU.nextSibling) {
                                    if (bU.nodeType === 1) {
                                        bU.nodeIndex = ++bV
                                    }
                                }
                                b1[A] = bW
                            }
                            b0 = bZ.nodeIndex - b2;
                            if (bX === 0) {
                                return b0 === 0
                            } else {
                                return (b0 % bX === 0 && b0 / bX >= 0)
                            }
                    }
                },
                ID: function(bT, e) {
                    return bT.nodeType === 1 && bT.getAttribute("id") === e
                },
                TAG: function(bT, e) {
                    return (e === "*" && bT.nodeType === 1) || !!bT.nodeName && bT.nodeName.toLowerCase() === e
                },
                CLASS: function(bT, e) {
                    return (" " + (bT.className || bT.getAttribute("class")) + " ").indexOf(e) > -1
                },
                ATTR: function(bV, bT) {
                    var bY = bT[1],
                        e = L.attr ? L.attr(bV, bY) : I.attrHandle[bY] ? I.attrHandle[bY](bV) : bV[bY] != null ? bV[bY] : bV.getAttribute(bY),
                        bX = e + "",
                        bW = bT[2],
                        bU = bT[4];
                    return e == null ? bW === "!=" : !bW && L.attr ? e != null : bW === "=" ? bX === bU : bW === "*=" ? bX.indexOf(bU) >= 0 : bW === "~=" ? (" " + bX + " ").indexOf(bU) >= 0 : !bU ? bX && e !== false : bW === "!=" ? bX !== bU : bW === "^=" ? bX.indexOf(bU) === 0 : bW === "$=" ? bX.substr(bX.length - bU.length) === bU : bW === "|=" ? bX === bU || bX.substr(0, bU.length + 1) === bU + "-" : false
                },
                POS: function(bT, e, bU, bX) {
                    var bW = e[2],
                        bV = I.setFilters[bW];
                    if (bV) {
                        return bV(bT, bU, e, bX)
                    }
                }
            }
        };
        var H = I.match.POS,
            x = function(bT, e) {
                return "\\" + (e - 0 + 1)
            };
        for (var F in I.match) {
            I.match[F] = new RegExp(I.match[F].source + (/(?![^\[]*\])(?![^\(]*\))/.source));
            I.leftMatch[F] = new RegExp(/(^(?:.|\r|\n)*?)/.source + I.match[F].source.replace(/\\(\d+)/g, x))
        }
        var E = function(bT, e) {
            bT = Array.prototype.slice.call(bT, 0);
            if (e) {
                e.push.apply(e, bT);
                return e
            }
            return bT
        };
        try {
            Array.prototype.slice.call(an.documentElement.childNodes, 0)[0].nodeType
        } catch (bR) {
            E = function(bU, e) {
                var bW = 0,
                    bV = e || [];
                if (M.call(bU) === "[object Array]") {
                    Array.prototype.push.apply(bV, bU)
                } else {
                    if (typeof bU.length === "number") {
                        for (var bT = bU.length; bW < bT; bW++) {
                            bV.push(bU[bW])
                        }
                    } else {
                        for (; bU[bW]; bW++) {
                            bV.push(bU[bW])
                        }
                    }
                }
                return bV
            }
        }
        var D, B;
        if (an.documentElement.compareDocumentPosition) {
            D = function(bT, e) {
                if (bT === e) {
                    z = true;
                    return 0
                }
                if (!bT.compareDocumentPosition || !e.compareDocumentPosition) {
                    return bT.compareDocumentPosition ? -1 : 1
                }
                return bT.compareDocumentPosition(e) & 4 ? -1 : 1
            }
        } else {
            D = function(b0, bZ) {
                if (b0 === bZ) {
                    z = true;
                    return 0
                } else {
                    if (b0.sourceIndex && bZ.sourceIndex) {
                        return b0.sourceIndex - bZ.sourceIndex
                    }
                }
                var bX, bT, bU = [],
                    e = [],
                    bW = b0.parentNode,
                    bY = bZ.parentNode,
                    b1 = bW;
                if (bW === bY) {
                    return B(b0, bZ)
                } else {
                    if (!bW) {
                        return -1
                    } else {
                        if (!bY) {
                            return 1
                        }
                    }
                }
                while (b1) {
                    bU.unshift(b1);
                    b1 = b1.parentNode
                }
                b1 = bY;
                while (b1) {
                    e.unshift(b1);
                    b1 = b1.parentNode
                }
                bX = bU.length;
                bT = e.length;
                for (var bV = 0; bV < bX && bV < bT; bV++) {
                    if (bU[bV] !== e[bV]) {
                        return B(bU[bV], e[bV])
                    }
                }
                return bV === bX ? B(b0, e[bV], -1) : B(bU[bV], bZ, 1)
            };
            B = function(bT, e, bV) {
                if (bT === e) {
                    return bV
                }
                var bU = bT.nextSibling;
                while (bU) {
                    if (bU === e) {
                        return -1
                    }
                    bU = bU.nextSibling
                }
                return 1
            }
        }(function() {
            var bT = an.createElement("div"),
                bU = "script" + (new Date()).getTime(),
                e = an.documentElement;
            bT.innerHTML = "<a name='" + bU + "'/>";
            e.insertBefore(bT, e.firstChild);
            if (an.getElementById(bU)) {
                I.find.ID = function(bX, bW, bY) {
                    if (typeof bW.getElementById !== "undefined" && !bY) {
                        var bV = bW.getElementById(bX[1]);
                        return bV ? bV.id === bX[1] || typeof bV.getAttributeNode !== "undefined" && bV.getAttributeNode("id").nodeValue === bX[1] ? [bV] : ap : []
                    }
                };
                I.filter.ID = function(bW, bV) {
                    var bX = typeof bW.getAttributeNode !== "undefined" && bW.getAttributeNode("id");
                    return bW.nodeType === 1 && bX && bX.nodeValue === bV
                }
            }
            e.removeChild(bT);
            e = bT = null
        })();
        (function() {
            var bT = an.createElement("div");
            bT.appendChild(an.createComment(""));
            if (bT.getElementsByTagName("*").length > 0) {
                I.find.TAG = function(bU, e) {
                    var bX = e.getElementsByTagName(bU[1]);
                    if (bU[1] === "*") {
                        var bW = [];
                        for (var bV = 0; bX[bV]; bV++) {
                            if (bX[bV].nodeType === 1) {
                                bW.push(bX[bV])
                            }
                        }
                        bX = bW
                    }
                    return bX
                }
            }
            bT.innerHTML = "<a href='#'></a>";
            if (bT.firstChild && typeof bT.firstChild.getAttribute !== "undefined" && bT.firstChild.getAttribute("href") !== "#") {
                I.attrHandle.href = function(e) {
                    return e.getAttribute("href", 2)
                }
            }
            bT = null
        })();
        if (an.querySelectorAll) {
            (function() {
                var bT = L,
                    bV = an.createElement("div"),
                    bU = "__sizzle__";
                bV.innerHTML = "<p class='TEST'></p>";
                if (bV.querySelectorAll && bV.querySelectorAll(".TEST").length === 0) {
                    return
                }
                L = function(b7, b5, b4, b3) {
                    b5 = b5 || an;
                    if (!b3 && !L.isXML(b5)) {
                        var b2 = /^(\w+$)|^\.([\w\-]+$)|^#([\w\-]+$)/.exec(b7);
                        if (b2 && (b5.nodeType === 1 || b5.nodeType === 9)) {
                            if (b2[1]) {
                                return E(b5.getElementsByTagName(b7), b4)
                            } else {
                                if (b2[2] && I.find.CLASS && b5.getElementsByClassName) {
                                    return E(b5.getElementsByClassName(b2[2]), b4)
                                }
                            }
                        }
                        if (b5.nodeType === 9) {
                            if (b7 === "body" && b5.body) {
                                return E([b5.body], b4)
                            } else {
                                if (b2 && b2[3]) {
                                    var b1 = b5.getElementById(b2[3]);
                                    if (b1 && b1.parentNode) {
                                        if (b1.id === b2[3]) {
                                            return E([b1], b4)
                                        }
                                    } else {
                                        return E([], b4)
                                    }
                                }
                            }
                            try {
                                return E(b5.querySelectorAll(b7), b4)
                            } catch (bY) {}
                        } else {
                            if (b5.nodeType === 1 && b5.nodeName.toLowerCase() !== "object") {
                                var b0 = b5,
                                    bX = b5.getAttribute("id"),
                                    bW = bX || bU,
                                    b8 = b5.parentNode,
                                    b6 = /^\s*[+~]/.test(b7);
                                if (!bX) {
                                    b5.setAttribute("id", bW)
                                } else {
                                    bW = bW.replace(/'/g, "\\$&")
                                }
                                if (b6 && b8) {
                                    b5 = b5.parentNode
                                }
                                try {
                                    if (!b6 || b8) {
                                        return E(b5.querySelectorAll("[id='" + bW + "'] " + b7), b4)
                                    }
                                } catch (bZ) {} finally {
                                    if (!bX) {
                                        b0.removeAttribute("id")
                                    }
                                }
                            }
                        }
                    }
                    return bT(b7, b5, b4, b3)
                };
                for (var e in bT) {
                    L[e] = bT[e]
                }
                bV = null
            })()
        }(function() {
            var bW = an.documentElement,
                bU = bW.matchesSelector || bW.mozMatchesSelector || bW.webkitMatchesSelector || bW.msMatchesSelector;
            if (bU) {
                var bT = !bU.call(an.createElement("div"), "div"),
                    e = false;
                try {
                    bU.call(an.documentElement, "[test!='']:sizzle")
                } catch (bV) {
                    e = true
                }
                L.matchesSelector = function(bY, bX) {
                    bX = bX.replace(/\=\s*([^'"\]]*)\s*\]/g, "='$1']");
                    if (!L.isXML(bY)) {
                        try {
                            if (e || !I.match.PSEUDO.test(bX) && !/!=/.test(bX)) {
                                var b0 = bU.call(bY, bX);
                                if (b0 || !bT || bY.document && bY.document.nodeType !== 11) {
                                    return b0
                                }
                            }
                        } catch (bZ) {}
                    }
                    return L(bX, null, null, [bY]).length > 0
                }
            }
        })();
        (function() {
            var e = an.createElement("div");
            e.innerHTML = "<div class='test e'></div><div class='test'></div>";
            if (!e.getElementsByClassName || e.getElementsByClassName("e").length === 0) {
                return
            }
            e.lastChild.className = "e";
            if (e.getElementsByClassName("e").length === 1) {
                return
            }
            I.order.splice(1, 0, "CLASS");
            I.find.CLASS = function(bU, bT, bV) {
                if (typeof bT.getElementsByClassName !== "undefined" && !bV) {
                    return bT.getElementsByClassName(bU[1])
                }
            };
            e = null
        })();

        function w(b2, b1, b0, bZ, bY, bX) {
            for (var bU = 0, bT = bZ.length; bU < bT; bU++) {
                var bW = bZ[bU];
                if (bW) {
                    var bV = false;
                    bW = bW[b2];
                    while (bW) {
                        if (bW[A] === b0) {
                            bV = bZ[bW.sizset];
                            break
                        }
                        if (bW.nodeType === 1 && !bX) {
                            bW[A] = b0;
                            bW.sizset = bU
                        }
                        if (bW.nodeName.toLowerCase() === b1) {
                            bV = bW;
                            break
                        }
                        bW = bW[b2]
                    }
                    bZ[bU] = bV
                }
            }
        }

        function bP(b2, b1, b0, bZ, bY, bX) {
            for (var bU = 0, bT = bZ.length; bU < bT; bU++) {
                var bW = bZ[bU];
                if (bW) {
                    var bV = false;
                    bW = bW[b2];
                    while (bW) {
                        if (bW[A] === b0) {
                            bV = bZ[bW.sizset];
                            break
                        }
                        if (bW.nodeType === 1) {
                            if (!bX) {
                                bW[A] = b0;
                                bW.sizset = bU
                            }
                            if (typeof b1 !== "string") {
                                if (bW === b1) {
                                    bV = true;
                                    break
                                }
                            } else {
                                if (L.filter(b1, [bW]).length > 0) {
                                    bV = bW;
                                    break
                                }
                            }
                        }
                        bW = bW[b2]
                    }
                    bZ[bU] = bV
                }
            }
        }
        if (an.documentElement.contains) {
            L.contains = function(bT, e) {
                return bT !== e && (bT.contains ? bT.contains(e) : true)
            }
        } else {
            if (an.documentElement.compareDocumentPosition) {
                L.contains = function(bT, e) {
                    return !!(bT.compareDocumentPosition(e) & 16)
                }
            } else {
                L.contains = function() {
                    return false
                }
            }
        }
        L.isXML = function(bT) {
            var e = (bT ? bT.ownerDocument || bT : 0).documentElement;
            return e ? e.nodeName !== "HTML" : false
        };
        var C = function(b0, bZ, bW) {
            var bV, bX = [],
                bU = "",
                bY = bZ.nodeType ? [bZ] : bZ;
            while ((bV = I.match.PSEUDO.exec(b0))) {
                bU += bV[0];
                b0 = b0.replace(I.match.PSEUDO, "")
            }
            b0 = I.relative[b0] ? b0 + "*" : b0;
            for (var bT = 0, e = bY.length; bT < e; bT++) {
                L(b0, bY[bT], bX, bW)
            }
            return L.filter(bU, bX)
        };
        L.attr = al.attr;
        L.selectors.attrMap = {};
        al.find = L;
        al.expr = L.selectors;
        al.expr[":"] = al.expr.filters;
        al.unique = L.uniqueSort;
        al.text = L.getText;
        al.isXMLDoc = L.isXML;
        al.contains = L.contains
    })();
    var a3 = /Until$/,
        aD = /^(?:parents|prevUntil|prevAll)/,
        bs = /,/,
        bI = /^.[^:#\[\.,]*$/,
        ad = Array.prototype.slice,
        V = al.expr.match.POS,
        aJ = {
            children: true,
            contents: true,
            next: true,
            prev: true
        };
    al.fn.extend({
        find: function(x) {
            var e = this,
                y, w;
            if (typeof x !== "string") {
                return al(x).filter(function() {
                    for (y = 0, w = e.length; y < w; y++) {
                        if (al.contains(e[y], this)) {
                            return true
                        }
                    }
                })
            }
            var C = this.pushStack("", "find", x),
                A, B, z;
            for (y = 0, w = this.length; y < w; y++) {
                A = C.length;
                al.find(x, this[y], C);
                if (y > 0) {
                    for (B = A; B < C.length; B++) {
                        for (z = 0; z < A; z++) {
                            if (C[z] === C[B]) {
                                C.splice(B--, 1);
                                break
                            }
                        }
                    }
                }
            }
            return C
        },
        has: function(w) {
            var e = al(w);
            return this.filter(function() {
                for (var y = 0, x = e.length; y < x; y++) {
                    if (al.contains(this, e[y])) {
                        return true
                    }
                }
            })
        },
        not: function(e) {
            return this.pushStack(aQ(this, e, false), "not", e)
        },
        filter: function(e) {
            return this.pushStack(aQ(this, e, true), "filter", e)
        },
        is: function(e) {
            return !!e && (typeof e === "string" ? V.test(e) ? al(e, this.context).index(this[0]) >= 0 : al.filter(e, this).length > 0 : this.filter(e).length > 0)
        },
        closest: function(y, w) {
            var D = [],
                z, x, C = this[0];
            if (al.isArray(y)) {
                var B = 1;
                while (C && C.ownerDocument && C !== w) {
                    for (z = 0; z < y.length; z++) {
                        if (al(C).is(y[z])) {
                            D.push({
                                selector: y[z],
                                elem: C,
                                level: B
                            })
                        }
                    }
                    C = C.parentNode;
                    B++
                }
                return D
            }
            var A = V.test(y) || typeof y !== "string" ? al(y, w || this.context) : 0;
            for (z = 0, x = this.length; z < x; z++) {
                C = this[z];
                while (C) {
                    if (A ? A.index(C) > -1 : al.find.matchesSelector(C, y)) {
                        D.push(C);
                        break
                    } else {
                        C = C.parentNode;
                        if (!C || !C.ownerDocument || C === w || C.nodeType === 11) {
                            break
                        }
                    }
                }
            }
            D = D.length > 1 ? al.unique(D) : D;
            return this.pushStack(D, "closest", y)
        },
        index: function(e) {
            if (!e) {
                return (this[0] && this[0].parentNode) ? this.prevAll().length : -1
            }
            if (typeof e === "string") {
                return al.inArray(this[0], al(e))
            }
            return al.inArray(e.jquery ? e[0] : e, this)
        },
        add: function(w, e) {
            var y = typeof w === "string" ? al(w, e) : al.makeArray(w && w.nodeType ? [w] : w),
                x = al.merge(this.get(), y);
            return this.pushStack(Q(y[0]) || Q(x[0]) ? x : al.unique(x))
        },
        andSelf: function() {
            return this.add(this.prevObject)
        }
    });

    function Q(e) {
        return !e || !e.parentNode || e.parentNode.nodeType === 11
    }
    al.each({
        parent: function(w) {
            var e = w.parentNode;
            return e && e.nodeType !== 11 ? e : null
        },
        parents: function(e) {
            return al.dir(e, "parentNode")
        },
        parentsUntil: function(w, x, e) {
            return al.dir(w, "parentNode", e)
        },
        next: function(e) {
            return al.nth(e, 2, "nextSibling")
        },
        prev: function(e) {
            return al.nth(e, 2, "previousSibling")
        },
        nextAll: function(e) {
            return al.dir(e, "nextSibling")
        },
        prevAll: function(e) {
            return al.dir(e, "previousSibling")
        },
        nextUntil: function(w, x, e) {
            return al.dir(w, "nextSibling", e)
        },
        prevUntil: function(w, x, e) {
            return al.dir(w, "previousSibling", e)
        },
        siblings: function(e) {
            return al.sibling(e.parentNode.firstChild, e)
        },
        children: function(e) {
            return al.sibling(e.firstChild)
        },
        contents: function(e) {
            return al.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : al.makeArray(e.childNodes)
        }
    }, function(x, w) {
        al.fn[x] = function(y, e) {
            var A = al.map(this, w, y),
                z = ad.call(arguments);
            if (!a3.test(x)) {
                e = y
            }
            if (e && typeof e === "string") {
                A = al.filter(e, A)
            }
            A = this.length > 1 && !aJ[x] ? al.unique(A) : A;
            if ((this.length > 1 || bs.test(e)) && aD.test(x)) {
                A = A.reverse()
            }
            return this.pushStack(A, x, z.join(","))
        }
    });
    al.extend({
        filter: function(w, e, x) {
            if (x) {
                w = ":not(" + w + ")"
            }
            return e.length === 1 ? al.find.matchesSelector(e[0], w) ? [e[0]] : [] : al.find.matches(w, e)
        },
        dir: function(w, e, z) {
            var y = [],
                x = w[e];
            while (x && x.nodeType !== 9 && (z === ap || x.nodeType !== 1 || !al(x).is(z))) {
                if (x.nodeType === 1) {
                    y.push(x)
                }
                x = x[e]
            }
            return y
        },
        nth: function(x, w, A, z) {
            w = w || 1;
            var y = 0;
            for (; x; x = x[A]) {
                if (x.nodeType === 1 && ++y === w) {
                    break
                }
            }
            return x
        },
        sibling: function(x, e) {
            var w = [];
            for (; x; x = x.nextSibling) {
                if (x.nodeType === 1 && x !== e) {
                    w.push(x)
                }
            }
            return w
        }
    });

    function aQ(z, y, x) {
        y = y || 0;
        if (al.isFunction(y)) {
            return al.grep(z, function(A, B) {
                var e = !!y.call(A, B, A);
                return e === x
            })
        } else {
            if (y.nodeType) {
                return al.grep(z, function(e, A) {
                    return (e === y) === x
                })
            } else {
                if (typeof y === "string") {
                    var w = al.grep(z, function(e) {
                        return e.nodeType === 1
                    });
                    if (bI.test(y)) {
                        return al.filter(y, w, !x)
                    } else {
                        y = al.filter(y, w)
                    }
                }
            }
        }
        return al.grep(z, function(e, A) {
            return (al.inArray(e, y) >= 0) === x
        })
    }

    function a(w) {
        var e = a2.split(" "),
            x = w.createDocumentFragment();
        if (x.createElement) {
            while (e.length) {
                x.createElement(e.pop())
            }
        }
        return x
    }
    var a2 = "abbr article aside audio canvas datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",
        av = / jQuery\d+="(?:\d+|null)"/g,
        aE = /^\s+/,
        ae = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/ig,
        c = /<([\w:]+)/,
        u = /<tbody/i,
        ah = /<|&#?\w+;/,
        at = /<(?:script|style)/i,
        ac = /<(?:script|object|embed|option|style)/i,
        aw = new RegExp("<(?:" + a2.replace(" ", "|") + ")", "i"),
        m = /checked\s*(?:[^=]|=\s*.checked.)/i,
        bF = /\/(java|ecma)script/i,
        a5 = /^\s*<!(?:\[CDATA\[|\-\-)/,
        aI = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            area: [1, "<map>", "</map>"],
            _default: [0, "", ""]
        },
        ao = a(an);
    aI.optgroup = aI.option;
    aI.tbody = aI.tfoot = aI.colgroup = aI.caption = aI.thead;
    aI.th = aI.td;
    if (!al.support.htmlSerialize) {
        aI._default = [1, "div<div>", "</div>"]
    }
    al.fn.extend({
        text: function(e) {
            if (al.isFunction(e)) {
                return this.each(function(x) {
                    var w = al(this);
                    w.text(e.call(this, x, w.text()))
                })
            }
            if (typeof e !== "object" && e !== ap) {
                return this.empty().append((this[0] && this[0].ownerDocument || an).createTextNode(e))
            }
            return al.text(this)
        },
        wrapAll: function(e) {
            if (al.isFunction(e)) {
                return this.each(function(x) {
                    al(this).wrapAll(e.call(this, x))
                })
            }
            if (this[0]) {
                var w = al(e, this[0].ownerDocument).eq(0).clone(true);
                if (this[0].parentNode) {
                    w.insertBefore(this[0])
                }
                w.map(function() {
                    var x = this;
                    while (x.firstChild && x.firstChild.nodeType === 1) {
                        x = x.firstChild
                    }
                    return x
                }).append(this)
            }
            return this
        },
        wrapInner: function(e) {
            if (al.isFunction(e)) {
                return this.each(function(w) {
                    al(this).wrapInner(e.call(this, w))
                })
            }
            return this.each(function() {
                var w = al(this),
                    x = w.contents();
                if (x.length) {
                    x.wrapAll(e)
                } else {
                    w.append(e)
                }
            })
        },
        wrap: function(e) {
            return this.each(function() {
                al(this).wrapAll(e)
            })
        },
        unwrap: function() {
            return this.parent().each(function() {
                if (!al.nodeName(this, "body")) {
                    al(this).replaceWith(this.childNodes)
                }
            }).end()
        },
        append: function() {
            return this.domManip(arguments, true, function(e) {
                if (this.nodeType === 1) {
                    this.appendChild(e)
                }
            })
        },
        prepend: function() {
            return this.domManip(arguments, true, function(e) {
                if (this.nodeType === 1) {
                    this.insertBefore(e, this.firstChild)
                }
            })
        },
        before: function() {
            if (this[0] && this[0].parentNode) {
                return this.domManip(arguments, false, function(w) {
                    this.parentNode.insertBefore(w, this)
                })
            } else {
                if (arguments.length) {
                    var e = al(arguments[0]);
                    e.push.apply(e, this.toArray());
                    return this.pushStack(e, "before", arguments)
                }
            }
        },
        after: function() {
            if (this[0] && this[0].parentNode) {
                return this.domManip(arguments, false, function(w) {
                    this.parentNode.insertBefore(w, this.nextSibling)
                })
            } else {
                if (arguments.length) {
                    var e = this.pushStack(this, "after", arguments);
                    e.push.apply(e, al(arguments[0]).toArray());
                    return e
                }
            }
        },
        remove: function(w, e) {
            for (var x = 0, y;
                (y = this[x]) != null; x++) {
                if (!w || al.filter(w, [y]).length) {
                    if (!e && y.nodeType === 1) {
                        al.cleanData(y.getElementsByTagName("*"));
                        al.cleanData([y])
                    }
                    if (y.parentNode) {
                        y.parentNode.removeChild(y)
                    }
                }
            }
            return this
        },
        empty: function() {
            for (var e = 0, w;
                (w = this[e]) != null; e++) {
                if (w.nodeType === 1) {
                    al.cleanData(w.getElementsByTagName("*"))
                }
                while (w.firstChild) {
                    w.removeChild(w.firstChild)
                }
            }
            return this
        },
        clone: function(w, e) {
            w = w == null ? false : w;
            e = e == null ? w : e;
            return this.map(function() {
                return al.clone(this, w, e)
            })
        },
        html: function(w) {
            if (w === ap) {
                return this[0] && this[0].nodeType === 1 ? this[0].innerHTML.replace(av, "") : null
            } else {
                if (typeof w === "string" && !at.test(w) && (al.support.leadingWhitespace || !aE.test(w)) && !aI[(c.exec(w) || ["", ""])[1].toLowerCase()]) {
                    w = w.replace(ae, "<$1></$2>");
                    try {
                        for (var y = 0, x = this.length; y < x; y++) {
                            if (this[y].nodeType === 1) {
                                al.cleanData(this[y].getElementsByTagName("*"));
                                this[y].innerHTML = w
                            }
                        }
                    } catch (z) {
                        this.empty().append(w)
                    }
                } else {
                    if (al.isFunction(w)) {
                        this.each(function(A) {
                            var e = al(this);
                            e.html(w.call(this, A, e.html()))
                        })
                    } else {
                        this.empty().append(w)
                    }
                }
            }
            return this
        },
        replaceWith: function(e) {
            if (this[0] && this[0].parentNode) {
                if (al.isFunction(e)) {
                    return this.each(function(y) {
                        var x = al(this),
                            w = x.html();
                        x.replaceWith(e.call(this, y, w))
                    })
                }
                if (typeof e !== "string") {
                    e = al(e).detach()
                }
                return this.each(function() {
                    var w = this.nextSibling,
                        x = this.parentNode;
                    al(this).remove();
                    if (w) {
                        al(w).before(e)
                    } else {
                        al(x).append(e)
                    }
                })
            } else {
                return this.length ? this.pushStack(al(al.isFunction(e) ? e() : e), "replaceWith", e) : this
            }
        },
        detach: function(e) {
            return this.remove(e, true)
        },
        domManip: function(F, E, D) {
            var B, z, C, H, G = F[0],
                x = [];
            if (!al.support.checkClone && arguments.length === 3 && typeof G === "string" && m.test(G)) {
                return this.each(function() {
                    al(this).domManip(F, E, D, true)
                })
            }
            if (al.isFunction(G)) {
                return this.each(function(I) {
                    var e = al(this);
                    F[0] = G.call(this, I, E ? e.html() : ap);
                    e.domManip(F, E, D)
                })
            }
            if (this[0]) {
                H = G && G.parentNode;
                if (al.support.parentNode && H && H.nodeType === 11 && H.childNodes.length === this.length) {
                    B = {
                        fragment: H
                    }
                } else {
                    B = al.buildFragment(F, this, x)
                }
                C = B.fragment;
                if (C.childNodes.length === 1) {
                    z = C = C.firstChild
                } else {
                    z = C.firstChild
                }
                if (z) {
                    E = E && al.nodeName(z, "tr");
                    for (var y = 0, w = this.length, A = w - 1; y < w; y++) {
                        D.call(E ? bt(this[y], z) : this[y], B.cacheable || (w > 1 && y < A) ? al.clone(C, true, true) : C)
                    }
                }
                if (x.length) {
                    al.each(x, bH)
                }
            }
            return this
        }
    });

    function bt(w, e) {
        return al.nodeName(w, "table") ? (w.getElementsByTagName("tbody")[0] || w.appendChild(w.ownerDocument.createElement("tbody"))) : w
    }

    function r(x, e) {
        if (e.nodeType !== 1 || !al.hasData(x)) {
            return
        }
        var C, z, w, B = al._data(x),
            A = al._data(e, B),
            y = B.events;
        if (y) {
            delete A.handle;
            A.events = {};
            for (C in y) {
                for (z = 0, w = y[C].length; z < w; z++) {
                    al.event.add(e, C + (y[C][z].namespace ? "." : "") + y[C][z].namespace, y[C][z], y[C][z].data)
                }
            }
        }
        if (A.data) {
            A.data = al.extend({}, A.data)
        }
    }

    function ax(w, e) {
        var x;
        if (e.nodeType !== 1) {
            return
        }
        if (e.clearAttributes) {
            e.clearAttributes()
        }
        if (e.mergeAttributes) {
            e.mergeAttributes(w)
        }
        x = e.nodeName.toLowerCase();
        if (x === "object") {
            e.outerHTML = w.outerHTML
        } else {
            if (x === "input" && (w.type === "checkbox" || w.type === "radio")) {
                if (w.checked) {
                    e.defaultChecked = e.checked = w.checked
                }
                if (e.value !== w.value) {
                    e.value = w.value
                }
            } else {
                if (x === "option") {
                    e.selected = w.defaultSelected
                } else {
                    if (x === "input" || x === "textarea") {
                        e.defaultValue = w.defaultValue
                    }
                }
            }
        }
        e.removeAttribute(al.expando)
    }
    al.buildFragment = function(x, w, C) {
        var B, e, y, z, A = x[0];
        if (w && w[0]) {
            z = w[0].ownerDocument || w[0]
        }
        if (!z.createDocumentFragment) {
            z = an
        }
        if (x.length === 1 && typeof A === "string" && A.length < 512 && z === an && A.charAt(0) === "<" && !ac.test(A) && (al.support.checkClone || !m.test(A)) && (!al.support.unknownElems && aw.test(A))) {
            e = true;
            y = al.fragments[A];
            if (y && y !== 1) {
                B = y
            }
        }
        if (!B) {
            B = z.createDocumentFragment();
            al.clean(x, z, B, C)
        }
        if (e) {
            al.fragments[A] = y ? B : 1
        }
        return {
            fragment: B,
            cacheable: e
        }
    };
    al.fragments = {};
    al.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function(x, w) {
        al.fn[x] = function(z) {
            var e = [],
                C = al(z),
                B = this.length === 1 && this[0].parentNode;
            if (B && B.nodeType === 11 && B.childNodes.length === 1 && C.length === 1) {
                C[w](this[0]);
                return this
            } else {
                for (var A = 0, y = C.length; A < y; A++) {
                    var D = (A > 0 ? this.clone(true) : this).get();
                    al(C[A])[w](D);
                    e = e.concat(D)
                }
                return this.pushStack(e, x, C.selector)
            }
        }
    });

    function by(e) {
        if (typeof e.getElementsByTagName !== "undefined") {
            return e.getElementsByTagName("*")
        } else {
            if (typeof e.querySelectorAll !== "undefined") {
                return e.querySelectorAll("*")
            } else {
                return []
            }
        }
    }

    function aK(e) {
        if (e.type === "checkbox" || e.type === "radio") {
            e.defaultChecked = e.checked
        }
    }

    function S(w) {
        var e = (w.nodeName || "").toLowerCase();
        if (e === "input") {
            aK(w)
        } else {
            if (e !== "script" && typeof w.getElementsByTagName !== "undefined") {
                al.grep(w.getElementsByTagName("input"), aK)
            }
        }
    }
    al.extend({
        clone: function(x, w, B) {
            var A = x.cloneNode(true),
                e, y, z;
            if ((!al.support.noCloneEvent || !al.support.noCloneChecked) && (x.nodeType === 1 || x.nodeType === 11) && !al.isXMLDoc(x)) {
                ax(x, A);
                e = by(x);
                y = by(A);
                for (z = 0; e[z]; ++z) {
                    if (y[z]) {
                        ax(e[z], y[z])
                    }
                }
            }
            if (w) {
                r(x, A);
                if (B) {
                    e = by(x);
                    y = by(A);
                    for (z = 0; e[z]; ++z) {
                        r(e[z], y[z])
                    }
                }
            }
            e = y = null;
            return A
        },
        clean: function(M, L, K, J) {
            var I;
            L = L || an;
            if (typeof L.createElement === "undefined") {
                L = L.ownerDocument || L[0] && L[0].ownerDocument || an
            }
            var H = [],
                C;
            for (var F = 0, z;
                (z = M[F]) != null; F++) {
                if (typeof z === "number") {
                    z += ""
                }
                if (!z) {
                    continue
                }
                if (typeof z === "string") {
                    if (!ah.test(z)) {
                        z = L.createTextNode(z)
                    } else {
                        z = z.replace(ae, "<$1></$2>");
                        var G = (c.exec(z) || ["", ""])[1].toLowerCase(),
                            x = aI[G] || aI._default,
                            E = x[0],
                            w = L.createElement("div");
                        if (L === an) {
                            ao.appendChild(w)
                        } else {
                            a(L).appendChild(w)
                        }
                        w.innerHTML = x[1] + z + x[2];
                        while (E--) {
                            w = w.lastChild
                        }
                        if (!al.support.tbody) {
                            var B = u.test(z),
                                D = G === "table" && !B ? w.firstChild && w.firstChild.childNodes : x[1] === "<table>" && !B ? w.childNodes : [];
                            for (C = D.length - 1; C >= 0; --C) {
                                if (al.nodeName(D[C], "tbody") && !D[C].childNodes.length) {
                                    D[C].parentNode.removeChild(D[C])
                                }
                            }
                        }
                        if (!al.support.leadingWhitespace && aE.test(z)) {
                            w.insertBefore(L.createTextNode(aE.exec(z)[0]), w.firstChild)
                        }
                        z = w.childNodes
                    }
                }
                var A;
                if (!al.support.appendChecked) {
                    if (z[0] && typeof(A = z.length) === "number") {
                        for (C = 0; C < A; C++) {
                            S(z[C])
                        }
                    } else {
                        S(z)
                    }
                }
                if (z.nodeType) {
                    H.push(z)
                } else {
                    H = al.merge(H, z)
                }
            }
            if (K) {
                I = function(e) {
                    return !e.type || bF.test(e.type)
                };
                for (F = 0; H[F]; F++) {
                    if (J && al.nodeName(H[F], "script") && (!H[F].type || H[F].type.toLowerCase() === "text/javascript")) {
                        J.push(H[F].parentNode ? H[F].parentNode.removeChild(H[F]) : H[F])
                    } else {
                        if (H[F].nodeType === 1) {
                            var y = al.grep(H[F].getElementsByTagName("script"), I);
                            H.splice.apply(H, [F + 1, 0].concat(y))
                        }
                        K.appendChild(H[F])
                    }
                }
            }
            return H
        },
        cleanData: function(D) {
            var C, w, e = al.cache,
                A = al.event.special,
                z = al.support.deleteExpando;
            for (var y = 0, x;
                (x = D[y]) != null; y++) {
                if (x.nodeName && al.noData[x.nodeName.toLowerCase()]) {
                    continue
                }
                w = x[al.expando];
                if (w) {
                    C = e[w];
                    if (C && C.events) {
                        for (var B in C.events) {
                            if (A[B]) {
                                al.event.remove(x, B)
                            } else {
                                al.removeEvent(x, B, C.handle)
                            }
                        }
                        if (C.handle) {
                            C.handle.elem = null
                        }
                    }
                    if (z) {
                        delete x[al.expando]
                    } else {
                        if (x.removeAttribute) {
                            x.removeAttribute(al.expando)
                        }
                    }
                    delete e[w]
                }
            }
        }
    });

    function bH(w, e) {
        if (e.src) {
            al.ajax({
                url: e.src,
                async: false,
                dataType: "script"
            })
        } else {
            al.globalEval((e.text || e.textContent || e.innerHTML || "").replace(a5, "/*$0*/"))
        }
        if (e.parentNode) {
            e.parentNode.removeChild(e)
        }
    }
    var a1 = /alpha\([^)]*\)/i,
        aG = /opacity=([^)]*)/,
        O = /([A-Z]|^ms)/g,
        bu = /^-?\d+(?:px)?$/i,
        bG = /^-?\d/,
        W = /^([\-+])=([\-+.\de]+)/,
        bq = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        aA = ["Left", "Right"],
        bl = ["Top", "Bottom"],
        ak, aT, bh;
    al.fn.css = function(x, w) {
        if (arguments.length === 2 && w === ap) {
            return this
        }
        return al.access(this, x, w, true, function(y, e, z) {
            return z !== ap ? al.style(y, e, z) : al.css(y, e)
        })
    };
    al.extend({
        cssHooks: {
            opacity: {
                get: function(w, e) {
                    if (e) {
                        var x = ak(w, "opacity", "opacity");
                        return x === "" ? "1" : x
                    } else {
                        return w.style.opacity
                    }
                }
            }
        },
        cssNumber: {
            fillOpacity: true,
            fontWeight: true,
            lineHeight: true,
            opacity: true,
            orphans: true,
            widows: true,
            zIndex: true,
            zoom: true
        },
        cssProps: {
            "float": al.support.cssFloat ? "cssFloat" : "styleFloat"
        },
        style: function(E, D, B, A) {
            if (!E || E.nodeType === 3 || E.nodeType === 8 || !E.style) {
                return
            }
            var x, C, y = al.camelCase(D),
                w = E.style,
                F = al.cssHooks[y];
            D = al.cssProps[y] || y;
            if (B !== ap) {
                C = typeof B;
                if (C === "string" && (x = W.exec(B))) {
                    B = (+(x[1] + 1) * +x[2]) + parseFloat(al.css(E, D));
                    C = "number"
                }
                if (B == null || C === "number" && isNaN(B)) {
                    return
                }
                if (C === "number" && !al.cssNumber[y]) {
                    B += "px"
                }
                if (!F || !("set" in F) || (B = F.set(E, B)) !== ap) {
                    try {
                        w[D] = B
                    } catch (z) {}
                }
            } else {
                if (F && "get" in F && (x = F.get(E, false, A)) !== ap) {
                    return x
                }
                return w[D]
            }
        },
        css: function(x, w, z) {
            var y, e;
            w = al.camelCase(w);
            e = al.cssHooks[w];
            w = al.cssProps[w] || w;
            if (w === "cssFloat") {
                w = "float"
            }
            if (e && "get" in e && (y = e.get(x, true, z)) !== ap) {
                return y
            } else {
                if (ak) {
                    return ak(x, w)
                }
            }
        },
        swap: function(x, w, A) {
            var z = {};
            for (var y in w) {
                z[y] = x.style[y];
                x.style[y] = w[y]
            }
            A.call(x);
            for (y in w) {
                x.style[y] = z[y]
            }
        }
    });
    al.curCSS = al.css;
    al.each(["height", "width"], function(w, x) {
        al.cssHooks[x] = {
            get: function(y, e, A) {
                var z;
                if (e) {
                    if (y.offsetWidth !== 0) {
                        return n(y, x, A)
                    } else {
                        al.swap(y, bq, function() {
                            z = n(y, x, A)
                        })
                    }
                    return z
                }
            },
            set: function(y, e) {
                if (bu.test(e)) {
                    e = parseFloat(e);
                    if (e >= 0) {
                        return e + "px"
                    }
                } else {
                    return e
                }
            }
        }
    });
    if (!al.support.opacity) {
        al.cssHooks.opacity = {
            get: function(w, e) {
                return aG.test((e && w.currentStyle ? w.currentStyle.filter : w.style.filter) || "") ? (parseFloat(RegExp.$1) / 100) + "" : e ? "1" : ""
            },
            set: function(w, e) {
                var A = w.style,
                    y = w.currentStyle,
                    x = al.isNumeric(e) ? "alpha(opacity=" + e * 100 + ")" : "",
                    z = y && y.filter || A.filter || "";
                A.zoom = 1;
                if (e >= 1 && al.trim(z.replace(a1, "")) === "") {
                    A.removeAttribute("filter");
                    if (y && !y.filter) {
                        return
                    }
                }
                A.filter = a1.test(z) ? z.replace(a1, x) : z + " " + x
            }
        }
    }
    al(function() {
        if (!al.support.reliableMarginRight) {
            al.cssHooks.marginRight = {
                get: function(w, e) {
                    var x;
                    al.swap(w, {
                        display: "inline-block"
                    }, function() {
                        if (e) {
                            x = ak(w, "margin-right", "marginRight")
                        } else {
                            x = w.style.marginRight
                        }
                    });
                    return x
                }
            }
        }
    });
    if (an.defaultView && an.defaultView.getComputedStyle) {
        aT = function(w, e) {
            var z, y, x;
            e = e.replace(O, "-$1").toLowerCase();
            if (!(y = w.ownerDocument.defaultView)) {
                return ap
            }
            if ((x = y.getComputedStyle(w, null))) {
                z = x.getPropertyValue(e);
                if (z === "" && !al.contains(w.ownerDocument.documentElement, w)) {
                    z = al.style(w, e)
                }
            }
            return z
        }
    }
    if (an.documentElement.currentStyle) {
        bh = function(x, w) {
            var B, e, A, y = x.currentStyle && x.currentStyle[w],
                z = x.style;
            if (y === null && z && (A = z[w])) {
                y = A
            }
            if (!bu.test(y) && bG.test(y)) {
                B = z.left;
                e = x.runtimeStyle && x.runtimeStyle.left;
                if (e) {
                    x.runtimeStyle.left = x.currentStyle.left
                }
                z.left = w === "fontSize" ? "1em" : (y || 0);
                y = z.pixelLeft + "px";
                z.left = B;
                if (e) {
                    x.runtimeStyle.left = e
                }
            }
            return y === "" ? "auto" : y
        }
    }
    ak = aT || bh;

    function n(w, e, z) {
        var y = e === "width" ? w.offsetWidth : w.offsetHeight,
            x = e === "width" ? aA : bl;
        if (y > 0) {
            if (z !== "border") {
                al.each(x, function() {
                    if (!z) {
                        y -= parseFloat(al.css(w, "padding" + this)) || 0
                    }
                    if (z === "margin") {
                        y += parseFloat(al.css(w, z + this)) || 0
                    } else {
                        y -= parseFloat(al.css(w, "border" + this + "Width")) || 0
                    }
                })
            }
            return y + "px"
        }
        y = ak(w, e, e);
        if (y < 0 || y == null) {
            y = w.style[e] || 0
        }
        y = parseFloat(y) || 0;
        if (z) {
            al.each(x, function() {
                y += parseFloat(al.css(w, "padding" + this)) || 0;
                if (z !== "padding") {
                    y += parseFloat(al.css(w, "border" + this + "Width")) || 0
                }
                if (z === "margin") {
                    y += parseFloat(al.css(w, z + this)) || 0
                }
            })
        }
        return y + "px"
    }
    if (al.expr && al.expr.filters) {
        al.expr.filters.hidden = function(x) {
            var w = x.offsetWidth,
                e = x.offsetHeight;
            return (w === 0 && e === 0) || (!al.support.reliableHiddenOffsets && ((x.style && x.style.display) || al.css(x, "display")) === "none")
        };
        al.expr.filters.visible = function(e) {
            return !al.expr.filters.hidden(e)
        }
    }
    var a0 = /%20/g,
        aC = /\[\]$/,
        bL = /\r?\n/g,
        bJ = /#.*$/,
        aN = /^(.*?):[ \t]*([^\r\n]*)\r?$/mg,
        bj = /^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,
        a4 = /^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/,
        ba = /^(?:GET|HEAD)$/,
        b = /^\/\//,
        Z = /\?/,
        bp = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
        o = /^(?:select|textarea)/i,
        g = /\s+/,
        bK = /([?&])_=[^&]*/,
        Y = /^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+))?)?/,
        P = al.fn.load,
        am = {},
        p = {},
        aO, q, bf = ["*/"] + ["*"];
    try {
        aO = bE.href
    } catch (aH) {
        aO = an.createElement("a");
        aO.href = "";
        aO = aO.href
    }
    q = Y.exec(aO.toLowerCase()) || [];

    function d(e) {
        return function(x, w) {
            if (typeof x !== "string") {
                w = x;
                x = "*"
            }
            if (al.isFunction(w)) {
                var D = x.toLowerCase().split(g),
                    z = 0,
                    A = D.length,
                    y, B, C;
                for (; z < A; z++) {
                    y = D[z];
                    C = /^\+/.test(y);
                    if (C) {
                        y = y.substr(1) || "*"
                    }
                    B = e[y] = e[y] || [];
                    B[C ? "unshift" : "push"](w)
                }
            }
        }
    }

    function bg(F, E, D, C, B, A) {
        B = B || E.dataTypes[0];
        A = A || {};
        A[B] = true;
        var z = F[B],
            x = 0,
            w = z ? z.length : 0,
            y = (F === am),
            G;
        for (; x < w && (y || !G); x++) {
            G = z[x](E, D, C);
            if (typeof G === "string") {
                if (!y || A[G]) {
                    G = ap
                } else {
                    E.dataTypes.unshift(G);
                    G = bg(F, E, D, C, G, A)
                }
            }
        }
        if ((y || !G) && !A["*"]) {
            G = bg(F, E, D, C, "*", A)
        }
        return G
    }

    function az(x, e) {
        var z, w, y = al.ajaxSettings.flatOptions || {};
        for (z in e) {
            if (e[z] !== ap) {
                (y[z] ? x : (w || (w = {})))[z] = e[z]
            }
        }
        if (w) {
            al.extend(true, x, w)
        }
    }
    al.fn.extend({
        load: function(C, B, A) {
            if (typeof C !== "string" && P) {
                return P.apply(this, arguments)
            } else {
                if (!this.length) {
                    return this
                }
            }
            var z = C.indexOf(" ");
            if (z >= 0) {
                var y = C.slice(z, C.length);
                C = C.slice(0, z)
            }
            var x = "GET";
            if (B) {
                if (al.isFunction(B)) {
                    A = B;
                    B = ap
                } else {
                    if (typeof B === "object") {
                        B = al.param(B, al.ajaxSettings.traditional);
                        x = "POST"
                    }
                }
            }
            var w = this;
            al.ajax({
                url: C,
                type: x,
                dataType: "html",
                data: B,
                complete: function(D, e, E) {
                    E = D.responseText;
                    if (D.isResolved()) {
                        D.done(function(F) {
                            E = F
                        });
                        w.html(y ? al("<div>").append(E.replace(bp, "")).find(y) : E)
                    }
                    if (A) {
                        w.each(A, [E, e, D])
                    }
                }
            });
            return this
        },
        serialize: function() {
            return al.param(this.serializeArray())
        },
        serializeArray: function() {
            return this.map(function() {
                return this.elements ? al.makeArray(this.elements) : this
            }).filter(function() {
                return this.name && !this.disabled && (this.checked || o.test(this.nodeName) || bj.test(this.type))
            }).map(function(w, e) {
                var x = al(this).val();
                return x == null ? null : al.isArray(x) ? al.map(x, function(y, z) {
                    return {
                        name: e.name,
                        value: y.replace(bL, "\r\n")
                    }
                }) : {
                    name: e.name,
                    value: x.replace(bL, "\r\n")
                }
            }).get()
        }
    });
    al.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "), function(e, w) {
        al.fn[w] = function(x) {
            return this.bind(w, x)
        }
    });
    al.each(["get", "post"], function(w, x) {
        al[x] = function(y, e, A, z) {
            if (al.isFunction(e)) {
                z = z || A;
                A = e;
                e = ap
            }
            return al.ajax({
                type: x,
                url: y,
                data: e,
                success: A,
                dataType: z
            })
        }
    });
    al.extend({
        getScript: function(w, e) {
            return al.get(w, ap, e, "script")
        },
        getJSON: function(w, e, x) {
            return al.get(w, e, x, "json")
        },
        ajaxSetup: function(w, e) {
            if (e) {
                az(w, al.ajaxSettings)
            } else {
                e = w;
                w = al.ajaxSettings
            }
            az(w, e);
            return w
        },
        ajaxSettings: {
            url: aO,
            isLocal: a4.test(q[1]),
            global: true,
            type: "GET",
            contentType: "application/x-www-form-urlencoded",
            processData: true,
            async: true,
            accepts: {
                xml: "application/xml, text/xml",
                html: "text/html",
                text: "text/plain",
                json: "application/json, text/javascript",
                "*": bf
            },
            contents: {
                xml: /xml/,
                html: /html/,
                json: /json/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText"
            },
            converters: {
                "* text": aq.String,
                "text html": true,
                "text json": al.parseJSON,
                "text xml": al.parseXML
            },
            flatOptions: {
                context: true,
                url: true
            }
        },
        ajaxPrefilter: d(am),
        ajaxTransport: d(p),
        ajax: function(L, K) {
            if (typeof L === "object") {
                K = L;
                L = ap
            }
            K = K || {};
            var B = al.ajaxSetup({}, K),
                bU = B.context || B,
                E = bU !== B && (bU.nodeType || bU instanceof al) ? al(bU) : al.event,
                bT = al.Deferred(),
                bP = al.Callbacks("once memory"),
                z = B.statusCode || {},
                A, F = {},
                bQ = {},
                bS, x, M, C, G, y = 0,
                w, J, H = {
                    readyState: 0,
                    setRequestHeader: function(bV, e) {
                        if (!y) {
                            var bW = bV.toLowerCase();
                            bV = bQ[bW] = bQ[bW] || bV;
                            F[bV] = e
                        }
                        return this
                    },
                    getAllResponseHeaders: function() {
                        return y === 2 ? bS : null
                    },
                    getResponseHeader: function(bV) {
                        var e;
                        if (y === 2) {
                            if (!x) {
                                x = {};
                                while ((e = aN.exec(bS))) {
                                    x[e[1].toLowerCase()] = e[2]
                                }
                            }
                            e = x[bV.toLowerCase()]
                        }
                        return e === ap ? null : e
                    },
                    overrideMimeType: function(e) {
                        if (!y) {
                            B.mimeType = e
                        }
                        return this
                    },
                    abort: function(e) {
                        e = e || "abort";
                        if (M) {
                            M.abort(e)
                        }
                        D(0, e);
                        return this
                    }
                };

            function D(b5, b4, b2, b1) {
                if (y === 2) {
                    return
                }
                y = 2;
                if (C) {
                    clearTimeout(C)
                }
                M = ap;
                bS = b1 || "";
                H.readyState = b5 > 0 ? 4 : 0;
                var bY, b6, b3, bW = b4,
                    bX = b2 ? bC(B, H, b2) : ap,
                    bV, b0;
                if (b5 >= 200 && b5 < 300 || b5 === 304) {
                    if (B.ifModified) {
                        if ((bV = H.getResponseHeader("Last-Modified"))) {
                            al.lastModified[A] = bV
                        }
                        if ((b0 = H.getResponseHeader("Etag"))) {
                            al.etag[A] = b0
                        }
                    }
                    if (b5 === 304) {
                        bW = "notmodified";
                        bY = true
                    } else {
                        try {
                            b6 = U(B, bX);
                            bW = "success";
                            bY = true
                        } catch (bZ) {
                            bW = "parsererror";
                            b3 = bZ
                        }
                    }
                } else {
                    b3 = bW;
                    if (!bW || b5) {
                        bW = "error";
                        if (b5 < 0) {
                            b5 = 0
                        }
                    }
                }
                H.status = b5;
                H.statusText = "" + (b4 || bW);
                if (bY) {
                    bT.resolveWith(bU, [b6, bW, H])
                } else {
                    bT.rejectWith(bU, [H, bW, b3])
                }
                H.statusCode(z);
                z = ap;
                if (w) {
                    E.trigger("ajax" + (bY ? "Success" : "Error"), [H, B, bY ? b6 : b3])
                }
                bP.fireWith(bU, [H, bW]);
                if (w) {
                    E.trigger("ajaxComplete", [H, B]);
                    if (!(--al.active)) {
                        al.event.trigger("ajaxStop")
                    }
                }
            }
            bT.promise(H);
            H.success = H.done;
            H.error = H.fail;
            H.complete = bP.add;
            H.statusCode = function(bV) {
                if (bV) {
                    var e;
                    if (y < 2) {
                        for (e in bV) {
                            z[e] = [z[e], bV[e]]
                        }
                    } else {
                        e = bV[H.status];
                        H.then(e, e)
                    }
                }
                return this
            };
            B.url = ((L || B.url) + "").replace(bJ, "").replace(b, q[1] + "//");
            B.dataTypes = al.trim(B.dataType || "*").toLowerCase().split(g);
            if (B.crossDomain == null) {
                G = Y.exec(B.url.toLowerCase());
                B.crossDomain = !!(G && (G[1] != q[1] || G[2] != q[2] || (G[3] || (G[1] === "http:" ? 80 : 443)) != (q[3] || (q[1] === "http:" ? 80 : 443))))
            }
            if (B.data && B.processData && typeof B.data !== "string") {
                B.data = al.param(B.data, B.traditional)
            }
            bg(am, B, K, H);
            if (y === 2) {
                return false
            }
            w = B.global;
            B.type = B.type.toUpperCase();
            B.hasContent = !ba.test(B.type);
            if (w && al.active++ === 0) {
                al.event.trigger("ajaxStart")
            }
            if (!B.hasContent) {
                if (B.data) {
                    B.url += (Z.test(B.url) ? "&" : "?") + B.data;
                    delete B.data
                }
                A = B.url;
                if (B.cache === false) {
                    var I = al.now(),
                        bR = B.url.replace(bK, "$1_=" + I);
                    B.url = bR + ((bR === B.url) ? (Z.test(B.url) ? "&" : "?") + "_=" + I : "")
                }
            }
            if (B.data && B.hasContent && B.contentType !== false || K.contentType) {
                H.setRequestHeader("Content-Type", B.contentType)
            }
            if (B.ifModified) {
                A = A || B.url;
                if (al.lastModified[A]) {
                    H.setRequestHeader("If-Modified-Since", al.lastModified[A])
                }
                if (al.etag[A]) {
                    H.setRequestHeader("If-None-Match", al.etag[A])
                }
            }
            H.setRequestHeader("Accept", B.dataTypes[0] && B.accepts[B.dataTypes[0]] ? B.accepts[B.dataTypes[0]] + (B.dataTypes[0] !== "*" ? ", " + bf + "; q=0.01" : "") : B.accepts["*"]);
            for (J in B.headers) {
                H.setRequestHeader(J, B.headers[J])
            }
            if (B.beforeSend && (B.beforeSend.call(bU, H, B) === false || y === 2)) {
                H.abort();
                return false
            }
            for (J in {
                    success: 1,
                    error: 1,
                    complete: 1
                }) {
                H[J](B[J])
            }
            M = bg(p, B, K, H);
            if (!M) {
                D(-1, "No Transport")
            } else {
                H.readyState = 1;
                if (w) {
                    E.trigger("ajaxSend", [H, B])
                }
                if (B.async && B.timeout > 0) {
                    C = setTimeout(function() {
                        H.abort("timeout")
                    }, B.timeout)
                }
                try {
                    y = 1;
                    M.send(F, D)
                } catch (bO) {
                    if (y < 2) {
                        D(-1, bO)
                    } else {
                        al.error(bO)
                    }
                }
            }
            return H
        },
        param: function(e, z) {
            var w = [],
                x = function(B, A) {
                    A = al.isFunction(A) ? A() : A;
                    w[w.length] = encodeURIComponent(B) + "=" + encodeURIComponent(A)
                };
            if (z === ap) {
                z = al.ajaxSettings.traditional
            }
            if (al.isArray(e) || (e.jquery && !al.isPlainObject(e))) {
                al.each(e, function() {
                    x(this.name, this.value)
                })
            } else {
                for (var y in e) {
                    t(y, e[y], z, x)
                }
            }
            return w.join("&").replace(a0, "+")
        }
    });

    function t(x, w, A, z) {
        if (al.isArray(w)) {
            al.each(w, function(B, e) {
                if (A || aC.test(x)) {
                    z(x, e)
                } else {
                    t(x + "[" + (typeof e === "object" || al.isArray(e) ? B : "") + "]", e, A, z)
                }
            })
        } else {
            if (!A && w != null && typeof w === "object") {
                for (var y in w) {
                    t(x + "[" + y + "]", w[y], A, z)
                }
            } else {
                z(x, w)
            }
        }
    }
    al.extend({
        active: 0,
        lastModified: {},
        etag: {}
    });

    function bC(E, D, B) {
        var z = E.contents,
            C = E.dataTypes,
            w = E.responseFields,
            y, A, x, e;
        for (A in w) {
            if (A in B) {
                D[w[A]] = B[A]
            }
        }
        while (C[0] === "*") {
            C.shift();
            if (y === ap) {
                y = E.mimeType || D.getResponseHeader("content-type")
            }
        }
        if (y) {
            for (A in z) {
                if (z[A] && z[A].test(y)) {
                    C.unshift(A);
                    break
                }
            }
        }
        if (C[0] in B) {
            x = C[0]
        } else {
            for (A in B) {
                if (!C[0] || E.converters[A + " " + C[0]]) {
                    x = A;
                    break
                }
                if (!e) {
                    e = A
                }
            }
            x = x || e
        }
        if (x) {
            if (x !== C[0]) {
                C.unshift(x)
            }
            return B[x]
        }
    }

    function U(I, E) {
        if (I.dataFilter) {
            E = I.dataFilter(E, I.dataType)
        }
        var D = I.dataTypes,
            H = {},
            A, F, x = D.length,
            B, C = D[0],
            y, z, G, w, e;
        for (A = 1; A < x; A++) {
            if (A === 1) {
                for (F in I.converters) {
                    if (typeof F === "string") {
                        H[F.toLowerCase()] = I.converters[F]
                    }
                }
            }
            y = C;
            C = D[A];
            if (C === "*") {
                C = y
            } else {
                if (y !== "*" && y !== C) {
                    z = y + " " + C;
                    G = H[z] || H["* " + C];
                    if (!G) {
                        e = ap;
                        for (w in H) {
                            B = w.split(" ");
                            if (B[0] === y || B[0] === "*") {
                                e = H[B[1] + " " + C];
                                if (e) {
                                    w = H[w];
                                    if (w === true) {
                                        G = e
                                    } else {
                                        if (e === true) {
                                            G = w
                                        }
                                    }
                                    break
                                }
                            }
                        }
                    }
                    if (!(G || e)) {
                        al.error("No conversion from " + z.replace(" ", " to "))
                    }
                    if (G !== true) {
                        E = G ? G(E) : e(w(E))
                    }
                }
            }
        }
        return E
    }
    var aZ = al.now(),
        s = /(\=)\?(&|$)|\?\?/i;
    al.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            return al.expando + "_" + (aZ++)
        }
    });
    al.ajaxPrefilter("json jsonp", function(F, E, D) {
        var C = F.contentType === "application/x-www-form-urlencoded" && (typeof F.data === "string");
        if (F.dataTypes[0] === "jsonp" || F.jsonp !== false && (s.test(F.url) || C && s.test(F.data))) {
            var B, y = F.jsonpCallback = al.isFunction(F.jsonpCallback) ? F.jsonpCallback() : F.jsonpCallback,
                A = aq[y],
                w = F.url,
                z = F.data,
                x = "$1" + y + "$2";
            if (F.jsonp !== false) {
                w = w.replace(s, x);
                if (F.url === w) {
                    if (C) {
                        z = z.replace(s, x)
                    }
                    if (F.data === z) {
                        w += (/\?/.test(w) ? "&" : "?") + F.jsonp + "=" + y
                    }
                }
            }
            F.url = w;
            F.data = z;
            aq[y] = function(e) {
                B = [e]
            };
            D.always(function() {
                aq[y] = A;
                if (B && al.isFunction(A)) {
                    aq[y](B[0])
                }
            });
            F.converters["script json"] = function() {
                if (!B) {
                    al.error(y + " was not called")
                }
                return B[0]
            };
            F.dataTypes[0] = "json";
            return "script"
        }
    });
    al.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /javascript|ecmascript/
        },
        converters: {
            "text script": function(e) {
                al.globalEval(e);
                return e
            }
        }
    });
    al.ajaxPrefilter("script", function(e) {
        if (e.cache === ap) {
            e.cache = false
        }
        if (e.crossDomain) {
            e.type = "GET";
            e.global = false
        }
    });
    al.ajaxTransport("script", function(w) {
        if (w.crossDomain) {
            var x, e = an.head || an.getElementsByTagName("head")[0] || an.documentElement;
            return {
                send: function(z, y) {
                    x = an.createElement("script");
                    x.async = "async";
                    if (w.scriptCharset) {
                        x.charset = w.scriptCharset
                    }
                    x.src = w.url;
                    x.onload = x.onreadystatechange = function(B, A) {
                        if (A || !x.readyState || /loaded|complete/.test(x.readyState)) {
                            x.onload = x.onreadystatechange = null;
                            if (e && x.parentNode) {
                                e.removeChild(x)
                            }
                            x = ap;
                            if (!A) {
                                y(200, "success")
                            }
                        }
                    };
                    e.insertBefore(x, e.firstChild)
                },
                abort: function() {
                    if (x) {
                        x.onload(0, 1)
                    }
                }
            }
        }
    });
    var aY = aq.ActiveXObject ? function() {
            for (var e in aa) {
                aa[e](0, 1)
            }
        } : false,
        N = 0,
        aa;

    function aX() {
        try {
            return new aq.XMLHttpRequest()
        } catch (w) {}
    }

    function ay() {
        try {
            return new aq.ActiveXObject("Microsoft.XMLHTTP")
        } catch (w) {}
    }
    al.ajaxSettings.xhr = aq.ActiveXObject ? function() {
        return !this.isLocal && aX() || ay()
    } : aX;
    (function(e) {
        al.extend(al.support, {
            ajax: !!e,
            cors: !!e && ("withCredentials" in e)
        })
    })(al.ajaxSettings.xhr());
    if (al.support.ajax) {
        al.ajaxTransport(function(e) {
            if (!e.crossDomain || al.support.cors) {
                var w;
                return {
                    send: function(C, B) {
                        var A = e.xhr(),
                            z, y;
                        if (e.username) {
                            A.open(e.type, e.url, e.async, e.username, e.password)
                        } else {
                            A.open(e.type, e.url, e.async)
                        }
                        if (e.xhrFields) {
                            for (y in e.xhrFields) {
                                A[y] = e.xhrFields[y]
                            }
                        }
                        if (e.mimeType && A.overrideMimeType) {
                            A.overrideMimeType(e.mimeType)
                        }
                        if (!e.crossDomain && !C["X-Requested-With"]) {
                            C["X-Requested-With"] = "XMLHttpRequest"
                        }
                        try {
                            for (y in C) {
                                A.setRequestHeader(y, C[y])
                            }
                        } catch (x) {}
                        A.send((e.hasContent && e.data) || null);
                        w = function(L, K) {
                            var J, E, D, H, G;
                            try {
                                if (w && (K || A.readyState === 4)) {
                                    w = ap;
                                    if (z) {
                                        A.onreadystatechange = al.noop;
                                        if (aY) {
                                            delete aa[z]
                                        }
                                    }
                                    if (K) {
                                        if (A.readyState !== 4) {
                                            A.abort()
                                        }
                                    } else {
                                        J = A.status;
                                        D = A.getAllResponseHeaders();
                                        H = {};
                                        G = A.responseXML;
                                        if (G && G.documentElement) {
                                            H.xml = G
                                        }
                                        H.text = A.responseText;
                                        try {
                                            E = A.statusText
                                        } catch (I) {
                                            E = ""
                                        }
                                        if (!J && e.isLocal && !e.crossDomain) {
                                            J = H.text ? 200 : 404
                                        } else {
                                            if (J === 1223) {
                                                J = 204
                                            }
                                        }
                                    }
                                }
                            } catch (F) {
                                if (!K) {
                                    B(-1, F)
                                }
                            }
                            if (H) {
                                B(J, E, H, D)
                            }
                        };
                        if (!e.async || A.readyState === 4) {
                            w()
                        } else {
                            z = ++N;
                            if (aY) {
                                if (!aa) {
                                    aa = {};
                                    al(aq).unload(aY)
                                }
                                aa[z] = w
                            }
                            A.onreadystatechange = w
                        }
                    },
                    abort: function() {
                        if (w) {
                            w(0, 1)
                        }
                    }
                }
            }
        })
    }
    var aW = {},
        br, k, aM = /^(?:toggle|show|hide)$/,
        bd = /^([+\-]=)?([\d+.\-]+)([a-z%]*)$/i,
        bm, aS = [
            ["height", "marginTop", "marginBottom", "paddingTop", "paddingBottom"],
            ["width", "marginLeft", "marginRight", "paddingLeft", "paddingRight"],
            ["opacity"]
        ],
        bn;
    al.fn.extend({
        show: function(w, e, B) {
            var A, z;
            if (w || w === 0) {
                return this.animate(bk("show", 3), w, e, B)
            } else {
                for (var y = 0, x = this.length; y < x; y++) {
                    A = this[y];
                    if (A.style) {
                        z = A.style.display;
                        if (!al._data(A, "olddisplay") && z === "none") {
                            z = A.style.display = ""
                        }
                        if (z === "" && al.css(A, "display") === "none") {
                            al._data(A, "olddisplay", v(A.nodeName))
                        }
                    }
                }
                for (y = 0; y < x; y++) {
                    A = this[y];
                    if (A.style) {
                        z = A.style.display;
                        if (z === "" || z === "none") {
                            A.style.display = al._data(A, "olddisplay") || ""
                        }
                    }
                }
                return this
            }
        },
        hide: function(w, e, B) {
            if (w || w === 0) {
                return this.animate(bk("hide", 3), w, e, B)
            } else {
                var A, z, y = 0,
                    x = this.length;
                for (; y < x; y++) {
                    A = this[y];
                    if (A.style) {
                        z = al.css(A, "display");
                        if (z !== "none" && !al._data(A, "olddisplay")) {
                            al._data(A, "olddisplay", z)
                        }
                    }
                }
                for (y = 0; y < x; y++) {
                    if (this[y].style) {
                        this[y].style.display = "none"
                    }
                }
                return this
            }
        },
        _toggle: al.fn.toggle,
        toggle: function(w, z, y) {
            var x = typeof w === "boolean";
            if (al.isFunction(w) && al.isFunction(z)) {
                this._toggle.apply(this, arguments)
            } else {
                if (w == null || x) {
                    this.each(function() {
                        var e = x ? w : al(this).is(":hidden");
                        al(this)[e ? "show" : "hide"]()
                    })
                } else {
                    this.animate(bk("toggle", 3), w, z, y)
                }
            }
            return this
        },
        fadeTo: function(w, e, y, x) {
            return this.filter(":hidden").css("opacity", 0).show().end().animate({
                opacity: e
            }, w, y, x)
        },
        animate: function(e, A, z, y) {
            var x = al.speed(A, z, y);
            if (al.isEmptyObject(e)) {
                return this.each(x.complete, [false])
            }
            e = al.extend({}, e);

            function w() {
                if (x.queue === false) {
                    al._mark(this)
                }
                var L = al.extend({}, x),
                    K = this.nodeType === 1,
                    I = K && al(this).is(":hidden"),
                    C, F, E, J, H, D, G, M, B;
                L.animatedProperties = {};
                for (E in e) {
                    C = al.camelCase(E);
                    if (E !== C) {
                        e[C] = e[E];
                        delete e[E]
                    }
                    F = e[C];
                    if (al.isArray(F)) {
                        L.animatedProperties[C] = F[1];
                        F = e[C] = F[0]
                    } else {
                        L.animatedProperties[C] = L.specialEasing && L.specialEasing[C] || L.easing || "swing"
                    }
                    if (F === "hide" && I || F === "show" && !I) {
                        return L.complete.call(this)
                    }
                    if (K && (C === "height" || C === "width")) {
                        L.overflow = [this.style.overflow, this.style.overflowX, this.style.overflowY];
                        if (al.css(this, "display") === "inline" && al.css(this, "float") === "none") {
                            if (!al.support.inlineBlockNeedsLayout || v(this.nodeName) === "inline") {
                                this.style.display = "inline-block"
                            } else {
                                this.style.zoom = 1
                            }
                        }
                    }
                }
                if (L.overflow != null) {
                    this.style.overflow = "hidden"
                }
                for (E in e) {
                    J = new al.fx(this, L, E);
                    F = e[E];
                    if (aM.test(F)) {
                        B = al._data(this, "toggle" + E) || (F === "toggle" ? I ? "show" : "hide" : 0);
                        if (B) {
                            al._data(this, "toggle" + E, B === "show" ? "hide" : "show");
                            J[B]()
                        } else {
                            J[F]()
                        }
                    } else {
                        H = bd.exec(F);
                        D = J.cur();
                        if (H) {
                            G = parseFloat(H[2]);
                            M = H[3] || (al.cssNumber[E] ? "" : "px");
                            if (M !== "px") {
                                al.style(this, E, (G || 1) + M);
                                D = ((G || 1) / J.cur()) * D;
                                al.style(this, E, D + M)
                            }
                            if (H[1]) {
                                G = ((H[1] === "-=" ? -1 : 1) * G) + D
                            }
                            J.custom(D, G, M)
                        } else {
                            J.custom(D, F, "")
                        }
                    }
                }
                return true
            }
            return x.queue === false ? this.each(w) : this.queue(x.queue, w)
        },
        stop: function(y, x, w) {
            if (typeof y !== "string") {
                w = x;
                x = y;
                y = ap
            }
            if (x && y !== false) {
                this.queue(y || "fx", [])
            }
            return this.each(function() {
                var z, e = false,
                    B = al.timers,
                    A = al._data(this);
                if (!w) {
                    al._unmark(true, this)
                }

                function C(E, D, F) {
                    var G = D[F];
                    al.removeData(E, F, true);
                    G.stop(w)
                }
                if (y == null) {
                    for (z in A) {
                        if (A[z].stop && z.indexOf(".run") === z.length - 4) {
                            C(this, A, z)
                        }
                    }
                } else {
                    if (A[z = y + ".run"] && A[z].stop) {
                        C(this, A, z)
                    }
                }
                for (z = B.length; z--;) {
                    if (B[z].elem === this && (y == null || B[z].queue === y)) {
                        if (w) {
                            B[z](true)
                        } else {
                            B[z].saveState()
                        }
                        e = true;
                        B.splice(z, 1)
                    }
                }
                if (!(w && e)) {
                    al.dequeue(this, y)
                }
            })
        }
    });

    function bz() {
        setTimeout(aF, 0);
        return (bn = al.now())
    }

    function aF() {
        bn = ap
    }

    function bk(w, e) {
        var x = {};
        al.each(aS.concat.apply([], aS.slice(0, e)), function() {
            x[this] = w
        });
        return x
    }
    al.each({
        slideDown: bk("show", 1),
        slideUp: bk("hide", 1),
        slideToggle: bk("toggle", 1),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        },
        fadeToggle: {
            opacity: "toggle"
        }
    }, function(x, w) {
        al.fn[x] = function(y, e, z) {
            return this.animate(w, y, e, z)
        }
    });
    al.extend({
        speed: function(w, z, y) {
            var x = w && typeof w === "object" ? al.extend({}, w) : {
                complete: y || !y && z || al.isFunction(w) && w,
                duration: w,
                easing: y && z || z && !al.isFunction(z) && z
            };
            x.duration = al.fx.off ? 0 : typeof x.duration === "number" ? x.duration : x.duration in al.fx.speeds ? al.fx.speeds[x.duration] : al.fx.speeds._default;
            if (x.queue == null || x.queue === true) {
                x.queue = "fx"
            }
            x.old = x.complete;
            x.complete = function(e) {
                if (al.isFunction(x.old)) {
                    x.old.call(this)
                }
                if (x.queue) {
                    al.dequeue(this, x.queue)
                } else {
                    if (e !== false) {
                        al._unmark(this)
                    }
                }
            };
            return x
        },
        easing: {
            linear: function(x, y, w, e) {
                return w + e * x
            },
            swing: function(x, y, w, e) {
                return ((-Math.cos(x * Math.PI) / 2) + 0.5) * e + w
            }
        },
        timers: [],
        fx: function(w, e, x) {
            this.options = e;
            this.elem = w;
            this.prop = x;
            e.orig = e.orig || {}
        }
    });
    al.fx.prototype = {
        update: function() {
            if (this.options.step) {
                this.options.step.call(this.elem, this.now, this)
            }(al.fx.step[this.prop] || al.fx.step._default)(this)
        },
        cur: function() {
            if (this.elem[this.prop] != null && (!this.elem.style || this.elem.style[this.prop] == null)) {
                return this.elem[this.prop]
            }
            var e, w = al.css(this.elem, this.prop);
            return isNaN(e = parseFloat(w)) ? !w || w === "auto" ? 0 : w : e
        },
        custom: function(w, B, A) {
            var z = this,
                y = al.fx;
            this.startTime = bn || bz();
            this.end = B;
            this.now = this.start = w;
            this.pos = this.state = 0;
            this.unit = A || this.unit || (al.cssNumber[this.prop] ? "" : "px");

            function x(e) {
                return z.step(e)
            }
            x.queue = this.options.queue;
            x.elem = this.elem;
            x.saveState = function() {
                if (z.options.hide && al._data(z.elem, "fxshow" + z.prop) === ap) {
                    al._data(z.elem, "fxshow" + z.prop, z.start)
                }
            };
            if (x() && al.timers.push(x) && !bm) {
                bm = setInterval(y.tick, y.interval)
            }
        },
        show: function() {
            var e = al._data(this.elem, "fxshow" + this.prop);
            this.options.orig[this.prop] = e || al.style(this.elem, this.prop);
            this.options.show = true;
            if (e !== ap) {
                this.custom(this.cur(), e)
            } else {
                this.custom(this.prop === "width" || this.prop === "height" ? 1 : 0, this.cur())
            }
            al(this.elem).show()
        },
        hide: function() {
            this.options.orig[this.prop] = al._data(this.elem, "fxshow" + this.prop) || al.style(this.elem, this.prop);
            this.options.hide = true;
            this.custom(this.cur(), 0)
        },
        step: function(C) {
            var A, B, w, y = bn || bz(),
                e = true,
                z = this.elem,
                x = this.options;
            if (C || y >= x.duration + this.startTime) {
                this.now = this.end;
                this.pos = this.state = 1;
                this.update();
                x.animatedProperties[this.prop] = true;
                for (A in x.animatedProperties) {
                    if (x.animatedProperties[A] !== true) {
                        e = false
                    }
                }
                if (e) {
                    if (x.overflow != null && !al.support.shrinkWrapBlocks) {
                        al.each(["", "X", "Y"], function(E, D) {
                            z.style["overflow" + D] = x.overflow[E]
                        })
                    }
                    if (x.hide) {
                        al(z).hide()
                    }
                    if (x.hide || x.show) {
                        for (A in x.animatedProperties) {
                            al.style(z, A, x.orig[A]);
                            al.removeData(z, "fxshow" + A, true);
                            al.removeData(z, "toggle" + A, true)
                        }
                    }
                    w = x.complete;
                    if (w) {
                        x.complete = false;
                        w.call(z)
                    }
                }
                return false
            } else {
                if (x.duration == Infinity) {
                    this.now = y
                } else {
                    B = y - this.startTime;
                    this.state = B / x.duration;
                    this.pos = juicebox_lib.jQuery.easing[x.animatedProperties[this.prop]](this.state, B, 0, 1, x.duration);
                    this.now = this.start + ((this.end - this.start) * this.pos)
                }
                this.update()
            }
            return true
        }
    };
    al.extend(al.fx, {
        tick: function() {
            var e, x = al.timers,
                w = 0;
            for (; w < x.length; w++) {
                e = x[w];
                if (!e() && x[w] === e) {
                    x.splice(w--, 1)
                }
            }
            if (!x.length) {
                al.fx.stop()
            }
        },
        interval: 13,
        stop: function() {
            clearInterval(bm);
            bm = null
        },
        speeds: {
            slow: 600,
            fast: 200,
            _default: 400
        },
        step: {
            opacity: function(e) {
                al.style(e.elem, "opacity", e.now)
            },
            _default: function(e) {
                if (e.elem.style && e.elem.style[e.prop] != null) {
                    e.elem.style[e.prop] = e.now + e.unit
                } else {
                    e.elem[e.prop] = e.now
                }
            }
        }
    });
    al.each(["width", "height"], function(w, e) {
        al.fx.step[e] = function(x) {
            al.style(x.elem, e, Math.max(0, x.now))
        }
    });
    if (al.expr && al.expr.filters) {
        al.expr.filters.animated = function(e) {
            return al.grep(al.timers, function(w) {
                return e === w.elem
            }).length
        }
    }

    function v(w) {
        if (!aW[w]) {
            var e = an.body,
                x = al("<" + w + ">").appendTo(e),
                y = x.css("display");
            x.remove();
            if (y === "none" || y === "") {
                if (!br) {
                    br = an.createElement("iframe");
                    br.frameBorder = br.width = br.height = 0
                }
                e.appendChild(br);
                if (!k || !br.createElement) {
                    k = (br.contentWindow || br.contentDocument).document;
                    k.write((an.compatMode === "CSS1Compat" ? "<!doctype html>" : "") + "<html><body>");
                    k.close()
                }
                x = k.createElement(w);
                k.body.appendChild(x);
                y = al.css(x, "display");
                e.removeChild(br)
            }
            aW[w] = y
        }
        return aW[w]
    }
    var aV = /^t(?:able|d|h)$/i,
        ar = /^(?:body|html)$/i;
    if ("getBoundingClientRect" in an.documentElement) {
        al.fn.offset = function(J) {
            var I = this[0],
                B;
            if (J) {
                return this.each(function(e) {
                    al.offset.setOffset(this, J, e)
                })
            }
            if (!I || !I.ownerDocument) {
                return null
            }
            if (I === I.ownerDocument.body) {
                return al.offset.bodyOffset(I)
            }
            try {
                B = I.getBoundingClientRect()
            } catch (E) {}
            var G = I.ownerDocument,
                x = G.documentElement;
            if (!B || !al.contains(x, I)) {
                return B ? {
                    top: B.top,
                    left: B.left
                } : {
                    top: 0,
                    left: 0
                }
            }
            var F = G.body,
                C = aU(G),
                A = x.clientTop || F.clientTop || 0,
                D = x.clientLeft || F.clientLeft || 0,
                w = C.pageYOffset || al.support.boxModel && x.scrollTop || F.scrollTop,
                z = C.pageXOffset || al.support.boxModel && x.scrollLeft || F.scrollLeft,
                H = B.top + w - A,
                y = B.left + z - D;
            return {
                top: H,
                left: y
            }
        }
    } else {
        al.fn.offset = function(F) {
            var E = this[0];
            if (F) {
                return this.each(function(H) {
                    al.offset.setOffset(this, F, H)
                })
            }
            if (!E || !E.ownerDocument) {
                return null
            }
            if (E === E.ownerDocument.body) {
                return al.offset.bodyOffset(E)
            }
            var C, x = E.offsetParent,
                w = E,
                G = E.ownerDocument,
                y = G.documentElement,
                A = G.body,
                B = G.defaultView,
                e = B ? B.getComputedStyle(E, null) : E.currentStyle,
                D = E.offsetTop,
                z = E.offsetLeft;
            while ((E = E.parentNode) && E !== A && E !== y) {
                if (al.support.fixedPosition && e.position === "fixed") {
                    break
                }
                C = B ? B.getComputedStyle(E, null) : E.currentStyle;
                D -= E.scrollTop;
                z -= E.scrollLeft;
                if (E === x) {
                    D += E.offsetTop;
                    z += E.offsetLeft;
                    if (al.support.doesNotAddBorder && !(al.support.doesAddBorderForTableAndCells && aV.test(E.nodeName))) {
                        D += parseFloat(C.borderTopWidth) || 0;
                        z += parseFloat(C.borderLeftWidth) || 0
                    }
                    w = x;
                    x = E.offsetParent
                }
                if (al.support.subtractsBorderForOverflowNotVisible && C.overflow !== "visible") {
                    D += parseFloat(C.borderTopWidth) || 0;
                    z += parseFloat(C.borderLeftWidth) || 0
                }
                e = C
            }
            if (e.position === "relative" || e.position === "static") {
                D += A.offsetTop;
                z += A.offsetLeft
            }
            if (al.support.fixedPosition && e.position === "fixed") {
                D += Math.max(y.scrollTop, A.scrollTop);
                z += Math.max(y.scrollLeft, A.scrollLeft)
            }
            return {
                top: D,
                left: z
            }
        }
    }
    al.offset = {
        bodyOffset: function(w) {
            var e = w.offsetTop,
                x = w.offsetLeft;
            if (al.support.doesNotIncludeMarginInBodyOffset) {
                e += parseFloat(al.css(w, "marginTop")) || 0;
                x += parseFloat(al.css(w, "marginLeft")) || 0
            }
            return {
                top: e,
                left: x
            }
        },
        setOffset: function(F, E, z) {
            var D = al.css(F, "position");
            if (D === "static") {
                F.style.position = "relative"
            }
            var B = al(F),
                w = B.offset(),
                e = al.css(F, "top"),
                G = al.css(F, "left"),
                H = (D === "absolute" || D === "fixed") && al.inArray("auto", [e, G]) > -1,
                C = {},
                A = {},
                x, y;
            if (H) {
                A = B.position();
                x = A.top;
                y = A.left
            } else {
                x = parseFloat(e) || 0;
                y = parseFloat(G) || 0
            }
            if (al.isFunction(E)) {
                E = E.call(F, z, w)
            }
            if (E.top != null) {
                C.top = (E.top - w.top) + x
            }
            if (E.left != null) {
                C.left = (E.left - w.left) + y
            }
            if ("using" in E) {
                E.using.call(F, C)
            } else {
                B.css(C)
            }
        }
    };
    al.fn.extend({
        position: function() {
            if (!this[0]) {
                return null
            }
            var e = this[0],
                x = this.offsetParent(),
                y = this.offset(),
                w = ar.test(x[0].nodeName) ? {
                    top: 0,
                    left: 0
                } : x.offset();
            y.top -= parseFloat(al.css(e, "marginTop")) || 0;
            y.left -= parseFloat(al.css(e, "marginLeft")) || 0;
            w.top += parseFloat(al.css(x[0], "borderTopWidth")) || 0;
            w.left += parseFloat(al.css(x[0], "borderLeftWidth")) || 0;
            return {
                top: y.top - w.top,
                left: y.left - w.left
            }
        },
        offsetParent: function() {
            return this.map(function() {
                var e = this.offsetParent || an.body;
                while (e && (!ar.test(e.nodeName) && al.css(e, "position") === "static")) {
                    e = e.offsetParent
                }
                return e
            })
        }
    });
    al.each(["Left", "Top"], function(e, x) {
        var w = "scroll" + x;
        al.fn[w] = function(z) {
            var y, A;
            if (z === ap) {
                y = this[0];
                if (!y) {
                    return null
                }
                A = aU(y);
                return A ? ("pageXOffset" in A) ? A[e ? "pageYOffset" : "pageXOffset"] : al.support.boxModel && A.document.documentElement[w] || A.document.body[w] : y[w]
            }
            return this.each(function() {
                A = aU(this);
                if (A) {
                    A.scrollTo(!e ? z : al(A).scrollLeft(), e ? z : al(A).scrollTop())
                } else {
                    this[w] = z
                }
            })
        }
    });

    function aU(e) {
        return al.isWindow(e) ? e : e.nodeType === 9 ? e.defaultView || e.parentWindow : false
    }
    al.each(["Height", "Width"], function(e, x) {
        var w = x.toLowerCase();
        al.fn["inner" + x] = function() {
            var y = this[0];
            return y ? y.style ? parseFloat(al.css(y, w, "padding")) : this[w]() : null
        };
        al.fn["outer" + x] = function(z) {
            var y = this[0];
            return y ? y.style ? parseFloat(al.css(y, w, z ? "margin" : "border")) : this[w]() : null
        };
        al.fn[w] = function(z) {
            var D = this[0];
            if (!D) {
                return z == null ? null : this
            }
            if (al.isFunction(z)) {
                return this.each(function(F) {
                    var E = al(this);
                    E[w](z.call(this, F, E[w]()))
                })
            }
            if (al.isWindow(D)) {
                var C = D.document.documentElement["client" + x],
                    y = D.document.body;
                return D.document.compatMode === "CSS1Compat" && C || y && y["client" + x] || C
            } else {
                if (D.nodeType === 9) {
                    return Math.max(D.documentElement["client" + x], D.body["scroll" + x], D.documentElement["scroll" + x], D.body["offset" + x], D.documentElement["offset" + x])
                } else {
                    if (z === ap) {
                        var B = al.css(D, w),
                            A = parseFloat(B);
                        return al.isNumeric(A) ? A : B
                    } else {
                        return this.css(w, typeof z === "string" ? z : z + "px")
                    }
                }
            }
        }
    });
    juicebox_lib.jQuery = juicebox_lib.$ = al
})(window);
if (typeof jQuery === "undefined") {
    window.jQuery = juicebox_lib.jQuery
}
if (typeof $ === "undefined") {
    window.$ = juicebox_lib.jQuery
}(function(r, t, q) {
    var j = ["top", "right", "bottom", "left", "opacity", "height", "width"],
        s = ["top", "right", "bottom", "left"],
        n = ["", "-webkit-", "-moz-", "-o-"],
        v = ["avoidTransforms", "useTranslate3d", "leaveTransforms"],
        h = /^([+-]=)?([\d+-.]+)(.*)$/,
        z = /([A-Z])/g,
        w = {
            secondary: {},
            meta: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        m = "jQe",
        c = "cubic-bezier(",
        y = ")",
        g = false,
        b = null;
    var k = document.body || document.documentElement,
        e = k.style,
        a = (e.WebkitTransition !== undefined) ? "webkitTransitionEnd" : (e.OTransition !== undefined) ? "oTransitionEnd" : "transitionend",
        x = e.WebkitTransition !== undefined || e.MozTransition !== undefined || e.OTransition !== undefined || e.transition !== undefined,
        f = g = ("WebKitCSSMatrix" in window && "m11" in new WebKitCSSMatrix());
    if (r.expr && r.expr.filters) {
        b = r.expr.filters.animated;
        r.expr.filters.animated = function(C) {
            return r(C).data("events") && r(C).data("events")[a] ? true : b.call(this, C)
        }
    }

    function i(M, G, D, H) {
        var J = h.exec(G),
            E = M.css(D) === "auto" ? 0 : M.css(D),
            N = typeof E == "string" ? A(E) : E,
            F = typeof G == "string" ? A(G) : G,
            L = H === true ? 0 : N,
            K = M.is(":hidden"),
            C = M.translation();
        if (D == "left") {
            L = parseInt(N, 10) + C.x
        }
        if (D == "right") {
            L = parseInt(N, 10) + C.x
        }
        if (D == "top") {
            L = parseInt(N, 10) + C.y
        }
        if (D == "bottom") {
            L = parseInt(N, 10) + C.y
        }
        if (!J && G == "show") {
            L = 1;
            if (K) {
                M.css({
                    display: "block",
                    opacity: 0
                })
            }
        } else {
            if (!J && G == "hide") {
                L = 0
            }
        }
        if (J) {
            var I = parseFloat(J[2]);
            if (J[1]) {
                I = ((J[1] === "-=" ? -1 : 1) * I) + parseInt(L, 10)
            }
            return I
        } else {
            return L
        }
    }

    function u(C, E, D) {
        return ((D === true || (g == true && D != false)) && f) ? "translate3d(" + C + "px," + E + "px,0)" : "translate(" + C + "px," + E + "px)"
    }

    function l(J, O, H, K, N, D, G, C) {
        var I = J.data(m) ? !d(J.data(m)) ? J.data(m) : r.extend(true, {}, w) : r.extend(true, {}, w),
            F = N,
            M = r.inArray(O, s) > -1;
        if (M) {
            var P = I.meta,
                E = A(J.css(O)) || 0,
                L = O + "_o";
            F = N - E;
            P[O] = F;
            P[L] = J.css(O) == "auto" ? 0 + F : E + F || 0;
            I.meta = P;
            if (G && F === 0) {
                F = 0 - P[L];
                P[O] = F;
                P[L] = 0
            }
        }
        return J.data(m, B(I, O, H, K, F, D, G, C))
    }

    function B(K, J, F, H, I, D, E, C) {
        K = typeof K === "undefined" ? {} : K;
        K.secondary = typeof K.secondary === "undefined" ? {} : K.secondary;
        for (var G = n.length - 1; G >= 0; G--) {
            if (typeof K[n[G] + "transition-property"] === "undefined") {
                K[n[G] + "transition-property"] = ""
            }
            K[n[G] + "transition-property"] += ", " + ((D === true && E === true) ? n[G] + "transform" : J);
            K[n[G] + "transition-duration"] = F + "ms";
            K[n[G] + "transition-timing-function"] = H;
            K.secondary[((D === true && E === true) ? n[G] + "transform" : J)] = (D === true && E === true) ? u(K.meta.left, K.meta.top, C) : I
        }
        return K
    }

    function o(D) {
        for (var C in D) {
            if ((C == "width" || C == "height") && (D[C] == "show" || D[C] == "hide" || D[C] == "toggle")) {
                return true
            }
        }
        return false
    }

    function d(D) {
        for (var C in D) {
            return false
        }
        return true
    }

    function A(C) {
        return parseFloat(C.replace(/px/i, ""))
    }

    function p(F, E, C) {
        var D = r.inArray(F, j) > -1;
        if ((F == "width" || F == "height") && (E === parseFloat(C.css(F)))) {
            D = false
        }
        return D
    }
    r.extend({
        toggle3DByDefault: function() {
            g = !g
        }
    });
    r.fn.translation = function() {
        if (!this[0]) {
            return null
        }
        var G = this[0],
            D = window.getComputedStyle(G, null),
            H = {
                x: 0,
                y: 0
            };
        for (var F = n.length - 1; F >= 0; F--) {
            var E = D.getPropertyValue(n[F] + "transform");
            if (E && (/matrix/i).test(E)) {
                var C = E.replace(/^matrix\(/i, "").split(/, |\)$/g);
                H = {
                    x: parseInt(C[4], 10),
                    y: parseInt(C[5], 10)
                };
                break
            }
        }
        return H
    };
    r.fn.animate = function(D, E, I, K) {
        D = D || {};
        var F = !(typeof D.bottom !== "undefined" || typeof D.right !== "undefined"),
            J = r.speed(E, I, K),
            C = this,
            H = 0,
            G = function() {
                H--;
                if (H === 0) {
                    if (typeof J.complete === "function") {
                        J.complete.apply(C[0], arguments)
                    }
                }
            };
        if (!x || d(D) || o(D) || J.duration <= 0 || (r.fn.animate.defaults.avoidTransforms === true && D.avoidTransforms !== false)) {
            return t.apply(this, arguments)
        }
        return this[J.queue === true ? "queue" : "each"](function() {
            var V = r(this),
                M = r.extend({}, J),
                R = function() {
                    var ac = {};
                    for (var Z = n.length - 1; Z >= 0; Z--) {
                        ac[n[Z] + "transition-property"] = "none";
                        ac[n[Z] + "transition-duration"] = "";
                        ac[n[Z] + "transition-timing-function"] = ""
                    }
                    V.unbind(a);
                    if (!D.leaveTransforms === true) {
                        var ab = V.data(m) || {},
                            aa = {};
                        for (Z = n.length - 1; Z >= 0; Z--) {
                            aa[n[Z] + "transform"] = ""
                        }
                        if (F && typeof ab.meta !== "undefined") {
                            for (var Y = 0, X; X = s[Y]; ++Y) {
                                aa[X] = ab.meta[X + "_o"] + "px"
                            }
                        }
                        V.css(ac).css(aa)
                    }
                    if (D.opacity === "hide") {
                        V.css("display", "none")
                    }
                    V.data(m, null);
                    G.call(V)
                },
                N = {
                    bounce: c + "0.0, 0.35, .5, 1.3" + y,
                    linear: "linear",
                    swing: "ease-in-out",
                    easeInQuad: c + "0.550, 0.085, 0.680, 0.530" + y,
                    easeInCubic: c + "0.550, 0.055, 0.675, 0.190" + y,
                    easeInQuart: c + "0.895, 0.030, 0.685, 0.220" + y,
                    easeInQuint: c + "0.755, 0.050, 0.855, 0.060" + y,
                    easeInSine: c + "0.470, 0.000, 0.745, 0.715" + y,
                    easeInExpo: c + "0.950, 0.050, 0.795, 0.035" + y,
                    easeInCirc: c + "0.600, 0.040, 0.980, 0.335" + y,
                    easeOutQuad: c + "0.250, 0.460, 0.450, 0.940" + y,
                    easeOutCubic: c + "0.215, 0.610, 0.355, 1.000" + y,
                    easeOutQuart: c + "0.165, 0.840, 0.440, 1.000" + y,
                    easeOutQuint: c + "0.230, 1.000, 0.320, 1.000" + y,
                    easeOutSine: c + "0.390, 0.575, 0.565, 1.000" + y,
                    easeOutExpo: c + "0.190, 1.000, 0.220, 1.000" + y,
                    easeOutCirc: c + "0.075, 0.820, 0.165, 1.000" + y,
                    easeInOutQuad: c + "0.455, 0.030, 0.515, 0.955" + y,
                    easeInOutCubic: c + "0.645, 0.045, 0.355, 1.000" + y,
                    easeInOutQuart: c + "0.770, 0.000, 0.175, 1.000" + y,
                    easeInOutQuint: c + "0.860, 0.000, 0.070, 1.000" + y,
                    easeInOutSine: c + "0.445, 0.050, 0.550, 0.950" + y,
                    easeInOutExpo: c + "1.000, 0.000, 0.000, 1.000" + y,
                    easeInOutCirc: c + "0.785, 0.135, 0.150, 0.860" + y
                },
                Q = {},
                O = N[M.easing || "swing"] ? N[M.easing || "swing"] : M.easing || "swing";
            for (var L in D) {
                if (r.inArray(L, v) === -1) {
                    var S = r.inArray(L, s) > -1,
                        U = i(V, D[L], L, (S && D.avoidTransforms !== true));
                    if (D.avoidTransforms !== true && p(L, U, V)) {
                        l(V, L, M.duration, O, S && D.avoidTransforms === true ? U + "px" : U, S && D.avoidTransforms !== true, F, D.useTranslate3d === true)
                    } else {
                        Q[L] = D[L]
                    }
                }
            }
            var W = V.data(m) || {};
            for (var P = n.length - 1; P >= 0; P--) {
                if (typeof W[n[P] + "transition-property"] !== "undefined") {
                    W[n[P] + "transition-property"] = W[n[P] + "transition-property"].substr(2)
                }
            }
            V.data(m, W).unbind(a);
            if (!d(V.data(m)) && !d(V.data(m).secondary)) {
                H++;
                V.css(V.data(m));
                var T = V.data(m).secondary;
                setTimeout(function() {
                    V.bind(a, R).css(T)
                })
            } else {
                M.queue = false
            }
            if (!d(Q)) {
                H++;
                t.apply(V, [Q, {
                    duration: M.duration,
                    easing: r.easing[M.easing] ? M.easing : (r.easing.swing ? "swing" : "linear"),
                    complete: G,
                    queue: M.queue
                }])
            }
            return true
        })
    };
    r.fn.animate.defaults = {};
    r.fn.stop = function(F, D, E) {
        if (!x) {
            return q.apply(this, [F, D])
        }
        if (F) {
            this.queue([])
        }
        var G = {};
        for (var C = n.length - 1; C >= 0; C--) {
            G[n[C] + "transition-property"] = "none";
            G[n[C] + "transition-duration"] = "";
            G[n[C] + "transition-timing-function"] = ""
        }
        this.each(function() {
            var J = r(this),
                I = window.getComputedStyle(this, null),
                L = {},
                K;
            if (!d(J.data(m)) && !d(J.data(m).secondary)) {
                var M = J.data(m);
                if (D) {
                    L = M.secondary;
                    if (!E && typeof M.meta.left_o !== undefined || typeof M.meta.top_o !== undefined) {
                        L.left = typeof M.meta.left_o !== undefined ? M.meta.left_o : "auto";
                        L.top = typeof M.meta.top_o !== undefined ? M.meta.top_o : "auto";
                        for (K = n.length - 1; K >= 0; K--) {
                            L[n[K] + "transform"] = ""
                        }
                    }
                } else {
                    for (var N in J.data(m).secondary) {
                        N = N.replace(z, "-$1").toLowerCase();
                        L[N] = I.getPropertyValue(N);
                        if (!E && (/matrix/i).test(L[N])) {
                            var H = L[N].replace(/^matrix\(/i, "").split(/, |\)$/g);
                            L.left = (parseFloat(H[4]) + parseFloat(J.css("left")) + "px") || "auto";
                            L.top = (parseFloat(H[5]) + parseFloat(J.css("top")) + "px") || "auto";
                            for (K = n.length - 1; K >= 0; K--) {
                                L[n[K] + "transform"] = ""
                            }
                        }
                    }
                }
                J.unbind(a).css(G).css(L).data(m, null)
            } else {
                q.apply(J, [F, D])
            }
        });
        return this
    }
})(juicebox_lib.jQuery, juicebox_lib.jQuery.fn.animate, juicebox_lib.jQuery.fn.stop);
(function(i) {
    if (!juicebox_lib.jQuery.browser.msie || juicebox_lib.jQuery.browser.version < 10) {
        return
    }
    var k = i.document,
        o = function(r, t, u) {
            var q, s = k.createEvent("Event");
            s.initEvent(r, true, true);
            for (q in u) {
                s[q] = u[q]
            }
            t.dispatchEvent(s)
        },
        l = (function() {
            var t = Math.pow(2, 32) - 1,
                r = Object.prototype.hasOwnProperty;

            function s(u) {
                return u >>> 0
            }

            function q(u) {
                var v = -1,
                    w, x;
                for (x in u) {
                    w = (String(s(x)) === x && s(x) !== t && r.call(u, x));
                    if (w && x > v) {
                        v = x
                    }
                }
                return v
            }
            return function(u) {
                var v = 0;
                u = u || {};
                u.length = {
                    get: function() {
                        var w = +q(this);
                        return Math.max(v, w + 1)
                    },
                    set: function(z) {
                        var x = s(z);
                        if (x !== +z) {
                            throw new RangeError()
                        }
                        for (var y = x, w = this.length; y < w; y++) {
                            delete this[y]
                        }
                        v = x
                    }
                };
                u.toString = {
                    value: Array.prototype.join
                };
                return Object.create(Array.prototype, u)
            }
        })(),
        m = {
            identifiedTouch: {
                value: function(r) {
                    var q = this.length;
                    while (q--) {
                        if (this[q].identifier === r) {
                            return this[q]
                        }
                    }
                    return undefined
                }
            },
            item: {
                value: function(q) {
                    return this[q]
                }
            },
            _touchIndex: {
                value: function(r) {
                    var q = this.length;
                    while (q--) {
                        if (this[q].pointerId == r.pointerId) {
                            return q
                        }
                    }
                    return -1
                }
            },
            _addAll: {
                value: function(r) {
                    var q = 0,
                        s = r.length;
                    for (; q < s; q++) {
                        this._add(r[q])
                    }
                }
            },
            _add: {
                value: function(r) {
                    var q = this._touchIndex(r);
                    q = q < 0 ? this.length : q;
                    r.type = "MSPointerMove";
                    r.identifier = r.pointerId;
                    r.force = r.pressure;
                    r.radiusX = r.radiusY = 1;
                    r.rotationAngle = 0;
                    this[q] = r
                }
            },
            _remove: {
                value: function(r) {
                    var q = this._touchIndex(r);
                    if (q >= 0) {
                        this.splice(q, 1)
                    }
                }
            }
        },
        f = (function(q) {
            return function() {
                var r = l(q);
                if (arguments.length === 1) {
                    r.length = arguments[0]
                } else {
                    r.push.apply(r, arguments)
                }
                return r
            }
        })(m),
        d, c = {},
        n = i.MSGesture ? new MSGesture() : null,
        a = [],
        j = function(q, r) {
            if (r) {
                if (q === r) {
                    return true
                } else {
                    return j(q, r.parentNode)
                }
            } else {
                return false
            }
        },
        h = function(q) {
            var u, w = q.target,
                s, t, v;
            if (q.type === "MSPointerDown") {
                d._add(q);
                c[q.pointerId] = q.target;
                u = "touchstart";
                if (d.length > 1) {
                    n.target = q.target;
                    for (var r = 0; r < d.length; r++) {
                        n.addPointer(d[r].pointerId)
                    }
                }
            }
            if (q.type === "MSPointerMove" && d.identifiedTouch(q.pointerId)) {
                d._add(q);
                u = "touchmove"
            }
            t = k.createTouchList(q);
            v = k.createTouchList();
            for (var r = 0; r < d.length; r++) {
                if (j(w, c[d[r].identifier])) {
                    v._add(d[r])
                }
            }
            s = c[q.pointerId];
            if (q.type === "MSPointerUp") {
                d._remove(q);
                c[q.pointerId] = null;
                delete c[q.pointerId];
                u = "touchend";
                if (d.length <= 1 && n) {
                    n.stop()
                }
            }
            if (u && s) {
                o(u, s, {
                    touches: d,
                    changedTouches: t,
                    targetTouches: v
                })
            }
        },
        b = function(q) {
            var r;
            if (q.type === "MSGestureStart") {
                r = "gesturestart"
            } else {
                if (q.type === "MSGestureChange") {
                    r = "gesturechange"
                } else {
                    if (q.type === "MSGestureEnd") {
                        r = "gestureend"
                    }
                }
            }
            o(r, q.target, {
                scale: q.scale,
                rotation: q.rotation,
                screenX: q.screenX,
                screenY: q.screenY
            })
        },
        g = function(u) {
            var s = p,
                r = e,
                t = u.prototype.addEventListener,
                q = u.prototype.removeEventListener;
            u.prototype.addEventListener = function(w, x, v) {
                i.navigator.msPointerEnabled && s.call(this, w, x, v);
                t.call(this, w, x, v)
            };
            u.prototype.removeEventListener = function(w, x, v) {
                i.navigator.msPointerEnabled && r.call(this, w, x, v);
                q.call(this, w, x, v)
            }
        },
        p = function(r, u, q) {
            var t = this,
                s;
            if (r.indexOf("touchstart") === 0) {
                s = function() {
                    if (j(t, arguments[0].target)) {
                        h.apply(this, arguments)
                    }
                };
                a.push({
                    node: this,
                    func: s
                });
                this.ownerDocument.addEventListener("MSPointerDown", s, q)
            }
            if (r.indexOf("touchmove") === 0) {
                this.ownerDocument.addEventListener("MSPointerMove", h, q)
            }
            if (r.indexOf("touchend") === 0) {
                this.ownerDocument.addEventListener("MSPointerUp", h, q)
            }
            if (r.indexOf("gesturestart") === 0) {
                this.ownerDocument.addEventListener("MSGestureStart", b, q)
            }
            if (r.indexOf("gesturechange") === 0) {
                this.ownerDocument.addEventListener("MSGestureChange", b, q)
            }
            if (r.indexOf("gestureend") === 0) {
                this.ownerDocument.addEventListener("MSGestureEnd", b, q)
            }
            if (this.style && typeof this.style.msTouchAction != "undefined") {
                this.style.msTouchAction = "none"
            }
        },
        e = function(s, u, q) {
            var t, r;
            if (s.indexOf("touchstart") === 0) {
                r = a.length;
                while (r--) {
                    if (a[r].node === this) {
                        this.ownerDocument.removeEventListener("MSPointerDown", t, q);
                        a.splice(r, 1);
                        break
                    }
                }
            }
            if (s.indexOf("touchmove") === 0) {
                this.ownerDocument.removeEventListener("MSPointerMove", h, q)
            }
            if (s.indexOf("touchend") === 0) {
                this.ownerDocument.removeEventListener("MSPointerUp", h, q)
            }
            if (s.indexOf("gesturestart") === 0) {
                this.ownerDocument.removeEventListener("MSGestureStart", b, q)
            }
            if (s.indexOf("gesturechange") === 0) {
                this.ownerDocument.removeEventListener("MSGestureChange", b, q)
            }
            if (s.indexOf("gestureend") === 0) {
                this.ownerDocument.removeEventListener("MSGestureEnd", b, q)
            }
        };
    k.createTouchList = function(r) {
        var q = new f();
        if (r) {
            if (r.length) {
                q._addAll(r)
            } else {
                q._add(r)
            }
        }
        return q
    };
    k.createTouch = function(q, w, r, v, t, u, s) {
        return {
            identifier: r,
            screenX: u,
            screenY: s,
            pageX: v,
            pageY: t,
            target: w
        }
    };
    if (!i.ontouchstart) {
        i.ontouchstart = 1
    }
    d = k.createTouchList();
    g(HTMLElement);
    g(Document)
}(window));
juicebox_lib.jQuery.fn.extend({
    disableSelection: function() {
        return this.each(function() {
            this.onselectstart = function() {
                return false
            };
            this.unselectable = "on";
            jQuery(this).css("user-select", "none");
            jQuery(this).css("-o-user-select", "none");
            jQuery(this).css("-moz-user-select", "none");
            jQuery(this).css("-khtml-user-select", "none");
            jQuery(this).css("-webkit-user-select", "none")
        })
    }
});
if (!juicebox_lib.jQuery.easing.easeOutQuart) {
    juicebox_lib.jQuery.extend(juicebox_lib.jQuery.easing, {
        easeOutQuart: function(e, f, a, h, g) {
            return -h * ((f = f / g - 1) * f * f * f - 1) + a
        }
    })
}
var juice_box_utils = function(p$) {
    var $ = p$;
    var is_pro_version = "cd64f8c2ad416da082f8c514ba054429";
    var is_absolute_path = function(path) {
        if (!path) {
            return false
        }
        if (path.indexOf("/") === 0) {
            return true
        }
        if (path.toLowerCase().indexOf("http://") === 0) {
            return true
        }
        if (path.toLowerCase().indexOf("https://") === 0) {
            return true
        }
        if (path.indexOf("://") > 0 && path.indexOf("://") < 10) {
            return true
        }
        return false
    };
    var is_end_with = function(str, ch) {
        if (!str || !ch) {
            return false
        }
        if (str.substring(str.length - ch.length) === ch) {
            return true
        }
        return false
    };
    var get_base_url = function(url, uri) {
        if (url.indexOf("/") === 0) {
            var iposs = uri.indexOf("://");
            if (iposs < 0) {
                iposs = 0
            } else {
                iposs += 3
            }
            var ipose = uri.indexOf("/", iposs);
            if (ipose < 0) {
                return uri
            }
            return uri.substring(0, ipose)
        }
        var ipos = uri.lastIndexOf("/");
        if (ipos <= 0) {
            return ""
        }
        return uri.substring(0, ipos)
    };
    var convert_to_absolute_path = function(url) {
        if (url.toLowerCase().indexOf("http://") === 0 || url.toLowerCase().indexOf("https://") === 0) {
            return url
        }
        var uri = window.location.href.split("#")[0].split("?")[0];
        var ipos = uri.lastIndexOf("/");
        var iposs = uri.indexOf("://");
        if (ipos <= 0) {
            return "/" + url
        }
        if (iposs > 0 && ipos - iposs < 3) {
            return "/" + url
        }
        return get_base_url(url, uri) + (url.indexOf("/") === 0 ? "" : "/") + url
    };
    var concatenate_path = function(base, url) {
        if (!base) {
            base = ""
        }
        if (!url) {
            url = ""
        }
        if (is_absolute_path(url)) {
            return url
        }
        if (!is_end_with(base, "/") && base) {
            base += "/"
        }
        return base + url
    };
    var is_it_scrolling = function() {
        var doc = $(document);
        var win = $(window);
        return {
            v_scrolling: doc.height() > win.height(),
            h_scrolling: doc.width() > win.width()
        }
    };
    var in_iframe = function() {
        if (window.location.href.indexOf("noiframelimit") > -1) {
            return false
        }
        if (top && top.location !== location) {
            return true
        }
        return false
    };
    var is_iphone_chrome = function() {
        if (navigator.userAgent.match(/iPhone/i) && navigator.userAgent.match(/CriOS/i)) {
            return true
        }
        return false
    };
    var is_iphone = function() {
        if (navigator.userAgent.match(/iPhone/i)) {
            return true
        }
        return false
    };
    var is_ipad = function() {
        if (navigator.userAgent.match(/iPad/i)) {
            return true
        }
        return false
    };
    var is_android = function() {
        if (navigator.userAgent.match(/Android/i)) {
            return true
        }
        return false
    };
    var is_mobile_ie = function() {
        if (navigator.userAgent.match(/IEMobile/i)) {
            return true
        }
        return false
    };
    var is_small_android = function() {
        if (navigator.userAgent.match(/Galaxy Nexus/i)) {
            return true
        }
        if (navigator.userAgent.match(/Nexus S/i)) {
            return true
        }
        if (navigator.userAgent.match(/HTC Panache/i)) {
            return true
        }
        if (navigator.userAgent.match(/HTC myTouch/i)) {
            return true
        }
        if (navigator.userAgent.match(/Sensation/i)) {
            return true
        }
        if (is_android() && is_small_screen()) {
            return true
        }
        return false
    };
    var is_chrome = function() {
        if (navigator.userAgent.match(/Chrome/i)) {
            return true
        }
        return false
    };
    var is_opera = function() {
        if (navigator.userAgent.match(/Opera/i)) {
            return true
        }
        return false
    };
    var is_firefox = function() {
        if (navigator.userAgent.match(/Firefox/i)) {
            return true
        }
        return false
    };
    var get_android_ver = function() {
        var pos = navigator.userAgent.indexOf("Android");
        if (pos < 0) {
            return 0
        }
        var pose = navigator.userAgent.indexOf(";", pos);
        if (pose <= pos) {
            return 0
        }
        var vi = navigator.userAgent.substring(pos, pose);
        var va = vi.split(" ");
        if (va.length !== 2) {
            return 0
        }
        var num = parseInt(va[1].replace(/\./g, "").substring(0, 3));
        var ver = parseFloat(parseFloat(num) / 100);
        if (ver < 1) {
            ver *= 10
        }
        if (ver < 1) {
            ver *= 10
        }
        return ver
    };
    var get_vp_meta_cnt = function(density, scalable) {
        return "width=device-width, initial-scale=1.0, minimum-scale=" + (scalable ? 0.25 : 1) + ", maximum-scale=" + (scalable ? 4 : 1) + ", user-scalable=" + (scalable ? 1 : 0) + (density ? ", target-densitydpi=" + density : "")
    };
    var get_vp_meta_cnt_4_iphone_with_ratio = function(ratio) {
        return "width=800, initial-scale=" + ratio + ", minimum-scale=" + ratio + ", maximum-scale=" + ratio + ", user-scalable=" + (scalable ? 1 : 0)
    };
    var meta_tag_id = "sv-meta";
    var populate_viewport_meta_content = function(isFullscreen) {
        if (isFullscreen) {
            if (is_ipad() || is_iphone()) {
                return get_vp_meta_cnt("")
            } else {
                if (is_android()) {
                    return get_vp_meta_cnt(160)
                }
            }
        } else {
            return ""
        }
        return ""
    };
    var set_viewport_value = function(val, scalable) {
        if (is_android()) {
            $("#" + meta_tag_id).attr("content", get_vp_meta_cnt(val, scalable))
        }
        if (is_iphone()) {
            $("#" + meta_tag_id).attr("content", get_vp_meta_cnt_4_iphone_with_ratio(val, scalable))
        }
    };
    var host_has_viewport_meta = function() {
        return document.getElementsByName("viewport").length > 0 && $("#" + meta_tag_id).length <= 0
    };
    var has_viewport_locked = function() {
        var vp = document.getElementsByName("viewport");
        if (!vp || vp.length <= 0 || !vp[0].content) {
            return false
        }
        var cnt = vp[0].content.toLowerCase().replace(/ /g, "");
        var hasInitialScale = cnt.indexOf("initial-scale=1.0") >= 0 || cnt.indexOf("initial-scale=1.,") >= 0 || cnt.indexOf("initial-scale=1,") >= 0;
        var userScalable = cnt.indexOf("user-scalable=0") >= 0 || cnt.indexOf("user-scalable=off") || cnt.indexOf("user-scalable=false");
        return hasInitialScale && userScalable
    };
    var need_viewport_meta = function() {
        if (is_ipad() || is_iphone() || is_android()) {
            return true
        }
        return false
    };
    var add_js_tag = function(url, id) {
        if (id && $("#" + id).length > 0) {
            return
        }
        var tag = document.createElement("script");
        if (id) {
            tag.id = id
        }
        tag.type = "text/javascript";
        tag.src = url;
        var header = document.getElementsByTagName("head");
        if (!header) {
            return
        }
        header[0].appendChild(tag)
    };
    var add_viewport_meta = function(isFullscreen) {
        if (!need_viewport_meta()) {
            return
        }
        if ($("#" + meta_tag_id).length > 0) {
            return
        }
        if (host_has_viewport_meta()) {
            return
        }
        var svmeta4idvc = document.createElement("meta");
        svmeta4idvc.name = "viewport";
        svmeta4idvc.id = meta_tag_id;
        svmeta4idvc.content = populate_viewport_meta_content(isFullscreen);
        var header = document.getElementsByTagName("head");
        if (!header) {
            return
        }
        header[0].appendChild(svmeta4idvc)
    };
    var set_viewport_meta = function(isFullscreen) {
        if (!need_viewport_meta()) {
            return
        }
        $("#" + meta_tag_id).attr("content", populate_viewport_meta_content(isFullscreen))
    };
    var get_viewport_meta_content = function() {
        var tags = document.getElementsByName("viewport");
        if (tags.length <= 0) {
            return null
        }
        if (!tags[0].content) {
            return null
        }
        return tags[0].content
    };
    var set_viewport_meta_content = function(content) {
        var tags = document.getElementsByName("viewport");
        if (tags.length <= 0) {
            return
        }
        tags[0].content = content
    };
    var get_current_path = function() {
        var uri = window.location.href.split("#")[0].split("?")[0];
        var posLasts = uri.lastIndexOf("/");
        var posS = uri.indexOf("//");
        if (posLasts < 0 || posS < 0) {
            return ""
        }
        var pos1 = uri.indexOf("/", posS + 2);
        if (pos1 < 0 || posLasts - pos1 <= 0) {
            return "/"
        }
        var tail = uri.substring(posLasts + 1);
        if (tail.indexOf(".") > 0) {
            return uri.substring(pos1, posLasts)
        }
        return uri.substring(pos1)
    };
    var get_qs_value = function(key, dft_) {
        if (dft_ == null) {
            dft_ = ""
        }
        key = key.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + key + "=([^&#]*)");
        var qs = regex.exec(window.location.href);
        if (qs == null) {
            return dft_
        } else {
            return qs[1]
        }
    };
    var get_js_folder_url = function() {
        var i, root, pos, scripts = document.getElementsByTagName("script");
        for (i = 0; i < scripts.length; i++) {
            pos = scripts[i].src.toLowerCase().indexOf("juicebox.js");
            if (pos === 0) {
                return ""
            }
            if (pos > 0) {
                return scripts[i].src.substring(0, pos)
            }
        }
        return ""
    };
    var u_skey = "cd64f8c2ad416da082f8c514ba054429";
    var set_cookie = function(c_name, value, expires) {
        if (expires < 0) {
            expires = "Thu, 01 Jan 1970 00:00:00 GMT"
        } else {
            expires = ""
        }
        document.cookie = c_name + "=" + escape(value) + ((expires === "") ? "" : ";expires=" + expires) + ";path=/"
    };
    var get_cookie = function(c_name) {
        if (document.cookie.length > 0) {
            c_start = document.cookie.indexOf(c_name + "=");
            if (c_start !== -1) {
                c_start = c_start + c_name.length + 1;
                c_end = document.cookie.indexOf(";", c_start);
                if (c_end === -1) {
                    c_end = document.cookie.length
                }
                return unescape(document.cookie.substring(c_start, c_end))
            }
        }
        return ""
    };
    var wrap_value = function(val) {
        switch (typeof val) {
            case "boolean":
            case "number":
                return val + "";
            default:
                return '"' + val + '"'
        }
    };
    var save_object_2_cookie = function(c_name, object) {
        if (!object) {
            set_cookie(c_name, "");
            return
        }
        var jsons = "";
        for (var k in object) {
            if (jsons.length > 0) {
                jsons += ","
            }
            jsons += k + ":" + wrap_value(object[k])
        }
        jsons = "{" + jsons + "}";
        set_cookie(c_name, jsons)
    };
    var get_object_from_cookie = function(c_name) {
        var json = get_cookie(c_name);
        var ret;
        eval("ret = " + (json ? json : null) + ";");
        return ret
    };
    var get_device_dpi = function(cb) {
        if (!is_iphone() && !is_ipad() && !is_android()) {
            if (cb) {
                cb(1)
            }
            return 1
        }
        var s = document.createElement("style");
        var d = document.createElement("div");
        d.id = "dpi-detector-01";
        var map = [{
            ratio: 1,
            pixel: "10px"
        }, {
            ratio: 1.5,
            pixel: "15px"
        }, {
            ratio: 2,
            pixel: "20px"
        }];
        s.innerText = "";
        for (var i = 0; i < map.length; i++) {
            s.innerText += "@media (-webkit-min-device-pixel-ratio:" + map[i].ratio + ") {#" + d.id + "{font-size:" + map[i].pixel + " !important;}}"
        }
        document.documentElement.appendChild(s).appendChild(d);
        window.setTimeout(function() {
            var dfs = getComputedStyle(d, null).getPropertyValue("font-size");
            for (var j = 0; j < map.length; j++) {
                if (dfs == map[i].pixel) {
                    if (cb) {
                        cb(map[i].ratio)
                    }
                    return map[i].ratio
                }
            }
            s.parentNode.removeChild(s);
            d.parentNode.removeChild(d);
            if (cb) {
                cb(1)
            }
            return 1
        }, 100)
    };
    var get_query_path = function(document_id, path) {
        var paths = path.split(",");
        var xpath = "";
        for (var i = 0; i < paths.length; i++) {
            xpath += "#" + document_id + " " + paths[i] + (i === paths.length - 1 ? "" : ", ")
        }
        return xpath
    };
    var is_small_screen = function() {
        if (is_android()) {
            if (navigator.userAgent.match(/Mobile/i)) {
                return true
            }
            return false
        }
        if (Math.max(screen.height, screen.width) > 1000) {
            return false
        }
        return true
    };
    var is_swipable_device = function() {
        if (!is_iphone() && !is_ipad() && !is_android()) {
            return false
        }
        return true
    };
    var is_large_screen_mode = function(config) {
        if (config.screenmode.toUpperCase() === "LARGE") {
            return true
        }
        if (config.screenmode.toUpperCase() === "SMALL") {
            return false
        }
        if (!is_small_screen() && !is_small_android() && !is_iphone()) {
            return true
        }
        return false
    };
    var is_earlier_ie = function() {
        if ($.browser.msie && $.browser.version < 9) {
            return true
        }
        return false
    };
    var is_ie8 = function() {
        return ($.browser.msie && $.browser.version < 9 && $.browser.version > 7)
    };
    var is_firefox3 = function() {
        var bz = $.browser;
        if (bz.mozilla && bz.version.slice(0, 3) == "1.9") {
            return true
        }
        return false
    };
    var format_color = function(color) {
        color = color.replace(/#/g, "");
        if (color.match(/^[0-9a-f]{3,6}$/i)) {
            return "#" + color
        }
        return color
    };
    var need_new_window = function(config) {
        if (typeof(config.expandinnewpage) === "boolean") {
            return config.expandinnewpage
        }
        var optval = config.expandinnewpage.toUpperCase();
        if (optval === "TRUE") {
            return true
        }
        if (optval === "FALSE") {
            return false
        }
        if (is_iphone() || is_ipad()) {
            if (has_viewport_locked()) {
                return false
            }
            return true
        }
        return false
    };
    var is_new_expanded_window = function() {
        return typeof(expanded_jb_gallery) != "undefined" && expanded_jb_gallery
    };
    var is_adobe_air = function() {
        return navigator.userAgent.match(/AdobeAIR/i)
    };
    var show_real_fullscreen = function(domid) {
        var eledlg = document.getElementById(domid);
        if (eledlg.requestFullScreen) {
            eledlg.requestFullScreen()
        } else {
            if (eledlg.mozRequestFullScreen) {
                eledlg.mozRequestFullScreen()
            } else {
                if (eledlg.webkitRequestFullScreen) {
                    eledlg.webkitRequestFullScreen()
                }
            }
        }
    };
    var exit_fullscreen = function() {
        if (document.cancelFullScreen) {
            document.cancelFullScreen()
        } else {
            if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen()
            } else {
                if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen()
                }
            }
        }
    };
    var support_real_fullscreen = function() {
        if (document.cancelFullScreen) {
            return true
        } else {
            if (document.mozCancelFullScreen) {
                return true
            } else {
                if (document.webkitCancelFullScreen) {
                    return true
                }
            }
        }
        return false
    };
    var exit_support_real_fullscreen = function() {
        if (document.cancelFullScreen || document.mozCancelFullScreen || document.webkitCancelFullScreen) {
            return true
        }
        return false
    };
    var add_fullscreen_listener = function(callback) {
        if (typeof(callback) != "function") {
            return
        }
        if ($.browser.msie) {
            return
        }
        document.addEventListener("fullscreenchange", function() {
            callback(document.fullscreen)
        }, false);
        document.addEventListener("mozfullscreenchange", function() {
            callback(document.mozFullScreen)
        }, false);
        document.addEventListener("webkitfullscreenchange", function() {
            callback(document.webkitIsFullScreen)
        }, false)
    };
    var is_side_layout = function(config) {
        var tmbpos = config.thumbsposition.toUpperCase();
        return tmbpos === "LEFT" || tmbpos === "RIGHT"
    };
    var get_gallery_title_html = function(config, forIdxPanel) {
        if (!config.gallerytitle) {
            return ""
        }
        var isLSM = is_large_screen_mode(config);
        if (isLSM && forIdxPanel) {
            return ""
        }
        var titleHtml;
        var cls = forIdxPanel ? "jb-idx-title" : "jb-area-large-mode-title";
        if (isLSM || config.gallerytitle.indexOf("<") > -1) {
            titleHtml = config.gallerytitle
        } else {
            titleHtml = '<textarea rows="1" class="jb-idx-ssm-title-wrapper" readonly="true" style="background:transparent;border:none;overflow:hidden;resize: none;">' + config.gallerytitle + "</textarea>"
        }
        if (config.gallerytitleposition.toUpperCase() != "ABOVE_THUMBS") {
            return "<div class='" + cls + "' style='position: absolute;display:none;'>" + titleHtml + "</div>"
        }
        return "<div class='" + cls + (config.gallerytitleposition.toUpperCase() === "OVERLAY" ? " jb-classifier-show-on-over " : " ") + "jb-classifier-layer' layer='600' style='position:absolute;display:none;z-index:600'>" + titleHtml + "</div>"
    };
    var get_caption_html = function() {
        return "<div class='jb-area-caption jb-classifier-layer' layer='200' style='position:absolute !important;overflow:hidden; bottom: 0; z-index:200;'></div>"
    };
    var add_font_icon_4_ie8 = function(config, content, is4bb) {
        if (!$.browser.msie || $.browser.version >= 9) {
            return ""
        }
        var bbstyle = config.buttonbariconrealsize ? config.buttonbariconrealsize + "px;" : "";
        return "<span style=\"font-family: 'juicebox';" + bbstyle + '">' + content + "</span>"
    };
    var get_text_shadow_style = function(rgba, colora, styleValueOnly) {
        if (is_earlier_ie()) {
            return ""
        }
        var shadowstr = (colora.toLowerCase() === "transparent" ? "0px 0px 0px " : "1px 1px 2px ");
        if (is_small_android() || is_iphone()) {
            return (styleValueOnly ? "" : "-webkit-text-shadow: ") + shadowstr + format_color(colora) + ";"
        }
        return (styleValueOnly ? "" : "text-shadow: ") + shadowstr + format_color(rgba) + (styleValueOnly ? "" : ";")
    };
    var get_font_shadow_style = function(rgba, colora, blur) {
        if (is_earlier_ie()) {
            return ""
        }
        if (is_small_android() || is_iphone()) {
            return "-webkit-text-shadow: 0px 0px " + blur + "px " + format_color(colora) + ";"
        }
        return "text-shadow: 0px 0px " + blur + "px " + format_color(rgba) + ";"
    };
    var get_shadow_style_string = function(rgba, colora, blur, styleValueOnly) {
        if (is_earlier_ie()) {
            return ""
        }
        if (is_small_android() || is_iphone()) {
            return (styleValueOnly ? "" : "-webkit-box-shadow: ") + "0px 0px " + blur + "px " + format_color(colora) + ";"
        }
        return (styleValueOnly ? "" : "box-shadow: ") + "0px 0px " + blur + "px " + format_color(rgba) + (styleValueOnly ? "" : ";")
    };
    var get_button_bar_style = function(config, is4BackBtn) {
        var useFilter = false;
        var ret = "";
        if (config.buttonbarbackgroundcolor) {
            ret += "background-color:" + format_color(config.buttonbarbackgroundcolor) + ";" + (useFilter ? config.buttonbarbackgroundopacity + ";" : "")
        }
        if (is_earlier_ie()) {
            var sz = parseInt(config.buttonbariconrealsize);
            var ht = "auto;";
            if (sz) {
                ht = (2 * sz) + "px;"
            }
            ret += "height:" + ht
        } else {
            if (is4BackBtn) {
                ret += "padding:0;height:auto;border-radius:3px;"
            }
        }
        return ret
    };
    var get_button_bar_icon_style = function(config, forBackBtn) {
        var useFilter = false;
        var ret = "";
        if (config.buttonbariconrealsize) {
            var sz = parseInt(config.buttonbariconrealsize);
            ret += "font-size:" + config.buttonbariconrealsize + (sz ? "px;" : ";");
            if (!forBackBtn) {
                var bdtop = parseInt(sz / 2);
                if (is_ie8()) {
                    bdtop = parseInt(sz / 4)
                }
                if (sz) {
                    ret += "border-top:" + bdtop + "px solid transparent;height:" + parseInt(1.5 * sz) + "px;width:" + (2 * sz) + "px;"
                }
            } else {
                if (sz) {
                    ret += "height:" + (2 * sz - parseInt(sz / 2)) + "px;width:" + (2 * sz) + "px;"
                }
            }
        }
        if (config.buttonbariconcolor) {
            ret += "color:" + format_color(config.buttonbariconcolor) + ";" + (useFilter ? config.buttonbariconopacity + ";" : "")
        }
        if (config.buttonbarshadowcolor) {
            ret += get_font_shadow_style(config.buttonbarshadowcolor, config.buttonbarshadowcolora, config.buttonbarshadowblur)
        }
        return ret
    };
    var get_thumb_size = function(config) {
        var thumb_width, thumb_height;
        if (config.usethumbdots) {
            thumb_width = 20;
            thumb_height = 20
        } else {
            thumb_width = config.thumbwidth;
            thumb_height = config.thumbheight
        }
        return {
            width: thumb_width,
            height: thumb_height
        }
    };
    var btnOriginalSize = 28;
    var get_nav_btn_size = function(config) {
        var btnsz = btnOriginalSize;
        var icnsz = parseInt(config.navbuttoniconrealsize);
        var hw = "";
        if (icnsz) {
            btnsz = parseInt(1.4 * icnsz)
        }
        return btnsz
    };
    var NavSizeThresHold4IE = 25;
    var get_nav_btn_size_style = function(config, adjsize) {
        var btnsz = get_nav_btn_size(config);
        if (!btnsz) {
            return ""
        }
        if (adjsize) {
            var icnsz = parseInt(config.navbuttoniconrealsize);
            if (!icnsz) {
                icnsz = 18
            }
            var bdw = parseInt((btnsz - icnsz) / 2);
            btnsz -= bdw
        }
        if ($.browser.msie && $.browser.version < 10 && $.browser.version >= 9 && icnsz > NavSizeThresHold4IE) {
            var btnszh = btnsz - 1;
            return "height:" + btnszh + "px;width:" + btnsz + "px;"
        }
        return "height:" + btnsz + "px;width:" + btnsz + "px;"
    };
    var get_nav_icon_style = function(config) {
        var useFilter = false;
        var ret = "";
        if (config.navbuttoniconrealsize) {
            var icnsz = parseInt(config.navbuttoniconrealsize);
            var btnsz = get_nav_btn_size(config);
            var hw = "";
            if (btnsz) {
                var bdw = parseInt((($.browser.msie && $.browser.version >= 10 ? 1.1 : 1) * btnsz - icnsz) / 2);
                var ie8adj = 0;
                if (is_ie8()) {
                    ie8adj = bdw
                }
                var ie9adj = ($.browser.msie && $.browser.version < 10 && $.browser.version >= 9 && icnsz > NavSizeThresHold4IE) ? 1 : 0;
                hw += get_nav_btn_size_style(config, true) + "padding-left:" + parseInt(bdw / 2) + "px;padding-right:" + parseInt(bdw / 2) + "px;padding-top:" + (bdw + ie9adj - ie8adj) + "px;"
            }
            ret += "font-size:" + config.navbuttoniconrealsize + (icnsz ? "px;" : ";") + hw;
            ret += "border-radius:" + config.navbuttoniconrealsize + "px;"
        }
        if (config.navbuttoniconcolor) {
            ret += "color:" + format_color(config.navbuttoniconcolor) + ";" + (useFilter ? config.navbuttoniconopacity + ";" : "")
        }
        if (config.navbuttonshadowcolor) {
            ret += get_font_shadow_style(config.navbuttonshadowcolor, config.navbuttonshadowcolora, config.navbuttonshadowblur)
        }
        if (config.navbuttonbackcolor) {
            ret += "background-color:" + format_color(config.navbuttonbackcolor) + ";" + (useFilter ? config.navbuttonbackgroundopacity + ";" : "")
        }
        return ret
    };
    var get_button_bar_button_size = function(config) {
        if (!config.buttonbariconrealsize) {
            return {
                buttonWidth: 38,
                padding: 8
            }
        }
        return {
            buttonWidth: 2 * config.buttonbariconrealsize,
            padding: 8
        }
    };
    var get_popup_position_string = function(width, height) {
        var result = "height=" + height + ",width=" + width;
        return result
    };
    var getMsPointerXy = function(e) {
        var len = e.touches ? e.touches.length : 0;
        var x = -1,
            y = -1;
        if (len > 0) {
            x = e.touches[0].screenX;
            y = e.touches[0].screenY
        }
        if (len > 1) {
            x = e.touches[1].screenX;
            y = e.touches[1].screenY
        }
        return {
            x: x,
            y: y
        }
    };
    var is_buttonbarposition_default = function(cfg) {
        var bbpos = cfg.buttonbarposition.toUpperCase();
        if (bbpos != "TOP" && bbpos != "NONE" && bbpos != "OVERLAY_IMAGE") {
            return true
        }
        return false
    };
    var is_captionposition_default = function(cfg) {
        var cappos = cfg.captionposition.toUpperCase();
        if (cappos != "BOTTOM" && cappos != "NONE" && cappos != "OVERLAY_IMAGE" && cappos != "BELOW_IMAGE" && cappos != "BELOW_THUMBS") {
            return true
        }
        return false
    };
    var is_touchable_desktop = function() {
        if (window.navigator.msPointerEnabled && window.navigator.msMaxTouchPoints) {
            return true
        }
        return false
    };
    var is_touchable_device = function(config) {
        if (is_swipable_device() || is_touchable_desktop() || config.forcetouchmode) {
            return true
        }
        return false
    };
    return {
        ship: is_pro_version === u_skey,
        concate_path: concatenate_path,
        is_page_scrolling: is_it_scrolling,
        is_in_iframe: in_iframe,
        add_viewport_meta_tag_4_device: add_viewport_meta,
        set_viewport_meta: set_viewport_meta,
        is_iphone: is_iphone,
        is_iphone_chrome: is_iphone_chrome,
        is_ipad: is_ipad,
        is_android: is_android,
        is_small_android: is_small_android,
        get_android_ver: get_android_ver,
        is_chrome: is_chrome,
        is_opera: is_opera,
        get_current_path: get_current_path,
        get_query_string_value: get_qs_value,
        save_object_2_cookie: save_object_2_cookie,
        get_object_from_cookie: get_object_from_cookie,
        get_device_dpi: get_device_dpi,
        get_query_path: get_query_path,
        is_swipable_device: is_swipable_device,
        is_large_screen_mode: is_large_screen_mode,
        is_earlier_ie: is_earlier_ie,
        set_viewport_value: set_viewport_value,
        format_color: format_color,
        need_viewport_meta: need_viewport_meta,
        host_has_viewport_meta: host_has_viewport_meta,
        get_viewport_meta_content: get_viewport_meta_content,
        set_viewport_meta_content: set_viewport_meta_content,
        is_firefox: is_firefox,
        is_firefox3: is_firefox3,
        get_js_folder_url: get_js_folder_url,
        need_new_window: need_new_window,
        convert_to_absolute_path: convert_to_absolute_path,
        is_adobe_air: is_adobe_air,
        is_new_expanded_window: is_new_expanded_window,
        show_real_fullscreen: show_real_fullscreen,
        exit_fullscreen: exit_fullscreen,
        exit_support_real_fullscreen: exit_support_real_fullscreen,
        add_fullscreen_listener: add_fullscreen_listener,
        is_ie8: is_ie8,
        is_mobile_ie: is_mobile_ie,
        support_real_fullscreen: support_real_fullscreen,
        is_side_layout: is_side_layout,
        get_gallery_title_html: get_gallery_title_html,
        get_caption_html: get_caption_html,
        add_font_icon_4_ie8: add_font_icon_4_ie8,
        get_button_bar_icon_style: get_button_bar_icon_style,
        get_button_bar_style: get_button_bar_style,
        get_nav_icon_style: get_nav_icon_style,
        get_nav_btn_size: get_nav_btn_size,
        get_nav_btn_size_style: get_nav_btn_size_style,
        get_shadow_style_string: get_shadow_style_string,
        add_js_tag: add_js_tag,
        get_button_bar_button_size: get_button_bar_button_size,
        get_thumb_size: get_thumb_size,
        get_popup_position_string: get_popup_position_string,
        get_text_shadow_style: get_text_shadow_style,
        getMsPointerXy: getMsPointerXy,
        is_touchable_desktop: is_touchable_desktop,
        is_buttonbarposition_default: is_buttonbarposition_default,
        is_captionposition_default: is_captionposition_default,
        is_touchable_device: is_touchable_device
    }
};
var juicebox_config_manager = function(c, t) {
    var v = c;
    var a = t;
    var f = false;
    var s = "048d7e421a02974b54391bc3463ebd52";
    var z = false;
    var p = "";
    var b = "";
    var x = {
        containerid: "",
        debugmode: false,
        forcetouchmode: false,
        usefullscreenexpand: false,
        expandinnewpage: "AUTO",
        gallerywidth: "100%",
        galleryheight: "100%",
        backgroundcolor: "",
        backgroundurl: "",
        backgroundscale: "STRETCH",
        galleryfontface: "",
        backgroundopacity: "1",
        textcolor: "",
        textshadowcolor: "",
        textshadowcolora: "",
        topbackcolor: "",
        topbackopacity: "0",
        captionbackcolor: "",
        captionbackopacity: "1",
        buttonbarbackcolor: "",
        buttonbarbackopacity: "1",
        imageframecolor: "",
        imageframeopacity: "1",
        thumbframecolor: "rgba(255, 255, 255, .5)",
        thumbframeopacity: "",
        thumbframewidth: 0,
        thumbhoverframewidth: 2,
        thumbselectedframewidth: 10,
        thumbcornerradius: 0,
        thumbshadowcolor: "rgba(0, 0, 0, .4)",
        thumbshadowcolora: "",
        thumbshadowblur: 5,
        imageshadowcolor: "rgba(0, 0, 0, .4)",
        imageshadowcolora: "",
        imageshadowblur: 10,
        stagepadding: 0,
        imagepadding: 0,
        framewidth: 0,
        enablekeyboardcontrols: true,
        firstimageindex: -1,
        randomizeimages: false,
        showpreloader: true,
        screenmode: "AUTO",
        languagelistall: 'Previous|Next|Start AutoPlay|Stop AutoPlay|Play Audio|Pause Audio|Show Thumbnails|Expand Gallery|Close Gallery|Open Image in New Window|Download Image|About|AutoPlay ON|AutoPlay OFF|Show Thumbnails|Hide Thumbnails|Show Information|Next Image|Previous Image|Hide Information|Juicebox does not display locally in $BrowserName$. <a href="http://www.juicebox.net/support/faq/#$BrowserLink$">More Info</a>.|Juicebox Error: Config XML file not found.|Juicebox Error: Cannot find div with id: "|"|Juicebox Error: Theme CSS file not found|Buy this Image|Share on Facebook|Share on Twitter|Share on Google+|Share on Pinterest|To use Fotomoto please set the Fotomoto Store Id|Share on Tumblr|Go Back|of',
        languagelist: "",
        imagelocking: false,
        enablelooping: false,
        changeimageonhover: false,
        maximagewidth: 1024,
        maximageheight: 768,
        imageclickmode: "NAVIGATE",
        imagescalemode: "SCALE_DOWN",
        imagepreloading: "PAGE",
        imagetransitiontime: 0.5,
        imagetransitiontype: "SLIDE",
        imagevalign: "CENTER",
        imagehalign: "CENTER",
        showimageoverlay: "AUTO",
        showimagenav: true,
        imagenavposition: "STAGE",
        showbigplaybutton: false,
        thumbsposition: "BOTTOM",
        thumbnavposition: "CENTER",
        thumbwidth: 85,
        thumbheight: 85,
        thumbpadding: 10,
        thumbhseparation: 10,
        thumbvseparation: 10,
        thumbsvalign: "CENTER",
        thumbshalign: "CENTER",
        thumbpreloading: "PAGE",
        changecaptiononhover: false,
        changeimageonhover: false,
        usethumbdots: false,
        thumbdotcolor: "rgba(0, 0, 0, .4)",
        showthumbpagingtext: false,
        showsmallthumbsbutton: true,
        smallthumbsshowtitles: false,
        smallthumbslayoutstyle: "GRID",
        smallthumbslidetime: 0.5,
        topareaheight: 50,
        buttonbarposition: "OVERLAY",
        buttonbarhalign: "RIGHT",
        showopenbutton: true,
        showexpandbutton: true,
        showinfobutton: false,
        showdownloadbutton: false,
        showsharebutton: true,
        shownavbuttons: false,
        showautoplaybutton: false,
        showaudiobutton: false,
        showthumbsbutton: true,
        showthumbsonload: true,
        showsmallthumbsonload: true,
        buttonbariconsize: 0,
        buttonbariconrealsize: 0,
        buttonbariconcolor: "",
        buttonbariconopacity: "",
        buttonbariconhovercolor: "",
        buttonbariconhoveropacity: "",
        buttonbarshadowcolor: "",
        buttonbarshadowcolora: "",
        buttonbarshadowblur: 5,
        buttonbarbackgroundcolor: "",
        buttonbarbackgroundopacity: "",
        navbuttoniconsize: 0,
        navbuttoniconrealsize: 0,
        navbuttoniconcolor: "rgba(255, 255, 255, 1)",
        navbuttoniconopacity: "",
        navbuttoniconhovercolor: "",
        navbuttoniconhoveropacity: "",
        navbuttonshadowcolor: "",
        navbuttonshadowcolora: "",
        navbuttonshadowblur: 5,
        navbuttonbackcolor: "rgba(0, 0, 0, .5)",
        navbuttonbackgroundopacity: "",
        imagenavpadding: 20,
        imagecornerradius: 0,
        showoverlayonload: true,
        gallerytitle: "",
        gallerytitleposition: "OVERLAY",
        gallerytitlehalign: "LEFT",
        captionposition: "OVERLAY",
        captionhalign: "LEFT",
        maxcaptionheight: 120,
        showimagenumber: true,
        enableautoplay: false,
        autoplayonload: false,
        displaytime: 5,
        showautoplaystatus: true,
        gonextonautoplay: false,
        autoplaythumbs: true,
        audiourlmp3: "",
        audiourlogg: "",
        loopaudio: true,
        playaudioonload: false,
        audiovolume: 0.8,
        showsmallbackbutton: false,
        backbuttonuseicon: false,
        backbuttontext: "< Back",
        backbuttonurl: "",
        backbuttonposition: "NONE",
        backbuttonhalign: "LEFT",
        usefixedlayout: false,
        showsplashpage: "AUTO",
        splashbuttontext: "View Gallery",
        splashtitle: "",
        splashimageurl: "",
        splashshowimagecount: true,
        gallerydescription: "",
        enableseo: false,
        seoadditionaltext: "",
        enabledirectlinks: false,
        usefotomoto: false,
        fotomotostoreid: "",
        sharefacebook: false,
        sharetwitter: false,
        sharegplus: false,
        sharepinterest: false,
        sharetumblr: false,
        shareemail: false,
        configurl: "config.xml",
        themeurl: a.get_js_folder_url() + "classic/theme.css",
        baseurl: "",
        useflickr: false,
        flickrusername: "",
        flickrtags: "",
        flickruserid: "",
        flickrsetid: "",
        flickrgroupid: "",
        flickrtagmode: "ALL",
        flickrsort: "DATE-POSTED-DESC",
        flickrimagesize: "LARGE",
        flickrimagecount: 50,
        flickrextraparams: "",
        flickrshowtitle: true,
        flickrshowdescription: false,
        flickrshowpagelink: false,
        flickrpagelinktext: "View on Flickr",
        theme: "classic",
        showcaption: true,
        slidecaption: false,
        maxthumbcolumns: 10,
        maxthumbrows: 1,
        thumb_load_placeholder: "<div class='jb-status-thumb-loading'><div>",
        main_load_placeholder: "<div class='jb-status-loading'></div>",
        pages_header: "",
        sync_caption_dimensions: true,
        minimagegap: 60,
        use_webkit_transform: (a.is_swipable_device() && !a.is_in_iframe() && a.is_ipad()) || v.browser.webkit,
        onload: function() {}
    };
    var G = ",onload,";
    var r = ",containerid,gallerytitle,gallerywidth,galleryheight,backgroundcolor,overlaycolor,framecolor,showopenbutton,showexpandbutton,useflickr,flickrusername,flickrtags,configurl,themeurl,baseurl,debugmode,showthumbsbutton,maximagewidth,maximageheight,languagelist,usefullscreenexpand,textcolor,thumbframecolor,usethumbdots,";
    var n = {
        usefullscreenexpand: {
            appliedValues: [true],
            "default": false
        },
        showthumbsonload: {
            appliedValues: [false],
            "default": true
        },
        showthumbsbutton: {
            appliedValues: [false],
            "default": true
        },
        usethumbdots: {
            appliedValues: [true],
            "default": false
        },
        captionposition: {
            appliedValues: ["BELOW_IMAGE", "BOTTOM", "OVERLAY_IMAGE", "BELOW_THUMBS"],
            "default": "OVERLAY"
        },
        captionhalign: {
            appliedValues: ["CENTER", "RIGHT"],
            "default": "LEFT"
        },
        buttonbarposition: {
            appliedValues: ["TOP"],
            "default": "OVERLAY"
        },
        backbuttonposition: {
            appliedValues: ["TOP", "OVERLAY"],
            "default": "NONE"
        },
        backbuttonhalign: {
            appliedValues: ["RIGHT", "CENTER"],
            "default": "LEFT"
        },
        stagepadding: {
            appliedValues: null,
            "default": 0
        },
        topbackcolor: {
            appliedValues: null,
            "default": ""
        },
        thumbsposition: {
            appliedValues: ["TOP", "LEFT", "RIGHT"],
            "default": "BOTTOM"
        },
        thumbnavposition: {
            appliedValues: ["BOTTOM"],
            "default": "CENTER"
        },
        imageframecolor: {
            appliedValues: null,
            "default": ""
        },
        imagetransitiontype: {
            appliedValues: null,
            "default": "SLIDE"
        },
        changeimageonhover: {
            appliedValues: [true],
            "default": false
        },
        gallerytitleposition: {
            appliedValues: ["TOP", "ABOVE_THUMBS"],
            "default": "OVERLAY"
        },
        gallerytitlehalign: {
            appliedValues: ["RIGHT", "CENTER"],
            "default": "LEFT"
        },
        usefotomoto: {
            appliedValues: [true],
            "default": false
        },
        buttonbarhalign: {
            appliedValues: ["CENTER", "LEFT"],
            "default": "RIGHT"
        },
        thumbshalign: {
            appliedValues: ["RIGHT", "LEFT"],
            "default": "CENTER"
        },
        thumbsvalign: {
            appliedValues: ["TOP", "BOTTOM"],
            "default": "CENTER"
        },
        imagehalign: {
            appliedValues: ["RIGHT", "LEFT"],
            "default": "CENTER"
        },
        imagevalign: {
            appliedValues: ["TOP", "BOTTOM"],
            "default": "CENTER"
        }
    };
    var J = function(K) {
        if (!K) {
            return "100%"
        }
        if (typeof(K) === "number" || K.indexOf("%") <= 0) {
            return parseInt(K) + "px"
        }
        return K
    };
    var D = function(M, L) {
        if (!M) {
            return L
        }
        var K = M.split("#")[0].split("?")[0].split("/");
        if (K.length <= 0) {
            return L
        }
        if (K.length <= 1) {
            return ""
        }
        if (K[K.length - 1].toLowerCase().indexOf("theme.css") < 0) {
            return L
        }
        return K[K.length - 2]
    };
    var l = function(L, K, N, M) {
        if (M) {
            return M
        }
        if (!L || L.length <= K) {
            return N
        }
        return L[K]
    };
    var u = function(M, L, K, O, N) {
        if (!O && x.languagelistall[M]) {
            O = x.languagelistall[M]
        }
        x.languagelistall[M] = l(L, K, O, N)
    };
    var e = function(M, K) {
        if (!K) {
            return true
        }
        for (var L = 0; L < K.length; L++) {
            if (typeof(M) === "string") {
                if (K[L].toUpperCase() === M.toUpperCase()) {
                    return true
                }
            } else {
                if (K[L] === M) {
                    return true
                }
            }
        }
        return false
    };
    var B = function() {
        if (x.audiovolume < 0) {
            x.audiovolume = 0
        }
        if (x.audiovolume > 1) {
            x.audiovolume = 1
        }
        if (a.is_iphone() || a.is_ipad()) {
            x.playaudioonload = false
        }
        if (!x.showpreloader) {
            x.main_load_placeholder = x.main_load_placeholder.replace("jb-status-loading", "jb-status-no-loading")
        }
        if (x.backbuttonuseicon) {
            x.backbuttontext = " "
        }
        x.galleryfontface = decodeURI(x.galleryfontface).replace(/\+/g, " ");
        var L = a.is_large_screen_mode(x);
        if (L) {
            x.showsmallbackbutton = false;
            return
        }
        for (var K in x) {
            if (!n[K]) {
                continue
            }
            if (!e(x[K], n[K].appliedValues)) {
                continue
            }
            x[K] = n[K]["default"]
        }
        if (a.is_swipable_device()) {
            if (x.forcetouchmode) {
                x.forcetouchmodereversed = true
            }
            x.forcetouchmode = false
        }
        x.thumbselectedframewidth = x.thumbframewidth
    };
    var g = function() {
        if (typeof(x.languagelistall) != "string" && !x.languagelist) {
            return
        }
        var O = x.languagelist.split("|");
        x.languagelistbak = x.languagelist;
        x.languagelist = "";
        var K = O.length;
        var L = 5;
        var N = 24;
        if (m()) {
            if (K - N > 0) {
                O.splice(N, K - N)
            }
        } else {
            if (K - L > 0) {
                O.splice(N, K - L)
            }
        }
        var M = null;
        if (typeof(x.languagelistall) === "string") {
            M = x.languagelistall.split("|");
            x.languagelistall = {}
        }
        u("p", M, 0, "");
        u("n", M, 1, "");
        u("strta", M, 2, "", O[11]);
        u("stpa", M, 3, "", O[12]);
        u("plya", M, 4, "", O[7]);
        u("psa", M, 5, "", O[8]);
        u("st", M, 6, "", O[0]);
        u("gf", M, 7, "", O[2]);
        u("ef", M, 8, "", O[3]);
        u("oiinw", M, 9, "", O[4]);
        u("di", M, 10, "");
        u("abt", M, 11, "");
        u("aon", M, 12, "", O[13]);
        u("aoff", M, 13, "", O[14]);
        u("stlsm", M, 14, "", O[0]);
        u("htlsm", M, 15, "", O[1]);
        u("sinfo", M, 16, "", O[9]);
        u("gonxt", M, 17, "", O[5]);
        u("goprv", M, 18, "", O[6]);
        u("hdinfo", M, 19, "", O[10]);
        u("lcchm", M, 20, "");
        u("ae", M, 21, "");
        u("noid01", M, 22, "");
        u("noid02", M, 23, "");
        u("nothm", M, 24, "");
        u("fotomoto", M, 25, "", O[16]);
        u("facebook", M, 26, "", O[17]);
        u("twitter", M, 27, "", O[18]);
        u("gplus", M, 28, "", O[19]);
        u("printerest", M, 29, "", O[20]);
        u("fotomotomissingid", M, 30, "");
        u("tumblr", M, 31, "", O[21]);
        u("gobk", M, 32, "", O[15]);
        u("pgnum", M, 33, "", O[22])
    };
    var H = function() {
        x.galleryheight = J(x.galleryheight);
        x.gallerywidth = J(x.gallerywidth);
        x.theme = D(x.themeurl, x.theme);
        if (x.thumbwidth < 20 || x.thumbwidth > 600) {
            x.thumbwidth = 96
        }
        if (x.thumbheight < 20 || x.thumbheight > 600) {
            x.thumbheight = 96
        }
        g();
        var M;
        if (x) {
            if (x.backgroundcolor) {
                M = F(x.backgroundcolor);
                x.backgroundcolor = M.color;
                if (M.fullFormate) {
                    x.backgroundopacity = M.opacity
                }
            }
            if (x.textcolor) {
                M = F(x.textcolor);
                x.textcolor = M.color
            }
            if (x.textshadowcolor) {
                if (x.textshadowcolor.replace(/ /g, "").toLowerCase() === "rgba(0,0,0,0)") {
                    x.textshadowcolora = "transparent";
                    b += "textshadowcolora,"
                } else {
                    M = F(x.textshadowcolor);
                    x.textshadowcolora = M.color
                }
            }
            if (x.topbackcolor) {
                M = F(x.topbackcolor);
                x.topbackcolor = M.color;
                if (M.fullFormate) {
                    x.topbackopacity = M.opacity
                }
            }
            if (x.captionbackcolor) {
                M = F(x.captionbackcolor);
                x.captionbackcolor = M.color;
                if (M.fullFormate) {
                    x.captionbackopacity = M.opacity
                }
            }
            if (x.buttonbarbackcolor) {
                M = F(x.buttonbarbackcolor);
                x.buttonbarbackcolor = M.color;
                if (M.fullFormate) {
                    x.buttonbarbackopacity = M.opacity
                }
            }
            if (x.imageframecolor) {
                M = F(x.imageframecolor);
                x.imageframecolor = M.color;
                if (M.fullFormate) {
                    x.imageframeopacity = M.opacity
                }
            }
            if (x.thumbframecolor) {
                M = F(x.thumbframecolor);
                x.thumbframecolor = M.color;
                if (M.fullFormate) {
                    x.thumbframeopacity = M.opacity
                }
            }
            if (x.thumbshadowcolor) {
                M = F(x.thumbshadowcolor);
                x.thumbshadowcolora = M.color
            }
            if (x.imageshadowcolor) {
                M = F(x.imageshadowcolor);
                x.imageshadowcolora = M.color
            }
            if (x.buttonbariconcolor) {
                M = F(x.buttonbariconcolor);
                x.buttonbariconcolor = M.color;
                if (M.fullFormate) {
                    x.buttonbariconopacity = M.opacity
                }
            }
            if (x.buttonbariconhovercolor) {
                M = F(x.buttonbariconhovercolor);
                x.buttonbariconhovercolor = M.color;
                if (M.fullFormate) {
                    x.buttonbariconhoveropacity = M.opacity
                }
            }
            if (x.buttonbarbackgroundcolor) {
                M = F(x.buttonbarbackgroundcolor);
                x.buttonbarbackgroundcolor = M.color;
                if (M.fullFormate) {
                    x.buttonbarbackgroundopacity = M.opacity
                }
            }
            if (x.buttonbarshadowcolor) {
                M = F(x.buttonbarshadowcolor);
                x.buttonbarshadowcolora = M.color
            }
            if (x.navbuttoniconcolor) {
                M = F(x.navbuttoniconcolor);
                x.navbuttoniconcolor = M.color;
                if (M.fullFormate) {
                    x.navbuttoniconopacity = M.opacity
                }
            }
            if (x.navbuttoniconhovercolor) {
                M = F(x.navbuttoniconhovercolor);
                x.navbuttoniconhovercolor = M.color;
                if (M.fullFormate) {
                    x.navbuttoniconhoveropacity = M.opacity
                }
            }
            if (x.navbuttonbackcolor) {
                M = F(x.navbuttonbackcolor);
                x.navbuttonbackcolor = M.color;
                if (M.fullFormate) {
                    x.navbuttonbackgroundopacity = M.opacity
                }
            }
            if (x.navbuttonshadowcolor) {
                M = F(x.navbuttonshadowcolor);
                x.navbuttonshadowcolora = M.color
            }
            if (x.thumbdotcolor) {
                M = F(x.thumbdotcolor);
                x.thumbdotcolor = M.color
            }
            var L = 1;
            if (a.is_touchable_device(x)) {
                L = 1.3
            }
            if (x.buttonbariconsize === 0) {
                x.buttonbariconsize = 20
            }
            x.buttonbariconrealsize = parseInt(L * x.buttonbariconsize);
            if (x.navbuttoniconsize === 0) {
                x.navbuttoniconsize = 20
            }
            x.navbuttoniconrealsize = parseInt(L * x.navbuttoniconsize);
            var K = a.is_large_screen_mode(x);
            if (b.indexOf("maxthumbrows,") < 0) {
                if (K) {
                    if (b.indexOf("screenmode,") > -1) {
                        x.maxthumbrows = 1
                    }
                }
            }
            if (K) {
                x.showsmallthumbsbutton = true;
                if (x.usethumbdots && x.maxthumbcolumns <= 1 && x.thumbnavposition.toUpperCase() === "BOTTOM") {
                    x.maxthumbcolumns = 2
                }
                x.thumbhseparation = x.stagepadding;
                x.thumbvseparation = x.stagepadding
            } else {
                x.showthumbsbutton = true;
                x.maxthumbcolumns = 1000;
                x.maxthumbrows = 1000
            }
            if (a.is_side_layout(x)) {
                if (x.thumbshalign.toUpperCase() != "CENTER") {
                    x.thumbshalign = "CENTER"
                }
            } else {
                if (x.thumbsvalign.toUpperCase() != "CENTER") {
                    x.thumbsvalign = "CENTER"
                }
            }
            if (a.is_in_iframe()) {
                x.usefotomoto = false
            }
            if (a.is_swipable_device()) {
                x.buttonbariconhovercolor = "";
                x.navbuttoniconhovercolor = ""
            }
        }
    };
    var C = function(L) {
        var K = L.toString(16);
        if (K.length >= 2) {
            return K
        }
        if (K.length === 1) {
            return "0" + K
        }
        if (K.length === 0) {
            return "00"
        }
        return K
    };
    var h = function(K) {
        return K && parseInt(K, 16) > 0
    };
    var F = function(R) {
        if (!R) {
            return {
                color: "",
                opacity: y(1)
            }
        }
        var P = R.toLowerCase().replace(/ /g, "");
        if (P.indexOf("rgb") !== 0) {
            if (h(R)) {
                R = "#" + R
            }
            return {
                color: R,
                opacity: y(1),
                fullFormate: false
            }
        }
        P = P.replace("rgba(", "").replace("rgb(", "").replace(")", "");
        var O = P.split(",");
        if (O.length < 3 || O.length > 4) {
            return {
                color: R,
                opacity: y(1),
                fullFormate: false
            }
        }
        var L = R;
        if (v.browser.msie && v.browser.version < 9) {
            var N = parseInt(O[0]);
            var M = parseInt(O[1]);
            var K = parseInt(O[2]);
            L = "#" + C(N) + C(M) + C(K)
        }
        if (O.length === 3) {
            return {
                color: L,
                opacity: y(1),
                fullFormate: true
            }
        }
        var Q = parseFloat(O[3]);
        if (Q < 0 || Q > 1) {
            return {
                color: L,
                opacity: y(1),
                fullFormate: true
            }
        }
        return {
            color: L,
            opacity: y(Q),
            fullFormate: true
        }
    };
    var y = function(K) {
        if (!(v.browser.msie && v.browser.version < 9)) {
            return K
        }
        if (("" + K).indexOf("filter") === 0) {
            return K
        }
        var L = v.browser.version < 8 ? 100 : parseInt(100 * K);
        return "filter:alpha(opacity=" + L + ")"
    };
    var m = function() {
        return f || q === "048d7e421a02974b54391bc3463ebd52"
    };
    var j = function(M) {
        if (!M) {
            return
        }
        var L, O;
        var N = m();
        for (var K in M) {
            L = K.toLowerCase();
            if (typeof x[L] == "undefined") {
                continue
            }
            O = "," + L + ",";
            if (q === "048d7e421a20974d54321bc3563ebd52") {
                continue
            }
            if (!N && r.indexOf(O) < 0) {
                continue
            }
            if (G.indexOf(O) >= 0) {
                continue
            }
            b += L + ",";
            x[L] = w(M[K], (typeof x[L]))
        }
        H()
    };
    var q = "048d7e421a02974b54391bc3463ebd52";
    var w = function(L, K) {
        switch (K) {
            case "boolean":
                if (typeof L == "boolean") {
                    return L
                }
                return (L.toLowerCase() == "true" || L.toLowerCase() == "on" || L == "1") ? true : false;
            case "number":
                return parseFloat(L);
            default:
                return L
        }
        return L
    };
    var A = function() {
        var K = "";
        var O = ",gallerywidth,galleryheight,containerid,maxthumbrows,maxthumbcolumns,";
        var N, M;
        for (var L in x) {
            N = "," + L + ",";
            if (G.indexOf(N) >= 0) {
                continue
            }
            if (O.indexOf(N) >= 0) {
                continue
            }
            if (q === "048d7e421a20975d64321bc3563ebd52") {
                continue
            }
            M = (typeof x[L] == "string") ? x[L].replace("#", "_p-s_") : x[L];
            K += L + "=" + encodeURI(M) + "&"
        }
        return K
    };
    var i = function() {
        var O = window.location.href.split("?");
        if (O.length <= 1) {
            return null
        }
        var K = O[1].split("#");
        if (K.length <= 0) {
            return null
        }
        var S = K[0].split("&");
        var P = {};
        var R, L, T, N;
        var Q;
        for (var M = 0; M < S.length; M++) {
            R = S[M].split("=");
            if (R.length < 2) {
                continue
            }
            L = R[0].toLowerCase();
            N = R[1] ? R[1].replace("_p-s_", "#") : "";
            T = decodeURI(N);
            Q = typeof x[L];
            if (Q == "undefined") {
                continue
            }
            P[L] = w(T, Q)
        }
        return P
    };
    var E = function(M) {
        if (!M) {
            return null
        }
        var L = {};
        var P, N;
        var K = (v.browser.msie && M.childNodes.length > 1) ? M.childNodes[1] : M.childNodes[0];
        if (!K || !K.attributes) {
            return null
        }
        var O = v(K.attributes);
        O.each(function(Q, R) {
            P = R.nodeName.toLowerCase();
            N = typeof x[P];
            if (N == "undefined") {
                return
            }
            L[P] = w(R.nodeValue, N)
        });
        return L
    };
    var d = function(N) {
        if (!N) {
            N = p
        }
        var Q = function(U, V, T) {
            if (T < 0) {
                T = "Thu, 01 Jan 1970 00:00:00 GMT"
            } else {
                T = ""
            }
            document.cookie = U + "=" + escape(V) + ((T === "") ? "" : ";expires=" + T) + ";path=/"
        };
        var O = function(U) {
            if (document.cookie.length > 0) {
                var V = document.cookie.indexOf(U + "=");
                if (V !== -1) {
                    V = V + U.length + 1;
                    var T = document.cookie.indexOf(";", V);
                    if (T === -1) {
                        T = document.cookie.length
                    }
                    return unescape(document.cookie.substring(V, T))
                }
            }
            return ""
        };
        var M = function() {
            return N + "svcrntimgi_lf"
        };
        var K = function() {
            return N + "-sv-config-"
        };
        var R = function() {
            return N + "-changed-options-"
        };
        var L = function(Y) {
            Q(M(), "1", null);
            var X = b.split(",");
            var W = Y.skip ? "," + Y.skip + "," : "";
            for (var V = 0; V < X.length; V++) {
                if (!X[V]) {
                    continue
                }
                if (W.indexOf("," + X[V] + ",") >= 0) {
                    continue
                }
                Q(K() + X[V], encodeURI(x[X[V]]))
            }
            var Z = "," + b;
            var T = Y.skip.split(",");
            for (var V = 0; V < T.length; V++) {
                Z.replace("," + T[V] + ",", ",")
            }
            for (var U in Y.config) {
                if (!U) {
                    continue
                }
                if (Z.indexOf("," + U + ",") < 0) {
                    Z += U + ","
                }
                x[U] = Y.config[U];
                Q(K() + U, encodeURI(x[U]))
            }
            Q(R(), Z)
        };
        var P = function() {
            if (!O(M())) {
                return
            }
            var W = O(R());
            if (!W) {
                return
            }
            var T = W.split(",");
            for (var U = 0; U < T.length; U++) {
                if (!T[U]) {
                    continue
                }
                var V = O(K() + T[U]);
                if (!V) {
                    continue
                }
                x[T[U]] = w(decodeURI(V), typeof(x[T[U]]))
            }
            g()
        };
        var S = function() {
            Q(M(), "", -10)
        };
        return {
            saveConfig: L,
            loadSavedConfig: P,
            clearCookie: S
        }
    };
    var I = function(L, K, N) {
        if (window.location.href.indexOf("jbdbgmd=true") > 0 && z) {
            f = true
        }
        j(E(K));
        j(L);
        if (x.debugmode || f) {
            j(i())
        }
        p = N;
        var M = d(p);
        if (!a.is_new_expanded_window()) {
            M.clearCookie()
        } else {
            M.loadSavedConfig()
        }
    };
    var o = function(L, K) {
        j(E(K));
        j(L);
        if (x.debugmode || f) {
            j(i())
        }
        B()
    };
    var k = function() {
        return x
    };
    return {
        isp: s == q,
        init: I,
        sync_options: o,
        get_config: k,
        get_query_string: A,
        get_cookie_manager: d
    }
};
var juicebox_gallery_dialog = function(f) {
    var h, b;
    var a = "jb-glry-dlg";
    var i = function(m) {
        h = m.jquery;
        b = h("#" + a);
        if (b.length <= 0) {
            h("body").append(k());
            b = h("#" + a)
        }
    };
    var k = function() {
        return "<div id='" + a + "' style='display:none;position:absolute;width:100%;height:100%;left:0;top:0;'></div>"
    };
    var c = function() {
        b.hide()
    };
    var l = function() {
        c();
        b.html("");
        g(true);
        d(true)
    };
    var g = function(m) {
        if (m) {
            b.siblings(".jb-status-hiding-4-dlg").show().removeClass("jb-status-hiding-4-dlg")
        } else {
            b.siblings(":visible").addClass("jb-status-hiding-4-dlg").hide()
        }
    };
    var d = function(m) {
        if (m) {
            b.siblings().children(".jb-status-hiding-4-dlg").show().removeClass("jb-status-hiding-4-dlg")
        } else {
            b.siblings().children(".juicebox-gallery:visible").addClass("jb-status-hiding-4-dlg").hide()
        }
    };
    var j = function(n, m) {
        if (n) {
            g(false)
        } else {
            d(false)
        }
        if (m) {
            b.html(m)
        }
        b.show()
    };
    var e = function() {
        return a
    };
    i(f);
    return {
        initialize: i,
        hide_dialog: c,
        cleanup_dialog: l,
        show_dialog: j,
        get_id: e
    }
};
var juicebox_sizing_manager = function(M, ap, ag) {
    var af = M;
    var D = ag;
    var Y = ap;
    var B = af("body");
    var am = 0;
    var H = 0;
    var V = [{
        name: "HTC Panache",
        height: 535,
        width: 325
    }, {
        name: "HTC myTouch",
        height: 535,
        width: 325
    }, {
        name: "MB860",
        height: 615,
        width: 334
    }, {
        name: "X325a",
        height: 640,
        width: 360
    }, {
        name: "Z520m",
        height: 640,
        width: 360
    }];
    var X = function() {
        am = af(window).width();
        H = af(window).height()
    };
    var j = function() {
        var aw;
        for (var av = 0; av < V.length; av++) {
            aw = V[av];
            if (navigator.userAgent.indexOf(aw.name) >= 0) {
                if (aw.additional) {
                    if (navigator.userAgent.indexOf(aw.additional) >= 0) {
                        return aw
                    } else {
                        continue
                    }
                }
                return aw
            }
        }
        return null
    };
    var p = function(av) {
        var aw = j();
        if (!aw) {
            return {
                height: av,
                registered: false
            }
        }
        return {
            height: aw.height,
            registered: true
        }
    };
    var E = function(av) {
        var aw = j();
        if (!aw) {
            return {
                width: av,
                registered: false
            }
        }
        return {
            width: aw.width,
            registered: true
        }
    };

    function ai(aw) {
        var av = ao(aw, "height");
        if (parseInt(av) === 0) {
            return 0
        }
        return av
    }

    function m(aw) {
        var av = ao(aw, "width");
        if (parseInt(av) === 0) {
            return 0
        }
        return av
    }
    var x = function(ay, ax) {
        var av = Math.max(H, am);
        var aw = Math.min(H, am);
        return (ay > ax) ? av : aw
    };
    var A = function(aw, ax, av) {
        if (aw < 3.1) {
            return 1
        }
        if (aw > 3.1 && aw < 4) {
            return 0
        }
        if (aw < 4.1 && aw >= 4) {
            if (av > ax) {
                return 0
            }
            return D.is_small_android() ? 58 : 0
        }
        return (av > ax) ? 68 : 58
    };
    var s = false;
    var ah = 0;

    function ab(aB, aG, aA, av, az) {
        var aF = aG;
        var aw = true;
        if (D.is_in_iframe()) {
            return {
                 height: af(window).height(),
                //height: af(window).width()/1.25,
                registered: aw
            }
        }
        if (D.is_iphone()) {
            aF = aG * ak(aG, aA);
            if (aB || av) {
                if (aG > aA) {
                    if (aF >= screen.height) {
                        aF = screen.height - 20
                    } else {
                        if (screen.height > 560 && screen.height < 576) {
                            aF = screen.height - 64
                        }
                    }
                } else {
                    if (aG == screen.width) {
                        aF = screen.width
                    } else {
                        if (aF >= screen.width) {
                            aF = screen.width - 20
                        }
                    }
                }
            }
        } else {
            if (D.is_android()) {
                var aC = af(window);
                var aE = aC.height();
                var ay = aC.width();
                if (D.get_android_ver() < 4 && !(ax > 3.1 && ax < 4)) {
                    aE = screen.height;
                    ay = screen.width
                } else {
                    aE = x(aC.height(), aC.width())
                }
                var aD;
                if (aG > aA) {
                    aD = p(aG);
                    aF = aD.height
                } else {
                    aD = E(aG);
                    aF = aD.width
                }
                aw = aD.registered;
                if (!aw) {
                    var ax = D.get_android_ver();
                    if (ax >= 4) {
                        if (az) {
                            return {
                                height: parseInt(aF) + 2,
                                registered: aw
                            }
                        }
                        aF = aC.height() + A(ax, aA, aG)
                    } else {
                        if (ax > 3.1 && ax < 4) {
                            if (aC.height() > aE + 10) {
                                aF = aC.height() + (aC.height() > aC.width() ? (av ? 2 : 50) : 2)
                            } else {
                                if (aE > aC.height()) {
                                    aF = aC.height() + (aC.height() > aC.width() ? (av ? 2 : 0) : 2)
                                } else {
                                    aF = aG + (av ? 54 : 50)
                                }
                            }
                        } else {
                            if (ax >= 2.3) {
                                if (aG > aA) {
                                    aF = aD.height + 5
                                } else {
                                    aF = aD.width + 5
                                }
                            } else {
                                aF = aG + 5
                            }
                        }
                    }
                } else {
                    if (D.get_android_ver() >= 4 && av) {
                        aF += 5
                    }
                }
            } else {
                if (D.is_mobile_ie()) {
                    aF = parseInt(1.13 * aG)
                }
            }
        }
        return {
            height: aF,
            registered: aw
        }
    }
    var b = true;
    var ar = ai(B.attr("style"));
    var I = m(B.attr("style"));
    var t = (ar && parseInt(ar) > 0);
    var l = (I && parseInt(I) > 0);
    var y = function(av) {
        if (t) {
            return false
        }
        if (av.galleryheight.indexOf("%") < 0) {
            return false
        }
        if (((b && !f(av.gallerywidth, av.galleryheight)) || Q(av)) && !(D.is_iphone() && c(av))) {
            return false
        }
        return true
    };
    var u = function(av) {
        return false
    };
    var Q = function(av) {
        return J().heightFound && av.galleryheight.indexOf("%") > 0
    };
    var k = function(av) {
        return J().widthFound && av.galleryheight.indexOf("%") > 0
    };
    var an = function(aw, av) {
        var ax = af(window);
        if (av || y(aw)) {
            B.height(ab(av, ax.height(), ax.width()).height)
        }
        if (av || u(aw)) {
            B.width(ax.width())
        }
    };

    function ak(aw, av) {
        if (!D.is_iphone() || D.is_iphone_chrome()) {
            return 1
        }
        return (aw > av) ? 1.18 : 1.3
    }
    var f = function(aw, av) {
        if (aw === "100%" && av === "100%" && Y.width() == af("body").width() && J().percentHeight === 0 && (K().height == 0 || Y.height() == af("body").height() || (af("body").height() === 0 && D.is_ie8()))) {
            return true
        }
        return false
    };
    var c = function(aw) {
        var av = D.is_page_scrolling();
        if (f(aw.gallerywidth, aw.galleryheight) && (D.is_small_android() || D.is_iphone() || af.browser.msie || (!av.v_scrolling && !av.h_scrolling))) {
            return true
        }
        return false
    };

    function ao(az, aw) {
        if (!az || !aw) {
            return ""
        }
        var av = az.split(";");
        var ax, aC, aB, aA, ay;
        for (ay = 0; ay < av.length; ay++) {
            aC = af.trim(av[ay]);
            if (!aC) {
                continue
            }
            ax = aC.split(":");
            if (ax.length !== 2) {
                continue
            }
            aB = af.trim(ax[0]);
            aA = af.trim(ax[1]);
            if (!aB) {
                continue
            }
            if (aB.toLowerCase() === aw.toLowerCase()) {
                return aA
            }
        }
        return ""
    }
    var w = false;
    var g = 0;
    var aq = 0;
    var J = function() {
        if (w) {
            return {
                heightFound: g > 0,
                widthFound: aq > 0,
                percentHeight: g,
                percentWidth: aq
            }
        }
        w = true;
        Y.parents().each(function(aw, az) {
            if (g > 0 && aq > 0) {
                return
            }
            var ay = az.nodeName.toUpperCase();
            if (ay === "BODY") {
                return
            }
            style = af(az).attr("style");
            var ax = ai(style);
            var av = m(style);
            if (!av && !ax) {
                return
            }
            if (ax.indexOf("%") > 0 || parseInt(ax) > 0) {
                g = parseInt(ax)
            }
            if (av.indexOf("%") > 0 || parseInt(av) > 0) {
                aq = parseInt(av)
            }
        });
        return {
            heightFound: g > 0,
            widthFound: aq > 0,
            percentHeight: g,
            percentWidth: aq
        }
    };
    var aa = false;
    var a = 0;
    var d = 0;
    var K = function() {
        if (aa) {
            return {
                height: a,
                parentHeight: d
            }
        }
        a = Y.height();
        d = Y.parent().height();
        aa = true;
        return {
            height: a,
            parentHeight: d
        }
    };
    var z = 0;
    var n = function() {
        var aw = Y.height();
        var av = z;
        z = aw;
        return {
            newHeight: aw,
            oldHeight: av
        }
    };
    var O = false;
    var r = function() {
        var av = n();
        if (af.browser.msie) {
            if (af.browser.version < 8) {
                if (K().height === 0) {
                    if (av.newHeight > 0) {
                        return true
                    }
                } else {
                    if (K().height === av.newHeight && av.newHeight > 110) {
                        return true
                    }
                }
                return false
            } else {
                if (D.is_ie8()) {
                    if (Y.height() <= 0 && Y.parent().height() > 0 && Y.parent().height() === K().parentHeight) {
                        O = true;
                        return true
                    }
                    if (O) {
                        return true
                    }
                    return false
                }
            }
        }
        return K().parentHeight > 110 && av.newHeight > 110
    };
    var e = function(av, aw, aA, ax) {
        if (aw) {
            var az = af(window);
            var ay = ab(aw, az.height(), az.width(), aA, ax);
            return ay.height;
            return winh
        }
        return W(av, aw)
    };
    var W = function(aw, ay) {
        var av = parseInt(aw.galleryheight);
        if (aw.galleryheight.indexOf("%") < 0) {
            return av
        }
        if (!J().heightFound && r()) {
            if (D.is_ie8() && Y.height() < 10 && Y.parent().height() > 10) {
                return Y.parent().height()
            }
            return Y.height()
        }
        var aA = 1;
        var ax = 0;
        var az;
        Y.parents().each(function(aD, aF) {
            var aE = aF.nodeName.toUpperCase();
            if (aE === "BODY") {
                return
            }
            az = af(aF).attr("style");
            var aC = ai(az);
            if (aC.toLowerCase().indexOf("%") < 0 && parseInt(aC) > 0) {
                ax = parseInt(aC)
            }
            if (!aC || ax > 0) {
                return
            }
            if (aC.indexOf("%") > 0) {
                aA *= (parseInt(aC) / 100)
            }
        });
        var aB = af(window);
        if (ax === 0) {
            ax = ab(ay, aB.height(), aB.width()).height
        }
        if (!av) {
            av = 100
        }
        av /= 100;
        return aA * av * ax
    };
    var N = function(av, aw, ay) {
        if (aw) {
            var ax = af(window).width();
            if (ay && D.is_android() && D.get_android_ver() >= 4.1) {
                ax += 2
            }
            return ax
        }
        return F(av)
    };
    var F = function(av) {
        var aA = parseInt(av.gallerywidth);
        if (av.gallerywidth.indexOf("%") < 0) {
            return aA
        }
        if (!J().widthFound) {
            return Y.width()
        }
        var ay = 1;
        var aw = 0;
        var ax;
        Y.parents().each(function(aC, aE) {
            var aD = aE.nodeName.toUpperCase();
            if (aD === "BODY") {
                return
            }
            ax = af(aE).attr("style");
            var aB = m(ax);
            if (aB.toLowerCase().indexOf("%") < 0 && parseInt(aB) > 0) {
                aw = parseInt(aB)
            }
            if (!aB || aw > 0) {
                return
            }
            if (aB.indexOf("%") > 0) {
                ay *= (parseInt(aB) / 100)
            }
        });
        var az = af(window);
        if (aw === 0) {
            aw = az.width()
        }
        if (!aA) {
            aA = 100
        }
        aA /= 100;
        return ay * aA * aw
    };
    var aj = function(aw, az, ax) {
        var aA = S(aw, az, ax);
        var ay = D.get_thumb_size(ax);
        var av = ay.height + ax.thumbpadding;
        return aA.rows * av + ax.thumbpadding
    };
    var Z = function(ax) {
        if (!D.is_large_screen_mode(ax)) {
            return 0
        }
        var aw = ax.thumbsposition.toUpperCase();
        if (aw != "LEFT" && aw != "RIGHT") {
            return 0
        }
        var az = D.get_thumb_size(ax);
        var av = az.width + ax.thumbpadding;
        var aA = ax.thumbnavposition.toUpperCase() != "BOTTOM" ? 128 : 0;
        var ay = ax.maxthumbcolumns > 0 ? ax.maxthumbcolumns : 1;
        return av * ay + aA
    };
    var au = function(aw) {
        if (!D.is_large_screen_mode(aw)) {
            return 0
        }
        var av = aw.thumbsposition.toUpperCase();
        if (av === "LEFT" || av === "RIGHT") {
            return 0
        }
        var ax = D.get_thumb_size(aw);
        return ax.height + 2 * aw.thumbpadding
    };
    var G = function(av, aw) {
        if (av.captionposition.toUpperCase() === "NONE") {
            return 0
        }
        if (!aw || aw <= 0) {
            return av.maxcaptionheight
        }
        return av.maxcaptionheight > aw ? aw : av.maxcaptionheight
    };
    var i = function(aw, ax) {
        var av;
        if (ax) {
            av = ax
        } else {
            av = aw.captionposition.toUpperCase()
        }
        if ("BOTTOM,NONE,BELOW_IMAGE,OVERLAY_IMAGE,BELOW_THUMBS".indexOf(av) >= 0) {
            return false
        }
        return true
    };
    var T = 30;
    var v = 35;
    var h = 75;
    var at = function(aY, a3, aw, aB, aC, aW, aA, aZ) {
        var a9 = C(aY, a3, aZ);
        var ay = Z(aZ);
        var av = 2 * a9;
        if (av > aY - 60 || av > a3 - 60) {
            av = 0;
            a9 = 0
        }
        var aI = a9;
        var aP = a9;
        var aT = av;
        var aM = av;
        aT = 2 * aI;
        aM = 2 * aP;
        var aH, aD, aE, aS, aR, aK, ax, aF, aX, aQ, a6, ba, aG;
        var a2 = aI,
            a4 = 0,
            aV = 0,
            aJ = aP;
        var a5 = aZ.captionposition.toUpperCase();
        var a0 = aZ.thumbnavposition.toUpperCase();
        var aU = a0 === "BOTTOM" ? h : 0;
        if (aW) {
            a4 = aZ.topareaheight;
            aV = aY - aM
        }
        var a8 = aZ.thumbsposition.toUpperCase();
        var aL = aZ.thumbpadding / 2;
        var aO = aA + (2 * aL);
        aH = ((aZ.showthumbpagingtext && aU <= 0) ? aO + (aC ? v : 15) : aO) + (aC ? 0 : 25) + aU;
        var a1 = aZ.gallerytitleposition.toUpperCase();
        if (a1 === "ABOVE_THUMBS") {
            if (a8 != "LEFT" && a8 != "RIGHT") {
                aH += T
            }
        }
        aR = a3 - aH - a2 - a4 - aI;
        var az = aZ.captionposition.toUpperCase();
        aG = 0;
        var bc = G(aZ, a3 - a2 - a4 - aI);
        aX = bc;
        var bb = false;
        if (a8 === "TOP") {
            ax = a3 - aI - aR;
            aE = a2 + a4 + aL
        } else {
            if (a8 === "LEFT") {
                bb = true
            } else {
                if (a8 === "RIGHT") {
                    bb = true
                } else {
                    ax = a2 + a4;
                    aE = a3 - aI - aH + aL
                }
            }
        }
        if (bb) {
            aE = a2 + a4;
            ax = a2 + a4;
            aR = a3 - a2 - a4 - aI;
            aH = aR - (a5 === "BOTTOM" ? aX : 0)
        }
        if (a5 === "BELOW_IMAGE" || a5 === "BOTTOM") {
            a6 = a3 - aI - aX
        } else {
            if (a5 === "BELOW_THUMBS") {
                if (bb) {
                    if (aZ.thumbsvalign.toUpperCase() === "TOP") {
                        a6 = aj((bb ? ay : aY - aM), o(aZ, aH), aZ) + (aZ.showthumbpagingtext && aU <= 0 ? v : 0) + aU
                    } else {
                        a6 = (aH) / 2 + aj((bb ? ay : aY - aM), o(aZ, aH), aZ) / 2 + (aZ.showthumbpagingtext && aU <= 0 ? v : 0) + aU
                    }
                } else {
                    a6 = aj((bb ? ay : aY - aM), aH - o(aZ, aH), aZ) + (aZ.showthumbpagingtext && aU <= 0 ? v : 0) - parseInt(aZ.thumbpadding / 2) + aU
                }
            } else {
                a6 = aR - aX - a4
            }
        }
        if (aw && aB) {
            aD = aY - aM;
            aS = aP;
            aK = aD;
            aF = aP;
            if (bb) {
                aD = ay;
                aK = aY - aM - aD - aZ.thumbhseparation
            }
            if (a8 === "LEFT") {
                aS = aP;
                aF = aS + aD + aZ.thumbhseparation
            } else {
                if (a8 === "RIGHT") {
                    aF = aP;
                    aS = aF + aK + aZ.thumbhseparation
                } else {
                    if (!bb) {
                        if (a8 === "TOP") {
                            aR -= aZ.thumbvseparation;
                            ax += aZ.thumbvseparation
                        } else {
                            aR -= aZ.thumbvseparation
                        }
                    }
                }
            }
            aQ = aY - aM;
            ba = aP;
            if (az === "BOTTOM" || (!bb && a5 === "BELOW_THUMBS" && a8 != "TOP")) {
                if (a5 === "BELOW_THUMBS") {
                    ba = 0;
                    aH += aX;
                    if (!bb) {
                        a6 = aH - aX
                    }
                } else {
                    a6 = a3 - aX - aI
                }
                aR -= aX;
                if (a8 != "TOP") {
                    aE -= aX
                }
                if (aE < 0) {
                    aE = 0
                }
            } else {
                if (az === "BELOW_IMAGE") {
                    aX = aR;
                    aR -= bc;
                    a6 = ax;
                    aQ = aK;
                    ba = aF
                } else {
                    if (a5 === "BELOW_THUMBS") {
                        aX = bc;
                        ba = 0;
                        if (bb) {
                            aQ = aD
                        }
                        ba = 0;
                        if (a8 === "TOP") {
                            aR -= aX;
                            ax += aX
                        }
                        if (!bb) {
                            aH += aX
                        }
                    } else {
                        aG = (a8 === "TOP" ? 0 : aH) + aI;
                        var aN = aR - aX;
                        if (aN > 0) {
                            a6 = ax + aN
                        } else {
                            a6 = ax
                        }
                        if (az === "OVERLAY_IMAGE") {
                            aQ = aK;
                            ba = aF
                        }
                    }
                }
            }
        } else {
            var a7 = a2 + a4;
            aH = a3 - a7;
            aD = aY - aM;
            aE = aI + a7;
            aS = aP;
            aR = a3 - a7 - aI;
            aX = aZ.maxcaptionheight > aR ? aR : aZ.maxcaptionheight;
            aK = aY - aM;
            ax = a7;
            aF = aP;
            aQ = aY - aM;
            ba = aP;
            if (az === "BOTTOM") {
                aR -= aX
            } else {
                if (az === "BELOW_IMAGE") {
                    aR -= aX;
                    a6 = ax
                } else {
                    var aN = aR - aX;
                    if (aN > 0) {
                        a6 = ax + aN
                    } else {
                        a6 = ax
                    }
                    aG = aI
                }
            }
        }
        return {
            top_panel_height: a4,
            top_panel_width: aV,
            top_panel_left: aJ,
            top_panel_top: a2,
            index_panel_height: aH,
            index_panel_width: aD,
            index_panel_top: aE,
            index_panel_left: aS,
            detail_panel_height: aR,
            detail_panel_width: aK,
            detail_panel_top: ax,
            detail_panel_left: aF,
            caption_panel_height: aX,
            caption_panel_width: aQ,
            caption_panel_left: ba,
            caption_panel_top: a6,
            caption_panel_bottom: aG,
            is_sideway_layout: bb
        }
    };
    var C = function(av, az, ay) {
        var ax = Math.min(av, az);
        if (ay.stagepadding * 2 + 160 > ax) {
            var aw = parseInt((ax - 160) / 2);
            return aw >= 0 ? aw : 0
        }
        return ay.stagepadding
    };
    var R = function(ay, av, ax) {
        var aw = Math.min(ay, av);
        if (ax.imagepadding * 2 + 60 > aw) {
            if (ax.framewidth > 0 && ax.framewidth * 2 >= 60) {
                return parseInt((aw - 60) / 4)
            }
            return parseInt((aw - 60) / 2)
        }
        return ax.imagepadding
    };
    var al = function(ay, av, ax) {
        var az = 10;
        var aw = Math.min(ay, av);
        if (ax.framewidth * 2 + az > aw) {
            if (ax.imagepadding > 0 && ax.imagepadding * 2 >= az) {
                return parseInt((aw - az) / 4)
            }
            return parseInt((aw - az) / 2)
        }
        if (2 * ax.imagepadding + 2 * ax.framewidth + az > aw) {
            return 0
        }
        return ax.framewidth
    };
    var P = function(aB, aH, aG, aF, ax) {
        var aE, aw, aD, aA, az, aC;
        var av = aH / aF;
        var ay = aB / aG;
        if (aH <= 0 || aB <= 0 || aF <= 0 || aG <= 0) {
            return {}
        }
        if (av >= 1 && ay >= 1) {
            aD = "auto";
            aA = "auto";
            az = aH;
            aC = aB;
            aE = parseInt((aB - aG) / 2);
            aw = parseInt((aH - aF) / 2)
        } else {
            if (av < ay) {
                aD = aF;
                aA = "auto";
                az = aF;
                aC = parseInt(az * aB / aH);
                aw = 0;
                aE = parseInt((aC - aG) / 2)
            } else {
                aA = aG;
                aD = "auto";
                aC = aG;
                az = parseInt(aC * aH / aB);
                aE = 0;
                aw = parseInt((az - aF) / 2)
            }
        }
        var aI = {
            imageTop: -1 * aE,
            imageLeft: -1 * aw,
            imageWidth: aD,
            imageHeight: aA,
            imageExpectedWidth: az,
            imageExpectedHeight: aC
        };
        if (ax) {
            ax(aI)
        } else {
            return aI
        }
    };
    var L = function(ay, ax, aw, az) {
        ay = parseInt(ay);
        ax = parseInt(ax);
        var av = new Image();
        av.onload = function() {
            P(av.height, av.width, ax, ay, az)
        };
        av.src = aw
    };
    var U = function(ax, aB, ay, aA, aD, av) {
        var aC = av ? 0 : 2 * (R(aB, ay, aA) + al(aB, ay, aA));
        aB -= aC;
        ay -= aC;
        if (!ax || !ax.width || !ax.height) {
            return {
                width: "auto",
                height: "auto"
            }
        }
        var aw = aB / ax.width;
        var az = ay / ax.height;
        var aE = 0;
        if (aD === "SCALE") {
            aE = 0
        } else {
            if (aD === "FILL") {
                aE = 3
            } else {
                if (aD === "STRETCH") {
                    aE = 4
                } else {
                    if (aD === "NONE") {
                        aE = 2
                    } else {
                        if (aw < 1 || az < 1) {
                            aE = 0
                        } else {
                            aE = 1
                        }
                    }
                }
            }
        }
        switch (aE) {
            case 0:
                if (aw > az) {
                    return {
                        width: "auto",
                        height: ay + "px"
                    }
                } else {
                    return {
                        width: aB + "px",
                        height: "auto"
                    }
                }
                break;
            case 1:
                return {
                    width: ax.width + "px",
                    height: ax.height + "px"
                };
                break;
            case 2:
                return {
                    width: "auto",
                    height: "auto"
                };
                break;
            case 3:
                if (aw > az) {
                    return {
                        width: aB + "px",
                        height: "auto",
                        expectedWidth: aB,
                        expectedHeight: (aB * ax.height / ax.width)
                    }
                } else {
                    return {
                        width: "auto",
                        height: ay + "px",
                        expectedWidth: (ay * ax.width / ax.height),
                        expectedHeight: ay
                    }
                }
                break;
            case 4:
                return {
                    width: aB + "px",
                    height: ay + "px"
                };
                break
        }
    };
    var ae = function(aI, aN, av, az, aK, aL) {
        var aA = U(aI, aN, av, az, (aK ? aK : az.imagescalemode.toUpperCase()), aL);
        var aE = aA.width;
        var aO = aA.height;
        var aD = aL ? 0 : R(aN, av, az);
        var aG = aL ? 0 : al(aN, av, az);
        var aP = aD + aG;
        var aF = 2 * aP;
        if (aE === "auto" && aO === "auto") {
            aO = aI.height;
            aE = aI.width
        } else {
            if (aE === "auto") {
                aE = parseInt(aO) * (aI.width / aI.height)
            } else {
                if (aO === "auto") {
                    aO = parseInt(aE) * (aI.height / aI.width)
                }
            }
        }
        aE = parseInt(aE);
        aO = parseInt(aO);
        var ax = 0;
        var aH = 0;
        var ay = az.imagehalign.toUpperCase();
        var aB = az.imagevalign.toUpperCase();
        if (ay === "LEFT") {
            ax = 0
        } else {
            if (ay === "RIGHT") {
                ax = parseInt(aN - aE - 2 * aG) - aD
            } else {
                ax = parseInt((aN - aE) / 2) - aG
            }
        }
        if (aB === "TOP") {
            aH = 0
        } else {
            if (aB === "BOTTOM") {
                aH = parseInt(av - aO - 2 * aG) - aD
            } else {
                aH = parseInt((av - aO) / 2) - aG
            }
        }
        var aJ = ax;
        var aw = aH;
        if (ax < aD) {
            ax = aD
        }
        if (aH < aD) {
            aH = aD
        }
        var aM = aN - aF < parseInt(aE) ? aN - aF : parseInt(aE);
        var aC = av - aF < parseInt(aO) ? av - aF : parseInt(aO);
        return {
            width: parseInt(aE),
            height: parseInt(aO),
            left: ax,
            top: aH,
            frameWidth: aM,
            frameHeight: aC,
            unadjtop: aw,
            unadjleft: aJ,
            parentWidth: aN,
            parentHeight: av
        }
    };
    var S = function(av, aG, aw, aA) {
        if (aG < 0) {
            aG = 0
        }
        var aD = 0,
            az = 0;
        var aC = 0;
        var aF = D.get_thumb_size(aw);
        var aB = aF.width + aw.thumbpadding;
        var aE = aF.height + aw.thumbpadding;
        var ay = D.get_nav_btn_size(aw) + aw.thumbpadding;
        aC = av - (2 * ay);
        var ax = aw.thumbsposition.toUpperCase();
        if (ax === "LEFT" || ax === "RIGHT") {
            aD = aw.maxthumbcolumns
        } else {
            if (aD == 0 && av > 0) {
                aD = parseInt(aC / aB)
            }
        }
        if (aD <= 0) {
            aD = 1
        }
        if (aD > aw.maxthumbcolumns) {
            aD = aw.maxthumbcolumns
        }
        if (az == 0 && aG > 0) {
            az = parseInt(aG / aE);
            if (!D.is_large_screen_mode(aw) && (aA || aw.forcetouchmode || aw.forcetouchmodereversed)) {
                if (az * aE > aG - (aw.showthumbpagingtext ? 90 : 60)) {
                    az--
                }
            }
        }
        if (az <= 0 || aw.usethumbdots) {
            az = 1
        }
        if (az > aw.maxthumbrows) {
            az = aw.maxthumbrows
        }
        return {
            columns: aD,
            rows: az
        }
    };
    var o = function(aw, av) {
        var az = aw.thumbnavposition.toUpperCase();
        var ax = aw.captionposition.toUpperCase();
        var ay = D.is_side_layout(aw);
        if (aw.gallerytitleposition.toUpperCase() === "ABOVE_THUMBS" && ax != "BELOW_THUMBS" || !D.is_large_screen_mode(aw)) {
            av -= T
        }
        if (ax === "BELOW_THUMBS") {
            av -= G(aw);
            if (ay && az != "BOTTOM") {
                av -= G(aw)
            }
        }
        if (aw.showthumbpagingtext && az != "BOTTOM") {
            av -= (ay ? 2 : 1) * v
        }
        if (az === "BOTTOM") {
            av -= (ay ? 2 : 1) * h
        }
        av -= aw.thumbpadding / 2;
        return av
    };
    var q = function(ay, av, aw, ax) {
        av = o(aw, av);
        return S(ay, av, aw, ax)
    };
    var ac = function(av) {
        return parseInt(av.thumbheight / 3)
    };
    var ad = function(aL, aJ, aQ, aw, aG, aK) {
        var av = aQ.thumbshalign.toUpperCase();
        var aA = aQ.thumbsvalign.toUpperCase();
        var ax = D.get_thumb_size(aQ);
        var aN = aQ.thumbnavposition.toUpperCase();
        var aF = ax.width + aQ.thumbpadding;
        var aE = ax.height + aQ.thumbpadding;
        var aP = aG * aE + aQ.thumbpadding;
        if (aP < D.get_nav_btn_size(aQ)) {
            aP = D.get_nav_btn_size(aQ)
        }
        var aD = aw * aF + aQ.thumbpadding;
        var aO = aQ.captionposition.toUpperCase();
        var aB = C(Y.width(), Y.height(), aQ);
        var ay = (aO === "BOTTOM" ? aB : 0) + parseInt((aJ - aP) / 2 - (D.is_side_layout(aQ) ? aQ.thumbpadding : 0) / 2 + aQ.thumbpadding / 2);
        var aR = 0;
        var aM = ag.get_nav_btn_size(aQ);
        if (av === "LEFT") {
            aR = aM
        } else {
            if (av === "RIGHT") {
                aR = parseInt((aL - aD)) - aM
            } else {
                aR = parseInt((aL - aD) / 2)
            }
        }
        if (aA === "TOP") {
            ay = 0
        } else {
            if (aA === "BOTTOM") {
                ay = (aO === "BOTTOM" ? aB : 0) + parseInt((aJ - aP) - (D.is_side_layout(aQ) ? aQ.thumbpadding : 0) / 2 + aQ.thumbpadding / 2) - (aN === "BOTTOM" ? aM + ac() : 0)
            } else {
                ay = (aO === "BOTTOM" ? aB : 0) + parseInt((aJ - aP) / 2 - (D.is_side_layout(aQ) ? aQ.thumbpadding : 0) / 2 + aQ.thumbpadding / 2)
            }
        }
        if (!D.is_side_layout(aQ)) {
            ay = 0
        } else {
            if (ay < 0) {
                ay = 0
            }
        }
        var aC = aQ.gallerytitleposition.toUpperCase();
        var az = aQ.thumbnavposition.toUpperCase();
        var aI = D.is_large_screen_mode(aQ);
        var aH = false;
        if (D.is_side_layout(aQ)) {
            if (!aH) {
                if (ay < 0) {
                    ay = 0
                }
            }
        } else {
            if (aC === "ABOVE_THUMBS") {
                ay += T
            }
        }
        return {
            top: ay,
            left: aR,
            width: aD,
            height: (aH || !aI) ? "100%" : aP
        }
    };
    return {
        get_gallery_height: e,
        get_gallery_width: N,
        is_fullscreen_mode: c,
        is_gallery_fully_filled: f,
        try_set_body_size: an,
        get_containers_size_and_position: at,
        get_stage_padding: C,
        get_image_padding: R,
        get_image_framewidth: al,
        position_2_fill_image: L,
        force_height_calculation: Q,
        force_width_calculation: k,
        get_initial_size: X,
        get_initial_win_size: x,
        get_side_panel_width: Z,
        get_container_image_size_info: P,
        suggested_image_size: U,
        get_image_display_size: ae,
        get_thumb_size_info: q,
        get_thumbs_show_area_size_info: ad,
        constTitleHeight4AboveThumbs: T,
        constTitleHeight4AboveThumbs: T,
        constIndexNavHeight: h,
        get_android_additional_height: A,
        padding_bottom_index_nav: ac
    }
};
var juicebox_flickr_image_loader = function(r, y, j) {
    var w = y.get_config();
    var v = 50;
    var f = j;
    var J = 0;
    var g = 1;
    var z = 0;
    var i = window.location.href.toLowerCase().indexOf("https:") === 0;
    var D = i ? "s://secure" : "://api";
    var p = i ? "s" : "";
    var I = "http" + D + ".flickr.com/services/rest/?method=";
    var G = "&api_key=b40dc56c795c0103c6170731e6271e04";
    var a = {
        FLICKR_SEARCH: "flickr.photos.search",
        FLICKR_INTERESTINGNESS: "flickr.interestingness.getList",
        FLICKR_SET: "flickr.photosets.getPhotos",
        FLICKR_GROUP: "flickr.groups.pools.getPhotos",
        FLICKR_FIND_USER: "flickr.people.findByUsername",
        FLICKR_PHOTO_INFO: "flickr.photos.getInfo",
        FLICKR_PEOPLE_FIND: "flickr.people.findByUsername"
    };

    function q(K) {
        return I + a[K] + G
    }

    function F(K) {
        return q("FLICKR_SEARCH") + (w.flickrtags ? "&tags=" + w.flickrtags : "") + (w.flickruserid ? "&user_id=" + w.flickruserid : "") + "&page=" + g + "&per_page=" + K + "&sort=" + w.flickrsort.toLowerCase() + "&tag_mode=" + w.flickrtagmode.toLowerCase() + (w.flickrextraparams ? "&" + w.flickrextraparams.replace(/,/g, "&") : "") + "&media=photos&extras=url_sq,url_m,url_l,url_o,original_format&format=json&jsoncallback=?"
    }

    function e(K) {
        return q("FLICKR_SET") + "&photoset_id=" + w.flickrsetid + (w.flickrtags ? "&tags=" + w.flickrtags : "") + "&page=" + g + "&per_page=" + K + "&tag_mode=" + w.flickrtagmode.toLowerCase() + "&media=photos&extras=url_sq,url_m,url_l,url_o,original_format&format=json&jsoncallback=?"
    }

    function n(K) {
        return q("FLICKR_GROUP") + "&group_id=" + w.flickrgroupid + (w.flickrtags ? "&tags=" + w.flickrtags : "") + "&page=" + g + "&per_page=" + K + "&tag_mode=" + w.flickrtagmode.toLowerCase() + "&extras=url_sq,url_m,url_l,url_o,original_format&format=json&jsoncallback=?"
    }

    function m(K) {
        return q("FLICKR_INTERESTINGNESS") + "&page=" + g + "&per_page=" + K + "&extras=url_sq, url_m, url_l,url_o,original_format&format=json&jsoncallback=?"
    }

    function B() {
        return q("FLICKR_PEOPLE_FIND") + "&username=" + w.flickrusername + "&format=json&jsoncallback=?"
    }

    function s(K) {
        if (!y.isp) {
            if (w.flickrtags || w.flickrusername) {
                return F(K)
            } else {
                return m(K)
            }
        }
        if (w.flickrsetid) {
            return e(K)
        } else {
            if (w.flickrgroupid) {
                return n(K)
            } else {
                if (w.flickruserid) {
                    return F(K)
                } else {
                    if (w.flickrusername) {
                        return F(K)
                    } else {
                        if (w.flickrtags) {
                            return F(K)
                        } else {
                            return m(K)
                        }
                    }
                }
            }
        }
    }

    function c(L, K) {
        return "http" + p + "://www.flickr.com/photos/" + L + "/" + K
    }

    function A(M, N, L, K) {
        return "http" + p + "://farm" + M + ".static.flickr.com/" + N + "/" + K + "_" + L + "_s.jpg"
    }

    function l(M, N, L, K) {
        return "http" + p + "://farm" + M + ".static.flickr.com/" + N + "/" + K + "_" + L + ".jpg"
    }

    function o(M, N, L, K) {
        return "http" + p + "://farm" + M + ".static.flickr.com/" + N + "/" + K + "_" + L + "_b.jpg"
    }

    function d(M, N, L, K) {
        return "http" + p + "://farm" + M + ".static.flickr.com/" + N + "/" + K + "_" + L + "_o.jpg"
    }
    var b = function(M, O) {
        var Q, N, P;
        var K = "";
        var L = [];
        if (y.isp) {
            if (M.photos) {
                Q = M.photos.photo
            } else {
                if (M.photoset) {
                    Q = M.photoset.photo;
                    K = M.photoset.owner
                }
            }
        } else {
            Q = M.photos.photo
        }
        if (Q.length == 0) {
            f("Flickr Images Not Found")
        }
        for (N = 0; N < Q.length && N < J; N += 1) {
            P = {
                flickrPhotoId: Q[N].id,
                thumbURL: A(Q[N].farm, Q[N].server, Q[N].secret, Q[N].id),
                imageFullURL: c(Q[N].owner || K, Q[N].id),
                imageURL: c(Q[N].owner || K, Q[N].id),
                linkTarget: "_blank",
                caption: Q[N].title || "",
                description: "",
                preloadedImage: null,
                preloaded: false
            };
            if (w.flickrimagesize.toLowerCase() === "original" && Q[N].url_o) {
                P.imageURL = Q[N].url_o
            } else {
                if ((w.flickrimagesize.toLowerCase() === "large" || w.flickrimagesize.toLowerCase() === "original") && Q[N].url_l) {
                    P.imageURL = Q[N].url_l
                } else {
                    P.imageURL = Q[N].url_m
                }
            }
            L.push(P);
            if (typeof(O) === "function") {
                H(N, Q[N].id, O)
            }
        }
        return L
    };
    var C = function(K) {
        if (!K || !K.photo) {
            return null
        }
        var L = K.photo;
        return {
            id: L.id,
            title: L.title._content,
            description: L.description._content.replace(/\n/g, "<br/>")
        }
    };
    var h = function(L) {
        var K = B();
        r.ajax({
            url: K,
            dataType: "json",
            success: function(M) {
                if (M.stat === "ok") {
                    w.flickruserid = M.user.id;
                    if (L) {
                        L()
                    }
                } else {
                    f("Cannot find Flickr User: " + w.flickrusername)
                }
            },
            error: function(O, M, N) {
                f("Cannot find Flickr User: " + w.flickrusername)
            }
        })
    };
    var k = function(M, L) {
        J = (y.isp ? parseInt(w.flickrimagecount) : v);
        var K = s(J);
        r.ajax({
            url: K,
            dataType: "json",
            success: function(N) {
                if (N.photos) {
                    J = Math.min(N.photos.total, J);
                    z = N.photos.pages
                } else {
                    if (N.photoset) {
                        J = Math.min(N.photoset.total, J);
                        z = N.photoset.pages
                    }
                }
                if (N.stat === "ok") {
                    if (M) {
                        M(b(N, L))
                    }
                } else {
                    f("Flickr Images Not Found")
                }
            },
            error: function(P, N, O) {
                f("Flickr Images Not Found")
            }
        })
    };
    var x = function(K) {
        return q("FLICKR_PHOTO_INFO") + "&format=json&photo_id=" + K + "&jsoncallback=?"
    };
    var H = function(M, L, N) {
        if (!w.flickrshowdescription) {
            return
        }
        var K = x(L);
        r.ajax({
            url: K,
            dataType: "json",
            success: function(O) {
                if (O.stat === "ok") {
                    if (N) {
                        N(M, C(O))
                    }
                }
            },
            error: function(Q, O, P) {}
        })
    };
    var t = function(L, K) {
        if (w.flickrusername) {
            h(function() {
                k(L, K)
            })
        } else {
            k(L, K)
        }
    };
    var E = function(M, K, L) {
        if (!w.flickrshowdescription) {
            return
        }
        if (typeof(L) === "function") {
            H(M, K, L)
        }
    };
    var u = function(K, L, N) {
        if (!w.flickrshowdescription) {
            return
        }
        if (typeof(N) !== "function") {
            return
        }
        if (L.to >= K.length) {
            L.to = K.length - 1
        }
        if (L.from < 0) {
            L.from = 0
        }
        for (var M = L.from; M <= L.to; M++) {
            if (K[M].detail_loaded) {
                continue
            }
            E(M, K[M].flickrPhotoId, N)
        }
    };
    return {
        get_images: t,
        load_flickr_images_detail: u
    }
};
var juicebox_gallery_manager = function() {
    var g = [];
    var a = 0;
    var f;
    var k = function(m) {
        f = m
    };
    var h = function(m) {
        m.position = g.length;
        m.loaded = 0;
        m.thumb_loaded = 0;
        m.width = null;
        m.height = null;
        m.thumb_width = null;
        m.thumb_height = null;
        m.order = parseInt(1000 * Math.random());
        g[g.length] = m;
        a = g.length
    };
    var i = function(m) {
        return g[m]
    };
    var d = function() {
        return g
    };
    var c = function(m) {
        m = parseInt(m);
        if (!f.enablelooping && m >= g.length - 1) {
            return null
        }
        return g[m < g.length - 1 ? m + 1 : 0]
    };
    var l = function(m) {
        m = parseInt(m);
        if (!f.enablelooping && m <= 0) {
            return null
        }
        return g[m > 0 ? m - 1 : g.length - 1]
    };
    var e = function(m) {
        g[m.position] = m
    };
    var j = function(n, m) {
        return g.slice(n, m)
    };
    var b = function() {
        g = g.sort(function(o, n) {
            return o.order - n.order
        });
        for (var m = 0; m < g.length; m++) {
            g[m].position = m
        }
    };
    var a = function() {
        return g.length
    };
    return {
        add_image: h,
        length: a,
        get_range: j,
        get_image: i,
        get_images: d,
        update_image: e,
        get_previous_image: l,
        get_next_image: c,
        sort_images: b,
        init: k
    }
};
var juicebox_gallery_splash_panel = function() {
    var b, c, f, a, e, g, p, n, k;
    var o, m, s;
    var l = function(t) {
        b = t.jquery;
        c = t.document_id;
        f = t.container;
        e = t.config;
        g = t.utils;
        p = t.sizing;
        a = t.glymng;
        n = t.finish_draw_event_callback;
        k = t.view_gallery_event_callback;
        o = t.current_width;
        m = t.current_height;
        s = t.splashImageUrl
    };
    var r = function(t) {
        return b(g.get_query_path(c, t))
    };
    var j = function() {
        if (!e.gallerydescription) {
            return ""
        }
        return "<p class='jb-splash-desc'>" + e.gallerydescription + "</p>"
    };
    var d = function() {
        var t = "style='display:none;position:absolute;left:0;top:0;width:" + o + "px;height:" + m + "px'";
        return "<table><tr><td class='jb-splash-holder'><img src='" + s + "' " + t + "/>                     <div class='jb-splash-background' " + t + "></div>                     <div class='jb-splash'>                     <div class='jb-splash-info jb-layer' layer='100' style='z-index:100;'>                         <h3>" + (e.splashtitle ? e.splashtitle : e.gallerytitle) + "</h3>                         " + (e.splashshowimagecount ? "<p class='jb-splash-cnt'>" + a.length() + " Image" + (a.length() > 1 ? "s" : "") + "</p>" : "") + j() + "<a class='jb-splash-view-glry' href='#'>" + e.splashbuttontext + "</a>                     </div>                 </div></td></tr></table>"
    };
    var h = function() {
        f.html(d());
        p.position_2_fill_image(f.width(), f.height(), s, function(t) {
            r(".jb-splash-holder img").css({
                top: t.imageTop,
                left: t.imageLeft,
                width: t.imageWidth,
                height: t.imageHeight
            }).show()
        });
        r(".jb-splash-view-glry, .jb-splash, .jb-splash-background").click(function() {
            k();
            return false
        });
        if (typeof(n) === "function") {
            n()
        }
    };
    var q = function() {};
    var i = function() {
        f.html("")
    };
    return {
        initialize: l,
        draw: h,
        resize: q,
        purge: i
    }
};
var juicebox_gallery_index_panel = function(L) {
    var ak, d, aq, Q, aa, ac, ay, al;
    var z = L;
    var aw = 0;
    var aB = 1;
    var E = 0,
        P = 0;
    var U = 0;
    var v = 0;
    var S = 86;
    var ai = 86;
    var J = 96;
    var am = 96;
    var r = 5;
    var n = true;
    var h = false;
    var e = "jb-tbn-current";
    var W = "jb-tbn-prev";
    var ab = "jb-tbn-next";
    var l = 0;
    var H = 0;
    var ap = 0;
    var G = 0;
    var j = 0;
    var a = false;
    var ao = false;
    var x = "display:none;";
    var B = 11;
    var aA;
    var F = function(aD) {
        return ak(z.get_query_path(d, aD))
    };
    var T = function() {
        if (v == 0) {
            v = F("").height()
        }
        E = 0;
        P = 0;
        var aD = ac.get_thumb_size_info(U, v, aa, h);
        E = aD.columns;
        P = aD.rows;
        aB = Math.ceil(Q.length() / (P * E))
    };
    var A = function() {
        return ac.get_thumbs_show_area_size_info(U, v, aa, E, P, F("").height())
    };
    var av = function() {
        var aD = (aw + 1) * E * P - 1;
        if (aD >= Q.length()) {
            aD = Q.length() - 1
        }
        if (aD < 0) {
            aD = 0
        }
        return {
            from: aw * E * P,
            to: aD
        }
    };
    var k = function(aD) {
        var aE = z.get_thumb_size(aD);
        S = aE.width;
        ai = aE.height;
        r = aD.thumbpadding / 2;
        J = S + (2 * r);
        am = ai + (2 * r)
    };
    var V = function(aE, aD) {
        ak = aE.jquery;
        h = aD;
        d = aE.document_id;
        aq = aE.container;
        aa = aE.config;
        z = aE.utils;
        ac = aE.sizing;
        Q = aE.glymng;
        ay = aE.finish_draw_event_callback;
        al = aE.touch_event_callback;
        aA = aE.debug;
        U = aE.current_width;
        v = aE.current_height;
        k(aa);
        T();
        o();
        ae();
        C();
        if (z.ship || !aa.usethumbdots || P > 1) {
            B = 0
        }
    };
    var o = function() {
        var aE = z.get_gallery_title_html(aa, true);
        var aD = "";
        if (aa.captionposition.toUpperCase() === "BELOW_THUMBS") {
            aD = z.get_caption_html()
        }
        aq.html(aE + "<div class='jb-idx-show-area' style='overflow:hidden;margin:0;padding:0;position:absolute;'></div>" + (aa.showthumbpagingtext ? "<div class='jb-idx-thb-list-page-number' style='position: absolute;'></div>" : "") + aD)
    };
    var ae = function() {
        var aH = function(aJ) {
            if (a) {
                return
            }
            aJ.preventDefault();
            G = 0;
            j = 0;
            if (!ao) {
                ao = true;
                if (z.is_touchable_desktop()) {
                    var aK = z.getMsPointerXy(aJ);
                    H = aK.x;
                    ap = aK.x
                } else {
                    H = aJ.originalEvent.touches[0].pageX;
                    ap = aJ.originalEvent.touches[0].pageX
                }
            }
        };
        var aD = function(aK) {
            if (a || !ao) {
                return
            }
            aK.preventDefault();
            var aJ, aM;
            if (z.is_touchable_desktop()) {
                var aL = z.getMsPointerXy(aK);
                aJ = aL.x;
                aM = aL.y
            } else {
                aJ = aK.originalEvent.touches[0].pageX;
                aM = aK.originalEvent.touches[0].pageX
            }
            G = aJ - H;
            F("table.jb-idx-thb-container").animate({
                left: "+=" + (aJ - ap),
                avoidTransforms: !aa.use_webkit_transform,
                useTranslate3d: true
            }, 0);
            ap = aJ;
            j = aJ - H
        };
        var aF = function(aJ) {
            if (a || !ao) {
                return
            }
            ao = false;
            if (G > 5) {
                if (m() && !aa.enablelooping) {
                    O(G)
                } else {
                    af(Math.abs(G), null, U, v)
                }
                aJ.preventDefault()
            } else {
                if (G < -5) {
                    if (au() && !aa.enablelooping) {
                        O(G)
                    } else {
                        g(Math.abs(G), null, U, v)
                    }
                    aJ.preventDefault()
                } else {
                    if (Math.abs(j) < 5 && !z.is_touchable_desktop()) {
                        if (aa.forcetouchmode) {
                            if (ak(aJ.target).attr("position") != null) {
                                ay(ak(aJ.target).attr("position"))
                            } else {
                                if (ak(aJ.target).parent().attr("position") != null) {
                                    ay(ak(aJ.target).parent().attr("position"))
                                }
                            }
                        } else {
                            if (ak(aJ.target).parent().attr("position") != null) {
                                ay(ak(aJ.target).parent().attr("position"))
                            }
                        }
                    }
                }
            }
        };
        if (z.is_touchable_desktop()) {
            var aG = document.getElementsByClassName("jb-idx-thumbnail-container");
            for (var aE = 0; aE < aG.length; aE++) {
                var aI = aG[aE];
                aI.addEventListener("touchstart", aH, false);
                aI.addEventListener("touchmove", aD, false);
                aI.addEventListener("touchend", aF, false);
                aI.addEventListener("gesturestart", aH, false);
                aI.addEventListener("gesturechange", aD, false);
                aI.addEventListener("gestureend", aF, false)
            }
        } else {
            if (!ak.browser.msie) {
                aq.bind("touchstart", aH).bind("touchmove", aD).bind("touchend", aF)
            }
        }
        if (aa.forcetouchmode && !z.is_touchable_desktop()) {
            F(" .jb-idx-thumb, .jb-idx-thb-frame").mousedown(function(aK) {
                if (aK.which !== 1) {
                    return
                }
                var aJ = {
                    originalEvent: {
                        touches: [{}]
                    }
                };
                aK.preventDefault();
                aJ.preventDefault = function() {};
                aJ.originalEvent.touches[0].pageX = aK.screenX;
                aJ.originalEvent.touches[0].pageY = aK.screenY;
                ak(this).children(".jb-idx-thb-frame").css(az());
                aH(aJ)
            }).mousemove(function(aK) {
                if (aK.which !== 1) {
                    ao = false;
                    return
                }
                if (!ao) {
                    return
                }
                var aJ = {
                    originalEvent: {
                        touches: [{}]
                    }
                };
                aJ.preventDefault = function() {};
                aJ.originalEvent.touches[0].pageX = aK.screenX;
                aJ.originalEvent.touches[0].pageY = aK.screenY;
                aD(aJ)
            }).mouseup(function(aK) {
                if (!ao) {
                    return
                }
                var aJ = {};
                aJ.preventDefault = function() {};
                aJ.target = this;
                aF(aJ)
            }).mouseout(function(aK) {
                if (!ao) {
                    return
                }
                var aJ = {};
                aJ.preventDefault = function() {};
                aJ.target = this;
                aF(aJ)
            })
        }
    };
    var p = function() {
        var aE = E * J;
        var aD = P * am;
        return {
            height: aD,
            width: aE
        }
    };
    var aj = function(aK, aJ, aF, aQ, aE) {
        var aM = P * E * aK;
        var aN = P * E * (aK + 1);
        var aD = "page_" + aK;
        var aO;
        if (Q.length() < E) {
            aO = Q.length() * J
        } else {
            aO = E * J
        }
        var aI = z.is_side_layout(aa) || (aa.usethumbdots && P * am < z.get_nav_btn_size(aa));
        aJ.append("<table class='jb-idx-thb-container jb-classifier-thumb-area table_page_" + aK + " " + (aE ? aE : "") + "' style='left:" + aF + "px;" + (aI ? "height:100%;" : "") + "' ><tr><td style='text-align:center !important;width:auto !important;'><div class='jb-idx-thb-list' style='text-align:center !important;width:" + aO + "px;margin-left: auto;margin-right: auto; margin-top:0; margin-bottom:0; padding:0;' ></div></td></tr></table>");
        var aH = F(".table_page_" + aK + (aE ? "." + aE : "") + " .jb-idx-thb-list");
        var aP = "";
        var aL = Q.get_range(aM, aN);
        for (var aG = 0; aG < aL.length; aG++) {
            aP = Z(aL[aG], aH, aP)
        }
        aH.append(aP)
    };
    var s = function(aD) {
        if (z.is_earlier_ie()) {
            return ""
        }
        return aD.thumbcornerradius > 0 && aD.thumbcornerradius <= Math.min(aD.thumbwidth, aD.thumbheight) ? "border-radius:" + aD.thumbcornerradius + "px;" : ""
    };
    var ar = function() {
        if (aa.usethumbdots) {
            return "width:" + (J) + "px;height:" + (am) + "px;padding:0;margin:" + B + "px 0 0 0;" + (aa.navbuttonbackcolor ? "color:" + z.format_color(aa.navbuttonbackcolor) + ";" : z.format_color(aa.thumbdotcolor))
        }
        return "overflow:hidden;width:" + (S) + "px;height:" + (ai) + "px;padding:0;margin:" + (B + r) + "px " + parseInt(r) + "px " + r + "px " + parseInt(r) + "px;" + s(aa)
    };
    var f = function(aE, aD) {
        if (aa.usethumbdots) {
            return "padding:0;margin:" + r + "px;width:" + (S) + "px;height:" + (ai) + "px;"
        }
        return (aD ? "display:inline;" : "") + "display:inline;position:relative;padding:0;left:" + aE.left + "px;top:" + aE.top + "px;width:" + aE.thumb_width + "px;height:" + aE.thumb_height + "px;"
    };
    var C = function() {
        var aF = aa.thumbpreloading.toUpperCase();
        if (aF != "ALL") {
            return
        }
        var aD = Q.get_images();
        for (var aE = 0; aE < aD.length; aE++) {
            Y(aD[aE])
        }
    };
    var y = function() {
        return aa.thumbframecolor ? z.format_color(aa.thumbframecolor) : ""
    };
    var w = function(aD) {
        if (aD) {
            return (aa.thumbframecolor && aa.thumbselectedframewidth ? "border-color:" + z.format_color(aa.thumbframecolor) + ";" : "") + (z.is_ie8() ? aa.thumbframeopacity + ";" : "")
        }
        return (aa.thumbframecolor && aa.thumbframewidth ? "border-color:" + z.format_color(aa.thumbframecolor) + ";" : "") + (z.is_ie8() ? aa.thumbframeopacity + ";" : "")
    };
    var c = function(aG) {
        if (aa.usethumbdots) {
            return ""
        }
        var aD = ak("#" + d + "_thumb_" + aG.position + ".jb-thm-thumb-selected").length > 0 && z.is_large_screen_mode(aa);
        var aE = aD ? w() : "";
        var aF = aD ? aa.thumbselectedframewidth : aa.thumbframewidth;
        var aH = aD ? aa.thumbselectedframewidth : aa.thumbframewidth;
        return '<div class="jb-idx-thb-frame" style="position:absolute;border-style:solid;' + aE + ";border-width:" + aH + "px;width:" + (S - 2 * aF) + "px;height:" + (ai - 2 * aF) + "px;left:0px;top:0;" + w(aD) + s(aa) + '"></div>'
    };
    var Y = function(aD) {
        if (aD.isPreloadingThumbnail) {
            return
        }
        aD.isPreloadingThumbnail = true;
        ac.position_2_fill_image(S, ai, aD.thumbURL, function(aE) {
            aD.thumb_loaded = 1;
            if (S === ai && aE.imageExpectedWidth === aE.imageExpectedHeight) {
                aD.thumb_width = S;
                aD.thumb_height = ai;
                aD.imageExpectedWidth = ai;
                aD.imageExpectedHeight = ai;
                aD.top = 0;
                aD.left = 0
            } else {
                aD.thumb_width = aE.imageWidth;
                aD.thumb_height = aE.imageHeight;
                aD.imageExpectedWidth = aE.imageExpectedWidth;
                aD.imageExpectedHeight = aE.imageExpectedHeight;
                aD.top = aE.imageTop;
                aD.left = aE.imageLeft
            }
            if (n) {
                ak("#" + d + "_thumb_" + aD.position).html("<img class='jb-thm-thumb-image' src='" + aD.thumbURL + "' style='" + x + f(aD, true) + s(aa) + "'>" + c(aD));
                ak("#" + d + "_thumb_" + aD.position + " img").fadeIn(400)
            } else {
                ak("#" + d + "_thumb_" + aD.position).html("<img class='jb-thm-thumb-image' src='" + aD.thumbURL + "' style='" + f(aD, false) + s(aa) + "'>" + c(aD))
            }
            Q.update_image(aD);
            ak("#" + d + "_thumb_" + aD.position + " img").disableSelection()
        })
    };
    var ax = function(aD) {
        return z.get_shadow_style_string(aD.thumbshadowcolor, aD.thumbshadowcolora, aD.thumbshadowblur)
    };
    var Z = function(aF, aE, aD) {
        if (aa.usethumbdots) {
            return aD + "<div position='" + aF.position + "' id='" + d + "_thumb_" + aF.position + "' class='jb-idx-thumb jb-thm-thumb-dot' style='" + ar() + "'><div class='jb-thm-thumb-image' style='" + f(aF) + "'>" + ((ak.browser.msie && ak.browser.version < 9) ? "&#xe015;" : "") + "</div></div>"
        }
        if (aF.thumb_loaded) {
            return aD + "<div position='" + aF.position + "' id='" + d + "_thumb_" + aF.position + "' class='jb-idx-thumb' style='" + ar() + ax(aa) + "'><img class='jb-thm-thumb-image' src='" + aF.thumbURL + "' style='" + f(aF) + s(aa) + "'>" + c(aF) + "</div>"
        } else {
            aE.append(aD);
            aD = "";
            aE.append("<div position='" + aF.position + "' id='" + d + "_thumb_" + aF.position + "' class='jb-idx-thumb' style='" + ar() + ax(aa) + "'>" + aa.thumb_load_placeholder + "</div>");
            Y(aF);
            return ""
        }
    };
    var at = function() {
        return (aw <= 0) ? aB - 1 : aw - 1
    };
    var N = function() {
        return (aw >= aB - 1) ? 0 : aw + 1
    };
    var I = function() {
        an(aw)
    };
    var ah = function(aD) {
        if (aD < 0 || aD >= aB) {
            return
        }
        M(aD)
    };
    var ag = function(aD, aE, aH, aF) {
        if (aE) {
            U = aE
        }
        if (aH) {
            v = aH
        }
        T();
        var aG = parseInt(aD / (E * P));
        M(aG, aF);
        q(aD);
        if (!z.is_large_screen_mode(aa)) {
            F(".jb-idx-title").show()
        }
    };
    var u = function() {
        an(at())
    };
    var K = function() {
        an(N())
    };
    var q = function(aE) {
        l = aE;
        var aG = S - (2 * aa.thumbselectedframewidth);
        var aI = ai - (2 * aa.thumbselectedframewidth);
        var aJ = S - (2 * aa.thumbframewidth);
        var aD = ai - (2 * aa.thumbframewidth);
        var aF = (aa.navbuttonbackcolor ? z.format_color(aa.navbuttonbackcolor) : z.format_color(aa.thumbdotcolor));
        F(".jb-idx-thumb").removeClass("jb-thm-thumb-selected").children("div").css({
            color: aF
        });
        F(".jb-idx-thumb .jb-idx-thb-frame").css({
            width: aJ + "px",
            height: aD + "px",
            "border-width": aa.thumbframewidth
        });
        var aH = ak("#" + d + "_thumb_" + aE).addClass("jb-thm-thumb-selected").addClass("jb-thumb-visited").children("div").css({
            color: z.format_color(aa.navbuttoniconcolor)
        });
        ak("#" + d + "_thumb_" + aE + " .jb-idx-thb-frame").css({
            width: aG + "px",
            height: aI + "px",
            "border-width": aa.thumbselectedframewidth + "px",
            "border-color": y()
        });
        if (aa.thumbframecolor) {
            aH.children(".jb-idx-thb-frame").css({
                "border-color": z.format_color(aa.thumbframecolor)
            })
        }
    };
    var az = function() {
        return {
            height: aa.thumbheight - 2 * aa.thumbselectedframewidth,
            width: aa.thumbwidth - 2 * aa.thumbselectedframewidth,
            "border-width": aa.thumbselectedframewidth,
            "border-color": z.format_color(aa.thumbframecolor)
        }
    };
    var M = function(aL, aK) {
        F(" .jb-idx-thb-container").remove();
        var aP = F(".jb-idx-show-area");
        var aS = A();
        aP.css({
            top: aS.top,
            left: aS.left,
            width: aS.width,
            height: aS.height
        });
        if (F(".table_page_" + aL).length == 0) {
            aj(aL, aP, 0, v, e)
        }
        var aG = A().width + 2 * ac.get_stage_padding(F("").width(), F("").height(), aa);
        if (aa.enablelooping || aL < aB - 1) {
            var aR = (aL >= aB - 1) ? 0 : aL + 1;
            aj(aR, aP, +aG, v, ab)
        }
        if (aa.enablelooping || aL > 0) {
            var aN = (aL <= 0) ? aB - 1 : aL - 1;
            aj(aN, aP, -aG, v, W)
        }
        t(aL);
        q(l);
        var aM = F(" .jb-idx-thumb");
        if (!aa.forcetouchmode) {
            var aI = function(aT) {
                var aU = F(".jb-idx-thb-list div.jb-idx-thumb .jb-thm-thumb-image");
                aU.stop(true, true).show();
                if (!z.is_earlier_ie()) {
                    aU.css({
                        opacity: 1
                    })
                }
                ay(aT)
            };
            aM.click(function(aT) {
                F("").focus();
                if (a) {
                    return false
                }
                n = false;
                aT.preventDefault();
                aI(ak(this).attr("position"));
                return false
            });
            if (aa.usethumbdots) {
                var aH = z.format_color(aa.navbuttoniconcolor);
                var aF = (aa.navbuttonbackcolor ? z.format_color(aa.navbuttonbackcolor) : z.format_color(aa.thumbdotcolor));
                F(" .jb-idx-thumb .jb-thm-thumb-image").hover(function() {
                    ak(this).css({
                        color: aH
                    })
                }, function() {
                    if (ak(this).parent(".jb-thm-thumb-selected").length > 0) {
                        return
                    }
                    ak(this).css({
                        color: aF
                    })
                })
            }
            if (!B) {
                aM.mousedown(function(aT) {
                    if (aT.preventDefault) {
                        aT.preventDefault()
                    }
                    ak(this).children(".jb-idx-thb-frame").css(az())
                }).bind("touchstart", function() {
                    ak(this).children(".jb-idx-thb-frame").css(az())
                });
                ak(".jb-idx-thb-frame").mousedown(function(aT) {
                    if (aT.preventDefault) {
                        aT.preventDefault()
                    }
                    ak(this).css(az())
                })
            }
            if (aa.changeimageonhover) {
                aM.mouseenter(function() {
                    var aT = ak(this).attr("position");
                    aI(aT)
                }, null)
            }
        } else {
            ae()
        }
        if (aa.thumbframecolor) {
            var aQ = S - 2 * aa.thumbhoverframewidth;
            var aJ = ai - 2 * aa.thumbhoverframewidth;
            var aD = S - 2 * aa.thumbframewidth;
            var aO = ai - 2 * aa.thumbframewidth;
            var aE = z.is_large_screen_mode(aa);
            aM.hover(function() {
                var aT = ak(this);
                if (aT.is(".jb-thm-thumb-selected") && aE) {
                    return
                }
                aT.children(".jb-idx-thb-frame").css({
                    width: aQ,
                    height: aJ,
                    "border-color": z.format_color(aa.thumbframecolor),
                    "border-width": aa.thumbhoverframewidth
                })
            }, function() {
                var aT = ak(this);
                if (aT.is(".jb-thm-thumb-selected") && aE) {
                    return
                }
                aT.children(".jb-idx-thb-frame").css({
                    width: aD,
                    height: aO,
                    "border-color": aa.thumbframewidth ? z.format_color(aa.thumbframecolor) : "transparent",
                    "border-width": aa.thumbframewidth
                })
            })
        }
        F(".jb-classifier-thumb-area").disableSelection();
        aw = aL;
        if (typeof al == "function") {
            al(aK)
        }
    };
    var aC = function() {
        var aE = Q.length();
        if (P * E <= aE) {
            return {
                row: P,
                col: E
            }
        }
        if (E >= aE) {
            return {
                row: 1,
                col: aE
            }
        }
        var aD = (aE % E == 0 ? 0 : 1);
        return {
            row: parseInt(aE / E) + aD,
            col: E
        }
    };
    var t = function(aI) {
        var aH = A();
        var aF = aC();
        var aE = aF.row * (am);
        var aG = parseInt((v - aE) / 4);
        if (v <= aG || aG < 0) {
            aG = 0
        }
        var aD = parseInt((U - (aF.col * J)) / 2 + parseInt(r / 2));
        if (aD < 0) {
            aD = 0
        }
        F(".jb-idx-title").css({
            left: aD + "px",
            top: aG + "px"
        });
        F(".jb-idx-ssm-title-wrapper").css({
            width: aH.width
        });
        var aK = U / 2 - 20;
        if (aK < aD) {
            aK = aD
        }
        var aJ;
        if (z.is_large_screen_mode(aa)) {
            aJ = parseInt(aH.top + (z.is_side_layout(aa) ? aH.height : aE) + aa.thumbpadding);
            if (aa.usethumbdots && aa.showthumbpagingtext) {
                aJ += (z.is_side_layout(aa) ? 25 : -10)
            }
        } else {
            aJ = parseInt(aH.top + aE + aa.thumbpadding / 2 + (v - aE > 0 && aa.thumbnavposition.toUpperCase() != "BOTTOM" ? (v - aE) / 2 : 0))
        }
        if (aJ <= 0) {
            aJ = 0
        }
        F(".jb-idx-thb-list-page-number").css({
            left: aK + "px",
            top: aJ + "px"
        }).html((aI + 1) + " " + aa.languagelistall.pgnum + " " + aB);
        if (aa.textcolor) {
            F(".jb-idx-title, .jb-idx-thb-list-page-number").css({
                color: z.format_color(aa.textcolor)
            })
        }
        if (aa.textshadowcolor) {
            F(".jb-idx-title, .jb-idx-thb-list-page-number").css({
                "text-shadow": z.get_text_shadow_style(aa.textshadowcolor, aa.textshadowcolora, true)
            })
        }
    };
    var an = function(aD) {
        T();
        M(aD)
    };
    var O = function(aE) {
        if (!aE) {
            return
        }
        var aD = 1000 * aa.smallthumbslidetime;
        aD = aD * ((400 - aE / 2) / 400);
        q(l);
        F("table.jb-idx-thb-container").animate({
            left: "+=" + (-aE),
            avoidTransforms: !aa.use_webkit_transform,
            useTranslate3d: true
        }, aD, "", null)
    };
    var ad = function(aI, aG, aK, aJ, aD) {
        var aE = -1;
        if (aJ) {
            U = aJ
        }
        if (aD) {
            v = aD
        }
        var aL = function(aM) {
            a = false;
            if (aI) {
                if (aE === N()) {
                    K()
                }
            } else {
                if (aE === at()) {
                    u()
                }
            }
            aE = -1;
            if (typeof aK == "function") {
                aK()
            }
        };
        aE = aI ? N() : at();
        if (typeof(aG) == "undefined") {
            aG = 0
        }
        if (!a) {
            a = true;
            var aF = 1000 * aa.smallthumbslidetime;
            if (aG > 0) {
                aF = aF * ((400 - aG / 2) / 400)
            }
            var aH = A().width + 2 * ac.get_stage_padding(F("").width(), F("").height(), aa);
            F("table.jb-idx-thb-container").animate({
                left: (aI ? "-=" : "+=") + (aH - aG),
                avoidTransforms: !aa.use_webkit_transform,
                useTranslate3d: true
            }, aF, "easeOutQuart", aL)
        } else {
            F("table.jb-idx-thb-container").stop();
            aL(true)
        }
    };
    var g = function(aG, aF, aD, aE) {
        ad(true, aG, aF, aD, aE)
    };
    var af = function(aG, aF, aD, aE) {
        ad(false, aG, aF, aD, aE)
    };
    var i = function(aD, aE) {
        a = false
    };
    var au = function() {
        if (aw + 1 >= aB) {
            return true
        }
        return false
    };
    var m = function() {
        if (aw <= 0) {
            return true
        }
        return false
    };
    var D = function() {
        return aw
    };
    var R = function(aD) {
        if (aD) {
            F(".jb-idx-title").show();
            F(".jb-classifier-link-wrapper.jb-classifier-thumb-area").show()
        } else {
            F(".jb-idx-title").hide();
            F(".jb-classifier-link-wrapper.jb-classifier-thumb-area").hide()
        }
    };
    var b = function() {
        var aD = P * am;
        if (aD < z.get_nav_btn_size(aa)) {
            aD = z.get_nav_btn_size(aa)
        }
        return aD
    };
    var X = function(aD) {
        a = true;
        window.setTimeout(function() {
            a = false
        }, aD)
    };
    return {
        initialize: V,
        show_current_page: I,
        show_prev_page: u,
        show_next_page: K,
        move_to_next_page: g,
        move_to_prev_page: af,
        show_page_4_image_position: ag,
        show_page_by_page_index: ah,
        is_last_page: au,
        is_first_page: m,
        get_index: D,
        repaint: i,
        get_thumblist_size: p,
        display_gallery_top: R,
        get_image_index_range: av,
        set_thumbnail_visited: q,
        get_thumb_height: b,
        yield_4_transition: X,
        synchronize_config: k,
        get_show_area_position: A
    }
};
var juicebox_gallery_detail_panel = function(g) {
    var Q, af, F, U, am, b, ac, d, D, x, B;
    var Z, O;
    var ae;
    var e = g;
    var J;
    var s = null;
    var m = -1;
    var q = 0;
    var k, ad;
    var j;
    var H = false;
    var P = false;
    var c = 12;
    var aa = 18;
    var ag = function(aq) {
        P = true;
        Q = aq.jquery;
        af = aq.document_id;
        F = aq.container;
        ae = aq.caption_container;
        am = aq.config;
        b = aq.utils;
        ac = aq.sizing;
        U = aq.glymng;
        d = aq.before_draw_event_callback;
        D = aq.finish_draw_event_callback;
        x = aq.touch_event_callback;
        B = aq.caption_complete_callback;
        j = 1000 * am.imagetransitiontime;
        if (j <= 0) {
            j = 10
        }
        Z = aq.onHidingImage;
        O = aq.onShowingImage;
        k = aq.current_width;
        ad = aq.current_height;
        C(0);
        J = aq.debug
    };
    var ap = function(aq) {
        return Q(b.get_query_path(af, aq))
    };
    var S = function() {
        if (!s) {
            return 0
        }
        return s.position
    };
    var K = function() {
        return s
    };
    var C = function(aq) {
        s = U.get_image(aq)
    };
    var an = function(av, at) {
        if (!av) {
            av = am.captionposition.toUpperCase()
        }
        if (av === "BOTTOM" || av === "NONE" || av === "BELOW_IMAGE") {
            return
        }
        if (typeof(B) != "function") {
            return
        }
        var ax = ap(".caption_" + at + " a");
        var aq = ap(".caption_" + at + " .jb-caption").height();
        if (ax.length > 0 && aq === 0) {
            aq = 50
        }
        aq = (aq && ax.length > 0 ? aq + 2 * c : 0);
        if (av != "OVERLAY_IMAGE") {
            B(ad - aq)
        } else {
            var ar = U.get_image(at);
            if (!ar.loaded) {
                return
            }
            var aw = ac.get_image_display_size(ar, k, ad, am);
            var au = (aw.top + aw.height + ac.get_image_framewidth(k, ad, am));
            if (au > ad) {
                au = ad - ac.get_image_framewidth(k, ad, am) - am.imagepadding
            }
            B(au - aq)
        }
    };
    var N = function(aA, aC, av, au, at) {
        var aE = m > -1 ? m : s.position;
        var aB = -1;
        if (typeof(au) != "undefined") {
            aB = au
        } else {
            if (aA && U.get_next_image(aE)) {
                aB = U.get_next_image(aE).position
            } else {
                if (!aA && U.get_previous_image(aE)) {
                    aB = U.get_previous_image(aE).position
                }
            }
        }
        if (aB < 0) {
            return
        }
        var az;
        var aI = am.captionposition.toUpperCase();
        if (typeof(av) === "undefined") {
            av = true
        }
        if (aI === "NONE" || (",BOTTOM,BELOW_IMAGE,OVERLAY_IMAGE,BELOW_THUMBS,".indexOf("," + aI + ",") < 0 && am.showimageoverlay.toUpperCase() === "NEVER")) {
            av = false
        }
        var aw = 0;
        var aG = function(aK) {
            if (aI === "NONE") {
                return
            }
            if (am.showimageoverlay.toUpperCase() === "NEVER" && aI != "BOTTOM" && aI != "BELOW_THUMBS") {
                return
            }
            if (!am.slidecaption && (av || aI === "BOTTOM" || aI === "BELOW_IMAGE")) {
                ap(".jb-cap-frame.jb-status-fading").fadeIn(aK);
                if (Q.browser.msie && Q.browser.version >= 10) {
                    ae.css({
                        opacity: 0
                    })
                }
                ae.fadeIn(aK);
                if (aI != "BOTTOM" && aI != "BELOW_IMAGE" && aI != "OVERLAY_IMAGE" && aI != "NONE") {
                    if (aw) {
                        window.clearTimeout(aw)
                    }
                    aw = window.setTimeout(function() {
                        aw = 0;
                        an(aI, aB)
                    }, aK + 50)
                }
            }
        };
        var ay = function(aM) {
            var aL = am.captionposition.toUpperCase();
            if (av) {
                var aK = aM;
                var aL = am.captionposition.toUpperCase();
                if (Q.browser.msie && Q.browser.version >= 7 && Q.browser.version < 8) {
                    aK = 0
                } else {
                    if (aL === "OVERLAY_IMAGE") {
                        aK = 0
                    }
                }
                if (!aK) {
                    ar.addClass("jb-status-fading").hide()
                } else {
                    ar.addClass("jb-status-fading").fadeOut(aK)
                }
            } else {
                ar.removeClass("jb-status-fading")
            }
        };
        var aH = function(aK) {
            d(aB);
            A(aB, aK, null, av, true);
            if (ap(".jb-dt-main-image-" + aB).css("opacity") == 0.01) {
                ap(".jb-dt-main-image-" + aB).css("opacity", 1)
            }
            D(aB);
            aG(aK);
            m = -1
        };
        var ax = function(aL, aM) {
            var aK = m > -1 ? m : aB;
            if (!at) {
                d(aK)
            }
            A(aK, 0, null, av, true);
            if (!at && !aM) {
                D(aK)
            }
            aG(aL);
            m = -1
        };
        if (m > -1) {
            az = ap(" .jb-panel-detail .jb-dt-main-frame, .jb-cap-frame");
            az.stop(false, false);
            ap(".jb-cap-frame.caption_" + aB).stop(false, false);
            ap(".jb-dt-main-image-" + aE).stop(false, false);
            if (q) {
                window.clearTimeout(q);
                q = 0
            }
            ax(0, true)
        }
        var aF = am.imagetransitiontype.toUpperCase();
        if (typeof(aC) == "undefined") {
            aC = 0
        }
        m = aB;
        var aJ = 1000 * am.imagetransitiontime;
        if (aC > 0) {
            aJ = aJ * ((400 - aC / 2) / 400)
        }
        var aD = parseInt(k) + parseInt(am.minimagegap) + (2 * ac.get_stage_padding(ap("").width(), ap("").height(), am));
        d(aB);
        var ar = ap(".jb-cap-frame.caption_" + aE);
        az = ap(" .jb-panel-detail .jb-dt-main-frame");
        az.stop();
        if (q) {
            window.clearTimeout(q);
            q = 0
        }
        if (b.is_swipable_device() && au == null) {
            az.animate({
                left: (aA ? "-=" : "+=") + (aD - aC),
                avoidTransforms: !am.use_webkit_transform,
                useTranslate3d: true
            }, aJ, "easeOutQuart", function() {
                ax(aJ / 2)
            });
            ay(aJ / 2)
        } else {
            if (aF === "NONE" || at) {
                ar.fadeOut(0);
                ax(0)
            } else {
                if (aF === "CROSS_FADE") {
                    var aq = ap(".jcbx-glry-classic").css("background-color");
                    az = ap(".jb-dt-main-image-" + aE).css({
                        "background-color": aq
                    });
                    s = U.get_image(aB);
                    if (s.loaded) {
                        F.append(ao(s, 0, true, false, 1));
                        ae.append(l(s, ae.width(), ae.height(), 0, false, 500));
                        az.fadeOut(aJ, function() {});
                        q = window.setTimeout(function() {
                            var aK = m > -1 ? m : aB;
                            A(aK, 0, null, av, true);
                            D(aK);
                            if (aI === "BELOW_IMAGE" || aI === "OVERLAY_IMAGE" || aI === "BOTTOM" || aI === "BELOW_THUMBS") {
                                ap(".jb-cap-frame.jb-status-fading").fadeIn(0);
                                ae.fadeIn(0)
                            }
                            q = 0
                        }, aJ + 100);
                        ay(aJ)
                    } else {
                        ax(0)
                    }
                } else {
                    if (aF === "FADE" || (au && aF != "FADE" && aF != "CROSS_FADE" && aF != "NONE")) {
                        if (az.length > 0) {
                            if (Q.browser.opera && parseFloat(Q.browser.version) >= 12) {
                                az.fadeOut(aJ / 2);
                                q = window.setTimeout(function() {
                                    ar.stop();
                                    q = 0;
                                    aH(aJ / 2)
                                }, aJ / 2 + 100)
                            } else {
                                az.fadeOut(aJ / 2, function() {
                                    ar.stop();
                                    aH(aJ / 2)
                                })
                            }
                        } else {
                            if (au) {
                                q = window.setTimeout(function() {
                                    ar.stop();
                                    q = 0;
                                    aH(aJ / 2)
                                }, aJ / 2)
                            }
                        }
                        ay(aJ / 2)
                    } else {
                        az.animate({
                            left: (aA ? "-=" : "+=") + (aD - aC),
                            avoidTransforms: !am.use_webkit_transform,
                            useTranslate3d: true
                        }, aJ, "easeOutQuart", function() {
                            ax(aJ / 2)
                        });
                        ay(aJ / 2)
                    }
                }
            }
        }
        if (typeof(Z) === "function" && aF != "NONE" && aJ > 0) {
            Z(aJ / 2)
        }
    };
    var p = function(ar, aq) {
        N(true, ar, aq)
    };
    var i = function(au) {
        if (!au) {
            return
        }
        var ar = 1000 * am.imagetransitiontime;
        ar = ar * ((400 - au / 2) / 400);
        var aq = parseInt(k) + parseInt(am.minimagegap);
        var at;
        at = ap(" .jb-panel-detail .jb-dt-main-frame");
        at.stop();
        at.animate({
            left: "+=" + (-au),
            avoidTransforms: !am.use_webkit_transform,
            useTranslate3d: true
        }, ar, "", null)
    };
    var w = function(ar, aq) {
        N(false, ar, aq)
    };
    var A = function(aB, aA, ay, au, aG) {
        if (typeof(au) === "undefined") {
            au = true
        }
        var av = parseInt(k) + parseInt(am.minimagegap) + (2 * ac.get_stage_padding(ap("").width(), ap("").height(), am));
        s = U.get_image(aB);
        m = -1;
        var aE = ap(".jb-panel-detail");
        if (aE.length > 0 && !aE.is(":visible")) {
            aE.show()
        }
        var az = U.get_image(aB);
        var aq = U.get_previous_image(aB);
        var aw = U.get_next_image(aB);
        var aC = aA > 0;
        var at = am.imagetransitiontype.toUpperCase();
        if (at != "FADE" && at != "CROSS_FADE" && at != "NONE" && U.length() > 2) {
            F.children(":not(.jb-dt-main-image-" + aB + ")").remove()
        } else {
            F.children().remove()
        }
        var ax = F.children(".jb-dt-main-image-" + aB);
        if (ax.length <= 0) {
            F.append(ao(az, 0, true, aC));
            ax = F.children(".jb-dt-main-image-" + (az ? az.position : ""))
        } else {
            ax.css({
                left: 0
            })
        }
        if (az.loaded && typeof(O) === "function" && (am.imagenavposition.toUpperCase() === "IMAGE" || am.buttonbarposition.toUpperCase() === "OVERLAY_IMAGE")) {
            var aD = ac.get_image_display_size(az, k, ad, am);
            O(aD, j / 2)
        }
        if (aq) {
            ax.before(ao(aq, -av, false, false))
        }
        if (aw) {
            ax.after(ao(aw, av, false, false))
        }
        if (!ax.is(":visible")) {
            if (!Q.browser.msie || Q.browser.version >= 10) {
                ax.show().css({
                    opacity: 0.01
                })
            }
            ax.fadeIn(aA)
        } else {
            if (aA) {
                if (ax.css("opacity") < 1) {
                    if (!Q.browser.msie || Q.browser.version >= 10) {
                        ax.show().css({
                            opacity: 0.01
                        })
                    }
                    ax.fadeIn(aA)
                }
            } else {
                ax.css({
                    opacity: 1
                })
            }
        }
        var ar = ae.width();
        var aF = ae.height();
        if (au === true) {
            if (aC || aG) {
                if (Q.browser.msie || b.is_firefox3()) {
                    ae.hide()
                } else {
                    ae.fadeOut(0)
                }
            } else {
                if (s.loaded) {
                    ae.fadeIn(0)
                }
            }
        } else {
            ae.hide()
        }
        I(az);
        var aH = ar + parseInt(am.minimagegap) + ac.get_side_panel_width(am);
        ae.html(l(aq, ar, aF, -aH, au) + l(az, ar, aF, 0, au) + l(aw, ar, aF, aH, au));
        an("", az.position);
        if (am.textcolor) {
            ap(".jb-cap-frame a").css({
                color: b.format_color(am.textcolor)
            })
        }
        if (am.textshadowcolor) {
            ap(".jb-cap-frame a").css({
                "text-shadow": b.get_text_shadow_style(am.textshadowcolor, am.textshadowcolora, true)
            })
        }
        if (am.captionbackcolor) {
            ap(".jb-caption").css({
                "background-color": b.format_color(am.captionbackcolor)
            })
        }
        if (aA > 0 && typeof(ay) === "function") {
            if (Q.browser.msie && Q.browser.version >= 10) {
                ap(".jb-dt-main-image-" + az.position).css({
                    opacity: 0
                })
            }
            ap(".jb-dt-main-image-" + az.position).fadeIn(aA);
            if (au) {
                ae.fadeIn(aA)
            }
            window.setTimeout(function() {
                ay()
            }, aA)
        }
    };
    var E = function(ar, aq) {
        if (!ar) {
            ap(".jb-dt-main-image-" + s.position).hide();
            return
        }
        ap(".jb-dt-main-image-" + s.position).fadeOut(ar);
        ae.fadeOut(ar);
        if (typeof(aq) === "function") {
            window.setTimeout(function() {
                aq()
            }, ar)
        }
    };
    var a = function(aq) {
        if (aq >= U.length()) {
            aq = U.length() - 1
        }
        if (aq < 0) {
            return 0
        }
        return aq
    };
    var W = function(ar, au) {
        var aq = U.get_range(a(ar), a(au));
        for (var at = 0; at < aq.length; at++) {
            Y(aq[at])
        }
    };
    var I = function(au) {
        if (!au.loaded) {
            return
        }
        var ar = am.captionposition.toUpperCase();
        if (ar !== "OVERLAY_IMAGE") {
            if (ar === "BELOW_THUMBS") {
                return
            }
            if (ar === "BELOW_IMAGE") {
                ae.css({
                    overflow: "visible"
                })
            }
            return
        }
        var at = ac.get_image_display_size(au, k, ad, am);
        var av = at.top + at.frameHeight - am.maxcaptionheight + am.framewidth;
        if (av < 0) {
            av = 0
        }
        var aw = parseInt(F.css("top"));
        av += aw;
        var aq = parseInt(ap("").height()) - aw - at.top - at.frameHeight - am.framewidth;
        ae.css({
            top: av,
            bottom: aq,
            overflow: "hidden"
        })
    };
    var X = function(ar, aq) {
        if (!ar) {
            ar = am.captionposition.toUpperCase()
        }
        if (ar != "BELOW_THUMBS" || !b.is_side_layout(am)) {
            return aa
        }
        var au = e.get_show_area_position();
        var at = au.left + am.thumbpadding - (aq ? 72 : 0);
        if (at < aa) {
            at = aa
        }
        return at
    };
    var ak = function(aw) {
        var au = ap(".caption_" + aw.position + " .jb-caption").height(),
            aq;
        var at = am.captionposition.toUpperCase();
        var ar = 140;
        if (at != "OVERLAY_IMAGE") {
            aq = ar
        } else {
            if (aw.loaded) {
                if (!ah(aw)) {
                    aq = 0;
                    au = 0
                } else {
                    var av = ac.get_image_display_size(aw, k, ad, am);
                    aq = av.width;
                    au = av.height
                }
            } else {
                return null
            }
        }
        if (aq < 100 || au < ap(".caption_" + aw.position + " .jb-caption").height()) {
            return {
                display: "none"
            }
        } else {
            if (aq < ar) {
                return {
                    display: "block",
                    padding: "0"
                }
            } else {
                return {
                    display: ah(aw) ? "block" : "none",
                    "padding-top": c + "px",
                    "padding-right": X(at, true) + "px",
                    "padding-left": X(at) + "px",
                    "padding-bottom": (h() ? c : (c + 18)) + "px"
                }
            }
        }
    };
    var M = function(au) {
        var at = ak(au);
        if (!at) {
            return ""
        }
        var aq = "";
        for (var ar in at) {
            if (!ar) {
                continue
            }
            aq += ar + ":" + at[ar] + ";"
        }
        return aq
    };
    var t = function(aw, ar) {
        if (!aw) {
            return
        }
        var at = am.captionposition.toUpperCase();
        if (at !== "BELOW_IMAGE" && at !== "OVERLAY_IMAGE") {
            return
        }
        var au = parseInt(ae.width()) + parseInt(am.minimagegap) + ac.get_side_panel_width(am);
        var av = (aw.position - s.position) * au;
        var aq = ak(aw);
        if (aq) {
            ap(".caption_" + aw.position + " .jb-caption").css(aq)
        }
        ap(".jb-cap-frame.caption_" + aw.position).attr("style", T(aw, ae.width(), ae.height(), av, ar))
    };
    var o = function() {
        var aq = am.captionposition.toUpperCase();
        return (aq != "BELOW_IMAGE" && aq != "BOTTOM") ? false : true
    };
    var T = function(at, aB, aw, ar, az) {
        var au = o();
        var aC = "position:absolute;";
        var aD, av;
        var ay = am.captionposition.toUpperCase();
        var aq = am.imagetransitiontype.toUpperCase();
        if (aq === "CROSS_FADE" && !az && at.loaded) {
            aC += (Q.browser.msie || b.is_firefox3()) ? "display:none;" : "opacity:0;"
        }
        if (ay === "BELOW_IMAGE" || ay === "OVERLAY_IMAGE") {
            if (!at.loaded) {
                aD = (ay === "OVERLAY_IMAGE") ? "" : "top:" + (aw - am.maxcaptionheight > 0 ? aw - am.maxcaptionheight : 0) + "px;";
                return aC + (au ? "height:100%;" : "") + "width:100%;left:" + ar + "px;display:none;" + aD
            }
        } else {
            if ((ay !== "OVERLAY_IMAGE" && !au) || !at.loaded || ay === "BOTTOM") {
                return aC + (au ? "height:100%;" : "") + "width:" + aB + "px;left:" + ar + "px;"
            }
        }
        var aA = ac.get_image_display_size(at, k, ad, am);
        var ax = ac.get_image_framewidth(k, ad, am);
        if (ay === "OVERLAY_IMAGE") {
            aD = am.imagecornerradius > 0 ? r(am) : "";
            av = "width:" + (aA.frameWidth) + "px;";
            ar += ax
        } else {
            aD = "top:" + (aA.top + aA.frameHeight + 2 * ax + ac.get_image_padding(k, ad, am)) + "px;";
            av = "width:" + (aA.frameWidth + 2 * ax) + "px;"
        }
        return aC + av + "height:100%;padding:0;margin:0;left:" + (aA.left + ar) + "px;" + aD
    };
    var al = 0;
    var ab = function(at, ar, aq) {
        if (!at.loaded) {
            return
        }
        I(at);
        t(at, aq);
        if (!aq) {
            if (Q.browser.msie) {
                ap(".jb-cap-frame.caption_" + at.position).fadeIn(ar)
            } else {
                ap(".jb-cap-frame.caption_" + at.position).animate({
                    opacity: 1
                }, ar)
            }
            if (al) {
                window.clearTimeout(al);
                al = 0
            }
            al = window.setTimeout(function() {
                al = 0;
                an("", at.position)
            }, ar)
        } else {
            if (Q.browser.msie && Q.browser.version >= 10 && ae.is(":visible")) {
                ae.css({
                    opacity: 1
                })
            }
        }
    };
    var Y = function(ar, at) {
        if (ar.isPreloading || ar.loaded) {
            return
        }
        var aq = new Image();
        ar.isPreloading = true;
        aq.onload = function() {
            ar.loaded = true;
            ar.width = aq.width;
            ar.height = aq.height;
            U.update_image(ar);
            var av = ap(".jb-panel-detail .jb-dt-main-image-" + ar.position);
            if (av.length > 0) {
                var au = function() {
                    av.html(y(ar, at, s.position === ar.position));
                    var aw = ap(".jb-panel-detail .jb-dt-main-image-" + ar.position + " img");
                    aw.disableSelection();
                    if (s.position === ar.position) {
                        aw.fadeIn(j, function() {
                            if (aw.css("opacity") < 0.5) {
                                aw.css("opacity", 1)
                            }
                        });
                        if (Q.browser.msie && Q.browser.version >= 10) {
                            window.setTimeout(function() {
                                ab(ar, j, true)
                            }, j / 2)
                        } else {
                            ab(ar, j)
                        }
                    }
                };
                if (b.is_swipable_device()) {
                    window.setTimeout(au, 100)
                } else {
                    au()
                }
            }
        };
        aq.src = ar.imageURL
    };
    var ao = function(at, ar, aq, av, az) {
        if (!at) {
            return ""
        }
        var ay = "";
        var au = am.imagetransitiontype.toUpperCase();
        if (ar === 0 && (au === "CROSS_FADE" || au === "FADE")) {
            if (!az) {
                az = 2
            }
            ay = "z-index:" + az + ";"
        }
        var aA = am.showpreloader ? "<div class='jb-status-loading' style='position:absolute;top:0;left:0;width:" + k + "px;height:" + ad + "px;padding:0;margin:0;" + ay + "'></div>" : "";
        var ax;
        if (at.loaded) {
            aA = y(at, aq)
        } else {
            Y(at, aq)
        }
        var aw = R(k, ad, ac.suggested_image_size(at, k, ad, am, am.imagescalemode.toUpperCase()));
        return "<div class='jb-dt-main-frame jb-dt-main-image-" + at.position + "' style='height:" + ad + "px;width:" + k + "px;left:" + ar + "px;" + aj(av) + ay + "'>" + aA + "</div>"
    };
    var aj = function(aq) {
        if (!aq) {
            return ""
        }
        if (Q.browser.msie || b.is_firefox3()) {
            return "display:none;"
        }
        return "opacity:0;"
    };
    var ah = function(ar) {
        if (!ar) {
            return ""
        }
        var az, aw, ax = "";
        if (am.useflickr) {
            az = am.flickrshowtitle ? ar.caption : "";
            aw = (am.flickrshowdescription && ar.description) ? ar.description : "";
            ax = am.flickrshowpagelink ? '<p class="jb-cap-content jb-caption-link"><a href="' + ar.imageFullURL + '" target="_blank"  style="' + v() + ai() + ';">' + (am.flickrpagelinktext ? am.flickrpagelinktext : ar.caption) + "</a>&nbsp</p>" : ""
        } else {
            az = ar.title ? ar.title : "";
            aw = ar.caption ? ar.caption : ""
        }
        var aq = am.captionhalign.toUpperCase();
        var at = "";
        if (aq === "CENTER") {
            at = "text-align:center;"
        } else {
            if (aq === "RIGHT") {
                at = "text-align:right;"
            }
        }
        var ay = Q.trim(az) ? '<p class="jb-cap-content jb-caption-title" style="' + at + '">' + az + "&nbsp</p>" : "";
        var au = Q.trim(aw) ? '<p class="jb-caption-desc" style="' + at + (am.showimagenumber ? "" : "margin-right:0;") + (az ? "margin-top:10px;" : "margin-top:0;") + '">' + aw + "</p>" : "";
        var av = am.showimagenumber ? "<div class='jbac-number jb-classifier-layer' layer='2000' style='z-index:2000;" + ((b.ship || !H) ? "" : "padding-bottom:20px;") + v() + ai() + "'>" + (ar.position + 1) + " / " + U.length() + "</div>" : "";
        return av + ay + au + ax
    };
    var h = function() {
        return (b.ship || !H)
    };
    var ai = function() {
        if (!am.textshadowcolor) {
            return ""
        }
        return "text-shadow:" + b.get_text_shadow_style(am.textshadowcolor, am.textshadowcolora, true)
    };
    var v = function() {
        if (!am.textcolor) {
            return ""
        }
        return "color:" + b.format_color(am.textcolor) + ";"
    };
    var l = function(at, av, au, ar, aq, aA) {
        if (!at) {
            return ""
        }
        if (!aA) {
            aA = 1000
        }
        var aw = ah(at);
        var ay = am.maxcaptionheight - (2 * c);
        if (!h()) {
            ay -= 18
        }
        if (ay <= 0) {
            ay = am.maxcaptionheight > au ? au : am.maxcaptionheight
        }
        var az = "<div layer='1000' class='jb-caption jb-classifier-layer' style='overflow:hidden;z-index:" + aA + ";" + M(at) + (am.captionposition.toUpperCase() === "OVERLAY_IMAGE" ? r(am) : "") + "max-height:" + ay + "px;" + (aw ? "" : "display:none;") + v() + ai() + "'>" + aw + "</div>";
        var ax = " class='jb-cap-frame caption_" + at.position + "' style='" + (aw ? T(at, av, au, ar, aq) : "display:none;") + "'";
        if (o()) {
            return "<div" + ax + ">" + az + "</div>"
        } else {
            return "<table" + ax + "><tr><td>" + az + "</td></tr></table>"
        }
    };
    var f = function(ar) {
        if (b.ship) {
            return
        }
        H = ar;
        var aq = am.maxcaptionheight - (2 * c);
        if (!h()) {
            aq -= 18
        }
        if (aq <= 0) {
            aq = am.maxcaptionheight > ae.height() ? ae.height() : am.maxcaptionheight
        }
        var au = ar ? c + 18 : c;
        var at = ar ? "20px" : "";
        ap(".jb-cap-frame .jb-caption").css({
            "padding-bottom": au,
            "max-height": aq
        });
        ap(".jb-cap-frame .jbac-number").css({
            "padding-bottom": at
        })
    };
    var z = function(at) {
        var aq = ap(".caption_" + at.position + " .jb-caption");
        var ar = ah(at);
        if (ar) {
            aq.css({
                display: ""
            })
        } else {
            aq.hide()
        }
        aq.html(ar)
    };
    var V = function(aq) {
        if (b.is_earlier_ie()) {
            return ""
        }
        if (b.is_small_android() || b.is_iphone()) {
            return "-webkit-box-shadow: 0px 0px " + aq.imageshadowblur + "px " + b.format_color(aq.imageshadowcolora) + ";"
        }
        return "box-shadow: 0px 0px " + aq.imageshadowblur + "px " + aq.imageshadowcolor + ";"
    };
    var L = function(aq, at) {
        if (b.is_earlier_ie()) {
            return ""
        }
        var ar = aq.imagecornerradius;
        if (at) {
            ar = G(aq)
        }
        return ar > 0 ? "border-radius:" + ar + "px;" : ""
    };
    var G = function(ar) {
        var aq = ar.imagecornerradius;
        if (ar.framewidth && ar.imagecornerradius) {
            aq = ar.imagecornerradius - ar.framewidth
        }
        if (aq < 0) {
            aq = 0
        }
        return aq
    };
    var r = function(aq) {
        if (b.is_earlier_ie()) {
            return ""
        }
        return aq.imagecornerradius > 0 ? "border-bottom-left-radius:" + G(aq) + "px;border-bottom-right-radius:" + G(aq) + "px;" : ""
    };
    var y = function(at, ar, aB) {
        if (!at) {
            return ""
        }
        var aw = ac.get_image_display_size(at, k, ad, am);
        var aq = ac.suggested_image_size(at, k, ad, am, am.imagescalemode.toUpperCase());
        var aA = "";
        var ay = false;
        var ax = 0;
        var az = 0;
        if (aq.height === "auto" && aw.frameHeight < aw.height) {
            ax = "-" + parseInt((aw.height - aw.frameHeight) / 2) + "px";
            ay = true
        }
        if (aq.width === "auto" && aw.frameWidth < aw.width) {
            az = "-" + parseInt((aw.width - aw.frameWidth) / 2) + "px";
            ay = true
        }
        if (b.is_adobe_air() && am.imagescalemode.toUpperCase() === "FILL") {
            aq.height = aq.expectedHeight + "px";
            aq.width = aq.expectedWidth + "px"
        }
        var av = "<div class='jb-dt-main-image' style='position:absolute;top:" + aw.top + "px;left:" + aw.left + "px;height:" + aw.frameHeight + "px;width:" + aw.frameWidth + "px;padding:0;overflow:hidden;border:none;" + (am.imageframecolor ? "border-color:" + b.format_color(am.imageframecolor) + ";" : "") + V(am) + L(am) + "'><img style='${0}$height:" + aq.height + ";width:" + aq.width + ";" + aA + aj(aB) + L(am, true) + "'  src='" + at.imageURL + "'></div>";
        var au = ac.get_image_framewidth(k, ad, am);
        if (au) {
            av = av.replace("border:none;", "border-style:solid;border-width:" + au + "px;")
        }
        if (at.position === s.position && typeof(O) === "function") {
            O(aw, j / 2)
        }
        if (ay) {
            return av.replace("${0}$", "display:inline;position:relative;top:" + ax + ";left:" + az + ";")
        }
        return av.replace("${0}$", "")
    };
    var R = function(aw, ax, au) {
        var ar = parseInt(au.width);
        var av = parseInt(au.height);
        var aq = !ar || aw > ar ? "auto" : aw + "px";
        var at = !av || ax > av ? "auto" : ax + "px";
        return {
            width: aq,
            height: at
        }
    };
    var n = function(at, au, az, ar) {
        if (!at) {
            return
        }
        var ay = ",BELOW_THUMBS,";
        var ax = ",BOTTOM,BELOW_IMAGE,OVERLAY_IMAGE" + ay;
        var av = "," + am.captionposition.toUpperCase() + ",";
        F.children().remove();
        var aw = ae.is(":visible") || ay.indexOf(av) > -1;
        var aq = am.showimageoverlay.toUpperCase();
        if (aq === "NEVER") {
            if (ax.indexOf(av) < 0) {
                aw = false
            }
        }
        A(at.position, 0, null, aw);
        return
    };
    var u = function(aq, ar) {
        k = aq;
        ad = ar;
        ap(".jb-dt-main-frame").css({
            width: aq,
            height: ar
        });
        n(s, aq, ar, 0);
        ab(s, 0, true);
        var at = U.get_previous_image(s.position);
        at = U.get_next_image(s.position)
    };
    return {
        get_photo_position: S,
        move_2_next_photo: p,
        move_2_previous_photo: w,
        initialize: ag,
        populate_photo_html: A,
        repaint: u,
        get_current_photo: K,
        preload_images: W,
        fadeout_current_image: E,
        repopulate_caption_html: z,
        move_back: i,
        set_caption_height_mode: f,
        is_initialized: function() {
            return P
        },
        change_2_photo: N
    }
};
var juicebox_utils = new juice_box_utils(juicebox_lib.jQuery);
var juicebox_instances = [];
var juicebox_instance_count = 0;
var juicebox = function(_config) {
    var $ = juicebox_lib.jQuery;
    var utils = juicebox_utils;
    var gallery_manager = new juicebox_gallery_manager();
    var index_panel = new juicebox_gallery_index_panel(utils);
    var detail_panel = new juicebox_gallery_detail_panel(index_panel);
    var config_manager = new juicebox_config_manager($, utils);
    var flickr_loader = null;
    var dialog = null;
    var sizing = null;
    var switching_2_thumbnail = false;
    var overlay_visible = true;
    var in_the_transitioning = false;
    var is_index_visible = true;
    var is_detail_visible = false;
    var is_switching_image = false;
    var hide_thumbnails_in_lsm = false;
    var transTimer = 0;
    var audioPlayer;
    var instance_id;
    var document_id = (new Date()).valueOf();
    config_manager.init(_config, null, "ck-s-");
    var config = config_manager.get_config();
    var backgroundImageWidth = 0;
    var backgroundImageHeight = 0;
    var backgroundUrl = "";
    gallery_manager.init(config);
    var image_change_speed = 1000 * config.imagetransitiontime;
    var theme_cls = "jcbx-glry-classic";
    var themeUrl = "";
    var current_width = null;
    var current_height = null;
    var is_full_screen_mode = false;
    var start_x;
    var last_x;
    var delta_x;
    var start_y;
    var last_y;
    var delta_y;
    var in_navigation = false;
    var right_button_offset = null;
    var current_page = null;
    var total_page_count = null;
    var image_showed = false;
    var fullScreenPersistor = {
        parent_gallery_param: _config.persistor_param,
        is_full_screen: ((_config.fullscreen_displaying_mode) ? true : false),
        parent_gallery: _config.parent_gallery,
        initial_body_css_inline_style: (_config.initial_body_css_inline_style ? _config.initial_body_css_inline_style : ""),
        scroll_position: (_config.scroll_position ? _config.scroll_position : {}),
        initial_height: 0,
        initial_width: 0
    };
    var parent_gallery = fullScreenPersistor.is_full_screen ? fullScreenPersistor.parent_gallery : null;
    var extended_gallery = null;
    var correct_path = function(path) {
        if (!path) {
            return ""
        }
        return utils.concate_path(config.baseurl, path)
    };
    var _ = function(path) {
        return $(utils.get_query_path(document_id, path))
    };
    var need_top_panel = function() {
        if (!utils.is_large_screen_mode(config)) {
            return false
        }
        var bbpos = config.backbuttonposition.toUpperCase();
        if (config.gallerytitleposition.toUpperCase() === "TOP" || config.buttonbarposition.toUpperCase() === "TOP" || bbpos === "TOP") {
            return true
        }
        return false
    };
    var is_caption_overlap = function() {
        var cappos = config.captionposition.toUpperCase();
        if (cappos != "BOTTOM" && cappos != "BELOW_IMAGE" && cappos != "NONE" && cappos != "BELOW_THUMBS") {
            return true
        }
        if (cappos === "NONE") {
            return false
        }
        if (!(is_index_visible && is_detail_visible)) {
            return true
        }
        return false
    };
    var setup_layout = function(glry_width, glry_height, show_detail) {
        if (utils.is_large_screen_mode(config)) {
            if (hide_thumbnails_in_lsm) {
                is_index_visible = false
            } else {
                is_index_visible = true
            }
            is_detail_visible = true;
            _("").addClass("jb-flag-large-screen-mode")
        } else {
            if (show_detail) {
                is_index_visible = false;
                is_detail_visible = true
            } else {
                is_index_visible = true;
                is_detail_visible = false
            }
            _("").removeClass("jb-flag-large-screen-mode")
        }
    };
    var need_full_screen_button = function() {
        if (!utils.is_in_iframe() && config.usefullscreenexpand && utils.exit_support_real_fullscreen()) {
            return true
        }
        if (!utils.is_in_iframe() && (fullScreenPersistor.is_full_screen || utils.is_new_expanded_window())) {
            return true
        }
        if (config.showexpandbutton && (!is_full_screen_mode) && (!utils.is_in_iframe())) {
            return true
        }
        return false
    };
    var show_audio_button = function() {
        if (!config.showaudiobutton || utils.is_earlier_ie()) {
            return false
        }
        return true
    };
    var get_button_width = function() {
        var btncnt = apply_show_options(true);
        var btnszinfo = utils.get_button_bar_button_size(config);
        return btnszinfo.buttonWidth * btncnt.detailButtonCount + btnszinfo.padding + (4 * btncnt.separatorCount)
    };
    var apply_show_options = function(countonly, panelVisibilityOverwritten) {
        var show_thumb_button_bar = false;
        var show_detail_button_bar = false;
        var detailButtonCount = 0;
        var indexButtonCount = 0;
        var gp1v = false;
        var gp2v = false;
        var gp3v = false;
        var gp4v = false;
        if (!config.showsmallthumbsbutton || !config.showthumbsbutton || (!utils.is_large_screen_mode(config) && is_index_visible)) {
            _(".jb-bb-btn-de-show-list").hide()
        } else {
            show_detail_button_bar = true;
            gp1v = true;
            detailButtonCount++
        }
        if (!config.showcaption) {
            _(".jb-caption").hide()
        }
        if (!config.showsmallthumbsbutton || (!config.showthumbsbutton && utils.is_large_screen_mode(config))) {
            _(".jb-bb-btn-de-show-list").hide()
        } else {
            show_detail_button_bar = true;
            gp1v = true;
            if (detailButtonCount <= 0) {
                detailButtonCount++
            }
        }
        if (!config.showopenbutton) {
            _(".jb-bb-btn-open-url").hide()
        } else {
            show_detail_button_bar = true;
            gp1v = true;
            detailButtonCount++
        }
        if (!config.showautoplaybutton) {
            _(".jb-bb-btn-auto-play").hide()
        } else {
            show_detail_button_bar = true;
            gp2v = true;
            detailButtonCount++
        }
        if (!show_audio_button()) {
            _(".jb-bb-btn-audio").hide()
        } else {
            show_detail_button_bar = true;
            gp3v = true;
            detailButtonCount++
        }
        if (!need_full_screen_button()) {
            _(".jb-bb-btn-full-screen").hide()
        } else {
            gp1v = true;
            if (is_index_visible && !utils.is_large_screen_mode(config)) {
                show_thumb_button_bar = true;
                indexButtonCount++
            } else {
                show_detail_button_bar = true;
                detailButtonCount++
            }
        }
        if (!config.showinfobutton) {
            _(".jb-bb-btn-show-info").hide()
        } else {
            show_detail_button_bar = true;
            gp3v = true;
            detailButtonCount++
        }
        if (!config.shownavbuttons) {
            _(".jb-bb-btn-top-nav").hide()
        } else {
            show_detail_button_bar = true;
            gp2v = true;
            detailButtonCount += 2
        }
        if (!config.usefotomoto || !utils.is_large_screen_mode(config)) {
            _(".jb-bb-btn-fotomoto").hide()
        } else {
            show_detail_button_bar = true;
            gp4v = true;
            detailButtonCount++
        }
        if (!config.sharefacebook) {
            _(".jb-bb-btn-facebook").hide()
        } else {
            show_detail_button_bar = true;
            gp4v = true;
            detailButtonCount++
        }
        if (!config.sharetwitter) {
            _(".jb-bb-btn-twitter").hide()
        } else {
            show_detail_button_bar = true;
            gp4v = true;
            detailButtonCount++
        }
        if (!config.sharegplus) {
            _(".jb-bb-btn-gplus").hide()
        } else {
            show_detail_button_bar = true;
            gp4v = true;
            detailButtonCount++
        }
        if (!config.sharepinterest) {
            _(".jb-bb-btn-printerest").hide()
        } else {
            show_detail_button_bar = true;
            gp4v = true;
            detailButtonCount++
        }
        if (!config.sharetumblr) {
            _(".jb-bb-btn-tumblr").hide()
        } else {
            show_detail_button_bar = true;
            gp4v = true;
            detailButtonCount++
        }
        var separatorCount = 0;
        if (gp1v && gp2v) {
            _(".jb-bb-splitter-1").show();
            separatorCount++
        } else {
            _(".jb-bb-splitter-1").hide()
        }
        if (gp3v && (gp2v || gp1v)) {
            _(".jb-bb-splitter-2").show();
            separatorCount++
        } else {
            _(".jb-bb-splitter-2").hide()
        }
        if (gp4v && (gp3v || gp2v || gp1v)) {
            _(".jb-bb-splitter-3").show();
            separatorCount++
        } else {
            _(".jb-bb-splitter-3").hide()
        }
        if (countonly) {
            return {
                detailButtonCount: detailButtonCount,
                indexButtonCount: indexButtonCount,
                separatorCount: separatorCount
            }
        }
        var showimageoverlay = config.showimageoverlay.toUpperCase();
        var btnPos = config.buttonbarposition.toUpperCase();
        if (!show_detail_button_bar || btnPos === "NONE") {
            _(".jb-classifier-link-wrapper.jb-classifier-detail-area").remove()
        } else {
            if (config.showinfobutton || overlay_visible || btnPos === "TOP" || showimageoverlay === "ALWAYS") {
                if (is_detail_visible && btnPos != "OVERLAY_IMAGE") {
                    _(".jb-classifier-link-wrapper.jb-classifier-detail-area").show()
                }
                _(".jb-classifier-link-wrapper.jb-classifier-detail-area .jb-bb-bar").show()
            } else {
                _(".jb-classifier-link-wrapper.jb-classifier-detail-area").hide();
                _(".jb-classifier-link-wrapper.jb-classifier-detail-area .jb-bb-bar").hide()
            }
        }
        if (!show_thumb_button_bar) {
            _(".jb-classifier-link-wrapper.jb-classifier-thumb-area .jb-bb-bar").hide()
        } else {
            _(".jb-classifier-link-wrapper.jb-classifier-thumb-area .jb-bb-bar").show()
        }
    };
    var show_hide_controls = function(control, show, delay) {
        if (delay) {
            control.stop(false, true);
            if (show) {
                if (!control.is(":visible") || control.css("opacity") == 0 || utils.is_swipable_device()) {
                    control.fadeIn(delay)
                }
            } else {
                control.fadeOut(delay)
            }
            return
        }
        if (show) {
            control.css("opacity", 1).show()
        } else {
            control.hide()
        }
    };
    var is_title_with_overlay = function() {
        if (!utils.is_large_screen_mode(config) || !is_detail_visible) {
            return false
        }
        var galleryTitlePosition = config.gallerytitleposition.toUpperCase();
        if (galleryTitlePosition === "NONE" || galleryTitlePosition === "TOP") {
            return false
        }
        return true
    };
    var concatenate_tags_string = function(arytags) {
        if (!arytags) {
            return ""
        }
        var ret = "";
        for (var i = 0; i < arytags.length; i++) {
            if (!arytags[i]) {
                continue
            }
            if (ret) {
                ret += (", " + arytags[i])
            } else {
                ret = arytags[i]
            }
        }
        return ret
    };
    var set_overlay_visible = function(show) {
        var showimageoverlay = config.showimageoverlay.toUpperCase();
        if (showimageoverlay === "ALWAYS") {
            overlay_visible = true
        } else {
            if (showimageoverlay === "NEVER") {
                overlay_visible = false
            } else {
                overlay_visible = show
            }
        }
    };
    var show_count = 0;
    var show_hide_overlay = function(show, delay) {
        set_overlay_visible(show);
        display_overlay(delay)
    };
    var display_overlay = function(delay) {
        var excludesel = (!image_showed && config.buttonbarposition.toUpperCase() === "OVERLAY_IMAGE") ? ":not(.jb-classifier-link-wrapper)" : "";
        if ($.browser.msie && overlay_visible) {
            _(".jb-classifier-show-on-over .jb-bb-bar").show()
        }
        show_hide_controls(_(".jb-classifier-show-on-over" + excludesel), overlay_visible, delay)
    };
    var overlayTimer = 0;
    var set_overlay = function(show, delay) {
        if (is_switching_image) {
            return
        }
        if (!_(" .jb-panel-detail").is(":visible")) {
            return
        }
        if (switching_2_thumbnail) {
            return
        }
        if (overlayTimer) {
            window.clearTimeout(overlayTimer);
            overlayTimer = 0
        }
        overlayTimer = window.setTimeout(function() {
            overlayTimer = 0;
            show_hide_overlay(show, ($.browser.msie && $.browser.version >= 7 && $.browser.version < 8) ? 0 : delay)
        }, 100)
    };
    var check_open_image_directly = function() {
        var ret = directGo2(true);
        if (ret === 1 || ret === 3) {
            is_detail_visible = true;
            is_index_visible = false;
            return true
        }
        if (config.firstimageindex > 0 && config.firstimageindex <= gallery_manager.length()) {
            show_main_image(config.firstimageindex - 1, image_change_speed, true);
            is_detail_visible = true;
            is_index_visible = false;
            return true
        }
        return false
    };
    var set_init_visible_panel = function() {
        setup_layout(current_width, current_height, true);
        var cntSize = sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
        positioning.set_containers_size_and_position(cntSize);
        positioning.set_index_nav_button_position(cntSize)
    };
    var originalIdx = -1;
    var isHiding = false;
    var directGo2 = function(dlink) {
        if (isHiding) {
            return 0
        }
        var urlhash = window.location.href.split("#");
        var result = 0;
        if (config.enabledirectlinks || dlink) {
            var directPicIdx = (urlhash.length >= 2) ? parseInt(urlhash[1]) : -1;
            if (directPicIdx > 0 && directPicIdx <= gallery_manager.length() && originalIdx != directPicIdx) {
                originalIdx = directPicIdx;
                set_init_visible_panel();
                show_main_image(directPicIdx - 1, 0, false, true);
                result |= 1
            }
        }
        var hasExpHash = urlhash.length == 2 && urlhash[1].indexOf(expandedHash) >= 0;
        if ((!hasExpHash && fullScreenPersistor.is_full_screen && !utils.is_new_expanded_window()) || (hasExpHash && !fullScreenPersistor.is_full_screen && !is_full_screen_mode)) {
            full_screen();
            result |= 2
        }
        return result
    };
    var hashTimer = 0;
    var set_hash_changed_event = function() {
        if ($.browser.msie && $.browser.version < 8) {
            if (hashTimer) {
                window.clearInterval(hashTimer)
            }
            hashTimer = window.setInterval(directGo2, 800)
        } else {
            $(window).bind("hashchange", directGo2)
        }
    };
    var splash_is_set = function() {
        var ssp = config.showsplashpage.toUpperCase();
        if (ssp === "NEVER") {
            return false
        } else {
            if (ssp === "ALWAYS") {
                return true
            } else {
                if (!utils.is_large_screen_mode(config) && !is_full_screen_mode) {
                    return true
                }
            }
        }
        return false
    };
    var need_show_splash_page = function() {
        if (fullScreenPersistor.is_full_screen || utils.is_new_expanded_window()) {
            return false
        }
        return splash_is_set()
    };
    var show_splash_page = function() {
        if (config.usefotomoto) {
            if (!config.fotomotostoreid) {
                display_error_message(config.languagelistall.fotomotomissingid);
                return
            }
            utils.add_js_tag("http://widget.fotomoto.com/stores/script/" + config.fotomotostoreid + ".js?api=true&aid=68677e1269332506", "fotomotojs")
        }
        if (gallery_manager.length() <= 0) {
            return
        }
        utils.add_viewport_meta_tag_4_device(sizing.is_gallery_fully_filled(config.gallerywidth, config.galleryheight) || utils.is_new_expanded_window() || ((utils.is_iphone() || utils.is_ipad()) && config.expandinnewpage.toUpperCase() === "FALSE"));
        current_width = get_gallery_width();
        current_height = get_gallery_height();
        set_font();
        if (need_show_splash_page()) {
            _(".jb-classifier-detail-area").hide();
            var splashImageUrl = (config.splashimageurl ? correct_path(config.splashimageurl) : gallery_manager.get_image(0).imageURL);
            var splash = new juicebox_gallery_splash_panel();
            var params = get_panel_params();
            params.splashImageUrl = splashImageUrl;
            params.finish_draw_event_callback = null;
            params.view_gallery_event_callback = function() {
                full_screen()
            };
            splash.initialize(params);
            splash.draw();
            hide_url_bar()
        } else {
            after_loading_images();
            set_gallery_title()
        }
    };
    var get_panel_params = function() {
        return {
            jquery: $,
            document_id: document_id,
            container: _(" .jb-panel-index>.jb-idx-thumbnail-container"),
            config: config,
            utils: utils,
            glymng: gallery_manager,
            sizing: sizing,
            finish_draw_event_callback: switch_2_main_image,
            touch_event_callback: after_page_changed,
            caption_complete_callback: set_touch_component_height,
            current_width: current_width,
            current_height: current_height,
            debug: {
                debug3value: debug_info2,
                debugmsg: debug_message
            }
        }
    };
    var link_overlays = function() {
        if (!need_top_panel()) {
            _(".jb-panel-top").remove()
        } else {
            _(".jb-panel-top").show()
        }
        if (!need_full_screen_button()) {
            _(".jb-bb-btn-full-screen").remove()
        }
        if (!config.showsmallthumbsbutton || !config.showthumbsbutton) {
            _(".jb-bb-btn-de-show-list").remove()
        }
        var ov = config.captionposition.toUpperCase();
        var areaCap = _(".jb-area-caption").css("max-height", config.maxcaptionheight);
        if (ov === "NONE") {
            areaCap.remove()
        } else {
            if (ov === "BELOW_IMAGE" || ov === "BOTTOM" || ov === "BELOW_THUMBS") {
                areaCap.removeClass("jb-classifier-show-on-over").addClass("jb-flag-size-fixed")
            } else {
                areaCap.addClass("jb-classifier-show-on-over")
            }
        }
        var gobackbtn = _(".jb-go-back");
        if (!show_back_button()) {
            gobackbtn.remove()
        } else {
            ov = config.backbuttonposition.toUpperCase();
            if (ov === "OVERLAY") {
                gobackbtn.addClass("jb-classifier-show-on-over")
            } else {
                gobackbtn.removeClass("jb-classifier-show-on-over")
            }
            if (config.showsmallbackbutton) {
                gobackbtn.addClass("jb-classifier-detail-area")
            }
            if (config.backbuttonuseicon) {
                gobackbtn.addClass("jb-go-back-icon-frame");
                gobackbtn.children("a").addClass("jb-go-back-icon")
            }
        }
        ov = config.buttonbarposition.toUpperCase();
        var btnsel = ($.browser.msie ? ".jb-classifier-link-wrapper.jb-classifier-detail-area" : ".jb-classifier-link-wrapper.jb-classifier-detail-area, .jb-classifier-link-wrapper.jb-classifier-detail-area .jb-bb-bar");
        if (ov === "NONE") {
            _(".jb-classifier-link-wrapper.jb-classifier-detail-area").remove()
        } else {
            if (ov === "TOP" || config.showinfobutton) {
                _(btnsel).removeClass("jb-classifier-show-on-over")
            } else {
                _(btnsel).addClass("jb-classifier-show-on-over");
                if (config.showimageoverlay.toUpperCase() === "NEVER") {
                    _(".jb-classifier-link-wrapper.jb-classifier-detail-area").hide()
                }
            }
        }
        ov = config.gallerytitleposition.toUpperCase();
        if (ov === "NONE") {
            _(".jb-area-large-mode-title").hide()
        } else {
            if (ov === "TOP") {
                _(".jb-area-large-mode-title").removeClass("jb-classifier-show-on-over")
            } else {
                _(".jb-area-large-mode-title").addClass("jb-classifier-show-on-over")
            }
        }
        if (!need_image_nav_button()) {
            _(".jb-navigation .jbn-nav-button").remove()
        }
        if (config.topbackcolor) {
            _(".jb-panel-top").css({
                "background-color": utils.format_color(config.topbackcolor)
            })
        }
        if (config.buttonbarbackcolor) {
            _(".jb-bb-bar, .jb-go-back-icon").css({
                "background-color": utils.format_color(config.buttonbarbackcolor)
            })
        }
    };
    var test_remove_title_and_caption = function() {
        if (config.gallerytitleposition.toUpperCase() === "ABOVE_THUMBS") {
            _(".jb-area-large-mode-title").remove()
        }
        if (config.captionposition.toUpperCase() === "BELOW_THUMBS") {
            _(".jb-area-caption").remove()
        }
    };
    var hide_caption_if_needed = function(delay) {
        if (_(".jb-area-caption").is(":visible")) {
            _(".jb-area-caption").addClass("jb-status-cap-hide-4-move").fadeOut(delay)
        }
    };
    var unhide_caption_if_needed = function(delay) {
        _(".jb-area-caption.jb-status-cap-hide-4-move").removeClass("jb-status-cap-hide-4-move").fadeIn(delay)
    };
    var hide_image_nav_if_needed = function(delay) {
        if (config.imagenavposition.toUpperCase() != "IMAGE") {
            return
        }
        _(".jb-classifier-detail-area .jbn-nav-button div").fadeOut(delay)
    };
    var unhide_image_nav_if_necessary = function() {
        if (config.imagenavposition.toUpperCase() != "IMAGE") {
            return
        }
        set_image_nav()
    };
    var hide_button_bar_if_needed = function(delay) {
        if (config.buttonbarposition.toUpperCase() != "OVERLAY_IMAGE") {
            return
        }
        _(".jb-classifier-link-wrapper.jb-classifier-detail-area, .jb-classifier-link-wrapper.jb-classifier-detail-area .jb-bb-bar").fadeOut(delay)
    };
    var unhide_button_bar_if_necessary = function(delay) {
        if (config.buttonbarposition.toUpperCase() != "OVERLAY_IMAGE") {
            return
        }
        if (utils.is_buttonbarposition_default(config) && !overlay_visible) {
            return
        }
        if (!is_detail_visible) {
            return
        }
        if (!delay) {
            delay = 0
        }
        _(".jb-classifier-link-wrapper.jb-classifier-detail-area, .jb-classifier-link-wrapper.jb-classifier-detail-area .jb-bb-bar").fadeIn(delay)
    };
    var move_back_image_after_touch = function(delta) {
        detail_panel.move_back(delta_x);
        if (config.imagenavposition.toUpperCase() == "IMAGE") {
            window.setTimeout(function() {
                unhide_image_nav_if_necessary()
            }, 500 * config.imagetransitiontime)
        }
        if (utils.is_buttonbarposition_default(config) || config.buttonbarposition.toUpperCase() == "OVERLAY_IMAGE") {
            window.setTimeout(function() {
                unhide_button_bar_if_necessary()
            }, 500 * config.imagetransitiontime)
        }
        window.setTimeout(function() {
            unhide_caption_if_needed()
        }, 500 * config.imagetransitiontime)
    };
    var initialize_panels = function() {
        test_remove_title_and_caption();
        setup_layout(current_width, current_height, is_detail_visible);
        var thumbpanelheigh = config.maxthumbrows * (config.thumbheight + config.thumbpadding);
        if (utils.is_side_layout(config)) {
            thumbpanelheigh = 10
        }
        var cntSize = sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), thumbpanelheigh, config);
        var params = get_panel_params();
        params.current_width = cntSize.index_panel_width;
        params.current_height = cntSize.index_panel_height;
        index_panel.initialize(params, is_full_screen_mode || fullScreenPersistor.is_full_screen);
        params.container = _(" .jb-panel-detail");
        params.caption_container = _(".jb-area-caption");
        params.current_width = cntSize.detail_panel_width;
        params.current_height = cntSize.detail_panel_height;
        params.before_draw_event_callback = before_show_main_image;
        params.finish_draw_event_callback = after_show_main_image;
        params.onHidingImage = function(delay) {
            hide_image_nav_if_needed(delay);
            hide_button_bar_if_needed(0)
        };
        params.onShowingImage = function(imagePosition, delay) {
            positioning.showComponentsOverlayImage(imagePosition, delay)
        };
        detail_panel.initialize(params)
    };
    var windowResize = function() {
        repaint(false)
    };
    var set_icon_style_4_hover = function() {
        if (config.buttonbariconhovercolor) {
            var bbattrbak = "";
            var selbtn = ".jb-bb-button";
            if (show_back_button() && config.backbuttonuseicon) {
                selbtn += ", .jb-go-back-icon"
            }
            _(selbtn).hover(function() {
                bbattrbak = $(this).attr("style");
                $(this).css({
                    color: utils.format_color(config.buttonbariconhovercolor)
                })
            }, function() {
                if ($.browser.msie && $.browser.version < 10) {
                    $(this).css({
                        color: utils.format_color(config.buttonbariconcolor)
                    })
                } else {
                    $(this).attr("style", bbattrbak)
                }
            })
        }
        if (config.navbuttoniconhovercolor) {
            var navattrbak = "";
            _(".jbn-nav-button-icon").hover(function() {
                navattrbak = $(this).attr("style");
                $(this).css({
                    color: utils.format_color(config.navbuttoniconhovercolor)
                })
            }, function() {
                if ($.browser.msie && $.browser.version < 10) {
                    $(this).css({
                        color: utils.format_color(config.navbuttoniconcolor)
                    })
                } else {
                    $(this).attr("style", navattrbak)
                }
            })
        }
    };
    var set_font = function() {
        if (!config.galleryfontface) {
            return
        }
        _(".jcbx-glry-classic").css({
            "font-family": config.galleryfontface
        })
    };
    var after_loading_images = function(skipshowing) {
        if (config.randomizeimages) {
            gallery_manager.sort_images()
        }
        sizing.get_initial_size();
        $("#" + document_id).html(get_gallery_frame_html());
        set_font();
        set_touchevent();
        initialize_panels();
        set_back_button();
        link_overlays();
        set_icon_style_4_hover();
        positioning.adjust_title_button_bar_position();
        if (config.useflickr) {
            _("").addClass("jb-flickr-glry")
        }
        if (fullScreenPersistor.is_full_screen) {
            if (utils.need_viewport_meta() && !utils.host_has_viewport_meta()) {
                _("").addClass("jb-large-icon")
            }
        }
        positioning.setSidePadding();
        if (false) {
            window.setTimeout(function() {
                display_error_message(themeUrl)
            }, image_change_speed)
        }
        if (!skipshowing) {
            setup_layout(current_width, current_height, is_detail_visible);
            var cntSize = sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
            positioning.set_nav_btn_position(cntSize);
            $(window).resize(windowResize);
            if (utils.is_iphone() || utils.is_ipad()) {
                window.onorientationchange = function() {
                    repaint(true)
                }
            }
            _(".jb-bb-btn-de-show-list").click(index_button_clicked);
            _(".jb-classifier-thumb-area .jbn-right-button").click(function() {
                return next_page(0)
            });
            _(".jb-classifier-thumb-area .jbn-left-button").click(function() {
                return previous_page(0)
            });
            _(".jb-bb-btn-open-url").click(open_url);
            _(".jb-bb-btn-full-screen").click(full_screen);
            _(".jb-bb-btn-auto-play").click(function() {
                toggle_autoplay();
                return false
            });
            _(".jb-bb-btn-audio").click(toggle_audio_play);
            _(".jb-bb-btn-show-info").click(function() {
                toggle_info();
                return false
            });
            _(".jb-bb-btn-top-nav.jb-bb-btn-top-nav-left").click(function() {
                if (autoplay_timer) {
                    toggle_autoplay()
                }
                return previous_image(0)
            });
            _(".jb-bb-btn-top-nav.jb-bb-btn-top-nav-right").click(function() {
                if (autoplay_timer) {
                    toggle_autoplay()
                }
                return next_image(0)
            });
            _(".jb-bb-btn-fotomoto").click(buy);
            _(".jb-bb-btn-facebook").click(facebook);
            _(".jb-bb-btn-twitter").click(twitter);
            _(".jb-bb-btn-gplus").click(gplus);
            _(".jb-bb-btn-printerest").click(printerest);
            _(".jb-bb-btn-tumblr").click(tumblr);
            var audioUrl = "";
            if (utils.is_firefox() || utils.is_opera()) {
                audioUrl = config.audiourlogg
            } else {
                if (config.audiourlmp3) {
                    audioUrl = config.audiourlmp3
                } else {
                    audioUrl = config.audiourlogg
                }
            }
            if (fullScreenPersistor.is_full_screen && fullScreenPersistor.parent_gallery_param.parent_toggle_audio_play) {
                audio_playing = fullScreenPersistor.parent_gallery_param.is_audio_playing;
                if (fullScreenPersistor.parent_gallery_param.is_audio_playing) {
                    _(".jb-bb-btn-audio").addClass("jb-status-playing").attr("title", config.languagelistall.psa)
                } else {
                    _(".jb-bb-btn-audio").removeClass("jb-status-playing").attr("title", config.languagelistall.plya)
                }
            } else {
                if (audioUrl && !utils.is_earlier_ie() && !utils.is_adobe_air()) {
                    try {
                        audioPlayer = new Audio(audioUrl);
                        audioPlayer.addEventListener("ended", function() {
                            this.currentTime = 0;
                            if (config.loopaudio) {
                                this.play()
                            } else {
                                toggle_audio_play()
                            }
                        }, false);
                        audioPlayer.volume = config.audiovolume;
                        if (config.playaudioonload) {
                            toggle_audio_play()
                        }
                    } catch (err) {
                        console.error("cannot handle audio")
                    }
                }
            }
            var clickMode = config.imageclickmode.toUpperCase();
            if (!utils.is_touchable_device(config) || config.forcetouchmode || ($.browser.msie && clickMode != "OPEN_URL")) {
                _(".jb-classifier-detail-area .jbn-right-button").click(function() {
                    if (delta_x || delta_y) {
                        return
                    }
                    if (autoplay_timer) {
                        toggle_autoplay()
                    }
                    return next_image(0)
                });
                _(".jb-classifier-detail-area .jbn-left-button").click(function() {
                    if (autoplay_timer) {
                        toggle_autoplay()
                    }
                    if (delta_x || delta_y) {
                        return
                    }
                    return previous_image(0)
                });
                if (!config.forcetouchmode) {
                    if (clickMode === "NONE") {
                        _(".jb-classifier-detail-area .jbn-nav-right-touch-area").css("cursor", "default");
                        _(".jb-classifier-detail-area .jbn-nav-left-touch-area").css("cursor", "default")
                    } else {
                        if (clickMode === "OPEN_URL") {
                            _(".jb-classifier-detail-area .jbn-nav-right-touch-area").click(open_url);
                            _(".jb-classifier-detail-area .jbn-nav-left-touch-area").click(open_url)
                        } else {
                            _(".jb-classifier-detail-area .jbn-nav-right-touch-area").click(function() {
                                if (delta_x || delta_y) {
                                    return
                                }
                                if (autoplay_timer) {
                                    toggle_autoplay()
                                }
                                return next_image(0)
                            });
                            _(".jb-classifier-detail-area .jbn-nav-left-touch-area").click(function() {
                                if (delta_x || delta_y) {
                                    return
                                }
                                if (autoplay_timer) {
                                    toggle_autoplay()
                                }
                                return previous_image(0)
                            })
                        }
                    }
                }
            } else {
                var delay = 1050 * config.imagetransitiontime + 300;
                var delay = parseInt(1005 * config.imagetransitiontime + 510 * config.imagetransitiontime);
                _(".jb-classifier-detail-area .jbn-right-button").bind("touchend", function(e) {
                    index_panel.yield_4_transition(delay);
                    e.preventDefault();
                    if (in_the_transitioning) {
                        return
                    }
                    in_the_transitioning = true;
                    if (autoplay_timer) {
                        toggle_autoplay()
                    }
                    next_image(0);
                    window.setTimeout(function() {
                        in_the_transitioning = false
                    }, delay)
                });
                _(".jb-classifier-detail-area .jbn-left-button").bind("touchend", function(e) {
                    index_panel.yield_4_transition(delay);
                    e.preventDefault();
                    if (in_the_transitioning) {
                        return
                    }
                    in_the_transitioning = true;
                    if (autoplay_timer) {
                        toggle_autoplay()
                    }
                    previous_image(0);
                    window.setTimeout(function() {
                        in_the_transitioning = false
                    }, delay)
                })
            }
            if (is_detail_visible) {
                if (fullScreenPersistor.is_full_screen) {
                    overlay_visible = fullScreenPersistor.parent_gallery_param.overlay_visible
                } else {
                    overlay_visible = config.showoverlayonload
                }
                show_hide_overlay(overlay_visible, 0);
                show_hide_nav_controls(overlay_visible);
                set_image_nav()
            }
            set_key_events();
            config.onload();
            if (!utils.is_iphone() && !utils.is_ipad() && !utils.is_android() && !config.showinfobutton && !config.forcetouchmode) {
                var selstr = "";
                _(selstr).hover(function() {
                    if (!is_detail_visible) {
                        return
                    }
                    if (in_navigation || in_the_transitioning) {
                        return
                    }
                    overlay_visible = true;
                    set_overlay(overlay_visible, 250)
                }, function() {
                    if (!is_detail_visible) {
                        return
                    }
                    if (in_navigation || in_the_transitioning) {
                        return
                    }
                    overlay_visible = false;
                    set_overlay(overlay_visible, 250)
                })
            }
            set_hash_changed_event();
            var forceInitialization = true;
            if (fullScreenPersistor.is_full_screen) {
                forceInitialization = false;
                if (utils.is_large_screen_mode(config)) {
                    show_main_image(fullScreenPersistor.parent_gallery_param.current_image_index, image_change_speed, true);
                    hide_thumbnails_in_lsm = fullScreenPersistor.parent_gallery_param.hide_thumbnails_in_lsm;
                    repaint(true);
                    if (fullScreenPersistor.parent_gallery_param.is_autoplaying) {
                        autoplay_timer = 0;
                        toggle_autoplay(false, true)
                    }
                } else {
                    is_detail_visible = fullScreenPersistor.parent_gallery_param.is_detail_visible;
                    is_index_visible = fullScreenPersistor.parent_gallery_param.is_index_visible;
                    if (is_detail_visible) {
                        show_main_image(fullScreenPersistor.parent_gallery_param.current_image_index, image_change_speed, true);
                        repaint(true);
                        overlay_visible = fullScreenPersistor.parent_gallery_param.overlay_visible;
                        show_hide_overlay(overlay_visible, 0);
                        show_hide_nav_controls(overlay_visible);
                        set_image_nav();
                        if (fullScreenPersistor.parent_gallery_param.is_autoplaying) {
                            autoplay_timer = 0;
                            toggle_autoplay(false, true)
                        }
                    } else {
                        show_thumbnails(fullScreenPersistor.parent_gallery_param.current_image_index);
                        repaint(true)
                    }
                }
                utils.add_fullscreen_listener(function(fullscreen) {
                    if (!fullscreen) {
                        full_screen()
                    }
                })
            } else {
                if (utils.is_new_expanded_window()) {
                    forceInitialization = false;
                    hide_thumbnails_in_lsm = config.hide_thumbnails_in_lsm === "true";
                    is_detail_visible = config.is_detail_visible === "true";
                    is_index_visible = config.is_index_visible === "true";
                    if (config.pageTitle) {
                        try {
                            $("head > title").html(config.pageTitle)
                        } catch (err) {}
                    }
                    if (is_detail_visible) {
                        show_main_image(config.firstimageindex ? config.firstimageindex - 1 : 0, image_change_speed, true)
                    }
                    repaint(true)
                } else {
                    if ($.browser.webkit) {
                        window.setTimeout(function() {
                            var idxPnl = _(".jb-panel-index");
                            idxPnl.hide();
                            repaint(true, false, true)
                        }, 300)
                    }
                }
            }
            if (!utils.is_new_expanded_window()) {
                window.setTimeout(function() {
                    if (config.usethumbdots && is_detail_visible && is_index_visible) {
                        var cntSize = sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
                        detail_panel.repaint(cntSize.detail_panel_width, cntSize.detail_panel_height)
                    }
                    repaint(true);
                    if (config_manager.isp && fullScreenPersistor.is_full_screen) {
                        lastImageEventIndex = fullScreenPersistor.parent_gallery_param.last_image_event_index;
                        for (var key in fullScreenPersistor.parent_gallery) {
                            if (typeof(fullScreenPersistor.parent_gallery[key]) != "function") {
                                continue
                            }
                            if (key === "onExpand") {
                                continue
                            }
                            juicebox_instances[instance_id][key] = fullScreenPersistor.parent_gallery[key]
                        }
                    }
                }, 100);
                if (window.location.href.toLowerCase().indexOf("http") !== 0 && $.browser.mozilla) {
                    repaint(true)
                }
                if ($.browser.msie && (!utils.is_large_screen_mode(config) || utils.is_earlier_ie())) {
                    window.setTimeout(function() {
                        repaint(true)
                    }, 100)
                }
            }
            var panelVisibilityOverwritten = false;
            if (config.autoplayonload && !fullScreenPersistor.is_full_screen) {
                if (!utils.is_large_screen_mode(config)) {
                    show_main_image(detail_panel.get_photo_position(), image_change_speed, true);
                    is_detail_visible = true;
                    is_index_visible = false;
                    panelVisibilityOverwritten = true
                }
                window.setTimeout(function() {
                    toggle_autoplay(true)
                }, 200)
            }
            if (!config.showthumbsonload && utils.is_large_screen_mode(config)) {
                hide_thumbnails_in_lsm = false;
                toggle_index_panel_4_lsm(true)
            }
            if (config_manager.isp && juicebox_instances[instance_id] && typeof(juicebox_instances[instance_id].onInitComplete) === "function") {
                juicebox_instances[instance_id].onInitComplete()
            }
            if (forceInitialization) {
                if (!check_open_image_directly() && !panelVisibilityOverwritten) {
                    if (!config.showsmallthumbsbutton || !config.showsmallthumbsonload) {
                        is_detail_visible = true;
                        is_index_visible = false
                    }
                    if (is_index_visible) {
                        show_thumbnails(0)
                    }
                    if (is_detail_visible && !fullScreenPersistor.is_full_screen) {
                        window.setTimeout(function() {
                            show_main_image(0, 0)
                        }, 100)
                    }
                } else {
                    if (is_detail_visible && !utils.is_large_screen_mode(config)) {
                        overlay_visible = config.showoverlayonload;
                        show_hide_overlay(overlay_visible, 0);
                        show_hide_nav_controls(overlay_visible)
                    }
                }
            }
            apply_show_options(false, panelVisibilityOverwritten)
        }
        _(".jb-classifier-detail-area").disableSelection()
    };
    var autoplay_timer = 0;
    var set_autoplay_info = function(skipStatusInfo) {
        var message = config.languagelistall.aon;
        if (autoplay_timer) {
            _(".jb-bb-btn-auto-play").toggleClass("jb-status-playing").attr("title", config.languagelistall.stpa)
        } else {
            message = config.languagelistall.aoff;
            _(".jb-bb-btn-auto-play").toggleClass("jb-status-playing").attr("title", config.languagelistall.strta)
        }
        if (config.showautoplaystatus && !skipStatusInfo) {
            var msgdlg = _(".jb-status-message");
            var cntSize = sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
            var msgTp = cntSize.detail_panel_height / 2 - 18;
            var msgLf = cntSize.detail_panel_width / 2 - 60;
            msgdlg.css({
                top: msgTp,
                left: msgLf,
                width: "115px"
            });
            msgdlg.html(message).fadeIn(300);
            window.setTimeout(function() {
                msgdlg.hide().fadeOut(image_change_speed);
                msgdlg.fadeOut(300)
            }, 1000)
        }
    };
    var audio_playing = false;
    var toggle_audio_play = function() {
        if (fullScreenPersistor.is_full_screen && fullScreenPersistor.parent_gallery_param.parent_toggle_audio_play) {
            fullScreenPersistor.parent_gallery_param.parent_toggle_audio_play()
        } else {
            if (!audioPlayer) {
                return false
            }
        }
        if (utils.is_earlier_ie()) {
            return false
        }
        if (audio_playing) {
            if (audioPlayer) {
                audioPlayer.pause()
            }
            audio_playing = false;
            _(".jb-bb-btn-audio").removeClass("jb-status-playing").attr("title", config.languagelistall.plya)
        } else {
            if (audioPlayer) {
                audioPlayer.play()
            }
            audio_playing = true;
            _(".jb-bb-btn-audio").addClass("jb-status-playing").attr("title", config.languagelistall.psa)
        }
        return false
    };
    var can_image_move = function(to_next) {
        var glrylen = gallery_manager.length();
        if (glrylen <= 1) {
            return false
        }
        if (config.enablelooping) {
            return true
        }
        var imgpos = detail_panel.get_photo_position();
        if (to_next) {
            if (imgpos >= glrylen - 1) {
                return false
            }
            return true
        } else {
            if (imgpos <= 0) {
                return false
            }
            return true
        }
    };
    var can_page_move = function(to_next) {
        if (index_panel.is_last_page() && index_panel.is_first_page()) {
            return false
        }
        if (config.enablelooping) {
            return true
        }
        if (to_next) {
            if (index_panel.is_last_page()) {
                return false
            }
            return true
        } else {
            if (index_panel.is_first_page()) {
                return false
            }
            return true
        }
    };
    var set_autoplay = function() {
        autoplay_timer = window.setInterval(function() {
            if (!can_image_move(true)) {
                toggle_autoplay();
                return false
            }
            var ptpos = gallery_manager.get_next_image(detail_panel.get_photo_position()).position;
            var mimg = _(".jb-dt-main-image-" + ptpos + " .jb-status-loading");
            if (mimg.length <= 0 && config.main_load_placeholder.indexOf("jb-status-") > 0) {
                next_image(0)
            }
        }, 1000 * config.displaytime + image_change_speed)
    };
    var toggle_autoplay = function(callOnLoad, skipStatusInfo) {
        if (!config.showautoplaybutton && !config.enableautoplay) {
            return
        }
        if (autoplay_timer) {
            window.clearInterval(autoplay_timer);
            autoplay_timer = 0;
            set_autoplay_info(skipStatusInfo);
            return false
        }
        if (is_detail_visible) {
            if (config.gonextonautoplay && !callOnLoad) {
                next_image(0)
            } else {
                show_main_image(detail_panel.get_photo_position())
            }
        }
        set_autoplay();
        set_autoplay_info(skipStatusInfo);
        return false
    };
    var set_key_events = function() {
        if (!config.enablekeyboardcontrols) {
            return
        }
        if (utils.is_iphone() || utils.is_ipad() || utils.is_small_android()) {
            return
        }
        if (fullScreenPersistor.is_full_screen || is_full_screen_mode) {
            if (!utils.is_in_iframe()) {
                _("").focus()
            }
        }
        _("").keydown(function(evt) {
            if (evt.ctrlKey || evt.altKey || evt.shiftKey || evt.metaKey) {
                return
            }
            switch (evt.keyCode) {
                case 32:
                    evt.preventDefault();
                    toggle_autoplay();
                    break;
                case 37:
                case 75:
                    evt.preventDefault();
                    previous_image(0);
                    break;
                case 39:
                case 74:
                    evt.preventDefault();
                    next_image(0);
                    break;
                case 36:
                    evt.preventDefault();
                    show_thumbnails(0);
                    show_main_image(0);
                    break;
                case 35:
                    evt.preventDefault();
                    var imgpos = gallery_manager.length() - 1;
                    show_thumbnails(imgpos);
                    show_main_image(imgpos);
                    break;
                case 70:
                    if (is_full_screen_mode || fullScreenPersistor.is_full_screen) {
                        return
                    }
                    evt.preventDefault();
                    full_screen();
                    break;
                case 27:
                    if (fullScreenPersistor.is_full_screen) {
                        evt.preventDefault();
                        full_screen()
                    }
                    break
            }
        })
    };
    var update_flickr_image_details = function(imageIndex, details) {
        if (!details) {
            return
        }
        var image = gallery_manager.get_image(imageIndex);
        if (image.flickrPhotoId !== details.id) {
            return
        }
        image.description = details.description;
        image.detail_loaded = true;
        if (detail_panel.is_initialized()) {
            detail_panel.repopulate_caption_html(image)
        }
    };
    var load_images = function(xml) {
        if (config.useflickr) {
            flickr_loader = new juicebox_flickr_image_loader($, config_manager, display_error_message)
        }
        if (fullScreenPersistor.is_full_screen && fullScreenPersistor.parent_gallery_param && fullScreenPersistor.parent_gallery_param.gallery_manager) {
            gallery_manager = fullScreenPersistor.parent_gallery_param.gallery_manager;
            show_splash_page();
            return
        }
        var limit = config_manager.isp ? (100000) : 50;
        if (config.useflickr) {
            flickr_loader.get_images(function(photos) {
                for (var i = 0; i < photos.length && i < limit; i++) {
                    gallery_manager.add_image({
                        imageURL: photos[i].imageURL,
                        thumbURL: photos[i].thumbURL,
                        caption: photos[i].caption,
                        imageFullURL: photos[i].imageFullURL,
                        flickrPhotoId: photos[i].flickrPhotoId
                    })
                }
                show_splash_page()
            }, null)
        } else {
            var count = 0;
            $(xml).find("image").each(function() {
                if (count >= limit) {
                    return
                }
                count++;
                var node = $(this);
                var imgurl = correct_path(node.attr("imageURL"));
                var tu = node.attr("thumbURL");
                var thmurl = (tu ? correct_path(tu) : imgurl);
                gallery_manager.add_image({
                    imageURL: imgurl,
                    thumbURL: thmurl,
                    title: node.children("title").text(),
                    caption: node.children("caption").text(),
                    linkURL: correct_path(node.attr("linkURL")),
                    linkTarget: node.attr("linkTarget")
                })
            });
            show_splash_page()
        }
    };
    var get_gallery_height = function(donotAdjustHeight) {
        return sizing.get_gallery_height(config, fullScreenPersistor.is_full_screen || is_full_screen_mode, fullScreenPersistor.is_full_screen, donotAdjustHeight)
    };
    var get_gallery_width = function() {
        return sizing.get_gallery_width(config, fullScreenPersistor.is_full_screen || is_full_screen_mode, fullScreenPersistor.is_full_screen)
    };
    var init_before_loading_gallery_html = function(container) {
        if (!utils.is_ie8()) {
            container.css({
                height: config.galleryheight,
                width: config.gallerywidth
            })
        }
        sizing = new juicebox_sizing_manager($, container, utils);
        if (!utils.is_ie8()) {
            is_full_screen_mode = sizing.is_fullscreen_mode(config)
        }
        sizing.try_set_body_size(config, fullScreenPersistor.is_full_screen || is_full_screen_mode);
        if (!sizing.force_height_calculation(config) && (config.galleryheight + "").indexOf("%") > 0) {
            $("#" + config.containerid).css({
                height: get_gallery_height(),
                width: config.gallerywidth
            })
        } else {
            container.css({
                height: config.galleryheight,
                width: config.gallerywidth
            })
        }
        if (utils.is_ie8()) {
            is_full_screen_mode = sizing.is_fullscreen_mode(config)
        }
        if (is_full_screen_mode) {
            $("body").css({
                overflow: "hidden",
                padding: "0",
                margin: "0"
            })
        }
        current_width = get_gallery_width();
        current_height = get_gallery_height()
    };
    var set_touchevent = function() {
        var moveImage = function(e, delta) {
            in_navigation = false;
            in_the_transitioning = true;
            var delaytime = parseInt(1000 * config.imagetransitiontime * (current_width - delta_x) / current_width);
            if (delta > 10) {
                if (autoplay_timer) {
                    toggle_autoplay()
                }
                if (!can_image_move(false)) {
                    move_back_image_after_touch(delta)
                } else {
                    previous_image(Math.abs(delta))
                }
                e.preventDefault()
            } else {
                if (delta < -10) {
                    if (autoplay_timer) {
                        toggle_autoplay()
                    }
                    if (!can_image_move(true)) {
                        move_back_image_after_touch(delta)
                    } else {
                        next_image(Math.abs(delta))
                    }
                    e.preventDefault()
                } else {
                    var clickMode = config.imageclickmode.toUpperCase();
                    if (clickMode === "OPEN_URL") {
                        open_url();
                        transTimer = 0;
                        in_the_transitioning = false;
                        unhide_image_nav_if_necessary();
                        unhide_button_bar_if_necessary();
                        unhide_caption_if_needed();
                        return
                    }
                    if (!config.showinfobutton) {
                        if (!utils.is_touchable_desktop() || !overlay_visible) {
                            detail_panel.move_back(delta_x);
                            toggle_overlay();
                            if (config.captionposition.toUpperCase() === "BELOW_IMAGE") {
                                _(".jb-area-caption").fadeIn()
                            }
                        } else {
                            move_back_image_after_touch(delta)
                        }
                        delaytime = 310
                    } else {
                        move_back_image_after_touch(delta);
                        transTimer = 0;
                        in_the_transitioning = false;
                        return
                    }
                }
            }
            index_panel.yield_4_transition(delaytime);
            if (utils.is_large_screen_mode(config)) {
                transTimer = window.setTimeout(function() {
                    transTimer = 0;
                    in_the_transitioning = false
                }, delaytime)
            } else {
                in_the_transitioning = false
            }
        };
        var touchStarted = function(e) {
            if (fullScreenPersistor.is_full_screen) {
                e.preventDefault()
            }
            if (in_navigation) {
                return
            }
            if (in_the_transitioning) {
                in_the_transitioning = false
            }
            delta_x = 0;
            delta_y = 0;
            if (!in_navigation) {
                in_navigation = true;
                if (utils.is_touchable_desktop()) {
                    var cd = utils.getMsPointerXy(e);
                    start_x = cd.x;
                    start_y = cd.y
                } else {
                    start_x = e.originalEvent.touches[0].pageX;
                    start_y = e.originalEvent.touches[0].pageY
                }
                last_x = start_x;
                last_y = start_y;
                hide_image_nav_if_needed(0);
                hide_button_bar_if_needed(0)
            }
        };
        var brokenMovingStopTimer = 0;
        var touchMoving = function(e) {
            var pgx = 0;
            var pgy = 0;
            if (fullScreenPersistor.is_full_screen || is_full_screen_mode || Math.abs(pgx - start_x) > Math.abs(pgy - start_y)) {
                e.preventDefault()
            }
            if (utils.is_touchable_desktop()) {
                var cd = utils.getMsPointerXy(e);
                pgx = cd.x;
                pgy = cd.y
            } else {
                pgx = e.originalEvent.touches[0].pageX;
                pgy = e.originalEvent.touches[0].pageY
            }
            if (in_the_transitioning) {
                return
            }
            if (!in_navigation) {
                return
            }
            hide_caption_if_needed(0);
            delta_x = pgx - start_x;
            delta_y = pgy - start_y;
            if (Math.abs(delta_x) > 10) {
                if (autoplay_timer) {
                    toggle_autoplay()
                }
            }
            var imgs = _(" .jb-panel-detail .jb-dt-main-frame");
            imgs.animate({
                left: "+=" + (pgx - last_x),
                avoidTransforms: !config.use_webkit_transform,
                useTranslate3d: true
            }, 0);
            last_x = pgx;
            last_y = pgy;
            if (utils.is_android()) {
                if (brokenMovingStopTimer) {
                    window.clearTimeout(brokenMovingStopTimer)
                }
                brokenMovingStopTimer = window.setTimeout(function() {
                    brokenMovingStopTimer = 0;
                    touchEnded(e)
                }, 1000)
            }
        };
        var touchEnded = function(e) {
            if (brokenMovingStopTimer) {
                window.clearTimeout(brokenMovingStopTimer);
                brokenMovingStopTimer = 0
            }
            var is_h_swipe = Math.abs(delta_x) > Math.abs(delta_y);
            if (fullScreenPersistor.is_full_screen || is_full_screen_mode || is_h_swipe) {
                e.preventDefault()
            }
            if (in_the_transitioning || !in_navigation) {
                delta_x = 0;
                delta_y = 0;
                return
            }
            if (is_h_swipe) {
                moveImage(e, delta_x)
            } else {
                if (Math.abs(delta_y) > 10) {
                    var clickMode = config.imageclickmode.toUpperCase();
                    move_back_image_after_touch(delta_x);
                    if (!is_full_screen_mode && !fullScreenPersistor.is_full_screen) {
                        window.scrollBy(0, -1 * delta_y)
                    }
                    in_navigation = false
                } else {
                    moveImage(e, 0)
                }
            }
        };
        if (utils.is_touchable_desktop()) {
            var elements = document.getElementsByClassName("jb-navigation jb-classifier-detail-area");
            for (var i = 0; i < elements.length; i++) {
                var elm = elements[i];
                elm.addEventListener("touchstart", touchStarted, false);
                elm.addEventListener("touchmove", touchMoving, false);
                elm.addEventListener("touchend", touchEnded, false);
                elm.addEventListener("gesturestart", touchStarted, false);
                elm.addEventListener("gesturechange", touchMoving, false);
                elm.addEventListener("gestureend", touchEnded, false)
            }
        } else {
            if (!$.browser.msie) {
                _(".jb-navigation.jb-classifier-detail-area").bind("touchstart", touchStarted).bind("touchmove", touchMoving).bind("touchend", touchEnded)
            }
        }
        if (!$.browser.msie || utils.is_touchable_desktop()) {
            _(".jb-classifier-detail-area .jbn-right-button, jb-classifier-detail-area .jbn-left-button").bind("touchstart", function(e) {
                e.preventDefault()
            }).bind("touchmove", function(e) {
                e.preventDefault()
            }).bind("touchend", function(e) {
                e.preventDefault()
            });
            _(".jb-area-caption, .jb-classifier-link-wrapper, .jb-area-large-mode-title").bind("touchmove", function(e) {
                e.preventDefault()
            });
            _(".jb-panel-detail").nextAll('div[onclick*="window.open"]').bind("touchmove", function(e) {
                e.preventDefault()
            }).bind("touchend", function(e) {
                window.open("http://www." + ["ju", "ice", "b", "ox", ".n", "et"].join(""));
                e.preventDefault()
            })
        }
        if (config.forcetouchmode && !utils.is_touchable_desktop()) {
            _(".jb-classifier-detail-area .jbn-left-button, .jb-classifier-detail-area .jbn-right-button").mouseup(function(e) {
                e.preventDefault();
                in_navigation = false
            }).mousedown(function(e) {
                e.preventDefault()
            }).mousemove(function(e) {
                e.preventDefault()
            });
            _(".jb-navigation.jb-classifier-detail-area").mousedown(function(e) {
                if (e.which !== 1) {
                    return
                }
                var thEvt = {
                    originalEvent: {
                        touches: [{}]
                    }
                };
                e.preventDefault();
                thEvt.preventDefault = function() {};
                thEvt.originalEvent.touches[0].pageX = e.screenX;
                thEvt.originalEvent.touches[0].pageY = e.screenY;
                touchStarted(thEvt)
            }).mousemove(function(e) {
                if (e.which !== 1) {
                    in_navigation = false;
                    return
                }
                if (!in_navigation) {
                    return
                }
                var thEvt = {
                    originalEvent: {
                        touches: [{}]
                    }
                };
                thEvt.preventDefault = function() {};
                thEvt.originalEvent.touches[0].pageX = e.screenX;
                thEvt.originalEvent.touches[0].pageY = e.screenY;
                touchMoving(thEvt)
            }).mouseup(function(e) {
                if (!in_navigation) {
                    return
                }
                var thEvt = {};
                thEvt.preventDefault = function() {};
                touchEnded(thEvt)
            }).mouseout(function(e) {
                if (!in_navigation) {
                    return
                }
                var thEvt = {};
                thEvt.preventDefault = function() {};
                touchEnded(thEvt)
            })
        }
    };
    var init_after_dom_loaded = function() {
        _(".jb-navigation.jb-classifier-detail-area").fadeOut(0);
        dialog = new juicebox_gallery_dialog({
            jquery: $
        });
        if (config.showpreloader) {
            var opct = $.browser.msie ? "filter: alpha(opacity = 0);" : "opacity:0;";
            if (utils.is_firefox3()) {
                opct = "display:none;"
            }
            if (sizing.force_height_calculation(config)) {
                _("").css({
                    height: current_height
                })
            }
            _(".jb-idx-thumbnail-container").html(config.main_load_placeholder);
            _("#jb-glry-preload .jb-status-loading").css({
                height: current_height,
                width: current_width
            });
            _("#jb-glry-preload").fadeIn(300)
        }
        if (window.location.href.toLowerCase().indexOf("http") !== 0) {
            if (utils.is_chrome()) {
                display_error_message(config.languagelistall.lcchm.replace("$BrowserName$", "Google Chrome").replace("$BrowserLink$", "chrome_local"));
                return
            }
            if (utils.is_opera()) {
                display_error_message(config.languagelistall.lcchm.replace("$BrowserName$", "Opera").replace("$BrowserLink$", "opera_local"));
                return
            }
        }
        var galleryFile = correct_path(config.configurl);
        $.ajax({
            url: galleryFile,
            type: "GET",
            error: function(xhr, data) {
                $("#" + document_id).html(display_error_message(config.languagelistall.ae))
            },
            success: function(data) {
                var rsp;
                if (typeof data === "string") {
                    if ($.browser.msie) {
                        rsp = new ActiveXObject("Microsoft.XMLDOM");
                        rsp.async = false;
                        rsp.loadXML(data);
                        data = rsp
                    } else {
                        rsp = new DOMParser();
                        data = rsp.parseFromString(data, "text/xml")
                    }
                }
                if (!utils.is_new_expanded_window()) {
                    config_manager.sync_options(_config, data);
                    config = config_manager.get_config()
                }
                image_change_speed = 1000 * config.imagetransitiontime;
                if (image_change_speed <= 0) {
                    image_change_speed = 1000
                }
                index_panel.synchronize_config(config);
                var bIsPercentage = (config.galleryheight + "").indexOf("%") > 0;
                _("." + theme_cls).attr("style", get_background_style());
                if (config.showpreloader) {
                    window.setTimeout(function() {
                        load_images(data)
                    }, 300)
                } else {
                    load_images(data)
                }
            }
        })
    };
    var toggle_overlay = function() {
        overlay_visible = !overlay_visible;
        show_hide_overlay(overlay_visible, 250)
    };
    var toggle_info = function() {
        overlay_visible = !overlay_visible;
        show_hide_nav_controls(overlay_visible, 250, true)
    };
    var show_hide_nav_controls = function(show, delay, skipBtnBar) {
        if (!is_detail_visible) {
            return
        }
        var tags;
        var excludesel = (!image_showed && config.buttonbarposition.toUpperCase() === "OVERLAY_IMAGE") ? ":not(.jb-classifier-link-wrapper)" : "";
        show_hide_controls(_(".jb-classifier-show-on-over" + excludesel), show, (($.browser.msie && $.browser.version >= 7 && $.browser.version < 8) ? 0 : delay));
        _(".jb-area-caption table").css({
            display: ""
        });
        var tt = show ? config.languagelistall.hdinfo : config.languagelistall.sinfo;
        _(".jb-bb-button.jb-bb-btn-show-info").attr("title", tt)
    };
    var display_error_message = function(msg) {
        var container;
        if (config.containerid) {
            container = $("#" + config.containerid)
        } else {
            container = _("")
        }
        var msgHtml;
        if (container.height() <= 0 && config.galleryheight.indexOf("%") > 0) {
            container.height($(window).height() * parseInt(config.galleryheight) / 100)
        }
        if (container && container.length > 0) {
            msgHtml = "<table style='width:100%;height:100%;text-align:center;background-color:#777;'><tr><td><div class='jb-error-message' style='color:white;font-family:sans-serif;font-size:18px;'>" + msg + "</div></td></tr></table>";
            container.html(msgHtml)
        } else {
            msgHtml = "<table style='width:100%;height:100%;text-align:center;font-family:sans-serif;font-size:18px;background-color:#777;color:#FFF;'><tr><td>" + msg + "</td></tr></table>";
            document.write(msgHtml)
        }
    };
    var add_css_link = function(linkUrl) {
        var csslnk = document.createElement("link");
        csslnk.type = "text/css";
        csslnk.rel = "stylesheet";
        var head = document.getElementsByTagName("head")[0] || document.documentElement;
        csslnk.href = linkUrl;
        head.appendChild(csslnk)
    };
    var init = function() {
        instance_id = juicebox_instance_count;
        if (!fullScreenPersistor.is_full_screen && instance_id > 0) {
            expandedHash = "expand" + (instance_id + 1)
        }
        juicebox_instance_count++;
        if (config.themeurl) {
            themeUrl = config.themeurl
        } else {
            if (config.theme) {
                themeUrl = correct_path(config.jbcore) + "themes/" + config.theme + "/css/style.css"
            }
        }
        add_css_link(themeUrl);
        var container;
        if (config.containerid) {
            var dom_loading_tmr = 0;
            container = $("#" + config.containerid);
            if (container.length > 0) {
                init_before_loading_gallery_html(container);
                container.html(gallery_skeleton(document_id));
                init_after_dom_loaded()
            } else {
                dom_loading_tmr = window.setInterval(function() {
                    var cntnr = $("#" + config.containerid);
                    if (cntnr.length <= 0) {
                        if ($("body").length > 0) {
                            display_error_message(config.languagelistall.noid01 + config.containerid + config.languagelistall.noid02);
                            if (dom_loading_tmr) {
                                window.clearInterval(dom_loading_tmr)
                            }
                            dom_loading_tmr = 0;
                            return
                        }
                        return
                    }
                    if (dom_loading_tmr) {
                        window.clearInterval(dom_loading_tmr)
                    }
                    dom_loading_tmr = 0;
                    init_before_loading_gallery_html(cntnr);
                    cntnr.html(gallery_skeleton(document_id));
                    init_after_dom_loaded()
                }, 200)
            }
        } else {
            document.write(get_container_html(document_id));
            container = _("");
            init_before_loading_gallery_html(container);
            container.html(get_gallery_frame_html());
            init_after_dom_loaded()
        }
    };
    var get_container_html = function(document_id, token) {
        var ver = "";
        if ($.browser.msie) {
            ver = "jb-flag-msie jb-flag-msiever" + parseInt($.browser.version) + (utils.is_earlier_ie() ? " jb-flag-msie-bf9" : "")
        } else {
            if (utils.is_swipable_device()) {
                ver = "jb-flag-touchable"
            }
        }
        return "<div id='" + document_id + "' tabindex='0' class='juicebox-gallery " + ver + "' style='width:100%;height:100%;'>" + (token ? token : "") + "</div>"
    };
    var show_back_button = function() {
        if (config.showsmallbackbutton) {
            return true
        }
        var bkbtnpos = config.backbuttonposition.toUpperCase();
        if (bkbtnpos === "TOP" || bkbtnpos === "OVERLAY") {
            return true
        }
        return false
    };
    var get_back_button_html_content = function() {
        if (!show_back_button()) {
            return ""
        }
        var lnk;
        var icncls = config.backbuttonuseicon ? "jb-go-back-icon" : "";
        var btncnt = (config.backbuttonuseicon && $.browser.msie && $.browser.version < 9) ? "&#xe014;" : (config.backbuttonuseicon ? "" : config.backbuttontext);
        var tips = config.backbuttonuseicon ? " title='" + config.languagelistall.gobk + "'" : "";
        var adj = ($.browser.msie && $.browser.version < 8) ? "padding-top:" + parseInt(utils.get_button_bar_button_size(config).buttonWidth / 4) + "px;" : "";
        if (config.backbuttonurl) {
            lnk = "<a href='" + config.backbuttonurl + "'" + (config.showsmallbackbutton ? " class='jb-classifier-show-on-over " + icncls + "'" : "class='" + icncls + "'") + " style='" + adj + (config.backbuttonuseicon ? utils.get_button_bar_icon_style(config, true) : "") + "'" + tips + ">" + btncnt + "</a>"
        } else {
            lnk = "<a href='#' onclick='history.back(); return false;'" + (config.showsmallbackbutton ? " class='jb-classifier-show-on-over " + icncls + "'" : "class='" + icncls + "'") + " style='" + adj + (config.backbuttonuseicon ? utils.get_button_bar_icon_style(config, true) : "") + "'" + tips + ">" + btncnt + "</a>"
        }
        return lnk
    };
    var set_back_button = function() {
        if (!show_back_button()) {
            _(".jb-go-back").remove();
            return
        }
        var pd = 10 + sizing.get_stage_padding(current_width, current_height, config);
        var cntSize = sizing.get_containers_size_and_position(current_width, current_height, true, true, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
        var btnrt = pd;
        var btntp = config.backbuttonposition.toUpperCase() != "OVERLAY" ? pd : (cntSize.detail_panel_top + 10);
        var bhalgn = config.backbuttonhalign.toUpperCase();
        var cssobj;
        if (bhalgn === "CENTER") {
            cssobj = {
                top: btntp,
                left: btnrt,
                right: btnrt,
                "text-align": "center",
                "z-index": 550
            };
            if (config.backbuttonuseicon) {
                cssobj.left = parseInt((current_width - 38) / 2);
                cssobj.right = "auto";
                cssobj.padding = 0;
                cssobj.width = "auto"
            }
        } else {
            if (bhalgn === "RIGHT") {
                cssobj = {
                    top: btntp,
                    left: "auto",
                    right: btnrt,
                    "z-index": 650
                }
            } else {
                cssobj = {
                    top: btntp,
                    left: btnrt,
                    right: "auto",
                    "z-index": 650
                }
            }
        }
        if (!config.showsmallbackbutton) {
            _(".jb-go-back").html(get_back_button_html_content()).css(cssobj).show()
        } else {
            _(".jb-go-back").html(get_back_button_html_content()).css(cssobj)
        }
        if (config.textcolor) {
            _(".jb-go-back a").css({
                color: utils.format_color(config.textcolor)
            })
        }
        if (config.textshadowcolor) {
            _(".jb-go-back a").css({
                "text-shadow": utils.get_text_shadow_style(config.textshadowcolor, config.textshadowcolora, true)
            })
        }
    };
    var get_back_button_html = function() {
        return "<div class='jb-go-back jb-classifier-layer' layer='600' style='position:absolute !important;z-index:600; top: 10px; left: 10px; display:none;" + (show_back_button() && config.backbuttonuseicon ? utils.get_button_bar_style(config, true) : "") + "'>" + get_back_button_html_content() + "</div>"
    };
    var get_autoplay_status_html = function() {
        if (!config.showautoplaystatus) {
            return ""
        }
        return "<div class='jb-status-message' style='position:absolute;display:none;'></div>"
    };
    var need_image_nav_button = function() {
        if (utils.is_large_screen_mode(config)) {
            return true
        }
        if (!config.showimagenav) {
            return false
        }
        return true
    };
    var need_button_bar = function() {
        if (config.buttonbarposition.toUpperCase() === "NONE") {
            return false
        }
        return true
    };
    var get_calculated_gallery_height = function(ht) {
        return parseInt(ht * parseInt(config.galleryheight) / 100)
    };
    var get_background_style = function() {
        var hstr = "height:100%";
        return "display:none;width:100%;" + hstr + ";" + (config.backgroundcolor ? "background-color:" + utils.format_color(config.backgroundcolor) + ";" : "")
    };
    var get_top_panel_html = function() {
        return "<div class='jb-panel-top' style='position:absolute;display:none;'> </div>"
    };
    var get_splitter_html = function(cls) {
        var bbsz = 0;
        var bdcolor = "";
        if (config.buttonbariconrealsize && parseInt(config.buttonbariconrealsize)) {
            bbsz = parseInt(config.buttonbariconrealsize)
        }
        if (config.buttonbariconcolor) {
            bdcolor = "border-color:" + config.buttonbariconcolor + ";"
        }
        return "<div class='jb-bb-splitter " + cls + "' style='" + (bbsz ? "height:" + bbsz + "px;margin:" + parseInt(bbsz / 2) + "px 0 0 3px;" : "") + bdcolor + "'></div>"
    };
    var get_badge_image_url = function() {
        if (utils.is_adobe_air()) {
            return ""
        }
        return ["u", "rl", "(", "ht", "tp", ":", "/", "/", "j", "ui", "ce", "b", "o", "x", ".", "n", "e", "t", "/", "i", "m", "g", "/", "jb", "0", "0", "1", ".", "p", "n", "g", ")"].join("")
    };
    var get_badge_link = function() {
        return ["on", "c", "l", "i", "c", "k", "=", '"', "w", "i", "n", "d", "o", "w", ".", "o", "p", "e", "n", "(", "'", "h", "t", "t", "p", ":", "/", "/", "w", "w", "w", ".", "j", "u", "i", "c", "eb", "ox", ".", "ne", "t'", ")", ";", "return ", "false", ';"'].join("")
    };
    var set_background_image_size = function(initfull) {
        if (!config.backgroundurl) {
            return
        }
        if (!backgroundImageWidth || !backgroundImageHeight) {
            return
        }
        var szinfo = {};
        var scaleMode = config.backgroundscale.toUpperCase();
        var bkimg = _(".jb-panel-background");
        var cheight = current_height;
        var cwidth = current_width;
        if (initfull) {
            if (config.usefullscreenexpand && utils.support_real_fullscreen && screen.height && screen.width) {
                cheight = parseInt(screen.height);
                cwidth = parseInt(screen.width)
            } else {
                cheight = $(window).height();
                cwidth = $(window).width()
            }
        }
        if (scaleMode === "FILL") {
            szinfo = sizing.get_image_display_size({
                width: backgroundImageWidth,
                height: backgroundImageHeight
            }, cwidth, cheight, config, "FILL", true);
            bkimg.css({
                top: szinfo.unadjtop,
                left: szinfo.unadjleft,
                width: szinfo.width,
                height: szinfo.height
            })
        } else {
            if (scaleMode === "NONE") {} else {
                bkimg.css({
                    width: cwidth,
                    height: cheight
                });
                szinfo = {
                    imageTop: 0,
                    imageLeft: 0,
                    imageWidth: cwidth,
                    imageHeight: cheight
                }
            }
        }
        return szinfo
    };
    var get_background_html = function(backgroundurl) {
        if (backgroundUrl === backgroundurl) {
            return ""
        }
        _(".jb-panel-background").remove();
        if (!backgroundurl) {
            return ""
        }
        backgroundUrl = backgroundurl;
        if (fullScreenPersistor.is_full_screen) {
            backgroundImageWidth = fullScreenPersistor.parent_gallery_param.background_image_width;
            backgroundImageHeight = fullScreenPersistor.parent_gallery_param.background_image_height;
            var szinfo = set_background_image_size(true);
            var szstr = "";
            if (typeof(szinfo) != "undefined") {
                if (typeof(szinfo.imageTop) != "undefined") {
                    szstr += "top:" + szinfo.imageTop + "px;"
                }
                if (typeof(szinfo.imageLeft) != "undefined") {
                    szstr += "left:" + szinfo.imageLeft + "px;"
                }
                if (szinfo.imageWidth) {
                    szstr += "width:" + szinfo.imageWidth + "px;"
                }
                if (szinfo.imageHeight) {
                    szstr += "height:" + szinfo.imageHeight + "px;"
                }
            }
            return "<img class='jb-panel-background' src='" + backgroundurl + "' style='position:absolute;" + szstr + "'/>"
        } else {
            var bkimage = new Image();
            bkimage.onload = function() {
                backgroundImageWidth = bkimage.width;
                backgroundImageHeight = bkimage.height;
                set_background_image_size();
                _(".jb-panel-background").attr("src", backgroundurl).show()
            };
            bkimage.src = backgroundurl;
            return "<img class='jb-panel-background' style='display:none;position:absolute;'/>"
        }
    };
    var get_gallery_frame_html = function() {
        var badge = "";
        if (!utils.ship) {
            badge = "<div style='display:block !important;width: 90px !important;height: 24px !important;overflow: hidden !important;position: absolute !important;z-index: 3000" + ($.browser.msie ? "" : " !important") + ";background: " + get_badge_image_url() + " no-repeat 0 0 !important;cursor:pointer;margin:0 !important;padding:0 !important;bottom:0 !important;right:0 !important' " + get_badge_link() + "></div>"
        }
        if (utils.is_adobe_air()) {
            badge = badge.replace("<div style=", "<div class='" + ["j", "b", "-", "b", "a", "d", "g", "e"].join("") + "' style=").replace(";background: " + get_badge_image_url() + " no-repeat 0 0 !important;", ";")
        }
        return "<div class='" + theme_cls + "' style='" + get_background_style() + "'>" + get_background_html(correct_path(config.backgroundurl)) + get_top_panel_html() + "<div class='jb-panel-index jb-classifier-thumb-area' layer='300' style='position:absolute !important;z-index:300;'><div class='jb-idx-thumbnail-container' style='height:100% !important;width:100% !important;margin:0;padding:0;position:relative;'></div><div class='jb-navigation index-navigation jb-classifier-thumb-area'><div class='jbn-nav-button jbn-left-button jbn-nav-button-icon jb-classifier-layer' layer='1000' style='z-index:1000;display:none;" + utils.get_nav_icon_style(config) + "'>" + utils.add_font_icon_4_ie8(config, "&#xe000;") + "</div><div class='jbn-nav-button jbn-right-button jbn-nav-button-icon jb-classifier-layer' layer='1000' style='z-index:1000;display:none;" + utils.get_nav_icon_style(config) + "'>" + utils.add_font_icon_4_ie8(config, "&#xe001;") + "</div></div></div>" + get_back_button_html() + "<div class='jb-classifier-link-wrapper jb-classifier-thumb-area jb-classifier-layer' layer='3000' style='z-index:3000;right:10px;top:10px;'><div class='jb-bb-bar' style='" + utils.get_button_bar_style(config) + "'><div class='jb-bb-button jb-bb-btn-full-screen" + ((fullScreenPersistor.is_full_screen || utils.is_new_expanded_window()) ? " jb-bb-btn-de-full-screen" : "") + "' title='" + ((fullScreenPersistor.is_full_screen || utils.is_new_expanded_window()) ? config.languagelistall.ef : config.languagelistall.gf) + "' style='" + utils.get_button_bar_icon_style(config) + "'>" + utils.add_font_icon_4_ie8(config, (fullScreenPersistor.is_full_screen || utils.is_new_expanded_window()) ? "&#xe006;" : "&#xe005;", true) + "</div></div></div><div class='jb-panel-detail jb-classifier-detail-area jb-classifier-layer' layer='50' style='position:absolute !important'></div>" + utils.get_gallery_title_html(config) + "<div class='jb-classifier-link-wrapper jb-classifier-detail-area jb-classifier-layer' layer='3000' style='z-index:3000;'>" + (need_button_bar() ? "<div class='jb-bb-bar' style='" + utils.get_button_bar_style(config) + "'>" + get_layout_links_html() + get_splitter_html("jb-bb-splitter-1") + get_play_links_html() + get_splitter_html("jb-bb-splitter-2") + get_media_links_html() + get_splitter_html("jb-bb-splitter-3") + get_social_links_html() + "</div>" : "") + "</div>" + badge + ((config.captionposition.toUpperCase() != "NONE") ? utils.get_caption_html() : "") + "<div class='jb-navigation jb-classifier-detail-area jb-classifier-layer' layer='500' style='height:100%;z-index:500;'>" + get_autoplay_status_html() + "<div class='jbn-nav-touch-area jbn-nav-left-touch-area'><div class='jbn-nav-button jb-classifier-show-on-over jb-classifier-layer' layer='1000' style='z-index:1000;position:absolute;left:" + (sizing.get_stage_padding(current_width, current_height, config)) + "px;" + utils.get_nav_btn_size_style(config, false) + "'><div class='jbn-left-button jbn-nav-button-icon' style='display:none;" + utils.get_nav_icon_style(config) + "'>" + utils.add_font_icon_4_ie8(config, "&#xe000;") + "</div></div></div><div class='jbn-nav-touch-area jbn-nav-right-touch-area'>" + (need_image_nav_button() ? "<div class='jbn-nav-button jb-classifier-show-on-over jb-classifier-layer' layer='1000' style='z-index:1000;position:absolute;right:" + (sizing.get_stage_padding(current_width, current_height, config) + 10) + "px;" + utils.get_nav_btn_size_style(config, false) + "'><div class='jbn-right-button jbn-nav-button-icon' style='display:none;" + utils.get_nav_icon_style(config) + "'>" + utils.add_font_icon_4_ie8(config, "&#xe001;") + "</div></div>" : "") + "</div></div></div>"
    };
    var get_layout_links_html = function() {
        return "<div class='jb-bb-button jb-bb-btn-de-show-list' title='" + config.languagelistall.st + "' style='" + utils.get_button_bar_icon_style(config) + "'>" + utils.add_font_icon_4_ie8(config, utils.is_large_screen_mode(config) ? "&#xe002;" : "&#xe003;", true) + "</div><div class='jb-bb-button jb-bb-btn-open-url' title='" + config.languagelistall.oiinw + "' style='" + utils.get_button_bar_icon_style(config) + "'>" + utils.add_font_icon_4_ie8(config, "&#xe004;", true) + "</div><div class='jb-bb-button jb-bb-btn-full-screen" + ((fullScreenPersistor.is_full_screen || utils.is_new_expanded_window()) ? " jb-bb-btn-de-full-screen" : "") + "' title='" + ((fullScreenPersistor.is_full_screen || utils.is_new_expanded_window()) ? config.languagelistall.ef : config.languagelistall.gf) + "' style='" + utils.get_button_bar_icon_style(config) + "'>" + utils.add_font_icon_4_ie8(config, (fullScreenPersistor.is_full_screen || utils.is_new_expanded_window()) ? "&#xe006;" : "&#xe005;", true) + "</div>"
    };
    var get_play_links_html = function() {
        return get_link_button_html("jb-bb-btn-top-nav jb-bb-btn-top-nav-left", config.languagelistall.goprv, "&#xe007;") + get_link_button_html("jb-bb-btn-auto-play", config.languagelistall.strta, "&#xe009;") + get_link_button_html("jb-bb-btn-top-nav jb-bb-btn-top-nav-right", config.languagelistall.gonxt, "&#xe008;")
    };
    var get_media_links_html = function() {
        return get_link_button_html("jb-bb-btn-show-info", config.languagelistall.hdinfo, "&#xe00b;") + get_link_button_html("jb-bb-btn-audio", config.languagelistall.plya, "&#xe00c;")
    };
    var get_social_links_html = function() {
        return (config.usefotomoto ? get_link_button_html("jb-bb-btn-fotomoto", config.languagelistall.fotomoto, "&#xe00e;") : "") + (config.sharefacebook ? get_link_button_html("jb-bb-btn-facebook", config.languagelistall.facebook, "&#xe00f;") : "") + (config.sharetwitter ? get_link_button_html("jb-bb-btn-twitter", config.languagelistall.twitter, "&#xe010;") : "") + (config.sharegplus ? get_link_button_html("jb-bb-btn-gplus", config.languagelistall.gplus, "&#xe011;") : "") + (config.sharepinterest ? get_link_button_html("jb-bb-btn-printerest", config.languagelistall.printerest, "&#xe012;") : "") + (config.sharetumblr ? get_link_button_html("jb-bb-btn-tumblr", config.languagelistall.tumblr, "&#xe013;") : "")
    };
    var get_link_button_html = function(cls, title, fontContent) {
        return "<div class='jb-bb-button " + cls + "' title='" + title + "' style='" + utils.get_button_bar_icon_style(config) + "'>" + utils.add_font_icon_4_ie8(config, fontContent, true) + "</div>"
    };
    var buy = function() {
        FOTOMOTO.API.showWindow(10, detail_panel.get_current_photo().imageURL);
        return false
    };
    var get_current_gallery_image_info = function() {
        var glryUrl = "";
        var currentImage = detail_panel.get_current_photo();
        if (config.enabledirectlinks) {
            glryUrl = window.location.href
        } else {
            glryUrl = get_url_with_image_hash(currentImage.position)
        }
        var galleryTitle = _(".jb-area-large-mode-title").text().trim();
        var imgTitle = _(".caption_" + currentImage.position + " .jb-caption .jb-caption-title").text().trim();
        var captionDesc = _(".caption_" + currentImage.position + " .jb-caption .jb-caption-desc").text().trim();
        var sharedTxt = galleryTitle;
        if (sharedTxt && imgTitle) {
            sharedTxt += " | " + imgTitle
        }
        var allTitles = sharedTxt;
        if (sharedTxt && captionDesc) {
            sharedTxt += " | " + captionDesc
        }
        if (!sharedTxt) {
            sharedTxt = captionDesc
        }
        return {
            shareUrl: encodeURIComponent(glryUrl),
            imageUrl: encodeURIComponent(utils.convert_to_absolute_path(currentImage.imageURL)),
            shareText: encodeURIComponent(sharedTxt),
            caption: encodeURIComponent(captionDesc),
            title: encodeURIComponent(imgTitle),
            galleryTitle: encodeURIComponent(galleryTitle),
            allTitles: encodeURIComponent(allTitles)
        }
    };
    var facebook = function() {
        var imginfo = get_current_gallery_image_info();
        window.open("http://www.facebook.com/sharer.php?s=100&p[url]=" + imginfo.shareUrl + "&p[images][0]=" + imginfo.imageUrl + "&p[title]=" + imginfo.allTitles + "&p[summary]=" + imginfo.caption, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes," + utils.get_popup_position_string(600, 420));
        return false
    };
    var twitter = function() {
        var imginfo = get_current_gallery_image_info();
        window.open("https://twitter.com/intent/tweet?text=" + imginfo.shareText + "&url=" + imginfo.shareUrl, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes," + utils.get_popup_position_string(600, 420));
        return false
    };
    var gplus = function() {
        var imginfo = get_current_gallery_image_info();
        window.open("https://plus.google.com/share?url=" + imginfo.imageUrl, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes," + utils.get_popup_position_string(600, 420));
        return false
    };
    var printerest = function() {
        var imginfo = get_current_gallery_image_info();
        window.open("https://pinterest.com/login/?next=/pin/create/bookmarklet/%3Fmedia%3D" + imginfo.imageUrl + "%26description%3D" + imginfo.shareText + "%26is_video%3Dfalse%26url%3D" + imginfo.shareUrl, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes," + utils.get_popup_position_string(600, 420));
        return false
    };
    var tumblr = function() {
        var imginfo = get_current_gallery_image_info();
        window.open("http://www.tumblr.com/share/photo?source=" + imginfo.imageUrl + "&caption=" + imginfo.shareText + "&click_thru=" + imginfo.shareUrl, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes," + utils.get_popup_position_string(600, 420));
        return false
    };
    var gallery_skeleton = function(document_id) {
        var frameHtml = get_gallery_frame_html();
        backgroundUrl = "";
        return get_container_html(document_id, frameHtml)
    };
    var lastPageEventIndex = -1;
    var after_page_changed = function(skipEvent) {
        set_index_nav_button();
        if (!skipEvent && config_manager.isp && juicebox_instances[instance_id] && typeof(juicebox_instances[instance_id].onThumbPageChange) === "function") {
            var curntPage = parseInt(index_panel.get_index()) + 1;
            if (curntPage != lastPageEventIndex) {
                lastPageEventIndex = curntPage;
                var curntImage = detail_panel.get_current_photo();
                var evntObj = {
                    id: curntPage,
                    title: config.gallerytitle,
                    caption: curntImage.caption
                };
                juicebox_instances[instance_id].onThumbPageChange(evntObj)
            }
        }
    };
    var set_index_nav_button = function() {
        if (!can_page_move()) {
            _(".jb-classifier-thumb-area .jbn-left-button").hide();
            if (!utils.is_large_screen_mode(config)) {
                window.setTimeout(function() {
                    _(".jb-classifier-thumb-area .jbn-left-button").hide()
                }, 50)
            }
        } else {
            _(".jb-classifier-thumb-area .jbn-left-button").show()
        }
        if (!can_page_move(true)) {
            _(".jb-classifier-thumb-area .jbn-right-button").hide();
            if (!utils.is_large_screen_mode(config)) {
                window.setTimeout(function() {
                    _(".jb-classifier-thumb-area .jbn-right-button").hide()
                }, 50)
            }
        } else {
            _(".jb-classifier-thumb-area .jbn-right-button").show()
        }
    };
    var show_thumbnails = function(imgpos) {
        var cntSize = sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
        if (is_index_visible) {
            positioning.set_containers_size_and_position(cntSize);
            positioning.set_index_nav_button_position(cntSize)
        }
        index_panel.show_page_4_image_position(imgpos, cntSize.index_panel_width, cntSize.index_panel_height);
        set_index_nav_button();
        apply_show_options();
        set_gallery_title();
        set_show_list_button()
    };
    var index_button_clicked = function() {
        if (!utils.is_large_screen_mode(config)) {
            return switch_2_thumbnails()
        }
        return toggle_index_panel_4_lsm()
    };
    var toggle_index_panel_4_lsm = function(noAnim) {
        var cntSize;
        var avoidtf = !_config.use_webkit_transform;
        var idxPnl = _(".jb-panel-index");
        hide_thumbnails_in_lsm = !hide_thumbnails_in_lsm;
        if (hide_thumbnails_in_lsm) {
            var finishHiddingIndexPanel = function() {
                is_index_visible = false;
                idxPnl.hide();
                positioning.adjust_title_button_bar_position();
                repaint(true, false, true)
            };
            if (!noAnim) {
                var idxht = parseInt(idxPnl.height());
                var idxwd = parseInt(idxPnl.width());
                var tmbpos = config.thumbsposition.toUpperCase();
                _(".jb-panel-index .jb-area-large-mode-title").css({
                    overflow: "hidden",
                    "white-space": "nowrap"
                });
                if (tmbpos === "TOP") {
                    idxPnl.animate({
                        bottom: "+=" + (idxht),
                        height: "-=" + (idxht),
                        avoidTransforms: avoidtf
                    }, 500, "easeOutQuart", finishHiddingIndexPanel)
                } else {
                    if (tmbpos === "LEFT") {
                        _(".index-navigation .jbn-nav-button").hide();
                        idxPnl.animate({
                            right: "+=" + (idxwd),
                            width: "-=" + (idxwd),
                            avoidTransforms: avoidtf
                        }, 500, "easeOutQuart", finishHiddingIndexPanel)
                    } else {
                        if (tmbpos === "RIGHT") {
                            idxPnl.animate({
                                left: "+=" + (idxwd),
                                width: "-=" + (idxwd),
                                avoidTransforms: avoidtf
                            }, 500, "easeOutQuart", finishHiddingIndexPanel)
                        } else {
                            idxPnl.animate({
                                top: "+=" + (idxht),
                                height: "-=" + (idxht),
                                avoidTransforms: avoidtf
                            }, 500, "easeOutQuart", finishHiddingIndexPanel)
                        }
                    }
                }
            } else {
                finishHiddingIndexPanel()
            }
        } else {
            cntSize = sizing.get_containers_size_and_position(current_width, current_height, true, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
            repaint(true, true, true);
            var tmbpos = config.thumbsposition.toUpperCase();
            var initop = cntSize.index_panel_top;
            var inileft = cntSize.index_panel_left;
            var iniheight = cntSize.index_panel_height;
            var iniwidth = cntSize.index_panel_width;
            if (tmbpos === "TOP") {
                iniheight = 0
            } else {
                if (tmbpos === "LEFT") {
                    iniwidth = 0
                } else {
                    if (tmbpos === "RIGHT") {
                        iniwidth = 0;
                        inileft = cntSize.index_panel_left + cntSize.index_panel_width
                    } else {
                        iniheight = 0;
                        initop = cntSize.index_panel_top + cntSize.index_panel_height
                    }
                }
            }
            idxPnl.css({
                top: initop,
                height: iniheight,
                left: inileft,
                width: iniwidth
            });
            idxPnl.show();
            _(".jb-panel-index .jb-area-caption").show();
            if (config.gallerytitleposition.toUpperCase() === "ABOVE_THUMBS") {
                _(".jb-panel-index .jb-area-large-mode-title").show()
            }
            var finishShowingIndexPanel = function() {
                is_index_visible = true;
                idxPnl.hide();
                repaint(true, false, true)
            };
            if (!noAnim) {
                _(".jb-panel-index .jb-area-large-mode-title").css({
                    overflow: "hidden",
                    "white-space": "nowrap"
                });
                if (tmbpos === "TOP") {
                    idxPnl.animate({
                        height: "+=" + (cntSize.index_panel_height),
                        avoidTransforms: avoidtf
                    }, 500, "easeOutQuart", finishShowingIndexPanel)
                } else {
                    if (tmbpos === "LEFT") {
                        idxPnl.animate({
                            right: "-=" + (cntSize.index_panel_width),
                            width: "+=" + (cntSize.index_panel_width),
                            avoidTransforms: avoidtf
                        }, 500, "easeOutQuart", finishShowingIndexPanel)
                    } else {
                        if (tmbpos === "RIGHT") {
                            idxPnl.animate({
                                left: "-=" + (cntSize.index_panel_width),
                                width: "+=" + (cntSize.index_panel_width),
                                avoidTransforms: avoidtf
                            }, 500, "easeOutQuart", finishShowingIndexPanel)
                        } else {
                            idxPnl.animate({
                                top: "+=" + (-cntSize.index_panel_height),
                                height: "+=" + (cntSize.index_panel_height),
                                avoidTransforms: avoidtf
                            }, 500, "easeOutQuart", finishShowingIndexPanel)
                        }
                    }
                }
            } else {
                finishShowingIndexPanel()
            }
        }
        if (!noAnim && config_manager.isp && juicebox_instances[instance_id] && typeof(juicebox_instances[instance_id].onShowThumbs) === "function") {
            juicebox_instances[instance_id].onShowThumbs(!hide_thumbnails_in_lsm)
        }
        return false
    };
    var switch_2_thumbnails = function(current_image_position) {
        if (autoplay_timer) {
            toggle_autoplay()
        }
        var imgpos = current_image_position ? current_image_position : 0;
        if (detail_panel.get_photo_position() > 0) {
            imgpos = detail_panel.get_photo_position()
        }
        if (is_index_visible && is_detail_visible) {
            show_thumbnails(imgpos);
            return false
        }
        is_detail_visible = false;
        is_index_visible = true;
        var target = _(" .jb-panel-index");
        var dtpnl = _(" .jb-panel-detail, .jb-area-caption");
        if (dtpnl.is(":visible")) {
            switching_2_thumbnail = true;
            var imgs = _(" .jb-panel-detail img");
            if (imgs.length > 0) {
                imgs.fadeOut(250)
            }
            if (utils.is_android()) {
                dtpnl.fadeOut(250);
                window.setTimeout(function() {
                    _(" .jb-classifier-detail-area, .jb-area-caption").hide();
                    _(".jb-classifier-thumb-area").show().fadeIn(200);
                    show_thumbnails(imgpos)
                }, 250)
            } else {
                dtpnl.fadeOut(250);
                window.setTimeout(function() {
                    _(" .jb-classifier-detail-area, .jb-area-caption").hide();
                    _(".jb-classifier-thumb-area").show().fadeIn(200);
                    show_thumbnails(imgpos)
                }, 250)
            }
        } else {
            show_thumbnails()
        }
        if (config.enabledirectlinks) {
            var urlhash = window.location.href.split("#");
            var exphash = "";
            if (urlhash.length == 2 && urlhash[1].indexOf(expandedHash) >= 0) {
                exphash = expandedHash
            }
            window.location.href = window.location.href.split("#")[0] + "#" + exphash
        }
        return false
    };
    var expandedHash = "expanded";
    var set_expanded_hash = function(full) {
        if (utils.need_new_window(config)) {
            return
        }
        var urlele = window.location.href.split("#");
        if (!full) {
            if (urlele.length <= 1) {
                return
            }
            var hv = urlele[1].replace(expandedHash, "").replace(/expand\d+/g, "");
            window.location.href = urlele[0] + "#" + hv;
            return
        } else {
            if (urlele.length == 1) {
                window.location.href = urlele[0] + "#" + expandedHash;
                return
            }
            urlele[1] = urlele[1].replace("expanded", "").replace(expandedHash, "").replace(/expand\d+/g, "");
            window.location.href = urlele[0] + "#" + urlele[1] + expandedHash;
            return
        }
    };
    var hashEventResetTimer = 0;
    var get_url_with_image_hash = function(position) {
        var urlele = window.location.href.split("#");
        var addhash = "";
        if (urlele.length == 2 && urlele[1].indexOf(expandedHash) > -1) {
            addhash = expandedHash
        }
        return urlele[0] + "#" + (parseInt(position) + 1) + addhash
    };
    var set_image_hash_value = function(position) {
        if (!config.enabledirectlinks) {
            return
        }
        var urlele = window.location.href.split("#");
        if (urlele.length >= 2 && position === parseInt(urlele[1]) - 1) {
            return
        }
        $(window).unbind("hashchange");
        window.location.href = get_url_with_image_hash(position);
        if (hashEventResetTimer) {
            window.clearTimeout(hashEventResetTimer)
        }
        hashEventResetTimer = window.setTimeout(function() {
            hashEventResetTimer = 0;
            set_hash_changed_event()
        }, 100)
    };
    var set_image_nav = function() {
        if (!image_showed && config.imagenavposition.toUpperCase() === "IMAGE") {
            return
        }
        var alwaysHide = (!config.showimagenav || config.showimageoverlay.toUpperCase() === "NEVER") ? true : false;
        if (!can_image_move()) {
            _(".jb-classifier-detail-area .jbn-left-button").hide();
            if (!utils.is_large_screen_mode(config)) {
                window.setTimeout(function() {
                    _(".jb-classifier-detail-area .jbn-left-button").hide()
                }, 50)
            }
            _(".jb-classifier-detail-area .jbn-nav-left-touch-area").addClass("dt-nav-disabled");
            _(".jb-bb-button.jb-bb-btn-top-nav.jb-bb-btn-top-nav-left").css({
                opacity: 0.5
            })
        } else {
            if (!alwaysHide) {
                _(".jb-classifier-detail-area .jbn-left-button").show().css({
                    opacity: 1
                })
            }
            _(".jb-classifier-detail-area .jbn-nav-left-touch-area").removeClass("dt-nav-disabled");
            _(".jb-bb-button.jb-bb-btn-top-nav.jb-bb-btn-top-nav-left").css({
                opacity: 1
            })
        }
        if (!can_image_move(true)) {
            _(" .jb-classifier-detail-area .jbn-right-button").hide();
            if (!utils.is_large_screen_mode(config)) {
                window.setTimeout(function() {
                    _(".jb-classifier-detail-area .jbn-right-button").hide()
                }, 50)
            }
            _(".jb-classifier-detail-area .jbn-nav-right-touch-area").addClass("dt-nav-disabled");
            _(".jb-bb-button.jb-bb-btn-top-nav.jb-bb-btn-top-nav-right").css({
                opacity: 0.5
            })
        } else {
            if (!alwaysHide) {
                _(" .jb-classifier-detail-area .jbn-right-button").show().css({
                    opacity: 1
                })
            }
            _(".jb-classifier-detail-area .jbn-nav-right-touch-area").removeClass("dt-nav-disabled");
            _(".jb-bb-button.jb-bb-btn-top-nav.jb-bb-btn-top-nav-right").css({
                opacity: 1
            })
        }
    };
    var set_gallery_title = function() {
        if (utils.is_large_screen_mode(config)) {
            index_panel.display_gallery_top(false);
            if (config.gallerytitle) {
                var showimageoverlay = config.showimageoverlay.toUpperCase();
                var galleryTitlePosition = config.gallerytitleposition.toUpperCase();
                if (config.textcolor) {
                    _(".jb-area-large-mode-title").css({
                        color: utils.format_color(config.textcolor)
                    })
                }
                if (config.textshadowcolor) {
                    _(".jb-area-large-mode-title").css({
                        "text-shadow": utils.get_text_shadow_style(config.textshadowcolor, config.textshadowcolora, true)
                    })
                }
                if (galleryTitlePosition == "TOP") {
                    _(".jb-area-large-mode-title").html(config.gallerytitle).show()
                } else {
                    if (galleryTitlePosition === "ABOVE_THUMBS") {
                        if (is_index_visible) {
                            _(".jb-area-large-mode-title").html(config.gallerytitle).css({
                                height: "auto",
                                overflow: "visible",
                                "white-space": "normal"
                            }).removeClass("jb-classifier-show-on-over").show()
                        } else {
                            _(".jb-area-large-mode-title").hide()
                        }
                    } else {
                        if (showimageoverlay === "NEVER") {
                            _(".jb-area-large-mode-title.jb-classifier-show-on-over").html(config.gallerytitle).hide()
                        } else {
                            if (overlay_visible || showimageoverlay === "ALWAYS") {
                                _(".jb-area-large-mode-title.jb-classifier-show-on-over").html(config.gallerytitle).show()
                            }
                        }
                    }
                }
            }
        } else {
            _(".jb-area-large-mode-title").remove();
            if (is_index_visible) {
                index_panel.display_gallery_top(is_index_visible)
            }
        }
    };
    var need_jump_2_page = function(position) {
        if (!utils.is_swipable_device() || !in_the_transitioning) {
            return false
        }
        var cntSize = sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
        index_panel.show_page_4_image_position(position, cntSize.index_panel_width, cntSize.index_panel_height);
        return true
    };
    var before_show_main_image = function(position) {
        index_panel.set_thumbnail_visited(position);
        if (is_index_visible && (!autoplay_timer || config.autoplaythumbs)) {
            var idxRange = index_panel.get_image_index_range();
            var rangeSize = idxRange.to - idxRange.from + 1;
            if (position < idxRange.from - rangeSize) {
                return
            }
            if (position > idxRange.to + rangeSize) {
                return
            }
            if (position < idxRange.from && position === 0) {
                if (!need_jump_2_page(position)) {
                    index_panel.move_to_next_page()
                }
            } else {
                if (position > idxRange.to) {
                    if (!need_jump_2_page(position)) {
                        index_panel.move_to_next_page()
                    }
                } else {
                    if (position < idxRange.from) {
                        if (!need_jump_2_page(position)) {
                            index_panel.move_to_prev_page()
                        }
                    }
                }
            }
        }
    };
    var after_show_main_image = function(position, fromHashEvent) {
        is_switching_image = false;
        set_gallery_title();
        if (!fromHashEvent || window.location.href.split("#").length < 2 || !window.location.href.split("#")[1]) {
            set_image_hash_value(position)
        }
        var imgrange = index_panel.get_image_index_range();
        if (imgrange.from > position || imgrange.to < position) {
            show_thumbnails(position)
        }
        apply_show_options();
        set_caption_height_mode();
        set_image_nav();
        set_show_list_button();
        if (utils.is_swipable_device() && overlay_visible) {
            show_hide_nav_controls(overlay_visible)
        }
        if (config_manager.isp && juicebox_instances[instance_id] && typeof(juicebox_instances[instance_id].onImageChange) === "function") {
            needImageEventOnFirstLoad = false;
            var curntImage = detail_panel.get_current_photo();
            var curntImgIdxNo = parseInt(curntImage.position) + 1;
            var evntObj = {
                id: curntImgIdxNo,
                title: config.gallerytitle,
                caption: curntImage.caption
            };
            if (curntImgIdxNo != lastImageEventIndex) {
                lastImageEventIndex = curntImgIdxNo;
                juicebox_instances[instance_id].onImageChange(evntObj)
            }
        }
        handle_image_preload();
        if (utils.is_chrome()) {
            _(" *").disableSelection()
        } else {
            _(".jb-dt-main-image-" + position + " img").disableSelection();
            _(".table_page_" + index_panel.get_index() + " img").disableSelection();
            if ($.browser.mozilla) {
                _(".jb-navigation.jb-classifier-detail-area *").disableSelection()
            }
        }
        if (!utils.is_swipable_device() && image_showed) {
            var cappos = config.captionposition.toUpperCase();
            if (cappos != "NONE" && cappos != "BELOW_IMAGE" && cappos != "BOTTOM" && cappos != "BELOW_THUMBS") {
                set_overlay(overlay_visible, 0)
            }
        }
        if ($.browser.msie && $.browser.version >= 8 && config.firstimageindex > 0) {
            index_panel.set_thumbnail_visited(position);
            window.setTimeout(function() {
                index_panel.set_thumbnail_visited(position)
            }, 200)
        }
    };
    var is_caption_visible = function() {
        var cappos = config.captionposition.toUpperCase();
        if (cappos === "NONE") {
            return false
        }
        if (cappos === "BELOW_IMAGE" || cappos === "BOTTOM" || cappos === "BELOW_THUMBS") {
            return true
        }
        set_overlay_visible(overlay_visible);
        return overlay_visible
    };
    var needImageEventOnFirstLoad = true;
    var lastImageEventIndex = -1;
    var show_main_image = function(position, delay, isfirstimage, fromHashEvent) {
        in_the_transitioning = false;
        in_navigation = false;
        if (transTimer) {
            window.clearTimeout(transTimer);
            transTimer = 0
        }
        if (!delay && $.browser.msie) {
            window.setTimeout(function() {
                index_panel.set_thumbnail_visited(position)
            }, 100)
        } else {
            index_panel.set_thumbnail_visited(position)
        }
        if (isfirstimage) {
            detail_panel.populate_photo_html(position, delay, function() {
                after_show_main_image(position, needImageEventOnFirstLoad);
                needImageEventOnFirstLoad = false
            }, is_caption_visible());
            return
        }
        if (delay) {
            is_switching_image = true;
            detail_panel.change_2_photo(false, 0, is_caption_visible(), position)
        } else {
            detail_panel.populate_photo_html(position, 0, null, is_caption_visible());
            after_show_main_image(position, fromHashEvent)
        }
        needImageEventOnFirstLoad = false
    };
    var handle_image_preload = function() {
        var range;
        var preldopt = config.imagepreloading.toUpperCase();
        if (preldopt === "NEXT" || preldopt === "NONE") {
            return
        }
        if (preldopt === "ALL") {
            range = {
                from: 0,
                to: gallery_manager.length() - 1
            }
        } else {
            range = index_panel.get_image_index_range()
        }
        if (flickr_loader) {
            flickr_loader.load_flickr_images_detail(gallery_manager.get_images(), range, update_flickr_image_details)
        }
        if (utils.is_large_screen_mode(config)) {
            detail_panel.preload_images(range.from, range.to + 1)
        }
    };
    var set_touch_component_height = function(height) {
        var size = sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
        set_touch_component_size(size.detail_panel_top, size.detail_panel_left, size.detail_panel_width, height)
    };
    var set_touch_component_size = function(top, left, width, height) {
        _(".jb-navigation.jb-classifier-detail-area").css({
            top: top,
            left: left,
            width: width,
            height: height
        })
    };
    var switch_2_main_image = function(position) {
        if (autoplay_timer) {
            toggle_autoplay()
        }
        if (is_index_visible && is_detail_visible) {
            show_main_image(position, image_change_speed);
            return
        }
        is_detail_visible = true;
        is_index_visible = false;
        if (_(".jb-panel-index").is(":visible")) {
            switching_2_thumbnail = false;
            var navpnl = _(".jb-panel-index img");
            if (!navpnl.length) {
                _(".jb-classifier-thumb-area").hide();
                _(".jb-classifier-detail-area, .jb-area-caption").show();
                show_main_image(position)
            } else {
                var transitionTime = 1000 * config.imagetransitiontime;
                navpnl.stop();
                navpnl.fadeOut(transitionTime, function() {});
                window.setTimeout(function() {
                    _(".jb-classifier-thumb-area").hide();
                    var dtpnl = _(".jb-classifier-detail-area, .jb-area-caption");
                    dtpnl.stop();
                    _(".jb-area-caption").html("");
                    if (utils.is_firefox3()) {
                        dtpnl.css({
                            opacity: 1,
                            display: "none"
                        })
                    }
                    dtpnl.children(".jb-dt-main-frame").remove();
                    dtpnl.fadeIn(transitionTime, function() {});
                    window.setTimeout(function() {
                        show_main_image(position, transitionTime)
                    }, 20)
                }, transitionTime > 50 ? transitionTime - 50 : transitionTime)
            }
        } else {
            show_main_image(position)
        }
    };
    var set_show_list_button = function() {
        var slb = _(".jb-bb-btn-de-show-list");
        if (utils.is_large_screen_mode(config)) {
            if (is_index_visible) {
                slb.attr("title", config.languagelistall.htlsm)
            } else {
                slb.attr("title", config.languagelistall.stlsm)
            }
        } else {
            slb.attr("title", config.languagelistall.st);
            if (!is_index_visible) {
                slb.show()
            } else {
                slb.hide();
                if (_(".jb-bb-bar>div:visible").length <= 0) {
                    _(".jb-bb-bar").hide()
                }
            }
            if (is_detail_visible) {
                index_panel.display_gallery_top(false);
                _(".jb-classifier-link-wrapper.jb-classifier-detail-area").show()
            } else {
                _(".jb-classifier-link-wrapper.jb-classifier-detail-area").hide()
            }
        }
    };
    var set_caption_height_mode = function() {
        if (config_manager.isp || !is_detail_visible) {
            return
        }
        var isHigh = true;
        if (is_index_visible && config.captionposition.toUpperCase() !== "BOTTOM" && config.captionposition.toUpperCase() !== "BELOW_THUMBS") {
            isHigh = false
        }
        detail_panel.set_caption_height_mode(isHigh)
    };
    var repaint_timer = 0;
    var repaint = function(force, ignoreIndexPnl, noresize, donotAdjustHeight) {
        sizing.try_set_body_size(config, fullScreenPersistor.is_full_screen || is_full_screen_mode);
        var _current_height = noresize ? current_height : get_gallery_height(donotAdjustHeight);
        var _current_width = noresize ? current_width : get_gallery_width();
        var win = $(window);
        if (!sizing.force_height_calculation(config) && (config.galleryheight + "").indexOf("%") > 0) {
            $("#" + config.containerid).height(_current_height)
        }
        if ($("#jb-glry-dlg:visible").length > 0 && _("").parent().attr("id") != "jb-glry-dlg") {
            return
        }
        if (right_button_offset == null) {
            right_button_offset = _(".jbn-right-button").width() + parseInt(_(".jbn-right-button").css("margin-right"))
        }
        if (force || ((current_width != _current_width || current_height != _current_height))) {
            current_width = _current_width;
            current_height = _current_height;
            if (fullScreenPersistor.is_full_screen) {
                _("").css({
                    width: _current_width,
                    height: _current_height
                })
            } else {
                if (sizing.force_height_calculation(config)) {
                    _("").css({
                        height: _current_height
                    })
                }
                if (sizing.force_width_calculation(config)) {
                    _("").css({
                        width: _current_width
                    })
                }
            }
            setup_layout(_current_width, _current_height, is_detail_visible);
            var cntSize = sizing.get_containers_size_and_position(_current_width, _current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
            positioning.set_containers_size_and_position(cntSize);
            if (is_detail_visible) {
                var wrappersel = (utils.is_swipable_device() || config.buttonbarposition.toUpperCase() === "OVERLAY_IMAGE") ? ":not(.jb-classifier-link-wrapper)" : "";
                var mainselstr = (overlay_visible && utils.is_swipable_device()) ? ".jb-classifier-detail-area" + wrappersel + ", .jb-area-caption" : ".jb-classifier-detail-area" + wrappersel;
                if (utils.is_earlier_ie()) {
                    _(mainselstr).fadeIn(100);
                    var imgs = _(".jb-panel-detail img");
                    imgs.fadeIn(100);
                    _(".jb-panel-detail").fadeIn(100)
                } else {
                    _(mainselstr).css("opacity", 1).show();
                    var imgs = _(".jb-panel-detail img");
                    imgs.css("opacity", 1).show();
                    _(".jb-panel-detail").css("opacity", 1)
                }
                if (_(".jb-panel-detail").html()) {
                    detail_panel.repaint(cntSize.detail_panel_width, cntSize.detail_panel_height)
                } else {
                    show_main_image(detail_panel.get_photo_position(), 0, false, true)
                }
                _(".jb-area-caption").css("max-height", config.maxcaptionheight > cntSize.detail_panel_height ? cntSize.detail_panel_height : config.maxcaptionheight)
            } else {
                detail_panel.repaint(cntSize.detail_panel_width, cntSize.detail_panel_height);
                _(".jb-classifier-detail-area, .jb-area-caption, .jb-classifier-link-wrapper.jb-classifier-detail-area").hide()
            }
            if (is_index_visible && !ignoreIndexPnl) {
                _(".jb-classifier-thumb-area").show();
                _(".jb-panel-index").show();
                var imgpos = detail_panel.get_photo_position();
                index_panel.show_page_4_image_position(imgpos, cntSize.index_panel_width, cntSize.index_panel_height, true)
            } else {
                _(".jb-panel-index").hide()
            }
            positioning.set_nav_btn_position(cntSize);
            positioning.set_index_nav_button_position(cntSize);
            set_show_list_button();
            index_panel.set_thumbnail_visited(detail_panel.get_photo_position());
            set_caption_height_mode();
            positioning.adjust_title_button_bar_position(cntSize)
        }
        if (!donotAdjustHeight) {
            if (fullScreenPersistor.is_full_screen) {
                if (utils.is_android()) {
                    hide_android_url_bar()
                } else {
                    if (utils.is_chrome() || utils.is_ipad()) {
                        if (repaint_timer) {
                            window.clearTimeout(repaint_timer);
                            repaint_timer = 0
                        }
                        repaint_timer = window.setTimeout(function() {
                            var ofst = _("").offset();
                            var bd = $("body");
                            bd.css("overflow", "scroll");
                            window.scrollTo(ofst.left, ofst.top);
                            bd.css("overflow", "hidden")
                        }, 100)
                    } else {
                        if (!$.browser.msie) {
                            var offset = _("").offset();
                            if (offset) {
                                window.scrollTo(offset.left, offset.top)
                            }
                        }
                    }
                }
            } else {
                if (is_full_screen_mode) {
                    if (utils.is_iphone()) {
                        window.scrollTo(0, 1);
                        if (repaint_timer) {
                            window.clearTimeout(repaint_timer);
                            repaint_timer = 0
                        }
                        repaint_timer = window.setTimeout(function() {
                            window.scrollTo(0, 1)
                        }, 1000)
                    } else {
                        if (utils.is_android() && !noresize) {
                            hide_android_url_bar()
                        }
                    }
                }
            }
        }
        set_background_image_size()
    };
    var hide_url_bar = function() {
        if (utils.is_iphone()) {
            window.scrollTo(0, 1)
        } else {
            if (utils.is_small_android()) {
                hide_android_url_bar()
            }
        }
    };
    var urlHidingTimer = 0;
    var hide_android_url_bar = function() {
        var win = $(window);
        var aver = utils.get_android_ver();
        var addht = sizing.get_android_additional_height(aver, win.width(), win.height());
        if (addht === 0 && aver < 4) {
            return
        }
        if (aver < 3.1) {
            $("body").css("overflow", "auto").height(get_gallery_height() + 60)
        }
        if (addht) {
            window.scrollTo(0, 1)
        }
        window.setTimeout(function() {
            if (addht) {
                window.scrollTo(0, 1)
            }
            if (aver >= 4 && (fullScreenPersistor.is_full_screen || is_full_screen_mode) && current_height > $(window).height() + 3) {
                if (urlHidingTimer) {
                    window.clearTimeout(urlHidingTimer)
                }
                urlHidingTimer = window.setTimeout(function() {
                    repaint(true, false, false, true)
                }, 500)
            }
        }, 200)
    };
    if (config.css != null) {
        document.write("<style id='" + document_id + "_style'>" + config.css.trim().replace(/\}\s/g, "} #" + document_id + " ").replace(/^/, "#" + document_id + " ") + "</style>");
        init()
    } else {
        init()
    }
    var next_page = function(delta_x) {
        if (!can_page_move(true)) {
            return false
        }
        index_panel.move_to_next_page(0, set_index_nav_button);
        handle_image_preload();
        return false
    };
    var previous_page = function(delta_x) {
        if (!can_page_move(false)) {
            return false
        }
        index_panel.move_to_prev_page(0, set_index_nav_button);
        handle_image_preload();
        return false
    };
    var next_image = function(delta_x) {
        if (!can_image_move(true)) {
            return false
        }
        detail_panel.move_2_next_photo(delta_x, ((config.captionposition.toUpperCase() === "BELOW_THUMBS" && !is_index_visible) ? false : overlay_visible));
        return false
    };
    var previous_image = function(delta_x) {
        if (!can_image_move(false)) {
            return false
        }
        detail_panel.move_2_previous_photo(delta_x, ((config.captionposition.toUpperCase() === "BELOW_THUMBS" && !is_index_visible) ? false : overlay_visible));
        return false
    };
    var open_url = function() {
        var curntImage = detail_panel.get_current_photo();
        if (config.useflickr) {
            if (curntImage.imageFullURL) {
                window.open(curntImage.imageFullURL);
                return false
            }
        }
        var targetUrl = curntImage.linkURL ? curntImage.linkURL : curntImage.imageURL;
        var linkTarget = curntImage.linkTarget ? curntImage.linkTarget.toLowerCase() : "";
        if (linkTarget === "_self") {
            window.location.href = targetUrl
        } else {
            window.open(targetUrl, linkTarget)
        }
        return false
    };
    var get_current_gallery_html = function() {
        var glrhtml = _("").html();
        _("").html("").hide();
        return glrhtml
    };
    var scroll_bar_compensition = function() {
        var scroll = utils.is_page_scrolling();
        return {
            h: scroll.v_scrolling ? 21 : 0,
            v: scroll.h_scrolling ? 21 : 0
        }
    };
    var is_doing_event = false;
    var full_screen = function() {
        if (navigator.userAgent.match(/Safari/i)) {
            if (is_doing_event) {
                return false
            }
            window.setTimeout(function() {
                toggle_full_screen()
            }, 100);
            window.setTimeout(function() {
                is_doing_event = false
            }, 200);
            is_doing_event = true
        } else {
            return toggle_full_screen()
        }
        return false
    };
    var toggle_full_screen = function() {
        if (!fullScreenPersistor.is_full_screen) {
            if (utils.is_new_expanded_window()) {
                window.history.back();
                return false
            }
            set_expanded_hash(true);
            isHiding = true;
            if (!(config.usefullscreenexpand && utils.exit_support_real_fullscreen() && !utils.is_in_iframe()) && utils.need_new_window(config)) {
                var savedconfig;
                if ($.browser.msie && $.browser.version < 8 && $.browser.version >= 7) {
                    savedconfig = {
                        configurl: utils.convert_to_absolute_path(correct_path(config.configurl)),
                        themeurl: utils.convert_to_absolute_path(config.themeurl),
                        hide_thumbnails_in_lsm: hide_thumbnails_in_lsm,
                        backgroundurl: utils.convert_to_absolute_path(correct_path(config.backgroundurl)),
                        firstimageindex: detail_panel.get_current_photo() ? detail_panel.get_current_photo().position + 1 : 0,
                        baseurl: utils.convert_to_absolute_path(config.baseurl)
                    }
                } else {
                    if (need_show_splash_page()) {
                        is_detail_visible = true;
                        is_index_visible = false
                    }
                    savedconfig = {
                        showsplashpage: "NEVER",
                        configurl: utils.convert_to_absolute_path(correct_path(config.configurl)),
                        themeurl: utils.convert_to_absolute_path(config.themeurl),
                        baseurl: utils.convert_to_absolute_path(config.baseurl),
                        backbuttonurl: utils.convert_to_absolute_path(config.backbuttonurl),
                        audiourlmp3: utils.convert_to_absolute_path(config.audiourlmp3),
                        audiourlogg: utils.convert_to_absolute_path(config.audiourlogg),
                        backgroundurl: utils.convert_to_absolute_path(correct_path(config.backgroundurl)),
                        firstimageindex: detail_panel.get_current_photo() ? detail_panel.get_current_photo().position + 1 : 0,
                        hide_thumbnails_in_lsm: hide_thumbnails_in_lsm,
                        is_detail_visible: is_detail_visible,
                        is_index_visible: is_index_visible,
                        maxthumbcolumns: config.maxthumbcolumns,
                        maxthumbrows: config.maxthumbrows,
                        languagelist: config.languagelistbak,
                        pageTitle: config.gallerytitle ? config.gallerytitle : $("head > title").text()
                    }
                }
                config_manager.get_cookie_manager().saveConfig({
                    skip: "gallerywidth,galleryheight,containerid,enabledirectlinks,usefullscreenexpand,expandinnewpage,languagelistall,splashbuttontext,splashtitle,splashimageurl,splashshowimagecount,gallerydescription,thumb_load_placeholder,main_load_placeholder",
                    config: savedconfig
                });
                if (audio_playing) {
                    toggle_audio_play()
                }
                document.location.href = utils.get_js_folder_url() + "full.html";
                return false
            }
            var vpc = utils.get_viewport_meta_content();
            utils.set_viewport_meta(true);
            if (config_manager.isp && juicebox_instances[instance_id] && typeof(juicebox_instances[instance_id].onExpand) === "function") {
                juicebox_instances[instance_id].onExpand(true)
            }
            var param = $.extend({}, config);
            param.containerid = dialog.get_id();
            param.parent_gallery = juicebox_instances[instance_id];
            param.gallerywidth = "100%";
            param.galleryheight = "100%";
            param.fullscreen_displaying_mode = true;
            param.parent_gallery = juicebox_instances[instance_id];
            param.initial_body_css_inline_style = $("body").attr("style");
            param.scroll_position = {};
            param.scroll_position.scrollTop = $(window).scrollTop();
            param.scroll_position.scrollLeft = $(window).scrollLeft();
            if ($.browser.msie) {
                window.scroll(0, 0)
            }
            param.persistor_param = {};
            param.persistor_param.viewportContent = vpc;
            var win = $(window);
            var isLSM = utils.is_large_screen_mode(config);
            param.persistor_param.max_side_length = Math.max(win.width(), win.height());
            param.persistor_param.restore_viewport = function(vpv, scalable) {
                utils.set_viewport_value(vpv, scalable)
            };
            param.persistor_param.is_index_visible = splash_is_set() ? false : is_index_visible;
            param.persistor_param.is_detail_visible = splash_is_set() ? true : is_detail_visible;
            param.persistor_param.current_image_index = detail_panel.get_photo_position();
            param.persistor_param.restore_image = function(imgIdx) {
                lastImageEventIndex = imgIdx + 1;
                if (isLSM) {
                    show_main_image(imgIdx)
                } else {
                    switch_2_main_image(imgIdx)
                }
            };
            param.persistor_param.restore_index = (isLSM ? show_thumbnails : switch_2_thumbnails);
            param.persistor_param.splash_is_set = splash_is_set;
            param.persistor_param.background_image_width = backgroundImageWidth;
            param.persistor_param.background_image_height = backgroundImageHeight;
            param.persistor_param.gallery_manager = gallery_manager;
            param.persistor_param.hide_thumbnails_in_lsm = hide_thumbnails_in_lsm;
            param.persistor_param.last_image_event_index = lastImageEventIndex;
            param.persistor_param.overlay_visible = overlay_visible;
            if (audioPlayer) {
                param.persistor_param.is_audio_playing = audio_playing;
                param.persistor_param.parent_toggle_audio_play = toggle_audio_play
            }
            if (autoplay_timer) {
                toggle_autoplay(false, true);
                param.persistor_param.is_autoplaying = true
            }
            param.persistor_param.restore_autoplay = function() {
                toggle_autoplay(false, true)
            };
            if (!(utils.is_swipable_device() || config.forcetouchmode || config.showinfobutton)) {
                overlay_visible = false;
                set_overlay(overlay_visible, 0)
            }
            $("body").css({
                overflow: "hidden"
            });
            if (config.backgroundopacity === 1 || config.backgroundopacity === "1" || (typeof(config.backgroundopacity) === "string" && config.backgroundopacity.indexOf("filter") === 0 && config.backgroundopacity.indexOf("100") > 0)) {
                dialog.show_dialog(true)
            } else {
                param.persistor_param.restore_zindex = function() {
                    _("").show();
                    _("").focus()
                };
                _("").hide();
                dialog.show_dialog(false)
            }
            extended_gallery = new juicebox(param);
            var eledlg = document.getElementById("jb-glry-dlg");
            if (config.usefullscreenexpand) {
                utils.show_real_fullscreen("jb-glry-dlg")
            }
        } else {
            var win = $(window);
            set_expanded_hash(false);
            if (utils.need_viewport_meta()) {
                if (fullScreenPersistor.parent_gallery_param.viewportContent) {
                    utils.set_viewport_meta_content(fullScreenPersistor.parent_gallery_param.viewportContent)
                } else {
                    if (utils.is_android() && utils.get_android_ver() >= 4) {
                        fullScreenPersistor.parent_gallery_param.restore_viewport(320, true)
                    } else {
                        if (utils.is_iphone()) {
                            fullScreenPersistor.parent_gallery_param.restore_viewport(0.4, true)
                        } else {
                            if (utils.is_ipad()) {} else {
                                fullScreenPersistor.parent_gallery_param.restore_viewport(160 * fullScreenPersistor.parent_gallery_param.max_side_length / Math.max(win.width(), win.height()), true)
                            }
                        }
                    }
                }
            }
            if (!fullScreenPersistor.parent_gallery_param.splash_is_set()) {
                var curntImgIdx = detail_panel.get_photo_position();
                if (is_detail_visible) {
                    fullScreenPersistor.parent_gallery_param.restore_image(curntImgIdx)
                }
                if (is_index_visible) {
                    fullScreenPersistor.parent_gallery_param.restore_index(curntImgIdx)
                }
            }
            window.setTimeout(function() {
                $("body").css({
                    overflow: "auto"
                });
                window.setTimeout(function() {
                    $("body").attr("style", fullScreenPersistor.initial_body_css_inline_style);
                    window.setTimeout(function() {
                        window.scroll(fullScreenPersistor.scroll_position.scrollLeft, fullScreenPersistor.scroll_position.scrollTop)
                    }, 100)
                }, 100)
            }, 100);
            if (fullScreenPersistor.parent_gallery_param.restore_zindex) {
                fullScreenPersistor.parent_gallery_param.restore_zindex()
            }
            var cleanupDialog = function() {
                dialog.cleanup_dialog();
                $(window).unbind("resize", windowResize);
                if (!splash_is_set()) {
                    fullScreenPersistor.parent_gallery.restore(hide_thumbnails_in_lsm, overlay_visible)
                }
            };
            if (config.usefullscreenexpand) {
                utils.exit_fullscreen();
                if (navigator.userAgent.match(/Safari/i) && navigator.userAgent.match(/Mac OS/i)) {
                    window.setTimeout(function() {
                        if (autoplay_timer) {
                            toggle_autoplay(false, true);
                            fullScreenPersistor.parent_gallery_param.restore_autoplay()
                        }
                        cleanupDialog()
                    }, 50);
                    return false
                }
            }
            if (autoplay_timer) {
                toggle_autoplay(false, true);
                fullScreenPersistor.parent_gallery_param.restore_autoplay()
            }
            cleanupDialog();
            isHiding = true;
            if (!splash_is_set()) {
                fullScreenPersistor.parent_gallery.sendMessage()
            }
        }
        return false
    };
    var positioning = {
        set_nav_btn_position: function(cntSize) {
            var naviconsz = parseInt(config.navbuttoniconrealsize);
            if (!naviconsz) {
                naviconsz = 18
            }
            var btnsz = utils.get_nav_btn_size(config);
            var btnszadj = btnsz / 2;
            if (config.imagenavposition.toUpperCase() != "IMAGE") {
                _(".jb-navigation.jb-classifier-detail-area .jbn-nav-button").css("top", (cntSize.detail_panel_height / 2 - btnszadj) + "px")
            }
            var thmbnavpos = config.thumbnavposition.toUpperCase();
            var topadj = (!cntSize.is_sideway_layout && config.gallerytitleposition.toUpperCase() === "ABOVE_THUMBS" && thmbnavpos != "BOTTOM" ? sizing.constTitleHeight4AboveThumbs : 0);
            if (utils.is_large_screen_mode(config)) {
                var thumbnavtop = index_panel.get_thumb_height() / 2 - btnszadj;
                var spos = index_panel.get_show_area_position();
                var stgpd = sizing.get_stage_padding(current_width, current_height, config);
                var cappos = config.captionposition.toUpperCase();
                if (thmbnavpos === "BOTTOM") {
                    var mintop = spos.top + index_panel.get_thumb_height();
                    if (cappos === "BELOW_THUMBS") {
                        thumbnavtop = mintop + parseInt((cntSize.caption_panel_top - (mintop) - naviconsz - config.thumbpadding) / 2)
                    } else {
                        thumbnavtop = mintop + sizing.padding_bottom_index_nav(config)
                    }
                    var dfttop = mintop + parseInt((cntSize.index_panel_height - index_panel.get_thumb_height()) / 2) - btnszadj;
                    if (thumbnavtop < mintop) {
                        thumbnavtop = mintop
                    }
                    if (thumbnavtop > dfttop) {
                        thumbnavtop = dfttop
                    }
                } else {
                    if (cntSize.is_sideway_layout) {
                        thumbnavtop = (current_height - cntSize.top_panel_height - 2 * stgpd - (cappos === "BOTTOM" ? cntSize.caption_panel_height : 0)) / 2 - btnszadj + (cappos === "BOTTOM" ? stgpd : 0);
                        var tmbvaln = config.thumbsvalign.toUpperCase();
                        if (tmbvaln === "TOP" || tmbvaln === "BOTTOM") {
                            thumbnavtop = spos.top + parseInt((index_panel.get_thumb_height() - btnsz + config.thumbpadding) / 2)
                        }
                    }
                }
                if (config.usethumbdots) {
                    var thmnavpos = config.thumbnavposition.toUpperCase();
                    if (config.showthumbpagingtext && thmnavpos === "BOTTOM") {
                        topadj += 10
                    }
                    if (thumbnavtop < 0) {
                        topadj += 7 + ((naviconsz <= 20) ? (22 - naviconsz) / 2 : 0)
                    }
                    if (!config_manager.isp) {
                        topadj += 11
                    }
                } else {}
                _(".jb-navigation.jb-classifier-thumb-area .jbn-nav-button").css("top", (thumbnavtop + topadj) + "px")
            } else {
                _(".jb-navigation.jb-classifier-thumb-area .jbn-nav-button").css("top", ((cntSize.index_panel_height / 2 - btnszadj) + topadj) + "px")
            }
        },
        adjust_title_button_bar_position: function(sizeinfo) {
            var galleryTitlePosition = config.gallerytitleposition.toUpperCase();
            var buttonbarPosition = config.buttonbarposition.toUpperCase();
            var stgpding = sizing.get_stage_padding(current_width, current_height, config);
            var ort = 10 + stgpding;
            var tp = config.thumbpadding;
            var cntSize = sizeinfo ? sizeinfo : sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
            var rt = ort;
            var lft = rt,
                rht = rt;
            var ttha = config.gallerytitlehalign.toUpperCase();
            var isleft = true;
            var topp = 0;
            if (ttha === "RIGHT") {
                isleft = false
            }
            topp = tp + cntSize.detail_panel_top;
            if (galleryTitlePosition === "TOP") {
                topp = tp + 1 + cntSize.top_panel_top
            } else {
                if (galleryTitlePosition === "ABOVE_THUMBS") {
                    var thumbsize = index_panel.get_show_area_position();
                    var titleHt = parseInt($(".jb-area-large-mode-title").css("font-size"));
                    if (cntSize.is_sideway_layout) {
                        topp = parseInt(thumbsize.top - titleHt - config.thumbpadding)
                    } else {
                        topp = parseInt((thumbsize.top - titleHt) / 2)
                    }
                    if (topp < 0) {
                        topp = 0
                    }
                    lft = thumbsize.left + config.thumbpadding;
                    rht = lft
                }
            }
            var tmbpos = config.thumbsposition.toUpperCase();
            var is4SideLayout = galleryTitlePosition === "ABOVE_THUMBS" && (tmbpos === "LEFT" || tmbpos === "RIGHT") ? true : false;
            var cssattrs;
            if (ttha === "CENTER") {
                if (is4SideLayout && galleryTitlePosition != "ABOVE_THUMBS") {
                    lft = stgpding - parseInt(_(".jb-area-large-mode-title").css("padding-left"));
                    if (galleryTitlePosition === "ABOVE_THUMBS" && tmbpos === "RIGHT") {
                        lft = cntSize.index_panel_left - config.thumbhseparation
                    }
                    rht = stgpding + (tmbpos === "RIGHT" ? 0 : cntSize.detail_panle_left)
                }
                if (is_index_visible) {
                    cssattrs = {
                        left: lft,
                        top: topp,
                        right: rht,
                        height: "auto",
                        "text-align": "center",
                        overflow: "visible",
                        "white-space": "normal",
                        "z-index": 200
                    }
                } else {
                    cssattrs = {
                        left: lft,
                        top: topp,
                        right: rht,
                        height: "auto",
                        "text-align": "center",
                        overflow: "hidden",
                        "white-space": "nowrap",
                        "z-index": 200
                    }
                }
            } else {
                if (isleft) {
                    if (is4SideLayout && tmbpos === "RIGHT" && galleryTitlePosition != "ABOVE_THUMBS") {
                        lft = cntSize.index_panel_left
                    }
                    if (is_index_visible) {
                        cssattrs = {
                            left: lft,
                            right: "auto",
                            height: "auto",
                            top: topp,
                            "text-align": "left",
                            overflow: "visible",
                            "white-space": "normal",
                            "z-index": 200
                        }
                    } else {
                        cssattrs = {
                            left: lft,
                            right: "auto",
                            height: "auto",
                            top: topp,
                            "text-align": "left",
                            overflow: "hidden",
                            "white-space": "nowrap",
                            "z-index": 200
                        }
                    }
                } else {
                    if (is4SideLayout && galleryTitlePosition != "ABOVE_THUMBS") {
                        if (tmbpos === "LEFT") {
                            rht += (current_width - cntSize.detail_panel_left)
                        } else {
                            rht -= 10
                        }
                    }
                    if (is_index_visible) {
                        cssattrs = {
                            left: "auto",
                            right: rht,
                            top: topp,
                            height: "auto",
                            "text-align": "right",
                            overflow: "visible",
                            "white-space": "normal",
                            "z-index": 200
                        }
                    } else {
                        cssattrs = {
                            left: "auto",
                            right: rht,
                            top: topp,
                            height: "auto",
                            "text-align": "right",
                            overflow: "hidden",
                            "white-space": "nowrap",
                            "z-index": 200
                        }
                    }
                }
            }
            _(".jb-area-large-mode-title").css(cssattrs);
            if (config.buttonbarposition.toUpperCase() != "OVERLAY_IMAGE") {
                var bbha = config.buttonbarhalign.toUpperCase();
                isleft = false;
                rt = ort;
                if (bbha === "CENTER") {
                    isleft = true;
                    var wd = get_button_width();
                    rt = parseInt((current_width - wd) / 2) - 10
                } else {
                    if (bbha === "LEFT") {
                        isleft = true;
                        rt -= 10
                    }
                }
                topp = tp + cntSize.detail_panel_top;
                if (buttonbarPosition === "TOP") {
                    topp = tp - 4 + cntSize.top_panel_top
                }
                if (isleft) {
                    if ($.browser.msie && $.browser.version < 8) {
                        var wd = get_button_width();
                        _(".jb-classifier-link-wrapper.jb-classifier-detail-area").css({
                            left: rt,
                            top: topp,
                            width: wd
                        })
                    } else {
                        _(".jb-classifier-link-wrapper.jb-classifier-detail-area").css({
                            left: rt,
                            top: topp
                        })
                    }
                } else {
                    _(".jb-classifier-link-wrapper.jb-classifier-detail-area").css({
                        right: rt,
                        top: topp
                    })
                }
            }
        },
        showComponentsOverlayImage: function(imagePosition, delay) {
            if (is_detail_visible) {
                image_showed = true
            }
            if (config.imagenavposition.toUpperCase() != "IMAGE" && config.buttonbarposition.toUpperCase() != "OVERLAY_IMAGE") {
                return
            }
            var cntSize = sizing.get_containers_size_and_position(current_width, current_height, is_index_visible, is_detail_visible, config_manager.isp, need_top_panel(), index_panel.get_thumb_height(), config);
            var dttop = cntSize.detail_panel_top;
            var spd = sizing.get_stage_padding(current_width, current_height, config);
            var ipd = 10;
            var top = imagePosition.top + (Math.min(imagePosition.parentHeight, imagePosition.height) / 2) - _(".jbn-nav-button").height() / 2 + config.framewidth;
            var lside = imagePosition.left + spd + ipd + config.framewidth;
            var rside = imagePosition.parentWidth - (imagePosition.left + imagePosition.width + config.framewidth) + spd + ipd;
            if (config.imagenavposition.toUpperCase() === "IMAGE") {
                var alwaysHide = (!config.showimagenav || config.showimageoverlay.toUpperCase() === "NEVER") ? true : false;
                _(".jb-classifier-detail-area .jbn-nav-left-touch-area .jbn-nav-button").css({
                    left: lside,
                    top: top
                });
                _(".jb-classifier-detail-area .jbn-nav-right-touch-area .jbn-nav-button").css({
                    right: rside,
                    top: top
                });
                if (can_image_move() && !alwaysHide) {
                    _(".jb-classifier-detail-area .jbn-left-button").fadeIn(delay)
                }
                if (can_image_move(true) && !alwaysHide) {
                    _(".jb-classifier-detail-area .jbn-right-button").fadeIn(delay)
                }
            }
            if (config.buttonbarposition.toUpperCase() === "OVERLAY_IMAGE") {
                var radiusadj = parseInt(config.imagecornerradius / 4);
                var btbtp = dttop + imagePosition.top + config.framewidth + ipd + radiusadj;
                var bbha = config.buttonbarhalign.toUpperCase();
                var wd = get_button_width();
                var needBothSide = false;
                if (imagePosition.width - wd < ipd) {
                    needBothSide = true
                }
                if (bbha === "LEFT") {
                    _(".jb-classifier-link-wrapper.jb-classifier-detail-area").css({
                        left: lside + radiusadj + cntSize.detail_panel_left - spd - 10,
                        top: btbtp,
                        width: needBothSide ? imagePosition.width - ipd : "auto"
                    })
                } else {
                    if (bbha === "CENTER") {
                        var wd = get_button_width();
                        rt = parseInt((imagePosition.width - wd) / 2 + imagePosition.left + spd + config.framewidth);
                        rt -= 10;
                        _(".jb-classifier-link-wrapper.jb-classifier-detail-area").css({
                            left: rt + cntSize.detail_panel_left - spd,
                            top: btbtp
                        })
                    } else {
                        _(".jb-classifier-link-wrapper.jb-classifier-detail-area").css({
                            right: rside + radiusadj + (config.thumbsposition.toUpperCase() === "RIGHT" ? (current_width - cntSize.index_panel_left) : 0),
                            top: btbtp,
                            width: needBothSide ? imagePosition.width - ipd : "auto"
                        })
                    }
                }
                if ((overlay_visible || config.showinfobutton) && is_detail_visible) {
                    _(".jb-classifier-link-wrapper.jb-classifier-detail-area, .jb-classifier-link-wrapper.jb-classifier-detail-area .jb-bb-bar").fadeIn(delay)
                }
            }
        },
        set_index_nav_button_position: function(cntSize) {
            var thumb_size = index_panel.get_thumblist_size();
            var navbtnsz = utils.get_nav_btn_size(config);
            var pd = parseInt(((cntSize.index_panel_width - thumb_size.width) / 2 - navbtnsz) - (navbtnsz / 3));
            if ((navbtnsz / 3) > 10 && pd < 5) {
                pd = 5
            }
            var idxposadj = cntSize.index_panel_width - thumb_size.width - 2 * navbtnsz;
            if (utils.is_large_screen_mode(config)) {
                if (config.thumbnavposition.toUpperCase() === "BOTTOM") {
                    pd = parseInt((cntSize.index_panel_width - thumb_size.width) / 2 + (config.thumbwidth - navbtnsz + config.thumbpadding) / 2);
                    if (parseInt(config.maxthumbcolumns) <= 1) {
                        pd -= parseInt(config.thumbwidth / 2 - 12)
                    }
                }
                if (config.thumbnavposition.toUpperCase() === "BOTTOM" && config.usethumbdots) {
                    if (config.maxthumbcolumns <= 4) {
                        pd -= 11
                    } else {
                        pd -= 3
                    }
                }
            }
            var tmbpos = config.thumbshalign.toUpperCase();
            var navbtnpd = 5;
            if (tmbpos === "LEFT") {
                _(".index-navigation .jbn-left-button").css("left", navbtnpd + "px");
                _(".index-navigation .jbn-right-button").css("right", (idxposadj - navbtnpd) + "px")
            } else {
                if (tmbpos === "RIGHT") {
                    _(".index-navigation .jbn-left-button").css("left", (idxposadj - navbtnpd) + "px");
                    _(".index-navigation .jbn-right-button").css("right", navbtnpd + "px")
                } else {
                    _(".index-navigation .jbn-left-button").css("left", (pd) + "px");
                    _(".index-navigation .jbn-right-button").css("right", (pd) + "px")
                }
            }
        },
        set_containers_size_and_position: function(expected_size) {
            var set_toucharea_height = function(position, size) {
                var halfht = size.detail_panel_height / 2 + parseInt(_(".jbn-right-button").height() / 2);
                var clnk = _(".jb-cap-frame.caption_" + position + " a");
                var cappos = config.captionposition.toUpperCase();
                var needReduce = cappos != "BOTTOM" && cappos != "NONE" && cappos != "BELOW_IMAGE" && cappos != "BELOW_THUMBS";
                set_touch_component_size(size.detail_panel_top, size.detail_panel_left, size.detail_panel_width, size.detail_panel_height - (!needReduce || clnk.length <= 0 ? 0 : (halfht > config.maxcaptionheight ? config.maxcaptionheight : halfht)))
            };
            var pos = detail_panel.get_current_photo().position;
            set_toucharea_height(pos, expected_size);
            _(".jb-panel-index").css({
                width: expected_size.index_panel_width,
                height: expected_size.index_panel_height,
                top: expected_size.index_panel_top,
                left: expected_size.index_panel_left
            });
            _(".jb-panel-detail").css({
                width: expected_size.detail_panel_width,
                height: expected_size.detail_panel_height,
                top: expected_size.detail_panel_top,
                left: expected_size.detail_panel_left
            });
            var cpppos = config.captionposition.toUpperCase();
            var caphover = !utils.is_earlier_ie() && (cpppos != "NONE" && cpppos != "BOTTOM" && cpppos != "BELOW_IMAGE" && cpppos != "BELOW_THUMBS");
            var captionArea = _(".jb-area-caption");
            var capHeight = expected_size.caption_panel_height;
            if (!($.browser.msie && $.browser.version <= 8) && (utils.is_large_screen_mode(config) && (hide_thumbnails_in_lsm || caphover) || !utils.is_large_screen_mode(config))) {
                capHeight = "100%"
            }
            var capTop = expected_size.caption_panel_top;
            if (cpppos === "BELOW_THUMBS") {
                capHeight = "auto"
            }
            captionArea.css({
                width: expected_size.caption_panel_width,
                height: capHeight,
                top: capTop,
                left: expected_size.caption_panel_left,
                bottom: expected_size.caption_panel_bottom
            });
            _(".jb-panel-top").css({
                width: expected_size.top_panel_width,
                height: expected_size.top_panel_height,
                top: expected_size.top_panel_top,
                left: expected_size.top_panel_left
            })
        },
        setSidePadding: function() {
            _(".jbn-nav-left-touch-area .jbn-nav-button").css({
                left: config.imagenavpadding
            });
            _(".jbn-nav-right-touch-area .jbn-nav-button").css({
                right: config.imagenavpadding
            })
        }
    };
    var debug_info = function(selMsgTag) {
        var win = $(window);
        var msg = "timestamp = " + ((new Date()).valueOf() + "").substring(9) + "<br/>isfullscreen = " + is_full_screen_mode + "<br/>r_h = " + sizing.get_initial_win_size(win.height(), win.width()) + "<br/>current_height = " + current_height + "<br/>current_width = " + current_width + "<br/>scrn.h = " + screen.height + "<br/>win.h = " + $(window).height() + "<br/>doc.h = " + $(document).height() + "<br/>bd.h = " + $("body").height() + "<br/>bd.w = " + $("body").width() + "<br/>scrn.w = " + screen.width + "<br/>win.w = " + $(window).width() + "<br/>doc.w = " + $(document).width() + "<br/>bd.w = " + $("body").width() + "<br/>glry.h = " + _("").height();
        _(".jb-navigation").html(msg).css({
            color: "white",
            "font-size": "20px"
        }).click(function() {
            window.location.href = window.location.href.replace(/#/g, "") + "?cw=" + current_width + "&ch=" + current_height;
            return false
        });
        if (!selMsgTag) {
            selMsgTag = "jb-debug-message"
        }
        $("#jb-debug-message").html(msg).show()
    };
    var debug_viewport_info = function(selMsgTag) {
        var win = $(window);
        var msg = "timestamp = " + ((new Date()).valueOf() + "").substring(9) + "<br/>viewport=" + $("#sv-meta").attr("content");
        _(".jb-navigation").html(msg).css({
            color: "white",
            "font-size": "20px"
        }).click(function() {
            window.location.href = window.location.href.replace(/#/g, "") + "?cw=" + current_width + "&ch=" + current_height;
            return false
        });
        if (!selMsgTag) {
            selMsgTag = "jb-debug-message"
        }
        $("#jb-debug-message").html(msg).show()
    };
    var debug_info2 = function(v1, v2, v3) {
        var win = $(window);
        _(".jb-navigation").html("timestamp = " + ((new Date()).valueOf() + "").substring(9) + "<br/>v1 = " + v1 + "<br/>v2 = " + v2 + "<br/>v3 = " + v3).css({
            color: "white",
            "font-size": "20px"
        })
    };
    var debug_message = function(msg) {
        _(".jb-navigation").html(msg + " @timestamp=" + ((new Date()).valueOf() + "").substring(9)).css({
            color: "white",
            "font-size": "20px"
        })
    };
    var basicMethods = {
        debug: function(script) {
            config.debugmode = true;
            eval(script)
        },
        sendMessage: function() {
            if (config_manager.isp && juicebox_instances[instance_id] && typeof(juicebox_instances[instance_id].onExpand) === "function") {
                juicebox_instances[instance_id].onExpand(false)
            }
        },
        restore: function(hideThumbs, isOverlayVisible) {
            isHiding = false;
            extended_gallery = null;
            if (splash_is_set()) {
                return
            }
            if (typeof(isOverlayVisible) != "undefined") {
                overlay_visible = isOverlayVisible;
                window.setTimeout(function() {
                    overlay_visible = isOverlayVisible;
                    show_hide_overlay(overlay_visible, 0);
                    show_hide_nav_controls(overlay_visible);
                    if (!is_detail_visible) {
                        _(".jb-area-caption").hide()
                    }
                    $('.jb-dt-main-frame[style*="opacity: 0.01"]').fadeIn()
                }, 100)
            }
            hide_thumbnails_in_lsm = !hideThumbs;
            toggle_index_panel_4_lsm(true)
        }
    };
    var proMethods = config_manager.isp ? {
        showGallery: function(show) {
            if (!show) {
                if (audio_playing) {
                    toggle_audio_play()
                }
                if (autoplay_timer) {
                    toggle_autoplay()
                }
            }
            show ? _("").show() : _("").hide()
        },
        setGallerySize: function(width, height) {
            if (fullScreenPersistor.is_full_screen) {
                return
            }
            var container = $("#" + config.containerid);
            if (container.length <= 0) {
                return
            }
            var w = parseInt(width) + "px";
            var h = parseInt(height) + "px";
            is_full_screen_mode = false;
            config.gallerywidth = w;
            config.galleryheight = h;
            container.css({
                height: h,
                width: w
            });
            _("").height(h);
            repaint(true)
        },
        showImage: function(index) {
            if (extended_gallery) {
                extended_gallery.showImageE(index);
                return
            }
            var glrylen = gallery_manager.length();
            index--;
            if (index < 0 || index >= glrylen) {
                return
            }
            show_main_image(index)
        },
        showNextImage: function() {
            if (extended_gallery) {
                extended_gallery.showNextImageE();
                return
            }
            next_image()
        },
        showPreviousImage: function() {
            if (extended_gallery) {
                extended_gallery.showPreviousImageE();
                return
            }
            previous_image()
        },
        showIndexByImage: function() {
            if (extended_gallery) {
                extended_gallery.showIndexByImageE();
                return
            }
            show_thumbnails()
        },
        toggleAutoPlay: function() {
            if (extended_gallery) {
                extended_gallery.toggleAutoPlayE();
                return
            }
            toggle_autoplay()
        },
        toggleThumbs: function() {
            if (extended_gallery) {
                extended_gallery.toggleThumbsE();
                return
            }
            index_button_clicked()
        },
        toggleAudio: function() {
            if (extended_gallery) {
                extended_gallery.toggleAudioE();
                return
            }
            toggle_audio_play()
        },
        toggleExpand: function() {
            if (extended_gallery) {
                extended_gallery.toggleExpandE();
                return
            }
            full_screen()
        },
        toggleOverlay: function() {
            config.showimageoverlay = "AUTO";
            overlay_visible = !overlay_visible;
            set_overlay(overlay_visible, 250)
        },
        openImageLink: function() {
            open_url()
        },
        showThumbPage: function(index) {
            index--;
            index_panel.show_page_by_page_index(index)
        },
        getImageInfo: function(index) {
            index--;
            var glrylen = gallery_manager.length();
            if (index < 0 || index >= glrylen) {
                return null
            }
            var img = gallery_manager.get_image(index);
            return {
                id: parseInt(img.position) + 1,
                imageURL: img.imageURL,
                thumbURL: img.thumbURL,
                caption: img.caption,
                title: img.title,
                linkURL: img.linkURL,
                linkTarget: img.linkTarget
            }
        },
        getImageCount: function() {
            return gallery_manager.length()
        },
        getThumbPageIndex: function() {
            return parseInt(index_panel.get_index()) + 1
        },
        getImageIndex: function() {
            return parseInt(detail_panel.get_current_photo().position) + 1
        }
    } : {};
    if (config_manager.isp && parent_gallery) {
        proMethods = {
            showImageE: function(index) {
                var glrylen = gallery_manager.length();
                index--;
                if (index < 0 || index >= glrylen) {
                    return
                }
                show_main_image(index)
            },
            showNextImageE: next_image,
            showPreviousImageE: previous_image,
            showIndexByImageE: show_thumbnails,
            toggleAutoPlayE: toggle_autoplay,
            toggleThumbsE: index_button_clicked,
            toggleAudioE: toggle_audio_play,
            toggleExpandE: full_screen
        }
    }
    juicebox_instances[instance_id] = $.extend(basicMethods, proMethods);
    return juicebox_instances[instance_id]
};