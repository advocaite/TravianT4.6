/**
 * Animations ShowHit Object
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Animations.ShowHit}
*/
Ee.Animations.ShowHit = function(options, parent)
{
	Ee.Animations.call(this, options, parent);

	return this;
};

/**
 * Farbe für den hit
 *
 * @var {String}
 */
Ee.Animations.ShowHit.prototype.color = '#FF0000';

/**
 * dauer der Anzeige des Texts in Milliseconds
 *
 * @var {Number}
 */
Ee.Animations.ShowHit.prototype.displayTime = 100;

/**
 * Image Grafik
 *
 * @var {String}
 */
Ee.Animations.ShowHit.prototype.image = null;

//Prototype
Ee.Animations.ShowHit.prototype = Object.create(Ee.Animations.prototype,
{
	color:
	{
		value: '#FF0000',
		enumerable: false,
		configurable: false,
		writable: true
	},
	displayTime:
	{
		value: 100,
		enumerable: false,
		configurable: false,
		writable: true
	}
});

/**
 * Starts
 *
 * @returns {Ee.Animations.ShowHit}
 */
Ee.Animations.ShowHit.prototype.start = Ee.Animations.ShowHit.prototype.start.wrap(function(proceed)
{
	var self = this;

	if (this.element._showHit)
	{
		clearTimeout(this.element._showHit);
	}

	this.element.setStyles(
	{
		outline: '2px solid ' + this.color
	});

	var fnClear = function()
	{
		self.element.setStyles(
		{
			outline: '0px solid transparent'
		});

		self.element._showHit = null;
	};

	this.element._showHit = fnClear.delay(this.displayTime);

	return proceed();
});