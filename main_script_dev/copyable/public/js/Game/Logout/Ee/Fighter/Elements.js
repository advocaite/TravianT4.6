/**
 * Fighter Object
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Fighter.Elements}
 */
Ee.Fighter.Elements = function(options, parent)
{
	Ee.Fighter.call(this, options, parent);

	return this;
};

//Prototype
Ee.Fighter.Elements.prototype = Object.create(Ee.Fighter.prototype,
	{
	});

/**
 * beendet den Kampf
 *
 * @returns {Ee.Fighter}
 */
Ee.Fighter.Elements.prototype.finishFight = Ee.Fighter.Elements.prototype.finishFight.wrap(function(proceed)
{
	proceed();

	this.each(function(units)
	{
		units.each(function(unit)
		{
			unit.element.fade('out');
		});
	});

	return this;
});