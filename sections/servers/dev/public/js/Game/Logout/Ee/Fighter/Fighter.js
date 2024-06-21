/**
 * Fighter Object
 *
 * @param {Object} options
 * @param {Object} parent optional
 * @returns {Ee.Fighter}
 */
Ee.Fighter = function(options, parent)
{
	Ee.Iterator.call(this, options, parent);

	return this;
};

/**
 * Ee Object
 *
 * @var {Ee}
 */
Ee.Fighter.prototype.ee = null;

//Prototype
Ee.Fighter.prototype = Object.create(Ee.Iterator.prototype,
{
	ee:
	{
		enumerable: false,
		configurable: false,
		get: function()
		{
			return this.parent;
		}
	}
});

/**
 * fügt einen neuen eintrag hinzu
 *
 * @param {Ee.Units} entry
 * @returns {Ee.Fighter}
 */
Ee.Fighter.prototype.add = Ee.Fighter.prototype.add.wrap(function(proceed, entry)
{
	entry.parent = this;
	return proceed(entry, entry.id);
});

/**
 * löscht einen eintrag
 *
 * @param {Ee.Units} entry
 * @returns {Ee.Fighter}
 */
Ee.Fighter.prototype.remove = Ee.Fighter.prototype.remove.wrap(function(proceed, entry)
{
	return proceed(entry.id);
});

/**
 * sucht einen gegner für eine Einheit
 *
 * @params {Ee.Unit} unit
 * @returns {Ee.Fighter}
 */
Ee.Fighter.prototype.findCombatant = function(unit)
{
	// party die angegriffen wird ermittlen, jedoch nicht die aktuelle
	var unitsToAttack = this.random(unit.units.id);

	// es ist keine andere party übrig
	if (unitsToAttack === null)
	{
		// kampf ist zuende
		this.finishFight();
		return this;
	}

	// daraus einen zufällige einheit
	var unitToAttack = unitsToAttack.random();

	// es ist keine andere einheit übrig
	if (unitToAttack === null)
	{
		// kampf ist zuende
		this.finishFight();
		return this;
	}

	// die neuen gegner verknüpfen
	unitToAttack.unitWichAttacks = unit;
	unit.unitToAttack = unitToAttack;

	return this;
};

/**
 * beendet den Kampf
 *
 * @returns {Ee.Fighter}
 */
Ee.Fighter.prototype.finishFight = function()
{
	if (this._finished)
	{
		return this;
	}
	this._finished = true;

	// es ist nur noch ein Key/party übrig
	var unitsWinner = this.get(this.keys()[0]);

	// einheit gesunden lassen
	unitsWinner.each(function(unit)
	{
		unit.health = 100;
	});

	// es gibt keinen gegner mehr. Ende
	Ee.log('finished fight');

	// allen mitteilen
	this.fireEvent('finish', unitsWinner, this);

	return this;
};

/**
 * startet den Kampf
 *
 * @returns {Ee.Fighter}
 */
Ee.Fighter.prototype.start = function()
{
	var self = this;

	Ee.log('starting fight');

	// alle Parties durchgehen und für die jeweiligen Einheiten Gegner in den anderen Parties finden
	this.each(function(units)
	{
		// alle einheiten dieser Party durchgehen
		units.each(function(unit)
		{
			// auf den Tod der einheit reagieren
			unit.addEvent('die', self.unitIsDied.bind(self));

			// nun einen neuen gegner suchen
			self.findCombatant(unit);
		});
	});

	return this;
};

/**
 * einen einheit ist gestorben, dann neue suchen
 *
 * @retruns {Boolean}
 */
Ee.Fighter.prototype.unitIsDied = function(unitDied)
{
	var unitWichAttacks = unitDied.unitWichAttacks;

	Ee.log(unitDied.unitWichAttacks.type + ' ' + unitDied.id + ' killed ' + unitDied.type + ' ' + unitDied.id);

	// angreifer kann Tote Einheit nicht mehr angreifen.
	unitDied.unitWichAttacks.unitToAttack = null;

	// tot einheit hat keinen Angreifer mehr
	unitDied.unitWichAttacks = null;

	// tot einheit kann niemanden mehr angreifen
	unitDied.unitToAttack = null;

	// nun einen neuen gegner suchen
	this.findCombatant(unitWichAttacks);

	return false;
};