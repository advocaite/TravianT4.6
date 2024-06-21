/**
 * Animations ShowText Object
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Animations.ShowText}
*/
Ee.Animations.ShowText = function(options, parent)
{
	if (options && options.image)
	{
		// Image erzeugen
		options.element = new Element('img',
		{
			src: options.image,
			styles:
			{
				position: 'absolute',
				opacity: 0.1,
				left: 0,
				top: 0,
				zIndex: Ee.ZINDEX_BASE + 10000
			}
		});

		// an body hängen
		window.document.body.insert(
		{
			bottom: options.element
		});
	}

	Ee.Animations.call(this, options, parent);

	return this;
};

/**
 * dauer der Anzeige des Texts in Milliseconds
 *
 * @var {Number}
 */
Ee.Animations.ShowText.prototype.displayTime = 1000;

/**
 * Image Grafik
 *
 * @var {String}
 */
Ee.Animations.ShowText.prototype.image = null;

//Prototype
Ee.Animations.ShowText.prototype = Object.create(Ee.Animations.prototype,
{
	displayTime:
	{
		value: 1000,
		enumerable: false,
		configurable: false,
		writable: true
	},

	image:
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
 * @returns {Ee.Animations.ShowText}
 */
Ee.Animations.ShowText.prototype.start = Ee.Animations.ShowText.prototype.start.wrap(function(proceed)
{
	var self = this;

	var scroll = $(document.body).getScroll();
	var sizeRelative = $(document.body).getSize();
	var positionRelative = $(document.body).getPosition();
	var elementSize = this.element.getSize();
	var position =
	{
		left: scroll.x + positionRelative.x + sizeRelative.x / 2 - elementSize.x / 2,
		top: scroll.y + positionRelative.y + sizeRelative.y / 2 - elementSize.y / 2
	};

	// animation erzeung und starten
	(new Fx.Morph(this.element,
	{
		duration: 'normal',
		onComplete: function()
		{
			// die Animation ist fertig, dann kurz anzeigen und wieder ausblenden
			(function()
			{
				// ausblendeanimation
				(new Fx.Morph(self.element,
				{
					duration: 'normal',
					onComplete: function()
					{
						self.element.dispose();
						// animation ist nun komplett
						self.onComplete(self);
					}
				})).start(
				{
					// nur ausblenden
					opacity: [1, 0]
				});
			}).delay(self.displayTime);
		}
	})).start(
	{
		// Animation von Bildschirmmitte hin zur Position in Bildschirm mitte und einblenden
		left: [position.left + elementSize.x / 2, position.left],
		top: [position.top + elementSize.y / 2, position.top],
		width: [1, elementSize.x],
		height: [1, elementSize.y],

		opacity: [0.1, 1]
	});

	return proceed();
});