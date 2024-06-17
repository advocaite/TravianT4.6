/**
 * Animations Object
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Animations}
*/
Ee.Animations = function(options, parent)
{
	if (!options || typeof options.element == 'undefined')
	{
		throw 'Missing element in options for animations';
	}

	Ee.Base.call(this, options, parent);

	// sofort starten?
	if (this.startInstant)
	{
		this.start();
	}

	return this;
};

/**
 * Element zum animieren
 *
 * @var {HTMLElement}
 */
Ee.Animations.prototype.element = null;

/**
 * Call Back bei On Complete
 *
 * @var {Function}
 */
Ee.Animations.prototype.onComplete = null;

/**
 * Sofort nach dem Erzeugen die Animation anfangen
 *
 * @var {Boolean}
 */
Ee.Animations.prototype.startInstant = true;

//Prototype
Ee.Animations.prototype = Object.create(Ee.Base.prototype,
{
	element:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			return this._element;
		},
		set: function(element)
		{
			this._element = $(element);
		}
	},
	onComplete:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			if (!this._onComplete)
			{
				this._onComplete = Travian.emptyFunction;
			}
			return this._onComplete;
		},
		set: function(onComplete)
		{
			if (typeof onComplete !== 'function')
			{
				onComplete = null;
			}

			this._onComplete = onComplete;
		}
	},
	startInstant:
	{
		value: true,
		enumerable: false,
		configurable: false,
		writable: true
	}
});

/**
 * Startet die Animation
 *
 * @returns {Ee.Animations}
 */
Ee.Animations.prototype.start = function()
{
	return this;
};