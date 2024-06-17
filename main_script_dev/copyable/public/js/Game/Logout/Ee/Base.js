/**
 * Base object
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Base}
 */
Ee.Base = function(options, parent)
{
	if (parent)
	{
		this.parent = parent;
	}

	// es gibt eine ID an dem Objekt
	if (Ee.Object.hasProperty(this, 'id'))
	{
		// die ID wurde gesetzt, dann die UniqueId entsprechend anpassen
		if (options && typeof options.id != 'undefined')
		{
			Ee.Base._globalUniqueId = Math.max(Ee.Base._globalUniqueId, options.id) + 1;
		}

		// es gibt keine Options oder keine ID dann eine zuweisen
		else if (!options || typeof options.id == 'undefined')
		{
			options.id = ++Ee.Base._globalUniqueId;
		}
	}

	Ee.Object.extend(this, options);

	return this;
};

/**
 * Global UniqueId
 *
 * @var {Number}
 */
Ee.Base._globalUniqueId = 1;

/**
 * Parent Object
 *
 * @var {Object}
 */
Ee.Base.prototype.parent = null;

// Prototype
Ee.Base.prototype = Object.create(Object.prototype,
{
	parent:
	{
		value: null,
		enumerable: false,
		configurable: false,
		writable: true
	}
});

/**
 * fügt ein EventListener hinzu
 *
 * @param {String} name
 * @param {Function} callback
 * @returns {Ee.Base}
 */
Ee.Base.prototype.addEvent = function(name, callback)
{
	if (!this._events)
	{
		this._events = {};
	}

	if (!this._events[name])
	{
		this._events[name] = [];
	}

	this._events[name].push(callback);

	return this;
};

/**
 * zerstört alles an diesem Object.
 *
 * @returns {Ee.Base}
 */
Ee.Base.prototype.destroy = function()
{
	this.destroyProperty('parent', false);

	return this;
};

/**
 * zerstört alles an diesem Object.
 *
 * @param {String} property
 * @param {Boolean} destroyObjectFunction optional default TRUE
 * @returns {Ee.Base}
 */
Ee.Base.prototype.destroyProperty = function(property, destroyObjectFunction)
{
	if (typeof destroyObjectFunction == 'undefined')
	{
		destroyObjectFunction = true;
	}

	if (destroyObjectFunction && typeof this[property] == 'object' && typeof this[property]['destroy'] == 'function')
	{
		this[property].destroy();
	}
	this[property] = null;
	delete(this[property]);

	return this;
};

/**
 * feuert ein Events
 * @param {String} name
 * @param {*} arguments
 * @returns {Ee.Base}
 */
Ee.Base.prototype.fireEvent = function(name)
{
	var self = this;
	var args = Array.convert(arguments);
	args.shift();

	if (!this._events)
	{
		return this;
	}

	if (!this._events[name])
	{
		return this;
	}

	self._events[name].find(function(callback)
	{
		return callback.apply(this, args) === false;
	});
	return this;
};