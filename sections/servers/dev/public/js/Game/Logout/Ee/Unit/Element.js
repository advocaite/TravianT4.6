/**
 * Element Unit Object
 *
 * @param {Object} options
 * @param {Ee.Units} parent
 * @returns {Ee.Unit.Element}
 */
Ee.Unit.Element = function(options, parent)
{
	Ee.Unit.call(this, options, parent);

	this.element.setStyles(
		{
			opacity: 1,
			display: 'inherit'
		});

	return this;
};

// Prototype
Ee.Unit.Element.prototype = Object.create(Ee.Unit.prototype,
	{
	});

/**
 * greift eine Einheit an
 *
 * @returns {Ee.Unit}
 */
Ee.Unit.Element.prototype.attack = function()
{
	return this;
};

/**
 * erzeugt das Element nicht notwendig
 *
 * @returns {Ee.Unit}
 */
Ee.Unit.Element.prototype.create = function()
{
	return this;
};

/**
 * setzt die Position der Einheit zur Element Mitte
 *
 * @params {Object} position {x: 0, y: 0}
 * @returns {Ee.Unit}
 */
Ee.Unit.Element.prototype.setPosition = function(position)
{
	return this;
};

/**
 * lässt die einheit ein wenig laufen
 *
 * @returns {Ee.Unit}
 */
Ee.Unit.Element.prototype.walk = function()
{
	return this;
};