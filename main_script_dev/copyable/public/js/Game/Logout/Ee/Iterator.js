/**
 * Iterator
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Iterator}
 */
Ee.Iterator = function(options, parent)
{
	Ee.Base.call(this, options, parent);

	this._iteratorData = {};

	return this;
};

// Prototype Property definition
Ee.Iterator.prototype = Object.create(Ee.Base.prototype,
{
	length:
	{
		get: function()
		{
			return Object.keys(this._iteratorData).length;
		}
	}
});

/**
 * fügt einen neuen eintrag hinzu
 *
 * @param {Object} entry
 * @param mixed id
 * @returns {Ee.Iterator}
 */
Ee.Iterator.prototype.add = function(entry, id)
{
	if (this._iteratorData[id])
	{
		this.remove(id);
	}

	this._iteratorData[id] = entry;

	return this;
};

/**
 * zerstört alles an diesem Object.
 *
 * @returns {Ee.Iterator}
 */
Ee.Iterator.prototype.destroy = Ee.Iterator.prototype.destroy.wrap(function(proceed)
{
	for (var key in this._iteratorData)
	{
		this._iteratorData[key].destroy();
		delete(this._iteratorData[key]);
	}

	this.destroyProperty('_iteratorData', false);

	return proceed();
});

/**
 * liefert den eintrag sofern vorhanden ansonsten NULL
 *
 * @param mixed id
 * @returns {Object}
 */
Ee.Iterator.prototype.get = function(id)
{
	if (this._iteratorData[id])
	{
		return this._iteratorData[id];
	}

	return null;
};

/**
 * iteriert über alle einträge
 *
 * @param {Function} callback [entry, iterator]
 * @returns {Ee.Iterator}
 */
Ee.Iterator.prototype.each = function(callback)
{
	var self = this;

	Object.each(this._iteratorData, function(entry)
	{
		callback(entry, self);
	});

	return this;
};

/**
 * sucht einen eintrag
 *
 * @param {Function} callback [entry, iterator]
 * @returns {Object}
 */
Ee.Iterator.prototype.find = function(callback)
{
	var self = this;

	return Object.find(this._iteratorData, function(entry)
	{
		return callback(entry, self);
	});
};

/**
 * liefert alle Keys
 *
 * @returns {Array}
 */
Ee.Iterator.prototype.keys = function()
{
	return Object.keys(this._iteratorData);
};

/**
 * reduce
 *
 * @param {Function} callback [previousValue, entry, iterator]
 * @param mixed initialValue
 * @returns mixed
 */
Ee.Iterator.prototype.reduce = function(callback, initialValue)
{
	var self = this;

	return Object.reduce(this._iteratorData, function(previousValue, entry)
	{
		return callback(previousValue, entry, self);
	}, initialValue);
};

/**
 * liefert einen Zufälligen Eintrag
 *
 * @params mixed ignoreId diesen einen eintrag ignorieren
 * @returns mixed
 */
Ee.Iterator.prototype.random = function(ignoreId)
{
	var possibleEntries = this.keys();

	if (typeof ignoreId !== 'undefined')
	{
		possibleEntries = possibleEntries.filter(function(id)
		{
			return !(id == ignoreId);
		});
	}
	var key = possibleEntries.getRandom();

	if (key === null)
	{
		return null;
	}

	return this.get(possibleEntries.getRandom());
};

/**
 * entfernt einen eintrag
 *
 * @param mixed id
 * @returns {Ee.Iterator}
 */
Ee.Iterator.prototype.remove = function(id)
{
	if (this._iteratorData[id])
	{
		delete this._iteratorData[id];
	}

	return this;
};