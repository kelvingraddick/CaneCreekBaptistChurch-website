var _____WB$wombat$assign$function_____ = function(name) {return (self._wb_wombat && self._wb_wombat.local_init && self._wb_wombat.local_init(name)) || self[name]; };
if (!self.__WB_pmw) { self.__WB_pmw = function(obj) { this.__WB_source = obj; return this; } }
{
  let window = _____WB$wombat$assign$function_____("window");
  let self = _____WB$wombat$assign$function_____("self");
  let document = _____WB$wombat$assign$function_____("document");
  let location = _____WB$wombat$assign$function_____("location");
  let top = _____WB$wombat$assign$function_____("top");
  let parent = _____WB$wombat$assign$function_____("parent");
  let frames = _____WB$wombat$assign$function_____("frames");
  let opener = _____WB$wombat$assign$function_____("opener");

(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);throw new Error("Cannot find module '"+o+"'")}var f=n[o]={exports:{}};t[o][0].call(f.exports,function(e){var n=t[o][1][e];return s(n?n:e)},f,f.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
(function() {
  var API, TT;

  TT = require('./tt-core');

  /**
  @class TT.api
  */


  API = (function() {
    function API() {}

    API.prototype._url = "https://web.archive.org/web/20160201224421/https://api.tictail.com";

    /**
    Access token of the store for which this app is installed in.
    
    @property accessToken
    */


    API.prototype.accessToken = null;

    /**
    Proxy to `$.ajax` with the `contentType` and `headers` set.
    
    @method ajax
    @param {Object} options The standard options that you would give `$.ajax`
    @return {Promise} A promise that will resolve if the request was successful or otherwise fail
    */


    API.prototype.ajax = function(options) {
      var defaults;
      defaults = {
        url: "" + this._url + "/" + options.endpoint,
        contentType: 'application/json',
        headers: {
          Authorization: "Bearer " + this.accessToken
        }
      };
      if ($.type(options.data) !== 'string') {
        options.data = JSON.stringify(options.data);
      }
      return $.ajax($.extend(true, defaults, options));
    };

    /**
    Shorthand for performing `GET` requests to the API.
    
    @method get
    @param {String} endpoint The endpoint to get
    @return {Promise} A promise that will resolve if the request was successful or otherwise fail
    */


    API.prototype.get = function(endpoint) {
      return this.ajax({
        endpoint: endpoint,
        type: 'GET'
      });
    };

    /**
    Shorthand for performing `POST` requests to the API.
    
    @method post
    @param {String} endpoint The endpoint to post against
    @param {Object} Object to serialize and send to the API as JSON
    @return {Promise} A promise that will resolve if the request was successful or otherwise fail
    */


    API.prototype.post = function(endpoint, data) {
      return this.ajax({
        endpoint: endpoint,
        data: data,
        type: 'POST'
      });
    };

    /**
    Shorthand for performing `PUT` requests to the API.
    
    @method put
    @param {String} endpoint The endpoint to put against
    @param {Object} Object to serialize and send to the API as JSON
    @return {Promise} A promise that will resolve if the request was successful or otherwise fail
    */


    API.prototype.put = function(endpoint, data) {
      return this.ajax({
        endpoint: endpoint,
        data: data,
        type: 'PUT'
      });
    };

    /**
    Shorthand for performing `DELETE` requests to the API.
    
    @method delete
    @param {String} endpoint The endpoint to delete against
    @return {Promise} A promise that will resolve if the request was successful or otherwise fail
    */


    API.prototype["delete"] = function(endpoint) {
      return this.ajax({
        endpoint: endpoint,
        type: 'DELETE'
      });
    };

    /**
    Shorthand for performing `PATCH` requests to the API.
    
    @method patch
    @param {String} endpoint The endpoint to patch against
    @param {Object} Object to serialize and send to the API as JSON
    @return {Promise} A promise that will resolve if the request was successful or otherwise fail
    */


    API.prototype.patch = function(endpoint, data) {
      return this.ajax({
        endpoint: endpoint,
        data: data,
        type: 'PATCH'
      });
    };

    return API;

  })();

  if (typeof define === 'function' && define.amd) {
    define('tt-api', ['jquery', 'tt-core'], function($, TT) {
      return TT.api = new API;
    });
  } else {
    TT.api = new API;
  }

}).call(this);

},{"./tt-core":2}],2:[function(require,module,exports){
/**
@class TT
*/


(function() {
  var TT, tt,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  TT = (function() {
    function TT() {
      this.noConflict = __bind(this.noConflict, this);
      this._TT = window.TT;
    }

    /**
     Reset the value of window.TT to what it was previously.
    
     @method noConflict
     @return {Object} A reference to the TT.js object.
    */


    TT.prototype.noConflict = function() {
      window.TT = this._TT;
      return this;
    };

    return TT;

  })();

  tt = new TT;

  if (typeof define === 'function' && define.amd) {
    define('tt-core', function() {
      return tt;
    });
  } else {
    window.TT = tt;
  }

  module.exports = tt;

}).call(this);

},{}],3:[function(require,module,exports){
(function() {
  var Native, TT,
    __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

  TT = require('./tt-core');

  /**
  @class TT.native
  */


  Native = (function() {
    Native.prototype.PARENT_ORIGIN = "https://web.archive.org/web/20160201224421/https://tictail.com";

    /**
    You should not need to use this access token when performing calls to the
    API using `TT.api`. However, it could be a good idea to save this access
    token if you plan to call the API at a later time, i.e. to push feed card
    items.
    
    @property accessToken
    */


    Native.prototype.accessToken = null;

    /**
    You should not need to use this store id when performing calls to the
    API using `TT.api`. See accessToken.
    
    @property storeId
    */


    Native.prototype.storeId = null;

    function Native() {
      this.createAndRequestPayment = __bind(this.createAndRequestPayment, this);
      this.createPurchaseToken = __bind(this.createPurchaseToken, this);
      this.requestPayment = __bind(this.requestPayment, this);
      this.performCard = __bind(this.performCard, this);
      this.reportSize = __bind(this.reportSize, this);
      this.loaded = __bind(this.loaded, this);
      this.loading = __bind(this.loading, this);
      this._events = $({});
      this._events.on("requestSize", this.reportSize);
      this._configurePostMessage();
    }

    Native.prototype._configurePostMessage = function() {
      var _this = this;
      return $(window).on("message", function(event) {
        var data, e;
        event = event.originalEvent;
        if (event.origin !== _this.PARENT_ORIGIN) {
          return;
        }
        try {
          data = JSON.parse(event.data);
        } catch (_error) {
          e = _error;
          return;
        }
        return _this._events.trigger(data.eventName, data.eventData);
      });
    };

    /**
    This method is the magic entry point to native apps, this method initializes
    tt.js by performing the handshake with the Tictail Dashboard and gives the
    methods inside `TT.api` access to talk to the API.
    
    @method init
    @return {Promise} A promise that will resolve when the handshake was successful.
    */


    Native.prototype.init = function() {
      var deferred,
        _this = this;
      deferred = $.Deferred();
      this._trigger("requestAccess");
      this._events.one("access", function(e, _arg) {
        var accessToken, store;
        accessToken = _arg.accessToken, store = _arg.store;
        _this.accessToken = accessToken;
        _this.storeId = store.id;
        if (TT.api != null) {
          TT.api.accessToken = _this.accessToken;
        }
        _this.loaded();
        return deferred.resolve();
      });
      this._events.one("error", function(event, _arg) {
        var message;
        message = _arg.message;
        _this.accessToken = null;
        if (TT.api != null) {
          TT.api.accessToken = _this.accessToken;
        }
        return deferred.reject(message);
      });
      return deferred;
    };

    /**
    Show a small loading spinner inside the Tictail Dashboard. This method
    is useful for providing feedback to the user if your app is doing something
    time consuming, i.e. fetching data over the network. Make sure to call
    `TT.native.loaded()` when your app has finished with its task at hand.
    
    @method loading
    */


    Native.prototype.loading = function() {
      return this._trigger("loading");
    };

    /**
    Dismisses the small loading spinner inside the Tictail Dashboard triggered
    by `TT.native.loading`.
    
    @method loaded
    */


    Native.prototype.loaded = function() {
      return this._trigger("loaded");
    };

    /**
    Reports the app size back to the Tictail Dashboard. Make sure to always
    call this method when the size of your app changes inside the DOM. This
    is used when your app is displayed inside the Tictail Feed. As your app
    is displayed inside an iframe we need to know the size of your app.
    
    @method reportSize
    */


    Native.prototype.reportSize = function() {
      var $el, height, width;
      $el = $("html");
      width = $el.outerWidth();
      height = $el.outerHeight();
      return this._trigger("reportSize", {
        width: width,
        height: height
      });
    };

    /**
    Marks the native card as performed in the Tictail Feed, closing it  and
    removing the card from the feed. Make sure to call this method once you
    decide that the user is done with your card.
    
    @method performCard
    */


    Native.prototype.performCard = function() {
      return this._trigger("perform");
    };

    /**
    Show the share dialog in the Tictail Dashboard. This share dialog is a
    way for your app to share a message in social media on behalf of the user.
    
    @method showShareDialog
    @param {String} heading The heading of the share dialog. This should be
    a short text describing why the user is presented to share something.
    @param {String} message A prefilled message that the user is about to share,
    the user will always have the possibility to change what is about to be
    shared.
    @return {Promise} A promise that will resolve if the user decides to share
    your message or rejects if the user decideds to abort the sharing process.
    */


    Native.prototype.showShareDialog = function(heading, message) {
      var deferred;
      deferred = $.Deferred();
      this._trigger("showShareDialog", {
        heading: heading,
        message: message
      });
      this._events.one("shareDialogShown", function(event, shared) {
        if (shared) {
          return deferred.resolve();
        } else {
          return deferred.reject();
        }
      });
      return deferred;
    };

    /**
    
    Request the payment of an in-app purchase, represented by a
    token. This will cause the IAP payment flow to begin and the in-app
    payment modal to popup.
    
    @method requestPayment
    @param {String} token The token identifiying the in-app purchase that is to be paid.
    @return {Promise} A promise that resolves if and only if the user pays for the purchase.
    It is rejected if the flow did not cause the user to be charged.
    */


    Native.prototype.requestPayment = function(token) {
      var def;
      def = $.Deferred();
      this._trigger("requestPayment", {
        token: token
      });
      this._events.one("paymentDone", function(e, data) {
        if (data.paid) {
          return def.resolve(data);
        } else {
          return def.reject(data);
        }
      });
      return def;
    };

    /**
    Create a purchase token with a price, title and currency.
    
    @method createPurchaseToken
    @param {Object} options An object consisting of title, price and currency.
    @return {Promise} A promise that resolves to the ID of the token or is rejected
    if we were unable to create the requested inapp purchase.
    */


    Native.prototype.createPurchaseToken = function(_arg) {
      var currency, endpoint, params, price, title;
      title = _arg.title, price = _arg.price, currency = _arg.currency;
      endpoint = "v1/stores/" + this.storeId + "/in_app_purchases";
      params = {
        endpoint: endpoint,
        type: "POST",
        data: JSON.stringify({
          "title": title,
          "price": price,
          "currency": currency
        })
      };
      return TT.api.ajax(params).then(function(response) {
        return response.id;
      });
    };

    /**
    Helper method that creates a purchase and then requests payment for it.
    
    @method createAndRequestPayment
    @param {Object} options An object with a price, title and currency.
    @return {Promise} A promise that resolves if a payment was successfully
    created and paid.
    */


    Native.prototype.createAndRequestPayment = function(obj) {
      return this.createPurchaseToken(obj).then(this.requestPayment);
    };

    /**
    Use this method to show a message to the user inside the Tictail Dashboard.
    This could be used to show the results of actions inside your application,
    i.e. a short "Saved" when the users data have been saved.
    
    @method showStatus
    @param {String} message The short message to show to the user.
    */


    Native.prototype.showStatus = function(message) {
      return this._trigger("showStatus", message);
    };

    Native.prototype._trigger = function(eventName, eventData) {
      var message;
      message = JSON.stringify({
        eventName: eventName,
        eventData: eventData
      });
      return window.parent.postMessage(message, this.PARENT_ORIGIN);
    };

    return Native;

  })();

  if (typeof define === 'function' && define.amd) {
    define('tt-native', ['jquery', 'tt-core'], function($, TT) {
      return TT["native"] = new Native;
    });
  } else {
    TT["native"] = new Native;
  }

}).call(this);

},{"./tt-core":2}],4:[function(require,module,exports){
(function() {
  var TT;

  TT = require('./tt-core');

  require('./tt-api');

  require('./tt-native');

  if (typeof define === 'function' && define.amd) {
    define('tt', ['tt-core', 'tt-api', 'tt-native'], function(tt) {
      return tt;
    });
  } else {
    window.TT = TT;
  }

}).call(this);

},{"./tt-api":1,"./tt-core":2,"./tt-native":3}]},{},[4])

}