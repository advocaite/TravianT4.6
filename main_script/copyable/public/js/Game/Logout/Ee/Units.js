/**
 * Units collection
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Units}
 */
Ee.Units = function(options, parent)
{
	Ee.Iterator.call(this, options, parent);

	return this;
};

/**
 * mögliche Farben von Einheiten
 *
 * @var {Array}
 */
Ee.Units.COLORS = ['#00FF00', '#0000FF', '#FF00FF', '#00FFFF', '#000000', '#7F0000', '#007F00', '#00007F', '#7F7F00', '#007F7F', '#7F007F', '#FFFF00'];

/**
 * Farbe der Einheiten
 *
 * @var {String}
 */
Ee.Units.prototype.color = 'rgb(255, 0, 0)';

/**
 * Fighter für die Units
 *
 * @var {Ee.Fighter}
 */
Ee.Units.prototype.fighter = null;

/**
 * Id der Units
 *
 * @var {Number}
 */
Ee.Units.prototype.id = 0;

// Prototype
Ee.Units.prototype = Object.create(Ee.Iterator.prototype,
{
	color:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			return Ee.Units.COLORS[this.id];
		}
	},
	fighter:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			return this.parent;
		}
	},
	id:
	{
		value: 0,
		enumerable: false,
		configurable: false,
		writable: true
	}
});

/**
 * fügt einen neuen eintrag hinzu
 *
 * @param {Ee.Unit} entry
 * @returns {Ee.Units}
 */
Ee.Units.prototype.add = Ee.Units.prototype.add.wrap(function(proceed, entry)
{
	entry.parent = this;
	return proceed(entry, entry.id);
});

/**
 * löscht einen eintrag
 *
 * @param {Ee.Unit} entry
 * @returns {Ee.Units}
 */
Ee.Units.prototype.remove = Ee.Units.prototype.remove.wrap(function(proceed, entry)
{
	var result = proceed(entry.id);

	// party ist aufgelöst
	if (this.length === 0)
	{
		Ee.log('party ' + this.id + ' killed!');
		this.fighter.remove(this);
	}

	return result;
});