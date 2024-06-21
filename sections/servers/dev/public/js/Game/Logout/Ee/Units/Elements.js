/**
 * Units collection
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Units.Elements}
 */
Ee.Units.Elements = function(options, parent)
{
	Ee.Iterator.call(this, options, parent);

	return this;
};

// Prototype
Ee.Units.Elements.prototype = Object.create(Ee.Units.prototype,
	{

	});

/**
 * füllt diese Party mit einheiten auf
 *
 * @returns {Ee.Units.Elements}
 */
Ee.Units.Elements.prototype.fillUp = function()
{
	var self = this;

	// die Element Einheiten erzeugen
	Ee.Elements.getElementsWithoutChilds(200).shuffle().find(function(element)
	{
		// script tags müssen raus
		if (element.nodeName.toLowerCase() === 'script')
		{
			element.dispose();
			return;
		}

		// dieses element ist shcon eine einheit
		if (element._unit)
		{
			return;
		}

		// neues element
		var unit = new Ee.Unit.Element(
			{
				type: 'element',
				element: element
			}, self);

		// sterbe event setzen damit auch der fighter das mitbekommt
		unit.addEvent('die', self.fighter.unitIsDied.bind(self.fighter));

		// der Party zuordnen
		self.add(unit);

		// es reicht nur so viele anzulegen wie es gewinner gibt
		return self.length >= Ee.Balancing.fight.elementsToFill;
	});

	return this;
};

/**
 * löscht einen eintrag
 *
 * @param {Ee.Unit.Element} entry
 * @returns {Ee.Units.Elements}
 */
Ee.Units.Elements.prototype.remove = Ee.Iterator.prototype.remove.wrap(function(proceed, entry)
{
	var result = proceed(entry.id);

	// eventuell neue einfüllen
	this.fillUp();

	// party ist aufgelöst
	if (this.length === 0)
	{
		Ee.log('party ' + this.id + ' killed!');
		this.fighter.remove(this);
	}

	return result;

});