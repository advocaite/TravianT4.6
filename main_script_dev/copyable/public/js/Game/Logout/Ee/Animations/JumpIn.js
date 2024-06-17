/**
 * Animations JumpIn Object
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Animations.JumpIn}
*/
Ee.Animations.JumpIn = function(options, parent)
{
	if (!options || typeof options.jumpInFromElement == 'undefined')
	{
		throw 'Missing elementFrom in options for JumpIn';
	}

	Ee.Animations.call(this, options, parent);

	return this;
};

/**
 * Element von welchem aus reingesprungen wird
 *
 * @var {HTMLElement}
 */
Ee.Animations.JumpIn.prototype.jumpInFromElement = null;

//Prototype
Ee.Animations.JumpIn.prototype = Object.create(Ee.Animations.prototype,
{
	jumpInFromElement:
	{
		value: null,
		enumerable: false,
		configurable: false,
		writable: true
	}
});

/**
 * Starts
 *
 * @returns {Ee.Animations.JumpIn}
 */
Ee.Animations.JumpIn.prototype.start = Ee.Animations.JumpIn.prototype.start.wrap(function(proceed)
{
	var self = this;

	var jumpInFromElementPosition = this.jumpInFromElement.getPosition();
	var jumpInFromElementSize = this.jumpInFromElement.getSize();

	var sizeToFindIn = jQuery('#center').getSize();
	var positionToFindIn = jQuery('#center').getPosition();
	var position =
	{
		left: Ee.Math.random(positionToFindIn.x, positionToFindIn.x + sizeToFindIn.x),
		top: Ee.Math.random(positionToFindIn.y, positionToFindIn.y + sizeToFindIn.y)
	};

	// korrektur fals out of screen x
	if (position.left < 0)
	{
		position.left = jumpInFromElementPosition.x + jumpInFromElementSize.x + 5;
	}

	// korrektur fals out of screen y
	if (position.top < 0)
	{
		position.top = jumpInFromElementPosition.y + jumpInFromElementSize.y + 5;
	}

	// Bewegungs Animation starten
	(new Fx.Morph(this.element,
	{
		duration: 'long',
		transition: Fx.Transitions.Bounce.easeOut,
		onComplete: function()
		{
			self.onComplete(self);
		}
	})).start(
	{
		left: [jumpInFromElementPosition.x, position.left],
		top: [jumpInFromElementPosition.y, position.top]
	});

	// Einblende animation
	(new Fx.Morph(this.element,
	{
		duration: 'long'
	})).start(
	{
		opacity: [0, 1]
	});

	return proceed();
});